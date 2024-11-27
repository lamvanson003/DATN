import React from "react";
import { useState } from "react";
import { useEffect } from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";
import "./css/AboutUs.css";
import pro1 from "../../assets/images/img1.webp";
import pro2 from "../../assets/images/img2.png";
import pro3 from "../../assets/images/img3.avif";
import spro1 from "../../assets/images/small-img1.jpg";
import spro2 from "../../assets/images/small-img2.jpg";
import spro3 from "../../assets/images/small-img3.jpg";
import plane from "../../assets/images/icon-plane.svg";
import bt from "../../assets/images/img-bt.jpg";
import tc1 from "../../assets/images/icon-1.png";
import tc2 from "../../assets/images/icon-2.png";
import tc3 from "../../assets/images/icon-3.png";
import tc4 from "../../assets/images/icon-4.png";
import tc5 from "../../assets/images/icon-5.png";
import tc6 from "../../assets/images/icon-6.png";
import logo1 from "../../assets/images/xiaomi.png";
import logo2 from "../../assets/images/Lenovo.png";
import logo3 from "../../assets/images/Huawei-Logo 1.png";
import logo4 from "../../assets/images/logo-samsung.png";
import logo5 from "../../assets/images/realme.png";
import logo6 from "../../assets/images/Apple_logo_black 1.png";
import avt1 from "../../assets/images/avt1.jpg";
import avt2 from "../../assets/images/avt2.jpg";
import avt3 from "../../assets/images/avt3.jpg";
import avt4 from "../../assets/images/avt4.jpg";
import avt5 from "../../assets/images/avt5.jpg";
const About = () => {
  const cardData = [
    {
      title: "Giá tốt nhất kèm nhiều ưu đãi",
      text: "chúng tôi mang đến cho bạn giá tốt nhất kèm theo nhiều ưu đãi hấp dẫn.",
      imgSrc: tc1,
    },
    {
      title: "Mua bán công bằng ",
      text: "Sản phẩm phải đáp ứng tiêu chuẩn chất lượng, tránh việc lừa dối khách hàng.",
      imgSrc: tc2,
    },
    {
      title: "Dịch vụ khách hàng tận tâm",
      text: "Đảm bảo sản phẩm đến tay bạn một cách nhanh chóng cam kết giao hàng trong thời gian ngắn.",
      imgSrc: tc3,
    },
    {
      title: "Phản hồi nhanh chóng",
      text: "Hỗ trợ mọi thắc mắc trong thời gian ngắn nhất. Không ngừng nâng cao chất lượng dịch vụ.",
      imgSrc: tc4,
    },
    {
      title: "100% hoàn trả",
      text: "Quy trình hoàn hàng được thiết kế dễ dàng và nhanh chóng.",
      imgSrc: tc5,
    },
    {
      title: "Giao hàng tận nơi",
      text: "Sản phẩm sẽ được giao đến địa chỉ bạn chỉ định, giúp tiết kiệm thời gian và công sức.",
      imgSrc: tc6,
    },
  ];

  const faqData = [
    {
      question: "Sản phẩm của CloudlAB có bảo hành không?",
      answer:
        "Tất cả sản phẩm tại CloudlAB đều có bảo hành chính hãng. Thời gian bảo hành tùy theo từng sản phẩm và nhà cung cấp.",
    },
    {
      question: "CloudlAB có miễn phí giao hàng không?",
      answer:
        "CloudlAB cung cấp dịch vụ giao hàng miễn phí cho các đơn hàng có giá trị từ 1 triệu đồng trở lên trong phạm vi nội thành.",
    },
    {
      question: "Có thể đổi sản phẩm sau khi mua không?",
      answer:
        "Nếu sản phẩm còn nguyên tem mác và chưa qua sử dụng, bạn có thể đổi trong vòng 7 ngày kể từ ngày nhận hàng.",
    },
    {
      question: "CloudlAB có hỗ trợ trả góp không?",
      answer:
        "Chúng tôi hỗ trợ trả góp qua các ngân hàng liên kết. Bạn có thể tham khảo thêm thông tin tại trang thanh toán của chúng tôi.",
    },
  ];
  const [openIndex, setOpenIndex] = useState(null);

  const handleToggle = (index) => {
    setOpenIndex(openIndex === index ? null : index);
  };

  useEffect(() => {
    AOS.init({
      duration: 1000,
    });
  }, []);

  const customerRate = [
    {
      imgSrc: avt1,
      name: "Nguyễn Văn A",
      role: "Khách hàng",
      text: "Sản phẩm rất chất lượng, tôi rất hài lòng với dịch vụ và sẽ tiếp tục ủng hộ!",
    },
    {
      imgSrc: avt2,
      name: "Lê Thị B",
      role: "Khách hàng",
      text: "Dịch vụ giao hàng nhanh chóng, nhân viên rất nhiệt tình, tôi sẽ giới thiệu cho bạn bè.",
    },
    {
      imgSrc: avt3,
      name: "Trần Minh C",
      role: "Khách hàng",
      text: "Tôi rất ấn tượng với chất lượng sản phẩm. Sẽ quay lại mua hàng tiếp trong tương lai.",
    },
    {
      imgSrc: avt4,
      name: "Phạm Quang D",
      role: "Khách hàng",
      text: "Một trải nghiệm tuyệt vời, hỗ trợ khách hàng rất chu đáo và sản phẩm hoàn toàn như mong đợi.",
    },
    {
      imgSrc: avt5,
      name: "Vũ Minh E",
      role: "Khách hàng",
      text: "Dịch vụ rất tốt, sản phẩm chất lượng xứng đáng với giá tiền. Tôi rất hài lòng!",
    },
  ];

  return (
    <div className="container my-5">
      <div className="row g-5" data-aos="fade-up">
        <div className="col-md-6">
          <h2 className="mb-4">Chúng tôi là ai?</h2>
          <p>
            Chào mừng bạn đến với{" "}
            <strong className="text-primary">CloudlAB!</strong> Chúng tôi chuyên
            cung cấp các sản phẩm điện tử chất lượng cao, bao gồm điện thoại,
            laptop và nhiều thiết bị công nghệ khác. Với mong muốn mang đến trải
            nghiệm mua sắm tiện lợi và đáng tin cậy, chúng tôi cam kết chỉ cung
            cấp những sản phẩm chính hãng với dịch vụ chăm sóc khách hàng tận
            tâm.
          </p>
          <h4 className="mt-4">Tại sao CloudlAB?</h4>
          <ul className="list-unstyled">
            <li className="d-flex align-items-center mb-2">
              <i
                className="bi bi-check-circle me-2"
                style={{ color: "#28a745" }}
              ></i>
              <strong>Đội ngũ chuyên gia</strong> - Được xây dựng từ những người
              đam mê công nghệ.
            </li>
            <li className="d-flex align-items-center mb-2">
              <i
                className="bi bi-check-circle me-2"
                style={{ color: "#28a745" }}
              ></i>
              <strong>Sản phẩm chất lượng</strong> - Chỉ bán các sản phẩm chính
              hãng với bảo hành đầy đủ.
            </li>
            <li className="d-flex align-items-center mb-2">
              <i
                className="bi bi-check-circle me-2"
                style={{ color: "#28a745" }}
              ></i>
              <strong>Dịch vụ khách hàng hoàn hảo</strong> - Cam kết hỗ trợ
              nhanh chóng và tận tâm.
            </li>
          </ul>
          <h4 className="mt-4">Khám phá CloudlAB ngay hôm nay!</h4>
          <p>
            Hãy đến với CloudlAB để tìm kiếm các sản phẩm công nghệ tốt nhất với
            mức giá hợp lý. Chúng tôi luôn sẵn sàng phục vụ bạn!
          </p>
        </div>

        <div className="col-md-6">
          <div className="row image-container">
            <div className="col-12 mb-3 main-image about-images">
              <img alt="Product 1" src={spro1} />
            </div>
            <div className="col-6 mb-3 small-images about-images">
              <img alt="Product 2" src={spro2} />
              <img alt="Product 3" src={spro3} />
            </div>
          </div>
        </div>
      </div>

      <div id="clients" className="clients section">
        <div className="container" data-aos="fade-up">
          <div className="row gy-4 justify-content-center mt-5">
            <div className="col-xl-2 col-md-3 col-6 client-logo">
              <img src={logo1} alt="Client 1" />
            </div>
            <div className="col-xl-2 col-md-3 col-6 client-logo">
              <img src={logo2} alt="Client 2" />
            </div>
            <div className="col-xl-2 col-md-3 col-6 client-logo">
              <img src={logo3} alt="Client 3" />
            </div>
            <div className="col-xl-2 col-md-3 col-6 client-logo">
              <img src={logo5} alt="Client 5" />
            </div>
            <div className="col-xl-2 col-md-3 col-6 client-logo">
              <img src={logo6} alt="Client 6" />
            </div>
            <div className="col-xl-2 col-md-3 col-6 client-logo">
              <img src={logo4} alt="Client 4" />
            </div>
          </div>
        </div>
      </div>

      <div id="services" className="services section light-background mt-5">
        <div className="container section-title" data-aos="fade-up">
          <h2 className="text-center align-items-center">
            Dịch vụ của chúng tôi
          </h2>
        </div>
        <div className="row g-5">
          {cardData.map((card, index) => (
            <div className="col-lg-6" data-aos="fade-up" key={index}>
              <div className="service-item d-flex align-items-center">
                <img
                  src={card.imgSrc}
                  className="service-img"
                  alt={card.title}
                />
                <div className="service-content">
                  <h3>{card.title}</h3>
                  <p>{card.text}</p>
                  <a href="#" className="read-more stretched-link">
                    Learn More <i className="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>

      <div className="container mt-5">
        <div className="container section-title" data-aos="fade-up">
          <h2 className="text-center align-items-center">
            Đánh giá của khách hàng
          </h2>
          <p className="text-center align-items-center">
            Tổng hợp những đánh giá của khách hàng về chúng tôi gần đây
          </p>
        </div>

        <div className="container" data-aos="fade-up">
          <Swiper
            loop={true}
            speed={600}
            autoplay={{ delay: 5000 }}
            slidesPerView="auto"
            pagination={{
              el: ".swiper-pagination",
              type: "bullets",
              clickable: true,
            }}
            breakpoints={{
              320: { slidesPerView: 1, spaceBetween: 40 },
              1200: { slidesPerView: 3, spaceBetween: 1 },
            }}
          >
            {customerRate.map((customerRate, index) => (
              <SwiperSlide key={index}>
                <div className="card customerRate-item d-flex justify-content-center align-items-center p-4">
                  <div className="card-body text-center">
                    <div className="stars mb-2">
                      {Array.from({
                        length: Math.floor(Math.random() * 2) + 4,
                      }).map((_, i) => (
                        <i key={i} className="bi bi-star-fill"></i>
                      ))}
                    </div>
                    <p>{customerRate.text}</p>
                    <div className="profile mt-auto text-center">
                      <img
                        src={customerRate.imgSrc}
                        className="customerRate-img rounded-circle mb-4"
                        alt=""
                      />
                      <h5>{customerRate.name}</h5>
                      <h6>{customerRate.role}</h6>
                    </div>
                  </div>
                </div>
              </SwiperSlide>
            ))}
          </Swiper>
          <div className="swiper-pagination"></div>
        </div>
      </div>

      <div className="row g-5 mt-5">
        <div className="col-md-6 d-flex align-items-center">
          <img alt="Image description" className="w-50 h-50" src={spro1} />
          <img alt="Image description" className="w-75 h-75" src={spro2} />
        </div>
        <div className="col-md-6">
          <h2>dịch vụ của chúng tôi</h2>
          <h1>
            <strong>Cung cấp cho bạn các sản phẩm tốt nhất</strong>
          </h1>
          <p>
            Mỗi sản phẩm đều được kiểm tra kỹ lưỡng để đảm bảo đáp ứng tiêu
            chuẩn cao nhất. Chúng tôi cung cấp nhiều loại sản phẩm, Hợp tác với
            các thương hiệu danh tiếng để đảm bảo bạn nhận được giá trị tốt
            nhất.
          </p>
          từ đồ điện tử đến thời trang, đáp ứng nhu cầu của mọi khách hàng.
          <p>
            Chúng tôi lắng nghe ý kiến của khách hàng để không ngừng cải thiện
            và mang đến sản phẩm phù hợp nhất.
          </p>
        </div>
      </div>
      <div className="card position-relative rounded-pill mt-5 w-100">
        <img className="card-img" src={bt} />
        <div className="card-img-overlay d-flex flex-column justify-content-center align-items-start ps-5">
          <h3>
            <strong>Ở nhà vẫn mua được hàng tốt</strong>
          </h3>
          <p>
            Bắt đầu mua sắp cùng với
            <span className="text-primary fw-bold "> CloudLAB</span>
          </p>
          <div className="input-group d-flex w-50 align-items-center position-relative">
            <input
              className="form-control ps-5 input-email"
              placeholder="Địa chỉ email của bạn"
              type="email"
            />
            <span
              className="position-absolute top-50 translate-middle-y ps-2"
              style={
                {
                  // left: "10px",
                  // color: "#6c757d",
                  // pointerEvents: "none"
                }
              }
            >
              <img
                alt=""
                src={plane}
                style={{ height: "20px", width: "20px" }}
              />
            </span>
            <button className="btn btn-primary btn-register" type="submit">
              Đăng ký
            </button>
          </div>
        </div>
      </div>

      <div className="accordion mt-5" id="accordionExample" data-aos="fade-up">
        <div className="container section-title">
          <h2 className="text-center align-items-center">Faq</h2>
        </div>
        {faqData.map((faq, index) => (
          <div className="accordion-item" key={index}>
            <h2 className="accordion-header">
              <button
                className={`accordion-button ${
                  openIndex !== index ? "collapsed" : ""
                }`}
                type="button"
                onClick={() => handleToggle(index)}
                aria-expanded={openIndex === index ? "true" : "false"}
                aria-controls={`collapse${index}`}
              >
                {faq.question}
              </button>
            </h2>
            <div
              id={`collapse${index}`}
              className={`accordion-collapse collapse ${
                openIndex === index ? "show" : ""
              }`}
              data-bs-parent="#accordionExample"
            >
              <div className="accordion-body">{faq.answer}</div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default About;
