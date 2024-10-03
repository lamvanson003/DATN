import React from "react";
import banner4 from "../assets/images/iHome/Banner4.png";
const Countdown = () => {
  return (
    <div className="mt-5 d-flex justify-content-center">
      <div className="second-banner-slide">
        <div className="second-banner-content">
          <img
            src={banner4}
            alt="Second Banner Image 1"
            className="img-fluid active"
          />
          <button type="button" className="btn btn-primary">
            Mua Ngay
          </button>
          <div id="countdown" className="countdown-timer">
            <div className="time-box">
              <span id="days" className="time-value" />
              <span className="time-label">Ngày</span>
            </div>
            <div className="time-box">
              <span id="hours" className="time-value" />
              <span className="time-label">Giờ</span>
            </div>
            <div className="time-box">
              <span id="minutes" className="time-value" />
              <span className="time-label">Phút</span>
            </div>
            <div className="time-box">
              <span id="seconds" className="time-value" />
              <span className="time-label">Giây</span>
            </div>
          </div>
        </div>
        <div className="nav-icons"></div>
      </div>
    </div>
  );
};

export default Countdown;
