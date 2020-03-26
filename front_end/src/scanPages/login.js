import React, { useEffect, useState } from "react";
import {
  Row,
  Container,
  Col,
  Button,
  Form,
  FormGroup,
  Input
} from "reactstrap";
import ImageBlock from "./../components/images/imageBlock";
import BarCodeImg from "./../assets/login/barCode.png";
import { postDataNoToken } from "./../requests";
import cls from "classnames";
import "./index.css";
const RegistrationPage = () => {
  const [error, setError] = useState(false);

  const postUserData = e => {
    e.preventDefault();
    let formData = new FormData(e.target),
      data = {};
    formData.forEach((value, key) => {
      data[key] = value;
    });
    postDataNoToken("users/login/", data)
      .then(response => {
        console.log(response);
        if (response.token) {
          localStorage.setItem(
            "expressUserData",
            JSON.stringify(response.token)
          );
          setTimeout(() => (window.location.href = `/scan/selectCode/`), 200);
        } else {
          setError(true);
        }
      })
      .catch(() => {
        setError(true);
      });
  };
  return (
    <div className="wrapper">
      <Container className="formRegistrationBlock pt-5">
        <Row className={"mt-6 pt-5 justify-content-center scan-form"}>
          <Col className={"mb-5 scanLogin"} lg={5} sm={12}>
            <Form
              className={"formRegistration justify-content-center p-4"}
              onSubmit={postUserData}
            >
              <FormGroup className="scan-title">
                <p className={"text-center mx-auto contacts-form-title"}>
                  Сканирование штрих кода
                </p>
              </FormGroup>
              <FormGroup className={"w-100"}>
                <Input
                  type={"text"}
                  name="phone"
                  required
                  placeholder="Логин"
                  onChange={() => setError(false)}
                  className={"contacts-form__input mb-2"}
                />
              </FormGroup>{" "}
              <FormGroup className={"w-100"}>
                <Input
                  type={"password"}
                  name="password"
                  required
                  onChange={() => setError(false)}
                  placeholder="Пароль"
                  className={"contacts-form__input mb-2"}
                />
                <p
                  className={cls({
                    errorBlock: !error,
                    errorBlockActive: error
                  })}
                >
                  Неверный логин или пароль, пожалуйста попробуйте еще раз или
                  обратитесь к администратору.
                </p>
              </FormGroup>
              <Button
                className={"w-100 pl-5 pr-5 mt-2 btn contacts-form__button"}
              >
                Войти
              </Button>
            </Form>
          </Col>
          <ImageBlock imgUrl={BarCodeImg} />
          <FormGroup className="title-scan-sm">
            <p className={"text-center mx-auto contacts-form-title"}>
              Сканирование штрих кода
            </p>
          </FormGroup>
        </Row>
      </Container>
    </div>
  );
};
export default RegistrationPage;
