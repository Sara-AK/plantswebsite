<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('plant_region', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('plant_id'); // Foreign key to plants table
            $table->unsignedBigInteger('region_id'); // Foreign key to regions table

            // Foreign key constraints
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_region');
    }
};
