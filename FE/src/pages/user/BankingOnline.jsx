import React from "react";

const BankingOnline = () => {
  return (
    <div>
      <img
        src={`https://qr.sepay.vn/img?bank=MBBank&acc=0903252427&template=compact&amount=${parseInt(
          1000000
        )}&des=DH${1}`}
        style={{ height: 500 }}
      />
    </div>
  );
};

export default BankingOnline;
