import { actionTypes } from "../actions/actionTypes";
const initialState = {
  productsData: null,
};

const proReducer = (state = initialState, action) => {
  switch (action.type) {
    case actionTypes.PRODUCTS:
      return {
        ...state,
        productsData: action.productsData,
      };
    default: {
      return state;
    }
  }
};
export default proReducer;
