import React from "react";
import { Header, Footer } from "../../components";
import { Outlet, useLocation } from "react-router-dom";
const Public = () => {
  const location = useLocation();
  const hideHeaderFooterRoutes = ["/login", "/signup"];
  const shouldHideHeaderFooter = hideHeaderFooterRoutes.includes(
    location.pathname
  );

  return (
    <div>
      {!shouldHideHeaderFooter && <Header />}
      <div>
        <Outlet />
      </div>
      {!shouldHideHeaderFooter && <Footer />}
    </div>
  );
};

export default Public;
