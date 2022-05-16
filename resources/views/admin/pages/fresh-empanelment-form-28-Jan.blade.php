@extends('admin.layouts.layout')
@section('custom_css')
<link href="{{ asset('css/comman-css.css')}}" rel="stylesheet" />
@endsection
@section('content')
<!-- /.end card-header -->

@php
$readonlyowner = '';
if(@count($ownerotherdata)>=1 && $ownerotherdata !=''){

$readonlyowner = 'readonly';
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
$disabledall = 'disabled';
$checked = 'checked';
}

$readonlyvendor = '';
if(@$vendordatas['Modification'] == 1){
$readonlyvendor = 'readonly';

}

$efiling = 'block';
$readonlyvalid = '';
if(@$vendordatas['CIR Base'] == 0 && @$vendordatas['CIR Base'] != ''){
$readonlyvalid = 'readonly';
}

$reg_no = '';
$solid_circulation = '';
$reg_no_verified = '';
$solid_circulation_verified = '';
$turnover_verified = '';
$date_verified = '';
$efiling = 'none';
$abc_cert = 'none';
if(@$vendordatas['CIR Base'] == 0 && @$vendordatas['CIR Base'] != ''){
$reg_no = $vendordatas['RNI Registration No_'] ?? '';
$solid_circulation = $vendordatas['Claimed Circulation'] ?? '';
$efiling = 'block';
$abc_cert = 'none';
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
$reg_no_verified = $vendordatas['ABC Registration Validation'] ?? '';
$solid_circulation_verified = $vendordatas['ABC Circulation Validation'] ?? '';
$turnover_verified = $vendordatas['ABC Annual Validation'] ?? '';
$date_verified = $vendordatas['ABC Validation Date'] ?? '';
}
@endphp


<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-normal text-primary">Application Form for Fresh Empanelment of Newspaper</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div style="display: none;" align="center" class="alert alert-success"></div>
      <div style="display: none;" align="center" class="alert alert-danger"></div>

      <form method="POST" enctype="multipart/form-data" autocomplete="off" id="fress_emp_form">
        {{ csrf_field() }}

        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active show" data-toggle="tab" href="#tab1">Basic Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab2">Print Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab3">Account Details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab4">Upload Document</a>
          </li>
        </ul>

        <div class="tab-content">
          <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
            <div class="row">
              <div class="col-sm-8">
                <div class="form-group clearfix">
                  <label for="exist_owner">Applying For First Time / पहली बार आवेदन करना<font color="red">*</font></label><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="exist_owner2" name="exist_owner" onclick="existOwner(this.value)" value="0" {{$check1}} {{$disabledall}}>
                    <label for="exist_owner2"> Fresh User / ताजा उपयोगकर्ता</label>
                  </div>&nbsp;&nbsp;
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="exist_owner1" name="exist_owner" onclick="existOwner(this.value)" value="1" {{$check2}} {{$disabledall}}>
                    <label for="exist_owner1"> Existing User / मौजूदा उपयोगकर्ता </label>
                  </div>
                </div>
                <span id="alert_exist_owner" style="color:red;display: none;"></span>
              </div>
              <div class="col-sm-4">
                <div class="form-group" id="exist_owner_ids" style="display:{{$check2 ? 'block' : 'none'}}">
                  <label for="exist_owner_id">Group Code / समूह कोड<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" id="exist_owner_id" name="exist_owner_id" placeholder="Enter Group Code" onkeypress="javascript:return isAlphaNumeric(event,this.value);" value="{{ @$ownerdatas['Owner ID'] ?? '' }}" maxlength="20" {{$disabledall}} {{$readonlyvendor}} {{$readonlyowner}}>
                  <span id="alert_exist_owner_id" class="error invalid-feedback" style="color:red;display: none;"></span>
                </div>
              </div>
              <!-- <div class="col-sm-4"></div> -->
              <div class="col-md-4">
                <div class="form-group">
                  <label for="owner_name">Owner Name / मालिक का नाम</label>
                  <input type="text" class="form-control form-control-sm" id="name" name="owner_name" placeholder="Enter Publication Name" onkeypress="return onlyAlphabets(event,this)" maxlength="40" value="{{ @$ownerdatas['Owner Name'] ?? '' }}" {{$disabledall}} {{$readonlyowner}}>
                  <span id="alert_name" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Owner Type / मालिक का प्रकार<font color="red">*</font></label>
                  <select name="owner_type" id="owner_type" class="form-control  form-control-sm" style="width: 100%;" {{$disabledall}}>
                    <option value="">Select Owner Type</option>
                    <option value="0" <?= (@$ownerdatas['Owner Type'] == 0 && @$ownerdatas['Owner Type'] != "") ? 'selected' : '' ?>>Individual</option>
                    <option value="1" <?= (@$ownerdatas['Owner Type'] == 1) ? 'selected' : '' ?>>Partnership</option>
                    <option value="2" <?= (@$ownerdatas['Owner Type'] == 2) ? 'selected' : '' ?>>Trust</option>
                    <option value="3" <?= (@$ownerdatas['Owner Type'] == 3) ? 'selected' : '' ?>>Society</option>
                    <option value="4" <?= (@$ownerdatas['Owner Type'] == 4) ? 'selected' : '' ?>>Proprietorship</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">E-mail ID(Owner) / ई मेल आईडी<font color="red">*</font></label>
                  <input type="email" class="form-control form-control-sm" id="email" name="email" maxlength="50" placeholder="Enter Email ID" value="{{ @$ownerdatas['Email ID'] ?? '' }}" onchange="return checkUniqueOwner('email', this.value)" {{$disabledall}} {{$readonlyvendor}} {{$readonlyowner}}>
                  <span id="alert_email" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="mobile">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" id="mobile" name="mobile" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{ @$ownerdatas['Mobile No_'] ?? '' }}" onchange="return checkUniqueOwner('mobile', this.value)" {{$disabledall}} {{$readonlyvendor}} {{$readonlyowner}}>
                  <input type="hidden" name="ownermobilecheck" id="ownermobilecheck" value="{{ @$ownerdatas['Mobile No_'] ?? '' }}">
                  <span id="alert_mobile" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="address">Address / पता<font color="red">*</font></label>
                  <textarea name="address" id="address" placeholder="Enter Address" cols="50" maxlength="220" class="form-control form-control-sm" {{$disabledall}} {{$readonlyowner}}>{{ @$ownerdatas['Address 1'] ?? '' }}</textarea>
                  <span id="alert_address" style="color:red;display: none;"></span>
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

                  <span id="alert_state" style="color:red;display: none;"></span>
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

                  <span id="alert_district" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="city">City / नगर<font color="red">*</font></label>
                  <input type="text" id="city" name="city" maxlength="30" onkeypress="return onlyAlphabets(event,this)" class="form-control form-control-sm" placeholder="Enter City" value="{{ @$ownerdatas['City'] ?? '' }}" {{$disabledall}} {{$readonlyowner}}>
                  <span id="alert_city" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="phone">Phone No. / फोन नंबर</label>
                  <input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="Enter Phone Number" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{ @$ownerdatas['Phone No_'] ?? '' }}" {{$disabledall}} {{$readonlyowner}}>
                  <span id="alert_phone" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="fax_no">Fax / फैक्स </label>
                  <input type="text" class="form-control form-control-sm" id="fax" name="fax_no" placeholder="Enter Fax" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{ @$ownerdatas['Fax No_'] ?? '' }}" {{$disabledall}} {{$readonlyowner}}>
                  <span id="alert_fax" style="color:red;display: none;"></span>
                </div>
              </div>
            </div>
            <input type="hidden" name="owner_input_clean" id="owner_input_clean">
            <input type="hidden" name="ownerid" id="ownerid" value="{{ @$ownerdatas['Owner ID'] }}" {{$disabledall}}>
            <input type="hidden" name="Modification" id="Modification" value="{{ $vendordatas['Modification'] ?? ''}}">
            <input type="hidden" name="next_tab_1" id="next_tab_1" value="0" {{$disabledall}}>
            <a class="btn btn-primary next-button" id="tab_1">Next</a>
          </div>
          <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab2-trigger">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="GST_No">GST No. / जीएसटी संख्या</label>
                  <input type="text" class="form-control form-control-sm" name="GST_No" id="GST_No" placeholder="Enter GST No." onkeypress="return isAlphaNumeric(event)" onchange="return checksum(this.value), checkGstUnique(this.value)" maxlength="15" value="{{ $vendordatas['GST No_'] ?? ''}}" {{$disabledall}} {{$readonlyowner}}>
                  <span class="gstvalidationMsg"></span>
                  <span class="validcheck"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>CIR Base / प्रसार बेस<font color="red">*</font></label>
                  <select name="cir_base" id="cir_base" class="form-control  form-control-sm" style="width: 100%;" {{$disabledall}}>
                    <option value="">Select CIR Base</option>
                    <option value="0" <?= (@$vendordatas['CIR Base'] == 0 && @$vendordatas['CIR Base'] != "") ? 'selected' : '' ?>>RNI</option>
                    <option value="1" <?= (@$vendordatas['CIR Base'] == 1 ? 'selected' : '') ?>>CA</option>
                    <option value="2" <?= (@$vendordatas['CIR Base'] == 2 ? 'selected' : '') ?>>PIB</option>
                    <option value="3" <?= (@$vendordatas['CIR Base'] == 3 ? 'selected' : '') ?>>ABC</option>
                  </select>
                  <input type="hidden" name="cir_base_old" id="cir_base_old" value="{{ @$vendordatas['CIR Base'] ?? '' }}">
                  <input type="hidden" name="date_verified_old" id="date_verified_old" value="{{ date('Y-m-d', strtotime($date_verified)) }}">
                  <span id="alert_cir_base" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="rni_registration_no">Registration No. / पंजीकरण संख्या<font color="red">*</font></label>
                  <input type="text" name="rni_registration_no" maxlength="15" placeholder="Enter Registration No." class="form-control  form-control-sm" onchange="return checkRegCIRBase(this.value)" id="rni_registration_no" value="{{ $reg_no }}" {{$disabledall}}>
                  <input type="hidden" name="rni_reg_no_verified" id="rni_reg_no_verified" value="{{ $reg_no_verified }}">
                  <span id="alert_rni_registration_no" style="color:red;display: none;"></span>
                  <span id="rni_reg_no" style="color:green;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4" id="rni-efilling" style="display: {{$efiling}};">
                <div class="form-group">
                  <label for="rni_efiling_no">RNI E-filing Number / आरएनआई ई-फाइलिंग नंबर</label>
                  <input type="text" name="rni_efiling_no" maxlength="15" placeholder="Enter Rni E-filing Number" class="form-control  form-control-sm" id="rni_efiling_no" value="{{ $vendordatas['RNI E-filling No_'] ?? '' }}" {{ @$readonlyvalid }} {{$disabledall}}>
                  <input type="hidden" name="rni_annual_valid" id="rni_annual_valid" value="{{ $turnover_verified }}">
                  <span id="rni_efill_no" style="color:green;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4" id="abc-certificate" style="display: {{$abc_cert}};">
                <div class="form-group">
                  <label for="abc_certificate_no">ABC Certificate No. / एबीसी प्रमाणपत्र संख्या</label>
                  <input type="text" name="abc_certificate_no" maxlength="15" placeholder="Enter ABC Certificate No." class="form-control  form-control-sm" id="abc_certificate_no" value="{{ $vendordatas['ABC Certificate No_'] ?? ''}}" {{ @$readonlyvalid }} {{ $disabledall }}>
                  <span id="abc_cert_no" style="color:green;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="newspaper_name">Newspaper Name / अखबार का नाम<font color="red">*</font></label>
                  <input type="text" name="newspaper_name" placeholder="Enter Newspaper Name" maxlength="40" class="form-control  form-control-sm" id="newspaper_name" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Newspaper Name'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_newspaper_name" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="place_of_publication">Place of Publication / प्रकाशन का स्थान<font color="red">*</font></label>
                  <input type="text" name="place_of_publication" maxlength="25" placeholder="Enter Place of Publication" class="form-control  form-control-sm" id="place_of_publication" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Place of Publication'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_place_of_publication" style="color:red;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="v_email">E-mail ID(Vendor) / ई मेल आईडी<font color="red">*</font></label>
                  <input type="email" class="form-control  form-control-sm" maxlength="40" id="v_email" name="v_email" placeholder="Enter Email ID" value="{{ $vendordatas['E-mail ID'] ?? session('email') }}" onchange="return checkUniqueVendor('email', this.value)" {{$disabledall}}>
                  <input type="hidden" name="vendor_v_email" id="vendor_email" value="{{ $vendordatas['E-mail ID'] ?? '' }}">
                  <span id="v_alert_email" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="v_mobile">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" id="v_mobile" name="v_mobile" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{ $vendordatas['Mobile No_'] ?? '' }}" onchange="return checkUniqueVendor('mobile', this.value)" {{$disabledall}}>
                  <input type="hidden" name="vendor_v_mobile" id="vendor_mobile" value="{{ $vendordatas['Mobile No_'] ?? '' }}">
                  <span id="v_alert_mobile" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="v_address">Address / पता<font color="red">*</font></label>
                  <textarea name="v_address" id="v_address" maxlength="220" placeholder="Enter Address" cols="50" class="form-control  form-control-sm" {{$disabledall}}>{{ $vendordatas['Address'] ?? '' }}</textarea>
                  <span id="v_alert_address" style="color:red;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4" id="v_state_div">
                <div class="form-group">
                  <label for="v_state">State / राज्य<font color="red">*</font></label>
                  <select id="v_state" name="v_state" class="form-control  form-control-sm call_district" data="v_district" style="width: 100%;" {{$disabledall}}>
                    <option value="">Select State</option>
                    @foreach($states as $state)
                    <option value="{{$state['Code']}}" {{( @$vendordatas['State'] === $state['Code'] ? 'selected' : '') }}>{{$state['Code']}} ~ {{$state['Description']}}</option>
                    @endforeach
                  </select>
                  <span id="v_alert_state" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="v_district">District / ज़िला<font color="red">*</font></label>
                  <select id="v_district" name="v_district" class="form-control  form-control-sm" {{$disabledall}}>
                    @if(@$vendordatas['District'] != '')
                    @foreach($districts as $district)
                    <option value="{{$district['District']}}" {{ (@$vendordatas['District'] == $district['District'] ? 'selected' :'') }}>{{ $district['District'] }}</option>
                    @endforeach
                    @endif
                  </select>
                  <span id="v_alert_district" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="v_city">City / नगर<font color="red">*</font></label>
                  <input type="text" id="v_city" name="v_city" maxlength="30" onkeypress="return onlyAlphabets(event,this)" class="form-control  form-control-sm" placeholder="Enter City" value="{{ $vendordatas['City'] ?? '' }}" {{$disabledall}}>
                  <span id="v_alert_city" style="color:red;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="pin_code">Pin Code / पिन कोड<font color="red">*</font></label>
                  <input type="text" id="pin_code" name="pin_code" class="form-control  form-control-sm" placeholder="Enter Pin Code" onkeypress="return onlyNumberKey(event)" maxlength="6" value="{{ $vendordatas['Pin Code'] ?? '' }}" {{$disabledall}}>
                  <span id="v_alert_pin_code" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="v_phone">Phone No. / फोन नंबर</label>
                  <input type="text" class="form-control  form-control-sm" id="v_phone" name="v_phone" placeholder="Enter Phone Number" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{ $vendordatas['Phone No'] ?? '' }}" {{$disabledall}}>
                  <span id="v_alert_phone" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="v_fax_no">Fax / फैक्स </label>
                  <input type="text" class="form-control  form-control-sm" id="v_fax" name="v_fax_no" placeholder="Enter Fax" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{ $vendordatas['Fax'] ?? '' }}" {{$disabledall}}>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4" id="language_div">
                <div class="form-group">
                  <label>Language / भाषा<font color="red">*</font></label>
                  <select name="language" id="language" class="form-control  form-control-sm" style="width: 100%;" {{$disabledall}}>
                    <option value="">Select language</option>
                    @foreach($languages as $language)
                    <option value="{{$language['Code']}}" {{( @$vendordatas['Language'] == $language['Code'] ? 'selected' :'') }}>{{$language['Code']}} ~ {{$language['Name']}}</option>
                    @endforeach
                  </select>
                  <span id="alert_language" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="claimed_circulation">Claimed Circulation No. / दावा प्रसार संचलन <font color="red">*</font></label>
                  <input type="text" name="claimed_circulation" maxlength="8" placeholder="Enter Claimed Circulation No." class="form-control  form-control-sm" id="claimed_circulation" onkeyup="return checkCirculation(this.value)" onkeypress="return onlyNumberKey(event)" value="{{ $solid_circulation }}" {{$disabledall}}>
                  <span id="alert_claimed_circulation" class="error invalid-feedback" style="display: none;"></span>
                  <input type="hidden" name="claimed_circulation_verified" id="claimed_circulation_verified" value="{{ $solid_circulation_verified }}">
                  <input type="hidden" name="claimed_circulation_hidden" id="claimed_circulation_hidden">
                  <span id="rni_claimed_cirl" style="color:green;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4" id="periodicity_div">
                <div class="form-group">
                  <label>Periodicity / अवधि<font color="red">*</font></label>
                  <select name="periodicity" id="periodicity" class="form-control  form-control-sm" {{$disabledall}}>
                    <option value="">Select Periodicity</option>
                    <option value="0" {{ (@$vendordatas['Periodicity'] == 0 && @$vendordatas['Periodicity'] != "" ? 'selected' : '') }}>Daily(M)</option>
                    <option value="1" {{ @$vendordatas['Periodicity'] == 1  ? 'selected' : '' }}>Daily(E)</option>
                    <option value="2" {{ @$vendordatas['Periodicity'] == 2  ? 'selected' : '' }}>Daily Except Sunday</option>
                    <option value="3" {{ @$vendordatas['Periodicity'] == 3  ? 'selected' : '' }}>Bi-Weekly</option>
                    <option value="4" {{ @$vendordatas['Periodicity'] == 4  ? 'selected' : '' }}>Weekly</option>
                    <option value="5" {{ @$vendordatas['Periodicity'] == 5  ? 'selected' : '' }}>Fortnightly</option>
                    <option value="6" {{ @$vendordatas['Periodicity'] == 6  ? 'selected' : '' }}>Monthly</option>
                  </select>
                  <span id="alert_periodicity" style="color:red;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="print_area">Print Area Per Page (in SQ. CM) /प्रति पृष्ठ प्रिंट क्षेत्र (वर्ग सेमी में.)</label>
                  <input type="text" name="print_area" placeholder="Enter Print Area" maxlength="6" class="form-control  form-control-sm" id="print_area" onchange="return printArea(this.value)" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Page Area per page'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Page Area per page'])),0),'.') : '') }}" {{$disabledall}}>
                  <span id="alert_print_area" class="error invalid-feedback" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4"><br>
                <div class="form-group">
                  <label for="page_length">Page Length (in Cms.) / पृष्ठ की लंबाई (सेमी में.)<font color="red">*</font></label>
                  <input type="text" name="page_length" placeholder="Enter Page Length" maxlength="4" class="form-control  form-control-sm" id="page_length" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Page Length'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Page Length'])),0),'.') : '') }}" {{$disabledall}}>
                  <span id="alert_page_length" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4"><br>
                <div class="form-group">
                  <label for="page_width">Page Width (in Cms.) / पृष्ठ की चौड़ाई (सेमी में.)<font color="red">*</font></label>
                  <input type="text" name="page_width" placeholder="Enter Page Width" maxlength="4" class="form-control  form-control-sm" id="page_width" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Page Width'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Page Width'])),0),'.') : '') }}" {{$disabledall}}>
                  <span id="alert_page_width" style="color:red;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4"><br>
                <div class="form-group">
                  <label for="no_of_page">No. Of Pages / पृष्ठों की संख्या<font color="red">*</font></label>
                  <input type="text" name="no_of_page" placeholder="Enter No. Of Pages" maxlength="4" class="form-control  form-control-sm" id="no_of_page" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['No_ Of pages'] !=0 ? @$vendordatas['No_ Of pages'] : '') }}" {{$disabledall}}>
                  <span id="alert_no_of_page" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="total_print_area">Total Print Area (in Sq. Cms.) / कुल प्रिंट क्षेत्र (वर्ग सेमी में.)</label>
                  <input type="text" name="total_print_area" placeholder="Enter Total Print Area" maxlength="20" class="form-control  form-control-sm" id="total_print_area" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Total Print Area'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Total Print Area'])),0),'.') : '') }}" readonly>
                  <span id="alert_total_print_area" style="color:red;display: none;"></span>
                </div>
              </div>

            </div>
            <h4 class="subheading">Minimum Current Card Rate/न्यूनतम वर्तमान कार्ड दर</h4>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="black_white">Black & White (Rs per SQ CM) / ब्लैक एंड व्हाइट (रुपये प्रति वर्ग सेमी)</label>
                  <input type="text" name="black_white" maxlength="15" placeholder="Enter Black & White" class="form-control  form-control-sm" id="black_white" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Minimum Current Card Rate(B_W)'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Minimum Current Card Rate(B_W)'] )),0),'.') : '' ) }}" {{$disabledall}}>
                  <span id="alert_black_white" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4"><br>
                <div class="form-group">
                  <label for="colour">Color (Rs per SQ CM) / रंग (रुपये प्रति वर्ग सेमी)</label>
                  <input type="text" name="colour" placeholder="Enter Color" maxlength="15" class="form-control  form-control-sm" id="colour" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Minimum Current Card Rate(c)'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Minimum Current Card Rate(c)'] )),0),'.') : '') }}" {{$disabledall}}>
                  <span id="alert_colour" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4"><br>
                <div class="form-group">
                  <label for="price_newspaper">Price of Newspaper (Rs) / अखबार की कीमत (रु)<font color="red">*</font></label>
                  <input type="text" name="price_newspaper" maxlength="15" placeholder="Enter Price of Newspaper" class="form-control  form-control-sm" id="price_newspaper" onkeypress="return isNumber(event,this)" value="{{ (@$vendordatas['Price of NewsPaper'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Price of NewsPaper'] )),0),'.') : '') }}" {{$disabledall}}>
                  <span id="alert_price_newspaper" style="color:red;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group clearfix">
                  <label for="quality_paper_used">Quality of Paper Used / प्रयुक्त कागज की गुणवत्ता<font color="red">*</font></label><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary1" name="quality_paper_used" value="0" <?= (@$vendordatas['Quality of Paper'] == "0" ? "checked" : ""); ?> {{$disabledall}}>
                    <label for="radioPrimary1">Standard Newspaper / मानक समाचार पत्र </label>
                  </div><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary2" name="quality_paper_used" value="1" <?= (@$vendordatas['Quality of Paper'] == "1" ? "checked" : ""); ?> {{$disabledall}}>
                    <label for="radioPrimary2">Glazed / चमकता हुआ </label>
                  </div>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary3" name="quality_paper_used" value="2" <?= (@$vendordatas['Quality of Paper'] == "2" ? "checked" : ""); ?> {{$disabledall}}>
                    <label for="radioPrimary3">Ordinary / साधारण </label>
                  </div>
                </div>
                <span id="alert_quality_paper_used" style="color:red;display: none;"></span>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Printing in Color / रंग में मुद्रण<font color="red">*</font></label>
                  <select name="printing_colour" id="printing_colour" class="form-control  form-control-sm" style="width: 100%;" {{$disabledall}}>
                    <option value="">Select Color</option>
                    <option value="0" <?= (@$vendordatas['Printing in colour'] == 0 && @$vendordatas['Printing in colour'] != "" ? 'selected' : ''); ?>>Color</option>
                    <option value="1" <?= (@$vendordatas['Printing in colour'] == "1" ? "selected" : ""); ?>>B/W</option>
                  </select>
                  <span id="alert_printing_colour" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                @php
                if(@$vendordatas['Printing in colour'] == "0"){
                $display = 'block';
                }else{
                $display = 'none';
                }
                @endphp
                <div class="form-group" id="colour_page" style="display:{{ @$display }}">
                  <label for="colour_pages">How many Pages in Color / रंग में कितने पृष्ठ </label>
                  <input type="text" name="colour_pages" maxlength="8" placeholder="Enter Pages in Color" class="form-control  form-control-sm" id="colour_pages" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['No_ of pages in colour'] !=0 ? $vendordatas['No_ of pages in colour'] : '') }}" {{$disabledall}}>
                  <span id="alert_colour_pages" style="color:red;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>News Agencies Subscribed to / समाचार एजेंसियों ने सदस्यता ली<font color="red">*</font></label>
                  <select name="news_agencies_subscribed" id="news_agencies_subscribed" class="form-control  form-control-sm" style="width: 100%;" {{$disabledall}}>
                    <option value="">Select any one</option>
                    <option value="0" <?= (@$vendordatas['News Agencies Subscribed To'] == 0 && @$vendordatas['News Agencies Subscribed To'] != ""  ? 'selected' : ''); ?>>PTI</option>
                    <option value="1" <?= (@$vendordatas['News Agencies Subscribed To'] == 1  ? 'selected' : ''); ?>>Others</option>
                  </select>
                  <span id="alert_news_agencies_subscribed" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4" id="agenciesDiv"><br>
                <div class="form-group">
                  <label for="agencies">Enter Agency / एजेंसी दर्ज करें<font color="red">*</font></label>
                  <input type="text" name="agencies" maxlength="60" id="agencies" placeholder="Enter Agency" class="form-control  form-control-sm" id="agencies" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Agencies Name'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_agencies" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="total_annual">Total Annual Turnover of The Newspaper in Rs / अखबार का कुल वार्षिक कारोबार रु</label>
                  <input type="text" name="total_annual_turn_over" maxlength="10" placeholder="Enter Total annual turnover of the newspaper in Rs" class="form-control  form-control-sm" id="total_annual" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Annual Turn-over'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Annual Turn-over'])),0),'.') : '') }}" {{$disabledall}}>
                  <span id="alert_total_annual" style="color:red;display: none;"></span>
                  <span id="alert_total_annual_turn" style="color:#f8b739;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="name_of_editor">Editor Name/ संपादक का नाम<font color="red">*</font></label>
                  <input type="text" name="name_of_editor" maxlength="40" placeholder="Editor Name" class="form-control  form-control-sm" id="name_of_editor" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Editor Name'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_name_of_editor" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="editor_mobile">Editor Mobile No. / संपादक का मोबाइल नंबर<font color="red">*</font></label>
                  <input type="text" name="editor_mobile" maxlength="10" placeholder="Enter Editor Mobile" class="form-control  form-control-sm" id="editor_mobile" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['Editor Mobile'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_editor_mobile" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="editor_email">Editor Email ID / संपादक का ई मेल आईडी<font color="red">*</font></label>
                  <input type="text" name="editor_email" maxlength="40" placeholder="Enter Editor Email ID" class="form-control  form-control-sm" id="editor_email" value="{{ $vendordatas['Editor Email'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_editor_email" style="color:red;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="publisher_name">Publisher Name / प्रकाशक का नाम<font color="red">*</font></label>
                  <input type="text" name="publisher_name" maxlength="40" placeholder="Enter Publisher Name" class="form-control  form-control-sm" id="publisher_name" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Publisher_s Name'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_publisher_name" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="publisher_mobile">Publisher Mobile / प्रकाशक का मोबाइल नंबर<font color="red">*</font></label>
                  <input type="text" name="publisher_mobile" maxlength="10" placeholder="Enter Publisher Mobile" class="form-control  form-control-sm" id="publisher_mobile" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['Publisher Mobile'] ??'' }}" {{$disabledall}}>
                  <span id="alert_publisher_mobile" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="publisher_email">Publisher Email ID / प्रकाशक का ई मेल आईडी<font color="red">*</font></label>
                  <input type="text" name="publisher_email" maxlength="40" placeholder="Enter Publisher Email ID" class="form-control  form-control-sm" id="publisher_email" value="{{ $vendordatas['Publisher Email'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_publisher_email" style="color:red;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="printer_name">Printer Name / प्रिंटर का नाम<font color="red">*</font></label>
                  <input type="text" name="printer_name" maxlength="50" placeholder="Enter Printer Name" class="form-control  form-control-sm" id="printer_name" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Printer_s Name'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_printer_name" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="printer_mobile">Printer Mobile / प्रिंटर का मोबाइल नंबर<font color="red">*</font></label>
                  <input type="text" name="printer_mobile" maxlength="10" placeholder="Enter Printer Mobile" class="form-control  form-control-sm" id="printer_mobile" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['Printer Mobile'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_printer_mobile" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="printer_email">Printer Email ID / प्रिंटर का ई मेल आईडी<font color="red">*</font></label>
                  <input type="text" name="printer_email" maxlength="40" placeholder="Enter Printer Email ID" class="form-control  form-control-sm" id="printer_email" value="{{ $vendordatas['Printer Email'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_printer_email" style="color:red;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group clearfix">
                  <label for="owner_newspaper">Is the press Owned by the owner of newspaper? / क्या प्रेस का स्वामित्व अखबार के मालिक के पास है? ?<font color="red">*</font> </label><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="owner_newspaper2" name="press_owned_by_owner" class="owner_press" value="0" <?= (@$vendordatas['Press owned by owner'] === "0" ? "checked" : ""); ?> {{$disabledall}}>
                    <label for="owner_newspaper2">No / नहीं</label>
                  </div>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="owner_newspaper1" name="press_owned_by_owner" class="owner_press" value="1" <?= (@$vendordatas['Press owned by owner'] == "1" ? "checked" : ""); ?> {{$disabledall}}>
                    <label for="owner_newspaper1">Yes / हाँ </label>&nbsp;&nbsp;
                  </div>
                </div>
                <span id="alert_owner_newspaper" style="color:red;display: none;"></span>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="name_of_press">Press Name/ प्रेस का नाम<font color="red">*</font></label>
                  <input type="text" name="name_of_press" maxlength="40" placeholder="Press Name" class="form-control  form-control-sm" id="name_of_press" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Name of Press'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_name_of_press" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="press_mobile">Press Mobile / प्रेस का मोबाइल नंबर<font color="red">*</font></label>
                  <input type="text" name="press_mobile" maxlength="10" placeholder="Enter Press Mobile" class="form-control  form-control-sm" id="press_mobile" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['Press Mobile'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_press_mobile" style="color:red;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="press_email">Press Email ID / प्रेस का ई मेल आईडी<font color="red">*</font></label>
                  <input type="text" name="press_email" maxlength="40" placeholder="Enter Press Email ID" class="form-control  form-control-sm" id="press_email" value="{{ $vendordatas['Press Email'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_press_email" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="press_phone">Press Phone No. / प्रेस का फोन नंबर<font color="red">*</font></label>
                  <input type="text" name="press_phone" maxlength="15" placeholder="Enter Press Phone" class="form-control  form-control-sm" id="press_phone" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['Press Phone'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_press_phone" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="address_of_press">Address of Press / प्रेस का पता</label>
                  <textarea type="text" class="form-control  form-control-sm" maxlength="220" placeholder="Enter Address of Press" name="address_of_press" id="address_of_press" {{$disabledall}}>{{ $vendordatas['Address of Press'] ?? '' }}</textarea>
                  <span id="alert_address_of_press" style="color:red;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="distance_press">Distance from Office to Press (In Km) / कार्यालय से प्रेस की दूरी (किमी. में)</label>
                  <input type="text" name="distance_office_to_press" maxlength="15" placeholder="Enter Distance From Office to press" class="form-control  form-control-sm" id="distance_press" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendordatas['Distance from office to press'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Distance from office to press'] )),0),'.') : '') }}" {{$disabledall}}>
                  <span id="alert_distance_press" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4"><br>
                <div class="form-group">
                  <label for="ca_name">CA Name / सीए का नाम</label>
                  <input type="text" name="ca_name" maxlength="40" placeholder="Enter CA`s Name" class="form-control  form-control-sm" id="ca_name" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['CA Name'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_ca_name" style="color:red;display: none;"></span>
                </div>
              </div>
              <!-- <div class="col-md-4"><br>
                <div class="form-group">
                  <label for="ca_unique_no">CA Unique No. / सीए का यूनिक नंबर</label>
                  <input type="text" name="ca_unique_no" maxlength="25" placeholder="Enter CA`s Unique No." class="form-control  form-control-sm" id="ca_unique_no" value="{{ $vendordatas['CA Unique No_'] ?? '' }}" {{$disabledall}}>
                </div>
              </div> -->
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="ca_address">CA Address / सीए का पता</label>
                  <textarea type="text" class="form-control  form-control-sm" placeholder="Enter CA`s Address" name="ca_address" id="ca_address" maxlength="220" {{$disabledall}}>{{ $vendordatas['CA Address'] ?? '' }}</textarea>
                  <span id="alert_ca_address" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="ca_registration_no">CA Registration No. / सीए पंजीकरण संख्या</label>
                  <input type="text" name="ca_registration_no" maxlength="20" placeholder="Enter CA's Registration No." class="form-control  form-control-sm" id="ca_registration_no" onkeypress="javascript:return isAlphaNumeric(event,this.value);" value="{{ $vendordatas['CA Registration No_'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_ca_registration_no" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="ca_mobile">CA Mobile No. / सीए का मोबाइल नंबर</label>
                  <input type="text" name="ca_mobile" maxlength="10" placeholder="Enter CA's Mobile" class="form-control  form-control-sm" id="ca_mobile" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['CA Mobile No_'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_ca_mobile" style="color:red;display: none;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4"><br>
                <div class="form-group">
                  <label for="ca_email">CA Email ID / सीए का ई मेल आईडी</label>
                  <input type="text" name="ca_email" maxlength="40" placeholder="Enter CA's Email ID" class="form-control  form-control-sm" id="ca_email" value="{{ $vendordatas['CA Email'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_ca_email" style="color:red;display: none;"></span>
                </div>
              </div>
              <!-- <div class="col-md-4"><br>
                <div class="form-group">
                  <label for="cin_no">CIN No. / सीआईएन नंबर</label>
                  <input type="text" name="cin_no" maxlength="15" placeholder="Enter CIN No." class="form-control  form-control-sm" id="cin_no" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['CIN Number'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_cin_no" style="color:red;display: none;"></span>
                </div>
              </div> -->
              @php
              $dm_date = ' ';

              if((@$vendordatas['DM Declaration Date'] != '1970-01-01 00:00:00.000') && $vendordatas != null){
              $dm_date = date('Y-m-d', strtotime(@$vendordatas['DM Declaration Date'] ));
              }
              @endphp
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dm_declaration_date">DM Declaration End Date / डीएम घोषणा समाप्ति तिथि<font color="red">*</font></label>
                  <input type="date" name="dm_declaration_date" class="form-control  form-control-sm" id="dm_declaration_date" value="{{$dm_date}}" min="{{date('Y-m-d')}}" {{$disabledall}}>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group clearfix">
                  <label for="edition">Vendor Edition / विक्रेता संस्करण</label><br>
                  <div class="icheck-primary d-inline">
                    @php
                    $vendor_edition_check = (@$ownerotherdata == '' ? "checked" : "");
                    @endphp
                    <input type="radio" id="edition2" name="vendor_edition" value="0" {{ $vendor_edition_check }} {{$disabledall}}>
                    <label for="edition2">Single Edition/एकल संस्करण</label>
                  </div><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="edition1" name="vendor_edition" value="1" {{ (@count($ownerotherdata)>=1 && $ownerotherdata != '')  ? "checked" : "" }} {{$disabledall}}>
                    <label for="edition1">Multiple Edition/एकाधिक संस्करण</label>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group clearfix">
                  <label for="change_address">Is Past Address Changed ? / क्या पिछला पता बदल गया है ? </label><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="change_address2" name="change_address" onclick="changeCompAddr(this.value)" value="0" <?= (@$vendordatas['Change In Company Address'] === "0"  ? "checked" : ""); ?> {{$disabledall}}>
                    <label for="change_address2">No / नहीं</label>
                  </div>&nbsp;&nbsp;
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="change_address1" name="change_address" value="1" onclick="changeCompAddr(this.value)" <?= (@$vendordatas['Change In Company Address'] === "1"  ? "checked" : ""); ?> {{$disabledall}}>
                    <label for="change_address1">Yes / हाँ </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <!-- checkbox -->
                <div class="form-group clearfix">
                  <!-- <div class="icheck-primary d-inline">
                    <input type="checkbox" id="davp_panel" name="davp_checkbox" {{ (@count($ownerotherdata) >=1 && $ownerotherdata != '') ? "checked" : "" }} disabled {{$disabledall}}>
                    <label for="davp_panel">Click if having other publications on DAVP panel by same owner/ क्लिक करें यदि एक ही मालिक द्वारा डीएवीपी पैनल पर अन्य प्रकाशन हैं </label>
                  </div> -->
                </div>
              </div>
            </div>

            @if(@count($ownerotherdata)>=1 && $ownerotherdata != '')

            @foreach($ownerotherdata as $key => $owner_other_data)
            <div class="row" {{$key}}>
              <div class="col-md-12">
                <h4 class="subheading">Details of other publications of same owner or Publisher-----/एक ही मालिक या प्रकाशक के अन्य प्रकाशनों का विवरण ----</h4>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="title">Title / शीषक</label>
                  <input type="text" name="title" placeholder="Enter Title" maxlength="50" class="form-control  form-control-sm" id="title1" onkeypress="javascript:return isAlphaNumeric(event,this.value);" value="{{ $owner_other_data['Newspaper Name'] ?? '' }}" disabled>
                  <span id="alert_title" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Language / भाषा</label>
                  <select id="davp_lang1" name="lang" class="form-control  form-control-sm" style="width: 100%;" disabled>
                    <option value="" data-select2-id="2">Select Language</option>
                    @foreach($languages as $language)
                    <option value="{{ $language['Code'] }}" {{ @$ownerotherdata[$key]['Language'] == $language['Code']  ? 'selected' : '' }}>{{ $language['Code'] }} ~ {{ $language['Name'] }}</option>
                    @endforeach
                  </select>
                  <span id="alert_davp_lang1" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="publication">Place of Publication / प्रकाशक का स्थान</label>
                  <input type="text" name="place_of_publication_davp" maxlength="20" placeholder="Enter Place of Publication" class="form-control  form-control-sm" id="publication1" onkeypress="return onlyAlphabets(event,this)" value="{{ $owner_other_data['Place of Publication'] ?? '' }}" disabled>
                  <span id="alert_publication" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4"><br>
                <div class="form-group">
                  <label>Periodicity / अवधि</label>
                  <select name="periodicity_davp" id="periodicity_mult" class="form-control  form-control-sm" disabled>
                    <option value="0" {{ @$ownerotherdata[$key]['Periodicity'] == 0  ? 'selected' : '' }}>Daily(M)</option>
                    <option value="1" {{ @$ownerotherdata[$key]['Periodicity'] == 1  ? 'selected' : '' }}>Daily(E)</option>
                    <option value="2" {{ @$ownerotherdata[$key]['Periodicity'] == 2  ? 'selected' : '' }}>Daily Except Sunday</option>
                    <option value="3" {{ @$ownerotherdata[$key]['Periodicity'] == 3  ? 'selected' : '' }}>Bi-Weekly</option>
                    <option value="4" {{ @$ownerotherdata[$key]['Periodicity'] == 4  ? 'selected' : '' }}>Weekly</option>
                    <option value="5" {{ @$ownerotherdata[$key]['Periodicity'] == 5  ? 'selected' : '' }}>Fortnightly</option>
                    <option value="6" {{ @$ownerotherdata[$key]['Periodicity'] == 6  ? 'selected' : '' }}>Monthly</option>
                  </select>
                  <span id="alert_periodicity_mult" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4"><br>
                <div class="form-group">
                  <label for="davp">Owner/Group ID / मालिक/समूह कोड </label>
                  <input type="text" name="davp" placeholder="Enter Owner/Group ID" class="form-control  form-control-sm" id="davp" maxlength="8" value="{{ @$ownerotherdata[$key]['Newspaper Code'] ?? '' }}" disabled>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="edition_distance">Distance from this Edition(In Km) / इस संस्करण से दूरी (किमी. में)</label>
                  <input type="text" name="distance_from_edition[]" maxlength="15" placeholder="Enter Distance" class="form-control  form-control-sm" id="edition_distance" onkeypress="return onlyNumberKey(event)" value="{{ @$ownerotherdata !='' ?  @rtrim(rtrim(sprintf('%f', floatval(@$ownerotherdata[$key]['Distance from office to press'])),0),'.') : ''}}" disabled>
                  <span id="alert_edition_distance" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4"></div>
            </div>
            @endforeach
            @else
            <div class="row" id="add_davp" style="margin: 0px;">
            </div>
            @endif

            <input type="hidden" name="vendorid_tab_2" id="vendorid_tab_2" value="{{$vendordatas['Newspaper Code'] ?? ''}}" {{$disabledall}}>
            <input type="hidden" name="user_id" value="{{ session('id') }}" {{$disabledall}}>
            <input type="hidden" name="next_tab_2" id="next_tab_2" value="0" {{$disabledall}}>
            <a class="btn btn-primary reg-previous-button previousClass" data="10">Previous</a>
            <a class="btn btn-primary next-button" id="tab_2">Next</a>

          </div>
          <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab3-trigger">
            <div class="row">
              <div class="col-md-4"><br><br><br>
                <div class="form-group">
                  <label for="account_type">Account Type / खाते का प्रकार<font color="red">*</font></label>
                  <select class="form-control  form-control-sm" name="account_type" id="account_type" {{$disabledall}}>
                    <option value="">Select Account Type</option>
                    <option value="0" {{ (@$vendordatas['Account Type'] == 0 && @$vendordatas['Account Type'] != "" ? 'selected' : '') }}>Savings</option>
                    <option value="1" {{ (@$vendordatas['Account Type'] == 1 ? 'selected' : '') }}>Corporate</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="bank_account_no">Bank account number for receiving number*Bank Account No. for receiving Payments / संख्या प्राप्त करने के लिए बैंक खाता संख्या * भुगतान प्राप्त करने के लिए बैंक खाता संख्या<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" name="bank_account_no" maxlength="20" id="bank_account_no" placeholder="Enter Bank Account Number" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['Bank Account No_'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_bank_account_no" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4"><br><br>
                <div class="form-group divmargin">
                  <label for="account_holder_name">Account's Holder Name / खाता धारक का नाम<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" name="account_holder_name" maxlength="70" id="account_holder_name" placeholder="Enter Account Holder Name" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendordatas['Account Holder Name'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_account_holder_name" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="bank_name">Bank Name / बैंक का नाम<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" name="bank_name" id="bank_name" maxlength="50" placeholder="Enter Bank Name" value="{{ $vendordatas['Bank Name'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_bank_name" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="ifsc_code">IFSC Code / आईएफएससी कोड<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" name="ifsc_code" id="ifsc_code" maxlength="11" placeholder="Enter IFSC Code" value="{{ $vendordatas['IFSC Code'] ?? '' }}" {{$disabledall}} onchange="validateIfscCode(this);">
                  <span id="alert_ifsc_code" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="branch_name">Branch / शाखा<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" name="branch_name" id="branch_name" maxlength="40" placeholder="Enter Branch" value="{{ $vendordatas['Branch'] ?? '' }}" {{$disabledall}}>
                  <span id="alert_branch_name" style="color:red;display: none;"></span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="address_of_account">Address of account / खाते का पता<font color="red">*</font></label>
                  <textarea class="form-control  form-control-sm" placeholder="Enter Address of Account" maxlength="220" name="address_of_account" id="address_of_account" {{$disabledall}}>{{ $vendordatas['Account Address'] ?? '' }}</textarea>
                  <span id="alert_address_of_account" style="color:red;display: none;"></span>

                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="pan_card">PAN Card No.(If alloted) / पैन कार्ड नंबर<font color="red">*</font></label>
                  <input type="text" name="pan_card" id="pan_card" class="form-control  form-control-sm" maxlength="10" placeholder="Enter Pan Card" value="{{ $vendordatas['PAN'] ?? '' }}" {{$disabledall}} onchange="validatePanNumber(this)">
                  <span id="alert_pan_card" style="color:red;display: none;"></span>
                </div>
              </div>
              <fieldset class="fieldset-border">
                <legend>ESI Account Details / ईएसआई खाता विवरण</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ESI_account_no">Account No. / खाता नंबर</label>
                      <input type="text" name="ESI_account_no" id="ESI_account_no" maxlength="20" class="form-control  form-control-sm" placeholder="Enter Account No" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['ESI Account No'] ?? '' }}" {{$disabledall}}>
                      <span id="alert_address_of_account" style="color:red;display: none;"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ESI_no_employees">No of employees covered / कवर किए गए कर्मचारियों की संख्या</label>
                      <input type="text" name="ESI_no_employees" id="ESI_no_employees" maxlength="6" class="form-control  form-control-sm" placeholder="Enter No of Employees Covered" onkeypress="return onlyNumberKey(event)" value="{{ ((@$vendordatas['No_of Employees covered'] && @$vendordatas['No_of Employees covered'] !=0) ? @$vendordatas['No_of Employees covered'] : '')  }}" {{$disabledall}}>
                      <span id="alert_ESI_no_employees" style="color:red;display: none;"></span>
                    </div>
                  </div>
                </div>
              </fieldset>
              <fieldset class="fieldset-border">
                <legend>EPF Account Details / ईपीएफ खाता विवरण</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="Name">Account No. / खाता नंबर</label>
                      <input type="text" name="EPF_account_no" id="EPF_account_no" maxlength="20" class="form-control  form-control-sm" placeholder="Enter Account No" onkeypress="return onlyNumberKey(event)" value="{{ $vendordatas['EPF Account No_'] ?? '' }}" {{$disabledall}}>
                    </div>
                    <span id="alert_EPF_account_no" style="color:red;display: none;"></span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="Name">No of employees covered / कवर किए गए कर्मचारियों की संख्या</label>
                      <input type="text" name="EPF_no_of_employees" id="EPF_no_of_employees" maxlength="6" class="form-control  form-control-sm" placeholder="Enter No of Employees Covered" onkeypress="return onlyNumberKey(event)" value="{{ ((@$vendordatas['No_ of EPF Employees covered'] && @$vendordatas['No_ of EPF Employees covered'] !=0) ? @$vendordatas['No_ of EPF Employees covered'] : '')  }}" {{$disabledall}}>
                      <span id="alert_EPF_no_of_employees" style="color:red;display: none;"></span>
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>

            <input type="hidden" name="vendorid_tab_3" id="vendorid_tab_3" value="{{$vendordatas['Newspaper Code'] ?? ''}}" {{$disabledall}}>
            <input type="hidden" name="next_tab_3" id="next_tab_3" value="0" {{$disabledall}}>
            <a class="btn btn-primary reg-previous-button previousClass" data="11">Previous</a>
            <a class="btn btn-primary next-button" id="tab_3">Next</a>

          </div>
          <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab4-trigger">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="annexure_file_name1">Annexure – A (signed by C.A) (only PDF) max size 2MB / अनुलग्नक - ए (सीए द्वारा हस्ताक्षरित) (केवल पीडीएफ) अधिकतम आकार 2MB<font color="red">*</font></label>
                  <br><br>
                  <div class="input-group">
                    @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['Annexure - XII_A'] == '1') )
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="annexure_file_name_modify" id="annexure_file_name_modify" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="annexure_file_name_modify" id="annexure_file_name_modify2">{{ @$vendordatas['Annexure File Name'] ? $vendordatas['Annexure File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="annexure_file_name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="annexure_file_name" id="annexure_file_name" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="annexure_file_name" id="annexure_file_name2">{{ @$vendordatas['Annexure File Name'] ? $vendordatas['Annexure File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="annexure_file_name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendordatas['Annexure - XII_A'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Annexure File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      <input type="hidden" name="annexure_filename" id="annexure_filename" value="{{ @$vendordatas['Annexure File Name'] }}">
                    </div>
                    @endif
                  </div>
                  <span id="annexure_file_name1" class="error invalid-feedback"></span>
                  <span id="annexure_file_name_modify1" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="dm_declaration_file_name1">Latest DM certification uploaded in case of change ownership, printers, publisher, editor/
                    स्वामित्व, प्रिंटर, प्रकाशक, संपादक बदलने के मामले में नवीनतम डीएम प्रमाणीकरण अपलोड किया गया<font color="red">*</font></label>
                  <div class="input-group">
                    @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['DM Decl_ in case of Change'] == '1') )
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="dm_declaration_file_name_modify" id="dm_declaration_file_name_modify" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="dm_declaration_file_name_modify" id="dm_declaration_file_name_modify2">{{ @$vendordatas['DM Declaration File Name'] ? $vendordatas['DM Declaration File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="dm_declaration_file_name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="dm_declaration_file_name" id="dm_declaration_file_name" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="dm_declaration_file_name" id="dm_declaration_file_name2">{{ @$vendordatas['DM Declaration File Name'] ? $vendordatas['DM Declaration File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="dm_declaration_file_name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendordatas['DM Decl_ in case of Change'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['DM Declaration File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <span id="dm_declaration_file_name1" class="error invalid-feedback"></span>
                  <span id="dm_declaration_file_name_modify1" class="error invalid-feedback"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="specimen_copy_file_name1">Specimen copies to be sent with application / आवेदन के साथ भेजी जाने वाली नमूना प्रतियां <font color="red">*</font></label>
                  <div class="input-group">
                    @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['Specimen Copies'] == '1') )
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="specimen_copy_file_name_modify" id="specimen_copy_file_name_modify" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="specimen_copy_file_name_modify" id="specimen_copy_file_name_modify2">{{ @$vendordatas['Specimen Copy File Name'] ? $vendordatas['Specimen Copy File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="specimen_copy_file_name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="specimen_copy_file_name" id="specimen_copy_file_name" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="specimen_copy_file_name" id="specimen_copy_file_name2">{{ @$vendordatas['Specimen Copy File Name'] ? $vendordatas['Specimen Copy File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="specimen_copy_file_name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendordatas['Specimen Copies'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Specimen Copy File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <span id="specimen_copy_file_name1" class="error invalid-feedback"></span>
                  <span id="specimen_copy_file_name_modify1" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="commercial_rate_file_name1">Copy of commercial rate card of the publication (1 copy) / प्रकाशन के वाणिज्यिक दर कार्ड की प्रति (1 प्रति)<font color="red">*</font></label>
                  <div class="input-group">
                    @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['Commercial Rate'] == '1') )
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="commercial_rate_file_name_modify" id="commercial_rate_file_name_modify" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="commercial_rate_file_name_modify" id="commercial_rate_file_name_modify2">{{ @$vendordatas['Commercial Rate File Name'] ? $vendordatas['Specimen Copy File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="commercial_rate_file_name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="commercial_rate_file_name" id="commercial_rate_file_name" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="commercial_rate_file_name" id="commercial_rate_file_name2">{{ @$vendordatas['Commercial Rate File Name'] ? $vendordatas['Specimen Copy File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="commercial_rate_file_name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendordatas['Commercial Rate'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Commercial Rate File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <span id="commercial_rate_file_name1" class="error invalid-feedback"></span>
                  <span id="commercial_rate_file_name_modify1" class="error invalid-feedback"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="declaration_field_file_name1">Copy of declaration field by before DM/DCP or other competent authority/
                    डीएम/डीसीपी या अन्य सक्षम प्राधिकारी के समक्ष घोषणा क्षेत्र की प्रति।<font color="red">*</font></label>
                  <div class="input-group">
                    @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['Declaration Filed Before Auth_'] == '1') )
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="declaration_field_file_name_modify" id="declaration_field_file_name_modify" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="declaration_field_file_name_modify" id="declaration_field_file_name_modify2">{{ @$vendordatas['Decl_ Filed Before File Name'] ? $vendordatas['Decl_ Filed Before File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="declaration_field_file_name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="declaration_field_file_name" id="declaration_field_file_name" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="declaration_field_file_name" id="declaration_field_file_name2">{{ @$vendordatas['Decl_ Filed Before File Name'] ? $vendordatas['Decl_ Filed Before File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="declaration_field_file_name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendordatas['Declaration Filed Before Auth_'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Decl_ Filed Before File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <span id="declaration_field_file_name1" class="error invalid-feedback"></span>
                  <span id="declaration_field_file_name_modify1" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="pan_copy_file_name1">PAN number self-attested copy / पैन नंबर सेल्फ अटेस्टेड कॉपी।<font color="red">*</font></label>
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
            <div class="row">
              <div class="col-md-6">
                <div class="form-group" id="no_dues_cert" style="display: none;">
                  <label for="no_dues_cert_file_name1">No dues Certificates of Press Council of India for the last financial year registration/
                    पिछले वित्तीय वर्ष के पंजीकरण के लिए भारतीय प्रेस परिषद का कोई बकाया नहीं प्रमाण पत्र<font color="red">*</font></label>
                  <div class="input-group">
                    @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['No Dues Certificate'] == '1') )
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="no_dues_cert_file_name_modify" id="no_dues_cert_file_name_modify" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="no_dues_cert_file_name_modify" id="no_dues_cert_file_name_modify2">{{ @$vendordatas['No Dues Cert File Name'] ? $vendordatas['No Dues Cert File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="no_dues_cert_file_name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="no_dues_cert_file_name" id="no_dues_cert_file_name" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="no_dues_cert_file_name" id="no_dues_cert_file_name2">{{ @$vendordatas['No Dues Cert File Name'] ? $vendordatas['No Dues Cert File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="no_dues_cert_file_name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendordatas['No Dues Certificate'] === '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['No Dues Cert File Name']}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <span id="no_dues_cert_file_name1" class="error invalid-feedback"></span>
                  <span id="no_dues_cert_file_name_modify1" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group" id="abc_rni_cert" style="display: none;">
                  <label for="circulation_cert_file_name1">Circulation Certificate as per policy (self-attested) (If more than 25,000 than RNI/ABC is mandatory)/ पॉलिसी के अनुसार सर्कुलेशन सर्टिफिकेट (स्व-सत्यापित) (यदि आरएनआई/एबीसी से 25,000 से अधिक अनिवार्य है)<font color="red">*</font></label>
                  <div class="input-group">
                    @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['Circulation Certificate'] == '1'))
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="circulation_cert_file_name_modify" id="circulation_cert_file_name_modify" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="circulation_cert_file_name_modify" id="circulation_cert_file_name_modify2">{{ @$vendordatas['Circulation Cert File Name'] ? $vendordatas['Circulation Cert File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="circulation_cert_file_name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="circulation_cert_file_name" id="circulation_cert_file_name" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="circulation_cert_file_name" id="circulation_cert_file_name2">{{ @$vendordatas['Circulation Cert File Name'] ? $vendordatas['Circulation Cert File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="circulation_cert_file_name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendordatas['Circulation Certificate'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Circulation Cert File Name']}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <span id="circulation_cert_file_name1" class="error invalid-feedback"></span>
                  <span id="circulation_cert_file_name_modify1" class="error invalid-feedback"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group" id="rni_cert" style="display: none;">
                  <label for="rni_reg_file_name1">RNI (self-attested) Registration Certificate (Upload only PDF) max size 2MB / आरएनआई (स्व-सत्यापित) पंजीकरण प्रमाणपत्र (केवल पीडीएफ अपलोड करें) अधिकतम आकार 2MB<font color="red">*</font></label>
                  <div class="input-group">
                    @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['RNI Registration Certificate'] == '1') )
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="rni_reg_file_name_modify" id="rni_reg_file_name_modify" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="rni_reg_file_name_modify" id="rni_reg_file_name_modify2">{{ @$vendordatas['RNI Reg File Name'] ? $vendordatas['RNI Reg File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="rni_reg_file_name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="rni_reg_file_name" id="rni_reg_file_name" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="rni_reg_file_name" id="rni_reg_file_name2">{{ @$vendordatas['RNI Reg File Name'] ? $vendordatas['RNI Reg File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="rni_reg_file_name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendordatas['RNI Registration Certificate'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['RNI Reg File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <span id="rni_reg_file_name1" class="error invalid-feedback"></span>
                  <span id="rni_reg_file_name_modify1" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group" id="form2_rni_cert" style="display: none;">
                  <label for="annual_return_file_name1">Copy of Annual Return Form-2 submitted to RNI along with receiving proof / प्रमाण प्राप्त करने के साथ आरएनआई को जमा किए गए वार्षिक रिटर्न फॉर्म -2 की प्रति<font color="red">*</font></label>
                  <br>
                  <div class="input-group">
                    @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['Annual Return Submitted to RNI'] == '1') )
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="annual_return_file_name_modify" id="annual_return_file_name_modify" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="annual_return_file_name_modify" id="annual_return_file_name_modify2">{{ @$vendordatas['Annual Return File Name'] ? $vendordatas['Annual Return File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="annual_return_file_name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="annual_return_file_name" id="annual_return_file_name" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="annual_return_file_name" id="annual_return_file_name2">{{ @$vendordatas['Annual Return File Name'] ? $vendordatas['Annual Return File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="annual_return_file_name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendordatas['Annual Return Submitted to RNI'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Annual Return File Name']}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <span id="annual_return_file_name1" class="error invalid-feedback"></span>
                  <span id="annual_return_file_name_modify1" class="error invalid-feedback"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6"><br>
                <div class="form-group" id="gst_reg_file">
                  <label for="gst_reg_cert_file_name1" style="width: 100%"> GST registration Certificate / जीएसटी पंजीकरण प्रमाणपत्र<font color="red">*</font></label>

                  <div class="input-group">
                    @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['GST Registration Certificate'] == '1') )
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="gst_reg_cert_file_name_modify" id="gst_reg_cert_file_name_modify" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="gst_reg_cert_file_name_modify" id="gst_reg_cert_file_name_modify2">{{ @$vendordatas['GST Reg Cert File Name'] ? $vendordatas['GST Reg Cert File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="gst_reg_cert_file_name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="gst_reg_cert_file_name" id="gst_reg_cert_file_name" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="gst_reg_cert_file_name" id="gst_reg_cert_file_name2">{{ @$vendordatas['GST Reg Cert File Name'] ? $vendordatas['GST Reg Cert File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="gst_reg_cert_file_name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendordatas['GST Registration Certificate'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['GST Reg Cert File Name']}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <span id="gst_reg_cert_file_name1" class="error invalid-feedback"></span>
                  <span id="gst_reg_cert_file_name_modify1" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
                @php
                $show_data = 'hide-msg';
                if(@$vendordatas['Change In Company Address'] == 1){
                $show_data = '';
                }
                @endphp
                <div class="form-group {{ $show_data }}" id="change_info_doc">
                  <label for="change_in_address_file_name1">Change of information for existing company / मौजूदा कंपनी के लिए सूचना का परिवर्तन<font color="red">*</font></label>
                  <div class="input-group">
                    @if( (@$vendordatas['Modification'] == 1) && (@$vendordatas['Change in address uploaded'] == '1') )
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="change_in_address_file_name_modify" id="change_in_address_file_name_modify" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="change_in_address_file_name_modify" id="change_in_address_file_name_modify2">{{ @$vendordatas['Change in address File Name'] ? $vendordatas['Change in address File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="change_in_address_file_name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="change_in_address_file_name" id="change_in_address_file_name" {{$disabledall}} accept="application/pdf">
                      <label class="custom-file-label" for="change_in_address_file_name" id="change_in_address_file_name2">{{ @$vendordatas['Change in address File Name'] ? $vendordatas['Change in address File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="change_in_address_file_name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendordatas['Change in address uploaded'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendordatas['Change in address File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <span id="change_in_address_file_name1" class="error invalid-feedback"></span>
                  <span id="change_in_address_file_name_modify1" class="error invalid-feedback"></span>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <div class="icheck-success d-inline">
                  <input type="checkbox" name="self_declaration" {{$disabledall}} id="self_declaration" <?= (@$vendordatas['Self Declaration'] == 1 ? "checked" : ""); ?>>
                  <label for="self_declaration">Self declaration / स्वयं घोषित</label>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <div class="icheck-success d-inline">
                  <input type="checkbox" name="advertisement_policy" {{$disabledall}} id="advertisement_policy" {{ @$checked }}>
                  <label for="advertisement_policy">I have declared that I have read all <a href="http://davp.nic.in/writereaddata/Final_Print_Media_Advt_Policy_Revision_dated_23072020.pdf" target="_blank">Print Media Advertisement Policy of the Government of India - 2020.</a>
                    <font color="red">*</font>
                  </label>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-12">
              <div class="form-group">
                <div class="icheck-success d-inline">
                  <label for="emp-fee"> Empanel Fee / पैनल शुल्क </label>
                  <a class="btn btn-primary" style="padding: 2px;">To Be Discussed</a>
                </div>
              </div>
            </div> -->
            <input type="hidden" name="doc[]" id="doc_data">
            <input type="hidden" name="vendorid_tab_4" id="vendorid_tab_4" value="{{$vendordatas['Newspaper Code'] ?? ''}}" {{$disabledall}}>
            <input type="hidden" name="submit_btn" id="submit_btn" value="0" {{$disabledall}}>
            <a class="btn btn-primary reg-previous-button previousClass" data="12">Previous</a>
            <a id="sub_btn" class="btn btn-primary next-button" {{$disabledall}}>Submit</a>
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
  /* writen by priyanshi */
  $('#agenciesDiv').hide();
  var news_agencies_subscribed = $('#news_agencies_subscribed option:selected').val();

  if (news_agencies_subscribed == "0") {
    $('#agenciesDiv').hide();
  } else if (news_agencies_subscribed == "1") {
    $('#agenciesDiv').show();
  }
  $('#news_agencies_subscribed').change(function() {
    var news_agencies_subscribed = $('#news_agencies_subscribed option:selected').val();
    if (news_agencies_subscribed == "") {
      $('#agenciesDiv').hide();
    } else if (news_agencies_subscribed == "0") {
      $('#agenciesDiv').hide();
    } else if (news_agencies_subscribed == "1") {
      $('#agenciesDiv').show();
    }
  })
  //agencies show hide

  /* end priyanshi code */

  $(document).ready(function() {
    $("#printing_colour").change(function() {
      if ($(this).val() == 0 && $(this).val() != '') {
        $("#colour_page").show();
      } else {
        $("#colour_page").hide();
      }
    });
  });
  // get district based on state by ajax call 
  $(document).ready(function() {
    $(".call_district").change(function() {
      // if ($(this).val() != '') {
      var id = $(this).attr("data");
      $("#" + id).empty();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'POST',
        url: "{{Route('getdistrict')}}",
        data: {
          state_id: $(this).val()
        },
        success: function(response) {
          //console.log(response);
          $("#" + id).html(response.message);
        }
      });
      //  }
    });
  });
  // exist owner get details
  $(document).ready(function() {
    //$("#state_val").prop("disabled", true);
    //$("#district_val").prop("disabled", true);
    $("#add_davp").hide();
    // $("#edition1").prop("disabled", true);
    $("#add_davp").empty();
    $("#exist_owner_id").on('keyup', function() {
      if ($(this).val() != '') {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          type: 'POST',
          url: "{{Route('existownerdata')}}",
          data: {
            owner_id: $(this).val()
          },
          success: function(response) {
            //console.log(response);
            if (response.status == 0) {
              $("#name").val(response.message['owner_datas']['Owner Name']);
              $("#email").val(response.message['owner_datas']['Email ID']);
              $("#mobile").val(response.message['owner_datas']['Mobile No_']);
              $("#address").val(response.message['owner_datas']['Address 1']);
              $("#city").val(response.message['owner_datas']['City']);
              $("#phone").val(response.message['owner_datas']['Phone No_']);
              $("#fax").val(response.message['owner_datas']['Fax No_']);
              $("#name").prop("readonly", true);
              $("#email").prop("readonly", true);
              $("#mobile").prop("readonly", true);
              $("#address").prop("readonly", true);
              $("#city").prop("readonly", true);
              $("#phone").prop("readonly", true);
              $("#fax").prop("readonly", true);
              var option_state = "<option value='" + response.message['owner_datas']['Code'] + "'> " + response.message['owner_datas']['Code'] + " ~ " + response.message['owner_datas']['Description'] + "</option>";
              $("#state").html(option_state);
              $("#state_val").val(response.message['owner_datas']['Code']);
              $("#state").prop("disabled", true);
              var option_district = "<option value='" + response.message['owner_datas']['District'] + "'>" + response.message['owner_datas']['District'] + "</option>";

              var owner_type_arr = ['Individual', 'Partnership', 'Trust', 'Society', 'Proprietorship'];
              var owner_type = [];
              $.each(owner_type_arr, function(index, item) {
                owner_type.push("<option value='" + index + "' " + (index == response.message['owner_datas']['Owner Type'] ? 'selected' : '') + ">" + item + "</option>");
              });

              $("#owner_type").html(owner_type);
              $("#district").html(option_district);
              $("#district_val").val(response.message['owner_datas']['District']);
              $("#owner_type").prop("disabled", true);
              $("#district").prop("disabled", true);
              $("#alert_exist_owner_id").hide();
              $("#edition2").prop('checked', false);
              // $("#edition2").prop("disabled", true);
              $("#edition1").prop('checked', true);
              // $("#edition1").prop("disabled", false);
              $("#davp_panel").prop('checked', true);
              //$("#davp_panel").hide();
              $("#add_davp").show();
              $("#add_davp").empty();
              //console.log(response.message['owner_other_datas']);
              $.each(response.message['owner_other_datas'], function(index, item) {
                var periocity_val = item['Periodicity'];
                var dis = item['Distance from office to press'];
                $("#add_davp").append('<div class="row"><div class="col-md-12"><h4 class="subheading">Details of other publications of same owner or Publisher-----/एक ही मालिक या प्रकाशक के अन्य प्रकाशनों का विवरण ----</h4></div><div class="col-md-4"><div class="form-group"><label for="title">Title / शीषक</label><input type="text" name="title" placeholder="Enter Title" maxlength="40" class="form-control form-control-sm" id="title" value="' + item['Newspaper Name'] + '" readonly></div></div><div class="col-md-4"><div class="form-group"><label>Language / भाषा</label><select name="lang" class="form-control form-control-sm" style="width: 100%;" disabled><option value="' + item['Code'] + '">' + item['Code'] + '~' + item['Name'] + '</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="publication">Place of Publication / प्रकाशन का स्थान</label><input maxlength="30" type="text" placeholder="Enter Place of Publication" name="place_of_publication_davp" class="form-control form-control-sm" id="publication" value="' + item['Place of Publication'] + '" readonly></div></div><div class="col-md-4"><br><div class="form-group"><label>Periodicity / अवधि</label><select name="periodicity_davp" class="form-control form-control-sm" style="width: 100%;" disabled><option value="0" ' + (periocity_val == 0 ? 'selected' : '') + '>Daily(M)</option><option value="1" ' + (periocity_val == 1 ? 'selected' : '') + '>Daily(E)</option><option value="2" ' + (periocity_val == 2 ? 'selected' : '') + '>Daily Except Sunday</option><option value="3" ' + (periocity_val == 3 ? 'selected' : '') + '>Bi-Weekly</option><option value="4" ' + (periocity_val == 4 ? 'selected' : '') + '>Weekly</option><option value="5" ' + (periocity_val == 5 ? 'selected' : '') + '>Fortnightly</option><option value="6" ' + (periocity_val == 6 ? 'selected' : '') + '>Monthly</option></select></div></div><div class="col-md-4"><br><div class="form-group"><label for="davp">Owner/Group ID / मालिक/समूह कोड</label><input type="text" name="davp" placeholder="Enter Owner/Group ID" maxlength="8" class="form-control form-control-sm" id="davp" value="' + item['Newspaper Code'] + '" readonly></div></div><div class="col-md-4"><div class="form-group"><label for="edition_distance">Distance from this Edition(In Km) / इस संस्करण से दूरी (किमी. में)</label><input type="text" maxlength="15" Place of placeholder="Enter Distance" name="distance_from_edition" value="' + Math.round(dis) + '" readonly class="form-control form-control-sm" id="edition_distance" onkeypress="return onlyNumberKey(event)"></div></div></div><br>');
              });
              $("#state_val").prop("disabled", false);
              $("#district_val").prop("disabled", false);
            } else {
              $("#name").val('');
              $("#owner_type").html("<option value=''>No Data Found!</option>");
              $("#email").val('');
              $("#mobile").val('');
              $("#address").val('');
              $("#city").val('');
              $("#phone").val('');
              $("#fax").val('');
              $("#state").html("<option value=''>No Data Found!</option>");
              $("#district").html("<option value=''>No Data Found!</option>");
              $("#owner_type").prop("disabled", false);
              $("#district").prop("disabled", false);
              $("#state").prop("disabled", false);
              $("#state_val").prop("disabled", true);
              $("#district_val").prop("disabled", true);
              $("#name").prop("readonly", false);
              $("#email").prop("readonly", false);
              $("#mobile").prop("readonly", false);
              $("#address").prop("readonly", false);
              $("#city").prop("readonly", false);
              $("#phone").prop("readonly", false);
              $("#fax").prop("readonly", false);
              $("#alert_exist_owner_id").text(response.message).show();
              $("#add_davp").hide();
              //$("#davp_panel").hide()
            }
          }
        });
      }
    });
  });

  // Check Unique Data 
  function checkUniqueVendor(id, val) {
    if (val != '') {
      var email = val;
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'GET',
        url: 'checkuniquevendor/' + email,
        data: {},
        success: function(response) {
          if (response.status == 0 && val != $("#vendor_" + id).val()) {
            // console.log("#vendor_"+id);
            $("#v_alert_" + id).html(titleCase(id) + ' ' + response.message);
            $("#v_alert_" + id).show();
            $("#v_" + id).val('');
          } else {
            $("#v_alert_" + id).hide();
          }
        }
      });
    }
  }

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
            $("#name").prop("readonly", false);
            $("#owner_type").prop("readonly", false);
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
            // owner not exit clean data
            if ($("#owner_input_clean").val() == 0) {
              $("#state").val('');
              $("#district").val('');
              $("#name").val('');
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
                  $("#name").val(response.message['Owner Name']);
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
                  $("#exist_owner_id").val(response.message['Owner ID']);
                  $("#ownermobilecheck").val(response.message['Mobile No_']);
                  // $("#davp_panel").hide();
                  $("#add_davp").show();
                  $("#add_davp").empty();
                  //console.log(response.vendordatas);
                  var owner_type_arr = ['Individual', 'Partnership', 'Trust', 'Society', 'Proprietorship'];
                  var owner_type = [];
                  $.each(owner_type_arr, function(index, item) {
                    owner_type.push("<option value='" + index + "' " + (index == response.message['Owner Type'] ? 'selected' : '') + ">" + item + "</option>");
                  });

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
                  $("#name").prop("readonly", true);
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

  function titleCase(string) {
    return string[0].toUpperCase() + string.slice(1).toLowerCase();
  }
  $(document).ready(function() {
    $(window).keydown(function(event) {
      if (event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
  });
  $(document).ready(function() {
    $("#name").change(function() {
      $("#owner_input_clean").val(1);
    });
  });

  //  next and previous function for save 
  function nextSaveData(id) {
    console.log(id);
    if ($("#Modification").val() == 1 || $("#Modification").val() == '') {
      console.log($("#" + id).val());
      if ($("#" + id).val() == 0) {
        $("#" + id).val(1);
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

  $(document).ready(function() {
    $(".previousClass").click(function() {
      var activity_id = $(this).attr("data");
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: "post",
        url: "{{Route('fresh-empanelment-previous')}}",
        data: {
          activity_id: activity_id
        },
        // dataType: "json",
        success: function(data) {
          console.log(data);
          if (data['success'] == true) {
            console.log("success");
          }
        },
        error: function(error) {
          console.log('error');
        }
      });
    });
  });
</script>

<script>
  // start cir based validation
  $(document).ready(function() {
    $("#cir_base").change(function() {
      $("#rni_reg_no_verified").val(0);
      $("#claimed_circulation_verified").val(0);
      $("#rni_annual_valid").val(0);
      $("#rni_claimed_cirl").hide();
      $("#rni_efill_no").hide();
      $("#abc_cert_no").hide();
      $("#abc-certificate").hide();
      if ($(this).val() == 0) {
        $("#rni-efilling").show();
        $("#rni_reg_no").hide();
        $("#rni_registration_no").val('');
        $("#rni_efiling_no").val('');
        $("#claimed_circulation").val('');
        $("#rni_efiling_no").prop("readonly", false);
        $("#claimed_circulation").prop("readonly", false);
        $("#rni_cert").show();
        $("#form2_rni_cert").show();
        $("#abc-certificate").hide();
      } else if ($(this).val() == 3){
        $("#rni-efilling").hide();
        $("#rni_reg_no").hide();
        $("#rni_registration_no").val('');
        $("#rni_efiling_no").val('');
        $("#claimed_circulation").val('');
        $("#rni_efiling_no").prop("readonly", false);
        $("#claimed_circulation").prop("readonly", false);
        $("#newspaper_name").val('');
        $("#rni_cert").hide();
        $("#form2_rni_cert").hide();
        $("#abc-certificate").show();
      }else{
        $("#rni-efilling").hide();
        $("#rni_reg_no").hide();
        $("#rni_registration_no").val('');
        $("#rni_efiling_no").val('');
        $("#claimed_circulation").val('');
        $("#rni_efiling_no").prop("readonly", false);
        $("#claimed_circulation").prop("readonly", false);
        $("#newspaper_name").val('');
        $("#rni_cert").hide();
        $("#form2_rni_cert").hide();
      }
    });
  });

  function checkRegCIRBase(val) {
    var cir_no = $("#cir_base").val();
    if (val != '' && cir_no !='') {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: "get",
        url: "{{Route('check-regno-cir-base')}}",
        data: {
          cir_no: cir_no,
          reg_no: val
        },
        success: function(data) {
          if (data.status == true) {
            $("#rni_reg_no").text(data.message).show().css("color", "green");

            if (cir_no == 0) {
              $("#rni_efiling_no").val(data.data['Efile Number']);
              $("#rni_efiling_no").prop("readonly", true);
              $("#rni_efill_no").text(data.message).show().css("color", "green");
              if (($.trim(data.data['Efiling Number Valid']) == 'Yes') && ($.trim(data.data['Efiling Veryfied']) == 'Yes')) {
                $("#rni_annual_valid").val(1);
              }
              $("#newspaper_name").val(data.data['Publication Name']);
            }
            $("#claimed_circulation").val(data.data['Sold Circulation']);
            $("#claimed_circulation_hidden").val(data.data['Sold Circulation']);
            $("#rni_reg_no_verified").val(1);
            $("#claimed_circulation_verified").val(1);
            if (parseInt(data.data['Sold Circulation']) > 25000) {
              $("#rni_claimed_cirl").text('PCI no dues certificate is mandatory at tab 4').show().css("color", "#f8b739");
              $("#no_dues_cert").show();
              $("#abc_rni_cert").show();

            } else {
              $("#rni_claimed_cirl").text(data.message).show().css("color", "green");
              $("#no_dues_cert").hide();
              $("#abc_rni_cert").hide();
            }
            console.log("success");
          } else {
            $("#rni_reg_no").text(data.message).show().css("color", "#f8b739");
            $("#rni_claimed_cirl").hide();
            $("#rni_efill_no").hide();
            if (cir_no == 0) {
              $("#rni_efiling_no").val('');
            }
            $("#claimed_circulation").val('');
            $("#rni_efiling_no").prop("readonly", false);
            $("#rni_reg_no_verified").val(0);
            $("#claimed_circulation_verified").val(0);
            $("#rni_annual_valid").val(0);
            $("#newspaper_name").val('');
          }
        },
        error: function(error) {
          console.log('error');
        }
      });
    }
  }

  function checkCirculation(val) {
    if (val != '') {
      if (parseInt(val) == parseInt($("#claimed_circulation_hidden").val()) && parseInt(val) < 25000) {
        $("#rni_claimed_cirl").text("Veryfied").show().css("color", "green");
        $("#claimed_circulation_verified").val(1);
      } else {
        var msg = '';
        if (parseInt(val) > 25000) {
          msg = 'PCI no dues certificate is mandatory at tab 4';
          $("#no_dues_cert").show();
          $("#abc_rni_cert").show();
        } else {
          msg = 'Not verified';
          $("#no_dues_cert").hide();
          $("#abc_rni_cert").hide();
        }
        $("#rni_claimed_cirl").text(msg).show().css("color", "#f8b739");
        $("#claimed_circulation_verified").val(0);
      }
    }
  }
  // end cir based validation
</script>
<script>
  //start code of display owner press data 
  $(document).ready(function() {
    $(".owner_press").on('click', function() {
      var owner_id = $("#ownerid").val();
      if (owner_id != '' && $(this).val() == 1) {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          type: "post",
          url: "{{Route('get-press-owner-data')}}",
          data: {
            owner_id: owner_id
          },
          success: function(data) {
            // console.log(data);
            if (data['status'] == true) {
              console.log("success");
              $("#name_of_press").val(data.data['Name of Press']).prop("readonly", true);
              $("#press_email").val(data.data['Press Email']).prop("readonly", true);
              $("#press_mobile").val(data.data['Press Mobile']).prop("readonly", true);
              $("#press_phone").val(data.data['Press Phone']).prop("readonly", true);
              $("#address_of_press").val(data.data['Address of Press']).prop("readonly", true);
              $("#distance_press").val(Math.round(data.data['Distance from office to press'])).prop("readonly", true);
            } else {
              $("#name_of_press").val('').prop("readonly", false);
              $("#press_email").val('').prop("readonly", false);
              $("#press_mobile").val('').prop("readonly", false);
              $("#press_phone").val('').prop("readonly", false);
              $("#address_of_press").val('').prop("readonly", false);
              $("#distance_press").val('').prop("readonly", false);
            }
          },
          error: function(error) {
            console.log('error');
          }
        });
      } else {
        $("#name_of_press").prop("readonly", false);
        $("#press_email").prop("readonly", false);
        $("#press_mobile").prop("readonly", false);
        $("#press_phone").prop("readonly", false);
        $("#address_of_press").prop("readonly", false);
        $("#distance_press").prop("readonly", false);
      }
    });
  });
  //end code of display owner press data 

  // start check annual turn over of newspaper and show and hide file of GST at tab 4 
  $(document).ready(function() {
    $("#gst_reg_file").hide();
    $("#total_annual").on('keyup', function() {
      if (parseInt($(this).val()) > 4000000) {
        $("#alert_total_annual_turn").text("GST Registration and certificate is mandatory at tab 4").show();
        $("#gst_reg_file").show();
      } else {
        $("#alert_total_annual_turn").hide();
        $("#gst_reg_file").hide();
      }
    });
  });
  // end check annual turn over of newspaper and show and hide file of GST at tab 4

  // start check window load claim circulation and annual tornover based show and hide file of GST and No dues PCI at tab 4
  $(document).ready(function() {

    if (parseInt($("#claimed_circulation").val()) > 25000) {
      //  $("#rni_claimed_cirl").text('PCI no dues certificate is mandatory at tab 4').show().css("color", "#f8b739");
      $("#no_dues_cert").show();
      $("#abc_rni_cert").show();
    } else {
      $("#no_dues_cert").hide();
      $("#abc_rni_cert").hide();
    }
    if (parseInt($("#total_annual").val()) > 4000000) {
      // $("#alert_total_annual_turn").text("GST Registration and certificate is mandatory at tab 4").show();
      $("#gst_reg_file").show();
    } else {
      // $("#alert_total_annual_turn").hide();
      $("#gst_reg_file").hide();
    }
    if ($("#cir_base").val() == 0) {
      $("#rni_cert").show();
      $("#form2_rni_cert").show();
    } else {
      $("#rni_cert").hide();
      $("#form2_rni_cert").hide();
    }
  });
  //end check window load claim circulation and annual tornover based show and hide file of GST and No dues PCI at tab 4
</script>


<script>
  $(document).ready(function() {

    //color pages less than or equal to pages 
    $("#colour_pages").keyup(function() {
      var pages = $("#no_of_page").val();
      if (parseInt($(this).val()) > parseInt(pages)) {
        $("#alert_colour_pages").text('Color pages value should be less than or equal to no. of pages').show();
      } else {
        $("#alert_colour_pages").hide();
      }
    });

    //Black & White less than or equal to pages
    $("#black_white").keyup(function() {
      var pages = $("#no_of_page").val();
      if (parseInt($(this).val()) > parseInt(pages)) {
        $("#alert_black_white").text('Black & White value should be less than or equal to no. of pages').show();
      } else {
        $("#alert_black_white").hide();
      }
    });

    // pages
    $("#no_of_page").on('keyup', function() {
      var color = $("#colour_pages").val();
      var bwc = $("#black_white").val();
      if (parseInt(color) > parseInt($(this).val())) {
        // $("#colour_pages").val('');
        $("#alert_colour_pages").text('Color pages value should be less than or equal to no. of pages').show();
      } else {
        $("#alert_colour_pages").hide();
      }
      if (parseInt(bwc) > parseInt($(this).val())) {
        //  $("#black_white").val('');
        $("#alert_black_white").text('Black & White value should be less than or equal to no. of pages').show();
      } else {
        $("#alert_black_white").hide();
      }
    });
  });
</script>

<script>
  function checkGstUnique(val) {
    if (val != '') {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: "get",
        url: "check-gstno",
        data: {
          gst_no: val
        },
        success: function(data) {
          if (data['status'] == true) {
            if ($('.gstvalidationMsg').hasClass('alert-info-msg') == true) {
              $('.gstvalidationMsg').addClass('alert-info-msg2');
              $('.gstvalidationMsg').text(data['message']);
              $('.validcheck').html("");
            }
          }
        },
        error: function(error) {
          console.log('error');
        }
      });
    }
  }
</script>
@endsection