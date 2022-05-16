$(document).ready(function () {
  $(".next-button").click(function () {
    var form = $("#print_fress_emp_renewal");
    form.validate({
      rules: {
        v_email: {
          required: true,
          emailExt: true
        },
        v_address: {
          required: true
        },
        v_phone: {
          minlength: 6,
          maxlength: 15,
          number: true
        },
        claimed_circulation: {
          required: true,
          maxlength: 8,
          number: true
        },
        printing_colour: {
          required: true,
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
        colour_pages: {
          maxlength: 8,
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
        publisher_address: {
          required: true,
        },
        printer_name: {
          required: true,
        },
        printer_email: {
          required: true,
          emailExt: true
        },
        printer_phone: {
          required: true,
          minlength: 6,
          maxlength: 15,
          number: true
        },
        printer_address: {
          required: true,
        },
        dm_declaration_date: {
          required: true,
        },
        Circulation_File_Name: {
          required: true,
        },
        DMD_File_Name: {
          required: true,
        },
        advertisement_policy: {
          required: true
        },       
      },
      messages: {     
        v_email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        v_address: {
          required: "Please fill required field!"
        },
        v_phone: {
          required: "Please fill required field!",
          minlength: "Phone no. length should be min 6 digit!",
          maxlength: "Phone no. length should be max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        claimed_circulation: {
          required: "Please fill required field!",
          maxlength: "Circulation length should be min and max 8 digit!",
          number: "Users can enter only integer numbers!"
        },
        printing_colour: {
          required: "Please fill required field!"
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
        colour_pages: {
          maxlength: "Color pages length should be min and max 8 digit!",
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
        publisher_address: {
          required: "Please fill required field!"
        },
        printer_name: {
          required: "Please fill required field!"
        },
        printer_email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        printer_phone: {
          required: "Please fill required field!",
          minlength: "Phone no. length should be min 6 digit!",
          maxlength: "Phone no. length should be max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        printer_address: {
          required: "Please fill required field!"
        },
        dm_declaration_date: {
          required: "Please fill required field!",
        },
        Circulation_File_Name: {
          required: "Please fill required field!",
        },
        DMD_File_Name: {
          required: "Please fill required field!"
        },
        advertisement_policy: {
          required: "Please fill required field!"
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
    if (form.valid() === true) {
      if ($('#tab1').is(":visible")) {
        current_fs = $('#tab1');
        next_fs = $('#tab2');
        $("a[id='#tab1']").removeClass("active");
        $("a[id='#tab2']").addClass("active");

      } else if ($('#tab2').is(":visible")) {
        current_fs = $('#tab2');
        next_fs = $('#tab3');
        $("a[id='#tab2']").removeClass("active");
        $("a[id='#tab3']").addClass("active");

      } else if ($('#tab3').is(":visible")) {
        current_fs = $('#tab3');
        next_fs = $('#tab4');
        $("a[id='#tab3']").removeClass("active");
        $("a[id='#tab4']").addClass("active");
      } else if ($('#tab4').is(":visible")) {
        current_fs = $('#tab3');
        next_fs = $('#tab4');
        $("a[id='#tab4']").addClass("active");
         renewalSaveData();
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
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z\.\-]+\.[a-zA-Z]{2,4}$/);
  }, 'Please enter a vaild email address');

});

///////////// calculate total print area /////////

$(document).ready(function () {
  $('#page_length').keyup(calculate);
  $('#page_width').keyup(calculate);

});
function calculate(e) {
  var pages = 1;
  if($('#no_of_page').val() !=0){
    pages = $('#no_of_page').val();
  }
  var num = $('#page_length').val() * $('#page_width').val() * pages;

  $('#total_print_area').val(num.toFixed(4));
}

////////////// file upload size  512kb ////////////////
$(document).ready(function () {
  $(".custom-file-input").change(function () {
    var id = $(this).attr("id");
    var file = this.files[0].name;
    var file1 = $('#' + id + 2).text();

    var totalBytes = this.files[0].size;
    var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
    var ext = file.split('.').pop();
    if (file != '' && sizemb <= 2 && ext == "pdf") {
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

$("#colour_pages").keyup(function() {
  var pages = $("#no_of_page").val();
  //alert( parseInt(pages));
  if (pages =='' || parseInt($(this).val()) > parseInt(pages)) {
    $("#alert_colour_pages").text('Color pages value should be less than or equal to no. of pages').show();
  } else {
    $("#alert_colour_pages").hide();
  }
});

function removezero(val){
if(val == 0){
  $("#claimed_circulation").val('');
}
}


function latestDmCertificate(val) {
  if (val == 1) {
    $("#dm_certificate").removeClass("hide-msg");
  } else {
    $("#dm_certificate").addClass("hide-msg");
  }
}