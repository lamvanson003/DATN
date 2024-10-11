import React, { useContext } from "react";
import { Header, Footer, Loading } from "../../components";
import { Outlet, useLocation } from "react-router-dom";
import { CartContext } from "../../context/Cart";
import { FavorContext } from "../../context/Favor";
import { useSelector } from "react-redux";
const Public = () => {
  const { isLoading } = useSelector((state) => state.app);
  const location = useLocation();
  const hideHeaderFooterRoutes = ["/login", "/signup"];
  const shouldHideHeaderFooter = hideHeaderFooterRoutes.includes(
    location.pathname
  );
  const { cartItems } = useContext(CartContext);
  const { favorItems } = useContext(FavorContext);

  return (
    <div style={{ position: "relative" }}>
      {isLoading ? (
        <div
          style={{
            position: "absolute",
            boxSizing: "border-box",
            width: "100%",
            height: "100vh",
            zIndex: 100,
            backgroundColor: "#fff",
          }}
          className="position-absolute top-0 bottom-0 right-0 d-flex align-items-center justify-content-center"
        >
          <Loading />
        </div>
      ) : (
        <div>
          {!shouldHideHeaderFooter && (
            <Header
              cartItemAmout={cartItems.length}
              favorItemAmount={favorItems.length}
            />
          )}
          <div>
            <Outlet />
          </div>
          {!shouldHideHeaderFooter && <Footer />}
        </div>
      )}
    </div>
  );
};

export default Public;
