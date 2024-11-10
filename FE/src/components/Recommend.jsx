import React, { useEffect, useRef, useState } from "react";
import product from "../assets/images/iHome/image.png";
import axios from "axios";
import icons from "../ultis/icon";
import "./css/Recommend.css";
const {
  TbArrowBigLeftLineFilled,
  TbArrowBigRightLineFilled,
  FaQuoteRight,
  FaQuoteLeft,
} = icons;

const Recommend = () => {
  const [curIndex, setCurIndex] = useState(0);
  const [rePro, setRePro] = useState([]);
  const [isScroll, setIsScrolling] = useState(false);
  const pronameRef = useRef();
  useEffect(() => {
    const fetchRePro = async () => {
      try {
        const res = await axios.get("/recommend.json");
        setRePro(res.data);
      } catch (err) {
        console.log("có lỗi xảy ra: ", err);
      }
    };
    fetchRePro();
  }, []);
  useEffect(() => {
    if (pronameRef.current) {
      const pronameWidth = pronameRef.current.offsetWidth;
      const wrapperWidth = pronameRef.current.parentNode.offsetWidth;
      setIsScrolling(pronameWidth > wrapperWidth);
    }
  }, [rePro, curIndex]);
  const handleNext = () => {
    setCurIndex((prevIndex) => (prevIndex + 1) % rePro.length);
  };

  const handlePrev = () => {
    setCurIndex((prevIndex) => (prevIndex - 1 + rePro.length) % rePro.length);
  };

  const goToSlide = (index) => {
    setCurIndex(index);
  };

  return (
    <div className="container mt-5">
      <span className="d-flex flex-column">
        <span>ĐỀ XUẤT BỞI KHÁCH HÀNG</span>
        {rePro.length > 0 && (
          <span className="d-flex flex-column align-items-center">
            <span className="d-flex justify-content-center gap-2 align-items-center">
              <span className="recommend-arrow" onClick={handlePrev}>
                <TbArrowBigLeftLineFilled />
              </span>
              <span className="recommend-pro">
                <span className="recommend-left">
                  <img src={product} className="recommend-img" alt="" />
                  <span className="recommend-price">
                    <span className="recommend-dis">
                      {rePro[curIndex]?.discount}%
                    </span>
                    <span className="d-flex flex-column align-items-end">
                      <span
                        style={{
                          fontSize: 12,
                          textDecoration: "line-through",
                        }}
                      >
                        {rePro[curIndex]?.originalPrice}đ
                      </span>
                      <span style={{ fontSize: 18 }}>
                        {rePro[curIndex]?.discountedPrice}đ
                      </span>
                    </span>
                  </span>
                  <div className="recommend-proname-wrapper">
                    <span
                      className={`recommend-proname ${
                        isScroll ? "scroll" : ""
                      }`}
                      ref={pronameRef}
                    >
                      {rePro[curIndex]?.name}
                    </span>
                  </div>
                </span>
                <span className="recommend-right">
                  <span className="recomend-review">
                    <span>
                      <FaQuoteLeft className="quote" />
                    </span>
                    {rePro[curIndex]?.review?.comment}
                    <span>
                      <FaQuoteRight className="quote" />
                    </span>
                  </span>
                  <span
                    className="d-flex align-items-center gap-3"
                    style={{ borderTop: "1px solid #fff", paddingTop: 6 }}
                  >
                    <span
                      style={{
                        backgroundColor: "blue",
                        borderRadius: "50%",
                      }}
                    >
                      <img
                        src={product}
                        style={{
                          width: 50,
                          objectFit: "contain",
                        }}
                        alt=""
                      />
                    </span>
                    <span className="recommend-info">
                      <span className="d-flex align-items-center justify-content-between">
                        <span style={{ fontWeight: 600 }}>
                          {rePro[curIndex]?.review?.name}
                        </span>
                        <span style={{ fontSize: 12 }}>
                          {rePro[curIndex]?.review?.date}
                        </span>
                      </span>
                      <span style={{ fontSize: 12 }}>
                        {rePro[curIndex]?.review?.rating}
                      </span>
                      <span style={{ fontSize: 12 }}>
                        31 người thấy bình luận này hữu ích
                      </span>
                    </span>
                  </span>
                </span>
              </span>
              <span className="recommend-arrow" onClick={handleNext}>
                <TbArrowBigRightLineFilled />
              </span>
            </span>
            <span className="navigate-dot d-flex gap-2">
              {rePro.map((_, index) => (
                <span
                  key={index}
                  className={`dot ${index === curIndex ? "active" : ""}`}
                  onClick={() => goToSlide(index)}
                ></span>
              ))}
            </span>
          </span>
        )}
      </span>
    </div>
  );
};

export default Recommend;
