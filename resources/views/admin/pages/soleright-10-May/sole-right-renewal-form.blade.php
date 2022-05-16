@extends('admin.layouts.layout')

@section('custom_css')
<link href="{{ asset('css/comman-css.css')}}" rel="stylesheet" />
@endsection
<style>
    .error {
        color: red;
        font-size: 14px;
    }

    input[type=radio] {
        width: 20px;
        height: 20px;
    } 

    .table thead th {
        font-size: 13px;
        color: #444 !important;
    }

    .table td,
    .table th {
        padding: 0.45rem !important;
        font-size: 14px;
    }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@section('content')
<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Renewal-Outdoor Soleright Media Form</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="alert alert-success" id="show_msg" style="display: none;">
                <div align="center" class="alert alert-success text-primary" id="show_msg2"></div>
            </div>
            <div align="center" class="alert alert-danger" style="display: none;"></div>
            <!--  here form-->
            <form enctype="multipart/form-data" id="sole_right_media">
                @csrf
                @php
                $renewal_code=Request::segment(2);
                @endphp
                <input type="hidden" name="od_media_id" value="{{$renewal_code}}">
                <div class="tab-content">
                    <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
                        <!-- your steps content here -->
                        <div id="details_of_owner">
                            <input type="hidden" name="vendorcheck" value="{{@$vendorcheck}}">
                            <!--  authority details section start-->
                            @include('admin.pages.soleright.common.authority-details')
                            <!--  authority details section end-->
                            <!--  media address section start-->
                            @include('admin.pages.soleright.common.media-address')
                            <!--  media address section end-->
                            <!--  work done section start-->
                            @include('admin.pages.soleright.common.work-done')
                            <!--  work done section end-->
                            <!--  file upload start -->
                            <div class="row col-md-12">
                                <h4 class="subheading">Upload Document / दस्तावेज़ अपलोड करें:- </h4>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    @if(@$vendor->{'Legal Doc File Name'}=="")
                                    <div class="form-group">
                                        <label for="exampleInputFile">Upload document of legal status of company
                                            / कंपनी की कानूनी स्थिति का दस्तावेज अपलोड करें <font color="red">*</font></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="Legal_Doc_File_Name" class="custom-file-input" id="Legal_Doc_File_Name">
                                                <label class="custom-file-label" id="Legal_Doc_File_Name2" for="Legal_Doc_File_Name">
                                                    Choose file
                                                </label>
                                            </div>
                                            @if(@$vendor->{'Legal Doc File Name'} != '')
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor->{'Legal Doc File Name'} }}" target="_blank">View</a>
                                                </span>
                                            </div>
                                            @else
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="Legal_Doc_File_Name3">Upload</span>
                                            </div>
                                            @endif
                                        </div>
                                        <span id="Legal_Doc_File_Name1" class="error invalid-feedback"></span>
                                    </div>
                                    @else
                                    <div class="form-group">
                                        <label for="exampleInputFile">Upload document of legal status of company
                                            / कंपनी की कानूनी स्थिति का दस्तावेज अपलोड करें <font color="red">*</font></label><br><br>

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="Legal_Doc_File_Name_modify" {{$disabled}} class="custom-file-input" id="Legal_Doc_File_Name">
                                                <label class="custom-file-label" id="Legal_Doc_File_Name2" for="Legal_Doc_File_Name">
                                                    {{ @$vendor->{'Legal Doc File Name'} ?? 'Choose file' }}
                                                </label>
                                            </div>
                                            @if(@$vendor->{'Legal Doc File Name'} != '')
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor->{'Legal Doc File Name'} }}" target="_blank">View</a>
                                                </span>
                                            </div>
                                            @else
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="Legal_Doc_File_Name3">Upload</span>
                                            </div>
                                            @endif
                                        </div>
                                        <span id="Legal_Doc_File_Name1" class="error invalid-feedback"></span>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    @if(@$vendor->{'Affidavit File Name'}=="")
                                    <div class="form-group">
                                        <label for="exampleInputFile">Submit an affidavit on stamp paper stating
                                            on oath that the details submitted by you on performa are true and
                                            correct.Mention the application no. in affidavit / स्टाम्प पेपर पर
                                            शपथ पत्र पर प्रस्तुत करें कि आपके द्वारा प्रस्तुत किए गए
                                            विवरण सत्य और सही हैं। आवेदन संख्या का उल्लेख करें। हलफनामे
                                            में <font color="red">*</font></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="Affidavit_File_Name" class="custom-file-input" id="Affidavit_File_Name">
                                                <label class="custom-file-label" id="Affidavit_File_Name2" for="Affidavit_File_Name">Choose file</label>
                                            </div>
                                            @if(@$vendor->{'Affidavit File Name'} != '')
                                            <div class="input-group-append">
                                                <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor->{'Affidavit File Name'} }}" target="_blank">View</a></span>
                                            </div>
                                            @else
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="Affidavit_File_Name3">Upload</span>
                                            </div>
                                            @endif
                                        </div>
                                        <span id="Affidavit_File_Name1" class="error invalid-feedback"></span>
                                    </div>
                                    @else
                                    <div class="form-group">
                                        <label for="exampleInputFile">Submit an affidavit on stamp paper stating
                                            on oath that the details submitted by you on performa are true and
                                            correct.Mention the application no. in affidavit / स्टाम्प पेपर पर
                                            शपथ पत्र पर प्रस्तुत करें कि आपके द्वारा प्रस्तुत किए गए
                                            विवरण सत्य और सही हैं। आवेदन संख्या का उल्लेख करें। हलफनामे
                                            में <font color="red">*</font></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="Affidavit_File_Name_modify" {{$disabled}} class="custom-file-input" id="Affidavit_File_Name">
                                                <label class="custom-file-label" id="Affidavit_File_Name2" for="Affidavit_File_Name"> {{ @$vendor->{'Affidavit File Name'} ?? 'Choose file' }} </label>
                                            </div>
                                            @if(@$vendor->{'Affidavit File Name'} != '')
                                            <div class="input-group-append">
                                                <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor->{'Affidavit File Name'} }}" target="_blank">View</a></span>
                                            </div>
                                            @else
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="Affidavit_File_Name3">Upload</span>
                                            </div>
                                            @endif
                                        </div>
                                        <span id="Affidavit_File_Name1" class="error invalid-feedback"></span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="doc[]" id="doc_data"> <!-- add 25-feb -->
                            <!--  file upload end -->
                            <br><br>
                            <!--  App section start -->
                            <div class="card bg-light text-dark w-100">
                                <h6 class="text-center">Please submit location data through app</h6>
                                <a href="#" class="card-link text-center">App link</a>
                            </div>
                            <!-- App section end -->
                        </div>
                    </div><br><br>
                    <a class="btn btn-primary pm-next-button" id="tab_1" {{$disabled}} style="pointer-events: {{$pointer}};">Save <i class="fa fa-arrow-circle-right fa-lg"></i>
                    </a>
                </div>
        </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>

@endsection

@section('custom_js')
<script src="{{ url('/js') }}/sole-right-validation_ren.js"></script>
<script src="{{ url('/js') }}/sole-right-comman.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>

    //file size 2MB start
    $(document).ready(function() {
        $(".custom-file-input").change(function() {
            var id = $(this).attr("id");
            var file = this.files[0].name;
            var file1 = $('#' + id + 2).text();
            var totalBytes = this.files[0].size;
            var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
            var ext = file.split('.').pop();
            if (file != '' && sizemb <= 2 && ext == "pdf") {
                $("#" + id + 2).empty();
                $("#" + id + 2).text(file);
                $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass(
                    "input-group-text");
                $("#" + id + 4).show();
                $("#" + id + 1).hide();
                if ($("#doc_data").val() == '') {
                    $("#doc_data").val(file);
                } else {
                    var names = $("#doc_data").val();
                    var numbersArray = names.split(',');

                }
            } else {
                $("#" + id).val('');
                $("#" + id + 2).text("Choose file");
                $("#" + id + 1).text('File size should be 2MB and file should be pdf!');
                $("#" + id + 1).show();
                $("#" + id + 3).html("Upload").addClass("input-group-text");
                $("#" + id + "-error").addClass("hide-msg");
                $("#" + id + 4).hide();
            }
        });
    });


    //file size end

    // Check Unique Data
    function checkUniqueVendor(id, val) {
        //console.log(id +'~'+ val)
        if (val != '') {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                },
                type: 'POST',
                url: "{{Route('solerightcheckuniquevendor')}}",
                data: {
                    data: val
                },
                success: function(response) {
                    //console.log(response)
                    if (response.status == 0) {
                        $("#v_alert_" + id).html(titleCase(id) + ' ' + response.message);
                        $("#v_alert_" + id).show();
                        //$("#v_" + id).val('');
                    } else {
                        $("#v_alert_" + id).hide();
                    }
                }
            });
        }
    }

    $('.alert-danger').hide()

    $(document).ready(function() {
        $("input[name='boradio']").click(function() {
            var radioValue = $("input[name='boradio']:checked").val();
            console.log(radioValue);
            if (radioValue == '1') {
                $("#radio").show();
                $("#addid").show();
            } else {
                $("#radio").hide();
                $("#addid").hide();
            }
        });
    });

    $(document).ready(function() {
        $("#txt_from").on('change', function() {
            $("#txt_to").val('');
        });
    });

    //Licence Start date and End date
    $(document).ready(function() {
        $("#txt_from").on('focus', function() {
            var to = $("#txt_from").val();
            if (to.length == '') {
                $("#txt_to").removeAttr('disabled');
            }
            0
        });
    });
    $(document).ready(function() {
        $("#txt_to").focus(function() {
            var txt_from = $("#txt_from").val();
            $("#txt_to").attr('min', txt_from);
        });
    });


    $(document).ready(function() {
        $('.preventLeftClick').on('click', function(e) {
            e.preventDefault();
            return false;
        });
    });


    //for auth section
    $(document).ready(function() {

        $(document).on('click', '.remove_row', function(e) {
            // var ind = $(this).attr('data');
            e.preventDefault();
            var id = $(this).attr('id');
            $("#row" + id).remove();

            var add_count = $("#countID").val();
            $("#countID").val(add_count - 1);
        });



        $("#exist_owner1").click(function() {
            $("#exist_owner_ids").show();
        });

        $("#exist_owner2").click(function() {
            $("#exist_owner_ids").hide();
        });


    });





    //for auth section
    $(document).ready(function() {
        $("#add_Auth").click(function() {
            var i = $("#countID").val();
            i++;
            var append = '<div class="row" id="row' + i + '"><div class="col-md-4"><div class="form-group"><label for="address">Contact Person / संपर्क व्यक्ति <font color="red">*</font></label><textarea  type="text" name="Authorized_Rep_Name[]" placeholder="Enter Contact Person" rows="1" class="form-control form-control-sm" maxlength="40" ></textarea></div></div><div class="col-md-4"><div class="form-group"><label for="address">Address / पता <font color="red">*</font></label><textarea type="text" name="AR_Address[]" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm" ></textarea></div></div><div class="col-md-4"><div class="form-group"><label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red">*</font></label><input type="text" name="AR_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="landline_no" onkeypress="return onlyNumberKey(event)" maxlength="14" ></div></div><div class="col-md-4"><div class="form-group"><label for="email">E-mail. / ईमेल <font color="red">*</font></label><input type="text" name="AR_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" maxlength="30" ></div></div><div class="col-md-4"><div class="form-group"><label for="mobile">Mobile / मोबाइल <font color="red">*</font></label><input type="text" name="AR_Mobile_No[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" ></div></div> <div class="col-md-4"><div class="form-group"><label for="mobile">Alternate Mobile / मोबाइल <font color="red">*</font></label><input type="text" name="altername_mobile[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="altername_mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" ></div></div> <div class="col-md-10"></div><div class="col-md-2" style="padding: 2% 0 0 5%;"><button class="btn btn-danger remove_row" id="' + i + '"><i class="fa fa-minus"></i> Remove</button></div></div>';
            $("#radioar").append(append);
            $("#countID").val(i);
        });
        $(document).on('click', '.remove_row', function(e) {
            // var ind = $(this).attr('data');
            e.preventDefault();
            var id = $(this).attr('id');
            $("#row" + id).remove();

            var add_count = $("#countID").val();
            $("#countID").val(add_count - 1);
        });



        $("#exist_owner1").click(function() {
            $("#exist_owner_ids").show();
        });

        $("#exist_owner2").click(function() {
            $("#exist_owner_ids").hide();
        });


    });
</script>
@endsection