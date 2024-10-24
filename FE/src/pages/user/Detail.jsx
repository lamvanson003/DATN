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
  const [comment, setComment] = useState("");
  const [loadingComment, setLoadingComment] = useState(false);
  const [activeStorage, setActiveStorage] = useState(null);
  const [activeColor, setActiveColor] = useState(null);
  const [mainImage, setMainImage] = useState(detailData.images || "");
  const [currentVariant, setCurrentVariant] = useState();
  const [quantity, setQuantity] = useState(1);
  const [main, setMain] = useState();
  const [viewedProducts, setViewedProducts] = useState([]);
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
  console.log(relatedProducts);

  useEffect(() => {
    const storedProducts = localStorage.getItem("viewedProducts");
    const viewedProducts = storedProducts ? JSON.parse(storedProducts) : [];
    setViewedProducts(viewedProducts);
  }, []);
  useEffect(() => {
    const storedProducts = localStorage.getItem("viewedProducts");
    const viewedProducts = storedProducts ? JSON.parse(storedProducts) : [];
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
        console.log("detailData:", data); // Kiểm tra dữ liệu nhận được

        if (data.product_image_items) {
          const newImage = {
            id: Math.floor(Math.random() * 1000), // Tạo ID ngẫu nhiên
            name: "mainImg", // Đặt tên
            images: data.images, // Giả sử data.images là đường dẫn hình ảnh
          };
          data.product_image_items.push(newImage); // Thêm vào mảng hình ảnh
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
      setMainImage(firstVariant.images || "");
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

  return (
    <>
      <div className="container pb-3">
        <section className="px-2 py-3 mb-2" id="Breadcrumb" ref={ref}>
          <div className="container p-3 bg-Breadcrumb mt-5">
            <nav aria-label="breadcrumb">
              <ol className="breadcrumb mb-0">
                <li className="breadcrumb-item">
                  <a href="/">
                    <i className="fa-solid fa-house" /> TRANG CHỦ
                  </a>
                </li>
                <li className="breadcrumb-item">
                  <a href="#">SẢN PHẨM</a>
                </li>
                <li className="breadcrumb-item" aria-current="page">
                  <span>{detailData?.name}</span>
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
                  style={{
                    boxShadow: "0px 6px 15px rgba(0, 0, 0, 0.2)",
                    backgroundColor: "white",
                  }}
                >
                  <div
                    style={{ width: "100%", height: 355.2 }}
                    className="d-flex  justify-content-center mb-2"
                  >
                    <img
                      src={mainImage}
                      style={{ width: "60%" }}
                      alt=""
                      id="MainImg"
                    />
                  </div>
                  <div className="d-flex align-items-center justify-content-center gap-1 mt-5">
                    {detailData?.product_image_items &&
                      detailData?.product_image_items.map((item, index) => (
                        <div
                          key={index}
                          className=" mt-3 d-flex align-items-center justify-content-center"
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
              <div className="col-lg-6 col-md-7 pt-3">
                <div className="product__details__text">
                  <div className="product-tag">
                    <div className="bestseller-tag">#Bán chạy</div>
                    <div className="sold-tag">Đã bán: {detailData?.sold}</div>
                  </div>
                  <h1 className="text-uppercase">{detailData?.name}</h1>
                  <div className="info-product">
                    <div className="rate-sku">
                      <div className="rate">
                        <b>
                          {currentVariant?.rating ? currentVariant?.rating : 0}
                        </b>
                        <i
                          className="bx bxs-star"
                          style={{
                            color: "#f1c123",
                          }}
                        />

                        <span className="ml-2">({detailData?.reviews})</span>
                      </div>
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
                <div className="short_desc">{detailData?.short_desc}</div>
                <div className="option-group">
                  <label htmlFor="title">Số lượng</label>
                  <input
                    value={quantity}
                    onChange={(e) => setQuantity(e.target.value)}
                    id="quantity"
                    type="number"
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
            <div className="col-lg-8 col-md-8">
              <Tab detailData={detailData} />
            </div>
            <div className="col-lg-4 col-md-4">
              <div className="d-flex flex-column justify-content-center">
                <div className="d-flex align-items-center justify-content-center mb-3">
                  <h3
                    style={{
                      borderRight: "2px solid black",
                      paddingRight: 10,
                      marginBottom: 0,
                    }}
                  >
                    Sản phẩm đã xem
                  </h3>
                  <span
                    className="d-flex justify-content-center "
                    style={{ cursor: "pointer" }}
                    onClick={() => clearViewedProducts()}
                  >
                    <TiDeleteOutline size={24} style={{ marginLeft: 10 }} />
                  </span>
                </div>

                {viewedProducts.length > 0 &&
                  viewedProducts.map((item) => (
                    <div
                      key={item.id}
                      className="d-flex justify-content-center"
                    >
                      <BoxPro
                        viewed={true}
                        slug={item.slug}
                        image={item.images}
                        id={item.id}
                        name={item.name}
                        variant={item.product_variant}
                      />
                    </div>
                  ))}
              </div>
            </div>
          </div>
        </section>
        <section className="container mt-5">
          <h3>Sản phẩm liên quan</h3>
          <div className="row">
            {relatedProducts.length > 0 &&
              relatedProducts
                .filter((v, i) => i <= 4)
                .map((item) => (
                  <div key={item.id} className="col-md-2">
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
        </section>
        <section id="Comments mt-5">
          <div className="container mt-5">
            <div>
              <span>Bạn cần đăng nhập để bình luận</span>
              <form action="">
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
              <h3>2 bình luận của {detailData?.name}</h3>
            </div>
          </div>
        </section>
      </div>
    </>
  );
};

export default Detail;
