import axios from "axios";
export const productApi = {
  getAll: async () => {
    try {
      const response = await axios.get("/api/prodcut");
      return response.data;
    } catch (err) {
      console.log("Ko thể fetch được dữ liệu", err);
      return [];
    }
  },
  getOne: () => {},
};
