import {
  Home,
  Cart,
  Product,
  Public,
  ProductDetail,
  About,
  Payment,
  Login,
  Signup,
} from "./pages/user";
import { Routes, Route } from "react-router-dom";
import path from "./ultis/path";
function App() {
  return (
    <>
      <Routes>
        <Route path={path.PUBLIC} element={<Public />}>
          <Route path={path.HOME} element={<Home />} />
          <Route path={path.LOGIN} element={<Login />} />
          <Route path={path.SIGNUP} element={<Signup />} />
          <Route path={path.CART} element={<Cart />} />
          <Route path={path.ABOUT} element={<About />} />
          <Route path={path.PRODUCT} element={<Product />}>
            <Route path={path.PRODUCT_DETAIL} element={<ProductDetail />} />
          </Route>
          <Route path={path.PAYMENT} element={<Payment />} />
        </Route>
      </Routes>
    </>
  );
}

export default App;
