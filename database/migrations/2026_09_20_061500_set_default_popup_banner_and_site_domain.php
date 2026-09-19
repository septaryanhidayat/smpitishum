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
        $settings = [
            'site_domain' => ['value' => 'smpitishumpbm.sch.id', 'group' => 'general'],
            'popup_active' => ['value' => '1', 'group' => 'popup'],
            'popup_image' => ['value' => '/uploads/flyer-spmb-smpit-ishum.webp', 'group' => 'popup'],
            'popup_title' => ['value' => 'Telah Dibuka SPMB 3T (TP 2027/2028)', 'group' => 'popup'],
            'popup_subtitle' => ['value' => 'Sistem Penerimaan Murid Baru SMPS IT Ishlahul Ummah Prabumulih', 'group' => 'popup'],
            'popup_link' => ['value' => '/ppdb', 'group' => 'popup'],
            'popup_button_text' => ['value' => 'Info & Syarat SPMB', 'group' => 'popup'],
            'popup_target' => ['value' => '_self', 'group' => 'popup'],
        ];

        foreach ($settings as $key => $data) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $data['value'], 'group' => $data['group'], 'updated_at' => now()]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
