import React, { useEffect, useState, useMemo, act } from "react";
import { Outlet } from "react-router-dom";
import "./css/Product.css";
import { BoxPro } from "../../components";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faArrowUpZA } from "@fortawesome/free-solid-svg-icons";
import { faArrowDownAZ } from "@fortawesome/free-solid-svg-icons";
import { useDispatch, useSelector } from "react-redux";
import * as action from "../../store/actions";
import { Brand, Filter } from "../../components";
import { Link } from "react-router-dom";
import { useContext } from "react";
import axios from "axios";
import { FavorContext } from "../../context/Favor";
const Favor = () => {
  const { isLoading } = useSelector((state) => state.app);
  const dispatch = useDispatch();
  const [Pros, setPros] = useState([]);
  const [phone, setPhone] = useState([]);
  const [laptop, setLaptop] = useState([]);
  const { favorItems } = useContext(FavorContext);
  const [curPage, setCurPage] = useState(1);
  const [itemsPerPage] = useState(8);
  const indexOfLastItem = curPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;

  const pageNumbers = [];
  for (let i = 1; i <= Math.ceil(Pros.length / itemsPerPage); i++) {
    pageNumbers.push(i);
  }
  const paginate = (pageNumber) => setCurPage(pageNumber);

  const [minPrice, setMinPrice] = useState(100);
  const [maxPrice, setMaxPrice] = useState(50000000);
  // Thiết lập giá trị ban đầu cho Pros từ favorItems
  useEffect(() => {
    setPros(favorItems);
  }, [favorItems]); // Chỉ cập nhật khi favorItems thay đổi

  const filteredPros = useMemo(() => {
    return Pros.filter((pro) => pro.sale >= minPrice && pro.sale <= maxPrice);
  }, [Pros, minPrice, maxPrice]);
  const curItems = useMemo(() => {
    return filteredPros.slice(indexOfFirstItem, indexOfLastItem);
  }, [filteredPros, indexOfFirstItem, indexOfLastItem]);

  const handleRangeChange = (e) => {
    setMaxPrice(e.target.value);
  };
  const [sortOrder, setSortOrder] = useState(1); // 1: tăng dần, 0: giảm dần
  const sortedItems = useMemo(() => {
    const sorted = [...curItems]; // Tạo một bản sao của curItems để tránh thay đổi trực tiếp
    if (sortOrder) {
      return sorted.sort((a, b) => a.sale - b.sale); // Sắp xếp tăng dần
    } else {
      return sorted.sort((a, b) => b.sale - a.sale); // Sắp xếp giảm dần
    }
  }, [curItems, sortOrder]);

  return (
    <div className="container mt-5">
      <section id="header">
        <div className="row">
          <div className="d-flex"></div>
          <div className=" p-3 bg-Breadcrumb row">
            <nav aria-label="breadcrumb">
              <ol className="breadcrumb mb-0">
                <li className="breadcrumb-item">
                  <Link to="/">TRANG CHỦ</Link>
                </li>
                <li className="breadcrumb-item">
                  <span>SẢN PHẨM</span>
                </li>
              </ol>
            </nav>
          </div>
          <div className="row my-3">
            <div className="col-md-4">
              <h2>SẢN PHẨM YÊU THÍCH</h2>
            </div>
            <div className="col-md-8">
              <div
                className="d-flex align-items-center justify-content-end gap-4"
                style={{ height: "100%" }}
              >
                <span
                  style={{ cursor: "pointer" }}
                  onClick={() => setSortOrder(1)}
                >
                  <FontAwesomeIcon
                    icon={faArrowUpZA}
                    size="xl"
                    className={`increase ${sortOrder === 1 ? "fa-active" : ""}`}
                  />
                </span>
                <span
                  style={{ cursor: "pointer" }}
                  onClick={() => setSortOrder(0)}
                >
                  <FontAwesomeIcon
                    icon={faArrowDownAZ}
                    size="xl"
                    className={`decrease ${sortOrder === 0 ? "fa-active" : ""}`}
                  />
                </span>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="body-product mt-5">
        <div className="row">
          <div className="col-md-3 p-3">
            {/* <div className="category">
              <h3>Danh mục</h3>
              <hr />
              <div className="category-name">
                <button
                  className={`btn ${
                    active === 0 ? "btn-primary" : "btn-secondary"
                  }`}
                  onClick={() => setActive(0)}
                >
                  Điện thoại
                </button>
                <button
                  className={`btn ${
                    active === 1 ? "btn-primary" : "btn-secondary"
                  }`}
                  onClick={() => setActive(1)}
                >
                  Laptop
                </button>
              </div>
            </div> */}
            <div className="range-prices">
              <h3>Lọc theo giá</h3>
              <hr />
              <input
                className="form-range"
                id="customRange1"
                type="range"
                value={maxPrice}
                onChange={handleRangeChange}
                min="100"
                max="50000000"
              />
              <span>
                từ: {minPrice} đến: {maxPrice}
              </span>
            </div>
            <Filter />
          </div>
          <div className="col-md-9 p-3">
            <div className="row justify-content gap-3">
              <Brand />
              {sortedItems &&
                sortedItems.map((item) => (
                  <div key={item?.id} className="col-md-2-product">
                    <BoxPro
                      pid={item?.id}
                      name={item?.main?.name}
                      slug={item?.slug}
                      image={item?.images}
                      brand={item?.brand?.name}
                      variant={item?.product_variant}
                    />
                  </div>
                ))}
            </div>
          </div>
        </div>
      </section>
      <section className="pagi">
        <div className="row">
          <div className="col-md-3"></div>
          <div className="col-md-9">
            <nav aria-label="Page navigation example">
              <ul className="pagination justify-content-center">
                <li className="page-item">
                  <a className="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                {pageNumbers.map((number) => (
                  <li key={number} className="page-item">
                    <a
                      onClick={() => paginate(number)}
                      href="#"
                      className="page-link"
                    >
                      {number}
                    </a>
                  </li>
                ))}
                <li className="page-item">
                  <a className="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Favor;
