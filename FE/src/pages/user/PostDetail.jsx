import { useParams } from "react-router-dom";
import "./css/Post.css";
import { useEffect, useState } from "react";
import { postApi } from "../../apis/post";
import icons from "../../ultis/icon";
const PostDetail = () => {
  const { FaRegCalendar, FaRegUser } = icons;
  const { slug } = useParams();
  const [postDetail, setPostDetail] = useState([]);
  useEffect(() => {
    const fetchDetailData = async () => {
      const res = await postApi.getOne(slug);
      console.log(res);

      setPostDetail(res);
    };
    fetchDetailData();
  }, []);
  return (
    <div className="container mt-5">
      <div className="row">
        <div className="right-content col-xl-9 col-lg-9 col-12">
          <h1 className="title-page">{postDetail[0]?.title}</h1>
          <div className="article-info">
            <span className="info-item">
              <FaRegCalendar />
              <span>Ngày đăng: {postDetail[0]?.posted_at}</span>
            </span>
            <span className="info-item">
              <FaRegUser />
              <span>Tác giả: {postDetail[0]?.user.fullname}</span>
            </span>
          </div>
          {/* <div className="col-xs-12 text-left">
            <ul className="breadcrumb gap-2">
              <li className="home">
                <a href="/">
                  <span>Trang chủ</span>
                </a>
                <span className="br-line">|</span>
              </li>
              <li>
                <a href="/tin-tuc">
                  <span>Tin tức</span>
                </a>
                <span className="br-line">|</span>
              </li>
              <li>
                <strong>
                  <span>10 bí quyết giúp uống rượu để bảo vệ sức khỏe</span>
                </strong>
              </li>
            </ul>
          </div> */}
          <div className="article-wrapper">
            <div className="article-image-container ">
              <img
                src={postDetail[0]?.images}
                alt={postDetail[0]?.title}
                className="article-image"
              />
            </div>
            <div className="text-container">
              <p className="article-text">{postDetail[0]?.content}</p>
            </div>
          </div>

          <div id="article-comments">
            <h5 className="title-form-comment">Bình luận</h5>
            <p className="comment-count">3 bình luận</p>
            <div className="article-comment clearfix">
              <figure className="article-comment-user-image">
                <img
                  src="https://www.gravatar.com/avatar/5e846153274934d3791132dfebc8c10b?s=110&d=identicon"
                  alt="binh-luan"
                />
              </figure>
              <div className="article-comment-user-comment">
                <p className="user-name-comment">
                  <strong>aaa</strong>
                  <span className="article-comment-date">12/08/2024</span>
                </p>
                <p className="comment-text">tốt</p>
              </div>
            </div>
            <div className="article-comment clearfix">
              <figure className="article-comment-user-image">
                <img
                  src="https://www.gravatar.com/avatar/68f5f844896ee7a4626da5678045ec26?s=110&d=identicon"
                  alt="binh-luan"
                />
              </figure>
              <div className="article-comment-user-comment">
                <p className="user-name-comment">
                  <strong>aaaa</strong>
                  <span className="article-comment-date">12/05/2019</span>
                </p>
                <p className="comment-text">comment</p>
              </div>
            </div>
            <div className="article-comment clearfix">
              <figure className="article-comment-user-image">
                <img
                  src="https://www.gravatar.com/avatar/d04b6934ae002f591c1be910c9b12d29?s=110&d=identicon"
                  alt="binh-luan"
                />
              </figure>
              <div className="article-comment-user-comment">
                <p className="user-name-comment">
                  <strong>Nguyễn Trần Diễm Thị Trà My</strong>
                  <span className="article-comment-date">09/03/2017</span>
                </p>
                <p className="comment-text">comment</p>
              </div>
            </div>
          </div>
          <div className="comment mt-4">
            <div className="col-lg-12">
              <div className="form-comment">
                <h5 className="title-form-comment">Viết bình luận của bạn:</h5>
                <form action="#" method="POST">
                  <div className="row">
                    {/* Họ và tên */}
                    <div className="col-md-6 col-12">
                      <div className="form-group">
                        <label htmlFor="fullname" className="control-label">
                          Họ và tên <span className="text-danger">*</span>:
                        </label>
                        <input
                          type="text"
                          id="fullname"
                          className="form-control"
                          name="fullname"
                          placeholder="Nhập họ và tên"
                          required=""
                        />
                      </div>
                    </div>

                    <div className="col-md-6 col-12">
                      <div className="form-group">
                        <label htmlFor="email" className="control-label">
                          Email <span className="text-danger">*</span>:
                        </label>
                        <input
                          type="email"
                          id="email"
                          className="form-control"
                          name="email"
                          placeholder="Nhập email"
                          required=""
                        />
                      </div>
                    </div>
                  </div>

                  <div className="form-group">
                    <label htmlFor="message" className="control-label">
                      Nội dung:
                    </label>
                    <textarea
                      id="message"
                      className="form-control"
                      name="message"
                      rows={5}
                      placeholder="Nhập nội dung bình luận của bạn"
                      defaultValue={""}
                    />
                  </div>
                  {/* Nút gửi */}
                  <div className="form-group text-right">
                    <button type="submit" className="btn btn-primary">
                      Gửi bình luận
                    </button>
                  </div>
                </form>
              </div>
            </div>
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
                  <a
                    href="/blogs/all/tagged/kinh-nghiem"
                    title="kinh nghiệm"
                    className="tag btn-transition"
                  >
                    <span>kinh nghiệm</span>
                  </a>
                  <a
                    href="/blogs/all/tagged/laptop"
                    title="laptop"
                    className="tag btn-transition"
                  >
                    <span>laptop</span>
                  </a>
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

export default PostDetail;
