<?php

namespace App\Http\Controllers;

use App\Models\Trash;
use App\Models\TypeTrash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        $typeTrashes = TypeTrash::all();
        return view('admin.trash.create', compact('typeTrashes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'title' => 'required',
        ]);

        $data = $validatedData;
        $trash = Trash::create($data);

        if ($request->has('type_trashes')) {
            $typeTrashes = $request->input('type_trashes', []);
            foreach ($typeTrashes as $typeTrashId) {
                DB::table('trash_type_trash')->insert([
                    'trash_id' => $trash->id,
                    'type_trash_id' => $typeTrashId,
                    'weightable' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        Session::flash('success', 'Thêm thùng rác thành công!');
        return redirect()->route('trash.index');
    }
    public function update(Request $request, Trash $trash)
    {
        $data = $request->validate([
            'location' => 'required',
            'title' => 'required',
        ]);

        $trash->update($data);

        // Lấy danh sách ID của type_trashes được chọn
        $selectedTypeTrashes = $request->input('type_trashes', []);

        // Xóa tất cả các liên kết hiện tại trong bảng trung gian
        DB::table('trash_type_trash')->where('trash_id', $trash->id)->delete();

        // Thêm các liên kết mới vào bảng trung gian
        foreach ($selectedTypeTrashes as $typeTrashId) {
            DB::table('trash_type_trash')
            ->where('trash_id', $trash->id)
            ->where('type_trash_id', $typeTrashId)->update([
                'trash_id' => $trash->id,
                'type_trash_id' => $typeTrashId,
                'updated_at' => now(),
            ]);
        }

        Session::flash('success', 'Sửa thùng rác thành công!');
        return redirect()->route('trash.index');
    }


    public function edit(Trash $trash)
    {
        $decodedString = base64_decode($trash->location);
        $latLng = explode(",", $decodedString);
        $latitude = floatval($latLng[0]);
        $longitude = floatval($latLng[1]);
        $typeTrashes = TypeTrash::all();
        $selectedTypeTrashes = $typeTrashes->where('id_trash', $trash->id);
        return view('admin.trash.edit', compact('trash', 'latitude', 'longitude', 'typeTrashes', 'selectedTypeTrashes'));
    }


    public function destroy(Trash $trash)
    {
        $trash->delete();

        Session::flash('success', 'Xóa thùng rác thành công!');

        return redirect()->route('trash.index');
    }
    public function trashTaked()
    {

        $id_trash = Auth::user()->id_trash;
        if ($id_trash) {
            $trash = Trash::find($id_trash);
            $trashTypes = TypeTrash::join('trash_type_trash', 'type_trash.id', '=', 'trash_type_trash.type_trash_id')
                ->join('trash', 'trash_type_trash.trash_id', '=', 'trash.id')
                ->where('trash.id', $id_trash)
                ->select('type_trash.name','type_trash.weight', 'trash_type_trash.weightable','trash_type_trash.id')
                ->get();
            foreach ($trashTypes as $key => $trashtype) {
                $notification = 0;
                $notification = ($trashtype->weightable / $trashtype->weight) * 100;
                $trashTypes[$key]->notification = $notification;
            }
            session()->put('trash', $trash);
            session()->put('trasheType', $trashTypes);
        }
    }
    public function trashIndex(Request $request, Trash $trash)
    {
        $this->trashTaked();
        $trasheType = session()->get('trasheType');
        $trash = session()->get('trash');
        return view('index', compact('trash', 'trasheType'));
    }
    public function admin()
    {
        return view('admin.dashboad');
    }
}
