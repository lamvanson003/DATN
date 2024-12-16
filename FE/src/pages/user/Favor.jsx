import React, { useEffect, useState, useMemo, act } from "react";
import { Outlet, useNavigate } from "react-router-dom";
import "./css/Product.css";
import { BoxPro, Sbanner } from "../../components";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faArrowUpZA } from "@fortawesome/free-solid-svg-icons";
import { faArrowDownAZ } from "@fortawesome/free-solid-svg-icons";
import { useDispatch, useSelector } from "react-redux";
import { Filter } from "../../components";
import { useContext } from "react";
import { FavorContext } from "../../context/Favor";
import blank from "../../assets/images/iHome/blank.svg";
import "./css/Favor.css";
const Favor = () => {
  const [Pros, setPros] = useState([]);
  const { favorItems, clearFavor } = useContext(FavorContext);
  const [curPage, setCurPage] = useState(1);
  const [itemsPerPage] = useState(8);
  const indexOfLastItem = curPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;

  const pageNumbers = [];
  for (let i = 1; i <= Math.ceil(Pros.length / itemsPerPage); i++) {
    pageNumbers.push(i);
  }
  const paginate = (pageNumber) => setCurPage(pageNumber);

  const [minPrice, setMinPrice] = useState(1000000);
  const [maxPrice, setMaxPrice] = useState(500000000);

  useEffect(() => {
    setPros(favorItems);
  }, [favorItems]);

  const filteredPros = useMemo(() => {
    return Pros?.filter((pro) => {
      const salePrice =
        pro?.product_variant[0]?.variants[0]?.sale ??
        pro?.product_variant[0]?.variants[0]?.price;
      return salePrice >= minPrice && salePrice <= maxPrice;
    });
  }, [Pros, minPrice, maxPrice]);
  const curItems = useMemo(() => {
    return filteredPros.slice(indexOfFirstItem, indexOfLastItem);
  }, [filteredPros, indexOfFirstItem, indexOfLastItem]);

  const [sortOrder, setSortOrder] = useState(1);

  const sortedItems = [...curItems].sort((a, b) => {
    const aPrice =
      a.product_variant[0].variants[0].sale ||
      a.product_variant[0].variants[0].price;
    const bPrice =
      b.product_variant[0].variants[0].sale ||
      b.product_variant[0].variants[0].price;
    return sortOrder === 1 ? aPrice - bPrice : bPrice - aPrice;
  });

  const navigate = useNavigate();
  const handleNaPro = () => {
    navigate("/product");
  };

  return (
    <div className="container ">
      {favorItems.length === 0 ? (
        <div className="favorite-container d-flex flex-column align-items-center justify-content-center mt-3">
          <img src={blank} alt="No Favorites" className="favorite-image" />
          <p className="favorite-text">
            Bạn chưa có sản phẩm yêu thích, quay lại
            <span
              onClick={handleNaPro}
              style={{ color: "blue", marginLeft: 5, cursor: "pointer" }}
            >
              trang sản phẩm
            </span>
          </p>
        </div>
      ) : (
        <div>
          <section id="header">
            <section className=" mb-2" id="Breadcrumb">
              <div className="container py-3 px-0 bg-Breadcrumb ">
                <nav aria-label="breadcrumb">
                  <ol className="breadcrumb mb-0">
                    <li className="breadcrumb-item">
                      <a href="/" className="route">
                        <i className="fa-solid fa-house" /> Trang chủ
                      </a>
                    </li>
                    <li className="breadcrumb-item active_route">
                      <a href="/product" className="route">
                        Sản phẩm yêu thích
                      </a>
                    </li>
                  </ol>
                </nav>
              </div>
            </section>

            <div className="row my-3">
              <div className="col-md-6"></div>
              <div className="col-md-6 d-flex align-items-center justify-content-end gap-4">
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
                <Filter
                  minPrice={minPrice}
                  maxPrice={maxPrice}
                  setMinPrice={setMinPrice}
                  setMaxPrice={setMaxPrice}
                />
              </div>
            </div>
          </section>
          <div className="row justify-content ">
            {sortedItems.map((item) => (
              <div key={item?.id} className="col-md-3">
                <BoxPro
                  id={item.id}
                  name={item.name}
                  category={item.category}
                  brand={item.brand}
                  slug={item.slug}
                  image={item.image}
                  product_image_items={item.product_image_items}
                  variant={item.product_variant}
                />
              </div>
            ))}
          </div>
          <section className="pagi">
            <nav aria-label="Page navigation example">
              <ul className="pagination justify-content-center">
                <li className={`page-item ${curPage === 1 ? "disabled" : ""}`}>
                  <a
                    className="page-link"
                    href="#"
                    aria-label="Previous"
                    onClick={(e) => {
                      e.preventDefault();
                      if (curPage > 1) paginate(curPage - 1);
                    }}
                  >
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                {pageNumbers.map((number) => (
                  <li
                    key={number}
                    className={`page-item ${
                      curPage === number ? "active" : ""
                    }`}
                  >
                    <a
                      onClick={(e) => {
                        e.preventDefault();
                        paginate(number);
                      }}
                      href="#"
                      className="page-link"
                    >
                      {number}
                    </a>
                  </li>
                ))}
                <li
                  className={`page-item ${
                    curPage === pageNumbers.length ? "disabled" : ""
                  }`}
                >
                  <a
                    className="page-link"
                    href="#"
                    aria-label="Next"
                    onClick={(e) => {
                      e.preventDefault();
                      if (curPage < pageNumbers.length) paginate(curPage + 1);
                    }}
                  >
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </section>
        </div>
      )}
    </div>
  );
};

export default Favor;
