import React, { useEffect, useState } from "react";
import { productApi } from "../apis";
import hotB from "../assets/images/iHome/hot-banner.png";
import "./css/DealHot.css";
const DealHot = () => {
  const [dealHotData, setDealhotData] = useState([]);
  const [hotPhone, setHotPhone] = useState([]);
  const [hotLaptop, setHotLap] = useState([]);
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

  return (
    <div className="container mt-5">
      <div className="row  flex-nowrap">
        <div className="col-md-3">
          <div className="hot-product position-relative">
            <h5 className="text-center">DEAL HOT</h5>
            <img src={hotB} alt="Hot Banner 1 Image" className="img-fluid" />
            <select name="" id="" className="selectCateHP">
              <option value="dien-thoai">Điện thoại</option>
              <option value="laptop">Laptop</option>
            </select>
          </div>
        </div>
        <div className="col-md-9">
          <div className="row">
            {/* {
              .map((_, index) => (
                <div key={index} className="col-md-4 ">
                  <BoxPro />
                </div>
              ))} */}
          </div>
        </div>
      </div>
    </div>
  );
};

export default DealHot;
