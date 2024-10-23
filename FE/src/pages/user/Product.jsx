import React, { useEffect, useState, useMemo } from "react";
import "./css/Product.css";
import { BoxPro } from "../../components";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faArrowUpZA, faArrowDownAZ } from "@fortawesome/free-solid-svg-icons";
import { useDispatch, useSelector } from "react-redux";
import * as action from "../../store/actions";
import { Brand, Filter } from "../../components";
import { Link } from "react-router-dom";
import axios from "axios";

const Product = () => {
  const [pros, setPros] = useState([]);
  const { productsData } = useSelector((state) => state.pro);
  const [phonesData, setPhonesData] = useState([]);
  const [laptopsData, setLaptopsData] = useState([]);

  useEffect(() => {
    if (productsData) {
      setPhonesData(productsData.phone);
      setLaptopsData(productsData.laptop);
    }
    console.log(productsData);
  }, [productsData]);

  const [active, setActive] = useState(0);
  const [curPage, setCurPage] = useState(1);
  const [itemsPerPage] = useState(8);

  const indexOfLastItem = curPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;

  const pageNumbers = [];
  for (let i = 1; i <= Math.ceil(pros.length / itemsPerPage); i++) {
    pageNumbers.push(i);
  }

  const paginate = (pageNumber) => setCurPage(pageNumber);
  useEffect(() => {
    setPros(active === 0 ? phonesData : laptopsData);
  }, [active, phonesData, laptopsData]);

  const [minPrice, setMinPrice] = useState(1000000);
  const [maxPrice, setMaxPrice] = useState(100000000);

  const filteredPros = useMemo(() => {
    return pros.filter((pro) => {
      const price =
        pro.product_variant[0].variants[0].sale ??
        pro.product_variant[0].variants[0].price;
      return price >= minPrice && price <= maxPrice;
    });
  }, [pros, minPrice, maxPrice]);

  const curItems = useMemo(() => {
    return filteredPros.slice(indexOfFirstItem, indexOfLastItem);
  }, [filteredPros, indexOfFirstItem, indexOfLastItem]);

  const handleRangeChange = (e) => {
    setMaxPrice(e.target.value);
  };

  const [sortOrder, setSortOrder] = useState(1); // 1: tăng dần, 0: giảm dần

  const sortedItems = useMemo(() => {
    const itemsToSort = [...curItems];
    itemsToSort.sort((a, b) => {
      const aPrice =
        a.product_variant[0].variants[0].sale ||
        a.product_variant[0].variants[0].price;
      const bPrice =
        b.product_variant[0].variants[0].sale ||
        b.product_variant[0].variants[0].price;
      return sortOrder === 1 ? aPrice - bPrice : bPrice - aPrice;
    });
    return itemsToSort;
  }, [curItems, sortOrder]);

  return (
    <div className="container mt-5">
      <section id="header">
        <div className="row">
          <div className="d-flex"></div>
          <div className=" bg-Breadcrumb row">
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
          <div className="row mb-3">
            <div className="col-md-4"></div>
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
            <div className="category">
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
            </div>
            <div className="range-prices">
              <h3>Lọc theo giá</h3>
              <hr />
              <input
                className="form-range"
                id="customRange1"
                type="range"
                value={maxPrice}
                onChange={handleRangeChange}
                min="1000000"
                max="100000000"
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
              {sortedItems.map((item) => (
                <div key={item?.id} className="col-md-2-product">
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
        </div>
      </section>
      <section className="pagi">
        <div className="row">
          <div className="col-md-3"></div>
          <div className="col-md-9">
            <nav aria-label="Page navigation example">
              <ul className="pagination justify-content-center">
                <li className="page-item">
                  <a
                    className="page-link"
                    href="#"
                    aria-label="Previous"
                    onClick={(e) => {
                      e.preventDefault();
                      paginate(curPage - 1);
                    }}
                  >
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
                  <a
                    className="page-link"
                    href="#"
                    aria-label="Next"
                    onClick={(e) => {
                      e.preventDefault();
                      paginate(curPage + 1);
                    }}
                  >
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

export default Product;
