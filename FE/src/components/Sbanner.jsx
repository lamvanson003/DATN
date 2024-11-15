import React, { useState } from "react";
import sbanner1 from "../assets/images/iHome/image sub banner-1.png";
import sbanner2 from "../assets/images/iHome/image sub banner-2.png";
import sbanner3 from "../assets/images/iHome/image sub banner-3.png";
import tgddbn1 from "../assets/images/iHome/tgddbanner1.jpg";
import tgddbn2 from "../assets/images/iHome/tgddbanner2.jpg";
import tgddbn3 from "../assets/images/iHome/tgddbanner3.jpg";
import tgddbn4 from "../assets/images/iHome/tgddbanner4.jpg";
import tgddbn5 from "../assets/images/iHome/tgddbanner5.jpg";
import "./css/Sbanner.css";
const Sbanner = ({ product }) => {
  const [currentIndex, setCurrentIndex] = useState(0);
  const banners = [tgddbn1, tgddbn2, tgddbn3, tgddbn4, tgddbn5];
  const nextBanner = () => {
    setCurrentIndex((prevIndex) => (prevIndex + 1) % banners.length);
  };

  const prevBanner = () => {
    setCurrentIndex(
      (prevIndex) => (prevIndex - 1 + banners.length) % banners.length
    );
  };
  return (
    <div className="container">
      {product ? (
        <div
          style={{
            position: "relative",
            margin: "auto",
            display: "flex",
            justifyContent: "space-between",
            padding: "4px",
          }}
        >
          <div style={{ width: "48%", borderRadius: "8px" }}>
            <img
              src={banners[currentIndex]}
              alt={`Banner ${currentIndex + 1}`}
              style={{ width: "100%", height: "auto", borderRadius: "8px" }}
            />
          </div>

          <div style={{ width: "48%", borderRadius: "8px" }}>
            <img
              src={banners[(currentIndex + 1) % banners.length]}
              alt={`Banner ${((currentIndex + 1) % banners.length) + 1}`}
              style={{ width: "100%", height: "auto", borderRadius: "8px" }}
            />
          </div>

          <button
            onClick={prevBanner}
            style={{
              position: "absolute",
              top: "50%",
              left: "10px",
              transform: "translateY(-50%)",
              background: "rgba(0, 0, 0, 0.5)",
              color: "white",
              border: "none",
              borderRadius: "50%",
              padding: "10px",
              cursor: "pointer",
            }}
          >
            &#8592;
          </button>
          <button
            onClick={nextBanner}
            style={{
              position: "absolute",
              top: "50%",
              right: "10px",
              transform: "translateY(-50%)",
              background: "rgba(0, 0, 0, 0.5)",
              color: "white",
              border: "none",
              borderRadius: "50%",
              padding: "10px",
              cursor: "pointer",
            }}
          >
            &#8594;
          </button>
        </div>
      ) : (
        <div className="container">
          <div className="sub-banner-embrace">
          <div className="container mb-5">
            <div className="row justify-content-center flex-nowrap">
              <div className="col-lg-6">
                <div className="sub-banner">
                  <img
                    src={sbanner1}
                    alt="Banner 1 Image"
                    className="img-fluid"
                  />
                  <h5 className="text-center">Sub Banner 1</h5>
                </div>
              </div>
              <div className="col-lg-6">
                <div className="sub-banner">
                  <img
                    src={sbanner2}
                    alt="Banner 2 Image"
                    className="img-fluid"
                  />
                  <h5 className="text-center">Sub Banner 2</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      )}
    </div>
  );
};

export default Sbanner;
