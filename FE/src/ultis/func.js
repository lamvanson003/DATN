export const setupSlider = (slidesRef, formRef, prevRef, nextRef) => {
  let currentIndex = 0;
  let interval;

  // Hàm hiển thị slide
  const showSlide = (index) => {
    slidesRef.current.forEach((slide, i) => {
      slide.classList.remove("active");
      if (i === index) {
        slide.classList.add("active");
        if (index === 0 && formRef.current) {
          formRef.current.style.display = "flex"; // Hiển thị form ở banner đầu tiên
        } else if (formRef.current) {
          formRef.current.style.display = "none"; // Ẩn form ở các banner khác
        }
      }
    });
  };

  // Hiển thị slide đầu tiên
  showSlide(currentIndex);

  // Tạm dừng và khởi động lại interval
  const resetInterval = () => {
    clearInterval(interval);
    interval = setInterval(() => {
      currentIndex =
        currentIndex === slidesRef.current.length - 1 ? 0 : currentIndex + 1;
      showSlide(currentIndex);
    }, 10000);
  };

  // Sự kiện click cho prev và next
  const handlePrevClick = () => {
    currentIndex =
      currentIndex === 0 ? slidesRef.current.length - 1 : currentIndex - 1;
    showSlide(currentIndex);
    resetInterval(); // reset lại interval khi người dùng click
  };

  const handleNextClick = () => {
    currentIndex =
      currentIndex === slidesRef.current.length - 1 ? 0 : currentIndex + 1;
    showSlide(currentIndex);
    resetInterval(); // reset lại interval khi người dùng click
  };

  // Kiểm tra và thêm sự kiện khi ref không bị null
  if (prevRef.current && nextRef.current) {
    prevRef.current.addEventListener("click", handlePrevClick);
    nextRef.current.addEventListener("click", handleNextClick);
  }

  // Tự động chuyển slide mỗi 10 giây
  interval = setInterval(() => {
    currentIndex =
      currentIndex === slidesRef.current.length - 1 ? 0 : currentIndex + 1;
    showSlide(currentIndex);
  }, 10000);

  // Dọn dẹp interval và sự kiện khi component bị unmount
  return () => {
    clearInterval(interval);
    if (prevRef.current && nextRef.current) {
      prevRef.current.removeEventListener("click", handlePrevClick);
      nextRef.current.removeEventListener("click", handleNextClick);
    }
  };
};
