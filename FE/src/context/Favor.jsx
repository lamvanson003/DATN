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
    const variantKey = generateVariantKey(main.name, variant.color.sku);
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
      const matchedStorage = main.product_variant.find(
        (p_variant) => p_variant.storage === variant.storage
      );
      if (matchedStorage) {
        const newFavorItem = {
          ...main,
          product_variant: [
            {
              storage: matchedStorage.storage,
              variants: [
                matchedStorage.variants.find(
                  (v) => v.sku === variant.color.sku
                ),
              ].filter(Boolean),
            },
          ],
          variantKey: variantKey,
        };
        setFavorItems([...favorItems, newFavorItem]);
        toast.success("Đã thêm vào mục yêu thích");
      } else {
        console.log("Ko tìm thấy storage");
      }
    }
  };
  const clearFavor = () => {
    setFavorItems([]);
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
    <FavorContext.Provider value={{ favorItems, addToFavor, clearFavor }}>
      {children}
    </FavorContext.Provider>
  );
};
