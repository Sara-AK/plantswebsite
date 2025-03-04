<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('plantproducts', function (Blueprint $table) {
            $table->json('pictures')->nullable()->after('price'); // Adding 'pictures' column
        });
    }

    public function down()
    {
        Schema::table('plantproducts', function (Blueprint $table) {
            $table->dropColumn('pictures');
        });
    }

};
