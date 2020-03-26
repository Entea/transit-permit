import React from "react";
import { Route, Switch } from "react-router-dom";
import MainPage from "./pages/main/main";
import QRCode from "./scanPages/qrCode";
function App() {
  return (
    <React.Fragment>
      <Switch>
        <Route path="/" exact component={QRCode} />
        <Route path="/formIndividual" exact component={MainPage} />
      </Switch>
    </React.Fragment>
  );
}

export default App;
