// src/pages/Login.jsx
import React, { useState } from "react";
import { useNavigate } from "react-router-dom"; // Importa useNavigate para poder redirigir
import "../assets/css/login.css";
import Header from "../components/Header";
import login from "../imagenes/login.png";
import axios from "axios";
import izquierda from "../imagenes/arribaderecha.jpeg";
import abajo from "../imagenes/abajoizquierda.jpeg";
import derecha from "../imagenes/derecha.jpeg";
import logo from "../imagenes/logos.jpeg";

const Login = () => {
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [loading, setLoading] = useState(false);
  const navigate = useNavigate(); // Inicializa useNavigate para redirigir

  // Lógica de inicio de sesión que redirige sin verificar credenciales
  const handleLogin = async (e) => {
    e.preventDefault();
    if (!username || !password) {
      alert("Por favor, completa todos los campos.");
      return;
    }

    setLoading(true);

    try {
      console.log("hola");
      const response = await axios.post("http://localhost:8000/api/login", {
        name: username,
        password: password,
      });

      // Guarda el token en el almacenamiento local o en una cookie
      localStorage.setItem("token", response.data.token);

      // Redirige al usuario al dashboard
      setLoading(true);
      setTimeout(() => {
        navigate("/dashboard");
      }, 1000); // Espera 1 segundo antes de redireccionar
    } catch (error) {
      alert(
        "Credenciales inválidas. Por favor, verifica tu email y contraseña."
      );
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
      <div className="font-[sans-serif] bg-gray-800 text-gray-200 bg-gradient-to-r from-blue-950 to-purple-900">
        {/* Fondo granulado y degradado desde azul hasta granate */}
        <div className="min-h-screen flex flex-col items-center justify-center py-6 px-4">
          <div className="grid md:grid-cols-2 items-center gap-10 max-w-6xl w-full">
            <div className="flex flex-col items-start">
              <h1 className="lg:text-6xl text-6xl font-extrabold lg:leading-[55px] text-white">
                StockNow
              </h1>
              <p className="text-sm mt-6 text-gray-300">
                Ten un control sobre el Stock de tu almacen en tiempo real y no
                pierdas el tiempo.
                <br />
                StockNow está para ahorrarte tiempo
              </p>
            </div>

            <form className="max-w-md md:ml-auto w-full">
              <h3 className="text-3xl font-extrabold mb-8 text-white">
                Inicia Sesión
              </h3>

              <div className="space-y-4">
                <div>
                  <input
                    name="email"
                    type="email"
                    autoComplete="email"
                    required
                    className="bg-gray-700 w-full text-sm text-gray-200 px-4 py-3.5 rounded-md outline-blue-600 focus:bg-transparent focus:ring-2 focus:ring-blue-500" // Enfoque azul
                    placeholder="Email"
                    onChange={(e) => setUsername(e.target.value)}
                  />
                </div>
                <div>
                  <input
                    name="password"
                    type="password"
                    autoComplete="current-password"
                    required
                    className="bg-gray-700 w-full text-sm text-gray-200 px-4 py-3.5 rounded-md outline-blue-600 focus:bg-transparent focus:ring-2 focus:ring-blue-500" // Enfoque azul
                    placeholder="Password"
                    onChange={(e) => setPassword(e.target.value)}
                  />
                </div>
              </div>

              <div className="!mt-8">
                <button
                  type="button"
                  className="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-blue-800 hover:bg-purple-950 focus:outline-none focus:ring-2 focus:ring-red-500" // Fondo granate
                  onClick={handleLogin}
                  disabled={loading}
                >
                  {loading ? "Cargando..." : "Log in"}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </>
  );
};

export default Login;
