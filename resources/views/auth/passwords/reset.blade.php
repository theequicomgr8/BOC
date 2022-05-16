@extends('layouts.layout')
<style>
    .hide {
        display: none;
    }
</style>
@section('content')
<div class="form-validation mt-20">
    <!-- <h4>Client/ Partner Login</h4> -->
    <h4 class="text-right">Forgot Password</h4>
    <!-- client / vendor reset form-->
    <div id="resetform01" class="show">
        <div id="crederror"></div>
        <input type="hidden" id="csrf" value="{{Session::token()}}">
        <div class="form-group">
            <div class="form-group"><i class="fa fa-user"></i>
                <input name="email" type="text" id="email" tabindex="0" class="form-control underline-input" placeholder="Enter Email">
                <span id="emailerror"></span>
            </div>
            <div class="form-group"><i class="fa fa-unlock-alt"></i>
                <input name="mobile" type="text" id="mobile" class="form-control underline-input" maxlength="10" placeholder="Enter Mobile">
                <span id="moberror"></span>
            </div>
            <div class="form-group dp_ful captcha">
            </div>
            <div class="form-group text-left">
                <input type="submit" value="Submit" id="resetform" class="btn btn-greensea b-0 br-2 mr-3">
            </div>
        </div>
        <a style="text-shadow: 0px 1px 5px #fff;" class="new-registration-link" href="{{URL::to('vendor-login')}}"><i class="fa fa-user"></i> Login</a>
    </div><!-- end client / vendor  reset form-->
    <!-- client / vendor otp form-->
    <div id="otpdiv" class="hide">
        <div id="otperror"></div>
        <div class="alert alert-success" id="credotp"></div>
        <div class="form-group">
            <div class="form-group"><i class="fa fa-unlock-alt"></i>
                <input type="text" name="email_otp" id="email_otp" class="form-control underline-input" placeholder="Enter Email OTP" maxlength="4"><span id="email_otperr"></span>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group"><i class="fa fa-unlock-alt"></i>
                <input type="text" name="mobile_otp" id="mobile_otp" class="form-control underline-input" placeholder="Enter Mobile OTP" maxlength="4"><span id="mobile_otperr"></span>
            </div>
        </div>
        <div class="form-group text-left ">
            <input type="submit" value="Submit" id="otpSubmit" class="btn btn-greensea b-0 br-2 mr-3">
        </div>
    </div><!-- end client / vendor  otp form-->
    <!-- client / vendor newpassword form-->
    <div id="newpassdiv" class="hide">
        <div class="alert alert-success" id="credpass" style="display: none;"></div>
        <div class="alert alert-danger" id="passnotmatch" style="display: none;color:red"></div>
        <div class="form-group">
            <div class="form-group" id="pwd-container"><i class="fa fa-unlock-alt"></i>
                <input type="password" name="npassword" id="npassword" class="form-control underline-input" placeholder="Enter Password" onkeydown="return showProgressbar(this.value)"><span id="passerror"></span>
                <div class="col-sm-12 mt-1">
                    <div class="pwstrength_viewport_progress"></div>
                </div>
            </div>
            <div class="row">
                <div id="messages" class="col-sm-12"></div>
            </div>
            <div class="form-group" id="pwd-container"><i class="fa fa-unlock-alt"></i>
                <input type="password" name="confpassword" id="confpassword" class="form-control underline-input" placeholder="Enter Confirm Password"><span id="confpasserror"></span>
            </div>
            <div class="form-group dp_ful captcha">
            </div>
            <div class="form-group text-left">
                <input type="submit" value="Submit" id="newpassSubmit" class="btn btn-greensea b-0 br-2 mr-3" disabled>
            </div>
        </div>
    </div><!-- end client / vendor  newpassword form-->
</div>
@endsection
@section('custom_js')
<script type="text/javascript">
    $(function() {
        $("#otpdiv").hide();
        $("#newpassdiv").hide();
        $("#resetform").click(function() {
            var mobile = $("#mobile").val();
            var email = $("#email").val();
            var token = $("#csrf").val();
            if (email == '') {
                $('#emailerror').html('<h7 style="color:red">Enter User Email<h7>');
                return false;
            } else {
                $('#emailerror').html('');
            }
            if (mobile == '') {
                $('#moberror').html('<h7 style="color:red">Enter Mobile No.<h7>');
                return false;
            } else {
                $('#moberror').html('');
            }

            $.ajax({
                url: 'forgot-password',
                type: 'POST',
                data: {
                    _token: token,
                    mobile: mobile,
                    email: email
                },
                success: function(result) {
                    console.log(result);
                    var result = JSON.parse(result);
                    if (result.statusCode == 200) {
                        $("#resetform01").hide();
                        $("#otpdiv").show();
                        $('#credotp').text(result.msg);
                    } else {
                        $('#crederror').html('<h7 style="color:red">' + result.msg + '<h7>');
                    }
                }
            })
        })

        $("#otpSubmit").click(function() {
            var email_otp = $("#email_otp").val();
            email_otp = email_otp.trim();
            var mobile_otp = $("#mobile_otp").val();
            mobile_otp = mobile_otp.trim();
            var token = $("#csrf").val();
            if (email_otp == '' || mobile_otp == '') {
                if (email_otp == '') {
                    $('#email_otperr').html('<h7 style="color:red"> Enter Email One time Password <h7>');
                    return false;
                } else {
                    $('#email_otperr').html('');
                }
                if (mobile_otp == '') {
                    $("#mobile_otperr").html('<h7 style="color:red"> Enter Mobile One time Password <h7>');
                } else {
                    $('#mobile_otperr').html('');
                }
            } else {
                $.ajax({
                    type: "post",
                    url: 'submitotp',
                    data: {
                        _token: token,
                        email_otp: email_otp,
                        mobile_otp: mobile_otp
                    },
                    success: function(otpResult) {
                        otpResult = JSON.parse(otpResult);
                        if (otpResult.statusCode == 200) {
                            $("#resetform01").hide();
                            $("#otpdiv").hide();
                            $("#newpassdiv").show();
                            //location.replace("vendor-login");
                        } else {
                            $('#otperror').html('<h7 style="color:red"> ' + otpResult.msg + ' <h7>');
                        }
                    }
                });
            }
        });

        $("#newpassSubmit").click(function() {
            var npassword = $("#npassword").val();
            var confpassword = $("#confpassword").val();
            console.log(npassword);
            npassword = npassword.trim();
            var token = $("#csrf").val();
            if (npassword == '') {
                $('#passerror').html('<h7 style="color:red"> Enter Password <h7>');
                return false;
            } else {
                $('#passerror').html('');
            }
            if (confpassword == '') {
                $('#confpasserror').html('<h7 style="color:red"> Enter Confirm Password <h7>');
                return false;
            } else {
                $('#confpasserror').html('');
            }
            if (npassword != confpassword) {
                $('#passnotmatch').html('Password not match.').show();
                return false;
            } else {
                $('#passnotmatch').html('').hide();
            }
            $.ajax({
                type: "post",
                url: 'updatepassword',
                data: {
                    _token: token,
                    npassword: npassword
                },
                success: function(otpResult) {
                    otpResult = JSON.parse(otpResult);
                    if (otpResult.statusCode == 200) {
                        $('.alert-success').fadeIn().html(otpResult.msg).show();
                        setTimeout(function() {
                            $('.alert-success').fadeOut("slow");
                            location.replace("vendor-login");
                        }, 3000);

                    } else {
                        $('#otperror').html('<h7 style="color:red"> ' + result.msg + ' <h7>');
                    }
                }
            })
        })
    });
</script>

<script>
    jQuery(document).ready(function() {
        $(".pwstrength_viewport_progress").hide();
        "use strict";
        var options = {};
        options.ui = {
            bootstrap4: true,
            container: "#pwd-container",
            viewports: {
                progress: ".pwstrength_viewport_progress"
            },
            showVerdictsInsideProgressBar: true
        };
        options.common = {
            debug: true,
            onLoad: function() {
                $('#npassword').text('');
            }
        };
        $('#npassword:password').pwstrength(options);
    });

    function showProgressbar(val) {
        $(".pwstrength_viewport_progress").show();
        var passstrenth = $('.password-verdict').text();
        if (val == '' || passstrenth == 'Very Weak' || passstrenth == 'Weak') {
            $('#newpassSubmit').attr('disabled', true);
        } else {
            $('#newpassSubmit').attr('disabled', false);
        }
    }
</script>
@endsection