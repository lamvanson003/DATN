import React, { useEffect, useState } from "react";
import { Outlet } from "react-router-dom";
import icons from "../../ultis/icon";
import '../user/css/User.css';

const {
  FaRegCircleUser,
  FaPencilAlt,
  FaRegUser,
  FaHistory,
  MdNotificationsNone,
  FaTicketAlt,
  BsCashCoin,
} = icons;

const User = () => {
  const [userData, setUserData] = useState(null); // State để lưu trữ dữ liệu người dùng
  const [loading, setLoading] = useState(true);   // State để kiểm soát trạng thái loading
  const [error, setError] = useState(null);       // State để lưu trữ lỗi nếu có

  // Hàm fetch dữ liệu từ API
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
        setUserData(data.data); // Lưu trữ dữ liệu người dùng vào state
      } else {
        setError(data.message || "Có lỗi xảy ra khi fetch dữ liệu.");
      }
    } catch (error) {
      setError("Có lỗi xảy ra: " + error.message);
    } finally {
      setLoading(false);
    }
  };

  // Hàm cập nhật thông tin người dùng
  const updateUserData = async (event) => {
    event.preventDefault(); // Ngăn chặn hành động mặc định của form

    // Lấy giá trị từ các trường input
    const fullname = document.getElementById("fullname").value;
    const email = document.getElementById("email").value;
    const username = document.getElementById("username").value;
    const gender = document.querySelector('input[name="gender"]:checked')?.value; // Nếu có checkbox hoặc radio cho giới tính
    const phone = document.getElementById("phone").value;
    const address = document.getElementById("address").value;
    const password = document.getElementById("password").value; // mật khẩu mới
    const passwordConfirmation = document.getElementById("passwordConfirmation").value; // xác nhận mật khẩu

    // Tạo đối tượng dữ liệu để gửi
    const data = {
      fullname,
      email,
      username,
      gender,
      phone,
      address,
      password,
      password_confirmation: passwordConfirmation,
    };

    try {
      const response = await fetch("http://localhost:8000/api/profiles", {
        method: "PATCH", // Hoặc POST nếu bạn muốn
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
        body: JSON.stringify(data), // Chuyển đổi dữ liệu thành JSON
      });

      const result = await response.json();
      if (response.ok) {
        // Cập nhật thành công
        alert("Thông tin đã được cập nhật thành công!");
        window.location.reload(); // Tải lại trang
      } else {
        // Xử lý lỗi nếu có
        alert("Có lỗi xảy ra: " + result.message);
      }
    } catch (error) {
      alert("Có lỗi xảy ra: " + error.message);
    }
  };

  // Gọi API khi component được mount
  useEffect(() => {
    fetchUserData();
  }, []);

  if (loading) {
    return <div>Loading...</div>; // Hiển thị trạng thái loading khi fetch API
  }

  if (error) {
    return <div>Error: {error}</div>; // Hiển thị lỗi nếu có
  }

  return (
    <>
      <div className="mt-5" style={{ width: "100%" }}>
        <div className="row" style={{ width: "100%" }}>
          {/* comment from của hiếu  */}
          <div className="col-md-3 px-5">
            <span className="px-5 d-flex flex-column gap-4">
              <div className="d-flex align-items-center gap-3">
                <span>
                  <FaRegCircleUser size={30} />
                </span>
                <span className="d-flex flex-column">
                  <span className="fw-bold" style={{ fontSize: 16 }}>
                    {userData?.fullname || "Tên user"}
                  </span>
                  <span className="opacity-75" style={{ fontSize: 14 }}>
                    Sửa hồ sơ
                    <span className="ms-2">
                      <FaPencilAlt />
                    </span>
                  </span>
                </span>
              </div>
              <div className="d-flex flex-column gap-2 fw-semibold">
                <span className="d-flex align-items-center gap-1">
                  <FaRegUser color="rgb(0, 123, 255)" />
                  Tài khoản của tôi
                </span>
                <span className="d-flex align-items-center gap-1">
                  <FaHistory color="rgb(0, 123, 255)" />
                  Đơn mua
                </span>
                <span className="d-flex align-items-center gap-1">
                  <MdNotificationsNone className="text-danger" />
                  Thông báo
                </span>
                <span className="d-flex align-items-center gap-1">
                  <FaTicketAlt className="text-danger" />
                  Kho voucher
                </span>
                <span className="d-flex align-items-center gap-1">
                  <BsCashCoin className="text-warning" />
                  Xu khuyến mãi
                </span>
              </div>
            </span>
          </div>
          <div className="col-md-9 px-5">
            <Outlet />
           
          </div>
        </div>
      </div>
    </>
  );
};

export default User;

// giới tính
   {/* <div className="col">
                    <label className="form-label">Giới tính</label>
                    <div>
                      <input type="radio" id="male" name="gender" value="male" />
                      <label htmlFor="male">Nam</label>
                      <input type="radio" id="female" name="gender" value="female" />
                      <label htmlFor="female">Nữ</label>
                      <input type="radio" id="other" name="gender" value="other" />
                      <label htmlFor="other">Khác</label>
                    </div>
                  </div> */}

 