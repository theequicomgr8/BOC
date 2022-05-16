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
      <h6 class="m-0 font-weight-normal text-primary">Empanelment-Outdoor Sole-Right Media</h6>
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

        <div class="tab-content">
          <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
            <!-- your steps content here -->
            <div id="details_of_owner">
              <input type="hidden" name="vendorcheck" value="{{@$vendorcheck}}">
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
                <h4 class="subheading">Authority Details / प्राधिकरण विवरण :-</h4>
              </div><br>
              <div class="row" id="authority_details">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="authority">Authority Which Granted Media With
                      Address / प्राधिकरण जिसने मीडिया को पते के साथ प्रदान किया
                      <font color="red">*</font>
                    </label>
                    <input type="text" name="Authority_Which_granted_Media" placeholder="Enter Authority Which Granted Media With Address" class="form-control form-control-sm" id="authority" maxlength="120" value="{{$vendor->{'Authority Which granted Media'} ?? '' }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Contract_No">Contract No / अनुबंध क्रमांक<font color="red">*</font>
                    </label>
                    <input type="text" name="Contract_No" placeholder="Enter Contract Numbar" onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm" id="Contract_No" maxlength="13" value="{{$vendor->{'Contract No_'} ?? ''}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="License_Fee">License Fee / लाइसेंस शुल्क<font color="red">*
                      </font></label>
                    <input type="text" name="License_Fee" id="license_fee" placeholder="Enter License Fee" onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm" maxlength="8" value="{{round(@$vendor->{'License Fees'},5) ?? ''}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="license_from">License start date / लाइसेंस शुरू होने
                      की दिनांक<font color="red">*</font></label>
                    <input type="date" name="License_From" id="txt_from" maxlength="10" placeholder="DD/MM/YYYY" class="form-control form-control-sm" value="{{ @$vendor->{'License From'} ? date('Y-m-d', strtotime($vendor->{'License From'})) : ''}}">
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="license_to">License end date / लाइसेंस समाप्ति दिनांक
                      <font color="red">*</font>
                    </label>
                    <input type="date" name="License_To" id="txt_to" maxlength="10" placeholder="DD/MM/YYYY" class="form-control form-control-sm" value="{{ @$vendor->{'License To'} ? date('Y-m-d', strtotime($vendor->{'License To'})) : ''}}">
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div><br>
              <!--  work done section start-->

              <div class="row col-md-12">
                <h4 class="subheading">Details of work in last six months, for the applied media only, if any (As per format given below)<br>
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
                        <select name="ODMFO_Year[]" id="Years" class="form-control form-control-sm ddlYears">
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
                        <input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" id="quantity_duration" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm" maxlength="8" onkeypress="return onlyNumberKey(event)" value="{{$works->{'Qty Of Display_Duration'} ?? ''}}">
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
                        <input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8" value="{{$work_done_data1}}">
                      </p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>From Date / की दिनांक से : <font color="red">*</font>
                      </label>
                      <p>
                        <input type="date" name="from_date[]" maxlength="10" id="from_date" class="form-control form-control-sm" value="{{ (!empty(@$works->{'From Date'}) && @$works->{'From Date'} != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$works->{'From Date'})) : ''}}">
                      </p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>To Date / दिनांक तक <font color="red">*</font>
                      </label>
                      <p>
                        <input type="date" name="to_date[]" id="to_date" maxlength="10" class="form-control form-control-sm" value="{{ (!empty(@$works->{'To Date'}) && @$works->{'To Date'} != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$works->{'To Date'})) : ''}}">
                      </p>
                    </div>
                  </div>
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
                      <label>From Date / की दिनांक से : <font color="red">*</font>
                      </label>
                      <p>
                        <input type="date" name="from_date[]" maxlength="10" id="from_date" class="form-control form-control-sm">
                      </p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>To Date / दिनांक तक <font color="red">*</font>
                      </label>
                      <p>
                        <input type="date" name="to_date[]" maxlength="10" id="to_date" class="form-control form-control-sm">
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
                  <i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
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
                        <input type="file" name="Affidavit_File_Name_modify" class="custom-file-input" id="Affidavit_File_Name">
                        <label class="custom-file-label" id="Affidavit_File_Name2" for="Affidavit_File_Name">{{@$vendor->{'Affidavit File Name'} ?? 'Choose file'}}</label>
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
          <a class="btn btn-primary pm-next-button" id="tab_1">Save <i class="fa fa-arrow-circle-right fa-lg"></i>
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
<script src="{{ url('/js') }}/sole-right-existing-validation.js"></script>
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

  function uploadFile(i, thiss) {
    // condole.log('data');
    var file = thiss.files[0].name;
    var totalBytes = thiss.files[0].size;
    var sizeKb = Math.floor(totalBytes / 1000);
    console.log(sizeKb);
    var ext = file.split('.').pop();
    if (file != '' && sizeKb < 26000 && ext == "pdf") {
      $("#choose_file" + i).empty();
      $("#choose_file" + i).text(file);
      $("#upload_file" + i).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
      $("#upload_doc_error" + i).hide();
    } else {
      //console.log("hello");
      $("#upload_doc" + i).val('');
      $("#choose_file" + i).text("Choose file");
      $("#upload_doc_error" + i).text('File size should be less than 25mb and file should be only pdf !');
      $("#upload_doc_error" + i).show();
      $("#upload_file" + i).html("Upload").addClass("input-group-text");
      $("#upload_doc" + i + "-error").addClass("hide-msg");
    }
  }
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

  function checkUniqueOwnerSoleRight(thisd, val, i) {
    if (val != '') {
      var user_id = $('input[name="user_id"]').val();
      var user_email = $('input[name="user_email"]').val();

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'POST',
        url: "{{Route('checkpsolerightuniqueowner')}}",
        data: {
          data: val,
          id: user_id,
          email: user_email
        },
        success: function(response) {
          //console.log(response);
          if (response.status == 1 && thisd.id == 'owner_email' + i) {
            $("#owner_name" + i).prop("readonly", false);
            $("#owner_mobile" + i).prop("readonly", false);
            $("#owner_address" + i).prop("readonly", false);
            $("#owner_state" + i).prop("disabled", false);
            $("#owner_district" + i).prop("disabled", false);
            $("#owner_city" + i).prop("readonly", false);
            $("#owner_phone" + i).prop("readonly", false);
            $("#owner_fax" + i).prop("readonly", false);
            // $("#state_val" + i).prop("disabled", true);
            //$("#district_val" + i).prop("disabled", true);
            // owner not exit clean data
            if ($("#owner_input_clean").val() == 0) {
              $("#owner_state" + i).val('');
              $("#owner_district" + i).val('');
              $("#owner_name" + i).val('');
              $("#owner_mobile" + i).val('');
              $("#owner_address" + i).val('');
              $("#owner_city" + i).val('');
              $("#owner_phone" + i).val('');
              $("#owner_fax" + i).val('');
              $("#ownerid" + i).val('');
              // $("#exist_owner_id").val('');
              $("#mobilecheck").val('');
            }
            // $("#emailarr").val('');
            // $('input[name^="owner_email"]').each(function() {
            //arrText.push($(this).val());
            var names = $("#emailarr").val();
            var numbersArray = names.split(',');
            if (numbersArray.includes(val) == false) {
              $("#emailarr").val('');
              $('input[name^="owner_email"]').each(function() {
                // arrText.push($(this).val());
                $("#emailarr").val(function() {
                  return $("#emailarr").val() + ',' + $(this).val();
                });
              });
            }
            // });
          }
          //console.log(thisd.id +' ~ '+ 'owner_email' + i);
          if (response.status == 0 && thisd.id == 'owner_email' + i) {
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
              },
              type: 'POST',
              url: "{{Route('fetchsolerightownerrecord')}}",
              data: {
                data: val
              },
              success: function(response) {
                console.log(response);
                if (response.status == 1) {
                  $("#owner_state" + i).empty();
                  $("#owner_district" + i).empty();
                  // $("#state_val" + i).prop("disabled", false);
                  //$("#district_val" + i).prop("disabled", false);
                  $("#owner_name" + i).val(response.message['Owner Name']);
                  $("#owner_mobile" + i).val(response.message['Mobile No_']);
                  $("#owner_address" + i).val(response.message['Address 1']);
                  $("#owner_state" + i).html(response.state);
                  $("#owner_district" + i).html(response.districts);
                  // $("#state_val" + i).val(response.message['State']);
                  //  $("#district_val" + i).val(response.message['District']);
                  $("#owner_city" + i).val(response.message['City']);
                  $("#owner_phone" + i).val(response.message['Phone No_']);
                  $("#owner_fax" + i).val(response.message['Fax No_']);
                  $("#ownerid" + i).val(response.message['Owner ID']);
                  // $("#exist_owner_id").val(response.message['Owner ID']);
                  $("#mobilecheck").val(response.message['Mobile No_']);
                  if ($("#emailarr").val() == '') {
                    $("#emailarr").val(val);
                  } else {
                   
                    var names = $("#emailarr").val();
                    //console.log(numbersArray);
                    var numbersArray = names.split(',');
                    if (numbersArray.includes(val) == false) {
                      $("#emailarr").val('');
                      $('input[name^="owner_email"]').each(function() {
                        // arrText.push($(this).val());
                        $("#emailarr").val(function() {
                          return $("#emailarr").val() +
                            ',' + $(this).val();
                        });
                      });

                    } else {
                    
                    }
                  }
                  if ($("#ownerid").val() == '') {
                    $("#ownerid").val(response.message['Owner ID']);
                  } else {
                    var ownerids = $("#ownerid").val();
                    var ownerArray = ownerids.split(',');
                    if (isInArray(response.message['Owner ID'], ownerArray) ==
                      false) {
                      $("#ownerid").val(function() {
                        return $("#ownerid").val() + ',' + response
                          .message['Owner ID'];
                      });
                      var ownerids = $("#ownerid").val();
                      var ownerArray = ownerids.split(',');
                      $("#ownerid").val(ownerArray);
                    }
                  }
                }

                if (response.Status > 0) {
                  $("#owner_name" + i).prop("readonly", true);
                  $("#owner_mobile" + i).prop("readonly", true);
                  $("#owner_address" + i).prop("readonly", true);
                  $("#owner_state" + i).prop("disabled", true);
                  $("#owner_district" + i).prop("disabled", true);
                  $("#owner_city" + i).prop("readonly", true);
                  $("#owner_phone" + i).prop("readonly", true);
                  $("#owner_fax" + i).prop("readonly", true);
                }
                $("#owner_input_clean").val(0);
              }
            });

          } else if (response.status == 0 && thisd.id == 'owner_mobile' + i && val != $(
              "#mobilecheck").val()) {
            $("#alert_" + thisd.id).html(titleCase(thisd.id.slice(0, -1)) + ' ' + response.message);
            $("#alert_" + thisd.id).show();
          } else {
            // console.log(id.id);
            $("#alert_" + thisd.id).hide();
          }
          if (thisd.id == 'owner_mobile' + i) {
            $("#owner_input_clean").val(1);
          }
        }
      });
    }
  }

  function isInArray(value, array) {
    return array.indexOf(value) > -1;
  }

  function titleCase(string) {
    return string[0].toUpperCase() + string.slice(1).toLowerCase();
  }
  $(document).on('change', '.owner_name', function() {
    $("#owner_input_clean").val(1);
  });
  // $('.alert-success').hide()
  $('.alert-danger').hide()
  //  next and previous function for save
 
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