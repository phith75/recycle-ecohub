<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use App\Models\Gift;
use App\Models\User;
use App\Models\Trash;
use App\Models\TypeTrash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TrashController;
use App\Models\TypeTrashType;
use Illuminate\Support\Facades\Session;



class ScanQRController extends Controller
{
    public function index()
    {       $trashController = new TrashController();
            $trashController->trashTaked();
            $trash = session()->get('trash');
            $trasheType = session()->get('trasheType');
            $gifts = Gift::all();
            $user = Auth::user();
            
            return view("user_scaner", compact('trash', 'trasheType', 'gifts', 'user'));
    }
    public function redirectToRoute(Request $request, $id)
{
    $encodedData = $id;
    // Giải mã dữ liệu base64
    $jsonData = base64_decode($encodedData);
    // Chuyển đổi dữ liệu JSON thành mảng
    $data = json_decode($jsonData, true);
    // Lấy thông tin người dùng từ ID hoặc thông tin khác trong QR code
    $userId = Auth::id();
    // Lấy thông tin người dùng từ ID
    $user = User::find($userId);
    if (!$user) {
        return redirect('/user_client')->with('error', 'Không tìm thấy người dùng.');
    }
    $userName = $user->name;
    $weight = intval($data['weight']);
    $trashType = intval($data['trashType']);
    $able = intval($data['able']);
 
    $point = 0;
    switch ($trashType) {
        case 1:
            $point = $weight * 10;
            break;
        case 2:
            $point = $weight * 15;
            break;
        // Thêm các trường hợp khác nếu cần
        default:
            $point = $weight * 5; // Ví dụ mặc định
            break;
    }

    // Cập nhật dữ liệu vào cơ sở dữ liệu
    // Đây là một ví dụ cập nhật với Eloquent, bạn cần điều chỉnh phù hợp với cấu trúc cơ sở dữ liệu của bạn
    $trashType = TypeTrashType::where('type_trash_id', $trashType)->where('trash_id', $user->id_trash)->first();
    if ($trashType) {

        $trashType->weightable += $weight;
        $trashType->update(['weightable' => $trashType->weightable]);
        $user->point += $point;
        $user->update(['point' => $user->point]);
    }
    // tôi muốn render dữ liệu $trashType và $trash lấy dữ liệu từ bảng trash vào pusher như 1 mảng
    // Lấy dữ liệu từ bảng trash và gửi qua Pusher
    $trash = Trash::find($user->id_trash);
    // Bây giờ bạn có tên của người dùng, gửi thông tin này qua Pusher
    $dataToSend = [
        'trashType' => $trashType,
        'trash' => $trash,
        'userName' => $userName,
    ];
    // Gửi dữ liệu qua Pusher
    $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'useTLS' => true,
    ]);
    $pusher->trigger('scanner', 'userData', $dataToSend);
    // Hiển thị thông báo thành công
    
    // Redirect người dùng sau khi xử lý xong
    Session::flash('success', 'Your action was successful!');
    return redirect('/user_client');
}

}
