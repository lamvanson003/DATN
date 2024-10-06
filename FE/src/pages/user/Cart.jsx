import React, { useState, useContext } from "react";
import myImage from "../../assets/images/image.png";
import icons from "../../ultis/icon";
import { CartContext } from "../../context/Cart";
import { Link, useNavigate } from "react-router-dom";

const Cart = () => {
  const { IoCartOutline, TiDeleteOutline, MdDeleteForever } = icons;
  const { cartItems, addToCart, removeFromCart, clearCart, getCartTotal } =
    useContext(CartContext);
  const navigate = useNavigate();
  const handleNavigate = () => {
    navigate("/product");
  };
  const navigatePayment = () => {
    navigate("/payment");
  };
  return (
    <div
      className="d-flex align-items-center justify-content-center w-100"
      style={{ marginBottom: 101 }}
    >
      {cartItems.length >= 1 ? (
        <div className="d-flex flex-column" style={{ width: 1300 }}>
          <div
            className="d-flex align-items-center justify-content-between "
            style={{ marginTop: 40, marginBottom: 40 }}
          >
            <span className="d-flex align-items-center gap-4">
              <h3 className="fw-bold m-0" style={{ fontSize: 40 }}>
                Giỏ hàng
              </h3>
              <span>
                <IoCartOutline fontSize={40} />
              </span>
            </span>
            {cartItems.length >= 1 && (
              <span>
                <button
                  onClick={clearCart}
                  className="btn bg-danger text-light d-flex align-items-center"
                >
                  <span>
                    <MdDeleteForever size={24} />
                  </span>
                  Xóa hết
                </button>
              </span>
            )}
          </div>
          <div>
            <div className="d-flex flex-column gap-5">
              {cartItems.map((item) => (
                <div
                  key={item.id}
                  className="d-flex justify-content-between align-items-center product p-3 rounded"
                  style={{ boxShadow: "0 5px 10px rgba(0, 0, 0, 0.3)" }}
                >
                  <span
                    style={{ width: "40%", height: 100 }}
                    className="d-flex gap-4 align-items-center px-2"
                  >
                    <img
                      style={{ height: "90%" }}
                      src={myImage}
                      alt={item.name}
                    />
                    <span className="d-flex flex-column gap-3">
                      <span>{item.name}</span>
                      <span className="opacity-75">Loại: </span>
                    </span>
                  </span>
                  <span className="text-center" style={{ width: "20%" }}>
                    <span className="opacity-75 me-2 text-decoration-line-through">
                      ${item.price}
                    </span>
                    <span>${item.sale}</span>
                  </span>
                  <span
                    className="d-flex align-items-center justify-content-center fs-4"
                    style={{ width: "20%" }}
                  >
                    <span
                      style={{ width: "40%" }}
                      className="border rounded-start rounded-end d-flex justify-content-between "
                    >
                      <button
                        className="rounded-start border-0"
                        style={{
                          height: 50,
                          width: 30,
                          backgroundColor: "#fff",
                        }}
                        onClick={() => removeFromCart(item)}
                      >
                        -
                      </button>
                      <span className="d-flex align-items-center">
                        {item.quantity}
                      </span>
                      <button
                        className="rounded-end border-0"
                        style={{
                          height: 50,
                          width: 30,
                          backgroundColor: "#fff",
                        }}
                        onClick={() => addToCart(item)}
                      >
                        +
                      </button>
                    </span>
                  </span>
                  <span
                    className="text-center text-danger"
                    style={{ width: "20%" }}
                  >
                    {item.sale * item.quantity} đ
                  </span>
                </div>
              ))}
            </div>
            <div className="mt-5" style={{ height: 50 }}>
              <span className="px-2 py-3 bg-primary text-light rounded">
                Tiếp tục mua hàng
              </span>
            </div>
            <div className="d-flex justify-content-between mt-5">
              <div
                style={{
                  width: "40%",
                  backgroundColor: "#EDEAEA",
                  height: 70,
                }}
                className="px-3 py-2 d-flex justify-content-between align-items-center rounded"
              >
                <span
                  style={{ width: "75%", height: 50 }}
                  className="px-2 d-flex align-items-center"
                >
                  <input
                    style={{ width: "100%", height: "100%" }}
                    type="text"
                    placeholder="Nhập mã giảm giá"
                    className="text-center rounded border-0"
                  />
                </span>
                <span
                  style={{ backgroundColor: "#016AFF", height: "100%" }}
                  className="px-3 py-1 rounded text-light d-flex align-items-center fw-bold"
                >
                  Áp dụng
                </span>
              </div>
              <div
                className="d-flex flex-column gap-3 border border-secondary rounded px-3 py-3"
                style={{ width: "40%" }}
              >
                <span style={{ fontSize: 20 }} className="fw-semibold">
                  Tổng giỏ hàng
                </span>
                <span className="d-flex justify-content-between py-2 border-bottom border-secondary">
                  Giá gốc:
                  <span>đ</span>
                </span>
                <span className="d-flex justify-content-between py-2 border-bottom border-secondary">
                  Phí vận chuyển: <span>100.000đ</span>
                </span>
                <span className="d-flex justify-content-between py-2">
                  Tổng:
                  <span className="fw-bold text-danger">${getCartTotal()}</span>
                </span>
                <span className="d-flex justify-content-center">
                  <span
                    style={{
                      backgroundColor: "#016AFF",
                      width: "50%",
                      cursor: "pointer",
                    }}
                    className="text-center px-2 py-2 rounded text-light fw-bold"
                    onClick={() => navigatePayment()}
                  >
                    Tiến hành thanh toán
                  </span>
                </span>
              </div>
            </div>
          </div>
        </div>
      ) : (
        <div>
          Giỏ hàng của bạn chưa có gì! Quay lại
          <span
            style={{ color: "blue", cursor: "pointer" }}
            onClick={handleNavigate}
          >
            trang sản phảm
          </span>
        </div>
      )}
    </div>
  );
};

export default Cart;
