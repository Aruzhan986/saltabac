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
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('purchase_id');
            $table->unsignedBigInteger('item_id')->index();
            $table->unsignedBigInteger('customer_id')->index();
            $table->timestamp('purchase_date');
            $table->timestamps();
            $table->softDeletes();
        
            $table->foreign('item_id')->references('item_id')->on('items');
            $table->foreign('customer_id')->references('customer_id')->on('customers');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
