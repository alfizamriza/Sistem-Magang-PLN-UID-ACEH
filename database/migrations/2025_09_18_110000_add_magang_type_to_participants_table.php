<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->string('magang_type')->nullable()->after('university');
            $table->string('other_magang')->nullable()->after('magang_type');
        });
    }

    public function down()
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn(['magang_type', 'other_magang']);
        });
    }
};
