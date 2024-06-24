<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(BukuSeeder::class);
        $this->call(ModulSeeder::class);

        $data = [
            [
                'id_anggota' => '12',
                'email' => 'mahasiswa@mahasiswa.pcr.ac.id',
                'nama' => 'mahasiswa',
                'password' => password_hash('mahasiswa', PASSWORD_DEFAULT),
                'role' => 'mahasiswa'
            ],
            [
                'id_anggota' => '13',
                'email' => 'dosen@dosen.pcr.ac.id',
                'nama' => 'dosen',
                'password' => password_hash('dosen', PASSWORD_DEFAULT),
                'role' => 'dosen'
            ]
        ];

        $data2 = [
            'staff_id' => '99',
            'email' => 'staff@pcr.ac.id',
            'nama_staff' => 'staff',
            'password' => password_hash('staff', PASSWORD_DEFAULT),
        ];

        $this->db->table('civitas_akademik')->insertBatch($data);
        $this->db->table('staff_perpustakaan')->insertBatch($data2);
    }
}
