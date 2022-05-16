
$(document).ready(function(){
  $(".client-next-button").click(function(){
    var form = $("#client_request");        
    var validator=form.validate({
      rules: {
        /*  Basicinfo tab validation Rules*/       
        Name_of_Officer: {required:true, minlength:3, maxlength:40},
        Designation: {required:true,minlength:2,maxlength: 40},
        email: {required: true,emailExt:true, maxlength:40},
        mobile: {required: true, minlength: 10,maxlength: 10,number:true},
        address: {required: true},
        from_date:{required:true},
        to_date:{required:true},
        tentative_budget:{required:true}, 
        'media_name_s[]':{required:true}, 
        Campaign_Type:{required:true},
        /*  Print media tab validation Rules*/
        //knowncampaign:{required:true},
        Plan_No: {required:true, maxlength:20},
        print_media_planType: {required:true},
        multi_langauge_select: {required:true},                        
        individuals_s: { required:true},
        group_of_city: { required:true},
        cityList: {required:true},
        pageSize: {required:true},
        un_advertise_length:{required:true}, 
        un_advertise_breadth:{required:true}, 
        un_advertise_area:{required:true},
        print_color:{required:true},
        print_target_area:{ required:true},
        print_language:{required:true}, 
        print_media_plan:{required:true}, 
        print_advertisement_display_select:{required:true},
        print_creative:{required:true},
        print_upload_creative_fileName:{required:true},
        group_s:{required:true },
        group_of_city:{ required:true },
        langauge_list:{required:true},
        /*Outdoor media tab validation Rules*/
        OutdoorMedium :{ required:true },
        outdoorLanguage :{ required:true },
        "outdoorTArea[]" :{ required:true },
        "outdoorAdvLength[]" :{ required:true },
        "outdoorAdvBreadth[]" :{ required:true },
        "outdoorAdvArea[]" :{ required:true }, 
        "outdoorIndividualState[]" :{ required:true }, 
        //outdoorCityWithState :{ required:true },
        "outdoorCityList[]" :{ required:true }, 
        "outdoorTown[]" :{ required:true }, 
        "outdoorZone[]" :{ required:true }, 
        "outdoorPostalCode[]" :{ required:true },
        "outdoorDistrict[]" :{ required:true }, 
        "outdoorGroupState[]" :{ required:true },
        "outdoorGroupCity[]" :{ required:true }, 
        "outdoorRandomCityList[]" :{ required:true }, 
        "outdoorMediaCategory[]" :{ required:true }, 
        "outdoorMediaSubCategory[]" :{ required:true },
        //outdoorDuration :{ required:true }, 
        "outdoorSpotsno[]" :{ required:true }, 
        outdoorCreativeAvail :{ required:true },
        outdoorCreativeFileName:{ required:true },
        /*  TV validation start*/
        tvTargetArea:{ required:true },
        tvRegion:{ required:true },
        tvSpotsNo:{ required:true },
        tvDuration:{ required:true },
        tvCreativeAvail:{ required:true },
        tvCreativeFileName:{ required:true },
        /* End tv Validation*/
        /*  crs Radio validation start*/
        crsRadioMedium:{ required:true },
        crsRadioTargetArea:{ required:true },
        crsRadioRegion:{ required:true },
        crsRadioSpotsNo:{ required:true },
        crsRadioDuration:{ required:true },
        crsRadioCreativeAvail:{ required:true },
        crsRadioCreativeFileName:{ required:true },
        
        /* End crs Radio Validation*/

      },
      messages: { 
        /*  Basicinfo tab validation Mesage*/       
        Name_of_Officer: {required:"Please fill required field!", minlength: "Officer name must be at least 3 alphabets!",maxlength: "Users can type only max 40 alphabets!"},
        Designation: {required:"Please fill required field!", minlength: "Designation must be at least 2 alphabets!", maxlength: "Users can type only max 40 alphabets!"},
        email: {required: "Please fill required field!", email: "Please enter a vaild email address!"},
        mobile: {required: "Please fill required field!",maxlength: "Mobile length should be max and min 10 digit!",number: "Users can enter only integer numbers!"},
        address: {required: "Please fill required field!"},
        from_date:{required:"Please fill required field!"},
        to_date:{required:"Please fill required field!" }, 
        tentative_budget:{required:"Please fill required field!"}, 
        'media_name_s[]':{ required:"Please fill required field!"},
        Campaign_Type:{required:"Please fill required field!"},
        /*Print media tab validation Message*/
        langauge_list: {required:"Please fill required field!",},
        individuals_s: {required:"Please fill required field!", },
        group_s: {required:"Please fill required field!"},
        group_of_city: {required:"Please fill required field!",},
        cityList: {required:"Please fill required field!", },
        group_of_city: {required:"Please fill required field!",},
        pageSize: {  required:"Please fill required field!", },
        print_media_planType: {required:"Please fill required field!",},
        Plan_No: {required:"Please fill required field!",},
        un_advertise_length:{required:"Please fill required field!"},
        un_advertise_breadth:{required:"Please fill required field!"},
        un_advertise_area:{required:"Please fill required field!"}, 
        print_color:{required:"Please fill required field!"},
        multi_langauge_select:{required:"Please fill required field!"},
        print_target_area:{ required:"Please fill required field!"},
        print_language:{ required:"Please fill required field!" }, 
        print_media_plan:{ required:"Please fill required field!" },
        print_advertisement_display_select:{ required:"Please fill required field!" },
        print_creative:{required:"Please fill required field!" },
        print_upload_creative_fileName:{ required:"Please fill required field!"},
        /*Outdoor media tab validation message*/
        OutdoorMedium :{ required:"Please fill required field!" },
        outdoorLanguage :{ required:"Please fill required field!" },
        outdoorTArea :{ required:"Please fill required field!" },
        outdoorAdvLength :{ required:"Please fill required field!" },
        outdoorAdvBreadth :{ required:"Please fill required field!" },
        outdoorAdvArea :{ required:"Please fill required field!" }, 
        outdoorIndividualState :{ required:"Please fill required field!" }, 
        outdoorCityWithState :{ required:"Please fill required field!" },
        outdoorCityList :{ required:"Please fill required field!" }, 
        outdoorTown :{ required:"Please fill required field!" }, 
        outdoorZone :{ required:"Please fill required field!" }, 
        outdoorPostalCode :{ required:"Please fill required field!" },
        outdoorDistrict :{ required:"Please fill required field!" }, 
        outdoorGroupState :{ required:"Please fill required field!" },
        outdoorGroupCity :{ required:"Please fill required field!" }, 
        outdoorRandomCityList :{ required:"Please fill required field!" }, 
        outdoorMediaCategory :{ required:"Please fill required field!" }, 
        outdoorMediaSubCategory :{ required:"Please fill required field!" },
        outdoorDuration :{ required:"Please fill required field!" }, 
        outdoorSpotsno :{ required:"Please fill required field!" }, 
        outdoorCreativeAvail :{ required:"Please fill required field!" },
        outdoorCreativeFileName:{ required:"Please fill required field!" },
        /*  TV validation start*/
        tvTargetArea:{ required:"Please fill required field!" },
        tvRegion:{ required:"Please fill required field!" },
        tvSpotsNo:{ required:"Please fill required field!" },
        tvDuration:{ required:"Please fill required field!" },
        tvCreativeAvail:{ required:"Please fill required field!" },
        tvCreativeFileName:{ required:"Please fill required field!" },
        /* End tv Validation*/
        /*  crs Radio validation start*/
        crsRadioMedium:{ required:"Please fill required field!" },
        crsRadioTargetArea:{ required:"Please fill required field!" },
        crsRadioRegion:{ required:"Please fill required field!" },
        crsRadioSpotsNo:{ required:"Please fill required field!" },
        crsRadioDuration:{ required:"Please fill required field!" },
        crsRadioCreativeAvail:{ required:"Please fill required field!" },
        crsRadioCreativeFileName:{ required:"Please fill required field!" },
        
        /* End crs Radio Validation*/
        
      },
      //debug: true,
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
      },
      //ignore:[] 
    });
    if (form.valid() === true)
    {
      var count=getMediaNameLength();
      if ($('#basicInfoTab').is(":visible"))
      {
        $("li[data-target='#basicInfoTab']").removeClass("active show");
        $("a[id='basicInfoTab-trigger']").attr('aria-selected', false);
        $("a[id='basicInfoTab-trigger']").attr('disabled', true);
        $('select[name="media_name_s[]"] option:selected').each(function(index,v) {
            //console.log('v',k);
          var mNameval=$(this).val();
          if( mNameval=="1"&& count=="1" || mNameval=="1"&& count>1 && index=="0" ){
            //alert('a1');
            $("a[id='printMediaTab-trigger']").attr('disabled', false);
            $("a[id='printMediaTab-trigger']").attr('aria-selected', true);
            $("li[data-target='#printMediaTab']").addClass("active show");
            $("li[data-target='#outdoorMediaTab']").hide();
            $("li[data-target='#printMediaTab']").show();
            $('#printMediaTab').show();
            $('#basicInfoTab').hide();
            $('#outdoorMediaTab').hide();
            $('#previous_btn').show();
            $('#btntab').removeClass('btntab1');
            $('#btntab').addClass('btntab2');
           if(mNameval=="1" && count=="1"){
               $('.btntab2').html('<i class="" id="btnloader">Submit</i> <i class="fa fa-save"></i>'); 
            }else{
                $('.btntab2').html('<i class="" id="btnloader">Next</i> <i class="fa fa-caret-right"></i>');
            }

            
          }else if(mNameval=="2"&& count=="1" || mNameval=="2"&& count>1 && index=="0"){
            //alert('a2');
            $("a[id='outdoorMediaTab-trigger']").attr('disabled', false);
            $("a[id='outdoorMediaTab-trigger']").attr('aria-selected', true);
            $("li[data-target='#outdoorMediaTab']").addClass("active show");
            $("li[data-target='#printMediaTab']").hide();
            $("li[data-target='#outdoorMediaTab']").show();
            $('#outdoorMediaTab').show();
            $('#basicInfoTab').hide();
            $('#printMediaTab').hide();
            $('#previous_btn').show();
            $('#btntab').removeClass('btntab1');
            $('#btntab').addClass('btntab2');
            if(mNameval=="2" && count=="1"){
               $('.btntab2').html('<i class="" id="btnloader">Submit</i> <i class="fa fa-save"></i>'); 
            }
            else{
                $('.btntab2').html('<i class="" id="btnloader">Next</i> <i class="fa fa-caret-right"></i>');
            }
          }else if(mNameval=="3" && count=="1" || mNameval=="3" && count>1 && index=="0"){
            //alert('a3');
            $("a[id='tvMediaTab-trigger']").attr('disabled', false);
            $("a[id='tvMediaTab-trigger']").attr('aria-selected', true);
            $("li[data-target='#tvMediaTab']").addClass("active show");
            $("li[data-target='#printMediaTab']").hide();
            $("li[data-target='#outdoorMediaTab']").hide();
            $("li[data-target='#tvMediaTab']").show();
            $('#tvMediaTab').show();
            $('#outdoorMediaTab').hide();
            $('#basicInfoTab').hide();
            $('#printMediaTab').hide();
            $('#previous_btn').show();
            $('#btntab').removeClass('btntab1');
            $('#btntab').addClass('btntab2');
            if(mNameval=="3" && count=="1"){
               $('.btntab2').html('<i class="" id="btnloader">Submit</i> <i class="fa fa-save"></i>'); 
            }
            else{
                $('.btntab2').html('<i class="" id="btnloader">Next</i> <i class="fa fa-caret-right"></i>');
            }
          }else if(mNameval=="4" && count=="1" || mNameval=="4" && count>1 && index=="0"){
            //alert('a4');
            $("a[id='crsRadioMediaTab-trigger']").attr('disabled', false);
            $("a[id='crsRadioMediaTab-trigger']").attr('aria-selected', true);
            $("li[data-target='#crsRadioMediaTab']").addClass("active show");
            $("li[data-target='#printMediaTab']").hide();
            $("li[data-target='#outdoorMediaTab']").hide();
            $("li[data-target='#tvMediaTab']").hide();
            $("li[data-target='#crsRadioMediaTab']").show();
            $('#crsRadioMediaTab').show();
            $('#tvMediaTab').hide();
            $('#outdoorMediaTab').hide();
            $('#basicInfoTab').hide();
            $('#printMediaTab').hide();
            $('#previous_btn').show();
            $('#btntab').removeClass('btntab1');
            $('#btntab').addClass('btntab2');
            if(mNameval=="4" && count=="1"){
               $('.btntab2').html('<i class="" id="btnloader">Submit</i> <i class="fa fa-save"></i>'); 
            }
           else{
                $('.btntab2').html('<i class="" id="btnloader">Next</i> <i class="fa fa-caret-right"></i>');
            }
            
          }
        });
        nextSaveData('btnInfoTab');
      }
      else if($('#printMediaTab').is(":visible")  ){//print selectd
        $("a[id='printMediaTab-trigger']").attr('disabled', true);
        $("a[id='printMediaTab-trigger']").attr('aria-selected', false);
        $("li[data-target='#printMediaTab']").removeClass("active show");
        nextSaveData('printMediaTab');
      }else if($('#outdoorMediaTab').is(":visible")  ){//print selectd
        $("a[id='outdoorMediaTab-trigger']").attr('disabled', true);
        $("a[id='outdoorMediaTab-trigger']").attr('aria-selected', false);
        $("li[data-target='#outdoorMediaTab']").removeClass("active show");
        nextSaveData('outdoorMediaTab');
      }else if($('#tvMediaTab').is(":visible")  ){//tv selectd
        $("a[id='tvMediaTab-trigger']").attr('disabled', true);
        $("a[id='tvMediaTab-trigger']").attr('aria-selected', false);
        $("li[data-target='#tvMediaTab']").removeClass("active show");
        nextSaveData('tvMediaTab');
      }else if($('#crsRadioMediaTab').is(":visible") ){//crsRadio selectd
        $("a[id='crsRadioMediaTab-trigger']").attr('disabled', true);
        $("a[id='crsRadioMediaTab-trigger']").attr('aria-selected', false);
        $("li[data-target='#crsRadioMediaTab']").removeClass("active show");
        nextSaveData('crsRadioMediaTab');
      }/*else if($('#printMediaTab').is(":visible") && count>1 ){//print selectd
        $("a[id='printMediaTab-trigger']").attr('disabled', true);
        $("a[id='printMediaTab-trigger']").attr('aria-selected', false);
        $("li[data-target='#printMediaTab']").removeClass("active show");
        $("a[id='outdoorMediaTab-trigger']").attr('disabled', false);
        $("a[id='outdoorMediaTab-trigger']").attr('aria-selected', true);
        $("li[data-target='#outdoorMediaTab']").addClass("active show");
        //$("li[data-target='#outdoorMediaTab']").show();
        $('#printMediaTab').hide();
        $('#outdoorMediaTab').show();
        $('#btntab').removeClass('btntab1');
        $('#btntab').removeClass('btntab2');
        $('#btntab').addClass('btntab3');
        $('.btntab3').html('<i class="" id="btnloader">Submit</i> <i class="fa fa-save"></i>');
        nextSaveData('printMediaTab');
      }else if($('#outdoorMediaTab').is(":visible") && count>1 ){//print selectd
        $("a[id='printMediaTab-trigger']").attr('disabled', true);
        $("a[id='printMediaTab-trigger']").attr('aria-selected', false);
        $("li[data-target='#printMediaTab']").removeClass("active show");
        $("a[id='outdoorMediaTab-trigger']").attr('disabled', true);
        $("a[id='outdoorMediaTab-trigger']").attr('aria-selected', false);
        $("li[data-target='#outdoorMediaTab']").removeClass("active show");
        $("a[id='tvMediaTab-trigger']").attr('disabled', false);
        $("a[id='tvMediaTab-trigger']").attr('aria-selected', true);
        $("li[data-target='#tvMediaTab']").addClass("active show");
        //$("li[data-target='#tvMediaTab']").show();
        $('#btntab').removeClass('btntab1');
        $('#btntab').removeClass('btntab2');
        $('#btntab').removeClass('btntab3');
        $('#btntab').addClass('btntab4');
        $('.btntab4').html('<i class="" id="btnloader">Submit</i> <i class="fa fa-save"></i>');
        nextSaveData('outdoorMediaTab');
      }else if($('#tvMediaTab').is(":visible") && count>1 ){//print selectd
        $("a[id='tvMediaTab-trigger']").attr('disabled', true);
        $("a[id='tvMediaTab-trigger']").attr('aria-selected', false);
        $("li[data-target='#tvMediaTab']").removeClass("active show");
        $("a[id='crsRadioMediaTab-trigger']").attr('disabled', false);
        $("a[id='crsRadioMediaTab-trigger']").attr('aria-selected', true);
        $("li[data-target='#crsRadioMediaTab']").addClass("active show");
        //$("li[data-target='#crsRadioMediaTab']").show();
        $('#btntab').removeClass('btntab1');
        $('#btntab').removeClass('btntab2');
        $('#btntab').removeClass('btntab3');
        $('#btntab').addClass('btntab4');
        $('.btntab4').html('<i class="" id="btnloader">Submit</i> <i class="fa fa-save"></i>');
        nextSaveData('tvMediaTab');
      }else if($('#crsRadioMediaTab').is(":visible") && count>1 ){//print selectd
        $("a[id='crsRadioMediaTab-trigger']").attr('disabled', true);
        $("a[id='crsRadioMediaTab-trigger']").attr('aria-selected', false);
        $("li[data-target='#crsRadioMediaTab']").removeClass("active show");
        $('#btntab').removeClass('btntab1');
        $('#btntab').removeClass('btntab2');
        $('#btntab').removeClass('btntab3')
         $('#btntab').removeClass('btntab4');
        $('#btntab').addClass('btntab5');
        $('.btntab5').html('<i class="" id="btnloader">Submit</i> <i class="fa fa-save"></i>');
        nextSaveData('crsRadioMediaTab');
      }*/
    }
  });
  $('.reg-previous-button').click(function(){
      var count=getMediaNameLength();
      $('select[name="media_name_s[]"] option:selected').each(function() {
        var mNameval=$(this).val();
        if( (mNameval=="1"&& count=="1") || (mNameval=="2" && count=="1") || (mNameval=="3" && count=="1") || (mNameval=="4" && count=="1") ){//print
          $("li[data-target='#printMediaTab']").removeClass("active show");
          $("a[id='printMediaTab-trigger']").attr('disabled', true);
          $("a[id='printMediaTab-trigger']").attr('aria-selected', false);
          $("li[data-target='#outdoorMediaTab']").removeClass("active show");
          $("a[id='outdoorMediaTab-trigger']").attr('disabled', true);
          $("a[id='outdoorMediaTab-trigger']").attr('aria-selected', false);
          $("li[data-target='#tvMediaTab']").removeClass("active show");
          $("a[id='tvMediaTab-trigger']").attr('disabled', true);
          $("a[id='tvMediaTab-trigger']").attr('aria-selected', false);
          $("li[data-target='#crsRadioMediaTab']").removeClass("active show");
          $("a[id='crsRadioMediaTab-trigger']").attr('disabled', true);
          $("a[id='crsRadioMediaTab-trigger']").attr('aria-selected', false);

          $("a[id='basicInfoTab-trigger']").attr('disabled', false);
          $("a[id='basicInfoTab-trigger']").attr('aria-selected', true);
          $("li[data-target='#basicInfoTab']").addClass("active show");
          $('#basicInfoTab').show();
          $('#printMediaTab').hide();
          $('#outdoorMediaTab').hide();
          $('#tvMediaTab').hide();
          $('#crsRadioMediaTab').hide();
          $('#previous_btn').hide();
          $('#btntab').removeClass('btntab2');
          $('#btntab').removeClass('btntab3');
          $('#btntab').addClass('btntab1');
          $('.btntab1').html('<i class="" id="btnloader">Next</i> <i class="fa fa-caret-right"></i>');
        }/*else if($('#printMediaTab').is(":visible") && count>1 ){//print selectd
          $("li[data-target='#printMediaTab']").removeClass("active show");
          $("a[id='printMediaTab-trigger']").attr('disabled', true);
          $("a[id='printMediaTab-trigger']").attr('aria-selected', false);
          $("li[data-target='#outdoorMediaTab']").removeClass("active show");
          $("a[id='outdoorMediaTab-trigger']").attr('disabled', true);
          $("a[id='outdoorMediaTab-trigger']").attr('aria-selected', false);
          $("li[data-target='#tvMediaTab']").removeClass("active show");
          $("a[id='tvMediaTab-trigger']").attr('disabled', true);
          $("a[id='tvMediaTab-trigger']").attr('aria-selected', false);
          $("a[id='basicInfoTab-trigger']").attr('disabled', false);
          $("a[id='basicInfoTab-trigger']").attr('aria-selected', true);
          $("li[data-target='#basicInfoTab']").addClass("active show");
          $('#basicInfoTab').show();
          $('#printMediaTab').hide();
          $('#outdoorMediaTab').hide();
          $('#tvMediaTab').hide();
          $('#previous_btn').hide();
          $('#btntab').removeClass('btntab2');
          $('#btntab').removeClass('btntab3');
          $('#btntab').addClass('btntab1');
          $('.btntab1').html('<i class="" id="btnloader">Next</i> <i class="fa fa-caret-right"></i>');
        }*//*else if( $('#outdoorMediaTab').is(":visible") && count>1 ){//print selectd
          $("li[data-target='#printMediaTab']").addClass("active show");
          $("a[id='printMediaTab-trigger']").attr('disabled', false);
          $("a[id='printMediaTab-trigger']").attr('aria-selected', true);

          $("li[data-target='#outdoorMediaTab']").removeClass("active show");
          $("a[id='outdoorMediaTab-trigger']").attr('disabled', true);
          $("a[id='outdoorMediaTab-trigger']").attr('aria-selected', false);
          
          $("a[id='basicInfoTab-trigger']").attr('disabled', true);
          $("a[id='basicInfoTab-trigger']").attr('aria-selected', false);
          $("li[data-target='#basicInfoTab']").removeClass("active show");
          $('#basicInfoTab').hide();
          $('#outdoorMediaTab').hide();
          $('#previous_btn').show();
          $('#printMediaTab').show();
          $('#btntab').removeClass('btntab3');
          $('#btntab').addClass('btntab2');
          $('.btntab2').html('<i class="" id="btnloader">Next</i> <i class="fa fa-save"></i>');
        }*/
        /*else if( $('#outdoorMediaTab').is(":visible") && count>1 ){//print selectd

          $("a[id='basicInfoTab-trigger']").attr('disabled', true);
          $("a[id='basicInfoTab-trigger']").attr('aria-selected', false);
          $("li[data-target='#basicInfoTab']").removeClass("active show");

          
          $("a[id='outdoorMediaTab-trigger']").attr('disabled', true);
          $("a[id='outdoorMediaTab-trigger']").attr('aria-selected', false);
          $("li[data-target='#outdoorMediaTab']").removeClass("active show");

          $("a[id='tvMediaTab-trigger']").attr('disabled', true);
          $("a[id='tvMediaTab-trigger']").attr('aria-selected', false);
          $("li[data-target='#tvMediaTab']").removeClass("active show");
  
          $("li[data-target='#printMediaTab']").addClass("active show");
          $("a[id='printMediaTab-trigger']").attr('disabled', false);
          $("a[id='printMediaTab-trigger']").attr('aria-selected', true);
          $('#basicInfoTab').hide();
          $('#outdoorMediaTab').hide();
          $('#tvMediaTab').hide();
          $('#printMediaTab').show();
          $('#btntab').removeClass('btntab3');
          $('#btntab').addClass('btntab2');
          $('.btntab2').html('<i class="" id="btnloader">Next</i> <i class="fa fa-save"></i>');
          $('#previous_btn').show();
          
        }else if( $('#tvMediaTab').is(":visible") && count>1 ){//print selectd

          $("a[id='basicInfoTab-trigger']").attr('disabled', true);
          $("a[id='basicInfoTab-trigger']").attr('aria-selected', false);
          $("li[data-target='#basicInfoTab']").removeClass("active show");

          $("a[id='tvMediaTab-trigger']").attr('disabled', true);
          $("a[id='tvMediaTab-trigger']").attr('aria-selected', false);
          $("li[data-target='#tvMediaTab']").removeClass("active show");
  
          $("li[data-target='#printMediaTab']").removeClass("active show");
          $("a[id='printMediaTab-trigger']").attr('disabled', true);
          $("a[id='printMediaTab-trigger']").attr('aria-selected', false);

          $("a[id='outdoorMediaTab-trigger']").attr('disabled', false);
          $("a[id='outdoorMediaTab-trigger']").attr('aria-selected', true);
          $("li[data-target='#outdoorMediaTab']").addClass("active show");
          $('#basicInfoTab').hide();
           $('#tvMediaTab').hide();
          $('#printMediaTab').hide();
          $('#outdoorMediaTab').show();
          $('#btntab').removeClass('btntab4');
          $('#btntab').addClass('btntab3');
          $('.btntab3').html('<i class="" id="btnloader">Next</i> <i class="fa fa-save"></i>');
          $('#previous_btn').show();
          return false;
        }*/

      });
  });
  $('#btntab').addClass('btntab1');
  $('.btntab1').html('<i class="" id="btnloader">Next</i> <i class="fa fa-caret-right"></i>');
  $('#previous_btn').hide();
  //Campaign type select
  var CampaignType = $("#Campaign_Type").val();
    if(CampaignType=="0"){ 
        $('#mediaNameDiv').hide();
        $('#singlemediaNameDiv').show();
        $("#mediaName").attr("name", "multipleMediaName");
        $("#singlemediaName").attr("name", "media_name_s[]");
    }else if(CampaignType == "1")
    {
      $('#singlemediaNameDiv').hide();
      $('#mediaNameDiv').show(); 
      $("#mediaName").attr("name", "media_name_s[]");
      $("#singlemediaName").attr("name", "singlemediaName");

    }
  $('#Campaign_Type').change(function(){
    var CampaignType = $("#Campaign_Type").val();
    if(CampaignType=="0"){ 
      $('#mediaNameDiv').hide();
      $('#singlemediaNameDiv').show();
      $("#mediaName").attr("name", "multipleMediaName");
      $("#singlemediaName").attr("name", "media_name_s[]");
    }else if(CampaignType == "1")
    {
      $('#singlemediaNameDiv').hide();
      $('#mediaNameDiv').show(); 
      $("#mediaName").attr("name", "media_name_s[]");
      $("#singlemediaName").attr("name", "singlemediaName");

    }

  });
  $('#mediaName').multiselect({
        nonSelectedText: 'Select Media Name',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'100%',
        textleft:true,
        includeSelectAllOption:true,
    });
  function getMediaNameLength() {
    var val=[]; 
    $('select[name="media_name_s[]"] option:selected').each(function() {
      var mNameval1=$(this).val();
      val.push(mNameval1);
    });
    return val.length;
    
  }
  //end Campaign type
  
  jQuery.validator.addMethod("emailExt", function(value, element, param) {
  return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
  },'Please enter a vaild email address');
 

});