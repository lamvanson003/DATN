import { useEffect, useState } from "react";

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

  showSlide(currentIndex);

  const resetInterval = () => {
    clearInterval(interval);
    interval = setInterval(() => {
      currentIndex =
        currentIndex === slidesRef.current.length - 1 ? 0 : currentIndex + 1;
      showSlide(currentIndex);
    }, 10000);
  };

  const handlePrevClick = () => {
    currentIndex =
      currentIndex === 0 ? slidesRef.current.length - 1 : currentIndex - 1;
    showSlide(currentIndex);
    resetInterval();
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
export const formatCurrency = (value) => {
  return value.toLocaleString("vi-VN", {
    style: "currency",
    currency: "VND",
  });
};
export const handleNumber = (number) => {
  if (number > Math.pow(10, 6)) {
    return `${Math.round((number * 10) / Math.pow(10, 6)) / 10} M`;
  } else if (number < 1000) {
    return number;
  } else {
    return `${Math.round((number * 10) / Math.pow(10, 3)) / 10}K`;
  }
};
export function debounce(func, delay) {
  let timeout;
  function debounced(...args) {
    clearTimeout(timeout);
    timeout = setTimeout(() => func.apply(this, args), delay);
  }
  debounced.cancel = () => {
    clearTimeout(timeout);
  };

  return debounced;
}
export const transformFormatProducts = (product) => {
  return {
    id: product.id,
    name: product.name,
    images: product.images,
    slug: product.slug,
    category: {
      name: product.category.name,
    },
    brand: {
      name: product.brand.name,
    },
    start_time: product.start_time,
    end_time: product.end_time,
    sold: product.sold,
    quantity_limit: product.quantity_limit,
    product_variant: [
      {
        storage: product.product_variant[0]?.storage,
        variants: product.product_variant.map((variant) => ({
          id: variant.id,
          sku: variant.sku,
          storage: variant.storage,
          sale: product.discount_price,
          price: variant.price,
          images: variant.images,
          color: variant.color,
          instock: variant.instock,
          sold: variant.sold,
          is_flash_sale: variant.is_flash_sale,
        })),
      },
    ],
    product_image_items: product.product_image_items.map((item) => ({
      id: item.id,
      name: item.name,
      images: item.images,
    })),
  };
};

export const useCountdown = (start_time, end_time) => {
  const [timeRemaining, setTimeRemaining] = useState({
    hours: 0,
    minutes: 0,
    seconds: 0,
    status: "upcoming", // upcoming, active, expired
  });

  useEffect(() => {
    const calculateTimeRemaining = () => {
      const currentTime = new Date(); // Current date/time
      const startTime = new Date(start_time); // Parse start time
      const endTime = new Date(end_time); // Parse end time

      let status = "";
      let remainingTime = 0;

      if (currentTime < startTime) {
        // Event has not started yet
        status = "upcoming";
        remainingTime = startTime - currentTime; // Time until event starts
      } else if (currentTime >= startTime && currentTime < endTime) {
        // Event is currently active
        status = "active";
        remainingTime = endTime - currentTime; // Time until event ends
      } else {
        // Event has ended
        status = "expired";
        remainingTime = 0;
      }

      const hours = Math.floor(remainingTime / (1000 * 60 * 60));
      const minutes = Math.floor(
        (remainingTime % (1000 * 60 * 60)) / (1000 * 60)
      );
      const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

      setTimeRemaining({
        hours,
        minutes,
        seconds,
        status,
      });
    };

    calculateTimeRemaining();
    const interval = setInterval(calculateTimeRemaining, 1000);
    return () => clearInterval(interval);
  }, [start_time, end_time]);

  return timeRemaining;
};
