import React, { useEffect, useState } from "react";
import { Outlet } from "react-router-dom";
import "./css/Product.css";
import { BoxPro } from "../../components";
const Product = () => {
  const [Pros, setPros] = useState([]);
  const [phone, setPhone] = useState([]);
  const [laptop, setLaptop] = useState([]);
  const [active, setActive] = useState(0);
  const [curPage, setCurPage] = useState(1);
  const [itemsPerPage] = useState(8);
  const indexOfLastItem = curPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;

  const pageNumbers = [];
  for (let i = 1; i <= Math.ceil(Pros.length / itemsPerPage); i++) {
    pageNumbers.push(i);
  }
  const paginate = (pageNumber) => setCurPage(pageNumber);
  useEffect(() => {
    const fetchDataPhone = async () => {
      const res = await fetch("/data.json");
      if (!res.ok) {
        console.error("Lỗi");
        return;
      }
      const data = await res.json();
      setPhone(data);
    };
    const fetchDataLaptop = async () => {
      const res = await fetch("/datalaptop.json");
      if (!res.ok) {
        console.error("Lỗi");
        return;
      }
      const data = await res.json();
      setLaptop(data);
    };
    fetchDataPhone();
    fetchDataLaptop();
  }, []);

  const [minPrice, setMinPrice] = useState(100);
  const [maxPrice, setMaxPrice] = useState(2000);
  const filteredPros = Pros.filter(
    (pro) => pro.price > minPrice && pro.price < maxPrice
  );
  const curItems = filteredPros.slice(indexOfFirstItem, indexOfLastItem);
  useEffect(() => {
    if (active === 0) {
      setPros(phone);
    } else {
      setPros(laptop);
    }
  }, [active, phone, laptop]);
  const handleRangeChange = (e) => {
    setMaxPrice(e.target.value);
  };

  return (
    <div className="container mt-5">
      <section id="header">
        <div className="row">
          <div className=" p-3 bg-Breadcrumb row my-3">
            <nav aria-label="breadcrumb">
              <ol className="breadcrumb mb-0">
                <li className="breadcrumb-item">
                  <a href="/">
                    <i className="fa-solid fa-house" /> TRANG CHỦ
                  </a>
                </li>
                <li className="breadcrumb-item">
                  <a href="/product"> DANH MỤC </a>
                </li>
                <li className="breadcrumb-item">
                  <a href="#"> SẢN PHẨM </a>
                </li>
              </ol>
            </nav>
          </div>
          <div className="row my-3">
            <div className="col-md-4">
              <h2>Thương hiệu</h2>
            </div>
            <div className="col-md-8">
              <div className="brand-container">
                <div className="dropdown">
                  <button
                    className="btn dropdown-toggle"
                    type="button"
                    id="dropdownBrand"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    Chọn thương hiệu
                  </button>
                  <ul className="dropdown-menu" aria-labelledby="dropdownBrand">
                    <li>
                      <a className="dropdown-item" href="#!">
                        Thương hiệu 1
                      </a>
                    </li>
                    <li>
                      <a className="dropdown-item" href="#!">
                        Thương hiệu 2
                      </a>
                    </li>
                    <li>
                      <a className="dropdown-item" href="#!">
                        Thương hiệu 3
                      </a>
                    </li>
                    <li>
                      <a className="dropdown-item" href="#!">
                        Thương hiệu 4
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="body-product mt-5">
        <div className="row">
          <div className="col-md-3">
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
                min="100"
                max="2000"
              />
              <span>
                từ: {minPrice} đến: {maxPrice}
              </span>
              <div className="check-box">
                <h5>
                  <strong>Tình trạng hàng</strong>
                </h5>
                <div className="form-check">
                  <input
                    className="form-check-input"
                    defaultValue=""
                    id="flexCheckDefault"
                    type="checkbox"
                  />
                  <label
                    className="form-check-label"
                    htmlFor="flexCheckDefault"
                  >
                    Mới
                  </label>
                </div>
                <div className="form-check">
                  <input
                    className="form-check-input"
                    defaultValue=""
                    id="flexCheckDefault"
                    type="checkbox"
                  />
                  <label
                    className="form-check-label"
                    htmlFor="flexCheckDefault"
                  >
                    Hàng cũ
                  </label>
                </div>
                <div className="form-check">
                  <input
                    className="form-check-input"
                    defaultChecked
                    defaultValue=""
                    id="flexCheckChecked"
                    type="checkbox"
                  />
                  <label
                    className="form-check-label"
                    htmlFor="flexCheckChecked"
                  >
                    Sắp ra mắt
                  </label>
                </div>
                <div className="filter-button">
                  <button className="btn btn-primary" type="button">
                    Lọc
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div className="col-md-9 p-3">
            <div className="row justify-content gap-3">
              {curItems &&
                curItems.map((item) => (
                  <div key={item.id} className="col-md-2-product">
                    <BoxPro pro={item} />
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

export default Product;
