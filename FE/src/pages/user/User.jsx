import React, { useEffect, useState } from "react";
import { Outlet, useNavigate } from "react-router-dom";
import icons from "../../ultis/icon";
import "../user/css/User.css";

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
  const [isLoggedIn, setIsLoggedIn] = useState(false); // Kiểm tra xem người dùng đã đăng nhập hay chưa
  const navigate = useNavigate(); // Hook dùng để điều hướng người dùng

  // Hàm fetch dữ liệu từ API
  const fetchUserData = async () => {
    try {
      const token = localStorage.getItem("token");

      if (!token) {
        setIsLoggedIn(false); // Nếu không có token, người dùng chưa đăng nhập
        return;
      }

      const response = await fetch("http://localhost:8000/api/profiles", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${token}`,
        },
      });

      const data = await response.json();
      if (response.ok) {
        setFullname(data.data?.fullname || "");
        setIsLoggedIn(true); // Nếu đăng nhập thành công
      } else {
        setError(data.message || "Có lỗi xảy ra khi fetch dữ liệu.");
        setIsLoggedIn(false);
      }
    } catch (error) {
      setError("Có lỗi xảy ra: " + error.message);
      setIsLoggedIn(false);
    } finally {
      setLoading(false);
    }
  };

  const hoverEffectStyle = {
    padding: "10px",
    borderRadius: "5px",
    transition: "box-shadow 0.3s ease",
  };

  const hoverEffectStyleHover = {
    boxShadow: "0 4px 8px rgba(0, 0, 0, 0.2)",
  };

  // Gọi API khi component được mount
  useEffect(() => {
    fetchUserData();
  }, []);

  // Hàm đăng xuất
  const logout = () => {
    // Xóa token trong localStorage
    localStorage.removeItem("token");
    
    // Chuyển hướng về trang đăng nhập
    navigate("/login"); // Giả sử route đăng nhập là "/login"
  };

  if (loading) {
    return <div>Loading...</div>; // Hiển thị trạng thái loading khi fetch API
  }

  if (error) {
    return <div>Error: {error}</div>; // Hiển thị lỗi nếu có
  }

  if (!isLoggedIn) {
    return (
      <div
        style={{
          textAlign: "center",
          marginTop:"20px",
          padding: "50px",
          backgroundColor: "#cde7ff",
          borderRadius: "10px",
          color: "#415eff",
          fontSize: "24px",
          fontWeight: "bold",
          maxWidth: "600px",
          margin: "auto",
        }}
      >
        Bạn chưa đăng nhập. Vui lòng đăng nhập để tiếp tục quản lý tài khoản.
      </div>
    );
  }

  return (
    <>
      <div className="mt-5" style={{ width: "90%", margin: "0 100px" }}>
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
                  <span className="opacity-75" style={{ fontSize: 14 }}></span>
                </span>
              </div>
              <div className="d-flex flex-column gap-2 fw-semibold">
                <span
                  className="d-flex align-items-center gap-1"
                  style={hoverEffectStyle}
                  onMouseEnter={(e) =>
                    Object.assign(e.target.style, hoverEffectStyleHover)
                  }
                  onMouseLeave={(e) =>
                    Object.assign(e.target.style, { boxShadow: "none" })
                  }
                >
                  <FaRegUser color="rgb(0, 123, 255)" />
                  Tài khoản của tôi
                </span>
                <span
                  className="d-flex align-items-center gap-1"
                  style={hoverEffectStyle}
                  onMouseEnter={(e) =>
                    Object.assign(e.target.style, hoverEffectStyleHover)
                  }
                  onMouseLeave={(e) =>
                    Object.assign(e.target.style, { boxShadow: "none" })
                  }
                >
                  <FaHistory color="rgb(0, 123, 255)" />
                  Đơn mua
                </span>
              </div>
              <button
                onClick={logout} // Gọi hàm logout khi nhấn nút
                style={{
                  backgroundColor: "rgb(0, 123, 255)",
                  color: "white",
                  border: "none",
                  padding: "10px 20px",
                  borderRadius: "5px",
                  cursor: "pointer",
                  fontWeight: "bold",
                  fontSize: "14px",
                }}
              >
                Đăng xuất
              </button>
            </span>
          </div>
          <div  className="col-md-9 px-1 ">
            <Outlet />
          </div>
        </div>
      </div>
    </>
  );
};

export default User;
