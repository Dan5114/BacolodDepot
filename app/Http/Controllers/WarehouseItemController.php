<?php

// app/Http/Controllers/WarehouseItemController.php
namespace App\Http\Controllers;

use App\Models\WarehouseItem;
use Illuminate\Http\Request;

class WarehouseItemController extends Controller
{
    public function index()
    {
        $items = WarehouseItem::all();
        return view('warehouse.index', compact('items'));
    }

    public function create()
    {
        return view('warehouse.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        WarehouseItem::create($validated);
        return redirect()->route('warehouse.index')->with('success', 'Item created successfully!');
    }

    public function show(WarehouseItem $warehouseItem)
    {
        return view('warehouse.show', compact('warehouseItem'));
    }

    public function edit(WarehouseItem $warehouseItem)
    {
        return view('warehouse.edit', compact('warehouseItem'));
    }

    public function update(Request $request, WarehouseItem $warehouseItem)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $warehouseItem->update($validated);
        return redirect()->route('warehouse.index')->with('success', 'Item updated successfully!');
    }

    public function destroy(WarehouseItem $warehouseItem)
    {
        $warehouseItem->delete();
        return redirect()->route('warehouse.index')->with('success', 'Item deleted successfully!');
    }
}
