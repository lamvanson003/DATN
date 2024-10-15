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
    <div className="container">
      <div
        className="carousel slide"
        data-bs-ride="carousel"
        id="brandCarousel"
      >
        <div className="carousel-inner">
          <div className="carousel-item active">
            <div className="d-flex justify-content-between gap-2">
              {/* Apple Card */}
              <div className="brand-card apple-card p-3">
                <a className="" href="/apple">
                  <img
                    alt="Apple logo"
                    className="card-img-top m-0"
                    src={logoApple}
                  />
                </a>
              </div>

              {/* Samsung Card */}
              <div className="brand-card samsung-card p-3">
                <a className="" href="/samsung">
                  <img
                    alt="Samsung logo"
                    className="card-img-top m-0"
                    src={logoSamSung}
                  />
                </a>
              </div>

              {/* Microsoft Card */}
              <div className="brand-card microsoft-card p-3">
                <a className="" href="/microsoft">
                  <img
                    alt="Microsoft logo"
                    className="card-img-top m-0"
                    src={logoMic}
                  />
                </a>
              </div>

              {/* Lenovo Card */}
              <div className="brand-card lenovo-card p-3">
                <a className="" href="/lenovo">
                  <img
                    alt="Lenovo logo"
                    className="card-img-top m-0"
                    src={logoLeno}
                  />
                </a>
              </div>

              {/* Amazon Card */}
              <div className="brand-card amazon-card p-3">
                <a className="" href="/amazon">
                  <img
                    alt="Amazon logo"
                    className="card-img-top m-0"
                    src={logoAmazon}
                  />
                </a>
              </div>

              {/* Huawei Card */}
              <div className="brand-card huawei-card p-3">
                <a className="" href="/huawei">
                  <img
                    alt="Huawei logo"
                    className="card-img-top m-0"
                    src={logoHuW}
                  />
                </a>
              </div>

              {/* Xiaomi Card */}
              <div className="brand-card xiaomi-card p-3">
                <a className="" href="/xiaomi">
                  <img
                    alt="Xiaomi logo"
                    className="card-img-top m-0"
                    src={logoXiaomi}
                  />
                </a>
              </div>

              {/* Realme Card */}
              <div className="brand-card realme-card p-3">
                <a className="" href="/realme">
                  <img
                    alt="Realme logo"
                    className="card-img-top m-0"
                    src={logoReal}
                  />
                </a>
              </div>
            </div>
          </div>
        </div>
        <button
          className="carousel-control-prev"
          data-bs-slide="prev"
          data-bs-target="#brandCarousel"
          type="button"
        >
          <span aria-hidden="true" className="carousel-control-prev-icon">
            <i className="fas fa-chevron-left" />
          </span>
          <span className="visually-hidden">Previous</span>
        </button>
        <button
          className="carousel-control-next"
          data-bs-slide="next"
          data-bs-target="#brandCarousel"
          type="button"
        >
          <span aria-hidden="true" className="carousel-control-next-icon">
            <i className="fas fa-chevron-right" />
          </span>
          <span className="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  );
};

export default Brand;
