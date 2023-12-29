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
        Schema::create('material_stock_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->nullable()->constrained('unit', 'id')->nullOnDelete(); // Unit
            $table->foreignId('material_id')->constrained('material', 'id')->cascadeOnDelete(); // Material
            $table->string('description');
            $table->enum('type', ['in', 'out']);
            $table->decimal('quantity');
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
        Schema::dropIfExists('material_stock_log');
    }
};
