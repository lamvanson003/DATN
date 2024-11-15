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
      {/* <footer
        id="footer"
        className="mt-5 "
        style={{
          backgroundColor: "gray",
        }}
      >
        <div className="container mb-0">
          <div className="row pt-3 justify-content-between">
            <div className="col-lg-3 col-sm-12  col-md-5 ft-left border-right">
              <div className="ft-logo">
                <img alt="" src={logo} />
              </div>
              <div className="info-made d-flex flex-column">
                <h4>Thông tin liên hệ</h4>
                <div className="info-ct">
                  <h5 className="info-ft-ct">
                    ⛪Địa chỉ: 18/4 Mỹ Huề ,Trung Chánh ,Hóc Môn
                  </h5>
                  <h5 className="info-ft-ct">
                    Email : phamthetoan.aloa.vn@gmail.com
                  </h5>
                  <h5 className="info-ft-ct">
                    Fanpage chính thức: <a href="">CLOUDLAB</a>
                  </h5>
                  <h5 className="info-ft-ct">
                    ☎️ Hotline Hỗ Trợ: 0909.300.746 - 0909.45.0001
                  </h5>
                </div>
              </div>
            </div>
            <div className="col-lg-9 col-sm-12 col-md-7 ">
              <div className="container">
                <div className="row">
                  <div className="col-lg-3 col-sm-4">
                    <div className="gioithieu">
                      <h4>Hỗ Trợ Khách Hàng</h4>
                      <div className="list-thongtin">
                        <li>
                          <a href="" className="text-decoration-none">
                            Chế độ bảo hành
                          </a>
                        </li>
                        <li>
                          <a href="" className="text-decoration-none">
                            Chính sách đổi hàng
                          </a>
                        </li>
                        <li>
                          <a href="" className="text-decoration-none">
                            Bảo mật thông tin
                          </a>
                        </li>
                        <li>
                          <a href="" className="text-decoration-none">
                            Chính sách giao nhận
                          </a>
                        </li>
                      </div>
                    </div>
                  </div>
                  <div className="col-lg-3 col-sm-3">
                    <div className="gioithieu">
                      <h4>Chính sách</h4>
                      <div className="list-thongtin">
                        <li>
                          <a href="" className="text-decoration-none">
                            Chế độ bảo hành
                          </a>
                        </li>
                        <li>
                          <a href="" className="text-decoration-none">
                            Chính sách đổi hàng
                          </a>
                        </li>
                        <li>
                          <a href="" className="text-decoration-none">
                            Bảo mật thông tin
                          </a>
                        </li>
                        <li>
                          <a href="" className="text-decoration-none">
                            Chính sách giao nhận
                          </a>
                        </li>
                      </div>
                    </div>
                  </div>
                  <div className="col-lg-6 col-sm-5">
                    <div className="gioithieu">
                      <h4>Chứng nhận</h4>
                      <div className="list-thongtin">
                        <p>
                          Số ĐKKD: 41N8041309 cấp ngày 17/8/2018. Nơi cấp Ủy Ban
                          Nhân Dân Quận Tân Bình. Hộ Kinh Doanh: KINGSHOES.
                          Hotline: 0909.300.746
                        </p>
                        <li>
                          <img
                            alt=""
                            src={congnhan2}
                            style={{ backgroundImage: "#848eff" }}
                          />
                        </li>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-lg-12">
              <div className="coppyright">© Coppyright CLOUDLAB</div>
            </div>
          </div>
        </div>
      </footer> */}

<>
  {/* Begin Footer Area */}
  <div className="footer">
    {/* Begin Footer Static Top Area */}
    <div className="footer-static-top footer-static-top-3 pt-xs-50 pb-xs-10">
      <div className="container">
        {/* Begin Footer Shipping Area */}
        <div className="footer-shipping pb-xs-0">
          <div className="row">
            {/* Begin Li's Shipping Inner Box Area */}
            <div className="col-lg-3 col-md-3 col-sm-6 pb-xs-45">
              <div className="li-shipping-inner-box">
                <div className="shipping-icon">
                  <img src={shipingicon1} alt="Shipping Icon" />
                </div>
                <div className="shipping-text">
                  <h2>Giao hàng miễn phí
                  </h2>
                  <p>Và trả lại miễn phí. Xem thanh toán để biết ngày giao hàng.</p>
                </div>
              </div>
            </div>
            {/* Li's Shipping Inner Box Area End Here */}
            {/* Begin Li's Shipping Inner Box Area */}
            <div className="col-lg-3 col-md-3 col-sm-6 pb-xs-45">
              <div className="li-shipping-inner-box">
                <div className="shipping-icon">
                  <img src={shipingicon2} alt="Shipping Icon" />
                </div>
                <div className="shipping-text">
                  <h2>Thanh toán an toàn</h2>
                  <p>
                  Thanh toán bằng phương thức thanh toán phổ biến và an toàn nhất thế giới
                  </p>
                </div>
              </div>
            </div>
            {/* Li's Shipping Inner Box Area End Here */}
            {/* Begin Li's Shipping Inner Box Area */}
            <div className="col-lg-3 col-md-3 col-sm-6 pb-xs-45">
              <div className="li-shipping-inner-box">
                <div className="shipping-icon">
                  <img src={shipingicon3} alt="Shipping Icon" />
                </div>
                <div className="shipping-text">
                  <h2>Mua sắm với sự tự tin</h2>
                  <p>
                  Bảo vệ người mua của chúng tôi bao gồm việc mua hàng của bạn từ nhấp chuột đến
                  vận chuyển.
                  </p>
                </div>
              </div>
            </div>
            {/* Li's Shipping Inner Box Area End Here */}
            {/* Begin Li's Shipping Inner Box Area */}
            <div className="col-lg-3 col-md-3 col-sm-6">
              <div className="li-shipping-inner-box last-child">
                <div className="shipping-icon">
                  <img src={shipingicon4} alt="Shipping Icon" />
                </div>
                <div className="shipping-text">
                  <h2>Trung tâm trợ giúp 24/7</h2>
                  <p>Bạn có câu hỏi? Gọi cho chúng tôi .</p>
                </div>
              </div>
            </div>
            {/* Li's Shipping Inner Box Area End Here */}
          </div>
        </div>
        {/* Footer Shipping Area End Here */}
      </div>
    </div>
    {/* Footer Static Top Area End Here */}
    {/* Begin Footer Static Middle Area */}
    <div className="footer-static-middle">
      <div className="container">
        <div className="footer-logo-wrap pt-50 pb-35">
          <div className="row">
            {/* Begin Footer Logo Area */}
            <div className="col-lg-4 col-md-6">
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

    </>
  );
};

export default Footer;
