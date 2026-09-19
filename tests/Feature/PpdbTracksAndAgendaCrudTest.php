<?php

use App\Models\Agenda;
use App\Models\Pengumuman;
use App\Models\PpdbTrack;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('admin can create, update, and delete dynamic ppdb tracks', function () {
    $admin = User::create([
        'name' => 'Admin PPDB Track',
        'email' => 'admin_track@ishum.sch.id',
        'password' => Hash::make('Password123!'),
        'role' => 'admin',
    ]);

    // 1. Create a new track
    $createResponse = $this->actingAs($admin)->post(route('admin.ppdb.tracks.store'), [
        'name' => 'Jalur First Brive',
        'percentage' => '10%',
        'quota' => '10 Siswa',
        'cashback_info' => 'Diskon 10% Formulir',
        'description' => 'Jalur pendaftaran khusus Early Bird.',
        'is_active' => '1',
    ]);

    $createResponse->assertRedirect(route('admin.ppdb.content', ['tab' => 'jalur']));
    $createResponse->assertSessionHas('success');

    $track = PpdbTrack::where('name', 'Jalur First Brive')->first();
    expect($track)->not->toBeNull();
    expect($track->percentage)->toBe('10%');
    expect($track->is_active)->toBeTrue();

    // 2. Update track
    $updateResponse = $this->actingAs($admin)->put(route('admin.ppdb.tracks.update', $track), [
        'name' => 'Jalur First Brive Updated',
        'percentage' => '12%',
        'quota' => '15 Siswa',
        'cashback_info' => 'Diskon 12% Formulir',
        'description' => 'Jalur khusus diperbarui.',
        'is_active' => '1',
    ]);

    $updateResponse->assertRedirect(route('admin.ppdb.content', ['tab' => 'jalur']));
    $track->refresh();
    expect($track->name)->toBe('Jalur First Brive Updated');
    expect($track->percentage)->toBe('12%');

    // 3. Frontend PPDB index displays the track
    $frontendResponse = $this->get(route('ppdb.index'));
    $frontendResponse->assertStatus(200);
    $frontendResponse->assertSee('Jalur First Brive Updated');
    $frontendResponse->assertSee('12%');

    // 4. Delete track
    $deleteResponse = $this->actingAs($admin)->delete(route('admin.ppdb.tracks.destroy', $track));
    $deleteResponse->assertRedirect(route('admin.ppdb.content', ['tab' => 'jalur']));
    expect(PpdbTrack::find($track->id))->toBeNull();
});

test('admin can update agenda and pengumuman via PUT request', function () {
    $admin = User::create([
        'name' => 'Admin Agenda',
        'email' => 'admin_agenda@ishum.sch.id',
        'password' => Hash::make('Password123!'),
        'role' => 'admin',
    ]);

    // Create Agenda
    $agenda = Agenda::create([
        'title' => 'Agenda Original',
        'slug' => 'agenda-original',
        'location' => 'Kampus 1',
        'event_date' => now()->addDays(7),
        'status' => 'publish',
    ]);

    // Update Agenda
    $updateAgendaResponse = $this->actingAs($admin)->put(route('admin.agenda.update', $agenda), [
        'title' => 'Agenda Updated',
        'location' => 'Aula Utama Ishum',
        'event_date' => now()->addDays(10)->format('Y-m-d\TH:i'),
        'status' => 'publish',
        'content' => 'Deskripsi agenda diperbarui.',
    ]);

    $updateAgendaResponse->assertRedirect(route('admin.agenda.index'));
    $agenda->refresh();
    expect($agenda->title)->toBe('Agenda Updated');
    expect($agenda->location)->toBe('Aula Utama Ishum');

    // Create Pengumuman
    $pengumuman = Pengumuman::create([
        'title' => 'Pengumuman Original',
        'slug' => 'pengumuman-original',
        'content' => 'Isi pengumuman original.',
        'status' => 'publish',
    ]);

    // Update Pengumuman
    $updatePengumumanResponse = $this->actingAs($admin)->put(route('admin.pengumuman.update', $pengumuman), [
        'title' => 'Pengumuman Updated',
        'status' => 'publish',
        'content' => 'Isi pengumuman diperbarui.',
    ]);

    $updatePengumumanResponse->assertRedirect(route('admin.agenda.index'));
    $pengumuman->refresh();
    expect($pengumuman->title)->toBe('Pengumuman Updated');
    expect($pengumuman->content)->toBe('Isi pengumuman diperbarui.');
});

test('spmb banner is fully customizable and visible on homepage', function () {
    Setting::set('spmb_banner_title', 'SPMB Tahun Ini Dibuka Lebar', 'spmb');
    Setting::set('spmb_banner_card1_title', 'KUOTA SANGAT TERBATAS', 'spmb');
    Setting::set('spmb_banner_card1_desc', 'Hanya 15 Siswa', 'spmb');
    Setting::set('spmb_banner_card2_title', 'CASH BACK 2 JUTA', 'spmb');
    Setting::set('spmb_banner_card2_desc', 'Khusus Pendaftar Hari Ini', 'spmb');

    $homeResponse = $this->get(route('home'));
    $homeResponse->assertStatus(200);
    $homeResponse->assertSee('SPMB Tahun Ini Dibuka Lebar');
    $homeResponse->assertSee('KUOTA SANGAT TERBATAS');
    $homeResponse->assertSee('Hanya 15 Siswa');
    $homeResponse->assertSee('CASH BACK 2 JUTA');
    $homeResponse->assertSee('Khusus Pendaftar Hari Ini');
});
