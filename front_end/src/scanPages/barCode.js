import React, { useState, useEffect } from "react";
import { BrowserBarcodeReader } from "@zxing/library";
import Header from "../components/header/header";
import Title from "../components/title/title";
import { Container, Col, Row, Button } from "reactstrap";
import { postData } from "./../requests";
import Swal from "sweetalert2";
import hiddenScanImg from "./../assets/hiddenScan.png";
const QRCode = () => {
  const [result, setResult] = useState("");
  const [hidden, setHiddenScan] = useState(false);
  const Scan = async () => {
    const codeReader = new BrowserBarcodeReader();
    const result = await codeReader.listVideoInputDevices();
    console.log(result);
    let firstDeviceId;
    if (result.length > 1) {
      firstDeviceId = result[1].deviceId;
    } else {
      firstDeviceId = result[0].deviceId;
    }

    codeReader
      .decodeOnceFromVideoDevice(firstDeviceId, "video")
      .then(result => setResult(result.text))
      .catch(err => console.error(err));
  };

  console.log(result);

  const postUserData = () => {
    postData("parcels/update_parcel/", { track_code: result })
      .then(response => {
        console.log(response);
        if (response.id) {
          Swal.fire({
            icon: "success",
            title: "Товар получен на складе!",
            timer: 2000,
            showConfirmButton: true,
            confirmButtonColor: "#F7A810"
          });
          setTimeout(() => {
            window.location.href = `https://postexpress.org/api/v1/parcels/${response.id}/sticker/`;
          }, 2000);
        } else {
          Swal.fire({
            icon: "error",
            title: response.error,
            showConfirmButton: true,
            confirmButtonColor: "#F7A810"
          });
        }
      })
      .catch(() => {
        Swal.fire({
          icon: "error",
          title: "Повторите попытку",
          showConfirmButton: true,
          confirmButtonColor: "#F7A810"
        });
      });
  };

  return (
    <div className="wrapper">
      <Header />
      <Container>
        <Row>
          <Col className={"p-4 scanPage"}>
            <Title letterStyle="yellowLetter" title="Сканирование bar-кода" />
            <Container>
              <div className="row mb-5">
                <div className="scanCode pr-5">
                  {hidden ? (
                    <video id="video" className="barScan"></video>
                  ) : (
                    <img
                      src={hiddenScanImg}
                      className="scanCode img-fluid mr-5"
                      onClick={() => {
                        setHiddenScan(!hidden);
                        Scan();
                      }}
                    />
                  )}
                </div>

                <div className="scanResult">
                  <span>Формат: BarCode-код </span>
                  <span className="mb-3">Трек код: {result}</span>

                  <Button
                    className={
                      "w-100 pl-5 pr-5  btn contacts-form__button scanBtn"
                    }
                    onClick={() => {
                      Scan();
                      setResult("");
                    }}
                  >
                    Еще сканировать
                  </Button>
                  <Button
                    className={
                      "w-100 pl-5 pr-5  btn contacts-form__button mt-3"
                    }
                    onClick={() => postUserData()}
                  >
                    Отправить
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
