<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageSuccessToReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $blueprint) {
            $blueprint->string('image_success')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $blueprint) {
            $blueprint->dropColumn('image_success');
        });
    }
}