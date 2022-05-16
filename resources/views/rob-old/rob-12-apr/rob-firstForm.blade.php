@extends('admin.layouts.layout')
<style>
  body{
    color: #6c757d !important;
    p,
    label {
      font: 1rem 'Fira Sans', sans-serif;
    }

    input {
      margin: .4rem;
    }
  }
  .multiselect-search{
    width:100% !important;
    margin-right: 10px;
  }
  .dropdown-menu.show {
    display: block;
    width: 100% !important;
  }
  .multiselect-clear-filter{
    display: none !important;
  }
  .hide-msg {
    display: none !important;
  }

  .fa-check {
    color: green;
  }
  a.disabled {
    pointer-events: none;
  }
  .ui-datepicker-trigger{
    width: 25;
    height: 25;
    float: right;
    margin-top: -28px;
    margin-right: 4px;
  }
  .borderless table {
    border-top-style: none;
    border-left-style: none;
    border-right-style: none;
    border-bottom-style: none;
}


</style>
@section('content')
<!-- !empty(@$data->document_type) -->
<!-- if(trim(@$data->document_type) !='') -->
<!-- if(@$rob_documents[0]->event_date!='') -->
@php


if(@$data->status=='1')
{
  $block='readonly';
  $non='none';
  $tab='-1';
}
else
{
  $block='';
  $non='';
  $tab='';
}
@endphp
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> Application for ROB/FOB for submission of details related to their activity and programs.</h6> 

    </div>
    <!-- Card Body -->
    <div class="row">
        <div class="col-xl-12">
          <h6 class="alert alert-success" style="width: 100%;display: none; text-align: center;" id="msg"></h6>
        </div>
      </div>
    <div class="card-body">
      
     <div  style ="display: none;"align="center" class="alert alert-success"></div>
     <div style ="display: none;" align="center" class="alert alert-danger"></div>
     <form method="POST" class="client_request"  id="rob_request" enctype="multipart/form-data" >
      @csrf

      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item active show" data-target="#logins-part">
          <a class="nav-link " aria-controls="logins-part" id="logins-part-trigger">Activity / Program</a>
        </li>
        <li class="nav-item" data-target="#logins-part1">
          <a class="nav-link " aria-controls="logins-part1" id="logins-part1-trigger">Network Details</a>
        </li> 
        <li class="nav-item" data-target="#logins-part2">
          <a class="nav-link " aria-controls="logins-part2" id="logins-part2-trigger">Account Details</a>
        </li> 
        <li class="nav-item" data-target="#logins-part3">
          <a class="nav-link " aria-controls="logins-part3" id="logins-part3-trigger">Photo/Videos upload</a>
        </li> 
      </ul>

      <div class="tab-content">
        <div id="logins-part" class="tab-pane active show">
          <div id="logins-part" class="content pt-3" role="tabpanel" aria-labelledby="logins-part-trigger">
            @if(Session::get('UserType')=='2')
            <input type="hidden" name="rob_name" value="{{Session::get('UserName')}}">
            @else
            <input type="hidden" name="rob_name" value="{{Session::get('rob_name')}}">
            @endif
            <div class="row">
              <div class="col-xl-4">
                <div class="form-group">
                  <label for="">Category Of Programme Activity :<span style="color: red;">*</span></label>
                  <select name="programme_activity" id="ddl_pro_activity" tabindex="{{$tab}}" style="pointer-events:{{$non}};" class="form-control form-control-sm" {{$block}}>
                    <option value="">--Select--</option>
                    <option value="1" {{@$data->programme_activity=='1' ? 'selected': ''}}>Programme Activites(under ICOP) under DCID fund of M/O I&amp; B</option>
                    <option value="6" {{@$data->programme_activity=='6' ? 'selected': ''}}>Programme Activites(other than ICOP) under DCID fund of M/O I&amp; B</option>
                    <option value="2" {{@$data->programme_activity=='2' ? 'selected': ''}}>Programme Activites on SAP under DCID fund of M/O I&amp; B</option>
                    <option value="3" {{@$data->programme_activity=='3' ? 'selected': ''}}>Programme Activites under Establishment fund</option>
                    <option value="4" {{@$data->programme_activity=='4' ? 'selected': ''}}>Programme Activites (ICOP) for other Ministries</option>
                    <option value="5" {{@$data->programme_activity=='5' ? 'selected': ''}}>Programme Activites (Other than ICOP) for other Ministries</option>
                  </select>
                </div>
                <span id="ddl_pro_activity_err_" style="color: red;"></span>
              </div>
              @php
              if(@$data->programme_activity=='1' || @$data->programme_activity=='2' || @$data->programme_activity=='3' || @$data->programme_activity=='4')
              {
                $icop_disp='';
              }
              else
              {
                $icop_disp='none';
              }
              @endphp
              <div class="col-xl-4" id="icop" style="display: {{$icop_disp}}">
                <div class="form-group">
                  <label for="">Category under ICOP :</label>
                  <select name="category_icop" id="ddl_categ_icop" tabindex="{{$tab}}" style="pointer-events:{{$non}};" class="form-control form-control-sm" {{$block}}>
                    <option value="">--Select--</option>
                    <option id="mi" value="MI" {{@$data->category_icop=='MI' ? 'selected': ''}}>MINI</option>
                    <option id="sm" value="SM" {{@$data->category_icop=='SM' ? 'selected': ''}}>SMALL</option>
                    <option id="me" value="ME" {{@$data->category_icop=='ME' ? 'selected': ''}}>MEDIUM</option>
                    <option id="bi" value="BI" {{@$data->category_icop=='BI' ? 'selected': ''}}>BIG </option>
                    <option id="ot" value="OT" {{@$data->category_icop=='OT' ? 'selected': ''}}>OTHER </option>
                  </select>
                </div>
            </div>
            @php
            if(@$data->activity_checkbox1!='')
            {
              $check=explode(",",$data->activity_checkbox1);
            }
            @endphp
              <div class="col-xl-4">
                <div class="form-group">
                  <label for="">Type Of Activity : <span style="color: red;">*</span></label><br>
                  <!-- <input id="CheckBoxList1_0" value="1" type="checkbox" name="activity_checkbox1" {{@$data->activity_checkbox1=='1' ? 'checked': ''}} {{$block}}/> FIELD COMMUNICATION<br>
                  <input id="CheckBoxList1_1" value="1" type="checkbox" name="activity_checkbox2" {{@$data->activity_checkbox2=='1' ? 'checked': ''}} {{$block}}/> FOLK COMMUNICATION <br>
                  <input id="CheckBoxList1_2" value="1" type="checkbox" name="activity_checkbox3" {{@$data->activity_checkbox3=='1' ? 'checked': ''}} {{$block}}/> EXHIBITION<br> -->
                  <input id="CheckBoxList1_0" value="FIELD" type="checkbox" name="activity_checkbox1[]" {{@in_array('FIELD',$check) ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> FIELD COMMUNICATION<br>
                  <input id="CheckBoxList1_1" value="FOLK" type="checkbox" name="activity_checkbox1[]" {{@in_array('FOLK',$check) ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> FOLK COMMUNICATION <br>
                  <input id="CheckBoxList1_2" value="EXHIBITION" type="checkbox" name="activity_checkbox1[]" {{@in_array('EXHIBITION',$check) ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> EXHIBITION<br>
                </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Theme of Activity/Programme : <span style="color: red;">*</span></label>
                <input name="sop_theme" type="text" tabindex="-1" value="{{@$data->sop_theme ?? ''}}" id="txt_sop_theme" onkeypress="return alphaOnly(event);" class="form-control form-control-sm" placeholder="Theme of Activity/Programme" onMaxLength="100" {{$block}}/>
                <span id="txt_sop_theme_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Office Type : <span style="color: red;">*</span></label>
                <select name="office_type" id="ddl_off_type" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}>
                  <option value="">--Select--</option>
                  <option id="ot1" value="HQ" {{@$data->office_type == "HQ"  ? 'selected' : ''}}>ROB {{@$offTyp->rob_hq}} Headquarter</option>
                  <option id="ot2" value="FO" {{@$data->office_type == "FO"  ? 'selected' : ''}}>{{@$offTyp->rob_hq}} FOB</option>
                  
                  <!-- <option>{{@$offTyp->rob_hq}}</option> -->
                  
                </select>
                <span id="ddl_off_type_err_" style="color: red;"></span>
              </div>
            </div>

            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Region : <span style="color: red;">*</span></label>
                <select name="region_id" id="ddl_rob_region" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}>
                  <option value="">---Select----</option>
                  @if(@$data->office_type=='HQ')
                    @if (@$data->region_id!='') 
                      @foreach($offRegion as $reg)
                        @if(@trim($reg->rob_hq)!='')
                          <option value="{{$reg->rob_hq}}" {{@$reg->rob_hq==$data->region_id ? 'selected' : ''}}>{{$reg->rob_hq}}</option>
                        @endif
                      @endforeach  
                    @endif
                  @endif

                  @if(@$data->office_type=='FO')
                    @if (@$data->region_id!='') 
                      @foreach($offRegion as $reg)
                      <option value="{{$reg->rob_fo}}" {{@$reg->rob_fo==$data->region_id ? 'selected' : ''}}>{{$reg->rob_fo}}</option>                  
                      @endforeach  
                    @endif
                  @endif


                </select>
                <span id="ddl_rob_region_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Demography : <span style="color: red;">*</span></label>
                <select name="demography" id="ddl_area_nature" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}>
                  <option value="">--Select--</option>
                  <option id="demography1" value="U" {{@$data->demography=='U' ? 'selected' : ''}}>URBAN</option>
                  <option id="demography2" value="R" {{@$data->demography=='R' ? 'selected' : ''}}>RURAL</option>
                  <option id="demography3" value="M" {{@$data->demography=='M' ? 'selected' : ''}}>Minority</option>
                  <option id="demography3" value="L" {{@$data->demography=='L' ? 'selected' : ''}}>LW Area </option>
                </select>
                <span id="ddl_area_nature_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Area of Activites : <span style="color: red;">*</span></label>
                <select name="activity_area" id="ddl_area_act" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}>
                  <option value="">--Select--</option>
                  <option id="area1" value="V" {{@$data->activity_area=='V' ? 'selected' : ''}}>Village level</option>
                  <option id="area2" value="B" {{@$data->activity_area=='B' ? 'selected' : ''}}>Block level</option>
                  <option id="area3" value="D" {{@$data->activity_area=='D' ? 'selected' : ''}}>District level</option>
                  <option id="area4" value="C" {{@$data->activity_area=='C' ? 'selected' : ''}}>City level</option>
                </select>
                <span id="ddl_area_act_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Coverage (Village/Town Covered) : <span style="color: red;">*</span></label>
                <input name="coverage" {{$block}} type="text" value="{{@$data->coverage ?? ''}}" onkeypress="return onlyNumberKey(event)" maxlength="10" id="txt_no_covered" placeholder="No. of Village/Towns Covered" class="numeric form-control form-control-sm"/>
                <span id="txt_no_covered_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Name of Village/Town covered :<span style="color: red;">*</span></label>
                <input type="text" name="village_name" value="{{@$data->village_name ?? ''}}" id="txt_vilage_name" onkeypress="return alphaOnly(event);" placeholder="Name of Village/Town covered" class="form-control form-control-sm" {{$block}}>
                <!-- <textarea name="village_name" rows="2" cols="20" id="txt_vilage_name" onkeypress="return alphaOnly(event);" placeholder="Name of Village/Town covered" class="form-control form-control-sm"></textarea> -->
                <span id="txt_vilage_name_err_" style="color: red;"></span>
              </div>
            </div>

            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Name Of VIP :<span style="color: red;"></span></label>
                <input type="text" name="vip_name" value="{{@$data->vip_name ?? ''}}" id="vip_name" onkeypress="return alphaOnly(event);" placeholder="Name of VIP" class="form-control form-control-sm" {{$block}}>
                <span id="vip_name_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">Designation Of VIP :<span style="color: red;"></span></label>
                <input type="text" name="vip_designation" value="{{@$data->vip_designation ?? ''}}" id="vip_designation" onkeypress="return alphaOnly(event);" placeholder="VIP Designation" class="form-control form-control-sm" {{$block}}>
                <span id="vip_designation_err_" style="color: red;"></span>
              </div>
            </div>
            <!-- <div class="col-xl-4">
              <div class="form-group">
                <label for="">Funds Allocated :</label>
                <input name="allocated_funds" type="text" maxlength="10" id="txt_fund_sanc" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" onpaste="false" placeholder="Funds Allocated" />
                <span id="txt_fund_sanc_err" style="color:Red;"></span>
              </div>
            </div> -->
            <!-- <div class="col-xl-4">
              <div class="form-group">
                <label for="">Name Of The Officer:</label>
                <input name="officer_name" type="text" onkeypress="return alphaOnly(event);" maxlength="80" id="txt_officer_name" class="form-control form-control-sm" onpaste="false" placeholder="Officer Name" />
                <span id="txt_officer_name_err" style="color:Red;"></span>
              </div>
            </div> -->
            <!-- <div class="col-xl-4">
              <div class="form-group">
                <label for="">Designation Of The Officer:</label>
                <input name="officer_designation" type="text" onkeypress="return alphaOnly(event);" maxlength="40" id="txt_off_desig" onpaste="false" placeholder="Officer Designation" class="form-control form-control-sm" />
                <span id="txt_off_desig_err" style="color:Red;"></span>
              </div>
            </div> -->
            <!-- <div class="col-xl-4">
              <div class="form-group">
                <label for="">Location : </label>
                <input name="office_location" type="text" maxlength="40" id="txt_off_loc" onkeypress="return alphaOnly(event);" onpaste="false" placeholder="Location" class="form-control form-control-sm" />
                <span id="txt_off_loc_err" style="color:Red;"></span>
              </div>
            </div> -->
            <!-- <div class="col-xl-4">
              <div class="form-group">
                <label for="">On-Account Advance:</label>
                <input name="advance_account" type="text" maxlength="10" id="txt_adv_amt" onkeypress="return onlyNumberKey(event)" onpaste="false" placeholder="Advance amount drawn" class="form-control form-control-sm"/>
                <span id="txt_adv_amt_err" style="color:Red;"></span>
              </div>
            </div> -->
            <!-- <div class="col-xl-4">
              <div class="form-group">
                <label for="">Settlement of On-Account Advance:</label>
                <input name="sattlement_account_advance"  type="text" maxlength="10" id="txt_adv_pao" onkeypress="return onlyNumberKey(event)" onpaste="false" placeholder="Settlement of On-Account Advance" class="form-control form-control-sm"/>
                <span id="txt_adv_pao_err" style="color:Red;"></span>
              </div>
            </div> -->
            <!-- <div class="col-xl-4">
              <div class="form-group">
                <label for="">Direct Settlement Of Bill Through PAO :</label>
                <input name="direct_settlement_bill_pao" type="text" maxlength="10" onkeypress="return onlyNumberKey(event)" id="txt_direct_pao" onpaste="false" placeholder="Direct Settlement Amount Settled By PAO" class="form-control form-control-sm" />
                <span id="txt_direct_pao_err" style="color:Red;"></span>
              </div>
            </div> -->
            <div class="col-xl-12">
              <h4>Duration For Activity/Programme organised</h4>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <div class="form-group">
                  <label for="">From : <span style="color: red;">*</span></label>
                  <input name="duration_activity_from_date" value="{{@$data->duration_activity_from_date ?? ''}}" type="date" maxlength="10" id="txt_from" class="calendar1 form-control form-control-sm" {{$block}}/>
                  <span id="txt_from_err_" style="color: red;"></span>
                </div>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">To :<span style="color: red;">*</span></label>
                <input name="duration_activity_to_date" type="date" value="{{@$data->duration_activity_to_date ?? ''}}" maxlength="10" id="txt_to" class="calendar1 form-control form-control-sm" {{$block}}/>
                <span id="txt_to_err_" style="color: red;"></span>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="">No.Of Days:</label>
                <input name="no_of_days" type="text" value="{{@$data->no_of_days ?? ''}}" maxlength="10" id="txt_tot_prog_day" readonly class="numeric form-control form-control-sm" />
              </div>
            </div>
            <div class="row text-center">
              <div class="col-xl-12">
                <h4>Pre Event Activities</h4>
              </div>
            </div>
            </div><!-- row close-->
            @php 
            if(@$data->category_icop=='MI')
            {
              $single_disp='';
            }
            else
            {
              $single_disp='none';
            }
            @endphp
            <!--  for single start-->
            <div class="row" style="align-content: center;display: {{$single_disp}};" id="engagement" id="single">
              <div class="col-xl-10">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width:10%;">Sr : </th>
                      <th style="width:40%;">ACTIVITY</th>
                      <th>REMARKS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      @php
                      if(@$data->engagement_pre_event_activity=='1')
                      {
                        $engagement_pre='';
                      }
                      else
                      {
                        $engagement_pre='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl02_ch_pre_event_activity_single" value="1" type="checkbox" name="engagement_pre_event_activity" {{@$data->engagement_pre_event_activity=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl02_lbl_pre_event_activity_single">ENGAGEMENT</span>
                      </td>
                      <td valign="middle" id="single">
                        <textarea maxlength="120" name="engagement_txt_pre_event" rows="2" cols="20" id="GridView1_ctl02_txt_prev_single" style="height:50px;width:450px;resize: none; display:{{$engagement_pre}};" class="form-control" {{$block}}>{{@$data->engagement_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!--  for single end-->
            @php
            if(@$data->category_icop=='SM')
            {
              $five_disp='';
            }
            else
            {
              $five_disp='none';
            }
            @endphp
            <!-- for 5tab start  -->
            <div class="row" style="align-content: center; display:{{$five_disp}};" id="five1" id="fivemain">
              <div class="col-xl-10">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width:10%;">Sr</th>
                      <th style="width:40%;">ACTIVITY</th>
                      <th>REMARKS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      @php
                      if(@$data->nukkad_natak_pre_event_activity=='1')
                      {
                        $nukkad_natak_pre='';
                      }
                      else
                      {
                        $nukkad_natak_pre='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl02_ch_pre_event_activity1" value="1" type="checkbox" name="nukkad_natak_pre_event_activity" {{@$data->nukkad_natak_pre_event_activity=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl02_lbl_pre_event_activity1">NUKKAD NATAK</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="120" name="nukkad_natak_txt_pre_event" rows="2" cols="20" id="GridView1_ctl02_txt_prev1" style="height:50px;display:{{$nukkad_natak_pre}};" class="form-control" {{$block}}>{{@$data->nukkad_natak_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      @php
                      if(@$data->public_meeting_pre_event_activity=='1')
                      {
                        $public_meeting_pre_event='';
                      }
                      else
                      {
                        $public_meeting_pre_event='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl03_ch_pre_event_activity1" value="1" type="checkbox" name="public_meeting_pre_event_activity" {{@$data->public_meeting_pre_event_activity=='1' ? 'checked' : ''}}
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl03_lbl_pre_event_activity1">PUBLIC MEETING</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="120" name="public_meeting_txt_pre_event" rows="2" cols="20" id="GridView1_ctl03_txt_prev1" style="height:50px;display:{{$public_meeting_pre_event}};" class="form-control" {{$block}}>{{@$data->public_meeting_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      @php
                      if(@$data->public_announcement_pre_event_activity=='1')
                      {
                        $public_announcement_pre='';
                      }
                      else
                      {
                        $public_announcement_pre='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl04_ch_pre_event_activity1" value="1" type="checkbox" name="public_announcement_pre_event_activity" {{@$data->public_announcement_pre_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl04_lbl_pre_event_activity1">PUBLIC ANNOUNCEMENTS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="120" name="public_announcement_txt_pre_event" rows="2" cols="20" id="GridView1_ctl04_txt_prev1" style="height:50px;display:{{$public_announcement_pre}};" class="form-control" {{$block}}>{{@$data->public_announcement_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      @php
                      if(@$data->distribution_pamphlets_pre_event_activity=='1')
                      {
                        $distribution_pamphlets='';
                      }
                      else
                      {
                        $distribution_pamphlets='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl05_ch_pre_event_activity1" value="1" type="checkbox" name="distribution_pamphlets_pre_event_activity" {{@$data->distribution_pamphlets_pre_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl05_lbl_pre_event_activity1">DISTRIBUTION OF PAMPHLETS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="120" name="distribution_pamphlets_txt_pre_event" rows="2" cols="20" id="GridView1_ctl05_txt_prev1" style="height:50px;display:{{$distribution_pamphlets}};" class="form-control" {{$block}}>{{@$data->distribution_pamphlets_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>5</td>
                      @php
                      if(@$data->social_media_pre_event_activity=='1')
                      {
                        $social_media_pre='';
                      }
                      else
                      {
                        $social_media_pre='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl06_ch_pre_event_activity1" value="1" type="checkbox" name="social_media_pre_event_activity" {{@$data->social_media_pre_event_activity=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl06_lbl_pre_event_activity1">SOCIAL MEDIA CAMPAIGN</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="120" name="social_media_txt_pre_event" rows="2" cols="20" id="GridView1_ctl06_txt_prev1" style="height:50px;display:{{$social_media_pre}};" class="form-control" {{$block}}>{{@$data->social_media_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- for 5tab end  -->
            @php
            if(@$data->programme_activity=='6' || @$data->programme_activity=='5' || @$data->category_icop=='ME' || @$data->category_icop=='BI' || @$data->category_icop=='OT')
            {
              $nine_disp='';
            }
            else
            {
              $nine_disp='none';
            }
            @endphp
            
            <!-- 9 tab start-->
            <div class="row" style="align-content: center;display:{{$nine_disp}};" id="nine">
              <div class="col-xl-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10%;">Sr</th>
                      <th style="width: 30%;">ACTIVITY</th>
                      <th>REMARKS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>
                        <input id="GridView1_ctl02_ch_pre_event_activity9" value="1" type="checkbox" name="nukkad_natak1_pre_event_activity" {{@$data->nukkad_natak1_pre_event_activity=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl02_lbl_pre_event_activity">NUKKAD NATAK</span>
                      </td>
                      @php
                      if(@$data->nukkad_natak1_pre_event_activity=='1')
                      {
                        $nukkad_natak1='';
                      }
                      else
                      {
                        $nukkad_natak1='none';
                      }
                      @endphp
                      <td valign="middle">
                        <textarea maxlength="120" name="nukkad_natak1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl02_txt_prev9" style="height:50px;display:{{$nukkad_natak1}};" class="form-control" {{$block}}>{{@$data->nukkad_natak1_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      @php
                      if(@$data->public_meeting1_pre_event_activity=='1')
                      {
                        $public_meeting1='';
                      }
                      else
                      {
                        $public_meeting1='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl03_ch_pre_event_activity9" value="1" type="checkbox" name="public_meeting1_pre_event_activity" {{@$data->public_meeting1_pre_event_activity=='1' ? 'checked' : ''}}
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl03_lbl_pre_event_activity">PUBLIC MEETING</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="120" name="public_meeting1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl03_txt_prev9" style="height:50px;display:{{$public_meeting1}};" class="form-control" {{$block}}>{{@$data->public_meeting1_txt_pre_event ?? ''}}
                        </textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      @php
                      if(@$data->public_announcement1_pre_event_activity=='1')
                      {
                        $public_announcement1='';
                      }
                      else
                      {
                        $public_announcement1='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl04_ch_pre_event_activity9" value="1" type="checkbox" name="public_announcement1_pre_event_activity" {{@$data->public_announcement1_pre_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl04_lbl_pre_event_activity">PUBLIC ANNOUNCEMENTS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="120" name="public_announcement1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl04_txt_prev9" style="height:50px;display:{{$public_announcement1}};" class="form-control" {{$block}}>{{@$data->public_announcement1_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      @php
                      if(@$data->distribution_pamphlets1_pre_event_activity=='1')
                      {
                        $distribution_pamphlets1='';
                      }
                      else
                      {
                        $distribution_pamphlets1='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl05_ch_pre_event_activity9" value="1" type="checkbox" name="distribution_pamphlets1_pre_event_activity" {{@$data->distribution_pamphlets1_pre_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl05_lbl_pre_event_activity">DISTRIBUTION OF PAMPHLETS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="120" name="distribution_pamphlets1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl05_txt_prev9" style="height:50px;display:{{$distribution_pamphlets1}};" class="form-control" {{$block}}>{{@$data->distribution_pamphlets1_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>5</td>
                      @php
                      if(@$data->social_media_campaign1_pre_event=='1')
                      {
                        $social_media1='';
                      }
                      else
                      {
                        $social_media1='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl06_ch_pre_event_activity9" value="1" type="checkbox" name="social_media_campaign1_pre_event" {{@$data->social_media_campaign1_pre_event=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl06_lbl_pre_event_activity">SOCIAL MEDIA CAMPAIGN</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="120" name="social_media_campaign1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl06_txt_prev9" style="height:50px;display:{{$social_media1}};" class="form-control" {{$block}}>{{@$data->social_media_campaign1_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>6</td>
                      @php
                      if(@$data->public_rally_pre_event_activity=='1')
                      {
                        $public_rally='';
                      }
                      else
                      {
                        $public_rally='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl07_ch_pre_event_activity9" value="1" type="checkbox" name="public_rally_pre_event_activity" {{@$data->public_rally_pre_event_activity=='1' ? 'checked' : ''}}
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl07_lbl_pre_event_activity">PUBLIC RALLY IN NEARBY VILLAGE/TOWNS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="120" name="public_rally_txt_pre_event" rows="2" cols="20" id="GridView1_ctl07_txt_prev9" style="height:50px;display:{{$public_rally}};" class="form-control" {{$block}}>{{@$data->public_rally_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>7</td>
                      @php
                      if(@$data->media_briefing_pre_event_activity=='1')
                      {
                        $media_briefing='';
                      }
                      else
                      {
                        $media_briefing='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl08_ch_pre_event_activity9" value="1" type="checkbox" name="media_briefing_pre_event_activity" {{@$data->media_briefing_pre_event_activity=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl08_lbl_pre_event_activity">MEDIA BRIEFING</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="120" name="media_briefing_txt_pre_event" rows="2" cols="20" id="GridView1_ctl08_txt_prev9" style="height:50px;display:{{$media_briefing}};" class="form-control" {{$block}}>{{@$data->media_briefing_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>8</td>
                      @php
                      if(@$data->dd_air_curtain_pre_activity=='1')
                      {
                        $dd_air_curtain='';
                      }
                      else
                      {
                        $dd_air_curtain='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl09_ch_pre_event_activity9" value="1" type="checkbox" name="dd_air_curtain_pre_activity" {{@$data->dd_air_curtain_pre_activity=='1' ? 'checked' : ''}} 
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl09_lbl_pre_event_activity">DD/AIR SCROLL/CURTAIN RAISERS</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="120" name="dd_air_curtain_txt_pre_activity" rows="2" cols="20" id="GridView1_ctl09_txt_prev9" style="height:50px;display:{{$dd_air_curtain}};" class="form-control" {{$block}}>{{@$data->dd_air_curtain_txt_pre_activity ?? ''}}</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td>9</td>
                      @php
                      if(@$data->social_media_campaign_pre_event=='1')
                      {
                        $social_media_campaign='';
                      }
                      else
                      {
                        $social_media_campaign='none';
                      }
                      @endphp
                      <td>
                        <input id="GridView1_ctl10_ch_pre_event_activity9" value="1" type="checkbox" name="social_media_campaign_pre_event" {{@$data->social_media_campaign_pre_event=='1' ? 'checked' : ''}}
                        tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                        <span id="GridView1_ctl10_lbl_pre_event_activity">SOCIAL MEDIA CAMPAIGN</span>
                      </td>
                      <td valign="middle">
                        <textarea maxlength="120" name="social_media_campaign_txt_pre_event" rows="2" cols="20" id="GridView1_ctl10_txt_prev9" style="height:50px;display:{{$social_media_campaign}};" class="form-control" {{$block}}>{{@$data->social_media_campaign_txt_pre_event ?? ''}}</textarea>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- 9 tab end-->
            @php
            if(@$data->programme_activity=='3' || @$data->programme_activity=='4' || @$data->programme_activity=='5' || @$data->programme_activity=='6' || @$data->category_icop=='MI' || @$data->category_icop=='SM' || @$data->category_icop=='ME' || @$data->category_icop=='BI' || @$data->category_icop=='OT')
            {
              $fix_display='';
            }
            else
            {
              $fix_display='none';
            }
            @endphp
            <!-- fixed start-->
            <div id="fixed" style="display: {{$fix_display}};">
              <div class="row">
                <div class="col-xl-12 text-left"><h4>Post Event Activity</h4></div>
              </div>
              <div class="row">
                <div class="col-xl-12">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 5%;">Sr</th>
                        <th style="width: 8%;">COMPONENT</th>
                        <th style="width: 30%;">Activity/Details</th>
                        <th style="width: 10%;">No of Programme</th>
                        <th >REMARKS</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>
                          <span id="GridView2_ctl02_lbl_main_event_activity">MOBILISATION</span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl02_ch_main_event_activity" value="1" type="checkbox" name="mobile_station_main_event_activity" {{@$data->mobile_station_main_event_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl02_lbl_main_event_desc">SPORTS COMPETITION/YOGA SESSION/SELF DEFENCE CAMPS</span>
                        </td>
                        @php
                        if(@$data->mobile_station_main_event_activity=='1')
                        {
                          $mobile_station='';
                        }
                        else
                        {
                          $mobile_station='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="mobile_station_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl02_txt_main_no_program" {{$mobile_station}} value="{{@$data->mobile_station_main_no_program ?? ''}}" class="numeric form-control" style="height:50px;" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="mobile_station_main_remark" rows="2" cols="20" id="GridView2_ctl02_txt_main_remarl" {{$mobile_station}} style="height:50px;" class="form-control" {{$block}}>{{@$data->mobile_station_main_remark ?? ''}}</textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>
                          <span id="GridView2_ctl03_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl03_ch_main_event_activity" value="1" type="checkbox" name="painting_poetry_rangoli_main_activity" {{@$data->painting_poetry_rangoli_main_activity=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl03_lbl_main_event_desc">PAINTING/POETRY/RANGOLI COMPETITION</span>
                        </td>
                        @php
                        if(@$data->painting_poetry_rangoli_main_activity=='1')
                        {
                          $painting_poetry='';
                        }
                        else
                        {
                          $painting_poetry='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="painting_poetry_rangoli_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl03_txt_main_no_program" {{$painting_poetry}} value="{{@$data->painting_poetry_rangoli_main_no_program ?? ''}}" class="numeric form-control" style="height:50px;" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="painting_poetry_rangoli_main_remark" rows="2" cols="20" id="GridView2_ctl03_txt_main_remarl" {{$painting_poetry}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->painting_poetry_rangoli_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>
                          <span id="GridView2_ctl04_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl04_ch_main_event_activity" value="1" type="checkbox" name="debate_seminar_symposium_main_event" {{@$data->debate_seminar_symposium_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl04_lbl_main_event_desc">DEBATE/SEMINAR/SYMPOSIUM</span>
                        </td>
                        @php
                        if(@$data->debate_seminar_symposium_main_event=='1')
                        {
                          $debate_seminar='';
                        }
                        else
                        {
                          $debate_seminar='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="debate_seminar_symposium_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl04_txt_main_no_program"  {{$debate_seminar}} value="{{@$data->debate_seminar_symposium_main_no_program ?? ''}}" class="numeric form-control" style="height:50px;" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="debate_seminar_symposium_main_remark" rows="2" cols="20" id="GridView2_ctl04_txt_main_remarl" {{$debate_seminar}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->debate_seminar_symposium_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>
                          <span id="GridView2_ctl05_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl05_ch_main_event_activity" value="1" type="checkbox" name="testimonials_main_event" {{@$data->testimonials_main_event=='1' ? 'checked' : ''}} 
                          tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl05_lbl_main_event_desc">TESTIMONIALS</span>
                        </td>
                        @php
                        if(@$data->testimonials_main_event=='1')
                        {
                          $testimonials_main='';
                        }
                        else
                        {
                          $testimonials_main='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="testimonials_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl05_txt_main_no_program" {{$testimonials_main}} value="{{@$data->testimonials_main_no_program ?? ''}}" class="numeric form-control" style="height:50px;" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="testimonials_main_remark" rows="2" cols="20" id="GridView2_ctl05_txt_main_remarl"  style="height:50px;" {{$testimonials_main}} class="form-control" {{$block}}>
                            {{@$data->testimonials_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>
                          <span id="GridView2_ctl06_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl06_ch_main_event_activity" value="1" type="checkbox" name="felicitiation_main_event" {{@$data->felicitiation_main_event=='1' ? 'checked' : ''}}
                          tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl06_lbl_main_event_desc">FELICITIATION OF LOCAL PROGRESSIVE ICONS</span>
                        </td>
                        @php
                        if(@$data->felicitiation_main_event=='1')
                        {
                          $felicitiation_main='';
                        }
                        else
                        {
                          $felicitiation_main='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="felicitiation_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl06_txt_main_no_program" {{$felicitiation_main}} class="numeric form-control" value="{{@$data->felicitiation_main_no_program ?? ''}}" style="height:50px;" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="felicitiation_main_remark" rows="2" cols="20" id="GridView2_ctl06_txt_main_remarl" {{$felicitiation_main}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->felicitiation_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>
                          <span id="GridView2_ctl07_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl07_ch_main_event_activity" value="1" type="checkbox" name="identifying_opinion_main_event" {{@$data->identifying_opinion_main_event=='1' ? 'checked' : ''}}
                           tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl07_lbl_main_event_desc">IDENTIFYING OPINION LEADERS</span>
                        </td>
                        @php
                        if(@$data->identifying_opinion_main_event=='1')
                        {
                          $identifying_opinion='';
                        }
                        else
                        {
                          $identifying_opinion='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="identifying_opinion_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl07_txt_main_no_program" {{$identifying_opinion}} value="{{@$data->identifying_opinion_main_no_program ?? ''}}" class="numeric form-control" style="height:50px;" {{$block}} />
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="identifying_opinion_main_remark" rows="2" cols="20" {{$identifying_opinion}} id="GridView2_ctl07_txt_main_remarl"  style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->identifying_opinion_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td>
                          <span id="GridView2_ctl08_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl08_ch_main_event_activity" value="1" type="checkbox" name="expert_lectures_main_event" {{@$data->expert_lectures_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl08_lbl_main_event_desc">EXPERT LECTURES</span>
                        </td>
                        @php
                        if(@$data->expert_lectures_main_event=='1')
                        {
                          $expert_lectures='';
                        }
                        else
                        {
                          $expert_lectures='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="expert_lectures_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl08_txt_main_no_program" {{$expert_lectures}} class="numeric form-control" style="height:50px;" value="{{@$data->expert_lectures_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="expert_lectures_main_remark" rows="2" cols="20" id="GridView2_ctl08_txt_main_remarl" {{$expert_lectures}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->expert_lectures_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>8</td>
                        <td>
                          <span id="GridView2_ctl09_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl09_ch_main_event_activity" value="1" type="checkbox" name="workshop_main_event" {{@$data->workshop_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl09_lbl_main_event_desc">WORKSHOPS</span>
                        </td>
                        @php
                        if(@$data->workshop_main_event=='1')
                        {
                          $workshop_main='';
                        }
                        else
                        {
                          $workshop_main='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="workshop_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl09_txt_main_no_program" {{$workshop_main}} class="numeric form-control" style="height:50px;" value="{{@$data->workshop_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="workshop_main_remark" rows="2" cols="20" id="GridView2_ctl09_txt_main_remarl" {{$workshop_main}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->workshop_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>9</td>
                        <td>
                          <span id="GridView2_ctl10_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl10_ch_main_event_activity" value="1" type="checkbox" name="media_station_workshop_main_event" {{@$data->media_station_workshop_main_event=='1' ? 'checked' : ''}}
                          tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl10_lbl_main_event_desc">MEDIA SENSITIONS WORKSHOPS</span>
                        </td>
                        @php
                        if(@$data->media_station_workshop_main_event=='1')
                        {
                          $media_station='';
                        }
                        else
                        {
                          $media_station='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="media_station_workshop_main_no_programm" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl10_txt_main_no_program" {{$media_station}} class="numeric form-control" style="height:50px;" value="{{@$data->media_station_workshop_main_no_programm ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="media_station_workshop_main_remark" rows="2" cols="20" id="GridView2_ctl10_txt_main_remarl" {{$media_station}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->media_station_workshop_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>10</td>
                        <td>
                          <span id="GridView2_ctl11_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl11_ch_main_event_activity" value="1" type="checkbox" name="quiz_competitions_main_event" {{@$data->quiz_competitions_main_event=='1' ? 'checked' : ''}}
                          tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl11_lbl_main_event_desc">QUIZ COMPETITIONS ON GOVT SCHEMES</span>
                        </td>
                        @php
                        if(@$data->quiz_competitions_main_event=='1')
                        {
                          $quiz_competitions='';
                        }
                        else
                        {
                          $quiz_competitions='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="quiz_competitions_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl11_txt_main_no_program" {{$quiz_competitions}} class="numeric form-control" style="height:50px;" value="{{@$data->quiz_competitions_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="quiz_competitions_main_remark" rows="2" cols="20" id="GridView2_ctl11_txt_main_remarl" {{$quiz_competitions}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->quiz_competitions_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>11</td>
                        <td>
                          <span id="GridView2_ctl12_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl12_ch_main_event_activity" value="1" type="checkbox" name="public_meeting_main_event" {{@$data->public_meeting_main_event=='1' ? 'checked' : ''}}
                          tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl12_lbl_main_event_desc">PUBLIC MEETINGS</span>
                        </td>
                        @php
                        if(@$data->public_meeting_main_event=='1')
                        {
                          $public_meeting='';
                        }
                        else
                        {
                          $public_meeting='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="public_meeting_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl12_txt_main_no_program" {{$public_meeting}} class="numeric form-control" style="height:50px;" value="{{@$data->public_meeting_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="public_meeting_main_remark" rows="2" cols="20" id="GridView2_ctl12_txt_main_remarl" {{$public_meeting}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->public_meeting_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>12</td><!-- Add field-->
                        <td>
                          <span id="GridView2_ctl12_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="mobilisation_other_check" value="1" type="checkbox" name="mobilisation_other_check" {{@$data->mobilisation_other_check=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl12_lbl_main_event_desc">OTHER</span>
                        </td>
                        @php
                        if(@$data->mobilisation_other_check=='1')
                        {
                          $mobilisation_other='';
                        }
                        else
                        {
                          $mobilisation_other='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="mobilisation_other_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="mobilisation_other_program" {{$mobilisation_other}} class="numeric form-control" style="height:50px;" value="{{@$data->mobilisation_other_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="mobilisation_other_remark" rows="2" cols="20" id="mobilisation_other_remark" {{$mobilisation_other}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->mobilisation_other_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      

                      <tr>
                        <td>13</td>
                        <td>
                          <span id="GridView2_ctl13_lbl_main_event_activity">EXHIBITIONS</span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl13_ch_main_event_activity" value="1" type="checkbox" name="multimedia_component_main_event" {{@$data->multimedia_component_main_event=='1' ? 'checked' : ''}}
                           tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl13_lbl_main_event_desc">MULTIMEDIA COMPONENT</span>
                        </td>
                        @php
                        if(@$data->multimedia_component_main_event=='1')
                        {
                          $multimedia_component='';
                        }
                        else
                        {
                          $multimedia_component='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="multimedia_component_main_no_program" onkeypress="return onlyNumberKey(event)" type="text" maxlength="5" id="GridView2_ctl13_txt_main_no_program" {{$multimedia_component}} class="numeric form-control" style="height:50px;" value="{{@$data->multimedia_component_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="multimedia_component_main_remark" rows="2" cols="20" id="GridView2_ctl13_txt_main_remarl" {{$multimedia_component}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->multimedia_component_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr><!-- add new field -->
                        <td>14</td>
                        <td>
                          <span id="GridView2_ctl13_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="photo_check" value="1" type="checkbox" name="photo_check" {{@$data->photo_check=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl13_lbl_main_event_desc">PHOTOS/POSTER</span>
                        </td>
                        @php
                        if(@$data->photo_check=='1')
                        {
                          $photo_c='';
                        }
                        else
                        {
                          $photo_c='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="photo_program" type="text" maxlength="5" onkeypress="return onlyNumberKey(event)" id="photo_program" {{$photo_c}} class="numeric form-control" style="height:50px;" value="{{@$data->photo_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="photo_program_remark" rows="2" cols="20" id="photo_program_remark" {{$photo_c}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->photo_program_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr><!-- add new field -->
                        <td>15</td>
                        <td>
                          <span id="GridView2_ctl13_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="digital_check" value="1" type="checkbox" name="digital_check" {{@$data->digital_check=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl13_lbl_main_event_desc">DIGITAL INTERACTIVE EXHIBITION</span>
                        </td>
                        @php
                        if(@$data->digital_check=='1')
                        {
                          $digital_c='';
                        }
                        else
                        {
                          $digital_c='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="digital_program" type="text" maxlength="5" onkeypress="return onlyNumberKey(event)" id="digital_program" {{$digital_c}} class="numeric form-control" style="height:50px;" value="{{@$data->digital_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="digital_program_remark" rows="2" cols="20" id="digital_program_remark" {{$digital_c}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->digital_program_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr><!-- add new field -->
                        <td>16</td>
                        <td>
                          <span id="GridView2_ctl13_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="exhibition_other_check" value="1" type="checkbox" name="exhibition_other_check" {{@$data->exhibition_other_check=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl13_lbl_main_event_desc">OTHER</span>
                        </td>
                        @php
                        if(@$data->exhibition_other_check=='1')
                        {
                          $exhibition_o='';
                        }
                        else
                        {
                          $exhibition_o='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="exhibition_other_program" type="text" maxlength="5" onkeypress="return onlyNumberKey(event)" id="exhibition_other_program" {{$exhibition_o}} class="numeric form-control" style="height:50px;" value="{{@$data->exhibition_other_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="exhibition_other_program_remark" rows="2" cols="20" id="exhibition_other_program_remark" {{$exhibition_o}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->exhibition_other_program_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      

                      




                      <tr>
                        <td>17</td>
                        <td>
                          <span id="GridView2_ctl14_lbl_main_event_activity">CULTURAL PERFORMANCE/FOLK COMMUNICATION</span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl14_ch_main_event_activity" value="1" type="checkbox" name="nukkad_natak_main_event" {{@$data->nukkad_natak_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl14_lbl_main_event_desc">NUKKAD NATAK</span>
                        </td>
                        @php
                        if(@$data->nukkad_natak_main_event=='1')
                        {
                          $nukkad_na='';
                        }
                        else
                        {
                          $nukkad_na='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="nukkad_natak_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl14_txt_main_no_program" {{$nukkad_na}} class="numeric form-control" style="height:50px;" value="{{@$data->nukkad_natak_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="nukkad_natak_main_remark" rows="2" cols="20" id="GridView2_ctl14_txt_main_remarl" {{$nukkad_na}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->nukkad_natak_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>18</td>
                        <td>
                          <span id="GridView2_ctl15_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl15_ch_main_event_activity" value="1" type="checkbox" name="property_show_main_event" {{@$data->property_show_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl15_lbl_main_event_desc">PUPPETRY SHOW</span>
                        </td>
                        @php
                        if(@$data->property_show_main_event=='1')
                        {
                          $property_show='';
                        }
                        else
                        {
                          $property_show='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="property_show_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl15_txt_main_no_program" {{$property_show}} class="numeric form-control" style="height:50px;" value="{{@$data->property_show_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="property_show_main_remark" rows="2" cols="20" id="GridView2_ctl15_txt_main_remarl" {{$property_show}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->property_show_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>19</td>
                        <td>
                          <span id="GridView2_ctl16_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl16_ch_main_event_activity" value="1" type="checkbox" name="megic_show_main_event" {{@$data->megic_show_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl16_lbl_main_event_desc">MAGIC SHOW</span>
                        </td>
                        @php
                        if(@$data->megic_show_main_event=='1')
                        {
                          $megic_show='';
                        }
                        else
                        {
                          $megic_show='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="megic_show_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl16_txt_main_no_program" {{$megic_show}} class="numeric form-control" value="{{@$data->megic_show_main_no_program ?? ''}}" style="height:50px;" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="megic_show_main_remark" rows="2" cols="20" id="GridView2_ctl16_txt_main_remarl" {{$megic_show}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->megic_show_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>20</td>
                        <td>
                          <span id="GridView2_ctl17_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl17_ch_main_event_activity" value="1" type="checkbox" name="folk_song_main_event" {{@$data->folk_song_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl17_lbl_main_event_desc">FOLK RECITAL/SONGS</span>
                        </td>
                        @php
                        if(@$data->folk_song_main_event=='1')
                        {
                          $folk_song='';
                        }
                        else
                        {
                          $folk_song='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="folk_song_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl17_txt_main_no_program" {{$folk_song}} class="numeric form-control" style="height:50px;" value="{{@$data->folk_song_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="folk_song_main_remark" rows="2" cols="20" id="GridView2_ctl17_txt_main_remarl" {{$folk_song}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->folk_song_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>21</td>
                        <td>
                          <span id="GridView2_ctl18_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl18_ch_main_event_activity" value="1" type="checkbox" name="folk_dance_main_event" {{@$data->folk_dance_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl18_lbl_main_event_desc">FOLK DANCE</span>
                        </td>
                        @php
                        if(@$data->folk_dance_main_event=='1')
                        {
                          $folk_dance='';
                        }
                        else
                        {
                          $folk_dance='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="folk_dance_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl18_txt_main_no_program" {{$folk_dance}} class="numeric form-control" style="height:50px;" value="{{@$data->folk_dance_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="folk_dance_main_remark" rows="2" cols="20" id="GridView2_ctl18_txt_main_remarl" {{$folk_dance}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->folk_dance_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>22</td>
                        <td>
                          <span id="GridView2_ctl19_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl19_ch_main_event_activity" value="1" type="checkbox" name="folk_drama_main_event" {{@$data->folk_drama_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl19_lbl_main_event_desc">FOLK DRAMA</span>
                        </td>
                        @php
                        if(@$data->folk_drama_main_event=='1')
                        {
                          $folk_drama='';
                        }
                        else
                        {
                          $folk_drama='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="folk_drama_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl19_txt_main_no_program" {{$folk_drama}} class="numeric form-control" style="height:50px;" value="{{@$data->folk_drama_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="folk_drama_main_remark" rows="2" cols="20" id="GridView2_ctl19_txt_main_remarl" {{$folk_drama}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->folk_drama_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>23</td><!-- Add new field -->
                        <td>
                          <span id="GridView2_ctl19_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle"> 
                          <input id="cultural_other_check" value="1" type="checkbox" name="cultural_other_check" {{@$data->cultural_other_check=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl19_lbl_main_event_desc">OTHER</span>
                        </td>
                        @php
                        if(@$data->cultural_other_check=='1')
                        {
                          $cultural_other='';
                        }
                        else
                        {
                          $cultural_other ='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="cultural_other_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="cultural_other_program" {{$cultural_other}} class="numeric form-control" style="height:50px;" value="{{@$data->cultural_other_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="cultural_other_remark" rows="2" cols="20" id="cultural_other_remark" {{$cultural_other}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->cultural_other_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>


                      <tr>
                        <td> 24 </td>
                        <td>
                          <span id="GridView2_ctl20_lbl_main_event_activity">AV MEDIUM</span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl20_ch_main_event_activity" value="1" type="checkbox" name="av_medium_main_event" {{@$data->av_medium_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl20_lbl_main_event_desc">FILM SHOW</span>
                        </td>
                        @php
                        if(@$data->av_medium_main_event=='1')
                        {
                          $mobile_station='';
                        }
                        else
                        {
                          $mobile_station='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="av_medium_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl20_txt_main_no_program" {{$mobile_station}} class="numeric form-control" style="height:50px;" value="{{@$data->av_medium_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="av_medium_main_remark" rows="2" cols="20" id="GridView2_ctl20_txt_main_remarl" {{$mobile_station}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->av_medium_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>25</td>
                        <td>
                          <span id="GridView2_ctl21_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl21_ch_main_event_activity" value="1" type="checkbox" name="snippet_air_dd_main_event" {{@$data->snippet_air_dd_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl21_lbl_main_event_desc">SNIPPET OF AIR/DD</span>
                        </td>
                        @php
                        if(@$data->snippet_air_dd_main_event=='1')
                        {
                          $snippet_air='';
                        }
                        else
                        {
                          $snippet_air='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="snippet_air_dd_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl21_txt_main_no_program" {{$snippet_air}} class="numeric form-control" style="height:50px;" value="{{@$data->snippet_air_dd_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="snippet_air_dd_main_remark" rows="2" cols="20" id="GridView2_ctl21_txt_main_remarl" {{$snippet_air}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->snippet_air_dd_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>26</td>
                        <td>
                          <span id="GridView2_ctl22_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl22_ch_main_event_activity" value="1" type="checkbox" name="other_av_meterial_main_event" {{@$data->other_av_meterial_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl22_lbl_main_event_desc">OTHER AV MATERIAL</span>
                        </td>
                        @php
                        if(@$data->other_av_meterial_main_event=='1')
                        {
                          $other_av='';
                        }
                        else
                        {
                          $other_av='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="other_av_meterial_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl22_txt_main_no_program" {{$other_av}} class="numeric form-control" style="height:50px;" value="{{@$data->other_av_meterial_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="other_av_meterial_main_remark" rows="2" cols="20" id="GridView2_ctl22_txt_main_remarl" {{$other_av}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->other_av_meterial_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>27</td>
                        <td>
                          <span id="GridView2_ctl23_lbl_main_event_activity">FACILIATION THROUGH DEPARTMENTAL STALL</span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl23_ch_main_event_activity" value="1" type="checkbox" name="ten_twelve_stalls_main_event" {{@$data->ten_twelve_stalls_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl23_lbl_main_event_desc">10-12 STALLS</span>
                        </td>
                        @php
                        if(@$data->ten_twelve_stalls_main_event=='1')
                        {
                          $ten_twelve='';
                        }
                        else
                        {
                          $ten_twelve='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="ten_twelve_stalls_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl23_txt_main_no_program" {{$ten_twelve}} class="numeric form-control" style="height:50px;" value="{{@$data->ten_twelve_stalls_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="ten_twelve_stalls_main_remark" rows="2" cols="20" id="GridView2_ctl23_txt_main_remarl" {{$ten_twelve}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->ten_twelve_stalls_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>

                      <tr><!-- add new field -->
                        <td>28</td>
                        <td>
                          <span id="GridView2_ctl23_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="stalls_other_check" value="1" type="checkbox" name="stalls_other_check" {{@$data->stalls_other_check=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl23_lbl_main_event_desc">OTHER</span>
                        </td>
                        @php
                        if(@$data->stalls_other_check=='1')
                        {
                          $stalls_other='';
                        }
                        else
                        {
                          $stalls_other='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="stalls_other_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="stalls_other_program" {{$stalls_other}} class="numeric form-control" style="height:50px;" value="{{@$data->stalls_other_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="stalls_other_remark" rows="2" cols="20" id="stalls_other_remark" {{$stalls_other}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->stalls_other_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>



                      <tr>
                        <td> 29 </td>
                        <td>
                          <span id="GridView2_ctl24_lbl_main_event_activity">DISTRUBUTION OF GOVT BENEFITS</span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl24_ch_main_event_activity" value="1" type="checkbox" name="ujwala_gas_main_event" {{@$data->ujwala_gas_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl24_lbl_main_event_desc">DISTRUBUTION OF UJWALA GAS CONNECTIONS</span>
                        </td>
                        @php
                        if(@$data->ujwala_gas_main_event=='1')
                        {
                          $ujwala_gas='';
                        }
                        else
                        {
                          $ujwala_gas='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="ujwala_gas_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl24_txt_main_no_program" {{$ujwala_gas}} class="numeric form-control" style="height:50px;" value="{{@$data->ujwala_gas_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="ujwala_gas_main_remark" rows="2" cols="20" id="GridView2_ctl24_txt_main_remarl" {{$ujwala_gas}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->ujwala_gas_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>30</td>
                        <td>
                          <span id="GridView2_ctl25_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl25_ch_main_event_activity" value="1" type="checkbox" name="mudra_loans_main_event" {{@$data->mudra_loans_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl25_lbl_main_event_desc">DISTRUBUTION OF MUDRA LOANS</span>
                        </td>
                        @php
                        if(@$data->mudra_loans_main_event=='1')
                        {
                          $mudra_loans='';
                        }
                        else
                        {
                          $mudra_loans='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="mudra_loans_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl25_txt_main_no_program" {{$mudra_loans}} class="numeric form-control" style="height:50px;" value="{{@$data->mudra_loans_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="mudra_loans_main_remark" rows="2" cols="20" id="GridView2_ctl25_txt_main_remarl" {{$mudra_loans}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->mudra_loans_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>31</td>
                        <td>
                          <span id="GridView2_ctl26_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl26_ch_main_event_activity" value="1" type="checkbox" name="kisian_credits_card_main_event" {{@$data->kisian_credits_card_main_event=='1' ? 'checked' : ''}} 
                          tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl26_lbl_main_event_desc">DISTRUBUTION OF KISAN CREDITS CARDS</span>
                        </td>
                        @php
                        if(@$data->kisian_credits_card_main_event=='1')
                        {
                          $kisian_credits='';
                        }
                        else
                        {
                          $kisian_credits='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="kisian_credits_card_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl26_txt_main_no_program" {{$kisian_credits}} class="numeric form-control" style="height:50px;" value="{{@$data->kisian_credits_card_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="kisian_credits_card_main_remark" rows="2" cols="20" id="GridView2_ctl26_txt_main_remarl" {{$kisian_credits}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->kisian_credits_card_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td> 32 </td>
                        <td>
                          <span id="GridView2_ctl27_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl27_ch_main_event_activity" value="1" type="checkbox" name="opening_account_main_event" {{@$data->opening_account_main_event=='1' ? 'checked' : ''}} 
                          tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl27_lbl_main_event_desc">DISTRUBUTION OF OPENING OF ACCOUNTS</span>
                        </td>
                        @php
                        if(@$data->opening_account_main_event=='1')
                        {
                          $opening_account='';
                        }
                        else
                        {
                          $opening_account='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="opening_account_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl27_txt_main_no_program" {{$opening_account}} class="numeric form-control" style="height:50px;" value="{{@$data->opening_account_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="opening_account_main_remark" rows="2" cols="20" id="GridView2_ctl27_txt_main_remarl" {{$opening_account}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->opening_account_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>
                      <tr>
                        <td>33</td>
                        <td>
                          <span id="GridView2_ctl28_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="GridView2_ctl28_ch_main_event_activity" value="1" type="checkbox" name="other_govt_scheme_main_event" {{@$data->other_govt_scheme_main_event=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl28_lbl_main_event_desc">DISTRUBUTION OF ANY OTHER GOVT SCHEME</span>
                        </td>
                        @php
                        if(@$data->other_govt_scheme_main_event=='1')
                        {
                          $other_gov='';
                        }
                        else
                        {
                          $other_gov='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="other_govt_scheme_main_no_program" type="text" onkeypress="return onlyNumberKey(event)" maxlength="5" id="GridView2_ctl28_txt_main_no_program" {{$other_gov}} class="numeric form-control" style="height:50px;" value="{{@$data->other_govt_scheme_main_no_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="other_govt_scheme_main_remark" rows="2" cols="20" id="GridView2_ctl28_txt_main_remarl" {{$other_gov}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->other_govt_scheme_main_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>

                      <tr><!-- add new field -->
                        <td>34</td>
                        <td>
                          <span id="GridView2_ctl28_lbl_main_event_activity"></span>
                        </td>
                        <td valign="middle">
                          <input id="govt_other_check" value="1" type="checkbox" name="govt_other_check" {{@$data->govt_other_check=='1' ? 'checked' : ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>
                          <span id="GridView2_ctl28_lbl_main_event_desc">OTHER</span>
                        </td>
                        @php
                        if(@$data->govt_other_check=='1')
                        {
                          $govt_othe='';
                        }
                        else
                        {
                          $govt_othe='disabled';
                        }
                        @endphp
                        <td valign="middle">
                          <input name="govt_other_program" type="text" maxlength="5" onkeypress="return onlyNumberKey(event)" id="govt_other_program" {{$govt_othe}} class="numeric form-control" style="height:50px;" value="{{@$data->govt_other_program ?? ''}}" {{$block}}/>
                        </td>
                        <td valign="middle">
                          <textarea maxlength="120" name="govt_other_remark" rows="2" cols="20" id="govt_other_remark" {{$govt_othe}} style="height:50px;" class="form-control" {{$block}}>
                            {{@$data->govt_other_remark ?? ''}}
                          </textarea>
                        </td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>

              <div class="row">
                <div class="col-xl-6">
                  <div class="form-group">
                    <label for="">Social Media Campaign:</label><br>
                    <input id="chk_success" type="checkbox" value="1" name="success_stories" {{@$data->success_stories=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> Success Stories <br>
                    <input id="chk_local" type="checkbox" value="1" name="local_input_about_program" {{@$data->local_input_about_program=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> Local inputs about the programme<br>
                    <input id="chk_fb" type="checkbox" value="1" name="fb_twitter_instagram" {{@$data->fb_twitter_instagram=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> Facebook/Twitter/Instagram<br>
                    <input id="chk_web" type="checkbox" value="1" name="web_streaming" {{@$data->web_streaming=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> Web Streaming <br>
                    <input id="chk_live" type="checkbox" value="1" name="live_chat_session" {{@$data->live_chat_session=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> Live Chat sessions <br>
                    <input id="chk_talk" type="checkbox" value="1" name="talkathons" {{@$data->talkathons=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>Talkathons<br>
                    <input id="chk_self" type="checkbox" value="1" name="selfie_points" {{@$data->selfie_points=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>Selfie Points <br>
                    <input id="chk_social" type="checkbox" value="1" name="social_media_wall" {{@$data->social_media_wall=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/>Social Media Wall<br>
                    <input id="chkoth" type="checkbox" value="1" name="other" {{@$data->other=='1' ? 'checked': ''}} tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}/> Other
                    <span style="display:none;" id="other_field">
                    <!-- <input name="txt_smc_oth" type="text" maxlength="40" id="txt_smc_oth" placeholder="Specify only" class="alph" style="width:120px; "> -->
                    </span>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group">
                    <label for="">Media Coverage : </label>
                    <textarea maxlength="120" name="media_coverage_txt" rows="2" cols="20" id="TextBox1" placeholder="Specify Media Coverage " class="alph form-control" style="height: 170px;" {{$block}}>{{@$data->media_coverage_txt ?? ''}}</textarea>
                  </div>
                </div>
              </div>
            </div>
            <!-- fixed end-->
            <div class="row">
              <div class="col-xl-12 text-center"><h4>Programme Details</h4></div>
            </div>
            <div class="row">
              <div class="col-xl-4">
                <div class="form-group">
                  <label for="">Approx Size Of Audience : <span style="color: red;">*</span></label>
                  <input name="approx_size_of_audience" value="{{@$data->approx_size_of_audience ?? ''}}" type="text" maxlength="10" id="txt_aud_size" onkeypress="return onlyNumberKey(event)" class="numeric form-control form-control-sm" {{$block}} />
                  <span id="txt_aud_size_err_" style="color: red" ;></span>
                </div>
              </div>
              <div class="col-xl-4">
                @php
                  $ary=
                      array(
                          0=> array('sareavalue'=>1,
                          'saname'=>'BORDER AREA' ),
                          1=> array('sareavalue'=>2,
                          'saname'=>'LWE AREA'),
                          2=> array('sareavalue'=>3,
                          'saname'=>'MINORITIES AREA'),
                          3=> array('sareavalue'=>4,
                          'saname'=>'NORTH-EASTERN AREA'),
                          4=> array('sareavalue'=>5,
                          'saname'=>'ASPIRATIONAL DISTRICTS'),
                          5=> array('sareavalue'=>6,
                          'saname'=>'OTHER AREA')
                  );
                  $special=explode(",",@$data->Special_Areas);
                @endphp
                <!-- @in_array($val['sareavalue'],$list)? 'selected':'' -->
                <div class="form-group">
                  <label for="">Special Area( * if any) :</label>
                  <select size="4" name="special_area[]" multiple="multiple" id="ddl_area_type" class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}}; height: 150px;" {{$block}}>
                    @foreach($ary as $val)
                      <option value="{{$val['sareavalue']}}" {{ @in_array($val['sareavalue'],$special)? 'selected':''}}>{{$val['saname']}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

            </div>



          </div> 
          @if(@$data->sop_theme=='')
          <input type="hidden" name="get_id" id="get_id" value="0"> 
          @else
          <input type="hidden" name="url_id" value="{{@$data->Pk_id ?? ''}}">
          <input type="hidden" name="get_id" id="get_id" value="1">
          @endif 
          <div class="row">
            <div class="col-sm-12 text-right">
               <input type="hidden" id="next_tab_1">
               @if(@$data->status=='1')
               <a class="btn btn-primary client-next-button btn-sm m-0" >Next <i class="fa fa-caret-right"></i></a>
               @else
               <a class="btn btn-primary client-next-button btn-sm m-0" id="tab_1">Next <i class="fa fa-caret-right"></i></a>
               @endif
              
              
              <!-- <input type="hidden" name="fetch_id" value="{{@$data->Pk_id}}"> -->
              <!-- <a class="btn btn-primary client-next-button btn-sm m-0"   id="tab_1">Next1 <i class="fa fa-caret-right"></i></a> -->
              
            </div>
          </div>
        </div>  <!-- tab-pane close -->

          <div id="logins-part1" class="tab-pane">
           <div id="logins-part1" class="content pt-3" role="tabpanel" aria-labelledby="logins-part1-trigger">
            <div id="show_only_print_details1">
              <div class="row">
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="">Community Network Created :</label>
                    <input name="community_network_created" type="text" value="{{@$data->community_network_created ?? ''}}" maxlength="10" id="txt_comm_netwrk" class="numeric form-control form-control-sm" {{$block}}/>
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="">Community Network Details : </label>
                    <input type="text" name="community_network_details" value="{{@$data->community_network_details ?? ''}}" id="txt_comm_netwrk_details" class="form-control form-control-sm" {{$block}}>
                    <!-- <textarea name="community_network_details" rows="2" cols="20" id="txt_comm_netwrk_details" style="" class="form-control form-control-sm"></textarea> -->
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="">Virtual Network Created : </label>
                    <input name="virtual_network_created"  type="text" value="{{@$data->virtual_network_created ?? ''}}" maxlength="10" id="txt_virtual_netwrk" class="numeric form-control form-control-sm" {{$block}}/>
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="">Virtual Network Details : </label>
                    <input type="text" name="virtual_network_details" id="txt_virtual_netwrk_dtl" value="{{@$data->virtual_network_details ?? ''}}" class="form-control form-control-sm" {{$block}}>
                    <!-- <textarea name="virtual_network_details" rows="2" cols="20" id="txt_virtual_netwrk_dtl" style="" class="form-control form-control-sm"></textarea> -->
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="">Radio Station Mobilized : </label>
                    <input name="radio_station_mobilized" type="text" value="{{@$data->radio_station_mobilized ?? ''}}" maxlength="10" id="txt_rd_station" class="numeric form-control form-control-sm" {{$block}}/>
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="">Remarks : </label>
                    <textarea maxlength="120" name="remarks" rows="2" cols="20" id="txt_remarks" style="" class="form-control form-control-sm" {{$block}}>
                      {{@$data->remarks ?? ''}}
                    </textarea>
                  </div>
                </div>

              </div> <!-- row close-->      
            </div>
              <div class="row">
                <input type="hidden" name="get_status" id="get_status">
                <div class="col-sm-12 text-right">
                 <a class="btn btn-primary reg-previous-button  btn-sm m-0" id="previous_btn_2"><i class="fa fa-caret-left"></i> Previous</a>
                 <!-- <a class="btn btn-primary client-next-button btn-sm m-0"><i class="fa fa-save"></i> Submit </a> -->
                 <input type="hidden" id="next_tab_2">
                 @if(@$data->status=='1')
                 <a class="btn btn-primary client-next-button btn-sm m-0" >Next <i class="fa fa-caret-right"></i></a>
                 @else
                 <a class="btn btn-primary client-next-button btn-sm m-0" id="tab_2">Next <i class="fa fa-caret-right"></i></a>
                 @endif
                 
                 
               </div>
             </div>
           </div>   
         </div>


         <div id="logins-part2" class="tab-pane">
           <div id="logins-part2" class="content pt-3" role="tabpanel" aria-labelledby="logins-part2-trigger">
            <div id="show_only_print_details1">
              <div class="row">
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="">Funds Allocated : <span style="color: red;">*</span></label>
                    <input name="allocated_funds" value="{{@$data->allocated_funds ? @$data->allocated_funds : (!empty(@$data->document_type) ? ' ' : '') }}" type="text" maxlength="10" id="txt_fund_sanc" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" onpaste="false" placeholder="Funds Allocated" {{$block}} />
                    <span id="txt_fund_sanc_err" style="color:Red;"></span>
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="">Name Of The Officer: <span style="color: red;">*</span></label>
                    <input name="officer_name" type="text" value="{{@$data->officer_name ? @$data->officer_name : (!empty(@$data->document_type) ? ' ' : '') }}" onkeypress="return alphaOnly(event);" maxlength="80" id="txt_officer_name" class="form-control form-control-sm" onpaste="false" placeholder="Officer Name" {{$block}}/>
                    <span id="txt_officer_name_err" style="color:Red;"></span>
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="">Designation Of The Officer: <span style="color: red;">*</span></label>
                    <input name="officer_designation" type="text" value="{{@$data->officer_designation ? @$data->officer_designation : (!empty(@$data->document_type) ? ' ' : '') }}" onkeypress="return alphaOnly(event);" maxlength="40" id="txt_off_desig" onpaste="false" placeholder="Officer Designation" class="form-control form-control-sm" {{$block}}/>
                    <span id="txt_off_desig_err" style="color:Red;"></span>
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="">Location : <span style="color: red;">*</span></label>
                    <input name="office_location" type="text" value="{{@$data->office_location ? @$data->office_location : (!empty(@$data->document_type) ? ' ' : '') }}" maxlength="40" id="txt_off_loc" onkeypress="return alphaOnly(event);" onpaste="false" placeholder="Location" class="form-control form-control-sm" {{$block}}/>
                    <span id="txt_off_loc_err" style="color:Red;"></span>
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="">On-Account Advance: <span style="color: red;">*</span></label>
                    <input name="advance_account" type="text" value="{{@$data->advance_account ? @$data->advance_account : (!empty(@$data->document_type) ? ' ' : '') }}" maxlength="10" id="txt_adv_amt" onkeypress="return onlyNumberKey(event)" onpaste="false" placeholder="Advance amount drawn" class="form-control form-control-sm" {{$block}}/>
                    <span id="txt_adv_amt_err" style="color:Red;"></span>
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="">Settlement of On-Account Advance: <span style="color: red;">*</span></label>
                    <input name="sattlement_account_advance" type="text" value="{{@$data->sattlement_account_advance ? @$data->sattlement_account_advance : (!empty(@$data->document_type) ? ' ' : '') }}" maxlength="10" id="txt_adv_pao" onkeypress="return onlyNumberKey(event)" onpaste="false" placeholder="Settlement of On-Account Advance" class="form-control form-control-sm" {{$block}}/>
                    <span id="txt_adv_pao_err" style="color:Red;"></span>
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="">Direct Settlement Of Bill Through PAO : <span style="color: red;">*</span></label>
                    <input name="direct_settlement_bill_pao" type="text" value="{{@$data->direct_settlement_bill_pao ? @$data->direct_settlement_bill_pao : (!empty(@$data->sop_theme) ? ' ' : '') }}" maxlength="10" onkeypress="return onlyNumberKey(event)" id="txt_direct_pao" onpaste="false" placeholder="Direct Settlement Amount Settled By PAO" class="form-control form-control-sm" {{$block}}/>
                    <span id="txt_direct_pao_err" style="color:Red;"></span>
                  </div>
                </div>

              </div> <!-- row close-->      
            </div>
              <div class="row">

                <div class="col-sm-12 text-right">
                 <a class="btn btn-primary reg-previous-button  btn-sm m-0" id="previous_btn_3"><i class="fa fa-caret-left"></i> Previous</a>
                 <!-- <a class="btn btn-primary client-next-button btn-sm m-0"><i class="fa fa-save"></i> Submit </a> -->
                 <input type="hidden" id="next_tab_3">
                 <a class="btn btn-primary client-next-button btn-sm m-0"   id="tab_33">Skip <i class="fa fa-caret-right"></i></a>
                 @if(@$data->status=='1')
                 <a class="btn btn-primary client-next-button btn-sm m-0" >Next <i class="fa fa-caret-right"></i></a>
                 @else
                 <a class="btn btn-primary client-next-button btn-sm m-0"   id="tab_3">Next <i class="fa fa-caret-right"></i></a>
                 @endif
                 
                 
               </div>
             </div>
           </div>   
         </div>



         <div id="logins-part3" class="tab-pane">
           <div id="logins-part3" class="content pt-3" role="tabpanel" aria-labelledby="logins-part3-trigger">
            <div id="show_only_print_details1">
              <div class="row">
                <input type="hidden" name="rob_form_id" value="{{@$data->Pk_id ?? ''}}">
                <div class="col-xl-4">
                  <label for="">Document Type : <span style="color: red;">*</span>{{@$rob_documents[0]->document_type}}</label>
                  <select name="document_type"  id="ddl_doc_categ"  class="form-control form-control-sm" tabindex="{{$tab}}" style="pointer-events:{{$non}};" {{$block}}>
                    <option  value="">--Select--</option>
                    <option value="PIC" {{@$data->document_type=='PIC' ? 'selected' : ''}}>Photographs of Event</option>
                    <option value="VID" {{@$data->document_type=='VID' ? 'selected' : ''}}>Video Clips Of Event</option>
                    <option value="NEW" {{@$data->document_type=='NEW' ? 'selected' : ''}}>Newspaper cutting</option>
                  </select>
                  <span id="document_type_err" style="display: none;color: red;"></span>
                  
                </div>
                <div class="col-xl-4">
                  <label for="">Date Of Event : <span style="color: red;">*</span></label>
                  <input name="event_date" type="date" value="{{@$data->event_date ?? ''}}"  maxlength="10" id="txt_date_event" class="calendar1 form-control form-control-sm" {{$block}}/>
                  <span id="event_date_err" style="display: none;color: red;"></span>
                  
                </div>
                <div class="col-xl-4">
                  <label for="">Venue Of Event : <span style="color: red;">*</span></label>
                  <input name="venue_event" type="text" value="{{@$data->venue_event ?? ''}}"  maxlength="50" id="txt_venue_event" class="form-control form-control-sm" {{$block}}/>
                  <span id="venue_event_err" style="display: none;color: red;"></span>
                </div>

                @if(@$rob_documents[0]->event_date =='')
                <div class="col-xl-4">
                  <label>Detail Report Of Program : </label>
                  <input type="file" name="detail_report" class="form-control form-control-sm" accept="pdf">
                  <!-- <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="detail_report" class="custom-file-input" id="detail_report">
                                <label class="custom-file-label" id="detail_report2" for="detail_report">{{@$data->detail_report ?? 'Choose file'}}</label>
                            </div>
                            @if(@$data->detail_report != '')
                            <div class="input-group-append">
                                <span class="input-group-text"><a href="{{asset('rob/'.@$data->detail_report)}}" target="_blank">View</a></span>
                            </div>
                            @else
                            <div class="input-group-append">
                                <span class="input-group-text" id="detail_report3">Upload</span>
                            </div>
                            @endif
                        </div>
                        <span id="detail_report1" class="error invalid-feedback"></span>
                    </div> -->
                    <span id="detail_report_err" style="color: red;display: none;"></span>
                </div>
                <div class="col-xl-8"></div>
                @else
                  <div class="col-xl-4">
                    <label>Detail Report Of Program : </label>
                    <div class="form-group">
                        <!-- <label for="exampleInputFile">Detail Report Of Program : <font color="red">*</font></label> -->
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="detail_report" class="custom-file-input" id="file_name">
                                <label class="custom-file-label" id="file_name2" for="file_name">{{@$data->detail_report ?? 'Choose file'}}</label>
                            </div>
                            @if(@$data->detail_report != '')
                            <div class="input-group-append">
                                <span class="input-group-text"><a href="{{asset('rob/'.@$data->detail_report)}}" target="_blank">View</a></span>
                            </div>
                            @else
                            <div class="input-group-append">
                                <span class="input-group-text" id="file_name3">Upload</span>
                            </div>
                            @endif
                        </div>
                        <span id="file_name1" class="error invalid-feedback"></span>
                    </div>
                  </div>
                @endif
                <!-- <div class="col-xl-4">
                  <label>Detail Report Of Program : </label>
                  @if(@$rob_documents[0]->event_date =='')
                    <input type="file" name="detail_report" class="form-control form-control-sm" accept="pdf">
                    <span id="detail_report_err" style="color: red;display: none;"></span>
                  @else
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="detail_report" class="custom-file-input" id="file_name">
                                <label class="custom-file-label" id="file_name2" for="file_name">{{@$data->detail_report ?? 'Choose file'}}</label>
                            </div>
                            @if(@$data->detail_report != '')
                            <div class="input-group-append">
                                <span class="input-group-text"><a href="{{asset('rob/'.@$data->detail_report)}}" target="_blank">View</a></span>
                            </div>
                            @else
                            <div class="input-group-append">
                                <span class="input-group-text" id="file_name3">Upload</span>
                            </div>
                            @endif
                        </div>
                        <span id="file_name1" class="error invalid-feedback"></span>
                    </div>

                    @endif
                </div> -->
                <div class="col-xl-12">
                  <h5>Video upload section : </h5>
                </div>
                <!-- if(@$data->video=='' && @$data->video==null) -->
                @php
                if(Request::segment(2)!='')
                {
                  $status='1';
                }
                else
                {
                  $status='0';
                }
                @endphp
                @if(@$data->status=='0' || $status=='0')
                <div class="col-xl-4">
                  <label>Video upload : </label>
                  <input type="file" name="video" id="video" class="form-control form-control-sm" accept="video/mp4,video/x-m4v,video/*">
                  <span id="video_err" style="color: red;display: none;"></span>
                </div>
                <div class="col-xl-4">
                  <label>Caption : </label>
                  <input type="text" name="video_caption" id="video_caption" class="form-control form-control-sm">
                  <span id="video_caption_err" style="color: red;display: none;"></span>
                </div>
                <div class="col-xl-4"></div>
                @else
                <input type="hidden" name="video" value="{{@$data->video}}">
                <input type="hidden" name="video_caption" value="{{@$data->video_caption}}">
                <div class="col-xl-2">
                  <label>{{@$data->video_caption}} </label>
                  <!-- <iframe src="{{asset('rob/'.@$data->video)}}" style="width: 150px; height: 150px;" controls></iframe> -->
                  <video controls width="150" height="150">
                    <source src="{{asset('rob/'.@$data->video)}}">
                  </video>
                </div>
                @endif

                <!-- @$data->video2=='' && @$data->video2==null -->
                @if(@$data->status=='0' || $status=='0')
                <div class="col-xl-4">
                  <label>Video upload : </label>
                  <input type="file" name="video2" id="video2" class="form-control form-control-sm" accept="video/mp4,video/x-m4v,video/*">
                  <span id="video2_err" style="color: red;display: none;"></span>
                </div>
                <div class="col-xl-4">
                  <label>Caption : </label>
                  <input type="text" name="video2_caption" id="video2_caption" class="form-control form-control-sm">
                  <span id="video2_caption_err" style="color: red;display: none;"></span>
                </div>
                <div class="col-xl-4"></div>
                @else
                <input type="hidden" name="video2" value="{{@$data->video2}}">
                <input type="hidden" name="video2_caption" value="{{@$data->video2_caption}}">
                <div class="col-xl-2">
                  <label>{{@$data->video2_caption}} : </label>
                  <!-- <iframe src="{{asset('rob/'.@$data->video2)}}" style="width: 150px; height: 150px;" controls></iframe> -->
                  <video controls width="150" height="150">
                    <source src="{{asset('rob/'.@$data->video2)}}">
                  </video>

                </div>
                @endif

                <!-- @$data->video3=='' && @$data->video3==null -->
                @if(@$data->status=='0' || $status=='0')
                <div class="col-xl-4">
                  <label>Video upload : </label>
                  <input type="file" name="video3" id="video3" class="form-control form-control-sm" accept="video/mp4,video/x-m4v,video/*">
                  <span id="video3_err" style="color: red;display: none;"></span>
                </div>
                <div class="col-xl-4">
                  <label>Caption : </label>
                  <input type="text" name="video3_caption" id="video3_caption" class="form-control form-control-sm">
                  <span id="video3_caption_err" style="color: red;display: none;"></span>
                </div>
                @else
                <input type="hidden" name="video3" value="{{@$data->video3}}">
                <input type="hidden" name="video3_caption" value="{{@$data->video3_caption}}">
                <div class="col-xl-2">
                  <label>{{@$data->video3_caption}} : </label>
                  <!-- <iframe src="{{asset('rob/'.@$data->video3)}}" style="width: 150px; height: 150px;" controls></iframe> -->
                  <video controls width="150" height="150">
                    <source src="{{asset('rob/'.@$data->video3)}}">
                  </video>

                </div>
                @endif

                <div class="col-xl-12">
                  <!-- @$rob_documents[0]->event_date =='' -->
                  @if(@$data->status =='0' || $status=='0')
                  <table class="table borderless" id="FileUploadContainer" style="margin-left:-10px;">
                    <tr>
                        <td>
                          File : <input type="file" name="document_name[]" id="pic" class="form-control form-control-sm" accept="image/png, image/gif, image/jpeg" style="width: 336px;">

                        </td>
                        <td><span style="margin-left: -10px;">Caption Name:</span> <input type="text" name="caption_name[]" id="caption_name1"  class="form-control form-control-sm" style="width: 334px;margin-left: -10px;">
                        </td>
                        <td>
                          <br><input type="checkbox" name="show_website[]" id="show_website" value="1"> Show On Website
                        </td>                        
                        
                        <!-- @$rob_documents[0]->event_date -->
                        @if(@$data->status=='0' || $status=='0') <!-- when form is readable then add button not show -->
                        <td><br><button class="btn btn-info" id="Button1">Add More</button></td>
                        @endif
                    </tr>
                    <tr>
                      <td>
                        <span id="document_name_err" style="color: red;display: none;"></span>
                    </td>
                    <td>
                        <span id="caption_name1_err" style="color: red;display: none1;"></span>
                    </td>
                    </tr>

                  </table>
                  @endif
                </div>



                <!-- Press image -->
                <div class="col-xl-12">
                  <!-- @$rob_documents[0]->event_date =='' -->
                  @if(@$data->status =='0' || $status=='0')
                  <table class="table borderless" id="PressUploadContainer" style="margin-left:-10px;">
                    <tr>
                        <td>
                          Press Release File : <input type="file" name="press_document_name[]" id="pic2" class="form-control form-control-sm" accept="image/png, image/gif, image/jpeg" style="width: 336px;">
                        </td>
                        <td> Caption Name: <input type="text" name="press_caption_name[]" id="press_caption_name"  class="form-control form-control-sm" style="width: 334px;margin-left: -10px;">
                        <td><br><input type="checkbox" name="press_show_website[]" id="press_show_website" value="1"> Show On Website</td>                        
                        </td>
                        <!-- @$rob_documents[0]->event_date=='' -->
                        @if(@$data->status=='0' || $status=='0') <!-- when form is readable then add button not show -->
                        <td><br><button class="btn btn-info" id="press">Add More</button></td>
                        @endif
                    </tr>
                    <tr>
                      <td>
                        <span id="press_document_name_err" style="color: red;display: none;"></span>                     
                    </td>
                    </tr>
                  </table>
                  @endif
                </div>
                <!-- press image end -->

                <!-- @$rob_documents[0]->event_date!='' -->

                @if(@$data->status=='1')
                   <table class="table table-bordered" style="margin-top:10px;">
                    <tr style="background: #456bd8;color: white;">
                      <th style="width: 5%;">S.No</th>
                      <th style="width: 20%;">File</th>
                      <th style="width: 20%;">Caption Name</th>
                      <th style="width: 20%;">Show On Website</th>
                    </tr>
                    @foreach(@$rob_documents as $key=>$rob_document)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>
                        <a target="_blank" href="{{asset('rob/'.$rob_document->document_name)}}">
                          <img style="width: 50px;height: 50px;" src="{{asset('rob/'.$rob_document->document_name)}}">
                        </a>
                        <!-- <input type="hidden" name="document_name_modify[]" value="{{@$rob_document->document_name ?? ''}}"> -->
                      </td>
                      <td>
                        {{@$rob_document->caption_name}}
                        <!-- <input type="hidden" name="caption_name_modify[]" value="{{@$rob_document->caption_name ?? ''}}"> -->
                      </td>
                      @php
                      if(@$rob_document->show_website=='1')
                      {
                        $check='checked';
                        $disabled='disabled';
                      }
                      else
                      {
                        $check='';
                        $disabled='';
                      }
                      @endphp
                      <td>
                        <input type="checkbox" name="show_website" {{$check}} {{$disabled}}>
                        <!-- <input type="hidden" name="show_website_modify[]" value="{{@$rob_document->show_website ?? '0'}}"> -->

                      </td>
                    </tr>
                    @endforeach
                  </table>
                  @else
                  @foreach(@$rob_documents as $key=>$rob_document)
                  <input type="hidden" name="document_name_modify[]" value="{{@$rob_document->document_name ?? ''}}">
                  <input type="hidden" name="caption_name_modify[]" value="{{@$rob_document->caption_name ?? ''}}">
                  <input type="hidden" name="show_website_modify[]" value="{{@$rob_document->show_website ?? '0'}}">
                  @endforeach
                  @endif


                  <!-- press section -->
                  <!-- @$press[0]->event_date!='' -->
                  @if(@$data->status=='1')
                  <h4>Press Release : </h4>
                   <table class="table table-bordered" style="margin-top:10px;">
                    <tr style="background: #456bd8;color: white;">
                      <th style="width: 5%;">S.No</th>
                      <th style="width: 20%;">File</th>
                      <th style="width: 20%;">Caption Name</th>
                      <th style="width: 20%;">Show On Website</th>
                    </tr>
                    @foreach(@$press as $key=>$rob_document)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>
                        <a target="_blank" href="{{asset('rob/'.$rob_document->document_name)}}">
                          <img style="width: 50px;height: 50px;" src="{{asset('rob/'.$rob_document->document_name)}}">
                        </a>
                      </td>
                      <td>
                        {{@$rob_document->caption_name}}
                      </td>
                      @php
                      if(@$rob_document->show_website=='1')
                      {
                        $check='checked';
                        $disabled='disabled';
                      }
                      else
                      {
                        $check='';
                        $disabled='';
                      }
                      @endphp
                      <td><input type="checkbox" name="show_website" {{$check}} {{$disabled}}></td>
                    </tr>
                    @endforeach
                  </table>
                  @else
                   @foreach(@$press as $key=>$rob_document)
                   <input type="hidden" name="press_document_name_modify[]" value="{{@$rob_document->document_name ?? ''}}">
                   <input type="hidden" name="press_caption_name_modify[]" value="{{@$rob_document->caption_name ?? ''}}">
                   <input type="hidden" name="press_show_website_modify[]" value="{{@$rob_document->show_website ?? '0'}}">
                   @endforeach
                  @endif


              </div> <!-- row close -->       
            </div>
              <div class="row">
                <div class="col-sm-12 text-right">
                 <a class="btn btn-primary reg-previous-button  btn-sm m-0" id="previous_btn"><i class="fa fa-caret-left"></i> Previous</a>
                 <!-- @$rob_documents[0]->event_date=='' -->
                 @if(@$data->status=='0' || $status=='0')
                 <a class="btn btn-primary client-next-button btn-sm m-0" id="submit"><i class="fa fa-save"></i> Submit </a>
                 
                 @endif
                 <!-- <a class="btn btn-primary client-next-button btn-sm m-0"   id="tab_4">Next <i class="fa fa-caret-right"></i></a> -->
                 
               </div>
             </div>
           </div>   
         </div>





       </div> <!-- tab-content close -->
     </form>
   </div>  <!-- card-body close -->
 </div>  <!-- card shadow close -->
</div>   <!-- content-inside close -->
@endsection
@section('custom_js')
<script src="{{ url('/js') }}/validator.js"></script>
<script src="{{ url('/arogi/js') }}/rob_form.js"></script>
<script src="{{asset('arogi/js/custom.js')}}" type="text/javascript"></script>

<script>

$(document).ready(function(){
    var i=1;
    $("#Button1").click(function(e){
        e.preventDefault();
        i++;
        $("#FileUploadContainer").append('<tr id="row'+i+'"><td>File : <input type="file"  name="document_name[]" id="pic" class="form-control form-control-sm" style="width: 336px;"></td><td> Caption Name: <input type="text" name="caption_name[]" id="caption_name" class="form-control form-control-sm" style="width: 334px;margin-left: -10px;"></td><td><br><input type="checkbox" name="show_website[]" id="show_website" value="1"> Show On Website</td><td><br><button class="btn btn-danger remove" id="'+i+'">X</button></td></tr>'+"<br><br>");
    });

    $(document).on("click",'.remove',function(e){
        e.preventDefault();
        var id=$(this).attr('id');
        $("#row"+id).remove();
    });

    //for day count
      $("#txt_to").blur(function() {
        var start = $("#txt_from").val();
        var end = $("#txt_to").val();
        var days = (Date.parse(end) - Date.parse(start)) / 86400000;
        $("#txt_tot_prog_day").attr('value', days);
      });
});



$(document).ready(function(){
    var i=1;
    $("#press").click(function(e){
        e.preventDefault();
        i++;
        $("#PressUploadContainer").append('<tr id="row'+i+'"><td>File : <input type="file"  name="press_document_name[]" id="press_pic" class="form-control form-control-sm" style="width: 336px;"></td><td> Caption Name: <input type="text" name="press_caption_name[]" id="press_caption_name" class="form-control form-control-sm" style="width: 334px;margin-left: -10px;"></td><td><br><input type="checkbox" name="press_show_website[]" id="press_show_website" value="1"> Show On Website</td><td><br><button class="btn btn-danger remove" id="'+i+'">X</button></td></tr>'+"<br><br>");
    });

    $(document).on("click",'.remove',function(e){
        e.preventDefault();
        var id=$(this).attr('id');
        $("#row"+id).remove();
    });

    //for day count
      $("#txt_to").blur(function() {
        var start = $("#txt_from").val();
        var end = $("#txt_to").val();
        var days = (Date.parse(end) - Date.parse(start)) / 86400000;
        $("#txt_tot_prog_day").attr('value', days);
      });
});




function nextSaveData(tab='') {
    // console.log(tab);
   // e.preventDefault();
   if(tab=='next_tab_1'){
    $('#next_tab_1').val(tab);

  }
  if(tab =='submit_btn')
  {
      /*var value=$('#multi_langauge_select').val();
      console.log('value',value);
      return false;*/

      $('#next_tab_2').val(tab);

    }
    
    

  }




  
  

</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<script type="text/javascript">
function nextSaveData(id){

}
nextSaveData();

</script>
<style type="text/css">
  .multiselect-container {
    overflow-x:scroll;
    height: 400px;
  }
  .multiselect-container>li>a>label {
    height: auto;
  }
</style>
<script type="text/javascript">
  function alphadash(event) {
    var inputValue = event.charCode;
    if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0) && (inputValue!=45)){
      event.preventDefault();
    }
  }
</script>
@endsection