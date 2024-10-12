import axios from "axios";
export const cartApi = {
  getCart: async (userId) => {
    try {
      const response = await axios({
        url: "https://api.example.com/cart",
        method: "get",
        params: { userId },
      });
      return response.data;
    } catch (err) {
      console.log("Không thể fetch được dữ liệu", err);
    }
  },
  addToCart: async (userId, product, quantity) => {
    try {
      const currentCart = await this.getCart(userId);
      const existingItem = currentCart.find(
        (item) => item.product.id === product.id
      );
      if (existingItem) {
        const newQuantity = existingItem.quanity + quantity;
        const response = await axios.put(
          `https://api.example.com/cart/${existingItem.id}`,
          {
            quanity: newQuantity,
          }
        );
        return response.data;
      } else {
        const response = await axios.post(`https://api.example.com/cart`, {
          userId,
          product, // Thêm toàn bộ thông tin sản phẩm
          quantity,
        });
        return response.data;
      }
    } catch (err) {
      console.log("Ko thể thêm sản phẩm vào giỏ hàng", err);
      throw err;
    }
  },
};
