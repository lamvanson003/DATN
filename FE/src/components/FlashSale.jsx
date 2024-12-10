import React, { useEffect, useState } from "react";
import { BoxPro, Tab } from ".";
import flashsale from "../assets/images/iHome/flashsale.png";
import "./css/FlashSale.css";
import icons from "../ultis/icon";
import { productApi } from "../apis";
import { transformFormatProducts } from "../ultis/func";
const { IoArrowRedoOutline, IoArrowUndoOutline } = icons;
const FlashSale = () => {
  const [currentFs, setCurrentFs] = useState([]);
  const [comingFs, setComingFs] = useState([]);
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
  const handleChangeTab = (tab) => {
    setActiveTab(tab);
  };

  useEffect(() => {
    const fetchAllFs = async () => {
      const CFS = await productApi.getCurrentFs();
      const UFS = await productApi.getComingFs();
      setCurrentFs(CFS.map(transformFormatProducts));
      setComingFs(UFS.map(transformFormatProducts));
    };
    fetchAllFs();
  }, []);
  useEffect(() => {
    if (activeTab === "current") {
      console.log("current");
      setFlashSale(currentFs);
    } else {
      console.log("coming");
      setFlashSale(comingFs);
    }
  }, [activeTab, currentFs, comingFs]);
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
          Đang diễn ra
        </span>
        <span
          className={`${activeTab === "incoming" ? "activeTab" : ""} flashsale`}
          onClick={() => handleChangeTab("incoming")}
        >
          Sắp diễn ra
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
                variant={pro.product_variant}
                flashSale
                whenFs={pro.when}
                startFs={pro.start_time}
                endFs={pro.end_time}
                sold={pro.sold}
                quantity_limit={pro.quantity_limit}
                tab={activeTab}
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
