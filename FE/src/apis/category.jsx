import axios from "axios";
export const categoryApi = {
  getAll: async () => {
    try {
      const response = await axios.get("api/category");
      return response.data;
    } catch (err) {
      console.log("Không thể fetch dữ liệu", err);
    }
  },
};
