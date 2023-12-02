<?php

namespace App\Http\Controllers;

use App\Mail\NewBusiness;
use App\Models\ProductScanner;
use App\Models\User;
use App\Models\UserBusiness;
use App\Models\UserOffice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class BusinessController extends Controller
{
    public $sidebar_menu = 'business';
    public $main_content = 'Usaha'; 

    public function index()
    {
        $web_information = $this->WebInformation();
        $sidebar_menu = $this->sidebar_menu;
        $main_content = $this->main_content;
        $title = "$main_content - $web_information->title";

        return view('business.index', compact(
            'web_information', 'sidebar_menu', 'main_content', 'title'
        ));
    }

    public function datatable()
    {
        $data = UserBusiness::with('owner', 'offices')->orderBy('name', 'asc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('owner', function($row){
                return $row->owner?->name ?? 'N/A';
            })
            ->addColumn('role', function($row){
                return ucwords(strtolower($row->role));
            })
            ->addColumn('action', function($row){
                return '
                    <div class="btn-action-container">
                        <button type="button" class="btn btn-primary btn-square btn-action btn-action-edit"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-square btn-action btn-action-delete"><i class="fas fa-trash"></i></button>
                    </div>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'type'              => 'required|string|max:75',
            'name'              => 'required|string|max:75',
            'email'             => 'required|string|max:255|unique:users,email',
            'store_name'        => 'nullable|string|max:75',
            'store_address'     => 'nullable|string',
            'warehouse_name'    => 'nullable|string|max:75',
            'warehouse_address' => 'nullable|string'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $business = new UserBusiness();
        $business->name = $request->name;
        $business->slug = Str::slug($request->name.'-'.date('is'));
        $business->role = $request->type;
        $business->created_by = session('user')['id'];
        $business->created_at = Carbon::now();
        $business->save();
        
        $employee1 = new User();
        $employee1->role_id = 2;
        $employee1->userable_id = $business->id;
        $employee1->userable_type = UserBusiness::class;
        $employee1->name = "Pemilik Usaha ".$business->name;
        $employee1->slug = Str::slug("Pemilik Usaha ".$business->name.'-'.date('is'));
        $employee1->email = $request->email;
        $employee1->username = "OWR".date('His');
        $employee1->password = Hash::make('12345678');
        $employee1->created_by = session('user')['id'];
        $employee1->created_at = Carbon::now();
        $employee1->save();

        if($request->type == "AGEN"){
            $store = new UserOffice();
            $store->business_id = $business->id;
            $store->name = $request->store_name;
            $store->slug = Str::slug($request->store_name.'-'.date('is'));
            $store->address = $request->store_address;
            $store->role = "TOKO";
            $store->created_by = session('user')['id'];
            $store->created_at = Carbon::now();
            $store->save();

            $warehouse = new UserOffice();
            $warehouse->business_id = $business->id;
            $warehouse->name = $request->warehouse_name;
            $warehouse->slug = Str::slug($request->warehouse_name.'-'.date('is'));
            $warehouse->address = $request->warehouse_address;
            $warehouse->role = "GUDANG";
            $warehouse->created_by = session('user')['id'];
            $warehouse->created_at = Carbon::now();
            $warehouse->save();

            $scanner1 = new ProductScanner();
            $scanner1->office_id = $store->id;
            $scanner1->name = "Scanner toko ".$store->name;
            $scanner1->slug = Str::slug("Scanner toko ".$store->name.'-'.date('is'));
            $scanner1->created_by = session('user')['id'];
            $scanner1->created_at = Carbon::now();
            $scanner1->save();

            $scanner1 = new ProductScanner();
            $scanner1->office_id = $warehouse->id;
            $scanner1->name = "Scanner gudang ".$store->name;
            $scanner1->slug = Str::slug("Scanner gudang ".$store->name.'-'.date('is'));
            $scanner1->created_by = session('user')['id'];
            $scanner1->created_at = Carbon::now();
            $scanner1->save();

            $employee2 = new User();
            $employee2->role_id = 3;
            $employee2->userable_id = $store->id;
            $employee2->userable_type = UserOffice::class;
            $employee2->name = "Kasir Toko ".$business->name;
            $employee2->slug = Str::slug("Kasir Toko ".$business->name.'-'.date('is'));
            $employee2->username = "KSR".date('His');
            $employee2->password = Hash::make('12345678');
            $employee2->created_by = session('user')['id'];
            $employee2->created_at = Carbon::now();
            $employee2->save();

            $employee3 = new User();
            $employee3->role_id = 4;
            $employee3->userable_id = $warehouse->id;
            $employee3->userable_type = UserOffice::class;
            $employee3->name = "Petugas Gudang ".$business->name;
            $employee3->slug = Str::slug("Petugas Gudang ".$business->name.'-'.date('is'));
            $employee3->username = "GDG".date('His');
            $employee3->password = Hash::make('12345678');
            $employee3->created_by = session('user')['id'];
            $employee3->created_at = Carbon::now();
            $employee3->save();
        }

        if($request->type == "AGEN"){
            Mail::to($request->email)->send(new NewBusiness(compact('business', 'store', 'warehouse', 'employee1', 'employee2', 'employee3')));
        }else{
            Mail::to($request->email)->send(new NewBusiness(compact('business', 'employee1')));
        }

        return response()->json([
            'status'  => true,
            'message' => 'Usaha berhasil didaftarkan. Detail akun dikirimkan ke email '.$request->email.'. Silahkan cek folder spam jika perlu.'
        ], 200);
    }
}
