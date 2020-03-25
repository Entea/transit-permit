import React from "react";
import { Route, Switch } from "react-router-dom";
import MainPage from "./pages/main-page/main";
import AboutUs from "./pages/about-us/about-us";
import Contacts from "./pages/contacts/contact";
import Order from "./pages/order/orders";
import ProductTracking from "./pages/product-tracking/product-tracking";
import MyPackage from "./pages/my-package/my-package";
import OrderHistory from "./pages/order-history/order-history";
import SearchTracking from "./pages/ search-tracking/search-tracking";
import RegistrationPage from "./pages/registrationsPages/registrationPage";
import Confirmation from "./pages/registrationsPages/confirmation";
import Login from "./pages/registrationsPages/login";
import TariffPage from "./pages/tarifs-page/tarifs-page";
import ResetPasswordPhone from "./pages/registrationsPages/resetPasswordPhone";
import ValidateCode from "./pages/registrationsPages/validateCode";
import ResetPassword from "./pages/registrationsPages/resetPassword";
import InstructionWorkPage from "./pages/instruction-work-page/instruction-work-page";
import Address from "./pages/address/address";

import ScanLoginPage from "./scanPages/login";
import ScanSelectPage from "./scanPages/selectCode";
import QRCode from "./scanPages/qrCode";
import BarCode from "./scanPages/barCode";
function App() {
  return (
    <React.Fragment>
      <Switch>
     
        <Route path="/scan/login" exact component={ScanLoginPage} />
        <Route path="/scan/selectСode" exact component={ScanSelectPage} />
        <Route path="/scan/qr-code" exact component={QRCode} />
        <Route path="/scan/bar-code" exact component={BarCode} />
      </Switch>
    </React.Fragment>
  );
}

export default App;
