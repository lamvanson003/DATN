import axios from "axios";
export const paymentApi = {
  create: async (orderData) => {
    try {
      const response = await axios.post("http://127.0.0.1:8000/api/payments", {
        order_id: orderId,
      });
      if (response.data) {
        window.location.href = response.data;
      }
    } catch (error) {
      console.error("Lỗi khi tạo thanh toán:", error);
    }
  },
};
