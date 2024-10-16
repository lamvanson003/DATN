import React, { useState, useEffect, useContext, useRef } from "react";
import { CartContext } from "../../context/Cart";
import mainImg1 from "../../assets/images/k1.jpeg";
import mainImg2 from "../../assets/images/k2.jpeg";
import mainImg3 from "../../assets/images/k3.jpeg";
import mainImg4 from "../../assets/images/k1.jpeg";
import varImg1 from "../../assets/images/iphone1.jpg";
import varImg2 from "../../assets/images/iphone2.jpg";
import { commentApi } from "../../apis";
import { Tab, BoxPro } from "../../components";
import "./css/Detail.css";
import { useParams } from "react-router-dom";
const Detail = () => {
  const { addToCart } = useContext(CartContext);
  const { pid } = useParams();
  const [cmts, setCmts] = useState([]);
  const ref = useRef();
  const [proDatas, setProDatas] = useState([]);
  const [comment, setComment] = useState("");
  const [loadingComment, setLoadingComment] = useState(false);
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
  useEffect(() => {
    try {
      const fetchCmtpid = async () => {
        const data = await commentApi.getCommentByPid(+pid);
        setCmts(data);
      };
      fetchCmtpid();
    } catch (err) {
      console.log("không thể fetch dữ liệu", err);
    }
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

  const handleSubmitComment = async (e) => {
    e.preventDefault();
    setLoadingComment(true);
    try {
      const data = await commentApi.postComment(1, pid, comment);
      console.log("Bình luận đã được đăng !", data);
    } catch (err) {
      console.log("Lỗi", err);
    } finally {
      setLoadingComment(false);
    }
  };
  console.log(comment);

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
                <div
                  className="d-flex flex-column align-items-center p-3"
                  style={{ boxShadow: "0px 6px 15px rgba(0, 0, 0, 0.2)" }}
                >
                  <div
                    style={{ width: "100%" }}
                    className="d-flex  justify-content-center"
                  >
                    <img src={mainImage} style={{ width: "60%" }} alt="" />
                  </div>
                  <div className="d-flex align-items-center justify-content-center gap-1">
                    {imgList.map((item, index) => (
                      <div
                        key={index}
                        className=" mt-3 d-flex align-items-center justify-content-center"
                      >
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
              <div className="col-lg-6 col-md-7 pt-3">
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
        <section className=" container mt-5" id="Description">
          <div className="row">
            <div className="col-lg-8 col-md-8">
              <Tab proData={proData} />
            </div>
            <div className="col-lg-4 col-md-4">
              <div className="d-flex flex-column align-items-end">
                <h3>Sản phẩm đã xem</h3>
                <BoxPro watched={true} />
              </div>
            </div>
          </div>
        </section>
        <section className="container mt-5">
          <h3>Sản phẩm liên quan</h3>
          <div className="d-flex justify-content-between">
            <BoxPro />
            <BoxPro />
            <BoxPro />
            <BoxPro />
            <BoxPro />
          </div>
        </section>
        <section id="Comments mt-5">
          <div className="container mt-5">
            <div>
              <span>Bạn cần đăng nhập để bình luận</span>
              <form action="" onSubmit={handleSubmitComment}>
                <textarea
                  placeholder="Hãy nêu suy nghĩ của bạn"
                  style={{
                    width: "100%",
                    height: 100,
                    outline: "none",
                    boxShadow: "none",
                  }}
                  value={comment}
                  onChange={(e) => setComment(e.target.value)}
                />
                <span className="d-flex justify-content-end">
                  <button
                    className="btn btn-primary"
                    disabled={loadingComment}
                    type="submit"
                  >
                    {loadingComment ? "Đang gửi ..." : "Bình luận"}
                  </button>
                </span>
              </form>
            </div>
            <div className="reviews">
              <h3>2 bình luận của {proData?.name}</h3>
              {cmts.map((cmt) => (
                <div key={cmt.id} className="review">
                  <div className="reviewer-info">
                    <img
                      alt="Reviewer 1"
                      className="reviewer-img"
                      src={mainImg2}
                    />
                    <div>
                      <h4 className="m-0">{cmt.username} </h4>
                      <div className="rating d-flex align-items-center">
                        <span className="text-warning">★★★★☆</span>
                      </div>
                      <p className="text-secondary">
                        {cmt.createdAt} | Phân loại hàng:
                        {cmt?.product_variant_id}
                      </p>
                      <p>{cmt.content}</p>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </section>
      </div>
    </>
  );
};

export default Detail;
