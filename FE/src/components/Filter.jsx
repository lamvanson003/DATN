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

const filterKeyMap = {
  RAM: "RAM",
  "Độ phân giải": "resolution",
  "Tần số quét": "refreshRate",
  "Dung lượng lưu trữ": "storage",
  "Tính năng sạc": "charging",
  "Tính năng đặc biệt": "specialFeatures",
};

const Filter = () => {
  const [selectedFilters, setSelectedFilters] = useState({
    RAM: null,
    resolution: null,
    refreshRate: null,
    storage: null,
    charging: null,
    specialFeatures: [],
  });

  const handleSelect = (filterTitle, value) => {
    const key = filterKeyMap[filterTitle];

    setSelectedFilters((prev) => {
      if (key === "specialFeatures") {
        // Kiểm tra nếu đã chọn tính năng đó, thì bỏ chọn, ngược lại thì thêm vào
        const currentSelection = prev.specialFeatures;
        if (currentSelection.includes(value)) {
          return {
            ...prev,
            specialFeatures: currentSelection.filter((item) => item !== value),
          };
        } else {
          return {
            ...prev,
            specialFeatures: [...currentSelection, value],
          };
        }
      }
      return {
        ...prev,
        [key]: value,
      };
    });
  };

  const handleFilter = () => {
    console.log("Các tùy chọn lọc: ", selectedFilters);
  };

  return (
    <div className="filter-container">
      {filters.map((filter, index) => (
        <div
          className="check-box mb-4 p-3 rounded"
          key={filter.title} // Sử dụng filter.title làm key vì nó duy nhất
          style={{ boxShadow: "0px 6px 15px rgba(0, 0, 0, 0.2)" }}
        >
          <h5 style={{ borderBottom: "1px solid gray", paddingBottom: 10 }}>
            <strong>{filter.title}</strong>
          </h5>
          {filter.options.map((option, optionIndex) => (
            <div className="form-check" key={option}>
              <input
                className="form-check-input"
                id={`${filter.title
                  .toLowerCase()
                  .replace(/\s+/g, "-")}-${optionIndex}`}
                type={
                  filter.title === "Tính năng đặc biệt" ? "checkbox" : "radio"
                }
                checked={
                  filter.title === "Tính năng đặc biệt"
                    ? selectedFilters.specialFeatures.includes(option) // Kiểm tra nếu option đã được chọn trong mảng specialFeatures
                    : selectedFilters[filterKeyMap[filter.title]] === option
                }
                onChange={() => handleSelect(filter.title, option)}
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
        <button
          className="btn btn-primary"
          type="button"
          onClick={handleFilter}
        >
          Lọc
        </button>
      </div>
    </div>
  );
};

export default Filter;
