import React, { useContext } from "react";
import { Header, Footer } from "../../components";
import { Outlet, useLocation } from "react-router-dom";
import { CartContext } from "../../context/Cart";
import { FavorContext } from "../../context/Favor";
const Public = () => {
  const location = useLocation();
  const hideHeaderFooterRoutes = ["/login", "/signup"];
  const shouldHideHeaderFooter = hideHeaderFooterRoutes.includes(
    location.pathname
  );
  const { cartItems } = useContext(CartContext);
  const { favorItems } = useContext(FavorContext);

  return (
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
  );
};

export default Public;
