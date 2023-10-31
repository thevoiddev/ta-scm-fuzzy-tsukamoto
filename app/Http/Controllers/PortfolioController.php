<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $web_information = $this->WebInformation();
        $social_media = SocialMedia::all();

        $description = NULL;

        if($request->tag){
            $description = "Menampilkan hasil pencarian tag : ".$request->tag;

            $portfolios = Portfolio::where('keywords', 'LIKE', '%'.$request->tag.'%')->paginate(10);
        }else if($request->search){
            $description = "Menampilkan hasil pencarian : ".$request->search;

            $portfolios = Portfolio::where('title', 'LIKE', '%'.$request->search.'%')->paginate(10);
        }else{
            $portfolios = Portfolio::paginate(10);
        }

        return view('homepage.portfolio', compact('web_information', 'social_media', 'portfolios', 'description'));
    }

    public function detail($slug, Request $request)
    {
        $web_information = $this->WebInformation();
        $social_media = SocialMedia::all();

        $portfolio = Portfolio::where('slug', $slug)->first();
        
        if(!$portfolio) return abort(404);
        
        $latest = Portfolio::where('id', '!=', $portfolio->id)->latest()->take(5)->get();

        $share_button = \Share::page(
            route('portfolio.detail', $portfolio->slug),
            $portfolio->title,
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp();

        return view('homepage.article_detail', compact('web_information', 'social_media', 'portfolio', 'latest', 'share_button'));
    }
}
