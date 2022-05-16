@extends('admin.layouts.layout')

@section('content')
<?php
$user_id = Session::get('UserID');
$today = date('Y-m-d h:i:s', time());
?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link href="{{ url('/css') }}/payment-animation.css" rel="stylesheet" type="text/css">
<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-xl-12">
                    @if(Session::has('od_message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{Session::get('od_message') }}
                    </div>
                    @endif
                    @if(Session::has('msg_success'))
                    <div class="alert alert-success" align="center">
                        {{Session::get('msg_success')}}
                    </div>
                    @endif
                    @if(Session::has('msg_error'))
                    <div class="alert alert-warning" align="center">
                        {{Session::get('msg_error')}}
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                @if($pending_count > 0)
                <marquee behavior="scroll" direction="left" style="color:red">Your payment is pending.</marquee>               
                @endif
            </div>

            <div class="row">
                <div class="col-xl-7">
                    <h5><i class="fa fa-list-ol" aria-hidden="true"></i> Empanelled Media List</h5>
                </div>
                <div class="col-xl-2">
                    @if(Session::has('UserID'))
                    <a href="{{ url('outdoorsoleRightPdf') }}" class="btn btn-info" style="float: right;font-size: 13px;" download><i class="fa fa-download"></i> Download Reports </a>
                    @endif
                </div>
                
                @if(@$vendor[0]->Modification==1)
                <div class="col-xl-3">
                    <a href="/sole-right-existing-user" class="btn btn-info" style="float: right; font-size:13px">Add New Empanelment</a>
                </div>
                @else
                <div class="col-xl-3">
                    <a href="/sole-right-media" class="btn btn-info" style="float: right; font-size:13px">Add New Empanelment</a>
                </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped text-center" id="myTable" style="font-size: 12px;border: 1px solid #cacdd3;">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Reference</th>
                            <th>Email</th>
                            <th>Sub category</th>
                            <th>Mobile</th>
                            <th>Action</th>
                            <th>Status</th>
                            <th>Agreement</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendor as $key => $vendors )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                {{ $vendors->media_id }}
                            </td>
                            <td>
                                {{ $vendors->ho_email }}
                                {{-- @if (@$vendors->category==0)
                                                {{ 'Airport' }}
                                @elseif(@$vendors->category==1)
                                {{ 'Railway' }}
                                @elseif(@$vendors->category==2)
                                {{ 'Road side' }}
                                @elseif(@$vendors->category==3)
                                {{ 'Moving Media' }}
                                @elseif(@$vendors->category==4)
                                {{ 'Public utility' }}
                                @endif --}}
                                {{-- <a href="#" cat-id="{{ $vendors->media_id }}" class="text-info cat-modal" data-toggle="modal" data-target="#myModal">View</a> --}}
                            </td>
                            <td>
                                <!-- {{ $vendors->gst }} -->
                                <!-- {{-- {{ $vendors->{'name'} }} --}} -->
                                <a href="#" sub-cat-id="{{ $vendors->media_id }}" class="text-info sub-modal" id="" data-toggle="modal" data-target="#myModal2">View</a>
                            </td>
                            <td>
                                {{ $vendors->mobile }}
                            </td>
                            <td>
                                <a href="sole-right-media/{{ $vendors->media_id }}" id="view"><i class="fa fa-eye" style="font-size:17px;color:#f8b739"></i></a>
                            </td>
                            <td>
                                @if($vendors->to_date >=$today)
                                {{'Active'}}
                                @else
                                <a href="sole-right-renewal/{{ $vendors->vendor_code }}" class="text-info">Renewal </a>
                                @endif
                            </td>
                            <td>
                                <a href="soleright-fileupload/{{ $vendors->media_id }}" class="text-info">Agreement</a>
                            </td>
                            <td>
                                @if($vendors->payment_status == 'Pending')
                                <a href="/vendor-payment/{{$vendors->media_id}}" target="_blank" class="blinking">{{ $vendors->payment_status }}</a>
                                @else
                                <a href="#" payment-odmediaid="{{ $vendors->media_id }}" class="text-info payment-modal" id="" data-toggle="modal" data-target="#paymentModal">View</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- modal for category -->
    <div class="container">
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Show Category</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" id="model-cat">
                        <h3 id="showcat"></h3>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- modal for sub category -->
    <div class="container">
        <div class="modal" id="myModal2">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Sub Category</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" id="model-sub">
                        <h3 id="showsub"></h3>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal for Payment Transaction Details-->
<div class="container">
    <div class="modal" id="paymentModal">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 123%;">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h6 class="modal-title">Payment Transacstion Details</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table text-center" id="myTable" style="font-size: 12px;border: 1px solid #cacdd3;" border="1">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Total Amount</th>
                                <th>Transacstion ID</th>
                                <th>Transacstion Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="model-payment">
                        </tbody>
                    </table>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    $(document).ready(function() {
        $(document).on("click", ".sub-modal", function() {
            var cat_id = $(this).attr('sub-cat-id');
            $.ajax({
                url: '/show-subcategory',
                type: 'GET',
                data: {
                    cat_id: cat_id
                },
                success: function(data) {                
                    $("#model-sub").html("<h6 id='showsub'>" + data + "</h6>");
                }
            });
        });
    });



    $(document).ready(function() {
        function in_array(needle, haystack) {
            for (var key in haystack) {
                if (needle === haystack[key]) {
                    return true;
                }
            }

            return false;
        }
        $(document).on("click", ".cat-modal", function() {
            var cat_id = $(this).attr('cat-id');
            $.ajax({
                url: '/show-category',
                type: 'GET',
                data: {
                    cat_id: cat_id
                },
                success: function(data) {
                    // console.log(data.result.length);
                    console.log(jQuery.type(data.result));
                    var ary = [];
                    ary.push(data.result);
                    console.log(ary);
                    if (in_array('0', ary[0])) {
                        // $("#showcat").append('Airport ');
                        console.log('Airport');
                    } else if (in_array('1', ary[0])) {
                        // $("#showcat").append('Railway Station');
                        console.log('Railway Station');
                    } else if (in_array('2', ary[0])) {
                        // $("#showcat").append('Railway Station');
                        console.log('Road side');
                    } else if (in_array('3', ary[0])) {
                        // $("#showcat").append('Railway Station');
                        console.log('Moving Media');
                    } else if (in_array('4', ary[0])) {
                        // $("#showcat").append('Railway Station');
                        console.log('Public utility');
                    }

                    $("#model-cat").html("<h6 id='showcat'>" + data.result + "</h6>");
                }
            });
        });
    });
    
      //payment details ajax call
      $(document).ready(function() {
        $(document).on("click", ".payment-modal", function() {
            var payment_id = $(this).attr('payment-odmediaid');
            $.ajax({
                url: '/get-payment-details',
                type: 'GET',
                data: {
                    od_media_id: payment_id
                },
                success: function(data) {
                    console.log(data);
                    $("#model-payment").html(data.payment_data);
                }
            });
        });

        setTimeout(function() {
            $('.alert-success').fadeOut("slow");
            $(".alert-warning").fadeOut("slow");
        }, 7000);

    });
</script>
@endsection