import React, { useEffect, useState, useContext } from "react";
import "./css/Boxpro.css";
import { Link, useParams } from "react-router-dom";
import proImg from "../assets/images/iHome/image.png";
import fire from "../assets/images/iHome/fire.png";
import { CartContext } from "../context/Cart";
import { memo } from "react";
import { FavorContext } from "../context/Favor";
import { formatCurrency, handleNumber } from "../ultis/func";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faCogs, faFire } from "@fortawesome/free-solid-svg-icons";
import icons from "../ultis/icon";
const BoxPro = ({
  id,
  name,
  image,
  slug,
  brand,
  category,
  product_image_items,
  horizon,
  variant,
  hot,
  hoverCart,
  hoverCartItem,
  flashsale,
}) => {
  const { IoIosStar, IoIosStarHalf, IoIosStarOutline, FaFire } = icons;
  const [currentVariant, setCurrentVariant] = useState();
  const [activeStorage, setActiveStorage] = useState(null);
  const [activeColor, setActiveColor] = useState(null);
  useEffect(() => {
    if (variant && variant.length > 0) {
      const firstStorage = variant[0];
      const firstVariant = firstStorage?.variants[0];
      setActiveStorage(firstStorage || null);
      if (firstStorage.variants.length > 0) {
        setActiveColor(firstStorage.variants[0]);
      } else {
        setActiveColor(null);
      }
      setCurrentVariant({
        storage: firstStorage?.storage,
        color: firstVariant,
      });
    }
  }, [variant]);
  const handleAddToCart = () => {
    if (currentVariant && currentVariant?.color?.instock !== undefined) {
      addToCart(main, currentVariant, 1, currentVariant?.color?.instock);
    }
  };
  const handleChangeVariant = (selectedStorage) => {
    const selectedStorageObj = variant.find(
      (v) => v.storage === selectedStorage
    );
    if (selectedStorageObj && selectedStorageObj.variants.length > 0) {
      const firstVariant = selectedStorageObj.variants[0];
      setCurrentVariant({
        storage: selectedStorageObj.storage,
        color: firstVariant,
      });
      console.log({
        storage: selectedStorageObj.storage,
        color: firstVariant,
      });
    } else {
      setCurrentVariant(null);
    }
  };

  const { cartItems, addToCart, buyNow } = useContext(CartContext);
  const { favorItems, addToFavor } = useContext(FavorContext);
  const inCartItem = cartItems.find(
    (cartItem) => cartItem.color.sku === currentVariant?.color.sku
  );
  const cartItemQuantity = inCartItem && inCartItem.quantity;
  const inFavorItems = favorItems.find(
    (favorItem) =>
      favorItem.product_variant[0]?.variants[0]?.sku ===
      currentVariant?.color?.sku
  );

  const product_variant = variant;
  const main = {
    id,
    name,
    image,
    brand,
    category,
    slug,
    product_image_items,
    product_variant,
  };

  const testname = "Laptop ASUS TUF Gaming A14 FA401WV-RG061WS 12312412412";
  return (
    <div>
      {flashsale ? (
        <div
          className="card product-card"
          style={{
            width: "18rem",
            borderRadius: "10px",
            boxShadow: "0 4px 8px rgba(0, 0, 0, 0.1)",
          }}
        >
          <div
            className="position-absolute top-0 start-0 m-2 badge bg-danger text-white"
            style={{ borderRadius: "5px", fontSize: "12px" }}
          >
            <FontAwesomeIcon icon={faCogs} className="me-1" /> Siêu sale
          </div>
          <div
            className="position-absolute top-0 end-0 m-2 badge  "
            style={{ borderRadius: "5px", fontSize: "12px" }}
          >
            <span
              className="badge bg-warning text-dark"
              style={{ fontSize: "0.8rem" }}
            >
              -67%
            </span>
          </div>

          <img
            src={image}
            className="card-img-top p-3"
            alt="Product"
            style={{
              width: "100%",
              height: "200px",
              objectFit: "contain",
              borderRadius: "10px 10px 0 0",
              marginTop: 10,
            }}
          />

          <div className="card-body text-center">
            <h5
              className="card-title"
              style={{ fontSize: "1rem", fontWeight: "bold" }}
            >
              {name}
            </h5>

            <div
              className="price-container d-flex justify-content-center align-items-center mb-1"
              style={{ gap: "8px" }}
            >
              <p
                className="price text-danger mb-0"
                style={{ fontSize: "1.2rem", fontWeight: "bold" }}
              >
                290.000₫
              </p>
              <p
                className="text-muted text-decoration-line-through mb-0"
                style={{ fontSize: "0.9rem" }}
              >
                890.000₫
              </p>
            </div>

            <div
              className="progress my-3 position-relative"
              style={{ height: "20px", borderRadius: "10px" }}
            >
              <div
                className="progress-bar"
                role="progressbar"
                style={{ width: "60%", backgroundColor: "orange" }}
                aria-valuenow="60"
                aria-valuemin="0"
                aria-valuemax="100"
              >
                Còn 6/10 suất
              </div>
            </div>

            <button
              className="btn btn-primary btn-sm"
              style={{
                borderRadius: "20px",
                width: "100%",
                fontWeight: "bold",
              }}
            >
              Mua ngay
            </button>
          </div>
        </div>
      ) : horizon ? (
        <div
          className="d-flex p-2 rounded my-2"
          style={{ backgroundColor: "#fff", cursor: "pointer" }}
        >
          <span className="me-4 d-flex align-items-center">
            <Link
              to={`/detail/${
                hoverCartItem?.main?.slug ? hoverCartItem?.main?.slug : slug
              }`}
            >
              <img
                src={image}
                alt={name}
                style={{
                  maxWidth: "80px",
                  height: "auto",
                  objectFit: "contain",
                }}
              />
            </Link>
          </span>
          <span
            className="p-2 d-flex flex-column justify-content-between"
            style={{ width: 200 }}
          >
            <span className="fw-semibold">
              <Link
                to={`/detail/${
                  hoverCartItem?.main?.slug ? hoverCartItem?.main?.slug : slug
                }`}
                style={{ textDecoration: "none" }}
              >
                {name?.length > 25 ? `${name?.substring(0, 25)}...` : name}
              </Link>
            </span>
            <span>
              {!hoverCart ? (
                <span>
                  <span className="text-danger me-2">
                    {currentVariant?.color?.sale
                      ? currentVariant?.color?.sale > 100000000
                        ? handleNumber(currentVariant?.color?.sale)
                        : formatCurrency(currentVariant?.color?.sale)
                      : currentVariant?.color?.price
                      ? currentVariant?.color?.price > 100000000
                        ? handleNumber(currentVariant?.color?.price)
                        : formatCurrency(currentVariant?.color?.price)
                      : "---"}
                  </span>
                  {currentVariant?.color?.sale && (
                    <span className="text-decoration-line-through">
                      {currentVariant?.color?.price > 100000000
                        ? handleNumber(currentVariant?.color?.price)
                        : formatCurrency(currentVariant?.color?.price)}
                    </span>
                  )}
                </span>
              ) : (
                <span>
                  <span className="text-danger me-2">
                    {hoverCartItem?.color?.sale
                      ? hoverCartItem?.color?.sale > 100000000
                        ? handleNumber(hoverCartItem?.color?.sale)
                        : formatCurrency(hoverCartItem?.color?.sale)
                      : hoverCartItem?.color?.price
                      ? hoverCartItem?.color?.price > 100000000
                        ? handleNumber(hoverCartItem?.color?.price)
                        : formatCurrency(hoverCartItem?.color?.price)
                      : "---"}
                  </span>
                  {hoverCartItem?.color?.sale && (
                    <span className="text-decoration-line-through">
                      {hoverCartItem?.color?.price > 100000000
                        ? handleNumber(hoverCartItem?.color?.price)
                        : formatCurrency(hoverCartItem?.color?.price)}
                    </span>
                  )}
                </span>
              )}
            </span>
          </span>
          {hoverCart && (
            <span className="d-flex flex-column p-2 justify-content-between">
              <span className="d-flex gap-2">
                <span className="badge text-bg-info">
                  {hoverCartItem?.color.color}
                </span>
                <span className="badge text-bg-info">
                  {hoverCartItem?.storage}
                </span>
              </span>
              <span style={{ fontWeight: 600, fontSize: 20 }}>
                x{hoverCartItem.quantity}
              </span>
            </span>
          )}
        </div>
      ) : (
        <div
          className="card product-card my-2"
          style={{
            width: "18rem",
            borderRadius: "10px",
            boxShadow: "0 4px 8px rgba(0, 0, 0, 0.1)",
            position: "relative",
          }}
        >
          <div
            className="position-absolute top-0 start-0 m-2 badge bg-danger text-white"
            style={{ borderRadius: "5px", fontSize: "12px" }}
          >
            <FontAwesomeIcon icon={faCogs} className="me-1" /> Siêu sale
          </div>
          <div
            className="position-absolute top-0 end-0 m-2 badge"
            style={{ borderRadius: "5px", fontSize: "12px" }}
          >
            <div className="d-flex flex-column align-items-center">
              <span
                className="badge bg-warning text-dark"
                style={{ fontSize: "0.8rem" }}
              >
                -67%
              </span>

              {/* Các nút thêm vào giỏ hàng và yêu thích */}
              <div
                className="d-flex flex-column mt-2 action-buttons"
                style={{
                  opacity: 0,
                  visibility: "hidden",
                  transition: "opacity 0.3s, visibility 0.3s",
                }}
              >
                <button
                  className="icon-btn"
                  onClick={handleAddToCart}
                  style={{ marginBottom: "5px" }}
                >
                  <i className="fas fa-shopping-cart fw-semibold" />
                  <span className="fw-bold text-primary ms-1">
                    {cartItemQuantity ? `(${cartItemQuantity})` : ""}
                  </span>
                </button>
                <button
                  className="icon-btn"
                  onClick={() => addToFavor(main, currentVariant)}
                >
                  <i
                    className={`fas fa-heart ${inFavorItems && "text-danger"}`}
                  />
                </button>
              </div>
            </div>
          </div>

          <img
            src={image}
            className="card-img-top p-3"
            alt="Product"
            style={{
              width: "100%",
              height: "200px",
              objectFit: "contain",
              borderRadius: "10px 10px 0 0",
              marginTop: 10,
            }}
          />

          <div className="card-body text-center">
            <Link
              to={`/detail/${slug ? slug : ""}`}
              style={{ textDecoration: "none" }}
            >
              <span
                style={{
                  width: "100%",
                  display: "inline-block",
                  overflow: "hidden",
                }}
              >
                <h5 className="card-title" style={{ cursor: "pointer" }}>
                  {name
                    ? name.length > 40
                      ? name.slice(0, 40) + "..."
                      : `${name}${
                          currentVariant?.color?.color
                            ? ` ${currentVariant?.color?.color}`
                            : ""
                        }`
                    : testname.length > 40
                    ? testname.slice(0, 40) + "..."
                    : testname}
                </h5>
              </span>
            </Link>

            <div>
              <p className="price text-center my-1">
                <span className="me-2">
                  {currentVariant?.color?.sale
                    ? currentVariant?.color?.sale > 100000000
                      ? handleNumber(currentVariant?.color?.sale)
                      : formatCurrency(currentVariant?.color?.sale)
                    : currentVariant?.color?.price
                    ? currentVariant?.color?.price > 100000000
                      ? handleNumber(currentVariant?.color?.price)
                      : formatCurrency(currentVariant?.color?.price)
                    : "---"}
                </span>

                {/* Chỉ hiển thị old-price nếu có giá sale */}
                {currentVariant?.color?.sale && (
                  <span className="old-price">
                    {currentVariant?.color?.price
                      ? currentVariant?.color?.price > 100000000
                        ? handleNumber(currentVariant?.color?.price)
                        : formatCurrency(currentVariant?.color?.price)
                      : ""}
                  </span>
                )}
              </p>

              {/* Hiển thị các biến thể của bộ nhớ */}
              <div className="storage-variant my-3">
                {variant
                  ?.filter((v, index) => index < 4)
                  .map((v, index) => (
                    <span
                      key={index}
                      onClick={() => handleChangeVariant(v.storage)}
                      className={`storage-option ${
                        currentVariant?.storage === v.storage
                          ? "storage-selected"
                          : ""
                      }`}
                    >
                      {v?.storage}
                    </span>
                  ))}
              </div>

              {/* Nút "Mua ngay" khi không phải sản phẩm hot */}
              {!hot && (
                <button
                  className="btn btn-primary btn-sm"
                  style={{
                    borderRadius: "20px",
                    width: "100%",
                    fontWeight: "bold",
                  }}
                  onClick={() => buyNow(main, currentVariant)}
                >
                  Mua ngay
                </button>
              )}
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default memo(BoxPro);
