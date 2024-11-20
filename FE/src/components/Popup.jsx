import React from "react";
import { useNavigate } from "react-router-dom";
import sending from "../assets/images/iHome/sending.png";
import "./css/Popup.css";
const Popup = ({ orderId }) => {
  const navigate = useNavigate();
  const handleNaPro = () => {
    navigate("/product");
  };
  const handleNaInvoice = () => {
    if (orderId) {
      navigate(`/invoice/${orderId}`);
    } else {
      alert("Order ID không tồn tại.");
    }
  };
  const handleNaSeO = () => {
    navigate("/search-order");
  };

  return (
    <div className="custom-modal-overlay">
      <div className="custom-modal">
        <h2>Thông báo đơn hàng</h2>
        <p>Đơn hàng của bạn đã được gửi đi, Vui lòng chờ xác nhận !</p>
        <div className="modal-img-container">
          <img className="modal-img" src={sending} alt="" />
        </div>
        <div className="group-custom-modal-button">
          <span className="custom-modal-button" onClick={handleNaInvoice}>
            chi tiết hóa đơn
          </span>
          <span className="custom-modal-button" onClick={handleNaSeO}>
            Tra cứu hóa đơn
          </span>
          <span className="custom-modal-button" onClick={handleNaPro}>
            Trang sản phẩm
          </span>
        </div>
      </div>
    </div>
  );
};

export default Popup;
