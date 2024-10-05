import {
  Home,
  Cart,
  Product,
  Public,
  Detail,
  About,
  Payment,
  Login,
  Signup,
} from "./pages/user";
import { Routes, Route } from "react-router-dom";
import { Bounce, ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import path from "./ultis/path";
function App() {
  return (
    <>
      <div className="App">
        <Routes>
          <Route path={path.PUBLIC} element={<Public />}>
            <Route path={path.HOME} element={<Home />} />
            <Route path={path.LOGIN} element={<Login />} />
            <Route path={path.SIGNUP} element={<Signup />} />
            <Route path={path.CART} element={<Cart />} />
            <Route path={path.ABOUT} element={<About />} />
            <Route path={path.PRODUCT} element={<Product />}></Route>
            <Route path={path.PRODUCT__DETAIL__ID} element={<Detail />} />
            <Route path={path.PAYMENT} element={<Payment />} />
          </Route>
        </Routes>
      </div>
      <ToastContainer
        position="top-right"
        autoClose={5000}
        hideProgressBar={false}
        newestOnTop={false}
        closeOnClick
        rtl={false}
        pauseOnFocusLoss
        draggable
        pauseOnHover
        theme="light"
        transition={Bounce}
      />
    </>
  );
}

export default App;
