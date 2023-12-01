<?php

namespace App\Http\Controllers;

use App\Models\UserBusiness;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
}
