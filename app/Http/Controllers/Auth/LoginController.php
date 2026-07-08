<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Mengatur arah redirect login secara dinamis berdasarkan role user
     */
    protected function redirectTo()
    {
        $role = auth()->user()->role;

        if ($role === 'admin_pusat') {
            return route('admin.dashboard');
        } elseif ($role === 'pem_kecamatan') {
            return route('kecamatan.dashboard');
        }

        return route('warga.dashboard');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}