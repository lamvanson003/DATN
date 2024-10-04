import React from "react";
import login from "../../assets/images/log.svg";
import { Link } from "react-router-dom";
import { useNavigate } from "react-router-dom";
const Signup = () => {
  const navigate = useNavigate();
  const handleNavigate = () => {
    navigate("/login"); // Điều hướng đến trang đăng nhập
  };
  return (
    <div className="container">
      <section className="vh-100">
        <div className="container py-5 h-100">
          <div className="row d-flex align-items-center justify-content-center h-100">
            <div className="col-md-8 col-lg-7 col-xl-6">
              <img alt="Phone image" style={{ width: "100%" }} src={login} />
            </div>
            <div className="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
              <h3 className="fw-bold text-center text-primary my-4 custom-title">
                SIGN UP
              </h3>
              <form>
                <div className="d-flex mb-2">
                  <div className="form-outline flex-fill mb-0">
                    <label className="form-label" htmlFor="form3Example1c">
                      <i className="fas fa-user fa-lg me-2 fa-fw" />
                      Họ tên:
                    </label>
                    <input
                      className="form-control"
                      id="form3Example1c"
                      type="text"
                      style={{
                        boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                        border: "none",
                        outline: "none",
                      }}
                    />
                  </div>
                </div>
                <div className="d-flex  mb-2">
                  <div className="form-outline flex-fill mb-0">
                    <label className="form-label" htmlFor="form3Example1c">
                      <i className="fas fa-user fa-lg me-2 fa-fw" />
                      Email:
                    </label>
                    <input
                      className="form-control"
                      id="form3Example1c"
                      type="text"
                      style={{
                        boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                        border: "none",
                        outline: "none",
                      }}
                    />
                  </div>
                </div>
                <div className="d-flex  mb-2">
                  <div className="form-outline flex-fill mb-0">
                    <label className="form-label" htmlFor="form3Example1c">
                      <i className="fas fa-lock fa-lg me-3 fa-fw" />
                      Mật khẩu:
                    </label>
                    <input
                      className="form-control"
                      id="form3Example1c"
                      type="text"
                      style={{
                        boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                        border: "none",
                        outline: "none",
                      }}
                    />
                  </div>
                </div>
                <div className="d-flex  mb-2">
                  <div className="form-outline flex-fill mb-0">
                    <label className="form-label" htmlFor="form3Example1c">
                      <i className="fas fa-lock fa-lg me-3 fa-fw" />
                      Lặp lại mật khẩu:
                    </label>
                    <input
                      className="form-control"
                      id="form3Example1c"
                      type="text"
                      style={{
                        boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                        border: "none",
                        outline: "none",
                      }}
                    />
                  </div>
                </div>
                <div className="form-check d-flex justify-content-center mb-2">
                  <input
                    className="form-check-input me-2"
                    defaultValue=""
                    id="form2Example3c"
                    type="checkbox"
                  />
                  <label className="form-check-label" htmlFor="form2Example3">
                    Tôi đồng ý với <a href="#!">Điều khoản dịch vụ</a>
                  </label>
                </div>
                <div className="d-flex justify-content-center">
                  <button
                    className="btn btn-primary btn-lg btn-block"
                    type="submit"
                  >
                    Đăng ký
                  </button>
                </div>
                <div className="mt-4">
                  Đã có tài khoản? Đăng nhập
                  <span
                    style={{
                      cursor: "pointer",
                      textDecoration: "none",
                      color: "blue",
                      marginLeft: 5,
                    }} // Thêm kiểu để giống với Link
                    onClick={handleNavigate}
                  >
                    tại đây
                  </span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Signup;
