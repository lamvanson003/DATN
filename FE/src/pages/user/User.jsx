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
  const [fullname, setFullname] = useState(""); // State to store fullname
  const [loading, setLoading] = useState(true); // State to track loading state
  const [error, setError] = useState(null); // State for errors
  const [isLoggedIn, setIsLoggedIn] = useState(false); // Check if user is logged in
  const [selectedItem, setSelectedItem] = useState(""); // State to track selected item
  const navigate = useNavigate(); // Navigate hook

  // Function to fetch user data
  const fetchUserData = async () => {
    try {
      const token = localStorage.getItem("token");

      if (!token) {
        setIsLoggedIn(false);
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
        setIsLoggedIn(true); // User logged in successfully
      } else {
        setError(data.message || "Error fetching data.");
        setIsLoggedIn(false);
      }
    } catch (error) {
      setError("Error occurred: " + error.message);
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

  // Fetch user data when component mounts
  useEffect(() => {
    fetchUserData();
  }, []);

  // Logout function
  const logout = () => {
    localStorage.removeItem("token");
    navigate("/login");
  };

  // Function to handle item click and set selected item
  const handleItemClick = (item) => {
    setSelectedItem(item); // Set the clicked item as selected
  };

  // Inline style for selected item
  const selectedStyle = {
    backgroundColor: "#cde7ff", // Highlight color for selected item
    boxShadow: "0 4px 8px rgba(0, 0, 0, 0.2)", // Add shadow to make it look active
    padding: "10px",
    borderRadius: "5px",
  };

  if (loading) {
    return <div>Loading...</div>; // Show loading while fetching data
  }

  if (error) {
    return <div>Error: {error}</div>; // Show error message if there's an issue
  }

  if (!isLoggedIn) {
    return (
      <div
        style={{
          textAlign: "center",
          marginTop: "30px",
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
      <div
        className="mt-5"
        style={{ width: "90%", margin: "0 100px", marginLeft: "50px" }}
      >
        <div className="row" style={{ width: "100%" }}>
          <div className="col-md-3 px-5">
            <span className="px-5 d-flex flex-column gap-4">
              <div className="d-flex align-items-center gap-3">
                <span>
                  <FaRegCircleUser size={30} style={{ marginLeft: "10px" }} />
                </span>
                <span className="d-flex flex-column">
                  <span
                    className="fw-bold"
                    style={{ fontSize: 20, marginTop: "10px" }}
                  >
                    {fullname || "Tên user"}
                  </span>
                </span>
              </div>
              <div className="d-flex flex-column gap-2 fw-semibold">
                <span
                  className="d-flex align-items-center gap-1"
                  style={{
                    ...hoverEffectStyle,
                    ...(selectedItem === "account" ? selectedStyle : {}),
                  }}
                  onClick={() => handleItemClick("account")}
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
              </div>
              <button
                onClick={logout}
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
          <div className="col-md-9 px-1">
            <Outlet />
          </div>
        </div>
      </div>
    </>
  );
};

export default User;
