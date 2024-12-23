// src/components/Sidebar.jsx
import React from "react";
import { Link } from "react-router-dom";

const Sidebar = () => {
  return (
    <aside className="sidebar">
      <ul>
        <li>
          <Link to="/dashboard">Dashboard</Link>
        </li>
        <li>
          <Link to="/inventory">Inventario</Link>
        </li>
        <li>
          <Link to="/users">Gestión de Usuarios</Link>
        </li>
        <li>
          <Link to="/alerts">Alertas</Link>
        </li>
        <li>
          <Link to="/product-search">Búsqueda de Producto</Link>
        </li>
      </ul>
    </aside>
  );
};

export default Sidebar;
