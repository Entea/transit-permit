import React from "react";
import "./titleBlock.css";

const TitleBlock = ({ title = "Маршрутный лист", subTitle }) => {
  return (
    <div className="titleBlock">
      <h4>{title}</h4>
      <span>{subTitle}</span>
    </div>
  );
};
export default TitleBlock;
