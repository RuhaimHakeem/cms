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
            <label class="me-6 form-control bg-transparent" style="width:5rem !important;font-weight:bold" for="">From</label>
            <input class="form-control bg-transparent" type="date" id="from" name="from">
        </div>

        <div class="d-flex fv-row mb-8 w-25">
            <label class="me-6 form-control bg-transparent mx-5" style="width:5rem !important;font-weight:bold" for="">To</label>
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
<label class="d-flex bg-transparent ">
    <div class="box fw-bold ">
                    
        <select name="status" id="status" class="form-control m-5 box fw-bold" style="width:13rem">
            <option value='All'>All</option>
            <option value='In Hand'>In Hand</option>
            <option value='Deposited'>Deposited</option>
            <option value='Returned'>Returned</option>         
         </select>
    </div>
</label>
 <div class="d-flex justify-content-end col-11 col-sm-11  col-md-11 col-lg-11 col-xl-11 col-xxl-11"
       style="padding-right:1rem">
           <a href="/dashboard"><button class="btnfile"> <i class="fa-solid fa-plus"
             style="color:white"></i> Add </button></a>

</div>

<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered user_datatable">
                <thead>
                    <tr>
                        <th>Account Holder Name</th>
                        <th>Paid To</th>
                        <th>Bank Code</th>
                        <th>Amount</th>
                        <th>Deposit Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
                      
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">

$(document).ready(function(e) {

    fetchtransaction();

        function fetchtransaction(from = '', to = '', status = '') {
            var table = $('.user_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:'{{ route("cheque.details") }}',
                data:{from_date:from, to_date:to, status:status}
                },
            columns: [
            {data: 'accountholdername', name: 'accountholdername'},
            {data: 'payto', name: 'payto'},
            {data: 'bankcode', name: 'bankcode'},
            {data: 'amount', name: 'amount'},
            {data: 'depositdate', name: 'depositdate'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    }

    $('#search').click(function(){
        var from_date = $('#from').val();
        var to_date = $('#to').val();

        if(from_date != '' &&  to_date != '')
        {
            $('.user_datatable').DataTable().destroy();
            fetchtransaction(from_date, to_date);
        }
        else
        {
            alert('Both Date is required');
        }
        });

    $('#status').on('change', function() {
        var from = document.getElementById("from").value;
        var to = document.getElementById("to").value;
        if(from != "" && to != ""){
            document.getElementById("from").value = "";
            document.getElementById("to").value = "";
        }

        var status = $('#status').val();
        if(status != '') {
            $('.user_datatable').DataTable().destroy();
            fetchtransaction("","", status);
        }
            
    });
           
});
</script>