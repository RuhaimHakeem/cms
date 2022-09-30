<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Mail\OtpMail;
use App\Models\Chequedetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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

    public function dashboard() {
        return view('dashboard');
    }

    public function chequedetails() {

        $chequedetails = Chequedetail::all();
        
        return view('chequedetails', [
            'chequedetails' => $chequedetails,
        ]);
    }

    public function chequedetail($id) {

        $chequedetail = Chequedetail::where('id','=', $id)->first();
        
        return view('chequedetail', [
            'chequedetail' => $chequedetail,
        ]);
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
                $user->verified = true;
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
                    return redirect('/chequedetails');     
            }
            
            else {
                return back()->with('fail','The pin is incorrect');
            }  
        }
        else {
            return redirect('login')->with('fail','You have been logged out. Please try again');
        }
           
           
    }

    public function store(Request $request) {

        
            $chequedetail = new Chequedetail; 
            $chequedetail->depositdate = $request->depositdate;
            $chequedetail->payto = $request->payto;
            $chequedetail->amount = $request->amount;
            $chequedetail->currency = $request->currency;
            $chequedetail->accountholdername = $request->accountholdername;
            $chequedetail->accountholdernumber = $request->accountholdernumber;
            $chequedetail->chequenumber = $request->chequenumber;
            $chequedetail->bankcode = $request->bankcode;
            $chequedetail->branchcode = $request->branchcode;

            if($request->file('image')){
                $file= $request->file('image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('public/Image'), $filename);
                $chequedetail->image = $filename;
            }
     
        $res = $chequedetail->save();

            

        if($res) {
            return back()->with('success',"Cheque details added");
        }

        else {
            return back()->with('fail',"Something went wrong");
        }
    }

    public function logout(){

        $userId = Session::get('loginId');;
    
        $user = User::where('id','=', $userId)->first();
    
        if(Session::has('loginId')){
            $user->verified = false;
            $user->update();
            Session::pull('loginId');
            Session::forget('loginId');
    
            return redirect('login');
        }
    }

}