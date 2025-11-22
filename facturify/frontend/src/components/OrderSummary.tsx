// src/components/OrderSummary.tsx
import "./OrderSummary.css";
import { OrderResponse } from "../types/order";

interface OrderSummaryProps {
  result: OrderResponse | null;
  error: string | null;
  loading: boolean;
}

function OrderSummary({ result, error, loading }: OrderSummaryProps) {
  return (
    <div className="order-summary">
      {loading && (
        <p className="order-summary__loading">Calculando la orden...</p>
      )}

      {error && !loading && (
        <p className="order-summary__error">{error}</p>
      )}

      {result && !loading && (
        <div className="order-summary__card">
          <h2>Resultado</h2>
          <p>
            <strong>Order ID:</strong> {result.orderId}
          </p>
          <p>
            <strong>Subtotal:</strong> ${result.subtotal.toFixed(2)}
          </p>
          <p>
            <strong>Descuento:</strong> ${result.discount.toFixed(2)}
          </p>
          <p>
            <strong>Impuestos:</strong> ${result.tax.toFixed(2)}
          </p>
          <p>
            <strong>Total:</strong> ${result.total.toFixed(2)}
          </p>
        </div>
      )}
    </div>
  );
}

export default OrderSummary;
