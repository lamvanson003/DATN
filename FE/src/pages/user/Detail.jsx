import React, { useState } from "react";
import mainImg1 from "../../assets/images/k1.jpeg";
import mainImg2 from "../../assets/images/k2.jpeg";
import mainImg3 from "../../assets/images/k3.jpeg";
import varImg1 from "../../assets/images/iphone1.jpg";
import varImg2 from "../../assets/images/iphone2.jpg";
import "./css/Detail.css";
import { useParams } from "react-router-dom";
const Detail = () => {
  const pid = useParams();
  // State để lưu hình ảnh chính, dung lượng và màu sắc đang được chọn
  const [mainImage, setMainImage] = useState(mainImg1);
  const [activeStorage, setActiveStorage] = useState("64GB");
  const [activeColor, setActiveColor] = useState(varImg1);

  // Hàm thay đổi hình ảnh chính
  const handleImageClick = (img) => {
    setMainImage(img);
  };

  // Hàm chọn dung lượng
  const handleStorageClick = (storage) => {
    setActiveStorage(storage);
  };

  // Hàm chọn màu sắc
  const handleColorClick = (color) => {
    setActiveColor(color);
  };

  return (
    <div className="container mt-5 mb-5">
      <section className="pt-3 mb-5" id="Breadcrumb">
        <div className="container p-3 bg-Breadcrumb">
          <nav aria-label="breadcrumb">
            <ol className="breadcrumb mb-0">
              <li className="breadcrumb-item">
                <a href="/">
                  <i className="fa-solid fa-house" /> TRANG CHỦ
                </a>
              </li>
              <li className="breadcrumb-item">
                <a href="/product"> DANH MỤC </a>
              </li>
              <li className="breadcrumb-item">
                <a href="#"> SẢN PHẨM </a>
              </li>
              <li className="breadcrumb-item active"> CHI TIẾT </li>
            </ol>
          </nav>
        </div>
      </section>

      <section id="product_details">
        <div className="container">
          <div className="row">
            <div className="single_pro_image col-lg-6 col-md-5">
              {/* Hình ảnh chính */}
              <img alt="" className="img-fluid" id="MainImg" src={mainImage} />
              <div className="small-img-group d-flex mt-3">
                {/* Danh sách hình ảnh nhỏ */}
                {[mainImg1, mainImg2, mainImg3].map((img, index) => (
                  <div
                    className={`small-img-col me-2 ${
                      mainImage === img ? "active-border" : ""
                    }`}
                    key={index}
                  >
                    <img
                      alt=""
                      className="img-fluid smallimg"
                      src={img}
                      onClick={() => handleImageClick(img)}
                    />
                  </div>
                ))}
                {[mainImg1, mainImg2, mainImg3].map((img, index) => (
                  <div
                    className={`small-img-col me-2 ${
                      mainImage === img ? "active-border" : ""
                    }`}
                    key={index}
                  >
                    <img
                      alt=""
                      className="img-fluid smallimg"
                      src={img}
                      onClick={() => handleImageClick(img)}
                    />
                  </div>
                ))}
              </div>
            </div>
            <div className="col-lg-6 pt-3">
              <div className="product__details__text">
                <div className="product-tag">
                  <div className="bestseller-tag">#Bán chạy</div>
                  <div className="sold-tag">Đã bán: 41</div>
                </div>
                <h1 className="text-uppercase">
                  iPhone 13 128GB | Chính hãng VN/A
                </h1>
                <div className="info-product">
                  <div className="rate-sku">
                    <div className="rate">
                      <i className="bx bxs-star" style={{ color: "#f1c123" }} />
                      <b>5/5</b>
                      <span className="ml-2">(32 Reviews)</span>
                    </div>
                    <div className="sku">
                      <strong>Mã: ABC_xJ</strong>
                    </div>
                    <div className="status">
                      <span className="badge text-bg-success">Còn hàng</span>
                    </div>
                  </div>
                </div>
                <div className="info-product-price mt-2">
                  <h4>Giá:</h4>
                  <div className="sale">25.000.000 đ</div>
                  <div className="price">20.000.000 đ</div>
                </div>
                <div className="short_desc">
                  Máy mới 100% , chính hãng Apple Việt Nam. Clound LAB hiện là
                  đại lý bán lẻ uỷ quyền iPhone hãng VN/A của Apple Việt Nam.
                </div>
                <div className="product-options">
                  {/* Chọn dung lượng */}
                  <div className="option-group">
                    <label htmlFor="storage">Dung lượng</label>
                    <div className="storage-options">
                      {["64GB", "256GB"].map((storage) => (
                        <button
                          key={storage}
                          className={`option-btn ${
                            activeStorage === storage ? "active" : ""
                          }`}
                          onClick={() => handleStorageClick(storage)}
                        >
                          {storage}
                          {activeStorage === storage && (
                            <span className="badgeClick bx bx-check" />
                          )}
                        </button>
                      ))}
                    </div>
                  </div>
                  {/* Chọn màu sắc */}
                  <div className="option-group">
                    <label htmlFor="color">Màu sắc</label>
                    <div className="color-options">
                      {[varImg1, varImg2].map((color, index) => (
                        <button
                          key={index}
                          className={`option-btn ${
                            activeColor === color ? "active" : ""
                          }`}
                          onClick={() => handleColorClick(color)}
                        >
                          <img alt="" src={color} />
                          <span>{index === 0 ? "Đen" : "Tím"}</span>
                          {activeColor === color && (
                            <span className="badgeClick bx bx-check" />
                          )}
                        </button>
                      ))}
                    </div>
                  </div>
                  <div className="option-group">
                    <input defaultValue="1" id="quantity" type="number" />
                  </div>
                  {/* Nút hành động */}
                  <div className="action-buttons">
                    <button className="cart-btn">
                      <i className="bx bx-cart-add" /> Thêm giỏ hàng
                    </button>
                    <button className="buy-btn">
                      <i className="fas fa-shopping-cart" /> Mua ngay
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div>
        <section className="mt-3" id="Description">
          <div className="container">
            <h1 className="title_desc">
              Đặc Điểm Nổi Bật Của iPhone 13 128GB | Chính Hãng VN/A
            </h1>
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
        </section>
        <section id="Comments mt-3">
          <div className="container">
            <div className="reviews">
              <h3>2 Review For Blue Dress For Woman</h3>
              <div className="review">
                <div className="reviewer-info">
                  <img
                    alt="Reviewer 1"
                    className="reviewer-img"
                    src={mainImg1}
                  />
                  <div>
                    <h4>Alea Brooks</h4>
                    <p>March 5, 2018</p>
                    <p>Lorem Ipsum gravida nibh vel velit auctor aliquet...</p>
                  </div>
                </div>
                <div className="rating">
                  <span>★★★★☆</span>
                </div>
              </div>
              <div className="review">
                <div className="reviewer-info">
                  <img
                    alt="Reviewer 2"
                    className="reviewer-img"
                    src={mainImg2}
                  />
                  <div>
                    <h4>Grace Wong</h4>
                    <p>June 17, 2018</p>
                    <p>It is a long established fact that a reader will...</p>
                  </div>
                </div>
                <div className="rating">
                  <span>★★★☆☆</span>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  );
};

export default Detail;
