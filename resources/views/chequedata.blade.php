@extends('layouts.layout')
@section('content')
@section('addcheque_select','active')
@section('drop_select','here show')
@section('title_select','ADD CHEQUE DATA ')
{{-- @section('title_select','Lead Update') --}}

<div id="kt_app_content" class="app-content flex-column-fluid col-8 col-sm-8  col-md-4 col-lg-4 col-xl-4 col-xxl-4">
 <!--   <button onclick="history.back()" class="btnback mx-5 mt-5"><i class="fa-solid fa-angles-left"
            style="color:white;margin-top:0.2rem"></i></button> -->
    <div class="mt-10 mb-5 px-5">

        <h2 style="font-size:20px">ADD CHEQUE DATA</h2>
    </div>
    <!--begin::Content container-->

    <form class="form w-100 px-5 " action="/chequedatastore" method="post" enctype="multipart/form-data">
       
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
           
          <input  type="text" placeholder="Pay To(name)" name="payto" autocomplete="off"
                class="form-control bg-transparent" value={{old('payto')}} >
            <span class="text-danger">@error('payto') {{$message}} @enderror</span>
       
            
           
        </div>

   
<!--
        <div class="fv-row mb-8">
            
        <input required type="text" placeholder="Enter Account Holder Name" name="accountholdername" autocomplete="off"
                class="form-control bg-transparent" value={{old('accountholdername')}} > 
            <span class="text-danger">@error('accountholdername') {{$message}} @enderror</span>
         
            
        </div>

        <div class="fv-row mb-8">
           
          <input required type="text" placeholder="Enter Account Holder Number" name="accountholdernumber" autocomplete="off"
                class="form-control bg-transparent" value={{old('accountholdernumber')}}> 
            <span class="text-danger">@error('accountholdernumber') {{$message}} @enderror</span>
            
        </div>

        <div class="fv-row mb-8">
           
          <input required type="text" placeholder="Enter Cheque Number" name="chequenumber" autocomplete="off" class="form-control bg-transparent"
                value={{old('chequenumber')}} > 
            <span class="text-danger">@error('amount') {{$message}} @enderror</span>
           
        </div>

       

        <div class="fv-row mb-8">
           
          <input required type="text" placeholder="Enter Bank Code" name="bankcode" autocomplete="off"
                class="form-control bg-transparent" value={{old('bankcode')}}> 
            <span class="text-danger">@error('bankcode') {{$message}} @enderror</span>
          
        </div>

        <div class="fv-row mb-8">
            
        <input required type="text" placeholder="Enter Branch Code" name="branchcode" autocomplete="off"
                class="form-control bg-transparent" value={{old('branchcode')}}> 
            <span class="text-danger">@error('branchcode') {{$message}} @enderror</span>
           
        </div> 
-->
  

    
    
        <!--begin::Submit button-->
        <button type="submit" class="btnfile"><i class="fa-sharp fa-solid fa-file-import" style="color:white"></i>
            Save</button>
        <!--end::Submit button-->
    </form>



</div>
@endsection
<!--end::Content-->