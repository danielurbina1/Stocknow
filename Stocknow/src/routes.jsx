// src/routes.js
import Login from "./pages/Login";
import Dashboard from "./pages/Dashboard";
import Inventory from "./pages/Inventory";
import UserManagement from "./pages/UserManagement";
import Alerts from "./pages/Alerts";
import ProductSearch from "./pages/ProductSearch";
import Perfil from "./pages/Perfil";

export const routes = [
  { path: "/", component: <Login /> },
  { path: "/dashboard", component: <Dashboard /> },
  { path: "/inventory", component: <Inventory /> },
  { path: "/users", component: <UserManagement /> },
  { path: "/alerts", component: <Alerts /> },
  { path: "/product-search", component: <ProductSearch /> },
  { path: "/perfil", component: <Perfil/> },

];
