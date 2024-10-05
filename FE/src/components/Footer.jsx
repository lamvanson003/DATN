import React from "react";
import "./css/Footer.css";
import logo from "../assets/images/iHome/logo.svg";
import congnhan2 from "../assets/images/iHome/congnhan2.jpg";
const Footer = () => {
  return (
    <>
      <footer
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
      </footer>
    </>
  );
};

export default Footer;
