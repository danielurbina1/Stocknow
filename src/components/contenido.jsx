import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";

const Content = () => {
  const [pasillos, setPasillos] = useState([]); // Estado para almacenar los pasillos y productos
  const navigate = useNavigate();

  // Petición al backend para obtener los pasillos y productos
  useEffect(() => {
    const fetchPasillos = async () => {
      try {
        const token = localStorage.getItem("token"); // Asume que el token de autenticación está almacenado en localStorage
        const response = await axios.get("http://localhost:8000/api/pasillos", {
          headers: {
            Authorization: `Bearer ${token}`, // Agregar el token al encabezado
          },
        });
        setPasillos(response.data); // Guardar los datos en el estado
      } catch (error) {
        console.error("Error fetching pasillos:", error);
        if (error.response?.status === 401) {
          navigate("/login"); // Redirigir al usuario si no está autenticado
        }
      }
    };

    fetchPasillos();
  }, [navigate]);

  return (
    <div className="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
      <div className="border-b mb-5 flex justify-between text-sm">
        <div className="text-indigo-600 flex items-center pb-2 pr-2 border-b-2 border-indigo-600 uppercase">
          <span className="font-semibold inline-block">Productos</span>
        </div>
      </div>

      <div className="grid grid-cols-2 lg:grid-cols-4 gap-10">
        {pasillos.map((pasillo) =>
          pasillo.productos.map((producto) => (
            <div
              key={producto.id}
              className="rounded overflow-hidden shadow-lg flex flex-col"
            >
              <div className="relative">
                <img
                  className="w-full"
                  src={producto.imagen || "default-image.webp"} // Agregar una imagen predeterminada si no hay imagen
                  alt={producto.nombre}
                />
                <div className="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
              </div>
              <div className="px-6 py-4 mb-auto">
                <p className="font-medium text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out mb-2">
                  {producto.nombre}
                </p>
                <p className="text-sm text-gray-600">
                  Precio: €{producto.precio.toFixed(2)}
                </p>
                <p className="text-sm text-gray-600">Stock: {producto.stock}</p>
              </div>
            </div>
          ))
        )}
      </div>
    </div>
  );
};

export default Content;