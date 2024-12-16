import React, { useRef, useEffect, useState } from "react";


const Banner = () => {
  const [sliders, setSliders] = useState([]); 
  const [currentSlide, setCurrentSlide] = useState(0); 
  const slidesRef = useRef([]); 
  const prevRef = useRef(null);
  const nextRef = useRef(null);

  useEffect(() => {
    const fetchSliderData = async () => {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/sliders?status=active');
        const data = await response.json();
        if (data.success && data.slider) {
          setSliders([data.slider]);
        }
      } catch (error) {
        console.error("Error fetching slider data: ", error);
      }
    };
  
    fetchSliderData();
  }, []);
  

  const allSlides = Array.isArray(sliders)
  ? sliders.reduce((acc, slider) => {
      const mainBannerItems = slider.slider_items?.filter(
        (item) => item.type === "main_banner"
      ) || [];
      return acc.concat(mainBannerItems);
    }, [])
  : [];


  const totalSlides = allSlides.length;

  const handlePrev = () => {
    setCurrentSlide((prev) => (prev === 0 ? totalSlides - 1 : prev - 1));
  };

  const handleNext = () => {
    setCurrentSlide((prev) => (prev === totalSlides - 1 ? 0 : prev + 1));
  };

  useEffect(() => {
    if (prevRef.current) {
      prevRef.current.addEventListener('click', handlePrev);
    }

    if (nextRef.current) {
      nextRef.current.addEventListener('click', handleNext);
    }

    return () => {
      if (prevRef.current) {
        prevRef.current.removeEventListener('click', handlePrev);
      }
      if (nextRef.current) {
        nextRef.current.removeEventListener('click', handleNext);
      }
    };
  }, [sliders]);

  return (
    <div className="d-flex justify-content-center mt-5 mb-5">
      <div className="banner-slide m-0">
        {sliders.length > 0 && (
          <div className="banner-content">
            {allSlides.map((item, index) => (
              <img
                key={item.id}
                ref={(el) => (slidesRef.current[index] = el)}
                src={item.images}
                alt={item.title}
                className={`img-fluid ${index === currentSlide ? 'active' : ''}`}
              />
            ))}
          
          </div>
        )}
        <div className="nav-icons">
          <i
            className="fas fa-chevron-left"
            aria-hidden="true"
            ref={prevRef}
            id="prev"
          />
          <i
            className="fas fa-chevron-right"
            aria-hidden="true"
            ref={nextRef}
            id="next"
          />
        </div>
      </div>
    </div>
  );
};

export default Banner;
