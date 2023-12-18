<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Services\PurchaseService;
use Illuminate\Http\JsonResponse;

class PurchaseController extends Controller
{
    private $purchaseService;

    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->purchaseService->retrieveAll(), 200);
    }

    public function show($id): JsonResponse
    {
        $purchase = $this->purchaseService->find($id);
        return $purchase ? response()->json($purchase) : response()->json(['message' => 'Not Found'], 404);
    }

    public function store(PurchaseRequest $request): JsonResponse
    {
        return response()->json($this->purchaseService->create($request->validated()), 201);
    }

    public function update(PurchaseRequest $request, $id): JsonResponse
    {
        $result = $this->purchaseService->modify($request->validated(), $id);
        return $result ? response()->json($result) : response()->json(['message' => 'Not Found'], 404);
    }

    public function destroy($id): JsonResponse
    {
        return $this->purchaseService->remove($id) ? response()->json(null, 204) : response()->json(['message' => 'Not Found'], 404);
    }
}
