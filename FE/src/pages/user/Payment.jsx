import React, { useContext, useEffect, useState } from "react";
import icons from "../../ultis/icon";
import LogoVisa from "../../assets/images/logovisa.png";
import logomastercard from "../../assets/images/logomastercard.png";
import logovcb from "../../assets/images/logovcb.png";
import { CartContext } from "../../context/Cart";
import { formatCurrency } from "../../ultis/func";
import axios from "axios";
import { orderApi, paymentApi } from "../../apis";
import "./css/Payment.css";
import { useNavigate, useLocation } from "react-router-dom";
import sending from "../../assets/images/iHome/sending.png";
import { discountApi } from "../../apis";
import CryptoJS from "crypto-js";
const {
  IoIosArrowDropdown,
  RiBankCardFill,
  PiHandPalm,
  BiSolidDiscount,
  MdOutlineSmsFailed,
  FaCheckDouble,
} = icons;
const Payment = () => {
  const navigate = useNavigate();
  const location = useLocation();
  const { checkedItems } = location.state || { checkedItems: [] };
  const { cartItems, getCartTotal, buyNow } = useContext(CartContext);
  const [isSendingSuccess, setIsSendingSuccess] = useState(false);
  const [finalPrice, setFinalPrice] = useState(getCartTotal());
  const [provinces, setProvinces] = useState([]);
  const [districts, setDistricts] = useState([]);
  const [wards, setWards] = useState([]);
  const [selectedProvince, setSelectedProvince] = useState(null);
  const [selectedDistrict, setSelectedDistrict] = useState(null);
  const [selectedWard, setSelectedWard] = useState(null);

  const [discountCode, setDiscountCode] = useState("");
  const [applyingDiscount, setApplyingDiscount] = useState(false);
  const [isSuccessDiscount, setIsSuccessDiscount] = useState(0);
  const [paymentMethod, setPaymentMethod] = useState(2);
  const handleChangePaymentMethod = (e) => {
    const selectedValue = Number(e.target.value);
    setPaymentMethod(selectedValue);
  };
  const handleDiscount = async () => {
    try {
      setApplyingDiscount(true);
      const discountData = await discountApi.getOne(discountCode);
      setApplyingDiscount(false);
      if (discountData.value < 100) {
        const discountValue = (getCartTotal() * discountData.value) / 100;
        const discountPrice = getCartTotal() - discountValue;
        setFinalPrice(discountPrice);
      } else {
        const discountPrice = getCartTotal() - discountData.value;
        setFinalPrice(discountPrice);
      }
      setDiscountCode("");
      setIsSuccessDiscount(1);
    } catch (err) {
      console.log("Lỗi khi handle mã", err);
      setDiscountCode("");
      setIsSuccessDiscount(2);
    }
  };

  useEffect(() => {
    const fetchProvinces = async () => {
      const res = await axios.get("https://esgoo.net/api-tinhthanh/1/0.htm");
      setProvinces(res.data.data);
    };
    fetchProvinces();
  }, []);
  useEffect(() => {
    if (selectedProvince) {
      const fetchDistricts = async () => {
        const res = await axios.get(
          `https://esgoo.net/api-tinhthanh/2/${selectedProvince.id}.htm`
        );
        setDistricts(res.data.data);
        setWards([]);
      };
      fetchDistricts();
    }
  }, [selectedProvince]);
  useEffect(() => {
    if (selectedDistrict) {
      const fetchWards = async () => {
        const res = await axios.get(
          `https://esgoo.net/api-tinhthanh/3/${selectedDistrict.id}.htm`
        );
        setWards(res.data.data);
      };
      fetchWards();
    }
  }, [selectedDistrict]);
  const handleInputChange = (e) => {
    const { id, value } = e.target;
    setCustomerInfo((prev) => ({
      ...prev,
      [id]: value,
    }));
  };

  const [validFields, setValidFields] = useState({
    name: true,
    phone: true,
    province: true,
    district: true,
    ward: true,
    street: true,
  });
  const [customerInfo, setCustomerInfo] = useState({
    name: "",
    phone: "",
    province: "",
    district: "",
    ward: "",
    street: "",
    note: "",
    email: "",
  });
  const [products, setProducts] = useState([]);
  useEffect(() => {
    const updatedProducts = orderItems.map((item) => ({
      product_variant_id: item?.color?.id,
      quantity: item.quantity || 1,
      price: item?.color?.price,
      sale: item?.color?.sale ? item?.color?.sale : 0,
    }));
    setProducts(updatedProducts);
  }, []);
  const excutePayment = () => {
    const newValidFields = {
      name: customerInfo.name !== "",
      phone: customerInfo.phone !== "",
      email: customerInfo.email !== "",
      province: customerInfo.province !== "",
      district: customerInfo.district !== "",
      ward: customerInfo.ward !== "",
      street: customerInfo.street !== "",
    };

    setValidFields(newValidFields);
    const isFormValid = Object.values(newValidFields).every(Boolean);
    if (!isFormValid) {
      alert("Vui lòng điền đầy đủ thông tin");
      return;
    }

    const phonePattern = /^[0-9]{10}$/;
    if (!phonePattern.test(customerInfo.phone)) {
      alert("Số điện thoại bao gồm 10 chữ số và không chứa ký tự đặc biệt");
      return;
    }

    const namePattern = /^[\p{L}\s]+$/u;
    if (!namePattern.test(customerInfo.name)) {
      alert("Tên chỉ được chứa chữ cái và khoảng trắng.");
      return;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(customerInfo.email)) {
      alert("Vui lòng nhập địa chỉ email hợp lệ.");
      return;
    }

    const orderInfo = {
      user_id: null,
      payment_method_id: paymentMethod,
      discount_id: 1,
      shipping_method: 0,
      fullname: customerInfo.name,
      phone: customerInfo.phone,
      address: `${customerInfo.street}, ${customerInfo.ward}, ${customerInfo.district}, ${customerInfo.province}  `,
      email: customerInfo.email,
      note: "123",
      total_price: finalPrice,
      products: products,
    };

    // paymentMethod === 1 thanh toán Online
    if (paymentMethod === 1) {
      const vnp_TmnCode = "AABYH89K"; // Mã terminal của bạn từ VNPAY
      const secretKey = "EWD04RV011B8GM0K0GUKPD1C8PYXRC3B"; // Khóa bí mật của bạn
      const vnp_Amount = 99999 * 100; // Tổng số tiền thanh toán, nhân 100
      const vnp_TxnRef = Date.now().toString(); // Mã giao dịch duy nhất
      const vnp_IpAddr = "127.0.0.1"; // Địa chỉ IP của người dùng
      const vnp_ReturnUrl = "http://localhost:5173/payment"; // URL trả về

      const formatDateToVnpay = (date) => {
        const yyyyMMddHHmmss = date
          .toISOString()
          .replace(/[-:TZ]/g, "")
          .slice(0, 14);
        return yyyyMMddHHmmss;
      };

      const now = new Date();
      now.setHours(now.getHours() + 7); // Cộng thêm 7 giờ để chuyển sang UTC+7

      const vnp_CreateDate = formatDateToVnpay(now);

      const expireDate = new Date(now.getTime() + 15 * 60 * 1000); // Cộng thêm 15 phút
      const vnp_ExpireDate = formatDateToVnpay(expireDate);

      const orderData = {
        vnp_Version: "2.1.0", // Phiên bản VNPAY
        vnp_Command: "pay",
        vnp_TmnCode: vnp_TmnCode,
        vnp_Amount: vnp_Amount,
        vnp_CreateDate: vnp_CreateDate,
        vnp_ExpireDate: vnp_ExpireDate,
        vnp_CurrCode: "VND", // Mã tiền tệ
        vnp_IpAddr: vnp_IpAddr,
        vnp_Locale: "vn", // Ngôn ngữ giao dịch
        vnp_OrderInfo: "Mua sản phẩm từ cửa hàng ABC", // Mô tả đơn hàng
        vnp_OrderType: "billpayment", // Loại giao dịch
        vnp_ReturnUrl: vnp_ReturnUrl,
        vnp_TxnRef: vnp_TxnRef,
      };

      const sortedData = Object.keys(orderData)
        .sort()
        .map((key) => `${key}=${encodeURIComponent(orderData[key])}`) // Đảm bảo tất cả các giá trị đều mã hóa bằng encodeURIComponent
        .join("&");

      const secureHash = CryptoJS.HmacSHA512(sortedData, secretKey).toString(CryptoJS.enc.Hex);


      // Tạo URL thanh toán
      const paymentUrl = `https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?${sortedData}&vnp_SecureHash=${secureHash}&vnp_SecureHashType=HmacSHA512`;


      console.log("Payment URL:", paymentUrl);
      // Điều hướng đến trang thanh toán
      window.location.href = paymentUrl;
    } else {
      orderApi.create(orderInfo);
    }
  };
  // paymentApi.create(orderData);
  const closeModal = () => {
    setIsSendingSuccess(false);
  };
  useEffect(() => {
    return () => {
      if (location.pathname === "/payment") {
        localStorage.removeItem("buyNowItem");
      }
    };
  }, [location.pathname]);
  const orderItems = localStorage.getItem("buyNowItem")
    ? JSON.parse(localStorage.getItem("buyNowItem"))
    : checkedItems.length > 0
    ? checkedItems
    : [];
  return (
    <>
      {isSendingSuccess && (
        <div className="custom-modal-overlay">
          <div className="custom-modal">
            <h2>Thông báo đơn hàng</h2>
            <p>Đơn hàng của bạn đã được gửi đi, Vui lòng chờ đợi xác nhận</p>
            <div className="modal-img-container">
              <img className="modal-img" src={sending} alt="" />
            </div>
            <div className="group-custom-modal-button">
              <span className="custom-modal-button">chi tiết hóa đơn</span>
              <span className="custom-modal-button">trang chủ</span>
              <span className="custom-modal-button" onClick={closeModal}>
                Đóng
              </span>
            </div>
          </div>
        </div>
      )}
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
                    style={{ borderColor: validFields.name ? "" : "red" }}
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
                    style={{ borderColor: validFields.phone ? "" : "red" }}
                  />
                </div>

                <div>
                  <label htmlFor="email" className="label-style">
                    Email:
                  </label>
                  <input
                    id="email"
                    type="text"
                    className="input-style rounded"
                    value={customerInfo.email}
                    onChange={handleInputChange}
                    style={{ borderColor: validFields.phone ? "" : "red" }}
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
                          (p) => p.full_name === e.target.value
                        );

                        setSelectedProvince(selectedProvince);
                        setCustomerInfo((prev) => ({
                          ...prev,
                          province: selectedProvince
                            ? selectedProvince.full_name
                            : "",
                          district: "",
                          ward: "",
                        }));
                      }}
                      value={customerInfo.province || ""}
                      style={{
                        borderColor: validFields.province ? "" : "red",
                        marginBottom: 0,
                        backgroundColor: "#fff",
                      }}
                    >
                      <option value="">Chọn tỉnh thành phố</option>
                      {provinces.map((province) => (
                        <option key={province.id} value={province.full_name}>
                          {province.full_name}
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
                          (d) => d.full_name === e.target.value
                        );

                        setSelectedDistrict(selectedDistrict);
                        setCustomerInfo((prev) => ({
                          ...prev,
                          district: selectedDistrict
                            ? selectedDistrict.full_name
                            : "",
                          ward: "",
                        }));
                      }}
                      value={customerInfo.district || ""}
                      style={{
                        borderColor: validFields.district ? "" : "red",
                        marginBottom: 0,
                        backgroundColor: "#fff",
                      }}
                    >
                      <option value="">Chọn quận huyện</option>
                      {districts.map((district) => (
                        <option key={district.id} value={district.full_name}>
                          {district.full_name}
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
                          (w) => w.full_name === e.target.value
                        );

                        setCustomerInfo((prev) => ({
                          ...prev,
                          ward: selectedWard ? selectedWard.full_name : "",
                        }));
                      }}
                      value={customerInfo.ward || ""}
                      style={{
                        borderColor: validFields.ward ? "" : "red",
                        marginBottom: 0,
                        backgroundColor: "#fff",
                      }}
                    >
                      <option value="">Chọn phường xã</option>
                      {wards.map((ward) => (
                        <option key={ward.id} value={ward.full_name}>
                          {ward.full_name}
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
                    style={{ borderColor: validFields.street ? "" : "red" }}
                    id="street"
                    type="text"
                    className="input-style rounded"
                    value={customerInfo.street}
                    onChange={handleInputChange}
                  />
                </div>
                <div>
                  <label htmlFor="note" className="label-style">
                    Ghi chú:
                  </label>
                  <br />
                  <textarea
                    id="note"
                    className=" rounded"
                    value={customerInfo.note}
                    onChange={handleInputChange}
                  />
                </div>
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
                  backgroundColor: "#fff",
                }}
              >
                <div className="d-flex flex-column gap-3">
                  {orderItems.map((item) => (
                    <div
                      key={item.variantKey}
                      className="d-flex align-items-center gap-2 my-3"
                    >
                      <span style={{ width: "15%" }}>
                        <img
                          src={item.color.images}
                          alt="ảnh sản phẩm"
                          style={{ height: 65 }}
                        />
                      </span>
                      <span
                        style={{ width: "60%" }}
                        className="d-flex flex-column gap-1 "
                      >
                        <span className="text-start fw-semibold">
                          {item.main.name}
                        </span>
                        <span
                          className="opacity-75 flex-wrap d-flex flex-column"
                          style={{
                            whiteSpace: "normal",
                            wordBreak: "break-word",
                          }}
                        >
                          <span>Màu: {item.color.color}</span>
                          <span>Dung lượng: {item.storage}</span>
                        </span>
                      </span>
                      <span style={{ width: "5%" }} className="text-center">
                        x {item.quantity}
                      </span>
                      <span style={{ width: "20%" }} className="text-end">
                        {formatCurrency(
                          item?.color.sale
                            ? item?.color.sale
                            : item?.color.price * item.quantity
                        )}
                      </span>
                    </div>
                  ))}
                </div>

                <div className="position-relative">
                  {isSuccessDiscount !== 1 ? (
                    <>
                      <label htmlFor="discountCode" className="fw-semibold">
                        <BiSolidDiscount size={24} className="text-danger" />{" "}
                        Nhập mã giảm giá
                      </label>
                      <input
                        id="discountCode"
                        type="text"
                        value={discountCode}
                        onChange={(e) => setDiscountCode(e.target.value)}
                        style={{ outline: "none", boxShadow: "none" }}
                      />
                      <button
                        onClick={handleDiscount}
                        style={{
                          position: "absolute",
                          right: "0px",
                          top: "64%",
                          transform: "translateY(-50%)",
                          padding: "10px 10px",
                          border: "none",
                          borderRadius: "0 0.25rem 0.25rem 0",
                          outline: "none",
                          boxShadow: "none",
                        }}
                      >
                        Áp dụng
                      </button>
                    </>
                  ) : (
                    <span
                      className={`applyDiscountSuccess defaultDiscount`}
                      style={{
                        display: "flex",
                        alignItems: "center", // Canh giữa theo chiều dọc
                        justifyContent: "center", // Canh giữa theo chiều ngang
                        height: "50px", // Chiều cao giống với input để thay thế
                      }}
                    >
                      <FaCheckDouble size={24} /> Áp dụng mã thành công
                    </span>
                  )}
                </div>

                {/* Thẻ span hiển thị lỗi được đặt bên ngoài div */}
                {isSuccessDiscount !== 0 && isSuccessDiscount !== 1 && (
                  <span className="applyDiscountFail defaultDiscount">
                    Có lỗi xảy ra
                    <MdOutlineSmsFailed size={24} />
                  </span>
                )}

                <div className="d-flex flex-column gap-3">
                  <div className="d-flex justify-content-between border-bottom border-secondary py-2">
                    <span className="fw-semibold">Giá: </span>
                    <span>{formatCurrency(getCartTotal())}</span>
                  </div>
                  <div className="d-flex justify-content-between border-bottom border-secondary py-2">
                    <span className="fw-semibold">Phí vận chuyển: </span>
                    <span></span>
                  </div>
                  <div className="d-flex justify-content-between border-bottom border-secondary py-2">
                    <span className="fw-semibold">Giá giảm: </span>
                    <span></span>
                  </div>
                  <div className="d-flex justify-content-between border-bottom border-secondary py-2">
                    <span className="fw-semibold">Tổng: </span>
                    <span
                      className="text-danger fw-bold"
                      style={{ fontSize: 20 }}
                    >
                      {formatCurrency(finalPrice)}
                    </span>
                  </div>
                  <div>
                    <span className="d-flex justify-content-between align-items-center">
                      <span className="fw-semibold">
                        <input
                          type="radio"
                          style={{ marginRight: 20 }}
                          name="paymentMethod"
                          value={1}
                          checked={paymentMethod === 1}
                          onChange={handleChangePaymentMethod}
                        />
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
                        <input
                          type="radio"
                          style={{ marginRight: 20 }}
                          name="paymentMethod"
                          value={2}
                          checked={paymentMethod === 2}
                          onChange={handleChangePaymentMethod}
                        />
                        thanh toán khi nhận hàng (COD)
                      </span>
                      <span className="d-flex justify-content-between">
                        <PiHandPalm size={24} />
                      </span>
                    </span>
                  </div>
                </div>

                <div>
                  <span
                    onClick={excutePayment}
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
