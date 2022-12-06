<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {

        if(request()->ajax()){
            $data = Product::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn =
                '<a href="/propertytype/edit/' . $row->id . '" class="edit btn btn-success btn-sm"><i class="ni ni-app"></i></a>
                <a href="/propertytype/delete/' . $row->id . '" class="delete btn btn-danger btn-sm"><i class="ni ni-fat-delete"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);;
        }
        return view('product.index');
    }
    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request){
        
        $validator = $request->validate([
            'name' => 'required|max:255',
            'version'=> 'required|max:255',
            // 'category_id' => 'required|max:255',
            'default_price' => 'required|max:255',
        ]);

        // dd($request->except('_token'));
        try{
            if($validator){
                $data = $request->except('_token', 'category_id');
                Product::create($data);
                return redirect(route('product.index')); 
            }

        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }

        
        
        

    }
}
