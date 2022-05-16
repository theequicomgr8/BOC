@extends('admin.layouts.layout')
<style>
  body{
    color: #6c757d !important;
  }
  .ui-datepicker-trigger{
    width: 25;
    height: 25;
    float: right;
    margin-top: -28px;
    margin-right: 4px;
  }
.table-bordered td, .table-bordered th {
    font-size: 12px !important;
    padding: 10px 7px !important;
}
</style>

@section('content')
@php 
$results=isset($response)? $response:'';
@endphp
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3">
      <h6 class="m-0">
        <i class="fa fa-user"></i>  Media Request
      </h6> <br>
     <!--  <a href="{{url('clientRequestPDF/'.Session::get('UserID') )}}" class="m-0 font-weight-normal text-primary"> <i class="fa fa-download"></i> Download Media Request</a><br> -->
      <a style="font-size: 14px;" class="m-0 text-primary" href="{{route('client-submission-form')}}"  id="addnew" /> 
        <i class="fa fa-user-plus"></i> Add New Request </a>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="card-body p-2">
          <form name ="wingsTypesearch" id="wingsTypesearch" method="GET" enctype="multipart/form-data" action="{{Route('client-submission-list')}}" >
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Media Category</label>
                  <select name="wingType" id="wingType" class="form-control form-control-sm">
                  <!-- <option value=""> Select Wing Type</option> -->
                  <option value="1" {{ @$wingType == "1" ? "selected" :""}}>Print</option>
                  <option value="2" {{ @$wingType == "2" ? "selected" :""}}>Outdoor</option>
                  <option value="3" {{ @$wingType == "3" ? "selected" :""}}>AV-TV</option>
                  <option value="4" {{ @$wingType == "4" ? "selected" :""}}>AV-Radio</option>
                  
              </select>
                </div>
              </div>
              
               <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label">From Date</label>
                    <input  type="text" value="{{@$from_date ?? ''}}" class="form-control form-control-sm"
                   name="from_date" id="from_date" placeholder="DD/MM/YYYY" autocomplete="off">          
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label">To Date</label>
                  <input  type="text" value="{{@$to_date ?? ''}}"  class="form-control form-control-sm" name="to_date" id="to_date" placeholder="DD/MM/YYYY" autocomplete="off">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Media plan status</label>
                  <select name="mpstatus" id="mpstatus" class="form-control form-control-sm">
                  <option value="" selected>All</option>
                  <option value="0" {{ @$mpstatus == "0" ? "selected" :""}}>Media Plan Pending</option>
                  <option value="1" {{ @$mpstatus == "1" ? "selected" :""}}>Under Approval</option>
                  <option value="2" {{ @$mpstatus == "2" ? "selected" :""}}>Approved</option>
                  <option value="3" {{ @$mpstatus == "3" ? "selected" :""}}>Rejected</option> 
                  <option value="4" {{ @$mpstatus == "4" ? "selected" :""}}>Forwarded</option> 
                  <option value="5" {{ @$mpstatus == "5" ? "selected" :""}}>RO Created</option>
                  <option value="6" {{ @$mpstatus == "6" ? "selected" :""}}>Rolled Back</option> 

                  <option value="7" {{ @$mpstatus == "7" ? "selected" :""}}>At Nodal Officer</option> 
                  <option value="8" {{ @$mpstatus == "8" ? "selected" :""}}>At Media Plan</option> 
                  <option value="9" {{ @$mpstatus == "9" ? "selected" :""}}>Plan Created</option> 
                  <option value="10" {{ @$mpstatus == "10" ? "selected" :""}}>Plan Selected</option>
                  <option value="11" {{ @$mpstatus == "11" ? "selected" :""}}>Client Request Pending</option> 
              </select>
                </div>
              </div>
          
               <div class="col-md-2">
                <div class="form-group">
                  <label class="form-control-label">&nbsp;</label>
                  <input type="submit" value="Search" class="btn btn-block btn-primary btn-sm" >
                </div>
              </div>
               <div class="col-md-2">
                <div class="form-group">
                  <label class="form-control-label">&nbsp;</label>
                  <!-- <button class="btn btn-primary" id="reset" onclick="resetFunction()">Reset</button> -->
                   <input name="submitreset"  id="submitreset" type="submit" value="Reset" class="btn btn-block btn-primary btn-sm" >
                </div>
              </div>

            </div>
         </form>
     <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover order-list" id="myTable">   
        <thead>
          <tr>
            <th scope="col">S.No</th>
            <th scope="col">Media Request</th>
             <!-- <th scope="col">Media Category</th> -->
              @if($wingType_text=='Print')
             <th scope="col">Color Type</th>
             <th scope="col">Print Budget</th>
             <th scope="col">Newspaper Type</th>
             @endif
            <th scope="col">Request Date</th>
            <th scope="col">From Date</th>
            <th scope="col">To Date</th>
            <!-- <th scope="col">Email</th> -->
            <th scope="col">Status</th>

              <th scope="col">Display Key</th>
             <!--  @if($wingType==1)
              <th scope="col">MP Version</th>
              @endif
              @if($wingType!="4")
              <th scope="col">MP Client Name</th>
              @endif
              <th class="scope">MP Remark</th>
              <th scope="col">MP Target Area</th> -->
              <!-- <th scope="col">MP Status</th> -->
            <!-- <th scope="col">Media request submitted</th> -->  
             <th scope="col">Media plan generated</th>  
          </tr>
        </thead>
        <tbody>
          @forelse($results as $key=>$result) 
          <tr>
            <td>{{$results->firstItem() + $key}}</td>
            <td><a class="m-0 font-weight-normal text-primary" href="{{url('client-submission-form/'.$result->CRHID)}}"  class="editMember" title="Media Request View" >{{ $result->ClientRequestNo }}</a></td>
           <!--  @if($wingType_text )
            <td>{{$wingType_text}}</td>
            @else
            <td>{{ 'NA' }}  </td>
            @endif -->
            @if($wingType_text=='Print')
              <td>{{$result->colorType}}</td>
              <td>{{number_format($result->budgetAmount)}}</td>
              @if($result->newspaperType==0)
                <td>Daily</td>
              @elseif($result->newspaperType==1)
              <td>Employment News</td>
              @else
              <td>NA</td>
              @endif
            @endif
            <td>{{ date('Y-m-d', strtotime($result->RequestDate)) }} </td>
            <td>{{ date('Y-m-d', strtotime($result->FromDate))  }} </td>
            
            <td>{{ date('Y-m-d', strtotime($result->ToDate)) }} </td>
            <!-- <td>{{ $result->EmailId }} </td> -->
            @if($result->MPStatus =="0")
            <td> {{ 'Media Plan Pending' }} </td>
            @elseif($result->MPStatus =="1")
              <td> {{ 'Under Approval' }}  </td>
            @elseif($result->MPStatus =="2")
              <td> {{ 'Approved' }} </td>
            @elseif($result->MPStatus =="3")
              <td> {{ 'Rejected' }} </td>
            @elseif($result->MPStatus =="4")
              <td> {{ 'Farworded' }} </td>
            @elseif($result->MPStatus =="5")
              <td> {{ 'RO Created' }} </td>
            @elseif($result->MPStatus =="6")
              <td> {{ 'Rolled Back' }} </td>
           @elseif($result->CLStatus=="0")
              <td> {{ 'Client Request Pending' }} </td>
            @elseif($result->CLStatus =="1")
              <td> {{ 'At NO' }} </td>
             @elseif($result->CLStatus =="2")
              <td> {{ 'At MP' }} </td>
            @elseif($result->CLStatus =="3")
              <td> {{ 'Plan Created' }} </td>
            @elseif($result->CLStatus =="4")
              <td> {{ 'Plan Selected' }} </td>
            @endif
            @if(@isset($result->MPNO))
             <td>{{@$result->MPNO}}  </td>
             @else
             <td>NA</td>
             @endif
            <!--@if($wingType==1)
            <td>{{ $result->{'MPVersion'} }} </td>
            @endif
            @if($wingType!="4")
            <td>{{@$result->MPClientName}}</td>
            @endif
            <td>{{$result->MPClientRemarks}}</td>
            @if($result->{'MPTargetArea'} ==0)      
                <td>{{ 'Pan India' }} </td>
              @elseif($result->{'MPTargetArea'} ==1)
                <td> {{ 'Individual State' }} </td>
              @elseif($result->{'MPTargetArea'} ==2)
                <td> {{ 'Group of States' }} </td>
              @elseif($result->{'MPTargetArea'} ==3) 
                <td> {{ 'Cities' }} </td>
              @else
              <td>{{ 'NA' }}  </td>
              @endif -->
              <!-- @if($result->MPStatus =="0")
                <td> {{ 'Open' }} </td>
              @elseif($result->MPStatus =="1")
                <td> {{ 'Under Approval' }}  </td>
              @elseif($result->MPStatus =="2")
                <td> {{ 'Approved' }} </td>
              @elseif($result->MPStatus =="3")
                <td> {{ 'Rejected' }} </td>
              @elseif($result->MPStatus =="4")
                <td> {{ 'Farworded' }} </td>
              @elseif($result->MPStatus =="5")
                <td> {{ 'Approved' }} </td>
              @elseif($result->MPStatus =="6")
                <td> {{ 'Rejected' }} </td>
              @else
              <td>{{ 'NA' }}  </td>
              @endif -->
  


            <!-- <td align="center"><a class="m-0 font-weight-normal text-primary" href="{{url('client-submission-form/'.$result->CRHID)}}"  class="editMember" >
              <img src="{{asset('img/view22X22.png')}}" title="Media Request View" border="0" /></a> </td> -->
               @if($wingType==1 && @isset($result->MPNO))
              <td><a class="m-0 font-weight-normal text-primary" href="{{url('media-plan-view/'.$result->MPNO.'/'.$result->{'MPVersion'}  )}}"  style="font-size:15px;"   class="editMember" ><img src="{{asset('img/view22X22.png')}}" title="MP View" border="0" /></a> </td>
                @elseif($wingType=="2" &&  @isset($result->MPNO))
               <td><a class="m-0 font-weight-normal text-primary" href="{{route('ODMediaPlan.show', $result->MPNO )}}"  style="font-size:15px;"   class="editMember" ><img src="{{asset('img/view22X22.png')}}" title="MP View" border="0" /></a> </td>
                @elseif($wingType=="3" && @isset($result->MPNO))
               <td><a class="m-0 font-weight-normal text-primary" href="{{route('tvMediaPlan.show', $result->{'MPNO'} )}}"  style="font-size:15px;"   class="editMember" ><img src="{{asset('img/view22X22.png')}}" title="MP View" border="0" /></a> </td>
                @elseif($wingType=="4"&&  @isset($result->MPNO))
              <td><a class="m-0 font-weight-normal text-primary" href="{{route('radioMediaPlan.show', str_replace("FM/","FM",$result->{'MPNO'}) )}}"  style="font-size:15px;"   class="editMember" ><img src="{{asset('img/view22X22.png')}}" title="MP View" border="0" /></a> </td>
              @else
              <td>NA</td>
               @endif

            </tr>
            @empty
            <tr style="text-align: center; color: red;"><td colspan="15" >No Data</td></tr>
            @endforelse
            
          </tbody>
        </table>
      </div>
      <div class="d-block" style="width:100%; float: left;">
        <span class="float-right"> 
          {{$results->withQueryString()->links('pagination::bootstrap-4')}}
        </span> 
      </div>
    </div>
  </div>
</div>

@endsection
@section('custom_js')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
    var CURL = {!! json_encode(url('/')) !!};
    var dateFormat = "yy-mm-dd",
    from = $( "#from_date" )
    .datepicker({
      //defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      showOn: "button",
      buttonImage: CURL+"/img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      //inline: true,
      //showOtherMonths: true,
      dateFormat: 'yy-mm-dd',
      //dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

    })
    .on( "change", function() {
      to.datepicker( "option", "minDate", getDate( this ) );
    }),
    to = $( "#to_date" ).datepicker({
      //defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      showOn: "button",
      buttonImage: CURL+"/img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: 'yy-mm-dd',

    })
    .on( "change", function() {
      from.datepicker( "option", "maxDate", getDate( this ) );
    });

     function getDate(element) {
      var date = null;

      try {
        date = $.datepicker.parseDate(dateFormat, element.value);
      } catch (error) {
        date = null;
      }

      return date;
    }

    function onSelect(dateText, inst) {
      var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#from_date").val());
      var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#to_date").val());
      var selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);

      if (!date1 || date2) {
        $("#from_date").val(dateText);
        $("#to_date").val("");
        $(this).datepicker();
      } else if (selectedDate < date1) {
        $("#to_date").val($("#from_date").val());
        $("#from_date").val(dateText);
        $(this).datepicker();
      } else {
        $("#to_date").val(dateText);
        $(this).datepicker();
      }
    }

    $('#from_date').click(function() {
      $('#from_date').datepicker("show");
    });
    $('#to_date').click(function() {
      $('#to_date').datepicker("show");
    });
  } );
</script>
<script type="text/javascript">
// function getrolist() {
//     var formData =new FormData($('#rosearch')[0]);
//     console.log(formData);
//     $.ajax({
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
//       },       
//       type: "GET",
//       url: "{{Route('release-order-list')}}",
//       data: formData,
//       dataType: "json",
//       processData: false,
//       contentType: false,
//       success: function(data) {
//         // if (data.success == true) {
       
//         // },
//         //  error: function(error) {

//         //     console.log('error');
//         //    //window.location.reload();
//         //  }
//       }
//       });
    

// }
/*$('#submitreset').click(function() {
    document.getElementById("wingsTypesearch").trigger();
     window.location.href ='client-submission-list';
    });*/



</script>

@endsection