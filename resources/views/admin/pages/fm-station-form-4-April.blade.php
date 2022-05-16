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
 <!-- Content Wrapper. Contains page content -->

        <div class="content-inside p-3">
       <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Fresh empanelment of pvt. fm station</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
                  @php 
                  $FMdata =$FMdata ?? [1];  
                  $OD_owners=$OD_owners ?? [1];
                  $Time_band=$Time_band ?? [1];
                  $readonly = ' ';
                  $disabled = ' ';
                  $checked = ' ';
                  $Self_Dec='';
                  $pointer ='';
                  if(@$FMdata->{'Modification'} == 1){
                  $disabled = 'disabled';
                  $readonly = 'readonly';
                  $checked = 'checked';
                  $pointer='none';
                  }
                  @endphp
          <!-- /.end card-header -->  
          <div class="alert alert-success alert-dismissible text-center fade show" id="Final_submi" style="display: none;" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>          
              <div class="card-body p-0">
                <form  method="POST" id="fm_station">
                  @csrf
               <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active show" href="#tab1">Basic Information</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#tab2">Pvt. FM Information</a>
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
                              <label for="Name">Publication Name / प्रकाशन का नाम<font color="red"><font color="red">*</font></font></label>
                              <input type="text" class="form-control form-control-sm" 
                              name="owner_name" id="owner_name"  placeholder="Enter publication name" onkeypress="return onlyAlphabets(event,this)" maxlength="60" {{$disabled}}  value="{{@$OD_owners->{'Owner Name'} ?? ''}}" >
                            
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">E-mail ID / ई मेल आईडी<font color="red">*</font></label>
                            <input type="email" class="form-control form-control-sm" name="email" id="email_owner" placeholder="Enter email" {{$disabled}}  value="{{@$OD_owners->{'Email ID'} ?? ''}}">
                          <span id="first_email" class="text-danger"></span>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="mobile" id="mobile" placeholder="Enter mobile no." onkeypress="return onlyNumberKey(event)" maxlength="10" {{$disabled}}  value="{{@$OD_owners->{'Mobile No_'} ?? ''}}">
                          <span id="first_mobile" class="text-danger"></span>
                          </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Address / पता<font color="red">*</font></label>
          
                        <textarea name="address" id="address" class="form-control form-control-sm" row="2" maxlength="120" placeholder="Enter Address" {{$disabled}}>{{@$OD_owners->{'Address 1'} ?? ''}}</textarea>

                        <span id="first_address" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group"> 
                          <label for="Name">State / राज्य<font color="red">*</font></label>
                          <select  id="state_id" name="state" class="form-control form-control-sm" {{$disabled}} style="pointer-events:{{$pointer}}">
                              <option   value="">Select State</option>
                              @if(count($states) > 0)
                                  @foreach($states as $statesData)
                                    <option   value="{{ $statesData['Code'] }}" @if(@$OD_owners->{'State'} == $statesData['Code']) selected="selected" @endif>{{$statesData['Description']}}
                                    </option>
                                  @endforeach
                                @endif
                          </select>
                           <span id="first_state" class="text-danger"></span>
                         </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group"> 
                          <label for="Name">District / ज़िला<font color="red">*</font></label>
                          <select  id="district_id" name="district" class="form-control form-control-sm" {{$disabled}} style="pointer-events:{{$pointer}}">
                              <option  value="">Select District</option>
                              @if($dist > 0)
                              @foreach($dist as $distr)
                              <option value="{{$distr['District'] ?? ''}}" 
                              @if(@$OD_owners->{'District'} == $distr['District']) selected="selected" @endif>{{$distr['District'] ?? ''}}</option>
                              @endforeach
                              @endif
                          </select>
                           <span id="first_district" class="text-danger"></span>
                         </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group"> 
                          <label for="Name">City / नगर<font color="red">*</font></label>
                          <input type="text"  name="city" id="city" class="form-control form-control-sm" placeholder="Enter city" maxlength="30" {{$disabled}}  value="{{@$OD_owners->{'City'} ?? ''}}">
                         </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Phone No. (with STD code)  / फोन नंबर (एसटीडी कोड के साथ)</label>
                          <input type="text" class="form-control form-control-sm" name="phone" id="phone" placeholder="Enter phone number" onkeypress="return onlyNumberKey(event)" maxlength="15" {{$disabled}}  value="{{@$OD_owners->{'Phone No_'} ?? ''}}">
                        </div>
                      </div>
                      </div>
                    <input type="hidden" name="ownerid" id="ownerid"   value="{{@$OD_owners->{'Owner ID'} ?? ''}}">

                      @if(@$FMdata->{'Status'} == 1)
                       <input type="hidden"  id="next_tab_1"  value="0">
                       @else
                      <input type="hidden" name="next_tab_1" id="next_tab_1"  value="0">
                      @endif
                      <a class="btn btn-primary fm-next-button" id="tab_1">Next  <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                      
                      <!-- <button class="btn btn-primary" id="tab_1">Next</button> -->
                    </div>
                    <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="logins-part-trigger">
                    <div class="row">
                      <div class="col-md-6">
                      <div class="form-group">
                        <label for="newspaper_name">FM station name / रेडियो स्टेशन का नाम<font color="red">*</font></label>
                        <input type="text" name="FM_station_name" placeholder="Enter FM station name" class="form-control form-control-sm" id="station_name" onkeypress="return onlyAlphabets(event,this)" {{$disabled}}  value="{{@$FMdata->{'FM Station Name'} ?? ''}}">
                        <span id="first_station_name" class="text-danger" ></span>
                      </div>
                      </div>
                      <div class="col-md-6">
                      <div class="form-group">
                        <label for="place_of_publication">Broadcast From / प्रसारण  से<font color="red">*</font></label>
                        <input type="text" name="Broadcast_City" placeholder="Broadcast from" class="form-control form-control-sm" id="Broadcast" {{$disabled}}  value="{{@$FMdata->{'Broadcast City'} ?? ''}}">
                         <span id="first_Broadcast"  class="text-danger"></span>
                      </div>
                      </div>
            
                      <div class="col-md-6">
                      <div class="form-group">
                        <label for="place_of_publication">Group belong to / समूह संबंधित<font color="red">*</font></label>
                        <input type="text" name="Media_Group" placeholder="Group belong to" class="form-control form-control-sm" id="Group_belong_to" {{$disabled}}  value="{{@$FMdata->{'Media Group'} ?? ''}}">
                        <span class="text-danger" id="first_belong_to"></span>
                      </div>
                      </div>
                    
            
                      <div class="col-md-6">
                      <div class="form-group">
                      <label>Language of broadcast / प्रसारण की भाषा<font color="red">*</font></label>
                        <select name="language" class="form-control form-control-sm" id="language_of_broadcast"  style="width: 100%;" {{$disabled}} style="pointer-events:{{$pointer}}">
                          <option value="">Select Language of broadcast</option>
                           
                                 @if(count($languag) > 0)

                                        @foreach($languag as $stdata)
                                          <option  value="{{ $stdata['Code'] }}" @if(@$FMdata->{'Language'} == $stdata['Code']) selected="selected" @endif>{{$stdata['Name']}}</option>
                                        @endforeach
                                      @endif
                        </select>
                        <span class="text-danger" id="first_language_of_broadcast"></span>
                      </div>
                      </div>
                      
                     <div class="col-md-3">
                      <div class="form-group">
                        
                      </div>
                    </div>
            
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="place_of_publication">Time Band 1 / टाइम बैंड 1</label>
                        
                      </div>
                    </div>
                      
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="place_of_publication">Time Band 2 / टाइम बैंड 2</label>
                        
                      </div>
                    </div>
            
                     <div class="col-md-3">
                      <div class="form-group">
                        <label for="place_of_publication">Time Band 3 / टाइम बैंड 3</label>
                        
                      </div>
                    </div>
            
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="place_of_publication">Monday / सोमवार<font color="red">*</font></label>
                    
                      </div>
                    </div>
           
            @php
              $Mon_TB1_From =substr(@$Time_band->{'Mon TB1 From'}, 11,12);
              $m_tb1_f ='';
              if($Mon_TB1_From != '00:00:00.000'){
                $m_tb1_f = $Mon_TB1_From;
                }else{
                $m_tb1_f ='';
                }

            @endphp
            <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm" {{$disabled}}  value="{{$m_tb1_f ?? ''}}" id="Mon_TB1_From" name="Mon_TB1_From" data-val="Mon_TB1_">
             </div>
          </div>
             @php
              $Mon_TB1_To =substr(@$Time_band->{'Mon TB1 To'}, 11,12);
              $m_tb1_t ='';
              if($Mon_TB1_To != '00:00:00.000'){
                $m_tb1_t = $Mon_TB1_To;
                }else{
                $m_tb1_t ='';
                }

            @endphp
           <div class="col-md-2" id="to">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm" id="Mon_TB1_To" name="Mon_TB1_To" data-id="Mon_TB1_" data-deep="Mon_TB2_"  {{$disabled}}  value="{{$m_tb1_t ?? ''}}">
             </div>
                     </div>
           @php
              $Mon_TB2_From =substr(@$Time_band->{'Mon TB2 From'}, 11,12);
              $m_tb2_f ='';
              if($Mon_TB2_From != '00:00:00.000'){
                $m_tb2_f = $Mon_TB2_From;
                }else{
                $m_tb2_f ='';
                }

            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm" id="Mon_TB2_From" name="Mon_TB2_From"  data-val="Mon_TB2_" {{$disabled}}  value="{{$m_tb2_f ?? ''}}">
             </div>
                     </div>
             @php
              $Mon_TB2_To =substr(@$Time_band->{'Mon TB2 To'}, 11,12);
              $m_tb2_t ='';
              if($Mon_TB2_From != '00:00:00.000'){
                $m_tb2_t = $Mon_TB2_To;
                }else{
                $m_tb2_t ='';
                }

            @endphp
           <div class="col-md-2" id="to">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm" id="Mon_TB2_To" name="Mon_TB2_To" data-id="Mon_TB2_" {{$disabled}} data-deep="Mon_TB3_"  value="{{$m_tb2_t ?? ''}}">
             </div>
                     </div>
                       @php
              $Mon_TB3_From =substr(@$Time_band->{'Mon TB3 From'}, 11,12);
              $m_tb3_f ='';
              if($Mon_TB3_From != '00:00:00.000'){
                $m_tb3_f = $Mon_TB3_From;
                }else{
                $m_tb3_f ='';
                }

            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm" id="Mon_TB3_From" name="Mon_TB3_From"  data-val="Mon_TB3_" {{$disabled}}  value="{{$m_tb3_f ?? ''}}">
             </div>
          </div>
             @php
              $Mon_TB3_To =substr(@$Time_band->{'Mon TB3 To'}, 11,12);
              $m_tb3_t ='';
              if($Mon_TB3_To != '00:00:00.000'){
                $m_tb3_t = $Mon_TB3_To;
                }else{
                $m_tb3_t ='';
                }

            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm" id="Mon_TB3_To" name="Mon_TB3_To" data-id="Mon_TB3_" {{$disabled}}  value="{{$m_tb3_t ?? ''}}">
             </div>
          </div>
           
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">Tuesday / मंगलवार<font color="red">*</font></label>
             </div>
            </div>
            @php
              $Tue_TB1_From =substr(@$Time_band->{'Tue TB1 From'}, 11,12);
              $t_tb1_f ='';
              if($Tue_TB1_From != '00:00:00.000'){
                $t_tb1_f = $Tue_TB1_From;
                }else{
                $t_tb1_f ='';
                }

            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm" id="Tue_TB1_From" name="Tue_TB1_From" data-val="Tue_TB1_" {{$disabled}}  value="{{$t_tb1_f ?? ''}}">
             </div>
          </div>
            @php
              $Tue_TB1_To =substr(@$Time_band->{'Tue TB1 To'}, 11,12);
              $t_tb1_t ='';
              if($Tue_TB1_To != '00:00:00.000'){
                $t_tb1_t = $Tue_TB1_To;
                }else{
                $t_tb1_t ='';
                }

            @endphp
           <div class="col-md-2" id="to">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm" 
                id="Tue_TB1_To" name="Tue_TB1_To" data-id="Tue_TB1_" data-deep="Tue_TB2_" {{$disabled}}  value="{{$t_tb1_t ?? ''}}">
             </div>
          </div>
           @php
              $Tue_TB2_From =substr(@$Time_band->{'Tue TB2 From'}, 11,12);
              $t_tb2_f ='';
              if($Tue_TB2_From != '00:00:00.000'){
                $t_tb2_f = $Tue_TB2_From;
                }else{
                $t_tb2_f ='';
                }

            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm" id="Tue_TB2_From" name="Tue_TB2_From" data-val="Tue_TB2_" {{$disabled}}  value="{{$t_tb2_f ?? ''}}">
             </div>
          </div>
            @php
              $Tue_TB2_To =substr(@$Time_band->{'Tue TB2 To'}, 11,12);
              $t_tb2_t ='';
              if($Tue_TB2_To != '00:00:00.000'){
                $t_tb2_t = $Tue_TB2_To;
                }else{
                $t_tb2_t ='';
                }

            @endphp
           <div class="col-md-2" id="to">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                id="Tue_TB2_To" name="Tue_TB2_To" data-id="Tue_TB2_" data-deep="Tue_TB3_" {{$disabled}}  value="{{$t_tb2_t ?? ''}}">
             </div>
          </div>
              @php
              $Tue_TB3_From =substr(@$Time_band->{'Tue TB3 From'}, 11,12);
              $t_tb3_f ='';
              if($Tue_TB3_From != '00:00:00.000'){
                $t_tb3_f = $Tue_TB3_From;
                }else{
                $t_tb3_f ='';
                }

            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                id="Tue_TB3_From" name="Tue_TB3_From"  data-val="Tue_TB3_" {{$disabled}}  value="{{$t_tb3_f ?? ''}}">
             </div>
          </div>
           @php
              $Tue_TB3_To =substr(@$Time_band->{'Tue TB3 To'}, 11,12);
              $t_tb3_t ='';
              if($Tue_TB3_To != '00:00:00.000'){
                $t_tb3_t = $Tue_TB3_To;
                }else{
                $t_tb3_t ='';
                }

            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm" 
                 id="Tue_TB3_To" name="Tue_TB3_To" data-id="Tue_TB3_" {{$disabled}}  value="{{$t_tb3_t ?? ''}}">
             </div>
          </div>
           
           <div class="col-md-2">
                      <div class="form-group">
                        <label for="place_of_publication">Wednesday / बुधवार<font color="red">*</font></label>
                        
                      </div>
                      </div>
             @php
              $Wed_TB1_From =substr(@$Time_band->{'Wed TB1 From'}, 11,12);
              $w_tb1_f ='';
              if($Wed_TB1_From != '00:00:00.000'){
                $w_tb1_f = $Wed_TB1_From;
                }else{
                $w_tb1_f ='';
                }

            @endphp
            <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                id="Wed_TB1_From" name="Wed_TB1_From"  data-val="Wed_TB1_" {{$disabled}}  value="{{$w_tb1_f ?? ''}}">
             </div>
          </div>
           @php
              $Wed_TB1_To =substr(@$Time_band->{'Wed TB1 To'}, 11,12);
              $w_tb1_t ='';
              if($Wed_TB1_To != '00:00:00.000'){
                $w_tb1_t = $Wed_TB1_To;
                }else{
                $w_tb1_t ='';
                }

            @endphp
           <div class="col-md-2" id="to">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                 id="Wed_TB1_To" name="Wed_TB1_To" data-id="Wed_TB1_" data-deep="Wed_TB2_" {{$disabled}}  value="{{$w_tb1_t ?? ''}}">
             </div>
          </div>
           @php
              $Wed_TB2_From =substr(@$Time_band->{'Wed TB2 From'}, 11,12);
              $w_tb2_f ='';
              if($Wed_TB2_From != '00:00:00.000'){
                $w_tb2_f = $Wed_TB2_From;
                }else{
                $w_tb2_f ='';
                }

            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                id="Wed_TB2_From" data-val="Wed_TB2_" name="Wed_TB2_From" {{$disabled}}  value="{{$w_tb2_f ?? ''}}">
             </div>
          </div>
            @php
              $Wed_TB2_To =substr(@$Time_band->{'Wed TB2 To'}, 11,12);
              $w_tb2_t ='';
              if($Wed_TB2_To != '00:00:00.000'){
                $w_tb2_t = $Wed_TB2_To;
                }else{
                $w_tb2_t ='';
                }

            @endphp
           <div class="col-md-2" id="to">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                id="Wed_TB2_To" name="Wed_TB2_To" data-id="Wed_TB2_" data-deep="Wed_TB3_"  {{$disabled}}  value="{{$w_tb2_t ?? ''}}">
             </div>
          </div>
                    @php
              $Wed_TB3_From =substr(@$Time_band->{'Wed TB3 From'}, 11,12);
              $w_tb3_f ='';
              if($Wed_TB3_From != '00:00:00.000'){
                $w_tb3_f = $Wed_TB3_From;
                }else{
                $w_tb3_f ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                id="Wed_TB3_From" name="Wed_TB3_From" data-val="Wed_TB3_" {{$disabled}}  value="{{$w_tb3_f ?? ''}}">
             </div>
          </div>
            @php
              $Wed_TB3_To =substr(@$Time_band->{'Wed TB3 To'}, 11,12);
              $w_tb3_t ='';
              if($Wed_TB3_To != '00:00:00.000'){
                $w_tb3_t = $Wed_TB3_To;
                }else{
                $w_tb3_t ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                id="Wed_TB3_To" name="Wed_TB3_To"  data-id="Wed_TB3_" {{$disabled}}  value="{{$w_tb3_t ?? ''}}">
             </div>
          </div>
           
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">Thursday / गुरूवार<font color="red">*</font></label>
             </div>
           </div>
            @php
              $Thur_TB1_From =substr(@$Time_band->{'Thur TB1 From'}, 11,12);
              $thur_tb1_f ='';
              if($Thur_TB1_From != '00:00:00.000'){
                $thur_tb1_f = $Thur_TB1_From;
                }else{
                $thur_tb1_f ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                id="Thur_TB1_From" name="Thur_TB1_From" data-val="Thur_TB1_" {{$disabled}}  value="{{$thur_tb1_f ?? ''}}">
             </div>
          </div>
           @php
              $Thur_TB1_From =substr(@$Time_band->{'Thur TB1 To'}, 11,12);
              $thur_tb1_t ='';
              if($Thur_TB1_From != '00:00:00.000'){
                $thur_tb1_t = $Thur_TB1_From;
                }else{
                $thur_tb1_t ='';
                }
            @endphp
           <div class="col-md-2" id="to">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                id="Thur_TB1_To" name="Thur_TB1_To" data-id="Thur_TB1_" data-deep="Thur_TB2_" {{$disabled}}  value="{{$thur_tb1_t ?? ''}}">
             </div>
          </div>
            @php
              $Thur_TB2_From =substr(@$Time_band->{'Thur TB2 From'}, 11,12);
              $thur_tb2_f ='';
              if($Thur_TB2_From != '00:00:00.000'){
                $thur_tb2_f = $Thur_TB2_From;
                }else{
                $thur_tb2_f ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                id="Thur_TB2_From" name="Thur_TB2_From" data-val="Thur_TB2_" {{$disabled}}  value="{{$thur_tb2_f ?? ''}}">
             </div>
          </div>
            @php
              $Thur_TB2_To =substr(@$Time_band->{'Thur TB2 To'}, 11,12);
              $thur_tb2_t ='';
              if($Thur_TB2_To != '00:00:00.000'){
                $thur_tb2_t = $Thur_TB2_To;
                }else{
                $thur_tb2_t ='';
                }
            @endphp
           <div class="col-md-2" id="to">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                 id="Thur_TB2_To" name="Thur_TB2_To" data-id="Thur_TB2_" data-deep="Thur_TB3_" {{$disabled}}  value="{{$thur_tb2_t  ?? ''}}">
             </div>
          </div>
                    @php
              $Thur_TB3_From =substr(@$Time_band->{'Thur TB3 From'}, 11,12);
              $thur_tb3_f ='';
              if($Thur_TB3_From != '00:00:00.000'){
                $thur_tb3_f = $Thur_TB3_From;
                }else{
                $thur_tb3_f ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                id="Thur_TB3_From" name="Thur_TB3_From" data-val="Thur_TB3_" {{$disabled}}  value="{{$thur_tb3_f ?? ''}}">
             </div>
          </div>
           @php
              $Thur_TB3_To =substr(@$Time_band->{'Thur TB3 To'}, 11,12);
              $thur_tb3_t ='';
              if($Thur_TB3_To != '00:00:00.000'){
                $thur_tb3_t = $Thur_TB3_To;
                }else{
                $thur_tb3_t ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                 id="Thur_TB3_To" name="Thur_TB3_To" data-id="Thur_TB3_" {{$disabled}}  value="{{$thur_tb3_t ?? ''}}">
             </div>
          </div>
           
           <div class="col-md-2">
              <div class="form-group">
                <label for="Friday">Friday / शुक्रवार<font color="red">*</font></label>
             </div>
          </div>
            @php
              $Fri_TB1_From =substr(@$Time_band->{'Fri TB1 From'}, 11,12);
              $fri_tb1_f ='';
              if($Fri_TB1_From != '00:00:00.000'){
                $fri_tb1_f = $Fri_TB1_From;
                }else{
                $fri_tb1_f ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                id="Fri_TB1_From" name="Fri_TB1_From" data-val="Fri_TB1_" {{$disabled}}  value="{{$fri_tb1_f ?? ''}}">
             </div>
          </div>
            @php
              $Fri_TB1_To =substr(@$Time_band->{'Fri TB1 To'}, 11,12);
              $fri_tb1_t ='';
              if($Fri_TB1_To != '00:00:00.000'){
                $fri_tb1_t = $Fri_TB1_To;
                }else{
                $fri_tb1_t ='';
                }
            @endphp
           <div class="col-md-2" id="to">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                id="Fri_TB1_To" name="Fri_TB1_To" data-id="Fri_TB1_" data-deep="Fri_TB2_" {{$disabled}}  value="{{$fri_tb1_t ?? ''}}">
             </div>
          </div>
           @php
              $Fri_TB2_From =substr(@$Time_band->{'Fri TB2 From'}, 11,12);
              $fri_tb2_f ='';
              if($Fri_TB2_From != '00:00:00.000'){
                $fri_tb2_f = $Fri_TB2_From;
                }else{
                $fri_tb2_f ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                 id="Fri_TB2_From" name="Fri_TB2_From" data-val="Fri_TB2_" {{$disabled}}  value="{{$fri_tb2_f ?? '' }}">
             </div>
          </div>
           @php
              $Fri_TB2_To =substr(@$Time_band->{'Fri TB2 To'}, 11,12);
              $fri_tb2_t ='';
              if($Fri_TB2_To != '00:00:00.000'){
                $fri_tb2_t = $Fri_TB2_To;
                }else{
                $fri_tb2_t ='';
                }
            @endphp
           <div class="col-md-2" id="to">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                 id="Fri_TB2_To" name="Fri_TB2_To" data-id="Fri_TB2_"  data-deep="Fri_TB3_" {{$disabled}}  value="{{$fri_tb2_t ?? ''}}">
             </div>
          </div>
            @php
              $Fri_TB3_From =substr(@$Time_band->{'Fri TB3 From'}, 11,12);
              $fri_tb3_f ='';
              if($Fri_TB3_From != '00:00:00.000'){
                $fri_tb3_f = $Fri_TB3_From;
                }else{
                $fri_tb3_f ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                 id="Fri_TB3_From" name="Fri_TB3_From" data-val="Fri_TB3_" {{$disabled}}  value="{{$fri_tb3_f ?? ''}}">
             </div>
          </div>
            @php
              $Fri_TB3_To =substr(@$Time_band->{'Fri TB3 To'}, 11,12);
              $fri_tb3_t ='';
              if($Fri_TB3_To != '00:00:00.000'){
                $fri_tb3_t = $Fri_TB3_To;
                }else{
                $fri_tb3_t ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                 id="Fri_TB3_To" name="Fri_TB3_To" data-id="Fri_TB3_" {{$disabled}}  value="{{$fri_tb3_t ?? ''}}">
             </div>
          </div>
           
           <div class="col-md-2">
                      <div class="form-group">
                        <label for="Saturday">Saturday / शनिवार<font color="red">*</font></label>
                        
                      </div>
                      </div>
             @php
              $Sat_TB1_From =substr(@$Time_band->{'Sat TB1 From'}, 11,12);
              $sat_tb1_f ='';
              if($Sat_TB1_From != '00:00:00.000'){
                $sat_tb1_f = $Sat_TB1_From;
                }else{
                $sat_tb1_f ='';
                }
            @endphp
            <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                id="Sat_TB1_From" name="Sat_TB1_From" data-val="Sat_TB1_" {{$disabled}}  value="{{$sat_tb1_f ?? ''}}">
             </div>
          </div>
           @php
              $Sat_TB1_To =substr(@$Time_band->{'Sat TB1 To'}, 11,12);
              $sat_tb1_t ='';
              if($Sat_TB1_To != '00:00:00.000'){
                $sat_tb1_t = $Sat_TB1_To;
                }else{
                $sat_tb1_t ='';
                }
            @endphp
           <div class="col-md-2" id="to">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                id="Sat_TB1_To" name="Sat_TB1_To" data-id="Sat_TB1_" data-deep="Sat_TB2_" {{$disabled}}  value="{{$sat_tb1_t ?? ''}}">
             </div>
          </div>
           @php
              $Sat_TB2_From =substr(@$Time_band->{'Sat TB2 From'}, 11,12);
              $sat_tb2_f ='';
              if($Sat_TB2_From != '00:00:00.000'){
                $sat_tb2_f = $Sat_TB2_From;
                }else{
                $sat_tb2_f ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                id="Sat_TB2_From" name="Sat_TB2_From" data-val="Sat_TB2_" {{$disabled}}  value="{{$sat_tb2_f ?? ''}}">
             </div>
        </div>
            @php
              $Sat_TB2_To =substr(@$Time_band->{'Sat TB2 To'}, 11,12);
              $sat_tb2_t ='';
              if($Sat_TB2_To != '00:00:00.000'){
                $sat_tb2_t = $Sat_TB2_To;
                }else{
                $sat_tb2_t ='';
                }
            @endphp
           <div class="col-md-2" id="to">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                id="Sat_TB2_To" name="Sat_TB2_To" data-id="Sat_TB2_" data-deep="Sat_TB3_" {{$disabled}}  value="{{$sat_tb2_t ?? ''}}">
             </div>
           </div>
              @php
              $Sat_TB3_From =substr(@$Time_band->{'Sat TB3 From'}, 11,12);
              $sat_tb3_f ='';
              if($Sat_TB3_From != '00:00:00.000'){
                $sat_tb3_f = $Sat_TB3_From;
                }else{
                $sat_tb3_f ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                id="Sat_TB3_From" name="Sat_TB3_From" data-val="Sat_TB3_" {{$disabled}}  value="{{$sat_tb3_f ?? ''}}">
             </div>
          </div>
           @php
              $Sat_TB3_To =substr(@$Time_band->{'Sat TB3 To'}, 11,12);
              $sat_tb3_t ='';
              if($Sat_TB3_To != '00:00:00.000'){
                $sat_tb3_t = $Sat_TB3_To;
                }else{
                $sat_tb3_t ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                id="Sat_TB3_To" name="Sat_TB3_To" data-id="Sat_TB3_" {{$disabled}}  value="{{$sat_tb3_t  ?? ''}}">
             </div>
          </div>
           
          <div class="col-md-2">
              <div class="form-group">
                <label for="from">Sunday / रविवार<font color="red">*</font></label>
             </div>
          </div>
            @php
              $Sun_TB1_From =substr(@$Time_band->{'Sun TB1 From'}, 11,12);
              $sun_tb1_f ='';
              if($Sun_TB1_From != '00:00:00.000'){
                $sun_tb1_f = $Sun_TB1_From;
                }else{
                $sun_tb1_f ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                id="Sun_TB1_From" name="Sun_TB1_From" data-val="Sun_TB1_" {{$disabled}}  value="{{$sun_tb1_f ?? ''}}">
             </div>
          </div>
             @php
              $Sun_TB1_To =substr(@$Time_band->{'Sun TB1 To'}, 11,12);
              $sun_tb1_t ='';
              if($Sun_TB1_To != '00:00:00.000'){
                $sun_tb1_t = $Sun_TB1_To;
                }else{
                $sun_tb1_t ='';
                }
            @endphp
           <div class="col-md-2" id="to">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                id="Sun_TB1_To" name="Sun_TB1_To" data-id="Sun_TB1_" data-deep="Sun_TB2_" {{$disabled}}  value="{{$sun_tb1_t ?? ''}}">
             </div>
          </div>
            @php
              $Sun_TB2_From =substr(@$Time_band->{'Sun TB2 From'}, 11,12);
              $sun_tb2_f ='';
              if($Sun_TB2_From != '00:00:00.000'){
                $sun_tb2_f = $Sun_TB2_From;
                }else{
                $sun_tb2_f ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                id="Sun_TB2_From" name="Sun_TB2_From" data-val="Sun_TB2_" {{$disabled}}  value="{{$sun_tb2_f ?? ''}}">
             </div>
          </div>
           @php
              $Sun_TB2_To =substr(@$Time_band->{'Sun TB2 To'}, 11,12);
              $sun_tb3_t ='';
              if($Sun_TB2_To != '00:00:00.000'){
                $sun_tb3_t = $Sun_TB2_To;
                }else{
                $sun_tb3_t ='';
                }
            @endphp
           <div class="col-md-2" id="to">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                id="Sun_TB2_To" name="Sun_TB2_To" data-id="Sun_TB2_" data-deep="Sun_TB3_"  {{$disabled}}  value="{{$sun_tb3_t ?? ''}}">
             </div>
            </div>
              @php
              $Sun_TB3_From =substr(@$Time_band->{'Sun TB3 From'}, 11,12);
              $sun_tb3_f ='';
              if($Sun_TB3_From != '00:00:00.000'){
                $sun_tb3_f = $Sun_TB3_From;
                }else{
                $sun_tb3_f ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="from">From:</label>
                <input type="time" class="form-control form-control-sm"
                id="Sun_TB3_From" name="Sun_TB3_From" data-val="Sun_TB3_" {{$disabled}}  value="{{$sun_tb3_f ?? ''}}">
             </div>
          </div>
           @php
              $Sun_TB3_To =substr(@$Time_band->{'Sun TB3 To'}, 11,12);
              $sun_tb3_t ='';
              if($Sun_TB3_To != '00:00:00.000'){
                $sun_tb3_t = $Sun_TB3_To;
                }else{
                $sun_tb3_t ='';
                }
            @endphp
           <div class="col-md-2">
              <div class="form-group">
                <label for="To">To:</label>
                <input type="time" class="form-control form-control-sm"
                id="Sun_TB3_To" name="Sun_TB3_To" data-id="Sun_TB3_" {{$disabled}}  value="{{$sun_tb3_t ?? ''}}">
             </div>
          </div>
           @php
              $GOPA_Validity_Date =substr(@$FMdata->{'GOPA Validity Date'}, 0,10);
              $gopa_v_d ='';
              if($GOPA_Validity_Date != '1970-01-01'){
                $gopa_v_d = $GOPA_Validity_Date;
                }else{
                $gopa_v_d ='';

                }
                
            @endphp
           <div class="col-md-6">
              <div class="form-group">
                <label for="To">GOPA valid upto / गोपा वैध तक<font color="red">*</font></label><input type="date" name="GOPA_Validity_Date" id="GOPA_Validity_Date" class="form-control form-control-sm" {{$disabled}}  value="{{$gopa_v_d ?? ''}}">
             </div>
          </div>
            @php
              $WOL_Validity_Date =substr(@$FMdata->{'WOL Validity Date'},0,10);
              $WOL_v_d ='';
              if($WOL_Validity_Date != '1970-01-01'){
                $WOL_v_d = $WOL_Validity_Date;
                }else{
                $WOL_v_d ='';

                }
                
            @endphp
           <div class="col-md-6">
              <div class="form-group">
                <label for="To">WOL valid upto / वोलो वैध तक<font color="red">*</font></label><input type="date" name="WOL_Validity_Date" class="form-control form-control-sm" id="WOL_Validity_Date"  {{$disabled}}  value="{{$WOL_v_d ?? ''}}">
                
             </div>
          </div>
           
           <div class="col-md-6" style="margin-top: 25px;">
              <div class="form-group">
                <label for="To">Legal status of company / कंपनी की कानूनी स्थिति</label>
                <select name="legal_company" name="legal_company" id="legal_company" class="form-control form-control-sm" {{$disabled}} style="width: 100%;">
                <option {{$disabled}}  value="">Select legal status of company</option>
                <option {{$disabled}}  value="1" @if(@$FMdata->{'Company Legal Status'} =='1') selected="selected" @endif>Pvt</option>
                <option {{$disabled}}  value="2" @if(@$FMdata->{'Company Legal Status'} =='2') selected="selected" @endif>Ltd</option>
                <option {{$disabled}}  value="3" @if(@$FMdata->{'Company Legal Status'} =='3') selected="selected" @endif>Others</option>
               </select>
              
             </div>
            </div>
            @php 
              $Commercial_Launch_Date =substr(@$FMdata->{'WOL Validity Date'}, 0,10);
              $Comm_v_d ='';
              if($Commercial_Launch_Date != '1970-01-01'){
                $Comm_v_d = $Commercial_Launch_Date;
                }else{
                $Comm_v_d ='';

                }
                
            @endphp
           <div class="col-md-6">
              <div class="form-group">
                <label for="To">Pvt. FM commercial launch date /प्राइवेट एफएम वाणिज्यिक लॉन्च की तारीख<font color="red">*</font></label>
                <input type="date" name="Commercial_Launch_Date" class="form-control form-control-sm" id="Commercial_Launch_Date" {{$disabled}}  value="@if(!empty($Comm_v_d)){{date('Y-m-d', strtotime($Comm_v_d)) ?? ''}}@endif">
                
             </div>
                     </div>

                   <div class="row col-md-12 ml-1">
                    
                      <h4 class="subheading">Delhi office address/ दिल्ली कार्यालय का पता :-</h4>
                    </div>
           <!-- <h6 class="p-3">Address Details / पते का विवरण<br>Station Delhi Office: / स्टेशन दिल्ली कार्यालय</span></h6> -->
           <div class="row p-3">

           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Contact Name / संपर्क नाम <font color="red">*</font></label>
                <input type="text" name="DO_Contact_Name" class="form-control form-control-sm" id="DO_Contact_Name" placeholder="Contact Name" onkeypress="return onlyAlphabets(event,this)" maxlength="60" {{$disabled}}  value="{{@$FMdata->{'DO Contact Name'} ?? ''}}">
             </div>
                     </div>
           
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Address / पता<font color="red">*</font></label>
                <textarea name="DO_Address" id="DO_Address" placeholder="Address" rows="2" class="form-control form-control-sm" maxlength="120" {{$disabled}}>{{@$FMdata->{'DO Address'} ?? ''}}</textarea>
             </div>
          </div>
           
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Designation / पद<font color="red">*</font> </label>
                <input type="text" name="DO_Designation" class="form-control form-control-sm" id="DO_Designation" placeholder="Designation"
                maxlength="40" {{$disabled}}  value="{{@$FMdata->{'DO Designation'} ?? ''}}">
            
             </div>
            </div>
           
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Landline No. / लैंडलाइन नंबर </label>
                <input type="text" name="DO_Landline_No" class="form-control form-control-sm" id="DO_Landline_No" placeholder="Landline No." maxlength="15" onkeypress="return onlyNumberKey(event)" maxlength="15" {{$disabled}}  value="{{@$FMdata->{'DO Landline No_(with STD)'} ?? ''}}">
               
             </div>
          </div>
           
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
                <input type="text" name="DO_Mobile" class="form-control form-control-sm" id="DO_Mobile" placeholder="Mobile No." maxlength="10" onkeypress="return onlyNumberKey(event)" maxlength="10" {{$disabled}}  value="{{@$FMdata->{'DO Mobile No_'} ?? ''}}">
              
             </div>
          </div>
           
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">E-Mail ID / ई मेल आईडी <font color="red">*</font></label>
                <input type="email" name="DO_Email" class="form-control form-control-sm" id="DO_Email" placeholder="E-Mail ID" maxlength="50" {{$disabled}}  value="{{@$FMdata->{'DO E-Mail'} ?? ''}}">
              
             </div>
          </div>
          </div>
         <div class="row col-md-12 ml-1">
             <h4 class="subheading">Operating address of Pvt. FM station/ प्राइवेट एफएम स्टेशन का संचालन पता :-
             </h4>
        </div>
       <div class="row p-3">
              <div class="col-md-12">
                <div class="form-group clearfix">
                  <div class="icheck-primary d-inline">
                    @if(@$FMdata->{'OP Same Address DO'} == '1')
                    <input type="checkbox" id="OP_Same_Address_as_DO" name="OP_Same_Address_as_DO" class="get_channel_office_data" data="OHO" {{$disabled}}  value="1" checked="checked" style="pointer-events: none;">
                    @else
                    <input type="checkbox" id="OP_Same_Address_as_DO" name="OP_Same_Address_as_DO" class="get_channel_office_data" data="OHO" {{$disabled}}  value="1">
                    @endif
                    <label for="OP_Same_Address_as_DO">Same as delhi office / दिल्ली कार्यालय के समान</label>
                  </div>
                </div>
              </div>
            </div>
           <div class="row p-3">
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Contact Name/ संपर्क नाम <font color="red">*</font></label>
                <input type="text" name="OP_contact_name" class="form-control form-control-sm" id="OP_contact_name" placeholder="Contact Name" onkeypress="return onlyAlphabets(event,this)"  {{$disabled}}  value="{{@$FMdata->{'OP Contact Name'} ?? ''}}">
              
             </div>
          </div>
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Address / पता <font color="red">*</font></label>
                <textarea name="OP_Address" id="OP_Address" placeholder="Enter Address" rows="2" class="form-control form-control-sm" maxlength="120" {{$disabled}}>{{@$FMdata->{'OP Address'} ?? ''}}</textarea>
               
             </div>
          </div>
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Designation / पद <font color="red">*</font></label>
                <input type="text" class="form-control form-control-sm" name="OP_Designation" placeholder="Designation" 
                id="OP_Designation" maxlength="40" {{$disabled}}  value="{{@$FMdata->{'OP Designation'} ?? ''}}">
                
             </div>
            </div>
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Landline No. / लैंडलाइन नंबर </label>
                <input type="text" class="form-control form-control-sm" name="OP_Landline_No"  id="OP_Landline_No" placeholder="Landline No." maxlength="15" onkeypress="return onlyNumberKey(event)" {{$disabled}}  value="{{@$FMdata->{'OP Landline No_(with STD)'} ?? ''}}">
             </div>
             </div>
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
                <input type="text" class="form-control form-control-sm" name="OP_Mobile_No" id="OP_Mobile_No"  placeholder="Mobile No." maxlength="10" onkeypress="return onlyNumberKey(event)" {{$disabled}}  value="{{@$FMdata->{'OP Mobile No_'} ?? ''}}">
              
             </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="To">E-Mail ID / ई मेल आईडी<font color="red">*</font></label>
                <input type="email" class="form-control form-control-sm" name="OP_Email" id="OP_Email" placeholder="E-Mail ID" {{$disabled}}  value="{{@$FMdata->{'OP E-Mail'} ?? ''}}">
              
             </div>
            </div>
          </div>
       <div class="row col-md-12 ml-1">
         <h4 class="subheading">Address of head office to which pvt FM station belongs to/ प्रधान कार्यालय का पता जिससे प्राइवेट एफएम स्टेशन संबंधित है :-</h4>
        </div> 
       <div class="row p-3">
          <div class="col-md-12">
            <div class="form-group clearfix">
              <div class="icheck-primary d-inline">
                @if(@$FMdata->{'HO Same Address DO'} == '1')
                <input type="checkbox" id="Ho_same_as_op" name="Ho_same_as_op" class="get_channel_office_data" data="HOD" {{$disabled}}  value="1" checked="checked" style="pointer-events:{{$pointer}}">
                @else
                 <input type="checkbox" id="Ho_same_as_op" name="Ho_same_as_op" class="get_channel_office_data" data="HOD" {{$disabled}}  value="1">
                @endif
                <label for="Ho_same_as_op">Same As Operating Office/ संचालन कार्यालय के समान</label>
              </div>
            </div>
          </div>
        </div>
           <div class="row p-3">
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Contact Name/ संपर्क नाम <font color="red">*</font></label>
                <input type="text" class="form-control form-control-sm" name="HO_Contact_name" id="HO_Contact_name" placeholder="Contact Name" onkeypress="return onlyAlphabets(event,this)" {{$disabled}}  value="{{@$FMdata->{'HO Contact Name'} ?? ''}}">
              
             </div>
                     </div>
           
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Address/ पता<font color="red">*</font></label>
                <textarea name="HO_address" id="HO_address" placeholder="Address" rows="2" class="form-control form-control-sm" {{$disabled}} maxlength="120">{{@$FMdata->{'HO Address'} ?? ''}}</textarea>
             </div>
                     </div>
           
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Designation/ पद<font color="red">*</font></label>
                <input type="text" class="form-control form-control-sm" name="HO_Designation" id="HO_Designation" placeholder="Designation" {{$disabled}}  value="{{@$FMdata->{'HO Designation'} ?? ''}}">
             </div>
                     </div>
           
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Landline No./ लैंडलाइन नंबर</label>
                <input type="text" class="form-control form-control-sm" name="HO_Landline_No" id="HO_Landline_No" placeholder="Landline No." maxlength="15" onkeypress="return onlyNumberKey(event)" {{$disabled}}  value="{{@$FMdata->{'HO Landline No_(with STD)'} ?? ''}}">
              </div>
            </div>
           
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">Mobile No./ मोबाइल नंबर<font color="red">*</font></label>
                <input type="text" class="form-control form-control-sm" name="HO_Mobile_No" id="HO_Mobile" placeholder="Mobile No." maxlength="10" onkeypress="return onlyNumberKey(event)" {{$disabled}}  value="{{@$FMdata->{'HO Mobile No_'} ?? ''}}">

             </div>
                     </div>
           
           <div class="col-md-4">
              <div class="form-group">
                <label for="To">E-Mail ID / ई मेल आईडी<font color="red">*</font></label>
                <input type="email" class="form-control form-control-sm" name="HO_Email" id="HO_Email" placeholder="E-Mail ID" {{$disabled}}  value="{{@$FMdata->{'HO E-Mail'} ?? ''}}">
                <span id="first_head_office_mail" class="text-danger"></span>
             </div>
                     </div>
          </div>

            <input type="hidden" name="FMstatio" id="FMstatio" value="{{@$FMdata->{'FM Station ID'} ?? ''}}">
                      @if(@$FMdata->{'Status'} == 1)
                        <input type="hidden" id="next_tab_2"  value="0">
                       @else
                     <input type="hidden" name="next_tab_2" id="next_tab_2"  value="0">
                      @endif
                 <div class="ml-3">
                     <a class="btn btn-primary reg-previous-button ml-1">
                        <i class="fa fa-arrow-circle-left fa-lg"></i>
                      Previous</a> 
                      
                      <a class="btn btn-primary fm-next-button" id="tab_2"> Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                    </div>
                  </div>
                  </div>  

                    <div id="tab3" class="content  pt-3 tab-pane" role="tabpanel" aria-labelledby="logins-part-trigger">
                      <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">Bank account number for receiving payment / भुगतान प्राप्त करने के लिए बैंक खाता संख्या<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" name="Bank_account_number" id="Bank_account_number" placeholder="Enter bank account number" onkeypress="return onlyNumberKey(event)" maxlength="15" {{$disabled}}  value="{{@$FMdata->{'Bank A_c No_'} ?? ''}}">
                        </div>
                      </div>

                      <div class="col-md-4" style="margin-top: 25px;">
                        <div class="form-group">
                          <label for="Name">Account holder name / खाता धारक का नाम<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" name="A_C_Holder_name" id="A_C_Holder_name" placeholder="Enter account holder name" onkeypress="return onlyAlphabets(event,this)" maxlength="40" {{$disabled}}  value="{{@$FMdata->{'A_C Holder Name'} ?? ''}}">
                        </div>
                      </div>
                      <div class="col-md-4" style="margin-top: 25px;">
                        <div class="form-group">
                          <label for="Name">IFSC Code / आईएफएससी कोड<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" name="IFSC_code" id="IFSC_code" placeholder="Enter IFSC code" maxlength="15" onkeypress="isAlphaNumeric(event)" {{$disabled}} 
                          value="{{@$FMdata->{'IFSC Code'} ?? ''}}">
                          <span id="IFSC_code_Error"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">Bank Name / बैंक का नाम<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" name="Bank_name" id="bank_name" placeholder="Enter bank name" maxlength="40"  onkeypress="return onlyAlphabets(event)" {{$disabled}}  value="{{@$FMdata->{'Bank Name'} ?? ''}}">
                          
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">Branch / शाखा<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" name="Branch_name" id="Branch_name" placeholder="Enter branch" maxlength="50" {{$disabled}}  value="{{@$FMdata->{'Bank Branch'} ?? ''}}">

                        </div>
                      </div>

                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Address of account / खाते का पता<font color="red">*</font></label> 
                         <textarea name="Bank_account_address" class="form-control form-control-sm" id="Bank_account_address" placeholder="Enter address of account" maxlength="120" {{$disabled}}>{{@$FMdata->{'Bank A_C Address'} ?? ''}}</textarea>


                        </div>
                      </div>
                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">GST No. / जीएसटी संख्या<font color="red">*</font></label>
                          <input type="text" name="GST_No" id="GST_No" class="form-control form-control-sm" placeholder="Enter GST no." maxlength="15" onkeypress="return isAlphaNumeric(event)" {{$disabled}}  value="{{@$FMdata->{'GST No_'} ?? ''}}">
                           <span id="GST_No_Error"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">PAN card no. / पैन कार्ड नंबर <font color="red">*</font></label>
                         <input type="text" name="PAN_No" id="PAN_No" class="form-control form-control-sm" placeholder="Enter pan card no." maxlength="10"
                         onkeypress="return isAlphaNumeric(event)" {{$disabled}}  value="{{@$FMdata->{'PAN'} ?? ''}}">
                         <span id="PAN_No_Error"></span>
                     
                        </div>
                      </div>
               <fieldset class="fieldset-border">
                <legend>ESI account details / ईएसआई खाता विवरण</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ESI_account_no">Account No. / खाता नंबर</label>
                        <input type="text" name="ESI_account_no" id="ESI_account_no" class="form-control form-control-sm" placeholder="Enter account no." onkeypress="return onlyNumberKey(event)" maxlength="20" {{$disabled}}  value="{{@$FMdata->{'ESI A_C No_'} ?? ''}}">
                      <span id="alert_address_of_account" style="color:red;display: none;"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ESI_no_employees">No. of employees covered / कवर किए गए कर्मचारियों की संख्या</label>
                      <input type="text" name="ESI_employees_covered" id="ESI_employees_covered" class="form-control form-control-sm" placeholder="Enter no. of employees covered" onkeypress="return onlyNumberKey(event)" maxlength="6" {{$disabled}}  value="@if(@$FMdata->{'ESI - No_ Of Employee'} > 0){{@$FMdata->{'ESI - No_ Of Employee'} ?? ''}}@endif">
                      <span id="alert_ESI_no_employees" style="color:red;display: none;"></span>
                    </div>
                  </div>
                </div>
              </fieldset>
              <fieldset class="fieldset-border">
                <legend>EPF account details / ईपीएफ खाता विवरण</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="Name">Account No. / खाता नंबर</label>
                     <input type="text" name="EPF_account_no" id="EPF_account_no" class="form-control form-control-sm" placeholder="Enter account no." onkeypress="return onlyNumberKey(event)" maxlength="20" {{$disabled}}  value="{{@$FMdata->{'EPF A_C No_'} ?? ''}}">
                    </div>
                    <span id="alert_EPF_account_no" style="color:red;display: none;"></span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="Name">No. of employees covered / कवर किए गए कर्मचारियों की संख्या</label>
                      <input type="text" name="EPF_employees_covered" id="EPF_employees_covered" class="form-control form-control-sm" placeholder="Enter no. of employees covered" onkeypress="return onlyNumberKey(event)"  maxlength="6" {{$disabled}}  value="@if(@$FMdata->{'EPF - No_ Of Employee'} > 0){{@$FMdata->{'EPF - No_ Of Employee'} ?? ''}}@endif">
                      <span id="alert_EPF_no_of_employees" style="color:red;display: none;"></span>
                    </div>
                  </div>
                </div>
              </fieldset>
                    
                      </div>
                       <input type="hidden" name="vendorid_tab_3" id="vendorid_tab_3"   value="">

                      @if(@$FMdata->{'Status'} == 1)
                      <input type="hidden"  id="next_tab_3"  value="0">
                       @else
                    <input type="hidden" name="next_tab_3" id="next_tab_3"  value="0">
                      @endif
               
                      <a class="btn btn-primary reg-previous-button"> <i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
                      <!-- <a class="btn btn-primary" onclick="stepper.next()">Next</a> -->
                      <a class="btn btn-primary fm-next-button" id="tab_3">
                      Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                    </div>
                    <div id="tab4" class="content  pt-3 tab-pane" role="tabpanel" aria-labelledby="information-part-trigger">
                   <div class="row">
                     <div class="col-md-12">
                      <div class="form-group">
                        <label for="communication_and_IT1">Copy of valid wireless operating license (WOL) issued by WPC wing of ministry of communication and IT.(संचार और आईटी मंत्रालय के डब्ल्यूपीसी विंग द्वारा जारी वैध वायरलेस ऑपरेटिंग लाइसेंस (डब्ल्यूओएल) की प्रति।)<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="WOL_Certificate_file" id="communication_and_IT" {{$disabled}} >
                            <label class="custom-file-label" id="communication_and_IT2"  for="communication_and_IT">{{@$FMdata->{'WOL File Name'} ?? 'Choose file'}}</label>
                          </div>
                          
                          @if(@$FMdata->{'WOL File Name'} != '')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/FM_radio_station/{{ @$FMdata->{'WOL File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="communication_and_IT3">Upload</span>
                          </div>
                          @endif
                        </div>
                        <span id="communication_and_IT1" class="error invalid-feedback"></span>
                      </div>  
                  </div>
               <div class="col-md-12">
                  <div class="form-group">
                        <label for="information_&_broadcasting1">Copy of grant of permission agreement (GOPA) signed with the Ministry of information & broadcasting(सूचना और प्रसारण मंत्रालय के साथ हस्ताक्षर किए गए अनुमति समझौते (GOPA) के अनुदान की प्रति)<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" 
                            name="GOPA_Certificate_file" id="information_broadcasting" {{$disabled}} >
                            <label class="custom-file-label" id="information_broadcasting2" for="information_broadcasting">{{@$FMdata->{'GOPA File Name'} ?? 'Choose file'}}</label>
                          </div>
                           @if(@$FMdata->{'GOPA File Name'} != '')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/FM_radio_station/{{ @$FMdata->{'GOPA File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="information_broadcasting3">Upload</span>
                          </div>
                          @endif
                        </div>
                        <span id="information_broadcasting1" class="error invalid-feedback"></span>
                      </div>
                   </div>
               <div class="col-md-12">
                  <div class="form-group">
                        <label for="empanelled_with_DAVP1">An undertaking mentioning a Minimum Broadcast Period-The minimum broadcast period of 6 months of commercial broadcast with at least 16 hours broadcast per day i.e. 7 AM to 11 PM shall be the criterion for a private FM Radio Stations to be empanelled with DAVP.(न्यूनतम प्रसारण अवधि का उल्लेख करने वाला एक उपक्रम- छह महीने के वाणिज्यिक प्रसारण की न्यूनतम प्रसारण अवधि, जिसमें प्रतिदिन कम से कम 16 घंटे प्रसारण होता है, यानी सुबह 7 बजे से रात 11 बजे तक, एक निजी एफएम रेडियो स्टेशनों को डीएवीपी के साथ पैनल में शामिल करने के लिए मानदंड होगा।)<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" 
                            name="Undertaking_file" id="empanelled_with_DAVP" {{$disabled}} >
                            <label class="custom-file-label" id="empanelled_with_DAVP2" for="empanelled_with_DAVP">{{@$FMdata->{'Undertaking File Name'} ?? 'Choose file'}}</label>
                          </div>
                           @if(@$FMdata->{'Undertaking File Name'} != '')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/FM_radio_station/{{ @$FMdata->{'Undertaking File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="empanelled_with_DAVP3">Upload</span>
                          </div>
                          @endif
                        </div>
                         <span id="empanelled_with_DAVP1" class="error invalid-feedback"></span>
                      </div>
                   </div>
               <div class="col-md-12">
                  <div class="form-group">
                        <label for="date_of_application1">The programme scheduling for the previous 06 months from 7 AM to 11 PM, during which the FM stations operated. An external hard disk/ CD,station wise/Date wise in mp3 format, minimum 128 kbps (Bit rate) containing the programmes broadcast for the last one month preceding the date of
                        application.(पिछले 06 महीनों के लिए सुबह 7 बजे से रात 11 बजे तक का कार्यक्रम, जिसके दौरान एफएम स्टेशन संचालित होते हैं। एक बाहरी हार्ड डिस्क / सीडी, एमपी 3 प्रारूप में स्टेशनवार / तिथिवार, न्यूनतम 128 केबीपीएस (बिट दर) जिसमें पिछले एक महीने के कार्यक्रम प्रसारित होने की तारीख से पहले के कार्यक्रम होते हैं आवेदन।)<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="Program_Scheduling_Certificate_file" id="date_of_application" name="date_of_application" {{$disabled}} >
                            <label class="custom-file-label" id="date_of_application2" for="date_of_applicatione">{{@$FMdata->{'Program Scheduling File Name'} ?? 'Choose file'}}</label>
                          </div>
                           @if(@$FMdata->{'Program Scheduling File Name'} != '')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/FM_radio_station/{{ @$FMdata->{'Program Scheduling File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="date_of_application3">Upload</span>
                          </div>
                          @endif
                        </div>
                        <span id="date_of_application1" class="error invalid-feedback"></span>
                      </div>
                   </div>
                 <div class="col-md-12">
                     <div class="form-group">
                        <label for="cancelled_cheque1">Upload scan copy Of cancelled cheque(रद्द किए गए चेक की स्कैन कॉपी अपलोड करें)<font color="red">*</8font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="Cancelled_Cheque_file" id="cancelled_cheque" {{$disabled}}>
                            <label class="custom-file-label" id="cancelled_cheque2" for="cancelled_cheque">{{@$FMdata->{'Cancelled Cheque File Name'} ?? 'Choose file'}}</label>
                          </div>
                           @if(@$FMdata->{'Cancelled Cheque File Name'} != '')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/FM_radio_station/{{ @$FMdata->{'Cancelled Cheque File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="cancelled_cheque3">Upload</span>
                          </div>
                          @endif
                        </div>
                         <span id="cancelled_cheque1" class="error invalid-feedback"></span>
                      </div>
                   </div>
                 <div class="col-md-12">
                <div class="form-group">
                        <label for="previous_financial1">Certificate duly signed by the Auditor/Company secretary for the prescribed revenue details, latest profit & loss accounts, balance sheet and actual tax payment including service tax for previous financial year and the amount of advertisement revenue generated by the private FM radio stations during the previous financial year preceding the date of application.(निर्धारित राजस्व विवरण, नवीनतम लाभ और हानि खातों, बैलेंस शीट और पिछले वित्तीय वर्ष के लिए सेवा कर सहित वास्तविक कर भुगतान और पिछले के दौरान निजी एफएम रेडियो स्टेशनों द्वारा उत्पन्न विज्ञापन राजस्व की राशि के लिए लेखा परीक्षक / कंपनी सचिव द्वारा विधिवत हस्ताक्षरित प्रमाण पत्र आवेदन की तारीख से पहले का वित्तीय वर्ष।)<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="Auditor_Certificate_file" id="previous_financial" {{$disabled}}>
                            <label class="custom-file-label" id="previous_financial2" for="previous_financial">{{@$FMdata->{'Auditor File Name'} ?? 'Choose file'}}</label>
                          </div>
                           @if(@$FMdata->{'Auditor File Name'} != '')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/FM_radio_station/{{ @$FMdata->{'Auditor File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="previous_financial3">Upload</span>
                          </div>
                          @endif
                        </div>
                         <span id="previous_financial1" class="error invalid-feedback"></span>
                      </div>
                   </div>
                 <div class="col-md-12">
                  <div class="form-group">
                        <label for="bills_radio_stations1">The private FM radio stations either provide the documentary proof of broadcast certificate (BC) or give an undertaking that they would provide the broadcasting certificate along with physical bills at the time of submission of application.(निजी एफएम रेडियो स्टेशन या तो प्रसारण प्रमाण पत्र (बीसी) का दस्तावेजी प्रमाण प्रदान करेंगे या एक वचन देंगे कि वे आवेदन जमा करने के समय भौतिक बिलों के साथ प्रसारण प्रमाण पत्र प्रदान करेंगे।)<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="Broadcasting_Certificate_file" id="bills_radio_stations" {{$disabled}}>
                            <label class="custom-file-label" id="bills_radio_stations2" for="bills_radio_stations">{{@$FMdata->{'Broadcasting Cert File Name'} ?? 'Choose file'}}</label>
                          </div>
                           @if(@$FMdata->{'Broadcasting Cert File Name'} != '')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/FM_radio_station/{{ @$FMdata->{'Broadcasting Cert File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="bills_radio_stations3">Upload</span>
                          </div>
                          @endif
                        </div>
                        <span id="bills_radio_stations1" class="error invalid-feedback"></span>
                      </div>
            
                   </div>
               <div class="col-md-12">
                  <div class="form-group">
                        <label for="bills_TC1">A letter attested by Senior Management level executive of the FM Radio Station mention name, designation and signature of the authorized signature for bills/TC.(एफएम रेडियो स्टेशन के वरिष्ठ प्रबंधन स्तर के कार्यकारी द्वारा सत्यापित एक पत्र जिसमें बिल/टीसी के लिए अधिकृत हस्ताक्षरकर्ता के नाम, पदनाम और हस्ताक्षर का उल्लेख है।) <font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="Sr_Management_Attestation_file" id="bills_TC" {{$disabled}}>
                            <label class="custom-file-label" id="bills_TC2" for="bills_TC">{{@$FMdata->{'SMA File Name'} ?? 'Choose file'}}</label>
                          </div>
                          @if(@$FMdata->{'SMA File Name'} != '')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/FM_radio_station/{{ @$FMdata->{'SMA File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>

                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="bills_TC3">Upload</span>
                          </div>
                          @endif
                        </div>
                        <span id="bills_TC1" class="error invalid-feedback"></span>
                      </div>
                 </div>
               <div class="col-md-12">
                  <div class="form-group">
                        <label for="signed_list1">A signed list mention the name of station, frequency and state of operation to be provided by the group/holding company/media house to which the applicant FM radio station belongs.(जिस ग्रुप/होल्डिंग कंपनी/मीडिया हाउस से आवेदक एफएम रेडियो स्टेशन संबंधित है, उसे स्टेशन के नाम, फ्रीक्वेंसी और संचालन की स्थिति का उल्लेख करते हुए एक हस्ताक्षरित सूची।)<font color="red">*</font></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="signed_List_file" id="signed_list" {{$disabled}}>
                            <label class="custom-file-label" id="signed_list2" for="signed_list">{{@$FMdata->{'Signed List File Name'} ?? 'Choose file'}}</label>
                          </div>
                           @if(@$FMdata->{'Signed List File Name'} != '')
                          <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/FM_radio_station/{{ @$FMdata->{'Signed List File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="signed_list3">Upload</span>
                          </div>
                          @endif
                        </div>
                        <span id="signed_list1" class="error invalid-feedback"></span>
                      </div>
                   </div>
                 </div>
                <div class="row">
                   <div class="col-md-12">
                    <!-- checkbox -->
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
            
                        <input type="checkbox" id="davp_panel" name="Acceptance" value="1"  {{$checked}} {{$disabled}}> 

                        <label for="davp_panel">Acceptance of the policy.An undertaking of the acceptance of the policy guideline by Pvt FM Station./पॉलिसी की स्वीकृति। प्राइवेट एफएम स्टेशन द्वारा पॉलिसी गाइडलाइन की स्वीकृति का एक उपक्रम|<font color="red">*</font></label>
                      </div>
                    </div>
                   </div>
                 </div>
         
               <div class="row" style="margin-bottom: 35px;}">
                   <div class="col-md-12">
                    <!-- checkbox -->
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="davp_panel1" name="davp_panel1" value="1" {{$checked}} {{$disabled}} style="pointer-events:none;">
                        <label for="davp_panel1">I affirm that all the information given by me is true and no relevant information has been concealed. I hereby apply for the empanelment of the above mentioned Pvt. FM station with DAVP./
                        मैं पुष्टि करता हूं कि मेरे द्वारा दी गई सभी जानकारी सत्य है और कोई भी प्रासंगिक जानकारी छुपाई नहीं गई है। मैं एतद्द्वारा उपर्युक्त प्राइवेट लिमिटेड के पैनल में शामिल होने के लिए आवेदन करता हूं। डीएवीपी के साथ एफएम स्टेशन।<font color="red">*</font>
                      </label>
                     </div>
                    </div>
                   </div>
                 </div>
                 <input type="hidden" name="doc[]" id="doc_data">
                <input type="hidden" name="submit_btn" id="submit_btn" value="0" >
                 <a class="btn btn-primary reg-previous-button"> <i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
                @if(@$FMdata->{'Modification'} == 1)
                  <a  class="btn btn-primary fm-next-button" style="pointer-events:none;">Submit <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                @else
                 <a class="btn btn-primary fm-next-button" id="tab_4">
                 Submit <i class="fa fa-arrow-circle-right fa-lg"></i></a>
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
<script src="{{ url('/js')}}/fm-stationl.js"></script>
<script src="{{ url('/js') }}/avtv_comman.js"></script>
<script>
  $(document).ready(function() {
    $('#state_id').on('change', function() {
      var idState = $(this).val();
      // alert(idState);
      $.ajax({
        url: "{{url('FmfetchDistricts')}}",
        type: "get",
        data: {state_code: idState},
        success: function(data) {
          console.log(data);
         $('#district_id').html(data);
        }
      });
    });

  });
 function nextSaveData(id) {
  var FormDisable ='<?php echo $disabled; ?>';
  if(FormDisable == 'disabled'){
    return false;
  }
  console.log(id);
  ///console.log($("#" + id).val());
  if ($("#" + id).val() == 0) {
    $("#" + id).val(1);
  } else {
    $("#" + id).val(1);
  }
  var data = new FormData($("#fm_station")[0]);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
    }
   });
  $.ajax({
    type: "post",
    url: "{{Route('fmStation')}}",
    data: data,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function(data) {
     console.log(data);
      if (data['success'] == true) {
        if (id == 'next_tab_1') {
         $("#ownerid").val(data.data);
        
         }
        if(id=='next_tab_2'){
          $("#FMstatio").val(data.data);

        }
        if(id=='next_tab_3'){
           $("#vendorid_tab_3").val(data.data);
           $("#vendorid_tab_4").val(data.data);
        }
         if(id=='submit_btn'){
          $("#communication_and_IT").focus();
          $("#Final_submi").show();
          $("#Final_submi").text(data.message);
          setTimeout(function(){ 
            window.location.href ='fm-radio-station';
           },5000);
          console.log(data.message);
        }
      }
    },
    error: function(error) {
      console.log('error');
    }
  });
}
</script>
@endsection