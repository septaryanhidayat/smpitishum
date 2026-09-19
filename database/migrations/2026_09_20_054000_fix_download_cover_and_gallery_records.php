<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('downloads')
            ->where('cover_image', '/uploads/covers/cover-karakter-siswa.webp')
            ->orWhere('cover_image', 'uploads/covers/cover-karakter-siswa.webp')
            ->update(['cover_image' => '/uploads/covers/cover-karakter-santri.webp']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
