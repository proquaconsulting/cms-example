<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\InfoModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $info = InfoModel::orderBy('id', 'DESC')->first();

        return view('admin.login', [
            'category' => CategoryModel::all(),
            'info' => $info
            ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/articles/');
        }

        return back()->withErrors([
            'loginError' => 'Username dan password tidak sesuai!',
        ])->onlyInput('username');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/admin');
    }
}
