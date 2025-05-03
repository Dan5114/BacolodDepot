<?php

namespace App\Providers;

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    // Other methods and properties...
    
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        // Other boot code...
        
        // Register your middleware
        Route::middleware('admin', AdminMiddleware::class);
        
        // Rest of boot method...
    }
}