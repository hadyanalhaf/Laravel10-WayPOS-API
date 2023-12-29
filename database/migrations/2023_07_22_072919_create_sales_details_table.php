<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->nullable()->constrained('sales', 'id')->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained('product', 'id')->nullOnDelete();
            $table->decimal('price', 19, 2);
            $table->decimal('quantity');
            $table->decimal('discount', 19, 2)->nullable();
            $table->decimal('sub_total', 19, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_detail');
    }
};
