@extends('admin.layouts.layout')

@section('content')
<style>
    .main-footer{
        margin-left: 4px !important;
    }
</style>
<div class="content-wrapper">

    <link href="{{asset('arogi/css/home_standard.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('arogi/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('arogi/css/bootstrap-responsive.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('arogi/css/jquery-ui.css')}}" type="text/css" />
    <link href="{{asset('arogi/css/override_style.css')}}" rel="stylesheet" />
    <script src="{{asset('arogi/js/jquery-1.8.2.js')}}" type="text/javascript"></script>
    <script src="{{asset('arogi/js/jquery-ui.js')}}" type="text/javascript"></script>

       <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">ROB</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">ROB</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">

  @foreach($data as $list)
    <form name="Form1" method="post"   id="Form1" class="form-horizontal" autocomplete="off">
        
        @csrf







        <div class="row">
            
<LINK href="home_standard.css" type="text/css" rel="stylesheet">
<!-- <TABLE id="Table1" style="WIDTH: 100%;" cellSpacing="0" cellPadding="0" align="center" border="0">
	<TR>
		<TD width="100%">
			<div id="header">
			
                <div><img src="{{asset('arogi/images/banner_BOC.jpg')}}" border="0" alt="DAVP Banner" style="width:100%" /></div>
			</div>
		</TD>
	</TR>
</TABLE> -->

        </div>
        <div class="row form-actions text-center">
            <h4 style="margin-left:40%;">Feedback For Outreach Programs<br />Page-1
            </h4>
        </div>
        <center>
          <div class="alert alert-success" id="msg_box" style="display: none;">
            <span class="text-success"><h5 id="insert_msg"></h5></span>
          </div>
        </center>
        <input type="hidden" name="created_date" value="{{date('m/d/Y h:i:s a', time())}}">
        <div class="container " style="width: 85%">
            <div class="row" style ="te">
             <font color="red">
                 * Note : These are Mandatory fields</font>

            </div>

            <div class="row">
                <div class="span2">
                 <font color="red">*</font>    <b>Category Of Programme Activity :</b> 
                </div>
                <div class="span3">
                    <select disabled name="programme_activity"  id="ddl_pro_activity" disabled  style="width:550px;">
                    <option value="0">--Select--</option>
                    <option id="one" value="1" @if($list->programme_activity=='1') {{'selected'}}  @endif>Programme Activites(under ICOP) under DCID fund of M/O I&amp; B</option>
                    <option id="six" value="6" @if($list->programme_activity=='6') {{'selected'}}  @endif>Programme Activites(other than ICOP) under DCID fund of M/O I&amp; B</option>
                    <option id="two" value="2" @if($list->programme_activity=='2') {{'selected'}}  @endif>Programme Activites on SAP under DCID fund of M/O I&amp; B</option>
                    <option id="three" value="3" @if($list->programme_activity=='3') {{'selected'}}  @endif>Programme Activites under Establishment fund</option>
                    <option id="four" value="4" @if($list->programme_activity=='4') {{'selected'}}  @endif>Programme Activites (ICOP) for other Ministries</option>
                    <option id="five" value="5" @if($list->programme_activity=='5') {{'selected'}}  @endif>Programme Activites (Other than ICOP) for other Ministries</option>
                </select>
                <span id="ddl_pro_activity_err" style="color: red;"></span>
                </div>
            </div>

            {{-- default hiiden start --}}
            @if($list->category_icop!="")
            <div id="icop" class="row"> 
                <div class="span2">
                     <font color="red">*</font>  <span id="lbl_categ_icop" disabled style="font-weight:bold;">Category under ICOP :</span>
                </div>
                    <div class="span3">
                        <select disabled name="category_icop"  id="ddl_categ_icop">
                        <option value="">--Select--</option>
                        <option id="mi" value="MI" @if($list->category_icop=='MI') {{'selected'}}  @endif>MINI</option>
                        <option id="sm" value="SM" @if($list->category_icop=='SM') {{'selected'}}  @endif>SMALL</option>
                        <option id="me" value="ME" @if($list->category_icop=='ME') {{'selected'}}  @endif>MEDIUM</option>
                        <option id="bi" value="BI" @if($list->category_icop=='BI') {{'selected'}}  @endif>BIG </option>
                        <option id="ot" value="OT" @if($list->category_icop=='OT') {{'selected'}}  @endif>OTHER </option>
                        </select>
                    </div>              
            </div>
            @endif
            {{-- default hiiden end --}}


            <div class="row">
                 <div class="span2">
                    <font color="red">*</font>      <span id="lbl_type_act" style="font-weight:bold;">Type Of Activity :</span>
                </div>
                <div class="span3">
                    <table id="CheckBoxList1" class="chk_nowrap" border="0">
                        <tr>
                          <td><input disabled id="CheckBoxList1_0" readonly value="1" @if($list->activity_checkbox1=='1') {{'checked'}}  @endif type="checkbox" name="activity_checkbox1" /><label for="CheckBoxList1_0">FIELD COMMUNICATION</label></td>
                        </tr><tr>
                          <td><input disabled id="CheckBoxList1_1" readonly value="1" @if($list->activity_checkbox2=='1') {{'checked'}}  @endif type="checkbox" name="activity_checkbox2" /><label for="CheckBoxList1_1">FOLK COMMUNICATION</label></td>
                        </tr><tr>
                          <td><input disabled id="CheckBoxList1_2" readonly value="1" @if($list->activity_checkbox3=='1') {{'checked'}}  @endif type="checkbox" name="activity_checkbox3" /><label for="CheckBoxList1_2">EXHIBITION</label></td>
                        </tr>
                    </table>
                </div>
                <div class="span2">
                    <font color="red">*</font><span id="lbl_sop_theme" style="font-weight:bold;">Theme of Activity/Programme :</span>
                </div>
                <div class="span3">
                    <input disabled name="sop_theme" readonly type="text" id="txt_sop_theme" value="{{$list->sop_theme}}"   onkeypress="return alphaOnly(event);" placeholder="Theme of Activity/Programme" onMaxLength="100" />
                    <span id="txt_sop_theme_err" style="color: red;"></span>
                  </div>
            </div>
            <div class="row">
                <div class="span2"> <font color="red">*</font> <span id="lbl_off_type" style="font-weight:bold;">Office Type :</span></div>
                <div class="span3">
                     <select disabled name="office_type" disabled  id="ddl_off_type">
                        <option value="0">--Select--</option>
                        <option id="ot1" value="HQ" @if($list->office_type=='HQ') {{'selected'}}  @endif>ROB Headquarter</option>
                        <option id="ot2" value="FO" @if($list->office_type=='FO') {{'selected'}}  @endif>Field Outreach Bureau</option>
                      </select>
                      <span id="ddl_off_type_err" style="color: red;"></span>
                </div>
                <div class="span2"> <font color="red">*</font> <span id="lbl_rob_region" style="font-weight:bold;">Region :</span></div>
                <div class="span3">
                  <select disabled name="region_id" disabled  id="ddl_rob_region" id="ddl">
                    @if ($list->region_id=='1')
                        <option value="1" selected>Patna</option>
                    @endif
                    @if ($list->region_id=='2')
                        <option>----Select---</option>
                        <option selected value="2">SITAMARHI</option>
                        <option value="3">BHAGALPUR</option>
                        <option value="4">DARBHANGA</option>
                        <option value="5">CHAPRA</option>
                        <option value="6">MUNGER</option>
                    @endif
                    @if ($list->region_id=='3')
                        <option>----Select---</option>
                        <option  value="2">SITAMARHI</option>
                        <option selected value="3">BHAGALPUR</option>
                        <option value="4">DARBHANGA</option>
                        <option value="5">CHAPRA</option>
                        <option value="6">MUNGER</option>
                    @endif
                    @if ($list->region_id=='4')
                        <option>----Select---</option>
                        <option selected value="2">SITAMARHI</option>
                        <option value="3">BHAGALPUR</option>
                        <option selected value="4">DARBHANGA</option>
                        <option value="5">CHAPRA</option>
                        <option value="6">MUNGER</option>
                    @endif
                    @if ($list->region_id=='5')
                        <option>----Select---</option>
                        <option selected value="2">SITAMARHI</option>
                        <option value="3">BHAGALPUR</option>
                        <option value="4">DARBHANGA</option>
                        <option selected value="5">CHAPRA</option>
                        <option value="6">MUNGER</option>
                    @endif
                    @if ($list->region_id=='6')
                        <option>----Select---</option>
                        <option selected value="2">SITAMARHI</option>
                        <option value="3">BHAGALPUR</option>
                        <option value="4">DARBHANGA</option>
                        <option value="5">CHAPRA</option>
                        <option selected value="6">MUNGER</option>
                    @endif
                  </select>
                  <span id="ddl_rob_region_err" style="color: red;"></span>
                </div>
            </div>
             <div class="row">
                 <div class="span2">
                     <font color="red">*</font> <span id="lbl_area_nature" style="font-weight:bold;">Demography :</span>
                </div>
                <div class="span3">
                    <select disabled name="demography" disabled id="ddl_area_nature">
                      <option value="0">--Select--</option>
                      <option value="U" @if($list->demography=='U') {{'selected'}} @endif>URBAN</option>
                      <option value="R" @if($list->demography=='R') {{'selected'}} @endif>RURAL</option>
                    </select>
                    <span id="ddl_area_nature_err" style="color: red;"></span>
                </div>
                  <div class="span2">
                   <font color="red">*</font>   <span id="lbl_area_act" style="font-weight:bold;">Area of Activites :</span>
                </div>
                <div class="span3">
                    <select disabled name="activity_area" disabled id="ddl_area_act">
                        <option value="0">--Select--</option>
                        <option value="V" @if($list->activity_area=='V') {{'selected'}} @endif>Village level</option>
                        <option value="B" @if($list->activity_area=='B') {{'selected'}} @endif>Block level</option>
                        <option value="D" @if($list->activity_area=='D') {{'selected'}} @endif>District level</option>
                        <option value="C" @if($list->activity_area=='C') {{'selected'}} @endif>City level</option>
                    </select>
                    <span id="ddl_area_act_err" style="color: red;"></span>
                </div>
            </div>
            <div class="row">
                <div class="span2">
                    <font color="red">*</font>     <span id="lbl_no_covered" style="font-weight:bold;">Coverage :</span>
                </div>
                <div class="span3">
                    <input disabled name="coverage" value="{{$list->coverage}}" type="text" onkeypress="return onlyNumberKey(event)" maxlength="10" id="txt_no_covered" placeholder="No. of Village/Towns Covered" class="numeric" />
                    <span id="txt_no_covered_err" style="color: red;"></span>
                  </div>
                <div  class="span2"> <font color="red">*</font> <span id="lbl_vilage_name" style="font-weight:bold;">Name of Village/Town covered :</span></div>
                <div  class="span2">
                     <textarea disabled name="village_name"  rows="2" cols="20" id="txt_vilage_name" >{{$list->village_name}}</textarea>
                      <span id="txt_vilage_name_err" style="color: red;"></span>
                </div>
            </div>
            <div class="row">
                <div class="span2">
                  <font color="red">*</font>  <span id="lbl_fund_sanc" style="font-weight:bold;">Funds Allocated :</span></div>
                <div class="span3">
                    <input disabled name="allocated_funds" value="{{$list->allocated_funds}}" type="text" maxlength="10" id="txt_fund_sanc" onkeypress="return onlyNumberKey(event)" onpaste="false" placeholder="Funds Allocated" />
                    <span id="txt_fund_sanc_err" style="color:Red;"></span>
                </div>
            </div>
            <hr />
            <div class="row text-center ">
                <h4>Advance Drawn By Officer</h4>
            </div>
            <hr />


            <div class="row">
                <div class="span2">  <font color="red">*</font> <span id="lbl_officer_name" style="font-weight:bold;">Name Of The Officer:</span></div>
                <div class="span3"><input disabled name="officer_name" value="{{$list->officer_name}}" type="text" onkeypress="return alphaOnly(event);" maxlength="80" id="txt_officer_name" onpaste="false" placeholder="Officer&#39;s Name" />
                    <span id="txt_officer_name_err" style="color:Red;"></span>
                </div>
                <div class="span2">  <font color="red">*</font> <span id="lbl_off_desig" style="font-weight:bold;">Designation Of The Officer:</span></div>
                <div class="span3"><input disabled name="officer_designation" value="{{$list->officer_designation}}" type="text" onkeypress="return alphaOnly(event);" maxlength="40" id="txt_off_desig" onpaste="false" placeholder="Officer&#39;s Designation" />
                     <span id="txt_off_desig_err" style="color:Red;"></span>
                </div>
            </div>
            <div class="row">
                <div class="span2">  <font color="red">*</font> <span id="lbl_off_loc" style="font-weight:bold;">Location:</span></div>
                <div class="span3"><input disabled name="office_location" value="{{$list->office_location}}" type="text" maxlength="40" id="txt_off_loc" onkeypress="return alphaOnly(event);" onpaste="false" placeholder="Location" />
                     <span id="txt_off_loc_err" style="color:Red;"></span>
                </div>
                <div class="span2">  <font color="red">*</font> <span id="lbl_adv_amt" style="font-weight:bold;">On-Account Advance:</span></div>
                <div class="span3"><input disabled name="advance_account" value="{{$list->advance_account}}" type="text" maxlength="10" id="txt_adv_amt" onkeypress="return onlyNumberKey(event)" onpaste="false" placeholder="Advance amount drawn" /> 
                    <span id="txt_adv_amt_err" style="color:Red;"></span>
                </div>
            </div>
          
             <hr />
            <div class="row text-center ">
                <h4>Total Settlement Through PAO</h4>
            </div>
            <hr />




            <div class="row">
                <div class="span2">
                    <font color="red">*</font>   <span id="lbl_adv_pao" style="font-weight:bold;">Settlement of On-Account Advance:</span></div>
                <div class="span3">
                    <input disabled name="sattlement_account_advance" value="{{$list->sattlement_account_advance}}" type="text" maxlength="10" id="txt_adv_pao" onkeypress="return onlyNumberKey(event)" onpaste="false" placeholder="Settlement of On-Account Advance" />
                     <span id="txt_adv_pao_err" style="color:Red;"></span>
                </div>
                <div class="span2"><span id="lbl_direct_pao" style="font-weight:bold;">Direct Settlement Of Bill Through PAO :</span></div>
                <div class="span3"> <input disabled name="direct_settlement_bill_pao" value="{{$list->direct_settlement_bill_pao}}" type="text" maxlength="10" onkeypress="return onlyNumberKey(event)" id="txt_direct_pao" onpaste="false" placeholder="Direct Settlement Amount Settled By PAO" />
                     <span id="txt_direct_pao_err" style="color:Red;"></span>
                </div>
            </div>
      
            <div class="row">
                
            </div>
            <hr />
            <div class="row text-center ">
                <h4>Duration For Activity/Programme organised</h4>
            </div>
            <hr />
            <div class="row">
                <div class="span2">
                   <font color="red">*</font> <span id="lbl_from" style="font-weight:bold;">From1 :</span>
                </div>
                <div class="span3">
                    <input disabled name="duration_activity_from_date" value="{{$list->duration_activity_from_date}}" type="date" maxlength="10"  id="txt_from" class="calendar1" />
                    <span id="txt_from_err" style="color: red;"></span>
                </div>
                <div class="span2">
                   <font color="red">*</font> <span id="lbl_to" style="font-weight:bold;">To :</span>
                </div>
                <div class="span3">
                    <input disabled name="duration_activity_to_date" value="{{$list->duration_activity_to_date}}" type="date" maxlength="10"  id="txt_to" class="calendar1" />
                    <span id="txt_to_err" style="color: red;"></span>
                </div>
            </div>
            <div class="row">
                <div class="span2">
                    <span id="lbl_tot_prog_day" style="font-weight:bold;">No.Of Days:</span>
                </div>
                <div class="span3">
                    <input disabled name="no_of_days" value="{{$list->no_of_days}}" type="text" maxlength="10" id="txt_tot_prog_day" readonly class="numeric" />
                </div>
            </div>


            <div class="row">
                <div class="span2">
                </div>
            </div>
            <hr />
            <div class="row text-center ">
                <h4>Programme Activities</h4>
            </div>
            <hr />


        
            <div class="row">
                <div id="Panel1">
                  <div class="row text-left ">
                    <h4><u>Pre Event Engagement</u></h4>
                  </div>




                  <!--  for single start-->
                  @if($list->engagement_pre_event_activity=='1')
                  <div class="row" style="align-content: center;" id="engagement" id="single">
                    <div>
                      <table class="davpdgdatagrid" cellspacing="0" cellpadding="2" rules="all" border="1" id="GridView1_" style="color:Black;background-color:LightGoldenrodYellow;border-color:Tan;border-width:1px;border-style:solid;font-size:15px;border-collapse:collapse;">
                        <tr>
                          <th scope="col">Sr</th>
                          <th scope="col">PRE EVENT ACTIVITY</th>
                          <th scope="col">REMARKS</th>
                        </tr>
                        <tr>
                          <td> 1 </td>
                          <td>
                            <input disabled id="GridView1_ctl02_ch_pre_event_activity_single" @if($list->engagement_pre_event_activity=='1') {{'checked'}} @endif value="1" type="checkbox" name="engagement_pre_event_activity"  />
                            <span id="GridView1_ctl02_lbl_pre_event_activity_single">ENGAGEMENT</span>
                          </td>
                          <td valign="middle" id="single">
                            {{-- <textarea name="GridView1$ctl02$txt_prev" rows="2" cols="20" id="GridView1_ctl02_txt_prev_single" style="height:50px;width:450px;resize: none;display:none;"> --}}
                              <textarea name="engagement_txt_pre_event" rows="2" cols="20" id="GridView1_ctl02_txt_prev_single" style="height:50px;width:450px;resize: none;"> {{$list->engagement_txt_pre_event}} </textarea>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>                 
                  @endif
                  <!--  for single end-->


                  {{-- for 5tab start --}}
                  <!-- for 5tab start -->
                  @if($list->nukkad_natak_pre_event_activity=='1' || $list->public_meeting_pre_event_activity=='1' || $list->public_announcement_pre_event_activity=='1' || $list->distribution_pamphlets_pre_event_activity=='' || $list->social_media_pre_event_activity==1)
                  <div class="row five"  style="align-content: center;  " id="five">
                    <div>
                      <table class="davpdgdatagrid" id="GridView1" cellspacing="0" cellpadding="2" rules="all" border="1"  style="color:Black;background-color:LightGoldenrodYellow;border-color:Tan;border-width:1px;border-style:solid;font-size:15px;border-collapse:collapse;">
                        <tr >
                          <th scope="col">Sr</th>
                          <th scope="col">PRE EVENT     ACTIVITY</th>
                          <th scope="col">REMARKS</th>
                        </tr>
                        <tr>
                          <td> 1 </td>
                          <td>
                            <input disabled id="GridView1_ctl02_ch_pre_event_activity1" value="1" type="checkbox" name="nukkad_natak_pre_event_activity" @if($list->nukkad_natak_pre_event_activity=='1') {{'checked'}} @endif />
                            <span id="GridView1_ctl02_lbl_pre_event_activity1">NUKKAD NATAK</span>
                          </td>
                          <td valign="middle">
                            @if($list->nukkad_natak_pre_event_activity=='1')
                            <textarea name="nukkad_natak_txt_pre_event" rows="2" cols="20" id="GridView1_ctl02_txt_prev1" style="height:50px;width:450px;resize: none;"> @if($list->nukkad_natak_txt_pre_event!='NA') {{$list->nukkad_natak_txt_pre_event}} @endif </textarea>
                            @endif
                        </td>
                        </tr>
                        <tr style="background-color:PaleGoldenrod;">
                          <td> 2 </td>
                          <td>
                            <input disabled id="GridView1_ctl03_ch_pre_event_activity1" value="1" type="checkbox" name="public_meeting_pre_event_activity"  @if($list->public_meeting_pre_event_activity=='1') {{'checked'}} @endif />
                            <span id="GridView1_ctl03_lbl_pre_event_activity1">PUBLIC MEETING</span>
                          </td>
                          <td valign="middle">
                            @if($list->public_meeting_pre_event_activity=='1')
                            <textarea name="public_meeting_txt_pre_event" rows="2" cols="20" id="GridView1_ctl03_txt_prev1" style="height:50px;width:450px;resize: none;"> @if($list->public_meeting_txt_pre_event!='NA') {{$list->public_meeting_txt_pre_event}} @endif </textarea>
                            @endif
                        </td>
                        </tr>
                        <tr>
                          <td> 3 </td>
                          <td>
                            <input disabled id="GridView1_ctl04_ch_pre_event_activity1" value="1" type="checkbox" name="public_announcement_pre_event_activity" @if($list->public_announcement_pre_event_activity=='1') {{'checked'}} @endif  />
                            <span id="GridView1_ctl04_lbl_pre_event_activity1">PUBLIC ANNOUNCEMENTS</span>
                          </td>
                          <td valign="middle">
                            @if($list->public_announcement_pre_event_activity=='1')
                            <textarea name="public_announcement_txt_pre_event" rows="2" cols="20" id="GridView1_ctl04_txt_prev1" style="height:50px;width:450px;resize: none;"> @if($list->public_announcement_txt_pre_event!='NA') {{$list->public_announcement_txt_pre_event}} @endif </textarea>
                            @endif
                        </td>
                        </tr>
                        <tr style="background-color:PaleGoldenrod;">
                          <td> 4 </td>
                          <td>
                            <input disabled id="GridView1_ctl05_ch_pre_event_activity1" value="1" type="checkbox" name="distribution_pamphlets_pre_event_activity" @if($list->distribution_pamphlets_pre_event_activity=='1') {{'checked'}} @endif />
                            <span id="GridView1_ctl05_lbl_pre_event_activity1">DISTRIBUTION OF PAMPHLETS</span>
                          </td>
                          <td valign="middle">
                            @if($list->distribution_pamphlets_pre_event_activity=='1')
                            <textarea name="distribution_pamphlets_txt_pre_event" rows="2" cols="20" id="GridView1_ctl05_txt_prev1" style="height:50px;width:450px;resize: none;"> @if($list->distribution_pamphlets_txt_pre_event!='NA') {{$list->distribution_pamphlets_txt_pre_event}} @endif </textarea>
                            @endif
                        </td>
                        </tr>
                        <tr >
                          <td> 5 </td>
                          <td>
                            <input disabled id="GridView1_ctl06_ch_pre_event_activity1" value="1" type="checkbox" name="social_media_pre_event_activity" @if($list->social_media_pre_event_activity=='1') {{'checked'}} @endif  />
                            <span id="GridView1_ctl06_lbl_pre_event_activity1">SOCIAL MEDIA CAMPAIGN</span>
                          </td>
                          <td valign="middle">
                            @if($list->social_media_pre_event_activity=='1')
                            <textarea name="social_media_txt_pre_event" rows="2" cols="20" id="GridView1_ctl06_txt_prev1" style="height:50px;width:450px;resize: none;"> @if($list->social_media_txt_pre_event!='NA') {{$list->social_media_txt_pre_event}} @endif </textarea>
                            @endif
                        </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  @endif
                  <!-- for 5tab end  -->
                  {{-- for 5tab end --}}















                  {{-- for 9tab start --}}
                  <!--  for 9tab start -->
                  @if($list->nukkad_natak1_pre_event_activity=='1' || $list->public_meeting1_pre_event_activity=='1' || $list->public_announcement1_pre_event_activity=='1' || $list->distribution_pamphlets1_pre_event_activity=='1' || $list->social_media_campaign1_pre_event=='1' || $list->public_rally_pre_event_activity=='1' || $list->media_briefing_pre_event_activity=='1' || $list->dd_air_curtain_pre_activity=='1'  || $list->social_media_campaign_pre_event=='1')
                  <div class="row"  style="align-content: center; " id="nine">
                    <div>
                      <table class="davpdgdatagrid" id="GridView1" cellspacing="0" cellpadding="2" rules="all" border="1"  style="color:Black;background-color:LightGoldenrodYellow;border-color:Tan;border-width:1px;border-style:solid;font-size:15px;border-collapse:collapse;">
                        <tr >
                          <th scope="col">Sr</th>
                          <th scope="col">PRE EVENT     ACTIVITY</th>
                          <th scope="col">REMARKS</th>
                        </tr>
                        <tr>
                          <td> 1 </td>
                          <td>
                            <input disabled id="GridView1_ctl02_ch_pre_event_activity9" value="1" type="checkbox" name="nukkad_natak1_pre_event_activity" @if($list->nukkad_natak1_pre_event_activity=='1') {{'checked'}} @endif />
                            <span id="GridView1_ctl02_lbl_pre_event_activity">NUKKAD NATAK</span>
                          </td>
                          <td valign="middle">
                            @if($list->nukkad_natak1_pre_event_activity=='1')
                            <textarea name="nukkad_natak1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl02_txt_prev9" style="height:50px;width:450px;resize: none;">@if($list->nukkad_natak1_txt_pre_event!='NA') {{$list->nukkad_natak1_txt_pre_event}} @endif </textarea>
                            @endif
                        </td>
                        </tr>
                        <tr style="background-color:PaleGoldenrod;">
                          <td> 2 </td>
                          <td>
                            <input disabled id="GridView1_ctl03_ch_pre_event_activity9" value="1" type="checkbox" name="public_meeting1_pre_event_activity" @if($list->public_meeting1_pre_event_activity=='1') {{'checked'}} @endif />
                            <span id="GridView1_ctl03_lbl_pre_event_activity">PUBLIC MEETING</span>
                          </td>
                          <td valign="middle">
                            @if($list->public_meeting1_pre_event_activity=='1')
                            <textarea name="public_meeting1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl03_txt_prev9" style="height:50px;width:450px;resize: none;"> @if($list->public_meeting1_txt_pre_event!='NA') {{$list->public_meeting1_txt_pre_event}} @endif</textarea>
                            @endif
                        </td>
                        </tr>
                        <tr>
                          <td> 3 </td>
                          <td>
                            <input disabled id="GridView1_ctl04_ch_pre_event_activity9" value="1" type="checkbox" name="public_announcement1_pre_event_activity" @if($list->public_announcement1_pre_event_activity=='1') {{'checked'}} @endif />
                            <span id="GridView1_ctl04_lbl_pre_event_activity">PUBLIC ANNOUNCEMENTS</span>
                          </td>
                          <td valign="middle">
                            @if($list->public_announcement1_pre_event_activity=='1')
                            <textarea name="public_announcement1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl04_txt_prev9" style="height:50px;width:450px;resize: none;"> @if($list->public_announcement1_txt_pre_event!='NA') {{$list->public_announcement1_txt_pre_event}} @endif </textarea>
                            @endif
                        </td>
                        </tr>
                        <tr style="background-color:PaleGoldenrod;">
                          <td> 4 </td>
                          <td>
                            <input disabled id="GridView1_ctl05_ch_pre_event_activity9" value="1" type="checkbox" name="distribution_pamphlets1_pre_event_activity" @if($list->distribution_pamphlets1_pre_event_activity=='1') {{'checked'}} @endif />
                            <span id="GridView1_ctl05_lbl_pre_event_activity">DISTRIBUTION OF PAMPHLETS</span>
                          </td>
                          <td valign="middle">
                            @if($list->distribution_pamphlets1_pre_event_activity=='1')
                            <textarea name="distribution_pamphlets1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl05_txt_prev9" style="height:50px;width:450px;resize: none;"> @if($list->distribution_pamphlets1_txt_pre_event!='NA') {{$list->distribution_pamphlets1_txt_pre_event}} @endif </textarea>
                            @endif
                        </td>
                        </tr>
                        <tr >
                          <td> 5 </td>
                          <td>
                            <input disabled id="GridView1_ctl06_ch_pre_event_activity9" value="1" type="checkbox" name="social_media_campaign1_pre_event" @if($list->social_media_campaign1_pre_event=='1') {{'checked'}} @endif  />
                            <span id="GridView1_ctl06_lbl_pre_event_activity">SOCIAL MEDIA CAMPAIGN</span>
                          </td>
                          <td valign="middle">
                            @if($list->social_media_campaign1_pre_event=='1')
                            <textarea name="social_media_campaign1_txt_pre_event" rows="2" cols="20" id="GridView1_ctl06_txt_prev9" style="height:50px;width:450px;resize: none;"> @if($list->social_media_campaign1_txt_pre_event!='NA') {{$list->social_media_campaign1_txt_pre_event}} @endif </textarea>
                            @endif
                        </td>
                        </tr>

                        <tr style="background-color:PaleGoldenrod;">
                          <td> 6 </td>
                          <td>
                            <input disabled id="GridView1_ctl07_ch_pre_event_activity9" value="1" type="checkbox" name="public_rally_pre_event_activity" @if($list->public_rally_pre_event_activity=='1') {{'checked'}} @endif  />
                            <span id="GridView1_ctl07_lbl_pre_event_activity">PUBLIC RALLY IN NEARBY VILLAGE/TOWNS</span>
                          </td>
                          <td valign="middle">
                            @if($list->public_rally_pre_event_activity=='1')
                            <textarea name="public_rally_txt_pre_event" rows="2" cols="20" id="GridView1_ctl07_txt_prev9" style="height:50px;width:450px;resize: none;"> @if($list->public_rally_txt_pre_event!='NA') {{$list->public_rally_txt_pre_event}} @endif </textarea>
                            @endif
                        </td>
                        </tr>
                        <tr >
                          <td> 7 </td>
                          <td>
                            <input disabled id="GridView1_ctl08_ch_pre_event_activity9" value="1" type="checkbox" name="media_briefing_pre_event_activity" @if($list->media_briefing_pre_event_activity=='1') {{'checked'}} @endif />
                            <span id="GridView1_ctl08_lbl_pre_event_activity">MEDIA BRIEFING</span>
                          </td>
                          <td valign="middle">
                            @if($list->media_briefing_pre_event_activity=='1')
                            <textarea name="media_briefing_txt_pre_event" rows="2" cols="20" id="GridView1_ctl08_txt_prev9" style="height:50px;width:450px;resize: none;"> @if($list->media_briefing_txt_pre_event!='NA') {{$list->media_briefing_txt_pre_event}} @endif </textarea>
                            @endif
                        </td>
                        </tr>
                        <tr style="background-color:PaleGoldenrod;">
                          <td> 8 </td>
                          <td>
                            <input disabled id="GridView1_ctl09_ch_pre_event_activity9" value="1" type="checkbox" name="dd_air_curtain_pre_activity" @if($list->dd_air_curtain_pre_activity=='1') {{'checked'}} @endif  />
                            <span id="GridView1_ctl09_lbl_pre_event_activity">DD/AIR SCROLL/CURTAIN RAISERS</span>
                          </td>
                          <td valign="middle">
                            @if($list->dd_air_curtain_pre_activity=='1')
                            <textarea name="dd_air_curtain_txt_pre_activity" rows="2" cols="20" id="GridView1_ctl09_txt_prev9" style="height:50px;width:450px;resize: none;"> @if($list->dd_air_curtain_txt_pre_activity!='NA') {{$list->dd_air_curtain_txt_pre_activity}} @endif </textarea>
                            @endif
                        </td>
                        </tr>
                        <tr>
                          <td> 9 </td>
                          <td>
                            <input disabled id="GridView1_ctl10_ch_pre_event_activity9" value="1" type="checkbox" name="social_media_campaign_pre_event" @if($list->social_media_campaign_pre_event=='1') {{'checked'}} @endif />
                            <span id="GridView1_ctl10_lbl_pre_event_activity">SOCIAL MEDIA CAMPAIGN</span>
                          </td>
                          <td valign="middle">
                            @if($list->social_media_campaign_pre_event=='1')
                            <textarea name="social_media_campaign_txt_pre_event" rows="2" cols="20" id="GridView1_ctl10_txt_prev9" style="height:50px;width:450px;resize: none;"> @if($list->social_media_campaign_txt_pre_event!='NA') {{$list->social_media_campaign_txt_pre_event}} @endif </textarea>
                            @endif
                        </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  @endif
                  <!-- for 9tab end -->
                  {{-- for 9tab end --}}

                </div>
                @if($list->programme_activity!='')
                <div id="fixed" style="display1: none1;">
                <div id="panel2">
                  <div class="row text-left ">
                    <h4>
                      <u>Main Programmes</u>
                    </h4>
                  </div>
                  <div class="row">
                    <div>
                      <table class="davpdgdatagrid" cellspacing="0" cellpadding="2" rules="all" border="1" id="GridView2" style="color:Black;border-color:Tan;border-width:1px;border-style:solid;font-size:15px;border-collapse:collapse;">
                        <tr>
                          <th scope="col">Sr</th>
                          <th scope="col">COMPONENT</th>
                          <th scope="col">Activity/Details</th>
                          <th scope="col">No of Programme</th>
                          <th scope="col">REMARKS</th>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 1 </td>
                          <td>
                            <span id="GridView2_ctl02_lbl_main_event_activity">MOBILISATION</span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl02_ch_main_event_activity" value="1" type="checkbox" @if($list->mobile_station_main_event_activity=='1') {{'checked'}} @endif name="mobile_station_main_event_activity"  />
                            <span id="GridView2_ctl02_lbl_main_event_desc">SPORTS COMPETITION/YOGA SESSION/SELF DEFENCE CAMPS</span>
                          </td>
                          <td valign="middle">
                            <input name="mobile_station_main_no_program" @if($list->mobile_station_main_no_program!='NA') value="{{$list->mobile_station_main_no_program}}" @endif type="text" maxlength="5" id="GridView2_ctl02_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea name="mobile_station_main_remark" rows="2" cols="20" id="GridView2_ctl02_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->mobile_station_main_remark!='NA') {{$list->mobile_station_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 2 </td>
                          <td>
                            <span id="GridView2_ctl03_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl03_ch_main_event_activity" value="1" type="checkbox" name="painting_poetry_rangoli_main_activity" @if($list->painting_poetry_rangoli_main_activity=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl03_lbl_main_event_desc">PAINTING/POETRY/RANGOLI COMPETITION</span>
                          </td>
                          <td valign="middle">
                            <input name="painting_poetry_rangoli_main_no_program" @if($list->painting_poetry_rangoli_main_no_program!='NA') value="{{$list->painting_poetry_rangoli_main_no_program}}" @endif type="text" maxlength="5" id="GridView2_ctl03_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none"  />
                          </td>
                          <td valign="middle">
                            <textarea name="painting_poetry_rangoli_main_remark" rows="2" cols="20" id="GridView2_ctl03_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->painting_poetry_rangoli_main_remark!='NA') {{$list->painting_poetry_rangoli_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 3 </td>
                          <td>
                            <span id="GridView2_ctl04_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl04_ch_main_event_activity" value="1" type="checkbox" name="debate_seminar_symposium_main_event"  @if($list->debate_seminar_symposium_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl04_lbl_main_event_desc">DEBATE/SEMINAR/SYMPOSIUM</span>
                          </td>
                          <td valign="middle">
                            <input name="debate_seminar_symposium_main_no_program" @if($list->debate_seminar_symposium_main_no_program!='NA') value='{{$list->debate_seminar_symposium_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl04_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea name="debate_seminar_symposium_main_remark" rows="2" cols="20" id="GridView2_ctl04_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->debate_seminar_symposium_main_remark!='NA') {{$list->debate_seminar_symposium_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 4 </td>
                          <td>
                            <span id="GridView2_ctl05_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl05_ch_main_event_activity" value="1" type="checkbox" name="testimonials_main_event" @if($list->testimonials_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl05_lbl_main_event_desc">TESTIMONIALS</span>
                          </td>
                          <td valign="middle">
                            <input name="testimonials_main_no_program" @if($list->testimonials_main_no_program!='NA') value='{{$list->testimonials_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl05_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea name="testimonials_main_remark" rows="2" cols="20" id="GridView2_ctl05_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->testimonials_main_remark!='NA') {{$list->testimonials_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 5 </td>
                          <td>
                            <span id="GridView2_ctl06_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl06_ch_main_event_activity" value="1" type="checkbox" name="felicitiation_main_event" @if($list->felicitiation_main_event=='1') {{'checked'}} @endif  />
                            <span id="GridView2_ctl06_lbl_main_event_desc">FELICITIATION OF LOCAL PROGRESSIVE ICONS</span>
                          </td>
                          <td valign="middle">
                            <input name="felicitiation_main_no_program" @if($list->felicitiation_main_no_program!='NA') value='{{$list->felicitiation_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl06_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea name="felicitiation_main_remark" rows="2" cols="20" id="GridView2_ctl06_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->felicitiation_main_remark!='NA') {{$list->felicitiation_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 6 </td>
                          <td>
                            <span id="GridView2_ctl07_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl07_ch_main_event_activity" value="1" type="checkbox" name="identifying_opinion_main_event" @if($list->identifying_opinion_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl07_lbl_main_event_desc">IDENTIFYING OPINION LEADERS</span>
                          </td>
                          <td valign="middle">
                            <input name="identifying_opinion_main_no_program" @if($list->identifying_opinion_main_no_program!='NA') value='{{$list->identifying_opinion_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl07_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea name="identifying_opinion_main_remark" rows="2" cols="20" id="GridView2_ctl07_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->identifying_opinion_main_remark!='NA') {{$list->identifying_opinion_main_remark}} @endif </textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 7 </td>
                          <td>
                            <span id="GridView2_ctl08_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl08_ch_main_event_activity" value="1" type="checkbox" name="expert_lectures_main_event" @if($list->expert_lectures_main_event=='1') {{'checked'}} @endif  />
                            <span id="GridView2_ctl08_lbl_main_event_desc">EXPERT LECTURES</span>
                          </td>
                          <td valign="middle">
                            <input name="expert_lectures_main_no_program" @if($list->expert_lectures_main_no_program!='NA') value='{{$list->expert_lectures_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl08_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea name="expert_lectures_main_remark" rows="2" cols="20" id="GridView2_ctl08_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->expert_lectures_main_remark!='NA') {{$list->expert_lectures_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 8 </td>
                          <td>
                            <span id="GridView2_ctl09_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl09_ch_main_event_activity" value="1" type="checkbox" name="workshop_main_event" @if($list->workshop_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl09_lbl_main_event_desc">WORKSHOPS</span>
                          </td>
                          <td valign="middle">
                            <input disabled name="workshop_main_no_program" @if($list->workshop_main_no_program!='NA') value="{{$list->workshop_main_no_program}}" @endif type="text" maxlength="5" id="GridView2_ctl09_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="workshop_main_remark" rows="2" cols="20" id="GridView2_ctl09_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->workshop_main_remark!='NA') {{$list->workshop_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 9 </td>
                          <td>
                            <span id="GridView2_ctl10_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl10_ch_main_event_activity" value="1" type="checkbox" name="media_station_workshop_main_event" @if($list->media_station_workshop_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl10_lbl_main_event_desc">MEDIA SENSITIONS WORKSHOPS</span>
                          </td>
                          <td valign="middle">
                            <input  name="media_station_workshop_main_no_programm" @if($list->media_station_workshop_main_no_programm!='NA') value='{{$list->media_station_workshop_main_no_programm}}' @endif type="text" maxlength="5" id="GridView2_ctl10_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea disabled name="media_station_workshop_main_remark" rows="2" cols="20" id="GridView2_ctl10_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->media_station_workshop_main_remark!='NA') {{$list->media_station_workshop_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 10 </td>
                          <td>
                            <span id="GridView2_ctl11_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl11_ch_main_event_activity" value="1" type="checkbox" name="quiz_competitions_main_event" @if($list->quiz_competitions_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl11_lbl_main_event_desc">QUIZ COMPETITIONS ON GOVT SCHEMES</span>
                          </td>
                          <td valign="middle">
                            <input disabled name="quiz_competitions_main_no_program" @if($list->quiz_competitions_main_no_program!='NA') value='{{$list->quiz_competitions_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl11_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="quiz_competitions_main_remark" rows="2" cols="20" id="GridView2_ctl11_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->quiz_competitions_main_remark!='NA') {{$list->quiz_competitions_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 11 </td>
                          <td>
                            <span id="GridView2_ctl12_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl12_ch_main_event_activity" value="1" type="checkbox" name="public_meeting_main_event" @if($list->public_meeting_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl12_lbl_main_event_desc">PUBLIC MEETINGS</span>
                          </td>
                          <td valign="middle">
                            <input  name="public_meeting_main_no_program" @if($list->public_meeting_main_no_program!='NA') value='{{$list->public_meeting_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl12_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="public_meeting_main_remark" rows="2" cols="20" id="GridView2_ctl12_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->public_meeting_main_remark!='NA') {{$list->public_meeting_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:PaleGoldenrod;">
                          <td> 12 </td>
                          <td>
                            <span id="GridView2_ctl13_lbl_main_event_activity">EXHIBITIONS</span>
                          </td>
                          <td valign="middle">
                            <input disabled  id="GridView2_ctl13_ch_main_event_activity" value="1" type="checkbox" name="multimedia_component_main_event" @if($list->multimedia_component_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl13_lbl_main_event_desc">MULTIMEDIA COMPONENT</span>
                          </td>
                          <td valign="middle">
                            <input  name="multimedia_component_main_no_program" @if($list->multimedia_component_main_no_program!='NA') value='{{$list->multimedia_component_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl13_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="multimedia_component_main_remark" rows="2" cols="20" id="GridView2_ctl13_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->multimedia_component_main_remark!='NA') {{$list->multimedia_component_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 13 </td>
                          <td>
                            <span id="GridView2_ctl14_lbl_main_event_activity">CULTURAL PERFORMANCE/FOLK COMMUNICATION</span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl14_ch_main_event_activity" value="1" type="checkbox" name="nukkad_natak_main_event" @if($list->nukkad_natak_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl14_lbl_main_event_desc">NUKKAD NATAK</span>
                          </td>
                          <td valign="middle">
                            <input  name="nukkad_natak_main_no_program" @if($list->nukkad_natak_main_no_program!='NA') value='{{$list->nukkad_natak_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl14_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="nukkad_natak_main_remark" rows="2" cols="20" id="GridView2_ctl14_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->nukkad_natak_main_remark!='NA') {{$list->nukkad_natak_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 14 </td>
                          <td>
                            <span id="GridView2_ctl15_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl15_ch_main_event_activity" value="1" type="checkbox" name="property_show_main_event" @if($list->property_show_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl15_lbl_main_event_desc">PUPPETRY SHOW</span>
                          </td>
                          <td valign="middle">
                            <input  name="property_show_main_no_program" @if($list->property_show_main_no_program!='NA') value='{{$list->property_show_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl15_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="property_show_main_remark" rows="2" cols="20" id="GridView2_ctl15_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->property_show_main_remark!='NA') {{$list->property_show_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 15 </td>
                          <td>
                            <span id="GridView2_ctl16_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl16_ch_main_event_activity" value="1" type="checkbox" name="megic_show_main_event" @if($list->megic_show_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl16_lbl_main_event_desc">MAGIC SHOW</span>
                          </td>
                          <td valign="middle">
                            <input  name="megic_show_main_no_program" @if($list->megic_show_main_no_program!='NA') value='{{$list->megic_show_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl16_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="megic_show_main_remark" rows="2" cols="20" id="GridView2_ctl16_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->megic_show_main_remark!='NA') {{$list->megic_show_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 16 </td>
                          <td>
                            <span id="GridView2_ctl17_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl17_ch_main_event_activity" value="1" type="checkbox" name="folk_song_main_event" @if($list->folk_song_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl17_lbl_main_event_desc">FOLK RECITAL/SONGS</span>
                          </td>
                          <td valign="middle">
                            <input  name="folk_song_main_no_program" @if($list->folk_song_main_no_program!='NA') value='{{$list->folk_song_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl17_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="folk_song_main_remark" rows="2" cols="20" id="GridView2_ctl17_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->folk_song_main_remark!='NA') {{$list->folk_song_main_remark}} @endif </textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 17 </td>
                          <td>
                            <span id="GridView2_ctl18_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl18_ch_main_event_activity" value="1" type="checkbox" name="folk_dance_main_event" @if($list->folk_dance_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl18_lbl_main_event_desc">FOLK DANCE</span>
                          </td>
                          <td valign="middle">
                            <input  name="folk_dance_main_no_program" @if($list->folk_dance_main_no_program!='NA') value='{{$list->folk_dance_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl18_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="folk_dance_main_remark" rows="2" cols="20" id="GridView2_ctl18_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->folk_dance_main_remark!='NA') {{$list->folk_dance_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 18 </td>
                          <td>
                            <span id="GridView2_ctl19_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl19_ch_main_event_activity" value="1" type="checkbox" name="folk_drama_main_event" @if($list->folk_drama_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl19_lbl_main_event_desc">FOLK DRAMA</span>
                          </td>
                          <td valign="middle">
                            <input  name="folk_drama_main_no_program" @if($list->folk_drama_main_no_program!='NA') value='{{$list->folk_drama_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl19_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="folk_drama_main_remark" rows="2" cols="20" id="GridView2_ctl19_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->folk_drama_main_remark!='NA') {{$list->folk_drama_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:PaleGoldenrod;">
                          <td> 19 </td>
                          <td>
                            <span id="GridView2_ctl20_lbl_main_event_activity">AV MEDIUM</span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl20_ch_main_event_activity" value="1" type="checkbox" name="av_medium_main_event" @if($list->av_medium_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl20_lbl_main_event_desc">FILM SHOW</span>
                          </td>
                          <td valign="middle">
                            <input  name="av_medium_main_no_program" @if($list->av_medium_main_no_program!='NA') value='{{$list->av_medium_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl20_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="av_medium_main_remark" rows="2" cols="20" id="GridView2_ctl20_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none"> @if($list->av_medium_main_remark!='NA') {{$list->av_medium_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:PaleGoldenrod;">
                          <td> 20 </td>
                          <td>
                            <span id="GridView2_ctl21_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl21_ch_main_event_activity" value="1" type="checkbox" name="snippet_air_dd_main_event" @if($list->snippet_air_dd_main_event=='1') {{'checked'}} @endif  />
                            <span id="GridView2_ctl21_lbl_main_event_desc">SNIPPET OF AIR/DD</span>
                          </td>
                          <td valign="middle">
                            <input  name="snippet_air_dd_main_no_program" @if($list->snippet_air_dd_main_no_program!='NA') value='{{$list->snippet_air_dd_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl21_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="snippet_air_dd_main_remark" rows="2" cols="20" id="GridView2_ctl21_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->snippet_air_dd_main_remark!='NA') {{$list->snippet_air_dd_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:PaleGoldenrod;">
                          <td> 21 </td>
                          <td>
                            <span id="GridView2_ctl22_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl22_ch_main_event_activity" value="1" type="checkbox" name="other_av_meterial_main_event" @if($list->other_av_meterial_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl22_lbl_main_event_desc">OTHER AV MATERIAL</span>
                          </td>
                          <td valign="middle">
                            <input  name="other_av_meterial_main_no_program" @if($list->other_av_meterial_main_no_program!='NA') value='{{$list->other_av_meterial_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl22_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="other_av_meterial_main_remark" rows="2" cols="20" id="GridView2_ctl22_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->other_av_meterial_main_remark!='NA') {{$list->other_av_meterial_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:LightGoldenrodYellow;">
                          <td> 22 </td>
                          <td>
                            <span id="GridView2_ctl23_lbl_main_event_activity">FACILIATION THROUGH DEPARTMENTAL STALL</span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl23_ch_main_event_activity" value="1" type="checkbox" name="ten_twelve_stalls_main_event" @if($list->ten_twelve_stalls_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl23_lbl_main_event_desc">10-12 STALLS</span>
                          </td>
                          <td valign="middle">
                            <input  name="ten_twelve_stalls_main_no_program" @if($list->ten_twelve_stalls_main_no_program!='NA') value='{{$list->ten_twelve_stalls_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl23_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea name="ten_twelve_stalls_main_remark" rows="2" cols="20" id="GridView2_ctl23_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->ten_twelve_stalls_main_remark!='NA') {{$list->ten_twelve_stalls_main_remark}} @endif </textarea>
                          </td>
                        </tr>
                        <tr style="background-color:PaleGoldenrod;">
                          <td> 23 </td>
                          <td>
                            <span id="GridView2_ctl24_lbl_main_event_activity">DISTRUBUTION OF GOVT BENEFITS</span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl24_ch_main_event_activity" value="1" type="checkbox" name="ujwala_gas_main_event" @if($list->ujwala_gas_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl24_lbl_main_event_desc">DISTRUBUTION OF UJWALA GAS CONNECTIONS</span>
                          </td>
                          <td valign="middle">
                            <input  name="ujwala_gas_main_no_program" @if($list->ujwala_gas_main_no_program!='NA') value='{{$list->ujwala_gas_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl24_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="ujwala_gas_main_remark" rows="2" cols="20" id="GridView2_ctl24_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->ujwala_gas_main_remark!='NA') {{$list->ujwala_gas_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:PaleGoldenrod;">
                          <td> 24 </td>
                          <td>
                            <span id="GridView2_ctl25_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl25_ch_main_event_activity" value="1" type="checkbox" name="mudra_loans_main_event" @if($list->mudra_loans_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl25_lbl_main_event_desc">DISTRUBUTION OF MUDRA LOANS</span>
                          </td>
                          <td valign="middle">
                            <input  name="mudra_loans_main_no_program" @if($list->mudra_loans_main_no_program!='NA') value='{{$list->mudra_loans_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl25_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="mudra_loans_main_remark" rows="2" cols="20" id="GridView2_ctl25_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->mudra_loans_main_remark!='NA') {{$list->mudra_loans_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:PaleGoldenrod;">
                          <td> 25 </td>
                          <td>
                            <span id="GridView2_ctl26_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl26_ch_main_event_activity" value="1" type="checkbox" name="kisian_credits_card_main_event" @if($list->kisian_credits_card_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl26_lbl_main_event_desc">DISTRUBUTION OF KISAN CREDITS CARDS</span>
                          </td>
                          <td valign="middle">
                            <input  name="kisian_credits_card_main_no_program" @if($list->kisian_credits_card_main_no_program!='NA') value='{{$list->kisian_credits_card_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl26_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="kisian_credits_card_main_remark" rows="2" cols="20" id="GridView2_ctl26_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->kisian_credits_card_main_remark!='NA') {{$list->kisian_credits_card_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:PaleGoldenrod;">
                          <td> 26 </td>
                          <td>
                            <span id="GridView2_ctl27_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl27_ch_main_event_activity" value="1" type="checkbox" name="opening_account_main_event" @if($list->opening_account_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl27_lbl_main_event_desc">DISTRUBUTION OF OPENING OF ACCOUNTS</span>
                          </td>
                          <td valign="middle">
                            <input  name="opening_account_main_no_program" @if($list->opening_account_main_no_program!='NA') value='{{$list->opening_account_main_no_program}}' @endif type="text" maxlength="5" id="GridView2_ctl27_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="opening_account_main_remark" rows="2" cols="20" id="GridView2_ctl27_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none">@if($list->opening_account_main_remark!='NA') {{$list->opening_account_main_remark}} @endif</textarea>
                          </td>
                        </tr>
                        <tr style="background-color:PaleGoldenrod;">
                          <td> 27 </td>
                          <td>
                            <span id="GridView2_ctl28_lbl_main_event_activity"></span>
                          </td>
                          <td valign="middle">
                            <input disabled id="GridView2_ctl28_ch_main_event_activity" value="1" type="checkbox" name="other_govt_scheme_main_event" @if($list->other_govt_scheme_main_event=='1') {{'checked'}} @endif />
                            <span id="GridView2_ctl28_lbl_main_event_desc">DISTRUBUTION OF ANY OTHER GOVT SCHEME</span>
                          </td>
                          <td valign="middle">
                            <input  name="other_govt_scheme_main_no_program" @if($list->other_govt_scheme_main_no_program!='NA') value='{{$list->other_govt_scheme_main_no_program}}' @endif  type="text" maxlength="5" id="GridView2_ctl28_txt_main_no_program" disabled="disabled" class="numeric" style="height:20px;width:90px;resize: none" />
                          </td>
                          <td valign="middle">
                            <textarea  name="other_govt_scheme_main_remark"  rows="2" cols="20" id="GridView2_ctl28_txt_main_remarl" disabled="disabled" style="height:50px;width:410px;resize: none"> @if($list->other_govt_scheme_main_remark!='NA') {{$list->other_govt_scheme_main_remark}} @endif </textarea>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div id="panel3">
                  <div class="row text-left ">
                    <h4>
                      <u>Post Event</u>
                    </h4>
                  </div>
                  <div class="row">
                    <div class="span2">
                      <span id="Label1" style="font-weight:bold;">Social Media Campaign:</span>
                    </div>
                    <div class="span3">
                      <table>
                        <tr>
                          <td colspan="2">
                            <span class="chk_nowrap">
                              <input id="chk_success" disabled type="checkbox" value="1" name="success_stories" @if($list->success_stories=='1') {{'checked'}} @endif />
                              <label for="chk_success">Success Stories</label>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <span class="chk_nowrap">
                              <input id="chk_local" disabled type="checkbox" value="1" name="local_input_about_program" @if($list->local_input_about_program=='1') {{'checked'}} @endif />
                              <label for="chk_local">Local inputs about the programme</label>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <span class="chk_nowrap">
                              <input id="chk_fb" disabled type="checkbox" value="1" name="fb_twitter_instagram" @if($list->fb_twitter_instagram=='1') {{'checked'}} @endif />
                              <label for="chk_fb">Facebook/Twitter/Instagram</label>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <span class="chk_nowrap">
                              <input id="chk_web" disabled type="checkbox" value="1" name="web_streaming" @if($list->web_streaming=='1') {{'checked'}} @endif />
                              <label for="chk_web">Web Streaming</label>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <span class="chk_nowrap">
                              <input id="chk_live" disabled type="checkbox" value="1" name="live_chat_session" @if($list->live_chat_session=='1') {{'checked'}} @endif />
                              <label for="chk_live">Live Chat sessions</label>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <span class="chk_nowrap">
                              <input id="chk_talk" disabled type="checkbox" value="1" name="talkathons" @if($list->talkathons=='1') {{'checked'}} @endif />
                              <label for="chk_talk">Talkathons</label>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <span class="chk_nowrap">
                              <input id="chk_self" disabled type="checkbox" value="1" name="selfie_points" @if($list->selfie_points=='1') {{'checked'}} @endif />
                              <label for="chk_self">Selfie Points</label>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <span class="chk_nowrap">
                              <input id="chk_social" disabled type="checkbox" value="1" name="social_media_wall" @if($list->social_media_wall=='1') {{'checked'}} @endif />
                              <label for="chk_social">Social Media Wall</label>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <span class="chk_nowrap">
                              <input id="chkoth" disabled type="checkbox" value="1" name="other" @if($list->other=='1') {{'checked'}} @endif />
                              <label for="chkoth">Other</label>
                            </span>
                          </td>
                          <td style="display:none;" id="other_field">
                            <input name="txt_smc_oth" disabled type="text" maxlength="40" id="txt_smc_oth" placeholder="Specify only" class="alph" style="width:120px; ">
                          </td>
                        </tr>
                      </table>
                    </div>
                    <!-- <div class="span2">
                      <span id="Label2" style="font-weight:bold;">Media Coverage</span>
                    </div> -->
                    <div class="span3">
                        <span id="Label2" style="font-weight:bold;">Media Coverage</span>
                      <textarea name="media_coverage_txt" disabled rows="2" cols="20" id="TextBox1" placeholder="Specify Media Coverage " class="alph" style="height: 187px; width: 440px; margin: 0px;">@if($list->media_coverage_txt!='NA') {{$list->media_coverage_txt}} @endif</textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif















            <div class="row">
                
                
                
       
            </div>

          

            <hr />
            <div class="row text-center ">
                <h4>Programme Details</h4>

            </div>
            <hr />


           
            
            <div class="row ">
                <div class="span2">
                  <font color="red">*</font>   <span id="lbl_aud_size" style="font-weight:bold;">Approx Size Of Audience :</span>
                </div>
                <div class="span3">
                    <input name="approx_size_of_audience" disabled value="{{$list->approx_size_of_audience}}" type="text" maxlength="10" id="txt_aud_size" onkeypress="return onlyNumberKey(event)" class="numeric" />
                    <span id="txt_aud_size_err" style="color: red";></span>
                </div>
            </div>
            <div class="row">
                <div class="span2">
                    <span id="lbl_area_type" style="font-weight:bold;">Special Area( * if any) :</span>
                </div>
                <div class="span3">

                    <!-- {{-- @foreach($special_data as $slist)
                    {{$slist}}
                    @endforeach --}} -->
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
                    
                    
                    @endphp
                    <select size="4" name="special_area[]" disabled multiple="multiple"  id="ddl_area_type" style="height:100px;">
                      {{-- <option id="special1" value="1">BORDER AREA</option>
                      <option id="special2" value="2">LWE AREA</option>
                      <option id="special3" value="3">MINORITIES AREA</option>
                      <option id="special4" value="4">NORTH-EASTERN AREA</option>
                      <option id="special5" value="5">ASPIRATIONAL DISTRICTS</option>
                      <option id="special6" value="6">OTHER AREA</option> --}}
                      @foreach($ary as $val)

                          <option value="{{$val['sareavalue']}}" {{ @in_array($val['sareavalue'],$special_data)? 'selected':''}}>{{$val['saname']}}</option>
                      @endforeach
                    </select>
                    
                </div>

            </div>
            <div class="row ">
                <div class="span2">
                    <span id="lbl_comm_netwrk" style="font-weight:bold;">Community Network Created</span>
                </div>
                <div class="span3">
                    <input name="community_network_created" disabled value="{{$list->community_network_created}}" type="text" maxlength="10" id="txt_comm_netwrk" class="numeric" />
                </div>
               <div class="span2">
                    <span id="lbl_comm_netwrk_details" style="font-weight:bold;"> Community Network Details</span>
                </div>
                <div class="span3">
                    <textarea name="community_network_details" disabled rows="2" cols="20" id="txt_comm_netwrk_details" style="resize: none">{{$list->community_network_details}}
</textarea>
                </div>
            </div>
            <div class="row">
                 <div class="span2">
                    <span id="lbl_virtual_netwrk" style="font-weight:bold;">Virtual Network Created </span>
                </div>
                <div class="span3">
                    <input name="virtual_network_created" disabled value="{{$list->virtual_network_created}}" type="text" maxlength="10" id="txt_virtual_netwrk" class="numeric" />
                </div>
                 <div class="span2">
                    <span id="lbl_virtual_netwrk_dtl" style="font-weight:bold;"> Virtual Network  Details</span>
                </div>
                <div class="span3">
                    <textarea name="virtual_network_details" disabled rows="2" cols="20" id="txt_virtual_netwrk_dtl" style="resize: none">{{$list->virtual_network_details}}
</textarea>
                </div>

            </div>
            <div class="row ">
                <div class="span2">
                    <span id="lbl_rd_station" style="font-weight:bold;">Radio Station Mobilized </span>
                </div>
                <div class="span3">
                    <input name="radio_station_mobilized" disabled value="{{$list->radio_station_mobilized}}" type="text" maxlength="10" id="txt_rd_station" class="numeric" />
                </div>


            </div>
           

            <div class="row">
                <div class="span2">
                    <span id="lbl_remarks" style="font-weight:bold;">Remarks:</span>
                </div>
                <div class="span3">
                    <textarea name="remarks" disabled rows="2" cols="20" id="txt_remarks" style="resize: none; width: 653px; margin: 0px; height: 46px;">{{$list->remarks}}
</textarea>

                </div>
            </div>
            <div class="row text-center ">
                <!-- <input type="submit" disabled name="btn_save" value="Save As Draft" id="draft" id="btn_save" class="btn btn-primary btn-NewRound" /> -->
                
                <a href="{{route('roblist')}}" class="btn btn-danger">Back</a>
                
                
                <a href="{{route('userlist',$list->Pk_id)}}" class="btn btn-info" style="margin-left:80%;">Next</a>
              </div>
        </div>

</form>


<script src="{{asset('arogi/js/jquery-1.8.2.js')}}" type="text/javascript"></script>
<script src="{{('arogi/js/jquery-ui.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/custom.js')}}" type="text/javascript"></script>
<!-- {{-- <script src="{{asset('arogi/js/datafetch.js')}}" type="text/javascript"></script> --}} -->
<script type="text/javascript">
    $(function () {
        $(".calendar").datepicker({
            dateFormat: 'dd/mm/yy', inline: true
        });
        $(".calendar").bind("paste", function (e) {
            return false;
        });
        $(".calendar").bind("drop", function (e) {
            return false;
        });

    });


</script>
<script>
  
    $(document).ready(function(){

      //for day count
        $("#txt_to").blur(function(){
            var start  =$("#txt_from").val();
            var end  = $("#txt_to").val();
            var days=(Date.parse(end) - Date.parse(start)) / 86400000;
            $("#txt_tot_prog_day").attr('value',days);
        });     
        
    });

 


    function alphaOnly(event) {
      var inputValue = event.charCode;
          if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
              event.preventDefault();
        }
    }

    function onlyNumberKey(evt) {  
      var ASCIICode = (evt.which) ? evt.which : evt.keyCode
      if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
      return false;
    return true;
    }

    $("#ddl_off_type").on("change focus",function(){
        var off_type_value=$("#ddl_off_type").val();
        $("#ddl")=off_type_value;
        if(off_type_value=="HQ") 
        {
            $("#ddl_rob_region").append('<option>----Select---</option><option  value="1"  >PATNA</option>');
        }
        if(off_type_value=="FO") 
        {
            $("#ddl_rob_region").empty();
            $("#ddl_rob_region").append('<option>----Select---</option><option value="2">SITAMARHI</option><option value="3">BHAGALPUR</option><option value="4">DARBHANGA</option><option value="5">CHAPRA</option><option value="6">MUNGER</option>');
        }
    });
    
</script>


@endforeach 
</div>
</div>
</div>
</section>
@endsection





