import React from "react";
import camera from "../assets/images/iHome/camera.png";
import clock from "../assets/images/iHome/hwclock.png";
import ssphone from "../assets/images/iHome/samsungphone.png";
import hwphone from "../assets/images/iHome/hwphone.png";
const News = () => {
  return (
    <div className="d-flex justify-content-center mt-3">
      <div className="container news-section">
        <div className="d-flex justify-content-between align-items-center mb-3">
          <div className="news-title">TIN CÔNG NGHỆ</div>
          <div className="view-all">
            <a href="#">Xem tất cả</a>
          </div>
        </div>
        <div className="d-flex justify-content-between">
          <div className="card">
            <img
              alt="DJI Osmo Action 5 Pro camera"
              className="card-img-top"
              height={150}
              src={camera}
              width={230}
            />
            <div className="card-body">
              <a href="#" className="card-title">
                <p className="card-title">
                  DJI ra mắt camera hành động Osmo Action 5 Pro, cạnh tranh trực
                  tiếp...
                </p>
              </a>
            </div>
          </div>
          <div className="card">
            <img
              alt="Huawei Watch GT 5 Series and Watch D2"
              className="card-img-top"
              height={150}
              src={clock}
              width={230}
            />
            <div className="card-body">
              <a href="#" className="card-title">
                <p className="card-title">
                  Huawei Watch GT 5 Series và Watch D2 ra mắt với hàng loạt tính
                  năng...
                </p>
              </a>
            </div>
          </div>
          <div className="card">
            <img
              alt="Huawei Mate XT Ultimate"
              className="card-img-top"
              height={150}
              src={hwphone}
              width={230}
            />
            <div className="card-body">
              <a href="#" className="card-title">
                <p className="card-title">
                  Huawei Mate XT Ultimate có giá ở “chợ đen” lên tới hơn 245
                  triệu đồng...
                </p>
              </a>
            </div>
          </div>
          <div className="card">
            <img
              alt="Samsung Galaxy S25"
              className="card-img-top"
              height={150}
              src={ssphone}
              width={230}
            />
            <div className="card-body">
              <a href="#" className="card-title">
                <p className="card-title">
                  Rò rỉ dung lượng pin Galaxy S25: Không có cải tiến nào đáng
                  chú ý
                </p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default News;
