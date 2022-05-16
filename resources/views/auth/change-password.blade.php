@extends('admin.layouts.layout')
<style>
body {
color: #6c757d !important;
}

.hide-msg {
display: none !important;
}

.fa-check {
color: green;
}

.input-group-text {
height: 32px !important;
}

.custom-file-label {
height: 32px !important;
overflow: hidden;
}

.custom-file-label::after {
height: 30px !important;
}

.input-group-text {
font-size: 0.8rem !important;
}

/* .input-group {
width: 80% !important;
float: right !important;
} */

.flexview {
display: inline-flex;
}

.eyecolor {
color: #007bff !important;
}

.iframemargin {
margin-bottom: -50px;
}

.fieldset-border {
width: 100%;
border: solid 1px #ccc;
border-radius: 5px;
margin: 0 10px 15px 10px;
padding: 0 15px;
}

.fieldset-border legend {
width: auto;
background: #fff;
padding: 0 10px;
font-size: 14px;
font-weight: 600;
color: #3d63d2;
}

.subheading {
font-size: 16px;
font-weight: 500;
color: #4066d4;
border-bottom: solid 1px #4066d4;
margin-bottom: 15px;
}

.divmargin {
margin-top: 19px;
}

</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-2">
            <div class="panel panel-default">
                <h5>Change password</h5>
                <div class="panel-body">
                    @if(session()->has('status'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    {{-- @if(session()->has('status')==false)
                    <div class="alert alert-danger">
                        {{ session()->get('message') }}
                    </div>
                    @endif --}}
                    <form class="form-horizontal" method="POST" action="{{ route('changePasswordPost') }}" id="myForm">
                        @csrf
                            <label for="current_password" class="col-md-4 control-label">Current Password <font color="red">*</font></label>
                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control" name="current_password"  maxlength="20" required>
                                <span id="current_pass"></span>
                            </div>

                            <label for="new_password" class="col-md-4 control-label">New Password <font color="red">*</font></label>
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password"  maxlength="20" required>
                                <span id="new_pass"></span>
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirm" class="col-md-4 control-label">Confirm New Password <font color="red">*</font></label>
                                <div class="col-md-6">
                                    <input id="new_password_confirm" type="password" class="form-control" name="new_password_confirm"  maxlength="20" required>
                                    <span id="new_confirm_pass"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="submit" value="Submit" id="chngepass" class="btn btn-greensea b-0 br-2 mr-3">
                                    {{-- <button type="submit" class="btn btn-primary" id="chngepass">Submit</button> --}}
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
    $(document).on('keyup', '#password', function() {
        var val = $(this).val()
        if (isNaN(parseInt(val))) {
            alert("password is valid");
        } else {
            alert("Password should not start with number");
        }
    });
});

jQuery.validator.addMethod(
  "myPasswordMethod",
  function(value, element) {
    return value.match(/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/);
  },
  "Please enter a valid password"
);

$(document).ready(function() {
    $("#myForm").validate({
        rules: {
            current_password: "myPasswordMethod",
        }
    });
});




 ///alpha numeric
// function isAlphaNumeric(value) {
// // Alphanumeric only
//  // var k = new RegExp("/^[a-zA-Z0-9!@#$%^&*]{6,16}$/;");
//  console.log(value);
//   return /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(value);
//   //document.all ? k = e.keycode : k = e.which;
//  // return ((k > 47 && k < 58) || (k > 64 && k < 91) || (k > 96 && k < 123) || (k == 32) || k == 0);
// }


$(document).ready(function() {
    $("#chngepass").click(function() {
        var current_password = $("#current_password").val();
        var new_password = $("#new_password").val();
        var new_password_confirm = $("#new_password_confirm").val();
       // console.log(new_password_confirm);
        if (current_password == '') {
            $('#current_pass').html('<h7 style="color:red">You have entered wrong current password!<h7>');
            return false;
        } else {
            $('#current_pass').html('');
        }
        if(new_password == ''){
            $('#new_pass').html('<h7 style="color:red">Enter New Password<h7>');
            return false;
        } else {
            $('#new_pass').html('');
        }
        if(new_password_confirm == ''){
            $('#new_confirm_pass').html('<h7 style="color:red">New password and confirm password should be same!<h7>');
            return false;
        } else {
            $('#new_confirm_pass').html('');
        }
    });
});
</script>
