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
    role_id: "",
  });
  const [editUser, setEditUser] = useState(null);
  const [isModalOpen, setIsModalOpen] = useState(false);

  // Obtener usuarios y roles
  useEffect(() => {
    const fetchData = async () => {
      try {
        const [usersResponse, rolesResponse] = await Promise.all([
          axios.get("http://localhost:8000/api/users"),
          axios.get("http://localhost:8000/api/roles"),
        ]);
        console.log("Users:", usersResponse.data); // Verifica que los usuarios se obtienen correctamente
        console.log("Roles:", rolesResponse.data); // Verifica que los roles se obtienen correctamente
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
    const { name, value } = e.target;
    if (editUser) {
      setEditUser({ ...editUser, [name]: value });
    } else {
      setNewUser({ ...newUser, [name]: value });
    }
  };

  // Crear o actualizar usuario
  const handleSaveUser = async () => {
    try {
      if (editUser) {
        // Editar usuario
        const response = await axios.put(
          `http://localhost:8000/api/users/${editUser.id}`,
          editUser
        );
        setUsers((prev) =>
          prev.map((user) => (user.id === editUser.id ? response.data : user))
        );
      } else {
        // Crear usuario
        const response = await axios.post(
          "http://localhost:8000/api/users",
          newUser
        );
        setUsers([...users, response.data]);
      }

      setNewUser({ name: "", email: "", password: "", role_id: "" });
      setEditUser(null);
      setIsModalOpen(false);
    } catch (error) {
      console.error("Error al guardar usuario:", error);
    }
  };

  // Eliminar usuario
  const handleDeleteUser = async (id) => {
    try {
      await axios.delete(`http://localhost:8000/api/users/${id}`);
      setUsers((prev) => prev.filter((user) => user.id !== id));
    } catch (error) {
      console.error("Error al eliminar usuario:", error);
    }
  };

  // Abrir modal para editar usuario
  const handleEditUser = (user) => {
    setEditUser(user);
    setIsModalOpen(true);
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
          onClick={() => {
            setIsModalOpen(true);
            setEditUser(null);
          }}
          className="bg-blue-500  py-2 px-4 rounded hover:bg-blue-600"
        >
          Crear Usuario
        </button>
      </div>

      {/* Modal */}
      {isModalOpen && (
        <div className="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
          <div className="bg-white p-6 rounded-lg shadow-lg max-w-md w-full text-black">
            <h2 className="text-xl font-semibold mb-4">
              {editUser ? "Editar Usuario" : "Crear Usuario"}
            </h2>
            <div className="space-y-4">
              <input
                type="text"
                name="name"
                value={editUser ? editUser.name : newUser.name}
                onChange={handleInputChange}
                placeholder="Nombre"
                className="w-full p-2 border rounded text-black"
              />
              <input
                type="email"
                name="email"
                value={editUser ? editUser.email : newUser.email}
                onChange={handleInputChange}
                placeholder="Correo Electrónico"
                className="w-full p-2 border rounded text-black"
              />
              {!editUser && (
                <input
                  type="password"
                  name="password"
                  value={newUser.password}
                  onChange={handleInputChange}
                  placeholder="Contraseña"
                  className="w-full p-2 border rounded text-black"
                />
              )}
              <select
                name="role_id"
                value={editUser ? editUser.role_id : newUser.role_id}
                onChange={handleInputChange}
                className="w-full p-2 border rounded text-black"
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
                  onClick={handleSaveUser}
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
        <div className="overflow-x-auto">
          <table className="w-full table-auto border-collapse">
            <thead>
              <tr className="bg-gray-700 text-gray-100">
                <th className="border border-gray-600 p-3 text-left">Nombre</th>
                <th className="border border-gray-600 p-3 text-left">Correo</th>
                <th className="border border-gray-600 p-3 text-left">Rol</th>
                <th className="border border-gray-600 p-3 text-left">
                  Acciones
                </th>
              </tr>
            </thead>
            <tbody>
              {users.map((user, index) => (
                <tr
                  key={user.id}
                  className={
                    index % 2 === 0
                      ? "bg-gray-600 hover:bg-gray-500"
                      : "bg-gray-700 hover:bg-gray-600"
                  }
                >
                  <td className="border border-gray-600 p-3">{user.name}</td>
                  <td className="border border-gray-600 p-3">{user.email}</td>
                  <td className="border border-gray-600 p-3">
                    {user.role?.name}
                  </td>
                  <td className="border border-gray-600 p-3 flex space-x-2">
                    <button
                      onClick={() => handleDeleteUser(user.id)}
                      className="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600"
                    >
                      Eliminar
                    </button>
                    <button
                      onClick={() => handleEditUser(user)}
                      className="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600"
                    >
                      Editar
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default Users;
