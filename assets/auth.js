import axios from "axios";

const USERNAME = "admin";
const PASSWORD = "admin123";

const authHeader = "Basic " + btoa(`${USERNAME}:${PASSWORD}`);

const apiClient = axios.create({
  baseURL: "http://localhost/api",
  headers: {
    "Content-Type": "application/json",
    Authorization: authHeader,
  },
  withCredentials: true,
});

export default apiClient;



