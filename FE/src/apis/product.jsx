import axios from "axios";
export const productApi = {
  getAllphone: async () => {
    try {
      const response = await axios({
        url: " http://127.0.0.1:8000/api/products/category/dien-thoai",
        method: "get",
        headers: {
          "Content-Type": "application/json",
        },
      });
      return response;
    } catch (err) {
      console.log("Ko thể fetch được dữ liệu", err);
      return [];
    }
  },
  getCurrentFs: async () => {
    try {
      const response = await axios({
        url: " http://127.0.0.1:8000/api/flash-sales/active",
        method: "get",
        headers: {
          "Content-Type": "application/json",
        },
      });

      return response.data.data;
    } catch (err) {
      console.log("Ko thể fetch được dữ liệu", err);
      return [];
    }
  },
  getComingFs: async () => {
    try {
      const response = await axios({
        url: " http://127.0.0.1:8000/api/flash-sales/pending",
        method: "get",
        headers: {
          "Content-Type": "application/json",
        },
      });
      return response.data.data;
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
        headers: {
          "Content-Type": "application/json",
        },
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
        headers: {
          "Content-Type": "application/json",
        },
      });
      return response.data.data;
    } catch (err) {
      console.log("Không thể fetch được dữ liệu", err);
    }
  },
  getDealHot: async (cate) => {
    try {
      const res = await axios.get(
        `http://127.0.0.1:8000/api/products/hotdeal?category=${cate}`
      );
      return res.data.data;
    } catch (err) {
      console.log("Lỗi không thể fetch dữ liệu: ", err);
    }
  },
  search: async (name) => {
    try {
      const res = await axios({
        url: `http://127.0.0.1:8000/api/searchs`,
        params: { name },
        timeout: 500,
        method: "get",
        headers: {
          "Content-Type": "application/json",
        },
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
