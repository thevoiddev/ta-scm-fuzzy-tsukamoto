<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Agent;
use App\Models\Distributor;
use App\Models\Producer;
use App\Models\Product;
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
                'name' => 'Pemilik Usaha',
                'slug' => 'pemilik-usaha'
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
                'business_id' => 9,
                'name' => 'Toko Sinar Jaya (Kemuning)',
                'slug' => 'toko-sinar-jaya-kemuning',
                'address' => 'Jalan basuki rahmat, kemuning',
                'role' => 'TOKO'
            ],
            [
                'business_id' => 9,
                'name' => 'Toko Sinar Jaya (Demang)',
                'slug' => 'toko-sinar-jaya-demang',
                'address' => 'Jalan demang lebar daun',
                'role' => 'TOKO'
            ],
            [
                'business_id' => 9,
                'name' => 'Gudang Sinar Jaya (Kemuning)',
                'slug' => 'gudang-sinar-jaya-kemuning',
                'address' => 'Jalan basuki rahmat, kemuning',
                'role' => 'GUDANG'
            ],
            [
                'business_id' => 9,
                'name' => 'Gudang Sinar Jaya (Demang)',
                'slug' => 'gudang-sinar-jaya-demang',
                'address' => 'Jalan demang lebar daun',
                'role' => 'GUDANG'
            ],
            [
                'business_id' => 11,
                'name' => 'Toko Abadi Makmur (Pasar 16)',
                'slug' => 'toko-sinar-jaya-pasar-16',
                'address' => 'Jalan pasar 16',
                'role' => 'TOKO'
            ],
            [
                'business_id' => 11,
                'name' => 'Gudang Abadi Makmur (Pasar 16)',
                'slug' => 'gudang-sinar-jaya-pasar-16',
                'address' => 'Jalan pasar 16',
                'role' => 'GUDANG'
            ],
            [
                'business_id' => 12,
                'name' => 'Toko Bukit Besar (Bukit Besar)',
                'slug' => 'toko-sinar-jaya-bukit-besar',
                'address' => 'Jalan bukit besar',
                'role' => 'TOKO'
            ],
            [
                'business_id' => 12,
                'name' => 'Gudang Bukit Besar (Bukit Besar)',
                'slug' => 'gudang-sinar-jaya-bukit-besar',
                'address' => 'Jalan bukit besar',
                'role' => 'GUDANG'
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

        Product::insert([
            // Makanan Ringan
            [
                'category_id' => 3,
                'tag_id' => 'TMP31',
                'name' => 'Indomie Mi Instan Goreng 84 g',
                'slug' => 'indomie-mi-instan-goreng-84-g-754971',
                'description' => 'Indomie Mi Instan Goreng 84 g adalah adalah mi instan dengan varian goreng original. Dibuat dengan menggunakan tepung terigu pilihan berkualitas tinggi, yang diolah secara higienis menggunakan teknologi modern, sehingga menghasilkan mi instan yang berkualitas tinggi dan rasa yang lezat. Diperkaya dengan berbagai vitamin dan mineral yang baik untuk tubuh. Dengan bumbu yang dibuat dari rempah rempah asli kekayaan nusantara sehingga menghasilkan rasa yang khas dan kaya rasa. Perpaduan antara mi bertekstur lembut dan kenyal dengan bumbu mie goreng yang terdiri dari kecap manis, minyak, bumbu, saus sambal dan bawang goreng, menghasilkan perpaduan rasa yang pas. Kenyalnya mi dengan rasa gurih manis dari bumbu, serta tekstur renyah dari bawang goreng memberikan kenikmatan rasa yang sempurna. Dikemas secara praktis dalam kemasan plastik yang terdapaat satu set mi dan bumbu lengkap di dalamnya. Dapat disajikan dalam waktu yang singkat dan praktis. Segera miliki stock Indomie Mi Instan Goreng 85 g dan rasakan kenikmatan mie goreng original yang kaya akan rasa.',
                'tag' => 'mie instan',
                'image' => '1_A7549710001037_20230105135328250_base.png',
                'price' => 3100,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 3,
                'tag_id' => 'TMP32',
                'name' => 'Indomie Mi Instan Kaldu Ayam 72 g',
                'slug' => 'indomie-mi-instan-kaldu-ayam-72-g-15529',
                'description' => 'Indomie Mi Instan Kaldu Ayam 72 g adalah salah satu jenis mi instan dengan varian kuah. Dibuat dengan menggunakan tepung terigu pilihan berkualitas tinggi, yang diolah secara higienis menggunakan teknologi modern, sehingga menghasilkan mi instan yang berkualitas tinggi dan rasa yang lezat. Diperkaya dengan berbagai vitamin dan mineral yang baik untuk tubuh. Dengan bumbu yang dibuat dari rempah rempah asli kekayaan nusantara sehingga menghasilkan rasa yang khas dan kaya rasa. Perpaduan antara mie bertekstur lembut dan kenyal dengan kuah rasa kaldu ayam yang gurih dan lezat, menciptakan perpaduan yang nikmat dan aroma yang menggugah selera. Dikemas secara praktis dalam kemasan plastik yang terdapaat satu set mie dan bumbu lengkap di dalamnya. Dapat disajikan dalam waktu yang singkat dan praktis. Lebih nikmat disajikan saat cuaca dingin atau hujan. Segera miliki stok Indomie Mi Instan Kaldu Ayam 72 g dan rasakan kenikmatannya.',
                'tag' => 'mie instan',
                'image' => '1_A09430004251_20230105134555211_base.png',
                'price' => 3000,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 3,
                'tag_id' => 'TMP33',
                'name' => 'Indomie Mi Instan Goreng Rendang 91 g',
                'slug' => 'indomie-mi-instan-goreng-rendang-91-g-24064',
                'description' => 'Indomie Mi Instan Goreng Rendang 91 g adalah salah satu jenis varian mi instan goreng dengan varian rasa rendang. Dibuat dengan menggunakan tepung terigu pilihan berkualitas tinggi, yang diolah secara higienis menggunakan teknologi modern, sehingga menghasilkan mi instan yang berkualitas tinggi dan rasa yang lezat. Diperkaya dengan berbagai vitamin dan mineral yang baik untuk tubuh. Dengan bumbu yang dibuat dari rempah rempah asli kekayaan nusantara sehingga menghasilkan rasa yang khas dan kaya rasa. Memiliki mi bertekstur lembut dan kenyal dengan rasa rendang nikmatyang berasal dari campuran bumbu kering dan bumbu minyak. Dengan aroma bumbu rendang yang khas dan menggugah selera, serta kenyalnya mi dengan rasa rempah rempah yang kuat dan pedas khas rendang, memberikan sensasi rasa yang nikmat. Dikemas secara praktis dalam kemasan plastik yang terdapaat satu set mi dan bumbu lengkap di dalamnya. Dapat disajikan dalam waktu yang singkat dan praktis. Segera miliki stock Indomie Mi Instan Goreng Rendang 91 g dan rasakan kenikmatannya.',
                'tag' => 'mie instan',
                'image' => '1_A09430005096_20220314113003389_base.jpg',
                'price' => 3100,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 3,
                'tag_id' => 'TMP34',
                'name' => 'Indomie Mi Instan Goreng Aceh 90 g',
                'slug' => 'indomie-mi-instan-goreng-aceh-90-g-679482',
                'description' => 'Indomie Mi Instan Goreng Aceh 90 g adalah salah satu jenis varian mi instan dengan varian rasa nusantara yaitu mie goreng Aceh. Dibuat dengan menggunakan tepung terigu pilihan berkualitas tinggi, yang diolah secara higienis menggunakan teknologi modern, sehingga menghasilkan mi instan yang berkualitas tinggi dan rasa yang lezat. Diperkaya dengan berbagai vitamin dan mineral yang baik untuk tubuh. Dengan bumbu yang dibuat dari rempah rempah asli kekayaan nusantara sehingga menghasilkan rasa yang khas dan kaya rasa. Memiliki mi bertekstur lembut dan kenyal yang memiliki potongan lebih besar dari mi varian lain yang dilengkapi dengan rasa rempah rempah yang kuat khas dari mie goreng aceh, dan rasa pedas dari bumbu yang nikmat, menghasilkan perpaduan rasa yang unik. Kenyalnya mi dengan rasa rempah rempah yang kuat dan pedas dari mie goreng aceh, memberikan sensasi rasa yang nikmat. Dikemas secara praktis dalam kemasan plastik yang terdapaat satu set mi dan bumbu lengkap di dalamnya. Dapat disajikan dalam waktu yang singkat dan praktis. Segera miliki stock Indomie Mi Instan Goreng Aceh 90 g dan rasakan kenikmatan mie dengan rasa kuliner khas Aceh.',
                'tag' => 'mie instan',
                'image' => '1_A6794820000988_20210705141624927_base.jpg',
                'price' => 3100,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 3,
                'tag_id' => 'TMP35',
                'name' => 'Indomie Mi Instan Ayam Spesial 68 g',
                'slug' => 'indomie-mi-instan-ayam-spesial-68-g-13812',
                'description' => 'Indomie Mi Instan Ayam Spesial 68 g adalah salah satu jenis mi instan dengan varian kuah. Dibuat dengan menggunakan tepung terigu pilihan berkualitas tinggi, yang diolah secara higienis menggunakan teknologi modern, sehingga menghasilkan mi instan yang berkualitas tinggi dan rasa yang lezat. Diperkaya dengan berbagai vitamin dan mineral yang baik untuk tubuh. Dengan bumbu yang dibuat dari rempah rempah asli kekayaan nusantara sehingga menghasilkan rasa yang khas dan kaya rasa. Perpaduan antara Mi bertekstur lembut dan kenyal dengan rasa kuah kaldu ayam yang memiliki sensasi rasa lebih gurih dan lebih kaya rasa, memberikan pepaduan yang nikmat . Dikemas secara praktis dalam kemasan plastik yang terdapaat satu set mie dan bumbu lengkap di dalamnya. Dapat disajikan dalam waktu yang singkat dan praktis. Lebih nikmat disajikan saat cuaca dingin atau hujan. Segera miliki IndomieIndomie Mi Instan Ayam Spesial 68 g dan rasakan kenikmatan kaldu ayam yang lebih nikmat.',
                'tag' => 'mie instan',
                'image' => '1_A09430002100_20220314105536898_base.jpg',
                'price' => 3000,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 3,
                'tag_id' => 'TMP36',
                'name' => 'Indomie Mi Instan Ayam Bawang 69 g',
                'slug' => 'indomie-mi-instan-ayam-bawang-69-g-75639',
                'description' => 'Indomie Mi Instan Ayam Bawang 69 g adalah salah satu jenis mi instan dengan varian kuah. Dibuat dengan menggunakan tepung terigu pilihan berkualitas tinggi, yang diolah secara higienis menggunakan teknologi modern, sehingga menghasilkan mi instan yang berkualitas tinggi dan rasa yang lezat. Diperkaya dengan berbagai vitamin dan mineral yang baik untuk tubuh. Dengan bumbu yang dibuat dari rempah rempah asli kekayaan nusantara sehingga menghasilkan rasa yang khas dan kaya rasa. Perpaduan antara mie bertekstur lembut dan kenyal dengan kuah kaldu ayam dan rasa bawang yang gurih, menciptakan perpaduan yang nikmat dan aroma yang menggugah selera. Dikemas secara praktis dalam kemasan plastik yang terdapaat satu set mie dan bumbu di dalamnya. Dapat disajikan dalam waktu yang singkat dan praktis. Lebih nikmat disajikan saat cuaca dingin atau hujan. Segera miliki stok Indomie Indomie Mi Instan Ayam Bawang 69 g dan rasakan kenikmatannya.',
                'tag' => 'mie instan',
                'image' => '1_A03350000153_20210705133303527_base.jpg',
                'price' => 3000,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 3,
                'tag_id' => 'TMP37',
                'name' => 'Indomie Mi Instan Kari Ayam 70 g',
                'slug' => 'indomie-mi-instan-kari-ayam-70-g-13973',
                'description' => 'Indomie Mi Instan Kari Ayam 70 gr adalah salah satu jenis mi instan dengan varian kuah. Dibuat dengan menggunakan tepung terigu pilihan berkualitas tinggi, yang diolah secara higienis menggunakan teknologi modern, sehingga menghasilkan mi instan yang berkualitas tinggi dan rasa yang lezat. Diperkaya dengan berbagai vitamin dan mineral yang baik untuk tubuh. Dengan bumbu yang dibuat dari rempah rempah asli kekayaan nusantara sehingga menghasilkan rasa yang khas dan kaya rasa. Perpaduan antara mie bertekstur lembut dan kenyal dengan kuah rasa kari ayam yang gurih dan lezat, menciptakan perpaduan yang nikmat dan aroma yang menggugah selera. Dikemas secara praktis dalam kemasan plastik yang terdapaat satu set mie dan bumbu lengkap di dalamnya. Dapat disajikan dalam waktu yang singkat dan praktis. Lebih nikmat disajikan saat cuaca dingin atau hujan. Segera miliki stok Indomie Mi Instan Kari Ayam 70 gr dan rasakan kenikmatannya.',
                'tag' => 'mie instan',
                'image' => '1_A09430002298_20230105135444176_base.png',
                'price' => 3100,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 3,
                'tag_id' => 'TMP38',
                'name' => 'Indomie Mi Instan Soto Lamongan 80 g',
                'slug' => 'indomie-mi-instan-soto-lamongan-80-g-657343',
                'description' => 'Indomie Mi Instan Soto Lamongan adalah salah satu jenis mi instan dengan varian kuah. Dibuat dengan menggunakan tepung terigu pilihan berkualitas tinggi, yang diolah secara higienis menggunakan teknologi modern, sehingga menghasilkan mi instan yang berkualitas tinggi dan rasa yang lezat. Diperkaya dengan berbagai vitamin dan mineral yang baik untuk tubuh. Dengan bumbu yang dibuat dari rempah rempah asli kekayaan nusantara sehingga menghasilkan rasa yang khas dan kaya rasa. Perpaduan antara mie bertekstur lembut dan kenyal dengan kuah soto yang memiliki sensasi rasa gurih dari koya dan asam segar dari jeruk nipis, menciptakan perpaduan yang nikmat dan aroma yang menggugah selera. Ditambah dengan sensasi rasa pedas dari sambal soto yang semakin memberikan kenikmatan yang unik. Dikemas secara praktis dalam kemasan plastik yang terdapaat satu set mie dan bumbu lengkap di dalamnya. Dapat disajikan dalam waktu yang singkat dan praktis. Lebih nikmat disajikan saat cuaca dingin atau hujan. Segera miliki Indomie Mi Instan Soto Lamongan dan rasakan kenikmatan cita rasa soto khas Jawa Timur.',
                'tag' => 'mie instan',
                'image' => '1_A6573430001037_20230105135944638_base.png',
                'price' => 3000,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 3,
                'tag_id' => 'TMP39',
                'name' => 'POP MIE Mi Instan Cup Kuah Pedes Dower Ayam Pedas 75 g',
                'slug' => 'pop-mie-mi-instan-cup-kuah-pedes-dower-ayam-pedas-75-g-643577',
                'description' => 'POP MIE Mi Instan Cup Kuah Pedes Dower Ayam Pedas 75 g merupakan salah satu varian mie seduh kuah dari Pop Mie dengan cita rasa dan aroma pedes dower ayam pedas. Terbuat dari tepung terigu berkualitas dengan paduan rempah-rempah pilihan terbaik, serta diproses dengan higienis menggunakan standar internasional dan teknologi berkualitas tinggi. Juga dilengkapi topping sayuran kering yang akan menambah nikmat sajian mie seduh rasa pedes dowes ayam pedas ini. Nikmati rasa pedas yang khas berpadu kuah kental yang nikmat. Kemasan cup yang praktis menjadikan POP MIE Mi Instan Cup Kuah Pedes Dower Ayam Pedas 75 g teman yang asyik dan pas untuk dinikmati kapan saja dan dimana saja.
                ',
                'tag' => 'mie instan',
                'image' => 'A10370643577_A10370643577_20190709165154555_base.jpg',
                'price' => 5800,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 3,
                'tag_id' => 'TMP40',
                'name' => 'POP MIE Mi Instan Premium Tori Miso Japanese Ramen Cup 77 g',
                'slug' => 'pop-mie-mi-instan-premium-tori-miso-japanese-ramen-cup-77-g-801745',
                'description' => 'Varian Tori Miso Japanese Ramen hadir dengan tekstur mi yang tebal dan kenyal. Bumbu kuah kaldunya kental dilengkapi dengan bumbu Miso khas Jepang yang gurih dan mampu memberikan kehangatan. Mi instan ini juga hadir dengan aroma biji wijennya yang wangi. Tak hanya itu, mi ini juga hadir dengan topping rumput laut yang lezat.',
                'tag' => 'mie instan',
                'image' => '1_A8017450002167_20231020111034331_base.jpg',
                'price' => 6200,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 3,
                'tag_id' => 'TMP41',
                'name' => 'POP MIE Mi Instan Cup Ayam 75 g',
                'slug' => 'pop-mie-mi-instan-cup-ayam-75-g-112546',
                'description' => 'POP MIE Mi Instan Cup Ayam merupakan salah satu varian mie seduh kuah dari Pop Mie dengan cita rasa dan aroma daging ayam yang khas. Terbuat dari tepung terigu berkualitas dengan paduan rempah-rempah pilihan terbaik, serta diproses dengan higienis menggunakan standar internasional dan teknologi berkualitas tinggi. Juga dilengkapi topping sayuran kering yang akan menambah nikmat sajian mie seduh rasa ayam ini. Nikmati rasa daging ayam yang khas berpadu kuah kental yang nikmat. Kemasan cup yang praktis menjadikan POP MIE Mi Instan Cup Ayam teman yang asyik dan pas untuk dinikmati kapan saja dan dimana saja.',
                'tag' => 'mie instan',
                'image' => '_ORIPDM16-29jun17_A00020000027_0_base.jpg',
                'price' => 5400,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 3,
                'tag_id' => 'TMP42',
                'name' => 'POP MIE Mi Instan Cup Bakso 75 g',
                'slug' => 'pop-mie-mi-instan-cup-bakso-75-g-24920',
                'description' => 'POP MIE Mi Instan Cup Baso merupakan salah satu varian mie seduh kuah dari Pop Mie dengan cita rasa dan aroma baso yang khas. Terbuat dari tepung terigu berkualitas dengan paduan rempah-rempah pilihan terbaik, serta diproses dengan higienis menggunakan standar internasional dan teknologi berkualitas tinggi. Juga dilengkapi topping sayuran kering yang akan menambah nikmat sajian mie seduh rasa baso ini. Nikmati rasa baso yang khas berpadu kuah kental yang nikmat. Kemasan cup yang praktis menjadikan POP MIE Mi Instan Cup Baso teman yang asyik dan pas untuk dinikmati kapan saja dan dimana saja.',
                'tag' => 'mie instan',
                'image' => '1_A09430006006_20200306153932957_base.jpg',
                'price' => 5400,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 3,
                'tag_id' => 'TMP43',
                'name' => 'POP MIE Mi Instan Cup Soto Ayam 75 g',
                'slug' => 'pop-mie-mi-instan-cup-soto-ayam-75-g-12518',
                'description' => 'POP MIE Mi Instan Cup Soto Ayam merupakan salah satu varian mie seduh kuah dari Pop Mie dengan cita rasa dan aroma soto yang khas. Terbuat dari tepung terigu berkualitas dengan paduan rempah-rempah pilihan terbaik, serta diproses dengan higienis menggunakan standar internasional dan teknologi berkualitas tinggi. Juga dilengkapi topping sayuran kering yang akan menambah nikmat sajian mie seduh rasa soto ayam ini. Nikmati rasa soto yang khas berpadu kuah kental yang nikmat. Kemasan cup yang praktis menjadikan POP MIE Mi Instan Cup Soto Ayam teman yang asyik dan pas untuk dinikmati kapan saja dan dimana saja.',
                'tag' => 'mie instan',
                'image' => '1_A09430000367_20200204153414895_base.jpg',
                'price' => 5400,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 3,
                'tag_id' => 'TMP44',
                'name' => 'POP MIE Mi Instan Cup Kari Ayam 75 g',
                'slug' => 'pop-mie-mi-instan-cup-kari-ayam-75-g-15285',
                'description' => 'POP MIE Mi Instan Cup Kari Ayam merupakan salah satu varian mie seduh kuah dari Pop Mie dengan cita rasa dan aroma kari ayam yang khas. Terbuat dari tepung terigu berkualitas dengan paduan rempah-rempah pilihan terbaik, serta diproses dengan higienis menggunakan standar internasional dan teknologi berkualitas tinggi. Juga dilengkapi topping sayuran kering yang akan menambah nikmat sajian mie seduh rasa kari ayam ini. Nikmati rasa kari  yang khas berpadu kuah kental yang nikmat. Kemasan cup yang praktis menjadikan POP MIE Mi Instan Cup Kari Ayam teman yang asyik dan pas untuk dinikmati kapan saja dan dimana saja.',
                'tag' => 'mie instan',
                'image' => 'A09430003940-1_base.jpg',
                'price' => 5400,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 3,
                'tag_id' => 'TMP45',
                'name' => 'Sedaap Mi Instant Ayam Nampool Cup 75 g',
                'slug' => 'sedaap-mi-instant-ayam-nampool-cup-75-g-797970',
                'description' => 'Sedaap Mie Instant Ayam Nampool Cup 75 g
                Mie instant kuah dalam cup dengan rasa Ayam. Kuahnya melalui proses pemasakan yang lama sehingga kaldu lebih asli dan gurih. Tekstur mie kenyal ditambah topping chunky ball yang lezat.',
                'tag' => 'mie instan',
                'image' => '1_A7979700002167_20230725101738419_base.jpg',
                'price' => 5300,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],


            [
                'category_id' => 4,
                'tag_id' => 'TMP46',
                'name' => 'Sedaap Kecap Manis Kedelai Hitam Spesial 520 ml',
                'slug' => 'sedaap-kecap-manis-kedelai-hitam-spesial-520-ml-747436',
                'description' => 'Sedaap Kecap Manis Kedelai Hitam Spesial 520 ml adalah Kecap manis yang dibuat dari kedelai hitam berkualitas. Dengan warna yang benar-benar hitam dan tekstur yang kental, kecap ini meresap sampai ke dalam masakan. Kecap Sedaap Kedelai Hitam Special membuat warna masakan menjadi caramelized dan menggugah selera. Proses produksi dan pengemasan yang higienis.',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A7474360001001_20230522133258866_base.jpg',
                'price' => 17500,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 4,
                'tag_id' => 'TMP47',
                'name' => 'Indofood Kecap Manis 520 ml',
                'slug' => 'indofood-kecap-manis-520-ml-15018',
                'description' => 'Indofood Kecap Manis Reffil 520 ml adalah salah satu varian kecap Indofood dalam kemasan isi ulang yang disukai di seluruh Nusantara. Kecap Indofood diracik dari kedelai asli pilihan dan bahan-bahan terbaik lainnya. Bahan-bahan terbaik tersebut kemudian diolah secara sempurna melalui pemurnian ganda sehingga menghasilkan kecap Indofood dengan cita rasa yang sempurna. Lebih gurih, lembut, lezat, dan meresap dengan sempurna dalam seluruh masakan Anda. Berbagai hidangan dapat Anda sajikan dengan Indofood Kecap ini, seperti semur dan bacem. Rasakan manisnya berbagai hidangan sedap tak terkalahkan dari Indofood Kecap Manis.',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A09600003606_20201215095210428_base.jpg',
                'price' => 15900,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 4,
                'tag_id' => 'TMP48',
                'name' => 'Sedaap Kecap Manis 520 ml',
                'slug' => 'sedaap-kecap-manis-520-ml-13753',
                'description' => 'Sedaap Kecap Manis 520 ml merupakan kecap yang terbuat dari bahan-bahan eksotis pilihan yang hanya diproduksi di pulau Jawa, yaitu gula aren, kacang kedelai, dan bahan berkualitas lainnya. Kecap manis Sedaap diproses secara modern dan higienis untuk menghasilkan kecap dengan kekentalan dan kemurnian rasa sehingga memberikan cita rasa istimewa pada setiap masakan. Rasa manis kecap manis Sedaap yang alami diperoleh dari gula aren yang dikeringkan menggunakan panas sinar matahari, menambah aroma dan memberi rasa manis istimewa pada berbagai masakan.',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A09600002024_20200806105939398_base.jpg',
                'price' => 16200,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 4,
                'tag_id' => 'TMP49',
                'name' => 'dua Belibis Saus Cabe 135 ml',
                'slug' => 'dua-belibis-saus-cabe-135-ml-13520',
                'description' => 'dua Belibis Saus Cabe 135 ml adalah saus cabai nikmat persembahan dari dua Belibis.  Dibuat dari cabe berkualitas tinggi yang masih memiliki seluruh cita rasa dan aroma yang khas dari cabai. Selain itu, saus cabai dari dua Belibis juga memiliki perpaduan dari bawang putih di dalamnya yang membawa cita rasa khas dan unik yang tidak ditemukan di produk saus cabai lainnya. Melewati proses modern dan menghasilkan cita rasa pedas yang unik, ideal untuk dijadikan pelengkap di setiap masakan dan camilan. Dikemas dalam kemasan botol yang praktis, mudah digunakan kapan saja dan di mana saja. Tersedia dalam kemasan botol plastik 135 ml yang praktis. Temukan kenikmatan dari cita rasa saus cabai yang khas dan unik bersama dengan dua Belibis Saus Cabe 135 ml.',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A09600001724_20230530170028265_base.jpg',
                'price' => 9500,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 4,
                'tag_id' => 'TMP50',
                'name' => 'KIKKOMAN Saus Pedas ala Korea Gochujang Botol 300 g',
                'slug' => 'kikkoman-saus-pedas-ala-korea-gochujang-botol-300-g-768967',
                'description' => 'KIKKOMAN Saus Pedas ala Korea Gochujang Botol 300 g
                Dapat digunakan untuk memasak berbagai hidangan korea, marinasi, maupun cocolan berbagai makanan favorit Anda. Gochujang ini dapat digunakan sebagai bahan untuk membuat Jjigae atau masakan sup, merendam daging, membuat Tteokbokki atau masakan tepung beras, dipping Bimbimbab, juga digunakan sebagai penyedap masakan Naengmyeong (Mie gandum ala Korea).',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A7689670002167_20230721165124262_base.jpg',
                'price' => 23500,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 4,
                'tag_id' => 'TMP51',
                'name' => 'Jays Kitchen Crushed Black Pepper Merica Hitam Remah 55 g',
                'slug' => 'jays-kitchen-crushed-black-pepper-merica-hitam-remah-55-g-766790',
                'description' => 'Jays Kitchen Crushed Black Pepper Merica Hitam Remah 55 g adalah bumbu merica hitam yang hadir dalam bentuk bubuk, persembahan dari Jays Kitchen. Bubuk merica hitam dari Jays Kitchen ini dibuat dari biji lada hitam asli berkualitas yang kemudian ditumbuk agar menjadi halus dan dapat mengeluarkan cita rasa serta aroma khas dari lada hitam yang nikmat. Sangat cocok untuk ditambahkan ke dalam berbagai sajian makanan ataupun dijadikan rempah untuk memarinasi. Mampu memberikan rasa gurih, pedas dan panas yang menyegarkan pada berbagai masakan Anda. Cocok dicampurkan pada berbagai masakan Indonesia yang kaya akan bumbu. Bubuk merica hitam ini telah mendapatkan sertifikasi Halal dari MUI. Kini telah hadir dalam kemasan tube praktis 55 gram yang siap digunakan untuk menambahkan cita rasa dan aroma lada hitam ke dalam berbagai sajian makanan Anda. Hadirkan cita rasa nikmat dan menyegarkan dari lada hitam asli bersama Jays Kitchen Crushed Black Pepper Merica Hitam Remah 55 g.',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A7667900001294_20230721144124716_base.jpg',
                'price' => 30000,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 4,
                'tag_id' => 'TMP52',
                'name' => 'Del Monte Black Pepper Sauce 250 gr',
                'slug' => 'del-monte-black-pepper-sauce-250-gr-788994',
                'description' => 'Del Monte Black Pepper 250 gr merupakan saus lada hitam dalam kemasan pouch. Dibuat dari bahan-bahan pilihan berkualitas. Bisa dicampurkan dengan aneka daging sebagai bumbu marinasi, membuat daging menjadi lebih nikmat dan beraroma. Kamu juga bisa menggunakannya sebagai bumbu untuk menumis.',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A7889940002167_20230720114443225_base.jpg',
                'price' => 9900,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 4,
                'tag_id' => 'TMP53',
                'name' => 'KOEPOE KOEPOE Lada Hitam Bubuk Bumbu Dapur 83 g',
                'slug' => 'koepoe-koepoe-lada-hitam-bubuk-bumbu-dapur-83-g-779233',
                'description' => 'KOEPOE KOEPOE Lada Hitam Bubuk 83 g
                Merupakan bumbu masak berupa lada hitam bubuk. Dibuat dari rempah asli dan bahan pilihan yang bermutu. Lada hitam ini diproses berbentuk bubuk yang dikemas dengan praktis, sehingga dapat digunakan untuk segala macam keperluan. Terbuat dari lada hitam asli dan tidak mengandung pengawet. Bumbu dapur ini ideal untuk melengkapi bumbu dapur Anda.
                ',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A7792330002167_20230718181618017_base.jpg',
                'price' => 21900,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 4,
                'tag_id' => 'TMP54',
                'name' => 'Racik Bumbu Instan Sayur Asem 33 g ',
                'slug' => 'racik-bumbu-instan-sayur-asem-33-g-751696',
                'description' => 'Racik Bumbu Instan Sayur Asem 33 g adalah bumbu siap pakai untuk sayur asem favorit keluarga, jadi masak anti ribet, auto bisa! Diracik dari rempah alami berkualitas, tanpa bahan pengawet dan pewarna buatan, dan rasanya seenak racikan sendiri. 1 bungkus Bumbu RACIK Sayur Asem cukup untuk 1x masak untuk 3-4 porsi.',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A7516960001001_20220518170554124_base.jpg',
                'price' => 2200,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 4,
                'tag_id' => 'TMP55',
                'name' => 'Indofood Racik Bumbu Spesial Opor Ayam 45 g ',
                'slug' => 'indofood-racik-bumbu-spesial-opor-ayam-45-g-13622',
                'description' => 'Indofood Bumbu Racik Opor Ayam adalah salah satu bumbu instan yang dipersembahkan oleh Indofood untuk opor ayam yang lezat dan nikmat. Bumbu Indofood ini diracik dari perpaduan bumbu dan rempah-rempah alami yang segar. Perpaduan tersebut dihasilkan dari pasteurisasi yang menjaga kesegaran rempah. Tanpa dapur yang berantakan dan dengan waktu yang cepat, Anda dapat menyajikan opor ayam dengan kuah santan yang lebih kental dan kaya rasa. Bumbu instan ini terjamin aman karena diracik tanpa bahan pengawet dan pewarna, serta mendapatkan sertifikat hahal dari Majelis Ulama Indonesia (MUI). Bumbu Indofood ini juga disertai dengan santan dan bumbu-bumbu khas opor lainnya. Hidangkan opor ayam hangat kesukaan keluarga Anda bersama lezatnya Indofood Bumbu Racik Opor Ayam.',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A28120001849_20211118104331161_base.jpg',
                'price' => 6400,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 4,
                'tag_id' => 'TMP56',
                'name' => 'Desaku Bumbu Kari 12.5 g',
                'slug' => 'desaku-bumbu-kari-125-g-786357',
                'description' => 'Desaku Kari 12,5 g adalah bubuk kari dalam kemasan praktis yang mudah dibawa kemana saja, Dibuat dari 100% bahan-bahan murni tanpa campuran serta diolah dengan proses yang higienis. Desaku kari terjamin kemurnian dan kualitasnya, serta aromanya akan terjaga karena telah diolah secara modern. Memberikan rasa yang akan melengkapi masakan Anda dan membuat Anda ketagihan. Anda bisa gunakan untuk bumbu pelengkap masakan ayam, daging, ataupun lauk lainnya. ',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A7863570002167_20230720112628351_base.png',
                'price' => 2600,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 4,
                'tag_id' => 'TMP57',
                'name' => 'bamboe Bumbu Instant Rawon 54 g',
                'slug' => 'bamboe-bumbu-instant-rawon-54-g-750341',
                'description' => 'bamboe Bumbu Instant Rawon 54 g merupakan bumbu instant siap olah yang dibuat untuk memudahkan dalam mengolah dan menghasilkan rawon khas Indonesia yang lezat. Bumbu rawon instant dari bamboe ini terbuat dari paduan bahan-bahan alami yang segar dan diolah secara higienis sehingga menghadirkan bumbu dengan citarasa dan kualitas ekspor. Tersedia dalam kemasan 54 g yang ideal untuk penyajian 4 porsi, bumbu instan bamboe ini praktis dan mudah digunakan untuk membantu membuat rawon lezat tanpa perlu repot.',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A7503410001001_20200813094154953_base.jpg',
                'price' => 9600,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 4,
                'tag_id' => 'TMP58',
                'name' => 'Royco Bumbu Kaldu Ayam 40 g',
                'slug' => 'royco-bumbu-kaldu-ayam-40-g-773002',
                'description' => 'Royco Bumbu Kaldu Ayam 40 g
                Merupakan bumbu penyedap masakan yang dibuat dari kaldu ayam dan tulang pilihan. Cita rasa lezatnya juga berasal dari bumbu rempah berkualitas. Cocok digunakan pada berbagai masakan, salah satunya sup ayam. Tersedia dalam kemasan isi 40 gram.',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A7730020002167_20220111122221845_base.jpg',
                'price' => 4150,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 4,
                'tag_id' => 'TMP59',
                'name' => 'Kobe Tepung Bumbu Putih 850 g',
                'slug' => 'kobe-tepung-bumbu-putih-850-g-774785',
                'description' => 'Kobe Tepung Bumbu Putih 850 g adalah tepung bumbu instan yang kini hadir sebagai pelopor tepung bumbu dengan konsep modern dan keunggulan yang unik. Menghadirkan inovasi tepung bumbu yakni tepung kristal yang mampu menghasilkan butiran tepung renyah sehingga mampu membuat lapisan tepung pada hasil gorengan lebih tebal dan renyah. KOBE Tepung Bumbu Putih juga mampu mempertahankan kerenyahan dari makanan dalam waktu lama setelah digoreng. Tepung Bumbu Putih KOBE juga merupakan tepung lapisan sehingga tidak perlu ditambahkan air sebelum digunakan. Tersedia dalam kemasan bag 850 g.',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A7747850002167_20230721140640139_base.png',
                'price' => 28500,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 4,
                'tag_id' => 'TMP60',
                'name' => 'Royco Bumbu Kaldu Penyedap Rasa Sapi 94 g',
                'slug' => 'royco-bumbu-kaldu-penyedap-rasa-sapi-94-g-13828',
                'description' => 'Royco Bumbu Kaldu Penyedap Rasa Sapi 94 g adalah salah satu inovasi bumbu masakan Indonesia berbekal pengalaman panjang selama 30 tahun yang diracik dari bahan-bahan dan rempah pilihan, seperti daging sapi pilihan yang direbus secara baik. Mudah larut dan meresap sehingga membantu memberi rasa kaldu yang mantap pada masakan Anda serta membantu memasak dengan mudah dan menyenangkan.',
                'tag' => 'kebutuhan dapur',
                'image' => '1_A09130002120_20220810163154909_base.jpg',
                'price' => 6100,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
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
