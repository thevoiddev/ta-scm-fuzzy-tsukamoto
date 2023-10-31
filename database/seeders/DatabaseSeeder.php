<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Agent;
use App\Models\Distributor;
use App\Models\Producer;
use App\Models\WebInformation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            [
                'username'   => 'admin',
                'email'      => 'admin@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Ilham Fadli',
                'created_at' => Carbon::now()
            ]
        ]);

        Producer::insert([
            [
                'username'   => 'producer1',
                'email'      => 'producer1@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Indofood',
                'created_at' => Carbon::now()
            ],
            [
                'username'   => 'producer2',
                'email'      => 'producer2@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Nestle',
                'created_at' => Carbon::now()
            ],
            [
                'username'   => 'producer3',
                'email'      => 'producer3@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Garudafood',
                'created_at' => Carbon::now()
            ],
            [
                'username'   => 'producer4',
                'email'      => 'producer4@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Wings',
                'created_at' => Carbon::now()
            ],
            [
                'username'   => 'producer5',
                'email'      => 'producer5@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Roma',
                'created_at' => Carbon::now()
            ],
            [
                'username'   => 'producer6',
                'email'      => 'producer6@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Sidomuncul',
                'created_at' => Carbon::now()
            ]
        ]);

        Distributor::insert([
            [
                'username'   => 'distributor1',
                'email'      => 'distributor1@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'J&T',
                'created_at' => Carbon::now()
            ],
            [
                'username'   => 'distributor2',
                'email'      => 'distributor2@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'JNE',
                'created_at' => Carbon::now()
            ],
            [
                'username'   => 'distributor3',
                'email'      => 'distributor3@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Si Cepat',
                'created_at' => Carbon::now()
            ]
        ]);

        Agent::insert([
            [
                'username'   => 'agent1',
                'email'      => 'agent1@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Toko Abadi Kemuning',
                'created_at' => Carbon::now()
            ],
            [
                'username'   => 'agent2',
                'email'      => 'agent2@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Toko Makmur Sekip',
                'created_at' => Carbon::now()
            ],
            [
                'username'   => 'agent3',
                'email'      => 'agent3@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Toko Jaya Sukabangun',
                'created_at' => Carbon::now()
            ]
        ]);

        WebInformation::insert([
            [
                'favicon'          => '2ba3a0d7878316de5aaa6eed7faed9e4ba4e9f09.png',
                'logo_main'        => '1480de65dc58d0dfd45e755f1fe9e483f3d09da5.png',
                'logo_secondary'   => '34698e2d6c4532d215df03dfba85aaf15432555e.png',
                'title'            => 'Supply Chain Management',
                'description'      => 'Ini merupakan proyek tugas akhir Ilham Fadli, mahasiswa program studi Sistem Komputer, Universitas Sriwijaya angkatan 2018.',
                'long_description' => 'Ini merupakan proyek tugas akhir Ilham Fadli, mahasiswa program studi Sistem Komputer, Universitas Sriwijaya angkatan 2018.',
                'keywords'         => json_encode(['scm', 'fuzzy', 'tsukamoto', 'rfid']),
                'author'           => 'Ilham Fadli',
                'email'            => 'ilhampadli19@gmail.com',
                'phone'            => '-',
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ]
        ]);
    }
}
