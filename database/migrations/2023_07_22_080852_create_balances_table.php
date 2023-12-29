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
        Schema::create('balance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_sale_id')->nullable()->constrained('material_sales', 'id')->nullOnDelete();
            $table->foreignId('sale_id')->nullable()->constrained('sales', 'id')->nullOnDelete();
            $table->foreignId('create_by')->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->enum('type', ['in', 'out']);
            $table->decimal('amount', 19, 2);
            $table->date('record_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balance');
    }
};
