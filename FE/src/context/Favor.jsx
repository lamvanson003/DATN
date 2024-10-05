import { createContext, useEffect, useState } from "react";
import { toast } from "react-toastify";
export const FavorContext = createContext();
export const FavorProvider = ({ children }) => {
  const [favorItems, setFavorItems] = useState(
    localStorage.getItem("favorItems")
      ? JSON.parse(localStorage.getItem("favorItems"))
      : []
  );
  const addToFavor = (item) => {
    const isItemInFavor = favorItems.find(
      (favorItem) => favorItem.id === item.id
    );
    if (isItemInFavor) {
      const updateFavorItems = favorItems.filter(
        (favorItem) => favorItem.id !== item.id
      );
      setFavorItems(updateFavorItems);
      toast.warning("Đã xóa khỏi mục yêu thích");
    } else {
      setFavorItems([...favorItems, item]);
      toast.success("Đã thêm vào mục yêu thích");
    }
  };
  useEffect(() => {
    localStorage.setItem("favorItems", JSON.stringify(favorItems));
  }, [favorItems]);
  useEffect(() => {
    const favorItems = localStorage.getItem("favoritems");
    if (favorItems) {
      setFavorItems(JSON.parse(favorItems));
    }
  }, []);
  return (
    <FavorContext.Provider value={{ favorItems, addToFavor }}>
      {children}
    </FavorContext.Provider>
  );
};
