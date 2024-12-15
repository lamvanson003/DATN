import React, { useEffect, useState } from "react";
import { productApi } from "../apis";
import hotB from "../assets/images/iHome/hot-banner.png";
import "./css/DealHot.css";
import { BoxPro } from ".";
const DealHot = () => {
  const [dealHotData, setDealhotData] = useState([]);
  const [hotPhone, setHotPhone] = useState([]);
  const [hotLaptop, setHotLap] = useState([]);
  const [activeHot, setActiveHot] = useState([]);
  const [selectedCategory, setSelectedCategory] = useState("dien_thoai");
  const handleCategoryChange = (e) => {
    setSelectedCategory(e.target.value);
  };
  useEffect(() => {
    const fetchHP = async () => {
      const res = await productApi.getDealHot("dien-thoai");
      console.log("HP:", res);

      setHotPhone(res);
    };
    fetchHP();
    const fetchLT = async () => {
      const res = await productApi.getDealHot("laptop");
      console.log("HL:", res);

      setHotLap(res);
    };
    fetchLT();
  }, []);
  useEffect(() => {
    if (selectedCategory === "dien-thoai") {
      setActiveHot(hotPhone);
    } else {
      setActiveHot(hotLaptop);
    }
  }, [hotPhone, hotLaptop, selectedCategory]);
  return (
    <div className="container mt-5">
      <div className="row  flex-nowrap">
        <div className="col-md-3">
          <div className="hot-product position-relative">
            <h5 className="text-center">DEAL HOT</h5>
            <img src={hotB} alt="Hot Banner 1 Image" className="img-fluid" />
            <select
              name=""
              id=""
              className="selectCateHP"
              onChange={handleCategoryChange}
              value={selectedCategory}
            >
              <option value="dien-thoai">Điện thoại</option>
              <option value="laptop">Laptop</option>
            </select>
          </div>
        </div>
        <div className="col-md-9">
          <div className="row">
            {activeHot?.map((pro, index) => (
              <div key={index} className="col-md-4">
                <BoxPro
                  id={pro.id}
                  name={pro.name}
                  category={pro.category}
                  brand={pro.brand}
                  slug={pro.slug}
                  image={pro.images}
                  product_image_items={pro.product_image_items}
                />
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
};

export default DealHot;
