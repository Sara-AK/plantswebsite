<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('role_requests', function (Blueprint $table) {
            $table->text('request_note')->nullable()->after('requested_role'); // Allow text input
            $table->string('cv_file')->nullable()->after('request_note'); // Store CV file path
        });
    }

    public function down()
    {
        Schema::table('role_requests', function (Blueprint $table) {
            $table->dropColumn(['request_note', 'cv_file']);
        });
    }

};
