import axios from "axios";
import { toast } from "react-toastify";

export const commentApi = {
  getCommentByPid: async (pid) => {
    try {
      const response = await axios.get(
        `http://127.0.0.1:8000/api/comments/${pid}`
      );

      return response.data;
    } catch (err) {
      console.log("không thể fetch được dữ liệu", err);
    }
  },
  postComment: async ({
    pId,
    name,
    content,
    uId = null,
    rating = null,
    images = [],
  }) => {
    if (!pId || !name || !content) {
      throw new Error(
        "Missing required parameters: product ID, name, or content."
      );
    }

    try {
      const formData = new FormData();
      formData.append("product_variant_id", pId);
      formData.append("name", name);
      formData.append("content", content);
      formData.append("user_id", uId);
      if (rating !== null) formData.append("rating", rating);

      if (images.length > 0) {
        images.forEach((image, index) => {
          if (image instanceof File) {
            formData.append(`images[${index}]`, image);
          } else {
            console.error("Invalid image type:", image);
          }
        });
      }

      const response = await axios.post(
        "http://127.0.0.1:8000/api/comments",
        formData,
        {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        }
      );
      toast.info("Bình luận của bạn đang được chờ duyệt");
      console.log("Bình luận đã được đăng!", response.data);
      return response.data;
    } catch (err) {
      console.error("Không thể đăng tải bình luận", err);
      throw err;
    }
  },
  postPostComment: async ({ postId, name, content, uId = null }) => {
    if (!postId || !name || !content) {
      throw new Error(
        "Missing required parameters: product ID, name, or content."
      );
    }

    try {
      const formData = new FormData();
      formData.append("post_id", postId);
      formData.append("name", name);
      formData.append("content", content);
      formData.append("user_id", uId);

      const response = await axios.post(
        "http://127.0.0.1:8000/api/comments",
        formData,
        {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        }
      );
      toast.info("Bình luận của bạn đang được chờ duyệt");
      console.log("Bình luận đã được đăng!", response.data);
      return response.data;
    } catch (err) {
      console.error("Không thể đăng tải bình luận", err);
      throw err;
    }
  },
};
