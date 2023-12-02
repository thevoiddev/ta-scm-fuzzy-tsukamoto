<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public $sidebar_menu = '#';
    public $main_content = 'Profil Pengguna'; 

    public function index()
    {
        $web_information = $this->WebInformation();
        $sidebar_menu = $this->sidebar_menu;
        $main_content = $this->main_content;
        $title = "$main_content - $web_information->title";

        return view('profile.index', compact(
            'web_information', 'sidebar_menu', 'main_content', 'title'
        ));
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'     => 'required|string|max:75',
            'username' => 'required|string|max:75',
            'email'    => 'required|string|max:255',
            'password' => 'nullable|string'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $user = User::find(session('user')['id']);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        if($request->password) $user->password = Hash::make($request->password);

        $user->save();

        $user = User::with('role', 'userable')->where('username', $request->username)->first();

        if($user->userable){
            $user->business = $user->userable->business;
        }

        session()->put('user', $user);

        return response()->json([
            'status'  => true,
            'message' => 'Profil pengguna anda berhasil di perbarui.'
        ], 200);
    }
}
