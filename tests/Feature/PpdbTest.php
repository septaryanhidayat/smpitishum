<?php

use App\Models\PpdbRegistration;
use Illuminate\Http\UploadedFile;

test('spmb redirect and ppdb index load successfully', function () {
    $this->get('/spmb')->assertRedirect(route('ppdb.index'));

    $response = $this->get('/ppdb');
    $response->assertStatus(200);
});

test('ppdb form page loads with 200', function () {
    $response = $this->get('/form_ppdb');
    $response->assertStatus(200);
});

test('submitting ppdb registration successfully creates record and redirects', function () {
    $payload = [
        'wave' => 'Gelombang 1 (Early Bird)',
        'track' => 'Jalur Reguler / Tes Mandiri',
        'program_type' => 'Boarding School (Asrama Siswa)',
        'full_name' => 'Ahmad Fulan',
        'birth_place' => 'Prabumulih',
        'birth_date' => '2012-05-15',
        'gender' => 'Laki-laki',
        'address' => 'Jl. Jenderal Sudirman No. 123, Prabumulih',
        'living_with' => 'Orang Tua',
        'child_order' => 1,
        'siblings_count' => 2,
        'previous_school' => 'SD IT Ishlahul Ummah',
        'nisn' => '0123456789',
        'hobby' => 'Membaca',
        'favorite_subject' => 'Matematika',
        'ambition' => 'Dokter',
        'achievements' => 'Juara 1 Lomba Tahfidz',
        'phone' => '081234567890',

        'father_name' => 'Fulan Senior',
        'father_birth_place' => 'Palembang',
        'father_birth_date' => '1980-01-01',
        'father_address' => 'Jl. Jenderal Sudirman No. 123, Prabumulih',
        'father_education' => 'Sarjana (S1)',
        'father_job' => 'Wiraswasta / Pengusaha',
        'father_income' => 'Rp 5.000.000 - Rp 10.000.000',
        'father_phone' => '081234567891',

        'mother_name' => 'Fulanah',
        'mother_birth_place' => 'Prabumulih',
        'mother_birth_date' => '1982-02-02',
        'mother_address' => 'Jl. Jenderal Sudirman No. 123, Prabumulih',
        'mother_education' => 'Sarjana (S1)',
        'mother_job' => 'Ibu Rumah Tangga',
        'mother_income' => 'Tidak Berpenghasilan',
        'mother_phone' => '081234567892',

        'birth_certificate' => UploadedFile::fake()->image('akta.jpg', 600, 800),
        'payment_proof' => UploadedFile::fake()->create('bukti_bayar.pdf', 300, 'application/pdf'),
    ];

    $response = $this->post('/form_ppdb', $payload);

    $response->assertSessionHasNoErrors();
    $this->assertDatabaseHas('ppdb_registrations', [
        'full_name' => 'Ahmad Fulan',
        'phone' => '081234567890',
    ]);

    $registration = PpdbRegistration::where('full_name', 'Ahmad Fulan')->first();
    expect($registration)->not->toBeNull();
    $response->assertRedirect(route('ppdb.success', ['reg' => $registration->registration_number]));
});

test('submitting ppdb registration via ajax returns json success and redirect url', function () {
    $payload = [
        'wave' => 'Gelombang 1 (Early Bird)',
        'track' => 'Jalur Reguler / Tes Mandiri',
        'program_type' => 'Boarding School (Asrama Siswa)',
        'full_name' => 'Fatimah Az-Zahra',
        'birth_place' => 'Prabumulih',
        'birth_date' => '2012-08-20',
        'gender' => 'Perempuan',
        'address' => 'Jl. Anggrek No. 45',
        'living_with' => 'Orang Tua',
        'child_order' => 2,
        'siblings_count' => 3,
        'previous_school' => 'SD IT Ishlahul Ummah 2',
        'phone' => '089876543210',

        'father_name' => 'Abdullah',
        'father_birth_place' => 'Prabumulih',
        'father_birth_date' => '1978-03-10',
        'father_address' => 'Jl. Anggrek No. 45',
        'father_education' => 'Sarjana (S1)',
        'father_job' => 'PNS / Polisi / TNI',
        'father_income' => 'Rp 5.000.000 - Rp 10.000.000',

        'mother_name' => 'Aminah',
        'mother_birth_place' => 'Prabumulih',
        'mother_birth_date' => '1981-05-12',
        'mother_address' => 'Jl. Anggrek No. 45',
        'mother_education' => 'Sarjana (S1)',
        'mother_job' => 'Guru / Dosen',
        'mother_income' => 'Rp 3.000.000 - Rp 5.000.000',

        'birth_certificate' => UploadedFile::fake()->image('akta.webp', 800, 600),
        'payment_proof' => UploadedFile::fake()->image('bukti.webp', 800, 600),
    ];

    $response = $this->postJson('/form_ppdb', $payload);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
        ])
        ->assertJsonStructure([
            'success',
            'redirect_url',
            'reg_number',
            'message',
        ]);

    $this->assertDatabaseHas('ppdb_registrations', [
        'full_name' => 'Fatimah Az-Zahra',
    ]);
});

test('ppdb registration validation fails when required fields are missing', function () {
    $response = $this->postJson('/form_ppdb', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['full_name', 'birth_certificate', 'payment_proof']);
});
