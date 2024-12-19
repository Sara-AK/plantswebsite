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
        Schema::create('category_plant', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('plant_id'); // Foreign key to plants table
            $table->unsignedBigInteger('plantcategory_id'); // Foreign key to plantcategories table

            // Foreign key constraints
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
            $table->foreign('plantcategory_id')->references('id')->on('plantcategories')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_plant');
    }
};
