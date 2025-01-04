import React, { useEffect, useState } from "react";
import axios from "axios"; // Importa axios
import Header from "../components/Header"; // Asegúrate de que la ruta sea correcta
import Content from "../components/contenido";

const Dashboard = () => {
  // Estado para almacenar los datos de la API
  const [userData, setUserData] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const token = localStorage.getItem("token"); // Obtén el token
        if (!token) {
          throw new Error("No token found");
        }

        // Realiza la solicitud GET con el token
        const response = await axios.get("http://localhost:8000/api/user", {
          headers: {
            Authorization: `Bearer ${token}`, // Agrega el token al encabezado
          },
        });

        // Si la respuesta es exitosa, almacena los datos
        setUserData(response.data);
      } catch (err) {}
    };

    fetchData(); // Llama la función para obtener los datos
  }, []);

  return (
    <div className="bg-gray-800 text-gray-200 min-h-screen">
      <Header />
      <main className="p-8">
        <h1 className="text-4xl font-bold mb-8 text-center">
          Bienvenido al Dashboard {!!userData ? userData.name : ""}
        </h1>
        <div className="flex gap-2 justify-center">
          <Content />
        </div>
      </main>
    </div>
  );
};

export default Dashboard;
