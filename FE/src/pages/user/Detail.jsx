import React, { useState } from "react";
import mainImg1 from "../../assets/images/k1.jpeg";
import mainImg2 from "../../assets/images/k2.jpeg";
import mainImg3 from "../../assets/images/k3.jpeg";
import varImg1 from "../../assets/images/iphone1.jpg";
import varImg2 from "../../assets/images/iphone2.jpg";
import "./css/Detail.css";
const Detail = () => {
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
    </div>
  );
};

export default Detail;
