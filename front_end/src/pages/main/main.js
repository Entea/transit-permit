import React from "react";
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
// import { Link } from "react-router-dom";
import "./main.css";

const MainPage = () => {
  return (
    <div className="wrapper">
      {/* <Header /> */}
      <div className={"main-block"}>
        <Container></Container>
      </div>
      <Col>
        <Container>
          <Title />
          <Form>
            <FormGroup className={"d-flex"}>
              <Label>Дата</Label>
              <Input type="text" name="name" required />
            </FormGroup>
            <Button type="submit" color="secondary">
              Далее
            </Button>
          </Form>
        </Container>
      </Col>
      {/* <Footer /> */}
    </div>
  );
};
export default MainPage;
