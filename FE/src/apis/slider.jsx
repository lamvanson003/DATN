import axios from "axios";

const headers = {
  "Content-Type": "application/json",
};

export const sliderApi = {
  getAll: async (id) => {
    try {
      const response = await axios.get(
        `http://127.0.0.1:8000/api/sliders/show/${id}`,
        { headers: headers }
      );
      return response.data;
    } catch (err) {
      console.error("Không thể fetch dữ liệu:", err.message);
      throw err;
    }
  },
};
