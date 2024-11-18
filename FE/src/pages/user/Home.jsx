import React, { useState, useRef, useEffect } from "react";
import hotB from "../../assets/images/iHome/hot-banner.png";
import recommend from "../../assets/images/iHome/recommend.png";
import {
  BoxPro,
  Banner,
  Sbanner,
  Countdown,
  Commercial,
  News,
  FlashSale,
  Recommend,
  Popup,
} from "../../components";
import "./css/Home.css";
import { useSelector } from "react-redux";
import { Brand } from "../../components";
import { orderApi, productApi } from "../../apis";
const Home = () => {
  const url = new URL(window.location.href);
  const responseCode = url.searchParams.get("vnp_ResponseCode");
  const { productsData } = useSelector((state) => state.pro);
  const [phonesData, setPhonesData] = useState([]);
  const [laptopsData, setLaptopsData] = useState([]);
  const [flashSale, setFlashSale] = useState([]);
  const [isSendingSuccess, setIsSendingSuccess] = useState(false);
  useEffect(() => {
    if (productsData) {
      setPhonesData(productsData.phone);
      setLaptopsData(productsData.laptop);
    }
  }, [productsData]);

  useEffect(() => {
    if (responseCode === "00") {
      // const fetchCreateOrder = async () => {
      //    const res = await orderApi.create(orderInfo);
      //    const invoice = await orderApi.getOne(res);
      //    console.log("Invoice: ", invoice);

      //    setOrderId(res);
      //    const LeftItems = cartItems.filter(
      //      (item) => item.color.id !== res.product_variant_id
      //    );
      //    setCartItems(LeftItems);
      //    localStorage.setItem("cartItems", JSON.stringify(LeftItems));
      // }
      setIsSendingSuccess(true);
    }
  }, []);

  return (
    <>
      {isSendingSuccess && <Popup orderId={11} />}
      <Banner />

      <Sbanner />

      <Brand />

      <FlashSale />

      <div className="container mt-5">
        <div className="row bg-box">
          <div className="d-flex title-p align-items-center">
            <span>Điện thoại</span>
            <a href="">Xem tất cả</a>
          </div>
          <div className="row justify-content-start align-items-center pt-3 pb-3">
            {phonesData
              .filter((value, index) => index < 8)
              .map((pro, index) => (
                <div key={index} className="col-md-3">
                  <BoxPro
                    id={pro.id}
                    name={pro.name}
                    category={pro.category}
                    brand={pro.brand}
                    slug={pro.slug}
                    image={pro.images}
                    product_image_items={pro.product_image_items}
                    variant={pro.product_variant}
                  />
                </div>
              ))}
          </div>
        </div>
      </div>

      <Countdown />

      <div className="container mt-5">
        <div className="row justify-content-start bg-box">
          <div className="d-flex title-p align-items-center">
            <span>Laptop</span>
            <a href="">Xem tất cả</a>
          </div>
          <div className="row justify-content-start align-items-center pt-3 pb-3">
            {laptopsData
              .filter((value, index) => index < 8)
              .map((pro, index) => (
                <div key={index} className="col-md-3">
                  <BoxPro
                    id={pro.id}
                    name={pro.name}
                    category={pro.category}
                    brand={pro.brand}
                    slug={pro.slug}
                    image={pro.images}
                    product_image_items={pro.product_image_items}
                    variant={pro.product_variant}
                  />
                </div>
              ))}
          </div>
        </div>
      </div>

      <div className="container mt-5">
        <div className="row  flex-nowrap">
          <div className="col-md-3">
            <div className="hot-product position-relative">
              <h5 className="text-center">DEAL HOT</h5>
              <img src={hotB} alt="Hot Banner 1 Image" className="img-fluid" />
            </div>
          </div>
          <div className="col-md-9">
            <div className="row">
              {Array(3)
                .fill(0)
                .map((_, index) => (
                  <div key={index} className="col-md-4 ">
                    <BoxPro />
                  </div>
                ))}
            </div>
          </div>
        </div>
      </div>

      <div className="container mt-5">
        <div className="row  d-flex">
          <div className="special-container">
            <Recommend />
          </div>

          <div className="special-product position-relative">
            <img
              src={recommend}
              alt="Hot Banner 1 Image"
              className="img-fluid"
            />
          </div>
        </div>
      </div>

      <Commercial />

      <News />
    </>
  );
};

export default Home;
