import React from "react";
import { Route, Switch } from "react-router-dom";
import MainPage from "./pages/main/main";
function App() {
  return (
    <React.Fragment>
      <Switch>
        <Route path="/" exact component={MainPage} />
      </Switch>
    </React.Fragment>
  );
}

export default App;
