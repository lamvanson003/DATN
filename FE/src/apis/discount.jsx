import axios from "axios";
export const discountApi = {
  getAll: async () => {
    try {
      const response = await axios({
        url: " http://127.0.0.1:8000/api/discounts",
        method: "get",
      });
      return response.data;
    } catch (err) {
      console.log("Không thể fetch dữ liệu");
    }
  },
  getOne: async (code) => {
    try {
      const response = await axios({
        url: `http://127.0.0.1:8000/api/discounts${code}`,
        method: "get",
      });
      response.data;
    } catch (err) {
      console.log("Không thể fetch dữ liệu");
    }
  },
};
