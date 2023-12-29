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
        Schema::create('branch_category', function (Blueprint $table) {
            $table->foreignId('branch_id')->constrained('branch', 'id')->cascadeOnDelete(); // branch
            $table->foreignId('category_id')->constrained('category', 'id')->cascadeOnDelete(); // category
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_category');
    }
};
