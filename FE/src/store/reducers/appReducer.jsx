import { actionTypes } from "../actions/actionTypes";
const initialState = {
  isLoading: false,
  isLogin: false,
};
const appReducer = (state = initialState, action) => {
  switch (action.type) {
    case actionTypes.LOADING:
      return {
        ...state,
        isLoading: action.flag,
      };
    default: {
      return state;
    }
  }
};
export default appReducer;
