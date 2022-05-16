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
$OD_media_address_data= !empty($OD_media_address_data) ? $OD_media_address_data : [1];
$gst_value = Session::get('Gst');

$readonly = ' ';
$disabled = ' ';
$checked = ' ';
$Self_Dec='';
$media_id =@$vendor_data[0]['OD Media ID'];
// if(@$vendor_data[0]['OD Media Temp ID'] != ''){
// $disabled = 'readonly';
// $readonly = 'readonly';
// $checked = 'checked';
// $Self_Dec = @$vendor_data[0]['Self-declaration'] == 1 ? "checked" : "";
// }
@endphp


@php
$read='';
$tab='';
$pointer='';
$click='';
$show="";

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
$show="none";
if(!empty($branch) && @$branch[0]->State !=''){
$branchcheckyes = 'checked';
$branchcheckno = '';
$branchdisplayform = 'block';
$show="";
}
@endphp

@php 

// if(@$vendor_data[0]['Modification']=='null' || @$vendor_data[0]['Modification']==null)
// {
//     $read='readonly';
//     $click='preventLeftClick';
//     $show="none";
// }
if($username=='')
{
    $read='readonly';
    $click='preventLeftClick';
    $show="none";    
}
@endphp


<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Company Details</h6>
        </div>
        @if(Session::has('success'))    
        <div class="alert alert-success">
            <strong>Success!</strong> {{ Session('success') }}
        </div>
        @endif

        @if(Session::has('not_exist'))
        <div class="alert alert-warning">
            <strong>Error!</strong> {{ Session('not_exist') }} !! Click Here For Enpanelement   <a href="/sole-right-media" style="color: red;">Click</a>
        </div>
        @endif
        <!-- Card Body -->
        <div class="card-body">
            <div align="center" class="alert alert-success" id="show_msg2" style="display: none;"></div>
            <div align="center" class="alert alert-danger" style="display: none;"></div>
            <form method="post" action="/sole-basic-detail-update" enctype="multipart/form-data" id="sole_basic_detail">
                @csrf
                
                <div class="tab-content">
                    <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
                        <div class="row col-md-12">
                            <h4 class="subheading">Owner Detail / मालिक का विवरण :-</h4>
                        </div>
                        <div id="details_of_owner">
                            @foreach($owner_data as $key => $ownerlist)

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="owner_name">Owner Name / मालिक का नाम <font color="red">*</font>
                                        </label>
                                        <p>
                                            <input type="text" name="owner_name" id="owner_name{{$key}}" placeholder="Enter Owner name" class="form-control form-control-sm owner_name" onkeypress="return onlyAlphabets(event,this);" maxlength="40" value="{{$ownerlist['Owner Name']?? ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">E-mail ID / ई मेल आईडी<font color="red">*</font></label>
                                        <p>
                                            <input type="email" class="form-control form-control-sm owner_email" id="owner_email{{$key}}" name="owner_email" maxlength="50" placeholder="Enter Email ID" value="{{$ownerlist['Email ID']?? ''}}" onkeyup="return checkUniqueOwnerSoleRight(this, this.value,0)" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                            <span id="alert_owner_email0" style="color:red;display: none;"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                                        <p>
                                            <input type="text" name="owner_mobile" id="owner_mobile{{$key}}" maxlength="10" minlength="10" placeholder="Enter Mobile" class="form-control form-control-sm input-imperial owner_mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$ownerlist['Mobile No_']?? ''}}" onkeyup="return checkUniqueOwnerSoleRight(this, this.value,0)" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                            <span id="alert_owner_mobile0" style="color:red;display: none;"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address / पता<font color="red">*</font></label>
                                        <p>
                                            <textarea type="text" name="address" id="owner_address{{$key}}" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm owner_address" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">{{$ownerlist['Address 1']?? ''}}</textarea>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Name">State / राज्य<font color="red">*</font></label>
                                        <p>
                                            <select id="owner_state0" name="state" class="form-control form-control-sm call_district owner_state" data="owner_district{{$key}}" cityid="owner_city{{$key}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
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
                                            <select id="owner_district{{$key}}" name="district" class="form-control form-control-sm owner_district" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
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
                                            <select id="owner_city{{$key}}" name="city" class="form-control form-control-sm owner_city" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
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
                                        <input type="text" name="phone" id="owner_phone{{$key}}" maxlength="14" onkeypress="return onlyNumberKey(event)" placeholder="Enter Phone No" class="form-control form-control-sm input-imperial owner_phone" value="{{$ownerlist['Phone No_']?? ''}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
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

                        <div class="row col-md-12">
                            <h4 class="subheading">Details of GST / जीएसटी का विवरण :-</h4>
                        </div>
                        <input type="hidden" name="odmediaid" value="{{$vendor_data[0]['OD Media ID'] ?? ''}}">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- $vendor_data[0]['GST No_'] ?? ''  -->
                                <div class="form-group">
                                    <label for="GST_No">GST No. / जीएसटी संख्या <font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm {{$click}}" name="GST_No" id="GST_No" placeholder="Enter GST No." maxlength="15" value="{{$vendor_data[0]['GST No_'] ?? $gst_value}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};" onkeypress="return isAlphaNumeric(event)">
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
                        </div><br>
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
                            <br>
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
                            <a class="btn btn-primary {{$disabled}}" id="add_Auth" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}}; font-size: 13px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                        </div><br><br><br>
                        <!--  here remove include file -->
                        

                        <input type="hidden" name="vendorid_tab_2" id="vendorid_tab_2" value="{{$media_owner_details[0]['OD Media ID'] ?? ''}}">

                        <div class="row">
                            @if(@$vendor_data[0]['Legal Doc File Name']=="")
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile">Upload document of legal status of company
                                    / कंपनी की कानूनी स्थिति का दस्तावेज अपलोड करें <font color="red">*</font></label>
                                <div class="input-group">
                                    <div class="custom-file"> {{ $click }}
                                        <input type="file" name="Legal_Doc_File_Name" class="custom-file-input {{ $click }}" id="Legal_Doc_File_Name" {{$disabled}}>
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
                                        <input type="file" name="Attach_Copy_Of_Pan_Number_File_Name" class="custom-file-input {{ $click }}" id="Attach_Copy_Of_Pan_Number_File_Name" {{$disabled}}>
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
    
                            
    
                            @if(@$vendor_data[0]['GST File Name']=="")
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile">GST registration Certificate / जीएसटी
                                    पंजीकरण प्रमाणपत्र<font color="red">*</font></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="GST_File_Name" class="custom-file-input {{ $click }}" id="GST_File_Name" {{$disabled}}>
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
                            <div class="col-md-6">
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
                            
                            <input type="hidden" name="odmedia_id" id="odmedia_id" value="{{@$vendor_data[0]['OD Media ID'] ?? ''}}">
                            <input type="hidden" name="doc[]" id="doc_data">
                            <input type="hidden" name="submit_btn" id="submit_btn" value="0">
                            <input type="hidden" name="vendorid_tab_4" value="{{@$vendor_data[0]['OD Media ID'] ?? ''}}">
                            
                            <input type="hidden" name="od_media_id" value="{{$media_id}}">
    
                           
                        </div>

                        {{-- <a class="btn btn-primary" id="tab_1">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a> --}}
                        <input type="submit" value="Update" class="btn btn-primary">
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
<script src="{{ url('/js') }}/sole-right-basic-detail-validation.js"></script>
<script src="{{ url('/js') }}/sole-right-comman.js"></script>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    //  next and previous function for save
    


    //add more for branch 9-feb
    $(document).ready(function() {
        $("#add_branch").click(function() {
            var i = $("#count_branch_id").val();
            i++;
            var append = '<hr id="hrline_radio_' + i + '"><div class="row" id="row' + i + '"><div class="col-md-4"><div class="form-group"><label for="Name">State / राज्य<font color="red">*</font></label><p><select id="owner_state0" name="BO_state[]" class="form-control form-control-sm call_district" data="owner_district' + i + '"><option value="">Select State</option>@if(count($states) > 0)@foreach($states as $statesData)<option value="{{ $statesData['Code'] }}">{{$statesData['Description']}}</option>@endforeach @endif </select></p></div></div><div class="col-md-4"><div class="form-group"><label for="address">Address / पता <font color="red">*</font></label><textarea  type="text" name="BO_Address[]" id="BO_Address' + i + '" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm"></textarea></div></div><div class="col-md-4"><div class="form-group"><label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red"></font></label><input type="text" name="BO_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="bo_landline_no' + i + '" maxlength="14" onkeypress="return onlyNumberKey(event)"></div></div><div class="col-md-4"><div class="form-group"><label for="email">E-mail. / ईमेल <font color="red">*</font></label><input type="text" name="BO_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="email' + i + '" maxlength="30"></div></div><div class="col-md-4"><div class="form-group"><label for="mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label><input type="text" name="BO_Mobile[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile' + i + '" onkeypress="return onlyNumberKey(event)" maxlength="10"></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding: 0% 0 0 6%;"><button class="btn btn-danger remove_branch_row" id="' + i + '" style="font-size: 13px;"><i class="fa fa-minus"></i> Remove</button></div></div>';
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



    $("#tab_1").click(function(){
        var data =new FormData($("#sole_basic_detail")[0]);
            $.ajax({
                url : "/sole-basic-detail-update",
                type: 'POST',
                 // headers: {
                //   'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                // },
                 data : data,
                 contentType: false,
                 cache : false,
                 processData:false,
                success:function(data)
                {
                    console.log(data);
                }
            });
    });
</script>

@endsection