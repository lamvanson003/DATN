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
  History,
  Profile,
  Favor,
  User,
  Account,
  BankingOnline,
  Contact,
} from "./pages/user";
import { Routes, Route } from "react-router-dom";
import { Bounce, ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import { useDispatch } from "react-redux";
import path from "./ultis/path";
import * as actions from "./store/actions";
import { useEffect } from "react";
function App() {
  const dispatch = useDispatch();
  useEffect(() => {
    dispatch(actions.getProductAll());
  }, []);
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
            <Route path={path.CONTACT} element={<Contact />} />
            <Route path={path.PRODUCT} element={<Product />}></Route>
            <Route path={path.PRODUCT__DETAIL__SLUG} element={<Detail />} />
            <Route path={path.USER} element={<User />}>
              <Route path={path.ACCOUNT} element={<Account />}>
                <Route path={path.PROFILE} element={<Profile />} />
              </Route>
              <Route path={path.HISTORY} element={<History />} />
            </Route>
            <Route path={path.PAYMENT} element={<Payment />} />
            <Route path={path.BANKINGONLINE} element={<BankingOnline />} />
            <Route path={path.FAVOR} element={<Favor />} />
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
