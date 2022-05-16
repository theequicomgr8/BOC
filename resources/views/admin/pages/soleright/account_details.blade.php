@extends('admin.layouts.layout')

@section('content')

@php 
$read='';
if($username=='')
{
    $read='disabled';
    $click='preventLeftClick';
    $show="none";  

}
@endphp
<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Application Form For Soleright Account</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
    
            @if(session('status') === true)
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


            @if(Session::has('not_exist'))
            <div class="alert alert-warning">
                <strong>Error!</strong> {{ Session('not_exist') }} !! Click Here For Enpanelement   <a href="/sole-right-media" style="color: red;">Click</a>
            </div>
            @endif
            <form method="POST" action="{{Route('update_account_detail')}}" autocomplete="on" id="account_detail_form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="tab-content">
                    <div class="content pt-3 tab-pane active show" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pan_card">Pan No. / पैन नंबर<font color="red">*</font>
                                    </label>
                                    <input type="text" name="PAN" id="pan_card" class="form-control form-control-sm" placeholder="Enter Pan No." maxlength="10" value="{{$data->{'PAN'} ?? ''}}" {{ $read }}>
                                    @error('PAN')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ifsc_code">IFSC Code / आई एफ एस सी कोड<font color="red">*</font>
                                    </label>
                                    <input type="text" name="IFSC_Code" id="ifsc_code" class="form-control form-control-sm" placeholder="Enter IFSC Code" maxlength="11" value="{{$data->{'IFSC Code'} ?? ''}}" {{ $read }}>
                                    @error('IFSC_Code')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name / बैंक का नाम<font color="red">
                                            *</font></label>
                                    <input type="text" name="Bank_Name" id="bank_name" class="form-control form-control-sm" placeholder="Enter Bank Name" maxlength="30" onkeypress="return onlyAlphabets(event)" value="{{$data->{'Bank Name'} ?? ''}}" {{ $read }}>
                                    @error('Bank_Name')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch">Branch / शाखा<font color="red">*</font>
                                    </label>
                                    <input type="text" name="Bank_Branch" id="branch" class="form-control form-control-sm" placeholder="Enter branch" maxlength="30" value="{{$data->{'Bank Branch'} ?? ''}}" {{ $read }}>
                                    @error('Bank_Branch')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_no">Account no / खाता नंबर<font color="red">*</font></label>
                                    <input type="text" name="Account_No" id="account_no" class="form-control form-control-sm" placeholder="Enter Account no" onkeypress="return onlyNumberKey(event)" maxlength="20" value="{{$data->{'Account No_'} ?? ''}}" {{ $read }}>
                                    @error('Account_No')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                @if(@$data->{'Cancelled Cheque File Name'}=="")
                                <div class="form-group">
                                    <label for="exampleInputFile">Cancelled Cheque / रद्द चेक
                                        <font color="red">*</font>
                                    </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="cancelled_cheque_file_name" class="custom-file-input" id="cancelled_cheque_file_name">
                                            <label class="custom-file-label" id="cancelled_cheque_file_name2" for="cancelled_cheque_file_name">Choose file</label>
                                        </div>
                                        @if(@$data->{'Cancelled Cheque File Name'} != '')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$data->{'Cancelled Cheque File Name'} }}" target="_blank">View</a></span>
                                        </div>
                                        @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="cancelled_cheque_file_name3">Upload</span>
                                        </div>
                                        @endif
                                    </div>
                                    <span id="cancelled_cheque_file_name1" class="error invalid-feedback"></span>
                                </div>
                                @else
                                <div class="form-group">
                                    <label for="exampleInputFile">Cancelled Cheque / रद्द चेक <font color="red">*</font></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="cancelled_cheque_file_name_modify" class="custom-file-input" id="cancelled_cheque_file_name_modify">
                                            <label class="custom-file-label" id="cancelled_cheque_file_name_modify2" for="cancelled_cheque_file_name_modify">{{@$data->{'Cancelled Cheque File Name'}  ?? 'Choose file' }}</label>
                                        </div>
                                        @if(@$data->{'Cancelled Cheque File Name'} != '')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/sole-right-media/{{ @$data->{'Cancelled Cheque File Name'} }}" target="_blank">View</a></span>
                                        </div>
                                        @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="cancelled_cheque_file_name_modify3">Upload</span>
                                        </div>
                                        @endif
                                    </div>
                                    <span id="cancelled_cheque_file_name_modify1" class="error invalid-feedback"></span>
                                </div>
                                @endif
                            </div>
                            

                            <input type="hidden" name="doc[]" id="doc_data">
                            

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" style="float: right;" {{ $read }}>Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.content-->
@endsection
@section('custom_js')
<script>
   
////////////// file upload size  512kb ////////////////
$(document).ready(function () {
  function isInArray(value, array) {
    return array.indexOf(value) > -1;
  }
  $(".custom-file-input").change(function () {
    var id = $(this).attr("id");
    var file = this.files[0].name;
    var file1 = $('#' + id + 2).text();

    var totalBytes = this.files[0].size;
    var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
    var ext = file.split('.').pop();
    var nolimit = '';
    if (id == 'specimen_copy_file_name' || id == 'rni_reg_file_name' || id == 'annual_return_file_name') {
      nolimit = id;
    }
    if (file != '' && (sizemb <= 2 || nolimit != '') && ext == "pdf") {
      $("#" + id + 2).empty();
      $("#" + id + 2).text(file);
      $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
      $("#" + id + 4).show();
      $("#" + id + 1).hide();
      if ($("#doc_data").val() == '') {
        $("#doc_data").val(file);
      } else {
        var names = $("#doc_data").val();
        var numbersArray = names.split(',');

        if (isInArray(file, numbersArray) == false) {
          $("#doc_data").val(function () {
            return $("#doc_data").val() + ',' + file;
          });
          var namess = $("#doc_data").val();
          var numbersArray1 = namess.split(',');
          numbersArray1 = $.grep(numbersArray1, function (value) {
            return value != file1;
          });
          $("#doc_data").val(numbersArray1);
          $("#" + id + 1).hide();
        } else {
          var namess = $("#doc_data").val();
          var numbersArray1 = namess.split(',');
          numbersArray1 = $.grep(numbersArray1, function (value) {
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
</script>
@endsection