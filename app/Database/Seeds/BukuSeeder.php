<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class BukuSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $data = [];

        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'judul_buku' => $faker->sentence(3),
                'jenis_buku' => $faker->randomElement(['Refrensi', 'Hobi']),
                'edisi_tahun' => $faker->numberBetween(1990, 2024),
                'pengarang' => $faker->name,
                'penerbit' => $faker->company,
                'link_beli' => $faker->url,
                'perkiraan_harga' => $faker->numberBetween(50000, 300000),
                'tanggal_request' => $faker->date,
                'id_anggota_request' => '1083701898753437'
            ];
        }

        // Menggunakan Query Builder
        $this->db->table('buku')->insertBatch($data);
    }
}
