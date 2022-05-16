@extends('admin.layouts.layout')

<style>
body {
    color: #6c757d !important;
}
</style>
<style>
a.disabled {
    pointer-events: none;
    color: #ccc;
}

.hide-msg {
    display: none !important;
}

.fa-check {
    color: green;
}

.error {
    color: red;
    font-size: 14px;
}
</style>

@section('content')
@php
$latlongData1= $latlongData?? [1];
$owner_data= !empty($owner_data) ? $owner_data : [1];
$vendor_datas = $vendor_datas ?? [1];
$OD_work_dones= !empty($OD_work_dones_data) ? $OD_work_dones_data : [1];
$OD_media_address_data= !empty($OD_media_address_data) ? $OD_media_address_data : [1];


$readonly = ' ';
$disabled = ' ';
$checked = ' ';
$Self_Dec='';
$media_id =@$vendor_data[0]['OD Media ID'];
if(@$vendor_data[0]['OD Media ID'] != ''){
$disabled = '';
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
//if(@$vendor_data[0]['Rate Status Date'] > $current_date && @$vendor_data[0]['Status']=='1')
if(@$vendor_data[0]['Status']=='1')
{
$read='readonly';
$tab='-1';
$pointer='none';
$click='preventLeftClick';
}
else
{
$read='';
$tab='';
$pointer='';
$click='asdf';
}
@endphp


<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Empanelment-Outdoor Sole-Right Media
                {{ @$vendor_data[0]['Status'] }}</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div align="center" class="alert alert-success" style="display: none;"></div>
            <div align="center" class="alert alert-danger" style="display: none;"></div>
            <!-- <div align="center" class="alert alert-success text-primary"></div>
            <div align="center" class="alert alert-danger text-primary"></div> -->
            <!-- /.end card-header -->
            <form enctype="multipart/form-data" method="POST" id="sole_right_media">
                @csrf

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" style="pointer-events: none;"
                            href="#tab1">Basic Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" style="pointer-events: none;" href="#tab2">Outdoor
                            Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" style="pointer-events: none;" href="#tab3">Account
                            Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" style="pointer-events: none;" href="#tab4">Upload
                            Document</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" style="pointer-events: none;" href="#tab5">Advertisement
                            Details</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel"
                        aria-labelledby="tab1-trigger">
                        <!-- your steps content here -->
                        <div id="details_of_owner">
                            @foreach($owner_data as $key => $ownerlist)
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="owner_name">Owner name / मालिक का नाम <font color="red">*</font>
                                            </label>
                                        <p>
                                            <input type="text" name="owner_name" id="owner_name" placeholder="Enter Owner name" class="form-control form-control-sm owner_name"onkeypress="return onlyAlphabets(event,this);" maxlength="40"value="{{$ownerlist['Owner Name']?? ''}}" {{$read}} tabindex="{{$tab}}"style="pointer-events: {{$pointer}};">
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">E-mail ID / ई मेल आईडी<font color="red">*</font></label>
                                        <p>
                                            <input type="email" class="form-control form-control-sm"id="owner_email{{$key}}" name="owner_email" maxlength="50" placeholder="Enter Email ID" value="{{$ownerlist['Email ID']?? ''}}" onkeyup="return checkUniqueOwnerSoleRight(this, this.value,0)" {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';" readonly>
                                            <span id="alert_owner_email0" style="color:red;display: none;"></span>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">Mobile / मोबाइल<font color="red">*</font></label>
                                        <p>
                                            <input type="text" name="owner_mobile" id="owner_mobile{{$key}}"
                                                maxlength="10" placeholder="Enter Mobile"
                                                class="form-control form-control-sm input-imperial"
                                                onkeypress="return onlyNumberKey(event)" maxlength="10"
                                                value="{{$ownerlist['Mobile No_']?? ''}}"
                                                onkeyup="return checkUniqueOwnerSoleRight(this, this.value,0)" {{$read}}
                                                tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                            <span id="alert_owner_mobile0" style="color:red;display: none;"></span>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address / पता<font color="red">*</font></label>
                                        <p>
                                            <textarea type="text" name="address" id="owner_address{{$key}}"
                                                maxlength="120" placeholder="Enter Address" rows="1"
                                                class="form-control form-control-sm" {{$read}} tabindex="{{$tab}}"
                                                style="pointer-events: '{{$pointer}}';">{{$ownerlist['Address 1']?? ''}}</textarea>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Name">State / राज्य<font color="red">*</font></label>
                                        <p>
                                            <select id="owner_state0" name="state"
                                                class="form-control form-control-sm call_district"
                                                data="owner_district{{$key}}" {{$read}} tabindex="{{$tab}}"
                                                style="pointer-events: {{$pointer}};">
                                                <option value="">Select State</option>
                                                {{-- <option value="">Select State</option>
                                                @if(@$ownerlist['State'])
                                                <option selected="selected"> {{ $ownerlist['State'] }}
                                                </option>
                                                @endif --}}

                                                @if(count($states) > 0)
                                                @foreach($states as $statesData)
                                                <option value="{{ $statesData['Code'] }}"
                                                    {{@$ownerlist['State'] == $statesData['Code'] ? 'selected' : ''}}>
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
                                            <select id="owner_district{{$key}}" name="district"
                                                class="form-control form-control-sm" {{$disabled}} {{$read}}
                                                tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                                                @if(@$ownerlist['District'] != '')
                                                @foreach($districts as $district)
                                                <option value="{{$district['District']}}"
                                                    {{ @$ownerlist['District'] == $district['District']  ?  'selected' : '' }}>
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
                                            <input type="text" name="city" id="owner_city{{$key}}" maxlength="20"
                                                class="form-control form-control-sm" placeholder="City"
                                                value="{{$ownerlist['City']?? ''}}" {{$read}} tabindex="{{$tab}}"
                                                style="pointer-events: '{{$pointer}}';">
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone">Phone No / फोन नंबर</label>
                                        <input type="text" name="phone" id="owner_phone{{$key}}" maxlength="14"
                                            onkeypress="return onlyNumberKey(event)" placeholder="Enter Phone No"
                                            class="form-control form-control-sm input-imperial"
                                            value="{{$ownerlist['Phone No_']?? ''}}" {{$disabled}} {{$read}}
                                            tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fax">Fax / फैक्स</label>
                                        <input type="text" name="fax_no" id="owner_fax{{$key}}"
                                            onkeypress="return onlyNumberKey(event)" placeholder="Enter Fax"
                                            class="form-control form-control-sm" maxlength="14"
                                            value="{{$ownerlist['Fax No_']?? ''}}" {{$disabled}} {{$read}}
                                            tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="ownerid[]" id="ownerid" value="{{$ownerlist['Owner ID'] ?? ''}}">
                        <input type="hidden" name="increse_i" id="increse_i" value="{{$key ?? 0}}">
                        <div class="row" id="add_row_davp" style="float:right;margin-top:6px;">

                            <!-- <a class="btn btn-primary" id="add_row" style="margin-right: 7px;" {{$disabled}}><i
                                    class="fa fa-plus" aria-hidden="true"></i> Add</a> -->
                        </div>
                        <input type="hidden" name="mobilecheck" id="mobilecheck">
                        <input type="hidden" name="owner_input_clean" id="owner_input_clean">
                        <input type="hidden" name="user_id" value="{{ session('id') }}">
                        <input type="hidden" name="user_email" value="{{ session('email') }}">
                        <input type="hidden" name="emailarr[]" id="emailarr" value="">

                        <!-- <a class="btn btn-primary" onclick="stepper.next()">Next</a> -->
                        <input type="hidden" name="next_tab_1" id="next_tab_1" value="0">
                        <a class="btn btn-primary pm-next-button" id="tab_1">Next <i
                                class="fa fa-arrow-circle-right fa-lg"></i></a>
                        <!-- <input type="submit" name="submit" value="submit"> -->

                    </div>
                    <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                    <div class="row col-md-12">
                            <h5>Details of GST :-</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gst_no">GST No. / जीएसटी संख्या <font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm" name="GST_No" id="GST_No"
                                        placeholder="Enter GST No." maxlength="15"
                                        value="{{$vendor_data[0]['GST No_'] ?? ''}}" {{$disabled}} {{$read}}
                                        tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';"onkeypress="return isAlphaNumeric(event)">
                                    <span class="gstvalidationMsg"></span>
                                    <span class="validcheck"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="agency_name">Agency Name / एजेंसी का नाम<font color="red">*
                                        </font></label>
                                    <input type="text" name="PM_Agency_Name" class="form-control form-control-sm"
                                        placeholder="Enter Agency Name" maxlength="40" id="PM_Agency_Name"
                                        value="{{$vendor_data[0]['PM Agency Name'] ?? ''}}" {{ $disabled }} {{$read}}
                                        tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tin_tan_vat_no">TIN/TAN/VAT No.(if applicable) /
                                        टिन/टैन/वैट संख्या (यदि लागू हो)</label>
                                    <input type="text" class="form-control form-control-sm" name="TIN_TAN_VAT_No"
                                        id="tin_tan_vat_no" placeholder="Enter TIN/TAN/VAT No.(if applicable)"
                                        maxlength="15" onkeypress="return isAlphaNumeric(event)"
                                        value="{{$vendor_data[0]['TIN_TAN_VAT No_'] ?? ''}}" {{$disabled}} {{$read}}
                                        tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tin_tan_vat_no">Any other relevant information / कोई
                                        अन्य प्रासंगिक जानकारी</label>
                                    <input type="text" class="form-control form-control-sm"
                                        name="Other_Relevant_Information" id="tin_tan_vat_no"
                                        placeholder="Enter Any other relevant information" maxlength="80"
                                        value="{{$vendor_data[0]['Other Relevant Information'] ?? ''}}" {{$disabled}}
                                        {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <h5>Head Office :-</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address">Address / पता<font color="red">*</font></label>
                                    <textarea type="text" name="HO_Address" id="address1" maxlength="120"
                                        placeholder="Enter Address" rows="1" class="form-control form-control-sm"
                                        {{$disabled}} {{$read}} tabindex="{{$tab}}"
                                        style="pointer-events: '{{$pointer}}';">{{$vendor_data[0]['HO Address']??''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="landline_no">Landline No. / लैंडलाइन नंबर<font color="red">*</font>
                                        </label>
                                    <input type="text" name="HO_Landline_No" id="landline_no"
                                        placeholder="Enter Landline No." class="form-control form-control-sm"
                                        id="landline_head_office" onkeypress="return onlyNumberKey(event)"
                                        maxlength="10" value="{{$vendor_data[0]['HO Landline No_']??''}}" {{$disabled}}
                                        {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fax_no">Fax No. / फ़ैक्स नंबर</label>
                                    <input type="text" name="HO_Fax_No" placeholder="Enter Fax No"
                                        class="form-control form-control-sm" id="fax_no"
                                        onkeypress="return onlyNumberKey(event)" maxlength="14"
                                        value="{{$vendor_data[0]['HO Fax No_']??''}}" {{$disabled}} {{$read}}
                                        tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email_1">E-mail. / ईमेल<font color="red">*</font></label>
                                    <input type="text" name="HO_Email" placeholder="Enter E-mail"
                                        class="form-control form-control-sm" id="HO_Email"
                                        value="{{$vendor_data[0]['HO E-Mail']??''}}" {{$disabled}} maxlength="50"
                                        onkeyup="return checkUniqueVendor('email', this.value)" {{$read}}
                                        tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    <span id="v_alert_email" style="color:red;display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="HO_Mobile_No">Mobile No / मोबाइल नंबर<font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm" id="HO_Mobile_No"
                                        name="HO_Mobile_No" placeholder="Enter Mobile"
                                        onkeypress="return onlyNumberKey(event)" maxlength="10"
                                        value="{{$vendor_data[0]['HO Mobile No_']??''}}"
                                        onkeyup="return checkUniqueVendor('mobile', this.value)" {{$read}}
                                        tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    <span id="v_alert_mobile" style="color:red;display: none;"></span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row col-md-12">
                            <div class="row col-md-4">
                                <h5>Branch Office (if any) :-</h5>
                            </div>
                            <div class="row col-md-4">
                                @php
                                $check1 = '';
                                $check0 = '';
                                $display = '';
                                if(!empty(@$vendor_data) && @$vendor_data[0]['DO Address'] !=''){
                                $check1 = 'checked';
                                $display = 'block';
                                }else{
                                $check0 = 'checked';
                                $display = 'none';
                                }
                                @endphp
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input h5" name="boradio" value="1"
                                            {{$check1}}> Yes
                                        <input type="radio" class="form-check-input h5" name="boradio" value="0"
                                            {{$check0}}>No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div id="radio" style="display: {{$display}}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address / पता <font color="red">*</font></label>
                                        <textarea {{$disabled}} type="text" name="BO_Address" maxlength="120"
                                            placeholder="Enter Address" rows="1" class="form-control form-control-sm"
                                            {{$read}} tabindex="{{$tab}}"
                                            style="pointer-events: '{{$pointer}}';">{{$vendor_data[0]['BO Address']??''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red">*</font>
                                            </label>
                                        <input type="text" name="BO_Landline_No" placeholder="Enter Landline No."
                                            class="form-control form-control-sm" id="landline_no" maxlength="14"
                                            onkeypress="return onlyNumberKey(event)"
                                            value="{{$vendor_data[0]['BO Landline No_']??''}}" {{$disabled}} {{$read}}
                                            tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fax_no">Fax No. / फ़ैक्स नंबर <font color="red">*</font></label>
                                        <input type="text" name="BO_Fax_No" placeholder="Enter Fax No."
                                            class="form-control form-control-sm" id="fax_no" maxlength="14"
                                            onkeypress="return onlyNumberKey(event)"
                                            value="{{$vendor_data[0]['BO Fax No_']??''}}" {{$disabled}} {{$read}}
                                            tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">E-mail. / ईमेल <font color="red">*</font></label>
                                        <input type="text" name="BO_Email" placeholder="Enter E-mail"
                                            class="form-control form-control-sm" id="email" maxlength="30"
                                            value="{{$vendor_data[0]['BO E-Mail']??''}}" {{$disabled}} {{$read}}
                                            tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">Mobile / मोबाइल <font color="red">*</font></label>
                                        <input type="text" name="BO_Mobile" placeholder="Enter Mobile"
                                            class="form-control form-control-sm" id="mobile"
                                            onkeypress="return onlyNumberKey(event)" maxlength="10"
                                            value="{{$vendor_data[0]['BO Mobile No_']??''}}" {{$disabled}} {{$read}}
                                            tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="row col-md-4">
                                <h5>Authorized Representative :-</h5>
                            </div>
                        </div>
                        <br>

                        <div id="radioar">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Contact Person / संपर्क व्यक्ति <font color="red">*</font>
                                            </label>
                                        <textarea {{$disabled}} type="text" name="Authorized_Rep_Name"
                                            placeholder="Enter Contact Person" rows="1"
                                            class="form-control form-control-sm" maxlength="40" {{$read}}
                                            tabindex="{{$tab}}"
                                            style="pointer-events: '{{$pointer}}';">{{$vendor_data[0]['Authorized Rep Name']??''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address / पता <font color="red">*</font></label>
                                        <textarea {{$disabled}} type="text" name="AR_Address" maxlength="120"
                                            placeholder="Enter Address" rows="1" class="form-control form-control-sm"
                                            {{$read}} tabindex="{{$tab}}"
                                            style="pointer-events: '{{$pointer}}';">{{$vendor_data[0]['AR Address']??''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red">*</font>
                                            </label>
                                        <input type="text" name="AR_Landline_No" placeholder="Enter Landline No."
                                            class="form-control form-control-sm" id="landline_no"
                                            onkeypress="return onlyNumberKey(event)" maxlength="14"
                                            value="{{$vendor_data[0]['AR Landline No_']??''}}" {{$disabled}} {{$read}}
                                            tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fax_no">Fax No. / फ़ैक्स नंबर <font color="red">*</font></label>
                                        <input type="text" name="AR_FAX_No" placeholder="Enter Fax No."
                                            class="form-control form-control-sm" id="fax_no"
                                            onkeypress="return onlyNumberKey(event)" maxlength="14"
                                            value="{{$vendor_data[0]['AR FAX No_']??''}}" {{$disabled}} {{$read}}
                                            tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">E-mail. / ईमेल <font color="red">*</font></label>
                                        <input type="text" name="AR_Email" placeholder="Enter E-mail"
                                            class="form-control form-control-sm" id="email" maxlength="30"
                                            value="{{$vendor_data[0]['AR E-mail']??''}}" {{$disabled}} {{$read}}
                                            tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">Mobile / मोबाइल <font color="red">*</font></label>
                                        <input type="text" name="AR_Mobile_No" placeholder="Enter Mobile"
                                            class="form-control form-control-sm" id="mobile"
                                            onkeypress="return onlyNumberKey(event)" maxlength="10"
                                            value="{{$vendor_data[0]['AR Mobile No_']??''}}" {{$disabled}} {{$read}}
                                            tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Legal Status Of Company / कंपनी की कानूनी स्थिति<font color="red">*
                                            </font></label>
                                        <select name="Legal_Status_of_Company" class="form-control form-control-sm"
                                            style="width: 100%; pointer-events: {{$pointer}};" {{$read}}
                                            tabindex="{{$tab}}">
                                            <option value="">Select Category</option>
                                            <option value="0"
                                                <?= (@$vendor_data[0]["Legal Status of Company"] == 0 && @$vendor_data[0]["Legal Status of Company"] !='') ? 'selected' : ''; ?>>
                                                Proprietorship</option>
                                            <option value="1"
                                                <?= ( @$vendor_data[0]["Legal Status of Company"] == 1 ? 'selected' : ''); ?>>
                                                Partnership</option>
                                            <option value="2"
                                                <?= ( @$vendor_data[0]["Legal Status of Company"] == 2 ? 'selected' : ''); ?>>
                                                Limited liability partnership</option>
                                            <option value="3"
                                                <?= ( @$vendor_data[0]["Legal Status of Company"] == 3 ? 'selected' : ''); ?>>
                                                PSU</option>
                                            <option value="4"
                                                <?= ( @$vendor_data[0]["Legal Status of Company"] == 4 ? 'selected' : ''); ?>>
                                                NGO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row col-md-12">
                            <h5>Authority Details :-</h5>
                        </div><br>
                        <div class="row" id="authority_details">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="authority">Authority Which Granted Media With
                                        Address / प्राधिकरण जिसने मीडिया को पते के साथ प्रदान किया
                                        <font color="red">*</font>
                                    </label>
                                    <input type="text" name="Authority_Which_granted_Media"
                                        placeholder="Enter Authority Which Granted Media With Address"
                                        class="form-control form-control-sm" id="authority" maxlength="120"
                                        value="{{$vendor_data[0]['Authority Which granted Media']??''}}" {{$disabled}}
                                        {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-top: 26px;">
                                <div class="form-group">
                                    <label for="Contract_No">Contract No / अनुबंध क्रमांक<font color="red">*</font>
                                        </label>
                                    <input type="text" name="Contract_No"
                                        placeholder="Enter Amount Paid to Authority For The Current Year"
                                        onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm"
                                        id="Contract_No" maxlength="13" value="{{$vendor_data[0]['Contract No_']??''}}"
                                        {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="License_Fee">License Fee / लाइसेंस शुल्क<font color="red">*
                                        </font></label>
                                    <input type="text" name="License_Fee" id="license_fee"
                                        placeholder="Enter License Fee" onkeypress="return onlyNumberKey(event)"
                                        class="form-control form-control-sm" maxlength="8"
                                        value="{{ @$vendor_data[0]['License Fees'] ? round(@$vendor_data[0]['License Fees'],2) : ''}}"
                                        {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_from">Quantity of Display / प्रदर्शन की
                                        मात्रा<font color="red">*</font></label>
                                    <input type="text" name="Quantity_Of_Display" id="quantity_of_dis"
                                        placeholder="Quantity of Display" class="form-control form-control-sm"
                                        onkeypress="return onlyNumberKey(event)" maxlength="8"
                                        value="{{$vendor_data[0]['Quantity Of Display']??''}}" {{$read}}
                                        tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_from">License start date / लाइसेंस शुरू होने
                                        की तारीख<font color="red">*</font></label>
                                    <input type="date" name="License_From" id="txt_from" placeholder="DD/MM/YYYY"
                                        class="form-control form-control-sm"
                                        value="{{ @$vendor_data[0]['License From'] ? date('Y-m-d', strtotime(@$vendor_data[0]['License From'])) : ''}}"
                                        {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    <span id="date_error" style="color:red;display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_to">License end date / लाइसेंस समाप्ति तिथि
                                        <font color="red">*</font>
                                    </label>
                                    <input type="date" name="License_To" id="txt_to" placeholder="DD/MM/YYYY"
                                        class="form-control form-control-sm"
                                        value="{{ @$vendor_data[0]['License To'] ? date('Y-m-d', strtotime(@$vendor_data[0]['License To'])) : ''}}"
                                        {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    <span id="date_error" style="color:red;display: none;"></span>
                                </div>
                            </div>
                        </div><br>

                        <div class="row col-md-12">
                            <h5>Media Address:-</h5>


                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>If you want to import through XLS <a href="{{asset('uploads/demo_file.xlsx')}}"
                                        target="_blank">Download Sample File</a></h6>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" name="xls" id="xlxyes" value="1" class="xls">Yes
                                <input type="radio" name="xls" id="xlxno" value="0" class="xls" checked="checked">No
                            </div>
                        </div><br><br>

                        <div class="row" id="xls_show">
                            <div class="col-md-4">
                                <input type="file" name="media_import" class="form-control form-control-sm"
                                    accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            </div>
                        </div>
                        @php
                        $lineone =[];

                        @endphp
                        <div id="media_address">
                            @foreach($OD_media_address_data as $key => $OD_media_address)
                            <div class="row" id="media_address_{{$key}}">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Name">State / राज्य<font color="red">*</font>
                                        </label>
                                        <select {{$disabled}} id="state_id_{{$key}}" name="MA_State[]"
                                            class="form-control form-control-sm call_district" data="dist_id_{{$key}}"
                                            {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                                            <option value="">Select State</option>

                                            @if(count($states) > 0)
                                            @foreach($states as $statesData)
                                            <option value="{{ $statesData['Code'] }}"
                                                {{@$OD_media_address['State'] == $statesData['Code'] ? 'selected' : ''}}>
                                                {{$statesData['Description']}}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Name">District / ज़िला<font color="red">*</font>
                                        </label>
                                        <select {{$disabled}} id="dist_id_{{$key}}" name="MA_District[]"
                                            class="form-control form-control-sm" {{$read}} tabindex="{{$tab}}"
                                            style="pointer-events: {{$pointer}};">
                                            <option value="">Select District</option>
                                            @if(@$OD_media_address['District'])
                                            <option selected="selected">
                                                {{$OD_media_address['District']}}
                                            </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Name">City / नगर<font color="red">*</font></label>
                                        <input type="text" name="MA_City[]" class="form-control form-control-sm"
                                            placeholder="Enter City" maxlength="20"
                                            value="{{$OD_media_address['City']?? ''}}" {{$disabled}} {{$read}}
                                            tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: 24px;">
                                    <div class="form-group">
                                        <label for="license_to">Zone / क्षेत्र</label>
                                        <input type="text" name="MA_Zone[]" placeholder="Zone"
                                            class="form-control form-control-sm" id="zone" maxlength="8"
                                            value="{{$OD_media_address['Zone']?? ''}}" {{$disabled}}
                                            onkeypress="return onlyNumberKey(event)" {{$read}} tabindex="{{$tab}}"
                                            style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Media category / मीडिया श्रेणी <font color="red">*</font></label>
                                        <select name="Applying_For_OD_Media_Type[]"
                                            class="form-control form-control-sm mediaclass"
                                            style="width: 100%; pointer-events: {{$pointer}};" {{$disabled}}
                                            id="applying_media_{{$key}}" data-val="showcategory_{{$key}}" {{$read}}
                                            tabindex="{{$tab}}">
                                            <option value="">Select Category</option>
                                            <option value="0"
                                                {{@$OD_media_address['OD Media Type']=='0' ? 'selected' : ''}}>Airport
                                            </option>
                                            <option value="1"
                                                {{@$OD_media_address['OD Media Type']=='1' ? 'selected' : ''}}>Railway
                                                Station</option>
                                                <option value="2"
                                                {{@$OD_media_address['OD Media Type']=='2' ? 'selected' : ''}}>Road
                                                Side</option>
                                            <option value="3"
                                                {{@$OD_media_address['OD Media Type']=='3' ? 'selected' : ''}}>Moving
                                                Media</option>
                                            <option value="4"
                                                {{@$OD_media_address['OD Media Type']=='4' ? 'selected' : ''}}>Public
                                                utility</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4" id="subcategory">
                                    <div class="form-group">
                                        <label>Media Sub-Category / मीडिया उप-श्रेणी : <font color="red">*</font>
                                            </label>
                                        <select name="od_media_type[]" class="form-control-sm form-control"
                                            id="showcategory_{{$key}}" {{$read}} tabindex="{{$tab}}"
                                            style="pointer-events: {{$pointer}};">
                                            <option value="">Select</option>
                                            @if(@$OD_media_address['OD Media Type']!='')
                                            @foreach($getcat as $cat)
                                            <option value="{{$cat->media_uid}}"
                                                {{@$OD_media_address['OD Media ID']==$cat->media_uid ? 'selected' : ''}}>
                                                {{$cat->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4" style="margin-top: 24px;">
                                    <div class="form-group">
                                        <label for="year">Display size of media (Sqft) / मीडिया का प्रदर्शन आकार<font
                                                color="red">*
                                            </font></label>
                                        <input type="text" name="ODMFO_Display_Size_Of_Media[]"
                                            placeholder="Display size of media"
                                            class="form-control form-control-sm lat_media" id="size_of_media"
                                            onkeypress="return onlyDotNumberKey(event)"
                                            value="{{$OD_media_address['Display Size']?? ''}}" {{$read}}
                                            tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="illumination">Illumination <font color="red">*</font></label>
                                        <select name="Illumination_media[]" id="Illumination_media"
                                            class="form-control form-control-sm" {{$read}} tabindex="{{$tab}}"
                                            style="pointer-events: {{$pointer}};">
                                            <option value="">Select Illumination</option>
                                            <option value="1"
                                                {{@$OD_media_address['Illumination Type']=='1' ? 'selected' : ''}}>Lit
                                            </option>
                                            <option value="2"
                                                {{@$OD_media_address['Illumination Type']=='2' ? 'selected' : ''}}>Non
                                                lit</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Availability Start Date : </label>
                                        @if(@$OD_media_address['Availability Start Date']=='')
                                        <input type="date" name="av_start_date[]" class="form-control form-control-sm"
                                            id="av_start_date">
                                        @else
                                        <input type="date" name="av_start_date[]" class="form-control form-control-sm"
                                            id="av_start_date"
                                            value="{{date('Y-m-d', strtotime(@$OD_media_address['Availability Start Date'])) ?? ''}}"
                                            {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Availability End Date : </label>
                                        @if(@$OD_media_address['Availability End Date']=='')
                                        <input type="date" name="av_end_date[]" class="form-control form-control-sm"
                                            id="av_end_date">
                                        @else
                                        <input type="date" name="av_end_date[]" class="form-control form-control-sm"
                                            id="av_end_date"
                                            value="{{date('Y-m-d', strtotime(@$OD_media_address['Availability End Date'])) ?? ''}}"
                                            {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                        @endif
                                    </div>
                                </div>

                                <!-- For Delete Suman 31-Dec -->
                                @php 
                                $countAdd=count($OD_media_address_data);
                                
                                @endphp
                                @if($countAdd > 1)
                                <div class="col-md-4">
                                	<input type="hidden" name="sole_id" id="sole_id{{$key}}"  value="{{$OD_media_address['Sole Media ID']}}">
                                	<input type="hidden" name="li_no" id="li_no{{$key}}" value="{{$OD_media_address['Line No_']}}">
                                	<br><h4 class="del btn btn-danger" data-sid="li_no{{$key}}" data-mid="media_address_{{$key}}" data-sod="sole_id{{$key}}" style="cursor: pointer;">X</h4>
                                </div>
                                
                                @endif
                                <!-- For Delete end Suman 31-Dec -->
                            
                            </div>

                            @php
                            if(!empty($OD_media_address['Line No_'])) {
                            $lineone[] =$OD_media_address['Line No_'];
                            }
                            $extline1 =implode(',', $lineone);
                            @endphp

                            @endforeach
                        </div><!-- media_address id close -->
                        <input type="hidden" name="lineno1" id="lineno1" value="{{$extline1 ?? ''}}">
                        <div class="row" style="float:right;margin-top: 6px;">
                            <input type="hidden" name="count_id" id="count_id" value="{{$key ?? 0}}">
                            <a class="btn btn-primary {{$disabled}}" id="add_row_media_add"><i class="fa fa-plus"
                                    aria-hidden="true"></i> Add</a>
                        </div>
                        <div class="row">
                            <hr>
                        </div>
                        <div class="row col-md-12">
                            <h5>Details of work done in last year, for the applied media only, if
                                any (As per format given below) :-</h5>
                        </div><br>
                        @php
                        $dd_line =[];
                        $i=0;
                        $a=0;
                        @endphp
                        <div class="row" id="details_of_work_done">
                            @foreach($OD_work_dones as $key => $work_done_data)
                            @php
                            if(@$work_done_data['Allocated Vendor Code']!='')
                            {
                            	$readonly='readonly';
                            	$tabindexx='-1';
								$point='none';
								$click='preventLeftClick';
                            }
                            else
                            {
                            	$readonly='';
                            	$tabindexx='';
								$point='';
								$click='';
                            }
                            @endphp
                            <!-- {{@$work_done_data['Allocated Vendor Code']!='' ? 'readonly' : '' }} -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="year">Year1 / वर्ष  {{@$work_done_data['Allocated Vendor Code']}}<font color="red">*</font></label>
                                        <select name="ODMFO_Year[]" id="Years{{$key}}" class="form-control form-control-sm ddlYears {{$click}}"  tabindex="{{$tabindexx}}" style="pointer-events: {{$point}};" {{$readonly}}>
                                            @if(@$work_done_data['Year'] == '')
                                            <option value="">Select Year</option>
                                            @else
                                            <option value="{{ $work_done_data['Year'] }}">
                                                {{ $work_done_data['Year'] }}
                                            </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="quantity_duration">Quantity of Display or Duration /
                                            प्रदर्शन या अवधि की मात्रा<font color="red">*</font></label>
                                        <input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" id="quantity_duration{{$key}}" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm" maxlength="8" onkeypress="return onlyNumberKey(event)" value="{{$work_done_data['Qty Of Display_Duration'] ?? ''}}"  {{$read}} tabindex="{{$tabindexx}}" style="pointer-events: '{{$point}}';" {{$readonly}}>
                                        <input type="hidden" value="{{$work_done_data['Line No_'] ?? ''}}"
                                            name="line_no[]">
                                    </div>
                                    <input type="hidden" name="allocated_vendor_code[]" value="{{$work_done_data['Allocated Vendor Code'] ?? ''}}">
                                </div>
                                <div class="col-md-4">
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
                                        <input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount{{$key}}" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8"
                                            value="{{$work_done_data1}}" {{$disabled}} {{$read}} tabindex="{{$tabindexx}}" style="pointer-events: '{{$point}}';" {{$readonly}}>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="upload_doc_{{$key}}">Upload Document / दस्तावेज़ अपलोड
                                            करें</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" readonly="readonly" name="ODMFO_Upload_Document[]"
                                                    class="custom-file-doc {{$click}}" data="{{$key}}"
                                                    onchange="return uploadFile({{$key}},this)" id="upload_doc_{{$key}}"
                                                    accept="application/pdf" {{$read}} tabindex="{{$tab}}"
                                                    style="cursor: not-allowed;">
                                                <label class="custom-file-label" for="upload_doc_{{$key}}"
                                                    id="choose_file{{$key}}">Choose
                                                    file</label>
                                                <input type="hidden" name="ODMFO_Upload_Document_[]"
                                                    value="{{ @$work_done_data['File Name']}}"> <!-- ram code -->
                                                <!-- <span id="alert_upload_doc" style="color: red;"></span> -->

                                            </div>

                                            @if(@$work_done_data['File Name'] != '')
                                            <div class="input-group-append">
                                                <span class="input-group-text"><a
                                                        href="{{ url('/uploads') }}/sole-right-media/{{@$work_done_data['File Name']}}"
                                                        target="_blank"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></a></span>
                                            </div>
                                            @else
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="upload_file{{$key}}">Upload</span>
                                            </div>
                                            @endif
                                        </div>
                                        <span id="upload_doc_error{{$key}}" class="error invalid-feedback"></span>
                                    </div>


                                </div>
                                <!-- For Delete Suman 31-Dec -->
                                <!-- How Many Record Fetch From "BOC$OD Media Work done" Table Suman -->
                                @php 
                                $countTotal=count($OD_work_dones);
                                
                                @endphp
                                @if($countTotal > 1)
                                <div class="col-md-4">
                                	<input type="hidden" name="od_id" id="od_id{{$key}}"  value="{{$work_done_data['OD Media ID']}}">
                                	<input type="hidden" name="line_id" id="line_id{{$key}}" value="{{$work_done_data['Line No_']}}">
                                	<br>
                                	<!-- <h4 class="delete btn btn-danger" data-id="line_id{{$key}}" data-od="od_id{{$key}}" style="cursor: pointer;">X</h4> -->
                                </div>
                                @endif
                                <!-- For Delete end Suman 31-Dec -->
                            </div>
                            @php
                            if(@$work_done_data['Line No_']) {
                            $dd_line[] = $work_done_data['Line No_'];
                            }
                            $exline2=implode(',',$dd_line);
                            $i++;
                            $a++;
                            @endphp

                            @endforeach
                        </div>
                        <input type="hidden" name="lineno2" id="lineno2" value="{{$exline2 ?? ''}}">
                        <div class="row" style="float:right;margin-top: 6px;">
                            <input type="hidden" name="count_i" value="{{$key ?? 0}}" id="count_i">
                            <a class="btn btn-primary {{$disabled}}" id="add_row_next" {{$read}} tabindex="{{$tab}}"
                                style="pointer-events: {{$pointer}};"><i class="fa fa-plus" aria-hidden="true"></i>
                                Add</a>
                        </div><br><br>
                      
                        <input type="hidden" name="vendorid_tab_2" id="vendorid_tab_2"
                            value="{{$media_owner_details[0]['OD Media ID'] ?? ''}}">
                        <input type="hidden" name="next_tab_2" id="next_tab_2" value="0">
                        @if(@$vendor_data[0]['agency']=='')
                        <input type="hidden" name="getID" id="getID" value="0">
                        @else
                        <input type="hidden" name="getID" id="getID" value="1">
                        @endif
                        <a class="btn btn-primary reg-previous-button" id="prev_1"><i class="fa fa-arrow-circle-left fa-lg"></i>
                            Previous</a>
                        <a class="btn btn-primary pm-next-button" id="tab_2">Next <i
                                class="fa fa-arrow-circle-right fa-lg"></i></a>
                        <!-- <a class="btn btn-primary" onclick="stepper.next()">Next</a> -->
                    </div>
                    <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        <br>
                        <div class="row col-md-12">
                            <h5>Fee :-</h5>
                            <p>Application fee Rs.1000/- (non refundable) per media format.</p>
                        </div><br>
                        <!-- <div class="col-md-12 row">
                            <label>Payment Type</label>
                            <select id="select_payment">
                                <option value=" ">Select payment type</option>
                                <option value="0" selected="selected">Through DD</option>
                                <option value="1">Through NEFT</option>
                            </select>
                        </div> -->
                        <!-- <div class="row" id="dd_div" style="display: none;">
                            <div class="row col-md-12">
                                <p style="padding-left: 14px;">DD Details :-</p>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dd_no">DD No. / डीडी संख्या<font color="red">*
                                        </font></label>
                                    <input type="text" class="form-control form-control-sm" name="DD_No" id="dd_no"
                                        placeholder="Enter DD No." onkeypress="return onlyNumberKey(event)"
                                        maxlength="6" value="{{$vendor_data[0]['DD No_'] ?? ''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dd_date">DD Date / डीडी तिथि<font color="red">*
                                        </font></label>
                                    <input type="date" class="form-control form-control-sm" name="DD_Date" id="dd_date"
                                        placeholder="Enter DD Date" min="{{ date('Y-m-d',strtotime('-3 months')) }}"
                                        value="{{ @$vendor_data[0]['DD Date'] ? date('Y-m-d', strtotime(@$vendor_data[0]['DD Date'])) : ''}}"
                                        {{ $disabled }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name / बैंक का नाम<font color="red">
                                            *</font></label>
                                    <input type="text" class="form-control form-control-sm" name="DD_Bank_Name"
                                        id="bank_name_1" placeholder="Enter Bank Name" maxlength="30"
                                        onkeypress=" return onlyAlphabets(event)"
                                        value="{{$vendor_data[0]['DD Bank Name'] ?? ''}}" {{ $disabled }}>
                                    <span id="alert_bank_name_1" style="color: red;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch_name">Branch Name/ शाखा का नाम<font color="red">*</font>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" name="DD_Bank_Branch_Name"
                                        placeholder="Enter Branch Name" maxlength="30"
                                        value="{{$vendor_data[0]['DD Bank Branch Name'] ?? ''}}" {{ $disabled }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dd_account">DD Amount / डीडी राशि </label>
                                    <input type="text" name="Application_Amount" id="dd_amount"
                                        class="form-control form-control-sm" placeholder="Enter DD Account"
                                        onkeypress="return onlyNumberKey(event)" maxlength="10"
                                        value="{{@$vendor_data[0]['Application Amount'] ? round(@$vendor_data[0]['Application Amount'],2) : ''}}"
                                        {{ $disabled }}>
                                </div>
                            </div>
                        </div> -->

                        <div class="row" id="neft_div">
                            <div class="row col-md-12">
                                <p style="padding-left: 14px;">NEFT Details :-</p>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pan_no">Pan No. / पैन नंबर<font color="red">*</font>
                                    </label>
                                    <input type="text" name="PAN" id="pan_card" class="form-control form-control-sm"
                                        placeholder="Enter Pan No." maxlength="10"
                                        value="{{$vendor_data[0]['PAN'] ?? ''}}" {{ $disabled }} {{$read}}
                                        tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    <span id="PAN_No_Error"></span>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ifsc_code">IFSC Code / आई एफ एस सी कोड<font color="red">*</font>
                                    </label>
                                    <input type="text" name="IFSC_Code" id="ifsc_code"
                                        class="form-control form-control-sm" placeholder="Enter IFSC Code"
                                        maxlength="11" value="{{$vendor_data[0]['IFSC Code'] ?? ''}}" {{ $disabled }}
                                        {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                    <span id="IFSC_code_Error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name / बैंक का नाम<font color="red">
                                            *</font></label>
                                    <input type="text" name="Bank_Name" id="bank_name_2"
                                        class="form-control form-control-sm" placeholder="Enter Bank Name"
                                        maxlength="30" onkeypress="return onlyAlphabets(event)"
                                        value="{{$vendor_data[0]['Bank Name'] ?? ''}}" {{ $disabled }} {{$read}}
                                        tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch">Branch / शाखा<font color="red">*</font>
                                    </label>
                                    <input type="text" name="Bank_Branch" id="branch_2"
                                        class="form-control form-control-sm" placeholder="Enter branch" maxlength="30"
                                        value="{{$vendor_data[0]['Bank Branch'] ?? ''}}" {{ $disabled }} {{$read}}
                                        tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                           
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_no">Account no / खाता नंबर<font color="red">
                                            *</font></label>
                                    <input type="text" name="Account_No" id="account_no"
                                        class="form-control form-control-sm" placeholder="Enter Account no"
                                        onkeypress="return onlyNumberKey(event)" maxlength="20"
                                        value="{{$vendor_data[0]['Account No_'] ?? ''}}" {{ $disabled }} {{$read}}
                                        tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>
                        </div>
                        <div class="row" id="payment_mode3" style="display:none;">


                        </div>
                        <input type="hidden" name="vendorid_tab_3" id="vendorid_tab_3"
                            value="{{@$vendor_data[0]['OD Media ID'] ?? ''}}">
                        <input type="hidden" name="next_tab_3" id="next_tab_3" value="0">
                        <a class="btn btn-primary reg-previous-button" id="prev_2"><i class="fa fa-arrow-circle-left fa-lg"></i>
                            Previous</a>
                        <!-- <a class="btn btn-primary" onclick="stepper.next()">Next</a> -->
                        <a class="btn btn-primary pm-next-button" id="tab_3">Next <i
                                class="fa fa-arrow-circle-right fa-lg"></i></a>
                    </div>

                    <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        @if(@$vendor_data[0]['Legal Doc File Name']=="")
                        <div class="form-group">
                            <label for="exampleInputFile">Upload document of legal status of company
                                / कंपनी की कानूनी स्थिति का दस्तावेज अपलोड करें <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Legal_Doc_File_Name" class="custom-file-input"
                                        id="Legal_Doc_File_Name" {{$disabled}} >
                                    <label class="custom-file-label" id="Legal_Doc_File_Name2"
                                        for="Legal_Doc_File_Name">
                                        Choose file
                                    </label>
                                </div>
                                @if(@$vendor_data[0]['Legal Doc File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <a href="{{ url('/uploads') }}/sole-right-media/{{ $vendor_data[0]['Legal Doc File Name'] }}"
                                            target="_blank">View</a>
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
                                / कंपनी की कानूनी स्थिति का दस्तावेज अपलोड करें <font color="red">*</font></label>

                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Legal_Doc_File_Name_modify"
                                        class="custom-file-input" id="Legal_Doc_File_Name">
                                    <label class="custom-file-label" id="Legal_Doc_File_Name2"
                                        for="Legal_Doc_File_Name">
                                        Choose file
                                    </label>
                                </div>
                                @if(@$vendor_data[0]['Legal Doc File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <a href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Legal Doc File Name'] }}"
                                            target="_blank">View</a>
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






                        @if(@$vendor_data[0]['Notarized Copy File Name']=='')
                        <div class="form-group">
                            <label for="exampleInputFile">Upload document of outdoor media
                                format(attach supportive documents viz,Notarized copy of agreement
                                of sole right indicating location, receipt of amount paid, validity
                                etc/ allotment letter where agreement is not executed) / आउटडोर
                                मीडिया प्रारूप का दस्तावेज अपलोड करें (समर्थक दस्तावेज संलग्न करें,
                                जैसे कि एकमात्र अधिकार के समझौते की नोटरीकृत प्रति, स्थान का संकेत,
                                भुगतान की गई राशि की प्राप्ति, वैधता आदि / आवंटन पत्र जहां समझौता
                                निष्पादित नहीं किया गया है) <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Notarized_Copy_File_Name" class="custom-file-input"
                                        id="Notarized_Copy_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" for="Notarized_Copy_File_Name"
                                        id="Notarized_Copy_File_Name2">Choose file</label>
                                </div>
                                @if(@$vendor_data[0]['Notarized Copy File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a
                                            href="{{ url('/uploads') }}/sole-right-media/{{ $vendor_data[0]['Notarized Copy File Name'] }}"
                                            target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text" id="Notarized_Copy_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="Notarized_Copy_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="exampleInputFile">Upload document of outdoor media
                                format(attach supportive documents viz,Notarized copy of agreement
                                of sole right indicating location, receipt of amount paid, validity
                                etc/ allotment letter where agreement is not executed) / आउटडोर
                                मीडिया प्रारूप का दस्तावेज अपलोड करें (समर्थक दस्तावेज संलग्न करें,
                                जैसे कि एकमात्र अधिकार के समझौते की नोटरीकृत प्रति, स्थान का संकेत,
                                भुगतान की गई राशि की प्राप्ति, वैधता आदि / आवंटन पत्र जहां समझौता
                                निष्पादित नहीं किया गया है) <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Notarized_Copy_File_Name_modify"
                                        class="custom-file-input" id="Notarized_Copy_File_Name"
                                        {{$disabled}}>
                                    <label class="custom-file-label" for="Notarized_Copy_File_Name"
                                        id="Notarized_Copy_File_Name2">Choose file</label>
                                </div>
                                @if(@$vendor_data[0]['Notarized Copy File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a
                                            href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Notarized Copy File Name'] }}"
                                            target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text" id="Notarized_Copy_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="Notarized_Copy_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        @endif





                        @if(@$vendor_data[0]['PAN File Name']=="")
                        <div class="form-group">
                            <label for="exampleInputFile">Attach copy of Pan Number and
                                authorization of Bank for NEFT payment / एनईएफटी भुगतान के लिए पैन
                                नंबर और बैंक के प्राधिकरण की प्रति संलग्न करें <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Attach_Copy_Of_Pan_Number_File_Name"
                                        class="custom-file-input" id="Attach_Copy_Of_Pan_Number_File_Name"
                                        {{$disabled}}>
                                    <label class="custom-file-label" id="Attach_Copy_Of_Pan_Number_File_Name2"
                                        for="Attach_Copy_Of_Pan_Number_File_Name">Choose
                                        file</label>
                                </div>
                                @if(@$vendor_data[0]['PAN File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a
                                            href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['PAN File Name'] }}"
                                            target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text"
                                        id="Attach_Copy_Of_Pan_Number_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="Attach_Copy_Of_Pan_Number_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="exampleInputFile">Attach copy of Pan Number and
                                authorization of Bank for NEFT payment / एनईएफटी भुगतान के लिए पैन
                                नंबर और बैंक के प्राधिकरण की प्रति संलग्न करें <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Attach_Copy_Of_Pan_Number_File_Name_modify"
                                        class="custom-file-input" id="Attach_Copy_Of_Pan_Number_File_Name"
                                        {{$disabled}}>
                                    <label class="custom-file-label" id="Attach_Copy_Of_Pan_Number_File_Name2"
                                        for="Attach_Copy_Of_Pan_Number_File_Name">Choose
                                        file</label>
                                </div>
                                @if(@$vendor_data[0]['PAN File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a
                                            href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['PAN File Name'] }}"
                                            target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text"
                                        id="Attach_Copy_Of_Pan_Number_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="Attach_Copy_Of_Pan_Number_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        @endif



                        @if(@$vendor_data[0]['Affidavit File Name']=="")
                        <div class="form-group">
                            <label for="exampleInputFile">Submit an affidavit on stamp paper stating
                                on oath that the details submitted by you on performa are true and
                                correct.Mention the application no. in affidavit / स्टाम्प पेपर पर
                                शपथ पत्र पर शपथ पत्र प्रस्तुत करें कि आपके द्वारा प्रस्तुत किए गए
                                विवरण सत्य और सही हैं। आवेदन संख्या का उल्लेख करें। हलफनामे
                                में <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Affidavit_File_Name" class="custom-file-input"
                                        id="Affidavit_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" id="Affidavit_File_Name2"
                                        for="Affidavit_File_Name">Choose file</label>
                                </div>
                                @if(@$vendor_data[0]['Affidavit File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a
                                            href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Affidavit File Name'] }}"
                                            target="_blank">View</a></span>
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
                                शपथ पत्र पर शपथ पत्र प्रस्तुत करें कि आपके द्वारा प्रस्तुत किए गए
                                विवरण सत्य और सही हैं। आवेदन संख्या का उल्लेख करें। हलफनामे
                                में <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Affidavit_File_Name_modify"
                                        class="custom-file-input" id="Affidavit_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" id="Affidavit_File_Name2"
                                        for="Affidavit_File_Name">Choose file</label>
                                </div>
                                @if(@$vendor_data[0]['Affidavit File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a
                                            href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Affidavit File Name'] }}"
                                            target="_blank">View</a></span>
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


                        <!-- sk
                        @if(@$vendor_data[0]['Photo File Name']=="")
                        <div class="form-group">
                            <label for="exampleInputFile">Photographs of displayed medium (Separate
                                photo for each property) / प्रदर्शित माध्यम की तस्वीरें (प्रत्येक
                                संपत्ति के लिए अलग फोटो) <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Photo_File_Name" class="custom-file-input" data="0"
                                        onchange="return uploadFile(0,this)" id="Photo_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" id="Photo_File_Name2" for="Photo_File_Name">Choose
                                        file</label>
                                </div>
                                @if(@$vendor_data[0]['Photo File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a
                                            href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Photo File Name'] }}"
                                            target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text" id="Photo_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="Photo_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="exampleInputFile">Photographs of displayed medium (Separate
                                photo for each property) / प्रदर्शित माध्यम की तस्वीरें (प्रत्येक
                                संपत्ति के लिए अलग फोटो) <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Photo_File_Name_modify" class="custom-file-input {{$click}}" data="0"
                                        onchange="return uploadFile(0,this)" id="Photo_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" id="Photo_File_Name2" for="Photo_File_Name">Choose
                                        file</label>
                                </div>
                                @if(@$vendor_data[0]['Photo File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a
                                            href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['Photo File Name'] }}"
                                            target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text" id="Photo_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="Photo_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        @endif
                        -->



                        @if(@$vendor_data[0]['GST File Name']=="")
                        <div class="form-group">
                            <label for="exampleInputFile">GST registration Certificate / जीएसटी
                                पंजीकरण प्रमाणपत्र <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="GST_File_Name" class="custom-file-input" id="GST_File_Name"
                                        {{$disabled}}>
                                    <label class="custom-file-label" id="GST_File_Name2" for="GST_File_Name">Choose
                                        file</label>
                                </div>
                                @if(@$vendor_data[0]['GST File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a
                                            href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['GST File Name'] }}"
                                            target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text" id="GST_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="GST_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="exampleInputFile">GST registration Certificate / जीएसटी
                                पंजीकरण प्रमाणपत्र <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="GST_File_Name_modify" class="custom-file-input"
                                        id="GST_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" id="GST_File_Name2" for="GST_File_Name">Choose
                                        file</label>
                                </div>
                                @if(@$vendor_data[0]['GST File Name'] != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a
                                            href="{{ url('/uploads') }}/sole-right-media/{{ @$vendor_data[0]['GST File Name'] }}"
                                            target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text" id="GST_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="GST_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        @endif


                        <!-- checkbox -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" name="self_declaration" id="self_declaration" {{ @$vendor_data[0]['Self-declaration'] == 1 ? "checked" : "" }}
                                          value="1">
                                    <label for="self_declaration">Self declaration / स्वयं
                                        घोषित <font color="red">*</font></label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="odmedia_id" id="odmedia_id"
                            value="{{@$vendor_data[0]['OD Media ID'] ?? ''}}">
                        <input type="hidden" name="submit_btn" id="submit_btn" value="0">
                        <input type="hidden" name="vendorid_tab_4" value="{{@$vendor_data[0]['OD Media ID'] ?? ''}}">
                        <a class="btn btn-primary reg-previous-button" id="prev_3"><i class="fa fa-arrow-circle-left fa-lg"></i>
                            Previous</a>&nbsp;
                        <input type="hidden" name="od_media_id" value="{{$media_id}}">

                        @if(@$vendor_data[0]['Self-declaration']==1)
                        <a class="btn btn-primary pm-next-button" id="tab_4"><i class="fa fa-arrow-circle-right fa-lg"
                                ></i>Next</a>
                        @else
                        <a class="btn btn-primary pm-next-button" id="tab_4"><i class="fa fa-paper-plane"
                                aria-hidden="true"></i>
                            Next</a>@endif
                        <!--<button type="submit" id="sub_btn" class="btn btn-primary" onclick="nextSaveData('submit_btn');">Submit</button>
                        -->

                    </div>
                    <div id="tab5" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        @if(Session::has('od_message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{Session::get('od_message') }}
                        </div>
                        @endif

                        @if(count($latlongData1) == 0)
                        <div class="card bg-light text-dark w-75">
                            <h6 class="text-center">Please submit location data through app</h6>
                            <a href="#" class="card-link text-center">App link</a>
                        </div>
                        <!-- loop start -->
                        @else
                        @foreach($latlongData as $key=>$latlong)
                        <div class="row">
                            <div class="col-md-12">
                                <p>Property :- <?= $key+1; ?></p>
                            </div><br>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <p>{{$latlong->Latitude}}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <p>{{$latlong->Longitude}}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Image</label><br>
                                    <p> <img src="{{ 'https://pingtrack.azurewebsites.net/public/uploads/sole-right-media/'.$latlong->{ 'Image File Name'}   }}"
                                            name="image" alt="img" target="_blank" width="60" height="60"></p>
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
                        <a class="btn btn-primary reg-previous-button" id="prev_4"><i class="fa fa-arrow-circle-left fa-lg"></i>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{ url('/js') }}/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ url('/js') }}/sole-right-validation_ren.js"></script>
<script src="{{ url('/js') }}/validation_comman.js"></script>

<script src="{{asset('js/soleright_renewal.js')}}"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgvvPpyxo3IjhB-CMG7wCgCHcYvV7FJxU&libraries=places&callback=initialize"
    async defer></script>
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script> -->
<script>
//Show and hide div for payment type(DD and NEFT)
$('#select_payment').change(function() {
    var payment_type = $('#select_payment').val();
    if (payment_type == 0) {
        $('#dd_div').show();
        $('#neft_div').hide();
    } else {
        $('#dd_div').hide();
        $('#neft_div').show()
    }
});

//google map api start
function initialize() {

    $(document).on('keyup keypress', '.map-input', function(e) {

        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }

        const locationInputs = document.getElementsByClassName("map-input");
        const autocompletes = [];
        const geocoder = new google.maps.Geocoder;
        var ind = $(this).attr("data");
        for (let i = 0; i < locationInputs.length; i++) {
            const input = locationInputs[i];
            // const fieldKey = input.id.replace("-input-"+ind, "");
            const fieldKey = 'address';
            const isEdit = document.getElementById(fieldKey + "-latitude" + ind).value != '' && document
                .getElementById(fieldKey + "-longitude" + ind).value != '';
            const latitude = parseFloat(document.getElementById(fieldKey + "-latitude" + ind).value) || -
                33.8688;
            const longitude = parseFloat(document.getElementById(fieldKey + "-longitude" + ind).value) ||
                151.2195;

            const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                center: {
                    lat: latitude,
                    lng: longitude
                },
                zoom: 13
            });
            const marker = new google.maps.Marker({
                map: map,
                position: {
                    lat: latitude,
                    lng: longitude
                },
            });

            marker.setVisible(isEdit);

            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.key = fieldKey;
            autocompletes.push({
                input: input,
                map: map,
                marker: marker,
                autocomplete: autocomplete
            });
        }

        for (let i = 0; i < autocompletes.length; i++) {
            const input = autocompletes[i].input;
            const autocomplete = autocompletes[i].autocomplete;
            const map = autocompletes[i].map;
            const marker = autocompletes[i].marker;

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                marker.setVisible(false);
                const place = autocomplete.getPlace();

                geocoder.geocode({
                    'placeId': place.place_id
                }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        const lat = results[0].geometry.location.lat();
                        const lng = results[0].geometry.location.lng();
                        setLocationCoordinates(autocomplete.key, lat, lng, ind);
                    }
                });

                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    input.value = "";
                    return;
                }

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

            });
        }
    });

}

function setLocationCoordinates(key, lat, lng, ind) {
    const latitudeField = document.getElementById(key + "-" + "latitude" + ind);
    const longitudeField = document.getElementById(key + "-" + "longitude" + ind);
    latitudeField.value = lat;
    longitudeField.value = lng;
}
/* End searching location */

//payment mode script
$(document).ready(function() {
    $("#payment_type").change(function() {
        var mode = $("#payment_type").val();
        if (mode == 'DD') {
            $("#payment_mode1").show();
        } else {
            $("#payment_mode1").hide();
        }
        if (mode == 'NTFT') {
            $("#payment_mode2").show();
        } else {
            $("#payment_mode2").hide();
        }
        if (mode == 'BHARAT') {
            $("#payment_mode3").show();
        } else {
            $("#payment_mode3").hide();
        }
    });
});

// $(document).ready(function() {
//     $("#add_row").click(function() {
//         var i = $("#increse_i").val();
//         i++;
//         $.ajax({
//             url: "{{url('fetchStates')}}",
//             type: "GET",
//             dataType: 'json',
//             success: function(result) {
//                 // var obj = JSON.parse(data);
//                 var html = '';
//                 var html = '<option value="">Select any state</option>';
//                 $.each(result.data, function(key, value) {
//                     html += '<option value="' + value.Code + '">' + value
//                         .Description + '</option>';
//                 });
//                 $("#details_of_owner").append(
//                     '<div class="row" style="padding: 10px 18px 0 18px;"><div class="col-md-4"><div class="form-group"><label for="owner_name">Publication Name / प्रकाशन का नाम <font color="red">*</font></label><p><input type="text" name="owner_name[]" id="owner_name' +
//                     i +
//                     '" placeholder="Enter Owner`s Name" maxlength="40" class="form-control form-control-sm owner_name"></p></div></div><div class="col-md-4"><div class="form-group"><label for="email">Email / ईमेल<font color="red">*</font></label><p><input type="text" name="owner_email[]" id="owner_email' +
//                     i +
//                     '" placeholder="Enter Email" maxlength="30" onkeyup="return checkUniqueOwnerSoleRight(this, this.value,' +
//                     i +
//                     ')" class="form-control form-control-sm"><span id="alert_owner_email' +
//                     i +
//                     '" style="color:red;display: none;"></span></p></div></div><div class="col-md-4"><div class="form-group"><label for="mobile">Mobile / मोबाइल<font color="red">*</font></label><p><input type="text" name="owner_mobile[]" id="owner_mobile' +
//                     i +
//                     '" maxlength="10" placeholder="Enter Mobile" onkeyup="return checkUniqueOwnerSoleRight(this, this.value,' +
//                     i +
//                     ')" class="form-control form-control-sm"><span id="alert_owner_mobile' +
//                     i +
//                     '" style="color:red;display: none;"></span></p></div></div><div class="col-md-4"><div class="form-group"><label for="address">Address / पता<font color="red">*</font></label><p><textarea type="text" name="address[]" id="owner_address' +
//                     i +
//                     '" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm"></textarea></p></div></div><div class="col-md-4"><div class="form-group"><label for="Name">State / राज्य<font color="red">*</font></label><p><select  id="owner_state' +
//                     i +
//                     '" name="state[]" class=" form-control form-control-sm call_district" data="owner_district' +
//                     i + '">' + html +
//                     '</select></p></div></div><div class="col-md-4"><div class="form-group"><label for="Name">District / ज़िला<font color="red">*</font></label><p><select  id="owner_district' +
//                     i +
//                     '" name="district[]" class="form-control form-control-sm"></select></p></div></div><div class="col-md-4"><div class="form-group"><label for="phone">City / नगर<font color="red">*</font></label><p><input type="text" name="city[]" id="owner_city' +
//                     i +
//                     '" placeholder="Enter City" class="form-control form-control-sm" maxlength="20"></p></div></div><div class="col-md-4"><div class="form-group"><label for="phone">Phone No / फोन नंबर</label><input type="text" name="phone[]" id="owner_phone ' +
//                     i +
//                     '" maxlength="14" placeholder="Enter Phone No" class="form-control form-control-sm input-imperial" onkeypress="return onlyNumberKey(event)"></div></div><div class="col-md-4"><div class="form-group"> <label for="fax">Fax / फैक्स</label><input type="text" name="fax_no[]" id="owner_fax' +
//                     i +
//                     '" placeholder="Enter Fax" class="form-control form-control-sm" maxlength="14"></div></div><input type="hidden" name="ownerid[]" id="ownerid' +
//                     i +
//                     '" value=""><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 87px;"><button class="btn btn-danger remove_row" style="margin-left: -16px;"><i class="fa fa-minus"></i> Remove</button></div></div>'
//                 );
//             }
//         });
//         $("#increse_i").val(i);
//     });
//     $("#details_of_owner").on('click', '.remove_row', function() {
//         $(this).parent().parent().remove();
//     });
// });


$(document).ready(function() {
    $("#add_row_media_add").click(function() {
        var i = $("#count_id").val();
        i++;
        $.ajax({
            url: "{{url('fetchStates')}}",
            type: "GET",
            dataType: 'json',
            success: function(result) {
                // var obj = JSON.parse(data);
                var html = '';
                var html = '<option value="">Select any state</option>';
                $.each(result.data, function(key, value) {
                    html += '<option value="' + value.Code + '">' + value
                        .Description + '</option>';
                });

                $("#media_address").append(
                    '<div class="row"><div class="col-md-4"><div class="form-group"><label for="Name">State / राज्य<font color="red">*</font></label><select name="MA_State[]" class="form-control form-control-sm call_district" id="state_id_' +
                    i + '" data="dist_id_' + i + '">' + html +
                    '</select><span id="alert_state_dd" style="color: red;"></span></div></div><div class="col-md-4"><div class="form-group"><label for="Name">District / ज़िला<font color="red">*</font></label><select  name="MA_District[]" id="dist_id_' +
                    i +
                    '" class=" form-control form-control-sm"><option value="">Select District</option><option value="1">Uttar Pradesh</option><option value="2">Madhya Pradesh</option><option value="3">Kherla</option></select><span id="alert_dist_dd" style="color: red;"></span></div></div><div class="col-md-4"><div class="form-group"><label for="Name">City / नगर<font color="red">*</font></label> <input type="text" name="MA_City[]" maxlength="20" class="form-control form-control-sm" placeholder="City"><span id="alert_country_dd" style="color: red;"></span></div></div><div class="col-md-4"><div class="form-group"><label for="license_to">Zone  / क्षेत्र</label><input type="text" name="MA_Zone[]" placeholder="Zone" maxlength="8" onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm" id="zone"></div></div><div class="col-md-4"><div class="form-group"><label>Media category / मीडिया श्रेणी <font color="red">*</font></label><select name="Applying_For_OD_Media_Type[]" id="applying_media_' +
                    i + '" data-val="showcategory_' + i +
                    '" class="form-control form-control-sm mediaclass" style="width: 100%;"><option value="">Select Category</option><option value="1">Airport</option><option value="2">Railway Station</option><option value="3">Moving Media</option><option value="4">Public utility</option></select></div></div><div class="col-md-4" id="subcategory" ><div class="form-group"><label>Media Sub-Category / मीडिया उप-श्रेणी : </label><select name="od_media_type[]" class="form-control-sm form-control" id="showcategory_' +
                    i +
                    '"></select></div></div><div class="col-md-4" style="margin-top: 24px;"><div class="form-group"><label for="year">Display size of media (Sqft) / मीडिया का प्रदर्शनआकार<font color="red">*</font></label><input type="text" name="ODMFO_Display_Size_Of_Media[]"placeholder="Display size of media" class="form-control form-control-sm"id="size_of_media" maxlength="18"></div></div><div class="col-md-4"><div class="form-group"><label for="year">Illumination / रोशनी</label><select name="Illumination_media[]" id="Illumination_media"class="form-control form-control-sm"><option value="">Select Illumination</option><option value="1">lit</option><option value="2">non lit</option></select></div></div><div class="col-md-4"><div class="form-group"><label>Availability Start Date : </label><input type="date" name="av_start_date[]" class="form-control form-control-sm" id="av_start_date"></div></div><div class="col-md-4"><div class="form-group"><label>Availability End Date : </label><input type="date" name="av_end_date[]" class="form-control form-control-sm" id="av_end_date"></div></div> <div class="col-md-2" style="padding-left: 87px;"><button class="btn btn-danger remove_row"><i class="fa fa-minus"></i> Remove</button></div></div>'
                );
            }
        });
        $("#count_id").val(i);
    });
    $("#media_address").on('click', '.remove_row', function() {
        $(this).parent().parent().remove();
        var add_count = $("#count_id").val();
        $("#count_id").val(add_count - 1);
    });
});



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
            '<div class="row"><div class="col-md-4"><div class="form-group"><label for="year">Year / वर्ष<font color="red">*</font></label><select name="ODMFO_Year[]" id="Years' +
            i +
            '" class="form-control form-control-sm ddlYears"><option value="">Select Year</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="quantity_duration">Quantity of Display or Duration / प्रदर्शन या अवधि की मात्रा<font color="red">*</font></label><input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" maxlength="8" id="quantity_duration' +
            i +
            '" onkeypress="return onlyNumberKey(event)" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm"></div></div><div class="col-md-4"><div class="form-group"><label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि (रु)<font color="red">*</font></label><input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount' +
            i +
            '" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" maxlength="14" onkeypress="return onlyNumberKey(event)"></div></div><div class="col-md-4"><div class="form-group"><label for="upload_doc_0' +
            i +
            '">Upload Document / दस्तावेज़ अपलोड करें</label><div class="input-group"><div class="custom-file"><input type="file" name="ODMFO_Upload_Document[]" class="custom-file-doc" id="upload_doc_' +
            i + '"  onchange="return uploadFile(' + i + ',this)" data="' + i +
            '"><label class="custom-file-label" for="upload_doc_' + i + '" id="choose_file' + i +
            '">Choose file</label></div><div class="input-group-append"><span class="input-group-text" id="upload_file' +
            i + '">Upload</span></div></div><span id="upload_doc_error' + i +
            '" class="error invalid-feedback"></span></div></div><div class="col-md-10"></div><div class="col-md-2"><button class="btn btn-danger remove_row_next"><i class="fa fa-minus"></i> Remove</button></div></div>';
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
        $(this).parent().parent().remove();

        var add_count = $("#count_i").val();

        $("#count_i").val(add_count - 1);
    });

    //Loop and add the Year values to DropDownList.

});

// function test(){
//   console.log("test");
// }

//$(document).ready(function () {

$(document).on('change', '.call_district', function() {
    // console.log($(this).val() + '~' + $(this).attr("data"));
    if ($(this).val() != '') {
        var id = $(this).attr("data");
        $("#" + id).empty();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: 'POST',
            url: "{{Route('fetchDistricts')}}",
            data: {
                state_code: $(this).val()
            },
            success: function(response) {
                // console.log(response);
                $("#" + id).html(response.message);
            }
        });
    }
});


//sk for subcategory
$(document).on('change', '.mediaclass', function() {
    if ($(this).val() != '') {
        var id = $(this).attr("data-val");
        // console.log(id);
        $("#" + id).empty();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: 'POST',
            url: "{{Route('fetchmedia')}}",
            data: {
                media_code: $(this).val()
            },
            success: function(response) {
                // console.log("#" + id);
                // $("#" + id).html(response.message);
                $("#" + id).html(response);

            }
        });
    }
});





//});

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

                if (isinArray(file, numbersArray) == false) {
                    $("#doc_data").val(function() {
                        return $("#doc_data").val() + ',' + file;
                    });
                    var namess = $("#doc_data").val();
                    var numbersArray1 = namess.split(',');
                    numbersArray1 = $.grep(numbersArray1, function(value) {
                        return value != file1;
                    });
                    $("#doc_data").val(numbersArray1);
                    $("#" + id + 1).hide();
                } else {
                    var namess = $("#doc_data").val();
                    var numbersArray1 = namess.split(',');
                    numbersArray1 = $.grep(numbersArray1, function(value) {
                        return value != file1;
                    });
                    $("#doc_data").val(numbersArray1);
                    $("#" + id).val('');
                    $("#" + id + 2).text("Choose file");
                    $("#" + id + 3).html("Upload").addClass("input-group-text");
                    $("#" + id + 1).text('File already selected!');
                    $("#" + id + 1).show();
                    $("#" + id + "-error").addClass("hide-msg");
                }
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

$(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

})

$(document).ready(function() {
    $('body').on('focus', ".datepicker", function() {
        //$(this).datepicker();

        $(this).click(function() {
            $('.ui-datepicker-calendar').css("display", "none");
        });
        $(this).focusin(function() {
            $('.ui-datepicker-calendar').css("display", "none");
        });
        $(this).datepicker({
            // changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy',
            beforeShow: function(input) {
                $(input).datepicker("widget").addClass('hide-calendar');
            },
            onClose: function(dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst
                    .selectedMonth, 1));
                $(this).datepicker('widget').addClass('hide-calendar');
            }
        });
    });
});

function onlyAlphabets(e, t) {
    try {
        if (window.event) {
            var charCode = window.event.keyCode;
        } else if (e) {
            var charCode = e.which;
        } else {
            return true;
        }
        if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode == 32))
            return true;
        else
            return false;
    } catch (err) {
        alert(err.Description);
    }
}

//Only Numeric Number

function onlyAlphaNumeric(e) {
    var keyCode = e.which;
    // Not allow special
    if (!((keyCode >= 48 && keyCode <= 57) ||
            (keyCode >= 65 && keyCode <= 90) ||
            (keyCode >= 97 && keyCode <= 122)) &&
        keyCode != 32) {
        e.preventDefault();
    }
}

function onlyNumberKey(evt) {
    // Only ASCII character in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}


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
                                    // var arrText = new Array();
                                    // $("#emailarr").val('');
                                    // $('input[name^="owner_email"]').each(function() {
                                    //     arrText.push($(this).val());
                                    //     $("#emailarr").val(function() {
                                    //         return $("#emailarr").val() + ',' + $(this).val();
                                    //     });
                                    // });
                                    // console.log(arrText);
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
                                        // $("#alert_" + thisd.id).html("Please enter unique Owner ID");
                                        // $("#alert_" + thisd.id).show();
                                        // $("#owner_state" + i).val('');
                                        // $("#owner_district" + i).val('');
                                        // $("#owner_name" + i).val('');
                                        // $("#owner_mobile" + i).val('');
                                        // $("#owner_address" + i).val('');
                                        // $("#owner_city" + i).val('');
                                        // $("#owner_phone" + i).val('');
                                        // $("#owner_fax" + i).val('');
                                        // $("#ownerid" + i).val('');
                                        // //  $("#exist_owner_id").val('');
                                        // $("#mobilecheck").val('');
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
$('.alert-success').hide()
$('.alert-danger').hide()
//  next and previous function for save
function nextSaveData(id) {
    // if ($("#" + id).val() == 0) {
    //     $("#" + id).val(1);
    //     if (id == "next_tab_2") {
    //         $("#next_tab_1").val(0);
    //     } else if (id == "next_tab_3") {
    //         // $("#next_tab_1").val(0);
    //         $("#next_tab_2").val(0);
    //     } else if (id == "submit_btn") {
    //         //console.log(id);
    //         $("#next_tab_3").val(0);
    //     }
    // }
    // if (id != "next_tab_4") {
    //     var data = new FormData($("#sole_right_media")[0]);
    //     $.ajax({
    //         type: 'POST',
    //         url: "{{Route('saveSoleMedia')}}",
    //         data: data,
    //         dataType: "json",
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         //autoUpload: true,

    //         success: function(data) {
    //             //console.log(data);
    //             // if (data.success == false) {
    //             //     $('.alert-danger').fadeIn().html(data.message);
    //             //     setTimeout(function() {
    //             //         $('.alert-success').fadeOut("slow");
    //             //         //window.location.reload();
    //             //     }, 5000);
    //             // }
    //             if (data.success == true) {
    //                 if (id == 'next_tab_1') {
    //                     console.log(data['data']);
    //                     $("#ownerid").val(data.data);
    //                 } else {
    //                     $("#vendorid_tab_2").val(data.data['unique_id']);
    //                     $("#lineno1").val(data.data['lineno1']);
    //                     $("#lineno2").val(data.data['lineno2']);
    //                     $("#vendorid_tab_3").val(data.data);
    //                     $("#vendorid_tab_4").val(data.data[0]);
    //                     if (id == "submit_btn") {
    //                         $('.alert-success').fadeIn().html(data.message);
    //                         setTimeout(function() {
    //                             $('.alert-success').fadeOut("slow");
    //                             window.location.href = 'viewSoleRightMedia/' + data.data;
    //                             //window.location.href("{{ url('viewSoleRightMedia/')}}");
    //                         }, 5000);

    //                     }
    //                 }
    //             }
    //         },
    //         error: function(error) {
    //             console.log('error');
    //         }
    //     });
    // } else {
    //     console.log('Property Details');
    // }
}

$(document).ready(function() {
    $("input[name='boradio']").click(function() {
        var radioValue = $("input[name='boradio']:checked").val();
        console.log(radioValue);
        if (radioValue == '1') {
            $("#radio").show();
        } else {
            $("#radio").hide();
        }
    });

    // $("input[name='arradio']").click(function() {
    //     var radioValue = $("input[name='arradio']:checked").val();
    //     console.log(radioValue);
    //     if (radioValue == '1') {
    //         $("#radioar").show();
    //     } else {
    //         $("#radioar").hide();
    //     }
    // });
});

//Validation for number and .(Dot)
function onlyDotNumberKey(evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 46 || ASCIICode > 57))
        return false;
    return true;
}


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


$("#xls_show").hide();
$("#xlxyes").click(function() {
    var xlsvalue = $(this).val();
    if (xlsvalue == '1') {
        $("#xls_show").show();
        $("#media_address").hide();
        $("#add_row_media_add").hide();
    }

});
$("#xlxno").click(function() {
    var xlsvalue = $(this).val();
    if (xlsvalue == '0') {
        $("#xls_show").hide();
        $("#media_address").show();
        $("#add_row_media_add").show();
    }

});

//Pan card validation


//IFSC Code validation



$(document).ready(function(){
	$("#ifsc_code").on('blur', function(){
	  var IFSC =$(this).val();
	  $.ajax({
	    url:'https://ifsc.razorpay.com/'+IFSC,
	    type:'get',
	    success:function(data){
	      if(data.UPI ==true && IFSC !=''){
	         console.log(data);
	      $("#bank_name_2").val(data.BANK);
	      $("#branch_2").val(data.BRANCH);
	    }else{
	      $("#bank_name_2").val('');
	      $("#branch_2").val('');
	    }
	    },
	     error: function (error) {
	        alert(request.responseText);
	    }
	  
	  })
	});
});

</script>
@endsection