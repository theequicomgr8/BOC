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
</style>

@section('content')
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-normal text-primary">Application Form for Rate Settlement of Private Media</h6>
    </div>
    @php

    $owner_data_only =$owner_data_only ?? [1];
    $owner_data=$owner_data ?? [1];
    $OD_work_dones=@$OD_work_dones_data ? @$OD_work_dones_data : [1];
    $OD_media_address_data=$OD_media_address_data ?? [1];
    $vendor_data =$vendor_data ?? [1];

    $readonly = ' ';
    $disabled = '';
    $checked = ' ';
    $Self_Dec='';

    $media_id =@$vendor_data[0]['OD Media ID'];
    if(@$vendor_data[0]['Status'] == 1){
    $disabled = 'disabled1';
    $readonly = 'readonly';
    $checked = 'checked';
    $Self_Dec = $vendor_data[0]['Self-declaration'] == 1 ? "checked" : "";
    }
    @endphp

    <div class="card-body">
      @if(session()->has('status'))
      <div align="center" class="alert alert-success">
        {{ session()->get('msss') }}
      </div>
      @endif
      <div class="alert alert-success alert-dismissible text-center fade show" id="Final_submi" style="display: none;" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- /.end card-header -->
      <div class="card-body p-0">
        <div class="rrrrrrrr"></div>

        <form action="" method="POST" id="private_media" autocomplete="" enctype="multipart/form-data">

          <!-- /.end card-header -->

          @csrf

          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active show" id="#tab1">Basic Information</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="#tab2">Outdoor Information</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="#tab3">Account Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="#tab4">Upload Document</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="#tab5">Advertisement Details</a>
            </li>
          </ul>
          @if ($errors->any())
          {!! implode('', $errors->all(' <p align="center" style="color:red">:message</P>')) !!}
          @endif
          <div class="tab-content p-3">

  


            <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="logins-part-trigger">
              <div class="row col-md-12">
                <!-- <h4>Details of owner (Proprietor/Partner/Directors) Of Company :-</h4> -->
              </div>
              <!-- @php
              $i=0;
              $ownerid=[];
              @endphp -->
              @foreach($owner_data as $key=>$ownerlist)
              <div class="row" id="details_of_owner">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="owner_name">Publication Name / ????????????????????? ?????? ?????????<font color="red">*</font></label>
                    <!-- <p> -->
                    <input type="text" name="owner_name" id="owner_name0" placeholder="Enter Publication Name" class="form-control form-control-sm owner_name" onkeypress="return onlyAlphabets(event,this);" maxlength="40" value="{{$ownerlist['Owner Name'] ?? ''}}" {{$disabled}}>
                    <!-- </p> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="email">E-mail ID(Owner) / ??? ????????? ????????????<font color="red">*</font></label>
                    <!-- <p> -->
                    <input type="email" class="form-control form-control-sm" id="email0" name="email_owner" maxlength="50" placeholder="Enter Email ID" value="{{$ownerlist['Email ID'] ?? ''}}" onkeyup="return checkUniqueOwner(this, this.value,0)" {{ @$readonly }}>
                    <span id="alert_email0" style="color:red;display: none;"></span>
                    <!-- </p> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="mobile">Mobile No / ?????????????????? ????????????<font color="red">*</font></label>
                    <!-- <p> -->
                    <input type="text" class="form-control form-control-sm" id="mobile0" name="mobile_owner" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$ownerlist['Mobile No_'] ?? ''}}" onkeyup="return checkUniqueOwner(this, this.value,0)" {{ @$readonly }}>
                    <span id="alert_mobile0" style="color:red;display: none;"></span>
                    <!-- </p> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="address">Address / ?????????<font color="red">*</font></label>
                    <p>
                      <textarea name="address_owner" id="address0" placeholder="Enter Address" rows="2" cols="50" maxlength="120" class="form-control form-control-sm" {{$disabled}}>{{$ownerlist['Address 1']?? ''}}</textarea>
                    </p>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Name">State / ???????????????<font color="red">*</font></label>
                    <p>
                      <select id="state_id0" name="state_owner" class="form-control form-control-sm call_district" data="district_id{{$i}}" {{$disabled}}>
                        <option value="">Select State</option>
                        @if(@$ownerlist['State'])
                        <option selected="selected"> {{$ownerlist['State']}}</option>
                        @endif
                        @if(count($states) > 0)
                        @foreach($states as $statesData)
                        <option value="{{ $statesData['Code'] }}">{{$statesData['Description']}}</option>
                        @endforeach
                        @endif
                      </select>
                    </p>
                    <!--  <input type="hidden" id="state_val0" name="state[]" value="{{$ownerlist['State'] ?? '' }}"> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Name">District / ???????????????<font color="red">*</font></label>
                    <p>
                      <select id="district_id{{$i}}" name="district_owner" class="form-control form-control-sm" {{$disabled}}>
                        <option value="">Select District</option>
                        @if(@$ownerlist['District'])
                        <option selected="selected"> {{$ownerlist['District']}}</option>
                        @endif
                      </select>
                    </p>
                    <!--  <input type="hidden" id="district_val0" name="district[]" value="{{$ownerlist['District'] ?? '' }}"> -->
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Name">City / ?????????<font color="red">*</font></label>
                    <p>
                      <input type="text" name="city" class="form-control form-control-sm" id="city0" placeholder="City" value="{{$ownerlist['City'] ?? ''}}" {{$disabled}} onkeypress="return onlyAlphabets(event,this);" maxlength="30">
                    </p>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="phone">Phone No / ????????? ????????????</label>
                    <input type="text" name="phone" maxlength="14" id="phone0" onkeypress="return onlyNumberKey(event)" placeholder="Enter Phone No" class="form-control form-control-sm input-imperial" value="{{$ownerlist['Phone No_']?? ''}}" {{$disabled}}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="fax">Fax / ???????????????</label>
                    <input type="text" name="fax_no" id="fax0" onkeypress="return onlyNumberKey(event)" maxlength="14" placeholder="Enter Fax" class="form-control form-control-sm" value="{{$ownerlist['Fax No_']?? ''}}" {{$disabled}}>
                    <!-- @php
                    if(!empty($ownerlist['Owner ID'])) {
                    $ownerid[]=$ownerlist['Owner ID'];
                    }
                    $i++;
                    @endphp -->
                  </div>
                </div>
              </div>
              <input type="hidden" name="ownerid" id="ownerid" value="{{$ownerlist['Owner ID'] ?? ''}}">
              @endforeach


              <div class="row" id="add_row_davp" style="float:right;margin-top:6px;">
                <input type="hidden" name="mobilecheck" id="mobilecheck">
                <input type="hidden" name="owner_input_clean" id="owner_input_clean">
                <input type="hidden" name="user_id" value="{{ session('id') }}">
                <input type="hidden" name="user_email" value="{{ session('email') }}">
                <!-- @php $ownerd = implode(",",$ownerid)@endphp
                @if(!empty($ownerd))
                <input type="hidden" name="ownerid[]" id="ownerid" value="{{$ownerd}}">
                @else
                <input type="hidden" name="ownerid[]" id="ownerid" value="">
                @endif -->
                <input type="hidden" name="emailarr[]" id="emailarr" value="">
                
                {{-- @if(@$vendor_data[0]['Status'] == 1)
                <input type="hidden" name="next_tab_11" id="next_tab_11" value="0">
                @else
                <input type="hidden" name="next_tab_1" id="next_tab_1" value="0">
                @endif --}}

                <input type="hidden" name="next_tab_1" id="next_tab_1" value="0">

                <input type="hidden" class="btn btn-primary {{$disabled}}" id="add_row">
                <input type="hidden" id="count_dist_i" value="0">
              </div>
              <!-- Old code comment by sk  -->
              {{-- @if(@$vendor_data[0]['Status'] == 1)
              <a class="btn btn-primary pm-next-button" id="tab_11">Next</a>
              @else
              <a class="btn btn-primary pm-next-button" id="tab_1">Next</a>
              @endif --}}

              <a class="btn btn-primary pm-next-button" id="tab_1">Next</a> <!-- change sk -->
            </div>
            <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="logins-part-trigger">
              <div class="row col-md-12">
                <h4 class="subheading">Head Office :-</h4>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="address">Address / ?????????<font color="red">*</font></label>
                    <textarea type="text" name="HO_Address" id="address1" maxlength="120" placeholder="Enter Address" rows="2" class="form-control form-control-sm" {{$disabled}}>{{$vendor_data[0]['HO Address']??''}}</textarea>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="landline_no">Landline No. / ???????????????????????? ????????????<font color="red">*</font></label>
                    <input type="text" name="HO_Landline_No" id="landline_no" placeholder="Enter Landline No." class="form-control form-control-sm" id="landline_head_office" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['HO Landline No_']??''}}" {{$disabled}}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="fax_no">Fax No. / ?????????????????? ????????????</label>
                    <input type="text" name="HO_Fax_No" placeholder="Enter Fax No" class="form-control form-control-sm" id="fax_no" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['HO Fax No_']??''}}" {{$disabled}}>
                  </div>
                </div>
                @php
                $datA = Session::get('email');
                @endphp
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="email_1">E-mail / ????????????<font color="red">*</font></label>
                    <input type="text" name="HO_Email" placeholder="Enter E-mail" class="form-control form-control-sm" id="HO_Email" value="{{$vendor_data[0]['HO E-Mail']??$datA}}" {{$disabled}} maxlength="50" onkeyup="return checkUniqueVendor('email', this.value)">
                    <span id="v_alert_email" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="v_mobile">Mobile No / ?????????????????? ????????????<font color="red">*</font></label>
                    <input type="text" class="form-control form-control-sm" id="HO_Mobile_No" name="HO_Mobile_No" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$vendor_data[0]['HO Mobile No_']??''}}" onkeyup="return checkUniqueVendor('mobile', this.value)" {{ @$readonly }}>
                    <span id="v_alert_mobile" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <h4 class="subheading" style="width: 191px;">Branch Office (if any) :-</h4>
                </div>
                <div class="col-md-9" style="margin-top: 5px;">
                  @php
                  $checked1 = '';
                  $checked0 = '';
                  $displayed = '';
                  if(!empty(@$vendor_data) && (@$vendor_data[0]['BO Address'] !='' || @$vendor_data[0]['BO Landline No_'] !='' || @$vendor_data[0]['BO Fax No_'] !='' || @$vendor_data[0]['BO E-Mail'] !='' || @$vendor_data[0]['BO Mobile No_'] !='')){

                  $checked1 = 'checked';
                  $displayed = 'block';

                  }else if(!empty(@$vendor_data) && (@$vendor_data[0]['BO Address'] =='' || @$vendor_data[0]['BO Landline No_'] =='' || @$vendor_data[0]['BO Fax No_'] =='' || @$vendor_data[0]['BO E-Mail'] =='' || @$vendor_data[0]['BO Mobile No_'] =='') && @$vendor_data[0] !=1){

                  $checked0 = 'checked';
                  $displayed = 'none';

                  }else{

                  $checked1 = 'checked';
                  $displayed = 'block';

                  }
                  @endphp
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input h5" name="boradio" value="1" {{$checked1}} {{$disabled}}> Yes / ?????????  &nbsp;
                      <input type="radio" class="form-check-input h5" name="boradio" value="0" {{$checked0}} {{$disabled}}>No / ????????????
                    </label>
                  </div>
                </div>
              </div>
              <div id="boradio" style="display: {{$displayed}}">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="address">Address / ?????????</label>
                      <textarea {{$disabled}} type="text" name="BO_Address" id="BO_Address" placeholder="Enter Address" rows="2" class="form-control form-control-sm" maxlength="120">{{$vendor_data[0]['BO Address']??''}}</textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="landline_no">Landline No. / ???????????????????????? ????????????</label>
                      <input type="text" name="BO_Landline_No" placeholder="Enter Landline No." id="BO_Landline_No" class="form-control form-control-sm" id="landline_no" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['BO Landline No_']??''}}" {{$disabled}}>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="fax_no">Fax No. / ?????????????????? ????????????</label>
                      <input type="text" name="BO_Fax_No" placeholder="Enter Fax No." id="BO_Fax_No" class="form-control form-control-sm" id="fax_no" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['BO Fax No_']??''}}" {{$disabled}}>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="email">E-mail. / ????????????</label>
                      <input type="text" name="BO_Email" placeholder="Enter E-mail" class="form-control form-control-sm" id="BO_Email" value="{{$vendor_data[0]['BO E-Mail']??''}}" {{$disabled}} maxlength="50">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="mobile">Mobile / ??????????????????</label>
                      <input type="text" name="BO_Mobile" placeholder="Enter Mobile" class="form-control form-control-sm" id="BO_Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$vendor_data[0]['BO Mobile No_']??''}}" {{$disabled}}>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row col-md-12">
                <h4 class="subheading">Authorized Representative :-</h4>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="address">Contact Person / ?????????????????? ????????????????????? <font color="red">*</font></label>
                    <textarea {{$disabled}} type="text" name="Authorized_Rep_Name" placeholder="Enter Contact Person" rows="1" class="form-control form-control-sm" maxlength="40">{{$vendor_data[0]['Authorized Rep Name']??''}}</textarea>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="address">Address / ????????? <font color="red">*</font></label>
                    <textarea {{$disabled}} type="text" name="AR_Address" maxlength="120" placeholder="Enter Address" rows="2" class="form-control form-control-sm">{{$vendor_data[0]['AR Address']??''}}</textarea>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="landline_no">Landline No. / ???????????????????????? ????????????<font color="red">*</font></label>
                    <input type="text" name="AR_Landline_No" placeholder="Enter Landline No." class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" id="landline_no" maxlength="14" value="{{$vendor_data[0]['AR Landline No_']??''}}" {{$disabled}}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="fax_no">Fax No. / ?????????????????? ???????????? </label>
                    <input type="text" name="AR_FAX_No" placeholder="Enter Fax No." class="form-control form-control-sm" id="fax_no" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['AR FAX No_']??''}}" {{$disabled}}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="email">E-mail. / ???????????? <font color="red">*</font></label>
                    <input type="text" name="AR_Email" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" value="{{$vendor_data[0]['AR E-mail']??''}}" {{$disabled}} maxlength="50">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="mobile">Mobile / ?????????????????? <font color="red">*</font></label>
                    <input type="text" name="AR_Mobile_No" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile" maxlength="10" value="{{$vendor_data[0]['AR Mobile No_']??''}}" {{$disabled}} onkeypress="return onlyNumberKey(event)">
                  </div>
                </div>
                @php
                $aary =array(1=>'Proprietorship One', 2=>'Proprietorship Two');
                @endphp
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Legal Status Of Company / ??????????????? ?????? ?????????????????? ??????????????????<font color="red">*</font></label>

                    <select {{$disabled}} name="Legal_Status_of_Company" class="form-control form-control-sm" style="width: 100%;">
                      <!--   <option value="0">Select Option</option>
                                @foreach($aary as $key=>$value){
                                <option value="{{$key}}" @if(@$vendor_data[0]['Legal Status of Company'] == $key)  selected="selected" @endif>{{$value}}</option>
                                @endforeach
                              } -->
                      <option value="">Select Proprietorship</option>
                      <option value="0" {{( @$vendor_data[0]['Legal Status of Company'] == 0 && @$vendor_data[0]['Legal Status of Company'] !='' ? 'selected' : '') }}>Proprietorship</option>
                      <option value="1" {{( @$vendor_data[0]['Legal Status of Company'] == 1 ? 'selected' : '') }}>partnership</option>
                      <option value="2" {{( @$vendor_data[0]['Legal Status of Company'] == 2 ? 'selected' : '') }}>Limited liability partnership</option>
                      <option value="3" {{( @$vendor_data[0]['Legal Status of Company'] == 3 ? 'selected' : '') }}>PSU</option>
                      <option value="4" {{( @$vendor_data[0]['Legal Status of Company'] == 4 ? 'selected' : '') }}>NGO</option>

                    </select>
                  </div>
                </div>
              </div>

              <div class="row col-md-12">
                <h4 class="subheading">Authority Details :-</h4>
              </div>
              <div class="row" id="authority_details">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="authority">Authority Which Granted Media With Address / ??????????????????????????? ??????????????? ?????????????????? ?????? ????????? ?????? ????????? ?????????????????? ????????????<font color="red">*</font></label>
                    <input type="text" name="Authority_Which_granted_Media" placeholder="Enter Authority Which Granted Media With Address" class="form-control form-control-sm" id="authority" maxlength="120" value="{{$vendor_data[0]['Authority Which granted Media']??''}}" {{$disabled}}>
                  </div>
                </div>
                <div class="col-md-4"><br><br>
                  <div class="form-group">
                    <label for="Contract_No">Contract No. / ?????????????????? ?????????????????????<font color="red">*</font></label>
                    <input type="text" name="Contract_No" placeholder="Enter Contract No." class="form-control form-control-sm" id="Contract_No" maxlength="15" value="{{$vendor_data[0]['Contract No_']??''}}" onkeypress="return onlyNumberKey(event)" {{$disabled}}>
                  </div>
                </div>
                <div class="col-md-4"><br><br>
                  <div class="form-group">
                    <label for="license_from">Quantity of Display / ???????????????????????? ?????? ??????????????????<font color="red">*</font></label>
                    <input type="text" name="Quantity_Of_Display" id="quantity_of_dis" placeholder="Quantity of Display" maxlength="5" value="{{$vendor_data[0]['Quantity Of Display']??''}}" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" {{$disabled}}>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="license_from">License start date / ????????????????????? ???????????? ???????????? ?????? ???????????????<font color="red">*</font></label>
                    <input type="date" name="License_From" placeholder="DD/MM/YYYY" class="form-control form-control-sm" min="{{ date('Y-m-d', strtotime('-10 years')) }}" max="{{date('Y-m-d')}}" value="{{ @$vendor_data[0]['License From'] ? date('Y-m-d', strtotime(@$vendor_data[0]['License From'])) : ''}}" {{$disabled}}>
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="license_to">License end date / ????????????????????? ????????????????????? ????????????<font color="red">*</font></label>
                    <input type="date" name="License_To" placeholder="DD/MM/YYYY" class="form-control form-control-sm" min="{{ date('Y-m-d',strtotime('-10 years')) }}" value="{{ @$vendor_data[0]['License To'] ? date('Y-m-d', strtotime(@$vendor_data[0]['License To'])) : ''}}" {{$disabled}}>
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
              </div>
              <div class="row col-md-12">
                <h4 class="subheading">Media Address:-</h4>
              </div>
              <div id="media_address">
                @php
                $lineone = [];
                @endphp
                @foreach($OD_media_address_data as $key => $OD_media_address)
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="Name">State / ???????????????<font color="red">*</font></label>
                      <p>
                        <select {{$disabled}} id="state_id_{{$key}}" name="MA_State[]" class="form-control form-control-sm call_district" data="district_ID{{$key}}">
                          <option value="">Select State</option>
                          @if(@$OD_media_address['State'])
                          <option selected="selected"> {{$OD_media_address['State']}}</option>
                          @endif
                          @if(count($states) > 0)
                          @foreach($states as $statesData)
                          <option value="{{ $statesData['Code'] }}">{{$statesData['Description']}}</option>
                          @endforeach
                          @endif
                        </select>
                      </p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="Name">District / ???????????????<font color="red">*</font></label>
                      <p>
                        <select {{$disabled}} id="district_ID{{$key}}" name="MA_District[]" class="form-control form-control-sm">
                          <option value="">Select District</option>
                          @if(@$OD_media_address['District'])
                          <option selected="selected"> {{$OD_media_address['District']}}</option>
                          @endif
                        </select>
                      </p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="Name">City / ?????????<font color="red">*</font></label>
                      <p>
                        <input type="text" name="MA_City[]" id="MA_City{{$key}}" class="form-control form-control-sm" placeholder="Enter City" value="{{$OD_media_address['City']?? ''}}" {{$disabled}} onkeypress="return onlyAlphabets(event,this);" maxlength="30">
                      </p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="license_to">Zone / ?????????????????????</label>
                      <p>
                        <input type="text" name="MA_Zone[]" placeholder="Zone" class="form-control form-control-sm" id="zone{{$key}}" maxlength="8" value="{{$OD_media_address['Zone']?? ''}}" {{$disabled}} onkeypress="return onlyNumberKey(event)">
                      </p>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="license_to">Property Landmark / ????????????????????? ????????? ?????? ???????????????<font color="red">*</font></label>
                      <p>
                        <input type="text" name="MA_Property_Landmark[]" placeholder="Property Landmark" class="form-control form-control-sm" id="property_landmark{{$key}}" maxlength="100" value="{{$OD_media_address['Landmark']?? ''}}" {{$disabled}}>
                      </p>
                      <span id="alert_property_landmark" style="color: red;"></span>
                    </div>
                  </div>
                </div>

                @php
                if(!empty($OD_media_address['Line No_'])) {
                $lineone[] =$OD_media_address['Line No_'];
                }
                $extline1 =implode(',', $lineone);

                @endphp
                @endforeach
              </div>
              <div class="row" style="float:right;margin-top: 6px;">
                <a class="btn btn-primary" {{$disabled}} id="add_row_media_add">Add</a>
                <input type="hidden" id="count_dist_latitude" value="{{$key ?? 0}}">
                <input type="hidden" name="lineno1[]" id="Lineno1" value="{{@$extline1 ?? ''}}">
              </div>
              <div class="row col-md-12">
                <h4 class="subheading">Details Of Outdoor Media Formatted Offered :-</h4>
              </div>
              @php
              $arr =array(1=>'Per Annum One', 2=>'Per Annum Two');
              @endphp
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Outdoor media format for which applying / ??????????????? ?????????????????? ????????????????????? ??????????????? ????????? ??????????????? ???????????? ?????? ????????? ??????</label>
                    <select name="Applying_For_OD_Media_Type" class="form-control form-control-sm" style="width: 100%;" {{$readonly}} {{$disabled}}>
                      <option value="1" <?= (@$OD_media_address['Applying For OD Media Type'] === 1 ? 'selected' : ''); ?>>Display Board</option>
                      <option value="2" <?= (@$OD_media_address['Applying For OD Media Type'] === 2 ? 'selected' : ''); ?>>Banner</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row col-md-12">
                <h4 class="subheading">Details of work done in last year, for the applied media only, if any (As per format given below) :-</h4>
              </div>
              <div id="details_of_work_done">
                @php
                $dd_line =[];
                $i = 0;
                @endphp
                @foreach($OD_work_dones as $key=>$work_done_data)
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
                <div class="row">
                  <div class="col-md-4"><br>
                    <div class="form-group">
                      <label for="year">Year / ????????????<font color="red">*</font></label>
                      <p>
                        <select name="ODMFO_Year[]" id="Years{{$i}}" class="form-control form-control-sm ddlYears {{ $click }}" tabindex="{{ $tabindexx }}" style="pointer-events: {{$point}};" {{$readonly}}>
                          @if(@$work_done_data['Year'] == '')
                          <option value="">Select Year</option>
                          @else
                          <option value="{{ $work_done_data['Year'] }}">{{ $work_done_data['Year'] }}</option>
                          @endif
                        </select>
                      </p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="quantity_duration">Quantity of Display or Duration / ???????????????????????? ?????? ???????????? ?????? ??????????????????<font color="red">*</font></label>
                      <p>
                        <input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" id="quantity_duration{{$i}}" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm" maxlength="8" onkeypress="return onlyNumberKey(event)" value="{{$work_done_data['Qty Of Display_Duration'] ?? ''}}" style="pointer-events: {{$point}};" {{$readonly}}>
                      </p>
                    </div>
                    <input type="hidden" name="allocated_vendor_code[]" value="{{$work_done_data['Allocated Vendor Code'] ?? ''}}">
                  </div>
                  <div class="col-md-4"><br>
                    <div class="form-group">
                      @php
                      if(@$work_done_data['Billing Amount'] == 0)
                      {
                      $work_done_data_billing = '';
                      }
                      else
                      {
                      $work_done_data_billing = round(@$work_done_data['Billing Amount'],2);
                      }
                      @endphp
                      <label for="billing_amount">Billing Amount(Rs) / ?????????????????? ???????????? (??????)<font color="red">*</font></label>
                      <p>
                        <input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount{{$i}}" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8" value="{{$work_done_data_billing}}" style="pointer-events: {{$point}};" {{$readonly}}>
                      </p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="upload_doc_1{{$i}}">Upload Document / ??????????????????????????? ??????????????? ????????????</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <p>
                            <input type="file" name="ODMFO_Upload_Document[]" class="custom-file-doc" data="0" onchange="return uploadFile({{$i}},this)" id="upload_doc_{{$i}}"  accept="application/pdf" style="opacity: 0;">
                          </p>
                          <label class="custom-file-label" for="upload_doc_{{$i}}" id="choose_file{{$i}}">{{ @$work_done_data['File Name'] ? @$work_done_data['File Name'] : 'Choose file' }}</label>
                          <input type="hidden" name="ODMFO_Upload_Document_[]" value="{{ @$work_done_data['File Name']}}">
                        </div>
                        @if(@$work_done_data['File Name'] != '')
                        <div class="input-group-append">
                          <span class="input-group-text"><a href="{{ url('/uploads') }}/private-media/{{@$work_done_data['File Name']}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                        </div>
                        @else
                        <div class="input-group-append">
                          <span class="input-group-text" id="upload_file{{$i}}">Upload</span>
                        </div>
                        @endif
                      </div>
                      <span id="upload_doc_error{{$i}}" class="error invalid-feedback"></span>
                    </div>
                  </div>
                </div>
                @php
                $i++;
                @endphp
                @endforeach
              </div>
              <div class="row" style="float:right;margin-top: 6px;">
                <input type="hidden" name="count_i" id="count_i" value="{{$key ?? 0}}">
                <a class="btn btn-primary {{$disabled}}" id="add_row_next">Add</a>
              </div>
              <div class="row col-md-12">
                <h4 class="subheading">Details of GST :-</h4>
              </div>
              <div class="row">
                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="gst_no">GST No. / ?????????????????? ??????????????????</label>
                    <input type="text" class="form-control form-control-sm" name="GST_No" id="gst_no" placeholder="Enter GST No." maxlength="15" onkeypress="return isAlphaNumeric(event)" onchange="return checksum(this.value)" value="{{$vendor_data[0]['GST No_'] ?? ''}}" {{$disabled}}>
                    <span class="gstvalidationMsg"></span>
                    <span class="validcheck"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="tin_tan_vat_no">TIN/TAN/VAT No.(if applicable) / ?????????/?????????/????????? ?????????????????? (????????? ???????????? ??????)</label>
                    <input type="text" class="form-control form-control-sm" name="TIN_TAN_VAT_No" id="tin_tan_vat_no" placeholder="Enter TIN/TAN/VAT No.(if applicable)" onkeypress="return isAlphaNumeric(event)" maxlength="15" value="{{$vendor_data[0]['TIN_TAN_VAT No_'] ?? ''}}" {{$disabled}}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="tin_tan_vat_no">Any other relevant information / ????????? ???????????? ??????????????????????????? ?????????????????????</label>
                    <input type="text" class="form-control form-control-sm" name="Other_Relevant_Information" id="tin_tan_vat_no[]" placeholder="Enter Any other relevant information" onkeypress="return isAlphaNumeric(event)" maxlength="100" value="{{$vendor_data[0]['Other Relevant Information'] ?? ''}}" {{$disabled}}>
                  </div>
                </div>
              </div>
              @if(!empty($vendor_data[0]['OD Media ID']))
              <input type="hidden" name="vendorid_tab_2" id="vendorid_tab_2" value="{{$vendor_data[0]['OD Media ID']}}">
              @else
              <input type="hidden" name="vendorid_tab_2" id="vendorid_tab_2" value="">
              @endif
              <!-- Old Code Comment By SK -->
              {{-- @if(@$vendor_data[0]['Status'] == 1)
              <input type="hidden" name="next_tab_22" id="next_tab_22" value="0">
              @else
              <input type="hidden" name="next_tab_2" id="next_tab_2" value="0">
              @endif --}}
              <input type="hidden" name="next_tab_2" id="next_tab_2" value="0"> <!-- Change Sk -->
              <a class="btn btn-primary reg-previous-button" id="prev_1">Previous</a>
              <!-- Old code comment by sk -->
              {{-- @if(@$vendor_data[0]['Status'] == 1)
              <a class="btn btn-primary pm-next-button" id="tab_22">Next</a>
              @else
              <a class="btn btn-primary pm-next-button" id="tab_2">Next</a>
              @endif --}}
              @if(@$vendor_data[0]['agency']=='')
              <input type="hidden" name="getID" id="getID" value="0">
              @else
              <input type="hidden" name="getID" id="getID" value="1">
              @endif

              <a class="btn btn-primary pm-next-button" id="tab_2">Next</a> <!-- change sk -->
            </div>
            <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="logins-part-trigger">
              <!-- <div class="row">
                @php
                $paycheck0 = '';
                $paycheck1 = '';
                if(@$vendor_data[0]['DD No_'] !=''){
                $paycheck0 = 'selected';
                }

                if(@$vendor_data[0]['PM Agency Name'] !=''){
                $paycheck1 = 'selected';
                }
                @endphp
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Payment Type</label>
                    <select class="form-control form-control-sm" id="select_payment" {{$disabled}}>
                      <option value="0" {{$paycheck0}}>Through DD</option>
                      <option value="1" {{$paycheck1}}>Through NEFT</option>
                    </select>
                  </div>
                </div>
              </div> -->
              <div class="row" id="dd_div" style="display: none;">
                <div class="col-md-12" style="display: flex;">
                  <h4 class="subheading">Fee/DD Details :- </h4>&nbsp; <p>Application fee Rs.1000/- (non refundable) per media format (in the shape of DD in favor of PAO BOC ETC)</p>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dd_no">DD No. / ???????????? ??????????????????<font color="red">*</font></label>
                    <input type="text" class="form-control form-control-sm" name="DD_No" id="dd_no" placeholder="Enter DD No." onkeypress="return onlyNumberKey(event)" maxlength="6" value="{{$vendor_data[0]['DD No_'] ?? ''}}" {{$disabled}}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dd_date">DD Date / ???????????? ????????????<font color="red">*</font></label>
                    <input type="date" class="form-control form-control-sm" name="DD_Date" placeholder="Enter DD Date" min="{{ date('Y-m-d',strtotime('-3 months')) }}" value="{{ @$vendor_data[0]['DD Date'] ? date('Y-m-d', strtotime(@$vendor_data[0]['DD Date'])) : ''}}" {{ $disabled }}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="bank_name">Bank Name / ???????????? ?????? ?????????<font color="red">*</font></label>
                    <input type="text" class="form-control form-control-sm" name="DD_Bank_Name" id="bank_name_1" placeholder="Enter Bank Name" onkeypress=" return onlyAlphabets(event)" value="{{$vendor_data[0]['DD Bank Name'] ?? ''}}" {{ $disabled }} maxlength="30">
                    <span id="alert_bank_name_1" style="color: red;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="branch_name">Branch Name/ ???????????? ?????? ?????????<font color="red">*</font></label>
                    <input type="text" class="form-control form-control-sm" name="DD_Bank_Branch_Name" placeholder="Enter Branch Name" value="{{$vendor_data[0]['DD Bank Branch Name'] ?? ''}}" {{ $disabled }} maxlength="30">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    @php
                    if(@$vendor_data[0]['Application Amount'] == 0)
                    {
                    $application_ammount_data = '';
                    }
                    else
                    {
                    $application_ammount_data = round(@$vendor_data[0]['Application Amount'],2);
                    }
                    @endphp
                    <label for="dd_account">DD Amount / ???????????? ???????????? <font color="red">*</font></label>
                    <input type="text" name="Application_Amount" id="dd_account" class="form-control form-control-sm" placeholder="Enter DD Account" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$application_ammount_data}}" {{ $disabled }}>

                  </div>
                </div>
              </div>
              <div class="row" id="neft_div">
                <div class="col-md-12" style="display: flex;">
                  <h4 class="subheading">NEFT Details :-</h4>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="pan_no">Pan No. / ????????? ????????????<font color="red">*</font></label>
                    <input type="text" name="PAN" class="form-control form-control-sm" id="pan_no" placeholder="Enter Pan No." maxlength="10" onkeypress="return isAlphaNumeric(event)" value="{{$vendor_data[0]['PAN'] ?? ''}}" {{ $disabled }} onchange="validatePanNumber(this)">
                    <span id="alert_pan_no" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="agency_name">Agency Name / ?????????????????? ?????? ?????????<font color="red">*</font></label>
                    <input type="text" name="PM_Agency_Name" class="form-control form-control-sm" placeholder="Enter Agency Name" maxlength="40" value="{{$vendor_data[0]['PM Agency Name'] ?? ''}}" {{ $disabled }}>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="bank_name">Bank Name / ???????????? ?????? ?????????<font color="red">*</font></label>
                    <input type="text" name="Bank_Name" id="bank_name_2" class="form-control form-control-sm" placeholder="Enter Bank Name" maxlength="40" onkeypress="return onlyAlphabets(event)" value="{{$vendor_data[0]['Bank Name'] ?? ''}}" {{ $disabled }} maxlength="40">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="branch">Branch / ????????????<font color="red">*</font></label>
                    <input type="text" name="Bank_Branch" id="branch_2" class="form-control form-control-sm" placeholder="Enter branch" maxlength="40" value="{{$vendor_data[0]['Bank Branch'] ?? ''}}" {{ $disabled }}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="ifsc_code">IFSC Code / ?????? ?????? ?????? ?????? ?????????<font color="red">*</font></label>
                    <input type="text" name="IFSC_Code" id="ifsc_code" class="form-control form-control-sm" placeholder="Enter IFSC Code" maxlength="11" onkeypress="return isAlphaNumeric(event)" value="{{$vendor_data[0]['IFSC Code'] ?? ''}}" {{ $disabled }} onchange="validateIfscCode(this);">
                    <span id="alert_ifsc_code" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="account_no">Account no / ???????????? ????????????<font color="red">*</font></label>
                    <input type="text" name="Account_No" id="account_no" class="form-control form-control-sm" placeholder="Enter Account no" onkeypress="return onlyNumberKey(event)" maxlength="20" value="{{$vendor_data[0]['Account No_'] ?? ''}}" {{ $disabled }}>
                  </div>
                </div>
              </div>

              @if(!empty($vendor_data[0]['OD Media ID']))
              <input type="hidden" name="vendorid_tab_3" id="vendorid_tab_3" value="{{$vendor_data[0]['OD Media ID']}}">
              @else
              <input type="hidden" name="vendorid_tab_3" id="vendorid_tab_3" value="">
              @endif
              <!-- Old Code comment by sk -->
              {{-- @if(@$vendor_data[0]['Status'] == 1)
              <input type="hidden" name="next_tab_33" id="next_tab_33" value="0">
              @else
              <input type="hidden" name="next_tab_3" id="next_tab_3" value="0">
              @endif --}}
              <input type="hidden" name="next_tab_3" id="next_tab_3" value="0"> <!-- SK Change -->
              <a class="btn btn-primary reg-previous-button" id="prev_2">Previous</a>
              <!-- Old Code comment by SK -->
              {{-- @if(@$vendor_data[0]['Status'] == 1)
              <a class="btn btn-primary pm-next-button" id="tab_33">Next</a>
              @else
              <a class="btn btn-primary pm-next-button" id="tab_3">Next</a>
              @endif --}}
              <a class="btn btn-primary pm-next-button" id="tab_3">Next</a> <!-- Change Sk -->
            </div>
            <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="information-part-trigger">
              <div class="row">
                @if(@$vendor_data[0]['Legal Doc File Name']=="")
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Upload document of legal status of company / ??????????????? ?????? ?????????????????? ?????????????????? ?????? ???????????????????????? ??????????????? ????????????<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="Legal_Doc_File_Name" class="custom-file-input" id="Legal_Doc_File_Name" {{$disabled}}>
                        <label class="custom-file-label" id="Legal_Doc_File_Name2" for="Legal_Doc_File_Name">{{ @$vendor_data[0]['Legal Doc File Name'] ? @$vendor_data[0]['Legal Doc File Name'] : 'Choose file' }}</label>
                      </div>
                      @if(@$vendor_data[0]['Company Legal Documents'] == '1')
                      <div class="input-group-append">
                        <span class="input-group-text"><a href="{{ url('/uploads') }}/private-media/{{ $vendor_data[0]['Legal Doc File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
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
                    <label>Upload document of legal status of company / ??????????????? ?????? ?????????????????? ?????????????????? ?????? ???????????????????????? ??????????????? ????????????<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="Legal_Doc_File_Name_modify" class="custom-file-input" id="Legal_Doc_File_Name" {{$disabled}}>
                        <label class="custom-file-label" id="Legal_Doc_File_Name2" for="Legal_Doc_File_Name">{{ @$vendor_data[0]['Legal Doc File Name'] ? @$vendor_data[0]['Legal Doc File Name'] : 'Choose file' }}</label>
                      </div>
                      @if(@$vendor_data[0]['Legal Doc File Name'] != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a href="{{ url('/uploads') }}/private-media/{{ $vendor_data[0]['Legal Doc File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
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




                @if(@$vendor_data[0]['Photo File Name']=="")
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Photographs of displayed medium (Separate photo for each property) / ??????????????????????????? ?????????????????? ?????? ???????????????????????? (???????????????????????? ????????????????????? ?????? ????????? ????????? ????????????)<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="Photo_File_Name" class="custom-file-input" id="Photo_File_Name" {{$disabled}}>
                        <label class="custom-file-label" id="Photo_File_Name2" for="exampleInputFile">{{ @$vendor_data[0]['Photo File Name'] ? $vendor_data[0]['Photo File Name'] : 'Choose file' }}</label>
                      </div>
                      @if(@$vendor_data[0]['Photographs'] == '1')
                      <div class="input-group-append">
                        <span class="input-group-text"><a href="{{ url('/uploads') }}/private-media/{{ $vendor_data[0]['Photo File Name'] }}" target="_blank">View</a></span>
                      </div>
                      @else
                      <div class="input-group-append">
                        <span class="input-group-text" id="Photo_File_Name3">Upload</span>
                      </div>
                      @endif
                    </div>
                    <span id="Photo_File_Name1" class="error invalid-feedback"></span>
                  </div>
                </div>
                @else
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Photographs of displayed medium (Separate photo for each property) / ??????????????????????????? ?????????????????? ?????? ???????????????????????? (???????????????????????? ????????????????????? ?????? ????????? ????????? ????????????)<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="Photo_File_Name_modify" class="custom-file-input" id="Photo_File_Name" {{$disabled}}>
                        <label class="custom-file-label" id="Photo_File_Name2" for="exampleInputFile">{{ @$vendor_data[0]['Photo File Name'] ? $vendor_data[0]['Photo File Name'] : 'Choose file' }}</label>
                      </div>
                      @if(@$vendor_data[0]['Photo File Name'] != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a href="{{ url('/uploads') }}/private-media/{{ $vendor_data[0]['Photo File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @else
                      <div class="input-group-append">
                        <span class="input-group-text" id="Photo_File_Name3">Upload</span>
                      </div>
                      @endif
                    </div>
                    <span id="Photo_File_Name1" class="error invalid-feedback"></span>
                  </div>
                </div>
                @endif
              </div>



              <div class="row">
                @if(@$vendor_data[0]['Notarized Copy File Name']=="")
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Upload document of outdoor media format(attach supportive documents viz,Notarized copy of agreement of sole right indicating location, receipt of amount paid, validity etc/ allotment letter where agreement is not executed) / ?????????????????? ?????????????????? ????????????????????? ?????? ???????????????????????? ??????????????? ???????????? (?????????????????? ???????????????????????? ?????????????????? ????????????, ???????????? ?????? ????????????????????? ?????????????????? ?????? ?????????????????? ?????? ???????????????????????? ???????????????, ??????????????? ?????? ???????????????, ?????????????????? ?????? ?????? ???????????? ?????? ????????????????????????, ??????????????? ????????? / ??????????????? ???????????? ???????????? ?????????????????? ??????????????????????????? ???????????? ???????????? ????????? ??????)<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="Notarized_Copy_File_Name" class="custom-file-input" id="Notarized_Copy_File_Name" {{$disabled}}>
                        <label class="custom-file-label" id="Notarized_Copy_File_Name2" for="Notarized_Copy_File_Name">{{ @$vendor_data[0]['Notarized Copy File Name'] ? $vendor_data[0]['Notarized Copy File Name'] : 'Choose file' }}</label>
                      </div>
                      @if(@$vendor_data[0]['Notarized Copy Of Agreement'] == '1')
                      <div class="input-group-append">
                        <span class="input-group-text"><a href="{{ url('/uploads') }}/private-media/{{ $vendor_data[0]['Notarized Copy File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @else
                      <div class="input-group-append">
                        <span class="input-group-text" id="Notarized_Copy_File_Name3">Upload</span>
                      </div>
                      @endif
                    </div>
                    <span id="Notarized_Copy_File_Name1" class="error invalid-feedback"></span>
                  </div>
                </div>
                @else
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Upload document of outdoor media format(attach supportive documents viz,Notarized copy of agreement of sole right indicating location, receipt of amount paid, validity etc/ allotment letter where agreement is not executed) / ?????????????????? ?????????????????? ????????????????????? ?????? ???????????????????????? ??????????????? ???????????? (?????????????????? ???????????????????????? ?????????????????? ????????????, ???????????? ?????? ????????????????????? ?????????????????? ?????? ?????????????????? ?????? ???????????????????????? ???????????????, ??????????????? ?????? ???????????????, ?????????????????? ?????? ?????? ???????????? ?????? ????????????????????????, ??????????????? ????????? / ??????????????? ???????????? ???????????? ?????????????????? ??????????????????????????? ???????????? ???????????? ????????? ??????)<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="Notarized_Copy_File_Name_modify" class="custom-file-input" id="Notarized_Copy_File_Name" {{$disabled}}>
                        <label class="custom-file-label" id="Notarized_Copy_File_Name2" for="Notarized_Copy_File_Name">{{ @$vendor_data[0]['Notarized Copy File Name'] ? $vendor_data[0]['Notarized Copy File Name'] : 'Choose file' }}</label>
                      </div>
                      @if(@$vendor_data[0]['Notarized Copy File Name'] != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a href="{{ url('/uploads') }}/private-media/{{ $vendor_data[0]['Notarized Copy File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @else
                      <div class="input-group-append">
                        <span class="input-group-text" id="Notarized_Copy_File_Name3">Upload</span>
                      </div>
                      @endif
                    </div>
                    <span id="Notarized_Copy_File_Name1" class="error invalid-feedback"></span>
                  </div>
                </div>
                @endif


                @if(@$vendor_data[0]['Affidavit File Name']=="")
                <div class="col-md-6"><br><br>
                  <div class="form-group">
                    <label>Submit an affidavit on stamp paper stating on oath that the details submitted by you on performa are true and correct.Mention the application no. in affidavit / ????????????????????? ???????????? ?????? ????????? ???????????? ?????? ????????? ???????????? ???????????????????????? ???????????? ?????? ???????????? ?????????????????? ???????????????????????? ????????? ?????? ??????????????? ???????????? ?????? ????????? ???????????? ??????????????? ?????????????????? ?????? ?????????????????? ??????????????? ????????????????????? ?????????<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="Affidavit_File_Name" class="custom-file-input" id="Affidavit_File_Name" {{$disabled}}>
                        <label class="custom-file-label" id="Affidavit_File_Name2" for="exampleInputFile">{{ @$vendor_data[0]['Affidavit File Name'] ? $vendor_data[0]['Affidavit File Name'] : 'Choose file' }}</label>
                      </div>
                      @if(@$vendor_data[0]['Affidavit Of Oath'] == '1')
                      <div class="input-group-append">
                        <span class="input-group-text"><a href="{{ url('/uploads') }}/private-media/{{ $vendor_data[0]['Affidavit File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
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
                <div class="col-md-6"><br><br>
                  <div class="form-group">
                    <label>Submit an affidavit on stamp paper stating on oath that the details submitted by you on performa are true and correct.Mention the application no. in affidavit / ????????????????????? ???????????? ?????? ????????? ???????????? ?????? ????????? ???????????? ???????????????????????? ???????????? ?????? ???????????? ?????????????????? ???????????????????????? ????????? ?????? ??????????????? ???????????? ?????? ????????? ???????????? ??????????????? ?????????????????? ?????? ?????????????????? ??????????????? ????????????????????? ?????????<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="Affidavit_File_Name_modify" class="custom-file-input" id="Affidavit_File_Name" {{$disabled}}>
                        <label class="custom-file-label" id="Affidavit_File_Name2" for="exampleInputFile">{{ @$vendor_data[0]['Affidavit File Name'] ? $vendor_data[0]['Affidavit File Name'] : 'Choose file' }}</label>
                      </div>
                      @if(@$vendor_data[0]['Affidavit File Name'] != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a href="{{ url('/uploads') }}/private-media/{{ $vendor_data[0]['Affidavit File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
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
              </div>




              <div class="row">
                @if(@$vendor_data[0]['PAN File Name']=="")
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Attach copy of Pan Number and authorization of Bank for NEFT payment / ????????????????????? ?????????????????? ?????? ????????? ????????? ???????????? ?????? ???????????? ?????? ??????????????????????????? ?????? ??????????????? ?????????????????? ????????????<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="Attach_Copy_Of_Pan_Number_File_Name" class="custom-file-input" id="Attach_Copy_Of_Pan_Number_File_Name" {{$disabled}}>
                        <label class="custom-file-label" id="Attach_Copy_Of_Pan_Number_File_Name2" for="Attach_Copy_Of_Pan_Number_File_Name">{{ @$vendor_data[0]['PAN File Name'] ? $vendor_data[0]['PAN File Name'] : 'Choose file' }}</label>
                      </div>
                      @if(@$vendor_data[0]['PAN Attached'] == '1')
                      <div class="input-group-append">
                        <span class="input-group-text"><a href="{{ url('/uploads') }}/private-media/{{ $vendor_data[0]['PAN File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
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
                    <label>Attach copy of Pan Number and authorization of Bank for NEFT payment / ????????????????????? ?????????????????? ?????? ????????? ????????? ???????????? ?????? ???????????? ?????? ??????????????????????????? ?????? ??????????????? ?????????????????? ????????????<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="Attach_Copy_Of_Pan_Number_File_Name_modify" class="custom-file-input" id="Attach_Copy_Of_Pan_Number_File_Name" {{$disabled}}>
                        <label class="custom-file-label" id="Attach_Copy_Of_Pan_Number_File_Name2" for="Attach_Copy_Of_Pan_Number_File_Name">{{ @$vendor_data[0]['PAN File Name'] ? $vendor_data[0]['PAN File Name'] : 'Choose file' }}</label>
                      </div>
                      @if(@$vendor_data[0]['PAN File Name'] != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a href="{{ url('/uploads') }}/private-media/{{ $vendor_data[0]['PAN File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
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
                <div class="col-md-6"><br><br>
                  <div class="form-group">
                    <label>GST registration Certificate / ?????????????????? ????????????????????? ??????????????????????????????<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="GST_File_Name" class="custom-file-input" id="GST_File_Name" {{$disabled}}>
                        <label class="custom-file-label" id="GST_File_Name2" for="exampleInputFile">{{ @$vendor_data[0]['GST File Name'] ? $vendor_data[0]['GST File Name'] : 'Choose file' }}</label>
                      </div>
                      @if(@$vendor_data[0]['GST Registration'] == '1')
                      <div class="input-group-append">
                        <span class="input-group-text"><a href="{{ url('/uploads') }}/private-media/{{ $vendor_data[0]['GST File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @else
                      <div class="input-group-append">
                        <span class="input-group-text" id="GST_File_Name3">Upload</span>
                      </div>
                      @endif
                    </div>
                    <span id="Photo_File_Name1" class="error invalid-feedback"></span>
                  </div>
                </div>
                @else
                <div class="col-md-6"><br><br>
                  <div class="form-group">
                    <label>GST registration Certificate / ?????????????????? ????????????????????? ??????????????????????????????<font color="red">*</font></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="GST_File_Name_modify" class="custom-file-input" id="GST_File_Name" {{$disabled}}>
                        <label class="custom-file-label" id="GST_File_Name2" for="exampleInputFile">{{ @$vendor_data[0]['GST File Name'] ? $vendor_data[0]['GST File Name'] : 'Choose file' }}</label>
                      </div>
                      @if(@$vendor_data[0]['GST File Name'] != '1')
                      <div class="input-group-append">
                        <span class="input-group-text"><a href="{{ url('/uploads') }}/private-media/{{ $vendor_data[0]['GST File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @else
                      <div class="input-group-append">
                        <span class="input-group-text" id="GST_File_Name3">Upload</span>
                      </div>
                      @endif
                    </div>
                    <span id="Photo_File_Name1" class="error invalid-feedback"></span>
                  </div>
                </div>
                @endif
              </div>



              <!-- checkbox -->
              <div class="col-md-12">
                <div class="form-group">
                  <div class="icheck-success d-inline">
                    <input type="checkbox" name="self_declaration" value="1" id="self_declaration" {{ $vendor_data[0]['Self-declaration'] == 1 ? "checked" : "" }} {{$disabled}}>
                    <label for="self_declaration">Self declaration / ??????????????? ???????????????<font color="red">*</font></label>
                  </div>
                </div>
              </div>
            
              @if(!empty(@$vendor_data[0]['OD Media ID']))
              <input type="hidden" name="vendorid_tab_4" id="vendorid_tab_4" value="{{$vendor_data[0]['OD Media ID']}}">
              @else
              <input type="hidden" name="vendorid_tab_4" id="vendorid_tab_4" value="">
              @endif
              <input type="hidden" name="doc[]" id="doc_data">
              <input type="hidden" name="submit_btn" id="submit_btn" value="0">
              <a class="btn btn-primary reg-previous-button previousClass" id="prev_3">Previous</a> 
              @php
              $event="none";
              @endphp
              <!-- old code comment by sk -->
              {{-- @if(@$vendor_data[0]['Status'])
              <a class="btn btn-primary pm-next-button" style="pointer-events: {{$event}};">Submit</a>
              @else
              <a class="btn btn-primary pm-next-button">Submit</a>
              @endif --}}

              <a class="btn btn-primary pm-next-button" id="tab_4" onclick="removeActiveClass();">Submit</a> <!--  Sk Change -->
              <input type="hidden" name="read_only_form" id="read_only_form" value="{{$disabled ?? ''}}">
            </div>
            
              
              <div id="tab5" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="information-part-trigger">
                
                @if(count(@$latlongData) == 0)
                        <div class="card bg-light text-dark w-75">
                            <h6 class="text-center">Please submit location data through app</h6>
                            <a href="#" class="card-link text-center">App link</a>
                        </div>
                        <!-- loop start -->
                        @else
                        @foreach(@$latlongData as $key => $latlong)
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
                                    <p> <img src="{{ 'https://pingtrack.azurewebsites.net/public/uploads/sole-right-media/'.$latlong->{ 'Image File Name'}   }}" name="image" alt="img" target="_blank" width="60" height="60"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="remark">Remarks</label>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif


                <a class="btn btn-primary reg-previous-button previousClass" id="prev_4">Previous</a>
              </div>
            

            


            
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('custom_js')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="{{ url('/js') }}/fress-em-private-renewal-media-validation.js"></script>
<script src="{{asset('js/private_renewal.js')}}"></script>
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<!-- <script src="{{ url('/js') }}/jquery-validation/jquery.validate.min.js"></script> -->

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgvvPpyxo3IjhB-CMG7wCgCHcYvV7FJxU&libraries=places&callback=initialize" async defer></script> -->
<script>
  //google map api start

  // function initialize() {

  //   $(document).on('keyup keypress', '.map-input', function(e) {

  //     var keyCode = e.keyCode || e.which;
  //     if (keyCode === 13) {
  //       e.preventDefault();
  //       return false;
  //     }

  //     const locationInputs = document.getElementsByClassName("map-input");
  //     const autocompletes = [];
  //     const geocoder = new google.maps.Geocoder;
  //     var ind = $(this).attr("data");
  //     console.log(ind);
  //     for (let i = 0; i < locationInputs.length; i++) {
  //       const input = locationInputs[i];
  //       // const fieldKey = input.id.replace("-input-"+ind, "");
  //       const fieldKey = 'address';
  //       const isEdit = document.getElementById(fieldKey + "-latitude" + ind).value != '' && document.getElementById(fieldKey + "-longitude" + ind).value != '';

  //       const latitude = parseFloat(document.getElementById(fieldKey + "-latitude" + ind).value) || -33.8688;
  //       const longitude = parseFloat(document.getElementById(fieldKey + "-longitude" + ind).value) || 151.2195;

  //       const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
  //         center: {
  //           lat: latitude,
  //           lng: longitude
  //         },
  //         zoom: 13
  //       });
  //       const marker = new google.maps.Marker({
  //         map: map,
  //         position: {
  //           lat: latitude,
  //           lng: longitude
  //         },
  //       });

  //       marker.setVisible(isEdit);

  //       const autocomplete = new google.maps.places.Autocomplete(input);
  //       autocomplete.key = fieldKey;
  //       autocompletes.push({
  //         input: input,
  //         map: map,
  //         marker: marker,
  //         autocomplete: autocomplete
  //       });
  //     }

  //     for (let i = 0; i < autocompletes.length; i++) {
  //       const input = autocompletes[i].input;
  //       const autocomplete = autocompletes[i].autocomplete;
  //       const map = autocompletes[i].map;
  //       const marker = autocompletes[i].marker;

  //       google.maps.event.addListener(autocomplete, 'place_changed', function() {
  //         marker.setVisible(false);
  //         const place = autocomplete.getPlace();

  //         geocoder.geocode({
  //           'placeId': place.place_id
  //         }, function(results, status) {
  //           if (status === google.maps.GeocoderStatus.OK) {
  //             const lat = results[0].geometry.location.lat();
  //             const lng = results[0].geometry.location.lng();
  //             setLocationCoordinates(autocomplete.key, lat, lng, ind);
  //           }
  //         });

  //         if (!place.geometry) {
  //           window.alert("No details available for input: '" + place.name + "'");
  //           input.value = "";
  //           return;
  //         }

  //         if (place.geometry.viewport) {
  //           map.fitBounds(place.geometry.viewport);
  //         } else {
  //           map.setCenter(place.geometry.location);
  //           map.setZoom(17);
  //         }
  //         marker.setPosition(place.geometry.location);
  //         marker.setVisible(true);

  //       });
  //     }
  //   });

  // }

  function setLocationCoordinates(key, lat, lng, ind) {
    const latitudeField = document.getElementById(key + "-" + "latitude" + ind);
    const longitudeField = document.getElementById(key + "-" + "longitude" + ind);
    latitudeField.value = lat;
    longitudeField.value = lng;
  }

  $(document).ready(function() {
    $('#date_error').hide();
    $("#license_start_date").change(function() {
      var startDate = document.getElementById("license_start_date").value;
      var endDate = document.getElementById("license_end_date").value;

      if ((Date.parse(startDate) > Date.parse(endDate))) {
        //alert("End date should be greater than Start date");
        $('#date_error').show();
        $('#date_error').text('End date should be greater than Start date');
        document.getElementById("license_end_date").value = "";
      } else {

        $('#date_error').hide();

      }
    });



    $("#add_row").click(function() {
      // alert();
      var i = $('#count_dist_i').val();
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
            html += '<option value="' + value.Code + '">' + value.Description + '</option>';
          });
          // var email = 'email'+i;
          $("#details_of_owner").append('<div class="row p-3"><div class="col-md-4"><div class="form-group"><label for="owner_name">Publication Name / ????????????????????? ?????? ?????????<font color="red">*</font></label><p><input type="text" name="owner_name[]" id="owner_name' + i + '" placeholder="Enter Enter Publication Name" class="form-control form-control-sm owner_name" onkeypress="return onlyAlphabets(event,this);" maxlength="40"></p></div></div><div class="col-md-4"><div class="form-group"><label for="email">E-mail ID(Owner) / ????????????<font color="red">*</font></label><p><input type="text" name="email_owner[]" id="email' + i + '" placeholder="Enter Email" onkeyup="return checkUniqueOwner(this, this.value,' + i + ')" class="form-control form-control-sm" maxlength="50"> <span id="alert_email' + i + '" style="color:red;display: none;"></span></p></div></div><div class="col-md-4"><div class="form-group"><label for="mobile">Mobile / ??????????????????<font color="red">*</font></label><p><input type="text" name="mobile_owner[]" id="mobile' + i + '" placeholder="Enter Mobile" class="form-control form-control-sm" maxlength="10" onkeypress="return onlyNumberKey(event);" onkeyup="return checkUniqueOwner(this, this.value,' + i + ')"><span id="alert_mobile' + i + '" style="color:red;display: none;"></span></p></div></div><div class="col-md-4"><div class="form-group"><label for="address">Address / ?????????<font color="red">*</font></label><p><textarea type="text" name="address_owner[]" id="address' + i + '" placeholder="Enter Address" rows="2" class="form-control form-control-sm" maxlength="120"></textarea></p></div></div><div class="col-md-4"><div class="form-group"><label for="Name">State / ???????????????<font color="red">*</font></label><p><select  id="state_id' + i + '" name="state_owner[]" data="district_id' + i + '" class="form-control form-control-sm call_district">' + html + '</select></p></div></div><div class="col-md-4"><div class="form-group"><label for="Name">District / ???????????????<font color="red">*</font></label><p><select  id="district_id' + i + '" name="district_owner[]" class="form-control form-control-sm"><option value="">Select District</option></select></p></div></div><div class="col-md-4"><div class="form-group"><label for="Name">City / ?????????<font color="red">*</font></label><p><input type="text" name="city[]" id="city' + i + '" placeholderEnter City class="form-control form-control-sm" onkeypress="return onlyAlphabets(event,this);" maxlength="30"></p></div></div> <div class="col-md-4"><div class="form-group"><label for="phone">Phone No / ????????? ????????????</label><input type="text" name="phone[]" id="phone' + i + '" maxlength="14" placeholder="Enter Phone No" class="form-control form-control-sm input-imperial" onkeypress="return onlyNumberKey(event)"></div></div><div class="col-md-4"><div class="form-group"> <label for="fax">Fax / ???????????????</label><input type="text" name="fax_no[]" id="fax' + i + '" placeholder="Enter Fax" class="form-control form-control-sm" maxlength="14"  onkeypress="return onlyNumberKey(event);"></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 87px;"><button class="btn btn-danger remove_row">Remove</button></div></div>');
          $('#count_dist_i').val(i);
        }
      });
    });
    $("#details_of_owner").on('click', '.remove_row', function() {
      $(this).parent().parent().remove();
    });
  });


  $(document).ready(function() {

    var currentYear = (new Date()).getFullYear();
    //Loop and add the Year values to DropDownList.
    for (var i = 1980; i <= currentYear; i++) {
      var option = document.createElement("OPTION");
      option.innerHTML = i;
      option.value = i;
      $(".ddlYears").append(option);
    }
    $("#add_row_next").click(function() {

      var i = $("#count_i").val();
      i++;
      // var j = i + 1;
      // var k = i + 2;;
      $("#details_of_work_done:last").append('<div class="row"><div class="col-md-4"><br><div class="form-group"><label for="year">Year / ????????????<font color="red">*</font></label><p><select name="ODMFO_Year[]" id="Years' + i + '" class="form-control form-control-sm ddlYears"><option value="">Select Year</option></select></p></div></div><div class="col-md-4"><div class="form-group"><label for="quantity_duration">Quantity of Display or Duration / ???????????????????????? ?????? ???????????? ?????? ??????????????????<font color="red">*</font></label><p><input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" id="quantity_duration' + i + '" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm"maxlength="8" onkeypress="return onlyNumberKey(event)"></p></div></div><div class="col-md-4"><br><div class="form-group"><label for="billing_amount">Billing Amount(Rs) / ?????????????????? ???????????? (??????)<font color="red">*</font></label><p><input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount' + i + '" onkeypress="return isNumber(event,this)" placeholder="Enter Billing Amount(Rs)" maxlength="10" class="form-control form-control-sm"></p></div></div><div class="col-md-4"><div class="form-group"><label for="upload_doc_0' + i + '">Upload Document / ??????????????????????????? ??????????????? ????????????</label><div class="input-group"><div class="custom-file"><input type="file" name="ODMFO_Upload_Document[]" class="custom-file-doc" id="upload_doc_' + i + '" onchange="return uploadFile(' + i + ',this)" data="' + i + '" style="opacity: 0;"><label class="custom-file-label" for="upload_doc_' + i + '" id="choose_file' + i + '">Choose file</label></div><div class="input-group-append"><span class="input-group-text" id="upload_file' + i + '">Upload</span></div></div><span id="upload_doc_error' + i + '" class="error invalid-feedback"></span></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 87px;"><button class="btn btn-danger remove_row_next">Remove</button></div></div>');
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
  });
  // get district based on state by ajax call 
  //$(document).ready(function() {
  $(document).on('change', '.call_district', function() {
    if ($(this).val() != '') {
      var id = $(this).attr("data");
      // alert($(this).attr("data"));
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
    }
  });
  //});

  $(document).ready(function() {
    $("#add_row_media_add").click(function() {
      var i = $('#count_dist_latitude').val();
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
            html += '<option value="' + value.Code + '">' + value.Description + '</option>';
          });

          $("#media_address:last").append('<div class="row"><div class="col-md-4"><div class="form-group"><label for="Name">State / ???????????????<font color="red">*</font></label><p><select name="MA_State[]" id="state_id_' + i + '" data="district_ID' + i + '" class="form-control form-control-sm call_district">' + html + '</select></p><span id="alert_state_dd" style="color: red;"></span></div></div><div class="col-md-4"><div class="form-group"><label for="Name">District / ???????????????<font color="red">*</font></label><p><select  name="MA_District[]" id="district_ID' + i + '" class="1ma_district_' + i + '  form-control form-control-sm"><option value="">Select District</option></select></p><span id="alert_dist_dd" style="color: red;"></span></div></div><div class="col-md-4"><div class="form-group"><label for="Name">City / ?????????<font color="red">*</font></label><p><input type="text" name="MA_City[]" placeholder="Enter City" id="MA_City' + i + '" class="form-control form-control-sm" maxlength="30" onkeypress="return onlyAlphabets(event,this);"></p><span id="alert_country_dd" style="color: red;"></span></div></div><div class="col-md-4"><div class="form-group"><label for="license_to">Zone  / ?????????????????????</label><p><input type="text" name="MA_Zone[]" placeholder="Zone" class="form-control form-control-sm" id="zone' + i + '"  maxlength="8" onkeypress="return onlyNumberKey(event)"></p></div></div><div class="col-md-4"><div class="form-group"><label for="license_to">Property Landmark  / ????????????????????? ????????? ?????? ???????????????<font color="red">*</font></label><p><input type="text" name="MA_Property_Landmark[]" placeholder="Property Landmark" class="form-control form-control-sm" id="property_landmark' + i + '" maxlength="100"></p></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 73px;"><button class="btn btn-danger remove_row_media">Remove</button></div></div></div>');
          $('#count_dist_latitude').val(i);
        }
      });
    });
    $("#media_address").on('click', '.remove_row_media', function() {
      $(this).parent().parent().remove();
    });
  });

  // Check Unique Data 
  function checkUniqueVendor(id, val) {
    if (val != '') {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'POST',
        url: "{{Route('checkuniqueprivatevendor')}}",
        data: {
          data: val
        },
        success: function(response) {
          //console.log(response)
          if (response.status == 0) {
            $("#v_alert_" + id).html(titleCase(id) + ' ' + response.message);
            $("#v_alert_" + id).show();
          } else {
            $("#v_alert_" + id).hide();
          }
        }
      });
    }
  }

  function checkUniqueOwner(thisd, val, i) {

    if (val != '') {
      var user_id = $('input[name="user_id"]').val();
      var user_email = $('input[name="user_email"]').val();
      // console.log(i);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'POST',
        url: "{{Route('checkprivateuniqueowner')}}",
        data: {
          data: val,
          id: user_id,
          email: user_email
        },
        success: function(response) {
          //console.log(response);
          if (response.status == 1 && thisd.id == 'email' + i) {
            $("#owner_name" + i).prop("readonly", false);
            $("#mobile" + i).prop("readonly", false);
            $("#address" + i).prop("readonly", false);
            $("#state_id" + i).prop("readonly", false);
            $("#district_id" + i).prop("readonly", false);
            $("#city" + i).prop("readonly", false);
            $("#phone" + i).prop("readonly", false);
            $("#fax" + i).prop("readonly", false);
            $("#state_val" + i).prop("readonly", true);
            $("#district_val" + i).prop("readonly", true);
            // owner not exit clean data
            if ($("#owner_input_clean").val() == 0) {
              $("#state_id" + i).val('');
              $("#district_id" + i).val('');
              $("#owner_name" + i).val('');
              $("#mobile" + i).val('');
              $("#address" + i).val('');
              $("#city" + i).val('');
              $("#phone" + i).val('');
              $("#fax" + i).val('');
              $("#ownerid").val('');
              $("#exist_owner_id").val('');
              $("#mobilecheck").val('');
            }
          }
          if (response.status == 0 && thisd.id == 'email' + i) {
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
              },
              type: 'POST',
              url: "{{Route('fetchprivateownerrecord')}}",
              data: {
                data: val
              },
              success: function(response) {

                if (response.status == 1) {
                  $("#state_id" + i).empty();
                  $("#district_id" + i).empty();
                  $("#state_val" + i).prop("disabled", false);
                  $("#district_val" + i).prop("disabled", false);
                  $("#owner_name" + i).val(response.message['Owner Name']);
                  $("#mobile" + i).val(response.message['Mobile No_']);
                  $("#address" + i).val(response.message['Address 1']);
                  $("#state_id" + i).html(response.state);
                  $("#district_id" + i).html(response.districts);
                  $("#state_val" + i).val(response.message['State']);
                  $("#district_val" + i).val(response.message['District']);
                  $("#city" + i).val(response.message['City']);
                  $("#phone" + i).val(response.message['Phone No_']);
                  $("#fax" + i).val(response.message['Fax No_']);
                  $("#exist_owner_id").val(response.message['Owner ID']);
                  $("#mobilecheck").val(response.message['Mobile No_']);
                  if ($("#emailarr").val() == '') {
                    $("#emailarr").val(val);
                  } else {
                    var names = $("#emailarr").val();
                    var numbersArray = names.split(',');
                    if (isInArray(val, numbersArray) == false) {
                      $("#emailarr").val(function() {
                        return $("#emailarr").val() + ',' + val;
                      });
                      var namess = $("#emailarr").val();
                      var numbersArray1 = namess.split(',');
                      $("#emailarr").val(numbersArray1);
                      $("#alert_" + thisd.id).hide();
                    } else {
                      // $("#alert_" + thisd.id).html("Owner already exists");
                      //  $("#alert_" + thisd.id).show();

                      // $("#state_id" + i).val('');
                      // $("#district_id" + i).val('');
                      // $("#owner_name" + i).val('');
                      // $("#mobile" + i).val('');
                      // $("#address" + i).val('');
                      // $("#city" + i).val(''); 
                      // $("#phone" + i).val('');
                      // $("#fax" + i).val('');
                      // $("#ownerid" + i).val('');
                      // $("#exist_owner_id").val('');
                      // $("#mobilecheck").val('');
                    }
                  }

                  if ($("#ownerid").val() == '') {
                    $("#ownerid").val(response.message['Owner ID']);
                  } else {
                    var ownerids = $("#ownerid").val();
                    var ownerArray = ownerids.split(',');
                    if (isInArray(response.message['Owner ID'], ownerArray) == false) {
                      $("#ownerid").val(function() {
                        return $("#ownerid").val() + ',' + response.message['Owner ID'];
                      });
                      var ownerids = $("#ownerid").val();
                      var ownerArray = ownerids.split(',');
                      $("#ownerid").val(ownerArray);
                    }
                  }
                }

                if (response.ownerID > 0) {
                  $("#owner_name" + i).prop("readonly", true);
                  $("#mobile" + i).prop("readonly", true);
                  $("#address" + i).prop("readonly", true);
                  $("#state_id" + i).prop("readonly", true);
                  $("#district_id" + i).prop("readonly", true);
                  $("#city" + i).prop("readonly", true);
                  $("#phone" + i).prop("readonly", true);
                  $("#fax" + i).prop("readonly", true);
                }
                $("#owner_input_clean").val(0);
              }
            });

          } else if (response.status == 0 && thisd.id == 'mobile' + i && val != $("#mobilecheck").val()) {
            $("#alert_" + thisd.id).html(titleCase(thisd.id.slice(0, -1)) + ' ' + response.message);
            $("#alert_" + thisd.id).show();
          } else {
            $("#alert_" + thisd.id).hide();
          }
          if (thisd.id == 'mobile' + i) {
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


  function removeActiveClass()
  {
    var elems = document.querySelector(".active");
    if(elems !==null)
    {
    elems.classList.remove("active");
    $("a[id='#tab4']").removeClass("active");
    $("a[id='#tab5']").addClass("active");
    }
    elems.target.className = "active";
  }



  function nextSaveData(id) {
    // e.preventDefault();
    // console.log(id);
    ///console.log($("#" + id).val());
    if ($("#" + id).val() == 0) {
      $("#" + id).val(1);
    } else {
      $("#" + id).val(1);
    }
    // if ($("#read_only_form").val() == '') { comment by sk
      // var data = new FormData($("#private_media")[0]);
      // $.ajax({
      //   type: "post",
      //   url: "{{Route('private_media')}}",
      //   data: data,
      //   processData: false,
      //   contentType: false,
      //   dataType: "json",
      //   success: function(data) {
      //     console.log(data);
      //     if (data['success'] == true) {
      //       if (id == 'next_tab_1') {
      //         $("#ownerid").val(data['data']);
      //         console.log(data['data']);
      //       }
      //       if (id == 'next_tab_2') {
      //         $("#vendorid_tab_2").val(data.data.unique_id);
      //         $("#Lineno1").val(data.data['lineno1']);
      //         $("#Lineno2").val(data.data['lineno2']);
      //         console.log(data.data['lineno2']);
      //       }
      //       if (id == 'next_tab_3') {
      //         $("#vendorid_tab_3").val(data.data);
      //         $("#vendorid_tab_4").val(data.data);
      //         // console.log(data.data);
      //       }
      //       if (id == 'submit_btn') {
              
      //         //Remove active class from tab-4 and Add active class on tab-5.
      //         var elems = document.querySelector(".active");
              
      //         if(elems !==null){
      //         elems.classList.remove("active");
      //         $("a[id='#tab5']").addClass("active");
      //         }
      //       e.target.className = "active";
      //         $("#Final_submi").show();
      //         $("#Final_submi").text(data.message);
      //         // setTimeout(function() {
      //         //   window.location.href = 'rate-settlement-private-media';
      //         // }, 5000); comment sk
      //         console.log(data.message);
      //       }
      //     }
      //   },
      //   error: function(error) {
      //     console.log('error');
      //   }
      // });
      
  }

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