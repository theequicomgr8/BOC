@extends('admin.layouts.layout')
@section('custom_css')
<link href="{{ asset('css/comman-css.css')}}" rel="stylesheet" />
@endsection
@section('content')
<!-- /.end card-header -->

@php
$readonlyowner = '';
if(@count($ownerotherdata)>=1 && $ownerotherdata !=''){

// $readonlyowner = 'readonly';
}

$ispcheck1 = '';
$ispcheck2 = '';
if(!empty($vendordatas) && $vendordatas['Primary Edition'] == 1){
$ispcheck2 = 'checked="checked"';
}else if(!empty($vendordatas) && $vendordatas['Primary Edition'] == 0){
$ispcheck1 = 'checked="checked"';
}

$check1 = '';
$check2 = '';
if(@$ownerdatas['Owner ID'] != ''){
$check2 = 'checked="checked"';
}else{
$check1 = 'checked="checked"';
}

$disabledall = '';
$checked = '';
if(@$vendordatas['Modification'] == 0 && $vendordatas !=''){
// $disabledall = 'disabled';
$checked = 'checked';
}

$readonlyvendor = '';
if(@$vendordatas['Modification'] == 1){
// $readonlyvendor = 'readonly';

}

$efiling = 'block';
$readonlyvalid = '';
if(@$vendordatas['CIR Base'] == 0 && @$vendordatas['CIR Base'] != ''){
// $readonlyvalid = 'readonly';
}

$reg_no = '';
$solid_circulation = '';
$reg_no_verified = '';
$abc_reg_no_verified = '';
$solid_circulation_verified = '';
$turnover_verified = '';
$date_verified = '';
$efiling = 'none';
$abc_cert = 'none';
$rni_regist_no = 'none';
$udin_number = 'none';
if(@$vendordatas['CIR Base'] == 0 && @$vendordatas['CIR Base'] != ''){
$reg_no = $vendordatas['RNI Registration No_'] ?? '';
$solid_circulation = $vendordatas['Claimed Circulation'] ?? '';
$efiling = 'block';
$abc_cert = 'none';
$rni_regist_no = 'block';
$udin_number = 'none';
$reg_no_verified = $vendordatas['RNI Registration Validation'] ?? '';
$solid_circulation_verified = $vendordatas['RNI Circulation Validation'] ?? '';
$turnover_verified = $vendordatas['RNI Annual Validation'] ?? '';
$date_verified = $vendordatas['RNI Validation Date'] ?? '';
}

if(@$vendordatas['CIR Base'] == 3 && @$vendordatas['CIR Base'] != ''){
$reg_no = $vendordatas['ABC Number'] ?? '';
$solid_circulation = $vendordatas['ABC Circulation Number'] ?? '';
$efiling = 'none';
$abc_cert = 'block';
$rni_regist_no = 'none';
$udin_number = 'none';
$abc_reg_no_verified = $vendordatas['ABC Registration Validation'] ?? '';
$solid_circulation_verified = $vendordatas['ABC Circulation Validation'] ?? '';
$turnover_verified = $vendordatas['ABC Annual Validation'] ?? '';
$date_verified = $vendordatas['ABC Validation Date'] ?? '';
}

if(@$vendordatas['CIR Base'] == 1 && @$vendordatas['CIR Base'] != ''){
$udin_number = 'block';
$solid_circulation = $vendordatas['CA Circulation Number'] ?? '';
}

@endphp

<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-normal text-primary">Company Details</h6>
      <p>
        <!-- @if($vendordatas != '' && @$vendordatas['Modification'] == 0)
        <a href="{{url('print-pdf/'.@$vendordatas['Newspaper Code'])}}" class="m-0 font-weight-normal text-primary"><i class="fa fa-download"></i> Print Application Receipt</a>
        @endif -->
      </p>
    </div>

    <!-- Card Body -->
    <div class="card-body">
    @if(Session::has('update_msg'))
    <div align="center" class="alert alert-success">
        {{ Session('update_msg') }}
    </div>
    @endif
      
      <div style="display: none;" align="center" class="alert alert-danger"></div>
      <form method="POST" action="/print-basic-detail" enctype="multipart/form-data" autocomplete="off" id="fress_emp_form">
        {{ csrf_field() }}
        

        <div class="tab-content">
          <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
            <div class="row">
              {{-- <div class="col-md-4">
                <div class="form-group clearfix">
                  <label for="exist_owner">Applying For First Time / पहली बार आवेदन करना<font color="red">*</font></label><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="exist_owner2" name="exist_owner" onclick="existOwner(this.value)" value="0" {{$check1}} {{$disabledall}}>
                    <label for="exist_owner2"> Fresh User / नया उपयोगकर्ता</label>
                  </div>&nbsp;&nbsp;
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="exist_owner1" name="exist_owner" onclick="existOwner(this.value)" value="1" {{$check2}} {{$disabledall}}>
                    <label for="exist_owner1"> Existing User / मौजूदा उपयोगकर्ता </label>
                  </div>
                </div>
                <span id="alert_exist_owner" style="color:red;display: none;"></span>
              </div> --}}
              <div class="col-md-4" id="exist_owner_ids" style="display:{{$check2 ? 'block' : 'none'}}">
                <div class="form-group">
                  <label for="exist_owner_id">Group Code / समूह कोड<font color="red">*</font></label>
                  <input type="text" readonly class="form-control form-control-sm" id="exist_owner_id" name="exist_owner_id" placeholder="Enter Group Code" onkeypress="javascript:return isAlphaNumeric(event,this.value);" value="{{ @$ownerdatas['Owner ID'] ?? '' }}" maxlength="20" {{$disabledall}} {{$readonlyvendor}} {{$readonlyowner}}>
                  <span id="alert_exist_owner_id" class="error invalid-feedback" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <input type="hidden" name="newspaper_code" value="{{ @$ownerdatas['Newspaper Code'] ?? '' }} ">
              </div>
            </div>
            <div class="row">
              
              <div class="col-md-4">
                <div class="form-group">
                  <label for="owner_name">Owner Name / मालिक का नाम</label>
                  <input type="text" class="form-control form-control-sm" id="name" name="owner_name" placeholder="Enter Owner Name" onkeypress="return onlyAlphabets(event,this)" maxlength="40" value="{{ @$ownerdatas['Owner Name'] ?? '' }}" {{$disabledall}}>
                  @error('owner_name')
                  <span  style="color:red;"> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">Email ID(Owner) / ई मेल आईडी<font color="red">*</font></label>
                  <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" maxlength="50" placeholder="Enter Email ID" value="{{ @$ownerdatas['Email ID'] ?? '' }}" onchange="return checkUniqueOwner('email', this.value)" {{$disabledall}} {{$readonlyvendor}} {{$readonlyowner}}>
                  @error('email')
                  <span  style="color:red;" class="invalid-feedback"> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="mobile">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm @error('mobile') is-invalid @enderror " id="mobile" name="mobile" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{ @$ownerdatas['Mobile No_'] ?? '' }}" onchange="return checkUniqueOwner('mobile', this.value)" {{$disabledall}} {{$readonlyvendor}} {{$readonlyowner}}>
                  <input type="hidden" name="ownermobilecheck" id="ownermobilecheck" value="{{ @$ownerdatas['Mobile No_'] ?? '' }}">
                  @error('mobile')
                  <span  style="color:red;" class="invalid-feedback"> {{ $message }}</span>
                  @enderror
                  
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Owner Type / मालिक का प्रकार<font color="red">*</font></label>
                  <select name="owner_type" id="owner_type" class="form-control  form-control-sm" style="width: 100%;" {{$disabledall}} {{$readonlyowner}}>
                    <option value="">Select Owner Type</option>
                    <option value="0" <?= (@$ownerdatas['Owner Type'] == 0 && @$ownerdatas['Owner Type'] != "") ? 'selected' : '' ?>>Individual</option>
                    <option value="1" <?= (@$ownerdatas['Owner Type'] == 1) ? 'selected' : '' ?>>Partnership</option>
                    <option value="2" <?= (@$ownerdatas['Owner Type'] == 2) ? 'selected' : '' ?>>Trust</option>
                    <option value="3" <?= (@$ownerdatas['Owner Type'] == 3) ? 'selected' : '' ?>>Society</option>
                    <option value="4" <?= (@$ownerdatas['Owner Type'] == 4) ? 'selected' : '' ?>>Proprietorship</option>
                    <option value="5" <?= (@$ownerdatas['Owner Type'] == 5) ? 'selected' : '' ?>>Public Ltd.</option>
                    <option value="6" <?= (@$ownerdatas['Owner Type'] == 6) ? 'selected' : '' ?>>Pvt. Ltd.</option>
                  </select>
                  @error('owner_type')
                  <span  style="color:red;"> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="address">Address / पता<font color="red">*</font></label>
                  <textarea name="address" id="address" placeholder="Enter Address" cols="50" maxlength="220" class="form-control form-control-sm" {{$disabledall}} {{$readonlyowner}}>{{ @$ownerdatas['Address 1'] ?? '' }}</textarea>
                  @error('address')
                  <span  style="color:red;"> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4" id="state_div">
                <div class="form-group">
                  <label for="state">State / राज्य<font color="red">*</font></label>
                  <select id="state" name="state" class="form-control form-control-sm call_district" data="district" style="width: 100%;" {{$disabledall}} {{$readonlyowner}}>
                    <option value="">Select State</option>
                    @foreach($states as $state)
                    <option value="{{$state['Code']}}" {{( @$ownerdatas['State'] === $state['Code'] ? 'selected' : '') }}>{{$state['Code']}} ~ {{$state['Description']}}</option>
                    @endforeach
                  </select>
                  @error('state')
                  <span  style="color:red;"> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="district">District / ज़िला<font color="red">*</font></label>
                  <select id="district" name="district" class="form-control form-control-sm" {{$disabledall}} {{$readonlyowner}}>
                    @if(@$ownerdatas['District'] !='')
                    @foreach($districts as $district)
                    <option value="{{$district['District']}}" {{ (@$ownerdatas['District'] === @$district['District'] ? 'selected' : '') }}>{{ $district['District'] }}</option>
                    @endforeach
                    @endif
                  </select>
                  @error('district')
                  <span  style="color:red;"> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="city">City / नगर<font color="red">*</font></label>
                  <input type="text" id="city" name="city" maxlength="30" onkeypress="return onlyAlphabets(event,this)" class="form-control form-control-sm" placeholder="Enter City" value="{{ @$ownerdatas['City'] ?? '' }}" {{$disabledall}} {{$readonlyowner}}>
                  @error('city')
                  <span  style="color:red;"> {{ $message }}</span>
                  @enderror


                  
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="phone">Phone No. / फोन नंबर</label>
                  <input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="Enter Phone Number" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{ @$ownerdatas['Phone No_'] ?? '' }}" {{$disabledall}} {{$readonlyowner}}>
                  <span id="alert_phone" style="color:red;display: none;"></span>
                </div>
              </div>
              
              
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="pan_copy_file_name1">Owner’s PAN number self-attested copy / पैन नंबर सेल्फ अटेस्टेड कॉपी।<font color="red">*</font></label>
                  <br><br>
                  <div class="input-group">
                    @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['PAN Copy'] == '1') )
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="pan_copy_file_name_modify" id="pan_copy_file_name_modify" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="pan_copy_file_name_modify" id="pan_copy_file_name_modify2">{{ @$vendordatas['PAN Copy File Name'] ? $vendordatas['PAN Copy File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="pan_copy_file_name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="pan_copy_file_name" id="pan_copy_file_name" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="pan_copy_file_name" id="pan_copy_file_name2">{{ @$vendordatas['PAN Copy File Name'] ? $vendordatas['PAN Copy File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="pan_copy_file_name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendordatas['PAN Copy'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['PAN Copy File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <span id="pan_copy_file_name1" class="error invalid-feedback"></span>
                  <span id="pan_copy_file_name_modify1" class="error invalid-feedback"></span>
                  
                </div>
              </div>
              
              
              
              
              
            </div>
            <input type="hidden" name="owner_input_clean" id="owner_input_clean">
            <input type="hidden" name="ownerid" id="ownerid" value="{{ @$ownerdatas['Owner ID'] }}" {{$disabledall}}>
            <input type="hidden" name="Modification" id="Modification" value="{{ $vendordatas['Modification'] ?? ''}}">
            <input type="hidden" name="next_tab_1" id="next_tab_1" value="0" {{$disabledall}}>
            {{-- <a class="btn btn-primary next-button" id="tab_1">Next</a> --}}
            <input type="submit" value="Update" class="btn btn-primary">

          </div>
          
          
          
        </div>
    </div>
    </form>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.content-->
@endsection

@section('custom_js')
<script src="{{ url('/js') }}/fresh-em-validation.js"></script>
<script>
  function checkUniqueOwner(id, val) {
    if (val != '') {
      var email = val;
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'GET',
        url: 'checkuniqueowner/' + email,
        data: {},
        success: function(response) {
          console.log(response);
          if (response.status == 1 && id == 'email') {
            // $("#name").prop("readonly", false);
            $("#owner_type").prop("disabled", false);
            $("#mobile").prop("readonly", false);
            $("#address").prop("readonly", false);
            $("#state").prop("disabled", false);
            $("#district").prop("disabled", false);
            $("#city").prop("readonly", false);
            $("#phone").prop("readonly", false);
            $("#fax").prop("readonly", false);
            $("#davp_panel").prop('checked', false);
            // $("#edition1").prop('disabled', false);
            $("#edition1").prop('checked', false);
            $("#edition2").prop('checked', true);
            // $("#state_val").prop("disabled", true);
            $("#district_val").prop("disabled", true);
            $("#dateoffirstpublication").hide();
            $("#firstpublicationdate").val('');
            $("#tab_1").css('pointer-events', 'visible');
            // owner not exit clean data
            if ($("#owner_input_clean").val() == 0) {
              $("#state").val('');
              $("#district").val('');
              // $("#name").val('');
              $("#owner_type").val('');
              $("#mobile").val('');
              $("#address").val('');
              $("#city").val('');
              $("#phone").val('');
              $("#fax").val('');
              $("#ownerid").val('');
              $("#exist_owner_id").val('');
              //$("#davp_panel").hide();
              $("#add_davp").hide();
              $("#ownermobilecheck").val('');
            }
          }
          if (response.status == 0 && id == 'email') {
            // console.log("testing");
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
              },
              type: 'POST',
              url: "{{Route('fetchownerrecord')}}",
              data: {
                data: val
              },
              dataType: 'json',
              success: function(response) {
                // console.log(response);
                if (response.status == 1) {
                  $("#state").empty();
                  $("#district").empty();
                  $("#state_val").prop("disabled", false);
                  $("#district_val").prop("disabled", false);
                  // $("#name").val(response.message['Owner Name']);
                  $("#mobile").val(response.message['Mobile No_']);
                  $("#address").val(response.message['Address 1']);
                  $("#state").html(response.state);
                  $("#district").html(response.districts);
                  $("#state_val").val(response.message['State']);
                  $("#district_val").val(response.message['District']);
                  $("#city").val(response.message['City']);
                  $("#phone").val(response.message['Phone No_']);
                  $("#fax").val(response.message['Fax No_']);
                  $("#ownerid").val(response.message['Owner ID']);
                  // $("#exist_owner_id").val(response.message['Owner ID']);
                  $("#ownermobilecheck").val(response.message['Mobile No_']);
                  // $("#davp_panel").hide();
                  $("#add_davp").show();
                  $("#add_davp").empty();
                  //console.log(response.vendordatas);
                  var owner_type_arr = ['Individual', 'Partnership', 'Trust', 'Society', 'Proprietorship','Public Ltd','Pvt Ltd'];
                  var owner_type = [];
                  $.each(owner_type_arr, function(index, item) {
                    owner_type.push("<option value='" + index + "' " + (index == response.message['Owner Type'] ? 'selected' : '') + ">" + item + "</option>");
                  });
                  if (response.vendordatas.length >= 1) {
                    var len = response.vendordatas.length - 1;
                    var date_offirst_publication = response.vendordatas[len]['Date Of First Publication'];
                    $("#firstpublicationdate").val(date_offirst_publication);
                  }

                  $("#owner_type").html(owner_type);
                  var i;
                  for (i = 0; i < response.countvendordatas; ++i) {
                    // console.log(response.vendordatas[i]);
                    var item = response.vendordatas[i];
                    var periocity_val = item['Periodicity'];
                    var dis = item['Distance from office to press'];
                    var langval = item['Language'];
                    $("#add_davp").append('<div class="row"><div class="col-md-12"><h4 class="subheading">Details of other publications of same owner or Publisher-----/एक ही मालिक या प्रकाशक के अन्य प्रकाशनों का विवरण ----</h4></div><div class="col-md-4"><div class="form-group"><label for="title">Title / शीषक</label><input type="text" name="title" placeholder="Enter Title" maxlength="40" class="form-control form-control-sm" id="title" value="' + item['Newspaper Name'] + '" readonly></div></div><div class="col-md-4"><div class="form-group"><label>Language / भाषा</label><select name="lang" class="form-control form-control-sm" style="width: 100%;" data="' + langval + '" disabled><?php foreach ($languages as $language) { ?><option value="<?= $language['Code']; ?>" ' + (langval == "<?php echo $language['Code'] ?>" ? 'selected' : '') + ' ><?= $language['Code'] . ' ~ ' . $language['Name']; ?></option><?php } ?></select></div></div><div class="col-md-4"><div class="form-group"><label for="publication">Place of Publication / प्रकाशन का स्थान</label><input maxlength="30" type="text" placeholder="Enter Place of Publication" name="place_of_publication_davp" class="form-control form-control-sm" id="publication" value="' + item['Place of Publication'] + '" readonly></div></div><div class="col-md-4"><br><div class="form-group"><label>Periodicity / अवधि</label><select name="periodicity_davp" class="form-control form-control-sm" style="width: 100%;" disabled><option value="0" ' + (periocity_val == 0 ? 'selected' : '') + '>Daily(M)</option><option value="1" ' + (periocity_val == 1 ? 'selected' : '') + '>Daily(E)</option><option value="2" ' + (periocity_val == 2 ? 'selected' : '') + '>Daily Except Sunday</option><option value="3" ' + (periocity_val == 3 ? 'selected' : '') + '>Bi-Weekly</option><option value="4" ' + (periocity_val == 4 ? 'selected' : '') + '>Weekly</option><option value="5" ' + (periocity_val == 5 ? 'selected' : '') + '>Fortnightly</option><option value="6" ' + (periocity_val == 6 ? 'selected' : '') + '>Monthly</option></select></div></div><div class="col-md-4"><br><div class="form-group"><label for="davp">Owner/Group ID / मालिक/समूह कोड</label><input type="text" name="davp" placeholder="Enter Owner/Group ID" maxlength="8" class="form-control form-control-sm" id="davp" value="' + item['Newspaper Code'] + '" readonly></div></div><div class="col-md-4"><div class="form-group"><label for="edition_distance">Distance from this Edition(In Km) / इस संस्करण से दूरी (किमी. में)</label><input type="text" maxlength="15" Place of placeholder="Enter Distance" name="distance_from_edition" value="' + Math.round(dis) + '" readonly class="form-control form-control-sm" id="edition_distance" onkeypress="return onlyNumberKey(event)"></div></div></div><br>');
                  }
                }

                if (response.countvendordatas > 0) {
                  // $("#name").prop("readonly", true);
                  $("#owner_type").prop("disabled", true);
                  $("#mobile").prop("readonly", true);
                  $("#address").prop("readonly", true);
                  $("#state").prop("disabled", true);
                  $("#district").prop("disabled", true);
                  $("#city").prop("readonly", true);
                  $("#phone").prop("readonly", true);
                  $("#fax").prop("readonly", true);
                  $("#edition2").prop('checked', false);
                  //  $("#edition2").prop("disabled", false);
                  $("#edition1").prop('checked', true);
                  // $("#edition1").prop("disabled", false);
                  $("#davp_panel").prop('checked', true);
                  $("#owner_input_clean").val(0);
                }

              }
            });

          } else if (response.status == 0 && id == 'mobile' && val != $("#ownermobilecheck").val()) {
            //console.log(val);            
            $("#alert_" + id).html(titleCase(id) + ' ' + response.message);
            $("#alert_" + id).show();
            $("#mobile").val('');
          } else {
            $("#alert_" + id).hide();
          }
          if (id == 'mobile') {
            $("#owner_input_clean").val(1);
          }
        }
      });
    }
  }

  //  next and previous function for save 
  function nextSaveData(id) {
    console.log(id);
    if ($("#Modification").val() == 1 || $("#Modification").val() == '') {
      console.log($("#" + id).val());
      if ($("#" + id).val() == 0) {
        $("#" + id).val(1);
      }
      if (id == 'submit_btn') {
        $("#sub_btn").css('pointer-events', 'none')
        $("#response_wait").text('Please Wait...');
      }

      var formData = new FormData($('#fress_emp_form')[0]);
      $.ajax({
        type: "post",
        url: "{{Route('fresh-empanelment-save')}}",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(data) {
          console.log(data);
          if (data.success == true) {

            if (id == 'next_tab_1') {
              $("#ownerid").val(data['data']);
            } else {
              $("#vendorid_tab_2").val(data['data']);
              $("#vendorid_tab_3").val(data['data']);
              $("#vendorid_tab_4").val(data['data']);
            }
            if (id == 'submit_btn') {
              $("html, body").animate({
                scrollTop: 0
              }, 1000);

              $('.alert-success').fadeIn().html(data.message);
              setTimeout(function() {
                $('.alert-success').fadeOut("slow");
                window.location.reload();
              }, 7000);
            }

          }
          if (data.success == false) {
            if (id == 'submit_btn') {
              $("html, body").animate({
                scrollTop: 0
              }, 1000);

              $('.alert-danger').fadeIn().html(data.message);
              setTimeout(function() {
                $('.alert-danger').fadeOut("slow");
              }, 7000);
            }

          }
        },
      });
    } else {
      console.log('Modification');
    }
  }
  // end next and previous function for save   
</script>

@endsection