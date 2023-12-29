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
        Schema::create('material_sales_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_sale_id')->nullable()->constrained('material_sales', 'id')->nullOnDelete();
            $table->foreignId('material_id')->nullable()->constrained('material', 'id')->nullOnDelete();
            $table->foreignId('material_stock_log_id')->nullable()->constrained('material_stock_log', 'id')->nullOnDelete();
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
        Schema::dropIfExists('material_sales_detail');
    }
};
