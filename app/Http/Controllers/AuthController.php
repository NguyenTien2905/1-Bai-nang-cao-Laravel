<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $dataInput = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);


        if (Auth::attempt($dataInput)) {

            $request->session()->regenerate();
            // Phương thức ngăn chặn tấn công bằng CSRF bằng session ID
            if (Auth::user()->type === 0) {
                return redirect()->intended('/admin');
                // Chuyển hướng đến trang yêu cầu trc đó
            }
            return redirect()->intended('admin');
        }

        return redirect()->back();
    }



    public function showFormRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $dataInput = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        User::query()->create($dataInput);

        return redirect()->route('home');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        //Hủy bỏ session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
