<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryDataRequest;
use App\Services\CategoryManagementService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    private $categoryManager;

    public function __construct(CategoryManagementService $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->categoryManager->retrieveAll(), 200);
    }

    public function show($id): JsonResponse
    {
        $category = $this->categoryManager->find($id);
        return $category ? response()->json($category, 200) : response()->json(['message' => 'Not Found'], 404);
    }

    public function store(CategoryDataRequest $request): JsonResponse
    {
        return response()->json($this->categoryManager->create($request->all()), 201);
    }

    public function update(CategoryDataRequest $request, $id): JsonResponse
    {
        $result = $this->categoryManager->modify($request->all(), $id);
        return $result ? response()->json($result, 200) : response()->json(['error' => 'Not Found'], 404);
    }

    public function destroy($id): JsonResponse
    {
        return $this->categoryManager->remove($id) ? response()->json(['message' => 'Deleted'], 200) : response()->json(['message' => 'Not Found'], 404);
    }

    public function trashed(): JsonResponse
    {
        return response()->json($this->categoryManager->getTrashed(), 200);
    }

    public function restore($id): JsonResponse
    {
        return $this->categoryManager->recover($id) ? response()->json(['message' => 'Restored'], 200) : response()->json(['message' => 'Not Found'], 404);
    }

    public function forceDelete($id): JsonResponse
    {
        return $this->categoryManager->forceRemove($id) ? response()->json(['message' => 'Permanently Deleted'], 200) : response()->json(['message' => 'Not Found'], 404);
    }
}

