import React, { useEffect, useState } from "react";
import { BoxPro } from ".";
import flashsale from "../assets/images/iHome/flashsale.png";
import "./css/FlashSale.css";
import icons from "../ultis/icon";
import { productApi } from "../apis";
const { IoArrowRedoOutline, IoArrowUndoOutline } = icons;
const FlashSale = () => {
  const [countdown, setCountdown] = useState(() => {
    const savedCountdown = localStorage.getItem("countdown");
    return savedCountdown ? parseInt(savedCountdown, 10) : 3600;
  });
  const [flashSale, setFlashSale] = useState([]);
  const [activeTab, setActiveTab] = useState("current");
  const [currentPage, setCurrentPage] = useState(0);
  const totalPage = Math.ceil(flashSale?.length / 4);
  const curItems = flashSale?.slice(currentPage * 4, (currentPage + 1) * 4);

  const handlePreviousPage = () => {
    setCurrentPage((prevPage) => (prevPage > 0 ? prevPage - 1 : totalPage - 1));
  };
  const handleNextPage = () => {
    setCurrentPage((prevPage) => (prevPage < totalPage - 1 ? prevPage + 1 : 0));
  };
  const formatTime = (seconds) => {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const secs = seconds % 60;
    return (
      <div className="countdown">
        <span className="countdown-part hours">
          {String(hours).padStart(2, "0")}
        </span>
        :
        <span className="countdown-part minutes">
          {String(minutes).padStart(2, "0")}
        </span>
        :
        <span className="countdown-part seconds">
          {String(secs).padStart(2, "0")}
        </span>
      </div>
    );
  };
  const handleChangeTab = (tab) => {
    setActiveTab(tab);
  };
  useEffect(() => {
    const timer = setInterval(() => {
      setCountdown((prev) => {
        const newCountdown = prev > 0 ? prev - 1 : 0;
        if (newCountdown === 0) {
          localStorage.removeItem("countdown");
        } else {
          localStorage.setItem("countdown", newCountdown);
        }
        return newCountdown;
      });
    }, 1000);
    return () => clearInterval(timer);
  }, []);
  useEffect(() => {
    const fetchFlashSale = async () => {
      const res = await productApi.getFlashSale();
      console.log(res);

      setFlashSale(res);
    };
    fetchFlashSale();
  }, []);

  return (
    <div
      className="container d-flex flex-column justify-content-center mt-5 mb-5 "
      style={{
        backgroundColor: "#fff",
        padding: "10px",
        overflow: "hidden",
        borderRadius: "5px 5px 10px 10px",
      }}
    >
      <div className="fs-img">
        <img src={flashsale} alt="" style={{ width: "70%" }} />
      </div>
      <div className="tabs">
        <span
          className={`${activeTab === "current" ? "activeTab" : ""} flashsale`}
          onClick={() => handleChangeTab("current")}
        >
          chỉ còn: {formatTime(countdown)}
        </span>
        <span
          className={`${activeTab === "incoming" ? "activeTab" : ""} flashsale`}
          onClick={() => handleChangeTab("incoming")}
        >
          Sắp diễn ra:
        </span>
      </div>
      <div className="fsPros">
        <span className="arrow-container">
          <IoArrowUndoOutline
            className="arrowfs"
            onClick={handlePreviousPage}
          />
        </span>

        <div className="fsproducts-container">
          {curItems.map((pro, index) => (
            <div key={index}>
              <BoxPro
                id={pro.id}
                name={pro.name}
                category={pro.category}
                brand={pro.brand}
                slug={pro.slug}
                image={pro.images}
                product_image_items={pro.product_image_items}
                flashsale_variant={pro.product_variant}
                flashsale_price={pro.discount_price}
                sold={pro.sold}
                quantity_limit={pro.quantity_limit}
              />
            </div>
          ))}
        </div>

        <span className="arrow-container">
          <IoArrowRedoOutline className="arrowfs" onClick={handleNextPage} />
        </span>
      </div>
    </div>
  );
};

export default FlashSale;
