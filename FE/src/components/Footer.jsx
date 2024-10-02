import React from "react";
import "./css/Footer.css";
const Footer = () => {
  return (
    <>
      <div className="container footer">
        <div className="row ">
          <div className="col-md-4 ">
            <img
              alt="CloudAB logo"
              className="mb-3"
              height="50"
              src="/src/assets/images/logo.svg"
            />
            <p>
              <i className="fas fa-map-marker-alt"></i>
              Địa chỉ: 5171 W Campbell Ave
              <br />
              undefined Kent, Utah 53127 Hoa Kỳ
            </p>
            <p>
              <i className="fas fa-phone-alt"></i>
              SĐT:(+84) 012346678
            </p>
            <p>
              <i className="fas fa-envelope"></i>
              Email: cloudLAB@gmail.com
            </p>
            <p>
              <i className="fas fa-clock"></i>
              Giờ mở cửa: 10:00 - 18:00, Mon - Sat
            </p>
            <p>Follow Us</p>
            <div className="social-icons">
              <a href="#">
                <i className="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i className="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i className="fab fa-instagram"></i>
              </a>
              <a href="#">
                <i className="fab fa-pinterest"></i>
              </a>
              <a href="#">
                <i className="fab fa-youtube"></i>
              </a>
            </div>
            <p>Giảm giá lên đến 15% cho lần đăng ký đầu tiên của bạn</p>
          </div>
          <div className="col-md-4">
            <h5>Tài khoản</h5>
            <p>
              <a href="#">Đăng nhập</a>
            </p>
            <p>
              <a href="#">Xem giỏ hàng</a>
            </p>
            <p>
              <a href="#">Danh sách mong muốn của tôi</a>
            </p>
            <p>
              <a href="#">Theo dõi đơn hàng của tôi</a>
            </p>
            <p>
              <a href="#">Vé trợ giúp</a>
            </p>
            <p>
              <a href="#">Chi tiết giao hàng</a>
            </p>
            <p>
              <a href="#">So sánh sản phẩm</a>
            </p>
          </div>
          <div className="col-md-4">
            <h5>Thông tin chính sách</h5>
            <p>
              <a href="#">Mua hàng và thanh toán Online</a>
            </p>
            <p>
              <a href="#">Mua hàng trả góp Online</a>
            </p>
            <p>
              <a href="#">Mua hàng trả góp bằng thẻ tín dụng</a>
            </p>
            <p>
              <a href="#">Chính sách giao hàng</a>
            </p>
            <p>
              <a href="#">Tra điểm Smember</a>
            </p>
            <p>
              <a href="#">Xem ưu đãi Smember</a>
            </p>
            <p>
              <a href="#">Tra thông tin bảo hành</a>
            </p>
            <p>
              <a href="#">Tra cứu hoá đơn điện tử</a>
            </p>
            <p>
              <a href="#">Thông tin hoá đơn mua hàng</a>
            </p>
            <p>
              <a href="#">Trung tâm bảo hành chính hãng</a>
            </p>
            <p>
              <a href="#">Quy định về việc sao lưu dữ liệu</a>
            </p>
            <p>
              <a href="#">Chính sách khui hộp sản phẩm Apple</a>
            </p>
            <p>Phương thức thanh toán</p>
            <div className="payment-methods">
              <img alt="Visa logo" src="/src/assets/images/logovisa.png" />
              <img
                alt="MasterCard logo"
                height="30"
                src="/src/assets/images/logomastercard.png"
                width="50"
              />
              <img
                alt="Maestro logo"
                height="30"
                src="/src/assets/images/logovcb.png"
                width="50"
              />
              <img
                alt="American Express logo"
                height="30"
                src="/src/assets/images/ATM.png"
                width="40"
              />
            </div>
          </div>
        </div>
        <div className="bottom-text text-center">
          <p>© 2024, Clound Lab</p>
        </div>
      </div>
    </>
  );
};

export default Footer;
