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
  const addToCart = (main, variant, quantity = 0, inStock = 100) => {
    const variantKey = generateVariantKey(main.name, variant.color.sku);
    const isItemInCart = cartItems.find(
      (cartItem) => cartItem.variantKey === variantKey
    );

    const numericQuantity = Number(quantity) > 0 ? Number(quantity) : 1;
    if (inStock > numericQuantity) {
      if (isItemInCart) {
        setCartItems(
          cartItems.map((cartItem) =>
            cartItem.variantKey === variantKey
              ? {
                  ...cartItem,
                  quantity: cartItem.quantity + numericQuantity,
                }
              : cartItem
          )
        );
      } else {
        setCartItems([
          ...cartItems,
          {
            ...variant,
            quantity: numericQuantity,
            variantKey,
            main: {
              id: main.id,
              name: main.name,
              image: main.image,
            },
          },
        ]);
        toast.success("Đã thêm sản phẩm mới vào giỏ hàng!");
      }
      inStock -= numericQuantity;
    } else {
      console.log(inStock);
      toast.warning("Đã hết mặt hàng!");
    }
  };

  const removeFromCart = (main, variant) => {
    const variantKey = generateVariantKey(main.name, variant.color.sku);
    const isItemInCart = cartItems.find(
      (cartItem) => cartItem.variantKey === variantKey
    );
    if (isItemInCart) {
      if (isItemInCart.quantity === 1) {
        const confirmDelete = window.confirm(
          "Sản phẩm sẽ bị xóa khỏi giỏ hàng, bạn chắc chắc chứ ?"
        );
        if (confirmDelete) {
          setCartItems(
            cartItems.filter((cartItem) => cartItem.variantKey !== variantKey)
          );
        }
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
  const removeOneProductOfCart = (main, variant) => {
    const variantKey = generateVariantKey(main.name, variant.color.sku);
    const confirmDelete = window.confirm(
      "Sản phẩm sẽ bị xóa khỏi giỏ hàng, bạn chắc chắc chứ ?"
    );
    if (confirmDelete) {
      setCartItems(
        cartItems.filter((cartItem) => cartItem.variantKey !== variantKey)
      );
    }
  };
  const clearCart = () => {
    setCartItems([]);
  };
  const getCartTotal = () => {
    return cartItems.reduce(
      (total, cartItem) =>
        total +
        (cartItem.color.sale ? cartItem.color.sale : cartItem.color.price) *
          cartItem.quantity,
      0
    );
  };
  const buyNow = (main, variant, quantity) => {
    const variantKey = generateVariantKey(main.name, variant.color.sku);
    const buyNowItem = [
      {
        ...variant,
        quantity: quantity ? quantity : 1,
        variantKey,
        main: {
          id: main.id,
          name: main.name,
          image: main.image,
        },
      },
    ];

    localStorage.removeItem("buyNowItem");
    localStorage.setItem("buyNowItem", JSON.stringify(buyNowItem));
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
        removeOneProductOfCart,
      }}
    >
      {children}
    </CartContext.Provider>
  );
};
