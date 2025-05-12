@extends('layouts.app')

@section('title', 'Warehouse Inventory')

@section('content')
    <div class="welcome-section">
        <h1>WAREHOUSE INVENTORY</h1>
    </div>
    
    <section class="search-section">
        <form method="GET" action="{{ route('warehouse.index') }}" class="search-form">
            <!-- Display username -->
            <div class="username-display">{{ strtoupper(Auth::user()->name) }}</div>

            <!-- Search Input Field -->
            <input type="text" name="search" class="form-control search-input" 
                placeholder="Search by Name or ID" 
                value="{{ request('search') }}">

            <!-- Add Item Button: Visible only for Admin -->
            @if (Auth::user()->role == 'admin')
                <a href="{{ route('warehouse.create') }}" class="btn btn-warning add-item-btn">Add</a>
            @endif

            <!-- Return Button -->
            <a href="{{ route('warehouse.index') }}" class="btn btn-secondary return-btn">Return</a>

            <!-- Logout Button -->
            <a href="#" class="btn btn-warning" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </form>
    </section>

    <!-- Flash messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    ID 
                    <a href="{{ route('warehouse.index', ['sort' => 'id', 'order' => ($sortColumn == 'id' && $sortOrder == 'ASC') ? 'DESC' : 'ASC', 'search' => request('search')]) }}">
                        <i class="fas fa-sort"></i>
                    </a>
                </th>
                <th>
                    Name 
                    <a href="{{ route('warehouse.index', ['sort' => 'name', 'order' => ($sortColumn == 'name' && $sortOrder == 'ASC') ? 'DESC' : 'ASC', 'search' => request('search')]) }}">
                        <i class="fas fa-sort"></i>
                    </a>
                </th>
                <th>Description</th>
                <th>
                    Quantity 
                    <a href="{{ route('warehouse.index', ['sort' => 'quantity', 'order' => ($sortColumn == 'quantity' && $sortOrder == 'ASC') ? 'DESC' : 'ASC', 'search' => request('search')]) }}">
                        <i class="fas fa-sort"></i>
                    </a>
                </th>
                <th>
                    Price 
                    <a href="{{ route('warehouse.index', ['sort' => 'price', 'order' => ($sortColumn == 'price' && $sortOrder == 'ASC') ? 'DESC' : 'ASC', 'search' => request('search')]) }}">
                        <i class="fas fa-sort"></i>
                    </a>
                </th>
                <th>
                    Date Added 
                    <a href="{{ route('warehouse.index', ['sort' => 'date_added', 'order' => ($sortColumn == 'date_added' && $sortOrder == 'ASC') ? 'DESC' : 'ASC', 'search' => request('search')]) }}">
                        <i class="fas fa-sort"></i>
                    </a>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (count($items) > 0)
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->date_added }}</td>
                        <td>
                            @if ($role == 'admin')
                                <a href="{{ route('warehouse.edit', $item) }}" class="btn btn-primary btn-sm">Edit</a> |
                                <form action="{{ route('warehouse.destroy', $item) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @else
                                <a href="{{ route('warehouse.checkout', $item) }}" class="btn btn-success btn-sm">Checkout</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center">No items found</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection