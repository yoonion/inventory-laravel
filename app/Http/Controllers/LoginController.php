<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // 입력 값 검증
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
        } catch (ValidationException $exception) {
            return redirect()
                ->back()
                ->withErrors($exception->errors())
                ->withInput()
                ->with('error', '입력 값 검증 실패');
        }

        // 인증 처리
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()
                ->intended()
                ->with('success', '로그인에 성공하였습니다.');
        }

        // 인증 실패 시
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'AUTH FAIL');
    }
}
