@extends('admin.layouts.layout')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<title>BOC Client/ Partner Forgot Password</title>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" >
<link rel="stylesheet" href="{{ asset('login/css/style.css')}}" > -->
<div class="lgt-frm adt-cd">
    <div id="wrap" class="animsition backlayer" style="opacity: 1;">



        <div class="container">
            <div class="layerRight col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-login">
                    <div class="login-page float-right">
                        <div class="form-validation mt-20"> 
                           
                            <!-- <h4>Client/ Partner Login</h4> -->
                            <h4>Client/ Partner Forgot Password</h4>

                            <!-- client / vendor reset form-->
                            <div  id ="resetform01"class="show">
                                <div id="crederror"></div>
                                <input type="hidden" id="csrf" value="{{Session::token()}}">
                                <div class="form-group">

                                    <div class="form-group"><i class="fa fa-user"></i>
                                        <input name="email" type="text" id="email" tabindex="0" class="form-control underline-input" placeholder="User Name" >
                                        <span id="emailerror"></span>
                                    </div>

                                    <div class="form-group"><i class="fa fa-unlock-alt"></i>
                                        <input name="mobile" type="text" id="mobile" class="form-control underline-input" placeholder="Mobile" >
                                        <span id="moberror"></span>
                                    </div>

                                    <div class="form-group dp_ful captcha">
                                    </div>
                                    <div class="form-group text-left ">

                                        <input type="submit" value="Submit"  id="resetform" class="btn btn-greensea b-0 br-2 mr-3">

                                    </div>
                                </div>

                            </div><!-- end client / vendor  reset form-->
                            <!-- client / vendor otp form-->
                            <div  id ="otpdiv"class="hide">
                                <!-- <input type="hidden" id="csrf" value="{{Session::token()}}"> -->
                                <div class="form-group">

                                    <!-- <div class="form-group"><i class="fa fa-user"></i>
                                        <input name="email" type="text" id="email" tabindex="0" class="form-control underline-input" placeholder="User Name" required="required">
                                    </div> -->

                                    <div class="form-group"><i class="fa fa-unlock-alt"></i>
                                        <input type="text" name="otp"  id="otp" class="form-control underline-input" placeholder="Enter Otp" ><span id ="otperror"></span>
                                    </div>

                                    <div class="form-group dp_ful captcha">
                                    </div>
                                    <div class="form-group text-left ">

                                        <input type="submit" value="Submit"  id="otpSubmit" class="btn btn-greensea b-0 br-2 mr-3">

                                    </div>
                                </div>

                            </div><!-- end client / vendor  otp form-->

                             <!-- client / vendor newpassword form-->
                            <div  id ="newpassdiv"class="hide">
                               
                                <div class="form-group">

                                    <div class="form-group"><i class="fa fa-unlock-alt"></i>
                                        <input type="password" name="npassword"  id="npassword" class="form-control underline-input" placeholder="Enter New Password" ><span id ="passerror"></span>
                                    </div>

                                    <div class="form-group dp_ful captcha">
                                    </div>
                                    <div class="form-group text-left ">

                                        <input type="submit" value="Submit"  id="newpassSubmit" class="btn btn-greensea b-0 br-2 mr-3">

                                    </div>
                                </div>

                            </div><!-- end client / vendor  newpassword form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="loginfooter-lgn"><a class="explogologinpg" href="#">Managed by BECIL </a></footer>
    </div>
</div>

<script type="text/javascript">

    $(function(){
      $("#otpdiv").hide(); 
      $("#newpassdiv").hide();
      $("#resetform").click(function(){

            var mobile= $("#mobile").val();
            var email = $("#email").val();
            var token = $("#csrf").val();
            if(email==''){
               $('#emailerror').html('<h7 style="color:red">Enter User Name<h7>');
               return false;
            }else{
                  $('#emailerror').html('');  
            }
            if(mobile==''){
                $('#moberror').html('<h7 style="color:red">Enter Mobile No.<h7>');
                return false;
            }else{
               $('#moberror').html('');
            }

           $.ajax({
                url:'forgot-password',
                type:'POST',
                data:{
                    _token:token,
                    mobile:mobile,
                    email:email
                },
                success:function(result){
                    var result = JSON.parse(result);
                    if(result.statusCode == 200){
                        $("#resetform01").hide();
                        $("#otpdiv").show();   
                    }
                    else{
                        $('#crederror').html('<h7 style="color:red">'+result.msg+'<h7>');
                    }
                }
            })
        })

        $("#otpSubmit").click(function(){
            var otp = $("#otp").val();
            otp = otp.trim();
            var token = $("#csrf").val();
            if(otp==''){
               $('#otperror').html('<h7 style="color:red"> Enter One time Password <h7>');
               return false;
            }else{
              $('#otperror').html('');  
            }
            $.ajax({
                type:"post",
                url:'submitotp',
                data:{
                    _token:token,
                    otp:otp
                },
                success:function(otpResult){
                    otpResult = JSON.parse(otpResult);
                    if(otpResult.statusCode == 200){
                        $("#resetform01").hide();
                        $("#otpdiv").hide();
                        $("#newpassdiv").show();
                            //location.replace("vendor-login");
                    }
                    else{
                       $('#otperror').html('<h7 style="color:red"> '+result.msg+' <h7>');
                   }
                }
           })
        })
        $("#newpassSubmit").click(function(){
            var npassword = $("#npassword").val();
            console.log(npassword);
            npassword = npassword.trim();
            var token = $("#csrf").val();
            if(npassword==''){
               $('#passerror').html('<h7 style="color:red"> Enter New Password <h7>');
               return false;
            }else{
              $('#passerror').html('');  
            }
            $.ajax({
                type:"post",
                url:'updatepassword',
                data:{
                    _token:token,
                    npassword:npassword
                },
                success:function(otpResult){
                    otpResult = JSON.parse(otpResult);
                    if(otpResult.statusCode == 200){
                       
                        location.replace("vendor-login");
                    }
                    else{
                       $('#otperror').html('<h7 style="color:red"> '+result.msg+' <h7>');
                   }
                }
           })
        })
    })

</script>


@endsection
