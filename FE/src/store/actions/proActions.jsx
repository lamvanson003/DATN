import axios from "axios";
import { actionTypes } from "./actionTypes";
import { productApi } from "../../apis/product";
export const getProductAll = () => async (dispatch) => {
  try {
    const resPhone = await productApi.getAllphone();
    const resLaptop = await productApi.getAlllaptop();

    // Khởi tạo object chứa dữ liệu từ cả 2 API
    const productsData = {
      phone: resPhone ? resPhone.data.data : [],
      laptop: resLaptop ? resLaptop.data.data : [],
    };

    // Dispatch object productsData với dữ liệu đã gộp
    dispatch({
      type: actionTypes.PRODUCTS,
      productsData: productsData,
    });
  } catch (err) {
    dispatch({
      type: actionTypes.PRODUCTS,
      productsData: null,
    });
    console.log("Lỗi khi fetch dữ liệu:", err);
  }
};
