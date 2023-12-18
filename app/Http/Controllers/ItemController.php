<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Services\ItemService;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index()
    {
        $items = $this->itemService->getAllItems();
        return response()->json($items, 200);
    }

    public function store(ItemRequest $request)
    {
        $item = $this->itemService->createItem($request->all());
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = $this->itemService->getItemById($id);
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }
        return response()->json($item, 200);
    }

    public function update(ItemRequest $request, $id)
    {
        $item = $this->itemService->updateItem($request->all(), $id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        $item = $this->itemService->deleteItem($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        return response()->json(['message' => 'Item deleted'], 200);
    }
}

