<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateOrderRequest;
use App\Services\OrderCalculator;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    protected OrderCalculator $calculator;

    public function __construct(OrderCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * POST /api/orders/calculate
     */
    public function calculate(CalculateOrderRequest $request): JsonResponse
    {
        // Datos ya validados por CalculateOrderRequest
        $data = $request->validated();

        // Lógica de negocio en el servicio
        $result = $this->calculator->calculate($data);

        return response()->json($result);
    }
}
