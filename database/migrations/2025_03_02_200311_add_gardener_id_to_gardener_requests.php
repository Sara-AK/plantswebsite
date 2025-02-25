<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('gardener_requests', function (Blueprint $table) {
            $table->foreignId('gardener_id')->nullable()->constrained('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('gardener_requests', function (Blueprint $table) {
            $table->dropForeign(['gardener_id']);
            $table->dropColumn('gardener_id');
        });
    }
};
