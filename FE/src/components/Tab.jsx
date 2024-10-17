import React, { useState } from "react";
import InfoPro from "./InfoPro";
const Tab = ({ proData }) => {
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
            Bài viết đánh giá
          </a>
        </li>
      </ul>

      <div className="tab-content mt-4">
        <div
          className={`tab-pane fade ${
            activeTab === "tab1" ? "show active" : ""
          }`}
        >
          <InfoPro />
        </div>
        <div
          className={`tab-pane fade ${
            activeTab === "tab2" ? "show active" : ""
          }`}
        >
          <div className="container">
            <h1 className="title_desc">Đặc Điểm Nổi Bật Của {proData?.name}</h1>
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
              <h2 className="review-title">
                Đánh giá iPhone 13 - Flagship được mong chờ năm 2021
              </h2>
              <p>
                Cuối năm 2020, bộ 4 iPhone 12 đã được ra mắt với nhiều cải tiến.
                Sau đó, mọi sự quan tâm lại đổ dồn vào sản phẩm tiếp theo -
                iPhone 13. Vậy iPhone 13 sẽ có những gì nổi bật, hãy tìm hiểu
                ngay sau đây nhé!
              </p>
              <h3 className="review-subtitle">Thiết kế với nhiều đột phá</h3>
              <p>
                Về kích thước, iPhone 13 sẽ có 4 phiên bản khác nhau và kích
                thước không đổi so với series iPhone 12 hiện tại. Nếu iPhone 12
                có sự thay đổi trong thiết kế với cạnh viền bo tròn (Thiết kế
                được duy trì từ thời iPhone 6 đến iPhone 11 Pro Max) sang thiết
                kế vuông vắn (và lần đầu tiên trên iPhone 4 đến iPhone 5S, SE).
              </p>
              <p className="p_details">
                Điện thoại iPhone 13 vẫn được duy trì tốt mặt thiết kế tuyệt
                vời. Máy vẫn giữ phần khung viền thép, một số phiên bản khung
                nhôm cùng mặt lưng kính. Tuy nhiên năm ngoái, Apple cũng sẽ cho
                ra mắt 4 phiên bản là iPhone 13, 13 mini, 13 Pro và 13 Pro Max.
              </p>
            </div>
            <div className="see-more">
              <a className="see-more-link" href="#">
                Xem thêm
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Tab;
