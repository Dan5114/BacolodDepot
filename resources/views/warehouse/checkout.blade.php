@extends('layouts.app')

@section('title', 'Checkout Item')

@section('content')
    <div class="welcome-section">
        <h1>CHECKOUT ITEM</h1>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Checkout Item: {{ $warehouseItem->name }}</h2>
        </div>
        <div class="card-body">
            <div class="item-details mb-4">
                <p><strong>ID:</strong> {{ $warehouseItem->id }}</p>
                <p><strong>Description:</strong> {{ $warehouseItem->description }}</p>
                <p><strong>Available Quantity:</strong> {{ $warehouseItem->quantity }}</p>
                <p><strong>Price:</strong> ${{ number_format($warehouseItem->price, 2) }}</p>
            </div>

            <form action="{{ route('warehouse.process-checkout', $warehouseItem) }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="checkout_quantity" class="form-label">Checkout Quantity</label>
                    <input type="number" class="form-control @error('checkout_quantity') is-invalid @enderror" 
                           id="checkout_quantity" name="checkout_quantity" 
                           value="{{ old('checkout_quantity', 1) }}" 
                           min="1" max="{{ $warehouseItem->quantity }}" required>
                    @error('checkout_quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Confirm Checkout</button>
                    <a href="{{ route('warehouse.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection