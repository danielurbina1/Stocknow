import React from "react";
import axios from "axios"; // Importa axios
import Header from "../components/Header";
import { useEffect } from "react";
import { useState } from "react";
const Perfil = () => {
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
        console.log(response.data);
        // Si la respuesta es exitosa, almacena los datos
        setUserData(response.data);
      } catch (err) {}
    };

    fetchData(); // Llama la función para obtener los datos
  }, []);

  const handleEditProfile = () => {
    // Lógica para editar perfil
    alert("Función para editar perfil aún no implementada.");
  };

  return (
    <div className="bg-gray-800 text-gray-200 min-h-screen">
      <Header />
      <main className="p-8 max-w-4xl mx-auto">
        <h1 className="text-3xl font-bold mb-8">Mi Perfil</h1>

        {/* Información del Usuario */}
        <section className="bg-gray-700 p-6 rounded-lg shadow-lg">
          <h2 className="text-xl font-semibold mb-4">Información Personal</h2>
          <p>
            <strong>Nombre:</strong> {!!userData ? userData.name : ""}
          </p>
          <p>
            <strong>Email:</strong> {!!userData ? userData.email : ""}
          </p>
          <p>
            <strong>Rol:</strong> {!!userData ? userData.rol : ""}
          </p>
          <button
            className="mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg"
            onClick={handleEditProfile}
          >
            Editar Perfil
          </button>
        </section>

        {/* Historial o Actividad */}
        <section className="bg-gray-700 p-6 rounded-lg shadow-lg mt-16">
          <h2 className="text-xl font-semibold mb-4">Actividad Reciente</h2>
          <ul className="list-disc pl-6 space-y-2">
            <li>Visualizó el producto "Laptop Dell XPS 13" el 03/01/2025.</li>
            <li>Realizó una búsqueda de "Móviles Samsung" el 02/01/2025.</li>
            <li>Actualizó su contraseña el 01/01/2025.</li>
          </ul>
        </section>
      </main>
    </div>
  );
};

export default Perfil;
