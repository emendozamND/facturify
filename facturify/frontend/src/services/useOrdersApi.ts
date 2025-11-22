import { OrderRequest, OrderResponse } from "../types/order";

const API_BASE_URL = "http://localhost:8000/api"; // ajusta si tu backend usa otra ruta

export function useOrdersApi() {
  const calculateOrder = async (
    payload: OrderRequest
  ): Promise<OrderResponse> => {
    const response = await fetch(`${API_BASE_URL}/orders/calculate`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(payload),
    });

    if (!response.ok) {
      throw new Error("Error al consultar /orders/calculate");
    }

    return response.json();
  };

  return { calculateOrder };
}
