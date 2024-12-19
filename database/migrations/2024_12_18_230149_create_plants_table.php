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
        Schema::create('plants', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Plant name
            $table->text('description'); // Plant description
            $table->json('pictures'); // Pictures stored as a JSON array
            $table->string('caredifficulty'); // Difficulty level
            $table->text('caretips'); // Care tips
            $table->timestamps(); // Created_at and Updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
