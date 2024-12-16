import React, { useRef, useState } from "react";
import { commentApi } from "../apis";

const SubmitComment = ({ currentVariant }) => {
  const [loadingComment, setLoadingComment] = useState(false);
  const [images, setImages] = useState([]);
  const [name, setName] = useState("");
  const [content, setContent] = useState("");
  const [isModalOpen, setIsModalOpen] = useState(false);
  const modalContentRef = useRef(null);
  const [rating, setRating] = useState(0);

  const openModal = () => {
    setIsModalOpen(true);
  };

  const closeModal = () => {
    setIsModalOpen(false);
  };
  const handleOutsideClick = (e) => {
    if (
      modalContentRef.current &&
      !modalContentRef.current.contains(e.target)
    ) {
      closeModal();
    }
  };
  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!name.trim()) {
      alert("Vui lòng nhập họ tên!");
      return;
    }
    if (name.trim().length <= 4) {
      alert("Tên phải có nhiều hơn 4 ký tự!");
      return;
    }
    if (!content.trim()) {
      alert("Vui lòng nhập bình luận!");
      return;
    }
    setLoadingComment(true);
    console.log(currentVariant?.color?.id);
    try {
      await commentApi.postComment({
        pId: currentVariant?.color?.id,
        name,
        content,
        rating,
        images,
        uId: 1,
      });
      console.log(images);
      setName("");
      setContent("");
      setImages([]);
      setRating(0);
      setIsModalOpen(false);
    } catch (error) {
      alert("Đã xảy ra lỗi khi gửi bình luận!");
    } finally {
      setLoadingComment(false);
    }
  };
  const removeImage = (indexToRemove) => {
    setImages((prevImages) =>
      prevImages.filter((_, index) => index !== indexToRemove)
    );
  };

  // Handle image selection
  const handleImageChange = (e) => {
    const selectedFiles = Array.from(e.target.files);
    const validImages = selectedFiles.filter((file) =>
      [
        "image/jpeg",
        "image/png",
        "image/jpg",
        "image/gif",
        "image/svg+xml",
      ].includes(file.type)
    );

    if (validImages.length !== selectedFiles.length) {
      alert("Một số tệp không phải định dạng hình ảnh hợp lệ!");
    }
    setImages((prevImages) => [...prevImages, ...validImages]);
  };
  return (
    <div className="modal" onClick={handleOutsideClick}>
      <div className="modal-content" ref={modalContentRef}>
        <span className="close" onClick={closeModal}>
          &times;
        </span>

        <div className="form-comment">
          <span className="comment-label">
            Vui lòng để lại cảm nghĩ về sản phẩm:
          </span>
          <form className="comment-form" onSubmit={handleSubmit}>
            <div className="star-rating">
              {[1, 2, 3, 4, 5].map((star) => (
                <span
                  key={star}
                  className={star <= rating ? "star selected" : "star"}
                  onClick={() => setRating(star)}
                >
                  ★
                </span>
              ))}
            </div>
            <input
              type="text"
              className="comment-input"
              value={name}
              placeholder="Họ tên của bạn"
              onChange={(e) => setName(e.target.value)}
            />
            <textarea
              className="comment-textarea"
              placeholder="Hãy nêu suy nghĩ của bạn"
              value={content}
              onChange={(e) => setContent(e.target.value)}
            />
            <div className="form-footer">
              <div className="image-upload">
                <input
                  type="file"
                  multiple
                  accept="image/*"
                  onChange={handleImageChange}
                  id="image-upload"
                />
                <label htmlFor="image-upload" className="upload-label">
                  <i className="fas fa-image"></i> Chọn hình ảnh
                </label>
              </div>

              <button
                className="btn-submit"
                type="submit"
                disabled={loadingComment}
              >
                {loadingComment ? "Đang gửi ..." : "Gửi đánh giá"}
              </button>
            </div>
          </form>
          <div className="image-preview">
            {images.map((image, index) => (
              <div key={index} className="preview-item">
                <img
                  src={URL.createObjectURL(image)}
                  alt={`chosen-preview-${index}`}
                  className="preview-img"
                />
                <button
                  type="button"
                  className="remove-image"
                  onClick={() => removeImage(index)}
                >
                  X
                </button>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
};

export default SubmitComment;
