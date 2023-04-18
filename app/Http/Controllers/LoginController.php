<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function loginform(Request $request){
        if (Auth::check()) {
            return redirect()->route('user.page');
        }else{
            return view('Loginpage');
        }
    }



    public function login(Request $request)
    {
        // Kiểm tra tính hợp lệ của đầu vào
        $this->validate($request, ['email' => 'required|email',
                                'password' => 'required|min:6']);
        
        // Lấy thông tin đăng nhập từ đầu vào
        $credentials = $request->only('email', 'password');
        

        // Thực hiện đăng nhập và kiểm tra tính hợp lệ
        if (Auth::attempt($credentials, $request->remember)) {
            // Nếu đăng nhập thành công, chuyển hướng đến trang người dùng
            // return redirect()->intended('/Userpage');
            if ($request->remember) {
                auth()->user()->remember_token = Str::random(60);
                auth()->user()->save();
                Cookie::queue('remember_token', auth()->user()->remember_token, 1440);
            }

            return redirect()->route('user.page');

        } else {
            // Nếu đăng nhập không thành công, chuyển hướng đến trang đăng nhập và hiển thị thông báo lỗi
            return redirect()->back()->withErrors(['email' => 'Invalid email or password']);
            // $users = User::all();
        
            // $user = $users->first();
            // dd($users,$credentials);
        }
        
    }


}