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
    | Controller ini menangani otentikasi pengguna untuk aplikasi dan
    | mengarahkan mereka ke halaman dashboard sesuai dengan role masing-masing.
    |
    |--------------------------------------------------------------------------
    */

    use AuthenticatesUsers;

    /**
     * Membuat instance controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Menentukan jalur pengalihan setelah pengguna berhasil login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $role = auth()->user()->role;

        switch ($role) {
            case 'admin_pusat':
                return '/admin/dashboard';
            case 'pem_kecamatan':
                return '/kecamatan/dashboard';
            default:
                return '/warga/dashboard';
        }
    }
}