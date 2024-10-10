import React from "react";
import { Oval } from "react-loader-spinner";
import { memo } from "react";
const Loading = () => {
  return (
    <div>
      <Oval
        visible={true}
        height="80"
        width="80"
        color="#4fa94d"
        ariaLabel="oval-loading"
        wrapperStyle={{}}
        wrapperClass=""
      />
    </div>
  );
};

export default memo(Loading);
