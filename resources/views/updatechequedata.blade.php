@extends('layouts.layout')
@section('content')
@section('updateaddcheque_select','active')
@section('drop_select','here show')
@section('title_select','ADD CHEQUE DATA ')
{{-- @section('title_select','Lead Update') --}}

<div id="kt_app_content" class="app-content flex-column-fluid col-8 col-sm-8  col-md-4 col-lg-4 col-xl-4 col-xxl-4">
 <!--   <button onclick="history.back()" class="btnback mx-5 mt-5"><i class="fa-solid fa-angles-left"
            style="color:white;margin-top:0.2rem"></i></button> -->
            @if(\Session::has('success'))
                        <div class="alert alert-success w-25 mx-2">{{\Session::get('success')}}</div>
                        @endif
                        @if(\Session::has('fail'))
                        <div class="alert alert-danger w-25 mx-2">{{\Session::get('fail')}}</div>
                        @endif
                        <div style="margin-left:20px" class="mb-5">

                            <h2 style="font-size:20px">LEAD PROFILES</h2>


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
                                                <th>Pay_to</th>
                                                <th>created_at</th>
                                                <th>updated_at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- DataTable Start --}}

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
                        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
                        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
                        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script type="text/javascript">

                            function form(id) {
                                return '<form method="POST" action="/deletelead/' + id + ' "> @csrf @method("delete")<a class="btndelete btn btn-danger btn-sm show_confirm" style= title="Delete" id="show_confirm" data-toggle="tooltip"> Delete </a> </form>'
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
                                                return  '<div style="display:flex; flex-wrap: no-wrap; align-items:center"><a href="callto:'+ row.phonenumber +'" class="edit btn btn-secondary mx-4 btn-sm">Call</a> <a href="/viewlead/' + row.leadid + '" class="edit btn btn-success btn-sm">View</a> <a href="/updatelead/' + row.leadid + '" class="edit btn btn-secondary btn-sm mx-4">Update</a> ' + form(row.leadid) + ' </div>'
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