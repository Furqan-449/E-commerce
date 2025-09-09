<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Models\EndUser\EndUser;
use App\Mail\welcomeemail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;

class EnUser extends Controller
{
    //
    public function login_page()
    {
        return view('enduser.enduser_login');
    }
    public function google_login()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_redirect()
    {
        $google = Socialite::driver('google')->user();
        if ($google) {
            $finduser = EndUser::where('google_id', $google->id)->first();
            if ($finduser) {
                Auth::guard('endusers')->login($finduser);
                return redirect()->route('cart_items');
                // dd(Auth::guard('endusers')->user());
            } else {
                $newlogin = new EndUser();
                $newlogin->google_id = $google->id;
                $newlogin->name = $google->name;
                $newlogin->email = $google->email;
                $newlogin->password = bcrypt('7822Hassan@');
                $newlogin->save();
                if ($newlogin) {
                    Auth::guard('endusers')->login($newlogin);
                    return redirect()->route('cart_items');
                    // dd(Auth::guard('endusers')->user());
                }
            }
        }
        // dd($google);
    }
    public function singup_page()
    {
        return view('enduser.enduser_singup');
    }
    public function login_success(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('endusers')->attempt($validate)) {
            return redirect()->route('cart_items');
        }
        // If login fails, redirect back with error
        return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
    }
    public function singup(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required|string',
            'email' => [
                'required',
                'regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9._%+-]+\.[a-zA-Z]{2,}$/'
            ],
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%])[A-Za-z\d@#$%]+$/'
            ],
        ], [
            'email.required' => 'Email is required',
            'email.regex' => 'Invalid email format (e.g. you@domain.com)',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character (@, #, $, %)',
        ]);

        $check = EndUser::where('email', $valid['email'])->first();
        if ($check) {
            return redirect()->route('cart_items');
        }
        $user = new EndUser();
        $user->name = $valid['name'];
        $user->email = $valid['email'];
        $user->password = bcrypt($valid['password']);
        $user->save();
        // if ($user->save()) {
        $message = "welcome {$user->name} to TechShop";
        $subject = "welcome to";

        Mail::to($user->email)->send(new welcomeemail($message, $subject));
        // dd($response);
        return redirect()->route('login_page');
        // }
    }

    public function forget_password()
    {
        return view('enduser.forget_password');
    }

    public function forget_password_reset_link(Request $request)
    {
        $chkemail = $request->validate([
            'email' => 'required | email',
        ]);
        $status =  Password::broker('endusers')->sendResetLink([
            'email' => $chkemail['email']
        ]);
    }

    public function password_reset(Request $request, $token)
    {
        return view('enduser.reset_password', ['token' => $token, 'email' => $request->email]);
    }

    public function password_update(Request $request)
    {
        $valid = $request->validate([
            'token' => 'required',
            'email' => 'required | email',
            'password' => 'required | min:8 | confirmed',
        ]);
        $status = Password::broker('endusers')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forcefill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login_page')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function user_logout()
    {
        Auth::guard('endusers')->logout();
        return redirect()->route('cart_items');
    }
}
