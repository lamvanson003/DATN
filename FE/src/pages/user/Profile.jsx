import React, { useEffect, useState } from "react";
import "./css/Profile.css";
import icons from "../../ultis/icon";

const { LuUser2 } = icons;

const Profile = () => {
  const [userData, setUserData] = useState(null); // Dữ liệu người dùng
  const [loading, setLoading] = useState(true); // Trạng thái loading
  const [error, setError] = useState(null); // Lưu trữ lỗi nếu có

  // Fetch user data từ API khi component mount
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
        setUserData(data.data); // Lưu dữ liệu người dùng
      } else {
        setError(data.message || "Có lỗi xảy ra khi fetch dữ liệu.");
      }
    } catch (error) {
      setError("Có lỗi xảy ra: " + error.message);
    } finally {
      setLoading(false);
    }
  };

  // Cập nhật thông tin người dùng
  const updateUserData = async (e) => {
    e.preventDefault();

    // Lấy giá trị từ form
    const fullname = document.getElementById("fullname").value;
    const email = document.getElementById("email").value;
    const username = document.getElementById("username").value;
    const phone = document.getElementById("phone").value;
    const address = document.getElementById("address").value;
    const gender = document.querySelector(
      'input[name="gender"]:checked'
    )?.value;

    const data = {
      fullname,
      email,
      username,
      phone,
      address,
      gender,
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
        // Cập nhật state `userData` với dữ liệu mới
        setUserData(result.data); // Dùng result.data nếu API trả về dữ liệu người dùng đã được cập nhật
        alert("Thông tin đã được cập nhật thành công!");
      } else {
        alert("Có lỗi xảy ra: " + result.message);
      }
    } catch (error) {
      alert("Có lỗi xảy ra: " + error.message);
    }
  };

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
    <div className="row">
      <div
        className="row"
        style={{ borderBottom: "1px solid gray", paddingBottom: 10 }}
      >
        <h3>Hồ sơ của tôi</h3>
        <span>Quản lý thông tin hồ sơ để bảo mật tài khoản</span>
      </div>
      <div className="row mt-3">
        <div className="col-sm-9">
          <form className="form-container" onSubmit={updateUserData}>
            <div className="form-group">
              <label htmlFor="fullname">Họ và tên:</label>
              <input
                type="text"
                className="form-control"
                id="fullname"
                defaultValue={userData?.fullname || ""}
                required
              />
            </div>
            <div className="form-group">
              <label htmlFor="email">Email:</label>
              <input
                type="email"
                className="form-control"
                id="email"
                defaultValue={userData?.email || ""}
                required
              />
            </div>
            <div className="form-group">
              <label htmlFor="username">Tên đăng nhập:</label>
              <input
                type="text"
                className="form-control"
                id="username"
                defaultValue={userData?.username || ""}
                required
              />
            </div>
            <div className="form-group">
              <label htmlFor="phone">Số điện thoại:</label>
              <input
                type="text"
                className="form-control"
                id="phone"
                defaultValue={userData?.phone || ""}
              />
            </div>
            <div className="form-group">
              <label htmlFor="address">Địa chỉ:</label>
              <input
                type="text"
                className="form-control"
                id="address"
                defaultValue={userData?.address || ""}
              />
            </div>
            <div className="form-group form-group-gender d-flex gap-3">
              <label>Giới tính:</label>
              <div>
                <input
                  type="radio"
                  id="male"
                  name="gender"
                  value="1"
                  defaultChecked={userData?.gender === "1"}
                />
                <label htmlFor="male">Nam</label>
              </div>
              <div>
                <input
                  type="radio"
                  id="female"
                  name="gender"
                  value="2"
                  defaultChecked={userData?.gender === "2"}
                />
                <label htmlFor="female">Nữ</label>
              </div>
              <div>
                <input
                  type="radio"
                  id="other"
                  name="gender"
                  value="3"
                  defaultChecked={userData?.gender === "3"}
                />
                <label htmlFor="other">Khác</label>
              </div>
            </div>

            <div className="d-flex justify-content-center">
              <button
                className="btn btn-primary"
                style={{ width: "20%" }}
                type="submit"
              >
                Lưu thay đổi
              </button>
            </div>
          </form>
        </div>
        <div className="col-sm-3">
          <div className="my-3 d-flex flex-column align-items-center">
            <span className="m-3">
              <LuUser2
                size={120}
                className="p-3 border border-secondary rounded-circle"
              />
            </span>
            <input
              type="file"
              id="image-upload"
              name="image-upload"
              className="form-control"
              accept="image/*"
            />
            <span className="opacity-75">
              Dụng lượng file tối đa 1 MB Định dạng:.JPEG, .PNG
            </span>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Profile;
