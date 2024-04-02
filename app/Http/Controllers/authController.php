<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Trash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  public function signinPage(Request $request){
    $trashs = Trash::all();
    return view("auth.login", compact('trashs'));
   
  }
  public function login(Request $request)
  {
    // validate form
    $data = [
      'email' => $request->email,
      'password' => $request->password,
    ];
    
    if (Auth::attempt($data)) {
      
      $checking_role = User::where('email', $data['email'])->first();
      $_SESSION['role'] = $checking_role->role;
      if($request->location != null){
        $trash = $request->location;
        $checking_role->id_trash = $trash;
    $checking_role->save();
      }
    if($_SESSION['role'] == 1){
      return redirect('user_client');
    }
      return redirect('index');
    } else {
      session()->flash('error', 'Sai tài khoản hoặc mật khẩu!');
      return redirect('/sign-in');
    }
  }
  public function logout()
  {
    Auth::logout();
    return redirect('/');
  }

  public function signup(Request $request)
  {
    $trashs = Trash::all();

    if ($request->isMethod('post')) {
      $errors = [];

      // Validation
      $validator = Validator::make($request->all(), [
        'username' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'location' => 'required',
      ]);
      if (!empty($validator->errors()->messages())) {
        foreach ($validator->errors()->messages() as $index) {
          foreach ($index as $key) {
            $errors[] = $key;
          }
        }
        session()->flash('errors', $errors);
        return redirect('signup');
      }
      // Create User
      $user = new User();
      $user->name = $request->username;
      $user->id_trash = $request->location;
      $user->email = $request->email;
      $user->role = 1;
      $user->password = bcrypt($request->password);
      $user->save();
      if ($user) {
        session()->flash('success', 'Đăng ký tài khoản thành công');
      }
    }
    return view('auth.signup', compact('trashs'));
  }
}
