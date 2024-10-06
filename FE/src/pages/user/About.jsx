import React from "react";
import "./css/About.css";
import pro1 from "../../assets/images/img1.webp";
import pro2 from "../../assets/images/img2.png";
import pro3 from "../../assets/images/img3.avif";
import spro1 from "../../assets/images/small-img1.jpg";
import spro2 from "../../assets/images/small-img2.jpg";
import spro3 from "../../assets/images/small-img3.jpg";
import plane from "../../assets/images/icon-plane.svg";
import bt from "../../assets/images/img-bt.jpg";
import tc1 from "../../assets/images/icon-1.svg.jpg";
import tc2 from "../../assets/images/icon-2.svg.jpg";
import tc3 from "../../assets/images/icon-3.svg.jpg";
import tc4 from "../../assets/images/icon-4.svg.jpg";
import tc5 from "../../assets/images/icon-5.svg.jpg";
import tc6 from "../../assets/images/icon-6.svg.jpg";
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

  return (
    <div className="container my-5">
      <div className="row g-5">
        <div className="carousel slide col-md-6 " id="carouselExample">
          <div className="carousel-inner rounded-3">
            <div className="carousel-item active">
              <img alt="Product 1" className="w-100" src={pro1} />
            </div>
            <div className="carousel-item">
              <img alt="Product 2" className="w-100" src={pro2} />
            </div>
            <div className="carousel-item">
              <img alt="Product 3" className="w-100" src={pro3} />
            </div>
          </div>
          <button
            className="carousel-control-prev"
            data-bs-slide="prev"
            data-bs-target="#carouselExample"
            type="button"
          >
            <span
              aria-hidden="true"
              className="carousel-control-prev-icon"
              style={{
                backgroundColor: "black",
                borderRadius: "50%",
                padding: "10px",
              }}
            />
            <i className="bi bi-arrow-right-circle-fill" />
            <span className="visually-hidden">Previous</span>
          </button>
          <button
            className="carousel-control-next"
            data-bs-slide="next"
            data-bs-target="#carouselExample"
            type="button"
          >
            <span
              aria-hidden="true"
              className="carousel-control-next-icon"
              style={{
                backgroundColor: "black",
                borderRadius: "50%",
                padding: "10px",
              }}
            />
            <span className="visually-hidden">Next</span>
          </button>
        </div>
        <div className="col-md-6">
          <h2>CloudlAB chào bạn</h2>
          <p>
            Chúng tôi rất vui mừng chào đón bạn đến với CloudlAB, một trang web
            chuyên cung cấp các sản phẩm công nghệ hiện đại và chất lượng. Tại
            CloudlAB, bạn sẽ tìm thấy những thiết bị và phụ kiện công nghệ mới
            nhất, từ điện thoại thông minh, laptop, đến các sản phẩm smart home.
          </p>
          <h4>Tại Sao Chọn CloudlAB?</h4>
          <ul>
            <li>
              <strong>Sản Phẩm Đa Dạng:</strong> Chúng tôi cung cấp nhiều loại
              sản phẩm công nghệ để đáp ứng mọi nhu cầu của bạn.
            </li>
            <li>
              <strong>Giá Cả Cạnh Tranh:</strong> CloudlAB cam kết mang đến cho
              bạn những sản phẩm chất lượng với mức giá hợp lý nhất.
            </li>
            <li>
              <strong>Dịch Vụ Khách Hàng Tận Tâm:</strong> Đội ngũ nhân viên của
              chúng tôi luôn sẵn sàng hỗ trợ bạn trong mọi vấn đề.
            </li>
          </ul>
          <h4>Khám Phá Ngay Hôm Nay!</h4>
          <p>
            Hãy truy cập trang web của chúng tôi để khám phá những sản phẩm
            tuyệt vời và nhận những ưu đãi hấp dẫn. CloudlAB rất hân hạnh được
            phục vụ bạn!
          </p>
          <div className="d-flex">
            <img
              alt="Product 1"
              className="img-thumbnail me-2 w-25"
              src={spro1}
            />
            <img
              alt="Product 2"
              className="img-thumbnail me-2 w-25"
              src={spro2}
            />
            <img alt="Product 3" className="img-thumbnail w-25" src={spro3} />
          </div>
        </div>
      </div>
      <div className="d-flex flex-column align-items-center justify-content-between">
        <h1 className=" m-5">Tiện ích mang tới cho bạn</h1>
        <div className=" d-flex align-items-center justify-content-between flex-wrap">
          {cardData.map((card, index) => (
            <div
              className="d-flex justify-content-center"
              style={{ width: "30%" }}
              key={index}
            >
              <div className="card h-100">
                <div className="d-flex justify-content-center mt-5">
                  <img
                    src={card.imgSrc}
                    className="card-img-top"
                    alt={card.title}
                    style={{ maxHeight: "150px", objectFit: "contain" }}
                  />
                </div>
                <div className="card-body text-center">
                  <h4>
                    <strong>{card.title}</strong>
                  </h4>
                  <p className="card-text">{card.text}</p>
                  <a href="#" className="text-decoration-none">
                    Đọc thêm
                  </a>
                </div>
              </div>
            </div>
          ))}
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
        <img className="card-img " src={bt} />
        <div className="card-img-overlay d-flex flex-column justify-content-center align-items-start ps-5">
          <h3>
            <strong>Ở nhà vẫn mua được hàng tốt</strong>
          </h3>
          <p>
            Bắt đầu mua sắp cùng với
            <span className="ql-color-blue">CloudLAB</span>
          </p>
          <div className="input-group d-flex w-25">
            <span className="input-group-text">
              <img alt="" src={plane} />
            </span>
            <input
              className="form-control p-0 m-0"
              placeholder="Địa chỉ email của bạn"
              type="email"
            />
            <button className="btn btn-primary" type="submit">
              Đăng ký
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default About;
