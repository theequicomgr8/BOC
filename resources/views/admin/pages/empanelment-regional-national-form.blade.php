@extends('admin.layouts.layout')

<style>
body {
    color: #6c757d !important;
  }

  .hide-msg {
    display: none !important;
  }

  .fa-check {
    color: green;
  }

  .input-group-text {
    height: 32px !important;
  }

  .custom-file-label {
    height: 32px !important;
    overflow: hidden;
  }

  .custom-file-label::after {
    height: 30px !important;
  }

  .input-group-text {
    font-size: 0.8rem !important;
  }

  /* .input-group {
     width: 80% !important; 
     float: right !important; 
  } */

  .flexview {
    display: inline-flex;
  }
  .eyecolor{
    color: #007bff !important;
  }
  .iframemargin{
    margin-bottom: -50px;
  }
  .fieldset-border {
    width: 100%;
    border: solid 1px #ccc;
    border-radius: 5px;
    margin: 0 10px 15px 10px;
    padding: 0 15px;
}
.fieldset-border legend {
  width: auto;
  background: #fff;
  padding: 0 10px;
  font-size: 14px;
  font-weight: 600;
  color: #3d63d2;
}
.subheading {
  font-size: 16px;
  font-weight: 500;
  color: #4066d4;
  border-bottom: solid 1px #4066d4;
  margin-bottom: 15px;
}
.divmargin {
  margin-top: 19px;
}
 
</style>
                  @section('content')
                  @php 
                  $OwnerDetails=$OwnerDetails ?? [1];
                  $Chanal_Details=$Chanal_Details ?? [1];
                  $readonly = ' ';
                  $disabled = ' ';
                  $checked = ' ';
                  $Self_Dec='';
                  $pointer ='';
                  $click='';
                  $tab ='';
                  if(@$Chanal_Details->{'Modification'} == 1){
                  $disabled = '';
                  $readonly = 'readonly';
                  $checked = 'checked';
                  $pointer='none';
                  $read='readonly';
                  $click='preventLeftClick';
                  $tab='-1';
                  }
                  @endphp

<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Fresh empanelment of AV-TV</h6>
            @if(@$Chanal_Details->{'Modification'} == 1)
            <p><a href="{{url('avtvPDF/'.@$Chanal_Details->{'Channel ID'} ?? '')}}" class="m-0 font-weight-normal text-primary"> <i class="fa fa-download"></i> AVTV application Receipt</a></p>
            @endif
        </div>
        <input type="hidden" id="Final_submi_msg">
        <div class="alert alert-success alert-dismissible text-center fade show" id="Final_submi" style="display: none;" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>   
        <!-- Card Body -->
        <div class="card-body">
              
                <form id="emp_regional_national" method="post"  enctype="multipart/form-data">
                  @csrf
                      <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active show" href="#tab1">Basic Information</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#tab2">AVTV Information</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#tab3">Account Details</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#tab4">Upload Document</a>
                        </li>
                      </ul>
                  <div class="tab-content p-3">
                    <!-- your steps content here -->

                   <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="logins-part-trigger">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="Name">Publication Name / ????????????????????? ?????? ?????????<font color="red">*</font></label>
                              <input type="text" class="form-control form-control-sm" name="owner_name" id="owner_name" placeholder="Enter publication" onkeypress="return onlyAlphabets(event,this)" maxlength="40" {{$readonly}} {{$readonly}} value="{{@$OwnerDetails->{'Owner Name'} ?? ''}}">
                          </div>
                         </div>
                         <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">E-mail ID / ??? ????????? ????????????<font color="red">*</font></label>
                            <input type="text" name="email" class="form-control form-control-sm" id="email" placeholder="Enter email" maxlength="50" {{$readonly}} value="{{@$OwnerDetails->{'Email ID'} ?? ''}}">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Mobile No. / ?????????????????? ????????????<font color="red">*</font></label>
                            <input type="text" name="mobile" id="mobile" maxlength="10" placeholder="Enter mobile  no." class="form-control form-control-sm input-imperial" onkeypress="return onlyNumberKey(event)"
                            {{$readonly}} value="{{@$OwnerDetails->{'Mobile No_'} ?? ''}}">
                          </div>
                      </div>
                      <div class="row col-md-12 ml-1">
                      <h4 class="subheading">Owner???s Head Office / ??????????????? ?????? ?????????????????? ????????????????????????:-</h4>
                    </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Address / ?????????<font color="red">*</font></label>
                          <textarea name="address" id="address" placeholder="Enter address" maxlength="120" rows="1" cols="50" class="form-control form-control-sm" {{$readonly}}>{{@$OwnerDetails->{'Address 1'} ?? ''}}</textarea>
                        </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group"> 
                          <label for="Name">State / ???????????????<font color="red">*</font></label>
                          <input type="hidden" id="tab1_state" value="district">
                          <select  id="state" name="state" class="form-control form-control-sm callstatemulti {{$click}}" data="district" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                              <option  value="">Select State</option>
                              @if(count($state) > 0)
                              @foreach($state as $sat)
                              <option  value="{{$sat['Code']}}" @if(@$OwnerDetails->{'State'} == $sat['Code']) selected="selected" @endif>{{$sat['Description']}}</option>
                              @endforeach
                              @endif
                          </select>
                         </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group"> 
                          <label for="Name">District / ??????????????? <font color="red">*</font></label>
                          <select  id="district" name="district" class="form-control form-control-sm" {{$readonly}} style="pointer-events: {{$pointer}}"tabindex="{{$tab}}">
                              <option  value="">Select District</option>
                              @if($dist > 0)
                              @foreach($dist as $distr)
                              <option value="{{$distr['District'] ?? ''}}" 
                              @if(@$OwnerDetails->{'District'} == $distr['District']) selected="selected" @endif>{{$distr['District'] ?? ''}}</option>
                              @endforeach
                              @endif
                          </select>
                         </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group"> 
                          <label for="Name">City / ?????????<font color="red">*</font></label>
                           <input type="text" class="form-control form-control-sm" name="city" id="city" placeholder="Enter city" onkeypress="return onlyAlphabets(event,this)" maxlength="40" {{$readonly}} value="{{@$OwnerDetails->{'City'} ?? ''}}">
                         </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Phone No. (with STD code) /????????? ???????????? (?????????????????? ????????? ?????? ?????????)</label>
                          <input type="text" name="phone_no" class="form-control form-control-sm" id="phone_no" placeholder="Enter phone number" onkeypress="return onlyNumberKey(event)" maxlength="15" {{$readonly}} value="{{@$OwnerDetails->{'Phone No_'} ?? ''}}">
                        </div>
                      </div>
                        </div>
                        <input type="hidden" name="ownerid" id="ownerid" {{$readonly}} value="">
                         <input type="hidden" name="next_tab_1" id="next_tab_1" {{$readonly}} value="0">
                        <a class="btn btn-primary regional-national"  id="tab_1">Next
                          <i class="fa fa-arrow-circle-right fa-lg"></i>
                        </a>
                      <!-- <a class="btn btn-primary" onclick="stepper.next()">Next</a> -->
                    </div>
                    <div id="tab2" class="content  pt-3 tab-pane" role="tabpanel" aria-labelledby="logins-part-trigger">
                    <div class="row">
                      <input type="hidden" name="reginal_type" value="{{$formType ?? ''}}">
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="newspaper_name">Name of parent Company/Group / ????????? ???????????????/???????????? ?????? ?????????<font color="red">*</font></label>
                        <input type="text" name="company_Group" placeholder="Enter company name" class="form-control form-control-sm" id="newspaper_name" onkeypress="return onlyAlphabets(event,this)" maxlength="40" {{$readonly}} value="{{@$Chanal_Details->{'Parent Company Name'} ?? ''}}">
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="place_of_publication">Name of channel / ???????????? ?????? ?????????<font color="red">*</font></label>
                        <input type="text" name="chanel_name" placeholder="Enter name of channel" class="form-control form-control-sm" id="place_of_publication" onkeypress="return isAlphaNumeric(event)" maxlength="40" {{$readonly}} value="{{@$Chanal_Details->{'Channel Name'} ?? ''}}">
                      </div>
                      </div>
                     @php 
                        $Uplinking_Validity_Date =substr(@$Chanal_Details->{'Uplinking Validity Date'}, 0,10);
                        $U_V_D ='';
                        if($Uplinking_Validity_Date != '1970-01-01'){
                          $U_V_D  = $Uplinking_Validity_Date;
                          }else{
                          $U_V_D  ='';
                          }
                        @endphp
                      <div class="col-md-4">
                      <div class="form-group">
                      <label for="rni_registration_no">Uplinking valid upto / ??????????????????????????? ?????? ????????? ??????<font color="red">*</font></label>
                        <input type="date" name="Uplinking_valid_upto" data="Down_linking_valid_upto" placeholder="Enter uplinking valid upto." class="form-control form-control-sm" id="Uplinking_valid_upto"  maxlength="15" 
                        {{$readonly}} value="{{$U_V_D ?? ''}}">
                       </div>
                      </div>
                        @php 
                        $Downlinking_Validity_Date =substr(@$Chanal_Details->{'Downlinking Validity Date'}, 0,10);
                        $D_V_D ='';
                        if($Downlinking_Validity_Date != '1970-01-01'){
                          $D_V_D  = $Downlinking_Validity_Date;
                          }else{
                          $D_V_D  ='';
                          }
                        @endphp
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="claimed_circulation">Down-linking valid upto / ????????????-????????????????????? ?????? ??????????????? ??????<font color="red">*</font></label>
                        <input type="date" name="Down_linking_valid_upto" placeholder="" class="form-control form-control-sm" id="Down_linking_valid_upto" data="Uplinking_valid_upto"  maxlength="40"
                        {{$readonly}} value="{{$D_V_D ?? ''}}">
                        <span id="Down_linking_Error"></span>
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="page_length">EMMC license no. / ????????????????????? ????????????????????? ??????????????????</label>
                        <input type="text" name="EMMC_License_No" placeholder="Enter license no." class="form-control form-control-sm" id="EMMC_License_No" onkeypress="return onlyNumberKey(event)" 
                        {{$readonly}} value="{{@$Chanal_Details->{'EMMC License No_'} ?? ''}}">
                      </div>
                      </div>
                       @php 
                        $EMMC_Date =substr(@$Chanal_Details->{'EMMC Date'}, 0,10);
                        $EM_DA ='';
                        if($EMMC_Date != '1970-01-01'){
                          $EM_DA  = $EMMC_Date;
                          }else{
                          $EM_DA  ='';
                          }
                      @endphp
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="page_width">Date of EMMC / ????????????????????? ?????? ??????????????????</label>
                        <input type="date" name="Date_of_EMMC" placeholder="Enter date of EMMC" class="form-control form-control-sm" id="Date_of_EMMC" 
                        {{$readonly}} value="{{$EMMC_Date ?? ''}}">
                      </div>
                      </div>

                       <div class="col-md-4">
                        <div class="form-group">
                        <label>Regional/Language of classification (in case of regional channel) / ???????????????????????? ?????? ???????????????????????????/???????????? (??????????????????????????? ???????????? ?????? ??????????????? ?????????)<font color="red">*</font></label>
                            <select name="Regional_Language" id="Regional_Language" class="form-control form-control-sm" {{$readonly}} 
                            style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                            <option value="">Select Language</option>
                             @if(count($Languages) > 0)
                                        @foreach($Languages as $stdata)
                                          <option  value="{{ $stdata['Code'] }}" @if(@$Chanal_Details->{'Regional_Language Type'} == $stdata['Code']) selected="selected" @endif>{{$stdata['Name']}}</option>
                                        @endforeach
                                      @endif
                            </select>
                        </div>
                    </div>
                     <div class="col-md-4" >
                        <div class="form-group"> 
                        <label for="Name">Legal status of company / ??????????????? ?????? ?????????????????? ??????????????????<font color="red">*</font></label>
                        <select  id="Legal_status_of_company" name="Legal_status_of_company" class="form-control form-control-sm" {{$readonly}} 
                        style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                            <option {{$readonly}} value="">Select Legal Status of Company</option>
                            <option {{$readonly}} value="1" @if(@$Chanal_Details->{'Company Legal Status'} ==1) selected="selected" @endif>Pvt</option>
                            <option {{$readonly}} value="2" @if(@$Chanal_Details->{'Company Legal Status'} ==2) selected="selected" @endif>Ltd</option>
                            <option {{$readonly}} value="3" @if(@$Chanal_Details->{'Company Legal Status'} ==3) selected="selected" @endif>Others</option>
                        </select>
                       </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="print_area">Director/CEO/Head of Company /Channel / ??????????????????/????????????/???????????????/???????????? ?????? ??????????????????<font color="red">*</font></label>
                          <input type="text" name="Head_of_Company" placeholder="Enter head of company" class="form-control form-control-sm" id="Head_of_Company"
                          onkeypress="return onlyAlphabets(event,this)" maxlength="40" 
                          {{$readonly}} value="{{@$Chanal_Details->{'Channel Director_CEO'} ?? ''}}">
                        </div>
                      </div>
                      @php
                      $month =[1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December'];
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="print_area">Month of launch of channel / ???????????? ?????? ??????????????? ?????? ???????????????<font color="red">*</font></label>
                            <select  id="Month_launch" name="Month_launch" id-data-m="Month_launch" class="form-control form-control-sm" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                            <option {{$readonly}} value="">Select month of launch</option>
                            @foreach($month as $key=>$value)
                              <option value="{{$key}}" @if(@$Chanal_Details->{'Launch Month'} == $key) selected="selected" @endif>{{$value}}</option>
                            @endforeach
                            </select>
                        </div>
                      </div>
                        <div class="col-md-4">
                        <div class="form-group">
                          <label for="print_area"> Year of launch of channel / ???????????? ?????? ????????????????????? ?????? ????????????<font color="red">*</font></label>
                            <select  id="yearpicker"  name="Year_launch" class="form-control form-control-sm Year_launch" {{$readonly}} 
                            style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                            <option  value="">Select year of launch</option>
                            @if(@$Chanal_Details->{'Launch Year'} > 0)
                            <option  value="{{@$Chanal_Details->{'Launch Year'} ?? ''}}" @if(@$Chanal_Details->{'Launch Year'}) selected="selected" @endif>
                              {{@$Chanal_Details->{'Launch Year'} ?? ''}}
                            </option>
                            @endif
                            </select>
                            <span id="Month_launch_Error" class="text-danger"></span>
                        </div>
                       
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="print_area">Genre of channel / ???????????? ?????? ????????????<font color="red">*</font></label>
                          <select  id="Genre_of_channel" name="Genre_of_channel" class="form-control form-control-sm" {{$readonly}} 
                          style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                            <option  value="">Select genre of channel</option>
                            <option  value="1" @if(@$Chanal_Details->{'Channel Genre'} == 1) selected="selected" @endif>NON-GEC</option>
                            <option  value="0" @if(@$Chanal_Details->{'Channel Genre'} == 0) selected="selected" @endif>GEC</option>
                        </select>
                        </div>
                      </div>
                      @php 
                        $Strimg_start =substr(@$Chanal_Details->{'Streaming Start Date'}, 0,10);
                        $streaming ='';
                        if($Strimg_start != '1970-01-01'){
                          $streaming  = $Strimg_start;
                          }else{
                          $streaming  ='';
                          }
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="Streaming_Start_Date">Streaming Start Date / ?????????????????????????????? ????????????????????? ??????????????????<font color="red">*</font></label>
                          <input type="date" class="form-control form-control-sm" name="Streaming_Start_Date" id="Streaming_Start_Date" placeholder="" onkeypress="return onlyNumberKey(event)" 
                          {{$readonly}} value="{{$Strimg_start ?? ''}}"  maxlength="15"  min="2000-01-01">
                        </div>
                      </div>
                      </div><br>
                    <div class="row col-md-12">
                      <h4 class="subheading">Delhi Office / ?????????????????? ???????????????????????? :-</h4>
                    </div>
                      <div class="row">
                    <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Address / ?????????<font color="red">*</font></label>
                          <textarea name="DO_Address" id="DO_Address" placeholder="Enter address" rows="1" cols="50" class="form-control form-control-sm" maxlength="120" {{$readonly}}>{{@$Chanal_Details->{'DO Address'} ?? ''}}</textarea>
                        </div>
                      </div>
                     
                      <div class="col-md-4">
                         <div class="form-group"> 
                          <label for="Name">State / ???????????????<font color="red">*</font></label>
                          <select  id="DO_State" name="DO_State" class="form-control form-control-sm callstatemulti" data="DO_District" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                             <option value="">Select state</option>
                             @if(count($state) > 0)
                              @foreach($state as $sat)
                              <option  value="{{$sat['Code'] ?? ''}}" @if(@$Chanal_Details->{'DO State'} == $sat['Code']) selected="selected" @endif data-DO-state="{{$sat['Description'] ?? ''}}">{{$sat['Description'] ?? ''}}</option>
                              @endforeach
                              @endif
                          </select>
                         </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group"> 
                          <label for="Name">District / ???????????????<font color="red">*</font></label>
                          <select  id="DO_District" name="DO_District" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                              <option  value="">Select district</option>
                              @if(!empty($district1))
                              @foreach($district1 as $stateDistrict1)
                                <option  value="{{@$Chanal_Details->{'DO District'} ?? ''}}" @if(@$Chanal_Details->{'DO District'} == @$stateDistrict1['District']) selected="selected" @endif>{{@$stateDistrict1['District'] ?? ''}}</option>
                              @endforeach
                            @endif
                          </select>
                         </div>
                        </div>
                         <div class="col-md-4">
                        <div class="form-group"> 
                          <label for="Name">City / ?????????<font color="red">*</font></label>
                           <input type="text" class="form-control form-control-sm" name="DO_City" id="DO_City" placeholder="Enter city" onkeypress="return onlyAlphabets(event,this)" maxlength="40" {{$readonly}} value="{{@$Chanal_Details->{'DO City'} ?? ''}}">
                         </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Phone No. / ????????? ????????????</label>
                          <input type="text" class="form-control form-control-sm" name="DO_Phone" id="DO_Phone" placeholder="Enter phone no." onkeypress="return onlyNumberKey(event)" 
                          {{$readonly}} value="{{@$Chanal_Details->{'DO Landline No_(with STD)'} ?? ''}}"  maxlength="15">
                        </div>
                      </div>
                       <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Mobile No. / ?????????????????? ????????????<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="DO_Mobile" id="DO_Mobile" placeholder="Enter mobile no." onkeypress="return onlyNumberKey(event)" maxlength="10" 
                            {{$readonly}} value="{{@$Chanal_Details->{'DO Mobile No_'} ?? ''}}">
                          </div>
                      </div>
                       <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Email ID / ???????????? ????????????<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="DO_Email" id="DO_Email" placeholder="Enter email id" maxlength="50"
                            {{$readonly}} value="{{@$Chanal_Details->{'DO E-Mail'} ?? ''}}">
                          </div>
                      </div>
                   </div>
                   <br>
                  <div class="row col-md-12">
                      <h4 class="subheading">Head Office / ?????????????????? ???????????????????????? :-</h4>
                    </div>
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                              @if(@$Chanal_Details->{'HO Same Address DO'} == 1)
                              <input type="checkbox" id="HO_same_as_DO" name="HO_same_as_DO" class="get_channel_office_data {{$click}}" data="OHO"  {{$readonly}} value="1" checked="checked">
                              @else
                              <input type="checkbox" id="HO_same_as_DO" name="HO_same_as_DO" class="get_channel_office_data" data="OHO"  {{$readonly}} value="1">
                              @endif
                              <label for="HO_same_as_DO">Same as delhi office</label>
                            </div>
                          </div>
                      <div class="row">
                        <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Address / ?????????<font color="red">*</font></label>
                          <textarea name="HO_Address" id="HO_Address" placeholder="Enter address" rows="1" cols="50" class="form-control form-control-sm {{$click}}"  maxlength="120" {{$readonly}}>{{@$Chanal_Details->{'HO Address'} ?? ''}}</textarea>
                        </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group"> 
                          <label for="Name">State / ???????????????<font color="red">*</font></label>
                          
                          <select  id="HO_State" name="HO_State" class="form-control form-control-sm callstatemulti"   data="HO_District" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                              <option value="">Select state</option>
                              @if(count($state) > 0)
                              @foreach($state as $sat)
                              <option value="{{$sat['Code']}}" @if(@$Chanal_Details->{'HO State'} == $sat['Code']) selected="selected" @endif>{{$sat['Description']}}</option>
                              @endforeach
                              @endif
                          </select>
                         </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group"> 
                          <label for="Name">District / ???????????????<font color="red">*</font></label>
                          <select  id="HO_District" name="HO_District" class="form-control form-control-sm" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">

                              <option  value="">Select district</option>
                            @if(!empty($district2))
                              @foreach($district2 as $stateDistrict2)
                                <option  value="{{@$Chanal_Details->{'HO District'} ?? ''}}" @if(@$Chanal_Details->{'HO District'} == @$stateDistrict2['District']) selected="selected" @endif>{{@$stateDistrict2['District']}}</option>
                              @endforeach
                            @endif
                          </select>
                         </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group"> 
                          <label for="Name">City / ?????????<font color="red">*</font></label>
                           <input type="text" class="form-control form-control-sm" name="HO_City" id="HO_City" placeholder="Enter city" onkeypress="return onlyAlphabets(event,this)" maxlength="40" {{$readonly}} value="{{@$Chanal_Details->{'HO District'} ?? ''}}">
                         </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Phone No. / ????????? ????????????</label>
                          <input type="text" class="form-control form-control-sm" name="HO_Phone" id="HO_Phone" placeholder="Enter phone no." onkeypress="return onlyNumberKey(event)" {{$readonly}} value="{{@$Chanal_Details->{'DO Landline No_(with STD)'} ?? ''}}" maxlength="15">
                        </div>
                      </div>
                       <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Mobile No. / ?????????????????? ????????????<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="HO_Mobile" id="HO_Mobile" placeholder="Enter mobile no." onkeypress="return onlyNumberKey(event)" maxlength="10"  
                            {{$readonly}} value="{{@$Chanal_Details->{'HO Mobile No_'} ?? ''}}">
                          </div>
                      </div>
                       <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Email ID / ???????????? ????????????<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="HO_Email" id="HO_Email" placeholder="Enter email id" maxlength="50"
                            {{$readonly}} value="{{@$Chanal_Details->{'HO E-Mail'} ?? ''}}">
                          </div>
                      </div>
                    </div>
                    <br>
                   <!--  <div class="row col-md-12">
                      <h4 class="subheading">Owner???s Delhi Office / ??????????????? ?????? ?????????????????? ???????????????????????? :-</h4>
                    </div> -->

              <!--<div class="row">                 
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Address / ?????????<font color="red">*</font></label>
                          <textarea name="ODO_Address" id="ODO_Address" placeholder="Enter Address" rows="1" cols="50" class="form-control form-control-sm" maxlength="120"></textarea>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                         <div class="form-group"> 
                          <label for="Name">State / ???????????????<font color="red">*</font></label>
                          <select  id="ODO_State" name="ODO_State" class="form-control form-control-sm callstatemulti" data="ODO_District">
                              <option {{$readonly}} value="">Select State</option>
                               @if(count($state) > 0)
                              @foreach($state as $sat)
                              <option {{$readonly}} value="{{$sat['Code']}}">{{$sat['Description']}}</option>
                              @endforeach
                              @endif
                          </select>
                         </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group"> 
                          <label for="Name">District / ???????????????<font color="red">*</font></label>
                          <select  id="ODO_District" name="ODO_District" class="form-control form-control-sm">
                              <option {{$readonly}} value="">Select District</option>
                          </select>
                         </div>
                        </div>
                         <div class="col-md-4">
                        <div class="form-group"> 
                          <label for="Name">City / ?????????<font color="red">*</font></label>
                           <input type="text" class="form-control form-control-sm" name="ODO_City" id="ODO_City" placeholder="Enter City" onkeypress="return onlyAlphabets(event,this)" maxlength="40">
                         </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Phone No / ????????? ????????????</label>
                          <input type="text" class="form-control form-control-sm" id="ODO_Phone" name="ODO_Phone" placeholder="Enter Phon Number" onkeypress="return onlyNumberKey(event)" maxlength="15">
                        </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Fax / ???????????????</label>
                          <input type="text" class="form-control form-control-sm" name="ODO_Fax" id="ODO_Fax" placeholder="Enter Fax" onkeypress="return onlyNumberKey(event)" maxlength="15">
                        </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Mobile No / ?????????????????? ????????????<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="ODO_Mobile" id="ODO_Mobile" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10">
                          </div>
                      </div>
                       <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Email ID / ???????????? ????????????<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="ODO_Email" id="ODO_Email" placeholder="Enter Email ID"  maxlength="50">
                          </div>
                      </div>
                    </div> -->
                <!--   <div class="row col-md-12">
                      <h4 class="subheading">Owner???s Head Office / ??????????????? ?????? ?????????????????? ????????????????????????:-</h4>
                    </div>
                    <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                            <input type="checkbox" id="ODO_same_as_OWO" name="ODO_same_as_OWO" class="get_channel_office_data" data="OHO"  {{$readonly}} value="1">
                            <label for="ODO_same_as_OWO">Same as Owner Delhi Office</label>
                          </div>
                        </div> -->
                  <!--     <div class="row">                 
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Address / ?????????<font color="red">*</font></label>
                          <textarea name="OHO_Address" id="OHO_Address" placeholder="Enter Address" rows="1" cols="50" class="form-control form-control-sm"  maxlength="120"></textarea>
                        </div>
                      </div>
                     
                      <div class="col-md-4">
                         <div class="form-group"> 
                          <label for="Name">State / ???????????????<font color="red">*</font></label>
                          <select  id="OHO_State" name="OHO_State" class="form-control form-control-sm callstatemulti" data="OHO_District">
                              <option {{$readonly}} value="">Select State</option>
                               @if(count($state) > 0)
                              @foreach($state as $sat)
                              <option {{$readonly}} value="{{$sat['Code']}}">{{$sat['Description']}}</option>
                              @endforeach
                              @endif
                          </select>
                         </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group"> 
                          <label for="Name">District / ???????????????<font color="red">*</font></label>
                          <select  id="OHO_District" name="OHO_District" class="form-control form-control-sm">
                              <option {{$readonly}} value="">Select District</option>
                          </select>
                         </div>
                        </div>
                      <div class="col-md-4">
                        <div class="form-group"> 
                          <label for="Name">City / ?????????<font color="red">*</font></label>
                           <input type="text" class="form-control form-control-sm" name="OHO_City" id="OHO_City" placeholder="Enter City" onkeypress="return onlyAlphabets(event,this)" maxlength="40">
                         </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Phone No / ????????? ????????????</label>
                          <input type="text" class="form-control form-control-sm" id="OHO_Phone" name="OHO_Phone" placeholder="Enter Phon Number" onkeypress="return onlyNumberKey(event)" maxlength="15">
                        </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Fax / ???????????????</label>
                          <input type="text" class="form-control form-control-sm" name="OHO_Fax" id="OHO_Fax" placeholder="Enter Fax" onkeypress="return onlyNumberKey(event)" maxlength="15">
                        </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Mobile No / ?????????????????? ????????????<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="OHO_Mobile" id="OHO_Mobile" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10">
                          </div>
                      </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Email ID / ???????????? ????????????<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="OHO_Email" id="OHO_Email" placeholder="Enter Email ID" maxlength="50">
                          </div>
                      </div>
                    </div> -->
                      <a class="btn btn-primary reg-previous-button" id="reg-previous-button">
                      <i class="fa fa-arrow-circle-left fa-lg"></i>
                      Previous</a>
                      <!-- <button class="btn btn-primary" onclick="stepper.next()">Next</button> -->
                      <input type="hidden" name="getID" id="getID" {{$readonly}} value="0">
                      <a class="btn btn-primary regional-national" id="tab_2">Next 
                        <i class="fa fa-arrow-circle-right fa-lg"></i>
                      </a>
                    </div>
                    <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="logins-part-trigger">
                     <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                  <label for="bank_account_no">Bank account number for receiving payment / ?????????????????? ????????????????????? ???????????? ?????? ????????? ???????????? ???????????? ??????????????????<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" name="bank_account_no" maxlength="20" id="bank_account_no" placeholder="Enter bank account number" onkeypress="return onlyNumberKey(event)" {{$readonly}} value="{{@$Chanal_Details->{'Account No_'} ?? ''}}">
                  <span id="alert_bank_account_no" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group divmargin">
                  <label for="account_holder_name">Account holder name / ???????????? ???????????? ?????? ?????????<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" name="account_holder_name" maxlength="70" id="account_holder_name" placeholder="Enter account holder name" onkeypress="return onlyAlphabets(event,this)" 
                  {{$readonly}} value="{{@$Chanal_Details->{'A_C Holder Name'} ?? ''}}">
                  <span id="alert_account_holder_name" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group divmargin">
                  <label for="ifsc_code">IFSC Code / ???????????????????????? ?????????<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" name="ifsc_code"
                  id="ifsc_code" maxlength="15" placeholder="Enter IFSC code"  onkeypress="return isAlphaNumeric(event)" {{$readonly}} value="{{@$Chanal_Details->{'IFSC Code'} ?? ''}}">
                  <span id="IFSC_code_Error" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="bank_name">Bank Name / ???????????? ?????? ?????????<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" name="bank_name" id="bank_name" maxlength="50" placeholder="Enter bank name" 
                  {{$readonly}} value="{{@$Chanal_Details->{'Bank Name'} ?? ''}}">
                  <span id="alert_bank_name" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="branch_name">Branch / ????????????<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" name="branch_name" id="branch_name" maxlength="40" placeholder="Enter branch" 
                  {{$readonly}} value="{{@$Chanal_Details->{'Bank Branch'} ?? ''}}">
                  <span id="alert_branch_name" style="color:red;display: none;"></span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="address_of_account">Address of account / ???????????? ?????? ?????????<font color="red">*</font></label>
                  <textarea class="form-control  form-control-sm" placeholder="Enter address of account" maxlength="220" name="address_of_account" id="address_of_account"{{$readonly}}>{{@$Chanal_Details->{'Bank A_C Address'} ?? ''}}
                  </textarea>
                  <span id="alert_address_of_account" style="color:red;display: none;"></span>

                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="pan_card">PAN card no. / ????????? ??????????????? ????????????<font color="red">*</font></label>
                  <input type="text" name="pan_card" id="pan_card" class="form-control  form-control-sm" maxlength="10" placeholder="Enter pan card no." onkeypress="return isAlphaNumeric(event)" {{$readonly}} value="{{@$Chanal_Details->PAN ?? ''}}">
                  <span id="PAN_No_Error" style="color:red;display: none;"></span>
                </div>
              </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Name">GST No. / ?????????????????? ??????????????????<font color="red">*</font></label>
                    <input type="text" name="GST_No" id="GST_No" class="form-control form-control-sm" placeholder="Enter GST no." maxlength="15" onkeypress="return isAlphaNumeric(event)" {{$readonly}} value="{{@$Chanal_Details->{'GST No_'} ?? ''}}">
                     <span id="GST_No_Error"></span>
                  </div>
                </div>
              <fieldset class="fieldset-border">
                <legend>ESI account details / ??????????????? ???????????? ???????????????</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ESI_account_no">Account No. / ???????????? ????????????</label>
                      <input type="text" name="ESI_account_no" id="ESI_account_no" maxlength="20" class="form-control  form-control-sm" placeholder="Enter account no." onkeypress="return onlyNumberKey(event)" 
                      {{$readonly}} value="{{@$Chanal_Details->{'ESI A_C No_'} ?? ''}}">
                      <span id="alert_address_of_account" style="color:red;display: none;"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ESI_no_employees">No. of employees covered / ????????? ????????? ?????? ????????????????????????????????? ?????? ??????????????????</label>
                      <input type="text" name="ESI_no_employees" id="ESI_no_employees" maxlength="6" class="form-control  form-control-sm" placeholder="Enter no. of employees covered" onkeypress="return onlyNumberKey(event)" 
                      {{$readonly}} value="@if(@$Chanal_Details->{'ESI - No_ Of Employee'} > 0){{@$Chanal_Details->{'ESI - No_ Of Employee'} ?? ''}}@endif">
                      <span id="alert_ESI_no_employees" style="color:red;display: none;"></span>
                    </div>
                  </div>
                </div>
              </fieldset>
              <fieldset class="fieldset-border">
                <legend>EPF account details / ??????????????? ???????????? ???????????????</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="Name">Account No. / ???????????? ????????????</label>
                      <input type="text" name="EPF_account_no" id="EPF_account_no" maxlength="20" class="form-control  form-control-sm" placeholder="Enter account no." onkeypress="return onlyNumberKey(event)" 
                      {{$readonly}} value="{{@$Chanal_Details->{'EPF A_C No_'} ?? ''}}">
                    </div>
                    <span id="alert_EPF_account_no" style="color:red;display: none;"></span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="Name">No. of employees covered / ????????? ????????? ?????? ????????????????????????????????? ?????? ??????????????????</label>
                      <input type="text" name="EPF_no_of_employees" id="EPF_no_of_employees" maxlength="6" class="form-control  form-control-sm" placeholder="Enter no. of employees covered" onkeypress="return onlyNumberKey(event)" 
                      {{$readonly}} value="@if(@$Chanal_Details->{'EPF - No_ Of Employee'} > 0){{@$Chanal_Details->{'EPF - No_ Of Employee'} ?? ''}}@endif">
                      <span id="alert_EPF_no_of_employees" style="color:red;display: none;"></span>
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>
                      <a class="btn btn-primary reg-previous-button" id="prev_3">
                      <i class="fa fa-arrow-circle-left fa-lg"></i>
                      Previous</a>
                      <!-- <button class="btn btn-primary" onclick="stepper.next()">Next</button> -->
                      <a class="btn btn-primary regional-national" id="tab_3">Next
                        <i class="fa fa-arrow-circle-right fa-lg"></i>
                      </a>
                    </div>
                   <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="information-part-trigger">
                      <div class="row">
                      <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">Uplinking & Down-linking certificate of the channel / ???????????? ?????? ??????????????????????????? ?????? ????????????????????????????????? ??????????????????????????????<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input {{$click}}" name="Uplinking_Down_linking" id="Uplinking_Down_linking" {{$readonly}}>
                            <label class="custom-file-label" id="Uplinking_Down_linking2" for="Uplinking_Down_linking">{{@$Chanal_Details->{'Linking Certificate File Name'} ?? 'Choose file'}}</label>
                          </div>
                          @if(@$Chanal_Details->{'Linking Certificate File Name'} !='')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{@$Chanal_Details->{'Linking Certificate File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="Uplinking_Down_linking3">Upload</span>
                          </div>
                          @endif
                        </div>
                      </div>
                      <span id="Uplinking_Down_linking1" class="error invalid-feedback"></span>
                     </div>
                      <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">EMMC certificate telecasting over the last 6 months / ????????????????????? ?????????????????????????????? ??????????????? 6 ?????????????????? ????????? ???????????????????????? ?????? ????????? ?????????<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input {{$click}}" name="EMMC_certificate" id="EMMC_certificate" {{$readonly}}>
                            <label class="custom-file-label" id="EMMC_certificate2" for="EMMC_certificate">{{@$Chanal_Details->{'EMMC File Name'} ?? 'Choose file'}}</label>
                          </div>
                           @if(@$Chanal_Details->{'EMMC File Name'} !='')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{@$Chanal_Details->{'EMMC File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="EMMC_certificate3">Upload</span>
                          </div>
                          @endif
                        </div>
                      </div>
                      <span id="EMMC_certificate1" class="error invalid-feedback"></span>
                     </div>
                      <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">Fixed point chart (FPC) for the previous 6 months from 6AM to 11PM,  during which the channel operated / ??????????????? 6 ?????????????????? ?????? ????????? ???????????? 6 ????????? ?????? ????????? 11 ????????? ?????? ????????????????????? ????????????????????? ??????????????? (??????????????????) ??????????????? ??????????????? ???????????? ????????????????????? ???????????? ?????????<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input {{$click}}" name="Fixed_Point_Chart" id="Fixed_Point_Chart" {{$readonly}}>
                            <label class="custom-file-label" id="Fixed_Point_Chart2" for="Fixed_Point_Chart">{{@$Chanal_Details->{'FP Chart File Name'} ?? 'Choose file'}}</label>
                          </div>
                           @if(@$Chanal_Details->{'FP Chart File Name'} !='')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{@$Chanal_Details->{'FP Chart File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="Fixed_Point_Chart3">Upload</span>
                          </div>
                          @endif
                        </div>
                      </div>
                      <span id="Fixed_Point_Chart1" class="error invalid-feedback"></span>
                     </div>
                      <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">Scan copy of cancelled cheque / ???????????? ????????? ?????? ????????? ?????? ??????????????? ???????????????<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input {{$click}}" name="ancelled_cheque" id="ancelled_cheque" {{$readonly}}>
                            <label class="custom-file-label" id="ancelled_cheque2" for="ancelled_cheque">{{@$Chanal_Details->{'Cancelled Cheque File Name'} ?? 'Choose file'}}</label>
                          </div>
                          @if(@$Chanal_Details->{'Cancelled Cheque File Name'} !='')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{@$Chanal_Details->{'Cancelled Cheque File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="ancelled_cheque3">Upload</span>
                          </div>
                          @endif
                        </div>
                      </div>
                      <span id="ancelled_cheque1" class="error invalid-feedback"></span>
                     </div>
                      <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">Teleport operator certificate / ??????????????????????????? ?????????????????? ?????????????????????????????????<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file"><input type="file" class="custom-file-input {{$click}}" 
                            name="Teleport_operator_certificate" id="Teleport_operator_certificate" {{$readonly}}>
                            <label class="custom-file-label" for="Teleport_operator_certificate" id="Teleport_operator_certificate2">{{@$Chanal_Details->{'TOC File Name'} ?? 'Choose file'}}</label>
                          </div>
                           @if(@$Chanal_Details->{'TOC File Name'} !='')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{@$Chanal_Details->{'TOC File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="Teleport_operator_certificate3">Upload</span>
                          </div>
                          @endif
                        </div>
                      </div>
                      <span id="Teleport_operator_certificate1" class="error invalid-feedback"></span>
                     </div>
                      <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">Last year's certificate duly signed by the Auditor/Company / ??????????????? ???????????? ?????? ?????????????????????????????? ?????????????????????????????????/??????????????? ?????????????????? ?????????????????? ?????????????????????????????????<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input {{$click}}" name="Last_year_certificate" id="Last_year_certificate" {{$readonly}}>
                            <label class="custom-file-label" id="Last_year_certificate2" for="Last_year_certificate">{{@$Chanal_Details->{'Auditor File Name'} ?? 'Choose file'}}</label>
                          </div>
                          @if(@$Chanal_Details->{'Auditor File Name'} !='')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{@$Chanal_Details->{'Auditor File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="Last_year_certificate3">Upload</span>
                          </div>
                          @endif
                        </div>
                      </div>
                      <span id="Last_year_certificate1" class="error invalid-feedback"></span>
                     </div>
                      <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">A letter attested by Senior Management Level Executive,Giving Name, Designation &  Signatures / ?????????????????? ????????????????????? ???????????? ?????? ??????????????????????????? ?????????????????? ???????????????????????? ?????? ????????????, ?????????????????? ?????????, ??????????????? ?????? ??????????????????????????? ????????? ?????? ????????????<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input {{$click}}" name="letter_attested" id="letter_attested" {{$readonly}}>
                            <label class="custom-file-label" id="letter_attested2" for="letter_attested">{{@$Chanal_Details->{'SMA File Name'} ?? 'Choose file'}}</label>
                          </div>
                          @if(@$Chanal_Details->{'SMA File Name'} !='')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{@$Chanal_Details->{'SMA File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="letter_attested3">Upload</span>
                          </div>
                          @endif
                        </div>
                      </div>
                      <span id="letter_attested1" class="error invalid-feedback"></span>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">- A letter indicating whether or not the channel would be able to provide a third party certification of the Advertisement telecast for DAVP/ Government of India. / ?????? ???????????? ?????? ????????????????????? ?????? ?????? ???????????? ?????????????????????/???????????? ??????????????? ?????? ????????? ???????????????????????? ???????????????????????? ?????? ??????????????? ???????????? ?????? ?????????????????????????????? ?????????????????? ???????????? ????????? ??????????????? ???????????? ?????? ???????????????<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input {{$click}}" name="Government_India" id="Government_India" {{$readonly}}>
                            <label class="custom-file-label" id="Government_India2" for="Government_India">{{@$Chanal_Details->{'TPC File Name'} ?? 'Choose file'}}</label>
                          </div>
                           @if(@$Chanal_Details->{'TPC File Name'} !='')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{@$Chanal_Details->{'TPC File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="Government_India3">Upload</span>
                          </div>
                          @endif
                        </div>
                      </div>
                      <span id="Government_India1" class="error invalid-feedback"></span>
                     </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">A signed list of the different C&S. TV Channel in the Group/Holding Company/ Company to which the applicant channel belongs to / ????????????????????? ?????? ????????? ?????? ?????? ?????? ????????????????????????????????? ??????????????? ?????? ???????????????/???????????????????????? ???????????????/??????????????? ????????? ???????????? ???????????? ??????????????? ??????????????? ???????????? ????????????????????? ?????????<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input {{$click}}" name="applicant_channel_belongs" id="applicant_channel_belongs" {{$readonly}}>
                            <label class="custom-file-label" id="applicant_channel_belongs2" for="applicant_channel_belongs">{{@$Chanal_Details->{'DC&SL File Name'} ?? 'Choose file'}}</label>
                          </div>
                           @if(@$Chanal_Details->{'DC&SL File Name'} !='')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{@$Chanal_Details->{'DC&SL File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="applicant_channel_belongs3">Upload</span>
                          </div>
                          @endif
                        </div>
                      </div>
                      <span id="applicant_channel_belongs1" class="error invalid-feedback"></span>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                              @if(@$Chanal_Details->{'Self-declaration'} == 1)
                            <input type="checkbox" id="affirm" name="affirm" class="get_channel_office_data {{$click}}" data="OHO"  {{$readonly}} value="1" checked="checked">
                            @else
                            <input type="checkbox" id="affirm" name="affirm" class="get_channel_office_data" data="OHO"  {{$readonly}} value="1">
                            @endif
                            <label for="affirm">I affirm that all the information given by me is true and nothing has been concealed./????????? ?????????????????? ???????????? ????????? ?????? ???????????? ?????????????????? ?????? ?????? ????????? ????????????????????? ???????????? ?????? ?????? ????????? ?????? ?????????????????? ???????????? ????????? ?????????<font color="red">*</font></label>
                          </div>
                        </div>
                     </div>
                     </div>
                     <input type="hidden" name="doc[]" id="doc_data">
                      <a class="btn btn-primary reg-previous-button" id="prev_4">
                      <i class="fa fa-arrow-circle-left fa-lg"></i>
                      Previous</a>
                      @if(@$Chanal_Details->{'Modification'} == 1)
                      <a class="btn btn-primary callfinal" id="tab_4"
                      style="pointer-events:none;">Submit <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                      @else
                      <a class="btn btn-primary regional-national" id="tab_4">Submit <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                      @endif
                    </div>
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
<script src="{{ url('/js') }}/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ url('/js') }}/empanelment-regional-national.js"></script>
<script src="{{ url('/js') }}/avtv_comman.js"></script>
<script type="text/javascript">

  //onchange distsict load
    $(document).on('change', '.callstatemulti', function() {
    if ($(this).val() != '') {
      var id = $(this).attr("data");
       //alert($(this).attr("data"));
      $("#" + id).empty();
      $.ajax({
        type: 'get',
        url: "{{Route('getDistrict-national')}}",
        data: { state_id: $(this).val() },
        success: function(data) {
          //console.log(data);
          $("#" + id).html(data);
        }
      });
    }
  });

$(document).ready(function() {
    $('.preventLeftClick').on('click', function(e) {
        e.preventDefault();
        return false;
    });
    //get current Month and year 
   
    // $("#Month_launch").change(function(){
    //  Monthlaunch =  $("#Month_launch option:selected" ).val();  
    // })
    // console.log("MOn "+ Monthlaunch);
    // $(".Year_launch").change(function(){
    //    yearlaunch =$(".Year_launch option:selected").val();
    // });
});
</script>
@endsection