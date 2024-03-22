<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use App\Models\Trash;
use App\Models\TypeTrash;

use Illuminate\Http\Request;
use function Laravel\Prompts\alert;

class TypeTrashController extends Controller
{
    public function index()
    {
        $typeTrashes = TypeTrash::join('trash', 'type_trash.id_trash', '=', 'trash.id')
        ->select('type_trash.*', 'trash.name as trash_name')
        ->get();
        return view('admin.type_trash.index', compact('typeTrashes'));
    }

    public function create()
    {    
        $trashs = Trash::all();
        return view('admin.type_trash.create',compact('trashs'));
    }

    public function store(Request $request)
    {   
        intval($request->id_trash);

        $data = $request->validate([
            'name' => 'required',
            'weight' => 'required|integer',
            'id_trash' => 'required|integer',
            'weightable' => '',
        ]);
        $typeTrash = new TypeTrash();
        $typeTrash->fill($data);
        $typeTrash->save();

        return redirect()->route('type_trash.index');
    }

    public function show(TypeTrash $typeTrash)
    {
        return view('admin.type_trash.show', compact('typeTrash'));
    }

    public function edit(TypeTrash $typeTrash)
    {       
        $trashs = Trash::all();
        return view('admin.type_trash.edit', compact('typeTrash','trashs'));
    }
    public function update(Request $request, TypeTrash $typeTrash)
    {   
        intval($request->id_trash);
        $data = $request->validate([
            'name' => 'required',
            'weight' => 'required|integer',
            'weightable' => '',
            'id_trash' => 'required|integer',
        ]);
        $typeTrash->fill($data);
        $typeTrash->save();

        return redirect()->route('type_trash.index');
    }
    public function trashDelete(TypeTrash $typeTrash,$id){
        $notification = "Đổ rác thành công!";
        $typeTrash = TypeTrash::find($id);
        $typeTrash->weightable = 0;
        $typeTrash->update(['weightable' => $typeTrash->weightable]);
        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ]);
        $pusher->trigger('scanner', 'notification', $notification);
        return redirect()->route('user_client');
    }
    public function destroy(TypeTrash $typeTrash)
    {
        $typeTrash->delete();

        return redirect()->route('type_trash.index');
    }
}
