<?php

namespace App\Http\Controllers;

use App\Models\Trash;
use Pusher\Pusher;
use App\Models\User;
use App\Models\TypeTrash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScanQRController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
            return view("user_scaner");
        } else {
            echo "<script>alert('Bạn phải là người dùng mới được truy cập trang này');</script>";
            return view("index");
        }
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
        // Xử lý khi không tìm thấy người dùng
        return redirect('/user_client')->with('error', 'Không tìm thấy người dùng.');
    }
    $userName = $user->name;
    $weight = intval($data['weight']);
    $trashType = intval($data['trashType']);
    $able = intval($data['able']);
 
    $points = 0;
    switch ($trashType) {
        case 1:
            $points = $weight * 10;
            break;
        case 2:
            $points = $weight * 15;
            break;
        // Thêm các trường hợp khác nếu cần
        default:
            $points = $weight * 5; // Ví dụ mặc định
            break;
    }

    // Cập nhật dữ liệu vào cơ sở dữ liệu
    // Đây là một ví dụ cập nhật với Eloquent, bạn cần điều chỉnh phù hợp với cấu trúc cơ sở dữ liệu của bạn
    $trashType = TypeTrash::find($trashType);

    if ($trashType) {
        $trashType->weightable += $weight;
        $trashType->save();
        $user->points += $points;
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
    echo "<script>alert('Cộng điểm thành công');</script>";
    // Redirect người dùng sau khi xử lý xong
    return redirect('/user_client');
}

}
