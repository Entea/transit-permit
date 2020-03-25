import React from "react";
import { Route, Switch } from "react-router-dom";
function App() {
  return (
    <React.Fragment>
      <Switch>
        <Route path="/" exact component={ScanLoginPage} />
      </Switch>
    </React.Fragment>
  );
}

export default App;
