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
                <div class="row col-md-12">
                            <h4 class="subheading">Authority Details / प्राधिकरण विवरण :-</h4>
                        </div><br>
                        <div class="row" id="authority_details">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="authority">Authority Which Granted Media With
                                        Address / प्राधिकरण जिसने मीडिया को पते के साथ प्रदान किया
                                        <font color="red">*</font>
                                    </label>
                                    <input type="text" {{$disabled}} name="Authority_Which_granted_Media" placeholder="Enter Authority Which Granted Media With Address" class="form-control form-control-sm" id="authority" maxlength="120" value="{{$vendor->{'Authority Which granted Media'} ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Contract_No">Contract No. / अनुबंध क्रमांक<font color="red">*</font>
                                    </label>
                                    <input type="text" {{$disabled}} name="Contract_No" placeholder="Enter Contract Number" onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm" id="Contract_No" maxlength="13" value="{{$vendor->{'Contract No_'} ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="License_Fee">License Fee / लाइसेंस शुल्क<font color="red">*
                                        </font></label>
                                    <input type="text" {{$disabled}} name="License_Fee" id="license_fee" placeholder="Enter License Fee" onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm" maxlength="8" value="{{round(@$vendor->{'License Fees'},5) ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_from">License start date / लाइसेंस शुरू होने
                                        की दिनांक<font color="red">*</font></label>
                                    <input type="date" {{$disabled}} name="License_From" id="txt_from" placeholder="DD/MM/YYYY" class="form-control form-control-sm" value="{{ @$vendor->{'License From'} ? date('Y-m-d', strtotime($vendor->{'License From'})) : ''}}">
                                    <span id="date_error" style="color:red;display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_to">License end date / लाइसेंस समाप्ति दिनांक
                                        <font color="red">*</font>
                                    </label>
                                    <input type="date" {{$disabled}} name="License_To" id="txt_to" placeholder="DD/MM/YYYY" class="form-control form-control-sm" value="{{ @$vendor->{'License To'} ? date('Y-m-d', strtotime($vendor->{'License To'})) : ''}}">
                                    <span id="date_error" style="color:red;display: none;"></span>
                                </div>
                            </div>
                        </div><br>
                <!--  work done section start-->
                <div class="row">
                  <hr>
                </div>
                <div class="row col-md-12">
                <h4 class="subheading">Media Address / मीडिया पता:-</h4>
              </div><br>
              @include('admin.pages.soleright.comman-media')
              <div class="row">
                <hr>
              </div>
                <br>
                <div class="row col-md-12">
                  <h4 class="subheading">Details of work in last six months, for the applied media only, if any (As per format given below) <br>
                  केवल आवेदन मीडिया के लिए पिछले छह महीनों में कार्य का विवरण, यदि कोई हो (नीचे दिए गए प्रारूप के अनुसार) :-</h4>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <h6>If you want to import through XLS <a href="{{asset('uploads/work_done_excel.xlsx')}}" target="_blank">Download Sample File</a>
                    </h6>
                  </div>
                  <div class="col-md-3">
                    <input type="radio" name="xls2" id="xlxyes2" value="1" class="xls2"> Yes &nbsp; <input type="radio" name="xls2" id="xlxno2" value="0" class="xls2" checked="checked"> No
                  </div>
                </div>
                <br>
                <br>
                <div class="row" id="xls_show2" style="display: none;">
                  <div class="col-md-4">
                    <input type="file" name="media_import2" class="form-control form-control-sm" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                  </div>
                </div>
                <div id="details_of_work_done">
                  @forelse($work as $key => $works)
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="year">Year / वर्ष <font color="red">*</font>
                        </label>
                        <p>
                          <select name="ODMFO_Year[]" {{$disabled}} id="Years" class="form-control form-control-sm ddlYears">
                            @if(@$works->Year == '')
                            <option value="">Select Year</option>
                            @else
                            <option value="{{ $works->Year }}">
                                {{ $works->Year }}
                            </option>
                            @endif
                          </select>
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="quantity_duration">Quantity of Display or Duration / प्रदर्शन या अवधि की मात्रा <font color="red">*</font>
                        </label>
                        <p>
                          <input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" {{$disabled}} id="quantity_duration" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm" maxlength="8" onkeypress="return onlyNumberKey(event)" value="{{$works->{'Qty Of Display_Duration'} ?? ''}}">
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि (रु) <font color="red">*</font>
                            @php
                            if(@$works->{'Billing Amount'} == 0)
                            {
                            $work_done_data1 = '';
                            }
                            else
                            {
                            $work_done_data1 = round(@$works->{'Billing Amount'},2);
                            }
                            @endphp
                        </label>
                        <p>
                          <input type="text" name="ODMFO_Billing_Amount[]" {{$disabled}} id="billing_amount" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8" value="{{$work_done_data1}}">
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>From Date / की दिनांक से <font color="red">*</font>
                        </label>
                        <p>
                          <input type="date" name="from_date[]" {{$disabled}} id="from_date" class="form-control form-control-sm" value="{{ (!empty(@$works->{'From Date'}) && @$works->{'From Date'} != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$works->{'From Date'})) : ''}}">
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>To Date / दिनांक तक <font color="red">*</font>
                        </label>
                        <p>
                          <input type="date" name="to_date[]" {{$disabled}} id="to_date" class="form-control form-control-sm" value="{{ (!empty(@$works->{'To Date'}) && @$works->{'To Date'} != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$works->{'To Date'})) : ''}}">
                        </p>
                      </div>
                    </div>
                    <input type="hidden" name="allocated_vendor_code[]" value="{{@$works->{'Allocated Vendoe Code'} ?? ''}}">
                    <input type="hidden" name="work_od_media_id[]" value="{{@$works->{'OD Media ID'} ?? ''}}">
                    <input type="hidden" name="work_od_media_id[]" value="{{@$works->{'Line No_'} ?? ''}}">
                  </div>
                  @empty
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="year">Year / वर्ष <font color="red">*</font>
                        </label>
                        <p>
                          <select name="ODMFO_Year[]" id="Years" class="form-control form-control-sm ddlYears">
                            <option>Select Year</option>
                          </select>
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="quantity_duration">Quantity of Display or Duration / प्रदर्शन या अवधि की मात्रा <font color="red">*</font>
                        </label>
                        <p>
                          <input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" id="quantity_duration" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm" maxlength="8" onkeypress="return onlyNumberKey(event)">
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि (रु) <font color="red">*</font>
                        </label>
                        <p>
                          <input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8">
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>From Date / की दिनांक से <font color="red">*</font>
                        </label>
                        <p>
                          <input type="date" name="from_date[]" id="from_date" class="form-control form-control-sm">
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>To Date / तारीख तक <font color="red">*</font>
                        </label>
                        <p>
                          <input type="date" name="to_date[]" id="to_date" class="form-control form-control-sm">
                        </p>
                      </div>
                    </div>
                  </div>
                  @endforelse
                </div>
                <input type="hidden" name="lineno2" id="lineno2" value="{{$exline2 ?? ''}}">
                <div class="row" style="float:right;margin: 6px 0 0 0;">
                  <input type="hidden" name="count_i" value="{{$key ?? 0}}" id="count_i">
                  <a class="btn btn-primary" id="add_row_next">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add </a>
                </div>
                <br>
                <br>
                <!--  work done section end -->
                <br>
                <br>
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
                <input type="hidden" name="doc[]" id="doc_data">  <!-- add 25-feb -->
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
     $(document).ready(function() {
        var currentYear = (new Date()).getFullYear();
        for (var i = 1980; i <= currentYear; i++) {
            var option = document.createElement("OPTION");
            option.innerHTML = i;
            option.value = i;
            $(".ddlYears").append(option);
        }
        $("#add_row_next").click(function() {
            var i = $("#count_i").val();
            i++;

            var html =
                '<div class="row"><div class="col-md-4"><div class="form-group"><label for="year">Year / वर्ष<font color="red">*</font></label><p><select name="ODMFO_Year[]" id="Years' +
                i +
                '" class="form-control form-control-sm ddlYears"><option value="">Select Year</option></select></p></div></div><div class="col-md-4"><div class="form-group"><label for="quantity_duration">Quantity of Display or Duration / प्रदर्शन या अवधि की मात्रा<font color="red">*</font></label><p><input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" maxlength="8" id="quantity_duration' +
                i +
                '" onkeypress="return onlyNumberKey(event)" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm"></p></div></div><div class="col-md-4"><div class="form-group"><label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि (रु)<font color="red">*</font></label><p><input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount' +
                i +
                '" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" maxlength="14" onkeypress="return onlyNumberKey(event)"></p></div></div><div class="col-md-4"><div class="form-group"><label for="from_date">From date<font color="red">*</font></label><p><input type="date" name="from_date[]" id="from_date' +
                i +
                '" class="form-control form-control-sm" maxlength="14"></p></div></div><div class="col-md-4"><div class="form-group"><label for="to_date">To date<font color="red">*</font></label><p><input type="date" name="to_date[]" id="to_date' +
                i +
                '" class="form-control form-control-sm" maxlength="14"></p></div></div><div class="col-md-6"></div><div class="col-md-6"><button class="btn btn-danger remove_row_next" style="margin: 1% 0 0 78%;"><i class="fa fa-minus"></i> Remove</button></div></div><br>';
            $("#details_of_work_done").append(html);
            $("#count_i").val(i);
            for (var i = 1980; i <= currentYear; i++) {
                var option = document.createElement("OPTION");
                option.innerHTML = i;
                option.value = i;
                $(".ddlYears").append(option);
            }
        });
        $("#details_of_work_done").on('click', '.remove_row_next', function() {
            var ind = $(this).attr('data');
            var line_no = $("#line_no_" + ind).val();
            var odmedia_id = $("#odmedia_id_" + ind).val();
            if (line_no != '' && odmedia_id != '') {
                if (confirm("Are you sure you want to delete this?")) {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                        },
                        type: 'get',
                        url: 'remove-workdone-data',
                        data: {
                            line_no: line_no,
                            od_media_id: odmedia_id
                        },
                        success: function(response) {
                            console.log(response);
                        }
                    });
                } else {
                    return false;
                }
            }
            $(this).parent().parent().remove();

            var add_count = $("#count_i").val();

            $("#count_i").val(add_count - 1);
        });

        //Loop and add the Year values to DropDownList.

    });

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
            }0
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

    $("#xlxyes2").click(function() {
    var xlsvalue = $(this).val();
    if (xlsvalue == '1') {
        $("#xls_show2").show();
        $("#details_of_work_done").hide();
        $("#add_row_next").hide();
    }

});
$("#xlxno2").click(function() {
    var xlsvalue = $(this).val();
    if (xlsvalue == '0') {
        $("#xls_show2").hide();
        $("#details_of_work_done").show();
        $("#add_row_next").show();
    }

});

    //Pan card valida





//for auth section
$(document).ready(function() {
        
        $(document).on('click', '.remove_row', function(e) {
            // var ind = $(this).attr('data');
            e.preventDefault();
            var id=$(this).attr('id');
            $("#row"+id).remove();

            var add_count = $("#countID").val();
            $("#countID").val(add_count - 1);
        });



        $("#exist_owner1").click(function(){
            $("#exist_owner_ids").show();
        });

        $("#exist_owner2").click(function(){
            $("#exist_owner_ids").hide();
        });

        
    });





//for auth section
$(document).ready(function() {
        $("#add_Auth").click(function() {
            var i = $("#countID").val();
            i++;
            var append='<div class="row" id="row'+i+'"><div class="col-md-4"><div class="form-group"><label for="address">Contact Person / संपर्क व्यक्ति <font color="red">*</font></label><textarea  type="text" name="Authorized_Rep_Name[]" placeholder="Enter Contact Person" rows="1" class="form-control form-control-sm" maxlength="40" ></textarea></div></div><div class="col-md-4"><div class="form-group"><label for="address">Address / पता <font color="red">*</font></label><textarea type="text" name="AR_Address[]" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm" ></textarea></div></div><div class="col-md-4"><div class="form-group"><label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red">*</font></label><input type="text" name="AR_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="landline_no" onkeypress="return onlyNumberKey(event)" maxlength="14" ></div></div><div class="col-md-4"><div class="form-group"><label for="email">E-mail. / ईमेल <font color="red">*</font></label><input type="text" name="AR_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" maxlength="30" ></div></div><div class="col-md-4"><div class="form-group"><label for="mobile">Mobile / मोबाइल <font color="red">*</font></label><input type="text" name="AR_Mobile_No[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" ></div></div> <div class="col-md-4"><div class="form-group"><label for="mobile">Alternate Mobile / मोबाइल <font color="red">*</font></label><input type="text" name="altername_mobile[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="altername_mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" ></div></div> <div class="col-md-10"></div><div class="col-md-2" style="padding: 2% 0 0 5%;"><button class="btn btn-danger remove_row" id="'+i+'"><i class="fa fa-minus"></i> Remove</button></div></div>';
            $("#radioar").append(append);
            $("#countID").val(i);
        });
        $(document).on('click', '.remove_row', function(e) {
            // var ind = $(this).attr('data');
            e.preventDefault();
            var id=$(this).attr('id');
            $("#row"+id).remove();

            var add_count = $("#countID").val();
            $("#countID").val(add_count - 1);
        });



        $("#exist_owner1").click(function(){
            $("#exist_owner_ids").show();
        });

        $("#exist_owner2").click(function(){
            $("#exist_owner_ids").hide();
        });

        
    });
</script>
@endsection