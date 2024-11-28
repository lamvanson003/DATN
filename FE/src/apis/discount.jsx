import axios from "axios";
export const discountApi = {
  getAll: async () => {
    try {
      const response = await axios({
        url: " http://127.0.0.1:8000/api/discounts",
        method: "get",
        headers: {
          "Content-Type": "application/json",
        },
      });
      return response.data;
    } catch (err) {
      console.log("Không thể fetch dữ liệu");
    }
  },
  getOne: async (code) => {
    try {
      const response = await axios({
        url: `http://127.0.0.1:8000/api/discounts/${code}`,
        method: "get",
        headers: {
          "Content-Type": "application/json",
        },
      });

      return response.data.data;
    } catch (err) {
      console.log("Không thể fetch dữ liệu");
    }
  },
};
