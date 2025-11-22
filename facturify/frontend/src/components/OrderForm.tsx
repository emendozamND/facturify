// src/components/OrderForm.tsx
import { FormEvent, useState } from "react";
import "./OrderForm.css";
import OrderSummary from "./OrderSummary";

import { useOrdersApi } from "../services/useOrdersApi";
import {
  DiscountCode,
  OrderItem,
  OrderRequest,
  OrderResponse,
} from "../types/order";

const EMPTY_ITEM: OrderItem = {
  sku: "",
  price: 0,
  quantity: 1,
};

export function OrderForm() {
  const { calculateOrder } = useOrdersApi();

  const [orderId, setOrderId] = useState("");
  const [items, setItems] = useState<OrderItem[]>([{ ...EMPTY_ITEM }]);
  const [discountCode, setDiscountCode] = useState<DiscountCode>("NONE");

  const [result, setResult] = useState<OrderResponse | null>(null);
  const [error, setError] = useState<string | null>(null);
  const [loading, setLoading] = useState(false);

  const handleItemChange = (
    index: number,
    field: keyof OrderItem,
    value: string
  ) => {
    const newItems = [...items];

    if (field === "price" || field === "quantity") {
      newItems[index][field] = Number(value);
    } else {
      newItems[index][field] = value;
    }

    setItems(newItems);
  };

  const handleAddItem = () => {
    setItems((prev) => [...prev, { ...EMPTY_ITEM }]);
  };

  const handleRemoveItem = (index: number) => {
    setItems((prev) => prev.filter((_, i) => i !== index));
  };

  const isFormValid = () => {
    if (!orderId.trim()) return false;
    if (items.length === 0) return false;

    for (const item of items) {
      if (!item.sku.trim()) return false;
      if (item.price <= 0) return false;
      if (item.quantity <= 0) return false;
    }

    return true;
  };

  const handleSubmit = async (event: FormEvent) => {
    event.preventDefault();
    setError(null);
    setResult(null);

    if (!isFormValid()) {
      setError("Revisa los campos: precio y cantidad deben ser > 0.");
      return;
    }

    const payload: OrderRequest = {
      orderId,
      items,
      discountCode,
    };

    try {
      setLoading(true);
      const response = await calculateOrder(payload);
      setResult(response);
    } catch (err) {
      console.error(err);
      setError("Ocurrió un error al calcular la orden.");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="order-form">
      <h1 className="order-form__title">Calculadora de Orden</h1>

      <form onSubmit={handleSubmit} className="order-form__body">
        {/* Order ID */}
        <div className="order-form__field">
          <label htmlFor="orderId">Order ID</label>
          <input
            id="orderId"
            type="text"
            value={orderId}
            onChange={(e) => setOrderId(e.target.value)}
            placeholder="Ej: 123"
          />
        </div>

        {/* Items */}
        <div className="order-form__section">
          <div className="order-form__section-header">
            <h2>Items</h2>
            <button
              type="button"
              className="order-form__add-button"
              onClick={handleAddItem}
            >
              + Add item
            </button>
          </div>

          <div className="order-form__items">
            {items.map((item, index) => (
              <div className="order-form__item-row" key={index}>
                <div className="order-form__field">
                  <label>SKU</label>
                  <input
                    type="text"
                    value={item.sku}
                    onChange={(e) =>
                      handleItemChange(index, "sku", e.target.value)
                    }
                    placeholder="A01"
                  />
                </div>

                <div className="order-form__field">
                  <label>Price</label>
                  <input
                    type="number"
                    min={0}
                    step={0.01}
                    value={item.price}
                    onChange={(e) =>
                      handleItemChange(index, "price", e.target.value)
                    }
                    placeholder="100"
                  />
                </div>

                <div className="order-form__field">
                  <label>Quantity</label>
                  <input
                    type="number"
                    min={1}
                    value={item.quantity}
                    onChange={(e) =>
                      handleItemChange(index, "quantity", e.target.value)
                    }
                    placeholder="1"
                  />
                </div>

                {items.length > 1 && (
                  <button
                    type="button"
                    className="order-form__remove-button"
                    onClick={() => handleRemoveItem(index)}
                  >
                    ✕
                  </button>
                )}
              </div>
            ))}
          </div>
        </div>

        {/* Discount code */}
        <div className="order-form__field">
          <label htmlFor="discountCode">Discount code</label>
          <select
            id="discountCode"
            value={discountCode}
            onChange={(e) => setDiscountCode(e.target.value as DiscountCode)}
          >
            <option value="NONE">NONE</option>
            <option value="PROMO10">PROMO10</option>
            <option value="FREESHIP">FREESHIP</option>
          </select>
        </div>

      
        <button
          type="submit"
          className="order-form__submit"
          disabled={loading || !isFormValid()}
        >
          {loading ? "Calculando..." : "Calcular"}
        </button>
      </form>

      
      <OrderSummary result={result} error={error} loading={loading} />
    </div>
  );
}
