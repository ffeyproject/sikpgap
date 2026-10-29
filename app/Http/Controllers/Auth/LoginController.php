<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the needed authorization credentials from the request.
     * Hanya pengguna dengan status = 1 (aktif) yang diizinkan untuk login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return array_merge(
            $request->only($this->username(), 'password'),
            ['status' => 1]
        );
    }

    /**
     * Get the failed login response instance.
     * Memberikan pesan khusus jika akun pengguna ditemukan dan password benar namun akun berstatus nonaktif.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $usernameVal = $request->input($this->username());
        $user = User::where($this->username(), $usernameVal)->first();

        // Jika user ditemukan dan password cocok, tetapi status dinonaktifkan (status == 0)
        if ($user && Hash::check($request->input('password'), $user->password) && !$user->status) {
            throw ValidationException::withMessages([
                $this->username() => ['Akun Anda sedang dinonaktifkan oleh Administrator. Anda tidak diizinkan masuk ke dalam sistem.'],
            ]);
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
