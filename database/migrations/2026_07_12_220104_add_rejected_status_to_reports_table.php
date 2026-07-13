<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; // Hapus angka 5 di sini jadi 'Support' saja

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->enum('status', ['pending', 'forwarded', 'process', 'resolved', 'rejected'])
                  ->default('pending')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->enum('status', ['pending', 'forwarded', 'process', 'resolved'])
                  ->default('pending')
                  ->change();
        });
    }
};