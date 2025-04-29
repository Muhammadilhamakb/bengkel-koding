<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPeriksasTable extends Migration
{
    public function up(): void
{
    Schema::table('periksas', function (Blueprint $table) {
        // Menambahkan kolom 'status' pada tabel periksas
        $table->string('status')->default('pending');  // Default 'pending'
    });
}

public function down(): void
{
    Schema::table('periksas', function (Blueprint $table) {
        // Menghapus kolom 'status' jika migrasi di-rollback
        $table->dropColumn('status');
    });
}
}
