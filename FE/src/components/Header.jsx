import React, { useContext, useEffect, useState, useRef } from "react";
import { Link, NavLink, useLocation, useNavigate } from "react-router-dom";
import "./css/Header.css";
import path from "../ultis/path";
import icons from "../ultis/icon";
import { navMenu } from "../ultis/menu";
import logoCloudLab from "../assets/images/logo.svg";
import { useSelector } from "react-redux";
import Fuse from "fuse.js";
import { BoxPro } from ".";
import { CartContext } from "../context/Cart";
import { formatCurrency } from "../ultis/func";

const {
  BsSearch,
  CiLocationOn,
  BiCategoryAlt,
  FaRegHeart,
  FaRegUser,
  MdOutlineShoppingCart,
  ImBin2,
  MdHistory,
  MdOutlineSettingsSuggest,
} = icons;
const Header = ({ cartItemAmout, favorItemAmount }) => {
  const { productsData } = useSelector((state) => state.pro);
  const { cartItems, getCartTotal } = useContext(CartContext);
  const navigate = useNavigate();
  const [searchTerm, setSearchTerm] = useState("");
  const [searchHistory, setSearchHistory] = useState([]);
  const [searchProducts, setSearchProducts] = useState([]);
  const [isFocus, setIsFocus] = useState(false);
  const [isHover, setIsHover] = useState(false);
  const wrapperRef = useRef(null);
  const location = useLocation();

  useEffect(() => {
    setIsFocus(false);
    setIsHover(false);
  }, [location]);
  const handleSearch = (e) => {
    const term = e.target.value;
    setSearchTerm(e.target.value);
    if (!term) {
      setSearchProducts([]);
      return;
    }
    // Cấu hình cho Fuse.js để tìm kiếm "fuzzy"
    const fuseOptions = {
      keys: ["name"],
      threshold: 0.3, // Độ nhạy cho phép (0 = chính xác, 1 = khớp ít chính xác hơn)
      includeScore: true,
    };

    const allProducts = [
      ...(productsData.phone || []),
      ...(productsData.laptop || []),
    ];

    const keywords = term.toLowerCase().split(/\s+/);

    const fuse = new Fuse(allProducts, fuseOptions);

    const searchResults = keywords.flatMap((keyword) => fuse.search(keyword));

    const uniqueResults = [];
    const productMap = {};
    searchResults.forEach((result) => {
      const product = result.item;
      if (!productMap[product.name]) {
        uniqueResults.push(product);
        productMap[product.name] = true;
      }
    });

    setSearchProducts(uniqueResults.slice(0, 5));
  };
  const handleSearchHistory = (e) => {
    if (e.key === "Enter" && searchTerm) {
      e.preventDefault();
      if (!searchHistory.includes(searchTerm)) {
        if (searchHistory.length > 4) {
          searchHistory.pop();
        }
        const updatedHistory = [searchTerm, ...searchHistory];
        setSearchHistory(updatedHistory);
        localStorage.setItem("storedHistory", JSON.stringify(updatedHistory));
      }
      setSearchTerm("");
    }
  };

  const handleClickHistoryInSearch = (term) => {
    setSearchTerm(term);
    handleSearch({ target: { value: term } });
    setIsFocus(true);
  };

  const handleDeleteSearch = () => {
    setSearchTerm("");
    setSearchHistory([]);
    localStorage.removeItem("storedHistory");
  };

  const handleNaCart = () => {
    navigate("/cart");
  };
  const handleNaFa = () => {
    navigate("/favor");
  };

  useEffect(() => {
    const storedHistory =
      JSON.parse(localStorage.getItem("storedHistory")) || [];
    setSearchHistory(storedHistory);
  }, []);
  useEffect(() => {
    const handleClickOutside = (event) => {
      if (wrapperRef.current && !wrapperRef.current.contains(event.target)) {
        setSearchProducts([]);
      }
    };

    document.addEventListener("mousedown", handleClickOutside);
    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, []);
  const handleBlur = (event) => {
    setTimeout(() => {
      if (
        wrapperRef.current &&
        !wrapperRef.current.contains(event.relatedTarget)
      ) {
        setIsFocus(false);
      }
    }, 0);
  };
  let hoverTimeout;
  const handleHoverInCart = () => {
    clearTimeout(hoverTimeout);
    setIsHover(true);
  };
  const handleHoverOutCart = () => {
    hoverTimeout = setTimeout(() => setIsHover(false), 200);
  };
  const handleCheckAll = () => {
    localStorage.setItem("checkedItems", JSON.stringify(cartItems));
    navigate("/payment");
  };
  return (
    <>
      <div className="d-flex flex-column">
        <div
          style={{ height: 40, backgroundColor: "#053D99" }}
          className="d-flex align-items-center justify-content-between px-4"
        >
          <span></span>
          <span className="text-light ">
            100% Giao hàng đến bạn trong thời gian nhanh nhất
          </span>
          <span>
            <span className="text-light opacity-75" style={{ fontSize: 13 }}>
              Hotline + 1800 900
            </span>
          </span>
        </div>
        <div
          style={{ height: 120, backgroundColor: "#fff" }}
          className="d-flex align-items-center justify-content-between px-5"
        >
          <div>
            <img src={logoCloudLab} alt="logo" />
          </div>
          <div className="position-relative" ref={wrapperRef}>
            <form action="">
              <input
                type="text"
                placeholder="Tìm kiếm"
                style={{
                  width: 500,
                  height: 60,
                  paddingLeft: "12px",
                  border: "none",
                  outline: "none",
                }}
                className="form-control rounded-pill"
                value={searchTerm}
                onChange={handleSearch}
                onKeyDown={handleSearchHistory}
                onFocus={() => setIsFocus(true)}
                onBlur={handleBlur}
              />
              <button
                className="position-absolute"
                style={{
                  right: "15px",
                  top: "50%",
                  transform: "translateY(-50%)",
                  border: "none",
                }}
                type="submit"
                onClick={handleSearch}
              >
                <BsSearch />
              </button>
            </form>
            {isFocus &&
              (searchHistory.length > 0 || searchProducts.length > 0) && (
                <div
                  className="position-absolute "
                  style={{
                    backgroundColor: "#0056b3",
                    width: 500,
                    padding: 12,
                    zIndex: 100,
                  }}
                >
                  <div
                    style={{
                      fontWeight: 600,
                      paddingBottom: 5,
                      borderBottom: "1px solid white",
                      display: "flex",
                      justifyContent: "space-between",
                      alignItems: "center",
                      width: "100%",
                      color: "#fff",
                    }}
                  >
                    <span className="d-flex align-items-center gap-1">
                      <MdHistory size={20} />
                      <span>Lịch sử tìm kiếm</span>
                    </span>

                    <span
                      onClick={handleDeleteSearch}
                      style={{ cursor: "pointer" }}
                      onMouseDown={(e) => e.preventDefault()}
                    >
                      <ImBin2 />
                    </span>
                  </div>
                  {searchHistory.map((term, index) => (
                    <div
                      key={index}
                      className="my-1 searchH"
                      onClick={() => handleClickHistoryInSearch(term)}
                      onMouseDown={(e) => e.preventDefault()}
                    >
                      <span style={{ cursor: "pointer" }}>{term}</span>
                    </div>
                  ))}
                  {searchProducts.length > 0 && (
                    <div>
                      <div
                        style={{
                          fontWeight: 600,
                          paddingBottom: 5,
                          borderBottom: "1px solid white",
                          display: "flex",
                          justifyContent: "space-between",
                          alignItems: "center",
                          width: "100%",
                          color: "#fff",
                        }}
                      >
                        <span className="d-flex align-items-center gap-1">
                          <MdOutlineSettingsSuggest size={20} />
                          <span>Sản phẩm gợi ý</span>
                        </span>
                      </div>
                      <div className="search-results">
                        {searchProducts.map((item, index) => (
                          <div key={index} className="my-1 search-item">
                            <BoxPro
                              horizon
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
                  )}
                </div>
              )}
          </div>

          <div className="d-flex gap-4">
            <div className="d-flex align-items-center px-2 py-2 border border-secondary rounded gap-2">
              <span className="d-flex align-items-center">
                <CiLocationOn size={24} />
              </span>
              <span className="">Địa chỉ cửa hảng</span>
            </div>
            <div className="d-flex align-items-center gap-2">
              <div
                className="d-flex gap-2"
                style={{ cursor: "pointer" }}
                onClick={handleNaFa}
              >
                <div
                  className="position-relative"
                  style={{ display: "inline-block" }}
                >
                  <FaRegHeart size={24} />
                  <span
                    className="position-absolute badge rounded-pill bg-primary"
                    style={{
                      top: "-7px",
                      right: "-7px",
                    }}
                  >
                    {favorItemAmount}
                  </span>
                </div>
                <span>Yêu thích</span>
              </div>

              <div
                className="cart-container"
                onMouseEnter={handleHoverInCart}
                onMouseLeave={handleHoverOutCart}
              >
                <div className="d-flex gap-2 " style={{ cursor: "pointer" }}>
                  <div
                    className="position-relative"
                    style={{ display: "inline-block" }}
                    onClick={handleNaCart}
                  >
                    <MdOutlineShoppingCart size={24} />
                    <span
                      className="position-absolute badge rounded-pill bg-primary"
                      style={{
                        top: "-7px",
                        right: "-7px",
                      }}
                    >
                      {cartItemAmout}
                    </span>
                  </div>
                  <span onClick={handleNaCart}>Giỏ hàng</span>
                  {isHover && (
                    <div
                      className="cart-dropdown rounded"
                      onMouseEnter={handleHoverInCart}
                      onMouseLeave={handleHoverOutCart}
                    >
                      {cartItems?.map((item) => (
                        <div key={item.variantKey}>
                          <BoxPro
                            horizon
                            slug={item.slug}
                            image={
                              item?.color?.images
                                ? item?.color?.images
                                : item?.main?.image
                            }
                            hoverCart
                            id={item.id}
                            name={item.main.name}
                            hoverCartItem={item}
                          />
                        </div>
                      ))}

                      <div className="cart-price">
                        <span>Tổng tiền: </span>
                        <span className="text-danger ps-2">
                          {formatCurrency(getCartTotal())}
                        </span>
                      </div>
                      <div className="cart-action">
                        <button className="btn" onClick={handleCheckAll}>
                          Thanh Toán
                        </button>
                        <button className="btn" onClick={handleNaCart}>
                          Xem giỏ hàng
                        </button>
                      </div>
                    </div>
                  )}
                </div>
              </div>

              <div className="d-flex gap-2">
                <span className="d-flex align-items-center gap-1">
                  <FaRegUser size={24} />
                  <Link style={{ textDecoration: "none" }} to={"login"}>
                    Tài khoản
                  </Link>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div
          className="w-100  "
          style={{
            height: 60,
            backgroundColor: "#fff",
            borderTop: "1px solid black",
            borderBottom: "1px solid black",
          }}
        >
          <div
            className="d-flex fw-semibold align-items-center h-100 justify-content-between"
            style={{ marginLeft: 200, marginRight: 200 }}
          >
            {navMenu.map((item) => (
              <div className="" key={item.path}>
                <NavLink
                  to={item.path}
                  className={({ isActive }) =>
                    `base-class ${
                      isActive ? "active-class-header" : "inactive-class"
                    } additional-class`
                  }
                  style={{ textDecoration: "none" }}
                >
                  <span style={{ height: "100%" }}>{item.text}</span>
                </NavLink>
              </div>
            ))}
          </div>
        </div>
      </div>
    </>
  );
};

export default Header;
