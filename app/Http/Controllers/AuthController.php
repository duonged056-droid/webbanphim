<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Kiểm tra xem tài khoản có bị khoá không
            if (!$user->is_active) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors([
                    'email' => 'Tài khoản của bạn đã bị khoá. Vui lòng liên hệ quản trị viên.',
                ])->withInput();
            }

            // Cập nhật lần đăng nhập gần nhất
            $user->last_login_at = now();
            $user->save();

            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->intended('admin/sanpham')->with('success', 'Đăng nhập thành công với quyền Admin!');
            }
            return redirect()->intended('/')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Bạn đã đăng xuất.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'so_dien_thoai' => 'nullable|string|max:20',
            'dia_chi'       => 'nullable|string|max:500',
        ], [
            'password.min'  => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'email.unique'  => 'Email này đã được sử dụng.',
        ]);

        $user = \App\Models\User::create([
            'name'          => $validatedData['name'],
            'email'         => $validatedData['email'],
            'password'      => bcrypt($validatedData['password']),
            'so_dien_thoai' => $request->so_dien_thoai ?? null,
            'dia_chi'       => $request->dia_chi ?? null,
            'role'          => 'customer',
            'is_active'     => true,
            'last_login_at' => now(),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Đăng ký tài khoản thành công!');
    }
}
