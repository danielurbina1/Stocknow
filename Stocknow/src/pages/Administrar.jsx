import React, { useEffect, useState } from "react";
import axios from "axios";
import Header from "../components/Header";
const Users = () => {
  const [users, setUsers] = useState([]);
  const [roles, setRoles] = useState([]);
  const [newUser, setNewUser] = useState({
    name: "",
    email: "",
    password: "",
    role_id: "", // Se usa role_id para asociar al ID del rol en lugar del nombre
  });
  const [isModalOpen, setIsModalOpen] = useState(false);

  // Obtener usuarios y roles
  useEffect(() => {
    const fetchData = async () => {
      try {
        const [usersResponse, rolesResponse] = await Promise.all([
          axios.get("http://localhost:8000/api/users"),
          axios.get("http://localhost:8000/api/roles"),
        ]);
        setUsers(usersResponse.data);
        setRoles(rolesResponse.data);
      } catch (error) {
        console.error("Error al obtener datos:", error);
      }
    };

    fetchData();
  }, []);

  // Manejar cambios en los inputs
  const handleInputChange = (e) => {
    setNewUser({ ...newUser, [e.target.name]: e.target.value });
  };

  // Crear un nuevo usuario
  const handleCreateUser = async () => {
    try {
      console.log(newUser);
      const response = await axios.post(
        "http://localhost:8000/api/users",
        newUser
      );
      setUsers([...users, response.data]);
      setNewUser({ name: "", email: "", password: "", role_id: "" });
      setIsModalOpen(false);
    } catch (error) {
      console.error("Error al crear usuario:", error);
    }
  };

  return (
    <div className="bg-gray-800 text-gray-200 min-h-screen">
      <Header />
      <h1 className="text-3xl font-bold text-center mt-8 mb-8">
        Gestión de Usuarios
      </h1>

      {/* Botón para abrir el modal */}
      <div className="text-center mb-8">
        <button
          onClick={() => setIsModalOpen(true)}
          className="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
        >
          Crear Usuario
        </button>
      </div>

      {/* Modal */}
      {isModalOpen && (
        <div className="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
          <div className="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 className="text-xl font-semibold mb-4">Crear Usuario</h2>
            <div className="space-y-4">
              <input
                type="text"
                name="name"
                value={newUser.name}
                onChange={handleInputChange}
                placeholder="Nombre"
                className="w-full p-2 border rounded"
              />
              <input
                type="email"
                name="email"
                value={newUser.email}
                onChange={handleInputChange}
                placeholder="Correo Electrónico"
                className="w-full p-2 border rounded"
              />
              <input
                type="password"
                name="password"
                value={newUser.password}
                onChange={handleInputChange}
                placeholder="Contraseña"
                className="w-full p-2 border rounded"
              />
              <select
                name="role_id"
                value={newUser.role_id}
                onChange={handleInputChange}
                className="w-full p-2 border rounded"
              >
                <option value="">Seleccione un rol</option>
                {roles.map((role) => (
                  <option key={role.id} value={role.id}>
                    {role.name}
                  </option>
                ))}
              </select>
              <div className="flex justify-end space-x-4">
                <button
                  onClick={() => setIsModalOpen(false)}
                  className="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600"
                >
                  Cancelar
                </button>
                <button
                  onClick={handleCreateUser}
                  className="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
                >
                  Guardar
                </button>
              </div>
            </div>
          </div>
        </div>
      )}

      {/* Lista de Usuarios */}
      <div className="p-6 rounded-lg shadow-md">
        <h2 className="text-xl font-semibold mb-4">Lista de Usuarios</h2>
        <table className="w-full border-collapse">
          <thead>
            <tr className="bg-gray-700 text-gray-100">
              <th className="border border-gray-600 p-3 text-left">Nombre</th>
              <th className="border border-gray-600 p-3 text-left">Correo</th>
              <th className="border border-gray-600 p-3 text-left">Rol</th>
            </tr>
          </thead>
          <tbody>
            {users.map((user, index) => (
              <tr key={user.id} className={"bg-gray-600 hover:bg-gray-500"}>
                <td className="border border-gray-600 p-3">{user.name}</td>
                <td className="border border-gray-600 p-3">{user.email}</td>
                <td className="border border-gray-600 p-3">
                  {user.role?.name || "Sin rol"}
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default Users;
