import axios from "axios";
export const orderApi = {
  create: async (orderInfo) => {
    try {
      const response = await axios({
        url: "http://127.0.0.1:8000/api/orders",
        method: "post",
        data: orderInfo,
      });
      if (response.status === 200) {
        console.log(response.data);
      }
      return response.data.order_id;
    } catch (err) {
      console.log(
        "Không thể fetch dữ liệu",
        err.response ? err.response.data : err
      );
      throw err;
    }
  },
  getOne: async (id) => {
    try {
      const response = await axios({
        url: `http://127.0.0.1:8000/api/orders/detail/${id}`,
        method: "get",
      });
      console.log(response);
      return response;
    } catch (err) {
      console.log("Không thể fetch dữ liệu: ", err);
    }
  },
};
