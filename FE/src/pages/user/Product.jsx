import React, { useEffect, useState, useMemo } from "react";
import "./css/Product.css";
import { BoxPro, Sbanner } from "../../components";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faArrowUpZA, faArrowDownAZ } from "@fortawesome/free-solid-svg-icons";
import { useDispatch, useSelector } from "react-redux";
import * as action from "../../store/actions";
import { Brand, Filter } from "../../components";
import { Link, useSearchParams } from "react-router-dom";
import axios from "axios";
import { brandApi, productApi } from "../../apis";

const Product = () => {
  const [pros, setPros] = useState([]);
  const { productsData } = useSelector((state) => state.pro);
  const [phonesData, setPhonesData] = useState([]);
  const [laptopsData, setLaptopsData] = useState([]);
  const [searchParams] = useSearchParams();
  const searchTerm = searchParams.get("search");
  const [active, setActive] = useState(0);
  const [curPage, setCurPage] = useState(1);
  const [itemsPerPage] = useState(8);

  const handleProByBrandUpdate = (proByBrand, cate) => {
    if (cate === "dien-thoai") {
      setPhonesData(proByBrand);
    } else if (cate === "laptop") {
      setLaptopsData(proByBrand);
    }
  };

  useEffect(() => {
    const fetchSearchResults = async () => {
      try {
        if (searchTerm) {
          const results = await productApi.search(searchTerm);
          setPros(results);
        } else if (productsData) {
          setPhonesData(productsData.phone);
          setLaptopsData(productsData.laptop);
        }
      } catch (error) {
        console.error("Không thể lấy dữ liệu tìm kiếm:", error);
      }
    };
    fetchSearchResults();
  }, [searchTerm, productsData]);
  useEffect(() => {
    if (!searchTerm) {
      setPros(active === 0 ? phonesData : laptopsData);
    }
  }, [active, phonesData, laptopsData, searchTerm]);

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
        pro?.product_variant[0]?.variants[0]?.sale ??
        pro?.product_variant[0]?.variants[0]?.price;
      return price >= minPrice && price <= maxPrice;
    });
  }, [pros, minPrice, maxPrice]);

  const curItems = useMemo(() => {
    return filteredPros.slice(indexOfFirstItem, indexOfLastItem);
  }, [filteredPros, indexOfFirstItem, indexOfLastItem]);

  const [sortOrder, setSortOrder] = useState(1);

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
    <div className="container ">
      <section id="header">
        <section className="px-2 mb-2" id="Breadcrumb">
          <div className="container p-3 bg-Breadcrumb ">
            <nav aria-label="breadcrumb">
              <ol className="breadcrumb mb-0">
                <li className="breadcrumb-item">
                  <a href="/" className="route">
                    <i className="fa-solid fa-house" /> Trang chủ
                  </a>
                </li>
                <li className="breadcrumb-item active_route">
                  <a href="/product" className="route">
                    Sản phẩm
                  </a>
                </li>
              </ol>
            </nav>
          </div>
        </section>
        <Sbanner product />
        <div className="row my-3">
          <div className="col-md-6">
            <div className="category-buttons d-flex gap-2 ">
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
          <div className="col-md-6 d-flex align-items-center justify-content-end gap-4">
            <span style={{ cursor: "pointer" }} onClick={() => setSortOrder(1)}>
              <FontAwesomeIcon
                icon={faArrowUpZA}
                size="xl"
                className={`increase ${sortOrder === 1 ? "fa-active" : ""}`}
              />
            </span>
            <span style={{ cursor: "pointer" }} onClick={() => setSortOrder(0)}>
              <FontAwesomeIcon
                icon={faArrowDownAZ}
                size="xl"
                className={`decrease ${sortOrder === 0 ? "fa-active" : ""}`}
              />
            </span>
            <Filter
              minPrice={minPrice}
              maxPrice={maxPrice}
              setMinPrice={setMinPrice}
              setMaxPrice={setMaxPrice}
            />
          </div>
        </div>
      </section>
      <section id="body-product ">
        <div className="row ">
          <div className="col-md-12 p-3">
            {searchTerm && (
              <div>Bạn đang tìm kiếm với từ khóa: {`${searchTerm}`}</div>
            )}

            <div className="row ">
              <Brand
                active={active}
                onProByBrandUpdate={handleProByBrandUpdate}
              />
              <div className="row mt-5 py-2 bg-box">
                {sortedItems.map((item) => (
                  <div key={item?.id} className="col-md-3">
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
        </div>
      </section>
      <section className="pagi">
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
      </section>
    </div>
  );
};

export default Product;
