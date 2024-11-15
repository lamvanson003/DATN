import React, { useState } from "react";
import axios from "axios";
import login from "../../assets/images/log.svg"; // Path to image
import { Link, useNavigate } from "react-router-dom";
import "./css/Signup.css"; // Ensure correct CSS file path

const Signup = () => {
  const navigate = useNavigate();
  const [username, setUsername] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [passwordConfirmation, setPasswordConfirmation] = useState("");
  const [phone, setPhone] = useState("");
  const [error, setError] = useState("");
  const [errors, setErrors] = useState({});
  const [isSubmitting, setIsSubmitting] = useState(false);

  const validateForm = () => {
    let isValid = true;
    const newErrors = {};

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
    if (phone && !/^\d{10,15}$/.test(phone)) {  // Updated regex to accept 10-15 digits
      newErrors.phone = "Số điện thoại phải từ 10 đến 15 ký tự số";
      isValid = false;
    }

    setErrors(newErrors);
    return isValid;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");
    setErrors({});
  
    if (!validateForm()) return;
  
    const data = {
      username,
      email,
      password,
      password_confirmation: passwordConfirmation, // Key should match what's expected
      phone,
    };
  
    setIsSubmitting(true);
    try {
      console.log("Sending data:", data); // Log the data being sent
      const response = await axios.post("http://localhost:8000/api/registers", data, {
        headers: { "Content-Type": "application/json" },
      });
  
      if (response.status === 200) {
        navigate("/login"); // Navigate to login on success
      }
    } catch (err) {
      console.error("Error response:", err.response); // Log the full error response
  
      if (err.response) {
        const errorMessage = err.response.data.error || err.response.data.errors;
  
        if (errorMessage) {
          // Handle specific error messages
          if (errorMessage.email) {
            setErrors({ email: "Email đã được sử dụng. Vui lòng nhập email khác." });
          } else if (errorMessage.phone) {
            setErrors({ phone: "Số điện thoại đã được sử dụng. Vui lòng nhập số khác." });
          } else {
            setError("Tên tài khoản đã tồn tại . Vui lòng thử lại.");
          }
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
  

  return (
    <div className="container">
      <section className="vh-100">
        <div className="container py-5 h-100">
          <div className="row d-flex align-items-center justify-content-center h-100">
            <div className="col-md-8 col-lg-7 col-xl-6">
              <img alt="Signup" style={{ width: "100%" }} src={login} />
            </div>
            <div className="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
              <h3 className="fw-bold text-center text-primary my-4 custom-title">SIGN UP</h3>
              <form onSubmit={handleSubmit}>
                <div className="d-flex mb-2">
                  <div className="form-outline flex-fill mb-0">
                    <label className="form-label" htmlFor="form3Example1c">
                      <i className="fas fa-user fa-lg me-2 fa-fw" />
                      Tên tài khoản :
                    </label>
                    <input
                      className="form-control"
                      id="form3Example1c"
                      type="text"
                      value={username}
                      onChange={(e) => setUsername(e.target.value)}
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
                    />
                    {errors.passwordConfirmation && <div className="text-danger">{errors.passwordConfirmation}</div>}
                  </div>
                </div>
                <div className="d-flex mb-2">
                  <div className="form-outline flex-fill mb-0">
                    <label className="form-label" htmlFor="form3Example5c">
                      <i className="fas fa-phone fa-lg me-3 fa-fw" />
                      Số điện thoại:
                    </label>
                    <input
                      className="form-control"
                      id="form3Example5c"
                      type="text"
                      value={phone}
                      onChange={(e) => setPhone(e.target.value)}
                    />
                    {errors.phone && <div className="text-danger">{errors.phone}</div>}
                  </div>
                </div>
                {error && <div className="text-danger">{error}</div>}
                <div className="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                  <button className="btn btn-primary btn-lg" type="submit" disabled={isSubmitting}>
                    {isSubmitting ? "Đang đăng ký..." : "Đăng ký"}
                  </button>
                </div>
                <div className="form-check d-flex justify-content-center mb-2">
                  <label className="form-check-label" htmlFor="form2Example4">
                    Bạn đã có tài khoản?{" "}
                    <Link to="/login">Đăng nhập</Link>
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
