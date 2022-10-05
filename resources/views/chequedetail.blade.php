@extends('layouts.layout')
@section('content')
@section('title_select','CHEQUE VIEW')
<div>
<!-- <button onclick="history.back()" class="btnback mx-5 mt-5"><i class="fa-solid fa-angles-left"
            style="color:white;margin-top:0.2rem"></i></button> -->
    <div class="mt-10 m-5 ">

        <div class="d-grid">

            <h2 style="font-size:20px">CHEQUE DETAIL</h2>


        </div>


        <table class="table mt-10 caption-top" style="max-width: 300px">
            <thead>
                <tr>
                    <th id="th">Deposit Date</th>
                    <td>{{date('m-d-Y', strtotime($chequedetail->depositdate))}}</td>
                </tr>
                <tr>
                    <th id="th">Paid To</th>
                    <td>{{$chequedetail->payto}}</td>
                </tr>
                <tr>
                    <th id="th">Amount</th>
                    <td>{{$chequedetail->amount}} {{$chequedetail->currency}}</td>
                </tr>
                <tr>
                    <th id="th">Account Holder Name</th>
                    <td>{{$chequedetail->accountholdername}}</td>
                </tr>
                <tr>
                    <th id="th">Account Holder Number</th>
                    <td>{{$chequedetail->accountholdernumber}}</td>
                </tr>

                <tr>
                    <th id="th">Cheque Number</th>
                    <td>{{$chequedetail->chequenumber}}</td>
                </tr>
                <tr>
                    <th id="th">Bank Code</th>
                    <td>{{$chequedetail->bankcode}}</td>
                </tr>
                <tr>
                    <th id="th">Branch Code</th>
                    <td>{{$chequedetail->branchcode}}</td>
                </tr>

                <tr>
                    <th style="margin-bottom: 2rem" id="th">Image</th>
                    <td></td>
                </tr>

            </thead>

        </table>
        <div class="d-flex w-25 mt-5">
            <label class="me-6 m-4 p-5 " style="width: 10px; background-color: #e4e4e4;" for="">Cheque Image</label>

        <img src="{{ url('public/Image/'.$chequedetail->image) }}"
                        style="height: 100px; width: 150px;">
        </div>

    </div>
</div>


@endsection