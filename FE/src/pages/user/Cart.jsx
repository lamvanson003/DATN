import React from "react";
import myImage from "../../assets/images/image.png";
import icons from "../../ultis/icon";
const Cart = () => {
  const { IoCartOutline } = icons;
  return (
    <div className="d-flex align-items-center justify-content-center w-100">
      <div className="d-flex flex-column" style={{ width: 1300 }}>
        <div
          className="d-flex align-items-center jusitfy-content-center gap-3"
          style={{ marginTop: 40, marginBottom: 40 }}
        >
          <h3 className="fw-bold m-0" style={{ fontSize: 40 }}>
            Giỏ hàng
          </h3>
          <span>
            <IoCartOutline fontSize={40} />
          </span>
        </div>
        <div className="d-flex flex-column  gap-5">
          <div
            className="d-flex justify-content-between align-items-center  fw-semibold"
            style={{
              height: 100,
              fontSize: 25,
              boxShadow: "0 4px 8px rgba(0, 0, 0, 0.2)",
            }}
          >
            <span className="text-center" style={{ width: "40%" }}>
              Sản phẩm
            </span>
            <span className="text-center" style={{ width: "20%" }}>
              Giá
            </span>
            <span className="text-center" style={{ width: "20%" }}>
              Số lượng
            </span>
            <span className="text-center" style={{ width: "20%" }}>
              Tổng tiền
            </span>
          </div>
          <div
            className="d-flex justify-content-between align-items-center"
            style={{ boxShadow: "0 4px 8px rgba(0, 0, 0, 0.2)" }}
          >
            <span
              style={{ width: "40%", height: 170 }}
              className="d-flex justify-content-between align-items-center"
            >
              <span>Icon xóa</span>
              <img src={myImage} alt="123" />
              <span>Tên sản phẩm 1</span>
            </span>
            <span className="text-center" style={{ width: "20%" }}>
              23.000.000đ
            </span>
            <span
              className="d-flex align-items-center justify-content-center align-items-center fs-4"
              style={{ width: "20%" }}
            >
              <span
                style={{ width: "40%" }}
                className="border rounded-start rounded-end d-flex justify-content-between"
              >
                <button
                  className="rounded-start border-0"
                  style={{
                    height: 50,
                    width: 30,
                    backgroundColor: "#fff",
                  }}
                >
                  -
                </button>
                <input
                  className="text-center border-0"
                  type="text"
                  value={1}
                  style={{ width: "15%", height: 50 }}
                />
                <button
                  className="rounded-end border-0"
                  style={{
                    height: 50,
                    width: 30,
                    backgroundColor: "#fff",
                  }}
                >
                  +
                </button>
              </span>
            </span>
            <span className="text-center" style={{ width: "20%" }}>
              23.000.000
            </span>
          </div>
          <div
            className="d-flex justify-content-between align-items-center"
            style={{
              boxShadow: "0 4px 8px rgba(0, 0, 0, 0.2)",
            }}
          >
            <span
              style={{ width: "40%", height: 170 }}
              className="d-flex justify-content-between align-items-center"
            >
              <span>Icon xóa</span>
              <img src={myImage} alt="123" />
              <span>Tên sản phẩm 2</span>
            </span>
            <span className="text-center" style={{ width: "20%" }}>
              23.000.000đ
            </span>
            <span
              className="d-flex align-items-center justify-content-center align-items-center fs-4"
              style={{ width: "20%" }}
            >
              <span
                style={{ width: "40%" }}
                className="border rounded-start rounded-end d-flex justify-content-between"
              >
                <button
                  className="rounded-start border-0"
                  style={{
                    height: 50,
                    width: 30,
                    backgroundColor: "#fff",
                  }}
                >
                  -
                </button>
                <input
                  className="text-center border-0"
                  type="text"
                  value={1}
                  style={{ width: "15%", height: 50 }}
                />
                <button
                  className="rounded-end border-0"
                  style={{
                    height: 50,
                    width: 30,
                    backgroundColor: "#fff",
                  }}
                >
                  +
                </button>
              </span>
            </span>
            <span className="text-center" style={{ width: "20%" }}>
              23.000.000
            </span>
          </div>
        </div>
        <div className="mt-5" style={{ height: 50 }}>
          <span className="px-2 py-3 bg-primary text-light rounded">
            Tiếp tục mua hàng
          </span>
        </div>
        <div className="d-flex justify-content-between mt-5">
          <div
            style={{ width: "40%", backgroundColor: "#EDEAEA", height: 70 }}
            className="px-3 py-2 d-flex justify-content-between align-items-center rounded "
          >
            <span style={{ width: "75%", height: 50 }} className="px-2">
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
              Giá gốc : <span> 23.000.000đ</span>
            </span>
            <span className="d-flex justify-content-between py-2 border-bottom border-secondary">
              Phí vận chuyển <span>100.000đ</span>
            </span>
            <span className="d-flex justify-content-between py-2 ">
              Tổng: <span>23.100.000đ</span>
            </span>
            <span className="d-flex justify-content-center">
              <span
                style={{ backgroundColor: "#016AFF", width: "50%" }}
                className="text-center px-2 py-2 rounded text-light"
              >
                Tiến hành thanh toán
              </span>
            </span>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Cart;
