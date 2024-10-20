import React, { useState } from "react";
import "./css/InfoPro.css"; // Chứa các class và animation

const DeviceSpecs = () => {
  // State riêng biệt cho từng phần
  const [isConfigOpen, setIsConfigOpen] = useState(false);
  const [isBatteryOpen, setIsBatteryOpen] = useState(false);
  const [isUtilityOpen, setIsUtilityOpen] = useState(false); // State cho phần Tiện ích
  const [isConnectOpen, setIsConnectOpen] = useState(false);
  const [isDesignOpen, setIsDesignOpen] = useState(false);
  // Hàm toggle cho "Cấu hình & Bộ nhớ"
  const toggleConfigCollapse = () => {
    setIsConfigOpen(!isConfigOpen);
  };

  // Hàm toggle cho "Pin & Sạc"
  const toggleBatteryCollapse = () => {
    setIsBatteryOpen(!isBatteryOpen);
  };

  // Hàm toggle cho "Tiện ích"
  const toggleUtilityCollapse = () => {
    setIsUtilityOpen(!isUtilityOpen);
  };
  const toggleConnectCollapse = () => {
    setIsConnectOpen(!isConnectOpen);
  };
  const toggleDesignCollapse = () => {
    setIsDesignOpen(!isDesignOpen);
  };
  return (
    <>
      {/* Phần Cấu hình & Bộ nhớ */}
      <div className="mt-4 px-0">
        <div
          className="rounded border border-secondary p-2 my-1 d-flex align-items-center justify-content-between"
          style={{ backgroundColor: "#fff", cursor: "pointer" }}
          onClick={toggleConfigCollapse}
        >
          <h3 style={{ fontSize: 24 }}>Cấu hình & Bộ nhớ</h3>
          <span className="me-3">{isConfigOpen ? "▲" : "▼"}</span>
        </div>

        {/* Add class for smooth transition */}
        <div className={`collapse-content ${isConfigOpen ? "open" : ""}`}>
          <table className="table table-hover">
            <tbody>
              <tr>
                <th>Hệ điều hành</th>
                <td>Android 14</td>
              </tr>
              <tr>
                <th>Chip xử lý (CPU)</th>
                <td>Exynos 1480 8 nhân</td>
              </tr>
              <tr>
                <th>Tốc độ CPU</th>
                <td>4 nhân 2.7 GHz & 4 nhân 2 GHz</td>
              </tr>
              <tr>
                <th>Chip đồ họa (GPU)</th>
                <td>AMD Titan 1WGP</td>
              </tr>
              <tr>
                <th>RAM</th>
                <td>12 GB</td>
              </tr>
              <tr>
                <th>Dung lượng lưu trữ</th>
                <td>256 GB</td>
              </tr>
              <tr>
                <th>Dung lượng còn lại (khả dụng)</th>
                <td>235.5 GB</td>
              </tr>
              <tr>
                <th>Thẻ nhớ</th>
                <td>MicroSD, hỗ trợ tối đa 1 TB</td>
              </tr>
              <tr>
                <th>Danh bạ</th>
                <td>Không giới hạn</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      {/* Phần Pin & Sạc */}
      <div className="mt-4 px-0">
        <div
          className="rounded border border-secondary p-2 my-1 d-flex align-items-center justify-content-between"
          style={{ backgroundColor: "#fff", cursor: "pointer" }}
          onClick={toggleBatteryCollapse}
        >
          <h3 style={{ fontSize: 24 }}>Pin & Sạc</h3>
          <span className="me-3">{isBatteryOpen ? "▲" : "▼"}</span>
        </div>

        <div className={`collapse-content ${isBatteryOpen ? "open" : ""}`}>
          <table className="table table-hover">
            <tbody>
              <tr>
                <th style={{ width: "50%" }}>Dung lượng pin</th>
                <td>5000 mAh</td>
              </tr>
              <tr>
                <th>Loại pin</th>
                <td>Li-Po</td>
              </tr>
              <tr>
                <th>Hỗ trợ sạc tối đa</th>
                <td>25 W</td>
              </tr>
              <tr>
                <th>Công nghệ pin</th>
                <td>
                  <a
                    href="#"
                    style={{ color: "#007bff", textDecoration: "none" }}
                  >
                    Tiết kiệm pin
                  </a>
                  ,{" "}
                  <a
                    href="#"
                    style={{ color: "#007bff", textDecoration: "none" }}
                  >
                    Sạc pin nhanh
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      {/* Phần Tiện ích */}
      <div className="mt-4 px-0">
        <div
          className="rounded border border-secondary p-2 my-1 d-flex align-items-center justify-content-between"
          style={{ backgroundColor: "#fff", cursor: "pointer" }}
          onClick={toggleUtilityCollapse}
        >
          <h3 style={{ fontSize: 24 }}>Tiện ích</h3>
          <span className="me-3">{isUtilityOpen ? "▲" : "▼"}</span>
        </div>

        <div className={`collapse-content ${isUtilityOpen ? "open" : ""}`}>
          <table className="table table-hover">
            <tbody>
              <tr>
                <th style={{ width: "50%" }}>Bảo mật nâng cao</th>
                <td>
                  Mở khoá vân tay dưới màn hình
                  <br />
                  Mở khoá khuôn mặt
                </td>
              </tr>
              <tr>
                <th>Tính năng đặc biệt</th>
                <td>
                  Ứng dụng kép (Dual Messenger)
                  <br />
                  Đa cửa sổ (chia đôi màn hình)
                  <br />
                  Âm thanh Dolby Atmos
                  <br />
                  Tối ưu game (Game Booster)
                  <br />
                  Trợ lý ảo Samsung Bixby
                  <br />
                  Thu nhỏ màn hình sử dụng một tay
                  <br />
                  Mở rộng bộ nhớ RAM
                  <br />
                  Màn hình luôn hiển thị AOD
                  <br />
                  Không gian thứ hai (Thư mục bảo mật)
                  <br />
                  Chế độ đơn giản (Giao diện đơn giản)
                  <br />
                  Chặn tin nhắn
                  <br />
                  Chặn cuộc gọi
                  <br />
                  Chạm 2 lần tắt/sáng màn hình
                </td>
              </tr>
              <tr>
                <th>Kháng nước, bụi</th>
                <td>IP67</td>
              </tr>
              <tr>
                <th>Ghi âm</th>
                <td>
                  Ghi âm mặc định
                  <br />
                  Ghi âm cuộc gọi
                </td>
              </tr>
              <tr>
                <th>Radio</th>
                <td>Có</td>
              </tr>
              <tr>
                <th>Xem phim</th>
                <td>
                  WEBM
                  <br />
                  MP4
                  <br />
                  MKV
                  <br />
                  M4V
                  <br />
                  FLV
                  <br />
                  AV1
                  <br />
                  3GP
                  <br />
                  3G2
                </td>
              </tr>
              <tr>
                <th>Nghe nhạc</th>
                <td>
                  XMF
                  <br />
                  WAV
                  <br />
                  RTX
                  <br />
                  RTTTL
                  <br />
                  OTA
                  <br />
                  OGG
                  <br />
                  OGA
                  <br />
                  MXMF
                  <br />
                  MP3
                  <br />
                  Midi
                  <br />
                  M4A
                  <br />
                  IMY
                  <br />
                  FLAC
                  <br />
                  AWB
                  <br />
                  AMR
                  <br />
                  AAC
                  <br />
                  3GA
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      {/* Phần kết nối*/}
      <div className="mt-4 px-0">
        <div
          className="rounded border border-secondary p-2 my-1 d-flex align-items-center justify-content-between"
          style={{ backgroundColor: "#fff", cursor: "pointer" }}
          onClick={toggleConnectCollapse}
        >
          <h3 style={{ fontSize: 24 }}>Kết nối</h3>
          <span className="me-3">{isConnectOpen ? "▲" : "▼"}</span>
        </div>

        <div className={`collapse-content ${isConnectOpen ? "open" : ""}`}>
          <table className="table table-hover">
            <tbody>
              <tr>
                <th>Mạng di động</th>
                <td style={{ width: "50%" }}>Hỗ trợ 5G</td>
              </tr>
              <tr>
                <th>SIM</th>
                <td>2 Nano SIM + 1 eSIM</td>
              </tr>
              <tr>
                <th>Wifi</th>
                <td>
                  Wi-Fi hotspot
                  <br />
                  Wi-Fi Direct
                  <br />
                  Wi-Fi 802.11 a/b/g/n/ac/ax
                  <br />
                  Dual-band (2.4 GHz/5 GHz)
                </td>
              </tr>
              <tr>
                <th>GPS</th>
                <td>
                  QZSS
                  <br />
                  GPS
                  <br />
                  GLONASS
                  <br />
                  GALILEO
                  <br />
                  BEIDOU
                </td>
              </tr>
              <tr>
                <th>Bluetooth</th>
                <td>v5.3</td>
              </tr>
              <tr>
                <th>Cổng kết nối/sạc</th>
                <td>Type-C</td>
              </tr>
              <tr>
                <th>Jack tai nghe</th>
                <td>Type-C</td>
              </tr>
              <tr>
                <th>Kết nối khác</th>
                <td>NFC</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      {/* Phần thiết kế*/}
      <div className="mt-4 px-0">
        <div
          className="rounded border border-secondary p-2 my-1 d-flex align-items-center justify-content-between"
          style={{ backgroundColor: "#fff", cursor: "pointer" }}
          onClick={toggleDesignCollapse}
        >
          <h3 style={{ fontSize: 24 }}>Thiết kế & Chất liệu</h3>
          <span className="me-3">{isDesignOpen ? "▲" : "▼"}</span>
        </div>

        <div className={`collapse-content ${isDesignOpen ? "open" : ""}`}>
          <table className="table table-hover">
            <tbody>
              <tr>
                <th style={{ width: "50%" }}>Thiết kế</th>
                <td>Nguyên khối</td>
              </tr>
              <tr>
                <th>Chất liệu</th>
                <td>Khung kim loại & Mặt lưng kính</td>
              </tr>
              <tr>
                <th>Kích thước, khối lượng</th>
                <td>Dài 161.1 mm - Ngang 77.4 mm - Dày 8.2 mm - Nặng 213 g</td>
              </tr>
              <tr>
                <th>Thời điểm ra mắt</th>
                <td>03/2024</td>
              </tr>
              <tr>
                <th>Hãng</th>
                <td>
                  Samsung.{" "}
                  <a
                    href="#"
                    style={{ color: "#007bff", textDecoration: "none" }}
                  >
                    Xem thông tin hãng
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </>
  );
};

export default DeviceSpecs;
