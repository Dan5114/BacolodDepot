@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        <h2>Welcome to the Warehouse Management System</h2>
        <p>You are logged in as {{ auth()->user()->username }}.</p>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Inventory Management</h5>
                        <p class="card-text">Manage warehouse items, check stock levels, and update inventory.</p>
                        <a href="{{ route('warehouse.index') }}" class="btn btn-primary">View Inventory</a>
                    </div>
                </div>
            </div>

            @if(auth()->user()->role === 'admin')
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Admin Controls</h5>
                        <p class="card-text">Access administrative controls and user management.</p>
                        <a href="#" class="btn btn-warning">Admin Panel</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection