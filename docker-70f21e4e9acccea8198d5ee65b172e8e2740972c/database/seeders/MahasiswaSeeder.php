<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('mahasiswa')->insert([
           'id'=> Uuid::uuid4(),
           'nim' => '10511148',
            'nama' => 'Dimas Maryanto',
            'email' => 'software.dimas_m@icloud.com',
            'semester' => 5
        ]);
    }
}
