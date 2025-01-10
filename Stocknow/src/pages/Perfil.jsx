import React, { useEffect, useState } from "react";
import axios from "axios"; // Importa axios
import Header from "../components/Header";

const Perfil = () => {
  const [userData, setUserData] = useState(null); // Datos del usuario
  const [buzonMessages, setBuzonMessages] = useState([]); // Mensajes del buzón
  const [error, setError] = useState(null); // Error de API

  useEffect(() => {
    const fetchData = async () => {
      try {
        const token = localStorage.getItem("token"); // Obtén el token
        if (!token) {
          throw new Error("No se encontró un token válido.");
        }

        // Solicitar datos del usuario
        const userResponse = await axios.get("http://localhost:8000/api/user", {
          headers: {
            Authorization: `Bearer ${token}`, // Agrega el token al encabezado
          },
        });

        setUserData(userResponse.data);

        // Solicitar mensajes del buzón
        const buzonResponse = await axios.get(
          "http://localhost:8000/api/buzones",
          {
            headers: {
              Authorization: `Bearer ${token}`, // Agrega el token al encabezado
            },
          }
        );

        setBuzonMessages(buzonResponse.data); // Establece los mensajes del buzón
      } catch (err) {
        console.error("Error al obtener los datos:", err);
        setError("No se pudo obtener la información.");
      }
    };

    fetchData(); // Llama la función para obtener los datos
  }, []);

  const handleEditProfile = () => {
    // Lógica para editar perfil
    alert("Función para editar perfil aún no implementada.");
  };

  // Renderizado de error
  if (error) {
    return (
      <div className="bg-gray-800 text-gray-200 min-h-screen flex items-center justify-center">
        <p className="text-xl text-red-500">{error}</p>
      </div>
    );
  }

  return (
    <div className="bg-gray-800 text-gray-200 min-h-screen">
      <Header />
      <main className="p-8 max-w-4xl mx-auto">
        <h1 className="text-3xl font-bold mb-8">Mi Perfil</h1>

        {/* Información del Usuario */}
        <section className="bg-gray-700 p-6 rounded-lg shadow-lg">
          <h2 className="text-xl font-semibold mb-4">Información Personal</h2>
          <p>
            <strong>Nombre:</strong> {userData?.name}
          </p>
          <p>
            <strong>Email:</strong> {userData?.email}
          </p>
          <p>
            <strong>Rol:</strong> {userData?.role?.name}
          </p>
          <button
            className="mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg"
            onClick={handleEditProfile}
          >
            Editar Perfil
          </button>
        </section>

        {/* Buzón */}
        <section className="bg-gray-700 p-6 rounded-lg shadow-lg mt-16">
          <h2 className="text-xl font-semibold mb-4">Buzón</h2>
          {buzonMessages.length > 0 ? (
            <ul className="list-disc pl-6 space-y-2">
              {buzonMessages.map((message) => (
                <li key={message.id}>
                  <span className="font-bold">{message.jefe.name}</span> ha
                  quitado una cantidad de{" "}
                  <span className="font-bold">{message.cantidad}</span> de{" "}
                  <span className="font-bold">{message.producto.nombre}</span>{" "}
                  el día{" "}
                  <span className="font-bold">
                    {new Date(message.created_at).toLocaleDateString()}
                  </span>
                  .
                </li>
              ))}
            </ul>
          ) : (
            <p className="text-gray-400">No hay mensajes en el buzón.</p>
          )}
        </section>
      </main>
    </div>
  );
};

export default Perfil;
