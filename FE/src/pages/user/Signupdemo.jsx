import React from "react";
import login from "../../assets/images/log.svg";
const Signup = () => {
  return (
    <div className="container">
      <section>
        <div className="container py-5 ">
          <div className="row d-flex align-items-center justify-content-center ">
            <div className="col-md-8 col-lg-7 col-xl-6">
              <img alt="Phone image" className="img" src={login} />
            </div>
            <div className="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
              <form className="mx-1 mx-md-4">
                <div className="d-flex flex-row align-items-center mb-4">
                  <i className="fas fa-user fa-lg me-3 fa-fw" />
                  <div
                    className="form-outline flex-fill mb-0"
                    data-mdb-input-init=""
                  >
                    <label className="form-label" htmlFor="form3Example1c">
                      Your Name
                    </label>
                    <input
                      className="form-control"
                      id="form3Example1c"
                      type="text"
                    />
                  </div>
                </div>
                <div className="d-flex flex-row align-items-center mb-4">
                  <i className="fas fa-envelope fa-lg me-3 fa-fw" />
                  <div
                    className="form-outline flex-fill mb-0"
                    data-mdb-input-init=""
                  >
                    <label className="form-label" htmlFor="form3Example3c">
                      Your Email
                    </label>
                    <input
                      className="form-control"
                      id="form3Example3c"
                      type="email"
                    />
                  </div>
                </div>
                <div className="d-flex flex-row align-items-center mb-4">
                  <i className="fas fa-lock fa-lg me-3 fa-fw" />
                  <div
                    className="form-outline flex-fill mb-0"
                    data-mdb-input-init=""
                  >
                    <label className="form-label" htmlFor="form3Example4c">
                      Password
                    </label>
                    <input
                      className="form-control"
                      id="form3Example4c"
                      type="password"
                    />
                  </div>
                </div>
                <div className="d-flex flex-row align-items-center mb-4">
                  <i className="fas fa-key fa-lg me-3 fa-fw" />
                  <div
                    className="form-outline flex-fill mb-0"
                    data-mdb-input-init=""
                  >
                    <label className="form-label" htmlFor="form3Example4cd">
                      Repeat your password
                    </label>
                    <input
                      className="form-control"
                      id="form3Example4cd"
                      type="password"
                    />
                  </div>
                </div>
                <div className="form-check d-flex justify-content-center mb-5">
                  <input
                    className="form-check-input me-2"
                    defaultValue=""
                    id="form2Example3c"
                    type="checkbox"
                  />
                  <label className="form-check-label" htmlFor="form2Example3">
                    I agree all statements in <a href="#!">Terms of service</a>
                  </label>
                </div>
                <div className="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                  <button
                    className="btn btn-primary btn-lg"
                    data-mdb-button-init=""
                    data-mdb-ripple-init=""
                    type="button"
                  >
                    Register
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Signup;
