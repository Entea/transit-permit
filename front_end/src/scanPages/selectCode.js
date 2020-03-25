import React, { useEffect, useState } from "react";
import {
  Row,
  Container,
  Col,
  Button,
  Form,
  FormGroup,
  Input,
  InputGroup
} from "reactstrap";
// import ReactToPrint from 'react-to-print';
import Header from "../components/header/header";
import { postData } from "./../requests";
import barCode from "./../assets/barCode.png";
import QRCode from "./../assets/QRCode.png";
import Swal from "sweetalert2";
import { Link } from "react-router-dom";
const RegistrationPage = () => {
  const postUserData = e => {
    e.preventDefault();
    let formData = new FormData(e.target),
      data = {};
    formData.forEach((value, key) => {
      data[key] = value;
    });
    console.log(data);
    postData("parcels/update_parcel/", data)
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

          // setTimeout(() => {
          //   window.location.href = `https://postexpress.org/api/v1/parcels/${response.id}/sticker/`;
          // }, 2000);
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
          title: "Повторите посылку",
          showConfirmButton: true,
          confirmButtonColor: "#F7A810"
        });
      });
  };
  return (
    <div className="wrapper">
      <Header />
      <Container className="formRegistrationBlock">
        <Row className={"mt-6 justify-content-center"}>
          <Col className={"mb-5 scanLogin select-form"} sm={12}>
            <Form
              className={"formRegistration justify-content-center p-4"}
              onSubmit={postUserData}
            >
              <FormGroup>
                <p
                  className={"text-center mx-auto contacts-form-title mb-0 h2"}
                >
                  Сканирование штрих кода
                </p>
              </FormGroup>
              <div className={"row mb-4"}>
                <Link to={"/scan/bar-code"} className="selectImg">
                  <img src={barCode} alt="barCodeImg" className={"img-fluid"} />
                </Link>
                <Link to={"/scan/qr-code"} className="selectImg">
                  <img src={QRCode} alt="QRCodeImg" className={"img-fluid"} />
                </Link>
              </div>
              <FormGroup className="text-center">
                <h4 className="product-name mb-3 text-center">
                  Просканировать вручную
                </h4>
                <p className={"mx-auto contacts-form-title mb-0 h5"}>
                  Введите ваш трек номер
                </p>
              </FormGroup>
              <br />
              <InputGroup>
                <Input
                  className={"search-tracking-input scan-select-input"}
                  placeholder="Введите 16-значный код"
                  name="track_code"
                />
                <Button
                  className={"search-tracking-btn scan-tracking-btn"}
                  color="secondary"
                >
                  Сканировать
                </Button>
              </InputGroup>
              {/* <ReactToPrint
                trigger={() => <button>Print this out!</button>}
                content={() => componentRef.current}
              />
              <ComponentToPrint ref={componentRef} /> */}
            </Form>
          </Col>
        </Row>
      </Container>
    </div>
  );
};
export default RegistrationPage;
