<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class UsersController extends Controller
{
    public function index()
    {
        $users = User::join('trash', 'users.id_trash', '=', 'trash.id')
        ->select('users.*', 'trash.name as trash_name')
        ->get();
        
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {   
        $trashs = Trash::all();
        return view('admin.users.create',compact('trashs'));
    }

    public function store(Request $request)
    {   
        intval($request->id_trash);
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => '',
            'role' => 'required',

            'id_trash' => 'required|integer',
            'point' => 'required|integer',
            'date_of_birth' => 'required',

        ]);
        $user = new User();
        $user->fill($data);
        $user->save();

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {   
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {       
        $trashs = Trash::all();
        return view('admin.users.edit', compact('user','trashs'));
    }

    public function update(Request $request, User $user)
{   
    $data = $request->validate([
        'name' => 'required',
        'phone' => 'nullable',
        'email' => 'nullable|email',
        'role' => 'nullable',
        'id_trash' => 'nullable|integer',
        'point' => 'nullable|integer',
        'date_of_birth' => 'nullable',
    ]);

    // Cập nhật dữ liệu cho $user
    $user->update($data);

    return redirect()->route('users.index');
}
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
    public function addPoint($trashType,$unable){
        $weight = rand(10,$unable);
        if ($trashType == "re") {
        }
        return redirect('/');
    }
}
