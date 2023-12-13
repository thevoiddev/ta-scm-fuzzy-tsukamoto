<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public $sidebar_menu = 'product';
    public $main_content = 'Produk';

    public function index()
    {
        $web_information = $this->WebInformation();
        $sidebar_menu = $this->sidebar_menu;
        $main_content = $this->main_content;
        $title = "$main_content - $web_information->name";

        $product_category = ProductCategory::get();

        return view('product.index', compact(
            'web_information',
            'sidebar_menu',
            'main_content',
            'title',
            'product_category'
        ));
    }

    public function datatable()
    {
        $data = Product::orderBy('name', 'asc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('image_preview', function ($row) {
                return '
                    <img width="100%" src="' . (asset('images/products/' . $row->image)) . '" alt="Product Image">
                ';
            })
            ->addColumn('detail', function ($row) {
                $detail = "
                    <p class='mb-0'><b>Nama Produk</b></p>
                    <p class='mb-0'>$row->name</p>
                    <hr class='m-0'>
                    <p class='mb-0'><b>Deskripsi</b></p>
                    <p class='mb-0'>$row->description</p>
                    <hr class='m-0'>
                    <p class='mb-0'><b>Harga</b></p>
                    <p class='mb-0'>Rp." . number_format($row->price, 0, ',', '.') . "</p>
                    <hr class='m-0'>
                    <p class='mb-0'><b>RFID Tag</b></p>
                    <p class='mb-0'>$row->tag_id</p>
                    <hr class='m-0'>
                    <p class='mb-0'><b>Kategori</b></p>
                    <p class='mb-0'>{$row->category->name}</p>
                    <hr class='m-0'>
                    <p class='mb-0'><b>Tag</b></p>
                    <p class='mb-0'>
                ";

                foreach (explode(',', $row->tag) as $item) {
                    $detail .= '<span class="badge badge-secondary mr-2">#' . $item . '</span>';
                }

                $detail .= '</p>';

                return $detail;
            })
            ->addColumn('action', function ($row) {
                return '
                    <div class="btn-action-container">
                        <button type="button" class="btn btn-primary btn-square btn-action btn-action-edit"><i class="fas fa-edit"></i></button>
                    </div>
                ';
            })
            ->addColumn('category', function ($row) {
                return $row->category->slug;
            })
            ->addColumn('update_endpoint', function ($row) {
                return route('product.update', $row->slug);
            })
            ->addColumn('update_method', function () {
                return 'POST';
            })
            ->addColumn('image_url', function ($row) {
                return asset('images/products/' . $row->image);
            })
            ->rawColumns(['image_preview', 'detail', 'action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'category'    => 'required|string|exists:product_categories,slug',
            'image'       => 'required|mimes:jpeg,png,jpg,gif,svg',
            'tag_id'      => 'required|string|max:50',
            'name'       => 'required|string|max:50',
            'price'       => 'required|integer',
            'description' => 'required|string|max:150'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $product = new Product();

        $image = $request->file('image');
        if ($image) {
            $name_gen = 'product-image-' . date('His');
            $image_ext = strtolower($image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $image_ext;
            $image->move(public_path('images/products'), $image_name);

            $product->image = $image_name;
        }

        $category = ProductCategory::where('slug', $request->category)->first();

        if (!$category) {
            return response()->json([
                'status'  => false,
                'message' => 'Kategori produk tidak ditemukan.'
            ], 404);
        }

        $product->category_id = $category->id;
        $product->tag_id = $request->tag_id;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name . '-' . date('is'));
        $product->description = $request->description;
        $product->price = $request->price;
        $product->tag = $request->tag;
        $product->created_by = session('user')['id'];
        $product->created_at = Carbon::now();
        $product->save();

        return response()->json([
            'status'  => true,
            'message' => 'Produk berhasil disimpan.'
        ], 200);
    }

    public function update($slug, Request $request)
    {
        $validation = Validator::make([...$request->all(), 'slug' => $slug], [
            'slug'        => 'required|exists:products,slug',
            'category'    => 'required|string|exists:product_categories,slug',
            'image'       => 'nullable|mimes:jpeg,png,jpg,gif,svg',
            'tag_id'      => 'required|string|max:50',
            'name'       => 'required|string|max:50',
            'price'       => 'required|integer',
            'description' => 'required|string|max:150'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $product = Product::where('slug', $request->slug)->first();

        if (!$product) {
            return response()->json([
                'status'  => false,
                'message' => 'Produk tidak ditemukan.'
            ], 400);
        }

        $image = $request->file('image');
        if ($image) {
            if ($product->image) {
                if (file_exists(public_path('images/products') . '/' . $product->image)) unlink(public_path('images/products') . '/' . $product->image);
            }

            $name_gen = 'product-image-' . date('His');
            $image_ext = strtolower($image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $image_ext;
            $image->move(public_path('images/products'), $image_name);

            $product->image = $image_name;
        }

        $category = ProductCategory::where('slug', $request->category)->first();

        if (!$category) {
            return response()->json([
                'status'  => false,
                'message' => 'Kategori produk tidak ditemukan.'
            ], 404);
        }

        $product->category_id = $category->id;
        $product->tag_id = $request->tag_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->tag = $request->tag;
        $product->created_by = session('user')['id'];
        $product->created_at = Carbon::now();
        $product->save();

        return response()->json([
            'status'  => true,
            'message' => 'Produk berhasil disimpan.'
        ], 200);
    }
}
