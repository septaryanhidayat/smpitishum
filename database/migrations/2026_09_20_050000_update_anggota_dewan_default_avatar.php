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
        DB::table('anggota_dewans')
            ->whereIn('photo', [
                '/uploads/dewan/avatar-ustadz.svg',
                '/uploads/dewan/avatar-ustadzah.svg',
                'uploads/dewan/avatar-ustadz.svg',
                'uploads/dewan/avatar-ustadzah.svg',
            ])
            ->update(['photo' => '/uploads/dewan/avatar-default.svg']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Keep neutral avatar
    }
};
