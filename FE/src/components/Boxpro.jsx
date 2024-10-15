import React, { useEffect, useState, useContext } from "react";
import "./css/Boxpro.css";
import { Link, useParams } from "react-router-dom";
import proImg from "../assets/images/iHome/image.png";
import { CartContext } from "../context/Cart";
import { memo } from "react";
import { FavorContext } from "../context/Favor";
import icons from "../ultis/icon";
const BoxPro = ({ pro, watched }) => {
  const { IoIosStar, IoIosStarHalf, IoIosStarOutline } = icons;
  const { cartItems, addToCart, buyNow } = useContext(CartContext);
  const { favorItems, addToFavor } = useContext(FavorContext);
  const inCartItem = cartItems.find((cartItem) => cartItem.id === pro?.id);
  const cartItemQuantity = inCartItem && inCartItem.quantity;
  const inFavorItems = favorItems.find((favorItem) => favorItem.id === pro?.id);

  const renderStars = (rating) => {
    const maxStars = 5;
    const fullStars = Math.floor(rating); // Số sao đầy (phần nguyên của rating)
    const hasHalfStar = rating % 1 !== 0; // Kiểm tra nếu có sao nửa
    const emptyStars = maxStars - fullStars - (hasHalfStar ? 1 : 0); // Số sao trống

    return (
      <span className="text-warning">
        {Array(fullStars).fill(<IoIosStar />)} {/* Sao đầy */}
        {hasHalfStar && <IoIosStarHalf />} {/* Sao nửa nếu có */}
        {Array(emptyStars).fill(<IoIosStarOutline />)} {/* Sao trống */}
      </span>
    );
  };
  return (
    <div className="card">
      <div className="badge-hot">Hot</div>
      <div className="badge-discount">-16%</div>
      <div className="img-container">
        <Link to={`/detail/${pro?.id}`}>
          <img
            alt="Image of iPhone 14 Pro Max 128GB"
            className="card-img-top "
            style={{ cursor: "pointer" }}
            src={proImg}
          />
        </Link>
      </div>
      <div className="card-body">
        <p className="card-text">Điện thoại</p>
        <Link to={`/detail/${pro?.id}`} style={{ textDecoration: "none" }}>
          <h5 className="card-title text-center" style={{ cursor: "pointer" }}>
            {pro?.name ? pro?.name : "Not found"}
          </h5>
        </Link>

        <div>
          <p className="price text-center">
            <span className="me-2">{pro?.sale ? pro?.sale : "Not found"}</span>
            <span className="old-price">
              {pro?.price ? pro?.price : "Not found"}
            </span>
          </p>
          <div
            className="card-text d-flex justify-content-between"
            style={{ fontSize: 14 }}
          >
            <span>
              hãng:
              <span
                style={{
                  color: "#007bff",
                  marginLeft: 5,
                }}
              >
                {pro?.brand ? pro?.brand : "Not found"}
              </span>
            </span>

            {renderStars(3)}
          </div>
          <div className="d-flex justify-content-between align-items-center">
            <button
              className="icon-btn"
              onClick={() => {
                addToCart(pro);
              }}
            >
              <i className="fas fa-shopping-cart fw-semibold" />
              <span className="fw-bold text-danger ms-1">
                {cartItemQuantity ? `(${cartItemQuantity})` : ""}
              </span>
            </button>
            <button className="icon-btn">
              <i className="fas fa-exchange-alt" />
            </button>
            <button
              className="icon-btn"
              onClick={() => {
                addToFavor(pro);
              }}
            >
              <i className={`fas fa-heart ${inFavorItems && "text-danger"}`} />
            </button>
          </div>
          <button
            className="btn btn-buy mt-3"
            onClick={() => {
              buyNow(pro);
            }}
          >
            Mua ngay
          </button>
        </div>
      </div>
    </div>
  );
};

export default memo(BoxPro);
