<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\ArchiveCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = Archive::with('categories');
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action',function ($row){
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('user.index');
    }

    public function create()
    {
        $category = ArchiveCategory::all();

        return view('user.create',compact('category'));
    }

    public function store(Request $request)
    {
        //
    }


    public function show(Archive $archive)
    {
        //
    }


    public function edit(Archive $archive)
    {
        //
    }


    public function update(Request $request, Archive $archive)
    {
        //
    }


    public function destroy(Archive $archive)
    {
        //
    }
}
