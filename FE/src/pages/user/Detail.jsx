import React, { useState, useEffect, useContext, useRef } from "react";
import { CartContext } from "../../context/Cart";
import varImg1 from "../../assets/images/iphone1.jpg";
import varImg2 from "../../assets/images/iphone2.jpg";
import { productApi } from "../../apis";
import { commentApi } from "../../apis";
import { Tab, BoxPro, Brand } from "../../components";
import "./css/Detail.css";
import { useParams } from "react-router-dom";
import { formatCurrency } from "../../ultis/func";
import { useSelector } from "react-redux";
import icons from "../../ultis/icon";
const Detail = () => {
  const { productsData } = useSelector((state) => state.pro);
  const [relatedProducts, setRelatedProducts] = useState([]);
  const { slug } = useParams();
  const { TiDeleteOutline } = icons;
  const { addToCart, buyNow } = useContext(CartContext);
  const ref = useRef();
  const [detailData, setDetailData] = useState({});

  const [loadingComment, setLoadingComment] = useState(false);
  const [activeStorage, setActiveStorage] = useState(null);
  const [activeColor, setActiveColor] = useState(null);
  const [mainImage, setMainImage] = useState(detailData.images || "");
  const [currentVariant, setCurrentVariant] = useState();
  const [quantity, setQuantity] = useState(1);
  const [main, setMain] = useState();
  const [viewedProducts, setViewedProducts] = useState([]);

  const [images, setImages] = useState([]);
  const [comment, setComment] = useState("");
  const [isModalOpen, setIsModalOpen] = useState(false);
  const modalContentRef = useRef(null);

  useEffect(() => {
    const rePhonePro = productsData?.phone.filter(
      (p) =>
        p?.brand?.name === detailData?.brand?.name && p?.id !== detailData?.id
    );
    const reLaptopPro = productsData?.laptop.filter(
      (p) =>
        p?.brand?.name === detailData?.brand?.name && p?.id !== detailData?.id
    );
    const reAllPro = [...(rePhonePro || []), ...(reLaptopPro || [])];
    setRelatedProducts(reAllPro);
  }, [productsData, detailData]);
  useEffect(() => {
    const storedProducts = localStorage.getItem("viewedProducts");
    const viewedProducts = storedProducts ? JSON.parse(storedProducts) : [];
    setViewedProducts(viewedProducts);
    if (detailData && detailData.id) {
      const isWatchedP = viewedProducts.find((p) => p.id === detailData.id);
      if (!isWatchedP) {
        if (viewedProducts.length > 3) {
          viewedProducts.pop();
        }
        viewedProducts.unshift(detailData);
        localStorage.setItem("viewedProducts", JSON.stringify(viewedProducts));
      }
    }
  }, [detailData]);

  const clearViewedProducts = () => {
    localStorage.removeItem("viewedProducts");
    setViewedProducts([]);
  };
  useEffect(() => {
    const fetchDetailData = async () => {
      try {
        const data = await productApi.getOne(slug);

        if (data.product_image_items) {
          const newImage = {
            id: Math.floor(Math.random() * 1000),
            name: "mainImg",
            images: data.images,
          };
          data.product_image_items.push(newImage);
        }
        setMain({
          id: data.id,
          name: data.name,
          image: data.images,
          brand: data.brand,
          category: data.category,
          slug: data.slug,
          product_image_items: data.product_image_items,
          product_variant: data.product_variant,
        });
        setDetailData(data);
        if (data.product_image_items && data.product_image_items.length > 0) {
          setMainImage(data.product_image_items[0].images);
        }
      } catch (err) {
        console.log("Không thể lấy dữ liệu", err);
      }
    };

    fetchDetailData();
  }, [slug]);
  useEffect(() => {
    if (detailData.product_variant && detailData.product_variant.length > 0) {
      const firstStorage = detailData.product_variant[0];
      const firstVariant = firstStorage.variants[0];
      setActiveStorage(firstStorage.storage || "");
      if (firstStorage.variants.length === 1) {
        setActiveColor(firstVariant.color);
      } else {
        setActiveColor(firstVariant.color || "");
      }
      setCurrentVariant({
        storage: firstStorage.storage,
        color: firstVariant,
      });
    }
  }, [detailData, slug]);

  const handleChangeVariant = (color) => {
    const selectedStorage = detailData?.product_variant?.find(
      (pv) => pv?.storage === activeStorage
    );
    if (selectedStorage) {
      const selectedColor = selectedStorage.variants.find(
        (v) => v.color === color
      );
      if (selectedColor) {
        const selectedVariant = {
          storage: selectedStorage.storage,
          color: selectedColor,
        };
        setCurrentVariant(selectedVariant);
        setActiveColor(selectedColor.color); // Cập nhật activeColor
      } else {
        console.log("Không tìm thấy màu tương ứng");
      }
    } else {
      console.log("Không tìm thấy dung lượng tương ứng");
    }
  };

  const handleStorageClick = (storage) => {
    const selectedStorage = detailData?.product_variant?.find(
      (pv) => pv?.storage === storage
    );
    if (selectedStorage) {
      const firstVariant = selectedStorage.variants[0];
      setActiveStorage(storage);
      setActiveColor(firstVariant.color);
      setCurrentVariant({
        storage: selectedStorage.storage,
        color: firstVariant,
      });
      setMainImage(firstVariant.images || "");
    } else {
      console.log("Không tìm thấy dung lượng tương ứng");
    }
  };

  const handleImageClick = (img) => {
    setMainImage(img);
  };

  useEffect(() => {
    ref.current.scrollIntoView({
      behavior: "smooth",
      block: "end",
      inline: "nearest",
    });
  }, [slug]);
  // Hàm chọn dung lượng

  // Hàm chọn màu sắc
  const handleColorClick = (color) => {
    setActiveColor(color);
    handleChangeVariant(color);
  };

  // Handle image selection
  const handleImageChange = (e) => {
    const selectedFiles = Array.from(e.target.files);
    const imageUrls = selectedFiles.map((file) => URL.createObjectURL(file));
    setImages((prevImages) => [...prevImages, ...imageUrls]);
  };

  // Mở modal
  const openModal = () => {
    setIsModalOpen(true);
  };

  // Đóng modal
  const closeModal = () => {
    setIsModalOpen(false);
  };

  const handleOutsideClick = (e) => {
    if (
      modalContentRef.current &&
      !modalContentRef.current.contains(e.target)
    ) {
      closeModal();
    }
  };
  // Submit comment
  const handleSubmit = (e) => {
    e.preventDefault();

    if (!comment.trim()) {
      alert("Vui lòng nhập bình luận!");
      return;
    }

    setLoadingComment(true);

    // Here, you can handle the logic to send the comment and images to the server
    console.log("Bình luận:", comment);
    console.log("Hình ảnh:", images);

    // Simulate a delay to show loading state
    setTimeout(() => {
      setLoadingComment(false);
      setComment("");
      setImages([]);
    }, 2000);
  };
  return (
    <>
      <section className="px-2 mb-2" id="Breadcrumb" ref={ref}>
        <div className="container p-3 bg-Breadcrumb ">
          <nav aria-label="breadcrumb">
            <ol className="breadcrumb mb-0">
              <li className="breadcrumb-item">
                <a href="/" className="route">
                  <i className="fa-solid fa-house" /> Trang chủ
                </a>
              </li>
              <li className="breadcrumb-item ">
                <a href="/product" className="route">
                  Sản phẩm
                </a>
              </li>
              <li className="breadcrumb-item active_route" aria-current="page">
                <span>{detailData?.name}</span>
              </li>
            </ol>
          </nav>
        </div>
      </section>
      <div className="container pb-3 pt-4">
        <section id="product_details" className="mt-2">
          <div className="container">
            <div className="row ">
              <div className=" col-lg-6 col-md-5">
                <div className="single-pro-image">
                  <div className="bg-img">
                    <img src={mainImage} alt="" width="100%" id="MainImg" />
                  </div>
                  <div className="small-img-group gap-1">
                    {detailData?.product_image_items &&
                      detailData?.product_image_items.map((item, index) => (
                        <div
                          key={index}
                          className={`small-img-col  ${
                            item?.images === mainImage
                              ? "active-small-img-col"
                              : ""
                          } `}
                        >
                          <img
                            src={item?.images}
                            style={{ width: "70%", cursor: "pointer" }}
                            alt=""
                            onClick={() => handleImageClick(item?.images)}
                          />
                        </div>
                      ))}
                  </div>
                </div>
              </div>

              <div className="col-lg-6 col-md-7 pt-3 box-detail-right">
                <div className="product__details__text">
                  <div className="product-tag">
                    <div className="bestseller-tag">#Bán chạy</div>
                    <div className="sold-tag">Đã bán: 10</div>
                  </div>
                  <h1 className="text-uppercase">{detailData?.name}</h1>
                  <div className="info-product">
                    <div className="rate-sku">
                      {detailData?.reviews ? (
                        <div className="rate">
                          <i
                            className="bx bxs-star"
                            style={{
                              color: "#f1c123",
                            }}
                          />
                          <b>
                            {currentVariant?.rating
                              ? currentVariant?.rating
                              : 0}
                          </b>
                          <span className="ml-2">({detailData?.reviews})</span>
                        </div>
                      ) : (
                        <span style={{ paddingRight: "3px" }}>
                          Chưa có đánh giá
                        </span>
                      )}
                      <div className="sku">
                        <strong>Mã: {currentVariant?.color?.sku}</strong>
                      </div>
                      <div className="status">
                        <span className="badge text-bg-success">Còn hàng</span>
                      </div>
                    </div>
                  </div>

                  <div className="product-options">
                    <div className="option-group">
                      <label htmlFor="storage">Dung lượng</label>
                      <div className="storage-options mt-2">
                        {detailData?.product_variant?.map((item) => (
                          <button
                            key={item.storage}
                            className={`option-btn ${
                              activeStorage === item.storage
                                ? "storage badgeClick"
                                : ""
                            }`}
                            onClick={() => handleStorageClick(item.storage)}
                          >
                            {item.storage}
                          </button>
                        ))}
                      </div>
                    </div>
                    <div className="option-group">
                      <label htmlFor="color">Màu sắc</label>
                      <div className="color-options mt-2">
                        {detailData?.product_variant?.find(
                          (v) => v.storage === activeStorage
                        )?.variants?.length > 0 ? (
                          detailData?.product_variant
                            ?.find((v) => v.storage === activeStorage)
                            .variants?.map((item, index) => (
                              <button
                                key={index}
                                className={`option-btn ${
                                  activeColor === item.color
                                    ? "color badgeClick"
                                    : ""
                                }`}
                                onClick={() => {
                                  handleColorClick(item.color);
                                  setMainImage(item.images);
                                }}
                              >
                                <img alt={item.color} src={item.images} />
                                <span>{item.color}</span>
                                {activeColor === item.color && (
                                  <span
                                    className="badgeClick bx bx-check"
                                    style={{ display: "inline" }}
                                  />
                                )}
                              </button>
                            ))
                        ) : (
                          <p>Không tìm thấy phiên bản cho dung lượng đã chọn</p>
                        )}
                      </div>
                    </div>
                  </div>
                </div>
                <div className="info-product-price mt-2">
                  <div className="sale">
                    {currentVariant?.color?.sale
                      ? formatCurrency(currentVariant?.color?.sale)
                      : formatCurrency(currentVariant?.color?.price ?? 0)}
                  </div>
                  <div className="price">
                    {currentVariant?.color?.price && currentVariant?.color?.sale
                      ? formatCurrency(currentVariant?.color?.price)
                      : null}
                  </div>
                </div>
                <div className="short_desc"></div>
                <p>{detailData?.short_desc}</p>
                <div className="option-group">
                  <label htmlFor="title">Số lượng</label>
                  <input
                    value={quantity}
                    onChange={(e) => setQuantity(Number(e.target.value))}
                    id="quantity"
                    type="number"
                    max="5"
                    min="1"
                  />
                </div>
                <div className="action-buttons">
                  <button
                    className="cart-btn"
                    onClick={() => {
                      addToCart(main, currentVariant, quantity);
                    }}
                  >
                    <i className="bx bx-cart-add" /> Thêm giỏ hàng
                  </button>
                  <button
                    className="buy-btn"
                    onClick={() => buyNow(main, currentVariant, quantity)}
                  >
                    <i className="fas fa-shopping-cart" /> Mua ngay
                  </button>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section className=" container mt-5" id="Description">
          <div className="row">
            <div className="col-lg-8 col-md-8 ">
              <div className="box-tab-info">
                <Tab detailData={detailData} />
              </div>
            </div>
            {viewedProducts.length > 0 && (
              <div className="col-lg-4 col-md-4">
                <div className="d-flex flex-column justify-content-center viewedPr">
                  <div className="d-flex align-items-center justify-content-between box-viewedTilte ">
                    <h5
                      className="title"
                      style={{
                        paddingRight: 10,
                        marginBottom: 0,
                      }}
                    >
                      Sản phẩm đã xem
                    </h5>
                    <span
                      className="d-flex justify-content-center"
                      style={{ cursor: "pointer" }}
                      onClick={() => clearViewedProducts()}
                    >
                      Xóa tất cả
                    </span>
                  </div>

                  {viewedProducts.map((item) => (
                    <div key={item.id} className="box-viewP">
                      <div className="d-flex box-item ">
                        <BoxPro
                          horizon
                          slug={item.slug}
                          image={item.images}
                          id={item.id}
                          name={item.name}
                          variant={item.product_variant}
                        />
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            )}
          </div>
        </section>

        <section className=" mt-5">
          <div className="container">
            <div className="box-product-relate row justify-content-start">
              <span className="d-flex justify-content-between align-items-center mb-2">
                <h3 className="title">Sản phẩm tương tự</h3>
              </span>
              {relatedProducts.length > 0 &&
                relatedProducts
                  .filter((v, i) => i <= 4)
                  .map((item) => (
                    <div key={item.id} className="col-md-3">
                      <BoxPro
                        id={item.id}
                        name={item.name}
                        category={item.category}
                        brand={item.brand}
                        slug={item.slug}
                        image={item.images}
                        product_image_items={item.product_image_items}
                        variant={item.product_variant}
                      />
                    </div>
                  ))}
            </div>
          </div>
        </section>
        <section id="Comments mt-5">
          <div className=" mt-5">
            <div className="reviews ">
              <div className="comments-section">
                <h3 className="title-review title">
                  Khách hàng nói về sản phẩm
                </h3>
                <div className="review-container">
                  <div className="review-content">
                    <div className="review-text">
                      <h3>Trở thành người đầu tiên đánh giá về sản phẩm.</h3>
                      <button className="review-button" onClick={openModal}>
                        Đánh giá về sản phẩm
                      </button>
                    </div>
                    <div className="review-image">
                      <img
                        src="https://fptshop.com.vn/img/imgStar.png?w=1920&q=100"
                        alt="img-star"
                      />
                    </div>
                  </div>
                </div>
                <p className="comment-customer">
                  Các đánh giá của khách hàng :
                </p>
                <div className="comment-item">
                  <div className="comment-avatar d-flex">T</div>
                  <div className="comment-content">
                    <div className="comment-info">
                      <span className="comment-author">Nguyễn Văn A</span>
                      <span className="comment-date">12/11/2024</span>
                    </div>
                    <p className="comment-text">
                      Sản phẩm rất tốt! Tôi sẽ mua lại.
                    </p>
                    <div className="d-flex gap-2  ">
                      <img
                        src="http://127.0.0.1:8000/images/product/1729263239_ip15-promax.jpg"
                        alt="Review Image"
                        className="comment-image "
                      />
                      <img
                        src="http://127.0.0.1:8000/images/product/1729263239_ip15-promax.jpg"
                        alt="Review Image"
                        className="comment-image"
                      />
                    </div>
                  </div>
                </div>
                <div className="comment-item">
                  <div className="comment-avatar d-flex">T</div>
                  <div className="comment-content">
                    <div className="comment-info">
                      <span className="comment-author">Nguyễn Văn A</span>
                      <span className="comment-date">12/11/2024</span>
                    </div>
                    <p className="comment-text">
                      Sản phẩm rất tốt! Tôi sẽ mua lại.
                    </p>
                    {/* <img
                        src="http://127.0.0.1:8000/images/product/1729263239_ip15-promax.jpg"
                        alt="Review Image"
                        className="comment-image"
                      /> */}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      {/* Modal */}
      {isModalOpen && (
        <div className="modal" onClick={handleOutsideClick}>
          <div className="modal-content" ref={modalContentRef}>
            <span className="close" onClick={closeModal}>
              &times;
            </span>

            <div className="form-comment">
              <span className="comment-label">
                Vui lòng để lại cảm nghĩ về sản phẩm:
              </span>
              <form className="comment-form" onSubmit={handleSubmit}>
                <textarea
                  className="comment-textarea"
                  placeholder="Hãy nêu suy nghĩ của bạn"
                  value={comment}
                  onChange={(e) => setComment(e.target.value)}
                />

                <div className="form-footer">
                  <div className="image-upload">
                    <input
                      type="file"
                      multiple
                      accept="image/*"
                      onChange={handleImageChange}
                      id="image-upload"
                    />
                    <label htmlFor="image-upload" className="upload-label">
                      <i className="fas fa-image"></i> Chọn hình ảnh
                    </label>
                  </div>

                  <button
                    className="btn-submit"
                    type="submit"
                    disabled={loadingComment}
                  >
                    {loadingComment ? "Đang gửi ..." : "Gửi đánh giá"}
                  </button>
                </div>
              </form>

              {/* Hiển thị hình ảnh đã chọn */}
              <div className="image-preview">
                {images.map((image, index) => (
                  <img
                    key={index}
                    src={image}
                    alt={`chosen-preview-${index}`}
                    className="preview-img"
                  />
                ))}
              </div>
            </div>
          </div>
        </div>
      )}
    </>
  );
};

export default Detail;
