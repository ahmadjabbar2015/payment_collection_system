<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenants;
use Yajra\DataTables\Facades\DataTables;
class TenantsController extends Controller
{
    //saad
    public function index()
    {


    }
    public function create()
    {

        return view('tenants.create');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        tenants::create($input);
        return redirect('tenants')->with('success', 'tenants Addedd!');

            if ($request->ajax()) {
                $data = tenants::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
                }
                }



    public function show()
    {
        $tenants = ['tenants::all()'];
        return view('tenants.show')->with('tenants', $tenants);

    }
}
