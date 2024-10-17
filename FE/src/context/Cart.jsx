import React from "react";
import { createContext, useState, useEffect } from "react";
export const CartContext = createContext();
import { toast } from "react-toastify";
import { useNavigate } from "react-router-dom";
export const CartProvider = ({ children }) => {
  const navigate = useNavigate();

  const [cartItems, setCartItems] = useState(
    localStorage.getItem("cartItems")
      ? JSON.parse(localStorage.getItem("cartItems"))
      : []
  );
  const addToCart = (item) => {
    const isItemInCart = cartItems.find((cartItem) => cartItem.id === item.id);
    if (isItemInCart) {
      setCartItems(
        cartItems.map((cartItem) =>
          cartItem.id === item.id
            ? { ...cartItem, quantity: cartItem.quantity + 1 }
            : cartItem
        )
      );
    } else {
      setCartItems([...cartItems, { ...item, quantity: 1 }]);
      toast.success("Đã thêm sản phẩm vào giỏ hàng!");
    }
  };
  const removeFromCart = (item) => {
    const isItemInCart = cartItems.find((cartItem) => cartItem.id === item.id);
    if (isItemInCart) {
      if (isItemInCart.quantity === 1) {
        setCartItems(cartItems.filter((cartItem) => cartItem.id !== item.id));
      } else {
        setCartItems(
          cartItems.map((cartItem) =>
            cartItem.id === item.id
              ? { ...cartItem, quantity: cartItem.quantity - 1 }
              : cartItem
          )
        );
      }
    }
  };
  const clearCart = () => {
    setCartItems([]);
  };
  const getCartTotal = () => {
    return cartItems.reduce(
      (total, cartItem) => total + cartItem.sale * cartItem.quantity,
      0
    );
  };
  const buyNow = (item) => {
    setCartItems([{ ...item, quantity: 1 }]);
    navigate("/payment");
  };
  useEffect(() => {
    localStorage.setItem("cartItems", JSON.stringify(cartItems));
  }, [cartItems]);
  useEffect(() => {
    const cartItems = localStorage.getItem("cartItems");
    if (cartItems) {
      setCartItems(JSON.parse(cartItems));
    }
  }, []);
  return (
    <CartContext.Provider
      value={{
        cartItems,
        addToCart,
        removeFromCart,
        clearCart,
        getCartTotal,
        buyNow,
      }}
    >
      {children}
    </CartContext.Provider>
  );
};
