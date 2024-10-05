import { createRoot } from "react-dom/client";
import { BrowserRouter } from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import "bootstrap-icons/font/bootstrap-icons.css";
import { CartProvider } from "./context/Cart.jsx";
import { FavorProvider } from "./context/Favor.jsx";
import App from "./App.jsx";
import "./index.css";

createRoot(document.getElementById("root")).render(
  <BrowserRouter>
    <CartProvider>
      <FavorProvider>
        <App />
      </FavorProvider>
    </CartProvider>
  </BrowserRouter>
);
