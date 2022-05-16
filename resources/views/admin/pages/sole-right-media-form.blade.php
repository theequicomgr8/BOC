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

    .select2-container .select2-selection--single {
        height: 31px !important;
    }

    .select2-search--dropdown .select2-search__field {
        padding: 0rem !important;
    }

    .select2-search--dropdown .select2-search__field {
        padding: 1px !important;
    }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@section('content')
@php
$latlongData1= $latlongData?? [1];
$owner_data= !empty($owner_data) ? $owner_data : [1];
$vendor_datas = $vendor_datas ?? [1];
$OD_work_dones= !empty($OD_work_dones_data) ? $OD_work_dones_data : [1];
$OD_media_address_data= !empty($OD_media_address_data) ? $OD_media_address_data : [1];
$gst_value = Session::get('Gst');

$readonly = ' ';
$disabled = ' ';
$checked = ' ';
$Self_Dec='';
$media_id =@$vendor_data[0]['OD Media ID'];
if(@$vendor_data[0]['OD Media Temp ID'] != ''){
$disabled = 'readonly';
$readonly = 'readonly';
$checked = 'checked';
$Self_Dec = @$vendor_data[0]['Self-declaration'] == 1 ? "checked" : "";
}
@endphp


@php

//get current date and time
$current_date = date('Y-m-d h:i:s', time());
// if(@$vendor_data[0]['Self-declaration']!='' && @$vendor_data[0]['Status']=='1')
// if(@$vendor_data[0]['Modification']=='0' && @$vendor_data[0]['Status']=='1')
// @$vendor_data[0]['Rate Status Date'] > $current_date && @$vendor_data[0]['Status']=='1'
if(@$vendor_data[0]['Modification']=='1')
{
$read='readonly';
$tab='-1';
$pointer='none';
$click='preventLeftClick';
$show="none";
}
else
{
$read='';
$tab='';
$pointer='';
$click='asdf';
$show="";
}


$check1 = '';
$check2 = '';
// if(@$owner_data['Owner ID'] != ''){
if(@$owner_data[0]['Owner ID'] != ''){
$check2 = 'checked1';
// $dis='';
}else{
$check1 = 'checked1';
// $dis='none1';
}

$branchcheckyes = '';
$branchcheckno = 'checked';
$branchdisplayform = 'none';
if(!empty($branch) && @$branch[0]->State !=''){
$branchcheckyes = 'checked';
$branchcheckno = '';
$branchdisplayform = 'block';
}
@endphp


<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Empanelment-Outdoor Soleright Media</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="alert alert-success" id="show_msg" style="display: none;">
                <div align="center" class="alert alert-success" id="show_msg2"></div>
            </div>
            <div align="center" class="alert alert-danger" style="display: none;"></div>
            <form enctype="multipart/form-data" method="POST" id="sole_right_media">
                @csrf
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show {{$click}}" data-toggle="tab" id="#tab1">Basic Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$click}}" style="pointer-events: none;" data-toggle="tab" id="#tab2">Outdoor
                            Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$click}}" style="pointer-events: none;" data-toggle="tab" id="#tab3">Account
                            Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$click}}" style="pointer-events: none;" data-toggle="tab" id="#tab4">Upload
                            Document</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$click}}" style="pointer-events: none;" data-toggle="tab" id="#tab5">Advertisement
                            Details</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
                        <div id="details_of_owner">
                            @foreach($owner_data as $key => $ownerlist)
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="owner_name">Owner Name / मालिक का नाम <font color="red">*</font>
                                        </label>
                                        <p>
                                            <input type="text" name="owner_name[]" id="owner_name{{$key}}" placeholder="Enter Owner name" class="form-control form-control-sm owner_name" onkeypress="return onlyAlphabets(event,this);" maxlength="40" value="{{$ownerlist['Owner Name']?? ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">E-mail ID / ई मेल आईडी<font color="red">*</font></label>
                                        <p>
                                            <input type="email" class="form-control form-control-sm owner_email" id="owner_email{{$key}}" name="owner_email[]" maxlength="50" placeholder="Enter Email ID" value="{{$ownerlist['Email ID']?? ''}}" onkeyup="return checkUniqueOwnerSoleRight(this, this.value,0)" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                            <span id="alert_owner_email0" style="color:red;display: none;"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                                        <p>
                                            <input type="text" name="owner_mobile[]" id="owner_mobile{{$key}}" maxlength="10" minlength="10" placeholder="Enter Mobile" class="form-control form-control-sm input-imperial owner_mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$ownerlist['Mobile No_']?? ''}}" onkeyup="return checkUniqueOwnerSoleRight(this, this.value,0)" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                            <span id="alert_owner_mobile0" style="color:red;display: none;"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address / पता<font color="red">*</font></label>
                                        <p>
                                            <textarea type="text" name="address[]" id="owner_address{{$key}}" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm owner_address" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">{{$ownerlist['Address 1']?? ''}}</textarea>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Name">State / राज्य<font color="red">*</font></label>
                                        <p>
                                            <select id="owner_state0" name="state[]" class="form-control form-control-sm call_district owner_state" data="owner_district{{$key}}" cityid="owner_city{{$key}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                                                <option value="">Select State</option>
                                                @if(count($states) > 0)
                                                @foreach($states as $statesData)
                                                <option value="{{ $statesData['Code'] }}" {{@$ownerlist['State'] == $statesData['Code'] ? 'selected' : '' }}>
                                                    {{$statesData['Description']}}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Name">District / ज़िला<font color="red">*</font></label>
                                        <p>
                                            <select id="owner_district{{$key}}" name="district[]" class="form-control form-control-sm owner_district" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                                                @if(@$ownerlist['District'] != '')
                                                @foreach($ownerDistricts as $district)
                                                <option value="{{$district['District']}}" {{ @$ownerlist['District'] == $district['District']  ?  'selected' : '' }}>
                                                    {{ $district['District'] }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Name">City / नगर<font color="red">*</font></label>
                                        <p>
                                            <select id="owner_city{{$key}}" name="city[]" class="form-control form-control-sm owner_city" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                                                <option value="">Select City</option>
                                                @if(@$ownerlist['City'] != '')
                                                @foreach($ownerCities as $city)
                                                <option value="{{$city['cityName']}}" {{ @$ownerlist['City'] == $city['cityName']  ?  'selected' : '' }}>
                                                    {{ $city['cityName'] }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone">Phone No. / फोन नंबर</label>
                                        <input type="text" name="phone[]" id="owner_phone{{$key}}" maxlength="14" onkeypress="return onlyNumberKey(event)" placeholder="Enter Phone No" class="form-control form-control-sm input-imperial owner_phone" value="{{$ownerlist['Phone No_']?? ''}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="ownerid[]" id="ownerid" value="{{$ownerlist['Owner ID'] ?? ''}}">
                        <input type="hidden" name="increse_i" id="increse_i" value="{{$key ?? 0}}">
                        <div class="row" id="add_row_davp" style="float:right;margin-top:6px;">
                        </div>
                        <input type="hidden" name="mobilecheck" id="mobilecheck">
                        <input type="hidden" name="owner_input_clean" id="owner_input_clean">
                        <input type="hidden" name="user_id" value="{{ session('id') }}">
                        <input type="hidden" name="user_email" value="{{ session('email') }}">
                        <input type="hidden" name="emailarr[]" id="emailarr" value="">
                        <input type="hidden" name="next_tab_1" id="next_tab_1" value="0">
                        <a class="btn btn-primary pm-next-button" id="tab_1">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                    </div>
                    <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        <div class="row col-md-12">
                            <h4 class="subheading">Details of GST / जीएसटी का विवरण :-</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <!-- $vendor_data[0]['GST No_'] ?? ''  -->
                                <div class="form-group">
                                    <label for="GST_No">GST No. / जीएसटी संख्या <font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm {{$click}}" name="GST_No" id="GST_No" placeholder="Enter GST No." maxlength="15" value="{{$vendor_data[0]['GST No_'] ?? $gst_value}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};" onkeypress="return isAlphaNumeric(event)" readonly="readonly">
                                    <span class="gstvalidationMsg"></span>
                                    <span class="validcheck"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="PM_Agency_Name">Agency Name / एजेंसी का नाम<font color="red">*
                                        </font></label>
                                    <input type="text" name="PM_Agency_Name" class="form-control form-control-sm" placeholder="Enter Agency Name" id="PM_Agency_Name" value="{{$vendor_data[0]['PM Agency Name'] ?? ''}}" {{ $disabled }} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tin_tan_vat_no">TIN/TAN / टिन/टैन</label>
                                    <input type="text" class="form-control form-control-sm" name="TIN_TAN_VAT_No" id="tin_tan_vat_no" placeholder="Enter TIN/TAN (if applicable)" maxlength="15" onkeypress="return isAlphaNumeric(event)" value="{{$vendor_data[0]['TIN_TAN_VAT No_'] ?? ''}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tin_tan_vat_no">Any other relevant information / कोई
                                        अन्य प्रासंगिक जानकारी</label>
                                    <input type="text" class="form-control form-control-sm" name="Other_Relevant_Information" id="tin_tan_vat_no" placeholder="Enter Any other relevant information" maxlength="80" value="{{$vendor_data[0]['Other Relevant Information'] ?? ''}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <h4 class="subheading">Head Office / प्रधान कार्यालय :-</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address">Address / पता<font color="red">*</font></label>
                                    <textarea type="text" name="HO_Address" id="address1" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">{{$vendor_data[0]['HO Address']??''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="landline_no">Landline No. / लैंडलाइन नंबर<font color="red"></font>
                                    </label>
                                    <input type="text" name="HO_Landline_No" id="landline_no" placeholder="Enter Landline No." class="form-control form-control-sm" id="landline_head_office" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{$vendor_data[0]['HO Landline No_']??''}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email_1">E-mail. / ईमेल<font color="red">*</font></label>
                                    <input type="text" name="HO_Email" placeholder="Enter E-mail" class="form-control form-control-sm" id="HO_Email" value="{{$vendor_data[0]['HO E-Mail']??''}}" {{$disabled}} maxlength="50" onkeyup="return checkUniqueVendor('email', this.value)" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    <span id="v_alert_email" style="color:red;display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="HO_Mobile_No">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm" id="HO_Mobile_No" name="HO_Mobile_No" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10" value="{{$vendor_data[0]['HO Mobile No_']??''}}" onkeyup="return checkUniqueVendor('mobile', this.value)" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    <span id="v_alert_mobile" style="color:red;display: none;"></span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row col-md-12">
                            <div class="row col-md-6">
                                <h4 class="subheading">Branch Office (if any) / शाखा कार्यालय (यदि कोई हो) :-</h4>
                            </div>
                            <div class="row col-md-4">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input h5" name="boradio" value="1" {{$branchcheckyes}}> Yes &nbsp;
                                        <input type="radio" class="form-check-input h5" name="boradio" value="0" {{$branchcheckno}}>No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div id="radio" style="display: {{$branchdisplayform}};">
                            @forelse($branch as $key => $branches)
                            @if(($key - 1) >= 0)
                             <hr id="hrline_radio_{{$key}}">
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Name">State / राज्य<font color="red">*</font></label>
                                        <p>
                                            <select id="owner_state0" name="BO_state[]" class="form-control form-control-sm call_district" data="owner_district{{$key}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                                                <option value="">Select State</option>
                                                @if(count($states) > 0)
                                                @foreach($states as $statesData)
                                                <option value="{{ $statesData['Code'] }}" {{@$branches->State == $statesData['Code'] ? 'selected' : ''}}>
                                                    {{$statesData['Description']}}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address / पता <font color="red">*</font></label>
                                        <textarea {{$disabled}} type="text" name="BO_Address[]" id="BO_Address maxlength=" 120" placeholder="Enter Address" rows="1" class="form-control form-control-sm" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">{{$branches->{'BO Address'} ??''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red"></font>
                                        </label>
                                        <input type="text" name="BO_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="bo_landline_no" maxlength="14" onkeypress="return onlyNumberKey(event)" value="{{$branches->{'BO Landline No_'} ??''}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">E-mail / ईमेल <font color="red">*</font></label>
                                        <input type="text" name="BO_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" maxlength="30" v{{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';" value="{{$branches->{'BO E-Mail'} ??''}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
                                        <input type="text" name="BO_Mobile[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10" value="{{$branches->{'BO Mobile No_'} ??''}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Name">State / राज्य<font color="red">*</font></label>
                                        <p>
                                            <select id="owner_state0" name="BO_state[]" class="form-control form-control-sm call_district" data="owner_district{{$key}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                                                <option value="">Select State</option>
                                                @if(count($states) > 0)
                                                @foreach($states as $statesData)
                                                <option value="{{ $statesData['Code'] }}">
                                                    {{$statesData['Description']}}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address / पता <font color="red">*</font></label>
                                        <textarea {{$disabled}} type="text" name="BO_Address[]" id="BO_Address" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red"></font>
                                        </label>
                                        <input type="text" name="BO_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="bo_landline_no" maxlength="14" onkeypress="return onlyNumberKey(event)" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">E-mail / ईमेल <font color="red">*</font></label>
                                        <input type="text" name="BO_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" maxlength="30" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
                                        <input type="text" name="BO_Mobile[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                            </div>
                            @endforelse
                            
                        </div>
                            <!-- For Add function 8-Feb -->
                            <div class="row" style="float:right;margin-top: 6px;margin-right: 0px;" id="addid">
                                <input type="hidden" name="count_branch_id" id="count_branch_id" value="{{$key ?? 0}}">
                                <a class="btn btn-primary" id="add_branch" style="pointer-events: {{$pointer}}; display: {{$show}};font-size: 13px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                            </div>
                            <!-- For Add function 8-Feb end -->
                        <div class="row col-md-12">
                            <div class="row col-md-6">
                                <h4 class="subheading">Authorized Representative / अधिकृत प्रतिनिधि :-</h4>
                            </div>
                        </div>                      

                        <div id="radioar">
                            @forelse($authorize as $key => $auth)
                            @if(($key - 1) >= 0)
                             <hr id="hrline_authorized_{{$key}}">
                            @endif
                            <div class="row" id="auth_detail">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Contact Person / संपर्क व्यक्ति <font color="red">*</font>
                                        </label>
                                        <textarea {{$disabled}} type="text" name="Authorized_Rep_Name[]" placeholder="Enter Contact Person" rows="1" class="form-control form-control-sm" maxlength="40" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';" onkeypress="return onlyAlphabets(event)">{{$auth->{'AR Name'} ??''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address / पता <font color="red">*</font></label>
                                        <textarea {{$disabled}} type="text" name="AR_Address[]" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">{{$auth->{'AR Address'} ??''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red"></font>
                                        </label>
                                        <input type="text" name="AR_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="landline_no" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$auth->{'AR Phone No_'} ??''}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">E-mail. / ईमेल <font color="red">*</font></label>
                                        <input type="text" name="AR_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" maxlength="30" value="{{$auth->{'AR Email'} ??''}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
                                        <input type="text" name="AR_Mobile_No[]" placeholder="Enter Mobile No." class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10" value="{{$auth->{'AR Mobile'} ??''}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile"> Alternate Mobile No. / वैकल्पिक मोबाइल नंबर <font color="red"></font></label>
                                        <input type="text" name="altername_mobile[]" placeholder="Enter Alternate Mobile No." class="form-control form-control-sm" id="altername_mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10" value="{{$auth->{'Alternate Mobile No_'} ??''}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="row" id="auth_detail">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Contact Person / संपर्क व्यक्ति <font color="red">*</font>
                                        </label>
                                        <textarea {{$disabled}} type="text" name="Authorized_Rep_Name[]" placeholder="Enter Contact Person" rows="1" class="form-control form-control-sm" maxlength="40" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';" onkeypress="return onlyAlphabets(event)"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address / पता <font color="red">*</font></label>
                                        <textarea {{$disabled}} type="text" name="AR_Address[]" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red"></font>
                                        </label>
                                        <input type="text" name="AR_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="landline_no" onkeypress="return onlyNumberKey(event)" maxlength="14" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">E-mail. / ईमेल <font color="red">*</font></label>
                                        <input type="text" name="AR_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" maxlength="30" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
                                        <input type="text" name="AR_Mobile_No[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile"> Alternate Mobile No. / वैकल्पिक मोबाइल नंबर <font color="red"></font></label>
                                        <input type="text" name="altername_mobile[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="altername_mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>
                        <!-- For Add function 8-Feb -->
                        <div class="row" style="float:right;margin-top: 6px;margin-right: 0px;">
                            <input type="hidden" name="count_id" id="countID" value="{{$key ?? 0}}">
                            <a class="btn btn-primary {{$disabled}}" id="add_Auth" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}}; display: {{$show}};font-size: 13px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                        </div>
                        <!-- For Add function 8-Feb end -->
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
                                    <input type="text" name="Authority_Which_granted_Media" placeholder="Enter Authority Which Granted Media With Address" class="form-control form-control-sm" id="authority" maxlength="120" value="{{$vendor_data[0]['Authority Which granted Media']??''}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4"><br>
                                <div class="form-group">
                                    <label for="Contract_No">Contract No. / अनुबंध क्रमांक<font color="red">*</font>
                                    </label>
                                    <input type="text" name="Contract_No" placeholder="Enter Contract Number" onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm" id="Contract_No" maxlength="13" value="{{$vendor_data[0]['Contract No_']??''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4"><br>
                                <div class="form-group">
                                    <label for="License_Fee">License Fee / लाइसेंस शुल्क<font color="red">*
                                        </font></label>
                                    <input type="text" name="License_Fee" id="license_fee" placeholder="Enter License Fee" onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm" maxlength="8" value="{{ @$vendor_data[0]['License Fees'] ? round(@$vendor_data[0]['License Fees'],2) : ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_from">License start date / लाइसेंस शुरू होने
                                        की दिनांक<font color="red">*</font></label>
                                    <input type="date" name="License_From" maxlength="10" id="txt_from" maxlength="10" placeholder="DD/MM/YYYY" class="form-control form-control-sm" value="{{ @$vendor_data[0]['License From'] ? date('Y-m-d', strtotime(@$vendor_data[0]['License From'])) : ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    <span id="date_error" style="color:red;display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_to">License end date / लाइसेंस समाप्ति दिनांक
                                        <font color="red">*</font>
                                    </label>
                                    <input type="date" name="License_To" maxlength="10" id="txt_to" maxlength="10" placeholder="DD/MM/YYYY" class="form-control form-control-sm" value="{{ @$vendor_data[0]['License To'] ? date('Y-m-d', strtotime(@$vendor_data[0]['License To'])) : ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    <span id="date_error" style="color:red;display: none;"></span>
                                </div>
                            </div>
                        </div><br>
                        <div class="row col-md-12">
                            <h4 class="subheading">Media Address / मीडिया पता:-</h4>
                        </div><br>
                        @include('admin.pages.soleright.comman-media')
                        
                        <div class="row col-md-12">
                            <h4 class="subheading">Details of work in last six months, for the applied media only, if
                                any (As per format given below) <br>केवल आवेदन मीडिया के लिए पिछले छह महीनों में कार्य का विवरण, यदि कोई हो (नीचे दिए गए प्रारूप के अनुसार) :-</h4>
                        </div><br>

                        <div class="row" style="display: {{$show}};">
                            <div class="col-md-6">
                                <h6>If you want to import through XLS <a href="{{asset('uploads/work_done_excel.xlsx')}}" target="_blank">Download Sample File</a></h6>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" name="xls2" id="xlxyes2" value="1" class="xls2"> Yes &nbsp;
                                <input type="radio" name="xls2" id="xlxno2" value="0" class="xls2" checked="checked"> No
                            </div>
                        </div><br><br>
                        <div class="row" id="xls_show2" style="display: none;">
                            <div class="col-md-4">
                                <input type="file" name="media_import2" class="form-control form-control-sm" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            </div>
                        </div>
                        @php
                        $dd_line =[];
                        $i=0;
                        @endphp
                        <div id="details_of_work_done">
                            @foreach($OD_work_dones as $key => $work_done_data)
                            @if(($key - 1) >= 0)
                             <hr id="hrline_workdone_{{$key}}">
                            @endif
                            <div class="row" id="workid{{$key}}">
                                <div class="col-md-4"><br>
                                    <div class="form-group">
                                        <label for="year">Year / वर्ष<font color="red">*</font></label>
                                        <p>
                                            <select name="ODMFO_Year[]" id="Years{{$key}}" class="form-control form-control-sm ddlYears" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                                                @if(@$work_done_data['Year'] == '')
                                                <option value="">Select Year</option>
                                                @else
                                                <option value="{{ $work_done_data['Year'] }}">
                                                    {{ $work_done_data['Year'] }}
                                                </option>
                                                @endif
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="quantity_duration">Quantity of Display or Duration /
                                            प्रदर्शन या अवधि की मात्रा<font color="red">*</font></label>
                                        <p>
                                            <input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" id="quantity_duration{{$key}}" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm" maxlength="8" onkeypress="return onlyNumberKey(event)" value="{{$work_done_data['Qty Of Display_Duration'] ?? ''}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                        </p>
                                        <input type="hidden" value="{{$work_done_data['Line No_'] ?? ''}}" name="line_no[]">
                                    </div>
                                </div>
                                <div class="col-md-4"><br>
                                    <div class="form-group">
                                        <label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि
                                            (रु)<font color="red">*</font></label>
                                        @php
                                        if(@$work_done_data['Billing Amount'] == 0)
                                        {
                                        $work_done_data1 = '';
                                        }
                                        else
                                        {
                                        $work_done_data1 = round(@$work_done_data['Billing Amount'],2);
                                        }
                                        @endphp
                                        <p>
                                            <input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount{{$key}}" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8" value="{{$work_done_data1}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>From Date / की दिनांक से<font color="red">*</font></label>
                                        <p>
                                            <input type="date" name="from_date[]" maxlength="10" id="from_date{{$key}}" value="{{ (!empty(@$work_done_data['From Date']) && @$work_done_data['From Date'] != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$work_done_data['From Date'])) : ''}}" class="form-control form-control-sm" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>To Date / दिनांक तक :<font color="red">*</font></label>
                                        <p>
                                            <input type="date" name="to_date[]" maxlength="10" id="to_date{{$key}}" value="{{ (!empty(@$work_done_data['To Date']) && @$work_done_data['To Date'] != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$work_done_data['To Date'])) : ''}}" class="form-control form-control-sm" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                    <div class="col-md-10"></div>
                                    <div class="col-md-2" style="display: {{$key==0 ? 'none' :'block'}}; padding: 2% 0 0 6%;"><button class="btn btn-danger remove_row_next" data="{{$key}}" data-hide="workid{{$key}}" style="display: {{$show}};font-size: 13px;"><i class="fa fa-minus"></i> Remove</button>
                                        <input type="hidden" value="{{$work_done_data['Line No_'] ?? ''}}" name="line_no" id="line_no_{{$key}}">
                                        <input type="hidden" value="{{$work_done_data['OD Media ID'] ?? ''}}" name="odmedia_id" id="odmedia_id_{{$key}}">
                                    </div>
                                </div>
                            @php
                            if(@$work_done_data['Line No_']) {
                            $dd_line[] = $work_done_data['Line No_'];
                            }
                            $exline2=implode(',',$dd_line);
                            $i++;
                            @endphp
                            @endforeach
                        </div>

                        <input type="hidden" name="lineno2" id="lineno2" value="{{$exline2 ?? ''}}">
                        <div class="row" style="float:right;margin: 6px 0 0 0;">
                            <input type="hidden" name="count_i" value="{{$key ?? 0}}" id="count_i">
                            <a class="btn btn-primary {{$disabled}}" id="add_row_next" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}}; display: {{$show}};font-size: 13px;"><i class="fa fa-plus" aria-hidden="true"></i>
                                Add New</a>
                        </div><br><br>

                        <!-- remove file upload from work done section and put here 10-Feb -->
                        <div class="row">
                            <div class="col-md-4">
                                @if(@$vendor_data[0]['File Name']=="")
                                <div class="form-group">
                                    <label for="exampleInputFile">Upload Document / दस्तावेज़ अपलोड करें {{ @$vendor_data[0]['File Name'] }}
                                        <font color="red">*</font>
                                    </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="file_name" class="custom-file-input" id="file_name">
                                            <label class="custom-file-label" id="file_name2" for="file_name">Choose file</label>
                                        </div>
                                        @if(@$vendor_data[0]['File Name'] != '')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['File Name'] }}" target="_blank">View</a></span>
                                        </div>
                                        @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="file_name3">Upload</span>
                                        </div>
                                        @endif
                                    </div>
                                    <span id="file_name1" class="error invalid-feedback"></span>
                                </div>
                                @else
                                <div class="form-group">
                                    <label for="exampleInputFile">Upload Document / दस्तावेज़ अपलोड करें <font color="red">*</font></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="file_name_modify" class="custom-file-input {{$click}}" id="file_name_modify" {{$disabled}}>
                                            <label class="custom-file-label" id="file_name_modify2" for="file_name_modify">{{@$vendor_data[0]['File Name'] ?? 'Choose file' }}</label>
                                        </div>
                                        @if(@$vendor_data[0]['File Name'] != '')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['File Name'] }}" target="_blank">View</a></span>
                                        </div>
                                        @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="file_name_modify3">Upload</span>
                                        </div>
                                        @endif
                                    </div>
                                    <span id="file_name_modify1" class="error invalid-feedback"></span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <input type="hidden" name="vendorid_tab_2" id="vendorid_tab_2" value="{{$media_owner_details[0]['OD Media ID'] ?? ''}}">
                        <input type="hidden" name="next_tab_2" id="next_tab_2" value="0">
                        <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i>
                            Previous</a>
                        <a class="btn btn-primary pm-next-button" id="tab_2">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                    </div>
                    <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">

                        <div class="row" id="neft_div">
                            <div class="col-md-12" style="display: flex;">
                                <h4 class="subheading">NEFT Details / एनईएफटी विवरण :-</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pan_no">Pan No. / पैन नंबर<font color="red">*</font>
                                    </label>
                                    <input type="text" name="PAN" id="pan_card" class="form-control form-control-sm" placeholder="Enter Pan No." maxlength="10" value="{{$vendor_data[0]['PAN'] ?? ''}}" {{ $disabled }} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    <span id="PAN_No_Error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ifsc_code">IFSC Code / आई एफ एस सी कोड<font color="red">*</font>
                                    </label>
                                    <input type="text" name="IFSC_Code" id="ifsc_code" class="form-control form-control-sm" placeholder="Enter IFSC Code" maxlength="11" value="{{$vendor_data[0]['IFSC Code'] ?? ''}}" {{ $disabled }} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    <span id="IFSC_code_Error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name / बैंक का नाम<font color="red">
                                            *</font></label>
                                    <input type="text" name="Bank_Name" id="bank_name_22" class="form-control form-control-sm" placeholder="Enter Bank Name" maxlength="30" onkeypress="return onlyAlphabets(event)" value="{{$vendor_data[0]['Bank Name'] ?? ''}}" {{ $disabled }} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch">Branch / शाखा<font color="red">*</font>
                                    </label>
                                    <input type="text" name="Bank_Branch" id="branch_22" class="form-control form-control-sm" placeholder="Enter branch" maxlength="30" value="{{$vendor_data[0]['Bank Branch'] ?? ''}}" {{ $disabled }} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_no">Account No. / खाता नंबर<font color="red">*</font></label>
                                    <input type="text" name="Account_No" id="account_no" class="form-control form-control-sm" placeholder="Enter Account no" onkeypress="return onlyNumberKey(event)" maxlength="20" value="{{$vendor_data[0]['Account No_'] ?? ''}}" {{ $disabled }} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <br>
                                <!-- <a href="#" class="btn btn-info" style="float: right;">Online Payment</a> -->
                            </div>
                        </div>
                        <div class="row" id="payment_mode3" style="display:none;">
                        </div>
                        <input type="hidden" name="vendorid_tab_3" id="vendorid_tab_3" value="{{@$vendor_data[0]['OD Media ID'] ?? ''}}">
                        <input type="hidden" name="next_tab_3" id="next_tab_3" value="0">
                        <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i>
                            Previous</a>
                        <a class="btn btn-primary pm-next-button" id="tab_3">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                    </div>

                    <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                    <div class="row">
                        @if(@$vendor_data[0]['Legal Doc File Name']=="")
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile">Upload document of legal status of company
                                / कंपनी की कानूनी स्थिति का दस्तावेज अपलोड करें <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Legal_Doc_File_Name" class="custom-file-input" id="Legal_Doc_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" id="Legal_Doc_File_Name2" for="Legal_Doc_File_Name">
                                        Choose file
                                    </label>
                                </div>
                                @if(@$vendor_data[0]['Legal Doc File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <a href="{{ url('/uploads') }}/sole-right-media/{{ $vendor_data[0]['Legal Doc File Name'] }}" target="_blank">View</a>
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
                        </div>
                        @else
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile">Upload document of legal status of company
                                / कंपनी की कानूनी स्थिति का दस्तावेज अपलोड करें <font color="red">*</font></label>

                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Legal_Doc_File_Name_modify" class="custom-file-input {{$click}}" id="Legal_Doc_File_Name">
                                    <label class="custom-file-label" id="Legal_Doc_File_Name2" for="Legal_Doc_File_Name">
                                        {{@$vendor_data[0]['Legal Doc File Name'] ?? 'Choose file' }}
                                    </label>
                                </div>
                                @if(@$vendor_data[0]['Legal Doc File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Legal Doc File Name'] }}" target="_blank">View</a>
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
                        </div>
                        @endif

                        @if(@$vendor_data[0]['PAN File Name']=="")
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile">Attach copy of Pan Number and
                                authorization of Bank for NEFT payment / एनईएफटी भुगतान के लिए पैन
                                नंबर और बैंक के प्राधिकरण की प्रति संलग्न करें <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Attach_Copy_Of_Pan_Number_File_Name" class="custom-file-input" id="Attach_Copy_Of_Pan_Number_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" id="Attach_Copy_Of_Pan_Number_File_Name2" for="Attach_Copy_Of_Pan_Number_File_Name">Choose
                                        file</label>
                                </div>
                                @if(@$vendor_data[0]['PAN File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['PAN File Name'] }}" target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text" id="Attach_Copy_Of_Pan_Number_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="Attach_Copy_Of_Pan_Number_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        </div>
                        @else
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile">Attach copy of Pan Number and
                                authorization of Bank for NEFT payment / एनईएफटी भुगतान के लिए पैन
                                नंबर और बैंक के प्राधिकरण की प्रति संलग्न करें <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Attach_Copy_Of_Pan_Number_File_Name_modify" class="custom-file-input {{$click}}" id="Attach_Copy_Of_Pan_Number_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" id="Attach_Copy_Of_Pan_Number_File_Name2" for="Attach_Copy_Of_Pan_Number_File_Name">{{@$vendor_data[0]['PAN File Name'] ?? 'Choose file' }}</label>
                                </div>
                                @if(@$vendor_data[0]['PAN File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['PAN File Name'] }}" target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text" id="Attach_Copy_Of_Pan_Number_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="Attach_Copy_Of_Pan_Number_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        </div>
                        @endif

                        @if(@$vendor_data[0]['Affidavit File Name']=="")
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile">Submit an affidavit on stamp paper stating
                                on oath that the details submitted by you on performa are true and
                                correct.Mention the application no. in affidavit / स्टाम्प पेपर पर
                                शपथ पत्र पर प्रस्तुत करें कि आपके द्वारा प्रस्तुत किए गए
                                विवरण सत्य और सही हैं। आवेदन संख्या का उल्लेख करें। हलफनामे
                                में <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Affidavit_File_Name" class="custom-file-input" id="Affidavit_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" id="Affidavit_File_Name2" for="Affidavit_File_Name">Choose file</label>
                                </div>
                                @if(@$vendor_data[0]['Affidavit File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Affidavit File Name'] }}" target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text" id="Affidavit_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="Affidavit_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        </div>
                        @else
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile">Submit an affidavit on stamp paper stating
                                on oath that the details submitted by you on performa are true and
                                correct.Mention the application no. in affidavit / स्टाम्प पेपर पर
                                शपथ पत्र पर प्रस्तुत करें कि आपके द्वारा प्रस्तुत किए गए
                                विवरण सत्य और सही हैं। आवेदन संख्या का उल्लेख करें। हलफनामे
                                में <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Affidavit_File_Name_modify" class="custom-file-input {{$click}}" id="Affidavit_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" id="Affidavit_File_Name2" for="Affidavit_File_Name">{{@$vendor_data[0]['Affidavit File Name'] ?? 'Choose file' }}</label>
                                </div>
                                @if(@$vendor_data[0]['Affidavit File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Affidavit File Name'] }}" target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text" id="Affidavit_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="Affidavit_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        </div>
                        @endif

                        @if(@$vendor_data[0]['GST File Name']=="")
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile">GST registration Certificate / जीएसटी
                                पंजीकरण प्रमाणपत्र<font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="GST_File_Name" class="custom-file-input" id="GST_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" id="GST_File_Name2" for="GST_File_Name">Choose file</label>
                                </div>
                                @if(@$vendor_data[0]['GST File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['GST File Name'] }}" target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text" id="GST_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="GST_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        </div>
                        @else
                        <div class="col-md-6"><br><br><br>
                        <div class="form-group">
                            <label for="exampleInputFile">GST registration Certificate / जीएसटी
                                पंजीकरण प्रमाणपत्र <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="GST_File_Name_modify" class="custom-file-input {{$click}}" id="GST_File_Name_modify" {{$disabled}}>
                                    <label class="custom-file-label" id="GST_File_Name_modify2" for="GST_File_Name_modify">{{@$vendor_data[0]['GST File Name'] ?? 'Choose file' }}</label>
                                </div>
                                @if(@$vendor_data[0]['GST File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['GST File Name'] }}" target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text" id="GST_File_Name_modify3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="GST_File_Name_modify1" class="error invalid-feedback"></span>
                        </div>
                        </div>
                        @endif
                        <!-- checkbox -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" name="self_declaration" id="self_declaration" {{ @$vendor_data[0]['Self-declaration'] == 1 ? "checked" : "" }} {{$disabled}} class="{{$click}}">
                                    <label for="self_declaration">Self declaration / स्वयं
                                        घोषित <font color="red">*</font></label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="odmedia_id" id="odmedia_id" value="{{@$vendor_data[0]['OD Media ID'] ?? ''}}">
                        <input type="hidden" name="doc[]" id="doc_data">
                        <input type="hidden" name="submit_btn" id="submit_btn" value="0">
                        <input type="hidden" name="vendorid_tab_4" value="{{@$vendor_data[0]['OD Media ID'] ?? ''}}">
                        <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i>
                            Previous</a>&nbsp;
                        <input type="hidden" name="od_media_id" value="{{$media_id}}">

                        @if(@$vendor_data[0]['Modification']!=1)
                        <a class="btn btn-primary pm-next-button" id='file'><i class="fa fa-arrow-circle-right fa-lg" id="tab_4"></i>Next</a>
                        @else
                        <a class="btn btn-primary pm-next-button" id='file2'><i class="fa fa-paper-plane" aria-hidden="true"></i>
                            Next</a>@endif
                        <!--<button type="submit" id="sub_btn" class="btn btn-primary" onclick="nextSaveData('submit_btn');">Submit</button>
                        -->
                    </div>
                    </div>
                    <div id="tab5" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">

                        @if(Session::has('od_message1'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{Session::get('od_message1') }}
                        </div>
                        @endif

                        @if(@count($latlongData) == 0)
                        <div class="card bg-light text-dark w-75">
                            <h6 class="text-center">Please submit location data through app</h6>
                            <a href="#" class="card-link text-center">App link</a>
                        </div>
                        <!-- loop start -->
                        @else
                        @foreach($latlongData as $key=>$latlong)
                        <div class="row">
                            <div class="col-md-12">
                                <p>Property :- <?= $key + 1; ?></p>
                            </div><br>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <p>{{$latlong->Latitude}}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <p>{{$latlong->Longitude}}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Image</label><br>
                                    <p> <img src="{{ 'https://pingtrack.azurewebsites.net/public/uploads/sole-right-media/'.$latlong->{ 'Image File Name'}   }}" name="image" alt="img" target="_blank" width="60" height="60"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Far Image</label><br>
                                    <p> <img src="{{ 'https://pingtrack.azurewebsites.net/public/uploads/sole-right-media/'.$latlong->{ 'Far Image File Name'}   }}" name="image" alt="img" target="_blank" width="60" height="60"></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="longitude">City</label>
                                    <p>{{$latlong->City}}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="longitude">Tag Name</label>
                                    <p>{{$latlong->{'Tag Name'} }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="remark">Remarks</label>
                                    <p>{{$latlong->Remarks}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <!-- Loop end -->
                        <input type="hidden" name="next_tab_4" id="next_tab_4" value="0">
                        <br>
                        <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i>
                            Previous</a>

                        @if(count(@$latlongData1)>0)
                        <!-- a class="btn btn-primary pm-next-button" id="tab_2">Next <i
                                class="fa fa-arrow-circle-right fa-lg"></i></a> -->
                        @else
                        <!-- <a class="btn btn-primary pm-next-button" id="tab_2" style="pointer-events: none">Next <i
                                class="fa fa-arrow-circle-right fa-lg"></i></a> -->
                        @endif
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
<script src="{{ url('/js') }}/validator.js"></script>
<script src="{{ url('/js') }}/sole-right-validation.js"></script>
<script src="{{ url('/js') }}/sole-right-comman.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    //  next and previous function for save
    function nextSaveData(id) {
        @if(@$vendor_data[0]['Modification'] == '1')
        return false;
        @endif
        if ($("#" + id).val() == 0) {
            $("#" + id).val(1);
            if (id == "next_tab_2") {
                $("#next_tab_1").val(0);
            } else if (id == "next_tab_3") {
                // $("#next_tab_1").val(0);
                $("#next_tab_2").val(0);
            } else if (id == "submit_btn") {
                //console.log(id);
                $("#next_tab_3").val(0);
            }
        }
        if (id != "next_tab_4") {
            var data = new FormData($("#sole_right_media")[0]);
            $.ajax({
                type: 'POST',
                url: "{{Route('saveSoleMedia')}}",
                data: data,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                //autoUpload: true,

                success: function(data) {
                    if (data.success == true) {
                        if (id == 'next_tab_1') {
                            console.log(data['data']);
                            $("#ownerid").val(data.data);
                        } else {

                            $("#vendorid_tab_2").val(data.data['unique_id']);
                            $("#lineno1").val(data.data['lineno1']);
                            $("#lineno2").val(data.data['lineno2']);
                            $("#vendorid_tab_3").val(data.data);
                            $("#vendorid_tab_4").val(data.data[0]);
                            if (id == "submit_btn") {
                                $('.alert-success').fadeIn().html(data.message);

                            }
                        }
                    }
                },
                error: function(error) {
                    console.log('error');
                }
            });
        } else {
            console.log('Property Details');
        }
    }


    //add more for branch 9-feb
    $(document).ready(function() {
        $("#add_branch").click(function() {
            var i = $("#count_branch_id").val();
            i++;
            var append = '<hr id="hrline_radio_' + i + '"><div class="row" id="row' + i + '"><div class="col-md-4"><div class="form-group"><label for="Name">State / राज्य<font color="red">*</font></label><p><select id="owner_state0" name="BO_state[]" class="form-control form-control-sm call_district" data="owner_district' + i + '"><option value="">Select State</option>@if(count($states) > 0)@foreach($states as $statesData)<option value="{{ $statesData['Code'] }}">{{$statesData['Description']}}</option>@endforeach @endif </select></p></div></div><div class="col-md-4"><div class="form-group"><label for="address">Address / पता <font color="red">*</font></label><textarea  type="text" name="BO_Address[]" id="BO_Address' + i + '" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm"></textarea></div></div><div class="col-md-4"><div class="form-group"><label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red"></font></label><input type="text" name="BO_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="bo_landline_no' + i + '" maxlength="14" onkeypress="return onlyNumberKey(event)"></div></div><div class="col-md-4"><div class="form-group"><label for="email">E-mail. / ईमेल <font color="red">*</font></label><input type="text" name="BO_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="email' + i + '" maxlength="30"></div></div><div class="col-md-4"><div class="form-group"><label for="mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label><input type="text" name="BO_Mobile[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile' + i + '" onkeypress="return onlyNumberKey(event)" maxlength="10"></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding: 2% 0 0 6%;"><button class="btn btn-danger remove_branch_row" id="' + i + '" style="font-size: 13px;"><i class="fa fa-minus"></i> Remove</button></div></div>';
            $("#radio").append(append);
            $("#count_branch_id").val(i);
        });
        $(document).on('click', '.remove_branch_row', function(e) {
            e.preventDefault();
            var id = $(this).attr('id');
            $("#hrline_radio_"+id).remove();
            $("#row" + id).remove();
            var add_count = $("#count_branch_id").val();
            $("#count_branch_id").val(add_count - 1);
        });
    });
</script>

@endsection