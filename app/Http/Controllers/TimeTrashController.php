<?php

namespace App\Http\Controllers;

use App\Models\TimeTrash;
use Illuminate\Http\Request;

class TimeTrashController extends Controller
{
    public function index()
    {
        $timeTrashes = TimeTrash::all();
        return view('time_trash.index', compact('timeTrashes'));
    }

    public function create()
    {
        return view('time_trash.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'id_trash' => 'required|integer',
        ]);

        $timeTrash = new TimeTrash();
        $timeTrash->fill($data);
        $timeTrash->save();

        return redirect()->route('time_trash.index');
    }

    public function show(TimeTrash $timeTrash)
    {
        return view('time_trash.show', compact('timeTrash'));
    }

    public function edit(TimeTrash $timeTrash)
    {
        return view('time_trash.edit', compact('timeTrash'));
    }

    public function update(Request $request, TimeTrash $timeTrash)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'id_trash' => 'required|integer',
        ]);

        $timeTrash->fill($data);
        $timeTrash->save();

        return redirect()->route('time_trash.index');
    }

    public function destroy(TimeTrash $timeTrash)
    {
        $timeTrash->delete();

        return redirect()->route('time_trash.index');
    }
}
