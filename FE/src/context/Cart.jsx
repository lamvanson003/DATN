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
  const generateVariantKey = (mainName, variantSku) =>
    `${mainName}:${variantSku}`;
  const addToCart = (main, variant) => {
    const variantKey = generateVariantKey(main.name, variant.sku);
    const isItemInCart = cartItems.find(
      (cartItem) => cartItem.variantKey === variantKey
    );
    if (isItemInCart) {
      setCartItems(
        cartItems.map((cartItem) =>
          cartItem.variantKey === variantKey
            ? { ...cartItem, quantity: cartItem.quantity + 1 }
            : cartItem
        )
      );
    } else {
      setCartItems([
        ...cartItems,
        {
          ...variant, // Dữ liệu biến thể
          quantity: 1, // Số lượng khởi tạo
          variantKey, // Key duy nhất cho mỗi sản phẩm biến thể
          main: {
            name: main.name,
            image: main.image,
          },
        },
      ]);
      toast.success("Đã thêm sản phẩm mới vào giỏ hàng!");
    }
  };
  const removeFromCart = (main, variant) => {
    const variantKey = generateVariantKey(main.name, variant.sku);
    const isItemInCart = cartItems.find(
      (cartItem) => cartItem.variantKey === variantKey
    );
    if (isItemInCart) {
      if (isItemInCart.quantity === 1) {
        setCartItems(
          cartItems.filter((cartItem) => cartItem.variantKey !== variantKey)
        );
      } else {
        setCartItems(
          cartItems.map((cartItem) =>
            cartItem.variantKey === variantKey
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
