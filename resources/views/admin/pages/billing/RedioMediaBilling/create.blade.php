@extends('admin.layouts.layout')
<style>
  body {
    color: #6c757d !important;

    p,
    label {
      font: 1rem 'Fira Sans', sans-serif;
    }

    input {
      margin: .4rem;
    }
  }

  .multiselect-search {
    width: 100% !important;
    margin-right: 10px;
  }

  .dropdown-menu.show {
    display: block;
    width: 100% !important;
  }

  .multiselect-clear-filter {
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

  .ui-datepicker-trigger {
    width: 25;
    height: 25;
    float: right;
    margin-top: -28px;
    margin-right: 4px;
  }
</style>
@section('content')
@php 
//dd($RO_id); 
@endphp
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i>Bill Submission For AV-Radio </h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div style="display: none;" align="center" class="alert alert-success"></div>
      <div style="display: none;" align="center" class="alert alert-danger"></div>
      <form method="POST" action="{{route('savebilling')}}" class="AVradioMediaBillingFrm" id="AVradioMediaBillingFrm" enctype="multipart/form-data">
        @csrf
        <div class="tab-content">
          <div id="logins-part" class="tab-pane active show">
            <div id="logins-part" class="content pt-3" role="tabpanel" aria-labelledby="logins-part-trigger">
              <div class="row">
             
                <!-- <div class="col-md-4 mousedisable">
                  <div class="form-group">
                  <label class="form-control-label">AV Type<font color="red">*</font></label>
                  <select class="form-control form-control-sm" id="sel1">
                    <option>Select Type</option>
                    <option>AT-TV</option>
                    <option>AT-Radio</option>
                  </select>
                </div>
                </div> -->
              </div>
              @php
              if($RO_id->{'Invoice No_'}=='')
              {
                $invoiceNo=sprintf("%s%02s", 'B',rand(100,100000).session('UserName'));
              }
              else
              {
                $invoiceNo=$RO_id->{'Invoice No_'} ?? '';
              }
              
              
              @endphp
              <div class="row">
                  <input type="hidden" name="RO_Code" value="{{$RO_id->{'RO Code'} ?? ''}}">
                <div class="col-md-4 mousedisable">
                  <div class="form-group">
                    <label class="form-control-label">Invoice ID.<font color="red">*</font></label>
                    <input type="text" maxlength="20" class="form-control form-control-sm" name="Invoice_id" id="billno" value="{{$RO_id->{'Invoice No_'} ?? ''}}" >
                  </div>
                  
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Invoice Date  <font color="red">*</font></label>
                    <input  type="date" class="form-control form-control-sm" name="Invoice_date" id="bill_date1"  placeholder="DD-MM-YYYY"  value="{{ (!empty(@$RO_id->{'Invoice Date'}) && @$RO_id->{'Invoice Date'} != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$RO_id->{'Invoice Date'})) : ''}}" >
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>

                @php
                if($RO_id->{'Order No_'}=='')
                {
                  $orderID=sprintf("%s%02s", 'O',rand(100,100000).session('UserName'));

                }
                else
                {
                  
                  $orderID=$RO_id->{'Order No_'} ?? '';
                }
               @endphp
              <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Order ID<font color="red">*</font></label>
                    <input type="text" class="form-control form-control-sm" name="Order_id" id="published_pageno" onkeypress="return isNumber(event)" maxlength="" value="{{$RO_id->{'Order No_'} ?? '' }}" >
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Account Rep.<font color="red">*</font></label>
                    <input type="text" class="form-control form-control-sm" name="Account_rep" id=""  maxlength="" value="{{@$RO_id->{'Account Rep_'} ?? ''}}" >
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
                <!-- <div class="col-md-4" >
                  <div class="form-group">
                    <label class="form-control-label">GST No.<font color="red">*</font></label>
                    <input type="text" maxlength="15" class="form-control form-control-sm" name="gstno" id="gstno" return onchange="checksum(this.value);" value="">
                    <span class="gstvalidationMsg"></span>
                    <span class="validcheck"></span>
                    </div>
                  </div>                     -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Bill Officer Name<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" maxlength="40" name="billOfficerName" id="billOfficerName" value="{{@$RO_id->{'Bill Officer Name'} ?? ''}}" >
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Bill Officer Designation<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" maxlength="40" name="billOfficerDesign" id="billOfficerDesign" value="{{@$RO_id->{'Bill Officer Designation'} ?? ''}}"  style="pointer-events: none1;">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">E-mail ID<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" maxlength="40" name="email" id="email" value="{{@$RO_id->{'Email Id'} ?? ''}}"  style="pointer-events: none1;">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">From Date  <font color="red">*</font></label>
                    <input  type="date" class="form-control form-control-sm" name="from_date"   placeholder="DD-MM-YYYY" value="{{ (!empty(@$RO_id->{'Telecast_Broadcast From Date'}) && @$RO_id->{'Telecast_Broadcast From Date'} != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$RO_id->{'Telecast_Broadcast From Date'})) : ''}}"  >
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
                

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">To Date <font color="red">*</font></label>
                    <input  type="date" class="form-control form-control-sm" name="to_date"  placeholder="DD-MM-YYYY" value="{{ (!empty(@$RO_id->{'Telecast_Broadcast To Date'}) && @$RO_id->{'Telecast_Broadcast To Date'} != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$RO_id->{'Telecast_Broadcast To Date'})) : ''}}" >
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
                
                
                <!-- start np image upload file-->
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Upload<font color="red">*</font></label>
                    <input  accept="image/png, image/jpeg, image/jpg" type="file" class="custom-file-doc form-control form-control-sm" name="attachment1" id="agencyImage">
                  </div>
                  @if( @$RO_id->{'Attachment 1'} >0)
                  <img src="{{ url('/uploads') }}/radiobilling/{{ @$RO_id->{'Attachment 1'} ?? '' }}" width="60px" height="60px">
                  @endif
                </div><!--end np img div upload file end-->
                <!-- start upload file of adverttisement -->
                <div class="col-md-4" >
                  <div class="form-group">
                    <label class="form-control-label">Upload Advertisement Image<font color="red">*</font></label>
                    <input accept="image/png, image/jpeg, image/jpg"  type="file" class="form-control form-control-sm" name="attachment2" id="advtImage"></div>
                    @if( @$RO_id->{'Attachment 2'} >0)
                  <img src="{{ url('/uploads') }}/radiobilling/{{ @$RO_id->{'Attachment 2'} ?? '' }}" width="60px" height="60px">
                  @endif
                    <span id="alert_img_msg" style="display:none; color: red;">0% Match, Creative Image is not available.</span>
                </div><!--end div advt image upload file end-->


                @php
                $wing=Session::get('WingType');
                @endphp

                @if($wing==4 || $wing==5)
                <div class="col-md-4" >
                  <div class="form-group">
                    <label class="form-control-label">Excel Upload<font color="red">*</font></label>
                    <input type="file" class="form-control form-control-sm" name="avtv_excel" id="avtv_excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                  </div>
                </div><!--end div advt image upload file end-->
                @endif
              </div>
              </div>
              

              <div class="row pt-4">
                <div class="col-md-12">
                <table class="table table-bordered">
        <thead>
            <tr>
                <th>RO No.</th>
                <th>Date</th>
                <th>Time</th>
                <th>GST No.</th>
                <th>Duration/Description</th>
                <th>Bill Claim Amount</th>
            </tr>
        </thead>
        <tbody>
          @if(count($dataline)>0)
          @php $i =1; @endphp
          @foreach($dataline as $line)
          <input type="hidden" name="agencyCode[]" value="{{$line->{'Agency Code'} ?? ''}}">
          <input type="hidden" name="RoCode[]" value="{{$line->{'RO No_'} ?? ''}}">
          <input type="hidden" name="RoLine[]" value="{{$line->{'Line No_'} ?? ''}}">
            <tr>
                <td>{{$line->{'RO No_'} }}</td>
                <td>{{substr($line->{'Date'},0,10) }}</td>
                <td>{{substr($line->{'Time'},11,8) }}</td>
                <td>{{$line->{'Vendor GST No_'} ?? ''}}</td>
                <td> @if($line->{'Duration'} >0){{substr($line->{'Duration'},0,6) ?? ''}}@endif  &nbsp;&nbsp;&nbsp;&nbsp;@if($line->{'Description'}){{$line->{'Description'}  ?? ''}} @endif</td>
                <td><input type="text" class="form-control" name="claimed_amount[]" value="@if($line->{'Bill Claim Amount'} > 0){{round($line->{'Bill Claim Amount'},4)  ?? ''}} @endif" onkeypress="return isNumber(event)" maxlength="10"></td>
            </tr>
            @php $i++; @endphp
            @endforeach
            @endif
             </tbody>
            </table>

                </div>
              </div>
              <div class="row">

                <div class="col-md-4" id="diff-results" style="display:none;">
                  <div class="form-group">
                    <label class="form-control-label"> Match Image Difference(in %)<font color="red">*</font></label>
                    <input type="text" maxlength="20" class="form-control form-control-sm" name="ImageMatchPercentage" id="ImageMatchPercentage" value="" readonly>

                  </div>
                  <span id="alert_img_compare" class="" style="display:none;"></span>

                </div>
                

              </div>

              <div class="col-sm-6">
                <div class="form-group clearfix">
                  <label for="owner_newspaper"></label><br>
                  <div class="icheck-primary d-inline">

                  </div>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-12 text-right">

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 text-right">
              <input class="btn btn-primary submit-button btn-sm m-0 " type="submit" name="submit" value="submit">
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
</div>
</div>
@endsection
@section('custom_js')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<script src="https://rsmbl.github.io/Resemble.js/resemble.js"></script>
<!-- <script src="{{ url('/js/billing') }}/ODMediaBilling.js"></script> -->
<script type="text/javascript">
// $(document).ready(function(){
//    $("#add_row").click(function(){
// 		$("#add_davp").append('<div class="row"><div class="col-md-4"><div class="form-group"><label for="agency_contract_details">Date</label><input type="date" name="agency_contract_details" placeholder="" class="form-control form-control-sm" maxlength="30"></div></div><div class="col-md-4"><div class="form-group"><label for="S">Time</label><input type="time" name="" placeholder="" class="form-control form-control-sm" maxlength="30"></div></div><div class="col-md-4"><div class="form-group"><label for="S">Length (Sec)</label><input type="text" name="" placeholder="" class="form-control form-control-sm" maxlength="30"></div></div><div class="col-md-4"><div class="form-group"><label for="S">Description</label><input type="text" name="" placeholder="" class="form-control form-control-sm" maxlength="30"></div></div><div class="col-md-4"><div class="form-group"><label for="S">Copy ID/ISCI Code</label><input type="text" name="" placeholder="" class="form-control form-control-sm" maxlength="30"></div></div><div class="col-md-4"><div class="form-group"><label for="S">Cost</label><input type="text" name="" placeholder="" class="form-control form-control-sm" maxlength="30"></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 60px;"><button class="btn btn-danger remove_row mr-1">Remove</button></div></div><br />');
// 	});
//     $("#add_davp").on('click','.remove_row',function(){
//         $(this).parent().parent().remove();
//     });
// });

  function convertImgToBase64(url, callback, outputFormat) {
    var canvas = document.createElement('CANVAS'),
    ctx = canvas.getContext('2d'),
    img = new Image;
    img.crossOrigin = 'Anonymous';
    img.onload = function() {
      var dataURL;
      canvas.height = img.height;
      canvas.width = img.width;
      ctx.drawImage(img, 0, 0);
      dataURL = canvas.toDataURL(outputFormat);
      callback.call(this, dataURL);
      canvas = null;
    };
    img.src = url;
  }

  function encodeImageFileAsURL(element) {
    $('#alert_img_msg').hide();
    function onComplete(data) {
      var time = Date.now();
      var diffImage = new Image();
      diffImage.src = data.getImageDataUrl();

      $("#image-diff").html(diffImage);

      $(diffImage).click(function() {
        var w = window.open("about:blank", "_blank");
        var html = w.document.documentElement;
        var body = w.document.body;

        html.style.margin = 0;
        html.style.padding = 0;
        body.style.margin = 0;
        body.style.padding = 0;

        var img = w.document.createElement("img");
        img.src = diffImage.src;
        img.alt = "image diff";
        img.style.maxWidth = "100%";
        img.addEventListener("click", function() {
          this.style.maxWidth =
          this.style.maxWidth === "100%" ? "" : "100%";
        });
        body.appendChild(img);
      });

      console.log(data.misMatchPercentage);
      // if (data.misMatchPercentage == 0) {
                //$("#thesame").show();
                $('#ImageMatchPercentage').val("100");
                $('#alert_img_compare').show();
                $('#alert_img_compare').removeClass('alert-danger');                
                $('#alert_img_compare').addClass('alert-success');                
                $('#alert_img_compare').text("Both image are same");
                $("#diff-results").show();
            //   } else {
            //    $('#ImageMatchPercentage').val(data.misMatchPercentage);
            //    $('#alert_img_compare').show();
            //    $('#alert_img_compare').addClass('alert-danger');                
            //    $('#alert_img_compare').removeClass('alert-success');   
            //    $('#alert_img_compare').text("The second image is "+data.misMatchPercentage+"% different compared to the first.");
            //    $("#mismatch").text(data.misMatchPercentage);
            //    if (!data.isSameDimensions) {
            //     $("#differentdimensions").show();
            //   } else {
            //     $("#differentdimensions").hide();
            //   }
            //   $("#diff-results").show();

            // }
          }


          var file = element.files[0];
          var filePath1 = $("#img1").val();
          var filePath1_name = $("#img1_name").val();
          if(filePath1_name == "")
          {
            $('#alert_img_msg').show();
          }
          else
          {
            $('#alert_img_msg').hide();
            var filePath2 = URL.createObjectURL(file);
            console.log(filePath1);
            console.log(filePath2);
            var img1 = filePath1,
            img2 = filePath2;
            convertImgToBase64(img1, function(base64Img1) {
              convertImgToBase64(img2, function(base64Img2) {
                if (base64Img1 == base64Img2) {
                  if (base64Img2) {
                    resembleControl = resemble(img1)
                    .compareTo(base64Img2)
                    .onComplete(onComplete);
                  }
                  console.log("same");
                } else {
                  if (base64Img2) {
                    resembleControl = resemble(img1)
                    .compareTo(base64Img2)
                    .onComplete(onComplete);
                  }
                  console.log("diff");
                }

              });
            });
          }

        }
      </script>
      <script>


  //  next and previous function for save 

  $('.alert-success').hide();
  $('.alert-danger').hide();

  // function SaveData() {

  //   var formData = new FormData($('#AVradioMediaBillingFrm')[0]);
  //   $.ajax({
  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
  //     },
  //     type: "POST",
  //     url: "storebilling/",
  //     data: formData,
  //     dataType: "json",
  //     processData: false,
  //     contentType: false,
  //     success: function(data) {
  //       if (data.success == true) {
  //         $('.alert-success').fadeIn().html(data.message);
  //         setTimeout(function() {
  //           $('.alert-success').fadeOut("slow");
  //           window.location.reload();
  //         }, 5000);

  //       }
  //       if (data.success == false) {
  //         $('.alert-danger').fadeIn().html(data.message);
  //         setTimeout(function() {
  //           $('.alert-danger').fadeOut("slow");
  //         }, 5000);
  //       }
  //     },
  //     error: function(error) {

  //       console.log('error');
  //       //window.location.reload();
  //     }
  //   });


  // }

</script>


<script type="text/javascript">
  $( function() {
    var CURL = {!! json_encode(url('/')) !!};
    //var dateFormat = "mm/dd/yy",
    from = $( "#bill_date" )
    .datepicker({
      //defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      showOn: "button",
      buttonImage: CURL+"/img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: 'dd-mm-yy',
    })
    $('#bill_date').click(function() {
      $('#bill_date').datepicker("show");
    });
  } );
</script>
<script type="text/javascript">
  $( function() {
    var CURL = {!! json_encode(url('/')) !!};
    from = $( "#publication_date" )
    .datepicker({
      //defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      showOn: "button",
      buttonImage: CURL+"/img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: 'dd-mm-yy',
    });
    $('#publication_date').click(function() {
      $('#publication_date').datepicker("show");
    });
  } );

  //from date
  $( function() {
    var CURL = {!! json_encode(url('/')) !!};
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
      dateFormat: 'dd-mm-yy',
    });
    $('#from-date').click(function() {
      $('#from_date').datepicker("show");
    });
  } );

  //to date
  $( function() {
    var CURL = {!! json_encode(url('/')) !!};
    from = $( "#to_date" )
    .datepicker({
      //defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      showOn: "button",
      buttonImage: CURL+"/img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: 'dd-mm-yy',
    });
    $('#to_date').click(function() {
      $('#to_date').datepicker("show");
    });
  } );

 
</script>


<script>

 ////////////// file upload size  512kb ////////////////
 $(document).ready(function() {

  $(".custom-file-input").change(function() {
    var id = $(this).attr("id");
    id.slice(1);
      // console.log(id);
      var file = this.files[0].name;
      var totalBytes = this.files[0].size;
      var sizemb = (totalBytes / (1024*1024));
      var ext = file.split('.').pop();
      if ((file!= "" && sizemb <= 2)){
        $("#" + id + 2).empty();
        $("#" + id + 2).text(file);
        $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");

        $("#" + id + 1).hide();

      } else {
        $("#" + id).val('');
        $("#" + id + 2).text("Choose file");
        $("#" + id + 1).text('File size should be 2MB');
        $("#" + id + 1).show();
        $("#" + id + 3).html("Upload").addClass("input-group-text");
        $("#" + id + "-error").addClass("hide-msg");
      }
    });

});


 function uploadFile(i, thiss) {
  var file = thiss.files[0].name;
  var totalBytes =  thiss.files[0].size;
  var sizemb = (totalBytes / (1024*1024));
    // console.log('totalBytes',totalBytes);
    console.log('sizemb',sizemb);
     // console.log('file',file);
     var ext = file.split('.').pop();

    // if ((sizemb <= 2) && (ext == "jpeg" || ext == "jpg" || ext == "png")) 
    if ((file!= "" && sizemb <= 2)) 
    {
      console.log("if");
      $("#choose_file" + i).empty();
      $("#choose_file" + i).text(file);
      $("#upload_file" + i).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
      $("#upload_doc_error" + i).hide();
    } 
    else 
    {
      console.log("hello");
      $("#upload_doc" + i).val('');
      $("#choose_file" + i).text(file);
      $("#upload_doc_error" + i).text('File size should be 2MB');
      $("#upload_doc_error" + i).show();
      $("#upload_file" + i).html("Upload").addClass("input-group-text");
      $("#upload_doc" + i + "-error").addClass("hide-msg");
    }
  }

  $('.diffdatemsgLabel').removeClass('alert-info-msg');

</script>
<script >
  function checksum(g){
  
    let regTest = /\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/.test(g)

    if(regTest){
      var gstMsg='GST No. is valid format';
       $('.gstvalidationMsg').removeClass('alert-info-msg2');
      $('.gstvalidationMsg').addClass('alert-info-msg');
      $('.gstvalidationMsg').text(gstMsg);
      $('.validcheck').html("<i class='fa fa-check' aria-hidden='true'></i>");
      return true;
     //  let a=65,b=55,c=36;
     //  return Array['from'](g).reduce((i,j,k,g)=>{ 
     //   p=(p=(j.charCodeAt(0)<a?parseInt(j):j.charCodeAt(0)-b)*(k%2+1))>c?1+(p-c):p;
     //   return k<14?i+p:j==((c=(c-(i%c)))<10?c:String.fromCharCode(c+b));
     // },0); 
    }else{
      var gstMsg='Enter Valid format GST No. like(18AABCU9603R1ZM)';
      $('.gstvalidationMsg').removeClass('alert-info-msg');
      $('.gstvalidationMsg').addClass('alert-info-msg2');
      $('.gstvalidationMsg').text(gstMsg);
      $('.validcheck').html("");
      return false;

    }
    
}
$(document).ready(function() {
    $('.preventLeftClick').on('click', function(e) {
        e.preventDefault();
        return false;
    });
});

var event = $(".mousedisable").click(function(e) {
    e.stopPropagation();
    e.preventDefault();
    e.stopImmediatePropagation();
    return false;
});
</script>

<style type="text/css">
  .multiselect-container {
    overflow-x: scroll;
    height: 400px;
  }

  .multiselect-container>li>a>label {
    height: auto;
  }

  .alert-info-msg2 {
    font-size: 80%;
    color: #ef1721;
}
</style>

@endsection