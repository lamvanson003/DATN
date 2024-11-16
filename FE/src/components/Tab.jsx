import React, { useState } from "react";
import InfoPro from "./InfoPro";
const Tab = ({ detailData }) => {
  const [activeTab, setActiveTab] = useState("tab1");

  const handleTabClick = (tab, event) => {
    event.preventDefault(); // Ngăn chặn hành vi mặc định
    setActiveTab(tab);
  };

  return (
    <div>
      <ul className="nav nav-pills">
        <li className="nav-item">
          <a
            className={`nav-link ${activeTab === "tab1" ? "active" : ""}`}
            onClick={(event) => handleTabClick("tab1", event)} // Truyền event vào
            href="#"
          >
            Thông số kỹ thuật
          </a>
        </li>
        <li className="nav-item">
          <a
            className={`nav-link ${activeTab === "tab2" ? "active" : ""}`}
            onClick={(event) => handleTabClick("tab2", event)} // Truyền event vào
            href="#"
          >
            Mô tả về sản phẩm
          </a>
        </li>
      </ul>

      <div className="tab-content" style={{ padding: 10 }}>
        <div className={`tab-pane fade ${activeTab === "tab1" ? "show active" : ""}`}>
          <InfoPro />
        </div>
        <div className={`tab-pane fade ${   activeTab === "tab2" ? "show active" : "" }`}>
          <div className="container ">
            <h5 className="title_desc">
              Đặc Điểm Nổi Bật Của {detailData?.name}
            </h5>
            <ul className="features-list">
              <li>
                Hiệu năng vượt trội - Chip Apple A15 Bionic mạnh mẽ, hỗ trợ mạng
                5G tốc độ cao
              </li>
              <li>
                Không gian hiển thị sống động - Màn hình 6.1’’ Super Retina XDR
                độ sáng cao, sắc nét
              </li>
              <li>
                Trải nghiệm điện ảnh đỉnh cao - Camera kép 12MP, hỗ trợ ổn định
                hình ảnh quang học
              </li>
              <li>
                Tối ưu điện năng - Sạc nhanh 20 W, đầy 50% pin trong khoảng 30
                phút
              </li>
            </ul>
            <div className="review-section">
              <h2 className="review-title">Tổng quát</h2>
              {detailData?.description}
            </div>
            {/* <div className="see-more">
              <a className="see-more-link" href="#">
                Xem thêm
              </a>
            </div> */}
          </div>
        </div>
      </div>
    </div>
  );
};

export default Tab;
