import React, { useState } from "react";
import "./css/Profile.css";
import avatar from "../../assets/images/iHome/Amazon.png";
import { updateUserAccount } from "../../apis/profile";
const Profile = () => {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [phone, setPhone] = useState("");
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
    <div>
      <form onSubmit={handleSubmit}>
        <label>
          Tên:
          <input
            type="text"
            value={name}
            onChange={(e) => setName(e.target.value)}
            required
          />
        </label>
        <label>
          Email:
          <input
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
          />
        </label>
        <label>
          Điện thoại:
          <input
            type="tel"
            value={phone}
            onChange={(e) => setPhone(e.target.value)}
          />
        </label>
        <button type="submit">Cập nhật thông tin</button>
      </form>
    </div>
  );
};

export default Profile;
