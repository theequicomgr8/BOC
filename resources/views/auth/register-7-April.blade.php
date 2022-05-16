@extends('layouts.layout')
@section('title', 'Sign up Form')
@section('content')
<?php
$current_url = last(request()->segments());
?>
<div class="form-validation mt-20">
  @if ($errors->any())
  @foreach ($errors->all() as $error)
  <div class="text-danger text-center">{{$error}}</div>
  @endforeach
  @endif
  <h4>
    {{'Sign up'}}
  </h4>
  <form method="POST" id="signup-form" action="{{URL::to($current_url)}}">
    @csrf
    <input id="userTypeHidden" type="hidden" name="userTypeHidden" value="{{request()->user_type}}">
    <div class="form-group">
      <select name="wing_type" id="wing_type" class="form-control underline-input select1" required>
        <option value="">Select Wing Type</option>
        <option value="M001">Print</option>
        <option value="M003">Outdoor</option>
        <option value="M002">AV</option>
        <option value="M004">New Media</option>
        <option value="M004">Print Publisher</option>
      </select>
    </div>
    <div class="form-group"><i class="fa fa-envelope" aria-hidden="true"></i>
      <input type="text" name="email" id="email" value="{{old('email')}}" tabindex="0" class="form-control underline-input" placeholder="Enter Email" required="required">
    </div>
    <div class="form-group" id="mobile_section"><i class="fa fa-mobile" aria-hidden="true" style="font-size: 23px;top: 10px !important;"></i>
      <input type="text" name="mobile" id="mobile" value="{{old('mobile')}}" maxlength="10" tabindex="0" class="form-control underline-input" placeholder="Enter Mobile Number" required="required" onkeypress="return checkNumberOnly(event)" maxlength="10">
    </div>
    <div class="form-group" id="gst_section" style="display: none;"><i class="fa fa-user"></i>
      <input name="gst" type="text" id="gst" tabindex="0" class="form-control underline-input" placeholder="Enter GST Number" required="required">
      <span id="GST_No_Error"></span>
    </div>
    <div class="form-group text-left">
      <div class="row">
        <div class="col-md-6">
          <button type="submit" id="signup" class="btn btn-greensea btn-block animated-button signup-form">Sign up</button>
        </div>
        <div class="col-md-6">
          <!-- <a href="/signup_confirm" style="color: blue;">Email Verification</a> -->
        </div>
      </div>
    </div>
  </form>
  <a href="{{URL::to('vendor-login')}}"><i class="fa fa-user"></i> Already Registered</a>
</div>
@endsection
@section('custom_js')
<script type="text/javascript">
  $(document).ready(function() {
    $(".signup-form").click(function() {
      var form = $("#signup-form");
      form.validate({
        rules: {
          email: {
            required: true,
            emailExt: true
          }
        },
        messages: {
          email: {
            required: "Please fill required field!",
            email: "Please enter a vaild email address!"
          }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      })
    })
  });

  $(document).ready(function() {
    $("#wing_type").change(function() {
      var wing = $("#wing_type").val();
      if (wing == 'M003') {
        $("#gst_section").show();
      } else {
        $("#gst_section").hide();
      }
    });

    ///for gst
    $("#signup").click(function() {
      var wing = $("#wing_type").val();
      if (wing == 'M003') {
        var value = $("#gst").val();
        $("#GST_No_Error").hide();
        var reggst = (/\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/);
        if (value.match(reggst)) {
          $("#GST_No_Error").show();
          $("#GST_No_Error").text('Valid GST No.').css({
            "color": "green",
            "font-weight": "100",
            "font-size": "11px"
          });
          return value.match(reggst);
        } else if (value != '') {
          $("#GST_No_Error").show();
          $("#GST_No_Error").text('Invalid GST No.!').css({
            "color": "red",
            "font-weight": "100",
            "font-size": "11px"
          });
          return false;
        } else {
          $("#GST_No_Error").show();
          $("#GST_No_Error").text('Please fill required field!').css({
            "color": "red",
            "font-weight": "100",
            "font-size": "11px"
          });
          return false;
        }
      }
    });
  });

  function checkNumberOnly(event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
      event.preventDefault();
    }
  }
</script>
@endsection