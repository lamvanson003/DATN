import React, { useState } from "react";
import axios from "axios"; 
import login from "../../assets/images/log.svg";
import { Link, useNavigate } from "react-router-dom";
import "./css/Login.css";

const Login = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [errorMessage, setErrorMessage] = useState("");
  const navigate = useNavigate();

  const handleLogin = async (event) => {
    event.preventDefault(); 

    const loginData = { email, password };

    try {
      const response = await axios.post("http://localhost:8000/api/logins", loginData, {
        headers: {
          "Content-Type": "application/json",
        },
      });

      const data = response.data;
      console.log(data); 
      if (data.redirect_url) {
        window.location.href = data.redirect_url; 
      } else {
        navigate("/"); 
      }
    } catch (error) {
      console.error("Error during login:", error);
      if (error.response) {
        console.error("Response data:", error.response.data); 
        setErrorMessage(error.response.data.error || "đăng nhập thất bại ");
      } else {
        setErrorMessage("An unexpected error occurred.");
      }
    }
  };

  const navigateSignup = () => {
    navigate("/signup");
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
                LOGIN
              </h3>
              {errorMessage && (
                <div className="alert alert-danger" role="alert">
                  {errorMessage}
                </div>
              )}
              <form onSubmit={handleLogin}>
                <div className="form-outline mb-4">
                  <label className="form-label" htmlFor="form1Example13">
                    Email:
                  </label>
                  <input
                    className="form-control form-control-lg"
                    id="form1Example13"
                    type="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    style={{
                      boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                      border: "none",
                      outline: "none",
                    }}
                    required
                  />
                </div>
                <div className="form-outline mb-4">
                  <label className="form-label" htmlFor="form1Example23">
                    Mật khẩu:
                  </label>
                  <input
                    className="form-control form-control-lg"
                    id="form1Example23"
                    type="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    style={{
                      boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                      border: "none",
                      outline: "none",
                    }}
                    required
                  />
                </div>
                <div className="d-flex justify-content-between align-items-center mb-4">
                  <div className="form-check">
                    <label className="form-check-label " htmlFor="form1Example3">
                      Ghi nhớ đăng nhập
                    </label>
                    <input
                      className="form-check-input "
                      defaultChecked
                      id="form1Example3"
                      type="checkbox"
                    />
                  </div>
                  <span>Quên mật khẩu ?</span>
                  <span onClick={navigateSignup} style={{ cursor: "pointer" }}>
                    Chưa có tài khoản ?
                  </span>
                </div>
                <button
                  className="btn btn-primary btn-lg btn-block"
                  type="submit"
                >
                  Đăng nhập
                </button>
                <div className="divider d-flex align-items-center my-4">
                  <p className="text-center fw-bold mx-3 mb-0 text-muted">
                    Hoặc
                  </p>
                </div>
                <div className="row mt-3 ">
                  <span className="col-sm-6 text-start">
                    <a
                      className="btn btn-primary border-0 btn-lg btn-block"
                      href="#!"
                      style={{
                        backgroundColor: "#3b5998",
                        fontSize: 16,
                      }}
                    >
                      <i className="fab fa-facebook-f me-2" />
                      Đăng nhập bằng Facebook
                    </a>
                  </span>
                  <span className="col-sm-6 text-end">
                    <a
                      className="btn btn-primary border-0 btn-lg btn-block"
                      href="#!"
                      style={{
                        backgroundColor: "#DB4437",
                        fontSize: 16,
                      }}
                    >
                      <i className="fab fa-google me-2" />
                      Đăng nhập bằng Google
                    </a>
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

export default Login;
