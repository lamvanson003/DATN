import axios from "axios";
export const brandApi = {
  getAll: async () => {
    try {
      const response = await axios.get("/api/brand");
      return response.data;
    } catch (err) {
      console.log("ko thể fetch dữ liệu", err);
    }
  },
};
