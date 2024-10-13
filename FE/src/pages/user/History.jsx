import React from "react";
import icons from "../../ultis/icon";
const { BsSearch, CiShop, FaRocketchat, RiTruckLine } = icons;
const History = () => {
  return (
    <div className="d-flex flex-column gap-4">
      <div className="d-flex align-items-center justify-content-between ">
        <span>Tất cả</span>
        <span>Chờ thanh toán</span>
        <span>Vận chuyển</span>
        <span>Chờ giao hàng</span>
        <span>Hoàn thành</span>
        <span>Đã hủy</span>
        <span>Trả hàng/ Hoàn tiền</span>
      </div>
      <div className="d-flex flex-column gap-4">
        <div
          className="d-flex align-items-center px-3 py-1 rounded gap-2 "
          style={{ backgroundColor: "rgb(234, 234, 234)", height: 50 }}
        >
          <span className="d-flex align-items-center">
            <BsSearch />
          </span>
          <span style={{ width: "100%" }}>
            <input
              type="text"
              style={{
                backgroundColor: "rgb(234, 234, 234)",
                width: "100%",
                outline: "none",
                border: "none",
              }}
              placeholder=" Bạn có thể tìm kiếm theo tên Shop, ID đơn hàng hoặc tên sản phẩm"
            />
          </span>
        </div>
        <div
          className="d-flex flex-column gap-4 rounded p-3"
          style={{ boxShadow: " 0 4px 15px rgba(0, 0, 0, 0.3)" }}
        >
          <div
            className="d-flex align-items-center justify-content-between pb-2"
            style={{ borderBottom: "1px solid rgb(234, 234, 234)" }}
          >
            <div className="d-flex align-items-center gap-4">
              <span className="d-flex gap-1">
                <span className="d-flex align-items-center">
                  <CiShop size={24} />
                </span>
                <span className="fw-bold">Tên cửa hàng</span>
              </span>
              <span
                className="rounded d-flex p-1 gap-1 text-light"
                style={{ backgroundColor: "rgb(13, 110, 253)" }}
              >
                <span className="d-flex align-items-center">
                  <FaRocketchat />
                </span>
                <span>Chat</span>
              </span>
              <span
                className="rounded d-flex p-1 gap-1"
                style={{
                  border: "1px, solid, rgb(13, 110, 253)",
                  color: "rgb(13, 110, 253)",
                }}
              >
                <span className="d-flex align-items-center">
                  <CiShop />
                </span>
                <span>Xem shop</span>
              </span>
            </div>
            <div className="d-flex align-items-center gap-2 text-success">
              <span className="d-flex align-items-center">
                <RiTruckLine size={24} />
              </span>
              <span>Trạng thái đơn hàng</span>
            </div>
          </div>
          <div
            className="d-flex align-items-center justify-content-between pb-2"
            style={{ borderBottom: "1px solid rgb(234, 234, 234)" }}
          >
            <div className="d-flex gap-4">
              <img src="" alt="ảnh sản phảm" />
              <div className="d-flex flex-column">
                <span>Tên sản phẩm</span>
                <span className="opcaity-75">Phân loại</span>
                <span>Số lượng</span>
                <span>Ưu đãi</span>
              </div>
            </div>
            <div>
              <span>Giá tiền</span>
            </div>
          </div>
          <div className="d-flex flex-column gap-4 pb-2">
            <div className="d-flex align-items-center justify-content-end">
              Thành tiền:
              <span className="text-danger fs-3">120</span>
            </div>
            <div className="d-flex justify-content-between gap-4">
              <span
                className="px-2 py-1 rounded text-light fw-semibold"
                style={{
                  backgroundColor: "rgb(13, 110, 253)",
                  cursor: "pointer",
                }}
              >
                Đánh giá
              </span>
              <span
                className="rounded px-2 py-1"
                style={{
                  border: "1px solid rgb(13, 110, 253)",
                  cursor: "pointer",
                }}
              >
                Yêu cầu trả hàng/ hoàn tiền
              </span>
              <span
                className="rounded px-2 py-1"
                style={{
                  border: "1px solid rgb(13, 110, 253)",
                  cursor: "pointer",
                }}
              >
                Thêm
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default History;
