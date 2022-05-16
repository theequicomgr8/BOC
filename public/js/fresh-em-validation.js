$(document).ready(function () {
  $(".next-button").click(function () {
    var form = $("#fress_emp_form");
    form.validate({
      rules: {
        owner_name: {
          minlength: 3,
          maxlength: 100
        },
        is_primary: {
          required: true,
        },
        owner_type: {
          required: true,
        },
        email: {
          required: true,
          emailExt: true,

        },
        mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        address: {
          required: true
        },
        state: {
          required: true
        },
        city: {
          required: true
        },
        district: {
          required: true
        },
        phone: {
          minlength: 6,
          maxlength: 15,
          number: true
        },
        fax_no: {
          maxlength: 15,
          number: true
        },
        exist_owner_id: {
          required: true
        },
        newspaper_name: {
          required: true
        },
        place_of_publication: {
          required: true
        },
        v_email: {
          required: true,
          emailExt: true
        },
        v_mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        v_address: {
          required: true
        },
        v_state: {
          required: true
        },
        v_city: {
          required: true
        },
        v_district: {
          required: true
        },
        pin_code: {
          required: true,
          minlength: 6,
          maxlength: 6,
          number: true
        },
        v_phone: {
          minlength: 6,
          maxlength: 15,
          number: true
        },
        v_fax_no: {
          maxlength: 15,
          number: true
        },
        language: {
          required: true,
        },
        periodicity: {
          required: true,
        },
        cir_base: {
          required: true,
        },
        claimed_circulation: {
          required: true,
          //yourRuleName: true,
          maxlength: 4,
          number: true
        },
        quality_paper_used: {
          required: true,
        },
        printing_colour: {
          required: true,
        },
        news_agencies_subscribed: {
          required: true,
        },
        agencies: {
          required: true,
        },
        print_area: {
          number: true
        },
        page_length: {
          required: true,
          maxlength: 4,
          number: true
        },
        page_width: {
          required: true,
          maxlength: 4,
          number: true
        },
        no_of_page: {
          required: true,
          maxlength: 7,
          number: true
        },
        total_print_area: {
          required: true,
          maxlength: 20,
          number: true
        },
        black_white: {
          maxlength: 15,
          number: true
        },
        colour: {
          maxlength: 15,
          number: true
        },
        total_annual_turn_over: {
          maxlength: 10,
          number: true
        },
        colour_pages: {
          maxlength: 8,
          number: true
        },
        price_newspaper: {
          required: true,
          maxlength: 15,
          number: true,
        },
        distance_office_to_press: {
          maxlength: 15,
          number: true
        },
        cin_no: {
          maxlength: 15,
          number: true
        },
        publisher_name: {
          required: true,
        },
        publisher_email: {
          required: true,
          emailExt: true
        },
        publisher_mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        // publisher_phone: {
        //   required: true,
        //   maxlength: 15,
        //   number: true
        // },
        printer_name: {
          required: true,
        },
        printer_email: {
          required: true,
          emailExt: true
        },
        printer_mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        // printer_phone: {
        //   required: true,
        //   maxlength: 15,
        //   number: true
        // },
        press_owned_by_owner: {
          required: true,
        },
        name_of_press: {
          required: true,
        },
        press_email: {
          required: true,
          emailExt: true
        },
        press_mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        press_phone: {
          // required: true,
          minlength: 6,
          maxlength: 15,
          number: true
        },
        name_of_editor: {
          required: true,
        },
        editor_email: {
          required: true,
          emailExt: true
        },
        editor_mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        // editor_phone: {
        //   required: true,
        //   maxlength: 15,
        //   number: true
        // },
        // ca_email: {
        //   required: true,
        //   emailExt: true
        // },
        ca_mobile: {
          // required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        // ca_phone: {
        //   required: true,
        //   maxlength: 15,
        //   number: true
        // },
        dm_declaration_date: {
          required: true,
        },
        account_type: {
          required: true,
        },
        bank_account_no: {
          required: true,
          minlength: 9,
          maxlength: 20,
          number: true
        },
        account_holder_name: {
          required: true,
        },
        bank_name: {
          required: true,
        },
        ifsc_code: {
          required: true,
        },
        branch_name: {
          required: true,
        },
        address_of_account: {
          required: true,
        },
        pan_card: {
          required: true,
        },
        ESI_account_no: {
          number: true
        },
        ESI_no_employees: {
          number: true
        },
        EPF_account_no: {
          number: true
        },
        EPF_no_of_employees: {
          number: true
        },
        rni_reg_file_name: {
          required: true,
        },
        annexure_file_name: {
          required: true,
        },
        circulation_cert_file_name: {
          required: true,
        },
        annual_return_file_name: {
          required: true,
        },
        specimen_copy_file_name: {
          required: true,
        },
        commercial_rate_file_name: {
          required: true,
        },
        no_dues_cert_file_name: {
          required: true,
        },
        gst_reg_cert_file_name: {
          required: true,
        },
        declaration_field_file_name: {
          required: true,
        },
        pan_copy_file_name: {
          required: true,
        },
        dm_declaration_file_name: {
          required: true,
        },
        change_in_address_file_name: {
          required: true,
        },
        advertisement_policy: {
          required: true
        },
        rni_registration_no: {
          required: true,
          yourRuleName: true
        },
        // GST_No: {
        //   required: true
        // },
        abc_certificate_no: {
          required: true
        },
        average_circulation_copies: {
          required: true
        },
        date_of_first_publication: {
          required: true
        },
        ca_udin_number: {
          required: true
        }
      },
      messages: {
        owner_name: {
          minlength: "Owner name must be at least 3 alphabets!",
          maxlength: "Users can type only max 100 alphabets!"
        },
        is_primary: {
          required: "Please fill required field!",
        },
        owner_type: {
          required: "Please fill required field!",
        },
        email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        mobile: {
          required: "Please fill required field!",
          minlength: "Mobile length should be min and max 10 digit!",
          //maxlength: "Mobile length should be max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        address: {
          required: "Please fill required field!"
        },
        state: {
          required: "Please select an state!"
        },
        city: {
          required: "Please fill required field!"
        },
        district: {
          required: "Please fill required field!"
        },
        phone: {
          minlength: "Phone no. length should be min 6 digit!",
          maxlength: "Phone no. length should be max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        exist_owner_id: {
          required: "Please fill required field!"
        },
        fax_no: {
          maxlength: "Fax length should be min and max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        newspaper_name: {
          required: "Please fill required field!"
        },
        place_of_publication: {
          required: "Please fill required field!"
        },
        v_email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        v_mobile: {
          required: "Please fill required field!",
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        v_address: {
          required: "Please fill required field!"
        },
        v_state: {
          required: "Please fill required field!"
        },
        v_city: {
          required: "Please fill required field!"
        },
        v_district: {
          required: "Please fill required field!"
        },
        pin_code: {
          required: "Please fill required field!",
          minlength: "Pincode length should be min and max 6 digit!",
          number: "Users can enter only integer numbers!"
        },
        v_phone: {
          required: "Please fill required field!",
          minlength: "Phone no. length should be min 6 digit!",
          maxlength: "Phone no. length should be max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        v_fax_no: {
          maxlength: "Fax length should be min and max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        language: {
          required: "Please fill required field!"
        },
        periodicity: {
          required: "Please fill required field!"
        },
        cir_base: {
          required: "Please fill required field!"
        },
        claimed_circulation: {
          required: "Please fill required field!",
          maxlength: "Circulation length should be min and max 8 digit!",
          number: "Users can enter only integer numbers!"
        },
        quality_paper_used: {
          required: "Please fill required field!"
        },
        printing_colour: {
          required: "Please fill required field!"
        },
        news_agencies_subscribed: {
          required: "Please fill required field!"
        },
        agencies: {
          required: "Please fill required field!"
        },
        print_area: {
          number: "Users can enter only integer numbers!"
        },
        page_length: {
          required: "Please fill required field!",
          maxlength: "Page length should be min and max 4 digit!",
          number: "Users can enter only integer numbers!"
        },
        page_width: {
          required: "Please fill required field!",
          maxlength: "Width length should be min and max 4 digit!",
          number: "Users can enter only integer numbers!"
        },
        no_of_page: {
          required: "Please fill required field!",
          maxlength: "page length should be min and max 7 digit!",
          number: "Users can enter only integer numbers!"
        },
        total_print_area: {
          required: "Please fill required field!",
          maxlength: "Print Area length should be min and max 20 digit!",
          number: "Users can enter only integer numbers!"
        },
        black_white: {
          maxlength: "Black White length should be min and max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        colour: {
          maxlength: "Color length should be min and max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        total_annual_turn_over: {
          maxlength: "Annual Turn Over length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        colour_pages: {
          maxlength: "Color pages length should be min and max 8 digit!",
          number: "Users can enter only integer numbers!"
        },
        price_newspaper: {
          required: "Please fill required field!",
          maxlength: "Newspaper length should be min and max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        distance_office_to_press: {
          maxlength: "Distance length should be min and max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        cin_no: {
          maxlength: "CIN No. length should be min and max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        publisher_name: {
          required: "Please fill required field!"
        },
        publisher_email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        publisher_mobile: {
          required: "Please fill required field!",
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        // publisher_phone: {
        //   required: "Please fill required field!",
        //   maxlength: "Phone length should be min and max 15 digit!",
        //   number: "Users can enter only integer numbers!"
        // },
        printer_name: {
          required: "Please fill required field!"
        },
        printer_email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        printer_mobile: {
          required: "Please fill required field!",
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        // printer_phone: {
        //   required: "Please fill required field!",
        //   maxlength: "Phone length should be min and max 15 digit!",
        //   number: "Users can enter only integer numbers!"
        // },
        press_owned_by_owner: {
          required: "Please fill required field!"
        },
        name_of_press: {
          required: "Please fill required field!"
        },
        press_email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        press_mobile: {
          required: "Please fill required field!",
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        press_phone: {
          // required: "Please fill required field!",
          minlength: "Phone no. length should be min 6 digit!",
          maxlength: "Phone no. length should be max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        name_of_editor: {
          required: "Please fill required field!"
        },
        editor_email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        editor_mobile: {
          required: "Please fill required field!",
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        // editor_phone: {
        //   required: "Please fill required field!",
        //   maxlength: "Mobile length should be min and max 15 digit!",
        //   number: "Users can enter only integer numbers!"
        // },
        // ca_email: {
        //   required: "Please fill required field!",
        //   email: "Please enter a vaild email address!"
        // },
        ca_mobile: {
          // required: "Please fill required field!",
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        // ca_phone: {
        //   required: "Please fill required field!",
        //   maxlength: "Phone length should be min and max 15 digit!",
        //   number: "Users can enter only integer numbers!"
        // },
        dm_declaration_date: {
          required: "Please fill required field!",
        },
        account_type: {
          required: "Please fill required field!",
        },
        bank_account_no: {
          required: "Please fill required field!",
          minlength: "Bank Account length min 9 digit!",
          maxlength: "Bank Account length max 20 digit!",
          number: "Users can enter only integer numbers!"
        },
        account_holder_name: {
          required: "Please fill required field!"
        },
        bank_name: {
          required: "Please fill required field!"
        },
        ifsc_code: {
          required: "Please fill required field!"
        },
        branch_name: {
          required: "Please fill required field!"
        },
        address_of_account: {
          required: "Please fill required field!"
        },
        pan_card: {
          required: "Please fill required field!"
        },
        ESI_account_no: {
          maxlength: "Account No. length should be min and max 20 digit!",
          number: "Users can enter only integer numbers!"
        },
        ESI_no_employees: {
          maxlength: "Employees length should be min and max 6 digit!",
          number: "Users can enter only integer numbers!"
        },
        EPF_account_no: {
          maxlength: "Account No. length should be min and max 20 digit!",
          number: "Users can enter only integer numbers!"
        },
        EPF_no_of_employees: {
          maxlength: "Employees length should be min and max 6 digit!",
          number: "Users can enter only integer numbers!"
        },
        rni_reg_file_name: {
          required: "Please fill required field!",

        },
        annexure_file_name: {
          required: "Please fill required field!",

        },
        circulation_cert_file_name: {
          required: "Please fill required field!",

        },
        annual_return_file_name: {
          required: "Please fill required field!",

        },
        specimen_copy_file_name: {
          required: "Please fill required field!",

        },
        commercial_rate_file_name: {
          required: "Please fill required field!",

        },
        no_dues_cert_file_name: {
          required: "Please fill required field!",

        },
        gst_reg_cert_file_name: {
          required: "Please fill required field!",

        },
        declaration_field_file_name: {
          required: "Please fill required field!",

        },
        pan_copy_file_name: {
          required: "Please fill required field!",

        },
        dm_declaration_file_name: {
          required: "Please fill required field!",

        },
        advertisement_policy: {
          required: "Please fill required field!"
        },
        change_in_address_file_name: {
          required: "Please fill required field!"
        },
        rni_registration_no: {
          required: "Please fill required field!"
        },
        // GST_No: {
        //   required: "Please fill required field!"
        // },
        abc_certificate_no: {
          required: "Please fill required field!"
        },
        average_circulation_copies: {
          required: "Please fill required field!"
        },
        date_of_first_publication: {
          required: "Please fill required field!"
        },
        ca_udin_number: {
          required: "Please fill required field!"
        }
        //   terms: "Please accept our terms"
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
    if (form.valid() == false) {
      $('html, body').animate({
        scrollTop: $('.is-invalid').offset().top
      }, 2000);
    }
    if (form.valid() === true) {
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
        current_fs = $('#tab3');
        next_fs = $('#tab4');
        $("a[id='#tab4']").addClass("active");
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
    }

    next_fs.show();
    current_fs.hide();
  });
  //email validation formate
  jQuery.validator.addMethod("emailExt", function (value, element, param) {
    //alert(1);
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z\.\-]+\.[a-zA-Z]{2,4}$/);
  }, 'Please enter a vaild email address');

  //GST No Validation
  //email validation formate
  //  jQuery.validator.addMethod("gstno", function (value, element, param) {
  //   return value.match(/\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/);
  // }, 'Enter Valid format GST No. like(18AABCU9603R1ZM)');
});

jQuery.validator.addMethod("yourRuleName", function (value, element) {
  console.log(value);
  var claimed_circulation_hidden = $("#claimed_circulation_hidden").val();
  var checkg = checkRegCIRBase(value);
  console.log(claimed_circulation_hidden);
  if (checkRegCIRBase(value) == true && claimed_circulation_hidden != '') {
    $("#claimed_circulation").css("border-color", "#ced4da");
    $("#claimed_circulation-error").hide();
    $("#rni_registration_no").css("border-color", "#ced4da");
    $("#rni_registration_no-error").hide();
    return true;
  } else (value == '')
  {
    $("#rni_reg_no").hide();
  }

}, '');

///////////// calculate total print area /////////

$(document).ready(function () {
  $('#page_length').keyup(calculate);
  $('#page_width').keyup(calculate);
  $('#no_of_page').keyup(calculate);

});
function calculate(e) {
  var num = $('#page_length').val() * $('#page_width').val() * $('#no_of_page').val();
  var areaperpage = $('#page_length').val() * $('#page_width').val();
  $('#print_area').val(areaperpage.toFixed(2));
  $('#total_print_area').val(num.toFixed(2));
}

// show document when upload 
$(document).ready(function () {
  $(".custom-file-input").change(function () {
    // alert(this.files[0].name);
  });
});

// change print area value based on periodicity

$(document).ready(function () {
  $("#periodicity").change(function () {
    $("#print_area").val("");
  });
});

function printArea(val) {
  var periodicity_val = $("#periodicity :selected").val();
  if (periodicity_val == 0 && val < 7600) {
    $("#print_area").val("");
    $("#alert_print_area").text("Enter value should not be less than 7600").show();
    return false;
  } else {
    $("#alert_print_area").text("Enter value should not be less than 7600").hide();
  }

  if (periodicity_val == 1 && val < 3500) {
    $("#print_area").val("");
    $("#alert_print_area").text("Enter value should not be less than 3500").show();
    return false;
  } else {
    $("#alert_print_area").text("Enter value should not be less than 3500").hide();
  }
  if (periodicity_val == 2 && val < 4800) {
    $("#print_area").val("");
    $("#alert_print_area").text("Enter value should not be less than 4800").show();
    return false;
  } else {
    $("#alert_print_area").text("Enter value should not be less than 4800").hide();
  }
}

//claimed circulation
// $(document).ready(function () {
//   $("#claimed_circulation").change(function () {
//     $("#claimed_circulation-error").removeClass("hide-msg");
//     if ($(this).val() < 2000) {
//       var claimed_circulation = $("#claimed_circulation").val();
//       if (claimed_circulation != "") {
//         $("#claimed_circulation").val("");
//         $("#alert_claimed_circulation").text("Enter value should not be less than 2000").show();
//         $("#claimed_circulation-error").addClass("hide-msg");
//         return false;
//       }
//     } else {
//       $("#alert_claimed_circulation").text("Enter value should not be less than 2000").hide();
//     }
//   });
// });

// DM Declaration
function dmDeclaration(val) {
  if (val == 1) {
    $("#dm_dec_date").show();
  } else {
    $("#dm_dec_date").hide();
  }
}

// vendor will specify
function vendorEdition(val) {
  if (val == 0) {
    $("#davp_panel").attr('disabled', true);
    $('#davp_panel').prop('checked', false);
    $("#add_davp").hide();
    $("#add_row_davp").hide();
  } else {
    $("#davp_panel").attr('disabled', false);
  }
}
// change company address
function changeCompAddr(val) {
  if (val == 1) {
    $("#change_info_doc").removeClass("hide-msg");
  } else {
    $("#change_info_doc").addClass("hide-msg");
  }
}

////////////// file upload validation ////////////////
$(document).ready(function () {
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
function isInArray(value, array) {
  return array.indexOf(value) > -1;
}


// Existing owner
function existOwner(val) {
  if (val == 1) {
    //$("#name").val('');
    $("#email").val('');
    $("#mobile").val('');
    $("#address").val('');
    $("#city").val('');
    $("#phone").val('');
    $("#fax").val('');
    $("#district").html("<option value=''>Please District</option>");
    $("#state").html("<option value=''>Please State</option>");
    $("#exist_owner_ids").show();
    $("#is_primary2").prop("checked", false);
  } else {
    location.reload();
    $("#exist_owner_ids").hide();
  }
}

$(document).ready(function () {

  //color pages less than or equal to pages 
  $("#colour_pages").keyup(function () {
    var pages = $("#no_of_page").val();
    if (pages == '' || parseInt($(this).val()) > parseInt(pages)) {
      $("#alert_colour_pages").text('Color pages value should be less than or equal to no. of pages').show();
    } else {
      $("#alert_colour_pages").hide();
    }
  });

  //Black & White less than or equal to pages
  // $("#black_white").keyup(function() {
  //   var pages = $("#no_of_page").val();
  //   if (parseInt($(this).val()) > parseInt(pages)) {
  //     $("#alert_black_white").text('Black & White value should be less than or equal to no. of pages').show();
  //   } else {
  //     $("#alert_black_white").hide();
  //   }
  // });

  // pages
  $("#no_of_page").on('keyup', function () {
    var color = $("#colour_pages").val();
    var bwc = $("#black_white").val();
    if (parseInt(color) > parseInt($(this).val())) {
      // $("#colour_pages").val('');
      $("#alert_colour_pages").text('Color pages value should be less than or equal to no. of pages').show();
    } else {
      $("#alert_colour_pages").hide();
    }
    // if (parseInt(bwc) > parseInt($(this).val())) {
    //   //  $("#black_white").val('');
    //   $("#alert_black_white").text('Black & White value should be less than or equal to no. of pages').show();
    // } else {
    //   $("#alert_black_white").hide();
    // }
  });
});


// start check annual turn over of newspaper and show and hide file of GST at tab 4 
$(document).ready(function () {
  $("#gst_reg_file").hide();
  $("#total_annual").on('keyup', function () {
    if (parseInt($(this).val()) > 4000000) {
      $("#alert_total_annual_turn").text("GST Registration and certificate is mandatory at tab 4").show();
      $("#gst_reg_file").show();
    } else {
      $("#alert_total_annual_turn").hide();
      $("#gst_reg_file").hide();
    }
  });
});
// end check annual turn over of newspaper and show and hide file of GST at tab 4

// start check window load claim circulation and annual tornover based show and hide file of GST and No dues PCI at tab 4
$(document).ready(function () {

  if (parseInt($("#claimed_circulation").val()) > 25000) {
    //  $("#rni_claimed_cirl").text('PCI no dues certificate is mandatory at tab 4').show().css("color", "#f8b739");
    $("#no_dues_cert").show();
    $("#abc_rni_cert").show();
  } else {
    $("#no_dues_cert").hide();
    $("#abc_rni_cert").hide();
  }
  if (parseInt($("#total_annual").val()) > 4000000) {
    // $("#alert_total_annual_turn").text("GST Registration and certificate is mandatory at tab 4").show();
    $("#gst_reg_file").show();
  } else {
    // $("#alert_total_annual_turn").hide();
    $("#gst_reg_file").hide();
  }
  if ($("#cir_base").val() == 0 && $("#cir_base").val() != '') {
    $("#rni_cert").show();
    $("#form2_rni_cert").show();
  } else {
    $("#rni_cert").hide();
    $("#form2_rni_cert").hide();
  }
});
//end check window load claim circulation and annual tornover based show and hide file of GST and No dues PCI at tab 4


function checkCirculation(val) {
  if (val != '') {
    if (parseInt(val) == parseInt($("#claimed_circulation_hidden").val()) && parseInt(val) < 25000) {
      $("#rni_claimed_cirl").text("Verified").show().css("color", "green");
      $("#claimed_circulation_verified").val(1);
    } else {
      var msg = '';
      if (parseInt(val) > 25000) {
        msg = 'PCI no dues certificate is mandatory at tab 4';
        $("#no_dues_cert").show();
        $("#abc_rni_cert").show();
      } else {
        if ($("#cir_base").val() == 1) {
          msg = '';
        } else {
          msg = 'Not verified';
        }
        $("#no_dues_cert").hide();
        $("#abc_rni_cert").hide();
      }
      $("#rni_claimed_cirl").text(msg).show().css("color", "#f8b739");
      $("#claimed_circulation_verified").val(0);
    }
  }
}
// end cir based validation

// start cir based validation
$(document).ready(function () {
  $("#cir_base").change(function () {
    $("#rni_reg_no_verified").val(0);
    $("#claimed_circulation_verified").val(0);
    $("#rni_annual_valid").val(0);
    $("#abc_reg_no_verified").val(0);
    $("#rni_claimed_cirl").hide();
    $("#rni_efill_no").hide();
    $("#abc_cert_no").hide();
    $("#abc-certificate").hide();
    $("#dateoffirstpublication").hide();
    $("#tab_1").css('pointer-events', 'visible');
    if ($(this).val() == 0) {
      $("#rni-efilling").show();
      $("#rni_reg_no").hide();
      $("#rni_registration_no").val('');
      $("#rni_efiling_no").val('');
      $("#claimed_circulation").val('');
      $("#rni_efiling_no").prop("readonly", false);
      $("#claimed_circulation").prop("readonly", false);
      $("#rni_cert").show();
      $("#form2_rni_cert").show();
      $("#abc-certificate").hide();
      $("#rni_regist_no").show();
      $("#udin_number").hide();

    } else if ($(this).val() == 3) {
      $("#rni-efilling").hide();
      $("#rni_reg_no").hide();
      $("#rni_registration_no").val('');
      $("#rni_efiling_no").val('');
      $("#claimed_circulation").val('');
      $("#rni_efiling_no").prop("readonly", false);
      $("#claimed_circulation").prop("readonly", false);
      $("#newspaper_name").val('');
      $("#rni_cert").hide();
      $("#form2_rni_cert").hide();
      $("#abc-certificate").show();
      $("#rni_regist_no").hide();
      $("#udin_number").hide();
    } else if ($(this).val() == 1) {
      $("#rni-efilling").hide();
      $("#rni_reg_no").hide();
      $("#rni_registration_no").val('');
      $("#rni_efiling_no").val('');
      $("#claimed_circulation").val('');
      $("#rni_efiling_no").prop("readonly", false);
      $("#claimed_circulation").prop("readonly", false);
      $("#newspaper_name").val('');
      $("#rni_cert").hide();
      $("#form2_rni_cert").hide();
      $("#abc-certificate").hide();
      $("#rni_regist_no").hide();
      $("#udin_number").show();
    } else {
      $("#rni-efilling").hide();
      $("#rni_reg_no").hide();
      $("#rni_registration_no").val('');
      $("#rni_efiling_no").val('');
      $("#claimed_circulation").val('');
      $("#rni_efiling_no").prop("readonly", false);
      $("#claimed_circulation").prop("readonly", false);
      $("#newspaper_name").val('');
      $("#rni_cert").hide();
      $("#form2_rni_cert").hide();
      $("#rni_regist_no").hide();
      $("#udin_number").hide();
    }
  });
});

$(document).ready(function () {
  $(window).keydown(function (event) {
    if (event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
$(document).ready(function () {
  $("#name").change(function () {
    $("#owner_input_clean").val(1);
  });
});


$(document).ready(function () {
  $("#printing_colour").change(function () {
    if ($(this).val() == 0 && $(this).val() != '') {
      $("#colour_page").show();
    } else {
      $("#colour_page").hide();
    }
  });
});


/* writen by priyanshi */
$('#agenciesDiv').hide();
var news_agencies_subscribed = $('#news_agencies_subscribed option:selected').val();

if (news_agencies_subscribed == "8") {
  $('#agenciesDiv').show();
} else {
  $('#agenciesDiv').hide();
}
$('#news_agencies_subscribed').change(function () {
  var news_agencies_subscribed = $('#news_agencies_subscribed option:selected').val();
  if (news_agencies_subscribed == "") {
    $('#agenciesDiv').hide();
  } else if (news_agencies_subscribed == "8") {
    $('#agenciesDiv').show();
  } else {
    $('#agenciesDiv').hide();
  }
})
//agencies show hide



/*function checkRegCIRBase(val) {
  var cir_no = $("#cir_base").val();
  if (val != '' && cir_no != '') {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: "get",
      url: 'check-regno-cir-base',
      data: {
        cir_no: cir_no,
        reg_no: val
      },
      success: function (data) {
        if (data.status == true) {
          console.log(data);
          $("#rni_reg_no").text(data.message).show().css("color", "green");
          $("#abc_cert_no").text(data.message).show().css("color", "green");
          if (cir_no == 0) {
            $("#rni_efiling_no").val(data.data['Efile Number']);
            $("#rni_efiling_no").prop("readonly", true);
            $("#rni_efill_no").text(data.message).show().css("color", "green");
            if (($.trim(data.data['Efiling Number Valid']) == 'Yes') && ($.trim(data.data['Efiling veryfied']) == 'Yes')) {
              $("#rni_annual_valid").val(1);
            }
            $("#newspaper_name").val(data.data['Publication Name']);
            $("#rni_reg_no_verified").val(1);
          } else if (cir_no == 3) {
            $("#abc_reg_no_verified").val(1);
          }
          $("#claimed_circulation").val(data.data['Sold Circulation']);
          $("#claimed_circulation_hidden").val(data.data['Sold Circulation']);
          $("#claimed_circulation_verified").val(1);
          if (parseInt(data.data['Sold Circulation']) > 25000) {
            $("#rni_claimed_cirl").text('PCI no dues certificate is mandatory at tab 4').show().css("color", "#f8b739");
            $("#no_dues_cert").show();
            $("#abc_rni_cert").show();

          } else {
            $("#rni_claimed_cirl").text(data.message).show().css("color", "green");
            $("#no_dues_cert").hide();
            $("#abc_rni_cert").hide();
          }
          // }
          console.log("success");
          $("#tab_1").css('pointer-events', 'visible');
        } else {
          console.log("fail");
          $("#tab_1").css('pointer-events', 'none');
          if (data.message == 'Data already exist!' && cir_no == 0) {

            $("#rni_reg_no").text(data.message).show().css("color", "red");
          } else if (data.message == 'Data already exist!' && cir_no == 3) {

            $("#abc_cert_no").text(data.message).show().css("color", "red");
          } else {
            $("#rni_reg_no").text(data.message).show().css("color", "#f8b739");
            $("#abc_cert_no").text(data.message).show().css("color", "#f8b739");
            $("#rni_claimed_cirl").hide();
            $("#rni_efill_no").hide();
            if (cir_no == 0) {
              $("#rni_efiling_no").val('');
            }
            $("#claimed_circulation").val('');
            $("#rni_efiling_no").prop("readonly", false);
            $("#rni_reg_no_verified").val(0);
            $("#claimed_circulation_verified").val(0);
            $("#rni_annual_valid").val(0);
            $("#newspaper_name").val('');
          }
        }
      },
      error: function (error) {
        console.log('error');
      }
    });

    if (cir_no == 0 && $("#rni_efiling_no").val() == '') {
      // date of first publication grether than 4 months
      let today = new Date();
      today.setMonth(today.getMonth() - 4);
      let date1 = dateFormate(today);
      var date_offirst_publication = $("#firstpublicationdate").val();
      if (date_offirst_publication != '') {
        var date_offirst_publication1 = new Date(date_offirst_publication);
        var date = dateFormate(date_offirst_publication1);
        if (date >= date1) {
          $("#dateoffirstpublication").text('Date of first publication should be grether than 4 months').show();
          $("#tab_1").css('pointer-events', 'none');
        } else {
          $("#dateoffirstpublication").hide();
          $("#tab_1").css('pointer-events', 'visible');
        }
      } else {
        $("#dateoffirstpublication").hide();
      }
    }
    return true;
  } else {
    $("#rni_reg_no").hide();
    $("#abc_cert_no").hide();
    $("#rni_claimed_cirl").hide();
    $("#rni_efill_no").hide();
    $("#rni_efiling_no").val('');
    $("#rni_annual_valid").val('');
    $("#rni_reg_no_verified").val('');
    $("#claimed_circulation").val('');
    $("#claimed_circulation_verified").val('');
    $("#claimed_circulation_hidden").val('');
  }
}*/
// use for verify (RNI,ABC) data based on Circulation Base
function checkRegCIRBase(val) {
  var cir_no = $("#cir_base").val();
  if (val != '' && cir_no != '') {
    $("#rni_reg_no").hide();
    $("#abc_cert_no").hide();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: "get",
      url: 'check-regno-cir-base',
      data: {
        cir_no: cir_no,
        reg_no: val
      },
      success: function (data) {
        if (data.status == true) {
          console.log(data);

          if (data.message) {
            $("#claimed_circulation").css("border-color", "#ced4da");
            $("#claimed_circulation-error").hide();
          }
          $("#rni_reg_no").text(data.message).show().css("color", "green");
          $("#abc_cert_no").text(data.message).show().css("color", "green");
          if (cir_no == 0) {
            $("#rni_efiling_no").val(data.data['Efile Number']);
            $("#rni_efiling_no").prop("readonly", true);
            $("#rni_efill_no").text(data.message).show().css("color", "green");
            if (($.trim(data.data['Efiling Number Valid']) == 'Yes') && ($.trim(data.data['Efiling veryfied']) == 'Yes')) {
              $("#rni_annual_valid").val(1);
            }
            $("#newspaper_name").val(data.data['Publication Name']);
            $("#rni_reg_no_verified").val(1);
          } else if (cir_no == 3) {
            $("#abc_reg_no_verified").val(1);
          }
          $("#claimed_circulation").val(data.data['Sold Circulation']);
          $("#claimed_circulation_hidden").val(data.data['Sold Circulation']);
          $("#claimed_circulation_verified").val(1);
          if (parseInt(data.data['Sold Circulation']) > 25000) {
            $("#rni_claimed_cirl").text('PCI no dues certificate is mandatory at tab 4').show().css("color", "#f8b739");
            $("#no_dues_cert").show();
            $("#abc_rni_cert").show();

          } else {
            $("#rni_claimed_cirl").text(data.message).show().css("color", "green");
            $("#no_dues_cert").hide();
            $("#abc_rni_cert").hide();
          }
          // }
          console.log("success");
          $("#tab_1").css('pointer-events', 'visible');
        } else {
          console.log("fail");
          $("#tab_1").css('pointer-events', 'none');
          if (data.message == 'Data already exist!' && cir_no == 0) {

            $("#rni_reg_no").text(data.message).show().css("color", "red");
          } else if (data.message == 'Data already exist!' && cir_no == 3) {

            $("#abc_cert_no").text(data.message).show().css("color", "red");
          } else {
            $("#rni_reg_no").text(data.message).show().css("color", "#f8b739");
            $("#abc_cert_no").text(data.message).show().css("color", "#f8b739");
            $("#rni_claimed_cirl").hide();
            $("#rni_efill_no").hide();
            if (cir_no == 0) {
              $("#rni_efiling_no").val('');
            }
            $("#claimed_circulation").val('');
            $("#rni_efiling_no").prop("readonly", false);
            $("#rni_reg_no_verified").val(0);
            $("#claimed_circulation_verified").val(0);
            $("#rni_annual_valid").val(0);
            $("#newspaper_name").val('');
          }
        }
      },
      error: function (error) {
        console.log('error');
      }
    });

    checkFirstPublication(cir_no);
    return true;
  } else {
    $("#rni_reg_no").hide();
    $("#abc_cert_no").hide();
    $("#rni_claimed_cirl").hide();
    $("#rni_efill_no").hide();
    $("#rni_efiling_no").val('');
    $("#rni_annual_valid").val('');
    $("#rni_reg_no_verified").val('');
    $("#claimed_circulation").val('');
    $("#claimed_circulation_verified").val('');
    $("#claimed_circulation_hidden").val('');
  }
}


//start code of display owner press data 
$(document).ready(function () {
  $(".owner_press").on('click', function () {
    var owner_id = $("#ownerid").val();
    if (owner_id != '' && $(this).val() == 1) {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: "get",
        url: 'get-press-owner-data',
        data: {
          owner_id: owner_id
        },
        success: function (data) {
          // console.log(data);
          if (data['status'] == true) {
            console.log("success");
            $("#name_of_press").val(data.data['Name of Press']).prop("readonly", true);
            $("#press_email").val(data.data['Press Email']).prop("readonly", true);
            $("#press_mobile").val(data.data['Press Mobile']).prop("readonly", true);
            $("#press_phone").val(data.data['Press Phone']).prop("readonly", true);
            $("#address_of_press").val(data.data['Address of Press']).prop("readonly", true);
            $("#distance_press").val(Math.round(data.data['Distance from office to press'])).prop("readonly", true);
          } else {
            $("#name_of_press").val('').prop("readonly", false);
            $("#press_email").val('').prop("readonly", false);
            $("#press_mobile").val('').prop("readonly", false);
            $("#press_phone").val('').prop("readonly", false);
            $("#address_of_press").val('').prop("readonly", false);
            $("#distance_press").val('').prop("readonly", false);
          }
        },
        error: function (error) {
          console.log('error');
        }
      });
    } else {
      $("#name_of_press").prop("readonly", false);
      $("#press_email").prop("readonly", false);
      $("#press_mobile").prop("readonly", false);
      $("#press_phone").prop("readonly", false);
      $("#address_of_press").prop("readonly", false);
      $("#distance_press").prop("readonly", false);
    }
  });
});
//end code of display owner press data 

$(document).ready(function () {
  $(".previousClass").click(function () {
    var activity_id = $(this).attr("data");
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: "get",
      url: 'fresh-empanelment-previous',
      data: {
        activity_id: activity_id
      },
      // dataType: "json",
      success: function (data) {
        console.log(data);
        if (data['success'] == true) {
          console.log("success");
        }
      },
      error: function (error) {
        console.log('error');
      }
    });
  });
});

// Check Unique Data 
function checkUniqueVendor(id, val) {
  if (val != '') {
    var email = val;
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: 'GET',
      url: 'checkuniquevendor/' + email,
      data: {},
      success: function (response) {
        if (response.status == 0 && val != $("#vendor_" + id).val()) {
          // console.log("#vendor_"+id);
          $("#v_alert_" + id).html(titleCase(id) + ' ' + response.message);
          $("#v_alert_" + id).show();
          $("#v_" + id).val('');
        } else {
          $("#v_alert_" + id).hide();
        }
      }
    });
  }
}

// get district based on state by ajax call 
$(document).ready(function () {
  $(".call_district").change(function () {
    // if ($(this).val() != '') {
    var id = $(this).attr("data");
    $("#" + id).empty();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: 'get',
      url: 'getdistrict',
      data: {
        state_id: $(this).val()
      },
      success: function (response) {
        //console.log(response);
        $("#" + id).html(response.message);
      }
    });
    //  }
  });
});

function titleCase(string) {
  return string[0].toUpperCase() + string.slice(1).toLowerCase();
}

// exist owner get details
$(document).ready(function () {
  //$("#state_val").prop("disabled", true);
  //$("#district_val").prop("disabled", true);
  $("#add_davp").hide();
  // $("#edition1").prop("disabled", true);
  $("#add_davp").empty();
  $("#exist_owner_id").on('keyup', function () {
    $("#is_primary2").prop("checked", false);
    if ($(this).val() != '') {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'get',
        url: 'existownerdata',
        data: {
          owner_id: $(this).val()
        },
        success: function (response) {
          //console.log(response);
          if (response.status == 0) {
            $("#name").val(response.message['owner_datas']['Owner Name']);
            $("#email").val(response.message['owner_datas']['Email ID']);
            $("#mobile").val(response.message['owner_datas']['Mobile No_']);
            $("#address").val(response.message['owner_datas']['Address 1']);
            $("#city").val(response.message['owner_datas']['City']);
            $("#phone").val(response.message['owner_datas']['Phone No_']);
            $("#fax").val(response.message['owner_datas']['Fax No_']);
            $("#name").prop("readonly", true);
            $("#email").prop("readonly", true);
            $("#mobile").prop("readonly", true);
            $("#address").prop("readonly", true);
            $("#city").prop("readonly", true);
            $("#phone").prop("readonly", true);
            $("#fax").prop("readonly", true);
            var option_state = "<option value='" + response.message['owner_datas']['Code'] + "'> " + response.message['owner_datas']['Code'] + " ~ " + response.message['owner_datas']['Description'] + "</option>";
            $("#state").html(option_state);
            $("#state_val").val(response.message['owner_datas']['Code']);
            $("#state").prop("disabled", true);
            var option_district = "<option value='" + response.message['owner_datas']['District'] + "'>" + response.message['owner_datas']['District'] + "</option>";

            var owner_type_arr = ['Individual', 'Partnership', 'Trust', 'Society', 'Proprietorship', 'Public Ltd', 'Pvt Ltd'];
            var owner_type = [];
            $.each(owner_type_arr, function (index, item) {
              owner_type.push("<option value='" + index + "' " + (index == response.message['owner_datas']['Owner Type'] ? 'selected' : '') + ">" + item + "</option>");
            });

            $("#owner_type").html(owner_type);
            $("#district").html(option_district);
            $("#district_val").val(response.message['owner_datas']['District']);
            $("#owner_type").prop("disabled", true);
            $("#district").prop("disabled", true);
            $("#alert_exist_owner_id").hide();
            $("#edition1").prop('checked', true);
            // $("#edition2").prop("disabled", true);
            $("#edition2").prop('checked', false);
            // $("#edition1").prop("disabled", false);
            $("#davp_panel").prop('checked', true);
            //$("#davp_panel").hide();
            $("#add_davp").show();
            $("#add_davp").empty();
            var len = response.message['owner_other_datas'].length - 1;
            var date_offirst_publication = response.message['owner_other_datas'][len]['Date Of First Publication'];
            let today = new Date();
            today.setMonth(today.getMonth() - 4);
            let date1 = dateFormate(today);
            if (date_offirst_publication != '') {
              $("#firstpublicationdate").val(date_offirst_publication);
              if (date_offirst_publication >= date1) {
                // $("#dateoffirstpublication").text('Date of first publication should be grether than 4 months').show();
                $("#tab_1").css('pointer-events', 'none');
              } else {
                $("#dateoffirstpublication").hide();
                $("#tab_1").css('pointer-events', 'visible');
              }
            } else {
              $("#dateoffirstpublication").hide();
            }

            $.each(response.message['owner_other_datas'], function (index, item) {
              var periocity_val = item['Periodicity'];
              var dis = item['Distance from office to press'];
              $("#add_davp").append('<div class="row"><div class="col-md-12"><h4 class="subheading">Details of other publications of same owner or Publisher-----/एक ही मालिक या प्रकाशक के अन्य प्रकाशनों का विवरण ----</h4></div><div class="col-md-4"><div class="form-group"><label for="title">Title / शीषक</label><input type="text" name="title" placeholder="Enter Title" maxlength="40" class="form-control form-control-sm" id="title" value="' + item['Newspaper Name'] + '" readonly></div></div><div class="col-md-4"><div class="form-group"><label>Language / भाषा</label><select name="lang" class="form-control form-control-sm" style="width: 100%;" disabled><option value="' + item['Code'] + '">' + item['Code'] + '~' + item['Name'] + '</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="publication">Place of Publication / प्रकाशन का स्थान</label><input maxlength="30" type="text" placeholder="Enter Place of Publication" name="place_of_publication_davp" class="form-control form-control-sm" id="publication" value="' + item['Place of Publication'] + '" readonly></div></div><div class="col-md-4"><br><div class="form-group"><label>Periodicity / अवधि</label><select name="periodicity_davp" class="form-control form-control-sm" style="width: 100%;" disabled><option value="0" ' + (periocity_val == 0 ? 'selected' : '') + '>Daily(M)</option><option value="1" ' + (periocity_val == 1 ? 'selected' : '') + '>Daily(E)</option><option value="2" ' + (periocity_val == 2 ? 'selected' : '') + '>Daily Except Sunday</option><option value="3" ' + (periocity_val == 3 ? 'selected' : '') + '>Bi-Weekly</option><option value="4" ' + (periocity_val == 4 ? 'selected' : '') + '>Weekly</option><option value="5" ' + (periocity_val == 5 ? 'selected' : '') + '>Fortnightly</option><option value="6" ' + (periocity_val == 6 ? 'selected' : '') + '>Monthly</option></select></div></div><div class="col-md-4"><br><div class="form-group"><label for="davp">Owner/Group ID / मालिक/समूह कोड</label><input type="text" name="davp" placeholder="Enter Owner/Group ID" maxlength="8" class="form-control form-control-sm" id="davp" value="' + item['Newspaper Code'] + '" readonly></div></div><div class="col-md-4"><div class="form-group"><label for="edition_distance">Distance from this Edition(In Km) / इस संस्करण से दूरी (किमी. में)</label><input type="text" maxlength="15" Place of placeholder="Enter Distance" name="distance_from_edition" value="' + Math.round(dis) + '" readonly class="form-control form-control-sm" id="edition_distance" onkeypress="return onlyNumberKey(event)"></div></div></div><br>');
            });
            $("#state_val").prop("disabled", false);
            $("#district_val").prop("disabled", false);
          } else {
            // $("#name").val('');
            $("#owner_type").html("<option value=''>No Data Found!</option>");
            $("#email").val('');
            $("#mobile").val('');
            $("#address").val('');
            $("#city").val('');
            $("#phone").val('');
            $("#fax").val('');
            $("#state").html("<option value=''>No Data Found!</option>");
            $("#district").html("<option value=''>No Data Found!</option>");
            $("#owner_type").prop("disabled", false);
            $("#district").prop("disabled", false);
            $("#state").prop("disabled", false);
            $("#state_val").prop("disabled", true);
            $("#district_val").prop("disabled", true);
            $("#name").prop("readonly", false);
            $("#email").prop("readonly", false);
            $("#mobile").prop("readonly", false);
            $("#address").prop("readonly", false);
            $("#city").prop("readonly", false);
            $("#phone").prop("readonly", false);
            $("#fax").prop("readonly", false);
            $("#alert_exist_owner_id").text(response.message).show();
            $("#add_davp").hide();
            //$("#davp_panel").hide()
          }
        }
      });
    }
  });
});

/// date fromate yyyy-mm-dd
function dateFormate(date) {
  var dd = String(date.getDate()).padStart(2, '0');
  var mm = String(date.getMonth() + 1).padStart(2, '0');
  var yyyy = date.getFullYear();
  return date = yyyy + '-' + mm + '-' + dd;
}

// // first publication date compare
// function funFirstPublicationDate(e) {
//   var d1 = $("#firstpublicationdate").val();
//   var d2 = e.target.value;

//   if (d1 != '' && d1 != d2 + ' 00:00:00.000') {
//     $("#dateoffirstpublication").text('Date of first publication not match').show();
//     $("#date_of_first_publication").val('');
//   } else {
//     $("#dateoffirstpublication").hide();
//   }
// }

function isPrimaryEdition(val) {
  let checkuser = '';
  $('[name="exist_owner"]:checked').each(function () {
    checkuser = $(this).val();
  });
  if (val == 0) {
    return false;
  }
  if (checkuser == 1 && $("#exist_owner_id").val() == '') {
    $("#is_primary2").prop("checked", false);
    alert("Please Enter Group Code!");
    $("#exist_owner_id").focus();
    return false;
  }

  var owner_id = $("#exist_owner_id").val() ? $("#exist_owner_id").val() : $("#ownerid").val();
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
    },
    type: 'get',
    url: 'check-isprimaryedition',
    data: {
      owner_id: owner_id
    },
    success: function (response) {
      if (response.status == true) {
        alert(response.message);
        $("#is_primary2").prop("checked", false);
      }
    }
  });
}


var blink = document.getElementById('blink');
setInterval(function () {
  blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
}, 1500);


function checkGstUnique(val) {
  if (val != '') {
    $("#name").val("Please Wait...");
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: "get",
      url: "check-gstno",
      data: {
        gst_no: val
      },
      success: function (data) {
        if (data['status'] == true) {
          if ($('.gstvalidationMsg').hasClass('alert-info-msg') == true) {
            $('.gstvalidationMsg').addClass('alert-info-msg2');
            $('.gstvalidationMsg').text(data['message']);
            $('.validcheck').html("");
          }
        } else {
          $.ajax({
            url: '/checkgstprint',
            type: 'GET',
            data: { gstNumber: val },
            success: function (data) {
              console.log(data);
              if (data != '') {
                $("#name").val(data.legalName);
              }
            }
          });
        }
      },
      error: function (error) {
        console.log('error');
      }
    });
  }
}

function funPeriodicity(val) {
  var checkedValue = $('.messageCheckbox:checked').val();
  if (checkedValue == 1) {
    $("#speciman_copy").text('Upload 4 month specimen copy / 4 महीने की नमूना प्रति अपलोड करें');
  } else {
    if (val == 0 || val == 1 || val == 2) {
      $("#speciman_copy").text('Upload 6 month specimen copy / 6 महीने की नमूना प्रति अपलोड करें');
    } else {
      $("#speciman_copy").text('Upload 1 year specimen copy / 1 साल का नमूना कॉपी अपलोड करें');
    }
  }
}