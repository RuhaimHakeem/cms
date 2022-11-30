<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Mail\OtpMail;
use App\Models\Chequedetail;
use App\Models\Payto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use DB;
use DataTables;

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

    public function dashboard(Request $request) {
        $payto = DB::table('paytos')->get();
   
        return view('/dashboard', [
            'payto' => $payto,
    
        ]);



        return view('dashboard');
    }

    public function chequedata() {
        return view('chequedata');
    }
    public function details(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->from_date))
            {
            $data = DB::table('chequedetails')
                ->whereBetween('depositdate', array($request->from_date, $request->to_date))
                ->get();
            }
            else if(!empty($request->status)) {
                if($request->status == 'All') {
                    $data = DB::table('chequedetails')
                    ->orderBy('created_at', 'desc')
                    ->get();
                }
        
                else {
                    $data = DB::table('chequedetails')
                    ->where('status', '=',  $request->status )
                    ->orderBy('created_at', 'desc')
                    ->get();
                }
            }
            else
            {
            $data = DB::table('chequedetails')
                ->get();
            }
            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<div style="width: 12rem"> <a href="/updatechequedetail/'. $row->id .'" class="edit btn btn-success btn-sm">Edit</a> <a href="/chequedetail/'. $row->id .'" class="delete btn btn-secondary btn-sm">View</a> </div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])->make(true);
        }
            return view('chequedetails');
    }

    public function updatechequedetail($id) {
        $chequedetail = Chequedetail::where('id','=', $id)->first();

        return view('updatechequedetail', [
            'chequedetail' => $chequedetail,
        ]);
    }

    public function updatecheque(Request $request, $id) {
        
            $chequedetail =  Chequedetail::where('id','=', $id)->first();
            $chequedetail->depositdate = $request->depositdate;
            $chequedetail->payto = $request->payto;
            $chequedetail->amount = $request->amount;
            $chequedetail->currency = $request->currency;
            $chequedetail->accountholdername = $request->accountholdername;
            $chequedetail->accountholdernumber = $request->accountholdernumber;
            $chequedetail->chequenumber = $request->chequenumber;
            $chequedetail->bankcode = $request->bankcode;
            $chequedetail->branchcode = $request->branchcode;
            $chequedetail->status = $request->status;

            if($request->file('image')){
                $file= $request->file('image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('public/Image'), $filename);
                $chequedetail->image = $filename;
            }
     
        $res = $chequedetail->update();

            

        if($res) {
            return back()->with('success',"Cheque details updated");
        }

        else {
            return back()->with('fail',"Something went wrong");
        }
    }
    

    public function chequedetails() {

        $chequedetails = Chequedetail::orderBy('created_at', 'desc')->get();   
        
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

        if(!is_numeric($request->amount)) {
            return back()->with('fail',"Amount should only contain numbers");
        }
        else {
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
            $chequedetail->status = $request->status;

            if($request->file('image')){
                $file= $request->file('image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('public/Image'), $filename);
                $chequedetail->image = $filename;

                // $destination =  "/xampp/htdocs/cms/cms/public/public/Image" 
            } 
            $res = $chequedetail->save();
        }        

            

        if(isset($res)) {
            return back()->with('success',"Cheque details added");
        }

        else {
            return back()->with('fail',"Something went wrong");
        }
    }

    public function chequedatastore(Request $request){
 
        $request->validate([
            'payto'=>'required'
        ]);
            $payto = new Payto; 
            $payto->payto = $request->payto;


         
            $res = $payto->save();
             

            

        if(isset($res)) {
            return back()->with('success',"Cheque data added");
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