<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function user(){
    //     return ['name'=>'John Doe',
    //             'email'=>'example@gmail.com'];
    // }
  public function login(){
    return inertia('User/Login');
  }
  public function verifyLogin(Request $request){
    // validate user login
        $request->validate([
                'email'=>'required|email',
                'password'=>'required',
                'remember'=>'nullable|boolean'
        ]);

        $user=User::where('email',$request->email)->first();
        if($user){
          $encriptedPassword=$user->password;
          $checkPassword =Hash::check($request->password,$encriptedPassword);
          if($checkPassword){
            //login here
            Auth::login($user,$request->remember);
            $request->session()->regenerate();
            return redirect()->to('/dashboard');
          }
        }


        // $adminUser=AdminUser::where('email',$request->email)->first();
        // if($adminUser){
        //   $encriptedPassword=$adminUser->password;
        //   $checkPassword =Hash::check($request->password,$encriptedPassword);
        //   if($checkPassword){
        //     //login here
        //     Auth::guard('admin')->login($adminUser,$request->remember);
        //     $request->session()->regenerate();
        //     return redirect()->to('/is-admin');
        //   }
        // }
  }

  public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    return redirect()->route('login');
  }
  

}
