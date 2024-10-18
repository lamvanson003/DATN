import React, { useState } from "react";
import login from "../../assets/images/log.svg";
import { useNavigate } from "react-router-dom";
import axios from "axios"; // Import Axios

const Signup = () => {
  const navigate = useNavigate();
  const [username, setUsername] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [passwordConfirmation, setPasswordConfirmation] = useState("");
  const [error, setError] = useState("");
  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsSubmitting(true);
    setError(""); 
    const data = {
      username,
      email,
      password,
      password_confirmation: passwordConfirmation, 
    };

    try {
      const response = await axios.post("http://localhost:8000/api/registers", data, {
        headers: {
          "Content-Type": "application/json",
        },
      });

      if (response.status === 200) {
        navigate("/login"); 
      }
    } catch (err) {
      if (err.response && err.response.data) {
        setError(err.response.data.message || "Registration failed");
      } else {
        setError("An error occurred. Please try again.");
      }
    } finally {
      setIsSubmitting(false);
    }
  };

  const handleNavigate = () => {
    navigate("/login"); 
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
              <form onSubmit={handleSubmit}>
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
                      value={username}
                      onChange={(e) => setUsername(e.target.value)}
                      style={{
                        boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                        border: "none",
                        outline: "none",
                      }}
                    />
                  </div>
                </div>
                <div className="d-flex mb-2">
                  <div className="form-outline flex-fill mb-0">
                    <label className="form-label" htmlFor="form3Example2c">
                      <i className="fas fa-envelope fa-lg me-2 fa-fw" />
                      Email:
                    </label>
                    <input
                      className="form-control"
                      id="form3Example2c"
                      type="email"
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                      style={{
                        boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                        border: "none",
                        outline: "none",
                      }}
                    />
                  </div>
                </div>
                <div className="d-flex mb-2">
                  <div className="form-outline flex-fill mb-0">
                    <label className="form-label" htmlFor="form3Example3c">
                      <i className="fas fa-lock fa-lg me-3 fa-fw" />
                      Mật khẩu:
                    </label>
                    <input
                      className="form-control"
                      id="form3Example3c"
                      type="password"
                      value={password}
                      onChange={(e) => setPassword(e.target.value)}
                      style={{
                        boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                        border: "none",
                        outline: "none",
                      }}
                    />
                  </div>
                </div>
                <div className="d-flex mb-2">
                  <div className="form-outline flex-fill mb-0">
                    <label className="form-label" htmlFor="form3Example4c">
                      <i className="fas fa-lock fa-lg me-3 fa-fw" />
                      Lặp lại mật khẩu:
                    </label>
                    <input
                      className="form-control"
                      id="form3Example4c"
                      type="password"
                      value={passwordConfirmation}
                      onChange={(e) => setPasswordConfirmation(e.target.value)}
                      style={{
                        boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                        border: "none",
                        outline: "none",
                      }}
                    />
                  </div>
                </div>

                {error && <div className="text-danger">{error}</div>} 
                
                <div className="form-check d-flex justify-content-center mb-2">
                  <input
                    className="form-check-input me-2"
                    id="form2Example3"
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
                    disabled={isSubmitting} 
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
                    }}
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
