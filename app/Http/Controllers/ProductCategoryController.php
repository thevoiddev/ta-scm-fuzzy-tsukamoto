<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public $sidebar_menu = 'product_category';
    public $main_content = 'Kategori Produk';

    public function index()
    {
        $web_information = $this->WebInformation();
        $sidebar_menu = $this->sidebar_menu;
        $main_content = $this->main_content;
        $title = "$main_content - $web_information->title";

        return view('product_category.index', compact(
            'web_information',
            'sidebar_menu',
            'main_content',
            'title'
        ));
    }

    public function datatable()
    {
        $data = ProductCategory::orderBy('name', 'asc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <div class="btn-action-container">
                        <button type="button" class="btn btn-primary btn-square btn-action btn-action-edit"><i class="fas fa-edit"></i></button>
                    </div>
                ';
            })
            ->addColumn('update_endpoint', function ($row) {
                return route('product_category.update', $row->slug);
            })
            ->addColumn('update_method', function () {
                return 'POST';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $product_category = new ProductCategory();
        $product_category->name = $request->name;
        $product_category->slug = Str::slug($request->name . '-' . date('is'));
        $product_category->created_by = session('user')['id'];
        $product_category->created_at = Carbon::now();
        $product_category->save();

        return response()->json([
            'status'  => true,
            'message' => 'Kategori produk berhasil disimpan.'
        ], 200);
    }

    public function update($slug, Request $request)
    {
        $validation = Validator::make([...$request->all(), 'slug' => $slug], [
            'slug' => 'required|exists:product_categories,slug',
            'name' => 'nullable|required|string|max:50'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $product_category = ProductCategory::where('slug', $slug)->first();
        $product_category->name = $request->name;
        $product_category->slug = Str::slug($request->name . '-' . date('is'));
        $product_category->updated_by = session('user')['id'];
        $product_category->updated_at = Carbon::now();
        $product_category->save();

        return response()->json([
            'status'  => true,
            'message' => 'Kategori produk berhasil disimpan.'
        ], 200);
    }
}
