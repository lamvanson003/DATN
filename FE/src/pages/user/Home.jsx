import React, { useState, useRef, useEffect, useContext } from "react";

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
  DealHot,
} from "../../components";
import "./css/Home.css";
import { useSelector } from "react-redux";
import { Brand } from "../../components";
import { CartContext } from "../../context/Cart";
import { toast } from "react-toastify";
const Home = () => {
  const url = new URL(window.location.href);
  const status = url.searchParams.get("status");
  const { cartItems, setCartItems } = useContext(CartContext);
  const { productsData } = useSelector((state) => state.pro);
  const [phonesData, setPhonesData] = useState([]);
  const [laptopsData, setLaptopsData] = useState([]);
  const [flashSale, setFlashSale] = useState([]);
  const [isSendingSuccess, setIsSendingSuccess] = useState(false);
  useEffect(() => {
    const loginSuccess = localStorage.getItem("loginSuccess");
    if (loginSuccess === "true") {
      toast.success("Đăng nhập thành công");
      localStorage.removeItem("loginSuccess"); // Clear the flag
    }
  }, []);
  useEffect(() => {
    if (productsData) {
      setPhonesData(productsData.phone);
      setLaptopsData(productsData.laptop);
    }
  }, [productsData]);

  useEffect(() => {
    if (status === "success") {
      const PendingLeftCartItems = localStorage.getItem("PendingLeftCartItems");
      console.log(PendingLeftCartItems);

      if (PendingLeftCartItems) {
        try {
          const parsedItems = JSON.parse(PendingLeftCartItems);
          if (Array.isArray(parsedItems)) {
            setCartItems(parsedItems);
            localStorage.setItem("cartItems", PendingLeftCartItems);
          } else {
            console.error("Parsed items are not an array:", parsedItems);
          }
        } catch (error) {
          console.error("Error parsing PendingLeftCartItems:", error);
        }
      }

      setIsSendingSuccess(true);
    }
  }, [status, setCartItems]);

  return (
    <>
      {isSendingSuccess && <Popup />}
      <Banner />

      <Sbanner />

      <FlashSale />

      <div className="container mt-5">
        <div className="row bg-box">
          <div className="d-flex title-p align-items-center">
            <span>Điện thoại</span>
            <a href="">Xem tất cả</a>
          </div>
          <div className="row justify-content-start align-items-center pt-3 pb-3">
            {phonesData &&
              phonesData
                .filter((value, index) => index < 16)
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
            {laptopsData &&
              laptopsData
                .filter((value, index) => index < 16)
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

      <DealHot />

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
