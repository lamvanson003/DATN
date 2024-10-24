import axios from "axios";
export const paymentApi = {
  create: async (orderData) => {
    try {
      const response = await axios.post(
        "http://localhost:5173/create_payment_url",
        orderData,
        {
          headers: {
            "Content-Type": "application/json",
          },
        }
      );
      const paymentUrl = response.data.paymentUrl;
      window.location.href = paymentUrl;
    } catch (err) {
      console.log("Payment error: ", err);
    }
  },
};
