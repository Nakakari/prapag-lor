<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserSeeder::class);
        $this->call(RtRwSeeder::class);
        $this->call(JenisKelaminSeeder::class);
        $this->call([
            JenisGolonganDarahSeeder::class,
            JenisAgamaSeeder::class,
            JenisPendidikanSeeder::class,
            JenisStatusMaritalSeeder::class,
            JenisMasterPekerjaanSeeder::class,
            JenisStatusRelationSeeder::class,
        ]);
    }
}
