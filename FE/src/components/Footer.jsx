import React from "react";
import "./css/Footer.css";
import logo from "../assets/images/iHome/logo.svg";
import congnhan2 from "../assets/images/iHome/congnhan2.jpg";
import shipingicon1 from "../assets/shipping-icon/1.png";
import shipingicon2 from "../assets/shipping-icon/2.png";
import shipingicon3 from "../assets/shipping-icon/3.png";
import shipingicon4 from "../assets/shipping-icon/4.png";

const Footer = () => {
  return (
   
<>
  {/* Begin Footer Area */}
  <div className="footer">
  <div className="top-footer">
  <div className="container container-1265 px-sm-0">
    <div className="top-footer-wrap">
      <div className="row row-cols-2 row-cols-sm-2 row-cols-md-4 gx-0 gx-sm-0 gx-md-5">
        <div className="policy-item">
          <a href="/news/chinh-sach-doi-hang-bao-hanh-105398&id=109820">
            <img
              src="https://pos.nvncdn.com/d0f3ca-7136/bn/20230914_6bU8irTd.png"
              alt="Đổi hàng 30 ngày"
            />
            <span>
              <span className="policy-title">Đổi hàng 30 ngày</span>
              <span className="policy-desc">
                Thời gian đổi sản phẩm lên đến 30 ngày
              </span>
            </span>
          </a>
        </div>
        <div className="policy-item">
          <a href="/news/chinh-sach-doi-hang-bao-hanh-105398&id=109820">
            <img
              src="https://pos.nvncdn.com/d0f3ca-7136/bn/20230914_OHrlewqe.png"
              alt="Bảo hành 90 ngày"
            />
            <span>
              <span className="policy-title">Bảo hành 90 ngày</span>
              <span className="policy-desc">
                Hỗ trợ bảo hành miễn phí lên đến 90 ngày
              </span>
            </span>
          </a>
        </div>
        <div className="policy-item">
          <a href="/news/chinh-sach-hoan-tien-100693&id=71808">
            <img
              src="https://pos.nvncdn.com/d0f3ca-7136/bn/20230914_yUil5un4.png"
              alt="5 ngày hoàn tiền"
            />
            <span>
              <span className="policy-title">5 ngày hoàn tiền</span>
              <span className="policy-desc">
                Thời gian hoàn tiền không lý do lên đến 5 ngày
              </span>
            </span>
          </a>
        </div>
        <div className="policy-item">
          <a href="/news/chinh-sach-thanh-vien-99832&id=65278">
            <img
              src="https://pos.nvncdn.com/d0f3ca-7136/bn/20231002_0fyEtU6G.png"
              alt="Ưu đãi lên đến 15%"
            />
            <span>
              <span className="policy-title">Ưu đãi lên đến 15%</span>
              <span className="policy-desc">
                Ưu đãi cho Vip Member lên đến 15%
              </span>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

    {/* Begin Footer Static Middle Area */}
    <div className="footer-static-middle">
      <div className="container">
        <div className="footer-logo-wrap pt-50 pb-35">
          <div className="row text-left">
            {/* Begin Footer Logo Area */}
            <div className="col-lg-4 col-md-6 ">
              <div className="footer-logo">
                <img src={logo} alt="Footer Logo" />
                <p className="info">
                  
                  Luôn cung cấp và đem lại dịch vụ tốt nhất cho bạn trải nghiệm
                  khi đến với cửa hàng cúng tôi kèm theo các ưu đãi hấp dẫn .
                </p>
              </div>
              <ul className="des">
                <li>
                  <span>Địa chỉ: </span>
                  6688Princess Road, London, Greater London BAS 23JK, UK
                </li>
                <li>
                  <span>SĐT: </span>
                  <a href="#">(+123) 123 321 345</a>
                </li>
                <li>
                  <span>Email: </span>
                  <a href="mailto://info@yourdomain.com">info@yourdomain.com</a>
                </li>
              </ul>
            </div>
            {/* Footer Logo Area End Here */}
            {/* Begin Footer Block Area */}
            <div className="col-lg-2 col-md-3 col-sm-6">
              <div className="footer-block">
                <h3 className="footer-block-title">Sản phẩm</h3>
                <ul>
                  <li>
                    <a href="#">Giảm giá</a>
                  </li>
                  <li>
                    <a href="#">Sản phẩm mới</a>
                  </li>
                  <li>
                    <a href="#">Sản phẩm bán chạy </a>
                  </li>
                  <li>
                    <a href="#">Liên hệ với chúng tôi</a>
                  </li>
                </ul>
              </div>
            </div>
            {/* Footer Block Area End Here */}
            {/* Begin Footer Block Area */}
            <div className="col-lg-2 col-md-3 col-sm-6">
              <div className="footer-block">
                <h3 className="footer-block-title">Công ty chúng tôi</h3>
                <ul>
                  <li>
                    <a href="#">Vận chuyển</a>
                  </li>
                  <li>
                    <a href="#">Thông báo pháp lý</a>
                  </li>
                  <li>
                    <a href="#">Về chúng tôi </a>
                  </li>
                  <li>
                    <a href="#">Bảo hành</a>
                  </li>
                </ul>
              </div>
            </div>
            {/* Footer Block Area End Here */}
            {/* Begin Footer Block Area */}
            <div className="col-lg-4">
              <div className="footer-block">
                <h3 className="footer-block-title">Theo dõi chúng tôi</h3>
                <ul className="social-link">
                  <li className="twitter">
                    <a
                      href="https://twitter.com/"
                      data-toggle="tooltip"
                      target="_blank"
                      title="Twitter"
                    >
                      <i className="fa fa-twitter" />
                    </a>
                  </li>
                  <li className="rss">
                    <a
                      href="https://rss.com/"
                      data-toggle="tooltip"
                      target="_blank"
                      title="RSS"
                    >
                      <i className="fa fa-rss" />
                    </a>
                  </li>
                  <li className="google-plus">
                    <a
                      href="https://www.plus.google.com/discover"
                      data-toggle="tooltip"
                      target="_blank"
                      title="Google +"
                    >
                      <i className="fa fa-google-plus" />
                    </a>
                  </li>
                  <li className="facebook">
                    <a
                      href="https://www.facebook.com/"
                      data-toggle="tooltip"
                      target="_blank"
                      title="Facebook"
                    >
                      <i className="fa fa-facebook" />
                    </a>
                  </li>
                  <li className="youtube">
                    <a
                      href="https://www.youtube.com/"
                      data-toggle="tooltip"
                      target="_blank"
                      title="Youtube"
                    >
                      <i className="fa fa-youtube" />
                    </a>
                  </li>
                  <li className="instagram">
                    <a
                      href="https://www.instagram.com/"
                      data-toggle="tooltip"
                      target="_blank"
                      title="Instagram"
                    >
                      <i className="fa fa-instagram" />
                    </a>
                  </li>
                </ul>
              </div>
              {/* Begin Footer Newsletter Area */}
              <div className="footer-newsletter">
                <h4>Đăng ký nhận thông báo </h4>
                <form
                  action="#"
                  method="post"
                  id="mc-embedded-subscribe-form"
                  name="mc-embedded-subscribe-form"
                  className="footer-subscribe-form validate"
                  target="_blank"
                  noValidate=""
                >
                  <div id="mc_embed_signup_scroll">
                    <div
                      id="mc-form"
                      className="mc-form subscribe-form form-group"
                    >
                      <input
                        id="mc-email"
                        type="email"
                        autoComplete="off"
                        placeholder="Nhập Email"
                      />
                      <button className="btn" id="mc-submit">
                        Đăng ký
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              {/* Footer Newsletter Area End Here */}
            </div>
            {/* Footer Block Area End Here */}
          </div>
        </div>
      </div>
    </div>
    {/* Footer Static Middle Area End Here */}
    {/* Begin Footer Static Bottom Area */}
    <div className="footer-static-bottom">
      <div className="container">
        <div className="row">
          <div className="col-lg-12">
            {/* Begin Footer Links Area */}
          
            {/* Footer Links Area End Here */}
            {/* Begin Footer Payment Area */}
            <div className="payment text-center">
              <a href="#">
                <img src="" alt="" />
              </a>
            </div>
            {/* Footer Payment Area End Here */}
            {/* Begin Copyright Area */}
            <div className="copyright text-center pt-30 pb-50">
              <span>
                <a target="_blank" href="" style={{ textDecoration: 'none' }}>
               © Coppyright CLOUDLAB
                </a>
              </span>
            </div>
            {/* Copyright Area End Here */}
              {/* Begin Footer Payment Area */}
              <div className="payment text-center" >
              <a href="#">
                <img src="" alt="" />
              </a>
            </div>
            {/* Footer Payment Area End Here */}
          </div>
        </div>
      </div>
    </div>
    {/* Footer Static Bottom Area End Here */}
  </div>
  {/* Footer Area End Here */}
 
</>
  );
};

export default Footer;
