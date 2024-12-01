import React, { useEffect, useState } from "react";
import "./css/Post.css";
import { postApi } from "../../apis/post";
import { Link } from "react-router-dom";
import { postCategory } from "../../apis/postCategory";
const Post = () => {
  const [postData, setPostData] = useState([]);
  const [postCateData, setPostCateData] = useState([]);
  useEffect(() => {
    const fetchPostData = async () => {
      const res = await postApi.getAll();
      setPostData(res);
    };
    const fetchPostCateData = async () => {
      const res = await postCategory.getAll();
      console.log(res);

      setPostCateData(res);
    };
    fetchPostData();
    fetchPostCateData();
  }, []);
  return (
    <div className="container" style={{ margin: "0 auto", padding: 20 }}>
      <div className="row mt-5">
        <div className="right-content col-xl-9 col-lg-9 col-12">
          {/* <h1 className="title-page">Tin tức</h1> */}
          <div className="list-blogs">
            {postData?.map((item) => (
              <div key={item?.id} className="clearfix">
                <div className="blog-item clearfix">
                  <div className="row">
                    <div className="blog-item-thumbnail col-xl-4 col-lg-4 col-md-4 col-12">
                      <a
                        className="thumb"
                        href="/tablet-nokia-lumia-chua-bao-gio-ra-mat-vua-lo-dien-mot-lan-nua"
                        title={item?.title}
                      >
                        <img
                          src={item?.images}
                          data-src="//bizweb.dktcdn.net/thumb/large/100/037/441/articles/lumiatablet1.jpg?v=1449042941343"
                          alt={item?.title}
                          className="lazyload img-responsive loaded"
                          data-was-processed="true"
                        />
                      </a>
                    </div>
                    <div className="blog-item-info col-xl-7 col-lg-7 col-md-7 col-12">
                      <h3 className="blog-item-name">
                        <Link
                          title={item?.title}
                          to={`/post-detail/${item?.slug}`}
                        >
                          {item?.title}
                        </Link>
                      </h3>
                      <div className="post-time">{item?.posted_at}</div>
                      <p className="blog-item-summary">{item?.content}</p>
                      <Link
                        className="btn btn-more"
                        title="Xem thêm"
                        to={`/post-detail/${item?.slug}`}
                      >
                        Xem thêm
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 256 512"
                        >
                          <path d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"></path>
                        </svg>
                      </Link>
                    </div>
                  </div>
                </div>
              </div>
            ))}

            <div className="text-center"></div>
          </div>
        </div>
        <div className="blog_left_base col-lg-3 col-12">
          <div className="aside-item article-tags">
            <div className="module-header">
              <h2 className="module-title title-style-2">
                <span>Danh Mục</span>
              </h2>
              <div className="module-content">
                <div className="tags-list">
                  {postCateData?.map((item) => (
                    <Link
                      key={item.id}
                      title="kinh nghiệm"
                      className="tag btn-transition"
                    >
                      <span>{item.name}</span>
                    </Link>
                  ))}
                </div>
              </div>
            </div>
          </div>
          <div className="aside-item blog_relate_sidebar">
            <div className="module-header">
              <h2 className="module-title title-style-2">
                <a
                  className="padding-right-55"
                  href="/tin-tuc"
                  title="Tin tức nổi bật"
                >
                  Tin tức nổi bật
                </a>
              </h2>
            </div>
            <div className="module-content">
              <div className="blog-list blog-image-list">
                <div className="swiper_relateblog swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events swiper-container-multirow">
                  <div
                    className="swiper-wrapper"
                    style={{
                      width: 526,
                      transform: "translate3d(0px, 0px, 0px)",
                    }}
                  >
                    <div
                      className="swiper-slide loop-blog clearfix swiper-slide-active"
                      style={{ width: 263 }}
                    >
                      <div className="thumb-left">
                        <a
                          className="thumb"
                          href="/tablet-nokia-lumia-chua-bao-gio-ra-mat-vua-lo-dien-mot-lan-nua"
                          title="Tablet Nokia Lumia vừa mới được lộ diện"
                        >
                          <img
                            src="//bizweb.dktcdn.net/thumb/compact/100/037/441/articles/lumiatablet1.jpg?v=1449042941343"
                            data-src="//bizweb.dktcdn.net/thumb/compact/100/037/441/articles/lumiatablet1.jpg?v=1449042941343"
                            alt="Tablet Nokia Lumia vừa mới được lộ diện"
                            className="lazyload img-responsive loaded"
                            data-was-processed="true"
                          />
                        </a>
                      </div>
                      <div className="name-right">
                        <h3>
                          <a
                            href="/tablet-nokia-lumia-chua-bao-gio-ra-mat-vua-lo-dien-mot-lan-nua"
                            title="Tablet Nokia Lumia vừa mới được lộ diện"
                          >
                            Tablet Nokia Lumia vừa mới được lộ diện
                          </a>
                        </h3>
                        <div className="entry-date">01/12/2015</div>
                      </div>
                    </div>
                    <div
                      className="swiper-slide loop-blog clearfix swiper-slide-next"
                      style={{ width: 263 }}
                    >
                      <div className="thumb-left">
                        <a
                          className="thumb"
                          href="/huawei-sap-tung-smartphone-co-camera-doc-dao-khong-kem-gi-oppo-n3"
                          title="Huawei sắp tung smartphone có camera cực độc"
                        >
                          <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
                            data-src="//bizweb.dktcdn.net/thumb/compact/100/037/441/articles/maxresdefault.jpg?v=1448966334947"
                            alt="Huawei sắp tung smartphone có camera cực độc"
                            className="lazyload img-responsive"
                          />
                        </a>
                      </div>
                      <div className="name-right">
                        <h3>
                          <a
                            href="/huawei-sap-tung-smartphone-co-camera-doc-dao-khong-kem-gi-oppo-n3"
                            title="Huawei sắp tung smartphone có camera cực độc"
                          >
                            Huawei sắp tung smartphone có camera cực độc
                          </a>
                        </h3>
                        <div className="entry-date">01/12/2015</div>
                      </div>
                    </div>
                    <div
                      className="swiper-slide loop-blog clearfix"
                      style={{ marginTop: 0, width: 263 }}
                    >
                      <div className="thumb-left">
                        <a
                          className="thumb"
                          href="/iphone-6c-gia-re-tiep-tuc-xuat-hien"
                          title="iPhone 6c giá rẻ tiếp tục xuất hiện"
                        >
                          <img
                            src="//bizweb.dktcdn.net/thumb/compact/100/037/441/articles/832-img1.jpg?v=1448965983470"
                            data-src="//bizweb.dktcdn.net/thumb/compact/100/037/441/articles/832-img1.jpg?v=1448965983470"
                            alt="iPhone 6c giá rẻ tiếp tục xuất hiện"
                            className="lazyload img-responsive loaded"
                            data-was-processed="true"
                          />
                        </a>
                      </div>
                      <div className="name-right">
                        <h3>
                          <a
                            href="/iphone-6c-gia-re-tiep-tuc-xuat-hien"
                            title="iPhone 6c giá rẻ tiếp tục xuất hiện"
                          >
                            iPhone 6c giá rẻ tiếp tục xuất hiện
                          </a>
                        </h3>
                        <div className="entry-date">01/12/2015</div>
                      </div>
                    </div>
                    <div
                      className="swiper-slide loop-blog clearfix"
                      style={{ marginTop: 0, width: 263 }}
                    >
                      <div className="thumb-left">
                        <a
                          className="thumb"
                          href="/co-nen-thao-cu-sac-thiet-bi-di-dong-ra-khoi-o-dien-khi-khong-dung"
                          title="Có nên tháo củ sạc ra khỏi ổ điện khi không dùng?"
                        >
                          <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
                            data-src="//bizweb.dktcdn.net/thumb/compact/100/037/441/articles/adapter.jpg?v=1448965577950"
                            alt="Có nên tháo củ sạc ra khỏi ổ điện khi không dùng?"
                            className="lazyload img-responsive"
                          />
                        </a>
                      </div>
                      <div className="name-right">
                        <h3>
                          <a
                            href="/co-nen-thao-cu-sac-thiet-bi-di-dong-ra-khoi-o-dien-khi-khong-dung"
                            title="Có nên tháo củ sạc ra khỏi ổ điện khi không dùng?"
                          >
                            Có nên tháo củ sạc ra khỏi ổ...
                          </a>
                        </h3>
                        <div className="entry-date">01/12/2015</div>
                      </div>
                    </div>
                    <div
                      className="swiper-slide loop-blog clearfix"
                      style={{ marginTop: 0, width: 263 }}
                    >
                      <div className="thumb-left">
                        <a
                          className="thumb"
                          href="/bai-viet-mau"
                          title="Kinh nghiệm chọn mua laptop bạn cần lưu ý"
                        >
                          <img
                            src="//bizweb.dktcdn.net/thumb/compact/100/037/441/articles/laptop-mistakes.jpg?v=1448965209083"
                            data-src="//bizweb.dktcdn.net/thumb/compact/100/037/441/articles/laptop-mistakes.jpg?v=1448965209083"
                            alt="Kinh nghiệm chọn mua laptop bạn cần lưu ý"
                            className="lazyload img-responsive loaded"
                            data-was-processed="true"
                          />
                        </a>
                      </div>
                      <div className="name-right">
                        <h3>
                          <a
                            href="/bai-viet-mau"
                            title="Kinh nghiệm chọn mua laptop bạn cần lưu ý"
                          >
                            Kinh nghiệm chọn mua laptop bạn cần lưu...
                          </a>
                        </h3>
                        <div className="entry-date">30/11/2015</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="swiper-button-prev prev_relate swiper-button-disabled" />
                <div className="swiper-button-next next_relate" />
              </div>
            </div>
          </div>
          <div className="aside-item blog-banner d-md-none d-block d-sm-block d-lg-block d-xl-block">
            <div className="module-header">
              <h2 className="module-title title-style-2">
                <span>Quảng cáo</span>
              </h2>
            </div>
            <div className="module-content">
              <a href="#" title="Quảng cáo">
                <img
                  className="imageload lazyload loaded"
                  src="//bizweb.dktcdn.net/100/037/441/themes/880432/assets/blog_aside_banner.jpg?1698047656269"
                  data-src="//bizweb.dktcdn.net/100/037/441/themes/880432/assets/blog_aside_banner.jpg?1698047656269"
                  alt="quang-cao"
                  data-was-processed="true"
                />
              </a>
            </div>
          </div>
          <div className="aside-item aside-rte">
            <div className="module-header">
              <h2 className="module-title title-style-2">
                <span>Kính chào</span>
              </h2>
            </div>
            <div className="module-content">
              <div className="rte-content">
                Chào mừng quý khách tới với cửa hàng của chúng tôi. Hãy liên hệ
                theo địa chỉ cửa hàng ở bên để có thể được tư vấn và chăm sóc
                một cách tốt nhất. Xin cảm ơn.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Post;
