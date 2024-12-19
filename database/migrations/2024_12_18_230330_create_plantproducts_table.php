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
        Schema::create('plantproducts', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Product name
            $table->text('description'); // Product description
            $table->decimal('price', 8, 2); // Price with two decimal places
            $table->unsignedBigInteger('plant_id')->nullable(); // Foreign key to plants table
            $table->timestamps(); // Created_at and Updated_at

            // Define foreign key constraint
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantproducts');
    }
};
