import axios from "axios";

const headers = {
  "Content-Type": "application/json",
};

export const postApi = {
  getAll: async () => {
    try {
      const res = await axios.get("http://127.0.0.1:8000/api/posts", {
        headers: headers,
      });
      return res.data.data;
    } catch (err) {
      console.log("lỗi khi fetch dữ liệu: ", err);
    }
  },
  getOne: async (slug) => {
    try {
      const res = await axios.get(`http://127.0.0.1:8000/api/posts/${slug}`, {
        headers: headers,
      });
      return res.data.data;
    } catch (err) {
      console.log("lỗi khi fetch dữ liệu: ", err);
    }
  },
  getFeature: async () => {
    try {
      const res = await axios.get(
        "http://127.0.0.1:8000/api/posts/is_featured",
        {
          headers: headers,
        }
      );
      return res.data.data;
    } catch (err) {
      console.log("lỗi khi fetch dữ liệu: ", err);
    }
  },
};
