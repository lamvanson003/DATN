import axios from "axios";
export const paymentApi = {
  create: async (orderInfo) => {
    try {
      const response = await axios.post(
        "http://127.0.0.1:8000/api/payments",
        orderInfo,
        {
          headers: {
            "Content-Type": "application/json",
          },
        }
      );
      if (response.data.payment_url) {
        window.location.href = response.data.payment_url;
        // console.log(response.data);
      } else {
        alert("Có lỗi xảy ra, vui lòng thử lại.");
      }
    } catch (error) {
      console.error("Lỗi thanh toán:", error);
    }
  },
};
