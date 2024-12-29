// src/services/api.js
import axios from "axios";

const API_URL = "http://localhost/api"; // URL de tu backend en Laravel

export const login = (credentials) => {
  return axios.post(`${API_URL}/login`, credentials);
};

export const fetchProducts = () => {
  return axios.get(`${API_URL}/products`);
};

// Agrega más funciones según lo necesario
