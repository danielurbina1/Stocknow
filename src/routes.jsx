// src/routes.js
import Login from "./pages/Login";
import Dashboard from "./pages/Dashboard";
import Inventory from "./pages/Inventory";
import UserManagement from "./pages/UserManagement";
import Alerts from "./pages/Alerts";
import ProductSearch from "./pages/ProductSearch";

export const routes = [
  { path: "/", component: <Login /> },
  { path: "/dashboard", component: <Dashboard /> },
  { path: "/inventory", component: <Inventory /> },
  { path: "/users", component: <UserManagement /> },
  { path: "/alerts", component: <Alerts /> },
  { path: "/product-search", component: <ProductSearch /> },
];