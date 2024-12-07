import axios from "axios";
export const postCategory = {
  getAll: async () => {
    try {
      const res = await axios.get("http://127.0.0.1:8000/api/posts/category");
      return res.data.data;
    } catch (err) {
      console.log("Lỗi khi fetch dữ liệu:", err);
    }
  },
  getOne: async (slug) => {
    try {
      const res = await axios.get("");
      return res.data;
    } catch (err) {
      console.log("Lỗi khi fetch dữ liệu: ", err);
    }
  },
};
