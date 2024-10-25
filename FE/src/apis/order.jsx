import axios from "axios";
export const orderApi = {
  create: async (orderInfo) => {
    try {
      const response = await axios({
        url: "http://127.0.0.1:8000/api/orders",
        method: "post",
        data: orderInfo,
      });
      return response;
    } catch (err) {
      console.log(
        "Không thể fetch dữ liệu",
        err.response ? err.response.data : err
      );
      throw err;
    }
  },
};
