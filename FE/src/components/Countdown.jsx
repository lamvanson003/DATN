import React, { useEffect, useState } from "react";
import banner4 from "../assets/images/iHome/Banner4.png";
const Countdown = () => {
  const [timeLeft, setTimeLeft] = useState({
    days: 0,
    hours: 0,
    minutes: 0,
    seconds: 0,
  });
  const calculateTimeLeft = () => {
    const targetDate = new Date("2024-12-31T23:59:59");
    const now = new Date();
    const difference = targetDate - now;
    if (difference > 0) {
      const timeLeft = {
        days: Math.floor(difference / (1000 * 60 * 60 * 24)),
        hours: Math.floor((difference / (1000 * 60 * 60)) % 24),
        minutes: Math.floor((difference / 1000 / 60) % 60),
        seconds: Math.floor((difference / 1000) % 60),
      };
      return timeLeft;
    } else {
      // Nếu countdown kết thúc
      return { days: 0, hours: 0, minutes: 0, seconds: 0 };
    }
  };
  useEffect(() => {
    const timer = setInterval(() => {
      setTimeLeft(calculateTimeLeft());
    }, 1000);
    return () => clearInterval(timer);
  }, []);
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
              <span id="days" className="time-value">
                {timeLeft.days}
              </span>
              <span className="time-label">Ngày</span>
            </div>
            <div className="time-box">
              <span id="hours" className="time-value">
                {timeLeft.hours}
              </span>
              <span className="time-label">Giờ</span>
            </div>
            <div className="time-box">
              <span id="minutes" className="time-value">
                {timeLeft.minutes}
              </span>
              <span className="time-label">Phút</span>
            </div>
            <div className="time-box">
              <span id="seconds" className="time-value">
                {timeLeft.seconds}
              </span>
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
