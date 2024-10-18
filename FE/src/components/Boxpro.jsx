import React, { useEffect, useState, useContext } from "react";
import "./css/Boxpro.css";
import { Link, useParams } from "react-router-dom";
import proImg from "../assets/images/iHome/image.png";
import { CartContext } from "../context/Cart";
import { memo } from "react";
import { FavorContext } from "../context/Favor";
import { formatCurrency } from "../ultis/func";
import icons from "../ultis/icon";
const BoxPro = ({
  pid,
  name,
  image,
  rating,
  slug,
  brand,
  totalrate,
  watched,
  variant,
  hot,
}) => {
  const { IoIosStar, IoIosStarHalf, IoIosStarOutline, FaFire } = icons;
  const [currentVariant, setCurrentVariant] = useState(variant?.[0]);
  const handleChangeVariant = (selectedSku) => {
    const selectedVariant = variant.find((v) => v.sku === selectedSku);
    if (selectedVariant) {
      setCurrentVariant(selectedVariant);
    }
  };
  const { cartItems, addToCart, buyNow } = useContext(CartContext);
  const { favorItems, addToFavor } = useContext(FavorContext);
  const inCartItem = cartItems.find(
    (cartItem) => cartItem.id === currentVariant?.id
  );
  const cartItemQuantity = inCartItem && inCartItem.quantity;
  const inFavorItems = favorItems.find(
    (favorItem) => favorItem.id === currentVariant?.id
  );
  const main = { name, image };
  const testname = "Laptop ASUS TUF Gaming A14 FA401WV-RG061WS 12312412412";
  return (
    <div className="card">
      <div className="badge-hot text-danger">
        <FaFire />
      </div>
      <div className="badge-discount">-16%</div>
      <div className="badge-rating">
        {currentVariant?.average_rating
          ? currentVariant?.average_rating
          : "2.3"}

        <IoIosStar />
      </div>
      <div className="img-container">
        <Link to={`/detail/${slug ? slug : ""}`}>
          <img
            alt="Image of iPhone 14 Pro Max 128GB"
            className="card-img-top "
            style={{ cursor: "pointer" }}
            src={currentVariant?.image ? currentVariant?.image : image}
          />
        </Link>
      </div>
      <div className="card-body ">
        <Link
          to={`/detail/${slug ? slug : ""}`}
          style={{ textDecoration: "none" }}
        >
          <span
            style={{
              height: 50,
              width: "100%",
              display: "inline-block",
              overflow: "hidden", // Ẩn phần nội dung vượt quá kích thước
            }}
          >
            <h5 className="card-title" style={{ cursor: "pointer" }}>
              {name
                ? name.length > 40
                  ? name.slice(0, 40) + "..."
                  : name
                : testname.length > 40
                ? testname.slice(0, 40) + "..."
                : testname}
            </h5>
          </span>
        </Link>

        <div>
          <p className="price text-center my-1">
            <span className="me-2">
              {currentVariant?.sale
                ? formatCurrency(currentVariant?.sale)
                : "Not found"}
            </span>
            <span className="old-price">
              {currentVariant?.price
                ? formatCurrency(currentVariant?.price)
                : "Not found"}
            </span>
          </p>

          <div className="storage-variant">
            {variant?.map((v) => (
              <span
                key={v.sku}
                onClick={() => handleChangeVariant(v.sku)}
                className={`storage-option ${
                  currentVariant?.sku === v.sku ? "storage-selected" : ""
                }`}
              >
                {v?.storage}
              </span>
            ))}
          </div>
          {!hot && (
            <div className="d-flex justify-content-between align-items-center my-2">
              <button
                className="icon-btn"
                onClick={() => {
                  addToCart(main, currentVariant);
                }}
              >
                <i className="fas fa-shopping-cart fw-semibold" />
                <span className="fw-bold text-primary ms-1">
                  {cartItemQuantity ? `(${cartItemQuantity})` : ""}
                </span>
              </button>
              <button className="icon-btn">
                <i className="fas fa-exchange-alt" />
              </button>
              <button
                className="icon-btn"
                onClick={() => {
                  addToFavor(main, currentVariant);
                }}
              >
                <i
                  className={`fas fa-heart ${inFavorItems && "text-danger"} `}
                />
              </button>
            </div>
          )}

          {!hot && (
            <button
              className="btn btn-buy mt-1"
              onClick={() => {
                buyNow(main, currentVariant);
              }}
            >
              Mua ngay
            </button>
          )}
        </div>
      </div>
    </div>
  );
};

export default memo(BoxPro);
