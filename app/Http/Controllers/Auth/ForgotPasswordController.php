<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use function PHPUnit\Framework\isEmpty;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

//    public function forgot(){
//        return view('auth.passwords.email');
//    }
//
//    public function password(Request $request){
//        $user = User::where('email', "like", $request->email)->first();
//
//        if($user == 'null'){
//            return redirect()->back()->with(['error' => 'Nie ma takie adresu Email']);
//        }
//        dd('cza');
//
//        $user = RedisSentinel::findById($user->id);
//
//
//    }



}
