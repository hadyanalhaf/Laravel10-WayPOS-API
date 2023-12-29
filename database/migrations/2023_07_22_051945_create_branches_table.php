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
        Schema::create('branch', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained('partner', 'id')->onDelete('cascade'); // partner_id
            $table->string('branch_name');
            $table->time('open_time', 0);
            $table->time('close_time', 0);
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('long', 10, 8)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamp('activated_at', 0)->nullable();
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
        Schema::dropIfExists('branch');
    }
};
