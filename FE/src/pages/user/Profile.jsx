import React, { useState } from "react";
import "./css/Profile.css";
// import { updateUserAccount } from "../../apis/profile";
import icons from "../../ultis/icon";
const Profile = () => {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [phone, setPhone] = useState("");
  const { LuUser2 } = icons;
  const handleSubmit = async (e) => {
    e.preventDefault();
    const userId = 1;
    const userData = {
      name,
      email,
      phone,
    };
    try {
      const result = await updateUserAccount(userId, userData);
      console.log("Kết quả: ", result);
    } catch (error) {
      console.log("Không thể cập nhật thông tin người dùng");
    }
  };
  return (
    <div className="row">
      <div
        className="row"
        style={{ borderBottom: "1px solid gray", paddingBottom: 10 }}
      >
        <h3>Hồ sơ của tôi</h3>
        <span>Quản lý thông tin hồ sơ để bảo mật tài khoản</span>
      </div>
      <div className="row mt-3">
        <div className="col-sm-9">
          <form action="" className="form-container">
            <div className="form-group">
              <label htmlFor="">Họ và tên:</label>
              <input type="text" />
            </div>
            <div className="form-group">
              <label htmlFor="">Email:</label>
              <input type="email" />
            </div>
            <div className="form-group">
              <label htmlFor="">Số điện thoại:</label>
              <input type="text" />
            </div>
            <div className="form-group">
              <label htmlFor="">Địa chỉ:</label>
              <input type="text" />
            </div>
            <div className="form-group form-group-gender d-flex gap-3">
              <label>Giới tính</label>
              <div>
                <input type="radio" id="male" name="gender" value="male" />
                <label htmlFor="male">Nam</label>
              </div>

              <div>
                <input type="radio" id="female" name="gender" value="female" />
                <label htmlFor="female">Nữ</label>
              </div>

              <div>
                <input type="radio" id="other" name="gender" value="other" />
                <label htmlFor="other">Khác</label>
              </div>
            </div>
            <div className="form-group d-flex align-items-center">
              <label htmlFor="dob">Ngày sinh:</label>
              <input type="date" id="dob" name="dob" />
            </div>
            <div className="d-flex justify-content-center">
              <button
                className="btn btn-primary"
                style={{ width: "20%" }}
                type="submit"
              >
                Lưu
              </button>
            </div>
          </form>
        </div>
        <div className="col-sm-3">
          <div className=" my-3 d-flex flex-column align-items-center">
            <span className="m-3">
              <LuUser2
                size={120}
                className="p-3 border border-secondary rounded-circle"
              />
            </span>
            <input
              type="file"
              id="image-upload"
              name="image-upload"
              className="form-control"
              accept="image/*"
            />
            <span className="opacity-75">
              Dụng lượng file tối đa 1 MB Định dạng:.JPEG, .PNG
            </span>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Profile;
