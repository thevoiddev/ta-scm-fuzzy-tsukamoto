<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticlesCategory;
use App\Models\Client;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\PortfoliosCategory;
use App\Models\Service;
use App\Models\Slider;
use App\Models\SocialMedia;
use App\Models\User;
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
        User::insert([
            [
                'role'       => 'Administrator',
                'username'   => 'admin',
                'email'      => 'admin@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Ilham Fadli',
                'created_at' => Carbon::now()
            ],
            [
                'role'       => 'Produsen',
                'username'   => 'produsen1',
                'email'      => 'produsen1@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Indofood',
                'created_at' => Carbon::now()
            ],
            [
                'role'       => 'Produsen',
                'username'   => 'produsen2',
                'email'      => 'produsen2@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Nestle',
                'created_at' => Carbon::now()
            ],
            [
                'role'       => 'Produsen',
                'username'   => 'produsen3',
                'email'      => 'produsen3@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Garudafood',
                'created_at' => Carbon::now()
            ],
            [
                'role'       => 'Produsen',
                'username'   => 'produsen4',
                'email'      => 'produsen4@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Wings',
                'created_at' => Carbon::now()
            ],
            [
                'role'       => 'Produsen',
                'username'   => 'produsen5',
                'email'      => 'produsen5@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Roma',
                'created_at' => Carbon::now()
            ],
            [
                'role'       => 'Produsen',
                'username'   => 'produsen6',
                'email'      => 'produsen6@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Sidomuncul',
                'created_at' => Carbon::now()
            ],
            [
                'role'       => 'Distributor',
                'username'   => 'distributor1',
                'email'      => 'distributor1@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'J&T',
                'created_at' => Carbon::now()
            ],
            [
                'role'       => 'Distributor',
                'username'   => 'distributor2',
                'email'      => 'distributor2@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'JNE',
                'created_at' => Carbon::now()
            ],
            [
                'role'       => 'Distributor',
                'username'   => 'distributor3',
                'email'      => 'distributor3@website.com',
                'password'   => Hash::make('admin2023!@'),
                'name'       => 'Si Cepat',
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
