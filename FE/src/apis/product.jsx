import axios from "axios";
export const productApi = {
  getAll: async () => {
    try {
      const response = await axios({
        url: "http://127.0.0.1:8000/api/products",
        method: "get",
      });
      return response;
    } catch (err) {
      console.log("Ko thể fetch được dữ liệu", err);
      return [];
    }
  },
  getOne: async (pid) => {
    try {
      const response = await axios({
        url: "/api/detailproduct",
        method: "get",
        params: {
          pid: pid,
        },
      });
      return response.data;
    } catch (err) {
      console.log("Không thể fetch được dữ liệu", err);
    }
  },
};
