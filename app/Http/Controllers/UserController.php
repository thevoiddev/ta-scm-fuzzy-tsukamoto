<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserBusiness;
use App\Models\UserOffice;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public $sidebar_menu = 'user';
    public $main_content = 'Pengguna';

    public function index()
    {
        $web_information = $this->WebInformation();
        $sidebar_menu = $this->sidebar_menu;
        $main_content = $this->main_content;
        $title = "$main_content - $web_information->title";

        return view('user.index', compact(
            'web_information',
            'sidebar_menu',
            'main_content',
            'title'
        ));
    }

    public function datatable()
    {
        $data = User::where('id', '!=', session('user')['id'])->orderBy('name', 'asc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('role', function ($row) {
                return ucwords(strtolower($row->role->name));
            })
            ->addColumn('business', function ($row) {
                return  $row->userable_type == UserBusiness::class ? $row->userable?->name : $row->userable?->business->name;
            })
            ->addColumn('office', function ($row) {
                return  $row->userable_type == UserOffice::class ? $row->userable?->name : 'N/A';
            })
            ->addColumn('action', function ($row) {
                return '
                    <div class="btn-action-container">
                        <button type="button" class="btn btn-primary btn-square btn-action btn-action-edit"><i class="fas fa-edit"></i></button>
                    </div>
                ';
            })
            ->addColumn('edit_endpoint', function ($row) {
                return route('user.update', $row->slug);
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
