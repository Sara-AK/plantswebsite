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
        Schema::create('plant_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2); // Maximum 999,999.99
            $table->string('picture')->nullable(); // Stores the file path
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plant_products');
    }

};
