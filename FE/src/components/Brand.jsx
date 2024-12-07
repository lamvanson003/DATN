import React, { useEffect, useState } from "react";
import "./css/Brand.css";
import { brandApi } from "../apis";
import { useSelector } from "react-redux";

const Brand = ({ active, onProByBrandUpdate }) => {
  const [brandData, setBrandData] = useState([]);
  const [cate, setCate] = useState("");
  const [selectedBrandId, setSelectedBrandId] = useState(null);
  const [productCount, setProductCount] = useState(0);
  const { productsData } = useSelector((state) => state.pro);

  useEffect(() => {
    if (active === 0) {
      setCate("dien-thoai");
    } else {
      setCate("laptop");
    }
  }, [active]);

  useEffect(() => {
    const fetchBrandData = async () => {
      const res = await brandApi.getAll();
      setBrandData(res.data);
    };
    fetchBrandData();
  }, []);

  useEffect(() => {
    const allProducts =
      cate === "dien-thoai" ? productsData?.phone : productsData?.laptop;
    onProByBrandUpdate(allProducts, cate);
    setSelectedBrandId(null);
    setProductCount(0);
  }, [cate]);

  const handleProByBrand = async (cate, id) => {
    setSelectedBrandId(id);
    try {
      const res = await brandApi.getOneByCate(cate, id);
      const brandProducts = res?.data;
      setProductCount(brandProducts?.length || 0);
      onProByBrandUpdate(brandProducts, cate);
    } catch (error) {
      console.log(error);
    }
  };

  return (
    <div className="container carousel-slide">
      <div className="title-p">
        <h4 className="text-center">Thương hiệu</h4>
      </div>
      <div
        className="carousel slide"
        data-bs-ride="carousel"
        id="brandCarousel"
      >
        <div className="carousel-inner">
          <div className="carousel-item active">
            <div className="brand-carousel">
              {brandData?.map((item) => (
                <div key={item.id} className="brand-card-container">
                  <div
                    className="brand-card"
                    onClick={() => handleProByBrand(cate, item.id)}
                  >
                    <span>
                      <img alt={`${item.name}`} src={item.images} />
                    </span>
                  </div>

                  {selectedBrandId === item.id && (
                    <div className="product-count-message">
                      <span>{`${item.name} có ${productCount} sản phẩm`}</span>
                    </div>
                  )}
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Brand;
