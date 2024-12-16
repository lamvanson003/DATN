import axios from "axios";
export const brandApi = {
  getAll: async () => {
    try {
      const response = await axios.get("http://127.0.0.1:8000/api/brands");
      return response.data.data;
    } catch (err) {
      console.log("ko thể fetch dữ liệu", err);
    }
  },
  getOneByCate: async (cate, id) => {
    try {
      const response = await axios.get(
        `http://127.0.0.1:8000/api/products/category/${cate}?brand_id=${id}`
      );
      return response.data.data;
    } catch (err) {
      console.error("Error fetching data:", err.message);
      if (err.response) {
        console.error("Response error:", err.response.data);
      }
      return null;
    }
  },
};
