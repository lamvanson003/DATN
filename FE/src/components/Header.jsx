import React, { useContext, useEffect, useState, useRef } from "react";
import { Link, NavLink, useLocation, useNavigate } from "react-router-dom";
import "./css/Header.css";
import path from "../ultis/path";
import icons from "../ultis/icon";
import { navMenu } from "../ultis/menu";
import logoCloudLab from "../assets/images/logo.svg";
import fire from "../assets/images/iHome/fire.png";
import { useSelector } from "react-redux";
import Fuse from "fuse.js";
import { BoxPro } from ".";
import { CartContext } from "../context/Cart";
import { formatCurrency } from "../ultis/func";
import { productApi } from "../apis";
import { useParams } from "react-router-dom";
import { debounce } from "../ultis/func";
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
  BiLogIn,
  FaKey,
  IoMdListBox,
} = icons;
const Header = ({ cartItemAmout, favorItemAmount }) => {
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
    setSearchTerm(term);
    debouncedSearch(term);
  };
  const debouncedSearch = debounce(async (term) => {
    if (!term) {
      setSearchProducts([]);
      return;
    }

    const fuseOptions = {
      keys: ["name"],
      threshold: 0.3,
      includeScore: true,
    };

    const allProducts = await productApi.search(term);

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
  }, 1000);
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
      navigate(`/product?search=${encodeURIComponent(searchTerm)}`);
    }
  };

  const handleClickHistoryInSearch = (term) => {
    setSearchTerm(term);
    handleSearch({ target: { value: term } });
    setIsFocus(true);
    navigate(`/product?search=${encodeURIComponent(term)}`);
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
      <div style={{ backgroundColor: "#007bff" }}>
        <div className="d-flex flex-column ">
          <div
            className="container marquee-container"
            style={{ height: 30, color: "#fff" }}
          >
            <span className="marquee-text">
              <img style={{ margin: "0px 4px" }} width={16} src={fire} alt="" />
              <img style={{ margin: "0px 4px" }} width={16} src={fire} alt="" />
              <img style={{ margin: "0px 4px" }} width={16} src={fire} alt="" />
              Thông báo: Khuyến mãi lên đến 50% tất cả các mặt hàng tại
              CloudLab!
              <img style={{ margin: "0px 4px" }} width={16} src={fire} alt="" />
              <img style={{ margin: "0px 4px" }} width={16} src={fire} alt="" />
              <img style={{ margin: "0px 4px" }} width={16} src={fire} alt="" />
            </span>
          </div>
          <div style={{ backgroundColor: "#fff" }}>
            <div
              style={{ height: 120 }}
              className="d-flex align-items-center justify-content-between container "
            >
              <div
                style={{
                  padding: 20,
                }}
                className="rounded-pill"
              >
                <img src={logoCloudLab} alt="logo" />
              </div>
              <div className="position-relative" ref={wrapperRef}>
                <form action="">
                  <input
                    type="text"
                    placeholder="Tìm kiếm"
                    style={{
                      width: 500,
                      height: 40,
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
                {isFocus && (
                  <div
                    className="search-container position-absolute"
                    style={{
                      backgroundColor: "#fff",
                      color: "#333",
                      width: 500,
                      padding: 12,
                      borderRadius: 8,
                      boxShadow: "0px 4px 12px rgba(0, 0, 0, 0.3)",
                      zIndex: 100,
                    }}
                  >
                    <div
                      className=" d-flex justify-content-between align-items-center pb-1"
                      style={{ borderBottom: "1px solid black" }}
                    >
                      <span className="d-flex align-items-center gap-1 ">
                        <MdHistory size={20} />
                        <span style={{ fontWeight: 600 }}>
                          Lịch sử tìm kiếm
                        </span>
                      </span>
                      <span
                        onClick={handleDeleteSearch}
                        className="delete-icon"
                        onMouseDown={(e) => e.preventDefault()}
                        style={{ cursor: "pointer" }}
                      >
                        <ImBin2 />
                      </span>
                    </div>

                    <div className="search-history mt-2">
                      {searchHistory.map((term, index) => (
                        <div
                          key={index}
                          className="history-item "
                          onClick={() => handleClickHistoryInSearch(term)}
                          onMouseDown={(e) => e.preventDefault()}
                          style={{
                            cursor: "pointer",
                            padding: "8px 8px",
                            borderRadius: 4,
                            transition: "background-color 0.2s ease",
                          }}
                        >
                          {term}
                        </div>
                      ))}
                    </div>

                    {searchProducts.length > 0 && (
                      <div className="suggestions mt-3">
                        <div
                          className=" d-flex justify-content-between align-items-center pb-1"
                          style={{ borderBottom: "1px solid black" }}
                        >
                          <span className="d-flex align-items-center gap-1">
                            <MdOutlineSettingsSuggest size={20} />
                            <span style={{ fontWeight: 600 }}>
                              Sản phẩm gợi ý
                            </span>
                          </span>
                        </div>

                        <div className="search-results mt-2">
                          {searchProducts.map((item, index) => (
                            <div key={index} className="suggestion-item my-1">
                              <BoxPro
                                horizon
                                slug={item.slug}
                                image={item.images}
                                id={item.id}
                                name={item.name}
                                variant={item.product_variant}
                                style={{
                                  backgroundColor: "rgba(255, 255, 255, 0.1)",
                                  padding: "8px 12px",
                                  borderRadius: 4,
                                  transition: "background-color 0.2s ease",
                                }}
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
                <div className="d-flex align-items-center gap-5">
                  <div
                    className="d-flex gap-2"
                    style={{ cursor: "pointer" }}
                    onClick={handleNaFa}
                  >
                    <div
                      className="position-relative"
                      style={{ display: "inline-block" }}
                    >
                      <FaRegHeart size={40} />
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
                  </div>

                  <div
                    className="cart-container"
                    onMouseEnter={handleHoverInCart}
                    onMouseLeave={handleHoverOutCart}
                  >
                    <div
                      className="d-flex gap-2 "
                      style={{ cursor: "pointer" }}
                    >
                      <div
                        className="position-relative"
                        style={{ display: "inline-block" }}
                        onClick={handleNaCart}
                      >
                        <MdOutlineShoppingCart size={40} />
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

                      {isHover && (
                        <div
                          className="cart-dropdown rounded"
                          onMouseEnter={handleHoverInCart}
                          onMouseLeave={handleHoverOutCart}
                        >
                          {cartItems?.map((item) => (
                            <div
                              className="cart-dropdown-item "
                              key={item.variantKey}
                            >
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
                </div>
              </div>
            </div>
          </div>

          <div
            style={{
              height: 50,
              borderTop: "1px solid black",
              borderBottom: "1px solid black",
              backgroundColor: "#007bff",
            }}
          >
            <div className="d-flex fw-semibold align-items-center justify-content-between h-100  container ">
              <div
                className="d-flex align-items-center fixFontsize "
                style={{ gap: 50 }}
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
                      style={{ textDecoration: "none", color: "#fff" }}
                    >
                      <span style={{ height: "100%" }}>{item.text}</span>
                    </NavLink>
                  </div>
                ))}
              </div>

              <div className="d-flex gap-2 text-white gap-4">
                <span className="d-flex align-items-center gap-1">
                  <IoMdListBox size={20} />
                  <Link
                    style={{ textDecoration: "none", color: "#fff" }}
                    to={"search-order"}
                  >
                    Tra cứu đơn hàng
                  </Link>
                </span>
                <span className="d-flex align-items-center gap-1">
                  <BiLogIn size={20} />
                  <Link
                    style={{ textDecoration: "none", color: "#fff" }}
                    to={"login"}
                  >
                    Đăng nhập
                  </Link>
                </span>
                <span className="d-flex align-items-center gap-1">
                  <FaKey size={16} />
                  <Link
                    style={{ textDecoration: "none", color: "#fff" }}
                    to={"signup"}
                  >
                    Đăng ký
                  </Link>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default Header;
