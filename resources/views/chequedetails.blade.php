@extends('layouts.layout')
@section('content')



<div class="mt-10 m-5 ">

    <h2 style="font-size:20px" class="mb-5">CHEQUE DETAILS</h2>


    <!--end::Title-->
    <!--begin::Subtitle-->

    <!--end::Subtitle=-->
    {{-- <div class="d-flex">
        <div class="d-flex fv-row mb-8 w-25 ">
            <label class="me-6 form-control bg-transparent" style="width:5rem;font-weight:bold" for="">From</label>
            <input class="form-control bg-transparent" type="date" id="from" name="from">
        </div>

        <div class="d-flex fv-row mb-8 w-25">
            <label class="me-6 form-control bg-transparent mx-5" style="width:5rem;font-weight:bold" for="">To</label>
            <input class="form-control bg-transparent " type="date" id="to" name="to">
        </div>
    </div>
    <button type="submit" id="search" class="btnfile"><i class="fa-solid fa-filter" style="color:white"></i>
        <!--begin::Indicator label-->
        <span class="indicator-label">Filter</span>
        <!--end::Indicator label-->
        <!--begin::Indicator progress-->
        <!--end::Indicator progress-->
    </button> --}}
</div>
<table class="table ms-5 mt-10 ">

    <thead>
        <tr>
            <th id="th" scope="col">Account Holder Name</th>
            <th id="th" scope="col">Paid To</th>
            <th id="th" scope="col">Amount</th>
            <th id="th" scope="col">Cheque Number</th>
            <th id="th" scope="col"></th>


        </tr>
    </thead>
    @if(count($chequedetails) > 0)
    <tbody>
        @foreach($chequedetails as $chequedetail)
        <tr>
            <td>{{$chequedetail->accountholdername}}</td>
            <td>{{$chequedetail->payto}}</td>
            {{-- @if ($lead->reminder)
            <td>{{date('m-d-Y', strtotime($lead->reminder))}}</td>
            @else
            <td>NULL</td>
            @endif --}}
           
            <td>{{$chequedetail->amount}} {{$chequedetail->currency}}</td>
            <td>{{$chequedetail->chequenumber}}</td>
            <td style="text-align:center ;">
                <a target="_blank" style="margin-right:3rem;margin-left:3rem" href="/chequedetail/{{$chequedetail->id}}' +
                        value.leadid +
                        '"><button class="btnfile"><i class="fa-solid fa-file-circle-check" style="color:white"></i>
                        View</button></a>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>
@endsection