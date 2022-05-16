@extends('layouts.layout')
@section('title', 'Sign in/ Sign up Form')
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
    @if(session()->has('success_message'))
    <div class="alert alert-success">
        {{ session()->get('success_message') }}
    </div>
    @endif
    @if(session()->has('otp_success'))
    <div class="alert alert-success">
        {{ session()->get('otp_success') }}
    </div>
    @endif
    <!-- <h4>Client/ Partner Login</h4> -->
    <h4>
        @if(last(request()->segments())=='rob-login')
        {{'ROB-LOGIN'}}
        @else
        {{'Sign in'}}
        @endif
    </h4>
    @if(last(request()->segments())=='rob-login')
    <form method="POST" action="{{URL::to($current_url)}}">
        @csrf
        <input id="userTypeHidden" type="hidden" name="userTypeHidden" value="{{request()->user_type}}">
        <div class="form-group"><i class="fa fa-user"></i>
            <input name="email" type="text" id="email" tabindex="0" onkeypress="return alphadash(event,this);" class="form-control underline-input" placeholder="User Name" required="required">
            <!-- @error('email')
                                {{'Only Alpha Character'}}
                                @enderror -->
        </div>

        <div class="form-group"><i class="fa fa-unlock-alt"></i>
            <input name="password" type="password" id="password" class="form-control underline-input" placeholder="Password" required="required">
        </div>

        <div class="form-group text-left ">
            <button type="submit" class="btn btn-greensea btn-block  animated-button">Login</button>
        </div>
    </form>
    @elseif(last(request()->segments())=='vendor-login')
    <!-- client / vendor login-->
    <form method="POST" action="{{URL::to($current_url)}}">
        @csrf
        <div class="form-group">
            <select name="login_type" id="login_type" class="form-control underline-input select1" required>
                <option value="">Select Login Type</option>
                <!-- <option value="1">Email</option> -->
                <option value="2">GST</option>
                <option value="3">User ID</option>
                <option value="4">Agency Code</option>
            </select>
        </div>
        <input id="userTypeHidden" type="hidden" name="userTypeHidden" value="{{request()->user_type}}">
        <div class="form-group"><i class="fa fa-user"></i>
            <input name="email" type="text" id="email" tabindex="0" class="form-control underline-input vendorlogintypeplace" placeholder="Select login type" required="required">
            @error('email')
            {{'Only Alpha Character'}}
            @enderror
        </div>

        <div class="form-group"><i class="fa fa-unlock-alt"></i>
            <input name="password" type="password" id="password" class="form-control underline-input" placeholder="Enter Password" required="required">
        </div>

        <div class="form-group dp_ful captcha">
            <!--  <span class="re flt mr10" ng-click="Captha()" style="cursor:pointer;">
                                <i class="fa fa-refresh" aria-hidden="true"></i> <span class="rand1 captcha_txt flt mr10">10</span> <span class="captcha_txt flt mr10">+</span> <span class="rand2 captcha_txt flt mr10">14</span> <span class="captcha_txt flt mr10">=</span> <span class="captcha_txt flt pull-right">
                                    <input type="text" id="" placeholder="" autocomplete="off" class="form-control ng-pristine ng-untouched ng-invalid ng-invalid-required" ng-model="Caltotal" only-digits="" required="">
                                </span>
                            </span> -->
        </div>
        <div class="form-group text-left ">

            <input type="submit" value="Login" class="btn btn-greensea b-0 br-2 mr-3">
            <a href="{{url('reset-password')}}" class="frgt">Forgot password?</a>
        </div>
    </form><!-- end client / vendor login-->
    <a href="{{URL::to('vendor-signup')}}"><i class="fa fa-user"></i> New Vendor Registration</a><br>
        @if(session()->has('email_verified') && session('email_verified') == 0)
    <a href="{{url('signup_confirm')}}"> <i class="fa fa-user"></i> Email Verification</a>
    @endif
    @else
    <!-- client / vendor login-->
    <form method="POST" action="{{URL::to($current_url)}}">
        @csrf      
        <input id="userTypeHidden" type="hidden" name="userTypeHidden" value="{{request()->user_type}}">
        <div class="form-group"><i class="fa fa-user"></i>
            <input name="email" type="text" id="email" tabindex="0" class="form-control underline-input" placeholder="Enter User ID" required="required">
            @error('email')
            {{'Only Alpha Character'}}
            @enderror
        </div>

        <div class="form-group"><i class="fa fa-unlock-alt"></i>
            <input name="password" type="password" id="password" class="form-control underline-input" placeholder="Enter Password" required="required">
        </div>

        <div class="form-group dp_ful captcha">
            <!--  <span class="re flt mr10" ng-click="Captha()" style="cursor:pointer;">
                                <i class="fa fa-refresh" aria-hidden="true"></i> <span class="rand1 captcha_txt flt mr10">10</span> <span class="captcha_txt flt mr10">+</span> <span class="rand2 captcha_txt flt mr10">14</span> <span class="captcha_txt flt mr10">=</span> <span class="captcha_txt flt pull-right">
                                    <input type="text" id="" placeholder="" autocomplete="off" class="form-control ng-pristine ng-untouched ng-invalid ng-invalid-required" ng-model="Caltotal" only-digits="" required="">
                                </span>
                            </span> -->
        </div>
        <div class="form-group text-left ">

            <input type="submit" value="Login" class="btn btn-greensea b-0 br-2 mr-3">
            <a href="{{url('reset-password')}}" class="frgt">Forgot password?</a>
        </div>
    </form><!-- end client / vendor login-->
    @endif
    
</div>
@endsection
@section('custom_js')
<script type="text/javascript">
    function alphadash(event) {
        var inputValue = event.charCode;
        if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0) && (inputValue != 45)) {
            event.preventDefault();
        }
    }
    $(document).ready(function() {
        $('.alert-success').fadeIn();
        setTimeout(function() {
            $('.alert-success').fadeOut("slow");
        }, 5000);
    });
    
    $(document).ready(function(){
        $('#login_type').change(function(){
            var textval = $(this).find("option:selected").text();
            console.log(textval);
            $('.vendorlogintypeplace').attr("placeholder",'Enter '+textval);
        });
    })
</script>
@endsection