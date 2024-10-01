import React from "react";
import { Header, Footer } from "../../components";
import { Outlet } from "react-router-dom";
const Public = () => {
  return (
    <div>
      <Header />
      <div>
        <Outlet />
      </div>
      <Footer />
    </div>
  );
};

export default Public;
