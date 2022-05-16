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
          // required: true,
          // minlength: 3,
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
          required: true,
        },
        "BO_Address[]": {
          required: true,
        },
      
        "BO_Email[]": {
          required: true,
          emailExt: true
        },
        "BO_Mobile[]": {
          mytst1: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        "Authorized_Rep_Name[]": {
          required: true,
        },
        "AR_Address[]": {
          required: true,
        },
        // "AR_Landline_No[]":{
        //  required:true,
        // },
        "AR_Email[]": {
          required: true,
          emailExt: true,
        },
        "AR_Mobile_No[]": {
          mytst1 : true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        // "altername_mobile[]": {
        //   required: true,
        // },


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
        "Applying_For_OD_Media_Type[]": {
          mytst1: true
        },
        "od_media_type[]": {
          mytst1: true
        },
        "quantity[]": {
          mytst1: true
        },
        // "Size_Type[]": {
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
          mytst1: true
        },
        "ODMFO_Quantity_Of_Display_Or_Duration[]": {
          mytst1: true
        },
        "ODMFO_Billing_Amount[]": {
          mytst1: true
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
        License_From: {
          required: true,
        },
        License_To: {
          required: true,
        },
        GST_No: {
          testgst: true,

        },
       
        self_declaration: {
          required: true,
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
          minlength: "Mobile length should be 10 digit!",
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
          minlength: "Mobile length should be 10 digit!",
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
        "Applying_For_OD_Media_Type[]": {
          required: "Please fill required field!",
        },
        "od_media_type[]": {
          required: "Please fill required field!",
        },
        "quantity[]": {
          required: "Please fill required field!"
        },
        // "Size_Type[]": {
        //   required: "Please fill required field!"
        // },
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
          required: "Please fill required field!"
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
        self_declaration: {
          required: "Please fill required field!",
        },       
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
        "BO_Email[]": {
          required: "Please Fill required Field!",
          email: "Please enter a valid email address!",
        },
        "BO_Mobile[]": {
          required: "Please Fill required Field!",
          minlength: "Mobile length should be 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        "Authorized_Rep_Name[]": {
          required: "Please Fill required Field!",
        },
        "AR_Address[]": {
          required: "Please Fill required Field!",
        },
        "AR_Email[]": {
          required: "Please Fill required Field!",
          email: "Please enter a valid email address!",
        },
        "AR_Mobile_No[]": {
          required: "Please Fill required Field!",
          minlength: "Mobile length should be 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        // "altername_mobile[]": {
        //   required: "Please Fill required Field!",
        // },
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

    $(document).ready(function () {
      $("#file").click(function () {
        if (form.valid() === true) {
          var form_data = new FormData($("#sole_right_media")[0]);
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            url: '/fileupload',
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
              $("#show_msg2").show();
              $("#show_msg2").html(data);
              setTimeout(function () {
                window.location.href = 'sole-right-list';
              }, 5000);
            }
          });
        }
      });
    });
  
    if (form.valid() == true) {
      if ($('#tab1').is(":visible")) {
        current_fs = $('#tab1');
        next_fs = $('#tab2');
        $("a[id='#tab1']").removeClass("active");
        $("a[id='#tab2']").addClass("active");
        nextSaveData('next_tab_1');
        $("#next_tab_1").val("0");

      } else if ($('#tab2').is(":visible")) {
        current_fs = $('#tab2');
        next_fs = $('#tab3');
        $("a[id='#tab2']").removeClass("active");
        $("a[id='#tab3']").addClass("active");
        nextSaveData('next_tab_2');
        $("#next_tab_2").val("0");

      } else if ($('#tab3').is(":visible")) {
        current_fs = $('#tab3');
        next_fs = $('#tab4');
        $("a[id='#tab3']").removeClass("active");
        $("a[id='#tab4']").addClass("active");
        nextSaveData('next_tab_3');
        $("#next_tab_3").val("0");
      } else if ($('#tab4').is(":visible")) {
        current_fs = $('#tab4');
        next_fs = $('#tab5');
        $("a[id='#tab4']").removeClass("active");
        $("a[id='#tab5']").addClass("active");
        nextSaveData('next_tab_4');
        $("#next_tab_4").val("0");
      }

      // else if ($('#tab4').is(":visible")) {
      //   current_fs = $('#tab4');
      //   next_fs = $('#tab5');
      //   $("a[href='#tab4']").removeClass("active");
      //   $("a[href='#tab5']").addClass("active");
      //   nextSaveData('submit_btn');
      //   $("#submit_btn").val("0");
      // }
      else if ($('#tab5').is(":visible")) {
        current_fs = $('#tab4');
        next_fs = $('#tab5');
        $("a[id='#tab5']").addClass("active");
        nextSaveData('submit_btn');
        $("#submit_btn").val("0");
      }

      next_fs.show();
      current_fs.hide();
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
    var name = element.name;
    var id = element.id;
    var rename = name.substring(0, name.length - 2);
    var reid = id.substring(0, id.length - 1);

    $("[name^=" + rename + "]").each(function (i, j) {
      $(this).parent('p').find('span.error').remove();
      $(this).parent('p').find('span.error').remove();
      $("#" + reid + i).removeClass('is-invalid');
 
      if ($.trim($(this).val()) == '') {
        flag = false;
        $("#" + reid + i).addClass('is-invalid');
        $(this).parent('p').append('<span  id="' + reid + i + i + '-error" class="error invalid-feedback">Please fill required field!</span>');
      }
      $("#" + reid + i + "-error").hide();
    });

    return flag;
  }, "");
  jQuery.validator.addMethod("emailExt", function (value, element, param) {
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/);
  }, 'Please enter a valid email address');

  ///////////////////////IFSC///////////////
  jQuery.validator.addMethod('IFSCvalid', function (value) {
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
  $.validator.addMethod('Panvalid', function (value) {
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

  jQuery.validator.addMethod('testgst', function (value) {
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
  $("#GST_No").blur(function () {
    $("#PM_Agency_Name").val('Please Wait');
  });

  $("#GST_No").on('blur', function () {
    var gstNumber = $("#GST_No").val();
    $.ajax({
      url: '/checkgstsole',
      type: 'GET',
      data: { gstNumber: gstNumber },
      success: function (data) {
        $("#PM_Agency_Name").val('');
        $("#PM_Agency_Name").val(data.legalName);
      }
    });
  });
});

/*
$(window).on('load', function() {
  var gstNumber = $("#GST_No").val();
  $.ajax({
    url: '/checkgstsole',
    type: 'GET',
    data: { gstNumber: gstNumber },
    success: function (data) {
      $("#PM_Agency_Name").val('');
      $("#PM_Agency_Name").val(data.legalName);
    }
  });
});*/

$("#ifsc_code").on('blur', function () {
  var IFSC = $(this).val();
  $.ajax({
    url: 'https://ifsc.razorpay.com/' + IFSC,
    type: 'get',
    success: function (data) {
      if (data.UPI == true && IFSC != '') {
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
  });
});

$(document).ready(function () {
  $("#exist_owner_id").blur(function () {
    var group_code = $(this).val();
    $.ajax({
      url: '/existing_user',
      type: 'GET',
      dataType: 'json',
      data: { code: group_code },
      // contentType:false,
      // cache:false,
      // processData:false,
      success: function (data) {
        console.log(data[0].msg.name);
        if (data[0].status != 0) {
          $(".owner_name").val(data[0].msg.name);
          $(".owner_email").val(data[0].msg.email);
          $(".owner_mobile").val(data[0].msg.mobile);
          $(".owner_address").val(data[0].msg.address);
          $(".owner_city").val(data[0].msg.City);
          $(".owner_phone").val(data[0].msg.phone_no);
          $(".owner_state").val(data[0].msg.State);
          $(".owner_district").html("<option value='" + data[0].msg.District + "'>" + data[0].msg.District + "</option>");
          // alert("Yes");
        }
        else {
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

function checkUniqueVendor(id, val) {
  if (val != '') {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: 'POST',
      url: '/solerightcheckuniquevendor',
      data: {
        data: val
      },
      success: function (response) {
        if (response.status == 0) {
          $("#v_alert_" + id).html(titleCase(id) + ' ' + response.message);
          $("#v_alert_" + id).show();
        } else {
          $("#v_alert_" + id).hide();
        }
      }
    });
  }
}

// start for auth section
$(document).ready(function () {
  $("#add_Auth").click(function () {
    var i = $("#countID").val();
    i++;
    var append = '<hr id="hrline_authorized_' + i + '"><div class="row" id="row' + i + '"><div class="col-md-4"><div class="form-group"><label for="address">Contact Person / संपर्क व्यक्ति <font color="red">*</font></label><textarea  type="text" name="Authorized_Rep_Name[]" placeholder="Enter Contact Person" rows="1" class="form-control form-control-sm" maxlength="40" ></textarea></div></div><div class="col-md-4"><div class="form-group"><label for="address">Address / पता <font color="red">*</font></label><textarea type="text" name="AR_Address[]" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm" ></textarea></div></div><div class="col-md-4"><div class="form-group"><label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red"></font></label><input type="text" name="AR_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="landline_no" onkeypress="return onlyNumberKey(event)" maxlength="14" ></div></div><div class="col-md-4"><div class="form-group"><label for="email">E-mail. / ईमेल <font color="red">*</font></label><input type="text" name="AR_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" maxlength="30" ></div></div><div class="col-md-4"><div class="form-group"><label for="mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label><input type="text" name="AR_Mobile_No[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" ></div></div> <div class="col-md-4"><div class="form-group"><label for="mobile">Alternate Mobile No. / वैकल्पिक मोबाइल नंबर <font color="red"></font></label><input type="text" name="altername_mobile[]" placeholder="Enter Alternate Mobile No." class="form-control form-control-sm" id="altername_mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" ></div></div> <div class="col-md-10"></div><div class="col-md-2" style="padding: 0% 0 0 6%;"><button class="btn btn-danger remove_row" id="' + i + '" style="font-size: 13px;"><i class="fa fa-minus"></i> Remove</button></div></div>';
    $("#radioar").append(append);
    $("#countID").val(i);
  });
  $(document).on('click', '.remove_row', function (e) {
    // var ind = $(this).attr('data');
    e.preventDefault();
    var id = $(this).attr('id');
    $("#row" + id).remove();
    $("#hrline_authorized_"+id).remove();
    var add_count = $("#countID").val();
    $("#countID").val(add_count - 1);
  });
});
// end for auth section

//start get owner data
function checkUniqueOwnerSoleRight(thisd, val, i) {
  if (val != '') {
    var user_id = $('input[name="user_id"]').val();
    var user_email = $('input[name="user_email"]').val();

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: 'POST',
      url: '/checkpsolerightuniqueowner',
      data: {
        data: val,
        id: user_id,
        email: user_email
      },
      success: function (response) {
        //console.log(response);
        if (response.status == 1 && thisd.id == 'owner_email' + i) {
          $("#owner_name" + i).prop("readonly", false);
          $("#owner_mobile" + i).prop("readonly", false);
          $("#owner_address" + i).prop("readonly", false);
          $("#owner_state" + i).prop("disabled", false);
          $("#owner_district" + i).prop("disabled", false);
          $("#owner_city" + i).prop("readonly", false);
          $("#owner_phone" + i).prop("readonly", false);
          $("#owner_fax" + i).prop("readonly", false);
          // $("#state_val" + i).prop("disabled", true);
          //$("#district_val" + i).prop("disabled", true);
          // owner not exit clean data
          if ($("#owner_input_clean").val() == 0) {
            $("#owner_state" + i).val('');
            $("#owner_district" + i).val('');
            $("#owner_name" + i).val('');
            $("#owner_mobile" + i).val('');
            $("#owner_address" + i).val('');
            $("#owner_city" + i).val('');
            $("#owner_phone" + i).val('');
            $("#owner_fax" + i).val('');
            $("#ownerid" + i).val('');
            // $("#exist_owner_id").val('');
            $("#mobilecheck").val('');
          }
          // $("#emailarr").val('');
          // $('input[name^="owner_email"]').each(function() {
          //arrText.push($(this).val());
          var names = $("#emailarr").val();
          var numbersArray = names.split(',');
          if (numbersArray.includes(val) == false) {
            $("#emailarr").val('');
            $('input[name^="owner_email"]').each(function () {
              // arrText.push($(this).val());
              $("#emailarr").val(function () {
                return $("#emailarr").val() + ',' + $(this).val();
              });
            });
          }
          // });
        }
        //console.log(thisd.id +' ~ '+ 'owner_email' + i);
        if (response.status == 0 && thisd.id == 'owner_email' + i) {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: 'POST',
            url: '/fetchsolerightownerrecord',
            data: {
              data: val
            },
            success: function (response) {
              console.log(response);
              if (response.status == 1) {
                $("#owner_state" + i).empty();
                $("#owner_district" + i).empty();
                $("#owner_city" + i).empty();
                // $("#state_val" + i).prop("disabled", false);
                //$("#district_val" + i).prop("disabled", false);
                $("#owner_name" + i).val(response.message['Owner Name']);
                $("#owner_mobile" + i).val(response.message['Mobile No_']);
                $("#owner_address" + i).val(response.message['Address 1']);
                $("#owner_state" + i).html(response.state);
                $("#owner_district" + i).html(response.districts);
                $("#owner_city" + i).html(response.cities);
                // $("#state_val" + i).val(response.message['State']);
                //  $("#district_val" + i).val(response.message['District']);
                $("#owner_city" + i).val(response.message['City']);
                $("#owner_phone" + i).val(response.message['Phone No_']);
                $("#owner_fax" + i).val(response.message['Fax No_']);
                $("#ownerid" + i).val(response.message['Owner ID']);
                $("#mobilecheck").val(response.message['Mobile No_']);
                if ($("#emailarr").val() == '') {
                  $("#emailarr").val(val);
                } else {
                  var names = $("#emailarr").val();
                  var numbersArray = names.split(',');
                  if (numbersArray.includes(val) == false) {
                    $("#emailarr").val('');
                    $('input[name^="owner_email"]').each(function () {
                      $("#emailarr").val(function () {
                        return $("#emailarr").val() +
                          ',' + $(this).val();
                      });
                    });

                  } else {
                  }
                }
                if ($("#ownerid").val() == '') {
                  $("#ownerid").val(response.message['Owner ID']);
                } else {
                  var ownerids = $("#ownerid").val();
                  var ownerArray = ownerids.split(',');
                  if (isInArray(response.message['Owner ID'], ownerArray) ==
                    false) {
                    $("#ownerid").val(function () {
                      return $("#ownerid").val() + ',' + response
                        .message['Owner ID'];
                    });
                    var ownerids = $("#ownerid").val();
                    var ownerArray = ownerids.split(',');
                    $("#ownerid").val(ownerArray);
                  }
                }
              }

              if (response.Status > 0) {
                $("#owner_name" + i).prop("readonly", true);
                $("#owner_mobile" + i).prop("readonly", true);
                $("#owner_address" + i).prop("readonly", true);
                $("#owner_state" + i).prop("disabled", true);
                $("#owner_district" + i).prop("disabled", true);
                $("#owner_city" + i).prop("readonly", true);
                $("#owner_phone" + i).prop("readonly", true);
                $("#owner_fax" + i).prop("readonly", true);
              }
              $("#owner_input_clean").val(0);
            }
          });

        } else if (response.status == 0 && thisd.id == 'owner_mobile' + i && val != $(
          "#mobilecheck").val()) {
          $("#alert_" + thisd.id).html('Mobile No. ' + response.message);
          $("#alert_" + thisd.id).show();
        } else {
          $("#alert_" + thisd.id).hide();
        }
        if (thisd.id == 'owner_mobile' + i) {
          $("#owner_input_clean").val(1);
        }
      }
    });
  }
}

function isInArray(value, array) {
  return array.indexOf(value) > -1;
}

function titleCase(string) {
  return string[0].toUpperCase() + string.slice(1).toLowerCase();
}
$(document).on('change', '.owner_name', function () {
  $("#owner_input_clean").val(1);
});
//end get owner data

// $('.alert-success').hide()
$('.alert-danger').hide()

////////////// file upload size  512kb ////////////////
$(document).ready(function () {
  $(".custom-file-input").change(function () {
    var id = $(this).attr("id");
    id.slice(1);
    var file = this.files[0].name;
    var file1 = $('#' + id + 2).text();
    var totalBytes = this.files[0].size;
    // var sizeKb = Math.floor(totalBytes / 1000);
    // var ext = file.split('.').pop();
    // if (file != '' && sizeKb < 512 && ext == "pdf") {
    var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
    var ext = file.split('.').pop();
    if (file != '' && sizemb <= 2 && ext == "pdf") {
      $("#" + id + 2).empty();
      $("#" + id + 2).text(file);
      $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
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
      $("#" + id + 1).text('File size should be less than 2MB and file should be pdf!');
      $("#" + id + 1).show();
      $("#" + id + 3).html("Upload").addClass("input-group-text");
      $("#" + id + "-error").addClass("hide-msg");
    }
  });
});

//start Branch Office show hide form js
$(document).ready(function () {
  $("input[name='boradio']").click(function () {
    var radioValue = $("input[name='boradio']:checked").val();
    console.log(radioValue);
    if (radioValue == '1') {
      $("#radio").show();
      $("#addid").show();
    } else {
      $("#radio").hide();
      $("#addid").hide();
    }
  });
});
//end Branch Office show hide form js

//start section Licence
$(document).ready(function () {
  $("#txt_from").on('change', function () {
    $("#txt_to").val('');
  });
});

//Licence Start date and End date
$(document).ready(function () {
  $("#txt_from").on('focus', function () {
    var to = $("#txt_from").val();
    if (to.length == '') {
      $("#txt_to").removeAttr('disabled');
    }
    0
  });
});
$(document).ready(function () {
  $("#txt_to").focus(function () {
    var txt_from = $("#txt_from").val();
    $("#txt_to").attr('min', txt_from);
  });
});
//end section Licence

$(document).ready(function () {
  $('.preventLeftClick').on('click', function (e) {
    e.preventDefault();
    return false;
  });
});

$(document).ready(function () {
  $('.select2').select2();
});