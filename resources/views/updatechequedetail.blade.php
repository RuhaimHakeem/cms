@extends('layouts.layout')
@section('content')
@section('title_select','UPDATE DETAILS')

<div id="kt_app_content" class="app-content flex-column-fluid col-6 col-sm-6  col-md-3 col-lg-3 col-xl-3 col-xxl-3">
 <!--   <button onclick="history.back()" class="btnback mx-5 mt-5"><i class="fa-solid fa-angles-left"
            style="color:white;margin-top:0.2rem"></i></button> -->
    <div class="mt-10 mb-5 px-5">

        <h2 style="font-size:20px">UPDATE CHEQUE DETAILS</h2>
    </div>
    <!--begin::Content container-->

    <form class="form w-100 px-5 " action="/updatecheque/{{$chequedetail->id}}" method="post" enctype="multipart/form-data">
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

        <div class="d-flex fv-row mb-8">
            <label class="me-6 form-control bg-transparent"  for="">Deposit Date</label>
            <input required class="form-control bg-transparent" type="date"  name="depositdate" value={{$chequedetail->depositdate}}>
        </div>

        <div class="fv-row mb-8 d-flex ">
            <label class="me-6 form-control bg-transparent" for="">Pay To</label>
           
            <input  type="text"  style="width: 10rem" placeholder="Pay To" name="payto" autocomplete="off"
                class="form-control bg-transparent" value={{$chequedetail->payto}} >
            <span class="text-danger">@error('payto') {{$message}} @enderror</span>
           
        </div>

        <div class="fv-row mb-8 d-flex align-items-center">
            <label class="me-6 form-control bg-transparent" for="">Amount</label>
            <input required type="text" style="width: 10rem" placeholder="Amount" name="amount" autocomplete="off" class="form-control bg-transparent"
                value={{$chequedetail->amount}}>
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

        <div class="fv-row mb-8 d-flex">
            <label class="me-6 form-control bg-transparent" style="width: 10rem" for="">Account Holder Name</label>
            <input required type="text"  style="width: 10rem" placeholder="Account Holder Name" name="accountholdername" autocomplete="off"
                class="form-control bg-transparent" value={{$chequedetail->accountholdername}} >
            <span class="text-danger">@error('accountholdername') {{$message}} @enderror</span>
            
        </div>

        <div class="fv-row mb-8 d-flex">
            <label class="me-6 form-control bg-transparent" for="">Account Holder Number</label>
            <input required type="text" placeholder="Account Holder Number" name="accountholdernumber" autocomplete="off"
                class="form-control bg-transparent" value={{$chequedetail->accountholdernumber}}>
            <span class="text-danger">@error('accountholdernumber') {{$message}} @enderror</span>
           
        </div>

        <div class="fv-row mb-8 d-flex align-items-center">
            <label class="me-6 form-control bg-transparent" for="">Cheque Number</label>
            <input required type="text" placeholder="Cheque Number" name="chequenumber" autocomplete="off" class="form-control bg-transparent"
                value={{$chequedetail->chequenumber}} >
            <span class="text-danger">@error('amount') {{$message}} @enderror</span>
           
        </div>

        <div class="fv-row mb-8 d-flex">
            <label class="me-6 form-control bg-transparent" for="">Bank Code</label>
            <input required type="text" placeholder="Bank Code" name="bankcode" autocomplete="off"
                class="form-control bg-transparent" value={{$chequedetail->bankcode}}>
            <span class="text-danger">@error('bankcode') {{$message}} @enderror</span>
          
        </div>

        <div class="fv-row mb-8 d-flex">
            <label class="me-6 form-control bg-transparent" for="">Branch Code</label>
            <input required type="text" placeholder="Branch Code" name="branchcode" autocomplete="off"
                class="form-control bg-transparent" value={{$chequedetail->branchcode}}>
            <span class="text-danger">@error('branchcode') {{$message}} @enderror</span>
            
        </div>

        <div class="fv-row mb-8">
            <label><h4>Picture Of Cheque</h4></label>
            <input type="file" name="image" class="form-control" >
        </div>

    
        <!--begin::Submit button-->
        <button type="submit" class="btnfile"><i class="fa-sharp fa-solid fa-file-import" style="color:white"></i>
            UPDATE</button>
        <!--end::Submit button-->
    </form>



</div>
@endsection
<!--end::Content-->