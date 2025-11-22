// src/types/order.ts

export type DiscountCode = 'PROMO10' | 'FREESHIP' | 'NONE';

export interface OrderItem {
  sku: string;
  price: number;
  quantity: number;
}

export interface OrderRequest {
  orderId: string;
  items: OrderItem[];
  discountCode?: DiscountCode | null;
}

export interface OrderResponse {
  orderId: string;
  subtotal: number;
  discount: number;
  tax: number;
  total: number;
}
