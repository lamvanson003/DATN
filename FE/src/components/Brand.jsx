import React from "react";
import logoApple from "../assets/images/iHome/Apple_logo_black 1.png";
import logoSamSung from "../assets/images/iHome/logo-samsung.png";
import logoMic from "../assets/images/iHome/microshop.png";
import logoLeno from "../assets/images/iHome/Lenovo.png";
import logoAmazon from "../assets/images/iHome/Amazon.png";
import logoHuW from "../assets/images/iHome/Huawei-Logo 1.png";
import logoXiaomi from "../assets/images/iHome/xiaomi.png";
import logoReal from "../assets/images/iHome/realme.png";
import "./css/Brand.css";

const Brand = () => {
  return (
    <div className="container ">
      <div
        className="carousel slide"
        data-bs-ride="carousel"
        id="brandCarousel"
      >
        <div className="carousel-inner">
          <div className="carousel-item active">
            <div className="brand-carousel">
              <div className="brand-card">
                <img alt="Apple logo" src={logoApple} />
              </div>
              <div className="brand-card">
                <img alt="Samsung logo" src={logoSamSung} />
              </div>
              <div className="brand-card">
                <img alt="Microsoft logo" src={logoMic} />
              </div>
              <div className="brand-card">
                <img alt="Lenovo logo" src={logoLeno} />
              </div>
              <div className="brand-card">
                <img alt="Amazon logo" src={logoAmazon} />
              </div>
              <div className="brand-card">
                <img alt="Huawei logo" src={logoHuW} />
              </div>
              <div className="brand-card">
                <img alt="Xiaomi logo" src={logoXiaomi} />
              </div>
              <div className="brand-card">
                <img alt="Realme logo" src={logoReal} />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Brand;
