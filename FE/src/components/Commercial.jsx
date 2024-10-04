import React from "react";
import asus from "../assets/images/iHome/asus.png";
import laptop from "../assets/images/iHome/image laptop.png";
import phone from "../assets/images/iHome/image phone banner.png";
const Commercial = () => {
  return (
    <div className="d-flex justify-content-center mt-5">
      <div className="d-flex justify-content-between ">
        <div className="commercial-detailing container ">
          <div className="row justify-content-center flex-nowrap mb-5">
            <div className="col-auto">
              <div className="commercial">
                <img src={asus} alt="Banner 1 Image" className="img-fluid" />
                <h5 className="text-center ">Sub Banner 1</h5>
              </div>
            </div>
            <div className="col-auto">
              <div className="commercial ">
                <img src={laptop} alt="Banner 2 Image" className="img-fluid" />
                <h5 className="text-center ">Sub Banner 2</h5>
              </div>
            </div>
            <div className="col-auto">
              <div className="commercial">
                <img src={phone} alt="Banner 3 Image" className="img-fluid" />
                <h5 className="text-center ">Sub Banner 3</h5>
              </div>
            </div>
          </div>
          <div className="row text-center">
            <div className="col-md-3">
              <div className="info-box">
                <i className="fas fa-box-open" />
                <p>Dễ dàng hoàn hàng</p>
                <small>trong 30 ngày</small>
              </div>
            </div>
            <div className="col-md-3">
              <div className="info-box">
                <i className="fas fa-box-open" />
                <p>Dễ dàng hoàn hàng</p>
                <small>trong 30 ngày</small>
              </div>
            </div>
            <div className="col-md-3">
              <div className="info-box">
                <i className="fas fa-box-open" />
                <p>Dễ dàng hoàn hàng</p>
                <small>trong 30 ngày</small>
              </div>
            </div>
            <div className="col-md-3">
              <div className="info-box">
                <i className="fas fa-box-open" />
                <p>Dễ dàng hoàn hàng</p>
                <small>trong 30 ngày</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Commercial;
