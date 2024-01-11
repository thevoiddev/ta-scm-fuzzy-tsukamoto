<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/signin', function (Request $request) {
    $validation = Validator::make($request->all(), [
        'username' => 'required|string',
        'password' => 'required|string'
    ]);

    if ($validation->fails()) {
        return response()->json([
            'status'  => false,
            'message' => $validation->errors()->first()
        ], 400);
    }

    $user = User::with('role', 'userable')->where('username', $request->username)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'status'  => false,
            'message' => 'Username atau password salah.'
        ], 400);
    }

    if ($user->userable) {
        $user->business = $user->userable->business;
    }

    $token = JWT::encode($user->toArray(), env('APP_KEY'), 'HS256');

    session()->put('token', $token);

    return response()->json([
        'status'   => true,
        'message'  => 'Masuk berhasil, gunakan token dibawah untuk mengakses fitur.',
        'token'    => $token
    ], 200);


    return response()->json([
        'data' => Product::all()
    ]);
});


Route::get('product/stock', function (Request $request) {
    try {
        $validation = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $decoded = JWT::decode($request->token, new Key(env('APP_KEY'), 'HS256'));

        $products = Product::with('category')->get()->toArray();

        // for ($i = 0; $i <= count($products); $i++) {
        //     $products[$i]['stock'] = 125;
        // }

        return response()->json([
            'data' => $products
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Token invalid.'
        ], 400);
    }
});


Route::get('product/in/history', function (Request $request) {
    try {
        $validation = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $decoded = JWT::decode($request->token, new Key(env('APP_KEY'), 'HS256'));

        $products = Product::with('category')->limit(15)->get()->toArray();

        // for ($i = 0; $i <= count($products); $i++) {
        //     $products[$i]['stock'] = 125;
        // }

        return response()->json([
            'data' => $products
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Token invalid.'
        ], 400);
    }
});

Route::get('product/out/history', function (Request $request) {
    try {
        $validation = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $decoded = JWT::decode($request->token, new Key(env('APP_KEY'), 'HS256'));

        $products = Product::with('category')->limit(5)->get()->toArray();

        // for ($i = 0; $i <= count($products); $i++) {
        //     $products[$i]['stock'] = 125;
        // }

        return response()->json([
            'data' => $products
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Token invalid.'
        ], 400);
    }
});
