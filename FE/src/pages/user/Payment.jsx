import React, { useContext, useEffect, useState } from "react";
import icons from "../../ultis/icon";
import MyImage from "../../assets/images/image.png";
import LogoVisa from "../../assets/images/logovisa.png";
import logomastercard from "../../assets/images/logomastercard.png";
import logovcb from "../../assets/images/logovcb.png";
import { CartContext } from "../../context/Cart";
import axios from "axios";
import "./css/Payment.css";
const Payment = () => {
  const { IoIosArrowDropdown, RiBankCardFill, PiHandPalm } = icons;
  const { cartItems, getCartTotal, buyNowItem } = useContext(CartContext);
  const [provinces, setProvinces] = useState([]);
  const [districts, setDistricts] = useState([]);
  const [wards, setWards] = useState([]);
  const [selectedProvince, setSelectedProvince] = useState(null);
  const [selectedDistrict, setSelectedDistrict] = useState(null);
  const [selectedWard, setSelectedWard] = useState(null);
  useEffect(() => {
    const fetchProvinces = async () => {
      const res = await axios.get("https://provinces.open-api.vn/api/p/");
      setProvinces(res.data);
    };
    fetchProvinces();
  }, []);
  useEffect(() => {
    if (selectedProvince) {
      const fetchDistricts = async () => {
        const res = await axios.get(
          `https://provinces.open-api.vn/api/p/${selectedProvince.code}?depth=2`
        );
        setDistricts(res.data.districts);
        setWards([]);
      };
      fetchDistricts();
    }
  }, [selectedProvince]);
  useEffect(() => {
    if (selectedDistrict) {
      const fetchWards = async () => {
        const res = await axios.get(
          `https://provinces.open-api.vn/api/d/${selectedDistrict.code}?depth=2`
        );
        setWards(res.data.wards);
      };

      fetchWards();
    }
  }, [selectedDistrict]);
  const [customerInfo, setCustomerInfo] = useState({
    name: "",
    phone: "",
    province: "",
    district: "",
    ward: "",
    street: "",
  });
  const handleInputChange = (e) => {
    const { id, value } = e.target;
    setCustomerInfo((prev) => ({
      ...prev,
      [id]: value,
    }));
  };
  return (
    <>
      <div style={{ paddingLeft: 90, marginTop: 50, marginBottom: 50 }}>
        <h3 className="fw-semibold">Thông tin thanh toán</h3>
      </div>
      <div className="d-flex flex-column align-items-center justify-content-center">
        <div className="row" style={{ width: 1300 }}>
          <div className="col-md-6">
            <div className="d-flex flex-column">
              <form className="form-container">
                <div>
                  <label htmlFor="name" className="label-style">
                    Họ tên:
                  </label>
                  <input
                    id="name"
                    type="text"
                    className="input-style rounded"
                    value={customerInfo.name}
                    onChange={handleInputChange}
                  />
                </div>

                <div>
                  <label htmlFor="phone" className="label-style">
                    Số điện thoại:
                  </label>
                  <input
                    id="phone"
                    type="text"
                    className="input-style rounded"
                    value={customerInfo.phone}
                    onChange={handleInputChange}
                  />
                </div>

                <div>
                  <label htmlFor="province" className="label-style">
                    Tỉnh, thành phố:
                  </label>
                  <div className="input-group input-group-style">
                    <select
                      id="province"
                      className="form-control"
                      onChange={(e) => {
                        const selectedProvince = provinces.find(
                          (p) => p.code === Number(e.target.value)
                        );
                        setSelectedProvince(selectedProvince);
                        setCustomerInfo((prev) => ({
                          ...prev,
                          province: selectedProvince
                            ? selectedProvince.name
                            : "",
                          district: "",
                          ward: "",
                        }));
                      }}
                      value={
                        customerInfo.province
                          ? provinces.find(
                              (p) => p.name === customerInfo.province
                            )?.code
                          : ""
                      }
                    >
                      <option value="">Chọn tỉnh thành phố</option>
                      {provinces.map((province) => (
                        <option key={province.code} value={province.code}>
                          {province.name}
                        </option>
                      ))}
                    </select>
                  </div>
                </div>

                <div>
                  <label htmlFor="district" className="label-style">
                    Quận huyện:
                  </label>
                  <div className="input-group input-group-style">
                    <select
                      id="district"
                      className="form-control"
                      onChange={(e) => {
                        const selectedDistrict = districts.find(
                          (d) => d.code === Number(e.target.value)
                        );
                        setSelectedDistrict(selectedDistrict);
                        setCustomerInfo((prev) => ({
                          ...prev,
                          district: selectedDistrict
                            ? selectedDistrict.name
                            : "",
                          ward: "",
                        }));
                      }}
                      value={
                        customerInfo.district
                          ? districts.find(
                              (d) => d.name === customerInfo.district
                            )?.code
                          : ""
                      }
                    >
                      <option value="">Chọn quận huyện</option>
                      {districts.map((district) => (
                        <option key={district.code} value={district.code}>
                          {district.name}
                        </option>
                      ))}
                    </select>
                  </div>
                </div>

                <div>
                  <label htmlFor="ward" className="label-style">
                    Phường xã:
                  </label>
                  <div className="input-group input-group-style">
                    <select
                      id="ward"
                      className="form-control"
                      onChange={(e) => {
                        const selectedWard = wards.find(
                          (w) => w.code === Number(e.target.value)
                        );
                        setSelectedDistrict(selectedDistrict);
                        setCustomerInfo((prev) => ({
                          ...prev,
                          ward: selectedWard ? selectedWard.name : "",
                        }));
                      }}
                      value={
                        customerInfo.ward
                          ? wards.find((w) => w.code === customerInfo.ward)
                              ?.code
                          : ""
                      }
                    >
                      <option value="">Chọn phường xã</option>
                      {wards.map((ward) => (
                        <option key={ward.code} value={ward.code}>
                          {ward.name}
                        </option>
                      ))}
                    </select>
                  </div>
                </div>

                <div>
                  <label htmlFor="street" className="label-style">
                    Số nhà, tên đường:
                  </label>
                  <input
                    id="street"
                    type="text"
                    className="input-style rounded"
                    value={customerInfo.street}
                    onChange={handleInputChange}
                  />
                </div>
                <span
                  onClick={() => {
                    console.log(customerInfo);
                  }}
                >
                  In thông tin
                </span>
              </form>
            </div>
          </div>
          <div className="col-md-6">
            <div
              className=" d-flex justify-content-center"
              style={{ width: "100%" }}
            >
              <div
                className=" d-flex flex-column px-4 py-4 gap-5 rounded"
                style={{
                  width: 600,
                  boxShadow: "0 4px 8px rgba(0, 0, 0, 0.3)",
                }}
              >
                <div className="d-flex flex-column gap-3">
                  {cartItems.map((cartItem) => (
                    <div
                      key={cartItem.id}
                      className="d-flex align-items-center gap-3 my-3"
                    >
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
                        <span className="text-start">{cartItem.name}</span>
                        <span
                          className="opacity-75 flex-wrap"
                          style={{
                            whiteSpace: "normal",
                            wordBreak: "break-word",
                          }}
                        >
                          Màu sắc: vàng, dung lượng: 512gb
                        </span>
                      </span>
                      <span style={{ width: "10%" }} className="text-center">
                        {cartItem.quantity}
                      </span>
                      <span style={{ width: "10%" }} className="text-end">
                        {cartItem.sale}
                      </span>
                    </div>
                  ))}
                </div>

                <div className="d-flex flex-column gap-3">
                  <div className="d-flex justify-content-between border-bottom border-secondary py-2">
                    <span className="fw-semibold">Giá: </span>
                    <span>${getCartTotal()}</span>
                  </div>
                  <div className="d-flex justify-content-between border-bottom border-secondary py-2">
                    <span className="fw-semibold">Phí vận chuyển: </span>
                    <span>$2.99</span>
                  </div>
                  <div className="d-flex justify-content-between border-bottom border-secondary py-2">
                    <span className="fw-semibold">Tổng: </span>
                    <span
                      className="text-danger fw-bold"
                      style={{ fontSize: 20 }}
                    >
                      ${getCartTotal() + 2.99}
                    </span>
                  </div>
                  <div>
                    <span className="d-flex justify-content-between align-items-center">
                      <span className="fw-semibold">
                        <input type="radio" style={{ marginRight: 20 }} />
                        thanh toán online
                      </span>
                      <span className="d-flex justify-content-between gap-3">
                        <img style={{ height: 50 }} src={LogoVisa} alt="" />
                        <img
                          style={{ height: 50 }}
                          src={logomastercard}
                          alt=""
                        />
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
                <div className="d-flex justify-content-between align-items-center">
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
                    className="px-4 py-2 d-flex algin-items-center  border border-secondary rounded text-light bg-primary fw-semibold "
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
      </div>
    </>
  );
};

export default Payment;
