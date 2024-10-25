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
      if (err.response) {
        console.log("Payment error (server response): ", err.response.data);
      } else if (err.request) {
        console.log("Payment error (no response): ", err.request);
      } else {
        console.log("Payment error (request setup): ", err.message);
      }
    }
  },
};
