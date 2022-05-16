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
                            <h4>Resend OTP Form</h4>
                            


                            

                            <!-- client / vendor reset form-->
                            <form method="post" action="{{ route('resendotp_post') }}">
                                @csrf
                            <div  id ="resetform01"class="show">
                                <div id="crederror"></div>
                                {{-- <input type="hidden" id="csrf" value="{{Session::token()}}"> --}}
                                <div class="form-group">

                                    <div class="form-group"><i class="fa fa-user"></i>
                                        <input name="email" type="text" id="email" tabindex="0" class="form-control underline-input" placeholder="User Name" >
                                        <span id="emailerror"></span>
                                    </div>

                                    <div class="form-group"><i class="fa fa-unlock-alt"></i>
                                        <input name="mobile" type="number" id="mobile" maxlength="10" class="form-control underline-input" placeholder="Enter Your Number" >
                                        <span id="moberror"></span>
                                    </div>

                                    <div class="form-group dp_ful captcha">
                                    </div>
                                    <div class="form-group text-left ">

                                        <input type="submit" value="Submit"  id="resetform" class="btn btn-greensea b-0 br-2 mr-3">

                                    </div>
                                </div>

                            </div>
                        </form>
                        <a href="{{URL::to('vendor-login')}}"><i class="fa fa-user"></i> Already Registered</a> &nbsp;&nbsp;
                        
                            <!-- end client / vendor  reset form-->
                            <!-- client / vendor otp form-->
                            

                             
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="loginfooter-lgn"><a class="explogologinpg" href="#">Managed by BECIL </a></footer>
    </div>
</div>




@endsection
