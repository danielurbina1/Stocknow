import React, { useState, useEffect } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import logo from "../imagenes/logo.png"; // Importa la imagen

const Header = () => {
  const navigate = useNavigate();
  const [userData, setUserData] = useState(null); // Estado para los datos del usuario
  const [isMenuOpen, setIsMenuOpen] = useState(false); // Estado para manejar el menú en pantallas pequeñas

  useEffect(() => {
    const fetchData = async () => {
      try {
        const token = localStorage.getItem("token"); // Obtén el token
        if (!token) {
          throw new Error("No token found");
        }

        // Realiza la solicitud GET con el token
        const response = await axios.get(
          `${import.meta.env.VITE_BACKENDURL}/api/user`,
          {
            headers: {
              Authorization: `Bearer ${token}`, // Agrega el token al encabezado
            },
          }
        );

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
        `${import.meta.env.VITE_BACKENDURL}/api/logout`,
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
          <img src={logo} alt="Logo" className="w-28 h-28 mr-2" />{" "}
          {/* Logo a la izquierda */}
          <h2 className="text-lg font-bold">StockNow</h2>
        </div>

        {/* Menú en pantallas grandes */}
        <div
          id="collapseMenu"
          className={`lg:block ${
            isMenuOpen ? "block" : "hidden"
          } max-lg:hidden`}
        >
          <ul className="lg:flex lg:gap-x-5 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50">
            {userData?.role?.name &&
              ["Admin", "Jefe"].includes(userData.role.name) && (
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

        {/* Menú en pantallas pequeñas */}
        <div className="flex items-center ml-auto space-x-6">
          <button
            className="font-semibold text-[15px] border-none outline-none"
            onClick={handleLogout}
          >
            <span className="text-[#007bff] hover:underline">
              Cerrar Sesión
            </span>
          </button>
          {/* Icono de menú para pantallas pequeñas */}
          <button
            className="lg:hidden text-white"
            onClick={() => setIsMenuOpen(!isMenuOpen)} // Alterna la visibilidad del menú
          >
            <span className="material-icons">menu</span>
          </button>
        </div>
      </div>

      {/* Menú desplegable en pantallas pequeñas */}
      {isMenuOpen && (
        <div className="lg:hidden flex flex-col items-start p-4 bg-gray-800 w-full absolute top-0 left-0 z-50">
          {userData?.role?.name &&
            ["Admin", "Jefe"].includes(userData.role.name) && (
              <button
                onClick={() => navigateTo(ROUTES.Administrar)}
                className="text-white py-2 px-4 hover:text-[#007bff]"
              >
                Administrar
              </button>
            )}
          <button
            onClick={() => navigateTo(ROUTES.dashboard)}
            className="text-white py-2 px-4 hover:text-[#007bff]"
          >
            Productos
          </button>
          <button
            onClick={() => navigateTo(ROUTES.perfil)}
            className="text-white py-2 px-4 hover:text-[#007bff]"
          >
            Perfil
          </button>
        </div>
      )}
    </header>
  );
};

export default Header;
