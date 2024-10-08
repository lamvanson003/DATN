import { createRoot } from "react-dom/client";
import { BrowserRouter } from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import "bootstrap-icons/font/bootstrap-icons.css";
import { CartProvider } from "./context/Cart.jsx";
import { FavorProvider } from "./context/Favor.jsx";
import { Provider } from "react-redux";
import App from "./App.jsx";
import store from "./redux.jsx";
import "./index.css";

createRoot(document.getElementById("root")).render(
  <Provider store={store}>
    <BrowserRouter>
      <CartProvider>
        <FavorProvider>
          <App />
        </FavorProvider>
      </CartProvider>
    </BrowserRouter>
  </Provider>
);
