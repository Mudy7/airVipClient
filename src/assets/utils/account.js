import { get, post } from "./communications";

export async function getUser() {
  try {
    const response = await get("profile");
    return response.body;
  } catch (error) {
    console.error("Error fetching user data:", error);
    return null;
  }
}

export async function logout() {
  try {
    console.log("logging out...")
    await post("users/logout", null);
  } catch (error) {
    console.error("Error fetching user data:", error);
  }
}