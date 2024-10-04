import React, { useContext } from "react";
import { Link, NavLink, useNavigate } from "react-router-dom";
import "./css/Header.css";
import path from "../ultis/path";
import icons from "../ultis/icon";
import { navMenu } from "../ultis/menu";
import logoCloudLab from "../assets/images/logo.svg";

const Header = ({ cartItemAmout, favorItemAmount }) => {
  const navigate = useNavigate();

  const handleNaCart = () => {
    navigate("/cart");
  };
  const {
    BsSearch,
    CiLocationOn,
    BiCategoryAlt,
    FaRegHeart,
    FaRegUser,
    MdOutlineShoppingCart,
  } = icons;
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
          style={{ height: 120 }}
          className="d-flex align-items-center justify-content-between px-5"
        >
          <div>
            <img src={logoCloudLab} alt="logo" />
          </div>
          <div className="position-relative">
            <input
              type="text"
              placeholder="Tìm kiếm"
              style={{ width: 500, height: 60, paddingLeft: "12px" }} // Tạo khoảng cách cho icon
              className="form-control rounded"
            />
            <span
              className="position-absolute"
              style={{
                right: "15px",
                top: "50%",
                transform: "translateY(-50%)",
              }}
            >
              <BsSearch />
            </span>
          </div>

          <div className="d-flex gap-4">
            <div className="d-flex align-items-center px-2 py-2 border border-secondary rounded gap-2">
              <span className="d-flex align-items-center">
                <CiLocationOn size={24} />
              </span>
              <span className="">Địa chỉ cửa hảng</span>
            </div>
            <div className="d-flex align-items-center gap-2">
              <div className="d-flex gap-2">
                <div
                  className="position-relative"
                  style={{ display: "inline-block" }}
                >
                  <FaRegHeart size={24} />
                  <span
                    className="position-absolute badge rounded-pill bg-primary"
                    style={{
                      top: "-7px", // Tùy chỉnh khoảng cách từ trên xuống
                      right: "-7px", // Tùy chỉnh khoảng cách từ bên phải
                    }}
                  >
                    {favorItemAmount}
                  </span>
                </div>
                <div>Yêu thích</div>
              </div>

              <div
                className="d-flex gap-2"
                style={{ cursor: "pointer" }}
                onClick={handleNaCart}
              >
                <div
                  className="position-relative"
                  style={{ display: "inline-block" }}
                >
                  <MdOutlineShoppingCart size={24} />
                  <span
                    className="position-absolute badge rounded-pill bg-primary"
                    style={{
                      top: "-7px", // Tùy chỉnh khoảng cách từ trên xuống
                      right: "-7px", // Tùy chỉnh khoảng cách từ bên phải
                    }}
                  >
                    {cartItemAmout}
                  </span>
                </div>
                <span>Giỏ hàng</span>
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

            borderTop: "1px solid black",
            borderBottom: "1px solid black",
          }}
        >
          <div className="d-flex fw-semibold px-5 align-items-center h-100 justify-content-between">
            <div className=" col-md-4" style={{ width: 204 }}>
              <div className="dropdown">
                <a
                  className="btn btn-primary dropdown-toggle"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <BiCategoryAlt className="me-2" size={16} /> Tất cả danh mục
                </a>

                <ul className="dropdown-menu">
                  <li>
                    <a className="dropdown-item" href="#">
                      Action
                    </a>
                  </li>
                  <li>
                    <a className="dropdown-item" href="#">
                      Another action
                    </a>
                  </li>
                  <li>
                    <a className="dropdown-item" href="#">
                      Something else here
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div className=" col-md-8 d-flex align-items-center">
              <div className="row w-100">
                {navMenu.map((item) => (
                  <div className="col-sm-3 px-0" key={item.path}>
                    <NavLink
                      to={item.path}
                      className={({ isActive }) =>
                        `base-class ${
                          isActive ? "active-class" : "inactive-class"
                        } additional-class`
                      }
                      style={{ textDecoration: "none" }}
                    >
                      <span>{item.text}</span>
                    </NavLink>
                  </div>
                ))}
              </div>
            </div>
            <span></span>
          </div>
        </div>
      </div>
    </>
  );
};

export default Header;
