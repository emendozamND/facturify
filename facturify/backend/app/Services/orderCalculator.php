<?php
namespace App\Services;
class OrderCalculator
{
    public function calculate(array $data): array
    {
        $items = $data['items'] ?? [];
        $discountCode = $data['discountCode'] ?? null;
        // 1. Subtotal = suma de price * quantity
        $subtotal = collect($items)->reduce(function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
        // 2. IVA = 16% del subtotal
        $tax = round($subtotal * 0.16, 2);
        // 3. Descuentos según código
        $discount = 0;
        switch ($discountCode) {
            case 'PROMO10':
                $discount = round($subtotal * 0.10, 2);
                break;
            case 'FREESHIP':
                $discount = 50;
                break;
            case 'NONE':
            case null:
            default:
                $discount = 0;
                break;
        }
        // 4. Total = subtotal - discount + tax
        $total = $subtotal - $discount + $tax;
        return [
            'orderId'  => $data['orderId'],
            'subtotal' => $subtotal,
            'discount' => $discount,
            'tax'      => $tax,
            'total'    => $total,
        ];
    }
}