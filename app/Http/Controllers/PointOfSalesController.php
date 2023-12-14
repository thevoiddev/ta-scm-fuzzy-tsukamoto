<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PointOfSalesController extends Controller
{
    public $sidebar_menu = 'point_of_sales';
    public $main_content = 'Point Of Sales';

    public function index()
    {
        $web_information = $this->WebInformation();
        $sidebar_menu = $this->sidebar_menu;
        $main_content = $this->main_content;
        $title = "$main_content - $web_information->title";

        // $distributor = UserBusiness::where('role', 'DISTRIBUTOR')->get();
        // $agent =  UserBusiness::where('role', 'AGEN')->get();
        // $product = Product::get();

        return view('point_of_sales.index', compact(
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
