import React, { useState } from "react";
import QrReader from "react-qr-reader";

import { Container, Col, Row, Button } from "reactstrap";
// import { postData } from "./../requests";
// import Swal from "sweetalert2";
import hiddenScanImg from "./../assets/hiddenScan.png";
import Title from "./../components/titleBlock/titleBlock";
import "./index.css";
const QRCode = () => {
  const [result, setResult] = useState("");
  const [hidden, setHiddenScan] = useState(false);
  const Scan = data => {
    if (data) {
      setResult(data);
    }
  };

  // const postUserData = () => {
  //   postData("parcels/update_parcel/", { track_code: result })
  //     .then(response => {
  //       console.log(response);
  //       if (response.id) {
  //         Swal.fire({
  //           icon: "success",
  //           title: "Товар получен на складе!",
  //           timer: 2000,
  //           showConfirmButton: true,
  //           confirmButtonColor: "#F7A810"
  //         });

  //         setTimeout(() => {
  //           window.location.href = `https://postexpress.org/api/v1/parcels/${response.id}/sticker/`;
  //         }, 2000);
  //       } else {
  //         Swal.fire({
  //           icon: "error",
  //           title: response.error,
  //           showConfirmButton: true,
  //           confirmButtonColor: "#F7A810"
  //         });
  //       }
  //     })
  //     .catch(() => {
  //       Swal.fire({
  //         icon: "error",
  //         title: "Повторите попытку",
  //         showConfirmButton: true,
  //         confirmButtonColor: "#F7A810"
  //       });
  //     });
  // };

  return (
    <div className="wrapper">
      <Container>
        <Row>
          <Col className={"p-4 scanPage"}>
            <Title subTitle="Сканирование QR-кода" />
            <Container>
              <div className="row mb-5 mt-5">
                <div className="scanCode pr-5">
                  {hidden ? (
                    <QrReader
                      delay={300}
                      onError={e => console.log(e)}
                      onScan={Scan}
                      // facingMode="user"
                      // showViewFinder={false}
                      // constraints={true}
                    />
                  ) : (
                    <img
                      src={hiddenScanImg}
                      className="scanCode img-fluid mr-5"
                      alt="hidden Img"
                      onClick={() => setHiddenScan(!hidden)}
                    />
                  )}
                </div>

                <div className="scanResult">
                  <span>Формат: QR-код </span>
                  <span className="mb-3">Ссылка: {result}</span>
                  <Button
                    className={
                      "w-100 pl-5 pr-5  btn contacts-form__button scanBtn"
                    }
                    onClick={() => (window.location.href = `${result}`)}
                  >
                    Перейти
                  </Button>
                </div>
              </div>
            </Container>
          </Col>
        </Row>
      </Container>
    </div>
  );
};

export default QRCode;
