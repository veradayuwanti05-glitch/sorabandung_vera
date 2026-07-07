<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('reports', function (Blueprint $table) {
        // Menambahkan kolom prioritas dengan nilai bawaan 'normal'
        $table->enum('priority', ['low', 'normal', 'urgent'])->default('normal')->after('status');
    });
}

public function down(): void
{
    Schema::table('reports', function (Blueprint $table) {
        $table->dropColumn('priority');
    });
}
};
