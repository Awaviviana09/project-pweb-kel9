<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountActivation;

class UserAuthController extends Controller
{
    public function form() {

        if (Auth::check()) {
            return redirect(route('index'));
        }

        return view("auth.form");
    }
    public function register_account(Request $request) {

        $d = $request->validate([
            'username' => 'required|alpha_dash:ascii|min:4|max:32|unique:users',
            'email'=> 'required|email|max:100|unique:users|ends_with:gmail.com',
            'password' => 'required|min:8|max:32'
        ]);

        
        // User::create([
            //     'username'=> $request->username,
            //     'email' => $request->email,
            //     'password' => Hash::make($request->password),
            // ]);
            // return redirect()
            //         ->route('auth.form')
            //         ->with('msg',"You`re successfully registered!!!");
            // ->withSuccess('You can now login with your registered credentials!');
        
        $d = [
            'username'=> $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        // session for otp and datauser that need activation
        $otpCode = substr((rand()%2+rand()), 0, 6);

        Session::put('otpKey',$otpCode);

        Session::put('stackData', $d);

        //sending email
        // Mail::to($request->data['email'])->send(new AccountActivation($otpCode));
        $mailData = [
            'title' => "OTP Code",
            'body'=> 'Your code : '.$otpCode,            
        ]; 

        // dd($request->email);

        try{
            Mail::to($request->email)->send(new AccountActivation($mailData));
            return redirect()->route('auth.AccountActivation');
        } catch (\Exception $e) {
            return redirect(route('auth.form'))->with('emailFailed','There`s something wrong with your email, try again');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|min:8|max:32'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('index');
        }

        return back()->withErrors([
            'msg' => 'Invalid email or password.',
        ])->onlyInput('email');
    } 

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.form');
    }  
}
