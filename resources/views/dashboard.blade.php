@extends('layouts.layout')
@section('content')
@section('add_select','active')
@section('drop_select','here show')
@section('title_select','ADD')
{{-- @section('title_select','Lead Update') --}}

<div id="kt_app_content" class="app-content flex-column-fluid col-8 col-sm-8  col-md-4 col-lg-4 col-xl-4 col-xxl-4">
 <!--   <button onclick="history.back()" class="btnback mx-5 mt-5"><i class="fa-solid fa-angles-left"
            style="color:white;margin-top:0.2rem"></i></button> -->
    <div class="mt-10 mb-5 px-5">

        <h2 style="font-size:20px">CHEQUE DETAILS</h2>
    </div>
    <!--begin::Content container-->

    <form  class="form w-100 px-5 " action="/store" method="post" enctype="multipart/form-data">
        @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif
        @csrf


        <!--begin::Heading-->
        <!--begin::Login options-->

        <!--end::Login options-->
        <!--begin::Separator-->

        <!--end::Separator-->
        <!--begin::Input group=-->    
    

<div class="fv-row mb-8">
    <div class="d-flex">
        <div class="form-group">
            <label class="bg-transparent ">
                <div class="box fw-bold ">
                <label class="me-6"  for="">Status Update :</label>
                    <select name="status" id="status" class="form-control m-5 box fw-bold" style="width:13rem">
                        <option value='In Hand'>In Hand</option>
                        <option value='Deposited'>Deposited</option>
                        <option value='Returned'>Returned</option>         
                    </select>
                </div>
            </label>
        </div>
    </div>
</div>
        <div class="d-flex fv-row mb-8">
            <label class="me-6 form-control bg-transparent" for="">Deposit Date</label>
            <input required class="form-control bg-transparent" type="date"  name="depositdate" >
        </div>

        <div class="fv-row mb-8">
           
          <!--<input  type="text" placeholder="Pay To" name="payto" autocomplete="off"
                class="form-control bg-transparent" value={{old('payto')}} >
            <span class="text-danger">@error('payto') {{$message}} @enderror</span>-->
            <span class="text-danger">@error('payto') {{$message}} @enderror</span>
            <div class="d-flex fv-row mb-8">
            <label class="me-6 form-control bg-transparent" for="">Pay To</label>
<div class="form-group">
    
<label class="d-flex bg-transparent ">
        <div class="box fw-bold ">

            <select name="payto" id="payto" class="form-control" style="width:11rem">
            
                @foreach($payto as $payto)
                <option value='{{$payto->payto}}'>{{$payto->payto}}</option>
                @endforeach

            </select>
           
        </div>
    </label>
</div> 
</div> 
            
           
        </div>

        <div class="fv-row mb-8 d-flex align-items-center">
           
            <input required type="text" style="width: 10rem" placeholder="Enter Amount" name="amount" autocomplete="off" class="form-control bg-transparent"
                value={{old('amount')}}>
            <span class="text-danger">@error('amount') {{$message}} @enderror</span>

            <div class="form-group">
                <label class="bg-transparent">
                    <div class="fw-bold" style="width: 6rem">
                        <select name="currency" class="form-control ms-2" style="-webkit-appearance: button;">            
                            <option value='LKR' selected>LKR</option>
                        </select>
                    </div>
                </label>
            </div>     
        </div>

        <div class="fv-row mb-8">
            
     <!--      <input required type="text" placeholder="Enter Account Holder Name" name="accountholdername" autocomplete="off"
                class="form-control bg-transparent" value={{old('accountholdername')}} > -->
            <span class="text-danger">@error('accountholdername') {{$message}} @enderror</span>
              <div class="d-flex fv-row mb-8">
            <label class="me-6 form-control bg-transparent" for="">Enter Account Holder Name</label>
<div class="form-group">
    
<label class="d-flex bg-transparent ">
        <div class="box fw-bold ">

            <select name="accountholdername" id="accountholdername" class="form-control" style="width:11rem">
            
                @foreach($accountholdername as $accountholdername)
                <option value='{{$accountholdername->accountholdername}}'>{{$accountholdername->accountholdername}}</option>
                @endforeach

            </select>
           
        </div>
    </label>
</div> 
</div> 
            
        </div>

        <div class="fv-row mb-8">
           
            <!--       <input required type="text" placeholder="Enter Account Holder Number" name="accountholdernumber" autocomplete="off"
                class="form-control bg-transparent" value={{old('accountholdernumber')}}>  -->
            <span class="text-danger">@error('accountholdernumber') {{$message}} @enderror</span>
      <div class="d-flex fv-row mb-8">
            <label class="me-6 form-control bg-transparent" for="">Enter Account Holder Number</label>
<div class="form-group">
    
<label class="d-flex bg-transparent ">
        <div class="box fw-bold ">

            <select name="accountholdernumber" id="accountholdernumber" class="form-control" style="width:11rem">
            
                @foreach($accountholdernumber as $accountholdernumber)
                <option value='{{$accountholdernumber->accountholdernumber}}'>{{$accountholdernumber->accountholdernumber}}</option>
                @endforeach

            </select>
           
        </div>
    </label>
</div> 
</div>
        </div>

        <div class="fv-row mb-8">
           
         <!--    <input required type="text" placeholder="Enter Cheque Number" name="chequenumber" autocomplete="off" class="form-control bg-transparent"
                value={{old('chequenumber')}} > -->
            <span class="text-danger">@error('amount') {{$message}} @enderror</span>
           <div class="d-flex fv-row mb-8">
            <label class="me-6 form-control bg-transparent" for="">Enter Cheque Number</label>
<div class="form-group">
    
<label class="d-flex bg-transparent ">
        <div class="box fw-bold ">

            <select name="chequenumber" id="chequenumber" class="form-control" style="width:11rem">
            
                @foreach($chequenumber as $chequenumber)
                <option value='{{$chequenumber->chequenumber}}'>{{$chequenumber->chequenumber}}</option>
                @endforeach

            </select>
           
        </div>
    </label>
</div> 
</div> 
        </div>

       

        <div class="fv-row mb-8">
           
     <!--      <input required type="text" placeholder="Enter Bank Code" name="bankname" autocomplete="off"
                class="form-control bg-transparent" value={{old('bankname')}}> -->
            <span class="text-danger">@error('bankname') {{$message}} @enderror</span>
             <div class="d-flex fv-row mb-8">
            <label class="me-6 form-control bg-transparent" for="">Enter Bank Name</label>
            <label class="d-flex bg-transparent ">
        <div class="box fw-bold ">

            <select name="bankname" id="bankname" class="form-control" style="width:11rem">
            
                @foreach($bankname as $bankname)
                <option value='{{$bankname->bankname}}'>{{$bankname->bankname}}</option>
                @endforeach

            </select>
           
        </div>
    </label>
</div> 
</div> 
       

        <div class="fv-row mb-8">
            
          <input required type="text" placeholder="Enter Branch Name" name="branchname" autocomplete="off"
                class="form-control bg-transparent" value={{old('branchname')}}>
         <!--     <span class="text-danger">@error('branchname') {{$message}} @enderror</span>
            <div class="d-flex fv-row mb-8">
            <label class="me-6 form-control bg-transparent" for="">Enter Branch Code</label>
<div class="form-group">
    
    <label class="bg-transparent">
        <div class="fw-bold" style="width: 11rem">
            <select name="branchname" class="form-control ms-2" style="-webkit-appearance: button;">         
                <option value='001' selected>001</option>
                <option value='002'>002</option>
    
            </select>
        </div>
    </label>
</div> 
</div>  -->
        </div>

  

        <div class="fv-row mb-8">
            <label><h4>Picture Of Cheque</h4></label>
            <input type="file" name="image" class="form-control" required >
        </div>

    
        <!--begin::Submit button-->
        <button type="submit" class="btnfile"><i class="fa-sharp fa-solid fa-file-import" style="color:white"></i>
            Save</button>
        <!--end::Submit button-->
    </form>



</div>
@endsection
<!--end::Content-->