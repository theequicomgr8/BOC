@extends('admin.layouts.layout')
<style>
body{color: #6c757d !important;}
div#to {margin-right: 16px;}
label:not(.form-check-label):not(.custom-file-label) {font-weight: 500!important;}
@media (min-width: 768px){.col-md-2 {
   max-width: 13.666667%!important;}}
   .error {
     color: red;
    font-size: 14px;
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
.form-control-sm, .input-group-sm>.form-control, .input-group-sm>.input-group-append>.btn, .input-group-sm>.input-group-append>.input-group-text, .input-group-sm>.input-group-prepend>.btn, .input-group-sm>.input-group-prepend>.input-group-text {
    padding: 0.25rem 0.2rem !important;
    font-size: .875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}

</style>
@section('content')
@php
$vendorData =$vendorData ?? '1';
$DigitalScreen_dTA=@$DigitalScreen ?? [1];
                  $readonly = ' ';
                  $checked = ' ';
                  $Self_Dec='';
                  $pointer ='';
                  $click='';
                  $tab ='';
                  if(@$vendorData->{'Modification'} == 1){
                  $readonly = 'readonly';
                  $checked = 'checked';
                  $pointer='none';
                  $click='preventLeftClick';
                  $tab='-1';
                  }
@endphp

<!-- Content Wrapper. Contains page content -->
<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Fresh Empanelment of Digital Cinema</h6>
                <p>
        @if($vendorData != '' && @$vendorData->{'Modification'} == 1)
        <a href="{{url('getDigitalPDF/'.session::get('UserID'))}}" class="m-0 font-weight-normal text-primary"><i class="fa fa-download"></i> Digital Cinema Application Receipt</a>
        @endif
    </p>

        </div>

        <div class="alert alert-success alert-dismissible text-center fade show" id="Final_submi" style="display: none;" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <div class="card-body">

            <form method="post" action="" id="digita_cinema">
                @csrf
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" id="#tab1" style="pointer-events:none;" tabindex="-1">Basic Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" id="#tab2" style="pointer-events:none;" tabindex="-1">DC Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" id="#tab3" style="pointer-events:none;" tabindex="-1">Account Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" id="#tab4" style="pointer-events:none;" tabindex="-1">Upload Document</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel"
                        aria-labelledby="tab1-trigger">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Agency Name / एजेंसी का नाम <font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm" name="Owner_Name" id="Owner_Name" placeholder="Enter agency name" onkeypress="return onlyAlphabets(event,this)" maxlength="70"
                                    {{$readonly}} value="{{@$vendorData->{'Agency Name'} ?? ''}}">
                                    <span id="first_agency_name" style="color:red;display:none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">E-mail ID / ई मेल आईडी <font color="red">*</font></label>
                                    <input type="email" class="form-control form-control-sm" name="digital_email" id="owner_email" placeholder="Enter Email" {{$readonly}} value="{{@$vendorData->{'E-Mail'} ?? ''}}">
                                    <span id="first_email" style="color:red;display:none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm" name="digital_mobile" id="owner_mobile" placeholder="Enter mobile number" onkeypress="return onlyNumberKey(event)" maxlength="10"
                                    {{$readonly}} value="{{@$vendorData->{'Mobile'} ?? ''}}">
                                    <span id="first_mobile" style="color:red;display:none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Address / पता <font color="red">*</font></label>
                                    <textarea name="digital_address" id="address" placeholder="Enter Address" class="form-control form-control-sm" {{$readonly}}>{{@$vendorData->{'Address 1'} ?? ''}}</textarea>
                                    <span id="first_address" style="color:red;display:none;"></span>
                                </div>
                            </div>

	                    <div class="col-md-4">
	                       <div class="form-group">
	                        <label for="state">State / राज्य <font color="red">*</font></label>
	                        <select  id="digital_state" name="digital_state" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events:{{$pointer}};width: 100%;" tabindex="{{$tab}}">
	                            <option  value="">Select State</option>
                              @if($states > 0)
                              @foreach($states as $state)
	                            <option  value="{{$state['Code'] ?? ''}}"
                              @if(@$vendorData->{'State'} == $state['Code']) selected="selected"@endif>{{$state['Description'] ?? ''}}</option>
                              @endforeach
                              @endif
	                        </select>
                          <span id="first_state" class="text-danger"></span>
	                       </div>
	                     </div>
	                     <div class="col-md-4">
	                        <div class="form-group">
	                        <label for="district">District / ज़िला <font color="red">*</font></label>
	                        <select  id="digital_district" name="digital_district" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events:{{$pointer}};width: 100%;" tabindex="{{$tab}}">
	                            <option  value="">Select District</option>
                              @if($district > 0)
                              @foreach($district as $dist)
                              <option  value="{{@$dist['District'] ?? ''}}" @if(@$dist['District'] == @$vendorData->{'District'}) selected="selected"@endif>{{@$dist['District'] ?? ''}}</option>
                              @endforeach
                              @endif
	                        </select>
                          <span id="first_district" class="text-danger"></span>
	                       </div>
	                      </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">City / नगर <font color="red">*</font></label>
                                    <input type="text" name="digital_city" class="form-control form-control-sm" id="city"
                                        placeholder="Enter City" maxlength="20" {{$readonly}} value="{{@$vendorData->{'City'} ?? ''}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Phone No. / फोन नंबर</label>
                                    <input type="text" name="digital_phone_no" class="form-control form-control-sm" id="phone"
                                        placeholder="Enter phone Number" maxlength="15"
                                        onkeypress="return onlyNumberKey(event)" {{$readonly}} value="{{@$vendorData->{'Phone'} ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="next_tab_1" id="next_tab_1" {{$readonly}} value="0">
                        <a class="btn btn-primary fm-digital-cinema" id="tab_1">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                    </div>

                  <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                    <div id="add_davp">
                    @if(count($DigitalScreen_dTA) > 0)
                    @foreach($DigitalScreen_dTA as $DigitalSc)
                        <div class="row">
                          
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="screen_unique_code">Screen Unique Code / स्क्रीन यूनिक कोड<font color="red">*</font></label>
                                    <p><input type="text" name="screen_unique_code[]" id="unique_code" placeholder="Enter Screen Unique Code" class="form-control form-control-sm" maxlength="30" {{$readonly}} value="{{@$DigitalSc->{'Screen Unique Code'} ?? ''}}"></p>
                                    <span id="first_unique_code" class="text-danger"></span>
                                </div>
                            </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="number_screens">Number of seats / सीटों की संख्या*<font color="red">*</font></label>
                                <p><input type="text" name="number_screens[]" id="number_screens" placeholder="Enter Number of Seats" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8" {{$readonly}} value="{{@$DigitalSc->{'No_ Of Seats'} ?? ''}}"><p>
                                <span id="first_no_of_screen" class="text-danger"></span>
                            </div>
                          </div>


                        </div>
                       @endforeach
                        @else
                         <div class="row" id="add_davp">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="screen_unique_code">Screen unique code / स्क्रीन यूनिक कोड<font color="red">*</font></label>
                                    <p><input type="text" name="screen_unique_code[]" id="unique_code" placeholder="Enter Screen Unique Code" class="form-control form-control-sm" maxlength="30" {{$readonly}} value=""></p>
                                    <span id="first_unique_code" class="text-danger"></span>
                                </div>
                            </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="number_screens">Number of seats / सीटों की संख्या*<font color="red">*</font></label>
                                <p><input type="text" name="number_screens[]" id="number_screens" placeholder="Enter Number of Seats" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8" {{$readonly}} value=""><p>
                                <span id="first_no_of_screen" class="text-danger"></span>
                            </div>
                          </div>


                        </div>
                        @endif
                </div>
                         <div class="row mr-1" id="add_row_davp" {{$readonly}} style="pointer-events:{{$pointer}};float:right;margin-top: 6px;">
                         <a class="btn btn-primary" id="add_row" >Add More +</a>
                       </div>
                        <a class="btn btn-primary reg-previous-button"> <i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
                        <a class="btn btn-primary fm-digital-cinema" id="tab_2">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                    </div>

                    <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">
                          <label for="bank_account">Bank account number for receiving payment / भुगतान प्राप्त करने के लिए बैंक खाता संख्या<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" name="bank_account_no" id="bank_account_no" placeholder="Enter Bank Account Number" onkeypress="return onlyNumberKey(event)" maxlength="15" {{$readonly}} value="{{@$vendorData->{'Account No_'} ?? ''}}">
                          <span id="first_bank_account_no" class="text-danger"></span>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="account_holder_name">Account holder name / खाता धारक का नाम<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" id="account_holder_name" name="account_holder_name" placeholder="Enter Account holder Name" onkeypress="return onlyAlphabets(event,this)" {{$readonly}} value="{{@$vendorData->{'A_C Holder Name'} ?? ''}}">
                          <span id="first_account_holder_name" class="text-danger"></span>
                        </div>
                      </div>
                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="ifsc_code">IFSC Code / IFSC कोड<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" id="IFSC_Code" name="IFSC_Code" placeholder="Enter IFSC Code" {{$readonly}} value="{{@$vendorData->{'IFSC Code'} ?? ''}}">
                          <span id="IFSC_code_Error" style="color:red;display: none;"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="bank_name">Bank Name / बैंक का नाम<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" id="bank_name" name="bank_name" placeholder="Enter Bank Name" onkeypress="return onlyAlphabets(event,this)" {{$readonly}} value="{{@$vendorData->{'Bank Name'} ?? ''}}">
                          <span id="first_bank_name" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="branch">Branch / शाखा<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" id="branch_name" name="branch" placeholder="Enter Branch"  maxlength="30" onkeypress="return onlyAlphabets(event,this)" {{$readonly}} value="{{@$vendorData->{'Branch Name'} ?? ''}}">
                          <span id="first_branch_name" class="text-danger"></span>
                        </div>
                      </div>

                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="address_account">Address of account / खाते का पता<font color="red">*</font></label>
                         <textarea name="address_account" id="address_of_account" class="form-control form-control-sm" rows="2" placeholder="Enter Address of account" maxlength="80" onkeypress="return onlyAlphabets(event,this)" {{$readonly}}>{{@$vendorData->{'Account Address'} ?? ''}}</textarea>
                         <span id="first_address_of_account" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">PAN card no./ पैन कार्ड नंबर<font color="red">*</font></label>
                         <input type="text" name="PAN" id="pan_card" class="form-control form-control-sm" placeholder="Enter Pan card no." maxlength="10" {{$readonly}} value="{{@$vendorData->{'PAN'} ?? ''}}">
                         <span id="PAN_No_Error" style="color:red;display: none;"></span>
                        </div>
                      </div>
                        <fieldset class="fieldset-border">
                          <legend>ESI Account Details / ईएसआई खाता विवरण</legend>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="ESI_account_no">Account No. / खाता नंबर</label>
                                  <input type="text" name="ESI_account_no" id="ESI_account_no" class="form-control form-control-sm" placeholder="Enter Account no." onkeypress="return onlyNumberKey(event)" maxlength="20"  {{$readonly}} value="{{@$vendorData->{'ESI A_C No_'} ?? ''}}">
                                <span id="alert_address_of_account" style="color:red;display: none;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="ESI_no_employees">No. of employees covered / कवर किए गए कर्मचारियों की संख्या</label>
                                <input type="text" name="ESI_employees_covered" id="ESI_employees_covered" class="form-control form-control-sm" placeholder="Enter no. of employees covered" onkeypress="return onlyNumberKey(event)" maxlength="6"  {{$readonly}} value="@if(@$vendorData->{'No_ Of Emp in ESI'} >0){{@$vendorData->{'No_ Of Emp in ESI'} ?? ''}}@endif">
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
                               <input type="text" name="EPF_account_no" id="EPF_account_no" class="form-control form-control-sm" placeholder="Enter Account no." onkeypress="return onlyNumberKey(event)" maxlength="20"  {{$readonly}} value="{{@$vendorData->{'EPF A_c No_'} ?? ''}}">
                              </div>
                              <span id="alert_EPF_account_no" style="color:red;display: none;"></span>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="Name">No. of employees covered / कवर किए गए कर्मचारियों की संख्या</label>
                                <input type="text" name="EPF_employees_covered" id="EPF_employees_covered" class="form-control form-control-sm" placeholder="Enter no. of employees covered" onkeypress="return onlyNumberKey(event)" maxlength="6"  {{$readonly}} value="@if(@$vendorData->{'No_ Of Emp in EPF'} > 0){{@$vendorData->{'No_ Of Emp in EPF'} ?? ''}}@endif">
                                <span id="alert_EPF_no_of_employees" style="color:red;display: none;"></span>
                              </div>
                            </div>
                          </div>
                        </fieldset>
                        </div>
                        <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
                        <a class="btn btn-primary fm-digital-cinema" id="tab_3">Next
                          <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                    </div>
                    <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Agreement between parties (Owner & Agencies) / पार्टियों (मालिक और एजेंसियों) के बीच समझौता <font color="red">*</font></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="agreement_parties" class="custom-file-input {{$click}}" id="agreement_parties"
                                              id="upload_doc_" accept="application/pdf" {{$readonly}}style="pointer-events:{{$pointer}};" tabindex="{{$tab}}">
                                            <label class="custom-file-label" id="agreement_parties2" for="agreement_parties">{{@$vendorData->{'Agreement File Name'} ?? 'Choose file'}}</label>
                                        </div>
                                        @if(@$vendorData->{'Agreement File Name'} !='')
                                          <div class="input-group-append">
                                          <span class="input-group-text"><a href="{{ url('/uploads') }}/Digital-Cinema/{{@$vendorData->{'Agreement File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                        </div>
                                        @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="agreement_parties3">Upload</span>
                                        </div>
                                        @endif
                                    </div>
                                    <span id="agreement_parties1" class="error invalid-feedback"></span>
                                </div>
                            </div>

                        </div>
                         <div class="row" style="margin-bottom: 35px;}">
                               <div class="col-md-12">
                                <!-- checkbox -->
                                <div class="form-group clearfix">
                                  <div class="icheck-primary d-inline">
                                    @if(@$vendorData->{'Self Declaration'} == '1')
                                    <input type="checkbox" id="Self_declaration" name="Self_declaration" {{$readonly}} value="1"  style="pointer-events:{{$pointer}};" tabindex="{{$tab}}" checked="checked" class="{{$click}}">
                                    @else
                                    <input type="checkbox" id="Self_declaration" name="Self_declaration" value="1">
                                    @endif
                                    <label for="Self_declaration">Self-declaration /स्व घोषणा<font color="red">*</font></label>
                                 </div>
                                </div>
                               </div>
                             </div>
                             <input type="hidden" name="doc[]" id="doc_data">
                        <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
                        @if(@$vendorData->{'Modification'} == '1')
                       <!--  <a class="btn btn-primary fm-digital-cinema" style="pointer-events:{{$pointer}};"><i class="fa fa-paper-plane" aria-hidden="true">
                        </i> Submit</a> -->
                        @else
                        <a class="btn btn-primary fm-digital-cinema"><i class="fa fa-paper-plane" aria-hidden="true">
                        </i> Submit</a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('custom_js')
<script src="{{ url('/js') }}/validator.js"></script>
<script src="{{ url('/js') }}/fress-em-digital-cinema-validation.js"></script>

<script>
$(document).ready(function(){
    $("#add_row").click(function(){
		$("#add_davp").append('<div class="row"><div class="col-md-6"><div class="form-group"><label for="screen_unique_code">Screen Unique Code / स्क्रीन यूनिक कोड*</label><p><input type="text" name="screen_unique_code[]" placeholder="Enter screen unique code" class="form-control form-control-sm" maxlength="30"></p></div></div><div class="col-md-6"><div class="form-group"><label for="number_screens">Number of seats / सीटों की संख्या*</label><p><input type="text" name="number_screens[]" placeholder="Enter number of seats" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8"></p></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 38px;"><button class="btn btn-danger remove_row mr-1">Remove -</button></div></div>');
	});
    $("#add_davp").on('click','.remove_row',function(){
        $(this).parent().parent().remove();
    });
});

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



  $(document).ready(function() {
    $('.preventLeftClick').on('click', function(e) {
        e.preventDefault();
        return false;
    });
});

</script>
@endsection
