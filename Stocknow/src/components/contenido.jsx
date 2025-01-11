import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";

const Content = () => {
  // Estados para manejar los pasillos, productos filtrados y búsqueda
  const [pasillos, setPasillos] = useState([]);
  const [searchTerm, setSearchTerm] = useState("");
  const [filteredProductos, setFilteredProductos] = useState([]);
  const [selectedPasillo, setSelectedPasillo] = useState(null);
  const [editingProductId, setEditingProductId] = useState(null); // Para saber qué producto se está editando
  const [stockAmount, setStockAmount] = useState(""); // Valor que se usará para sumar o restar stock
  const navigate = useNavigate(); // Para redirigir en caso de no estar autenticado

  useEffect(() => {
    // Función para obtener los pasillos y productos de la API
    const fetchPasillos = async () => {
      try {
        const token = localStorage.getItem("token");
        const response = await axios.get("http://localhost:8000/api/pasillos", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        setPasillos(response.data); // Aqui estoy guardando los pasillos
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

  // Función que maneja el cambio en el campo de búsqueda
  const handleSearchChange = (e) => {
    const term = e.target.value.toLowerCase();
    setSearchTerm(term); // Actualizamos el término de búsqueda
    const allProductos = pasillos.flatMap((pasillo) => pasillo.productos); // Aplanamos todos los productos
    // Filtramos los productos según el término de búsqueda, ya sea por nombre o por ID
    const filtered = allProductos.filter(
      (producto) =>
        producto.nombre.toLowerCase().includes(term) ||
        producto.id.toString().includes(term)
    );
    setFilteredProductos(filtered); // Actualizamos los productos filtrados
  };

  // Función para manejar la selección de un pasillo
  const handlePasilloSelect = (pasilloId) => {
    setSelectedPasillo(pasilloId);
    if (pasilloId === null) {
      // Si no se selecciona ningún pasillo, mostramos todos los productos
      setFilteredProductos(pasillos.flatMap((pasillo) => pasillo.productos));
    } else {
      // Si se selecciona un pasillo, solo mostramos los productos de ese pasillo
      const selectedProducts =
        pasillos.find((pasillo) => pasillo.id === pasilloId)?.productos || [];
      setFilteredProductos(selectedProducts);
    }
  };

  // Función que activa el modo de edición para un producto específico
  const handleEditClick = (productId) => {
    setEditingProductId(productId); // Activamos la edición para ese producto
    setStockAmount(""); // Limpiamos el campo de cantidad de stock
    setOperation(""); // Limpiamos la operación de stock (sumar/restar)
  };

  // Función que actualiza el stock de un producto
  const handleStockUpdate = async (productId, operacion) => {
    const token = localStorage.getItem("token"); // Obtenemos el token para la autorización
    try {
      let url = ""; // La URL dependerá de si vamos a sumar o restar stock
      const payload = { cantidad_a_restar: stockAmount }; // Por defecto, intentamos restar stock

      if (operacion === "sumar") {
        // Si la operación es "sumar", construimos la URL para sumar el stock
        url = `http://localhost:8000/api/productos/${productId}/stock/sumar`;
        payload.cantidad_a_sumar = stockAmount; // Usamos el campo correcto para sumar
      } else if (operacion === "restar") {
        // Si la operación es "restar", construimos la URL para restar el stock
        url = `http://localhost:8000/api/productos/${productId}/stock/restar`;
      }

      const response = await axios.patch(url, payload, {
        headers: {
          Authorization: `Bearer ${token}`, // Autorizamos la petición con el token
        },
      });

      console.log("Respuesta del servidor:", response.data); // Mostramos la respuesta del servidor para depurar

      // Actualizamos el stock localmente en los productos filtrados
      const updatedProductos = filteredProductos.map((producto) =>
        producto.id === productId
          ? { ...producto, stock: response.data.stock } // Si es el producto editado, actualizamos su stock
          : producto
      );
      setFilteredProductos(updatedProductos);

      // Actualizamos el stock también en los pasillos
      const updatedPasillos = pasillos.map((pasillo) => ({
        ...pasillo,
        productos: pasillo.productos.map((producto) =>
          producto.id === productId
            ? { ...producto, stock: response.data.stock }
            : producto
        ),
      }));
      setPasillos(updatedPasillos);

      // Salimos del modo de edición y limpiamos la operación
      setEditingProductId(null);
      setOperation(""); // Limpiamos la operación de stock
    } catch (error) {
      console.error("Error al actualizar el stock:", error.response || error); // Mostramos el error si ocurre
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
          onChange={handleSearchChange} // Llamamos a la función para actualizar la búsqueda
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
                  // Si estamos en el modo de edición para este producto, mostramos los botones de suma/resta
                  <div className="flex items-center gap-2 text-black">
                    <input
                      type="number"
                      className="border px-1 py-1 text-sm w-16 rounded"
                      value={stockAmount}
                      onChange={(e) => setStockAmount(e.target.value)} // Actualizamos la cantidad de stock
                      placeholder="Cantidad"
                    />
                    <button
                      className="bg-red-500 text-white text-sm px-3 py-1 rounded"
                      onClick={() => {
                        // Establecemos que vamos a restar stock
                        handleStockUpdate(producto.id, "restar"); // Llamamos a la función de actualización de stock
                      }}
                    >
                      Restar Stock
                    </button>
                    <button
                      className="bg-green-500 text-white text-sm px-3 py-1 rounded"
                      onClick={() => {
                        // Establecemos que vamos a sumar stock
                        handleStockUpdate(producto.id, "sumar"); // Llamamos a la función de actualización de stock
                      }}
                    >
                      Sumar Stock
                    </button>
                  </div>
                ) : (
                  // Si no estamos en modo edición, mostramos el botón para editar stock
                  <button
                    className="bg-blue-500 text-white text-sm px-3 py-1 rounded"
                    onClick={() => handleEditClick(producto.id)}
                  >
                    Modificar Stock
                  </button>
                )}
              </div>
            </div>
          ))
        ) : (
          // Si no hay productos, mostramos un mensaje indicando que no se encontraron productos
          <p className="text-center col-span-full text-gray-500">
            No se encontraron productos.
          </p>
        )}
      </div>
    </div>
  );
};

export default Content;
