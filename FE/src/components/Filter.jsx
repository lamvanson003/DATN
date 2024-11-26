import React, { useState } from "react";
import {
  FaMemory,
  FaTv,
  FaSyncAlt,
  FaDatabase,
  FaBolt,
  FaShieldAlt,
  FaFilter,
} from "react-icons/fa";
import "./css/Filter.css";
const filters = [
  // {
  //   title: "RAM",
  //   icon: <FaMemory />,
  //   options: ["3 GB", "4 GB", "6 GB", "8 GB", "12 GB"],
  // },
  // {
  //   title: "Độ phân giải",
  //   icon: <FaTv />,
  //   options: ["QQVGA", "QVGA", "HD+", "Full HD+", "2K+", "Retina (iPhone)"],
  // },
  // {
  //   title: "Tần số quét",
  //   icon: <FaSyncAlt />,
  //   options: ["60 Hz", "90 Hz", "120 Hz", "144 Hz"],
  // },
  {
    title: "Dung lượng lưu trữ",
    icon: <FaDatabase />,
    options: ["64 GB", "128 GB", "256 GB", "512 GB", "1 TB"],
  },
  {
    title: "Màu sắc",
    icon: <FaTv />,
    options: ["Vàng", "Xanh ", "Đỏ", "Tím"],
  },
  // {
  //   title: "Tính năng sạc",
  //   icon: <FaBolt />,
  //   options: ["Sạc nhanh (từ 20W)", "Sạc siêu nhanh (từ 60W)"],
  // },
  // {
  //   title: "Tính năng đặc biệt",
  //   icon: <FaShieldAlt />,
  //   options: ["Kháng nước, bụi", "Hỗ trợ 5G", "Bảo mật khuôn mặt 3D"],
  // },
];

const Filter = ({ minPrice, maxPrice, setMinPrice, setMaxPrice }) => {
  const [isFilterVisible, setIsFilterVisible] = useState(false);
  const [selectedOptions, setSelectedOptions] = useState({
    RAM: null,
    resolution: null,
    refreshRate: null,
    storage: null,
    charging: null,
    specialFeatures: [],
  });

  const handleOptionClick = (filterTitle, option) => {
    setSelectedOptions((prev) => {
      if (filterTitle === "Tính năng đặc biệt") {
        const isSelected = prev.specialFeatures.includes(option);
        return {
          ...prev,
          specialFeatures: isSelected
            ? prev.specialFeatures.filter((item) => item !== option)
            : [...prev.specialFeatures, option],
        };
      } else {
        return {
          ...prev,
          [filterTitle]: prev[filterTitle] === option ? null : option,
        };
      }
    });
  };
  const handleRangeChange = (e) => {
    setMaxPrice(e.target.value);
  };
  const handleFilter = () => {
    console.log("Các tùy chọn lọc đã chọn:", selectedOptions);
    setIsFilterVisible(false); // Đóng modal sau khi áp dụng
  };

  const toggleFilterVisibility = () => {
    setIsFilterVisible((prev) => !prev);
  };

  return (
    <div className="filter-container">
      <button className="filter-button" onClick={toggleFilterVisibility}>
        <FaFilter /> Lọc
      </button>

      {isFilterVisible && (
        <div className="modal-overlay" onClick={toggleFilterVisibility}>
          <div className="modal-content" onClick={(e) => e.stopPropagation()}>
            <h2 className="modal-title">Lọc sản phẩm</h2>
            <div className="modal-body">
              <div className=" range-price">
                <h3>Lọc theo giá</h3>
                <input
                  className="form-range"
                  type="range"
                  value={maxPrice}
                  onChange={handleRangeChange}
                  min="1000000"
                  max="100000000"
                />
                <span className="text-muted">
                  từ: {minPrice} đến: {maxPrice}
                </span>
              </div>
              {filters.map((filter) => (
                <div className="filter-section" key={filter.title}>
                  <h5 className="filter-title">
                    {filter.icon} {filter.title}
                  </h5>
                  <div className="options-container">
                    {filter.options.map((option, index) => (
                      <button
                        key={index}
                        className={`option-button ${
                          selectedOptions[filter.title] === option ||
                          (filter.title === "Tính năng đặc biệt" &&
                            selectedOptions.specialFeatures.includes(option))
                            ? "active"
                            : ""
                        }`}
                        onClick={() => handleOptionClick(filter.title, option)}
                      >
                        {option}
                      </button>
                    ))}
                  </div>
                </div>
              ))}
            </div>
            <div className="modal-footer">
              <button
                className="btn btn-close"
                onClick={toggleFilterVisibility}
              ></button>
              <button className="btn btn-apply" onClick={handleFilter}>
                Áp dụng
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default Filter;
