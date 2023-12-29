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
        Schema::create('unit_conversion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_id')->constrained('unit', 'id')->cascadeOnDelete();
            $table->foreignId('result_id')->constrained('unit', 'id')->cascadeOnDelete();
            $table->decimal('factor');
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
        Schema::dropIfExists('unit_conversion');
    }
};
