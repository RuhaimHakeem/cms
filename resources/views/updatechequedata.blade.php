@extends('layouts.layout')
@section('content')
@section('updateaddcheque_select','active')
@section('drop_select','here show')
@section('title_select','UPDATE MASTER DATA ')
{{-- @section('title_select','Lead Update') --}}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div id="kt_app_content" class="app-content flex-column-fluid col-8 col-sm-8  col-md-12 col-lg-12 col-xl-12 col-xxl-12">
 <!--   <button onclick="history.back()" class="btnback mx-5 mt-5"><i class="fa-solid fa-angles-left"
            style="color:white;margin-top:0.2rem"></i></button> -->
            @if(\Session::has('success'))
                        <div class="alert alert-success w-25 mx-2 mt-10">{{\Session::get('success')}}</div>
                        @endif
                        @if(\Session::has('fail'))
                        <div class="alert alert-danger w-25 mx-2 mt-10">{{\Session::get('fail')}}</div>
                        @endif
                        <div style="margin-left:20px" class="mb-5 mt-10">

                            <h2 style="font-size:20px">PAY TO DETAILS</h2>


                            <!--end::Title-->
                            <!--begin::Subtitle-->

                            <!--end::Subtitle=-->
                        </div>
                 

                        <div class="container">
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-bordered user_datatable">
                                        <thead>
                                            <tr>
                                         
                                                <th>Pay To</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- DataTable Start --}}
                       <!-- function form(id) {
                                return '<form method="POST" action="updatechequedata/' + id + ' "> @csrf @method("delete")<a class="btndelete btn btn-danger btn-sm show_confirm" style= title="Delete" id="show_confirm" data-toggle="tooltip"> Delete </a> </form>'
                            } -->
                      
                            <script type="text/javascript">
//function form
function form(id) {
                                return '<form method="POST" action="updatechequedata/' + id + ' "> @csrf @method("delete")<a class="btndelete btn btn-danger btn-sm show_confirm" style= title="Delete" id="show_confirm" data-toggle="tooltip"> Delete </a> </form>'
                            }
                            $(document).ready(function(e) {

                                fetchtransaction();  

                                    function fetchtransaction() {
                                        var table = $('.user_datatable').DataTable({
                                        processing: true,
                                        serverSide: true,
                                        ajax: {
                                            url:'{{ route("updatecheque.data") }}',
                                            },
                                        columns: [
                                 
                                        {data: 'payto', name: 'payto'},
                                        {data: 'created_at', name: 'created_at'},
                                        {data: 'updated_at', name: 'updated_at'},
                                        {
                                            data: function(row) {
                                                return  '<div style="display:flex; flex-wrap: no-wrap; align-items:center"><a href="/editchequedata/' + row.id + '" class="edit btn btn-secondary btn-sm mx-4">Update</a> ' + form(row.id) + ' </div>'
                                            }
                                        }
                                        
                                    ]
                                });
                                }  
                            
                                $(document).on('click','#show_confirm',function(event){
                                    event.preventDefault();
                                    var form =  $(this).closest("form");
                                    var name = $(this).data("name");
                
                                    Swal.fire({
                                        title: 'Are you sure?',
                                        text: "You won't be able to revert this!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes, delete it!'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            form.submit();
                                        }
                                    })
                                }); 
                            });
                            </script>
                        {{-- DataTable End --}}


                        <div style="margin-left:20px" class="mb-5">

<h2 style="font-size:20px">ACCOUNT DETAILS</h2>


<!--end::Title-->
<!--begin::Subtitle-->

<!--end::Subtitle=-->
</div>


<div class="container">
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-bordered user_datatable2">
            <thead>
                <tr>
              
                    <th>Account Holder Name</th>
                    <th>Account Holder Number</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
</div>

{{-- DataTable Start --}}


<script type="text/javascript">


$(document).ready(function(e) {

    fetchtransaction();  

        function fetchtransaction() {
            var table = $('.user_datatable2').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:'{{ route("updatecheque2.data") }}',
                },
            columns: [

            {data: 'accountholdername', name: 'accountholdername'},
            {data: 'accountholdernumber', name: 'accountholdernumber'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {
                data: function(row) {
                    return  '<div style="display:flex; flex-wrap: no-wrap; align-items:center"><a href="/editaccountdata/' + row.id + '" class="edit btn btn-secondary btn-sm mx-4">Update</a> ' + form(row.id) + ' </div>'
                }
            }
            
        ]
    });
    }  

    $(document).on('click','#show_confirm',function(event){
        event.preventDefault();
        var form =  $(this).closest("form");
        var name = $(this).data("name");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    }); 
});
</script>
{{-- DataTable End --}}

<!--

<div style="margin-left:20px" class="mb-5">

<h2 style="font-size:20px">CHEQUE DETAILS</h2>



</div>


<div class="container">
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-bordered user_datatable3">
            <thead>
                <tr>
                    <th>Cheque Number</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
</div>

{{-- DataTable Start --}}


<script type="text/javascript">



$(document).ready(function(e) {

    fetchtransaction();  

        function fetchtransaction() {
            var table = $('.user_datatable3').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:'{{ route("updatecheque3.data") }}',
                },
            columns: [
            {data: 'chequenumber', name: 'chequenumber'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {
                data: function(row) {
                    return  '<div style="display:flex; flex-wrap: no-wrap; align-items:center"><a href="/editchequenodata/' + row.id + '" class="edit btn btn-secondary btn-sm mx-4">Update</a> ' + form(row.id) + ' </div>'
                }
            }
            
        ]
    });
    }  

    $(document).on('click','#show_confirm',function(event){
        event.preventDefault();
        var form =  $(this).closest("form");
        var name = $(this).data("name");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    }); 
});
</script>
{{-- DataTable End --}}
-->




<div style="margin-left:20px" class="mb-5">

<h2 style="font-size:20px">BANK DETAILS</h2>


<!--end::Title-->
<!--begin::Subtitle-->

<!--end::Subtitle=-->
</div>


<div class="container">
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-bordered user_datatable4">
            <thead>
                <tr>
                    <th>Bank Name</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
</div>

{{-- DataTable Start --}}


<script type="text/javascript">



$(document).ready(function(e) {

    fetchtransaction();  

        function fetchtransaction() {
            var table = $('.user_datatable4').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:'{{ route("updatecheque4.data") }}',
                },
            columns: [
            {data: 'bankname', name: 'bankname'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {
                data: function(row) {
                    return  '<div style="display:flex; flex-wrap: no-wrap; align-items:center"><a href="/editchequebankdata/' + row.id + '" class="edit btn btn-secondary btn-sm mx-4">Update</a> ' + form(row.id) + ' </div>'
                }
            }
            
        ]
    });
    }  

    $(document).on('click','#show_confirm',function(event){
        event.preventDefault();
        var form =  $(this).closest("form");
        var name = $(this).data("name");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    }); 
});
</script>
{{-- DataTable End --}}
</div>

@endsection
<!--end::Content-->