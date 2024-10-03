import React from "react";
import logoApple from "../assets/images/iHome/Apple_logo_black 1.png";
import logoSamSung from "../assets/images/iHome/logo-samsung.png";
import logoMic from "../assets/images/iHome/microshop.png";
import logoLeno from "../assets/images/iHome/Lenovo.png";
import logoAmazon from "../assets/images/iHome/Amazon.png";
import logoHuW from "../assets/images/iHome/Huawei-Logo 1.png";
import logoXiaomi from "../assets/images/iHome/xiaomi.png";
import logoReal from "../assets/images/iHome/realme.png";
const Brand = () => {
  return (
    <div className="container mt-5">
      <div className="category-header">Điện thoại</div>
      <div
        className="carousel slide"
        data-bs-ride="carousel"
        id="brandCarousel"
      >
        <div className="carousel-inner">
          <div className="carousel-item active">
            <div className="d-flex justify-content-center flex-wrap">
              {/* Apple Card */}
              <div
                className="brand-card"
                style={{
                  backgroundColor: "#B9D5FF",
                  width: 137,
                  height: 180.19,
                  marginRight: 27,
                  borderRadius: 10,
                }}
              >
                <a className="brand-link" href="/apple">
                  <img
                    alt="Apple logo"
                    className="card-img-top"
                    src={logoApple}
                  />
                </a>
                <div className="brand-card-body text-center">
                  <a className="brand-card-title brand-link" href="/apple">
                    Apple
                  </a>
                  <br />
                  <a className="brand-card-text brand-link" href="/apple">
                    26 items
                  </a>
                </div>
              </div>
              {/* Samsung Card */}
              <div
                className="brand-card"
                style={{
                  backgroundColor: "#ADD8E6",
                  width: 137,
                  height: "180.19px",
                  marginRight: 27,
                  borderRadius: 10,
                }}
              >
                <a className="brand-link" href="/samsung">
                  <img
                    alt="Samsung logo"
                    className="card-img-top"
                    src={logoSamSung}
                  />
                </a>
                <div className="brand-card-body text-center">
                  <a className="brand-card-title brand-link" href="/samsung">
                    Samsung
                  </a>
                  <br />
                  <a className="brand-card-text brand-link" href="/samsung">
                    28 items
                  </a>
                </div>
              </div>
              {/* Microsoft Card */}
              <div
                className="brand-card"
                style={{
                  backgroundColor: "#B0E0E6",
                  width: 137,
                  height: "180.19px",
                  marginRight: 27,
                  borderRadius: 10,
                }}
              >
                <a className="brand-link" href="/microsoft">
                  <img
                    alt="Microsoft logo"
                    className="card-img-top"
                    src={logoMic}
                  />
                </a>
                <div className="brand-card-body text-center">
                  <a className="brand-card-title brand-link" href="/microsoft">
                    Microsoft
                  </a>
                  <br />
                  <a className="brand-card-text brand-link" href="/microsoft">
                    14 items
                  </a>
                </div>
              </div>
              {/* Lenovo Card */}
              <div
                className="brand-card"
                style={{
                  backgroundColor: "#AFEEEE",
                  width: 137,
                  height: "180.19px",
                  marginRight: 27,
                  borderRadius: 10,
                }}
              >
                <a className="brand-link" href="/lenovo">
                  <img
                    alt="Lenovo logo"
                    className="card-img-top"
                    src={logoLeno}
                  />
                </a>
                <div className="brand-card-body text-center">
                  <a className="brand-card-title brand-link" href="/lenovo">
                    Lenovo
                  </a>
                  <br />
                  <a className="brand-card-text brand-link" href="/lenovo">
                    54 items
                  </a>
                </div>
              </div>
              {/* Amazon Card */}
              <div
                className="brand-card"
                style={{
                  backgroundColor: "#CCEEFF",
                  width: 137,
                  height: "180.19px",
                  marginRight: 27,
                  borderRadius: 10,
                }}
              >
                <a className="brand-link" href="/amazon">
                  <img
                    alt="Amazon logo"
                    className="card-img-top"
                    src={logoAmazon}
                  />
                </a>
                <div className="brand-card-body text-center">
                  <a className="brand-card-title brand-link" href="/amazon">
                    Amazon
                  </a>
                  <br />
                  <a className="brand-card-text brand-link" href="/amazon">
                    56 items
                  </a>
                </div>
              </div>
              {/* Huawei Card */}
              <div
                className="brand-card"
                style={{
                  backgroundColor: "#87CEEB",
                  width: 137,
                  height: "180.19px",
                  marginRight: 27,
                  borderRadius: 10,
                }}
              >
                <a className="brand-link" href="/huawei">
                  <img
                    alt="Huawei logo"
                    className="card-img-top"
                    src={logoHuW}
                  />
                </a>
                <div className="brand-card-body text-center">
                  <a className="brand-card-title brand-link" href="/huawei">
                    Huawei
                  </a>
                  <br />
                  <a className="brand-card-text brand-link" href="/huawei">
                    72 items
                  </a>
                </div>
              </div>
              {/* Xiaomi Card */}
              <div
                className="brand-card"
                style={{
                  backgroundColor: "#D0E0F0",
                  width: 137,
                  height: "180.19px",
                  marginRight: 27,
                  borderRadius: 10,
                }}
              >
                <a className="brand-link" href="/xiaomi">
                  <img
                    alt="Xiaomi logo"
                    className="card-img-top"
                    src={logoXiaomi}
                  />
                </a>
                <div className="brand-card-body text-center">
                  <a className="brand-card-title brand-link" href="/xiaomi">
                    Xiaomi
                  </a>
                  <br />
                  <a className="brand-card-text brand-link" href="/xiaomi">
                    36 items
                  </a>
                </div>
              </div>
              {/* Realme Card */}
              <div
                className="brand-card"
                style={{
                  backgroundColor: "#C7E1FD",
                  width: 137,
                  height: "180.19px",
                  borderRadius: 10,
                }}
              >
                <a className="brand-link" href="/realme">
                  <img
                    alt="Realme logo"
                    className="card-img-top"
                    src={logoReal}
                  />
                </a>
                <div className="brand-card-body text-center">
                  <a className="brand-card-title brand-link" href="/realme">
                    Realme
                  </a>
                  <br />
                  <a className="brand-card-text brand-link" href="/realme">
                    123 items
                  </a>
                </div>
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
