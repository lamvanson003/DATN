import React, { useState, useRef, useEffect } from "react";
import hotB from "../../assets/images/iHome/hot-banner.png";
import {
  BoxPro,
  Banner,
  Sbanner,
  Countdown,
  Commercial,
  News,
} from "../../components";
import "./css/Home.css";
import { useSelector } from "react-redux";
import { Brand } from "../../components";
const Home = () => {
  const { productsData } = useSelector((state) => state.pro);
  const [phonesData, setPhonesData] = useState([]);
  const [laptopsData, setLaptopsData] = useState([]);
  console.log(productsData);
  useEffect(() => {
    if (productsData) {
      setPhonesData(productsData.phone);
      setLaptopsData(productsData.laptop);
    }
  }, [productsData]);

  return (
    <>
      {/* start banner */}
      <Banner />
      {/* end banner */}
      {/* start category */}
      <Brand />
      {/* end categoy */}
      {/*  start sub banner */}
      <Sbanner />
      {/* end  sub banner */}
      {/* start product */}
      <div className="container mt-5">
        <div className="row justify-content-center">
          <p className="custom-text">Điện thoại</p>
          {phonesData.map((pro, index) => (
            <div key={index} className="col-md-2">
              <BoxPro
                id={pro.id}
                name={pro.name}
                slug={pro.slug}
                image={pro.images}
                brand={pro.brand.name}
                variant={pro.product_variant}
              />
            </div>
          ))}
        </div>
      </div>
      {/* end product */}
      {/* start hot product */}
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
      {/* end  hot product */}
      {/* start countdown */}
      <Countdown />
      {/* end countdown */}
      {/* start special product */}
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
      {/* end special product */}

      {/* start category */}
      <Brand />
      {/* end categoy */}
      {/*  start sub banner */}
      <Sbanner />
      {/* end  sub banner */}
      {/* start product */}
      <div className="container mt-5">
        <div className="row justify-content-center">
          <p className="custom-text">Điện thoại</p>
          {laptopsData.map((pro, index) => (
            <div key={index} className="col-md-2">
              <BoxPro
                id={pro.id}
                name={pro.name}
                slug={pro.slug}
                image={pro.images}
                brand={pro.brand.name}
                variant={pro.product_variant}
              />
            </div>
          ))}
        </div>
      </div>
      {/* end product */}
      {/* start hot product */}
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
      {/* end  hot product */}
      {/* start countdown */}
      <Countdown />
      {/* end countdown */}
      {/* start special product */}
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
      {/* end special product */}
      {/* start Commercial */}
      <Commercial />
      {/* end Commercial */}
      {/* start News */}
      <News />
      {/* end News */}
    </>
  );
};

export default Home;
