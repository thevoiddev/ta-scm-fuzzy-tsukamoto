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
                'category_id' => 1,
                'tag_id' => 'TMP01',
                'name' => 'Alfamart Kacang Kulit Original 250 g',
                'slug' => 'alfamart-kacang-kulit-original-250-g-13180',
                'description' => 'Alfamart Kacang Kulit Original 250 g adalah camilan kacang kulit persembahan dari Alfamart dengan varian rasa original. Camilan kacang kulit yang renyah dan gurih ini dapat menjadi pilihan terbaik untuk dapat menemani saat-saat santai Anda bersama teman, sahabat, dan keluarga. Menonton bola, bermain musik, dan piknik Anda bersama orang tersayang akan menjadi semakin berkesan dengan hadirnya produk camilan kacang kulit dari Alfamart. Jangan lupa untuk menyimpannya dalam toples untuk menjaga kerenyahan dan rasa gurih yang maksimal. Tersedia dalam kemasan bag isi 250 g yang mudah dan praktis untuk dibawa kemanapun. Jalani hari yang berkesan bersama Alfamart Kacang Kulit Original 250 g.',
                'tag' => 'makanan ringan',
                'image' => '1_A10000001307_20201202144914653_base.jpg',
                'price' => 20500,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 1,
                'tag_id' => 'TMP02',
                'name' => 'Alfamart Popcorn Karamel 75 g',
                'slug' => 'alfamart-popcorn-karamel-75-g-25259',
                'description' => 'Alfamart Popcorn Karamel 75 g adalah camilan popcorn dengan varian rasa karamel yang kini telah hadir untuk dapat menemani waktu senggang dan acara kumpul bersama teman dan keluarga dengan rasa karamael yang lezat. Dibuat dengan memadukan resep rahasia dan bahan-bahan pilihan berkualitas tinggi, menjadikan Alfamart Popcorn pantas untuk dicoba dan dinikmati bersama teman dan keluarga tercinta. Juga diproduksi secara higienis dan dikemas modern dalam kantong berukuran 75 g dengan desain yang ceria. Nikmati sensasi ledakan rasa dari perpaduan antara manisnya karamel dan popcorn yang renyah dari Alfamart Popcorn Karamel 75 g untuk temani waktu santai dan kumpul bersama yang seru.',
                'tag' => 'makanan ringan',
                'image' => '1_A10110006404_20210802152301907_base.jpg',
                'price' => 12500,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 1,
                'tag_id' => 'TMP03',
                'name' => 'DelfiORION Custas Soft Cup Cake 138 g',
                'slug' => 'delfiorion-custas-soft-cup-cake-138-g-391787',
                'description' => 'DelfiORION Custas Soft Cup Cake 138 g adalah kue bolu berbentuk cup yang mempunyai rasa yang nikmat. Tekstur cake premium yang lembut dan enak berisikan krim custard yang rasanya sangat lezat. Diolah dengan teknolgi modern dan dengan bahan-bahan pilihan sehingga menghasilkan rasa cup cake yang berkualitas. Krim custard adalah krim yang terbuat dari krim, susu dan telur. Meskipun begitu krim ini tidak menimbulkan aroma amis khas telur, melainkan wangi butter khas kue rumahan. Ditambah wangi butter yang kuat bikin kita akan selalu tertarik untuk terus menyantap sponge cake yang sangat nikmat ini. Tersedia dalam kemasan box isi 6 packs @ 23 g.',
                'tag' => 'makanan ringan',
                'image' => '1_A10212062444_20210903204355227_base.jpg',
                'price' => 23900,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 1,
                'tag_id' => 'TMP04',
                'name' => 'Tresno Joyo Madu Kurma TJ 150 g',
                'slug' => 'tresno-joyo-madu-kurma-tj-150-g-12560',
                'description' => 'Tresno Joyo Madu Kurma TJ 150 g merupakan produk madu murni yang terbuat dari 100% madu pilihan yang diproduksi oleh lebah pagi yang fresh dan dipanen saat madu matang dengan tambahan ekstrak kurma, sehingga kualitas Madu TJ Murni selalu terjamin. Madu TJ Madu Kurma kaya akan vitamin, mineral, dan enzim yang lengkap sehingga sangat baik untuk kesehatan, dapat menjaga stamina tubuh agar tidak mudah sakit, mencegah panas dalam dan berguna sebagai penambah gizi.',
                'tag' => 'makanan ringan',
                'image' => '1_A10560000420_20210908142250176_base.jpg',
                'price' => 23900,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 1,
                'tag_id' => 'TMP05',
                'name' => 'Alfamart Kacang Sangrai 180 g',
                'slug' => 'alfamart-kacang-sangrai-180-g-226151',
                'description' => 'Alfamart Kacang Sangrai 180 g merupakan camilan lokal persembahan Alfamart yang bisa menjadi pilihan teman ngemil saat santai atau kumpul bersama teman dan keluarga. Dibuat dari kacang tanah pilihan yang diolah dengan cara disangrai atau panggang pasir sehingga menghasilkan olahan kacang sangrai berkualitas yang memiliki tingkat kerenyahan dan rasa yang pas. Juga diolah secara higienies dan dikemas modern dalam kantong plastik 180 g agar dapat dinikmati dengan mudah.',
                'tag' => 'makanan ringan',
                'image' => '1_A10000109036_20201202145044554_base.jpg',
                'price' => 15500,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 1,
                'tag_id' => 'TMP06',
                'name' => 'Tango Wafer Vanilla Milk 115 g',
                'slug' => 'tango-wafer-vanilla-milk-115-g-424735',
                'description' => 'Tango Wafer Vanilla Milk 115 g merupakan wafer yang terbuat dari resep ahli dengan mengkombinasikan vanilla dan susu dalam setiap lapisan wafer krispi, sehingga menghasilkan rasa yang gurih & lezat di setiap gigitannya. Ideal dinikmati saat santai Anda bersama keluarga. Tersedia dalam kemasan pouch resealable zip lock 115 g.',
                'tag' => 'makanan ringan',
                'image' => '1_A10161176313_20201110104341466_base.jpg',
                'price' => 11900,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 1,
                'tag_id' => 'TMP07',
                'name' => 'Chomp-Chomp Mallow Duck Marshmallow 60 g',
                'slug' => 'chomp-chomp-mallow-duck-marshmallow-60-g-644652',
                'description' => 'Chomp-Chomp Mallow Duck Marshmallow 60 g Chomp-Chomp Mallow Car Marshmallow 60 g adalah produk marshmallows yang dibuat dalam bentuk bebek dengan varian rasa buah-buahan yang menjadi kesukaan anak-anak. Terbuat dari gula berkualitas dan bahan-bahan pilihan sehingga dapat menciptakan marshmallow yang lembut, kenyal, dan manis. Memiliki tekstur lembut dengan campuran rasa yang menggoda. Kudapan manis dan lembut ini ideal dikonsumsi dengan cara dipanggang atau dibakar. Tersedia dalam kemasan bag berbentuk bebek seberat 60 g yang praktis sehingga mudah untuk dibawa ataupun disimpan. Nikmati lelehan kelembutan dan rasa manis untuk menemani waktu santai atau acara kumpul dengan teman dan keluarga bersama Chomp-Chomp Mallow Duck Marshmallow 60 g.',
                'tag' => 'makanan ringan',
                'image' => '1_A10000109036_20201202145044554_base.jpg',
                'price' => 9900,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 1,
                'tag_id' => 'TMP08',
                'name' => 'MADU TJ Panas Dalam 150 g',
                'slug' => 'madu-tj-panas-dalam-150-g-647787',
                'description' => 'Madu TJ Panas Dalam 150 g merupakan produk madu murni yang terbuat dari 100% madu pilihan yang diproduksi oleh lebah pagi yang fresh dan dipanen saat madu matang, sehingga kualitas Madu TJ Panas Dalam selalu terjamin. Madu TJ Panas Dalam kaya akan ekstrak krisantemum vitamin, mineral, dan enzim yang lengkap sehingga sangat baik untuk kesehatan, dapat menjaga stamina tubuh agar tidak mudah sakit, mencegah panas dalam dan berguna sebagai penambah gizi.',
                'tag' => 'makanan ringan',
                'image' => 'A10190642648_base.jpg',
                'price' => 26600,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 1,
                'tag_id' => 'TMP09',
                'name' => 'Tresno Joyo Sari Kurma TJ 250 ml',
                'slug' => 'tresno-joyo-sari-kurma-tj-250-ml-679481',
                'description' => 'Tresno Joyo Sari Kurma TJ 250 ml adalah minuman sari kurma dari Arab yang tinggi zat besi. Memanfaatkan kebaikan madu asli dan kurma yang selalu merawat kesehatan seluruh keluarga Indonesia.Kaya akan vitamin, mineral, dan enzim yang lengkap sehingga sangat baik untuk kesehatan, dapat menjaga stamina tubuh agar tidak mudah sakit, mencegah panas dalam dan berguna sebagai penambah gizi. Kebaikan buah kurma sebagai buah gurun pasir ini dimanfaatkan Tresno Joyo untuk meningkatkan trombosit darah yang sangat cocok sekali untuk penyembuhan demam berdarah. Tersedia dalam kemasan botol 250 ml.',
                'tag' => 'makanan ringan',
                'image' => '1_A6794810001075_20210908152242695_base.jpg',
                'price' => 23500,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 1,
                'tag_id' => 'TMP10',
                'name' => 'Tao Kae Noi Big Sheet Crispy Seaweed Spicy 3,2 g',
                'slug' => 'tao-kae-noi-big-sheet-crispy-seaweed-spicy-32-g-178963',
                'description' => 'Tao Kae Noi Big Sheet Crispy Seaweed Spicy 3,2 g adalah snack rumput laut krispi rasa pedas dari Tao Kae Noi yang hadir untuk menemani saat santai atau luang Anda. Dibuat dari rumput laut pilihan berkualitas dan diproses secara higienis dan modern sehingga menghasilkan snack krispi dengan kerenyahan dan keistimewaan rasa rumput laut yang otentik. Tae Kae Noi Crispy Seaweed Big Sheet Spicy diproduksi dalam bentuk lembaran besar dengan tekstur krispi dan rasa pedas yang nikmat untuk memberikan sensasi makan rumput laut yang istimewa dalam tiap keping Tae Kae Noi. Tersedia dalam kemasan pack 3,2 g praktis untuk sekali makan. Rasakan renyah dan nikmatnya rasa dari rumput laut bersama Tao Kae Noi Big Sheet Crispy Seaweed Spicy 3,2 g.',
                'tag' => 'makanan ringan',
                'image' => '1_A09870892929_20210903142424894_base.jpg',
                'price' => 5200,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 1,
                'tag_id' => 'TMP11',
                'name' => 'Chomp-Chomp Mallow Love Marshmallow 60 g',
                'slug' => 'chomp-chomp-mallow-love-marshmallow-60-g-702387',
                'description' => 'Chomp-Chomp Mallow Love Marshmallow 60 g adalah produk marshmallows yang dibuat dalam bentuk love dengan varian rasa vanila dan teh hijau yang menjadi kesukaan anak-anak. Terbuat dari gula berkualitas dan bahan-bahan pilihan sehingga dapat menciptakan marshmallow yang lembut, kenyal, dan manis. Memiliki tekstur lembut dengan campuran rasa yang menggoda. Kudapan manis dan lembut ini ideal dikonsumsi dengan cara dipanggang atau dibakar. Tersedia dalam kemasan bag berbentuk love seberat 60 g yang praktis sehingga mudah untuk dibawa ataupun disimpan. Nikmati lelehan kelembutan dan rasa manis untuk menemani waktu santai atau acara kumpul dengan teman dan keluarga bersama Chomp-Chomp Mallow Love Marshmallow 60 g.',
                'tag' => 'makanan ringan',
                'image' => '1_A09870892929_20210903142424894_base.jpg',
                'price' => 9900,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 1,
                'tag_id' => 'TMP12',
                'name' => 'ALSHIFA Natural Honey 250 g',
                'slug' => 'alshifa-natural-honey-250-g-703886',
                'description' => 'ALSHIFA Natural Honey 250 g merupakan madu murni persembahan ALSHIFA yang diproduksi ideal untuk membantu menjaga daya tahan tubuh serta meningkatkan stamina. Terbuat dari 100% madu asli pilihan yang dihasikan dari lebah Arab yang menghisap bunga kurma sehingga memiliki khasiat yang baik untuk mengobati demam, maag, diabetes, darah tinggi, anti kanker, dan penyakit jantung, serta dapat sebagai obat flu yang ampuh baik untuk anak maupun dewasa.',
                'tag' => 'makanan ringan',
                'image' => '1_A7038860001019_20200722112246995_base.jpg',
                'price' => 67900,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 1,
                'tag_id' => 'TMP13',
                'name' => 'Gery Saluut Chocolate Coconut 105 g',
                'slug' => 'gery-saluut-chocolate-coconut-105-g-709715',
                'description' => 'Gery Saluut Chocolate Coconut 105 g merupakan biskuit crackers yang dilapisi dengan krim kelapa dan cokelat tebal di dalamnya. Terbuat dari bahan-bahan berkualitas yang dipadukan dengan lezatnya krim kelapa yang gurih. Mengandung nutrisi, karbohidrat, dan kalsium yang baik sehingga sangat aman dikonsumsi anda semua setiap hari. Sangat cocok untuk menemani waktu santai atau sebagai teman minum teh dan kopi. Segera coba Gery Saluut Chocolate Coconut 105 g, biskuit yang kaya akan krim kelapa yang lezat dan nikmat.',
                'tag' => 'makanan ringan',
                'image' => '1_A7097150001037_20210507101739629_base.jpg',
                'price' => 8500,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 1,
                'tag_id' => 'TMP14',
                'name' => 'Alfamart Kerupuk Ring Pedas 80 g',
                'slug' => 'alfamart-kerupuk-ring-pedas-80-g-391691',
                'description' => 'Alfamart Kerupuk Ring Pedas 80 g merupakan camilan kerupuk dengan bentuk ring yang unik persembahan dari Alfamart yang telah diproduksi dan dikemas secara modern dalam kemasan plastik premium. Camilan kerupuk berbentung ring ini diproses dan diolah secara khusus untuk dapat menghasilkan camilan yang renyah, kemudian di tambahkan dengan taburan bubuk cabai yang terbuat dari cabai pilihan berkualitas yang pedasnya tidak menimbulan rasa sakit pada perut. Kerupuk ring pedas ini sangat pas dinikmati sebagai pendamping makanan atau sebagai camilan pada saat bersantai. Tersedia dalam kemasan bag isi 80 g yang praktis dan mudah dibawa. Rasakan perpaduan renyahnya kerupuk dan pedasnya cabai pada Alfamart Kerupuk Ring Pedas 80 g.',
                'tag' => 'makanan ringan',
                'image' => '1_A09870893123_20201202152709249_base.jpg',
                'price' => 10900,
                'created_by'       => 1,
                'created_at'       => Carbon::now()
            ],
            [
                'category_id' => 1,
                'tag_id' => 'TMP15',
                'name' => 'Alfamart Kacang Telur Medan Premium 150 g',
                'slug' => 'alfamart-kacang-telur-medan-premium-150-g-391695',
                'description' => 'Alfamart Kacang Telur Medan Premium 150 g merupakan camilan kacang dengan lapisan tepung dan telur diluar persembahan dari Alfamart yang telah diproduksi dan dikemas secara modern dalam kemasan plastik premium. Terbuat dari kacang tanah pilihan yang berkualitas tinggi, kemudian diolah secara tradisional agar citarasa alami dari kacangnya dapat keluar dan benar-benar terasa. Rasa gurih alami dari kacang menjadi semakin nikmat dengan adanya balutan tepung terigu dengan bumbu rahasia sehingga dapat menghasilkan rasa manis gurih yang tak terlupakan. Sangat ideal untuk dijadikan sajian saat tamu berkunjung atau hanya sebagai camilan di saat senggang. Tersedia dalam kemasan bag 150 g. Nikmati rasa gurih kacang dan manis dari bumbu rahasia dari Alfamart Kacang Telur Medan Premium 150 g.',
                'tag' => 'makanan ringan',
                'image' => '1_A09870893127_20201202145214075_base.jpg',
                'price' => 14200,
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
