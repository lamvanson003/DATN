import React, { useState } from "react";
import login from "../../assets/images/log.svg";
import { useNavigate } from "react-router-dom";
import axios from "axios"; 

const Signup = () => {
  const navigate = useNavigate();
  const [username, setUsername] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [passwordConfirmation, setPasswordConfirmation] = useState("");
  const [phone, setPhone] = useState("");
  const [error, setError] = useState("");
  const [errors, setErrors] = useState({}); // State cho từng lỗi cụ thể
  const [isSubmitting, setIsSubmitting] = useState(false);

  const validateForm = () => {
    let isValid = true;
    const newErrors = {};

    // Kiểm tra các trường không được để trống
    if (!username) {
      newErrors.username = "Tên không được để trống";
      isValid = false;
    }
    if (!email) {
      newErrors.email = "Email không được để trống";
      isValid = false;
    }
    if (!password) {
      newErrors.password = "Mật khẩu không được để trống";
      isValid = false;
    } else if (password.length < 6) {
      newErrors.password = "Mật khẩu phải dài hơn 6 ký tự";
      isValid = false;
    }
    if (password !== passwordConfirmation) {
      newErrors.passwordConfirmation = "Mật khẩu không khớp";
      isValid = false;
    }
    if (!phone) {
      newErrors.phone = "Số điện thoại không được để trống";
      isValid = false;
    } else if (!/^\d{10}$/.test(phone)) {
      newErrors.phone = "Số điện thoại phải là 10 số";
      isValid = false;
    }

    setErrors(newErrors);
    return isValid;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError(""); // Xóa lỗi tổng quát trước khi submit
    setErrors({}); // Xóa các lỗi cụ thể trước khi submit

    if (!validateForm()) {
      return; // Dừng lại nếu form không hợp lệ
    }

    const data = {
      username,
      email,
      password,
      password_confirmation: passwordConfirmation, 
      phone,
    };

    setIsSubmitting(true);
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
      if (err.response && err.response.status === 409) {
        // API trả về lỗi xung đột (trùng email hoặc số điện thoại)
        const errorMessage = err.response.data.error; // Lấy thông báo lỗi từ API

        // Kiểm tra thông báo lỗi và cập nhật state errors để hiển thị lỗi tương ứng
        if (errorMessage.includes("Email")) {
          setErrors({ email: "Email đã được sử dụng. Vui lòng nhập email khác." });
        } else if (errorMessage.includes("Phone")) {
          setErrors({ phone: "Số điện thoại đã được sử dụng. Vui lòng nhập số khác." });
        } else {
          setError("Đăng ký thất bại. Vui lòng thử lại.");
        }
      } else {
        setError("Có lỗi xảy ra. Vui lòng thử lại.");
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
                    {errors.username && <div className="text-danger">{errors.username}</div>}
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
                    {errors.email && <div className="text-danger">{errors.email}</div>}
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
                    {errors.password && <div className="text-danger">{errors.password}</div>}
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
                    {errors.passwordConfirmation && (
                      <div className="text-danger">{errors.passwordConfirmation}</div>
                    )}
                  </div>
                </div>
                <div className="d-flex mb-2">
                  <div className="form-outline flex-fill mb-0">
                    <label className="form-label" htmlFor="form3Example5c">
                      <i className="fas fa-phone fa-lg me-3 fa-fw" />
                      Số điện thoại :
                    </label>
                    <input
                      className="form-control"
                      id="form3Example5c"
                      type="text"
                      value={phone}
                      onChange={(e) => setPhone(e.target.value)}
                      style={{
                        boxShadow: "3px 3px 5px rgba(0, 0, 0, 0.3)",
                        border: "none",
                        outline: "none",
                      }}
                    />
                    {errors.phone && <div className="text-danger">{errors.phone}</div>}
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

                <div className="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                  <button
                    className="btn btn-primary btn-lg"
                    type="submit"
                    disabled={isSubmitting}
                  >
                    {isSubmitting ? "Đang đăng ký..." : "Đăng ký"}
                  </button>
                </div>

                <div className="form-check d-flex justify-content-center mb-2">
                  <label className="form-check-label" htmlFor="form2Example4">
                    Bạn đã có tài khoản?{" "}
                    <a href="#" onClick={handleNavigate}>
                      Đăng nhập
                    </a>
                  </label>
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
