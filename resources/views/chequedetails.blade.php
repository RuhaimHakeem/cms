@extends('layouts.layout')
@section('content')
@section('home_select','active')
@section('drop_select','here show')
@section('title_select','CHEQUE DETAILS')


<div class="mt-10 m-5 ">

    <h2 style="font-size:20px" class="mb-5">CHEQUE DETAILS</h2>


    <!--end::Title-->
    <!--begin::Subtitle-->

    <!--end::Subtitle=-->
    <div class="d-flex">
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
    </button>
</div>
<div class="d-flex justify-content-end col-11 col-sm-11  col-md-11 col-lg-11 col-xl-11 col-xxl-11"
                            style="padding-right:1rem">
                            <a href="/dashboard"><button class="btnfile"> <i class="fa-solid fa-plus"
                                        style="color:white"></i> Add </button></a>

                        </div>
<table class="table ms-5 mt-5">

    <thead>
        <tr>
            <th id="th" scope="col">Account Holder Name</th>
            <th id="th" scope="col">Paid To</th>
            <th id="th" scope="col">Bank Code</th>
            <th id="th" scope="col">Amount</th>
            <th id="th" scope="col">Deposit Date</th>
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
            <td>{{$chequedetail->bankcode}}</td>
            <td>{{$chequedetail->amount}}</td>
            <td>{{$chequedetail->depositdate}}</td>
            <td style="text-align:center ;">
                <a target="_blank" style="margin-right:3rem;" href="/chequedetail/{{$chequedetail->id}}"><button class="btnfile"><i class="fa-solid fa-file-circle-check" style="color:white"></i>
                        View</button></a>

                <a target="_blank" href="/updatechequedetail/{{$chequedetail->id}}"><button class="btnfile"><i class="fa-solid fa-file-circle-check" style="color:white"></i>
                        Update</button></a>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script>

$(document).ready(function(e) {

    $('#search').on('click', function() {
        var from = document.getElementById("from").value;
        var to = document.getElementById("to").value;   
 
        if(from && to) {
            $("table tbody").html('');
            $.ajax({
            url: "{{url('api/fetch-transaction')}}",
            type: "POST",
            data: {
                from: from,
                to: to,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(result) {

                console.log(result.cheque);

                $.each(result.cheque, function(key, value) {

                    var tr = '<tr> <td>' + value
                        .accountholdername + ' </td> <td>' + value.payto + 
                        ' </td>  <td>' + value.depositdate +
                        '</td>  <td>' + value.amount +
                        '</td> <td>' + value.chequenumber +
                        '</td> <td style="text-align:center;"> <a style="margin-right:3rem; target="_blank" href="/chequedetail/' +
                        value.id +
                        '"> <button type="submit" form="form2" class="btnfile"><i class="fa-solid fa-file-circle-check" style="color:white"></i> View</button></a> <a target="_blank" href="/updatechequedetail/' +
                        value.id +
                        '"> <button type="submit" form="form2" class="btnfile"><i class="fa-solid fa-file-circle-check" style="color:white"></i> Update</button></a> </td>  </tr>'

                    $("table tbody").append(tr);
                });

            }
        });
        }
        
    });
});
</script>
@endsection