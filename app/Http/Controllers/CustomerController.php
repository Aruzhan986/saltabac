<?php
namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->customerService->retrieveAll(), 200);
    }

    public function show($id): JsonResponse
    {
        $customer = $this->customerService->find($id);
        return $customer ? response()->json($customer, 200) : response()->json(['message' => 'Not Found'], 404);
    }

    public function store(CustomerRequest $request): JsonResponse
    {
        return response()->json($this->customerService->create($request->all()), 201);
    }

    public function update(CustomerRequest $request, $id): JsonResponse
    {
        $result = $this->customerService->modify($request->all(), $id);
        return $result ? response()->json($result, 200) : response()->json(['error' => 'Not Found'], 404);
    }

    public function destroy($id): JsonResponse
    {
        return $this->customerService->remove($id) ? response()->json(['message' => 'Deleted'], 200) : response()->json(['message' => 'Not Found'], 404);
    }

    public function restore($id): JsonResponse
    {
        return $this->customerService->recover($id) ? response()->json(['message' => 'Restored'], 200) : response()->json(['message' => 'Not Found'], 404);
    }
}

