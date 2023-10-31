<?php

namespace App\Http\Controllers;

use App\Models\WebInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebInformationController extends Controller
{
    public $sidebar_menu = 'web_information';
    public $main_content = 'Web Information'; 

    public function index()
    {
        $web_information = $this->WebInformation();
        $sidebar_menu = $this->sidebar_menu;
        $main_content = $this->main_content;
        $title = "$main_content - $web_information->title";

        return view('web_information.index', compact(
            'web_information', 'sidebar_menu', 'main_content', 'title'
        ));
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'favicon'          => 'nullable|mimes:jpeg,png,jpg,gif,svg',
            'logo_primary'     => 'nullable|mimes:jpeg,png,jpg,gif,svg',
            'logo_secondary'   => 'nullable|mimes:jpeg,png,jpg,gif,svg',
            'title'            => 'required|string|max:50',
            'description'      => 'required|string|max:180',
            'long_description' => 'required|string|max:255',
            'keywords'         => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'email'            => 'required|string|max:120',
            'phone'            => 'required|string|max:20'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $web_information = $this->WebInformation();

        if(!$web_information->favicon && !isset($request->favicon)){
            return response()->json([
                'status'  => false,
                'message' => 'Favicon image is required.'
            ], 400);
        }

        $favicon = $request->file('favicon');
        if ($favicon) {
            if ($web_information->favicon && $web_information->favicon != 'honda.svg') {
                if (file_exists(public_path('images/logo') . '/' . $web_information->favicon)) unlink(public_path('images/logo') . '/' . $web_information->favicon);
            }

            $name_gen = 'favicon-'.date('His');
            $favicon_ext = strtolower($favicon->getClientOriginalExtension());
            $favicon_name = $name_gen . '.' . $favicon_ext;
            $favicon->move(public_path('images/logo'), $favicon_name);

            $web_information->favicon = $favicon_name;
        }

        if(!$web_information->logo_main && !isset($request->logo_primary)){
            return response()->json([
                'status'  => false,
                'message' => 'Logo primary image is required.'
            ], 400);
        }

        $logo_primary = $request->file('logo_primary');
        if ($logo_primary) {
            if ($web_information->logo_main && $web_information->logo_main != 'honda-green.svg') {
                if (file_exists(public_path('images/logo') . '/' . $web_information->logo_main)) unlink(public_path('images/logo') . '/' . $web_information->logo_main);
            }

            $name_gen = 'honda-green-'.date('His');
            $logo_primary_ext = strtolower($logo_primary->getClientOriginalExtension());
            $logo_primary_name = $name_gen . '.' . $logo_primary_ext;
            $logo_primary->move(public_path('images/logo'), $logo_primary_name);

            $web_information->logo_main = $logo_primary_name;
        }

        if(!$web_information->logo_secondary && !isset($request->logo_secondary)){
            return response()->json([
                'status'  => false,
                'message' => 'Logo secondary image is required.'
            ], 400);
        }

        $logo_secondary = $request->file('logo_secondary');
        if ($logo_secondary) {
            if ($web_information->logo_secondary && $web_information->logo_secondary != 'honda-white.svg') {
                if (file_exists(public_path('images/logo') . '/' . $web_information->logo_secondary)) unlink(public_path('images/logo') . '/' . $web_information->logo_secondary);
            }

            $name_gen = 'honda-white-'.date('His');
            $logo_secondary_ext = strtolower($logo_secondary->getClientOriginalExtension());
            $logo_secondary_name = $name_gen . '.' . $logo_secondary_ext;
            $logo_secondary->move(public_path('images/logo'), $logo_secondary_name);

            $web_information->logo_secondary = $logo_secondary_name;
        }

        $web_information->title = $request->title;
        $web_information->description = $request->description;
        $web_information->long_description = $request->long_description;
        $web_information->keywords = json_encode(explode(',', $request->keywords));
        $web_information->author = $request->author;
        $web_information->email = $request->email;
        $web_information->phone = $request->phone;
        $web_information->save();

        return response()->json([
            'status'  => true,
            'message' => 'Web information updated successfully. Refresh page to see the changes.'
        ], 200);
    }
}
