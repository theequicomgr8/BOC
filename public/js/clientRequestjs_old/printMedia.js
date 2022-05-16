
$(document).ready(function(){
  $('#randomCityList').multiselect({
    nonSelectedText: 'Select Random City',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth:'100%',
    textleft:true,
    includeSelectAllOption:true,
  });
  //Group of state
  $('#group_s').multiselect({
    nonSelectedText: 'Select Group of State',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth:'100%',
    textleft:true,
    includeSelectAllOption:true,
    //includeSelectAllIfMoreThan: 0,
    /*onDropdownShow: function(event) {
        var positions = jQuery('#group_s').val();
        errorPlacement(jQuery('#group_s'), positions);
    },
    onDropdownHide: function(event) {
        var positions = jQuery('#group_s').val();
        errorPlacement(jQuery('#group_s'), positions);
      }*/
  });
  //End group of state
  //Start multiple langauge
  $('#multi_langauge_select').multiselect({
    nonSelectedText: 'Select Group of language',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth:'100%',
    textleft:true,
    includeSelectAllOption:true,
  });

  $('#printLength').hide();
  $('#printBread').hide();
  $('#printArea').hide();
  var pageSize =$('#pageSize option:selected').val();
  if(pageSize == "0"){
    $('#un_advertise_length').val();
    $('#un_advertise_breadth').val();
    $('#un_advertise_area').val();
    $('#un_advertise_length').prop("readonly",false);
    $('#un_advertise_breadth').prop("readonly",false);
    $('#un_advertise_area').prop("readonly",true);
    $("#un_advertise_length,#un_advertise_breadth").keyup(function () {

      $('#un_advertise_area').val($('#un_advertise_length').val() * $('#un_advertise_breadth').val());

    });
    $('#printLength').show();
    $('#printBread').show();
    $('#printArea').show(); 
  }else if(pageSize == "1"){  //hph

    $('#un_advertise_length').val("25");
    $('#un_advertise_breadth').val("33");
    $('#un_advertise_area').val(25 * 33);
    $('#un_advertise_length').prop("readonly",true);
    $('#un_advertise_breadth').prop("readonly",true);
    $('#un_advertise_area').prop("readonly",true);
    $('#printLength').show();
    $('#printBread').show();
    $('#printArea').show(); 
  }else if(pageSize == "2"){//fp
    $('#un_advertise_length').val("0");
    $('#un_advertise_breadth').val("0");
    $('#un_advertise_area').val("0");
    $('#un_advertise_length').prop("readonly",true);
    $('#un_advertise_breadth').prop("readonly",true);
    $('#un_advertise_area').prop("readonly",true);
    $('#printLength').show();
    $('#printBread').show();
    $('#printArea').show(); 
  }else if(pageSize == "3"){  //hpv

    $('#un_advertise_length').val("52");
    $('#un_advertise_breadth').val("16");
    $('#un_advertise_area').val(52 * 16);
    $('#un_advertise_length').prop("readonly",true);
    $('#un_advertise_breadth').prop("readonly",true);
    $('#un_advertise_area').prop("readonly",true);
    $('#printLength').show();
    $('#printBread').show();
    $('#printArea').show(); 
  }else if(pageSize == "4"){  //Qp

    $('#un_advertise_length').val("25");
    $('#un_advertise_breadth').val("16");
    $('#un_advertise_area').val(25 * 16);
    $('#un_advertise_length').prop("readonly",true);
    $('#un_advertise_breadth').prop("readonly",true);
    $('#un_advertise_area').prop("readonly",true);
    $('#printLength').show();
    $('#printBread').show();
    $('#printArea').show(); 
  }
  $('#pageSize').change(function(){
    var pageSize =$('#pageSize option:selected').val();
    if(pageSize == "0"){
      $('#un_advertise_length').val('');
      $('#un_advertise_breadth').val("");
      $('#un_advertise_area').val('');
      $('#un_advertise_length').prop("readonly",false);
      $('#un_advertise_breadth').prop("readonly",false);
      $('#un_advertise_area').prop("readonly",true);
      $("#un_advertise_length,#un_advertise_breadth").keyup(function () {
        $('#un_advertise_area').val($('#un_advertise_length').val() * $('#un_advertise_breadth').val());
      });
      $('#printLength').show();
      $('#printBread').show();
      $('#printArea').show(); 
    }else if(pageSize == "1"){  //hph

      $('#un_advertise_length').val("25");
      $('#un_advertise_breadth').val("33");
      $('#un_advertise_area').val(25 * 33);
      $('#un_advertise_length').prop("readonly",true);
      $('#un_advertise_breadth').prop("readonly",true);
      $('#un_advertise_area').prop("readonly",true);
      $('#printLength').show();
      $('#printBread').show();
      $('#printArea').show(); 
    }else if(pageSize == "2"){//fp
      $('#un_advertise_length').val("0");
      $('#un_advertise_breadth').val("0");
      $('#un_advertise_area').val("0");
      $('#un_advertise_length').prop("readonly",true);
      $('#un_advertise_breadth').prop("readonly",true);
      $('#un_advertise_area').prop("readonly",true);
      $('#printLength').show();
      $('#printBread').show();
      $('#printArea').show(); 
    }else if(pageSize == "3"){  //hpv

      $('#un_advertise_length').val("52");
      $('#un_advertise_breadth').val("16");
      $('#un_advertise_area').val(52 * 16);
      $('#un_advertise_length').prop("readonly",true);
      $('#un_advertise_breadth').prop("readonly",true);
      $('#un_advertise_area').prop("readonly",true);
      $('#printLength').show();
      $('#printBread').show();
      $('#printArea').show(); 
    }else if(pageSize == "4"){  //Qp

      $('#un_advertise_length').val("25");
      $('#un_advertise_breadth').val("16");
      $('#un_advertise_area').val(25 * 16);
      $('#un_advertise_length').prop("readonly",true);
      $('#un_advertise_breadth').prop("readonly",true);
      $('#un_advertise_area').prop("readonly",true);
      $('#printLength').show();
      $('#printBread').show();
      $('#printArea').show(); 
    }else if(pageSize == ""){
      $('#printLength').hide();
      $('#printBread').hide();
      $('#printArea').hide(); 
    }
  });
  $('#individuals_state').hide();
  $('#group_state').hide();
  $('#group_city').hide();
  $('#randomCity').hide();
  var target_area =$('#target_area option:selected').val();
  if(target_area == "1"){
    $('#group_state').hide();
    $('#group_city').hide();
    $('#randomCity').hide();
    $("#randomCityList").multiselect("clearSelection");
    $("#randomCityList").multiselect( 'refresh' );
    $('#group_of_city').val('');
    $('#individuals_state').show();
    $('.city_with_state_div').show();
    $('#getCity').show();
    //$('#cityList').val('');

  }else if(target_area == "2"){
    $('#individuals_state').hide();
    $('.city_with_state_div').hide();
    $('#getCity').hide();
    $('#randomCity').hide();
    $("#randomCityList").multiselect("clearSelection");
    $("#randomCityList").multiselect( 'refresh' );
    $('#group_of_city').val('');
    $('#group_city').hide();
    $('#group_state').show();
    $('#cityList').val('');
    $('#individuals_s').val('')
  }else if(target_area == "3"){
    $('#individuals_state').hide();
    $('#group_state').hide();
    $('#group_city').show();
    $('.city_with_state_div').hide();
    $('#getCity').hide();
    $('#randomCity').hide();
    $('#cityList').val('');
    $('#individuals_s').val('')
  }
  else if(target_area == "0"){
    $('#individuals_state').hide();
    $('#group_state').hide();
    $('#group_city').hide();
    $('.city_with_state_div').hide();
    $('#getCity').hide();
    $('#randomCity').hide();
    $('#cityList').val('');
    $('#individuals_s').val('')
  }
  $('#target_area').change(function(){
    var target_area =$('#target_area option:selected').val();
    if(target_area == "1"){
      $('#individuals_s').val('');
      $('#group_state').hide();
      $('#group_city').hide();
      $('#randomCity').hide();
      $('#individuals_state').show();
      $('#city_with_state').prop("checked", false);
      $('.city_with_state_div').show();
      $('#city_with_state').show();
      $('#cityList').val('');
    }else if(target_area == "2"){
      $("#group_s").multiselect("clearSelection");
      $("#group_s").multiselect( 'refresh' );
      $('#individuals_state').hide();
      $('.city_with_state_div').hide();
      $('#getCity').hide();
      $('#group_city').hide();
      $('#group_state').show();
      $('#randomCity').hide();
      $('#cityList').val('');
      $('#individuals_s').val('')

    }else if(target_area == "3"){

      $("#group_of_city").val('');
      $('#individuals_state').hide();
      $('#group_state').hide();
      $('.city_with_state_div').hide();
      $('#getCity').hide();
      $('#group_city').show();
      $('#randomCity').hide();
      $('#cityList').val('');
      $('#individuals_s').val('')
    }
    else if(target_area == "0"){
      $('#individuals_state').hide();
      $('#group_state').hide();
      $('#group_city').hide();
      $('.city_with_state_div').hide();
      $('#getCity').hide();
      $('#randomCity').hide();
      $('#cityList').val('');
      $('#individuals_s').val('');
    }
  });
  $('#individuals_s').change(function(){
    $('#city_with_state').prop("checked", false);
  });
  //select State with city check box
  $('#city_with_state').change(function(){
    if($('#city_with_state').is(":checked")){
      $('#getCity').show();
      var stateCode=$('#individuals_s').val();
      if (stateCode != '') {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          type: 'GET',
          url: 'getCityStateBased/' + stateCode,
          success: function(response) {
            $.each(response, function(index, value) {
              $('#cityList').append('<option value="' + value.CityName + '">' + value.CityName + ' </option>');
            });
          },
        });
        $('#cityList').html('<option value="">Select City</option>');
      }else{
        $('#cityList').val('');
      }
    }else{ 
      $('#getCity').hide();$('#cityList').val('');
    }
  });

  //select  Group city check box
  var group_of_city =$('#group_of_city option:selected').val();
  if ($('#group_of_city').val()=="5"){
    $('#randomCity').show();
  }
  else{
    $('#randomCity').hide();
  }
  $('#group_of_city').change(function(){
    var group_of_city = $('#group_of_city option:selected').val();
    if ($('#group_of_city').val()=="5"){
      $("#randomCityList").multiselect("clearSelection");
      $("#randomCityList").multiselect( 'refresh' );
      $('#randomCity').show();
    }else{
      $("#randomCityList").multiselect("clearSelection");
      $("#randomCityList").multiselect( 'refresh' );
      $('#randomCity').hide();
    }
  });
  //Select Multiple language
  $('#single_langauge_select_div').hide();
  $('#multi_langauge_select_div').hide();
  $('#selecte_hindi_english').hide();
  var language_sm =$('#language_sm option:selected').val();
  if(language_sm == "0"){
    $('#multi_langauge_select_div').hide();
    $('#selecte_hindi_english').hide();
    $('#single_langauge_select_div').show();

  }
  else if(language_sm == "1"){
    $('#single_langauge_select_div').hide();
    $('#selecte_hindi_english').hide();
    $('#multi_langauge_select_div').show();

  }
  else if(language_sm == "2"){
    $('#multi_langauge_select_div').hide();
    $('#single_langauge_select_div').hide();
    $('#selecte_hindi_english').show();
  }
  else if(language_sm == "3"){
    $('#multi_langauge_select_div').hide();
    $('#single_langauge_select_div').hide();
    $('#selecte_hindi_english').hide();
  }

  $('#language_sm').change(function(){
    var language_sm =$('#language_sm option:selected').val();
    if(language_sm==""){
      $('#single_langauge_select_div').hide();
      $('#multi_langauge_select_div').hide();
      $('#selecte_hindi_english').hide();
    }
    else if(language_sm == "0"){
      $('#single_langauge_select').val('') ;
      $('#multi_langauge_select_div').hide();
      $('#selecte_hindi_english').hide();
      $('#single_langauge_select_div').show();
    }
    else if(language_sm == "1"){
      $("#multi_langauge_select").multiselect("clearSelection");
      $("#multi_langauge_select").multiselect( 'refresh' );
      $('#single_langauge_select_div').hide();
      $('#selecte_hindi_english').hide();
      $('#multi_langauge_select_div').show();
    }
    else if(language_sm == "2"){
      $('#multi_langauge_select_div').hide();
      $('#single_langauge_select_div').hide();
      $('#selecte_hindi_english').show();
    }
    else if(language_sm == "3"){
      $('#multi_langauge_select_div').hide();
      $('#single_langauge_select_div').hide();
      $('#selecte_hindi_english').hide();
    }
  });
  $('#heighLightDiv').hide();
  var multiple_media_plan_select =$('#multiple_media_plan_select option:selected').val();
  if(multiple_media_plan_select == "0"){
    $('#heighLightDiv').show();
  }
  else if(multiple_media_plan_select == "1" || multiple_media_plan_select=="2"){
    $('#heighLightDiv').hide();
  }
  $('#multiple_media_plan_select').change(function(){
    var multiple_media_plan_select =$('#multiple_media_plan_select option:selected').val();
    if(multiple_media_plan_select==""){
      $('#heighLightDiv').hide();
    }
    else if(multiple_media_plan_select == "0"){
      $('#heighLightDiv').show();
    }
    else if(multiple_media_plan_select == "1" || multiple_media_plan_select=="2"){
      $('#heighLightDiv').hide();
    }
  });
  //End Multiple language
  //Start media plan
  $('#multiple_media_plan').hide();
  var media_plan  =$('#media_plan option:selected').val();
  if(media_plan == "0"){
    $('#multiple_media_plan').hide();
  }else if(media_plan == "1"){
    $('#multiple_media_plan').show();
  }
  $('#media_plan').change(function(){
   var media_plan  =$('#media_plan option:selected').val();
   if(media_plan == ""){
     $('#multiple_media_plan').hide();
   }
   else if(media_plan == "0"){
     $('#multiple_media_plan').hide();
   }else if(media_plan == "1"){
     $('#multiple_media_plan').show();
   }
  });
  //end media plan
  //Start is creative  for print
  $('#upload_creative').hide();
  var is_create_available =$('#is_create_available option:selected').val();
  if(is_create_available==""){
    $('#upload_creative').hide();
  }
  else if(is_create_available == "0"){
    $('#upload_creative').show();
  }
  else if(is_create_available == "2"|| is_create_available == "3" || is_create_available == "1"){
    $('#upload_creative').hide();
  }
  $('#is_create_available').change(function(){
  	var is_create_available =$('#is_create_available option:selected').val();
  	if(is_create_available==""){
      $('#upload_creative').hide();
    }
    else if(is_create_available == "0"){
      $('#upload_creative').show();
    }
    else if(is_create_available == "3" || is_create_available == "1"){
      $('#upload_creative').hide();
    }
    else if(is_create_available == "2"){
      $('#upload_creative').hide();

    }
  });


});