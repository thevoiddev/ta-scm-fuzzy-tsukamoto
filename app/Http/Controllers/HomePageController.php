<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Client;
use App\Models\CompanyInformation;
use App\Models\ContactUs;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Slider;
use App\Models\SocialMedia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $web_information = $this->WebInformation();
        $social_media = SocialMedia::all();
        $sliders = Slider::where('status', 'SHOW')->get();
        $faqs = Faq::all();
        $clients = Client::all();
        $services = Service::all();
        $galleries = Gallery::all();
        $articles = Article::latest()->take(3)->get();

        return view('homepage.index', compact('web_information', 'social_media', 'sliders', 'faqs', 'clients', 'services', 'galleries', 'articles'));
    }

    public function contact_us(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'    => 'required|string',
            'email'   => 'required|email:rfc,dns',
            'phone'   => 'required|string',
            'company' => 'required|string',
            'message' => 'required|string'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $contact_us = new ContactUs();
        $contact_us->name = $request->name;
        $contact_us->email = $request->email;
        $contact_us->phone = $request->phone;
        $contact_us->company = $request->company;
        $contact_us->message = $request->message;
        $contact_us->created_at = Carbon::now();
        $contact_us->save();

        return response()->json([
            'status'  => true,
            'message' => 'Pesan berhasil dikirim, tim kami akan menghubungi anda dalam waktu 2x24jam.'
        ], 200);
    }
}
