<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductLog;
use App\Models\ProductLogItem;
use App\Models\User;
use App\Models\UserBusiness;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductLogController extends Controller
{
    public $sidebar_menu = 'product_log';
    public $main_content = 'Pengiriman Produk';

    public function index()
    {
        $web_information = $this->WebInformation();
        $sidebar_menu = $this->sidebar_menu;
        $main_content = $this->main_content;
        $title = "$main_content - $web_information->title";

        $distributor = UserBusiness::where('role', 'DISTRIBUTOR')->get();
        $agent =  UserBusiness::where('role', 'AGEN')->get();
        $product = Product::get();

        return view('product_log.index', compact(
            'web_information',
            'sidebar_menu',
            'main_content',
            'title',
            'product',
            'distributor',
            'agent'
        ));
    }

    public function datatable()
    {
        $data = ProductLog::with(['items'])->orderBy('title', 'asc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('title', function ($row) {
                return $row->title . '<hr>' . $row->resi;
            })
            ->addColumn('status', function ($row) {
                return ucwords(strtolower($row->status));
            })
            ->addColumn('distributor', function ($row) {
                return $row->distributor->name;
            })
            ->addColumn('agent', function ($row) {
                return $row->agent->name;
            })
            ->addColumn('f_items', function ($row) {
                if (count($row->items->toArray()) <= 0) return 'N/A';

                $items = '';

                foreach ($row->items as $item) {
                    $items .= '<li>' . $item->product->name . ' | ' . $item->amount . ' item</li>';
                }

                return '<ul>' . $items . '</ul>';
            })
            ->addColumn('action', function ($row) {
                if (
                    session('user')['userable_type'] == UserBusiness::class &&
                    UserBusiness::find(session('user')['userable_id'])->role == 'DISTRIBUTOR' && $row->status == 'DIBUAT'
                ) {

                    return '
                        <div class="btn-action-container">
                            <button type="button" class="btn btn-warning btn-square btn-action btn-action-send"><i class="fas fa-truck"></i></button>
                        </div>
                    ';
                }

                if (
                    session('user')['userable_type'] == UserBusiness::class &&
                    UserBusiness::find(session('user')['userable_id'])->role == 'AGEN' && $row->status == 'DIKIRIM'
                ) {
                    return '
                        <div class="btn-action-container">
                            <button type="button" class="btn btn-warning btn-square btn-action btn-action-received"><i class="fas fa-box-open"></i></button>
                        </div>
                    ';
                }

                return '';
            })
            ->addColumn('send_endpoint', function ($row) {
                return route('product_log.send', $row->resi);
            })
            ->addColumn('send_method', function () {
                return 'POST';
            })
            ->rawColumns(['f_items', 'title', 'action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|string',
            'distributor' => 'required|string',
            'agent' => 'required|string',
            'items' => 'required',
            'amounts' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $distributor = UserBusiness::where('slug', $request->distributor)->first();

        if (!$distributor) {
            return response()->json([
                'status'  => false,
                'message' => 'Distributor tidak ditemukan.'
            ], 404);
        }

        $agent = UserBusiness::where('slug', $request->agent)->first();

        if (!$distributor) {
            return response()->json([
                'status'  => false,
                'message' => 'Agen tidak ditemukan.'
            ], 404);
        }

        $product_log = new ProductLog();
        $product_log->distributor_id = $distributor->id;
        $product_log->agent_id = $agent->id;
        $product_log->title = $request->title;
        $product_log->resi = 'RSI' . date('His');
        $product_log->status = 'DIBUAT';
        $product_log->created_by = session('user')['id'];
        $product_log->created_at = Carbon::now();
        $product_log->save();

        foreach ($request->items as $key => $item) {
            $product = Product::where('slug', $item)->first();

            $product_log_item = new ProductLogItem();
            $product_log_item->product_log_id = $product_log->id;
            $product_log_item->product_id = $product->id;
            $product_log_item->amount = $request->amounts[$key];
            $product_log_item->save();
        }

        return response()->json([
            'status'  => true,
            'message' => 'Pengiriman produk berhasil disimpan. No Resi : ' . $product_log->resi
        ], 200);
    }

    public function send($resi)
    {
        $product_log = ProductLog::where('resi', $resi)->first();

        $product_log->status = 'DIKIRIM';
        $product_log->save();

        return response()->json([
            'status'  => true,
            'message' => 'Pengiriman produk berhasil dilakukan. No Resi : ' . $product_log->resi
        ], 200);
    }
}
