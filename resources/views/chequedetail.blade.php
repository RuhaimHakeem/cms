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


        <table class="table mt-10 caption-top" style="max-width: 800px">
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
                    <th style="margin-bottom: 2rem" id="th" class="align-middle">Image</th>
                    <td>  <div class="d-flex w-25 mt-5">

                        
                        <div>
                        <img class="tea-map-img" id="myImg" src="{{ url('public/Image/'.$chequedetail->image) }}"
                        style="height: 200px; width: 400px;" />
                          
                          <!-- The Modal -->
                          <div id="myModal" class="modal">
                            <img class="modal-content" id="img01">
                          </div>
                          <script>
                                // Get the modal
                                var modal = document.getElementById('myModal');
                                
                                // Get the image and insert it inside the modal - use its "alt" text as a caption
                                var img = document.getElementById('myImg');
                                var modalImg = document.getElementById("img01");
                                var captionText = document.getElementById("caption");
                                img.onclick = function(){
                                    modal.style.display = "block";
                                    modalImg.src = this.src;
                                    modalImg.alt = this.alt;
                                    captionText.innerHTML = this.alt;
                                }
                                
                                
                                // When the user clicks on <span> (x), close the modal
                                modal.onclick = function() {
                                    img01.className += " out";
                                    setTimeout(function() {
                                       modal.style.display = "none";
                                       img01.className = "modal-content";
                                     }, 400);
                                    
                                 }    
                                    
                                </script>
                        </div>
        </div></td>
                </tr>

            </thead>

        </table>
      

    </div>
</div>


@endsection




