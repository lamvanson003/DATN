import "./css/SearchOrder.css";
import icons from "../../ultis/icon";
import React, { useState, useEffect, useCallback } from "react";

const { BsSearch } = icons;

const Modal = ({ order, onClose }) => {
  if (!order) return null;

  return (
    <div
      style={{
        position: "fixed",
        top: 0,
        left: 0,
        width: "100%",
        height: "100%",
        backgroundColor: "rgba(0, 0, 0, 0.5)",
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        zIndex: 1000,
      }}
      onClick={onClose}
    >
      <div
        style={{
          backgroundColor: "white",
          padding: "20px",
          borderRadius: "8px",
          maxWidth: "600px",
          width: "80%",
          boxShadow: "0 2px 10px rgba(0, 0, 0, 0.3)",
          maxHeight: "80vh",
          overflowY: "auto",
        }}
        onClick={(e) => e.stopPropagation()}
      >
        <div
          style={{
            display: "flex",
            justifyContent: "space-between",
            alignItems: "center",
            marginBottom: "10px",
          }}
        >
          <h3 style={{ margin: 0, fontWeight: "bold" }}>
            Mã Đơn Hàng: {order.code}
          </h3>
          <p style={{ margin: 0, fontWeight: "bold", color: "#007BFF" }}>
            Trạng thái: {order.status}
          </p>
        </div>
        <p>Ngày mua: {new Date(order.created_at).toLocaleString()}</p>
        <p>Địa chỉ: {order.address}</p>
        <p>Ghi chú: {order.note}</p>

        {order.order_details.map((item) => (
          <div
            key={item.id}
            style={{
              borderTop: "1px solid #eee",
              padding: "10px 0",
              display: "flex",
              alignItems: "center",
              gap: "20px",
            }}
          >
            <div style={{ flex: 1 }}>
              <h4 style={{ margin: "0" }}>{item.product_variant.name}</h4>
              <p>Màu sắc: {item.product_variant.color}</p>
              <p>Bộ nhớ: {item.product_variant.storage}</p>
              <p>Số lượng: {item.quantity}</p>
              <p>Giá: {new Intl.NumberFormat().format(item.price)} VND</p>
              {item.sale > 0 && (
                <p>Giá khuyến mãi: {new Intl.NumberFormat().format(item.sale)} VND</p>
              )}
            </div>
            <img
              src={item.product_variant.images}
              alt={item.product_variant.name}
              style={{
                maxWidth: "270px", 
    width: "100%", 
    height: "auto",
    borderRadius: "8px", 
              }}
            />
          </div>
        ))}

<p style={{ marginTop: "20px", fontWeight: "bold", color: "#007BFF" }}>
  Tổng tiền:{" "}
  {new Intl.NumberFormat().format(
    order.order_details.reduce(
      (acc, item) =>
        acc +
        (item.sale > 0 ? item.sale : item.price) * item.quantity,
      0
    )
  )}{" "}
  VND
</p>


        <button
          onClick={onClose}
          style={{
            marginTop: "20px",
            padding: "8px 16px",
            backgroundColor: "#007BFF",
            color: "white",
            border: "none",
            borderRadius: "4px",
            cursor: "pointer",
          }}
        >
          Đóng
        </button>
      </div>
    </div>
  );
};

const SearchOrder = () => {
  const [orders, setOrders] = useState([]);
  const [phone, setPhone] = useState("");
  const [error, setError] = useState(null);
  const [showNotification, setShowNotification] = useState(false);
  const [selectedOrder, setSelectedOrder] = useState(null);

  const fetchOrderDetails = useCallback(async () => {
    if (!phone.trim()) {
      setShowNotification(true);
      setOrders([]);
      return;
    }

    setShowNotification(false);

    try {
      const response = await fetch(
        `http://127.0.0.1:8000/api/orders/detail-by-phone?phone=${phone}`
      );
      const data = await response.json();

      if (data.success) {
        const sortedOrders = data.data.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
        setOrders(data.data);
        setError(null);
      } else {
        setError("Không tìm thấy đơn hàng với số điện thoại này.");
        setOrders([]);
      }
    } catch (err) {
      setError("Lỗi khi lấy dữ liệu. Vui lòng thử lại.");
      setOrders([]);
    }
  }, [phone]);

  const handlePhoneChange = (e) => {
    setPhone(e.target.value);
    setShowNotification(true);
    setOrders([]);
    setError(null);
  };

  const handleShowDetails = (order) => {
    setSelectedOrder(order);
  };

  const handleCloseModal = () => {
    setSelectedOrder(null);
  };

  const handleSearchSubmit = (e) => {
    e.preventDefault();
    fetchOrderDetails();
  };

  return (
    <div
    style={{
      maxWidth: "1100px",
      marginLeft: "255px",
      marginTop: "25px",
      fontFamily: "Arial, sans-serif",
    }}
  >
    <h2 style={{ textAlign: "center" }}>Lịch Sử Đơn Hàng</h2>
  
    <form
      onSubmit={handleSearchSubmit}
      style={{ display: "flex", justifyContent: "center", marginBottom: "20px" }}
    >
      <div style={{ position: "relative", width: "380px" }}>
        <input
          type="text"
          value={phone}
          onChange={handlePhoneChange}
          placeholder="Nhập số điện thoại"
          style={{
            padding: "10px 15px",
            width: "100%",
            borderRadius: "10px",
            border: "1px solid #ccc",
            fontSize: "16px",
            paddingRight: "40px",
            boxSizing: "border-box",
          }}
        />
        <button
          type="submit"
          style={{
            position: "absolute",
            right: "10px",
            top: "50%",
            transform: "translateY(-50%)",
            padding: "10px 15px",
            backgroundColor: "#007BFF",
            color: "white",
            border: "none",
            borderRadius: "10%",
            cursor: "pointer",
            fontSize: "16px",
            transition: "background-color 0.3s",
          }}
          onMouseEnter={(e) => (e.target.style.backgroundColor = "#4ea3fd")}
          onMouseLeave={(e) => (e.target.style.backgroundColor = "#007BFF")}
        >
          <BsSearch />
        </button>
      </div>
    </form>
  
    {showNotification && (
      <div
        style={{
          backgroundColor: "#f8d7da",
          color: "#721c24",
          padding: "15px",
          border: "1px solid #f5c6cb",
          borderRadius: "5px",
          textAlign: "center",
          fontSize: "16px",
          margin: "20px 0",
          boxShadow: "0 2px 5px rgba(0, 0, 0, 0.1)",
        }}
      >
        <strong>Vui lòng nhập số điện thoại để tìm đơn hàng.</strong>
      </div>
    )}
  
    {error && <p style={{ color: "red", textAlign: "center" }}>{error}</p>}
  
    {orders.length > 0 ? (
      <table
        style={{
          width: "100%",
          borderCollapse: "collapse",
          marginTop: "20px",
        }}
      >
        <thead>
          <tr>
            <th
              style={{
                border: "1px solid #ccc",
                padding: "10px",
                backgroundColor: "#f2f2f2",
                textAlign: "left",
              }}
            >
              Mã Đơn Hàng
            </th>
            <th
              style={{
                border: "1px solid #ccc",
                padding: "10px",
                backgroundColor: "#f2f2f2",
                textAlign: "left",
              }}
            >
              Sản Phẩm
            </th>
            <th
              style={{
                border: "1px solid #ccc",
                padding: "10px",
                backgroundColor: "#f2f2f2",
                textAlign: "center",
              }}
            >
              Số Lượng
            </th>
            <th
              style={{
                border: "1px solid #ccc",
                padding: "10px",
                backgroundColor: "#f2f2f2",
                textAlign: "right",
              }}
            >
              Tổng Tiền
            </th>
            <th
              style={{
                border: "1px solid #ccc",
                padding: "10px",
                backgroundColor: "#f2f2f2",
                textAlign: "center",
              }}
            >
              Ngày Mua
            </th>
            <th
              style={{
                border: "1px solid #ccc",
                padding: "10px",
                backgroundColor: "#f2f2f2",
                textAlign: "center",
              }}
            >
              Thao Tác
            </th>
          </tr>
        </thead>
        <tbody>
          {orders.map((order) => (
            <tr key={order.id}>
              <td
                style={{
                  border: "1px solid #ccc",
                  padding: "10px",
                }}
              >
                {order.code}
              </td>
              <td
                style={{
                  border: "1px solid #ccc",
                  padding: "10px",
                }}
              >
                {order.order_details[0]?.product_variant.name}
              </td>
              <td
                style={{
                  border: "1px solid #ccc",
                  padding: "10px",
                  textAlign: "center",
                }}
              >
                {order.order_details.reduce((acc, item) => acc + item.quantity, 0)}
              </td>
              <td
  style={{
    border: "1px solid #ccc",
    padding: "10px",
    textAlign: "right",
  }}
>
  {new Intl.NumberFormat().format(
    order.order_details.reduce(
      (acc, item) =>
        acc +
        (item.sale > 0 ? item.sale : item.price) * item.quantity,
      0
    )
  )}{" "}
  VND
</td>

              <td
                style={{
                  border: "1px solid #ccc",
                  padding: "10px",
                  textAlign: "center",
                }}
              >
                {new Date(order.created_at).toLocaleDateString("vi-VN")}
              </td>
              <td
                style={{
                  border: "1px solid #ccc",
                  padding: "10px",
                  textAlign: "center",
                }}
              >
                <button
                  onClick={() => handleShowDetails(order)}
                  style={{
                    padding: "8px 12px",
                    backgroundColor: "#007BFF",
                    color: "white",
                    border: "none",
                    borderRadius: "4px",
                    cursor: "pointer",
                  }}
                >
                  Xem Chi Tiết
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    ) : (
      !showNotification && <p style={{ textAlign: "center" }}>Không có đơn hàng.</p>
    )}
  
    {/* Modal for Order Details */}
    <Modal order={selectedOrder} onClose={handleCloseModal} />
  </div>
  
  
  );
};

export default SearchOrder;
