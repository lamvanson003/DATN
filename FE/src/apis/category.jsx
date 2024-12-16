import axios from "axios";

const headers = {
  "Content-Type": "application/json",
};

export const categoryApi = {
  getAll: async () => {
    try {
      const response = await axios.get("api/category", { headers: headers });
      return response.data;
    } catch (err) {
      console.log("Không thể fetch dữ liệu", err);
    }
  },
};
