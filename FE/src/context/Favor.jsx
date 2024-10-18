import { createContext, useEffect, useState } from "react";
import { toast } from "react-toastify";
export const FavorContext = createContext();
export const FavorProvider = ({ children }) => {
  const [favorItems, setFavorItems] = useState(
    localStorage.getItem("favorItems")
      ? JSON.parse(localStorage.getItem("favorItems"))
      : []
  );
  const generateVariantKey = (mainName, variantSku) =>
    `${mainName}:${variantSku}`;
  const addToFavor = (main, variant) => {
    const variantKey = generateVariantKey(main.name, variant.sku);
    const isItemInFavor = favorItems.find(
      (favorItem) => favorItem.variantKey === variantKey
    );
    if (isItemInFavor) {
      const updateFavorItems = favorItems.filter(
        (favorItem) => favorItem.variantKey !== variantKey
      );
      setFavorItems(updateFavorItems);
      toast.warning("Đã xóa khỏi mục yêu thích");
    } else {
      setFavorItems([
        ...favorItems,
        {
          ...variant, // Dữ liệu biến thể
          variantKey, // Key duy nhất cho mỗi sản phẩm biến thể
          main: {
            name: main.name,
            image: main.image,
          },
        },
      ]);
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
