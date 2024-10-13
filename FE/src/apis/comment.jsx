import axios from "axios";

export const commentApi = {
  getAll: async () => {
    try {
      const response = await axios.get("/api/comment");
      return response.data;
    } catch (err) {
      console.log("không thể fetch được dữ liệu", err);
    }
  },
  getCommentByPid: async (pid) => {
    try {
      // Lấy file comment.json từ public folder
      const response = await axios.get("/comment.json");

      // Lọc dữ liệu dựa trên product id (pid)
      const data = response.data;
      const commentpid = data.filter((cmt) => cmt.productId === pid);

      return commentpid;
    } catch (err) {
      console.log("Không thể fetch được dữ liệu", err);
      return []; // Trả về mảng rỗng nếu có lỗi xảy ra
    }
  },
};
