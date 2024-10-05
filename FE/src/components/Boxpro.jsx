import React, { useEffect, useState, useContext } from "react";
import "./css/Boxpro.css";
import { Link, useParams } from "react-router-dom";
import proImg from "../assets/images/iHome/image.png";
import { CartContext } from "../context/Cart";
import { memo } from "react";
import { FavorContext } from "../context/Favor";
const BoxPro = ({ pro }) => {
  const { cartItems, addToCart } = useContext(CartContext);
  const { favorItems, addToFavor } = useContext(FavorContext);
  const inCartItem = cartItems.find((cartItem) => cartItem.id === pro?.id);
  const cartItemQuantity = inCartItem && inCartItem.quantity;
  const inFavorItems = favorItems.find((favorItem) => favorItem.id === pro?.id);

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

        <p className="price text-center">
          <span className="me-2">{pro?.sale ? pro?.sale : "Not found"}</span>
          <span className="old-price">
            {pro?.price ? pro?.price : "Not found"}
          </span>
        </p>
        <p className="card-text">
          Hãng
          <span
            style={{
              color: "#007bff",
              marginLeft: 20,
            }}
          >
            {pro?.brand ? pro?.brand : "Not found"}
          </span>
        </p>
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
        <button className="btn btn-buy mt-3">Mua ngay</button>
      </div>
    </div>
  );
};

export default memo(BoxPro);
