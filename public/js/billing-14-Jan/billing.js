
$(document).ready(function(){
  $(".submit-button").click(function(){
    var form = $("#billingFrm");      
    form.validate({
      rules: {   
        billno: {
          required:true,
        },
        bill_date: {
          required:true,
        },
        publication_date: {
          required:true,

        },
        gstno : {
          required:true,
        }, 
        bublishedIn : {
          required:true,
        },
        published_pageno : {
          required:true,
        },
        advtLen : {
          required:true,
        },
        advtWidth : {
          required:true,
        },
        diff : {
          required:true,
        },
        claimedAmount : {
          required:true,
        },
        billOfficerName : {
          required:true,
        },
        billOfficerDesign : {
          required:true,
        },
        email : {
          required:true,
        },
        SignatoryName : {
          required:true,
        },
        SignatoryDesign : {
          required:true,
        },
        advtImage : {
          required:true,
        },
        npImage : {
          required:true
        },
        
                              
      },
      messages: {      
        billno: {
          required:"Please fill required field!",
        },
        bill_date: {
          required:"Please fill required field!",
        },
        publication_date: {
          required:"Please fill required field!",

        },
        gstno : {
          required:"Please fill required field!",
        }, 
        bublishedIn : {
          required:"Please fill required field!",
        },
        published_pageno : {
          required:"Please fill required field!",
        },
        advtLen : {
          required:"Please fill required field!",
        },
        advtWidth : {
          required:"Please fill required field!",
        },
        diff : {
          required:"Please fill required field!",
        },
        claimedAmount : {
          required:"Please fill required field!",
        },
        billOfficerName : {
          required:"Please fill required field!",
        },
        billOfficerDesign : {
          required:"Please fill required field!",
        },
        email : {
          required:"Please fill required field!",
        },
        SignatoryName : {
          required:"Please fill required field!",
        },
        SignatoryDesign : {
          required:"Please fill required field!",
        },
        advtImage : {
          required:"Please fill required field!",
        },
        npImage : {
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

    