<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ModulSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        $data = [];

        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'judul_modul' => $faker->sentence(1),
                'jumlah_cetak' => $faker->numberBetween(100, 250),
                'tanggal_request' => $faker->date,
                'id_anggota_request' => '1',
                'asal_prodi' => 'Akutansi Perpajakan'
            ];
        }

        // Menggunakan Query Builder
        $this->db->table('modul')->insertBatch($data);
    }
}
