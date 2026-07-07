<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoordinatesToReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $blueprint) {
            $blueprint->string('latitude')->nullable()->after('description');
            $blueprint->string('longitude')->nullable()->after('latitude');
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $blueprint) {
            $blueprint->dropColumn(['latitude', 'longitude']);
        });
    }
}