import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";

const Content = () => {
  const [pasillos, setPasillos] = useState([]);
  const [searchTerm, setSearchTerm] = useState("");
  const [filteredProductos, setFilteredProductos] = useState([]);
  const [selectedPasillo, setSelectedPasillo] = useState(null);
  const [editingProductId, setEditingProductId] = useState(null); // Producto en edición
  const [restarStock, setRestarStock] = useState(""); // Valor de stock para restar
  const navigate = useNavigate();

  useEffect(() => {
    const fetchPasillos = async () => {
      try {
        const token = localStorage.getItem("token");
        const response = await axios.get("http://localhost:8000/api/pasillos", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        setPasillos(response.data);
        setFilteredProductos(
          response.data.flatMap((pasillo) => pasillo.productos)
        );
      } catch (error) {
        console.error("Error fetching pasillos:", error);
        if (error.response?.status === 401) {
          navigate("/login");
        }
      }
    };

    fetchPasillos();
  }, [navigate]);

  const handleSearchChange = (e) => {
    const term = e.target.value.toLowerCase();
    setSearchTerm(term);
    const allProductos = pasillos.flatMap((pasillo) => pasillo.productos);
    const filtered = allProductos.filter(
      (producto) =>
        producto.nombre.toLowerCase().includes(term) ||
        producto.id.toString().includes(term)
    );
    setFilteredProductos(filtered);
  };

  const handlePasilloSelect = (pasilloId) => {
    setSelectedPasillo(pasilloId);
    if (pasilloId === null) {
      setFilteredProductos(pasillos.flatMap((pasillo) => pasillo.productos));
    } else {
      const selectedProducts =
        pasillos.find((pasillo) => pasillo.id === pasilloId)?.productos || [];
      setFilteredProductos(selectedProducts);
    }
  };

  const handleEditClick = (productId) => {
    setEditingProductId(productId); // Activar modo edición para el producto
    setRestarStock(""); // Limpiar valor de restar stock
  };

  const handleRestarStock = async (productId) => {
    const token = localStorage.getItem("token");
    try {
      const response = await axios.patch(
        `http://localhost:8000/api/productos/${productId}/stock/restar`,
        { cantidad_a_restar: restarStock }, // Enviar cantidad a restar al backend
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );
      console.log("Respuesta del servidor:", response.data); // Depuración

      // Actualizar localmente
      const updatedProductos = filteredProductos.map((producto) =>
        producto.id === productId
          ? { ...producto, stock: response.data.stock }
          : producto
      );
      setFilteredProductos(updatedProductos);

      // Actualizar pasillos
      const updatedPasillos = pasillos.map((pasillo) => ({
        ...pasillo,
        productos: pasillo.productos.map((producto) =>
          producto.id === productId
            ? { ...producto, stock: response.data.stock }
            : producto
        ),
      }));
      setPasillos(updatedPasillos);

      // Salir del modo de edición
      setEditingProductId(null);
    } catch (error) {
      console.error("Error al restar el stock:", error.response || error);
    }
  };

  return (
    <div className="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
      <div className="border-b mb-5 flex justify-between items-center text-sm">
        <div className="text-indigo-600 flex items-center pb-2 pr-2 border-b-2 border-indigo-600 uppercase">
          <span className="font-semibold inline-block">Productos</span>
        </div>
        <input
          type="text"
          className="w-full max-w-xs px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-black"
          placeholder="Buscar por nombre o ID"
          value={searchTerm}
          onChange={handleSearchChange}
        />
      </div>

      <div className="mb-8 flex gap-2 flex-wrap">
        <button
          className={`px-4 py-2 rounded-md ${
            selectedPasillo === null
              ? "bg-indigo-600 text-white"
              : "bg-gray-300 text-black"
          }`}
          onClick={() => handlePasilloSelect(null)}
        >
          Todos
        </button>
        {pasillos.map((pasillo) => (
          <button
            key={pasillo.id}
            className={` px-4 py-2 rounded-md ${
              selectedPasillo === pasillo.id
                ? "bg-indigo-600 text-white"
                : "bg-gray-300 text-black"
            }`}
            onClick={() => handlePasilloSelect(pasillo.id)}
          >
            {pasillo.nombre}
          </button>
        ))}
      </div>

      <div className="grid grid-cols-2 lg:grid-cols-4 gap-10">
        {filteredProductos.length > 0 ? (
          filteredProductos.map((producto) => (
            <div
              key={producto.id}
              className="rounded overflow-hidden shadow-lg flex flex-col"
            >
              <div className="relative">
                <img
                  className="w-full"
                  src={`http://localhost:8000/storage/${producto.imagen}`}
                  alt={producto.nombre}
                />
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
              <div className="px-6 py-4">
                {editingProductId === producto.id ? (
                  <div className="flex items-center gap-2 text-black">
                    <input
                      type="number"
                      className="border px-1 py-1 text-sm w-16 rounded"
                      value={restarStock}
                      onChange={(e) => setRestarStock(e.target.value)}
                      placeholder="Restar stock"
                    />
                    <button
                      className="bg-red-500 text-white text-sm px-3 py-1 rounded"
                      onClick={() => handleRestarStock(producto.id)}
                    >
                      Restar Stock
                    </button>
                  </div>
                ) : (
                  <button
                    className="bg-blue-500 text-white text-sm px-3 py-1 rounded "
                    onClick={() => handleEditClick(producto.id)}
                  >
                    Modificar Stock
                  </button>
                )}
              </div>
            </div>
          ))
        ) : (
          <p className="text-center col-span-full text-gray-500">
            No se encontraron productos.
          </p>
        )}
      </div>
    </div>
  );
};

export default Content;
