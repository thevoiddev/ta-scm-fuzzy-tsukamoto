<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    public $sidebar_menu = 'slider';
    public $main_content = 'Slider'; 

    public function index()
    {
        $web_information = $this->WebInformation();
        $sidebar_menu = $this->sidebar_menu;
        $main_content = $this->main_content;
        $title = "$main_content - $web_information->title";

        return view('slider.index', compact(
            'web_information', 'sidebar_menu', 'main_content', 'title'
        ));
    }

    public function datatable()
    {
        $data = Slider::orderBy('status', 'asc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('image_preview', function($row){
                return '
                    <img width="100%" src="'.(asset('images/sliders/'.$row->image)).'" alt="Slider Image">
                ';
            })
            ->addColumn('detail', function($row){
                return "
                    <p class='mb-0'><b>Title</b></p>
                    <p class='mb-0'>$row->title</p>
                    <hr>
                    <p class='mb-0'><b>Description</b></p>
                    <p class='mb-0'>$row->description</p>
                    <hr>
                    <p class='mb-0'><b>Link</b></p>
                    <p class='mb-0'>$row->link</p>
                ";
            })
            ->addColumn('action', function($row){
                return '
                    <div class="btn-action-container">
                        <button type="button" class="btn btn-primary btn-square btn-action btn-action-edit"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn '.($row->status == 'SHOW' ? 'btn-dark' : 'btn-info').' btn-square btn-action btn-action-show"><i class="fas '.($row->status == 'SHOW' ? 'fa-eye-slash' : 'fa-eye').'"></i></button>
                        <button type="button" class="btn btn-danger btn-square btn-action btn-action-delete"><i class="fas fa-trash"></i></button>
                    </div>
                ';
            })
            ->addColumn('update_endpoint', function($row){
                return route('slider.update', Crypt::encryptString($row->id));
            })
            ->addColumn('update_method', function(){
                return 'POST';
            })
            ->addColumn('show_endpoint', function($row){
                return route('slider.show', Crypt::encryptString($row->id));
            })
            ->addColumn('show_method', function(){
                return 'POST';
            })
            ->addColumn('delete_endpoint', function($row){
                return route('slider.delete', Crypt::encryptString($row->id));
            })
            ->addColumn('delete_method', function(){
                return 'DELETE';
            })
            ->addColumn('image_url', function($row){
                return asset('images/sliders/'.$row->image);
            })
            ->rawColumns(['image_preview', 'detail', 'action'])
            ->make(true);
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'image'       => 'required|mimes:jpeg,png,jpg,gif,svg',
            'title'       => 'required|string|max:50',
            'description' => 'required|string|max:150',
            'button_text' => 'nullable|string',
            'link'        => 'nullable|string'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $slider_item = new Slider();

        $image = $request->file('image');
        if ($image) {
            $name_gen = 'slider-image-'.date('His');
            $image_ext = strtolower($image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $image_ext;
            $image->move(public_path('images/sliders'), $image_name);

            $slider_item->image = $image_name;
        }

        $slider_item->title = $request->title;
        $slider_item->description = $request->description;
        $slider_item->button_text = $request->button_text;
        $slider_item->link = $request->link;
        $slider_item->created_by = 1;
        $slider_item->created_at = Carbon::now();
        $slider_item->save();

        return response()->json([
            'status'  => true,
            'message' => 'Slider item created successfully.'
        ], 200);
    }

    public function update($id, Request $request)
    {
        $id = Crypt::decryptString($id);

        $validation = Validator::make([...$request->all(), 'id' => $id], [
            'id'          => 'required|exists:sliders,id',
            'image'       => 'nullable|mimes:jpeg,png,jpg,gif,svg',
            'title'       => 'required|string|max:50',
            'description' => 'required|string|max:150',
            'button_text' => 'nullable|string',
            'link'        => 'nullable|string'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $slider_item = Slider::find($id);

        if(!$slider_item->image && !isset($request->image)){
            return response()->json([
                'status'  => false,
                'message' => 'Slider image is required.'
            ], 400);
        }

        $image = $request->file('image');
        if ($image) {
            if ($slider_item->image) {
                if (file_exists(public_path('images/sliders') . '/' . $slider_item->image)) unlink(public_path('images/sliders') . '/' . $slider_item->image);
            }

            $name_gen = 'slider-image-'.date('His');
            $image_ext = strtolower($image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $image_ext;
            $image->move(public_path('images/sliders'), $image_name);

            $slider_item->image = $image_name;
        }

        $slider_item->title = $request->title;
        $slider_item->description = $request->description;
        $slider_item->button_text = $request->button_text;
        $slider_item->link = $request->link;
        $slider_item->created_by = 1;
        $slider_item->created_at = Carbon::now();
        $slider_item->save();

        return response()->json([
            'status'  => true,
            'message' => 'Slider item updated successfully.'
        ], 200);
    }

    public function show($id){
        $id = Crypt::decryptString($id);

        $validation = Validator::make(['id' => $id], [
            'id'   => 'required|exists:sliders,id'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        if(Slider::where('status', 'SHOW')->count() < 1){
            return response()->json([
                'status'  => false,
                'message' => 'Minimum number of active slider is 1 slides.',
            ], 400);
        }

        $slider_item = Slider::find($id);
        $slider_item->status = $slider_item->status == 'SHOW' ? 'HIDE' : 'SHOW';
        $slider_item->save();

        return response()->json([
            'status'  => true,
            'message' => 'Slider item updated successfully.',
        ], 200);
    }

    public function delete($id){
        $id = Crypt::decryptString($id);

        $validation = Validator::make(['id' => $id], [
            'id'   => 'required|exists:sliders,id'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $slider_item = Slider::find($id);

        if($slider_item->status == 'SHOW' && Slider::where('status', 'SHOW')->count() - 1 < 1){
            return response()->json([
                'status'  => false,
                'message' => 'Minimum number of active slider is 1 slides.',
            ], 400);
        }else if(Slider::count() - 1 < 1){
            return response()->json([
                'status'  => false,
                'message' => 'Minimum number of slider is 1 slides.',
            ], 400);
        }

        if ($slider_item->image) {
            if (file_exists(public_path('images/sliders') . '/' . $slider_item->image)) unlink(public_path('images/sliders') . '/' . $slider_item->image);
        }

        $slider_item->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Slider item deleted successfully.',
        ], 200);
    }
}
