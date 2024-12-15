import React, { useEffect, useState } from "react";
import camera from "../assets/images/iHome/camera.png";
import clock from "../assets/images/iHome/hwclock.png";
import ssphone from "../assets/images/iHome/samsungphone.png";
import hwphone from "../assets/images/iHome/hwphone.png";
import { postApi } from "../apis/post";
import { Link, useNavigate } from "react-router-dom";
const News = () => {
  const navigate = useNavigate();
  const [post, setPost] = useState([]);
  const handleViewAll = () => {
    navigate("/post");
  };
  useEffect(() => {
    const fetchData = async () => {
      const res = await postApi.getAll();
      console.log(res);
      setPost(res);
    };
    fetchData();
  }, []);

  return (
    <div className="d-flex justify-content-center mt-3">
      <div className="container news-section">
        <div className="d-flex justify-content-between align-items-center mb-3">
          <div className="news-title">TIN CÔNG NGHỆ</div>
          <div className="view-all">
            <span style={{ cursor: "pointer" }} onClick={handleViewAll}>
              Xem tất cả
            </span>
          </div>
        </div>
        <div className="d-flex justify-content-between">
          {post &&
            post
              .filter((_, index) => index < 4)
              .map((item) => (
                <div key={item.id} className="card">
                  <Link title={item?.title} to={`/post-detail/${item?.slug}`}>
                    <img
                      alt="DJI Osmo Action 5 Pro camera"
                      className="card-img-top"
                      height={150}
                      src={item.images}
                      width={230}
                    />
                  </Link>

                  <div className="card-body">
                    <a href="#" className="card-title">
                      <Link
                        title={item?.title}
                        to={`/post-detail/${item?.slug}`}
                      >
                        {item?.title}
                      </Link>
                    </a>
                  </div>
                </div>
              ))}
        </div>
      </div>
    </div>
  );
};

export default News;
