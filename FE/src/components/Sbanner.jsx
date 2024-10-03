import React from "react";
import sbanner1 from "../assets/images/iHome/image sub banner-1.png";
import sbanner2 from "../assets/images/iHome/image sub banner-2.png";
import sbanner3 from "../assets/images/iHome/image sub banner-3.png";

const Sbanner = () => {
  return (
    <div className="sub-banner-embrace">
      <div className="container mt-5">
        <div className="row justify-content-center flex-nowrap">
          <div className="col-auto">
            <div className="sub-banner">
              <img src={sbanner1} alt="Banner 1 Image" className="img-fluid" />
              <h5 className="text-center">Sub Banner 1</h5>
            </div>
          </div>
          <div className="col-auto">
            <div className="sub-banner">
              <img src={sbanner2} alt="Banner 2 Image" className="img-fluid" />
              <h5 className="text-center">Sub Banner 2</h5>
            </div>
          </div>
          <div className="col-auto">
            <div className="sub-banner">
              <img src={sbanner3} alt="Banner 3 Image" className="img-fluid" />
              <h5 className="text-center">Sub Banner 3</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Sbanner;
