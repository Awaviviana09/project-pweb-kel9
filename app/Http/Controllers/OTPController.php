<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Str;   
use App\Mail\AccountActivation;
use Illuminate\Http\Request;

class OTPController extends Controller
{
    public function index(Request $request){
        if (Auth::check()) {
            return redirect(route('index'));
        }

        return view('auth.accountActivation');
    }   

    // When user input the otp!!
    public function validatingOTP(Request $request){
        // Data OK
        // dd(Session::get('stackData'), Session::get('otpKey'));
        $otpKey = Session::get('otpKey');
        $data = Session::get('stackData');
        $userinput_otp = $request->otp;
        
        // dd($data['username'], $data['email'], $data['password']);

        
        // Create to database
        if($userinput_otp == $otpKey){
            User::create([
                'username'=> $data['username'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
            
            // Succesfully Registered! 
            
            // Delete session
            Session::forget('otpKey');
            Session::forget('stackData');

            return redirect()
            ->route('auth.form')
            ->with('msg',"You`re successfully registered!!!");
        }
        
        return redirect(route('auth.AccountActivation'))->with('otpFailed', 'Invalid OTP Code or Expired');
        
    }
}
