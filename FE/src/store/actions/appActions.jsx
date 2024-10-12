import { actionTypes } from "./actionTypes";
export const loading = (flag) => ({
  type: actionTypes.LOADING,
  flag,
});
