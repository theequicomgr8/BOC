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
$latlongData1 = $latlongData?? [1];
$owner_data=$owner_data ?? [1];
$OD_work_dones=$OD_work_dones_data ?? [1];
$OD_media_address_data=$OD_media_address_data ?? [1];
$vendor_data =$vendor_data ?? '';
//$ODMFO_Billing_Amount= ODMFO_Billing_Amount ?? [1];
$readonly = ' ';
$disabled = ' ';
$checked = ' ';
$Self_Dec='';
$media_id =@$vendor_data[0]['OD Media ID'];
if(@$vendor_data[0]['OD Media ID'] != ''){
$disabled = 'disabled';
$readonly = 'readonly';
$checked = 'checked';
$Self_Dec = $vendor_data[0]['Self-declaration'] == 1 ? "checked" : "";
}
@endphp



<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Empanelment-Outdoor Sole-Right Media</h6>
        </div>
        <!-- Card Body -->
        <div class="card-header" id="show_msg" style="display: none;">
            <div align="center" class="alert alert-success" id="show_msg2"></div>
        </div>
        <div class="card-body">
            @if(session()->has('status'))
            <div align="center" class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @else
            @if(session()->get('message'))
            <div align="center" class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
            @endif
            @endif
            <!-- <div align="center" class="alert alert-success"></div>
            <div align="center" class="alert alert-danger"></div> -->
            <!-- /.end card-header -->
            <form enctype="multipart/form-data" method="POST" id="sole_right_media">
                @csrf
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" href="#tab1">Basic Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="#tab2">Outdoor Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="#tab3">Account Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="#tab4">Property Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="#tab5">Upload Document</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel"
                        aria-labelledby="tab1-trigger">
                        <!-- your steps content here -->
                        @foreach($owner_data as $ownerlist)
                        <div class="row" id="details_of_owner">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="owner_name">Publication Name / प्रकाशन का
                                        नाम</label>
                                    <p>
                                        <input type="text" name="owner_name[]" id="owner_name0"
                                            placeholder="Enter Publication Name"
                                            class="form-control form-control-sm owner_name"
                                            onkeypress="return onlyAlphabets(event,this);" maxlength="40"
                                            value="{{$ownerlist['Owner Name']?? ''}}" {{ @$readonly }}>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">E-mail ID(Owner) / ई मेल आईडी<font color="red">*</font>
                                    </label>
                                    <p>
                                        <input type="email" class="form-control form-control-sm" id="owner_email0"
                                            name="owner_email[]" maxlength="50" placeholder="Enter Email ID"
                                            value="{{$ownerlist['Email ID']?? ''}}"
                                            onkeyup="return checkUniqueOwnerSoleRight(this, this.value,0)"
                                            {{ @$readonly }}>
                                        <span id="alert_owner_email0" style="color:red;display: none;"></span>
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mobile">Mobile / मोबाइल<font color="red">*</font>
                                    </label>
                                    <p>
                                        <input type="text" name="mobile[]" id="owner_mobile0" maxlength="10"
                                            placeholder="Enter Mobile"
                                            class="form-control form-control-sm input-imperial"
                                            onkeypress="return onlyNumberKey(event)" maxlength="10"
                                            value="{{$ownerlist['Mobile No_']?? ''}}"
                                            onkeyup="return checkUniqueOwnerSoleRight(this, this.value,0)"
                                            {{ @$readonly }}>
                                        <span id="alert_owner_mobile0" style="color:red;display: none;"></span>
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address">Address / पता<font color="red">*</font>
                                    </label>
                                    <p>
                                        <textarea type="text" name="address[]" id="owner_address0" maxlength="120"
                                            placeholder="Enter Address" rows="1" class="form-control form-control-sm"
                                            {{ @$readonly }}>{{$ownerlist['Address 1']?? ''}}</textarea>
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">State / राज्य<font color="red">*</font>
                                    </label>
                                    <p>
                                        <select id="owner_state0" name="state[]"
                                            class="form-control form-control-sm call_district" data="owner_district0"
                                            {{$disabled}}>
                                            <option value="">Select State</option>
                                            @if(@$ownerlist['State'])
                                            <option selected="selected"> {{$ownerlist['State']}}
                                            </option>
                                            @endif
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
                                    <label for="Name">District / ज़िला<font color="red">*</font>
                                    </label>
                                    <p>
                                        <select id="owner_district0" name="district[]"
                                            class="form-control form-control-sm" {{$disabled}}>
                                            <option value="">Select District</option>
                                            @if(@$ownerlist['District'])
                                            <option selected="selected" value="">
                                                {{$ownerlist['District']}}
                                            </option>
                                            @endif
                                        </select>
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">City / नगर<font color="red">*</font></label>
                                    <p>
                                        <input type="text" name="city[]" id="owner_city0" maxlength="20"
                                            class="form-control form-control-sm" placeholder="City"
                                            value="{{$ownerlist['City']?? ''}}" {{ @$readonly }}>
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Phone No / फोन नंबर</label>
                                    <input type="text" name="phone[]" id="owner_phone0" maxlength="14"
                                        onkeypress="return onlyNumberKey(event)" placeholder="Enter Phone No"
                                        class="form-control form-control-sm input-imperial"
                                        value="{{$ownerlist['Phone No_']?? ''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fax">Fax / फैक्स</label>
                                    <input type="text" name="fax_no[]" id="owner_fax0"
                                        onkeypress="return onlyNumberKey(event)" placeholder="Enter Fax"
                                        class="form-control form-control-sm" maxlength="14"
                                        value="{{$ownerlist['Fax No_']?? ''}}" {{$disabled}}>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="row" id="add_row_davp" style="float:right;margin-top:6px;">
                            <input type="hidden" name="increse_i" id="increse_i" value="0">
                            <!-- <a class="btn btn-primary" {{$disabled}} id="add_row" style="margin-right: 7px;" {{ @$readonly }}>Add</a> -->
                        </div>
                        <input type="hidden" name="mobilecheck" id="mobilecheck">
                        <input type="hidden" name="owner_input_clean" id="owner_input_clean">
                        <input type="hidden" name="user_id" value="{{ session('id') }}">
                        <input type="hidden" name="user_email" value="{{ session('email') }}">
                        <input type="hidden" name="emailarr[]" id="emailarr" value="">

                        <!-- <a class="btn btn-primary" onclick="stepper.next()">Next</a> -->
                        <input type="hidden" name="ownerid[]" id="ownerid" value="">
                        <input type="hidden" name="next_tab_1" id="next_tab_1" value="0">
                        <a class="btn btn-primary pm-next-button" id="tab_1">Next <i
                                class="fa fa-arrow-circle-right fa-lg"></i></a>
                        <!-- <input type="submit" name="submit" value="submit"> -->

                    </div>
                    <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        <div class="row col-md-12">
                            <h5>Head Office :-</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address">Address / पता<font color="red">*</font>
                                    </label>
                                    <textarea type="text" name="HO_Address" id="address1" maxlength="120"
                                        placeholder="Enter Address" rows="1" class="form-control form-control-sm"
                                        {{$disabled}}>{{$vendor_data[0]['HO Address']??''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="landline_no">Landline No. / लैंडलाइन नंबर<font color="red">*
                                        </font></label>
                                    <input type="text" name="HO_Landline_No" id="landline_no"
                                        placeholder="Enter Landline No." class="form-control form-control-sm"
                                        id="landline_head_office" onkeypress="return onlyNumberKey(event)"
                                        maxlength="14" value="{{$vendor_data[0]['HO Landline No_']??''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fax_no">Fax No. / फ़ैक्स नंबर</label>
                                    <input type="text" name="HO_Fax_No" placeholder="Enter Fax No"
                                        class="form-control form-control-sm" id="fax_no"
                                        onkeypress="return onlyNumberKey(event)" maxlength="14"
                                        value="{{$vendor_data[0]['HO Fax No_']??''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email_1">E-mail. / ईमेल<font color="red">*</font>
                                    </label>
                                    <input type="text" name="HO_Email" placeholder="Enter E-mail"
                                        class="form-control form-control-sm" id="HO_Email"
                                        value="{{$vendor_data[0]['HO E-Mail']??''}}" {{$disabled}} maxlength="50"
                                        onkeyup="return checkUniqueVendor('email', this.value)">
                                    <span id="v_alert_email" style="color:red;display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="HO_Mobile_No">Mobile No / मोबाइल नंबर<font color="red">*</font>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="HO_Mobile_No"
                                        name="HO_Mobile_No" placeholder="Enter Mobile"
                                        onkeypress="return onlyNumberKey(event)" maxlength="10"
                                        value="{{$vendor_data[0]['HO Mobile No_']??''}}"
                                        onkeyup="return checkUniqueVendor('mobile', this.value)" {{ @$readonly }}>
                                    <span id="v_alert_mobile" style="color:red;display: none;"></span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row col-md-12">
                            <h5>Branch Office (if any) :-</h5>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address">Address / पता</label>
                                    <textarea {{$disabled}} type="text" name="BO_Address" maxlength="120"
                                        placeholder="Enter Address" rows="1"
                                        class="form-control form-control-sm">{{$vendor_data[0]['BO Address']??''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="landline_no">Landline No. / लैंडलाइन नंबर</label>
                                    <input type="text" name="BO_Landline_No" placeholder="Enter Landline No."
                                        class="form-control form-control-sm" id="landline_no" maxlength="14"
                                        onkeypress="return onlyNumberKey(event)"
                                        value="{{$vendor_data[0]['BO Landline No_']??''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fax_no">Fax No. / फ़ैक्स नंबर</label>
                                    <input type="text" name="BO_Fax_No" placeholder="Enter Fax No."
                                        class="form-control form-control-sm" id="fax_no" maxlength="14"
                                        onkeypress="return onlyNumberKey(event)"
                                        value="{{$vendor_data[0]['BO Fax No_']??''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">E-mail. / ईमेल</label>
                                    <input type="text" name="BO_Email" placeholder="Enter E-mail"
                                        class="form-control form-control-sm" id="email" maxlength="30"
                                        value="{{$vendor_data[0]['BO E-Mail']??''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mobile">Mobile / मोबाइल</label>
                                    <input type="text" name="BO_Mobile" placeholder="Enter Mobile"
                                        class="form-control form-control-sm" id="mobile"
                                        onkeypress="return onlyNumberKey(event)" maxlength="10"
                                        value="{{$vendor_data[0]['BO Mobile No_']??''}}" {{$disabled}}>
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <h5>Authorized Representative :-</h5>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address">Contact Person / संपर्क व्यक्ति</label>
                                    <textarea {{$disabled}} type="text" name="Authorized_Rep_Name"
                                        placeholder="Enter Contact Person" rows="1" class="form-control form-control-sm"
                                        maxlength="40">{{$vendor_data[0]['Authorized Rep Name']??''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address">Address / पता</label>
                                    <textarea {{$disabled}} type="text" name="AR_Address" maxlength="120"
                                        placeholder="Enter Address" rows="1"
                                        class="form-control form-control-sm">{{$vendor_data[0]['AR Address']??''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="landline_no">Landline No. / लैंडलाइन नंबर</label>
                                    <input type="text" name="AR_Landline_No" placeholder="Enter Landline No."
                                        class="form-control form-control-sm" id="landline_no"
                                        onkeypress="return onlyNumberKey(event)" maxlength="14"
                                        value="{{$vendor_data[0]['AR Landline No_']??''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fax_no">Fax No. / फ़ैक्स नंबर</label>
                                    <input type="text" name="AR_FAX_No" placeholder="Enter Fax No."
                                        class="form-control form-control-sm" id="fax_no"
                                        onkeypress="return onlyNumberKey(event)" maxlength="14"
                                        value="{{$vendor_data[0]['AR FAX No_']??''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">E-mail. / ईमेल</label>
                                    <input type="text" name="AR_Email" placeholder="Enter E-mail"
                                        class="form-control form-control-sm" id="email" maxlength="30"
                                        value="{{$vendor_data[0]['AR E-mail']??''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mobile">Mobile / मोबाइल</label>
                                    <input type="text" name="AR_Mobile_No" placeholder="Enter Mobile"
                                        class="form-control form-control-sm" id="mobile"
                                        onkeypress="return onlyNumberKey(event)" maxlength="10"
                                        value="{{$vendor_data[0]['AR Mobile No_']??''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Legal Status Of Company / कंपनी की कानूनी स्थिति<font color="red">*
                                        </font></label>
                                    <select {{$disabled}} name="Legal_Status_of_Company"
                                        class="form-control form-control-sm" style="width: 100%;">
                                        @if(@$vendor_data[0]['Legal Status of Company']==1)
                                        <option value="1" selected="selected">Proprietorship
                                        </option>
                                        @else
                                        <option value="0" selected="selected">Proprietorship 1
                                        </option>
                                        @endif
                                        <option value="">Select Proprietorship</option>
                                        <option value="0">Proprietorship 1</option>
                                        <option value="1">Proprietorship</option>
                                    </select>
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
                                        value="{{$vendor_data[0]['Authority Which granted Media']??''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-top: 26px;">
                                <div class="form-group">
                                    <label for="Contract_No">Contract No / अनुबंध क्रमांक<font color="red">*
                                        </font></label>
                                    <input type="text" name="Contract_No"
                                        placeholder="Enter Amount Paid to Authority For The Current Year"
                                        onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm"
                                        id="Contract_No" maxlength="13" value="{{$vendor_data[0]['Contract No_']??''}}"
                                        {{$disabled}}>
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
                                        {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_from">Quantity of Display / प्रदर्शन की
                                        मात्रा<font color="red">*</font></label>
                                    <input type="text" name="Quantity_Of_Display" id="quantity_of_dis"
                                        placeholder="Quantity of Display" class="form-control form-control-sm"
                                        onkeypress="return onlyNumberKey(event)" maxlength="8"
                                        value="{{$vendor_data[0]['Quantity Of Display']??''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_from">License start date / लाइसेंस शुरू होने
                                        की तारीख<font color="red">*</font></label>
                                    <input type="date" name="License_From" placeholder="DD/MM/YYYY"
                                        class="form-control form-control-sm"
                                        min="{{ date('Y-m-d', strtotime('-10 years')) }}" max="{{date('Y-m-d')}}"
                                        value="{{ @$vendor_data[0]['License From'] ? date('Y-m-d', strtotime(@$vendor_data[0]['License From'])) : ''}}"
                                        {{$disabled}}>
                                    <span id="date_error" style="color:red;display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_to">License end date / लाइसेंस समाप्ति तिथि
                                        <font color="red">*</font>
                                    </label>
                                    <input type="date" name="License_To" placeholder="DD/MM/YYYY"
                                        class="form-control form-control-sm"
                                        min="{{ date('Y-m-d',strtotime('-10 years')) }}"
                                        value="{{ @$vendor_data[0]['License To'] ? date('Y-m-d', strtotime(@$vendor_data[0]['License To'])) : ''}}"
                                        {{$disabled}}>
                                    <span id="date_error" style="color:red;display: none;"></span>
                                </div>
                            </div>
                        </div><br>

                        <div class="row col-md-12">
                            <h5>Media Address:-</h5>
                        </div><br>
                        @foreach($OD_media_address_data as $OD_media_address)
                        <div class="row" id="media_address">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">State / राज्य<font color="red">*</font>
                                    </label>
                                    <select {{$disabled}} id="state_id_0" name="MA_State[]"
                                        class="form-control form-control-sm call_district" data="dist_id_0"
                                        {{$disabled}}>
                                        <option value="">Select State</option>
                                        @if(@$OD_media_address['State'])
                                        <option selected="selected"> {{$OD_media_address['State']}}
                                        </option>
                                        @endif
                                        @if(count($states) > 0)
                                        @foreach($states as $statesData)
                                        <option value="{{ $statesData['Code'] }}">
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
                                    <select {{$disabled}} id="dist_id_0" name="MA_District[]"
                                        class="form-control form-control-sm">
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
                                        value="{{$OD_media_address['City']?? ''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_to">Zone / क्षेत्र</label>
                                    <input type="text" name="MA_Zone[]" placeholder="Zone"
                                        class="form-control form-control-sm" id="zone" maxlength="8"
                                        value="{{$OD_media_address['Zone']?? ''}}" {{$disabled}}
                                        onkeypress="return onlyNumberKey(event)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_to">Latitude / अक्षांश<font color="red">*
                                        </font></label>
                                    <input type="text" name="MA_Latitude[]" placeholder="Latitude"
                                        class="form-control form-control-sm lat_cls" id="Latitude"
                                        onkeypress="return onlyDotNumberKey(event)" maxlength="19"
                                        value="{{$OD_media_address['Latitude']?? ''}}" {{$disabled}}>
                                </div>
                                <span id="alert_lat" style="color: red; display: none">Please enter
                                    decimal value. For Example: 779997.899</span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_to">Longitude / देशान्तर<font color="red">*
                                        </font></label>
                                    <input type="text" name="MA_Longitude[]" placeholder="Longitude"
                                        class="form-control form-control-sm lat_cls" id="Longitude"
                                        onkeypress="return onlyDotNumberKey(event)" maxlength="19"
                                        value="{{$OD_media_address['Longitde']?? ''}}" {{$disabled}}>
                                </div>
                                <span id="alert_lat" style="color: red; display: none">Please enter
                                    decimal value. For Example: 779997.899</span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_to">Property Landmark / संपत्ति सीमाचिह्न
                                        <font color="red">*</font>
                                    </label>
                                    <input type="text" name="MA_Property_Landmark[]" placeholder="Property Landmark"
                                        class="form-control form-control-sm" id="property_landmark" maxlength="80"
                                        value="{{$OD_media_address['Landmark']?? ''}}" {{$disabled}}>
                                    <span id="alert_property_landmark" style="color: red;"></span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="row" style="float:right;margin-top: 6px;">
                            <input type="hidden" name="count_id" id="count_id" value="0">
                            <a class="btn btn-primary {{$disabled}}" id="add_row_media_add">Add</a>
                        </div>
                        <div class="row col-md-12">
                            <h5>Details Of Outdoor Media Formatted Offered :-</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Outdoor media format for which applying / बाहरी मीडिया
                                        प्रारूप जिसके लिए आवेदन किया जा रहा है</label>
                                    <select name="Applying_For_OD_Media_Type" class="form-control form-control-sm"
                                        style="width: 100%;" {{$disabled}}>
                                        <option value="">Select Per Annum</option>
                                        @if(@$OD_media_address['Applying For OD Media Type']==1)
                                        <option value="1" selected="selected">Per Annum 1</option>
                                        @else
                                        <option value="2" selected="selected">Per Annum 2</option>
                                        @endif
                                        <option value="1">Per Annum 1</option>
                                        <option value="2">Per Annum 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-top: 24px;">
                                <div class="form-group">
                                    <label for="year">Display size of media / मीडिया का प्रदर्शन
                                        आकार<font color="red">*</font></label>

                                    <input type="text" name="ODMFO_Display_Size_Of_Media"
                                        placeholder="Display size of media" class="form-control form-control-sm"
                                        id="size_of_media" maxlength="18"
                                        value="{{ @$vendor_data[0]['Media Display size'] ? round(@$vendor_data[0]['Media Display size'],2) : ''}}"
                                        {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="year">Illumination / रोशनी</label>
                                    <input type="text" name="Illumination_media" placeholder="Illumination"
                                        onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm"
                                        id="Illumination" maxlength="9" value="{{$vendor_data[0]['Illumination']??''}}"
                                        {{$disabled}}>
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <h5>Details of work done in last year, for the applied media only, if
                                any (As per format given below) :-</h5>
                        </div><br>
                        @foreach($OD_work_dones as $work_done_data)
                        <div class="row" id="details_of_work_done">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="year">Year / वर्ष<font color="red">*</font></label>
                                    <select name="ODMFO_Year[]" id="Years0"
                                        class="form-control form-control-sm ddlYears" {{$disabled}}>
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
                                    <input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]"
                                        id="quantity_duration" placeholder="Enter Quantity of Display or Duration"
                                        class="form-control form-control-sm" maxlength="8"
                                        onkeypress="return onlyNumberKey(event)"
                                        value="{{$work_done_data['Qty Of Display_Duration'] ?? ''}}" {{$disabled}}>
                                    <input type="hidden" value="{{$work_done_data['Line No_'] ?? ''}}" name="line_no[]">
                                </div>
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
                                    <input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount"
                                        placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm"
                                        onkeypress="return onlyNumberKey(event)" maxlength="8"
                                        value="{{$work_done_data1}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="upload_doc1">Upload Document / दस्तावेज़ अपलोड
                                        करें</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="ODMFO_Upload_Document[]" class="custom-file-doc"
                                                data="0" onchange="return uploadFile(0,this)" id="upload_doc_0"
                                                {{$disabled}} accept="application/pdf">
                                            <label class="custom-file-label" for="upload_doc_0" id="choose_file0">Choose
                                                file</label>
                                            <!-- <span id="alert_upload_doc" style="color: red;"></span> -->
                                            <input type="hidden" name="" value="{{ @$work_done_data['File Name']}}">
                                        </div>

                                        @if(@$work_done_data['File Uploaded'] == '1')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a
                                                    href="{{ url('/uploads') }}/sole-right-media/{{ $work_done_data['File Name'] }}"
                                                    target="_blank">View</a></span>
                                        </div>
                                        @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="upload_file0">Upload</span>
                                        </div>
                                        @endif
                                    </div>
                                    <span id="upload_doc_error0" class="error invalid-feedback"></span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="row" style="float:right;margin-top: 6px;">
                            <input type="hidden" name="count_i" value="0" id="count_i">
                            <a class="btn btn-primary {{$disabled}}" id="add_row_next">Add</a>
                        </div><br><br>
                        <div class="row col-md-12">
                            <h5>Details of GST :-</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gst_no">GST No. / जीएसटी संख्या</label>
                                    <input type="text" class="form-control form-control-sm" name="GST_No" id="gst_no"
                                        placeholder="Enter GST No." maxlength="15"
                                        onkeypress="return isAlphaNumeric(event)"
                                        value="{{$vendor_data[0]['GST No_'] ?? ''}}" {{$disabled}}>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tin_tan_vat_no">TIN/TAN/VAT No.(if applicable) /
                                        टिन/टैन/वैट संख्या (यदि लागू हो)</label>
                                    <input type="text" class="form-control form-control-sm" name="TIN_TAN_VAT_No"
                                        id="tin_tan_vat_no" placeholder="Enter TIN/TAN/VAT No.(if applicable)"
                                        maxlength="15" onkeypress="return isAlphaNumeric(event)"
                                        value="{{$vendor_data[0]['TIN_TAN_VAT No_'] ?? ''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tin_tan_vat_no">Any other relevant information / कोई
                                        अन्य प्रासंगिक जानकारी</label>
                                    <input type="text" class="form-control form-control-sm"
                                        name="Other_Relevant_Information" id="tin_tan_vat_no"
                                        placeholder="Enter Any other relevant information" maxlength="80"
                                        value="{{$vendor_data[0]['Other Relevant Information'] ?? ''}}" {{$disabled}}>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="vendorid_tab_2" id="vendorid_tab_2" value="">
                        <input type="hidden" name="next_tab_2" id="next_tab_2" value="0">
                        <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i>
                            Previous</a>
                        <a class="btn btn-primary pm-next-button" id="tab_2">Next <i
                                class="fa fa-arrow-circle-right fa-lg"></i></a>
                        <!-- <a class="btn btn-primary" onclick="stepper.next()">Next</a> -->
                    </div>
                    <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        <br>
                        <div class="row col-md-12">
                            <h5>Fee/DD Details :-</h5>
                            <p>Application fee Rs.1000/- (non refundable) per media format (in the shape of DD in favor
                                of PAO BOC ETC)</p>
                        </div><br>
                        <div class="row">
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
                        </div>

                        <div class="row">
                            <div class="row col-md-12">
                                <p style="padding-left: 14px;">NTFT Details :-</p>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="agency_name">Agency Name / एजेंसी का नाम<font color="red">*
                                        </font></label>
                                    <input type="text" name="PM_Agency_Name" class="form-control form-control-sm"
                                        placeholder="Enter Agency Name" maxlength="40"
                                        value="{{$vendor_data[0]['PM Agency Name'] ?? ''}}" {{ $disabled }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pan_no">Pan No. / पैन नंबर<font color="red">*</font>
                                    </label>
                                    <input type="text" name="PAN" class="form-control form-control-sm"
                                        placeholder="Enter Pan No." maxlength="10"
                                        onkeypress="return isAlphaNumeric(event)"
                                        value="{{$vendor_data[0]['PAN'] ?? ''}}" {{ $disabled }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name / बैंक का नाम<font color="red">
                                            *</font></label>
                                    <input type="text" name="Bank_Name" id="bank_name_2"
                                        class="form-control form-control-sm" placeholder="Enter Bank Name"
                                        maxlength="30" onkeypress="return onlyAlphabets(event)"
                                        value="{{$vendor_data[0]['Bank Name'] ?? ''}}" {{ $disabled }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch">Branch / शाखा<font color="red">*</font>
                                    </label>
                                    <input type="text" name="Bank_Branch" id="branch_2"
                                        class="form-control form-control-sm" placeholder="Enter branch" maxlength="30"
                                        value="{{$vendor_data[0]['Bank Branch'] ?? ''}}" {{ $disabled }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ifsc_code">IFSC Code / आई एफ एस सी कोड<font color="red">*</font>
                                    </label>
                                    <input type="text" name="IFSC_Code" id="ifsc_code_sole"
                                        class="form-control form-control-sm" placeholder="Enter IFSC Code"
                                        maxlength="11" onkeypress="return isAlphaNumeric(event)"
                                        value="{{$vendor_data[0]['IFSC Code'] ?? ''}}" {{ $disabled }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_no">Account no / खाता नंबर<font color="red">
                                            *</font></label>
                                    <input type="text" name="Account_No" id="account_no"
                                        class="form-control form-control-sm" placeholder="Enter Account no"
                                        onkeypress="return onlyNumberKey(event)" maxlength="20"
                                        value="{{$vendor_data[0]['Account No_'] ?? ''}}" {{ $disabled }}>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="payment_mode3" style="display:none;">


                        </div>
                        <input type="hidden" name="vendorid_tab_3" id="vendorid_tab_3" value="">
                        <input type="hidden" name="next_tab_3" id="next_tab_3" value="0">
                        <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i>
                            Previous</a>
                        <!-- <a class="btn btn-primary" onclick="stepper.next()">Next</a> -->
                        <a class="btn btn-primary pm-next-button" id="tab_3">Next <i
                                class="fa fa-arrow-circle-right fa-lg"></i></a>
                    </div>
                    <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                    <!-- <div class="card bg-light text-dark w-75">
                            <h6 class="text-center">Please submit data through vendor APP</h6>
                            <a href="#" class="card-link text-center">App link</a>
                        </div> -->
                        <!-- loop start -->
                        @foreach($latlongData1 as $key=>$latlong)
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
                                    <p> <img src="<?php echo "https://pingtrack.azurewebsites.net/public/uploads/sole-right-media/".$latlong->{ 'Image File Name'} ?>" name="image" alt="img" target="_blank"
                                        width="60" height="60"></p>
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
                        <!-- Loop end -->

                        <input type="hidden" name="next_tab_4" id="next_tab_4" value="0">
                        <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i>
                            Previous</a>
                        <a class="btn btn-primary pm-next-button" id="tab_2">Next <i
                                class="fa fa-arrow-circle-right fa-lg"></i></a>

                    </div>
                    <div id="tab5" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        <div class="form-group">
                            <label for="exampleInputFile">Upload document of legal status of company
                                / कंपनी की कानूनी स्थिति का दस्तावेज अपलोड करें</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Legal_Doc_File_Name" class="custom-file-input"
                                        id="Legal_Doc_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" id="Legal_Doc_File_Name2"
                                        for="Legal_Doc_File_Name">Choose file</label>
                                </div>
                                @if(@$vendor_data[0]['Company Legal Documents'] == '1')
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
                        <div class="form-group">
                            <label for="exampleInputFile">Upload document of outdoor media
                                format(attach supportive documents viz,Notarized copy of agreement
                                of sole right indicating location, receipt of amount paid, validity
                                etc/ allotment letter where agreement is not executed) / आउटडोर
                                मीडिया प्रारूप का दस्तावेज अपलोड करें (समर्थक दस्तावेज संलग्न करें,
                                जैसे कि एकमात्र अधिकार के समझौते की नोटरीकृत प्रति, स्थान का संकेत,
                                भुगतान की गई राशि की प्राप्ति, वैधता आदि / आवंटन पत्र जहां समझौता
                                निष्पादित नहीं किया गया है)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Notarized_Copy_File_Name" class="custom-file-input"
                                        id="Notarized_Copy_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" for="Notarized_Copy_File_Name"
                                        id="Notarized_Copy_File_Name2">Choose file</label>
                                </div>
                                @if(@$vendor_data[0]['Notarized Copy Of Agreement'] == '1')
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

                        <div class="form-group">
                            <label for="exampleInputFile">Attach copy of Pan Number and
                                authorization of Bank for NEFT payment / एनईएफटी भुगतान के लिए पैन
                                नंबर और बैंक के प्राधिकरण की प्रति संलग्न करें</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Attach_Copy_Of_Pan_Number_File_Name"
                                        class="custom-file-input" id="Attach_Copy_Of_Pan_Number_File_Name"
                                        {{$disabled}}>
                                    <label class="custom-file-label" id="Attach_Copy_Of_Pan_Number_File_Name2"
                                        for="Attach_Copy_Of_Pan_Number_File_Name">Choose
                                        file</label>
                                </div>
                                @if(@$vendor_data[0]['PAN Attached'] == '1')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a
                                            href="{{ url('/uploads') }}/sole-right-media/{{ $vendor_data[0]['PAN File Name'] }}"
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

                        <div class="form-group">
                            <label for="exampleInputFile">Submit an affidavit on stamp paper stating
                                on oath that the details submitted by you on performa are true and
                                correct.Mention the application no. in affidavit / स्टाम्प पेपर पर
                                शपथ पत्र पर शपथ पत्र प्रस्तुत करें कि आपके द्वारा प्रस्तुत किए गए
                                विवरण सत्य और सही हैं। आवेदन संख्या का उल्लेख करें। हलफनामे
                                में</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Affidavit_File_Name" class="custom-file-input"
                                        id="Affidavit_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" id="Affidavit_File_Name2"
                                        for="Affidavit_File_Name">Choose file</label>
                                </div>
                                @if(@$vendor_data[0]['Affidavit Of Oath'] == '1')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a
                                            href="{{ url('/uploads') }}/sole-right-media/{{ $vendor_data[0]['Affidavit File Name'] }}"
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
                        <div class="form-group">
                            <label for="exampleInputFile">Photographs of displayed medium (Separate
                                photo for each property) / प्रदर्शित माध्यम की तस्वीरें (प्रत्येक
                                संपत्ति के लिए अलग फोटो)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Photo_File_Name" class="custom-file-input" data="0"
                                        onchange="return uploadFile(0,this)" id="Photo_File_Name" {{$disabled}}>
                                    <label class="custom-file-label" id="Photo_File_Name2" for="Photo_File_Name">Choose
                                        file</label>
                                </div>
                                @if(@$vendor_data[0]['Photographs'] == '1')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a
                                            href="{{ url('/uploads') }}/sole-right-media/{{ $vendor_data[0]['Photo File Name'] }}"
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

                        <div class="form-group">
                            <label for="exampleInputFile">GST registration Certificate / जीएसटी
                                पंजीकरण प्रमाणपत्र</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="GST_File_Name" class="custom-file-input" id="GST_File_Name"
                                        {{$disabled}}>
                                    <label class="custom-file-label" id="GST_File_Name2" for="GST_File_Name">Choose
                                        file</label>
                                </div>
                                @if(@$vendor_data[0]['GST Registration'] == '1')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a
                                            href="{{ url('/uploads') }}/sole-right-media/{{ $vendor_data[0]['GST File Name'] }}"
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

                        <!-- checkbox -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" name="self_declaration" id="self_declaration" {{ $Self_Dec }}
                                        {{$disabled}}>
                                    <label for="self_declaration">Self declaration / स्वयं
                                        घोषित</label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="odmedia_id" id="odmedia_id" value="">
                        <input type="hidden" name="submit_btn" id="submit_btn" value="0">
                        <input type="hidden" name="vendorid_tab_4" value="">
                        <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i>
                            Previous</a>&nbsp;
                        <input type="hidden" name="od_media_id" value="{{$media_id}}">

                        <a class="btn btn-primary" onclick="nextSaveData('submit_btn');"><i class="fa fa-paper-plane"
                                aria-hidden="true"></i> Submit</a>
                        <!--<button type="submit" id="sub_btn" class="btn btn-primary" onclick="nextSaveData('submit_btn');">Submit</button>
                        -->
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
<script src="{{ url('/js') }}/sole-right-validation.js"></script>
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script> -->
<script>
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

$(document).ready(function() {
    $("#add_row").click(function() {
        var i = $("#increse_i").val();
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
                $("#details_of_owner").append(
                    '<div class="row" style="padding: 10px 18px 0 18px;"><div class="col-md-4"><div class="form-group"><label for="owner_name">Publication Name / प्रकाशन का नाम</label><p><input type="text" name="owner_name[]" id="owner_name' +
                    i +
                    '" placeholder="Enter Owner`s Name" maxlength="40" class="form-control form-control-sm owner_name"></p></div></div><div class="col-md-4"><div class="form-group"><label for="email">Email / ईमेल<font color="red">*</font></label><p><input type="text" name="owner_email[]" id="owner_email' +
                    i +
                    '" placeholder="Enter Email" maxlength="30" onkeyup="return checkUniqueOwnerSoleRight(this, this.value,' +
                    i +
                    ')" class="form-control form-control-sm"><span id="alert_owner_email' +
                    i +
                    '" style="color:red;display: none;"></span></p></div></div><div class="col-md-4"><div class="form-group"><label for="mobile">Mobile / मोबाइल<font color="red">*</font></label><p><input type="text" name="owner_mobile[]" id="owner_mobile' +
                    i +
                    '" maxlength="10" placeholder="Enter Mobile" onkeyup="return checkUniqueOwnerSoleRight(this, this.value,' +
                    i +
                    ')" class="form-control form-control-sm"><span id="alert_owner_mobile' +
                    i +
                    '" style="color:red;display: none;"></span></p></div></div><div class="col-md-4"><div class="form-group"><label for="address">Address / पता<font color="red">*</font></label><p><textarea type="text" name="address[]" id="owner_address' +
                    i +
                    '" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm"></textarea></p></div></div><div class="col-md-4"><div class="form-group"><label for="Name">State / राज्य<font color="red">*</font></label><p><select  id="owner_state' +
                    i +
                    '" name="state[]" class=" form-control form-control-sm call_district" data="owner_district' +
                    i + '">' + html +
                    '</select></p></div></div><div class="col-md-4"><div class="form-group"><label for="Name">District / ज़िला<font color="red">*</font></label><p><select  id="owner_district' +
                    i +
                    '" name="district[]" class="form-control form-control-sm"></select></p></div></div><div class="col-md-4"><div class="form-group"><label for="phone">City / नगर<font color="red">*</font></label><p><input type="text" name="city[]" id="owner_city' +
                    i +
                    '" placeholder="Enter City" class="form-control form-control-sm" maxlength="20"></p></div></div><div class="col-md-4"><div class="form-group"><label for="phone">Phone No / फोन नंबर</label><input type="text" name="phone[]" id="owner_phone ' +
                    i +
                    '" maxlength="14" placeholder="Enter Phone No" class="form-control form-control-sm input-imperial" onkeypress="return onlyNumberKey(event)"></div></div><div class="col-md-4"><div class="form-group"> <label for="fax">Fax / फैक्स</label><input type="text" name="fax_no[]" id="owner_fax' +
                    i +
                    '" placeholder="Enter Fax" class="form-control form-control-sm" maxlength="14"></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 87px;"><button class="btn btn-danger remove_row">Remove</button></div></div>'
                    );
            }
        });
        $("#increse_i").val(i);
    });
    $("#details_of_owner").on('click', '.remove_row', function() {
        $(this).parent().parent().remove();
    });
});


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
                    '" class=" form-control form-control-sm"><option value="">Select District</option><option value="1">Uttar Pradesh</option><option value="2">Madhya Pradesh</option><option value="3">Kherla</option></select><span id="alert_dist_dd" style="color: red;"></span></div></div><div class="col-md-4"><div class="form-group"><label for="Name">City / नगर<font color="red">*</font></label> <input type="text" name="MA_City[]" maxlength="20" class="form-control form-control-sm" placeholder="City"><span id="alert_country_dd" style="color: red;"></span></div></div><div class="col-md-4"><div class="form-group"><label for="license_to">Zone  / क्षेत्र</label><input type="text" name="MA_Zone[]" placeholder="Zone" maxlength="8" onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm" id="zone"></div></div><div class="col-md-4"><div class="form-group"><label for="license_to">Latitude  / अक्षांश<font color="red">*</font></label><input type="text" name="MA_Latitude[]"  maxlength="20" onkeypress="return onlyDotNumberKey(event)" placeholder="Latitude" class="form-control form-control-sm lat_cls" id="Latitude"></div></div><div class="col-md-4"><div class="form-group"><label for="license_to">Longitude  / देशान्तर<font color="red">*</font></label><input type="text" name="MA_Longitude[]" placeholder="Longitude" maxlength="20" onkeypress="return onlyDotNumberKey(event)" class="form-control form-control-sm lat_cls" id="Longitude"></div></div><div class="col-md-4"><div class="form-group"><label for="license_to">Property Landmark  / संपत्ति सीमाचिह्न<font color="red">*</font></label><input type="text" name="MA_Property_Landmark[]" maxlength="80" placeholder="Property Landmark" class="form-control form-control-sm" id="property_landmark"></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 87px;"><button class="btn btn-danger remove_row">Remove</button></div></div>'
                );
            }
        });
        $("#count_id").val(i);
    });
    $("#media_address").on('click', '.remove_row', function() {
        $(this).parent().parent().remove();
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

        $("#details_of_work_done").append(
            '<div class="row"><div class="col-md-4"><div class="form-group"><label for="year">Year / वर्ष<font color="red">*</font></label><select name="ODMFO_Year[]" id="Years' +
            i +
            '" class="form-control form-control-sm ddlYears"><option value="">Select Year</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="quantity_duration">Quantity of Display or Duration / प्रदर्शन या अवधि की मात्रा<font color="red">*</font></label><input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" maxlength="8" id="quantity_duration" onkeypress="return onlyNumberKey(event)" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm"></div></div><div class="col-md-4"><div class="form-group"><label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि (रु)<font color="red">*</font></label><input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" maxlength="14" onkeypress="return onlyNumberKey(event)"></div></div><div class="col-md-4"><div class="form-group"><label for="upload_doc_0' +
            i +
            '">Upload Document / दस्तावेज़ अपलोड करें</label><div class="input-group"><div class="custom-file"><input type="file" name="ODMFO_Upload_Document[]" class="custom-file-doc" id="upload_doc_' +
            i + '"  onchange="return uploadFile(' + i + ',this)" data="' + i +
            '"><label class="custom-file-label" for="upload_doc_' + i + '" id="choose_file' + i +
            '">Choose file</label></div><div class="input-group-append"><span class="input-group-text" id="upload_file' +
            i + '">Upload</span></div></div><span id="upload_doc_error' + i +
            '" class="error invalid-feedback"></span></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 87px;"><button class="btn btn-danger remove_row_next">Remove</button></div></div>'
        );
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
//});

////////////// file upload size  512kb ////////////////
$(document).ready(function() {
    $(".custom-file-input").change(function() {
        var id = $(this).attr("id");
        id.slice(1);
        // console.log(id);
        var file = this.files[0].name;
        var totalBytes = this.files[0].size;
        var sizeKb = Math.floor(totalBytes / 1000);
        var ext = file.split('.').pop();
        if (file != '' && sizeKb < 512 && ext == "pdf") {
            $("#" + id + 2).empty();
            $("#" + id + 2).text(file);
            $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass(
                "input-group-text");
            $("#" + id + 1).hide();
        } else {
            $("#" + id).val('');
            $("#" + id + 2).text("Choose file");
            $("#" + id + 1).text('File size should be less than 512kb and file should be pdf!');
            $("#" + id + 1).show();
            $("#" + id + 3).html("Upload").addClass("input-group-text");
            $("#" + id + "-error").addClass("hide-msg");
        }
    });

});

function uploadFile(i, thiss) {
    var file = thiss.files[0].name;
    var totalBytes = thiss.files[0].size;
    var sizeKb = Math.floor(totalBytes / 1000);
    var ext = file.split('.').pop();
    if (file != '' && sizeKb < 512 && ext == "pdf") {
        $("#choose_file" + i).empty();
        $("#choose_file" + i).text(file);
        $("#upload_file" + i).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
        $("#upload_doc_error" + i).hide();
    } else {
        //console.log("hello");
        $("#upload_doc" + i).val('');
        $("#choose_file" + i).text("Choose file");
        $("#upload_doc_error" + i).text('File size should be less than 512kb and file should be pdf!');
        $("#upload_doc_error" + i).show();
        $("#upload_file" + i).html("Upload").addClass("input-group-text");
        $("#upload_doc" + i + "-error").addClass("hide-msg");
    }
}

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

                            if (response.ownerID > 0) {
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

//  next and previous function for save
function nextSaveData(id) {
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
            //console.log(data);
            if (data.success == false) {
                $('.alert-danger').fadeIn().html(data.message);
                setTimeout(function() {
                    $('.alert-success').fadeOut("slow");
                    //window.location.reload();
                }, 5000);
            }
            if (data.success == true) {
                if (id == 'next_tab_1') {
                    $("#ownerid").val(data.data);
                } else {
                    //console.log(data.data);
                    $("#vendorid_tab_2").val(data.data);
                    $("#vendorid_tab_3").val(data.data);
                    $("#vendorid_tab_4").val(data.data[0]);
                    if (id == "submit_btn") {
                        $('.alert-success').fadeIn().html(data.message);
                        // setTimeout(function() {
                        //     $('.alert-success').fadeOut("slow");
                        //     window.location.href = 'viewSoleRightMedia/' + data.data;
                        //     //window.location.href("{{ url('viewSoleRightMedia/')}}");
                        // }, 5000);

                    }
                }
            }
        },
        error: function(error) {
            console.log('error');
        }
    });
}
$('.alert-success').fadeOut()
$('.alert-danger').fadeOut()
</script>
@endsection