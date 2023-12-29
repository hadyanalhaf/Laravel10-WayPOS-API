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
        Schema::create('material', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('category', 'id')->nullOnDelete(); // category
            $table->foreignId('main_unit_id')->nullable()->constrained('material', 'id')->nullOnDelete(); // default_unit
            $table->string('name');
            $table->string('photo');
            $table->decimal('quantity');
            $table->decimal('price', 19, 2);
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
        Schema::dropIfExists('material');
    }
};
