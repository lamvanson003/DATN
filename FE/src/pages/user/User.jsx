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
  const [fullname, setFullname] = useState(""); // State để lưu trữ fullname
  const [loading, setLoading] = useState(true); // State để kiểm soát trạng thái loading
  const [error, setError] = useState(null);     // State để lưu trữ lỗi nếu có

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
        setFullname(data.data?.fullname || ""); 
      } else {
        setError(data.message || "Có lỗi xảy ra khi fetch dữ liệu.");
      }
    } catch (error) {
      setError("Có lỗi xảy ra: " + error.message);
    } finally {
      setLoading(false);
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
          <div className="col-md-3 px-5">
            <span className="px-5 d-flex flex-column gap-4">
              <div className="d-flex align-items-center gap-3">
                <span>
                  <FaRegCircleUser size={30} />
                </span>
                <span className="d-flex flex-column">
                  <span className="fw-bold" style={{ fontSize: 16 }}>
                    {fullname || "Tên user"}
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
              </div>            </span>
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




 