<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Agent;
use App\Models\Distributor;
use App\Models\Producer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public $main_content = 'Auth'; 

    public function index()
    {
        $web_information = $this->WebInformation();
        $main_content = $this->main_content;
        $title = "$main_content Signin -  $web_information->title";

        return view('auth.signin', compact(
            'web_information', 'title'
        ));
    }

    public function signin(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $user = User::with('role', 'userable')->where('username', $request->username)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'status'  => false,
                'message' => 'Username atau password salah.'
            ], 400);
        }

        if($user->userable){
            $user->business = $user->userable->business;
        }

        session()->put('user', $user);

        return response()->json([
            'status'   => true,
            'message'  => 'Masuk berhasil, kamu akan dialihkan dalam <span id="RedirectCountdown">5</span> detik.',
            'redirect' => route('dashboard.index')
        ], 200);
    }

    public function signout()
    {
        session()->forget('user');

        return redirect()->to(route('signin'));
    }
}
