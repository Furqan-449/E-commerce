<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Http\Request;
use App\Models\Auth\Admin; // Ensure the Admin model is imported
use Illuminate\Support\Facades\Auth;

class Admins extends Controller
{
    //
    public function index()
    {
        return view('auth.sing_up');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function  login_success(Request $request)
    {
        $validate = $request->validate([
            'email' => [
                'required',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', // Custom regex for email validation
            ],
            'password' => 'required',
        ], [
            'email.required' => 'Email is required',
            'email.regex' => 'Invalid email format (e.g.)',
        ]);

        $credentials = [
            'email' => strtolower($validate['email']),
            'password' => $validate['password'],
            'flag' => 1,
        ];

        // Attempt to log in with the provided credentials
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route("dashboard");
        }

        return redirect()->back()->withErrors(['noemail' => 'email or password is wrong'])->withInput();
    }

    public function admin_register(Request $request)
    {
        $valid = $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg |max:2048', // Validate image file
            'name' => 'required|string',
            'email' => [
                'required',
                'unique:admins,email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', // Custom regex for email validation
            ],
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%])[A-Za-z\d@#$%]+$/'
            ],
            'business' => 'required|string',
            'terms' => 'required|accepted', // Ensure terms are accepted
        ], [
            'email.required' => 'Email is required',
            'email.regex' => 'Invalid email format (e.g. you@domain.com)',
            'email.unique' => 'Email already exit',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character (@, #, $, %)',
            'profile_image.required' => 'Profile image is required',
            'terms.required' => 'You must accept the terms and conditions',
            'terms.accepted' => 'You must accept the terms and conditions',
        ]);
        $admin = new Admin();
        $path = $request->file('profile_image')->store('admins', 'public');
        $spl_path = explode('/', $path);
        $get_path = $spl_path[1];
        $admin->image = $get_path; // Store the image path
        $admin->fill($valid);
        $admin->save();


        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }

    public function delete_account()
    {
        $del_ad = Admin::deleteaccount();
        $del_ad->flag = 0;
        $del_ad->save();
        return redirect()->route('sign_up')->with('delete', 'Account Deleted!');
    }
}
