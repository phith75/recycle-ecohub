<?php

namespace App\Http\Controllers;

use App\Models\Trash;
use App\Models\TypeTrash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TrashController extends Controller
{
    public function index()
    {   
       
        $trashs = Trash::all();
       
        return view('admin.trash.index', compact('trashs'));
    }
    public function create()
    {
        return view('admin.trash.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'location' => 'required',
          
        ]);

        $trash = Trash::create($data);

        Session::flash('success', 'Thêm thùng rác thành công!');

        return redirect()->route('trash.index');
    }

    public function edit(Trash $trash)
    {
        return view('admin.trash.edit', compact('trash'));
    }

    public function update(Request $request, Trash $trash)
    {
        $data = $request->validate([
            'location' => 'required',
           
        ]);

        $trash->update($data);
        Session::flash('success', 'Sửa thùng rác thành công!');
        return redirect()->route('trash.index');
    }

    public function destroy(Trash $trash)
    {
        $trash->delete();

        Session::flash('success', 'Xóa thùng rác thành công!');

        return redirect()->route('trash.index');
    }
    public function trashIndex(){
        
        $id_trash = Auth::user()->id_trash;
        if($id_trash){
                $trash = Trash::find($id_trash);
                $trasheType = TypeTrash::where('id_trash',$id_trash)->get();
                foreach ($trasheType as $key => $trash) {
                    $notification = "";
                    $notification = $trash->weightabel / $trash->weight * 100;
                    $trasheType[$key]->notification = $notification;
                }
                return view('index',compact('trash','trasheType'));
    }

    return view('index');
    }

}
