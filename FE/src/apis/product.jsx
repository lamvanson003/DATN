import axios from "axios";
export const productApi = {
  getAllphone: async () => {
    try {
      const response = await axios({
        url: " http://127.0.0.1:8000/api/products/category/dien-thoai",
        method: "get",
      });
      return response;
    } catch (err) {
      console.log("Ko thể fetch được dữ liệu", err);
      return [];
    }
  },
  getAlllaptop: async () => {
    try {
      const response = await axios({
        url: " http://127.0.0.1:8000/api/products/category/laptop",
        method: "get",
      });
      return response;
    } catch (err) {
      console.log("Ko thể fetch được dữ liệu", err);
      return [];
    }
  },
  getOne: async (slug) => {
    try {
      const response = await axios({
        url: `http://127.0.0.1:8000/api/products/${slug}`, // Sử dụng slug trực tiếp trong URL
        method: "get",
      });
      return response.data.data;
    } catch (err) {
      console.log("Không thể fetch được dữ liệu", err);
    }
  },
  search: async (name) => {
    try {
      const res = await axios({
        url: `http://127.0.0.1:8000/api/searchs`,
        params: { name },
        timeout: 500,
        method: "get",
      });

      if (res?.data?.data) {
        return res.data.data;
      } else {
        console.warn("Dữ liệu không hợp lệ từ API");
        return [];
      }
    } catch (err) {
      console.log("lỗi ko thể fetch dữ liệu: ", err);
      return [];
    }
  },
};
