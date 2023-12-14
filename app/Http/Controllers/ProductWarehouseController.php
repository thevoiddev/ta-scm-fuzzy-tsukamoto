<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductWarehouseController extends Controller
{
    public $sidebar_menu = 'product_warehouse';
    public $main_content = 'Produk Gudang';

    public function index()
    {
        $web_information = $this->WebInformation();
        $sidebar_menu = $this->sidebar_menu;
        $main_content = $this->main_content;
        $title = "$main_content - $web_information->title";

        // $distributor = UserBusiness::where('role', 'DISTRIBUTOR')->get();
        // $agent =  UserBusiness::where('role', 'AGEN')->get();
        // $product = Product::get();

        return view('product_warehouse.index', compact(
            'web_information',
            'sidebar_menu',
            'main_content',
            'title',
            // 'product',
            // 'distributor',
            // 'agent'
        ));
    }
}
