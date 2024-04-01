<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\GiftUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminGiftController extends Controller
{
    public function index()
    {
        $gifts = Gift::all();
        return view('admin.gifts.index', compact('gifts'));
    }

    public function create()
    {
        return view('admin.gifts.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // điểm và số lượng
            'point' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images/gifts'), $imageName);

        $gift = new Gift();
        $gift->name = $request->input('name');
        $gift->content = $request->input('content');
        $gift->point = $request->input('point');
        $gift->quantity = $request->input('quantity');
        $gift->image = 'images/gifts/' . $imageName;
        $gift->save();

        return redirect()->route('gifts.index')->with('success', 'Gift created successfully.');
    }

    public function edit($id)
    {
        $gift = Gift::find($id);
        return view('admin.gifts.edit', compact('gift'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'point' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        $gift = Gift::find($id);

        $gift->name = $request->input('name');
        $gift->content = $request->input('content');
        $gift->point = $request->input('point');
        $gift->quantity = $request->input('quantity');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/gifts'), $imageName);
            $gift->image = 'images/gifts/' . $imageName;
        }

        $gift->save();

        return redirect()->route('index')->with('success', 'Gift updated successfully.');
    }

    public function destroy($id)
    {
        $gift = Gift::find($id);
        $gift->delete();

        return redirect()->route('index')->with('success', 'Gift deleted successfully.');
    }
    public function exchange($id)
    {
        $gift = Gift::findOrFail($id);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        // Kiểm tra điều kiện người dùng có đủ điểm để đổi quà hay không
        if ($user->coin >= $gift->coin_cost) {
            // Trừ điểm của người dùng sau khi đổi quà
            $user->point -= $gift->point;
            $user->save();
            $giftUser = new GiftUser();
            $giftUser->user_id = $user->id;
            $giftUser->gift_id = $gift->id;
            // sửa số lượng quà
            $gift->quantity -= 1;
            $gift->save();
            $giftUser->save();
            return response()->json([
                'success' => true,
                'message' => 'Đổi quà thành công!',
                'data' => [
                    // Dữ liệu cần thiết, ví dụ:
                    'gift' => $gift,
                ]
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bạn không đủ điểm để đổi quà.'
            ], 400);
        }
    }
    
}
