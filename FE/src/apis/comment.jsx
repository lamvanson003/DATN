import axios from "axios";

export const commentApi = {
  getAll: async () => {
    try {
      const response = await axios.get(
        "http://127.0.0.1:8000/api/comments/{product_variant_id}"
      );
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
  postComment: async (uId, pId, content, rating, images) => {
    try {
      const formData = new FormData();
      formData.append("uId", uId);
      formData.append("pId", pId);
      formData.append("content", content);
      formData.append("rating", rating);
      images.forEach((image, index) => {
        formData.append(`images[${index}]`, image);
      });

      const response = await axios.post(
        "http://127.0.0.1:8000/api/comments",
        formData,
        {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        }
      );

      console.log("Bình luận đã được đăng!", response.data);
      return response.data;
    } catch (err) {
      console.error("Không thể đăng tải bình luận", err);
      throw err;
    }
  },
};
