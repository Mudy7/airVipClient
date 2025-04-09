import { jwtDecode } from "jwt-decode";

export function isAuthenticated() {
  const token = localStorage.getItem("token");

  if (!token) {
    return false;
  }

  try {
    const decodedToken = jwtDecode(token);
    const currentTime = Math.floor(Date.now() / 1000); // Temps actuel en secondes

    if (decodedToken.exp && decodedToken.exp < currentTime) {
      localStorage.removeItem("token"); // Supprime le token expiré
      localStorage.removeItem("userId");
      localStorage.removeItem("role");
      return false;
    }

    return true;
  } catch (error) {
    console.error("Erreur lors du décodage du token :", error);
    localStorage.removeItem("token"); // Supprime un token invalide
    return false;
  }
}

export function getUserRole() {
  return localStorage.getItem("role") || null;
}

export function getUserIdFromToken() {
  const token = localStorage.getItem("token");
  if (!token) return null;

  try {
    const decoded = jwtDecode(token);
    return decoded.userId || decoded.sub || null;
  } catch (err) {
    console.error("Token decoding failed:", err);
    return null;
  }
}

console.log(getUserIdFromToken());

export function logout() {
  localStorage.removeItem("token");
  localStorage.removeItem("userId");
  localStorage.removeItem("role");
  window.location.href = "/login"; // Redirige vers la page de connexion
}
