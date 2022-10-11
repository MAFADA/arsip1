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
        $data = Archive::create([
            'letter_number' => $request->letter_number,
            'category'=>$request->category,
            'title'=>$request->title,
        ]);

        foreach ($request->input('document',[])as $file){
            $data->addMedia(storage_path('tmp/uploads/'.$file))->toMediaCollection('document');
        }

        return redirect()->route('archive.index');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
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
