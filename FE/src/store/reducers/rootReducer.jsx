import { combineReducers } from "redux";
import appReducer from "./appReducer";
import proReducer from "./proReducer";
const rootReducer = combineReducers({
  app: appReducer,
  pro: proReducer,
});
export default rootReducer;
