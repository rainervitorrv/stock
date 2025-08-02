<?php

use App\Models\MovementCategory;
use App\Models\ProductCategory;
use App\Models\ProductUnit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('cost_price', 10, 2);
            $table->string('barcode')->unique();
            $table->string('sku')->unique()->nullable();
            $table->foreignIdFor(ProductCategory::class, 'category_id');
            $table->foreignIdFor(ProductUnit::class, 'unit_id');
            $table->integer('stock')->default(0);
            $table->integer('min_stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
