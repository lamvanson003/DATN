import React, { useEffect, useState, useContext } from "react";
import "./css/Boxpro.css";
import { Link, useParams } from "react-router-dom";
import proImg from "../assets/images/iHome/image.png";
import { CartContext } from "../context/Cart";
import { memo } from "react";
import { FavorContext } from "../context/Favor";
import { formatCurrency, handleNumber } from "../ultis/func";
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
  const [currentVariant, setCurrentVariant] = useState();
  const [activeStorage, setActiveStorage] = useState(null);
  const [activeColor, setActiveColor] = useState(null);
  useEffect(() => {
    if (variant && variant.length > 0) {
      const firstStorage = variant[0];
      const firstVariant = firstStorage.variants[0];
      setActiveStorage(firstStorage || null);
      if (firstStorage.variants.length > 0) {
        setActiveColor(firstStorage.variants[0]); // Sửa ở đây để truy cập đúng biến
      } else {
        setActiveColor(null); // Set null nếu không có variant nào
      }
      setCurrentVariant({
        storage: firstStorage.storage,
        color: firstVariant,
      });
    }
  }, [variant]);
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
      // Nếu không tìm thấy storage, đặt currentVariant về null hoặc xử lý lỗi
      setCurrentVariant(null);
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
                  : `${name} ${
                      currentVariant?.color?.color &&
                      currentVariant?.color?.color
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

          <div className="storage-variant">
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
