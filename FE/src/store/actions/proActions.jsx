import axios from "axios";
import { actionTypes } from "./actionTypes";
import { productApi } from "../../apis/product";
export const getProductAll = () => async (dispatch) => {
  try {
    const response = await productApi.getAll();
    if (response) {
      dispatch({
        type: actionTypes.PRODUCTS,
        productsData: response.data.data,
      });
    } else {
      dispatch({
        type: actionTypes.PRODUCTS,
        productsData: null,
      });
      console.log("ko có sản phẩm");
    }
  } catch (err) {
    dispatch({
      type: actionTypes.PRODUCTS,
      productsData: null,
    });
    console.log("Lỗi khi fetch dữ liệu");
  }
};
