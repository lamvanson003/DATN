import axios from "axios";
export const postApi = {
  getAll: async () => {
    try {
      const res = await axios.get("http://127.0.0.1:8000/api/posts");

      return res.data.data;
    } catch (err) {
      console.log("lỗi khi fetch dữ liệu: ", err);
    }
  },
  getOne: async (slug) => {
    try {
      const res = await axios.get(`http://127.0.0.1:8000/api/posts/${slug}`);
      return res.data.data;
    } catch (err) {
      console.log("lỗi khi fetch dữ liệu: ", err);
    }
  },
};
