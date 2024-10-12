import React, { useRef, useEffect } from "react";
import banner1 from "../assets/images/iHome/banner-1.png";
import banner2 from "../assets/images/iHome/banner-2.png";
import banner3 from "../assets/images/iHome/banner-3.png";
import { setupSlider } from "../ultis/func";

const Banner = () => {
  const slidesRef = useRef([]); // Để tham chiếu tới các slide
  const formRef = useRef(null);
  const prevRef = useRef(null);
  const nextRef = useRef(null);

  useEffect(() => {
    // Gọi hàm setupSlider từ func.js và truyền tham chiếu (refs) cho nó
    const cleanup = setupSlider(slidesRef, formRef, prevRef, nextRef);

    // Cleanup khi component bị unmount
    return () => cleanup();
  }, []);

  return (
    <div className="d-flex justify-content-center mt-5">
      <div className="banner-slide m-0">
        <div className="banner-content">
          <img
            ref={(el) => (slidesRef.current[0] = el)}
            src={banner1}
            alt="Banner Image 1"
            className="img-fluid active"
          />
          <form ref={formRef} className="email-form">
            <input type="email" placeholder="Nhập email của bạn" required />
            <button type="submit">Đăng ký</button>
          </form>
        </div>
        <img
          ref={(el) => (slidesRef.current[1] = el)}
          src={banner2}
          alt="Banner Image 2"
          className="img-fluid"
        />
        <img
          ref={(el) => (slidesRef.current[2] = el)}
          src={banner3}
          alt="Banner Image 3"
          className="img-fluid"
        />
        <div className="nav-icons">
          <i
            className="fas fa-chevron-left"
            aria-hidden="true"
            ref={prevRef}
            id="prev"
          />
          <i
            className="fas fa-chevron-right"
            aria-hidden="true"
            ref={nextRef}
            id="next"
          />
        </div>
      </div>
    </div>
  );
};

export default Banner;
