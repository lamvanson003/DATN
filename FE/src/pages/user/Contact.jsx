import React from "react";
import '../user/css/Contact.css';

const Contact = () => {
  return <div className="container contact-section">
  <div className="text-center mb-5">
    <h2>liên hệ với chúng tôi</h2>
    <p>
      Bạn có thắc mắc hoặc nhận xét gì không? Hãy viết tin nhắn cho chúng tôi!
    </p>
  </div>
  <div className="row">
    <div className="col-md-5">
      <div className="contact-info">
        <h3>Thông tin liên hệ</h3>
        <p>Hãy nói điều gì đó để bắt đầu trò chuyện trực tiếp!</p>
        <p>
          <i className="fas fa-phone-alt" /> 1234567890
        </p>
        <p>
          <i className="fas fa-envelope" /> 444@gmail.com
        </p>
        <p>
          <i className="fas fa-map-marker-alt" /> cầu giấy 
        </p>
      </div>
    </div>
    <div className="col-md-7">
      <div className="contact-form">
        <form>
          <div className="row mb-3">
            <div className="col">
              <label htmlFor="firstName" className="form-label">
                Họ
              </label>
              <input
                type="text"
                className="form-control"
                id="firstName"
                placeholder="nhập họ của bạn "
              />
            </div>
            <div className="col">
              <label htmlFor="lastName" className="form-label">
                Tên
              </label>
              <input
                type="text"
                className="form-control"
                id="lastName"
                placeholder="nhập tên của bạn "
              />
            </div>
          </div>
          <div className="row mb-3">
            <div className="col">
              <label htmlFor="email" className="form-label">
                Email
              </label>
              <input
                type="email"
                className="form-control"
                id="email"
                placeholder=""
              />
            </div>
            <div className="col">
              <label htmlFor="phone" className="form-label">
                Số điện thoại
              </label>
              <input
                type="text"
                className="form-control"
                id="phone"
                placeholder="nhập số điện thoại "
              />
            </div>
          </div>
          <div className="mb-3">
            <label htmlFor="message" className="form-label">
              Tin nhắn
            </label>
            <textarea
              className="form-control"
              id="message"
              rows={4}
              placeholder="Viết phản hồi của bạn"
              defaultValue={""}
            />
          </div>
          <button type="submit" className="btn">
            Gửi tin nhắn
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

};

export default Contact;
