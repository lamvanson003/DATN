import { actionTypes } from "../actions/actionTypes";
const initialState = {
  isLoading: false,
};
const appReducer = (state = initialState, action) => {
  console.log("Received action:", action); // Log action nhận được
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
