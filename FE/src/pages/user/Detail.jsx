import React, { useState, useEffect, useContext, useRef } from "react";
import { CartContext } from "../../context/Cart";
import mainImg1 from "../../assets/images/k1.jpeg";
import mainImg2 from "../../assets/images/k2.jpeg";
import mainImg3 from "../../assets/images/k3.jpeg";
import mainImg4 from "../../assets/images/k1.jpeg";
import varImg1 from "../../assets/images/iphone1.jpg";
import varImg2 from "../../assets/images/iphone2.jpg";
import "./css/Detail.css";
import { useParams } from "react-router-dom";
const Detail = () => {
  const { addToCart } = useContext(CartContext);
  const { pid } = useParams();
  const ref = useRef();
  const [proDatas, setProDatas] = useState([]);
  useEffect(() => {
    const fetchProData = async () => {
      try {
        const res = await fetch("/data.json");
        const data = await res.json();
        setProDatas(data);
      } catch (err) {
        console.log(err);
      }
    };
    fetchProData();
  }, [pid]);
  useEffect(() => {
    ref.current.scrollIntoView({
      behavior: "smooth",
      block: "end",
      inline: "nearest",
    });
  }, [pid]);
  const proData = proDatas.find((item) => item.id === parseInt(pid));
  const imgList = [mainImg1, mainImg2, mainImg3, mainImg4];
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
    console.log("Active Storage:", storage);
  };

  // Hàm chọn màu sắc
  const handleColorClick = (color) => {
    setActiveColor(color);
    console.log("Active Color:", color);
  };

  return (
    <>
      <div className="container pb-3">
        <section className="px-2 py-3 mb-2" id="Breadcrumb" ref={ref}>
          <div className="container p-3 bg-Breadcrumb mt-5">
            <nav aria-label="breadcrumb">
              <ol className="breadcrumb mb-0">
                <li className="breadcrumb-item">
                  <a href="/">
                    <i className="fa-solid fa-house" />
                    TRANG CHỦ
                  </a>
                </li>
                <li aria-current="page" className="breadcrumb-item">
                  <a href="/product">DANH MỤC</a>
                </li>
                <li aria-current="page" className="breadcrumb-item ">
                  <a href="#">SAN PHAM</a>
                </li>
                <li aria-current="page" className="breadcrumb-item IN">
                  <a href="">CHI TIET</a>
                </li>
                <li aria-current="page" className="breadcrumb-item IN">
                  <a href="">{proData?.name}</a>
                </li>
              </ol>
            </nav>
          </div>
        </section>
        <section id="product_details" className="mt-2">
          <div className="container">
            <div className="row ">
              <div className="single_pro_image col-lg-6 col-md-5">
                <div className="d-flex flex-column align-items-center">
                  <div
                    style={{ width: "100%" }}
                    className="d-flex  justify-content-center"
                  >
                    <img src={mainImage} style={{ width: "60%" }} alt="" />
                  </div>
                  <div className="row">
                    {imgList.map((item, index) => (
                      <div key={index} className="col-sm-3 mt-3">
                        <img
                          src={item}
                          style={{ width: "70%", cursor: "pointer" }}
                          alt=""
                          onClick={() => handleImageClick(item)}
                        />
                      </div>
                    ))}
                  </div>
                </div>
              </div>
              <div className="col-lg-6 pt-3">
                <div className="product__details__text">
                  <div className="product-tag">
                    <div className="bestseller-tag">#Bán chạy</div>
                    <div className="sold-tag">Đã bán: {proData?.sold}</div>
                  </div>
                  <h1 className="text-uppercase">{proData?.name}</h1>
                  <div className="info-product">
                    <div className="rate-sku">
                      <div className="rate">
                        <i
                          className="bx bxs-star"
                          style={{
                            color: "#f1c123",
                          }}
                        />
                        <b>{proData?.rating}</b>
                        <span className="ml-2">({proData?.reviews})</span>
                      </div>
                      <div className="sku">
                        <strong>Mã: {proData?.sku}</strong>
                      </div>
                      <div className="status">
                        <span className="badge text-bg-success">Còn hàng</span>
                      </div>
                    </div>
                  </div>

                  <div className="short_desc">{proData?.description}</div>
                  <div className="product-options">
                    <div className="option-group">
                      <label htmlFor="storage">Dung lượng</label>
                      <div className="storage-options mt-3">
                        {proData?.storage_options?.map((item, index) => (
                          <button
                            key={index}
                            className={`option-btn ${
                              activeStorage === item ? "storage badgeClick" : ""
                            }`}
                            onClick={() => handleStorageClick(item)}
                          >
                            {item}
                            {/* Chỉ hiển thị span badge khi item được chọn */}
                            {activeStorage === item && (
                              <span
                                className="badgeClick bx bx-check"
                                style={{ display: "inline" }}
                              />
                            )}
                          </button>
                        ))}
                      </div>
                    </div>
                    <div className="option-group">
                      <label htmlFor="color">Màu sắc</label>
                      <div className="color-options mt-3">
                        {proData?.color_options?.map((item, index) => (
                          <button
                            key={index}
                            className={`option-btn ${
                              activeColor === varImg1
                                ? "storage badgeClick"
                                : ""
                            }`}
                            onClick={() => handleColorClick(varImg1)}
                          >
                            <img alt="Đen" src={varImg1} />
                            <span>{item}</span>
                            {activeColor === item && (
                              <span
                                className="badgeClick bx bx-check"
                                style={{ display: "inline" }}
                              />
                            )}
                          </button>
                        ))}
                      </div>
                    </div>
                  </div>
                </div>
                <div className="info-product-price mt-2">
                  <h4>Giá:</h4>
                  <div className="sale">${proData?.sale}</div>
                  <div className="price">${proData?.price}</div>
                </div>
                <div className="short_desc">
                  Máy mới 100% , chính hãng Apple Việt Nam.Clound LAB hiện là
                  đại lý bán lẻ uỷ quyền iPhone hãng VN/A của Apple Việt Nam
                </div>
                <div className="option-group">
                  <label htmlFor="title">Số lượng</label>
                  <input defaultValue="1" id="quantity" type="number" />
                </div>
                <div className="action-buttons">
                  <button
                    className="cart-btn"
                    onClick={() => {
                      addToCart(proData);
                    }}
                  >
                    <i className="bx bx-cart-add" /> Thêm giỏ hàng
                  </button>
                  <button className="buy-btn">
                    <i className="fas fa-shopping-cart" /> Mua ngay
                  </button>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section className="mt-3" id="Description">
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
        </section>
        <section id="Comments mt-3">
          <div className="container">
            <div className="reviews">
              <h3>2 bình luận của {proData?.name}</h3>
              <div className="review">
                <div className="reviewer-info">
                  <img
                    alt="Reviewer 1"
                    className="reviewer-img"
                    src={mainImg2}
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
    </>
  );
};

export default Detail;
