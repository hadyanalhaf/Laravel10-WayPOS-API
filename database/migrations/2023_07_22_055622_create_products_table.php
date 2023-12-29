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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('category', 'id')->nullOnDelete(); // category_id
            $table->foreignId('main_unit_id')->nullable()->constrained('unit', 'id')->nullOnDelete(); // main_unit_id
            $table->string('name');
            $table->string('photo');
            $table->decimal('quantity');
            $table->decimal('price', 19, 2);
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
        Schema::dropIfExists('product');
    }
};
