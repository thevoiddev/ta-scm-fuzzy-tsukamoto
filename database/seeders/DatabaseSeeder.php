<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Agent;
use App\Models\Distributor;
use App\Models\Producer;
use App\Models\ProductCategory;
use App\Models\ProductScanner;
use App\Models\User;
use App\Models\UserBusiness;
use App\Models\UserOffice;
use App\Models\UserRole;
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
        UserRole::insert([
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin'
            ],
            [
                'name' => 'Pemilik Bisnis',
                'slug' => 'pemilik-bisnis'
            ],
            [
                'name' => 'Kasir Toko',
                'slug' => 'kasir-toko'
            ],
            [
                'name' => 'Petugas Gudang',
                'slug' => 'petugas-gudang'
            ]
        ]);

        UserBusiness::insert([
            [
                'name' => 'Indofood',
                'slug' => 'indofood',
                'role' => 'PRODUSEN'
            ],
            [
                'name' => 'Nestle',
                'slug' => 'nestle',
                'role' => 'PRODUSEN'
            ],
            [
                'name' => 'Garuda Food',
                'slug' => 'garudafood',
                'role' => 'PRODUSEN'
            ],
            [
                'name' => 'Roma',
                'slug' => 'roma',
                'role' => 'PRODUSEN'
            ],
            [
                'name' => 'Sidomuncul',
                'slug' => 'sidomuncul',
                'role' => 'PRODUSEN'
            ],
            [
                'name' => 'Si Cepat',
                'slug' => 'sicepat',
                'role' => 'DISTRIBUTOR'
            ],
            [
                'name' => 'JNE',
                'slug' => 'jne',
                'role' => 'DISTRIBUTOR'
            ],
            [
                'name' => 'JNT',
                'slug' => 'jnt',
                'role' => 'DISTRIBUTOR'
            ],
            [
                'name' => 'Toko Sinar Jaya',
                'slug' => 'toko-sinar-jaya',
                'role' => 'AGEN'
            ],
            [
                'name' => 'Toko Abadi Makmur',
                'slug' => 'toko-abadi-makmur',
                'role' => 'AGEN'
            ],
            [
                'name' => 'Toko Bukit Besar',
                'slug' => 'toko-bukit-besar',
                'role' => 'AGEN'
            ]
        ]);

        UserOffice::insert([
            [
                'business_id' => 10,
                'name' => 'Toko Sinar Jaya (Kemuning)',
                'slug' => 'toko-sinar-jaya-kemuning',
                'address' => 'Jalan basuki rahmat, kemuning'
            ],
            [
                'business_id' => 10,
                'name' => 'Toko Sinar Jaya (Demang)',
                'slug' => 'toko-sinar-jaya-demang',
                'address' => 'Jalan demang lebar daun'
            ],
            [
                'business_id' => 10,
                'name' => 'Gudang Sinar Jaya (Kemuning)',
                'slug' => 'gudang-sinar-jaya-kemuning',
                'address' => 'Jalan basuki rahmat, kemuning'
            ],
            [
                'business_id' => 10,
                'name' => 'Gudang Sinar Jaya (Demang)',
                'slug' => 'gudang-sinar-jaya-demang',
                'address' => 'Jalan demang lebar daun'
            ],
            [
                'business_id' => 11,
                'name' => 'Toko Abadi Makmur (Pasar 16)',
                'slug' => 'toko-sinar-jaya-pasar-16',
                'address' => 'Jalan pasar 16'
            ],
            [
                'business_id' => 11,
                'name' => 'Gudang Abadi Makmur (Pasar 16)',
                'slug' => 'gudang-sinar-jaya-pasar-16',
                'address' => 'Jalan pasar 16'
            ],
            [
                'business_id' => 12,
                'name' => 'Toko Bukit Besar (Bukit Besar)',
                'slug' => 'toko-sinar-jaya-bukit-besar',
                'address' => 'Jalan bukit besar'
            ],
            [
                'business_id' => 12,
                'name' => 'Gudang Bukit Besar (Bukit Besar)',
                'slug' => 'gudang-sinar-jaya-bukit-besar',
                'address' => 'Jalan bukit besar'
            ]
        ]);

        User::insert([
            [
                'role_id' => 1,
                'userable_id' => null,
                'userable_type' => null,
                'name' => 'Ilham Fadli',
                'slug' => 'ilham-fadli',
                'email' => 'ilhampadli19@gmail.com',
                'username' => 'ilhampadli19',
                'password' => Hash::make('12345678')
            ],
            [
                'role_id' => 2,
                'userable_id' => 1,
                'userable_type' => UserBusiness::class,
                'name' => 'Indofood',
                'slug' => 'indofood',
                'email' => 'indofood@gmail.com',
                'username' => 'indofood',
                'password' => Hash::make('12345678')
            ],
            [
                'role_id' => 2,
                'userable_id' => 2,
                'userable_type' => UserBusiness::class,
                'name' => 'Netsle',
                'slug' => 'nestle',
                'email' => 'nestle@gmail.com',
                'username' => 'nestle',
                'password' => Hash::make('12345678')
            ],
            [
                'role_id' => 2,
                'userable_id' => 3,
                'userable_type' => UserBusiness::class,
                'name' => 'Garudafood',
                'slug' => 'garudafood',
                'email' => 'garudafood@gmail.com',
                'username' => 'garudafood',
                'password' => Hash::make('12345678')
            ],
            [
                'role_id' => 2,
                'userable_id' => 4,
                'userable_type' => UserBusiness::class,
                'name' => 'Roma',
                'slug' => 'roma',
                'email' => 'roma@gmail.com',
                'username' => 'roma',
                'password' => Hash::make('12345678')
            ],
            [
                'role_id' => 2,
                'userable_id' => 5,
                'userable_type' => UserBusiness::class,
                'name' => 'Sidomuncul',
                'slug' => 'sidomuncul',
                'email' => 'sidomuncul@gmail.com',
                'username' => 'sidomuncul',
                'password' => Hash::make('12345678')
            ],
            [
                'role_id' => 2,
                'userable_id' => 6,
                'userable_type' => UserBusiness::class,
                'name' => 'Si Cepat',
                'slug' => 'sicepat',
                'email' => 'sicepat@gmail.com',
                'username' => 'sicepat',
                'password' => Hash::make('12345678')
            ],
            [
                'role_id' => 2,
                'userable_id' => 7,
                'userable_type' => UserBusiness::class,
                'name' => 'JNE',
                'slug' => 'jne',
                'email' => 'jne@gmail.com',
                'username' => 'jne',
                'password' => Hash::make('12345678')
            ],
            [
                'role_id' => 2,
                'userable_id' => 8,
                'userable_type' => UserBusiness::class,
                'name' => 'JNT',
                'slug' => 'jnt',
                'email' => 'jnt@gmail.com',
                'username' => 'jnt',
                'password' => Hash::make('12345678')
            ],
            [
                'role_id' => 2,
                'userable_id' => 9,
                'userable_type' => UserBusiness::class,
                'name' => 'Joko Saputra',
                'slug' => 'joko-saputra',
                'email' => 'joko_saputra@gmail.com',
                'username' => 'joko_saputra',
                'password' => Hash::make('12345678')
            ],
            [
                'role_id' => 3,
                'userable_id' => 1,
                'userable_type' => UserOffice::class,
                'name' => 'Tina Fitri',
                'slug' => 'tina-fitri',
                'email' => 'tina_fitri@gmail.com',
                'username' => 'tina_fitri',
                'password' => Hash::make('12345678')
            ],
            [
                'role_id' => 4,
                'userable_id' => 2,
                'userable_type' => UserOffice::class,
                'name' => 'Valentina Putri',
                'slug' => 'valentina-putri',
                'email' => 'valentina_putri@gmail.com',
                'username' => 'valentina_putri',
                'password' => Hash::make('12345678')
            ]
        ]);

        ProductScanner::insert([
            [
                'office_id' => 1,
                'name' => 'Scanner 1',
                'slug' => 'scanner-1'
            ],
            [
                'office_id' => 1,
                'name' => 'Scanner 2',
                'slug' => 'scanner-2'
            ],
            [
                'office_id' => 2,
                'name' => 'Scanner 3',
                'slug' => 'scanner-3'
            ],
            [
                'office_id' => 2,
                'name' => 'Scanner 4',
                'slug' => 'scanner-4'
            ],
            [
                'office_id' => 3,
                'name' => 'Scanner 5',
                'slug' => 'scanner-5'
            ],
            [
                'office_id' => 3,
                'name' => 'Scanner 6',
                'slug' => 'scanner-6'
            ],
            [
                'office_id' => 4,
                'name' => 'Scanner 7',
                'slug' => 'scanner-7'
            ],
            [
                'office_id' => 4,
                'name' => 'Scanner 8',
                'slug' => 'scanner-8'
            ]
        ]);

        ProductCategory::insert([
            [
                'name' => 'Makanan Ringan',
                'slug' => 'makanan-ringan'
            ],
            [
                'name' => 'Minuman',
                'slug' => 'minuman'
            ],
            [
                'name' => 'Mie Instan',
                'slug' => 'mie-instan'
            ],
            [
                'name' => 'Kebutuhan Dapur',
                'slug' => 'kebutuhan-dapur'
            ]
        ]);

        // Admin::insert([
        //     [
        //         'username'   => 'admin',
        //         'email'      => 'admin@website.com',
        //         'password'   => Hash::make('admin2023!@'),
        //         'name'       => 'Ilham Fadli',
        //         'created_at' => Carbon::now()
        //     ]
        // ]);

        // Producer::insert([
        //     [
        //         'username'   => 'producer1',
        //         'email'      => 'producer1@website.com',
        //         'password'   => Hash::make('admin2023!@'),
        //         'name'       => 'Indofood',
        //         'created_at' => Carbon::now()
        //     ],
        //     [
        //         'username'   => 'producer2',
        //         'email'      => 'producer2@website.com',
        //         'password'   => Hash::make('admin2023!@'),
        //         'name'       => 'Nestle',
        //         'created_at' => Carbon::now()
        //     ],
        //     [
        //         'username'   => 'producer3',
        //         'email'      => 'producer3@website.com',
        //         'password'   => Hash::make('admin2023!@'),
        //         'name'       => 'Garudafood',
        //         'created_at' => Carbon::now()
        //     ],
        //     [
        //         'username'   => 'producer4',
        //         'email'      => 'producer4@website.com',
        //         'password'   => Hash::make('admin2023!@'),
        //         'name'       => 'Wings',
        //         'created_at' => Carbon::now()
        //     ],
        //     [
        //         'username'   => 'producer5',
        //         'email'      => 'producer5@website.com',
        //         'password'   => Hash::make('admin2023!@'),
        //         'name'       => 'Roma',
        //         'created_at' => Carbon::now()
        //     ],
        //     [
        //         'username'   => 'producer6',
        //         'email'      => 'producer6@website.com',
        //         'password'   => Hash::make('admin2023!@'),
        //         'name'       => 'Sidomuncul',
        //         'created_at' => Carbon::now()
        //     ]
        // ]);

        // Distributor::insert([
        //     [
        //         'username'   => 'distributor1',
        //         'email'      => 'distributor1@website.com',
        //         'password'   => Hash::make('admin2023!@'),
        //         'name'       => 'J&T',
        //         'created_at' => Carbon::now()
        //     ],
        //     [
        //         'username'   => 'distributor2',
        //         'email'      => 'distributor2@website.com',
        //         'password'   => Hash::make('admin2023!@'),
        //         'name'       => 'JNE',
        //         'created_at' => Carbon::now()
        //     ],
        //     [
        //         'username'   => 'distributor3',
        //         'email'      => 'distributor3@website.com',
        //         'password'   => Hash::make('admin2023!@'),
        //         'name'       => 'Si Cepat',
        //         'created_at' => Carbon::now()
        //     ]
        // ]);

        // Agent::insert([
        //     [
        //         'username'   => 'agent1',
        //         'email'      => 'agent1@website.com',
        //         'password'   => Hash::make('admin2023!@'),
        //         'name'       => 'Toko Abadi Kemuning',
        //         'created_at' => Carbon::now()
        //     ],
        //     [
        //         'username'   => 'agent2',
        //         'email'      => 'agent2@website.com',
        //         'password'   => Hash::make('admin2023!@'),
        //         'name'       => 'Toko Makmur Sekip',
        //         'created_at' => Carbon::now()
        //     ],
        //     [
        //         'username'   => 'agent3',
        //         'email'      => 'agent3@website.com',
        //         'password'   => Hash::make('admin2023!@'),
        //         'name'       => 'Toko Jaya Sukabangun',
        //         'created_at' => Carbon::now()
        //     ]
        // ]);

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
