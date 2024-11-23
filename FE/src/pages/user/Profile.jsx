import React, { useEffect, useState } from "react";
// import "./css/Profile.css";
import icons from "../../ultis/icon";
import 'bootstrap/dist/css/bootstrap.min.css';
import { useNavigate, useLocation } from "react-router-dom";


const { LuUser2 } = icons;


const Profile = () => {
  const [provinces, setProvinces] = useState([]);
  const [districts, setDistricts] = useState([]);
  const [wards, setWards] = useState([]);
  const [selectedProvince, setSelectedProvince] = useState(null);
  const [selectedDistrict, setSelectedDistrict] = useState(null);
  const [selectedWard, setSelectedWard] = useState(null);
  const [customerInfo, setCustomerInfo] = useState({
    province: "",
    district: "",
    ward: "",
    street: "",
  });

  const [userData, setUserData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [showDetails, setShowDetails] = useState(false);
  const [validFields, setValidFields] = useState({
    province: true,
    district: true,
    ward: true,
    street: true,
  });

  const toggleDetails = () => {
    setShowDetails(!showDetails);
  };

  const fetchUserData = async () => {
    try {
      const response = await fetch("http://localhost:8000/api/profiles", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });
      const data = await response.json();
      if (response.ok) {
        setUserData(data.data);
        if (data.data?.address) {
          const addressParts = data.data.address.split(", ");
          if (addressParts.length >= 4) {
            const street = addressParts.slice(0, addressParts.length - 3).join(", ");
            const ward = addressParts[addressParts.length - 3];
            const district = addressParts[addressParts.length - 2];
            const province = addressParts[addressParts.length - 1];

            setCustomerInfo({
              street,
              ward,
              district,
              province,
            });

            const selectedProvince = provinces.find(p => p.full_name === province);
            const selectedDistrict = districts.find(d => d.full_name === district);
            const selectedWard = wards.find(w => w.full_name === ward);

            setSelectedProvince(selectedProvince);
            setSelectedDistrict(selectedDistrict);
            setSelectedWard(selectedWard);
          }
        }
      } else {
        setError(data.message || "Lỗi khi lấy dữ liệu.");
      }
    } catch (error) {
      setError("Lỗi: " + error.message);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    const fetchProvinces = async () => {
      const res = await fetch("https://esgoo.net/api-tinhthanh/1/0.htm");
      const data = await res.json();
      setProvinces(data.data);
    };
    fetchProvinces();
  }, []);

  useEffect(() => {
    if (selectedProvince) {
      const fetchDistricts = async () => {
        const res = await fetch(
          `https://esgoo.net/api-tinhthanh/2/${selectedProvince.id}.htm`
        );
        const data = await res.json();
        setDistricts(data.data);
        setWards([]);
      };
      fetchDistricts();
    }
  }, [selectedProvince]);

  useEffect(() => {
    if (selectedDistrict) {
      const fetchWards = async () => {
        const res = await fetch(
          `https://esgoo.net/api-tinhthanh/3/${selectedDistrict.id}.htm`
        );
        const data = await res.json();
        setWards(data.data);
      };
      fetchWards();
    }
  }, [selectedDistrict]);

  const handleInputChange = (e) => {
    const { id, value } = e.target;
    setCustomerInfo((prev) => ({
      ...prev,
      [id]: value,
    }));
  };

  const updateUserData = async (e) => {
    e.preventDefault();
    const fullname = document.getElementById("fullname").value;
    const email = document.getElementById("email").value;
    const username = document.getElementById("username").value;
    const phone = document.getElementById("phone").value;
    const address = {
      street: customerInfo.street,
      ward: customerInfo.ward,
      district: customerInfo.district,
      province: customerInfo.province,
    };
    
    const data = {
      fullname,
      email,
      username,
      phone,
      address,
    };

    try {
      const response = await fetch("http://localhost:8000/api/profiles", {
        method: "PATCH",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
        body: JSON.stringify(data),
      });

      const result = await response.json();
      if (response.ok) {
        setUserData(result.data); 
        alert("Cập nhật thông tin người dùng thành công!");
      } else {
        alert("Lỗi: " + result.message);
      }
    } catch (error) {
      alert("Lỗi: " + error.message);
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const isValid = {
      province: customerInfo.province !== "",
      district: customerInfo.district !== "",
      ward: customerInfo.ward !== "",
      street: customerInfo.street !== "",
    };

    setValidFields(isValid);

    if (Object.values(isValid).every(Boolean)) {
      const address = {
        street: customerInfo.street,
        ward: customerInfo.ward,
        district: customerInfo.district,
        province: customerInfo.province,
      };

      const data = {
        fullname: userData?.fullname || "",
        email: userData?.email || "",
        username: userData?.username || "",
        phone: userData?.phone || "",
        address,
      };

      try {
        const response = await fetch("http://localhost:8000/api/profiles", {
          method: "PATCH",
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
          body: JSON.stringify(data),
        });

        const result = await response.json();
        if (response.ok) {
          setUserData(result.data); 
          alert("Cập nhật địa chỉ thành công!");
        } else {
          alert("Lỗi: " + result.message);
        }
      } catch (error) {
        alert("Lỗi: " + error.message);
      }
    } else {
      alert("Vui lòng điền đầy đủ thông tin địa chỉ.");
    }
  };

  const formattedAddress = `${userData?.address?.street || ""}, ${userData?.address?.ward || ""}, ${userData?.address?.district || ""}, ${userData?.address?.province || ""}`;

  


  useEffect(() => {
    fetchUserData();
  }, []);

  if (loading) {
    return <div>Loading...</div>; // Hiển thị khi đang tải dữ liệu
  }

  if (error) {
    return <div>Error: {error}</div>; // Hiển thị lỗi nếu có
  }


  return (
    <div className="row" style={{ marginLeft:"45px", marginTop: '0px', maxWidth:"1000px", }}>
      <h2 style={{ marginLeft: '-20px' }} >Thông tin tài khoản</h2>
    <div className="row" style={{ maxWidth: '1000px',backgroundColor: '#f8f9fa', padding:"   0 25px 0 25px  ", borderRadius: '5px', boxShadow: '0 0 10px rgba(0, 0, 0, 0.1)' }}>
        <div className="card-header" style={{ backgroundColor: '#f8f9fa', fontWeight: 'bold' , marginTop:"10px",marginBottom:"20px",maxWidth:"500px"}}>
            THÔNG TIN CÁ NHÂN
        </div>
        <div className="card-body" style={{ backgroundColor: '#f8f9fa' }}>
            <p> <span>{userData?.fullname || ""}- {userData?.phone || ""}</span>  <span className="details-btn" onClick={toggleDetails} style={{ color: 'blue', cursor: 'pointer' }}>Chi tiết</span></p>
            {showDetails && (
                <div id="details" className="details">
                    <form onSubmit={updateUserData}>
                     
                        <div className="row mt-3">
                            <div className="col-md-6">
                                <div className="mb-3">
                                    <label htmlFor="name" className="form-label">Họ & Tên:</label>
                                    <input
                                    type="text"
                                    className="form-control"
                                    id="fullname"
                                    defaultValue={userData?.fullname || ""}
                                    required
                                  />
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="mb-3">
                                    <label htmlFor="phone" className="form-label">Số điện thoại:</label>
                                    <input
                                    type="text"
                                    className="form-control"
                                    id="phone"
                                    defaultValue={userData?.phone || ""}
                                  />
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="mb-3">
                                    <label htmlFor="username" className="form-label">Tên đăng nhập:</label>
                                    <input
                                    type="text"
                                    className="form-control"
                                    id="username"
                                    defaultValue={userData?.username || ""}
                                    required
                                    />

                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="mb-3">
                                    <label htmlFor="email" className="form-label">Email:</label>
                                    <input
                                    type="email"
                                    className="form-control"
                                    id="email"
                                    defaultValue={userData?.email || ""}
                                    required
                                  />

                                </div>
                            </div>
                        </div>
                        <div className="d-flex justify-content-end">
                            <button type="button" className="btn btn-link btn-cancel" style={{ color: 'black' }}>Hủy</button>
                            <button type="submit" className="btn btn-link btn-save" style={{ color: 'blue' }}>Lưu</button>
                        </div>
                    </form>
                </div>
            )}
        </div>
    </div>
    <div className="row" style={{
      maxWidth: '1000px',
      margin: '50px auto',
      backgroundColor: '#ffffff',
      padding: '20px',
      borderRadius: '5px',
      boxShadow: '0 0 10px rgba(0, 0, 0, 0.1)',
      marginLeft: '-10px',
      marginRight: '0px',
      marginTop:"20px",
    }}>
      <h5>ĐỊA CHỈ NHẬN HÀNG </h5>
      <div className="row mb-3">
      <div className="row mb-3" style={{ display: 'none' }}>
  Địa chỉ hiện tại: <p>{formattedAddress}</p>
</div></div>
      <form onSubmit={handleSubmit}>
       
  <div className="row mb-3">
        <div className="col">
          
  <label htmlFor="province" style={{ fontWeight: 'bold' }}>Tỉnh, thành phố:</label>
  <div className="input-group" style={{ marginBottom: '15px' }}>
    <select
      id="province"
      className="form-select"
      onChange={(e) => {
        const selectedProvince = provinces.find(
          (p) => p.full_name === e.target.value
        );
        setSelectedProvince(selectedProvince); // Update selectedProvince state
        setCustomerInfo((prev) => ({
          ...prev,
          province: selectedProvince ? selectedProvince.full_name : "",
          district: "",
          ward: "",
        }));
        setDistricts([]); // Reset districts when province changes
        setWards([]); // Reset wards when province changes
      }}
      value={customerInfo.province || ""}
      style={{
        borderColor: validFields.province ? "" : "red",
        marginBottom: 0,
        backgroundColor: "#fff",
      }}
    >
      <option value="">Chọn tỉnh thành phố</option>
      {provinces.map((province) => (
        <option key={province.id} value={province.full_name}>
          {province.full_name}
        </option>
      ))}
    </select>
  </div>
</div>
<div className="col">
  <label htmlFor="district" style={{ fontWeight: 'bold' }}>Quận huyện:</label>
  <div className="input-group" style={{ marginBottom: '15px' }}>
    <select
      id="district"
      className="form-select"
      onChange={(e) => {
        const selectedDistrict = districts.find(
          (d) => d.full_name === e.target.value
        );
        setSelectedDistrict(selectedDistrict); // Update selectedDistrict state
        setCustomerInfo((prev) => ({
          ...prev,
          district: selectedDistrict ? selectedDistrict.full_name : "",
          ward: "",
        }));
        setWards([]); // Reset wards when district changes
      }}
      value={customerInfo.district || ""}
      style={{
        borderColor: validFields.district ? "" : "red",
        marginBottom: 0,
        backgroundColor: "#fff",
      }}
    >
      <option value="">Chọn quận huyện</option>
      {districts.map((district) => (
        <option key={district.id} value={district.full_name}>
          {district.full_name}
        </option>
      ))}
    </select>
  </div>
</div>
</div>

        <div className="row mb-3">
          <div className="col">
            <label htmlFor="ward" style={{ fontWeight: 'bold' }}>Phường xã:</label>
            <div className="input-group" style={{ marginBottom: '15px' }}>
              <select
                id="ward"
                className="form-select"
                onChange={(e) => {
                  const selectedWard = wards.find(
                    (w) => w.full_name === e.target.value
                  );
                  setCustomerInfo((prev) => ({
                    ...prev,
                    ward: selectedWard ? selectedWard.full_name : "",
                  }));
                }}
                value={customerInfo.ward || ""}
                style={{
                  borderColor: validFields.ward ? "" : "red",
                  marginBottom: 0,
                  backgroundColor: "#fff",
                }}
              >
                <option value="">Chọn phường xã</option>
                {wards.map((ward) => (
                  <option key={ward.id} value={ward.full_name}>
                    {ward.full_name}
                  </option>
                ))}
              </select>
            </div>
          </div>
          <div className="col">
            <label htmlFor="street" style={{ fontWeight: 'bold' }}>Số nhà, tên đường:</label>
            <input
              style={{  marginTop: '0px',  padding: '6px', borderColor: validFields.street ? "" : "red" }}
              id="street"
              type="text"
              className="form-control"
              value={customerInfo.street}
              onChange={handleInputChange}

            />
          </div>

        </div>

        <div className="form-check mb-3">
          <input className="form-check-input" type="checkbox" id="defaultAddress" />
          <label className="form-check-label" htmlFor="defaultAddress">
            Đặt làm địa chỉ mặc định
          </label>
        </div>

        <div className="d-flex justify-content-center">
          <button type="submit" className="btn" style={{
            backgroundColor: '#3f8ff0',
            color: '#ffffff',
            border: 'none',
            width: '150px'
          }}>CẬP NHẬT</button>
        </div>
      </form>
    </div>
</div>

  
  );
};

export default Profile;
