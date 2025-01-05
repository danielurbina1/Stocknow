import React, { useState, useEffect } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import Administrar from "../pages/Administrar";

const Header = () => {
  const navigate = useNavigate();
  const [userData, setUserData] = useState(null); // Estado para los datos del usuario

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

        setUserData(response.data); // Almacena los datos del usuario
        console.log(userData);
      } catch (err) {
        console.error("Error fetching user data:", err);
        // Si ocurre un error, redirige al login
        navigate("/");
      }
    };

    fetchData(); // Llama a la función para obtener los datos
  }, [navigate]);

  // Constantes para las rutas
  const ROUTES = {
    Administrar: "/Administrar",
    dashboard: "/dashboard",
    perfil: "/perfil",
    login: "/", // Ruta del login
  };

  const handleLogout = () => {
    const token = localStorage.getItem("token");
    axios
      .post(
        "http://localhost:8000/api/logout",
        {},
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      )
      .then((res) => {
        if (!!res.data.message) {
          localStorage.removeItem("token");
          navigate(ROUTES.login);
        }
      })
      .catch((err) => {
        console.error("Error logging out:", err);
      });
  };

  const navigateTo = (route) => {
    navigate(route);
  };

  return (
    <header className="flex shadow-lg py-4 px-4 sm:px-10 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-700 text-gray-200 font-[sans-serif] min-h-[70px] tracking-wide relative z-50 border-b border-gray-600">
      <div className="flex flex-wrap items-center justify-between gap-4 w-full">
        <div className="flex items-center lg:absolute lg:top-2/4 lg:left-2/4 lg:-translate-x-1/2 lg:-translate-y-1/2 max-lg:left-5">
          <h2 className="text-lg font-bold">StockNow</h2>
        </div>

        <div
          id="collapseMenu"
          className="max-lg:hidden lg:!block max-lg:w-full max-lg:fixed max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50"
        >
          <button
            id="toggleClose"
            className="lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white w-9 h-9 flex items-center justify-center border"
          >
            {/* ... */}
          </button>

          <ul className="lg:flex lg:gap-x-5 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50">
            {userData?.role?.name &&
              ["Admin", "Jefe"].includes(userData.role.name) && ( // Mostrar solo si el rol es "administrador"
                <li className="max-lg:border-b max-lg:py-3 px-3">
                  <button
                    onClick={() => navigateTo(ROUTES.Administrar)}
                    className="hover:text-[#007bff] text-[#ffffff] block font-semibold text-[15px]"
                  >
                    Administrar
                  </button>
                </li>
              )}
            <li className="max-lg:border-b max-lg:py-3 px-3">
              <button
                onClick={() => navigateTo(ROUTES.dashboard)}
                className="hover:text-[#007bff] text-[#ffffff] block font-semibold text-[15px]"
              >
                Productos
              </button>
            </li>
            <li className="max-lg:border-b max-lg:py-3 px-3">
              <button
                onClick={() => navigateTo(ROUTES.perfil)}
                className="hover:text-[#007bff] text-[#ffffff] block font-semibold text-[15px]"
              >
                Perfil
              </button>
            </li>
          </ul>
        </div>

        <div className="flex items-center ml-auto space-x-6">
          <button
            className="font-semibold text-[15px] border-none outline-none"
            onClick={handleLogout}
          >
            <span className="text-[#007bff] hover:underline">
              Cerrar Sesión
            </span>
          </button>
          <button id="toggleOpen" className="lg:hidden">
            {/* ... */}
          </button>
        </div>
      </div>
    </header>
  );
};

export default Header;
