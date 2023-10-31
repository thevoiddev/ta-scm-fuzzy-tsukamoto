<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $web_information = $this->WebInformation();
        $social_media = SocialMedia::all();

        $description = NULL;

        if($request->tag){
            $description = "Menampilkan hasil pencarian tag : ".$request->tag;

            $articles = Article::where('keywords', 'LIKE', '%'.$request->tag.'%')->paginate(10);
        }else if($request->search){
            $description = "Menampilkan hasil pencarian : ".$request->search;

            $articles = Article::where('title', 'LIKE', '%'.$request->search.'%')->paginate(10);
        }else{
            $articles = Article::paginate(10);
        }

        return view('homepage.article', compact('web_information', 'social_media', 'articles', 'description'));
    }

    public function detail($slug, Request $request)
    {
        $web_information = $this->WebInformation();
        $social_media = SocialMedia::all();

        $article = Article::where('slug', $slug)->first();
        
        if(!$article) return abort(404);
        
        $latest = Article::where('id', '!=', $article->id)->latest()->take(5)->get();

        $share_button = \Share::page(
            route('article.detail', $article->slug),
            $article->title,
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp();

        return view('homepage.article_detail', compact('web_information', 'social_media', 'article', 'latest', 'share_button'));
    }
}
