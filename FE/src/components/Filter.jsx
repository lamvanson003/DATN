import React, { useState } from "react";
const filters = [
  {
    title: "RAM",
    options: ["3 GB", "4 GB", "6 GB", "8 GB", "12 GB"],
  },
  {
    title: "Độ phân giải",
    options: ["QQVGA", "QVGA", "HD+", "Full HD+", "2K+", "Retina (iPhone)"],
  },
  {
    title: "Tần số quét",
    options: ["60 Hz", "90 Hz", "120 Hz", "144 Hz"],
  },
  {
    title: "Dung lượng lưu trữ",
    options: ["64 GB", "128 GB", "256 GB", "512 GB", "1 TB"],
  },
  {
    title: "Tính năng sạc",
    options: ["Sạc nhanh (từ 20W)", "Sạc siêu nhanh (từ 60W)"],
  },
  {
    title: "Tính năng đặc biệt",
    options: ["Kháng nước, bụi", "Hỗ trợ 5G", "Bảo mật khuôn mặt 3D"],
  },
];
const Filter = () => {
  const [selectedFilter, setSelectedFilter] = useState({
    RAM: null,
    resolution: null,
    refreshRate: null,
    storage: null,
    charging: null,
    specialFeatures: [],
  });
  const handleSelect = (filterTitle, value) => {
    selectedFilter((prev) => {
      if (filterTitle === "Tính năng đặc biệt") {
        const currentSelection = prev[filterTitle];
      }
    });
  };
  return (
    <div className="filter-container">
      {filters.map((filter, index) => (
        <div
          className="check-box mb-4 p-3 rounded"
          key={index}
          style={{ boxShadow: "0px 6px 15px rgba(0, 0, 0, 0.2)" }}
        >
          <h5>
            <strong>{filter.title}</strong>
          </h5>
          {filter.options.map((option, optionIndex) => (
            <div className="form-check" key={optionIndex}>
              <input
                className="form-check-input"
                id={`${filter.title
                  .toLowerCase()
                  .replace(/\s+/g, "-")}-${optionIndex}`}
                type="radio" // Thay đổi thành radio để chỉ chọn 1 option
                // checked={selectedFilters[filter.title] === option}
                // onChange={() => handleSelect(filter.title, option)}
              />
              <label
                className="form-check-label"
                htmlFor={`${filter.title
                  .toLowerCase()
                  .replace(/\s+/g, "-")}-${optionIndex}`}
              >
                {option}
              </label>
            </div>
          ))}
        </div>
      ))}
      <div className="filter-button mt-2">
        <button className="btn btn-primary" type="button">
          Lọc
        </button>
      </div>
    </div>
  );
};

export default Filter;
