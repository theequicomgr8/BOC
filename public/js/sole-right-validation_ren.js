function alphaOnly(event) {
  var inputValue = event.charCode;
  if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
    event.preventDefault();
  }
}

$(document).ready(function () {
  $(".pm-next-button").click(function () {
    var form = $("#sole_right_media");
    form.validate({
      rules: {
        "owner_name[]": {
          mytst1: true,
          minlength: 5,
          maxlength: 40
        },
        "owner_email[]": {
          mytst1: true,
          emailExt: true
        },
        "owner_mobile[]": {
          mytst1: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        "address[]": {
          mytst1: true
        },
        "state[]": {
          mytst1: true
        },
        "city[]": {
          mytst1: true
        },
        "district[]": {
          mytst1: true
        },
        "phone[]": {
          minlength: 3,
          maxlength: 14,
          number: true
        },
        "fax_no[]": {
          minlength: 3,
          maxlength: 14,
          number: true
        },
        HO_Address: {
          required: true
        },
        HO_Landline_No: {
          required: true,
          minlength: 3,
          maxlength: 15,
          number: true
        },
        fax_head_office: {
          required: true,
          minlength: 3,
          maxlength: 14,
          number: true
        },
        HO_Email: {
          required: true,
          emailExt: true
        },
        HO_Mobile_No: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        "BO_state[]": {
          mytst1 : true,
        },
        "BO_Address[]": {
          mytst1 : true,
        },
        "BO_Landline_No[]": {
          mytst1 : true,
        },
        "BO_Email[]": {
          mytst1 : true,
        },
        "BO_Mobile[]": {
          mytst1 : true,
        },
        "Authorized_Rep_Name[]": {
          mytst1 : true,
        },
        "AR_Address[]": {
          mytst1 : true,
        },
        "AR_Landline_No[]": {
          mytst1 : true,
        },
        "AR_Email[]": {
          mytst1 : true,
        },
        "AR_Mobile_No[]": {
          mytst1 : true,
        },
        "Legal_Status_of_Company[]": {
          mytst1 : true,
        },
        "from_date[]": {
          // mytst1 : true,
          required:true,
        },
        "to_date[]": {
          mytst1 : true,
        },


        Legal_Status_of_Company: {
          required: true,
        },
        Notarized_Copy_File_Name: {
          required: true,
        },
        Attach_Copy_Of_Pan_Number_File_Name: {
          required: true,
        },
        Affidavit_File_Name: {
          required: true,
        },
        Photo_File_Name: {
          required: true,
        },
        Legal_Doc_File_Name: {
          required: true,
        },
        GST_File_Name: {
          required: true,
        },
        contact_authorized: {
          minlength: 5,
          maxlength: 100
        },
        landline_authorized: {
          minlength: 3,
          maxlength: 14,
          number: true
        },
        fax_authorized: {
          minlength: 3,
          maxlength: 14,
          number: true
        },
        email_authorized: {
          email: true
        },
        mobile_authorized: {
          minlength: 10,
          maxlength: 10,
          number: true
        },
        "MA_City[]": {
          mytst1: true
        },
        "MA_State[]": {
          mytst1: true
        },
        "MA_District[]": {
          mytst1: true
        },
        // 'Illumination_media[]': {
        //   mytst1: true
        // },
        size_of_media: {
          required: true,
        },
        year_media: {
          required: true,
        },
        quantity_duration_media: {
          required: true,
        },
        billing_amount_media: {
          required: true,
        },
        DD_No: {
          required: true,
        },
        DD_Date: {
          required: true,
        },
        DD_Bank_Name: {
          required: true,
        },
        DD_Bank_Branch_Name: {
          required: true,
          alphanumeric: true
        },
        PM_Agency_Name: {
          required: true,
        },
        Bank_Name: {
          required: true,
        },
        branch_2: {
          required: true,
          alphanumeric: true,
        },
        ifsc_code_sole: {
          required: true,
        },
        Application_Amount: {
          required: true,
          number: true,
          range: [1000, 10000],
        },
        DD_Bank_Branch_Name: {
          required: true,
        },
        branch_name_media: {
          required: true,
        },
        pan_no_sole: {
          required: true,
        },
        bank_name_1: {
          required: true,
        },
        Bank_Branch: {
          required: true,
        },
        IFSC_Code: {
          IFSCvalid: true,
        },
        Account_No: {
          required: true,
        },
        "ODMFO_Display_Size_Of_Media[]": {
          mytst1: true
        },
        "ODMFO_Year[]": {
          // mytst1: true
          required:true,
        },
        "ODMFO_Quantity_Of_Display_Or_Duration[]": {
          // mytst1: true
          required:true,
        },
        "ODMFO_Billing_Amount[]": {
          // mytst1: true
          required:true,
        },
        PAN: {
          Panvalid: true,
        },
        Authority_Which_granted_Media: {
          required: true,
        },
        Contract_No: {
          required: true,
        },
        License_Fee: {
          required: true,
        },
        Quantity_Of_Display: {
          required: true,
        },
        License_From: {
          required: true,
        },
        License_To: {
          required: true,
        },
        GST_No: {
          testgst: true,
        
        },
        "Applying_For_OD_Media_Type[]": {
          mytst1: true
        },
        self_declaration: {
          required: true,
        },
        "od_media_type[]": {
          mytst1: true
        },
        AR_Email: {
          required: true,
          email: true,
        },
        Authorized_Rep_Name: {
          required: true,
        },
        AR_Address: {
          required: true,
        },
        AR_Landline_No: {
          required: true,
          minlength: 3,
          maxlength: 15,
        },
        AR_FAX_No: {
          required: true,
          minlength: 3,
          maxlength: 15,
        },
        AR_Mobile_No: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        BO_Address: {
          required: true,
        },
        BO_Landline_No: {
          required: true,
          minlength: 3,
          maxlength: 15,
        },
        BO_Fax_No: {
          required: true,
        },
        BO_Email: {
          required: true,
        },
        BO_Mobile: {
          required: true,
        },
      },
      messages: {
        "owner_name[]": {
          required: "Please fill required field!",
          minlength: "Owner name must be at least 5 alphabets!",
          maxlength: "Users can type only max 40 alphabets!"
        },
        "owner_email[]": {
          required: "Please fill required field!",
          email: "Please enter a valid email address!"
        },
        "owner_mobile[]": {
          required: "Please fill required field!",
          minlength: "Mobile length should be 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        "address[]": {
          required: "Please fill required field!"
        },
        "state[]": {
          required: "Please select an state!"
        },
        "city[]": {
          required: "Please fill required city!"
        },
        "district[]": {
          required: "Please fill required district!"
        },
        "phone[]": {          
          minlength: "Phone number should be min 3 digit!",
          maxlength: "Phone number should be max 14 digit!",
          number: "Users can enter only integer numbers!"
        },
        "fax_no[]": {          
          minlength: "Fax length should be min 3 digit!",
          maxlength: "Fax length should be max 14 digit!",
          number: "Users can enter only integer numbers!"
        },
        HO_Address: {
          required: "Please fill required field!"
        },
        HO_Landline_No: {
          required: "Please fill required field!",
          minlength: "Landline number should be min 3 digit!",
          maxlength: "Landline number should be max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        fax_head_office: {
          required: "Please fill required field!",
          minlength: "Fax length should be min 3 digit!",
          maxlength: "Fax length should be max 14 digit!",
          number: "Users can enter only integer numbers!"
        },
        HO_Email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        HO_Mobile_No: {
          required: "Please fill required field!",
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        Legal_Status_of_Company: {
          required: "Please fill required field!",
        },
        contact_authorized: {
          minlength: "Owner name must be at least 5 alphabets!",
          maxlength: "Users can type only max 100 alphabets!"
        },
        landline_authorized: {          
          minlength: "Landline number should be min 3 digit!",
          maxlength: "Landline number should be max 14 digit!",
          number: "Users can enter only integer numbers!"
        },
        fax_authorized: {          
          minlength: "Fax length should be min 3 digit!",
          maxlength: "Fax length should be max 14 digit!",
          number: "Users can enter only integer numbers!"
        },
        email_authorized: {
          email: "Please enter a valid email address!"
        },
        mobile_authorized: {
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        "MA_City[]": {
          required: "Please fill required field!"
        },
        "MA_State[]": {
          required: "Please fill required field!"
        },
        "MA_District[]": {
          required: "Please fill required field!"
        },
        size_of_media: {
          required: "Please fill required field!"
        },
        year_media: {
          required: "Please fill required field!"
        },
        quantity_duration_media: {
          required: "Please fill required field!"
        },
        billing_amount_media: {
          required: "Please fill required field!"
        },
        DD_No: {
          required: "Please fill required field!"
        },
        DD_Date: {
          required: "Please fill required field!"
        },
        DD_Bank_Name: {
          required: "Please fill required field!"
        },
        branch_name_media: {
          required: "Please fill required field!",
        },

        PM_Agency_Name: {
          required: "Please fill required field!"
        },

        Bank_Name: {
          required: "Please fill required field!"
        },
        branch_2: {
          required: "Please fill required field!"
        },
        ifsc_code_sole: {
          required: "Please fill required field!",

        },
        Application_Amount: {
          required: "Please fill required field!",
          number: "Users can enter only integer numbers!",
          range: "Range shold be 1000 to 10,000.",
        },
        branch_name_sole: {
          required: "Please fill required field!",
        },
        bank_name_1: {
          required: "Please fill required field!",
        },
        Bank_Branch: {
          required: "Please fill required field!",
        },
        IFSC_Code: {
          required: "Please fill required field!",
        },
        Account_No_: {
          required: "Please fill required field!",
        },
        "ODMFO_Display_Size_Of_Media[]": {
          required: "Please fill required field!",
        },
        "ODMFO_Year[]": {
          required: "Please fill required field!",
        },
        "ODMFO_Quantity_Of_Display_Or_Duration[]": {
          required: "Please fill required field!",
        },
        "ODMFO_Billing_Amount[]": {
          required: "Please fill required field!",
        },
        PAN: {
          required: "Please fill required field!",
        },
        Notarized_Copy_File_Name: {
          required: "Please fill required field!",
        },
        Attach_Copy_Of_Pan_Number_File_Name: {
          required: "Please fill required field!",
        },
        Affidavit_File_Name: {
          required: "Please fill required field!",
        },
        Photo_File_Name: {
          required: "Please fill required field!",
        },
        Legal_Doc_File_Name: {
          required: "Please fill required field!",
        },
        GST_File_Name: {
          required: "Please fill required field!",
        },
        Authority_Which_granted_Media: {
          required: "Please fill required field!",
        },
        Contract_No: {
          required: "Please fill required field!",
        },
        License_Fee: {
          required: "Please fill required field!",
        },
        Quantity_Of_Display: {
          required: "Please fill required field!",
        },
        License_From: {
          required: "Please fill required field!",
        },
        License_To: {
          required: "Please fill required field!",
        },
        GST_No: {
          maxlength: "Gst number length should be 15 digit!",
          required: "Please fill required field!",
        },
        "Applying_For_OD_Media_Type[]": {
          required: "Please fill required field!",
        },
        self_declaration: {
          required: "Please fill required field!",
        },
        "od_media_type[]": {
          required: "Please fill required field!",
        },
        // 'Illumination_media[]': {
        //   required: "Please fill required field!",
        // },
        AR_Email: {
          required: "Please Fill required Field!",
          email: "Please Enter a Valid Email Address",
        },
        Authorized_Rep_Name: {
          required: "Please Fill required Field!",
        },
        AR_Address: {
          required: "Please Fill required Field!",
        },
        AR_Landline_No: {
          required: "Please Fill required Field!",
          minlength: "Landline number should be min 3 digit!",
          maxlength: "Landline number should be max 14 digit!",
        },
        AR_FAX_No: {
          required: "Please Fill required Field!",
          minlength: "Fax length should be min 3 digit!",
          maxlength: "Fax length should be max 14 digit!",
        },
        AR_Mobile_No: {
          required: "Please Fill required Field!",
        },
        BO_Address: {
          required: "Please Fill required Field!",
        },
        BO_Landline_No: {
          required: "Please Fill required Field!",
          minlength: "Landline number should be min 3 digit!",
          maxlength: "Landline number should be max 14 digit!",
        },
        BO_Fax_No: {
          required: "Please Fill required Field!",
          minlength: "Fax length should be min 3 digit!",
          maxlength: "Fax length should be max 14 digit!",
        },
        BO_Email: {
          required: "Please Fill required Field!",
        },
        BO_Mobile: {
          required: "Please Fill required Field!",
        },
        "BO_state[]": {
           required: "Please Fill required Field!",
         },
         "BO_Address[]": {
          rrequired: "Please Fill required Field!",
         },
         "BO_Landline_No[]": {
          required: "Please Fill required Field!",
         },
         "BO_Email[]": {
          required: "Please Fill required Field!",
         },
         "BO_Mobile[]": {
          required: "Please Fill required Field!",
         },
         "Authorized_Rep_Name[]": {
          required: "Please Fill required Field!",
         },
         "AR_Address[]":{
          required: "Please Fill required Field!",
         },
         "AR_Landline_No[]":{
          required: "Please Fill required Field!",
         },
         "AR_Email[]":{
          required: "Please Fill required Field!",
         },
         "AR_Mobile_No[]":{
          required: "Please Fill required Field!",
         },
         "altername_mobile[]":{
          required: "Please Fill required Field!",
         },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });


    function formSubmit()
    {
        var data = new FormData($("#sole_right_media")[0]);
        $.ajax({
          url : '/sole-right-renewal-form-submit',
          type: 'POST',
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          success:function(data)
          {
            console.log(data);
            swal("Data saved success. Your code "+ data.media_id).then(function(){
                window.location='';
              });
          }
        });
    }


    if (form.valid() === true) {
      if ($('#tab1').is(":visible")) {
        current_fs = $('#tab1');
        formSubmit();
        next_fs = $('#tab1');
        $("a[id='#tab1']").addClass("active");
        // $("a[id='#tab1']").removeClass("active");
        // $("a[id='#tab2']").addClass("active");
        // nextSaveData('next_tab_1');
        // $("#next_tab_1").val("0");

      } 

      // next_fs.show();
      current_fs.show();
    }
  });
  $('.reg-previous-button').click(function () {
    if ($('#tab2').is(":visible")) {
      current_fs = $('#tab2');
      next_fs = $('#tab1');
      $("a[id='#tab2']").removeClass("active");
      $("a[id='#tab1']").addClass("active");
      $("#next_tab_3").val("0");
    } else if ($('#tab3').is(":visible")) {
      current_fs = $('#tab3');
      next_fs = $('#tab2');
      $("a[id='#tab3']").removeClass("active");
      $("a[id='#tab2']").addClass("active");

    } else if ($('#tab4').is(":visible")) {
      current_fs = $('#tab4');
      next_fs = $('#tab3');
      $("a[id='#tab4']").removeClass("active");
      $("a[id='#tab3']").addClass("active");
    } else if ($('#tab5').is(":visible")) {
      current_fs = $('#tab5');
      next_fs = $('#tab4');
      $("a[id='#tab5']").removeClass("active");
      $("a[id='#tab4']").addClass("active");
    }

    next_fs.show();
    current_fs.hide();
  });
  //jquery required validation on next a
  // $(function () {

  //     $.validator.setDefaults({
  //       submitHandler: function () {
  //         stepper.next()
  //         // alert( "Form successful submitted!" );
  //       }
  //   });
  //email validation formate
  $.validator.addMethod("mytst1", function (value, element) {
    var flag = true;
    //console.log(flag + 'ram')
    var name = element.name;
    var id = element.id;
    var rename = name.substring(0, name.length - 2);
    var reid = id.substring(0, id.length - 1);

    $("[name^=" + rename + "]").each(function (i, j) {
      $(this).parent('p').find('span.error').remove();
      $(this).parent('p').find('span.error').remove();
      $("#" + reid + i).removeClass('is-invalid');
      // console.log(rename + 'ram');
      // console.log(reid + 'ram');
      if ($.trim($(this).val()) == '') {
        flag = false;
        $("#" + reid + i).addClass('is-invalid');
        $(this).parent('p').append('<span  id="' + reid + i + i + '-error" class="error invalid-feedback">Please fill required field!</span>');
      }
      $("#" + reid + i + "-error").hide();
    });

    //console.log(flag)
    return flag;
  }, "");
  jQuery.validator.addMethod("emailExt", function (value, element, param) {
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/);
  }, 'Please enter a valid email address');

///////////////////////IFSC///////////////
jQuery.validator.addMethod('IFSCvalid', function(value) {
    $("#IFSC_code_Error").hide();
    var reg = /[A-Z|a-z]{4}[0][a-zA-Z0-9]{6}$/;
    if (value.match(reg)) {
        $("#IFSC_code_Error").show();
        $("#IFSC_code_Error").text('Valid IFSC code').css({
            "color": "green",
            "font-weight": "100",
            "font-size": "11px"
        });
       return true;
    } else if (value != '' && value.match(reg) != true) {
        $("#IFSC_code_Error").show();
        $("#IFSC_code_Error").text('Invalid IFSC code!').css({
            "color": "red",
            "font-weight": "100",
            "font-size": "11px"
        });
        return false;
    } else {
        $("#IFSC_code_Error").show();
        $("#IFSC_code_Error").text('Please fill required field!').css({
            "color": "red",
            "font-weight": "100",
            "font-size": "11px"
        });
        return false;
    }
}, '');

//pan card validation
$.validator.addMethod('Panvalid', function(value) {
    var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/;
    $("#PAN_No_Error").hide();
    if (value.match(regExp)) {
        $("#PAN_No_Error").show();
        $("#PAN_No_Error").text('Valid Pan card No.').css({
            "color": "green",
            "font-weight": "100",
            "font-size": "11px"
        });
        return true;
    } else if (value != '' && value.match(regExp) != true) {
        $("#PAN_No_Error").show();
        $("#PAN_No_Error").text('Invalid Pan No.!').css({
            "color": "red",
            "font-weight": "100",
            "font-size": "11px"
        });
        return false;
    } else {
        $("#PAN_No_Error").show();
        $("#PAN_No_Error").text('Please fill required field!').css({
            "color": "red",
            "font-weight": "100",
            "font-size": "11px"
        });
        return false;
    }

}, '');
//GST validation 
     
    jQuery.validator.addMethod('testgst', function(value) {
        $(".gstvalidationMsg").hide();
        var reggst = (/\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/);
        if (value.match(reggst)) {
            $(".gstvalidationMsg").show();
            $(".gstvalidationMsg").text('Valid GST No.').css({
                "color": "green",
                "font-weight": "100",
                "font-size": "11px"
            });
            return value.match(reggst);
        } else if (value != '') {
            $(".gstvalidationMsg").show();
            $(".gstvalidationMsg").text('Invalid GST No.!').css({
                "color": "red",
                "font-weight": "100",
                "font-size": "11px"
            });
            return false;
        } else {
            $(".gstvalidationMsg").show();
            $(".gstvalidationMsg").text('Please fill required field!').css({
                "color": "red",
                "font-weight": "100",
                "font-size": "11px"
            });
            return false;
        }
    }, '');

});

/*Latitude & Longitude Decimal function*/

$('.lat_cls').on('keyup', function () {
  var latitude = $(this).val();

  if (latitude == Math.floor(latitude)) {
    $('#alert_lat').show();
    return false;
  }
  else {
    $('#alert_lat').hide();
  }

});

//Validation for number and .(Dot)
function onlyDotNumberKey(evt) {
  var ASCIICode = (evt.which) ? evt.which : evt.keyCode
  if (ASCIICode > 31 && (ASCIICode < 46 || ASCIICode > 57))
    return false;
  return true;
}

function onlyAlphabets(e, t) {
  try {
    if (window.event) {
      var charCode = window.event.keyCode;
    }
    else if (e) {
      var charCode = e.which;
    }
    else { return true; }
    if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode == 32))
      return true;
    else
      return false;
  }
  catch (err) {
    alert(err.Description);
  }

}

///alpha numeric
function isAlphaNumeric(e) { // Alphanumeric only
  var k;
  document.all ? k = e.keycode : k = e.which;
  return ((k > 47 && k < 58) || (k > 64 && k < 91) || (k > 96 && k < 123) || k == 0);
}

function onlyNumberKey(evt) {

  // Only ASCII character in that range allowed
  var ASCIICode = (evt.which) ? evt.which : evt.keyCode
  if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
    return false;
  return true;
}

// THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
function isNumber(evt, element) {

  var charCode = (evt.which) ? evt.which : event.keyCode

  if (
    (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // Check minus and only once.
    (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // Check dot and only once.
    (charCode < 48 || charCode > 57))
    return false;

  return true;
}
//float validation

//check fax length
/*function IsAlphaNumeric(e) {
            // alert(e.keyCode);
             var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
             var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <=

122) || (keyCode == 32));
             document.getElementById("error").style.display = ret ? "none" : "inline";
             return ret;
         }*/

// alphanumeric
function Validate(e) {
  var keyCode = e.keyCode || e.which;
  var errorMsg = document.getElementById("lblErrorMsg");
  //errorMsg.innerHTML = "";

  //Regex to allow only Alphabets Numbers Dash Underscore and Space
  var pattern = /^[a-z\d\-_\s]+$/i;

  //Validating the textBox value against our regex pattern.
  var isValid = pattern.test(String.fromCharCode(keyCode));
  if (!isValid) {
    errorMsg.innerHTML = "Invalid Attempt, only alphanumeric, dash , underscore and space are allowed.";
  }

  return isValid;
}

$('.lat_media').on('keyup', function () {
  var latitude = $(this).val();

  if (latitude == Math.floor(latitude)) {
    $('#alert_lat').show();
    return false;
  }
  else {
    $('#alert_lat').hide();
  }

});


$(document).ready(function () {
  $("#GST_No").blur(function(){
    $("#PM_Agency_Name").val('Please Wait');
  });


  $("#GST_No").on('blur', function () {
    // $("#PM_Agency_Name").val('');
    var gstNumber = $("#GST_No").val();
    $.ajax({
      url: '/checkgstsole',
      type: 'GET',
      data: { gstNumber: gstNumber },
      success: function (data) {
        console.log(data);
        $("#PM_Agency_Name").val('');
        $("#PM_Agency_Name").val(data.legalName);
        // $("#PM_Agency_Name").val('Please Wait...');
        // setTimeout(function () {
        //   $("#PM_Agency_Name").val(data.legalName);
        // }, 5000);

      }
    });
  });
});



$("#ifsc_code").on('blur', function () {
  var IFSC = $(this).val();
  $.ajax({
    url: 'https://ifsc.razorpay.com/' + IFSC,
    type: 'get',
    success: function (data) {
      if (data.UPI == true && IFSC != '') {
        console.log(data);
        $("#bank_name_22").val(data.BANK);
        $("#branch_22").val(data.BRANCH);
        $("#address_of_account").val(data.ADDRESS);
      } else {
        $("#bank_name").val('');
        $("#branch_name").val('');
        $("#address_of_account").val('');
      }
    },
    error: function (error) {
      console.log(error);
    }

  })
})



$(document).ready(function () {
  // $("#applying_media").change(function () {
  //   var applying_media = $("#applying_media").val();
  //   $.ajax({

  //   });
  // });


  $("#exist_owner_id").blur(function(){
    var group_code=$(this).val();
    $.ajax({
      url : '/existing_user',
      type: 'GET',
      dataType:'json',
      data: {code : group_code},
      // contentType:false,
      // cache:false,
      // processData:false,
      success:function(data)
      {
        console.log(data[0].msg.name);
        if(data[0].status!=0)
        {
          $(".owner_name").val(data[0].msg.name);
          $(".owner_email").val(data[0].msg.email);
          $(".owner_mobile").val(data[0].msg.mobile);
          $(".owner_address").val(data[0].msg.address);
          $(".owner_city").val(data[0].msg.City);
          $(".owner_phone").val(data[0].msg.phone_no);
          $(".owner_state").val(data[0].msg.State);
          $(".owner_district").html("<option value='"+ data[0].msg.District +"'>"+data[0].msg.District +"</option>");
          // alert("Yes");
        }
        else
        {
          alert("No");
          // $(".owner_name").removeAttr('value');
          $(".owner_name").val('');
          $(".owner_email").val('');
          $(".owner_mobile").val('');
          $(".owner_address").val('');
          $(".owner_city").val('');
          $(".owner_phone").val('');
          $(".owner_state").val('');
          $(".owner_district").val('');
        }
        
      }
    });
  });

















  // $(document).on("change",".subcategory",function(){
  //   var getID=$(this).attr('data-eid');
  //   var sub_category_val=$("#"+getID).val();
  //   $.ajax({
  //     url : '/find-sub-category',
  //     type : 'GET',
  //     data:{sub_category_val : sub_category_val},
  //     success:function(data)
  //     {
  //       if(data.status=='1')
  //       {
  //         swal("Error", "You can not select this value!", "error");
  //         $("#"+getID).val('');
  //         // sweet alert
  //       }
        
  //     }
  //   });
    
  // });


   
});
