import React from "react";
import '../user/css/orderdetai.css'

const OrderDetail = () => {
  return <div className="container">
  <div className="order-status">
    <div className="line"></div>
    <div>
      <div className="circle">
        <i className="fas fa-file-alt"></i>
      </div>
      <p>
        Đơn Hàng Đã Đặt
        <br />
      </p>
    </div>
    <div>
      <div className="circle">
        <i className="fas fa-check-circle"></i>
      </div>
      <p>
        Đã Xác Nhận Thông Tin Thanh Toán
        <br />
      </p>
    </div>
    <div>
      <div className="circle">
        <i className="fas fa-truck"></i>
      </div>
      <p>
        Đã Giao Cho ĐVVC
        <br />
      </p>
    </div>
    <div>
      <div className="circle">
        <i className="fas fa-box-open"></i>
      </div>
      <p>
        Đã Nhận Được Hàng
        <br />
      </p>
    </div>
    <div>
      <div className="circle">
        <i className="fas fa-star"></i>
      </div>
      <p>
        Đơn Hàng Đã Hoàn Thành
        <br />
      </p>
    </div>
  </div>
  <div className="order-summary">
    <p>Cảm ơn bạn đã mua sắm tại Cloud Lab!</p>
  </div>
  <div className="d-flex justify-content-between mb-3">
    <button className="btn btn-primary">Mua Lại</button>
    <button className="btn btn-secondary">Liên Hệ Người Bán</button>
  </div>
  <div className="order-items">
    <div className="order-item">
      <img
        alt="Image of 3 rolls (1kg) biodegradable trash bags, medium size, black color"
        height={60}
        src="https://storage.googleapis.com/a1aa/image/NQuQD6ckXl4bDZ2uF3o5kSHYqX7YEV7N0DlCKuJoTkWpnI6E.jpg"
        width={60}
      />
      <div className="order-item-details">
        <p>
          3 cuộn (1kg) túi đựng rác sinh học tự phân hủy cỡ nhỏ, trung, đại loại
          màu và đen
          <br />
          <small>Phân loại hàng: ĐEN,ĐẠI x2</small>
        </p>
        <span className="badge bg-success">Trả hàng miễn phí 15 ngày</span>
      </div>
      <div className="order-item-price">
        <p>
          <del>₫70.000</del>
          <span className="text-danger">₫53.400</span>
        </p>
      </div>
    </div>
    <div className="order-item">
      <img
        alt="Image of 3 rolls (1kg) biodegradable trash bags, large size, black color"
        height={60}
        src="https://storage.googleapis.com/a1aa/image/xzF9G4WI7w6HBJHbkdt3KRQsdpFn9e4yYhRAvKNYMyhRPR0JA.jpg"
        width={60}
      />
      <div className="order-item-details">
        <p>
          3 cuộn (1kg) túi đựng rác sinh học tự phân hủy cỡ nhỏ, trung, đại loại
          màu và đen
          <br />
          <small>Phân loại hàng: ĐEN,CỰC ĐẠI (2 CUỘN)</small>
        </p>
        <span className="badge bg-success">Trả hàng miễn phí 15 ngày</span>
      </div>
      <div className="order-item-price">
        <p>
          <del>₫70.000</del>
          <span className="text-danger">₫58.200</span>
        </p>
      </div>
    </div>
    <div className="order-item">
      <img
        alt="Image of 6 laundry detergent tablets"
        height={60}
        src="https://storage.googleapis.com/a1aa/image/GGTn7dNIu37mE5gOVlremeuVuLZD4tFOIivmAGnBfI2M9ERnA.jpg"
        width={60}
      />
      <div className="order-item-details">
        <p>
          <span className="badge bg-warning text-dark">Quà Tặng</span>
          Hộp 6 viên tẩy lồng, viên vệ sinh máy giặt siêu sạch
          <br />
          <small>Phân loại hàng: HỘP 6 VIÊN GIẶT x1</small>
        </p>
      </div>
      <div className="order-item-price">
        <p>
          <del>₫70.000</del>
          <span className="text-danger">₫0</span>
        </p>
      </div>
    </div>
  </div>
  <div className="order-total">
    <p>
      Tổng tiền hàng:
      <span className="float-end">₫111.600</span>
    </p>
    <p>
      Phí vận chuyển:
      <span className="float-end">₫28.400</span>
    </p>
    <p>
      Giảm giá phí vận chuyển:
      <span className="float-end">-₫28.400</span>
    </p>
    <p className="total-amount">
      Thành tiền:
      <span className="float-end">₫111.600</span>
    </p>
  </div>
  
  <div className="text-end">
    <p>hình thức thanh toán :  Thanh toán khi nhận hàng</p>
  </div>
</div>
;
};

export default OrderDetail;
