import axios from "axios";

export const commentApi = {
  getAll: async () => {
    try {
      const response = await axios.get("http://127.0.0.1:8000/api/comments/{product_variant_id}");
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
  postComment: async (uId, pId, comment) => {
    try {
      const response = await axios({
        url: "http://127.0.0.1:8000/api/comments",
        method: "post",
        headers: {
          "Content-Type": "application/json",
        },
        data: {
          uId,
          pId,
          comment,
        },
      });
      console.log("bình luận đã được đăng !");
      return response.data;
    } catch (err) {
      console.log("Không thể đăng tải bình luận", err);
    }
  },
};
