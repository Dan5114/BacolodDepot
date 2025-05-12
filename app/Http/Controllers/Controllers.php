<?php

namespace App\Http\Controllers;

use App\Models\WarehouseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseItemController extends Controller
{
    /**
     * Display a listing of the warehouse items.
     */
    public function index(Request $request)
    {
        // Get user role
        $role = Auth::user()->role;
        
        // Sort parameters
        $sortColumn = $request->input('sort', 'id');
        $sortOrder = $request->input('order', 'ASC');
        
        // Validate sort column to prevent SQL injection
        $validColumns = ['id', 'name', 'quantity', 'price', 'date_added'];
        if (!in_array($sortColumn, $validColumns)) {
            $sortColumn = 'id';
        }
        
        // Validate sort order
        if ($sortOrder !== 'ASC' && $sortOrder !== 'DESC') {
            $sortOrder = 'ASC';
        }
        
        // Build query with search and sorting
        $query = WarehouseItem::query();
        
        // Add search if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', $search . '%')
                  ->orWhere('id', 'like', $search . '%');
            });
        }
        
        // Add sorting
        $items = $query->orderBy($sortColumn, $sortOrder)->get();
        
        return view('warehouse.index', compact('items', 'role', 'sortColumn', 'sortOrder'));
    }

    /**
     * Show the form for creating a new item.
     */
    public function create()
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('warehouse.index')
                ->with('error', 'You do not have permission to add items.');
        }
        
        return view('warehouse.create');
    }

    /**
     * Store a newly created item in storage.
     */
    public function store(Request $request)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('warehouse.index')
                ->with('error', 'You do not have permission to add items.');
        }
        
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);
        
        // Create the item
        WarehouseItem::create($validated);
        
        return redirect()->route('warehouse.index')
            ->with('success', 'Item added successfully.');
    }

    /**
     * Show the form for editing the specified item.
     */
    public function edit(WarehouseItem $warehouseItem)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('warehouse.index')
                ->with('error', 'You do not have permission to edit items.');
        }
        
        return view('warehouse.edit', compact('warehouseItem'));
    }

    /**
     * Update the specified item in storage.
     */
    public function update(Request $request, WarehouseItem $warehouseItem)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('warehouse.index')
                ->with('error', 'You do not have permission to update items.');
        }
        
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);
        
        // Update the item
        $warehouseItem->update($validated);
        
        return redirect()->route('warehouse.index')
            ->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified item from storage.
     */
    public function destroy(WarehouseItem $warehouseItem)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('warehouse.index')
                ->with('error', 'You do not have permission to delete items.');
        }
        
        // Delete the item
        $warehouseItem->delete();
        
        return redirect()->route('warehouse.index')
            ->with('success', 'Item deleted successfully.');
    }

    /**
     * Show the checkout form for the specified item.
     */
    public function showCheckout(WarehouseItem $warehouseItem)
    {
        return view('warehouse.checkout', compact('warehouseItem'));
    }

    /**
     * Process the checkout for the specified item.
     */
    public function processCheckout(Request $request, WarehouseItem $warehouseItem)
    {
        // Validate the checkout quantity
        $validated = $request->validate([
            'checkout_quantity' => 'required|integer|min:1|max:' . $warehouseItem->quantity,
        ]);
        
        // Update the item quantity
        $warehouseItem->quantity -= $validated['checkout_quantity'];
        $warehouseItem->save();
        
        return redirect()->route('warehouse.index')
            ->with('success', 'Item checked out successfully.');
    }
}