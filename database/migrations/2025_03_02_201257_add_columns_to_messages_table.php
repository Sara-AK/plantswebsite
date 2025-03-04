<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('sender_id')->after('id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->after('sender_id')->constrained('users')->onDelete('cascade');
            $table->text('message')->after('receiver_id');
        });
    }

    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['sender_id']);
            $table->dropForeign(['receiver_id']);
            $table->dropColumn(['sender_id', 'receiver_id', 'message']);
        });
    }
};
