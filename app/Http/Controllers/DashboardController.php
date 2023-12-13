<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\UserBusiness;

class DashboardController extends Controller
{
    public $sidebar_menu = 'dashboard';
    public $main_content = 'Dashboard';

    public function index()
    {
        $web_information = $this->WebInformation();
        $sidebar_menu = $this->sidebar_menu;
        $main_content = $this->main_content;
        $title = "$main_content -  $web_information->title";
        $business = UserBusiness::get();
        $user = User::get();
        $product = Product::get();
        $product_category = ProductCategory::get();

        return view('dashboard.index', compact(
            'web_information',
            'sidebar_menu',
            'main_content',
            'title',
            'business',
            'user',
            'product',
            'product_category'
        ));
    }
}
