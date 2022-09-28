<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    } 

    public function index() {
        return view('index');
    }

    public function register() {
        return view('register');
    }

    public function email() {
        return view('email');
    }

    public function recaptcha(Request $request)
    {
        $token = $request->input('g-recaptcha-response');
    
        if(strlen($token) > 0 ){
            return redirect('/login');
        }
        else{
            
        $request->validate([
            'g-recaptcha-response' => 'required|captcha'
        ]);
                
        }
       
    }

    public function registeruser(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:users',
            'password'=>'required',
            'email' => 'required|unique:users',

        ]);
        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;

       $res = $user->save();
        

        if($res){
            return back()->with('success','You have registered successfuly');
        }
        else{
            return back()->with('fail','Something wrong');
        }
    }

    public function loginuser(Request $request){

       
        $request->validate([
            'name'=>'required',
            'password'=>'required'
        ]);
        
        $user = User::where('name','=',$request->name)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId',$user->id);

                $pin = mt_rand(1000000, 9999999);
                $user->verification_code = $pin;
                $user->save();

               Mail::to($user->email)->send(new OtpMail($pin));

               return redirect('email');

            }

                else{
                    return back()->with('fail','Password not matches.');
                }
            }
        
        else{
            return back()->with('fail','This username is not valid');
        }
    }

    public function emailuser(Request $request)
    {

        $userId = $request->session()->get('loginId');

        $user = User::where('id','=', $userId)->first();

        if($user){
            if($user->verification_code == $request->number){

                $user->verification_code = null;
                $user->verified = true;
                $user->update();    
                    return redirect('admindashboard');     
            }
            
            else {
                return back()->with('fail','The pin is incorrect');
            }  
        }
        else {
            return redirect('adminlogin')->with('fail','You have been logged out. Please try again');
        }
           
           
    }

}