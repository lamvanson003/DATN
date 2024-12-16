import React, { useState, useEffect } from "react";
import "./css/Sbanner.css";

const Sbanner = ({ product }) => {
  const [currentIndex, setCurrentIndex] = useState(0);
  const [subBanners, setSubBanners] = useState([]);

  useEffect(() => {
    const fetchSubBanners = async () => {
      try {
        const response = await fetch("http://127.0.0.1:8000/api/sliders?status=active");
        const data = await response.json();
        if (data.success) {
          const allSubBanners = data.slider.slider_items.filter(
            (item) => item.type === "sub_banner"
          );
          setSubBanners(allSubBanners);
        }
      } catch (error) {
        console.error("Error fetching sub banners:", error);
      }
    };

    fetchSubBanners();
  }, []);

  const nextBanner = () => {
    setCurrentIndex((prevIndex) => (prevIndex + 1) % subBanners.length);
  };

  const prevBanner = () => {
    setCurrentIndex(
      (prevIndex) => (prevIndex - 1 + subBanners.length) % subBanners.length
    );
  };

  return (
    <div className="container">
      {product ? (
        subBanners.length > 0 ? (
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
                src={subBanners[currentIndex]?.images}
                alt={`Banner ${currentIndex + 1}`}
                style={{ width: "100%", height: "auto", borderRadius: "8px" }}
              />
            </div>
            <div style={{ width: "48%", borderRadius: "8px" }}>
              <img
                src={subBanners[(currentIndex + 1) % subBanners.length]?.images}
                alt={`Banner ${
                  ((currentIndex + 1) % subBanners.length) + 1
                }`}
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
          <p>Không có sub banner nào.</p>
        )
      ) : (
        <div className="container">
          <div className="sub-banner-embrace">
            <div className="container mb-5">
              <div className="row justify-content-center flex-nowrap">
                {subBanners.slice(0, 2).map((banner, index) => (
                  <div className="col-lg-6" key={index}>
                    <div className="sub-banner">
                      <img
                        src={banner.images}
                        alt={`Sub Banner ${index + 1}`}
                        className="img-fluid"
                      />
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default Sbanner;
