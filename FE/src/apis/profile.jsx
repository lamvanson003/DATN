import axios from "axios";
export const updateUserAccount = async (userId, userData) => {
  try {
    const response = await axios.put(
      `https://api.example.com/users/${userId}`,
      userData
    );
    return response.data;
  } catch (error) {
    console.log("lỗi khi cập nhật thông tin", error);
  }
};
