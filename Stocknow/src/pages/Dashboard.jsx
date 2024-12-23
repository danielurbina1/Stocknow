import React from "react";
import Header from "../components/Header"; // Asegúrate de que la ruta sea correcta
import Pasillos from "../components/pasillos";
import Content from "../components/contenido";
const Dashboard = () => {
  return (
    <div className="bg-gray-800 text-gray-200 min-h-screen">
      <Header />
      <main className="p-8">
        <h1 className="text-4xl font-bold mb-4">Bienvenido al Dashboard</h1>
        <div className="flex gap-2 justify-center">
          <Pasillos />
          <Content />
        </div>
      </main>
    </div>
  );
};

export default Dashboard;
