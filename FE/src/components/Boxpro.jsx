import React, { useEffect, useState, useContext } from "react";
import "./css/Boxpro.css";
import { Link, useParams } from "react-router-dom";
import pro from "../assets/images/iHome/image.png";
import { CartContext } from "../context/Cart";
const BoxPro = ({ id, name, price, sale, img, desc, brand }) => {
  const { cartItem, addToCart } = useContext(CartContext);
  return (
    <div className="card">
      <div className="badge-hot">Hot</div>
      <div className="badge-discount">-16%</div>
      <div className="img-container">
        <Link>
          <img
            alt="Image of iPhone 14 Pro Max 128GB"
            className="card-img-top "
            style={{ cursor: "pointer" }}
            src={pro}
          />
        </Link>
      </div>
      <div className="card-body">
        <p className="card-text">Điện thoại</p>
        <Link to={`/detail/${id}`}>
          <h5 className="card-title text-center" style={{ cursor: "pointer" }}>
            {name ? name : "Not found"}
          </h5>
        </Link>

        <p className="price text-center">
          {sale ? sale : "Not found"}{" "}
          <span className="old-price">{price ? price : "Not found"}</span>
        </p>
        <p className="card-text">
          Hãng
          <span
            style={{
              color: "#007bff",
              marginLeft: 20,
            }}
          >
            {brand ? brand : "Not found"}
          </span>
        </p>
        <div className="d-flex justify-content-between">
          <button className="icon-btn" onClick={() => addToCart(id)}>
            <i className="fas fa-shopping-cart" />
          </button>
          <button className="icon-btn">
            <i className="fas fa-exchange-alt" />
          </button>
          <button className="icon-btn">
            <i className="fas fa-heart" />
          </button>
        </div>
        <button className="btn btn-buy mt-3">Mua ngay</button>
      </div>
    </div>
  );
};

export default BoxPro;
