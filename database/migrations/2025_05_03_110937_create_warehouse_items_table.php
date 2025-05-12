<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_warehouse_items_table.php
public function up()
{
    Schema::create('warehouse_items', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100);
        $table->text('description')->nullable();
        $table->integer('quantity');
        $table->decimal('price', 10, 2);
        $table->timestamp('date_added')->useCurrent();
        $table->timestamps(); // Adds created_at and updated_at columns
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_items');
    }
};
