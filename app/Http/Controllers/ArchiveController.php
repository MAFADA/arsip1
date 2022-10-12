<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\ArchiveCategory;
use http\Client\Response;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = Archive::with('categories');
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('categories',function (Archive $archive){
                    return $archive->categories->archive_category;
                })
                ->addColumn('action',function ($row){

                    $btn ='<a href="#" data-id="' . $row->id . '" class="btn btn-outline-danger btn-sm show_confirm"> Hapus</a>
                    <form action="' . route('archive.destroy', [$row->id]) . '" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                    </form>';
                    $btn = $btn . '<a href="' . route('archive.show', [$row->id]) . '" data-id="' . $row->id . '" class="btn btn-outline-warning btn-sm"> Unduh</a>';
                    $btn = $btn . '<a href="' . route('archive.show', [$row->id]) . '" data-id="' . $row->id . '" class="btn btn-outline-primary btn-sm"> Lihat</a>';
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
            $data->addMedia(storage_path('files/'.$file))->toMediaCollection('document');
        }

        return redirect()->route('archive.index');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('files');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = $file->getClientOriginalName();

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }


    public function show(Archive $archive)
    {
        return view('user.show',compact('archive'));
    }


    public function edit(Archive $archive)
    {
        $category = ArchiveCategory::all();
        return view('user.edit',compact('archive','category'));
    }


    public function update(Request $request, Archive $archive)
    {
        //
    }


    public function destroy(Archive $archive)
    {
        $archive->delete();

        return back();
    }
}
