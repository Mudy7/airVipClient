export async function get(route) {
    //changer la route ici 
    const response = await fetch("http://localhost:8081/" + route, {
      method: "GET",
      credentials: "include",
    });
    return await parseResponse(response, route);
  }
  
  export async function post(route, body = null) {
    console.log("body: " + body, JSON.stringify(body));
  
    const data = {
      method: "POST",
      credentials: "include",
      body: body ? JSON.stringify(body) : null,
      headers: {
        "Content-Type": "application/json",
      },
    };
  
    const response = await fetch("http://localhost:8081/" + route, data);
    return await parseResponse(response, route);
  }
  
  async function parseResponse(response, route) {
    const contentType = response.headers.get("Content-Type");
    const status = response.status;
    const statusText = response.statusText;
  
    if (!response.ok) {
      throw new Error(
        "Request to: " + route + " failed with status: " + status + " - " + statusText
      );
    }
  
    let body;
  
    if (contentType && contentType.includes("application/json")) {
      body = await response.json();
    }
  

    if (body && body.role && body.role !== 'client') {
      throw new Error("Vous devez être un client pour vous inscrire.");
    }
  
    return { status, body };
  }