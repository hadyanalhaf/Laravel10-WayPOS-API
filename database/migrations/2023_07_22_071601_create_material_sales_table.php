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
        Schema::create('material_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cashier_id')->nullable()->constrained('users', 'id')->nullOnDelete(); // Cashier
            $table->foreignId('branch_id')->nullable()->constrained('branch', 'id')->nullOnDelete(); // Branch (Buyer)
            $table->string('sales_code')->unique();
            $table->decimal('amount', 19, 2);
            $table->decimal('discount', 19, 2)->nullable();
            $table->decimal('pay', 19, 2);
            $table->decimal('return', 19, 2);
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
        Schema::dropIfExists('material_sales');
    }
};
