import React, { useEffect, useState } from "react";
import "./css/Invoice.css";
import logoCloudLab from "../../assets/images/iHome/logo.svg";
import { useParams } from "react-router-dom";
import { orderApi } from "../../apis";
import { formatCurrency } from "../../ultis/func";
const Invoice = () => {
  const { id } = useParams();
  const [invoiceDetail, setInvoiceDetail] = useState();
  useEffect(() => {
    try {
      const fetchInvoice = async () => {
        const res = await orderApi.getOne(id);
        console.log(res.data.data.order_details);
        setInvoiceDetail(res.data.data);
      };
      fetchInvoice();
    } catch (err) {
      console.log("Lỗi khi cố lấy dữ liệu hóa đơn", err);
    }
  }, [id]);
  const totalAmount = invoiceDetail?.order_details?.reduce(
    (total, item) =>
      total + item.quantity * (item.sale !== 0 ? item.sale : item.price),
    0
  );
  const tax = totalAmount * 0.1;
  const totalPayment = totalAmount + tax;
  const formattedDate = invoiceDetail?.created_at
    ? new Intl.DateTimeFormat("vi-VN", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
      }).format(new Date(invoiceDetail.created_at))
    : "";
  return (
    <div className="invoice-container">
      <div className="header">
        <img src={logoCloudLab} alt="Logo Công ty" />
        <h1>HÓA ĐƠN GIÁ TRỊ GIA TĂNG</h1>
        <p>{formattedDate}</p>
        <p>Ký hiệu: 1K22TAB &nbsp;&nbsp; Số: 0000000</p>
      </div>
      <div className="invoice-info">
        <p>
          <span className="bold">Họ tên người mua hàng: </span>
          {invoiceDetail?.fullname}
        </p>
        <p>
          <span className="bold">Tên đơn vị:</span> {invoiceDetail?.agency}
        </p>
        <p>
          <span className="bold">Địa chỉ:</span> {invoiceDetail?.address}
        </p>
        <p>
          <span className="bold">Mã số thuế:</span> {invoiceDetail?.TIN}
        </p>
        <p>
          <span className="bold">Hình thức thanh toán:</span>
          {invoiceDetail?.payment_method_id === 1
            ? "Thanh toán khi nhận hàng"
            : "Thanh toán online"}
        </p>
      </div>
      <table className="table-container">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên hàng hóa, dịch vụ</th>
            <th>ĐVT</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
          </tr>
        </thead>
        <tbody>
          {invoiceDetail?.order_details.map((item, index) => (
            <tr key={item.id}>
              <td>{index + 1}</td>
              <td>
                {item?.product_variant
                  ? `${item.product_variant.name} ${item.product_variant.color} ${item.product_variant.storage}`
                  : "Thông tin không có sẵn"}
              </td>
              <td>{invoiceDetail.unit}</td>
              <td>{item?.quantity}</td>
              <td>
                {formatCurrency(item.sale !== 0 ? item.sale : item.price)}
              </td>
              <td>
                {formatCurrency(
                  (item.sale !== 0 ? item.sale : item.price) * item.quantity
                )}
              </td>
            </tr>
          ))}
          <tr>
            <td colSpan="5" style={{ textAlign: "right" }}>
              Cộng tiền hàng:
            </td>
            <td>{formatCurrency(totalAmount ? totalAmount : 0)}</td>
          </tr>
          <tr>
            <td colSpan="5" style={{ textAlign: "right" }}>
              Tiền thuế GTGT:
            </td>
            <td>{formatCurrency(tax ? tax : 0)}</td>
          </tr>
          <tr>
            <td colSpan="5" style={{ textAlign: "right" }}>
              <b>Tổng tiền thanh toán:</b>
            </td>
            <td>
              <b>{formatCurrency(totalPayment ? totalPayment : 0)}</b>
            </td>
          </tr>
        </tbody>
      </table>

      <div className="footer">
        <div className="signature-container">
          <div className="signature">
            <p>Người mua hàng</p>
            <p>(Ký, ghi rõ họ tên)</p>
          </div>
          <div className="signature">
            <p>Người bán hàng</p>
            <p>(Ký, ghi rõ họ tên)</p>
            <p className="note">
              Signature Valid
              <br />
              Ký bởi: Công ty Cổ phần MISA
              <br />
              Ký ngày: 13/01/2021
            </p>
          </div>
        </div>
        <p>
          Tra cứu tại Website:
          <a href="https://meInvoice.vn/tra-cuu/">meInvoice.vn/tra-cuu</a> - Mã
          tra cứu: GEHMFS8PP
        </p>
      </div>
    </div>
  );
};

export default Invoice;
