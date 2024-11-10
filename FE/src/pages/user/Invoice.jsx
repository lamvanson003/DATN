import React from "react";
import "./css/Invoice.css";
import logoCloudLab from "../../assets/images/iHome/logo.svg";
const Invoice = () => {
  return (
    <div className="invoice-container">
      {/* Header */}
      <div className="header">
        <img src={logoCloudLab} alt="Logo Công ty" />
        <h1>HÓA ĐƠN GIÁ TRỊ GIA TĂNG</h1>
        <p>Ngày 13 tháng 1 năm 2022</p>
        <p>Ký hiệu: 1K22TAB &nbsp;&nbsp; Số: 0000000</p>
      </div>

      {/* Invoice Information */}
      <div className="invoice-info">
        <p>
          <span className="bold">Họ tên người mua hàng:</span> Lê Bảo An
        </p>
        <p>
          <span className="bold">Tên đơn vị:</span> Công Ty Cổ phần Minh Phát
        </p>
        <p>
          <span className="bold">Địa chỉ:</span> 34, đường Nguyễn Lân, quận
          Thanh Xuân, Hà Nội
        </p>
        <p>
          <span className="bold">Mã số thuế:</span> 010100010022
        </p>
        <p>
          <span className="bold">Hình thức thanh toán:</span> TM/CK
        </p>
      </div>

      {/* Product Table */}
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
          {/* Example row, add actual data rows here */}
          <tr>
            <td>1</td>
            <td>Sản phẩm A</td>
            <td>Cái</td>
            <td>10</td>
            <td>100,000</td>
            <td>1,000,000</td>
          </tr>
          <tr>
            <td colSpan="5" style={{ textAlign: "right" }}>
              Cộng tiền hàng:
            </td>
            <td>1,000,000</td>
          </tr>
          <tr>
            <td colSpan="5" style={{ textAlign: "right" }}>
              Tiền thuế GTGT:
            </td>
            <td>100,000</td>
          </tr>
          <tr>
            <td colSpan="5" style={{ textAlign: "right" }}>
              <b>Tổng tiền thanh toán:</b>
            </td>
            <td>
              <b>1,100,000</b>
            </td>
          </tr>
        </tbody>
      </table>

      {/* Footer */}
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
          Tra cứu tại Website:{" "}
          <a href="https://meInvoice.vn/tra-cuu/">meInvoice.vn/tra-cuu</a> - Mã
          tra cứu: GEHMFS8PP
        </p>
      </div>
    </div>
  );
};

export default Invoice;
