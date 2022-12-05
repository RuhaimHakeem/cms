@extends('layouts.layout')
@section('content')
@section('drop_select','here show')
@section('title_select','UPDATE CHEQUE DATA ')
{{-- @section('title_select','Cheque Update') --}}

<div id="kt_app_content" class="app-content flex-column-fluid col-8 col-sm-8  col-md-4 col-lg-4 col-xl-4 col-xxl-4">
 <!--   <button onclick="history.back()" class="btnback mx-5 mt-5"><i class="fa-solid fa-angles-left"
            style="color:white;margin-top:0.2rem"></i></button> -->
    <div class="mt-10 mb-5 px-5">

        <h2 style="font-size:20px">UPDATE CHEQUE DATA</h2>
    </div>
    <!--begin::Content container-->

    <form class="form w-100 px-5 " action="/updatecheque4/{{$cheque->id}}" method="post" enctype="multipart/form-data">
       
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
           
           <input  type="text" placeholder="Cheque Number" name="chequenumber" autocomplete="off"
                 class="form-control bg-transparent" value="{{$cheque->chequenumber}}">
             <span class="text-danger">@error('chequenumber') {{$message}} @enderror</span>       
            
         </div>




        <!--begin::Submit button-->
        <button type="submit" class="btnfile"><i class="fa-sharp fa-solid fa-file-import" style="color:white"></i>
            Update</button>
        <!--end::Submit button-->
    </form>



</div>
@endsection
<!--end::Content-->