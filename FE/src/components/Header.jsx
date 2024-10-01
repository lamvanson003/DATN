import React from "react";
import { Link, NavLink } from "react-router-dom";
import "./css/Header.css";
import path from "../ultis/path";
const Header = () => {
  return (
    <>
      <div className="top-bar">
        100% Giao hàng đến bạn trong thời gian nhanh nhất
        <span className="float-end me-3">Hotline + 1800 900</span>
      </div>
      <nav className="navbar navbar-expand-lg navbar-light bg-white">
        <div className="container-fluid">
          <a className="navbar-brand" href="#">
            <img alt="CloudLAB logo" src="/src/assets/image/logo.svg" />
          </a>
          <form className="d-flex search-bar mx-auto">
            <input
              aria-label="Search"
              className="form-control me-2 "
              placeholder="Tìm kiếm"
              type="search"
            />
            <button className="btn" type="submit">
              <i className="fas fa-search" />
            </button>
          </form>
          <div className="d-flex">
            <a className="icon-text  icon-badge" href="#">
              <i className="fas fa-map-marker-alt" />
              <span>Địa chỉ cửa hàng</span>
            </a>
            <a className="icon-text icon-badge" href="#">
              <i className="fas fa-heart" />
              <span className="badge rounded-pill">6</span>
              <span>Yêu thích</span>
            </a>
            <a className="icon-text icon-badge" href="#">
              <i className="fas fa-shopping-cart" />
              <span className="badge rounded-pill">2</span>
              <span>Giỏ hàng</span>
            </a>
            <a className="icon-text  icon-badge" href="#">
              <i className="fas fa-user" />
              <span>Tài khoản</span>
            </a>
          </div>
        </div>
      </nav>
      <nav className="navbar navbar-expand-lg navbar-light bg-white">
        <div className="container-fluid">
          <button
            aria-expanded="false"
            className="btn btn-primary dropdown-toggle"
            data-bs-toggle="dropdown"
            id="categoryDropdown"
            type="button"
          >
            <i className="fas fa-th-large"></i>
            Tất cả danh mục
          </button>
          <ul aria-labelledby="categoryDropdown" className="dropdown-menu">
            <li>
              <a className="dropdown-item" href="#">
                Danh mục 1
              </a>
            </li>
            <li>
              <a className="dropdown-item" href="#">
                Danh mục 2
              </a>
            </li>
            <li>
              <a className="dropdown-item" href="#">
                Danh mục 3
              </a>
            </li>
          </ul>
          <div className="collapse navbar-collapse">
            <ul className="navbar-nav mx-auto mb-2 mb-lg-0">
              <li className="nav-item">
                <a className="nav-link" href="#">
                  Deals
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="#">
                  Trang chủ
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="#">
                  Về chúng tôi
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="#">
                  Cửa hàng
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="#">
                  Trang
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="#">
                  Liên hệ
                </a>
              </li>
            </ul>
            <a className="icon-text icon-badge" href="#">
              <i className="fas fa-balance-scale"></i>
              <span className="badge rounded-pill">6</span>
              <span>So sánh</span>
            </a>
          </div>
        </div>
      </nav>
    </>
  );
};

export default Header;
