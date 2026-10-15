<?php

use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->admin = User::firstOrCreate(
        ['email' => 'admin_test@smpitishum.sch.id'],
        [
            'name' => 'Admin Test Video',
            'password' => Hash::make('Secret12345!'),
            'role' => 'super_admin',
        ]
    );
});

test('video model extracts youtube id from various url formats including shorts and live', function () {
    expect(Video::extractYoutubeId('https://www.youtube.com/watch?v=dQw4w9WgXcQ'))->toBe('dQw4w9WgXcQ');
    expect(Video::extractYoutubeId('https://www.youtube.com/watch?v=dQw4w9WgXcQ&t=15s'))->toBe('dQw4w9WgXcQ');
    expect(Video::extractYoutubeId('https://youtu.be/dQw4w9WgXcQ'))->toBe('dQw4w9WgXcQ');
    expect(Video::extractYoutubeId('https://youtu.be/dQw4w9WgXcQ?si=abcd1234'))->toBe('dQw4w9WgXcQ');
    expect(Video::extractYoutubeId('https://www.youtube.com/shorts/dQw4w9WgXcQ'))->toBe('dQw4w9WgXcQ');
    expect(Video::extractYoutubeId('https://youtube.com/shorts/dQw4w9WgXcQ?feature=share'))->toBe('dQw4w9WgXcQ');
    expect(Video::extractYoutubeId('https://www.youtube.com/live/dQw4w9WgXcQ'))->toBe('dQw4w9WgXcQ');
    expect(Video::extractYoutubeId('https://www.youtube.com/embed/dQw4w9WgXcQ'))->toBe('dQw4w9WgXcQ');
    expect(Video::extractYoutubeId('youtube.com/watch?v=dQw4w9WgXcQ'))->toBe('dQw4w9WgXcQ');
    expect(Video::extractYoutubeId('dQw4w9WgXcQ'))->toBe('dQw4w9WgXcQ');
    expect(Video::extractYoutubeId('<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ"></iframe>'))->toBe('dQw4w9WgXcQ');
    expect(Video::extractYoutubeId('https://google.com/search?q=video'))->toBeNull();
});

test('admin can view media gallery page with video list', function () {
    $this->actingAs($this->admin);

    $response = $this->get(route('admin.media.index'));
    $response->assertStatus(200);
    $response->assertSee('Video YouTube Resmi');
    $response->assertSee('Tambah Video');
});

test('admin can store new video with standard url and shorts url', function () {
    $this->actingAs($this->admin);

    // 1. Standard YouTube URL
    $response1 = $this->post(route('admin.media.video.store'), [
        'title' => 'Video Profil Siswa Baru',
        'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        'description' => 'Liputan profil sekolah dan siswa baru.',
    ]);

    $response1->assertRedirect();
    $this->assertDatabaseHas('videos', [
        'title' => 'Video Profil Siswa Baru',
        'youtube_id' => 'dQw4w9WgXcQ',
    ]);

    // 2. YouTube Shorts URL
    $response2 = $this->post(route('admin.media.video.store'), [
        'title' => 'Shorts Kegiatan Tahfidz Siswa',
        'youtube_url' => 'https://www.youtube.com/shorts/sBS7nP9bb1Q',
        'description' => 'Momen tasmi Al-Quran santri.',
    ]);

    $response2->assertRedirect();
    $this->assertDatabaseHas('videos', [
        'title' => 'Shorts Kegiatan Tahfidz Siswa',
        'youtube_id' => 'sBS7nP9bb1Q',
    ]);
});

test('admin cannot store video with invalid youtube url', function () {
    $this->actingAs($this->admin);

    $response = $this->post(route('admin.media.video.store'), [
        'title' => 'Video Invalid Link',
        'youtube_url' => 'https://facebook.com/not-a-youtube-video',
    ]);

    $response->assertSessionHasErrors(['youtube_url']);
});

test('admin can update video details and youtube url', function () {
    $this->actingAs($this->admin);

    $video = Video::create([
        'title' => 'Video Sebelum Update',
        'slug' => 'video-sebelum-update',
        'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        'youtube_id' => 'dQw4w9WgXcQ',
        'description' => 'Deskripsi lama.',
    ]);

    $response = $this->put(route('admin.media.video.update', $video), [
        'title' => 'Video Setelah Diperbarui',
        'youtube_url' => 'https://youtu.be/_ltiwpOmK1k',
        'description' => 'Deskripsi baru yang diperbarui.',
    ]);

    $response->assertRedirect();
    $video->refresh();

    expect($video->title)->toBe('Video Setelah Diperbarui');
    expect($video->youtube_id)->toBe('_ltiwpOmK1k');
    expect($video->description)->toBe('Deskripsi baru yang diperbarui.');
});

test('admin can delete a video', function () {
    $this->actingAs($this->admin);

    $video = Video::create([
        'title' => 'Video Yang Akan Dihapus',
        'slug' => 'video-yang-akan-dihapus',
        'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        'youtube_id' => 'dQw4w9WgXcQ',
    ]);

    $response = $this->delete(route('admin.media.video.destroy', $video));
    $response->assertRedirect();

    $this->assertDatabaseMissing('videos', [
        'id' => $video->id,
    ]);
});

test('frontend video gallery page renders videos properly', function () {
    $response = $this->get(route('video.index'));
    $response->assertStatus(200);
    $response->assertSee('Galeri Video');
});
