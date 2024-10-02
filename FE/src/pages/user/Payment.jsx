import React from "react";
import icons from "../../ultis/icon";
import MyImage from "../../assets/images/image.png";
import LogoVisa from "../../assets/images/logovisa.png";
import logomastercard from "../../assets/images/logomastercard.png";
import logovcb from "../../assets/images/logovcb.png";
const Payment = () => {
  const { IoIosArrowDropdown, RiBankCardFill, PiHandPalm } = icons;
  return (
    <>
      <div style={{ paddingLeft: 90, marginTop: 50, marginBottom: 50 }}>
        <h3 className="fw-semibold">Thông tin thanh toán</h3>
      </div>
      <div className="d-flex flex-column align-items-center justify-content-center">
        <div className="d-flex" style={{ width: 1300 }}>
          <div className="" style={{ width: "50%" }}>
            <div className="d-flex flex-column">
              <span className="my-2">
                <label
                  htmlFor="name"
                  style={{
                    textShadow: "1px 1px 2px rgba(0, 0, 0, 0.5)",
                  }}
                  className="my-2"
                >
                  Họ tên:
                </label>
                <br />
                <input
                  id="phone"
                  type="text"
                  style={{
                    boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                    border: "none", // Bỏ border
                    outline: "none",

                    height: 40,
                    width: 520,
                  }}
                  className="rounded"
                />
              </span>

              <span className="my-2">
                <label
                  htmlFor="phone"
                  style={{
                    textShadow: "1px 1px 2px rgba(0, 0, 0, 0.5)",
                  }}
                  className="my-2"
                >
                  Số điện thoại:
                </label>
                <br />
                <input
                  id="phone"
                  type="text"
                  style={{
                    boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                    border: "none", // Bỏ border
                    outline: "none",

                    height: 40,
                    width: 520,
                  }}
                  className="rounded"
                />
              </span>
              <span className="my-2">
                <label
                  htmlFor="province"
                  style={{
                    textShadow: "1px 1px 2px rgba(0, 0, 0, 0.5)",
                  }}
                  className="my-2"
                >
                  Tỉnh, thành phố:
                </label>
                <div
                  className="input-group rounded"
                  style={{
                    width: 520,
                    boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                  }}
                >
                  <input
                    type="text"
                    className="form-control"
                    placeholder="Enter data"
                    style={{
                      border: "none", // Bỏ border
                      outline: "none",
                    }}
                  />
                  <button
                    className="btn text-primary"
                    type="button"
                    style={{
                      outline: "none", // Bỏ outline
                      boxShadow: "none", // Bỏ box-shadow khi nhấn
                    }}
                  >
                    <IoIosArrowDropdown size={24} />
                  </button>
                </div>
              </span>
              <span className="my-2">
                <label
                  htmlFor="district"
                  style={{
                    textShadow: "1px 1px 2px rgba(0, 0, 0, 0.5)",
                  }}
                  className="my-2"
                >
                  Quận, huyện:
                </label>
                <div
                  className="input-group rounded"
                  style={{
                    width: 520,
                    boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                  }}
                >
                  <input
                    type="text"
                    className="form-control"
                    placeholder="Enter data"
                    style={{
                      border: "none", // Bỏ border
                      outline: "none",
                    }}
                  />
                  <button
                    className="btn text-primary"
                    type="button"
                    style={{
                      outline: "none", // Bỏ outline
                      boxShadow: "none", // Bỏ box-shadow khi nhấn
                    }}
                  >
                    <IoIosArrowDropdown size={24} />
                  </button>
                </div>
              </span>
              <span className="my-2">
                <label
                  htmlFor="ward"
                  style={{
                    textShadow: "1px 1px 2px rgba(0, 0, 0, 0.5)",
                  }}
                  className="my-2"
                >
                  Phường, xã:
                </label>
                <div
                  className="input-group rounded"
                  style={{
                    width: 520,
                    boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                  }}
                >
                  <input
                    type="text"
                    className="form-control"
                    placeholder="Enter data"
                    style={{
                      border: "none", // Bỏ border
                      outline: "none",
                    }}
                  />
                  <button
                    className="btn text-primary"
                    type="button"
                    style={{
                      outline: "none", // Bỏ outline
                      boxShadow: "none", // Bỏ box-shadow khi nhấn
                    }}
                  >
                    <IoIosArrowDropdown size={24} />
                  </button>
                </div>
              </span>
              <span className="my-2">
                <label
                  htmlFor="street"
                  style={{
                    textShadow: "1px 1px 2px rgba(0, 0, 0, 0.5)",
                  }}
                  className="my-2"
                >
                  Số nhà, tên đường:
                </label>
                <br />
                <input
                  id="street"
                  type="text"
                  style={{
                    boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                    border: "none", // Bỏ border
                    outline: "none",
                    height: 40,
                    width: 520,
                  }}
                  className="rounded"
                />
              </span>
            </div>
          </div>
          <div
            className=" d-flex justify-content-center"
            style={{ width: "50%" }}
          >
            <div
              className=" d-flex flex-column px-4 py-4 gap-5 rounded"
              style={{
                width: 600,
                boxShadow: "0 4px 8px rgba(0, 0, 0, 0.3)",
              }}
            >
              <div className="d-flex flex-column gap-3">
                <div className="d-flex align-items-center gap-3 my-3">
                  <span style={{ width: "20%" }}>
                    <img
                      src={MyImage}
                      alt="ảnh sản phẩm"
                      style={{ height: 65 }}
                    />
                  </span>
                  <span
                    style={{ width: "60%" }}
                    className="d-flex flex-column gap-2 fw-semibold"
                  >
                    <span className="text-start">Iphone 16 promax</span>
                    <span
                      className="opacity-75 flex-wrap"
                      style={{ whiteSpace: "normal", wordBreak: "break-word" }}
                    >
                      Màu sắc: vàng, dung lượng: 512gb
                    </span>
                  </span>
                  <span style={{ width: "20%" }} className="text-end">
                    25.000.000đ
                  </span>
                </div>
                <div className="d-flex align-items-center gap-3 my-3">
                  <span style={{ width: "20%" }}>
                    <img
                      src={MyImage}
                      alt="ảnh sản phẩm"
                      style={{ height: 65 }}
                    />
                  </span>
                  <span
                    style={{ width: "60%" }}
                    className="d-flex flex-column gap-2 "
                  >
                    <span className="text-start fw-semibold">
                      Iphone 16 promax
                    </span>
                    <span
                      className="opacity-75 flex-wrap"
                      style={{ whiteSpace: "normal", wordBreak: "break-word" }}
                    >
                      Màu sắc: vàng, dung lượng: 512gb
                    </span>
                  </span>
                  <span style={{ width: "20%" }} className="text-end">
                    25.000.000đ
                  </span>
                </div>
                <div className="d-flex align-items-center gap-3 my-3">
                  <span style={{ width: "20%" }}>
                    <img
                      src={MyImage}
                      alt="ảnh sản phẩm"
                      style={{ height: 65 }}
                    />
                  </span>
                  <span
                    style={{ width: "60%" }}
                    className="d-flex flex-column gap-2 fw-semibold"
                  >
                    <span className="text-start">Iphone 16 promax</span>
                    <span
                      className="opacity-75 flex-wrap"
                      style={{ whiteSpace: "normal", wordBreak: "break-word" }}
                    >
                      Màu sắc: vàng, dung lượng: 512gb
                    </span>
                  </span>
                  <span style={{ width: "20%" }} className="text-end">
                    25.000.000đ
                  </span>
                </div>
              </div>

              <div className="d-flex flex-column gap-3">
                <div className="d-flex justify-content-between border-bottom border-secondary py-2">
                  <span className="fw-semibold">Giá: </span>
                  <span>50.000.000đ</span>
                </div>
                <div className="d-flex justify-content-between border-bottom border-secondary py-2">
                  <span className="fw-semibold">Phí vận chuyển: </span>
                  <span>100.000đ</span>
                </div>
                <div className="d-flex justify-content-between border-bottom border-secondary py-2">
                  <span className="fw-semibold">Tổng: </span>
                  <span>50.100.000đ</span>
                </div>
                <div>
                  <span className="d-flex justify-content-between align-items-center">
                    <span className="fw-semibold">
                      <input type="radio" style={{ marginRight: 20 }} />
                      thanh toán online
                    </span>
                    <span className="d-flex justify-content-between gap-3">
                      <img style={{ height: 50 }} src={LogoVisa} alt="" />
                      <img style={{ height: 50 }} src={logomastercard} alt="" />
                      <img style={{ height: 50 }} src={logovcb} alt="" />
                    </span>
                  </span>
                  <span className="d-flex justify-content-between">
                    <span className="fw-semibold">
                      <input type="radio" style={{ marginRight: 20 }} />
                      thanh toán khi nhận hàng (COD)
                    </span>
                    <span className="d-flex justify-content-between">
                      <PiHandPalm size={24} />
                    </span>
                  </span>
                </div>
              </div>
              <div className="d-flex justify-content-between">
                <span style={{ width: "60%" }}>
                  <input
                    style={{ height: 50, width: "100%" }}
                    type="text"
                    placeholder="Nhập mã"
                    className="text-center"
                  />
                </span>
                <span
                  style={{ height: 50 }}
                  className="px-4 py-2 d-flex algin-items-center border border-secondary rounded text-light bg-primary fw-semibold "
                >
                  Áp dụng mã
                </span>
              </div>
              <div>
                <span
                  style={{ height: 50, fontSize: 24, cursor: "pointer" }}
                  className="px-4 py-2 d-flex align-items-center justify-content-center border border-secondary rounded text-light bg-primary fw-bold"
                >
                  Thanh toán
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default Payment;
