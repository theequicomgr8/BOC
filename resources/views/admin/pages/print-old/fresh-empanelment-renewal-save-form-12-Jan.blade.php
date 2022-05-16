@extends('admin.layouts.layout')
@section('custom_css')
<link href="{{ asset('css/comman-css.css')}}" rel="stylesheet" />
@endsection
@section('content')
<!-- /.end card-header -->
<!-- renewal data owner_datas and vendor_datas -->
@php
$renewal_readonly = '';
$renewal_disabled = '';
$policy_check = '';
$start_date = date('Y-m-d', strtotime(@$np_rate_renewal[0]->{'Contract Start Date'}));
$end_date = date('Y-m-d', strtotime(@$np_rate_renewal[0]->{'Contract End Date'}));

if((date("Y-m-d") >= $start_date) && (date("Y-m-d") <= $end_date)){ $renewal_readonly='readonly' ; $policy_check='checked' ; $renewal_disabled = 'disabled'; } $company_change_add=@$vendor_datas->{'Change In Company Address'};

  $readonly = 'readonly';
  $disabled = 'disabled';

  $reg_no = '';
  $solid_circulation = '';
  $efiling = 'none';
  $reg_no_veryfied = '';
  $solid_circulation_veryfied = '';
  $turnover_veryfied = '';
  $date_veryfied = '';
  $rni_regist_no = 'none';
  $abc_cert = 'none';
  $abc_reg_no_verified = '';
  if((@$vendor_datas->{'CIR Base'} == 0 && @$vendor_datas->{'CIR Base'} != '') || (@$np_rate_renewal[0]->{'RNI Circulation'} == 1 && @$np_rate_renewal !='')){
  $reg_no = $vendor_datas->{'RNI Registration No_'} ?? '';
  $solid_circulation = $np_rate_renewal[0]->{'circulation'} ?? $vendor_datas->{'Claimed Circulation'} ?? '';
  $efiling = 'block';
  $rni_regist_no = 'block';
  $abc_cert = 'none';

  $reg_no_veryfied = $vendor_datas->{'RNI Registration Validation'} ?? '';
  $solid_circulation_veryfied = $vendor_datas->{'RNI Circulation Validation'} ?? '';
  $turnover_veryfied = $vendor_datas->{'RNI Annual Validation'} ?? '';
  $date_veryfied = $vendor_datas->{'RNI Validation Date'} ?? '';
  }

  if((@$vendor_datas->{'CIR Base'} == 3 && @$vendor_datas->{'CIR Base'} != '') || (@$np_rate_renewal[0]->{'ABC Circulation'} == 1 && @$np_rate_renewal !='')){
  $solid_circulation = $np_rate_renewal[0]->{'circulation'} ?? $vendor_datas->{'ABC Circulation Number'} ?? '';
  $efiling = 'none';
  $rni_regist_no = 'none';
  $abc_cert = 'block';

  $abc_reg_no_verified = $vendor_datas->{'ABC Registration Validation'} ?? '';
  $solid_circulation_veryfied = $vendor_datas->{'ABC Circulation Validation'} ?? '';
  $turnover_veryfied = $vendor_datas->{'ABC Annual Validation'} ?? '';
  $date_veryfied = $vendor_datas->{'ABC Validation Date'} ?? '';
  }

  @endphp

  <div class="content-inside p-3">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-normal text-primary">Application Form for Fresh Empanelment Renewal</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div style="display: none;" align="center" class="alert alert-success"></div>
        <div style="display: none;" align="center" class="alert alert-danger"></div>

        <form method="POST" enctype="multipart/form-data" autocomplete="off" id="print_fress_emp_renewal">
          {{ csrf_field() }}

          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active show" id="#tab1">Basic Information</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="#tab2">Print Information</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="#tab3">Account Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="#tab4">Upload Document</a>
            </li>
          </ul>

          <div class="tab-content">
            <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="owner_name">Owner Name / मालिक का नाम</label>
                    <input type="text" class="form-control form-control-sm" id="name" name="owner_name" placeholder="Enter Owner Name" onkeypress="return onlyAlphabets(event,this)" maxlength="40" value="{{ @$owner_datas[0]->{'Owner Name'} ??'' }}" {{ $readonly }}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Owner Type / मालिक का प्रकार<font color="red">*</font></label>
                    <select name="owner_type" id="owner_type" class="form-control  form-control-sm" style="width: 100%;" {{$disabled}}>
                      <option value="">Select Owner Type</option>
                      <option value="0" <?= (@$owner_datas[0]->{'Owner Type'} == 0 && @$owner_datas[0]->{'Owner Type'} != "") ? 'selected' : '' ?>>Individual</option>
                      <option value="1" <?= (@$owner_datas[0]->{'Owner Type'} == 1) ? 'selected' : '' ?>>Partnership</option>
                      <option value="2" <?= (@$owner_datas[0]->{'Owner Type'} == 2) ? 'selected' : '' ?>>Trust</option>
                      <option value="3" <?= (@$owner_datas[0]->{'Owner Type'} == 3) ? 'selected' : '' ?>>Society</option>
                      <option value="4" <?= (@$owner_datas[0]->{'Owner Type'} == 4) ? 'selected' : '' ?>>Proprietorship</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="email">E-mail ID(Owner) / ई मेल आईडी<font color="red">*</font></label>
                    <input type="email" class="form-control form-control-sm" id="email" name="email" maxlength="50" placeholder="Enter Email ID" value="{{ @$owner_datas[0]->{'Email ID'} ?? '' }}" {{ $readonly }}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="mobile">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                    <input type="text" class="form-control form-control-sm" id="mobile" name="mobile" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{ @$owner_datas[0]->{'Mobile No_'} ?? '' }}" {{ @$readonly }}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="address">Address / पता<font color="red">*</font></label>
                    <textarea name="address" id="address" placeholder="Enter Address" cols="50" maxlength="220" class="form-control form-control-sm" {{ @$readonly }}>{{ @$owner_datas[0]->{'Address 1'} ?? '' }}</textarea>
                  </div>
                </div>
                <div class="col-md-4" id="state_div">
                  <div class="form-group">
                    <label for="state">State / राज्य<font color="red">*</font></label>

                    <select id="state" name="state" class="form-control form-control-sm call_district" data="district" style="width: 100%;" {{ @$disabled }}>
                      <option value="" {{@$owner_datas[0]->{'State'} == ""  ? 'selected' : ''}}>Select State</option>
                      @foreach($states as $state)
                      <option value="{{$state['Code']}}" {{ (@$owner_datas[0]->{'State'} === $state['Code'])  ? 'selected' : '' }}>{{$state['Code']}} ~ {{$state['Description']}}</option>
                      @endforeach
                    </select>
                    <input type="hidden" id="state_val" name="state" value="{{@$owner_datas[0]->{'State'} ?? '' }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="district">District / ज़िला<font color="red">*</font></label>
                    <select id="district" name="district" class="form-control form-control-sm" {{ @$disabled }}>
                      @if(@$owner_datas[0]->{'District'} != '')
                      @foreach($districts as $district)
                      <option value="{{$district['District']}}" {{ (@$owner_datas[0]->{'District'} === $district['District']  ?  'selected' : '') }}>{{ $district['District'] }}</option>
                      @endforeach
                      @endif
                    </select>
                    <input type="hidden" id="district_val" name="district" value="{{ @$owner_datas[0]->{'District'} ?? ''}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="city">City / नगर<font color="red">*</font></label>
                    <input type="text" id="city" name="city" maxlength="30" onkeypress="return onlyAlphabets(event,this)" class="form-control form-control-sm" placeholder="Enter City" value="{{ @$owner_datas[0]->{'City'} ?? '' }}" {{ @$readonly }}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="phone">Phone No. / फोन नंबर</label>
                    <input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="Enter Phone Number" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{ @$owner_datas[0]->{'Phone No_'} ?? '' }}" {{ @$readonly }}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="fax_no">Fax / फैक्स </label>
                    <input type="text" class="form-control form-control-sm" id="fax" name="fax_no" placeholder="Enter Fax" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{ @$owner_datas[0]->{'Fax No_'} ?? '' }}" {{ @$readonly }}>
                  </div>
                </div>
              </div>
              <input type="hidden" name="next_tab_1" id="next_tab_1" value="0">
              <a class="btn btn-primary next-button" id="tab_1">Next</a>
            </div>
            <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab2-trigger">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="GST_No">GST No. / जीएसटी संख्या<font color="red">*</font></label>
                    <input type="text" class="form-control form-control-sm" name="GST_No" id="GST_No" placeholder="Enter GST No." maxlength="15" value="{{ @$vendor_datas->{'GST No_'} ?? ''}}" {{$readonly}}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Circulation Base / सी आई आर बेस<font color="red">*</font></label>
                    <select name="cir_base" id="cir_base" class="form-control  form-control-sm" style="width: 100%;" {{ @$disabled }}>
                      <option value="0" {{ (@$vendor_datas->{'CIR Base'} == 0 && @$vendor_datas->{'CIR Base'} != "")  ? 'selected' : ''}}>RNI</option>
                      <option value="1" {{ @$vendor_datas->{'CIR Base'} == 1  ? 'selected' : '' }}>CA</option>
                      <option value="2" {{ @$vendor_datas->{'CIR Base'} == 2  ? 'selected' : '' }}>PIB</option>
                      <option value="3" {{ @$vendor_datas->{'CIR Base'} == 3  ? 'selected' : '' }}>ABC</option>
                    </select>
                    <input type="hidden" name="cir_base" id="cir_base_old" value="{{ @$vendor_datas->{'CIR Base'} ?? '' }}">
                  </div>
                </div>
                <div class="col-md-4" id="rni_regist_no" style="display: {{$rni_regist_no}};">
                  <div class="form-group">
                    <label for="rni_registration_no">RNI Registration No. / पंजीकरण संख्या <font color="red">*</font></label>
                    <input type="text" name="rni_registration_no" maxlength="25" placeholder="Enter RNI Registration No." class="form-control  form-control-sm" onkeyup="return checkRegCIRBase(this.value)" id="rni_registration_no" value="{{ $reg_no }}" {{ @$readonly }}>
                    <input type="hidden" name="rni_reg_no_veryfied" id="rni_reg_no_veryfied" value="{{ $reg_no_veryfied }}">
                  </div>
                </div>
                <div class="col-md-4" id="abc-certificate" style="display: {{$abc_cert}};">
                  <div class="form-group">
                    <label for="abc_certificate_no">ABC Certificate No. / एबीसी प्रमाणपत्र संख्या<font color="red">*</font></label>
                    <input type="text" name="abc_certificate_no" maxlength="15" placeholder="Enter ABC Certificate No." class="form-control form-control-sm" onchange="return checkRegCIRBase(this.value)" id="abc_certificate_no" value="{{ $vendor_datas->{'ABC Number'} ?? ''}}" {{ $readonly }}>
                    <input type="hidden" name="abc_reg_no_verified" id="abc_reg_no_verified" value="{{ $abc_reg_no_verified }}">
                    <span id="abc_cert_no" style="color:green;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4" id="rni-efilling" style="display: {{$efiling}};">
                  <div class="form-group">
                    <label for="rni_efiling_no">RNI E-filing Number / आरएनआई ई-फाइलिंग नंबर</label>
                    <input type="text" name="rni_efiling_no" maxlength="19" placeholder="Enter Rni E-filing Number" class="form-control  form-control-sm" id="rni_efiling_no" value="{{ $vendor_datas->{'RNI E-filling No_'} ?? '' }}" {{ @$readonly }}>
                    <input type="hidden" name="rni_annual_valid" id="rni_annual_valid" value="{{ $turnover_veryfied }}">
                    <span id="rni_efill_no" style="color:green;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="newspaper_name">Newspaper Name / अखबार का नाम<font color="red">*</font></label>
                    <input type="text" name="newspaper_name" placeholder="Enter Newspaper Name" maxlength="40" class="form-control  form-control-sm" id="newspaper_name" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendor_datas->{'Newspaper Name'} ?? '' }}" {{ @$readonly }}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="place_of_publication">Place of Publication / प्रकाशन का स्थान<font color="red">*</font></label>
                    <input type="text" name="place_of_publication" maxlength="25" placeholder="Enter Place of Publication" class="form-control  form-control-sm" id="place_of_publication" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendor_datas->{'Place of Publication'} ?? '' }}" {{ @$readonly }}>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="v_email">E-mail ID(Vendor) / ई मेल आईडी<font color="red">*</font></label>
                    <input type="email" class="form-control  form-control-sm" maxlength="40" id="v_email" name="v_email" placeholder="Enter Email ID" value="{{ @$np_rate_renewal[0]->{'E-mail ID'} !='' ? $np_rate_renewal[0]->{'E-mail ID'} : @$vendor_datas->{'E-mail ID'} }}" {{$renewal_readonly}}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="v_mobile">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                    <input type="text" class="form-control  form-control-sm" id="v_mobile" name="v_mobile" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{ $vendor_datas->{'Mobile No_'} ?? '' }}" {{ @$readonly }}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="v_address">Address / पता<font color="red">*</font></label>
                    <textarea name="v_address" id="v_address" maxlength="220" placeholder="Enter Address" cols="50" class="form-control  form-control-sm" {{ $renewal_readonly }}>{{ @$np_rate_renewal[0]->{'Address'} !='' ? $np_rate_renewal[0]->{'Address'} : @$vendor_datas->{'Address'} }}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="v_state">State / राज्य<font color="red">*</font></label>
                    <select id="v_state" name="v_state" class="form-control  form-control-sm call_district" data="v_district" style="width: 100%;" {{ @$disabled }}>
                      <option value="">Select State</option>
                      @foreach($states as $state)
                      <option value="{{$state['Code']}}" {{ (@$vendor_datas->{'State'} == $state['Code']  ? 'selected' : '') }}>{{$state['Code']}} ~ {{$state['Description']}}</option>
                      @endforeach
                    </select>
                    <input type="hidden" name="v_state" value="{{@$vendor_datas->{'State'} ?? ''}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="v_district">District / ज़िला<font color="red">*</font></label>
                    <select id="v_district" name="v_district" class="form-control  form-control-sm" {{ @$disabled }}>
                      @if(@$vendor_datas->{'District'} != '')
                      @foreach($districts as $district)
                      <option value="{{$district['District']}}" {{ (@$vendor_datas->{'District'} === $district['District']  ? 'selected' : '') }}>{{ $district['District'] }}</option>
                      @endforeach
                      @endif
                    </select>
                    <input type="hidden" name="v_district" value="{{@$vendor_datas->{'District'} ?? ''}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="v_city">City / नगर<font color="red">*</font></label>
                    <input type="text" id="v_city" name="v_city" maxlength="30" onkeypress="return onlyAlphabets(event,this)" class="form-control  form-control-sm" placeholder="Enter City" value="{{ $vendor_datas->{'City'} ?? '' }}" {{ @$readonly }}>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="pin_code">Pin Code / पिन कोड<font color="red">*</font></label>
                    <input type="text" id="pin_code" name="pin_code" class="form-control  form-control-sm" placeholder="Enter Pin Code" onkeypress="return onlyNumberKey(event)" maxlength="6" value="{{ $vendor_datas->{'Pin Code'} ?? '' }}" {{ @$readonly }}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="v_phone">Phone No. / फोन नंबर</label>
                    <input type="text" class="form-control  form-control-sm" id="v_phone" name="v_phone" placeholder="Enter Phone Number" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{ @$np_rate_renewal[0]->{'Phone No'} != '' ? $np_rate_renewal[0]->{'Phone No'} : @$vendor_datas->{'Phone No'} }}" {{ $renewal_readonly }}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="v_fax_no">Fax / फैक्स </label>
                    <input type="text" class="form-control  form-control-sm" id="v_fax" name="v_fax_no" placeholder="Enter Fax" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{ $vendor_datas->{'Fax'} ?? '' }}" {{ @$readonly }}>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Language / भाषा<font color="red">*</font></label>
                    <select name="language" id="language" class="form-control  form-control-sm" style="width: 100%;" {{ @$disabled }}>
                      <option value="">Select language</option>
                      @foreach($languages as $language)
                      <option value="{{$language['Code']}}" {{(@$vendor_datas->{'Language'} == $language['Code']) ? 'selected' :'' }}>{{$language['Code']}} ~ {{$language['Name']}}</option>
                      @endforeach
                    </select>
                    <input type="hidden" name="language" value="{{@$vendor_datas->{'Language'} ?? ''}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="claimed_circulation">Claimed Circulation No. / दावा किया गया संचलन <font color="red">*</font></label>
                    <input type="text" name="claimed_circulation" maxlength="8" placeholder="Enter Claimed Circulation No." class="form-control  form-control-sm" id="claimed_circulation" onkeypress="return onlyNumberKey(event)" onkeyup="return removezero(this.value)" value="{{ $solid_circulation !=0 ? $solid_circulation : '' }}" {{ $renewal_disabled }}>
                    <span id="alert_claimed_circulation" class="error invalid-feedback" style="display: none;"></span>
                    <input type="hidden" name="claimed_circulation_veryfied" id="claimed_circulation_veryfied" value="{{ $solid_circulation_veryfied }}">
                    <input type="hidden" name="claimed_circulation_hidden" id="claimed_circulation_hidden">
                    <span id="rni_claimed_cirl" style="color:green;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Periodicity / अवधि<font color="red">*</font></label>
                    <select name="periodicity" id="periodicity" class="form-control  form-control-sm" {{ @$disabled }}>
                      <option value="" {{@$vendor_datas->{'Periodicity'} == ""   ? 'selected' : ''}}>Select any one</option>
                      <option value="0" {{ (@$vendor_datas->{'Periodicity'} == 0 && @$vendor_datas->{'Periodicity'} != "" ? 'selected' : '') }}>Daily(M)</option>
                      <option value="1" {{ @$vendor_datas->{'Periodicity'} == 1  ? 'selected' : '' }}>Daily(E)</option>
                      <option value="2" {{ @$vendor_datas->{'Periodicity'} == 2  ? 'selected' : '' }}>Daily Except Sunday</option>
                      <option value="3" {{ @$vendor_datas->{'Periodicity'} == 3  ? 'selected' : '' }}>Bi-Weekly</option>
                      <option value="4" {{ @$vendor_datas->{'Periodicity'} == 4  ? 'selected' : '' }}>Weekly</option>
                      <option value="5" {{ @$vendor_datas->{'Periodicity'} == 5  ? 'selected' : '' }}>Fortnightly</option>
                      <option value="6" {{ @$vendor_datas->{'Periodicity'} == 6  ? 'selected' : '' }}>Monthly</option>
                    </select>
                    <input type="hidden" name="periodicity" value="{{ @$vendor_datas->{'Periodicity'} ?? '' }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="print_area">Print Area Per Page (in SQ. CM) /प्रति पृष्ठ प्रिंट क्षेत्र (वर्ग सेमी में.) </label>
                    <input type="text" name="print_area" placeholder="Enter Print Area" maxlength="6" class="form-control  form-control-sm" id="print_area" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendor_datas->{'Page Area per page'} !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendor_datas->{'Page Area per page'} )),0),'.') : '') }}" {{ @$readonly }}>
                  </div>
                </div>
                <div class="col-md-4"><br>
                  @php
                  $length = '';
                  if(@$np_rate_renewal != '' && @$np_rate_renewal[0]->{'Length'} !=''){
                  $length = @$np_rate_renewal[0]->{'Length'};
                  }elseif(@$vendor_datas != '' && @$vendor_datas->{'Page Length'} !=''){
                  $length = @$vendor_datas->{'Page Length'};
                  }
                  @endphp
                  <div class="form-group">
                    <label for="page_length">Page Length (in Cms.) / पृष्ठ की लंबाई (सेमी में.)<font color="red">*</font></label>
                    <input type="text" name="page_length" placeholder="Enter Page Length" maxlength="4" class="form-control  form-control-sm" id="page_length" onkeypress="return isNumber(event,this)" value="{{ $length != '' ? rtrim(rtrim(sprintf('%f', floatval($length)),0),'.') : ''}}" {{ $renewal_readonly }}>
                    <span id="alert_page_length" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4"><br>
                  @php
                  $width = '';
                  if(@$np_rate_renewal != '' && @$np_rate_renewal[0]->{'Breadth'} !=''){
                  $width = @$np_rate_renewal[0]->{'Breadth'};
                  }elseif(@$vendor_datas != '' && @$vendor_datas->{'Page Width'} !=''){
                  $width = @$vendor_datas->{'Page Width'};
                  }
                  @endphp
                  <div class="form-group">
                    <label for="page_width">Page Width (in Cms.) / पृष्ठ की चौड़ाई (सेमी में.)<font color="red">*</font></label>
                    <input type="text" name="page_width" placeholder="Enter Page Width" maxlength="4" class="form-control  form-control-sm" id="page_width" onkeypress="return isNumber(event,this)" value="{{ $width != '' ? rtrim(rtrim(sprintf('%f', floatval($width)),0),'.') : ''}}" {{ $renewal_readonly }}>
                    <span id="alert_page_width" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="no_of_page">No. Of Pages / पृष्ठों की संख्या<font color="red">*</font></label>
                    <input type="text" name="no_of_page" placeholder="Enter No. Of Pages" maxlength="7" class="form-control  form-control-sm" id="no_of_page" onkeypress="return onlyNumberKey(event)" value="{{ $vendor_datas->{'No_ Of pages'} ?? '' }}" {{ $readonly }}>
                    <span id="alert_no_of_page" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  @php
                  $no_of_pages = @$vendor_datas->{'No_ Of pages'} !=0 ? @$vendor_datas->{'No_ Of pages'} : 1;
                  $total_print_area = '';
                  if(@$np_rate_renewal != '' && @$np_rate_renewal[0]->{'Print Area'} !=''){
                  $total_print_area = $length * $width * $no_of_pages;
                  }elseif(@$vendor_datas != '' && @$vendor_datas->{'Total Print Area'} !=''){
                  $total_print_area = $length * $width * $no_of_pages;
                  }
                  @endphp
                  <div class="form-group">
                    <label for="total_print_area">Total Print Area (in Sq. Cms.) / कुल प्रिंट क्षेत्र (वर्ग सेमी में.)</label>
                    <input type="text" name="total_print_area" placeholder="Enter Total Print Area" maxlength="20" class="form-control  form-control-sm" id="total_print_area" onkeypress="return onlyNumberKey(event)" value="{{ $total_print_area != '' ? rtrim(rtrim(sprintf('%f', floatval($total_print_area)),0),'.') : '0'}}" {{ $readonly }}>
                    <span id="alert_total_print_area" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <h4 class="subheading">Minimum Current Card Rate/न्यूनतम वर्तमान कार्ड दर</h4>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="black_white">Black & White (Rs per SQ CM) / ब्लैक एंड व्हाइट (रुपये प्रति वर्ग सेमी)</label>
                    <input type="text" name="black_white" maxlength="15" placeholder="Enter Black & White" class="form-control  form-control-sm" id="black_white" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendor_datas->{'Minimum Current Card Rate(B_W)'} !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendor_datas->{'Minimum Current Card Rate(B_W)'} )),0),'.') : '') }}" {{ @$readonly }}>
                    <span id="alert_black_white" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="colour">Color (Rs per SQ CM) / रंग (रुपये प्रति वर्ग सेमी)</label>
                    <input type="text" name="colour" placeholder="Enter Color" maxlength="15" class="form-control  form-control-sm" id="colour" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendor_datas->{'Minimum Current Card Rate(c)'} !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendor_datas->{'Minimum Current Card Rate(c)'} )),0),'.') : '') }}" {{ @$readonly }}>
                    <span id="alert_colour" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="price_newspaper">Price of Newspaper (Rs) / अखबार की कीमत (रु)<font color="red">*</font></label>
                    <input type="text" name="price_newspaper" maxlength="15" placeholder="Enter Price of Newspaper" class="form-control  form-control-sm" id="price_newspaper" onkeypress="return isNumber(event,this)" value="{{ (@$vendor_datas->{'Price of NewsPaper'} !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendor_datas->{'Price of NewsPaper'} )),0),'.') : '') }}" {{ @$readonly }}>
                    <span id="alert_price_newspaper" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group clearfix">
                    <label for="quality_paper_used">Quality of Paper Used / प्रयुक्त कागज की गुणवत्ता<font color="red">*</font></label><br>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary1" name="quality_paper_used" value="0" {{ (@$vendor_datas->{'Quality of Paper'}=="0") ? "checked" : "" }} {{ @$disabled }}>
                      <label for="radioPrimary1">Standard Newspaper / मानक समाचार पत्र </label>
                    </div><br>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary2" name="quality_paper_used" value="1" {{ (@$vendor_datas->{'Quality of Paper'}=="1") ? "checked" : "" }} {{ @$disabled }}>
                      <label for="radioPrimary2">Glazed / चमकता हुआ </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary3" name="quality_paper_used" value="2" {{ (@$vendor_datas->{'Quality of Paper'}=="2") ? "checked" : "" }} {{ @$disabled }}>
                      <label for="radioPrimary3">Ordinary / साधारण </label>
                    </div>

                  </div>
                  <span id="alert_quality_paper_used" style="color:red;display: none;"></span>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Printing in Color / रंग में मुद्रण<font color="red">*</font></label>
                    <select name="printing_colour" id="printing_colour" class="form-control  form-control-sm" style="width: 100%;" {{ $renewal_readonly }}>
                      <option value="">Please Select Color</option>
                      <option value="0" {{(@$np_rate_renewal[0]->{'Color'} == "0")  ? 'selected' : (@$vendor_datas->{'Printing in colour'} == "0" ? 'selected' : '') }}>Color</option>
                      <option value="1" {{ (@$np_rate_renewal[0]->{'Color'} == "1") ? "selected" : (@$vendor_datas->{'Printing in colour'} == "1" ? "selected" : '') }}>B/W</option>
                    </select>
                    <span id="alert_printing_colour" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  @php
                  $display = 'none';
                  if(@$np_rate_renewal[0]->{'Color'} == "0"){
                  $display = 'block';
                  } else if(empty(@$np_rate_renewal) && @$vendor_datas->{'Printing in colour'} == "0"){
                  $display = 'block';
                  }
                  @endphp
                  <div class="form-group" id="colour_page" style="display:{{ @$display }}">
                    <label for="colour_pages">How many Pages in Color / िकतने पे रंगीन है </label>
                    <input type="text" name="colour_pages" maxlength="8" placeholder="Enter Pages in Color" class="form-control  form-control-sm" id="colour_pages" onkeypress="return onlyNumberKey(event)" value="{{ @$np_rate_renewal[0]->{'No_ Of pages'} ?? @$vendor_datas->{'No_ of pages in colour'} }}" {{ $renewal_readonly }}>
                    <span id="alert_colour_pages" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>News Agencies Subscribed to / समाचार एजेंसियों ने सदस्यता ली<font color="red">*</font></label>
                    <select name="news_agencies_subscribed" id="news_agencies_subscribed" class="form-control  form-control-sm" style="width: 100%;" {{ @$disabled }}>
                      <option value="">Select any one</option>
                      <option value="0" {{ (@$vendor_datas->{'News Agencies Subscribed To'} == 0 && @$vendor_datas->{'News Agencies Subscribed To'} != "")  ? 'selected' : '' }}>PTI</option>
                      <option value="1" {{ (@$vendor_datas->{'News Agencies Subscribed To'} == 1)  ? 'selected' : ''}}>Others</option>
                    </select>
                    <input type="hidden" name="news_agencies_subscribed" value="{{ @$vendor_datas->{'News Agencies Subscribed To'} }}">
                    <span id="alert_news_agencies_subscribed" style="color:red;display: none;"></span>
                  </div>
                </div>
                @if(@$vendor_datas->{'News Agencies Subscribed To'} == 1)
                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="agencies">Enter Agency / एजेंसी दर्ज करें<font color="red">*</font></label>
                    <input type="text" name="agencies" maxlength="60" id="agencies" placeholder="Enter Agency" class="form-control  form-control-sm" id="agencies" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendor_datas->{'Agencies Name'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_agencies" style="color:red;display: none;"></span>
                  </div>
                </div>
                @endif
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="total_annual">Total Annual Turnover of The Newspaper in Rs / अखबार का कुल वार्षिक कारोबार रु</label>
                    <input type="text" name="total_annual_turn_over" maxlength="10" placeholder="Enter Total annual turnover of the newspaper in Rs" class="form-control  form-control-sm" id="total_annual" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendor_datas->{'Annual Turn-over'} !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendor_datas->{'Annual Turn-over'})),0),'.') : '') }}" {{ @$readonly }}>
                    <span id="alert_total_annual" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="name_of_editor">Editor Name/ संपादक का नाम<font color="red">*</font></label>
                    <input type="text" name="name_of_editor" maxlength="40" placeholder="Editor Name" class="form-control  form-control-sm" id="name_of_editor" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendor_datas->{'Editor Name'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_name_of_editor" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="editor_mobile">Editor Mobile No. / संपादक का मोबाइल नंबर<font color="red">*</font></label>
                    <input type="text" name="editor_mobile" maxlength="10" placeholder="Enter Editor Mobile" class="form-control  form-control-sm" id="editor_mobile" onkeypress="return onlyNumberKey(event)" value="{{ $vendor_datas->{'Editor Mobile'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_editor_mobile" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="editor_email">Editor Email ID / संपादक का ई मेल आईडी<font color="red">*</font></label>
                    <input type="text" name="editor_email" maxlength="40" placeholder="Enter Editor Email ID" class="form-control  form-control-sm" id="editor_email" value="{{ $vendor_datas->{'Editor Email'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_editor_email" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="publisher_name">Publisher Name / प्रकाशक का नाम<font color="red">*</font></label>
                    <input type="text" name="publisher_name" maxlength="40" placeholder="Enter Publisher Name" class="form-control  form-control-sm" id="publisher_name" onkeypress="return onlyAlphabets(event,this)" value="{{ @$np_rate_renewal[0]->{'Publisher Name'} != '' ? $np_rate_renewal[0]->{'Publisher Name'} : @$vendor_datas->{'Publisher_s Name'} }}" {{ $renewal_readonly }}>
                    <span id="alert_publisher_name" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="publisher_mobile">Publisher Mobile / प्रकाशक का मोबाइल नंबर<font color="red">*</font></label>
                    <input type="text" name="publisher_mobile" maxlength="10" placeholder="Enter Publisher Mobile" class="form-control  form-control-sm" id="publisher_mobile" onkeypress="return onlyNumberKey(event)" value="{{ @$np_rate_renewal[0]->{'Publisher Mobile'} != '' ? $np_rate_renewal[0]->{'Publisher Mobile'} : $vendor_datas->{'Publisher Mobile'} }}" {{ $renewal_readonly }}>
                    <span id="alert_publisher_mobile" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="publisher_email">Publisher Email ID / प्रकाशक का ई मेल आईडी<font color="red">*</font></label>
                    <input type="text" name="publisher_email" maxlength="40" placeholder="Enter Publisher Email ID" class="form-control  form-control-sm" id="publisher_email" value="{{ @$np_rate_renewal[0]->{'Publisher Email'} != '' ? $np_rate_renewal[0]->{'Publisher Email'} : $vendor_datas->{'Publisher Email'} }}" {{ $renewal_readonly }}>
                    <span id="alert_publisher_email" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="publisher_address">Publisher Address / प्रकाशक का पता<font color="red">*</font></label>
                    <textarea type="text" class="form-control  form-control-sm" maxlength="220" placeholder="Enter Publisher Address" name="publisher_address" id="publisher_address" {{ $renewal_readonly }}>{{ @$np_rate_renewal[0]->{'Publisher Address'} ?? '' }}</textarea>
                    <span id="alert_publisher_address" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="printer_name">Printer Name / प्रिंटर का नाम<font color="red">*</font></label>
                    <input type="text" name="printer_name" maxlength="50" placeholder="Enter Printer Name" class="form-control  form-control-sm" id="printer_name" onkeypress="return onlyAlphabets(event,this)" value="{{ @$np_rate_renewal[0]->{'Printer Name'} != '' ? $np_rate_renewal[0]->{'Printer Name'} : $vendor_datas->{'Printer_s Name'} }}" {{ $renewal_readonly }}>
                    <span id="alert_printer_name" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="printer_mobile">Printer Mobile / प्रिंटर का मोबाइल नंबर<font color="red">*</font></label>
                    <input type="text" name="printer_mobile" maxlength="10" placeholder="Enter Printer Mobile" class="form-control  form-control-sm" id="printer_mobile" onkeypress="return onlyNumberKey(event)" value="{{ $vendor_datas->{'Printer Mobile'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_printer_mobile" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="printer_email">Printer Email ID / प्रिंटर का ई मेल आईडी<font color="red">*</font></label>
                    <input type="text" name="printer_email" maxlength="40" placeholder="Enter Printer Email ID" class="form-control  form-control-sm" id="printer_email" value="{{ @$np_rate_renewal[0]->{'Printer Email'} != '' ? $np_rate_renewal[0]->{'Printer Email'} : $vendor_datas->{'Printer Email'} }}" {{ $renewal_readonly }}>
                    <span id="alert_printer_email" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="printer_phone">Printer Phone / प्रकाशक का फोन नंबर<font color="red">*</font></label>
                    <input type="text" name="printer_phone" maxlength="15" placeholder="Enter Printer Phone" class="form-control  form-control-sm" id="printer_phone" onkeypress="return onlyNumberKey(event)" value="{{ @$np_rate_renewal[0]->{'Printer Phone'} !='' ? $np_rate_renewal[0]->{'Printer Phone'} : $vendor_datas->{'Printer Phone'} }}" {{ $renewal_readonly }}>
                    <span id="alert_printer_phone" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="printer_address">Printer Address / प्रकाशक का पता<font color="red">*</font></label>
                    <textarea type="text" class="form-control  form-control-sm" maxlength="220" placeholder="Enter Printer Address" name="printer_address" id="printer_address" {{ $renewal_readonly }}>{{ @$np_rate_renewal[0]->{'Printer Address'} ?? '' }}</textarea>
                    <span id="alert_printer_address" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group clearfix">
                    <label for="owner_newspaper">Is the press Owned by the owner of newspaper? / क्या प्रेस का स्वामित्व अखबार के मालिक के पास है? ?<font color="red">*</font> </label><br>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="owner_newspaper2" name="press_owned_by_owner" class="owner_press" value="0" {{ (@$vendor_datas->{'Press owned by owner'}==="0") ? "checked" : "" }} {{ @$disabled }}>
                      <label for="owner_newspaper2">No / नहीं</label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="owner_newspaper1" name="press_owned_by_owner" class="owner_press" value="1" {{ (@$vendor_datas->{'Press owned by owner'}=="1") ? "checked" : "" }} {{ @$disabled }}>
                      <label for="owner_newspaper1">Yes / हाँ </label>&nbsp;&nbsp;
                    </div>
                  </div>
                  <span id="alert_owner_newspaper" style="color:red;display: none;"></span>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="name_of_press">Press Name/ प्रेस का नाम<font color="red">*</font></label>
                    <input type="text" name="name_of_press" maxlength="40" placeholder="Press Name" class="form-control  form-control-sm" id="name_of_press" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendor_datas->{'Name of Press'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_name_of_press" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="press_mobile">Press Mobile / प्रेस का मोबाइल नंबर<font color="red">*</font></label>
                    <input type="text" name="press_mobile" maxlength="10" placeholder="Enter Press Mobile" class="form-control  form-control-sm" id="press_mobile" onkeypress="return onlyNumberKey(event)" value="{{ $vendor_datas->{'Press Mobile'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_press_mobile" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="press_email">Press Email ID / प्रेस का ई मेल आईडी<font color="red">*</font></label>
                    <input type="text" name="press_email" maxlength="40" placeholder="Enter Press Email ID" class="form-control  form-control-sm" id="press_email" value="{{ $vendor_datas->{'Press Email'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_press_email" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="press_phone">Press Phone No. / प्रेस का फोन नंबर<font color="red">*</font></label>
                    <input type="text" name="press_phone" maxlength="15" placeholder="Enter Press Phone" class="form-control  form-control-sm" id="press_phone" onkeypress="return onlyNumberKey(event)" value="{{ $vendor_datas->{'Press Phone'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_press_phone" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="address_of_press">Address of Press / प्रेस का पता</label>
                    <textarea type="text" class="form-control  form-control-sm" maxlength="220" placeholder="Enter Address of Press" name="address_of_press" id="address_of_press" {{ @$readonly }}>{{ $vendor_datas->{'Address of Press'} ?? '' }}</textarea>
                    <span id="alert_address_of_press" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="distance_press">Distance from Office to Press (In Km) / कार्यालय से प्रेस की दूरी (किमी. में)</label>
                    <input type="text" name="distance_office_to_press" maxlength="15" placeholder="Enter Distance From Office to press" class="form-control  form-control-sm" id="distance_press" onkeypress="return onlyNumberKey(event)" value="{{ (@$vendor_datas->{'Distance from office to press'} !=0 ? @rtrim(rtrim(sprintf('%f', floatval($vendor_datas->{'Distance from office to press'} )),0),'.') : '') }}" {{ @$readonly }}>
                    <span id="alert_distance_press" style="color:red;display: none;"></span>
                  </div>
                </div>

                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="ca_name">CA Name / सीए का नाम</label>
                    <input type="text" name="ca_name" maxlength="40" placeholder="Enter CA`s Name" class="form-control  form-control-sm" id="ca_name" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendor_datas->{'CA Name'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_ca_name" style="color:red;display: none;"></span>
                  </div>
                </div>
                <!-- <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="ca_unique_no">CA Unique No. / सीए का यूनिक नंबर</label>
                    <input type="text" name="ca_unique_no" maxlength="25" placeholder="Enter CA`s Unique No." class="form-control  form-control-sm" id="ca_unique_no" value="{{ $vendor_datas->{'CA Unique No_'} ?? '' }}" {{ @$readonly }}>
                  </div>
                </div> -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="ca_address">CA Address / सीए का पता</label>
                    <textarea type="text" class="form-control  form-control-sm" placeholder="Enter CA`s Address" name="ca_address" id="ca_address" maxlength="220" {{ @$readonly }}>{{ $vendor_datas->{'CA Address'} ?? '' }}</textarea>
                    <span id="alert_ca_address" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row">

                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="ca_registration_no">CA Registration No. / सीए पंजीकरण संख्या</label>
                    <input type="text" name="ca_registration_no" maxlength="20" placeholder="Enter CA's Registration No." class="form-control  form-control-sm" id="ca_registration_no" onkeypress="javascript:return isAlphaNumeric(event,this.value);" value="{{ $vendor_datas->{'CA Registration No_'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_ca_registration_no" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="ca_mobile">CA Mobile No. / सीए का मोबाइल नंबर</label>
                    <input type="text" name="ca_mobile" maxlength="10" placeholder="Enter CA's Mobile" class="form-control  form-control-sm" id="ca_mobile" onkeypress="return onlyNumberKey(event)" value="{{ $vendor_datas->{'CA Mobile No_'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_ca_mobile" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="ca_email">CA Email ID / सीए का ई मेल आईडी</label>
                    <input type="text" name="ca_email" maxlength="40" placeholder="Enter CA's Email ID" class="form-control  form-control-sm" id="ca_email" value="{{ $vendor_datas->{'CA Email'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_ca_email" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row">

                <!-- <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="cin_no">CIN No. / सीआईएन नंबर</label>
                    <input type="text" name="cin_no" maxlength="15" placeholder="Enter CIN No." class="form-control  form-control-sm" id="cin_no" onkeypress="return onlyNumberKey(event)" value="{{ $vendor_datas->{'CIN Number'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_cin_no" style="color:red;display: none;"></span>
                  </div>
                </div> -->
                @php
                $dm_date = '';
                if((@$np_rate_renewal[0]->{'DM Declaration Date'} != '1753-01-01 00:00:00.000') && @$np_rate_renewal[0]->{'DM Declaration Date'} != ''){

                $dm_date = date('Y-m-d', strtotime(@$np_rate_renewal[0]->{'DM Declaration Date'}));

                }elseif((@$vendor_datas->{'DM Declaration Date'} != '1753-01-01 00:00:00.000') && $vendor_datas->{'DM Declaration Date'} != ''){

                $dm_date = date('Y-m-d', strtotime(@$vendor_datas->{'DM Declaration Date'}));

                }

                @endphp
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dm_declaration_date">DM Declaration End Date / डीएम घोषणा समाप्ति तिथि <font color="red">*</font></label>
                    <input type="date" name="dm_declaration_date" class="form-control  form-control-sm" id="dm_declaration_date" value="{{$dm_date}}" {{ $renewal_readonly }}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group clearfix">
                    <label for="edition">Vendor Edition / विक्रेता संस्करण</label><br>
                    <div class="icheck-primary d-inline">
                      @php
                      $vendor_edition_check = empty(@$owner_other_publications) ? 'checked' : '';
                      @endphp
                      <input type="radio" id="edition2" name="vendor_edition" value="0" {{ $vendor_edition_check }} {{ @$disabled }}>
                      <label for="edition2">Single Edition/एकल संस्करण</label>
                    </div><br>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="edition1" name="vendor_edition" value="1" {{ (@count(@$owner_other_publications)>0  ? "checked" :  "") }} {{ @$disabled }}>
                      <label for="edition1">Multiple Edition/एकाधिक संस्करण</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group clearfix">
                    <label for="change_address">Is Past Address Changed ? / क्या पिछला पता बदल गया है ? </label><br>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="change_address2" name="change_address" value="0" {{ (@$vendor_datas->{'Change In Company Address'} == "0")  ? "checked" : "" }} {{ @$disabled }}>
                      <label for="change_address2">No / नहीं</label>
                    </div>&nbsp;&nbsp;
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="change_address1" name="change_address" value="1" {{ (@$vendor_datas->{'Change In Company Address'} == "1") ? "checked" : "" }} {{ @$disabled }}>
                      <label for="change_address1">Yes / हाँ </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group clearfix">
                    <label for="latest_dm_cert"> Is Any Changes On DM Declaration ? / क्या डीएम की घोषणा में कोई बदलाव है ? </label>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="latest_dm_cert2" name="latest_dm_cert" value="0" onclick="latestDmCertificate(this.value)" <?= (@$np_rate_renewal[0]->{'DM Declaration'} == 0  ? "checked" : ""); ?> {{ $renewal_disabled }}>
                      <label for="latest_dm_cert2">No / नहीं</label>
                    </div>&nbsp;&nbsp;
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="latest_dm_cert1" name="latest_dm_cert" value="1" onclick="latestDmCertificate(this.value)" <?= (@$np_rate_renewal[0]->{'DM Declaration'} == 1  ? "checked" : ""); ?> {{ $renewal_disabled }}>
                      <label for="latest_dm_cert1">Yes / हाँ </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <!-- checkbox -->
                  <div class="form-group clearfix">
                    <!-- <div class="icheck-primary d-inline">
                      <input type="checkbox" id="davp_panel" name="davp_checkbox" {{ (@count(@$owner_other_publications)>0  ? "checked" : "")}} disabled>
                      <label for="davp_panel">Click if having other publications on DAVP panel by same owner/ क्लिक करें यदि एक ही मालिक द्वारा डीएवीपी पैनल पर अन्य प्रकाशन हैं </label>
                    </div> -->
                  </div>
                </div>
              </div>
              @if( @count(@$owner_other_publications)>0 )
              @foreach($owner_other_publications as $key => $owner_other_data)
              <div class="row" {{$key}}>
                <div class="col-md-12">
                  <h4 class="subheading">Details of other publications of same owner or Publisher-----/एक ही मालिक या प्रकाशक के अन्य प्रकाशनों का विवरण ----</h4>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title">Title / शीषक</label>
                    <input type="text" name="title" placeholder="Enter Title" maxlength="50" class="form-control  form-control-sm" id="title1" onkeypress="javascript:return isAlphaNumeric(event,this.value);" value="{{ $owner_other_data->{'Newspaper Name'} ?? '' }}" disabled>
                    <span id="alert_title" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Language / भाषा</label>
                    <select id="davp_lang1" name="lang" data="{{ @$owner_other_data->{'Language'} }}" class="form-control  form-control-sm" style="width: 100%;" disabled>
                      <option value="" data-select2-id="2">Select Language</option>
                      @foreach($languages as $language)
                      <option value="{{ $language['Code'] }}" {{ @$owner_other_data->{'Language'} == $language['Code']  ? 'selected' : '' }}>{{ $language['Code'] }} ~ {{ $language['Name'] }}</option>
                      @endforeach
                    </select>
                    <span id="alert_davp_lang1" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="publication">Place of Publication / प्रकाशक का स्थान</label>
                    <input type="text" name="place_of_publication_davp" maxlength="20" placeholder="Enter Place of Publication" class="form-control  form-control-sm" id="publication1" onkeypress="return onlyAlphabets(event,this)" value="{{ $owner_other_data->{'Place of Publication'} ?? '' }}" disabled>
                    <span id="alert_publication" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label>Periodicity / आवधि</label>
                    <select name="periodicity_davp" id="periodicity_mult" class="form-control  form-control-sm" disabled>
                      <option value="0" {{ (@$owner_other_data->{'Periodicity'} == 0 && @$owner_other_data->{'Periodicity'} != "" ? 'selected' : '') }}>Daily(M)</option>
                      <option value="1" {{ @$owner_other_data->{'Periodicity'} == 1  ? 'selected' : '' }}>Daily(E)</option>
                      <option value="2" {{ @$owner_other_data->{'Periodicity'} == 2  ? 'selected' : '' }}>Daily Except Sunday</option>
                      <option value="3" {{ @$owner_other_data->{'Periodicity'} == 3  ? 'selected' : '' }}>Bi-Weekly</option>
                      <option value="4" {{ @$owner_other_data->{'Periodicity'} == 4  ? 'selected' : '' }}>Weekly</option>
                      <option value="5" {{ @$owner_other_data->{'Periodicity'} == 5  ? 'selected' : '' }}>Fortnightly</option>
                      <option value="6" {{ @$owner_other_data->{'Periodicity'} == 6  ? 'selected' : '' }}>Monthly</option>
                    </select>
                    <span id="alert_periodicity_mult" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="davp">Owner/Group ID / मालिक/समूह कोड </label>
                    <input type="text" name="davp" placeholder="Enter Owner/Group ID" class="form-control  form-control-sm" id="davp" maxlength="8" value="{{ @$owner_other_data->{'Newspaper Code'} ?? '' }}" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="edition_distance">Distance from this Edition(In Km) / इस संस्करण से दूरी (किमी. में)</label>
                    <input type="text" name="distance_from_edition[]" maxlength="15" placeholder="Enter Distance" class="form-control  form-control-sm" id="edition_distance" onkeypress="return onlyNumberKey(event)" value="{{ @$owner_other_data !='' ?  @rtrim(rtrim(sprintf('%f', floatval($owner_other_data->{'Distance from office to press'})),0),'.') : ''}}" disabled>
                    <span id="alert_edition_distance" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4"></div>
              </div>
              @endforeach

              @endif
              <input type="hidden" name="next_tab_2" id="next_tab_2" value="0">
              <a class="btn btn-primary reg-previous-button previousClass" data="10">Previous</a>
              <a class="btn btn-primary next-button" id="tab_2">Next</a>
            </div>
            <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab3-trigger">
              <div class="row">
                <div class="col-md-4"><br><br><br>
                  <div class="form-group">
                    <label for="account_type">Account Type / खाते का प्रकार<font color="red">*</font></label>
                    <select class="form-control  form-control-sm" name="account_type" id="account_type" {{$disabled}}>
                      <option value="">Select Account Type</option>
                      <option value="0" {{ (@$vendor_datas->{'Account Type'} == 0 && @$vendor_datas->{'Account Type'} != "" ? 'selected' : '') }}>Savings</option>
                      <option value="1" {{ (@$vendor_datas->{'Account Type'} == 1 ? 'selected' : '') }}>Corporate</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="bank_account_no">Bank Account Number For Receiving Number*Bank Account No. For Receiving Payments / संख्या प्राप्त करने के लिए बैंक खाता संख्या * भुगतान प्राप्त करने के लिए बैंक खाता संख्या<font color="red">*</font></label>
                    <input type="text" class="form-control  form-control-sm" name="bank_account_no" maxlength="20" id="bank_account_no" placeholder="Enter Bank Account Number" onkeypress="return onlyNumberKey(event)" value="{{ $vendor_datas->{'Bank Account No_'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_bank_account_no" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4"><br><br>
                  <div class="form-group divmargin">
                    <label for="account_holder_name">Account Holder Name / खाता धारक का नाम<font color="red">*</font></label>
                    <input type="text" class="form-control  form-control-sm" name="account_holder_name" maxlength="70" id="account_holder_name" placeholder="Enter Account Holder Name" onkeypress="return onlyAlphabets(event,this)" value="{{ $vendor_datas->{'Account Holder Name'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_account_holder_name" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="bank_name">Bank Name / बैंक का नाम<font color="red">*</font></label>
                    <input type="text" class="form-control  form-control-sm" name="bank_name" id="bank_name" maxlength="50" placeholder="Enter Bank Name" value="{{ $vendor_datas->{'Bank Name'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_bank_name" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="ifsc_code">IFSC Code / आईएफएससी कोड<font color="red">*</font></label>
                    <input type="text" class="form-control  form-control-sm" name="ifsc_code" id="ifsc_code" maxlength="11" placeholder="Enter IFSC Code" value="{{ $vendor_datas->{'IFSC Code'} ?? '' }}" {{ @$readonly }} onkeypress="return isAlphaNumeric(event,this);">
                    <span id="alert_ifsc_code" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="branch_name">Branch / शाखा<font color="red">*</font></label>
                    <input type="text" class="form-control  form-control-sm" name="branch_name" id="branch_name" maxlength="40" placeholder="Enter Branch" value="{{ $vendor_datas->{'Branch'} ?? '' }}" {{ @$readonly }}>
                    <span id="alert_branch_name" style="color:red;display: none;"></span>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="address_of_account">Address of Account / खाते का पता<font color="red">*</font></label>
                    <textarea class="form-control  form-control-sm" placeholder="Enter Address of Account" maxlength="220" name="address_of_account" id="address_of_account" {{ @$readonly }}>{{ $vendor_datas->{'Account Address'} ?? '' }}</textarea>
                    <span id="alert_address_of_account" style="color:red;display: none;"></span>

                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="pan_card">PAN Card No. / पैन कार्ड नंबर<font color="red">*</font></label>
                    <input type="text" name="pan_card" id="pan_card" class="form-control  form-control-sm" maxlength="10" placeholder="Enter Pan Card" value="{{ $vendor_datas->{'PAN'} ?? '' }}" {{ @$readonly }} onkeypress="javascript:return isAlphaNumeric(event,this.value);">
                    <span id="alert_pan_card" style="color:red;display: none;"></span>
                  </div>
                </div>
                <fieldset class="fieldset-border">
                  <legend>ESI Account Details / ईएसआई खाता विवरण</legend>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="ESI_account_no">Account No. / खाता नंबर</label>
                        <input type="text" name="ESI_account_no" id="ESI_account_no" maxlength="20" class="form-control  form-control-sm" placeholder="Enter Account No" onkeypress="return onlyNumberKey(event)" value="{{ $vendor_datas->{'ESI Account No'} ?? '' }}" {{ @$readonly }}>
                        <span id="alert_address_of_account" style="color:red;display: none;"></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="ESI_no_employees">No of Employees Covered / कवर किए गए कर्मचारियों की संख्या</label>
                        <input type="text" name="ESI_no_employees" id="ESI_no_employees" maxlength="6" class="form-control  form-control-sm" placeholder="Enter No of Employees Covered" onkeypress="return onlyNumberKey(event)" value="{{ ((@$vendor_datas->{'No_of Employees covered'} && @$vendor_datas->{'No_of Employees covered'} !=0) ? @$vendor_datas->{'No_of Employees covered'} : '' ) }}" {{ @$readonly }}>
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
                        <input type="text" name="EPF_account_no" id="EPF_account_no" maxlength="20" class="form-control  form-control-sm" placeholder="Enter Account No" onkeypress="return onlyNumberKey(event)" value="{{ $vendor_datas->{'EPF Account No_'} ?? '' }}" {{ @$readonly }}>
                      </div>
                      <span id="alert_EPF_account_no" style="color:red;display: none;"></span>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="Name">No of Employees Covered / कवर किए गए कर्मचारियों की संख्या</label>
                        <input type="text" name="EPF_no_of_employees" id="EPF_no_of_employees" maxlength="6" class="form-control  form-control-sm" placeholder="Enter No of Employees Covered" onkeypress="return onlyNumberKey(event)" value="{{ ((@$vendor_datas->{'No_ of EPF Employees covered'} && @$vendor_datas->{'No_ of EPF Employees covered'} !=0) ? @$vendor_datas->{'No_ of EPF Employees covered'} : '' ) }}" {{ @$readonly }}>
                        <span id="alert_EPF_no_of_employees" style="color:red;display: none;"></span>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>

              <input type="hidden" name="next_tab_3" id="next_tab_3" value="0">
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

                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="annexure_file_name" id="annexure_file_name" {{ @$disabled }} accept="application/pdf">
                        <label class="custom-file-label" for="annexure_file_name" id="annexure_file_name2">{{ @$vendor_datas->{'Annexure File Name'} ? $vendor_datas->{'Annexure File Name'} : 'Choose file' }}</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="annexure_file_name3">Upload</span>
                      </div>

                      @if(@$vendor_datas->{'Annexure File Name'} != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'Annexure File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @endif
                    </div>
                    <span id="annexure_file_name1" class="error invalid-feedback"></span>
                    <span id="annexure_file_name_modify1" class="error invalid-feedback"></span>
                  </div>
                </div>
                <div class="col-md-6"><br>
                  <div class="form-group">
                    <label for="specimen_copy_file_name1">Specimen copies to be sent with application / आवेदन के साथ भेजी जाने वाली नमूना प्रतियां <font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="specimen_copy_file_name" id="specimen_copy_file_name" {{ @$disabled }} accept="application/pdf">
                        <label class="custom-file-label" for="specimen_copy_file_name" id="specimen_copy_file_name2">{{ @$vendor_datas->{'Specimen Copy File Name'} ? $vendor_datas->{'Specimen Copy File Name'} : 'Choose file' }}</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="specimen_copy_file_name3">Upload</span>
                      </div>

                      @if(@$vendor_datas->{'Specimen Copy File Name'} != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'Specimen Copy File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @endif
                    </div>
                    <span id="specimen_copy_file_name1" class="error invalid-feedback"></span>
                    <span id="specimen_copy_file_name_modify1" class="error invalid-feedback"></span>
                  </div>
                </div>
                <!-- <div class="col-md-6">
                  <div class="form-group">
                    <label for="dm_declaration_file_name1">Latest DM certification uploaded in case of change ownership, printers, publisher, editor/
                      स्वामित्व, प्रिंटर, प्रकाशक, संपादक बदलने के मामले में नवीनतम डीएम प्रमाणीकरण अपलोड किया गया<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="dm_declaration_file_name" {{ @$disabled }} id="dm_declaration_file_name" accept="application/pdf">
                        <label class="custom-file-label" for="dm_declaration_file_name" id="dm_declaration_file_name2">{{ @$vendor_datas->{'DM Declaration File Name'} ? $vendor_datas->{'DM Declaration File Name'} : 'Choose file' }}</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="dm_declaration_file_name3">Upload</span>
                      </div>

                      @if(@$vendor_datas->{'DM Declaration File Name'} != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'DM Declaration File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @endif
                    </div>
                    <span id="dm_declaration_file_name1" class="error invalid-feedback"></span>
                    <span id="dm_declaration_file_name_modify1" class="error invalid-feedback"></span>
                  </div>
                </div> -->
              </div>              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="declaration_field_file_name1">Copy of declaration field by before DM/DCP or other competent authority/
                      डीएम/डीसीपी या अन्य सक्षम प्राधिकारी के समक्ष घोषणा क्षेत्र की प्रति।<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="declaration_field_file_name" id="declaration_field_file_name" {{ @$disabled }} accept="application/pdf">
                        <label class="custom-file-label" for="declaration_field_file_name" id="declaration_field_file_name2">{{ @$vendor_datas->{'Decl_ Filed Before File Name'} ? $vendor_datas->{'Decl_ Filed Before File Name'} : 'Choose file' }}</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="declaration_field_file_name3">Upload</span>
                      </div>
                      @if(@$vendor_datas->{'Decl_ Filed Before File Name'} != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'Decl_ Filed Before File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
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
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="pan_copy_file_name" id="pan_copy_file_name" {{ @$disabled }} accept="application/pdf">
                        <label class="custom-file-label" for="pan_copy_file_name" id="pan_copy_file_name2">{{ @$vendor_datas->{'PAN Copy File Name'} ? $vendor_datas->{'PAN Copy File Name'} : 'Choose file' }}</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="pan_copy_file_name3">Upload</span>
                      </div>
                      @if(@$vendor_datas->{'PAN Copy File Name'} != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'PAN Copy File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @endif
                    </div>
                    <span id="pan_copy_file_name1" class="error invalid-feedback"></span>
                    <span id="pan_copy_file_name_modify1" class="error invalid-feedback"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6" id="no_dues_cert">
                  <div class="form-group">
                    <label for="no_dues_cert_file_name1">No dues Certificates of Press Council of India for the last financial year registration/
                      पिछले वित्तीय वर्ष के पंजीकरण के लिए भारतीय प्रेस परिषद का कोई बकाया नहीं प्रमाण पत्र<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="no_dues_cert_file_name" id="no_dues_cert_file_name" {{ @$disabled }} accept="application/pdf">
                        <label class="custom-file-label" for="no_dues_cert_file_name" id="no_dues_cert_file_name2">{{ @$vendor_datas->{'No Dues Cert File Name'} ? $vendor_datas->{'No Dues Cert File Name'} : 'Choose file' }}
                        </label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="no_dues_cert_file_name3">Upload</span>
                      </div>
                      @if(@$vendor_datas->{'No Dues Cert File Name'} != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'No Dues Cert File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @endif
                    </div>
                    <span id="no_dues_cert_file_name1" class="error invalid-feedback"></span>
                    <span id="no_dues_cert_file_name_modify1" class="error invalid-feedback"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="circulation_cert_file_name1">Circulation Certificate as per policy (self-attested) (If more than 25,000 than RNI/ABC is mandatory)/ पॉलिसी के अनुसार सर्कुलेशन सर्टिफिकेट (स्व-सत्यापित) (यदि आरएनआई/एबीसी से 25,000 से अधिक अनिवार्य है)<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="circulation_cert_file_name" id="circulation_cert_file_name" {{ @$disabled }} accept="application/pdf">
                        <label class="custom-file-label" for="circulation_cert_file_name" id="circulation_cert_file_name2">{{ @$vendor_datas->{'Circulation Cert File Name'} ? $vendor_datas->{'Circulation Cert File Name'} : 'Choose file' }}</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="circulation_cert_file_name3">Upload</span>
                      </div>

                      @if(@$vendor_datas->{'Circulation Cert File Name'} != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{  @$vendor_datas->{'Circulation Cert File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
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
                  <div class="form-group">
                    <label for="rni_reg_file_name1">RNI (self-attested) Registration Certificate (Upload only PDF) max size 2MB / आरएनआई (स्व-सत्यापित) पंजीकरण प्रमाणपत्र (केवल पीडीएफ अपलोड करें) अधिकतम आकार 2MB<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="rni_reg_file_name" {{ @$disabled }} id="rni_reg_file_name" accept="application/pdf">
                        <label class="custom-file-label" for="rni_reg_file_name" id="rni_reg_file_name2">{{ @$vendor_datas->{'RNI Reg File Name'} ? @$vendor_datas->{'RNI Reg File Name'} : 'Choose file' }}</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="rni_reg_file_name3">Upload</span>
                      </div>

                      @if(@$vendor_datas->{'RNI Reg File Name'} != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'RNI Reg File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @endif
                    </div>
                    <span id="rni_reg_file_name1" class="error invalid-feedback"></span>
                    <span id="rni_reg_file_name_modify1" class="error invalid-feedback"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="annual_return_file_name1">Copy of Annual Return Form-2 submitted to RNI along with receiving proof / प्रमाण प्राप्त करने के साथ आरएनआई को जमा किए गए वार्षिक रिटर्न फॉर्म -2 की प्रति<font color="red">*</font></label>
                    <br>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="annual_return_file_name" id="annual_return_file_name" {{ @$disabled }} accept="application/pdf">
                        <label class="custom-file-label" for="annual_return_file_name" id="annual_return_file_name2">{{ @$vendor_datas->{'Annual Return File Name'} ? $vendor_datas->{'Annual Return File Name'} : 'Choose file' }}</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="annual_return_file_name3">Upload</span>
                      </div>
                      @if(@$vendor_datas->{'Annual Return File Name'} != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{  @$vendor_datas->{'Annual Return File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @endif
                    </div>
                    <span id="annual_return_file_name1" class="error invalid-feedback"></span>
                    <span id="annual_return_file_name_modify1" class="error invalid-feedback"></span>
                  </div>
                </div>
              </div>
              <div class="row">               
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="commercial_rate_file_name1">Copy of commercial rate card of the publication (1 copy) / प्रकाशन के वाणिज्यिक दर कार्ड की प्रति (1 प्रति)<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="commercial_rate_file_name" id="commercial_rate_file_name" {{ @$disabled }} accept="application/pdf">
                        <label class="custom-file-label" for="commercial_rate_file_name" id="commercial_rate_file_name2">{{ @$vendor_datas->{'Commercial Rate File Name'} ? $vendor_datas->{'Commercial Rate File Name'} : 'Choose file' }}</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="commercial_rate_file_name3">Upload</span>
                      </div>

                      @if(@$vendor_datas->{'No Dues Cert File Name'} != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a class="eyecolor" href="{{  url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'Commercial Rate File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @endif
                    </div>
                    <span id="commercial_rate_file_name1" class="error invalid-feedback"></span>
                    <span id="commercial_rate_file_name_modify1" class="error invalid-feedback"></span>
                  </div>
                </div>
                <div class="col-md-6" id="gst_reg_file"><br>
                  <div class="form-group">
                    <label for="gst_reg_cert_file_name1" style="width: 100%"> GST registration Certificate / जीएसटी पंजीकरण प्रमाणपत्र<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="gst_reg_cert_file_name" id="gst_reg_cert_file_name" {{ @$disabled }} accept="application/pdf">
                        <label class="custom-file-label" for="gst_reg_cert_file_name" id="gst_reg_cert_file_name2">{{ @$vendor_datas->{'GST Reg Cert File Name'} ? $vendor_datas->{'GST Reg Cert File Name'} : 'Choose file' }}</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="gst_reg_cert_file_name3">Upload</span>
                      </div>

                      @if(@$vendor_datas->{'GST Reg Cert File Name'} != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'GST Reg Cert File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @endif
                    </div>
                    <span id="gst_reg_cert_file_name1" class="error invalid-feedback"></span>
                    <span id="gst_reg_cert_file_name_modify1" class="error invalid-feedback"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                
                <div class="col-md-6"><br>
                  @php
                  $show_data = 'hide-msg';
                  if($company_change_add == 1){
                  $show_data = '';
                  }
                  @endphp
                  <div class="form-group {{ $show_data }}" id="change_info_doc">
                    <label for="change_in_address_file_name1">Change of information for existing company / मौजूदा कंपनी के लिए सूचना का परिवर्तन<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="change_in_address_file_name" id="change_in_address_file_name" {{ @$disabled }} accept="application/pdf">
                        <label class="custom-file-label" for="change_in_address_file_name" id="change_in_address_file_name2">{{ @$vendor_datas->{'Change in address File Name'} ? $vendor_datas->{'Change in address File Name'} : 'Choose file' }}</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="change_in_address_file_name3">Upload</span>
                      </div>

                      @if(@$company_change_add == '1')
                      <div class="input-group-append">
                        <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$vendor_datas->{'Change in address File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @endif
                    </div>
                    <span id="change_in_address_file_name1" class="error invalid-feedback"></span>
                    <span id="change_in_address_file_name_modify1" class="error invalid-feedback"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6"><br><br>
                  <div class="form-group">
                    <label for="Circulation_File_Name1">Circulation File Upload / सर्कुलेशन फ़ाइल अपलोड<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="Circulation_File_Name" id="Circulation_File_Name" {{ $renewal_disabled }} accept="application/pdf">
                        <label class="custom-file-label" for="Circulation_File_Name" id="Circulation_File_Name2">{{ @$np_rate_renewal[0]->{'Circulation File Name'} ?? 'Choose file' }}</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="Circulation_File_Name3">Upload</span>
                      </div>

                      @if(@$np_rate_renewal[0]->{'Circulation File Name'} != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$np_rate_renewal[0]->{'Circulation File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @endif
                    </div>
                    <span id="Circulation_File_Name1" class="error invalid-feedback"></span>
                    <span id="Circulation_File_Name_modify1" class="error invalid-feedback"></span>
                  </div>
                </div>
                @php
                $show_data1 = 'hide-msg';
                if(@$np_rate_renewal[0]->{'DM Declaration'} == 1){
                $show_data1 = '';
                }
                @endphp
                <div class="col-md-6 {{$show_data1}}" id="dm_certificate">
                  <div class="form-group">
                    <label for="DMD_File_Name1">Latest DM certification uploaded in case of change ownership, printers, publisher, editor/
                      स्वामित्व, प्रिंटर, प्रकाशक, संपादक बदलने के मामले में नवीनतम डीएम प्रमाणीकरण अपलोड किया गया<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="DMD_File_Name" id="DMD_File_Name" {{ $renewal_disabled }} accept="application/pdf">
                        <label class="custom-file-label" for="DMD_File_Name" id="DMD_File_Name2">{{ @$np_rate_renewal[0]->{'DMD File Name'} ?? 'Choose file' }}</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="DMD_File_Name3">Upload</span>
                      </div>

                      @if(@$np_rate_renewal[0]->{'DMD File Name'} != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a class="eyecolor" href="{{ url('/uploads') }}/fresh-empanelment/{{ @$np_rate_renewal[0]->{'DMD File Name'} }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @endif
                    </div>
                    <span id="DMD_File_Name1" class="error invalid-feedback"></span>
                  </div>
                </div>
              </div>
              <!-- <div class="col-md-12">
              <div class="form-group">
                <div class="icheck-success d-inline">
                  <input type="checkbox" name="self_declaration" {{ @$disabled }} id="self_declaration" {{ (@$vendor_datas->{'Self Declaration'} == 1)? "checked" : "" }}>
                  <label for="self_declaration">Self declaration / स्वयं घोषित</label>
                </div>
              </div>
            </div> -->
              <div class="col-md-12">
                <div class="form-group">
                  <div class="icheck-success d-inline">
                    <input type="checkbox" name="advertisement_policy" id="advertisement_policy" {{ $policy_check }} {{ $renewal_readonly }}>
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
              <input type="hidden" name="submit_btn" id="submit_btn" value="0">
              <input type="hidden" name="newspaper_code" value="{{ @$vendor_datas->{'Newspaper Code'} ?? ''}}">
              <input type="hidden" name="modified" id="modified" value="{{ $renewal_readonly ? 1:''}}">
              <a class="btn btn-primary reg-previous-button previousClass">Previous</a>
              <a class="btn btn-primary next-button" id="print_renewal" {{ $renewal_readonly }}>Save</a>

            </div>
          </div>

        </form>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

  @endsection

  @section('custom_js')
  <script src="{{ url('/js') }}/fresh-em-validation_renewal.js"></script>
  <script>
    $(document).ready(function() {
      $("#printing_colour").change(function() {
        if ($(this).val() == 0 && $(this).val() != '') {
          $("#colour_page").show();
        } else {
          $("#colour_pages").val('');
          $("#colour_page").hide();
        }
      });
    });

    $(document).ready(function() {
      $(window).keydown(function(event) {
        if (event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
      });
    });

    // start update empanelment form  
    function renewalSaveData() {
      if ($("#modified").val() == '') {
        var formData = new FormData($('#print_fress_emp_renewal')[0]);
        $.ajax({
          type: "post",
          url: "{{Route('print-renewal-save')}}",
          data: formData,
          dataType: "json",
          processData: false,
          contentType: false,
          success: function(data) {
            console.log(data);
            if (data.success == true) {
              $("html, body").animate({
                scrollTop: 0
              }, 1000);

              $('.alert-success').fadeIn().html(data.message);
              setTimeout(function() {
                $('.alert-success').fadeOut("slow");
                window.location.reload();
              }, 7000);

            }
            if (data.success == false) {
              $("html, body").animate({
                scrollTop: 0
              }, 1000);

              $('.alert-danger').fadeIn().html(data.message);
              setTimeout(function() {
                $('.alert-danger').fadeOut("slow");
              }, 7000);
            }
          },
        });

      } else {
        console.log("modified");
      }
    }
  </script>

  @endsection