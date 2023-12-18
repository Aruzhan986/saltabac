<?php

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
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('item_id');
            $table->string('item_name', 100)->index();
            $table->integer('stock_quantity');
            $table->decimal('unit_price', 15, 2);
            $table->unsignedBigInteger('product_category_id')->index();
            $table->timestamps();
            $table->softDeletes();
        
            $table->foreign('product_category_id')->references('category_id')->on('product_categories');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
