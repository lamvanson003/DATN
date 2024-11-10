import React, { useState, useRef, useEffect } from "react";
import hotB from "../../assets/images/iHome/hot-banner.png";
import {
  BoxPro,
  Banner,
  Sbanner,
  Countdown,
  Commercial,
  News,
  FlashSale,
  Recommend,
} from "../../components";
import "./css/Home.css";
import { useSelector } from "react-redux";
import { Brand } from "../../components";
const Home = () => {
  const url = new URL(window.location.href);
  const responseCode = url.searchParams.get("vnp_ResponseCode");
  console.log("vnp_ResponseCode:", responseCode);
  const { productsData } = useSelector((state) => state.pro);
  const [phonesData, setPhonesData] = useState([]);
  const [laptopsData, setLaptopsData] = useState([]);

  useEffect(() => {
    if (productsData) {
      setPhonesData(productsData.phone);
      setLaptopsData(productsData.laptop);
    }
  }, [productsData]);

  return (
    <>
      <Banner />

      <Sbanner />

      <Brand />

      <div className="container mt-5">
        <span className="d-flex align-items-center justify-content-between">
          <span className="browseCloudlab">Sản phẩm mới ra mắt</span>
          <span className="browseCloudlab">Sản phẩm bán chạy</span>
          <span className="browseCloudlab">Sản phẩm được đánh giá cao</span>
          <span className="browseCloudlab">Phù hợp với bạn</span>
        </span>
      </div>

      <FlashSale fsproducts={phonesData} itemsPerPage={4} />

      <div className="container mt-5">
        <div className="row justify-content-start">
          <span className="d-flex justify-content-between align-items-center">
            <span className="fw-bold fs-3">Điện thoại</span>
          </span>
          {phonesData.map((pro, index) => (
            <div key={index} className="col-md-2">
              <BoxPro
                id={pro.id}
                name={pro.name}
                category={pro.category}
                brand={pro.brand}
                slug={pro.slug}
                image={pro.images}
                product_image_items={pro.product_image_items}
                variant={pro.product_variant}
              />
            </div>
          ))}
        </div>
      </div>
      <Recommend />
      <div className="container mt-5">
        <div className="row  flex-nowrap">
          <div className="col-md-2">
            <div className="hot-product position-relative">
              <h5 className="text-center">DEAL HOT</h5>
              <img src={hotB} alt="Hot Banner 1 Image" className="img-fluid" />
            </div>
          </div>
          <div className="outer-container">
            {Array(4)
              .fill(0)
              .map((_, index) => (
                <div key={index} className="col-md-2">
                  <BoxPro />
                </div>
              ))}
          </div>
        </div>
      </div>

      <div className="container mt-5">
        <div className="row  flex-nowrap">
          <div className="special-container">
            <div className="special-title">
              <h4 className="text-center">sản phẩm nổi bật của Appe</h4>
              <div className="dropdown-special">
                <button
                  aria-expanded="false"
                  className="btn btn-primary dropdown-toggle"
                  data-bs-toggle="dropdown"
                  id="dropdownMenuButton"
                  type="button"
                >
                  Apple
                </button>
                <ul
                  aria-labelledby="dropdownMenuButton"
                  className="dropdown-menu"
                >
                  <li>
                    <a className="dropdown-item" href="#">
                      Option 1
                    </a>
                  </li>
                  <li>
                    <a className="dropdown-item" href="#">
                      Option 2
                    </a>
                  </li>
                  <li>
                    <a className="dropdown-item" href="#">
                      Option 3
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            {Array(3)
              .fill(0)
              .map((_, index) => (
                <div key={index} className="col-md-2">
                  <BoxPro hot />
                </div>
              ))}
          </div>
          <div className="col-md-2">
            <div className="special-product position-relative">
              <h5 className="text-center">DEAL HOT</h5>
              <img src={hotB} alt="Hot Banner 1 Image" className="img-fluid" />
            </div>
          </div>
        </div>
      </div>

      <Countdown />

      <div className="container mt-5">
        <div className="row justify-content-start">
          <p className="custom-text">Laptop</p>
          {laptopsData.map((pro, index) => (
            <div key={index} className="col-md-2">
              <BoxPro
                id={pro.id}
                name={pro.name}
                category={pro.category}
                brand={pro.brand}
                slug={pro.slug}
                image={pro.images}
                product_image_items={pro.product_image_items}
                variant={pro.product_variant}
              />
            </div>
          ))}
        </div>
      </div>

      <div className="container mt-5">
        <div className="row  flex-nowrap">
          <div className="col-md-2">
            <div className="hot-product position-relative">
              <h5 className="text-center">DEAL HOT</h5>
              <img src={hotB} alt="Hot Banner 1 Image" className="img-fluid" />
            </div>
          </div>
          <div className="outer-container">
            {Array(4)
              .fill(0)
              .map((_, index) => (
                <div key={index} className="col-md-2">
                  <BoxPro />
                </div>
              ))}
          </div>
        </div>
      </div>

      <div className="container mt-5">
        <div className="row  flex-nowrap">
          <div className="special-container">
            <div className="special-title">
              <h4 className="text-center">sản phẩm nổi bật của Appe</h4>
              <div className="dropdown-special">
                <button
                  aria-expanded="false"
                  className="btn btn-primary dropdown-toggle"
                  data-bs-toggle="dropdown"
                  id="dropdownMenuButton"
                  type="button"
                >
                  Apple
                </button>
                <ul
                  aria-labelledby="dropdownMenuButton"
                  className="dropdown-menu"
                >
                  <li>
                    <a className="dropdown-item" href="#">
                      Option 1
                    </a>
                  </li>
                  <li>
                    <a className="dropdown-item" href="#">
                      Option 2
                    </a>
                  </li>
                  <li>
                    <a className="dropdown-item" href="#">
                      Option 3
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            {Array(3)
              .fill(0)
              .map((_, index) => (
                <div key={index} className="col-md-2">
                  <BoxPro hot />
                </div>
              ))}
          </div>
          <div className="col-md-2">
            <div className="special-product position-relative">
              <h5 className="text-center">DEAL HOT</h5>
              <img src={hotB} alt="Hot Banner 1 Image" className="img-fluid" />
            </div>
          </div>
        </div>
      </div>

      <Commercial />

      <News />
    </>
  );
};

export default Home;
