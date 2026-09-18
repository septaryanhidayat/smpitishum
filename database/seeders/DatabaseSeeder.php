<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'admin@smpitishum.sch.id'],
            [
                'name' => 'Admin SMPS IT Ishlahul Ummah Prabumulih',
                'password' => bcrypt('AdminIshum2026!'),
                'role' => 'admin',
            ]
        );

        $this->call([
            SchoolDataSeeder::class,
        ]);
    }
}
