
$(document).ready(function(){
  $(".submit-button").click(function(){
    var form = $("#complianceFrm");      
    form.validate({
      rules: {   
        npcode: {
          required:true,
        },
        rocode: {
          required:true,
        },
        published_date: {
          required:true,

        },
        published_pageno : {
          required:true,
        }, 
        print_upload_creative_fileName : {
          required:true,
        },
                              
      },
      messages: {      
        npcode: {
          required:"Please fill required field!",

        },
        rocode: {
          required:"Please fill required field!",

        },
        published_date: {
          required:"Please fill required field!",

        },
        published_pageno: {
          required:"Please fill required field!",

        },
        print_upload_creative_fileName: {
          required:"Please fill required field!",

        },
        
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
    if (form.valid() === true){
     SaveData();
    }else{
      
    }

  });
});