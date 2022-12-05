<?php

namespace App\Http\Controllers;


use DB;
use DataTables;
use App\Models\Bank;
use App\Models\User;
use App\Mail\OtpMail;
use App\Models\Payto;
use App\Models\Cheque;
use App\Models\Account;
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

    public function editchequedata($id) {
 
        $payto = Payto::where('id','=', $id)->first();

        return view('editchequedata', [
            'payto' => $payto,
        ]);

      

     
    }

    public function editaccountdata($id) {
 
        $account = Account::where('id','=', $id)->first();

        return view('editaccountdata', [
            'account' => $account,
        ]);

      

     
    }

    public function editchequenodata($id) {
 
        $cheque = Cheque::where('id','=', $id)->first();

        return view('editchequenodata', [
            'cheque' => $cheque,
        ]);

      

     
    }

    public function editchequebankdata($id) {
 
        $bank = Bank::where('id','=', $id)->first();

        return view('editchequebankdata', [
            'bank' => $bank,
        ]);

      

     
    }


    public function dashboard(Request $request) {
        $id = Payto::where('id','!=', null)->get();
        $payto = Payto::where('payto','!=', null)->get();
        $account = Account::where('accountholdername','!=', null)->get();
        $accounts = Account::where('accountholdernumber','!=', null)->get();
        $cheque = Cheque::where('chequenumber','!=', null)->get();
        $bank = Bank::where('bankname','!=', null)->get();
        return view('/dashboard', [
            'id' => $id,
            'payto' => $payto,
            'accountholdername' => $account,
            'accountholdernumber' => $accounts,
            'chequenumber' => $cheque,
            'bankname' => $bank,
    
        ]);



        return view('dashboard');
    }


    public function updatechequedata($id){
      
        $paytos = Payto::where('id','=', $id)->first();
        $payto = Payto::findOrFail($id);
        $res = $payto->delete();
  
        if($res) {
            return redirect('updatechequedata')->with('success','row deleted successfully');
        }
        else {
            return redirect('updatechequedata')->with('fail','Something went wrong. Please try again');
        }
     }



     


    public function chequedata() {
        return view('chequedata');
    }
    public function data(Request $request) {
        if(request()->ajax())
        {

            $data = Payto::where('payto','!=', null)->get();
            $data = Payto::where('created_at','!=', null)->get();
            $data = Payto::where('updated_at','!=', null)->get();
            
            return datatables()->of($data)->make(true);
        }
        return view('updatechequedata');
    }

    public function data2(Request $request) {
        if(request()->ajax())
        {

            $data2 = Account::where('accountholdername','!=', null)->get();
            $data2 = Account::where('accountholdernumber','!=', null)->get();
            $data2 = Account::where('created_at','!=', null)->get();
            $data2 = Account::where('updated_at','!=', null)->get();
            
            return datatables()->of($data2)->make(true);
        }
        return view('updatechequedata');
    }

    public function data3(Request $request) {
        if(request()->ajax())
        {

            $data3 = Cheque::where('chequenumber','!=', null)->get();
            $data3 = Cheque::where('created_at','!=', null)->get();
            $data3 = Cheque::where('updated_at','!=', null)->get();
            
            return datatables()->of($data3)->make(true);
        }
        return view('updatechequedata');
    }

    public function data4(Request $request) {
        if(request()->ajax())
        {

            $data4 = Bank::where('bankname','!=', null)->get();
            $data4 = Bank::where('created_at','!=', null)->get();
            $data4 = Bank::where('updated_at','!=', null)->get();
            
            return datatables()->of($data4)->make(true);
        }
        return view('updatechequedata');
    }

    public function deletelead($id){

        $payto = Payto::findOrFail($id);
        $res = $payto->delete();
  
        if($res) {
            return redirect('/updatechequedata')->with('success','Lead deleted successfully');
        }
        else {
            return redirect('/updatechequedata')->with('fail','Something went wrong. Please try again');
        }
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
            else if(!empty($request->keyword)) {
                $data = DB::table('chequedetails')
                ->where('accountholdername', 'like', '%'.$request->keyword.'%')
                ->orWhere('payto', 'like', '%'.$request->keyword.'%')
                ->orWhere('amount', 'like', '%'.$request->keyword.'%')
                ->orWhere('accountholdernumber', 'like', '%'.$request->keyword.'%')
                ->orWhere('chequenumber', 'like', '%'.$request->keyword.'%')
                ->orWhere('bankname', 'like', '%'.$request->keyword.'%')
                ->orWhere('branchname', 'like', '%'.$request->keyword.'%')
                ->orWhere('depositdate', 'like', '%'.$request->keyword.'%')
                ->orWhere('status', 'like', '%'.$request->keyword.'%')
                ->get();
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
            $chequedetail->bankname = $request->bankname;
            $chequedetail->branchname = $request->branchname;
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
    
    public function updatecheque2(Request $request, $id) {
        
        $payto =  Payto::where('id','=', $id)->first();
        $payto->payto = $request->payto;
      

  
    $res = $payto->update();

        

    if($res) {
        return back()->with('success',"Cheque details updated");
    }

    else {
        return back()->with('fail',"Something went wrong");
    }
}

public function updatecheque3(Request $request, $id) {
        
    $account =  Account::where('id','=', $id)->first();
    $account->accountholdername = $request->accountholdername;
    $account->accountholdernumber = $request->accountholdernumber;
  


$res = $account->update();

    

if($res) {
    return back()->with('success'," Details Updated");
}

else {
    return back()->with('fail',"Something went wrong");
}
}

public function updatecheque4(Request $request, $id) {
        
    $cheque =  Cheque::where('id','=', $id)->first();
    $cheque->chequenumber = $request->chequenumber;

  


$res = $cheque->update();

    

if($res) {
    return back()->with('success'," Details Updated");
}

else {
    return back()->with('fail',"Something went wrong");
}
}


public function updatecheque5(Request $request, $id) {
        
    $bank =  Bank::where('id','=', $id)->first();
    $bank->bankname = $request->bankname;

  


$res = $bank->update();

    

if($res) {
    return back()->with('success'," Details Updated");
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
            $chequedetail->bankname = $request->bankname;
            $chequedetail->branchname = $request->branchname;
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
 
      
            $payto = new Payto; 
            $accounts= new Account;
            $banks= new Bank;
            $cheques= new Cheque;
            
            if($request->payto) {
                $payto->payto = $request->payto;
                $res = $payto->save();
            }

            if($request->accountholdername || $request->accountholdernumber ) {
                $accounts->accountholdername = $request->accountholdername;
                $accounts->accountholdernumber = $request->accountholdernumber;
                $resacc = $accounts->save();
            }

            if($request->chequenumber) {
                $cheques->chequenumber = $request->chequenumber;
                $rescheque = $cheques->save();
            }

            if($request->bankname) {
                $banks->bankname = $request->bankname;
                $resbank = $banks->save();
            }

            

        if(isset($res) || isset($resacc) ||  isset($rescheque) || isset($resbank) ) {
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