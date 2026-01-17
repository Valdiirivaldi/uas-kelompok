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
    Schema::table('categories', function (Blueprint $table) {
        // Menambahkan kolom 'image' bertipe string, boleh kosong (nullable)
        // Diletakkan setelah kolom 'slug'
        $table->string('image')->nullable()->after('slug');
    });
}

public function down(): void
{
    Schema::table('categories', function (Blueprint $table) {
        // Instruksi untuk menghapus kolom 'image' jika migration di-rollback
        $table->dropColumn('image');
    });
}
};
