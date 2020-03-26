import React, { useState } from "react";
import {
  Container,
  Col,
  Form,
  Input,
  Button,
  FormGroup,
  Label
} from "reactstrap";
import Title from "../../components/titleBlock/titleBlock.js";
import PhoneInput from "react-phone-input-2";
import "react-phone-input-2/lib/style.css";
import ru from "react-phone-input-2/lang/ru.json";
// import { Link } from "react-router-dom";
import "./main.css";

const MainPage = () => {
  const [phoneNumber, setPhoneNumber] = useState("");
  return (
    <div className="wrapper">
      {/* <Header /> */}
      <div className={"main-block"}>
        <Container></Container>
      </div>
      <Col sm={12}>
        <Container>
          <Title subTitle="Данные о вас" />
          <Form className={"formRegistration p-5"}>
            <FormGroup className={"maxInput w-100"}>
              <Label className={"contacts-form-label"}>Имя</Label>
              <Input
                type="text"
                name="name"
                required
                className={" contacts-form__input"}
              />
            </FormGroup>
            <FormGroup className={"maxInput w-100"}>
              <Label className={"contacts-form-label"}>Фамилия</Label>
              <Input
                type={"text"}
                name="surname"
                required
                className={" contacts-form__input"}
              />
            </FormGroup>
            <FormGroup className={"maxInput w-100"}>
              <Label className={"contacts-form-label"}>Отчество</Label>
              <Input
                type={"text"}
                name="surname"
                required
                className={" contacts-form__input"}
              />
            </FormGroup>
            <FormGroup className={"maxInput w-100"}>
              <Label className={"contacts-form-label"}>Номер телефона</Label>
              <PhoneInput
                country={"kg"}
                name="phone"
                value={phoneNumber}
                onChange={value => setPhoneNumber(value)}
                localization={ru}
                masks={{ kg: "+... ... .. .. .." }}
                inputClass={"form-control contacts-form__input"}
              />
            </FormGroup>
            <div className="w-100 d-flex justify-content-around mt-3">
              <Button
                type="submit"
                className={"p-2 next__button"}
              >
                Далее
              </Button>
            </div>
          </Form>
        </Container>
      </Col>
      {/* <Footer /> */}
    </div>
  );
};
export default MainPage;
