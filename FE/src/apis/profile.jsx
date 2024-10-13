import axios from "axios";
export const profileApi = {
  getUserAccount: async (userId) => {
    try {
      const response = await axios({
        url: `https://api.example.com/users/${userId}`,
        method: "get",
      });
      return response.data;
    } catch (err) {
      console.log("Ko thể fetch được dữ liệu", err);
    }
  },

  updateUserAccount: async (userId, userData) => {
    try {
      const response = await axios({
        url: `https://api.example.com/users/${userId}`,
        method: "put",
        data: userData,
      });
      return response.data;
    } catch (error) {
      console.log("lỗi khi cập nhật thông tin", error);
    }
  },
};
