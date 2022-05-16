
$(document).ready(function(){
  $("#outdoorAdvLength,#outdoorAdvBreadth").keyup(function () {
    $('#outdoorAdvArea').val($('#outdoorAdvLength').val() * $('#outdoorAdvBreadth').val());
  });
  var outdoorTArea =$('#outdoorTArea option:selected').val();
  if(outdoorTArea == ''){
    $('#outdoor_individual_stateDiv').hide();
    $('#outdoor_city_with_stateDiv').hide();
    $('#outdoorgetCityDiv').hide();
    $('#outdoorIndividualState').val('');
    $('#outdoorCityWithState').prop("checked", false);
    $('#outdoorCityList').val('');
    $('#outdoor_group_stateDiv').hide();
    $("#outdoorGroupState").multiselect("clearSelection");
    $("#outdoorGroupState").multiselect( 'refresh' );
    $('#outdoor_group_cityDiv').hide();
    $('#outdoorGroupCity').val('');
    $('#outdoorRandomCityDiv').hide();
    $("#outdoorRandomCityList").multiselect("clearSelection");
    $("#outdoorRandomCityList").multiselect( 'refresh' );
    $('#outdoor_townDiv').hide();
    $('#outdoorTown').val('');
    $('#outdoor_districtDiv').hide();
    $('#outdoorDistrict').val('');
    $('#outdoor_ZoneDiv').hide();
    $('#outdoorZone').val('');
    $('#outdoor_postalCodeDiv').hide();
    $('#outdoorPostalCode').val('');
  }
  else if(outdoorTArea == "0"){
    $('#outdoor_individual_stateDiv').hide();
    $('#outdoor_city_with_stateDiv').hide();
    $('#outdoorgetCityDiv').hide();
    $('#outdoorIndividualState').val('');
    $('#outdoorCityWithState').prop("checked", false);
    $('#outdoorCityList').val('');
    $('#outdoor_group_stateDiv').hide();
    $("#outdoorGroupState").multiselect("clearSelection");
    $("#outdoorGroupState").multiselect( 'refresh' );
    $('#outdoor_group_cityDiv').hide();
    $('#outdoorGroupCity').val('');
    $('#outdoorRandomCityDiv').hide();
    $("#outdoorRandomCityList").multiselect("clearSelection");
    $("#outdoorRandomCityList").multiselect( 'refresh' );
    $('#outdoor_townDiv').hide();
    $('#outdoorTown').val('');
    $('#outdoor_districtDiv').hide();
    $('#outdoorDistrict').val('');
    $('#outdoor_ZoneDiv').hide();
    $('#outdoorZone').val('');
    $('#outdoor_postalCodeDiv').hide();
    $('#outdoorPostalCode').val('');
  }else if(outdoorTArea == "1"){
    $('#outdoor_individual_stateDiv').show();
    $('#outdoor_city_with_stateDiv').show();
    $('#outdoorgetCityDiv').show();
    $('#outdoor_group_stateDiv').hide();
    $("#outdoorGroupState").multiselect("clearSelection");
    $("#outdoorGroupState").multiselect( 'refresh' );
    $('#outdoor_group_cityDiv').hide();
    $('#outdoorGroupCity').val('');
    $('#outdoorRandomCityDiv').hide();
    $("#outdoorRandomCityList").multiselect("clearSelection");
    $("#outdoorRandomCityList").multiselect( 'refresh' );
    $('#outdoor_townDiv').hide();
    $('#outdoorTown').val('');
    $('#outdoor_districtDiv').hide();
    $('#outdoorDistrict').val('');
    $('#outdoor_ZoneDiv').hide();
    $('#outdoorZone').val('');
    $('#outdoor_postalCodeDiv').hide();
    $('#outdoorPostalCode').val('');
  }else if(outdoorTArea == "2"){
    $('#outdoor_individual_stateDiv').hide();
    $('#outdoor_city_with_stateDiv').hide();
    $('#outdoorgetCityDiv').hide();
    $('#outdoorIndividualState').val('');
    $('#outdoorCityWithState').prop("checked", false);
    $('#outdoorCityList').val('');
    $('#outdoor_group_stateDiv').show();
    $('#outdoor_group_cityDiv').hide();
    $('#outdoorGroupCity').val('');
    $('#outdoorRandomCityDiv').hide();
    $("#outdoorRandomCityList").multiselect("clearSelection");
    $("#outdoorRandomCityList").multiselect( 'refresh' );
    $('#outdoor_townDiv').hide();
    $('#outdoorTown').val('');
    $('#outdoor_districtDiv').hide();
    $('#outdoorDistrict').val('');
    $('#outdoor_ZoneDiv').hide();
    $('#outdoorZone').val('');
    $('#outdoor_postalCodeDiv').hide();
    $('#outdoorPostalCode').val('');
  }else if(outdoorTArea == "3"){
    $('#outdoor_individual_stateDiv').hide();
    $('#outdoor_city_with_stateDiv').hide();
    $('#outdoorgetCityDiv').hide();
    $('#outdoorIndividualState').val('');
    $('#outdoorCityWithState').prop("checked", false);
    $('#outdoorCityList').val('');
    $('#outdoor_group_stateDiv').hide();
    $("#outdoorGroupState").multiselect("clearSelection");
    $("#outdoorGroupState").multiselect( 'refresh' );
    $('#outdoor_group_cityDiv').show();
    //$('#outdoorGroupCity').val('');
    $('#outdoorRandomCityDiv').hide();
    $("#outdoorRandomCityList").multiselect("clearSelection");
    $("#outdoorRandomCityList").multiselect( 'refresh' );
    $('#outdoor_townDiv').hide();
    $('#outdoorTown').val('');
    $('#outdoor_districtDiv').hide();
    $('#outdoorDistrict').val('');
    $('#outdoor_ZoneDiv').hide();
    $('#outdoorZone').val('');
    $('#outdoor_postalCodeDiv').hide();
    $('#outdoorPostalCode').val('');
  }else if(outdoorTArea == "4"){
    $('#outdoor_individual_stateDiv').hide();
    $('#outdoor_city_with_stateDiv').hide();
    $('#outdoorgetCityDiv').hide();
    $('#outdoorIndividualState').val('');
    $('#outdoorCityWithState').prop("checked", false);
    $('#outdoorCityList').val('');
    $('#outdoor_group_stateDiv').hide();
    $("#outdoorGroupState").multiselect("clearSelection");
    $("#outdoorGroupState").multiselect( 'refresh' );
    $('#outdoor_group_cityDiv').hide();
    $('#outdoorGroupCity').val('');
    $('#outdoorRandomCityDiv').hide();
    $("#outdoorRandomCityList").multiselect("clearSelection");
    $("#outdoorRandomCityList").multiselect( 'refresh' );
    $('#outdoor_townDiv').show();
    $('#outdoorTown').val('');
    $('#outdoor_districtDiv').hide();
    $('#outdoorDistrict').val('');
    $('#outdoor_ZoneDiv').hide();
    $('#outdoorZone').val('');
    $('#outdoor_postalCodeDiv').hide();
    $('#outdoorPostalCode').val('');
  }else if(outdoorTArea == "5"){
    $('#outdoor_individual_stateDiv').hide();
    $('#outdoor_city_with_stateDiv').hide();
    $('#outdoorgetCityDiv').hide();
    $('#outdoorIndividualState').val('');
    $('#outdoorCityWithState').prop("checked", false);
    $('#outdoorCityList').val('');
    $('#outdoor_group_stateDiv').hide();
    $("#outdoorGroupState").multiselect("clearSelection");
    $("#outdoorGroupState").multiselect( 'refresh' );
    $('#outdoor_group_cityDiv').hide();
    $('#outdoorGroupCity').val('');
    $('#outdoorRandomCityDiv').hide();
    $("#outdoorRandomCityList").multiselect("clearSelection");
    $("#outdoorRandomCityList").multiselect( 'refresh' );
    $('#outdoor_townDiv').hide();
    $('#outdoorTown').val('');
    $('#outdoor_districtDiv').show();
    $('#outdoorDistrict').val('');
    $('#outdoor_ZoneDiv').hide();
    $('#outdoorZone').val('');
    $('#outdoor_postalCodeDiv').hide();
    $('#outdoorPostalCode').val('');
  }else if(outdoorTArea == "6"){
    $('#outdoor_individual_stateDiv').hide();
    $('#outdoor_city_with_stateDiv').hide();
    $('#outdoorgetCityDiv').hide();
    $('#outdoorIndividualState').val('');
    $('#outdoorCityWithState').prop("checked", false);
    $('#outdoorCityList').val('');
    $('#outdoor_group_stateDiv').hide();
    $("#outdoorGroupState").multiselect("clearSelection");
    $("#outdoorGroupState").multiselect( 'refresh' );
    $('#outdoor_group_cityDiv').hide();
    $('#outdoorGroupCity').val('');
    $('#outdoorRandomCityDiv').hide();
    $("#outdoorRandomCityList").multiselect("clearSelection");
    $("#outdoorRandomCityList").multiselect( 'refresh' );
    $('#outdoor_townDiv').hide();
    $('#outdoorTown').val('');
    $('#outdoor_districtDiv').hide();
    $('#outdoorDistrict').val('');
    $('#outdoor_ZoneDiv').show();
    $('#outdoorZone').val('');
    $('#outdoor_postalCodeDiv').hide();
    $('#outdoorPostalCode').val('');
  }else if(outdoorTArea == "7"){
    $('#outdoor_individual_stateDiv').hide();
    $('#outdoor_city_with_stateDiv').hide();
    $('#outdoorgetCityDiv').hide();
    $('#outdoorIndividualState').val('');
    $('#outdoorCityWithState').prop("checked", false);
    $('#outdoorCityList').val('');
    $('#outdoor_group_stateDiv').hide();
    $("#outdoorGroupState").multiselect("clearSelection");
    $("#outdoorGroupState").multiselect( 'refresh' );
    $('#outdoor_group_cityDiv').hide();
    $('#outdoorGroupCity').val('');
    $('#outdoorRandomCityDiv').hide();
    $("#outdoorRandomCityList").multiselect("clearSelection");
    $("#outdoorRandomCityList").multiselect( 'refresh' );
    $('#outdoor_townDiv').hide();
    $('#outdoorTown').val('');
    $('#outdoor_districtDiv').hide();
    $('#outdoorDistrict').val('');
    $('#outdoor_ZoneDiv').hide();
    $('#outdoorZone').val('');
    $('#outdoor_postalCodeDiv').show();
    $('#outdoorPostalCode').val('');
  }
  $('#outdoorTArea').change(function(){
    var outdoorTArea =$('#outdoorTArea option:selected').val();
    if(outdoorTArea == ''){
    $('#outdoor_individual_stateDiv').hide();
    $('#outdoor_city_with_stateDiv').hide();
    $('#outdoorgetCityDiv').hide();
    $('#outdoorIndividualState').val('');
    $('#outdoorCityWithState').prop("checked", false);
    $('#outdoorCityList').val('');
    $('#outdoor_group_stateDiv').hide();
    $("#outdoorGroupState").multiselect("clearSelection");
    $("#outdoorGroupState").multiselect( 'refresh' );
    $('#outdoor_group_cityDiv').hide();
    $('#outdoorGroupCity').val('');
    $('#outdoorRandomCityDiv').hide();
    $("#outdoorRandomCityList").multiselect("clearSelection");
    $("#outdoorRandomCityList").multiselect( 'refresh' );
    $('#outdoor_townDiv').hide();
    $('#outdoorTown').val('');
    $('#outdoor_districtDiv').hide();
    $('#outdoorDistrict').val('');
    $('#outdoor_ZoneDiv').hide();
    $('#outdoorZone').val('');
    $('#outdoor_postalCodeDiv').hide();
    $('#outdoorPostalCode').val('');
  }
  else if(outdoorTArea == "0"){
      $('#outdoor_individual_stateDiv').hide();
      $('#outdoor_city_with_stateDiv').hide();
      $('#outdoorgetCityDiv').hide();
      $('#outdoorIndividualState').val('');
      $('#outdoorCityWithState').prop("checked", false);
      $('#outdoorCityList').val('');
      $('#outdoor_group_stateDiv').hide();
      $("#outdoorGroupState").multiselect("clearSelection");
      $("#outdoorGroupState").multiselect( 'refresh' );
      $('#outdoor_group_cityDiv').hide();
      $('#outdoorGroupCity').val('');
      $('#outdoorRandomCityDiv').hide();
      $("#outdoorRandomCityList").multiselect("clearSelection");
      $("#outdoorRandomCityList").multiselect( 'refresh' );
      $('#outdoor_townDiv').hide();
      $('#outdoorTown').val('');
      $('#outdoor_districtDiv').hide();
      $('#outdoorDistrict').val('');
      $('#outdoor_ZoneDiv').hide();
      $('#outdoorZone').val('');
      $('#outdoor_postalCodeDiv').hide();
      $('#outdoorPostalCode').val('');
    }else if(outdoorTArea == "1"){
      $('#outdoor_individual_stateDiv').show();
      $('#outdoor_city_with_stateDiv').show();
      $('#outdoorgetCityDiv').hide();
      $('#outdoorIndividualState').val('');
      $('#outdoorCityWithState').prop("checked", false);
      $('#outdoorCityList').val('');
      $('#outdoor_group_stateDiv').hide();
      $("#outdoorGroupState").multiselect("clearSelection");
      $("#outdoorGroupState").multiselect( 'refresh' );
      $('#outdoor_group_cityDiv').hide();
      $('#outdoorGroupCity').val('');
      $('#outdoorRandomCityDiv').hide();
      $("#outdoorRandomCityList").multiselect("clearSelection");
      $("#outdoorRandomCityList").multiselect( 'refresh' );
      $('#outdoor_townDiv').hide();
      $('#outdoorTown').val('');
      $('#outdoor_districtDiv').hide();
      $('#outdoorDistrict').val('');
      $('#outdoor_ZoneDiv').hide();
      $('#outdoorZone').val('');
      $('#outdoor_postalCodeDiv').hide();
      $('#outdoorPostalCode').val('');
    }else if(outdoorTArea == "2"){
      $('#outdoor_individual_stateDiv').hide();
      $('#outdoor_city_with_stateDiv').hide();
      $('#outdoorgetCityDiv').hide();
      $('#outdoorIndividualState').val('');
      $('#outdoorCityWithState').prop("checked", false);
      $('#outdoorCityList').val('');
      $('#outdoor_group_stateDiv').show();
      $("#outdoorGroupState").multiselect("clearSelection");
      $("#outdoorGroupState").multiselect( 'refresh' );
      $('#outdoor_group_cityDiv').hide();
      $('#outdoorGroupCity').val('');
      $('#outdoorRandomCityDiv').hide();
      $("#outdoorRandomCityList").multiselect("clearSelection");
      $("#outdoorRandomCityList").multiselect( 'refresh' );
      $('#outdoor_townDiv').hide();
      $('#outdoorTown').val('');
      $('#outdoor_districtDiv').hide();
      $('#outdoorDistrict').val('');
      $('#outdoor_ZoneDiv').hide();
      $('#outdoorZone').val('');
      $('#outdoor_postalCodeDiv').hide();
      $('#outdoorPostalCode').val('');
    }else if(outdoorTArea == "3"){
      $('#outdoor_individual_stateDiv').hide();
      $('#outdoor_city_with_stateDiv').hide();
      $('#outdoorgetCityDiv').hide();
      $('#outdoorIndividualState').val('');
      $('#outdoorCityWithState').prop("checked", false);
      $('#outdoorCityList').val('');
      $('#outdoor_group_stateDiv').hide();
      $("#outdoorGroupState").multiselect("clearSelection");
      $("#outdoorGroupState").multiselect( 'refresh' );
      $('#outdoor_group_cityDiv').show();
      $('#outdoorGroupCity').val('');
      $('#outdoorRandomCityDiv').hide();
      $("#outdoorRandomCityList").multiselect("clearSelection");
      $("#outdoorRandomCityList").multiselect( 'refresh' );
      $('#outdoor_townDiv').hide();
      $('#outdoorTown').val('');
      $('#outdoor_districtDiv').hide();
      $('#outdoorDistrict').val('');
      $('#outdoor_ZoneDiv').hide();
      $('#outdoorZone').val('');
      $('#outdoor_postalCodeDiv').hide();
      $('#outdoorPostalCode').val('');
    }else if(outdoorTArea == "4"){
      $('#outdoor_individual_stateDiv').hide();
      $('#outdoor_city_with_stateDiv').hide();
      $('#outdoorgetCityDiv').hide();
      $('#outdoorIndividualState').val('');
      $('#outdoorCityWithState').prop("checked", false);
      $('#outdoorCityList').val('');
      $('#outdoor_group_stateDiv').hide();
      $("#outdoorGroupState").multiselect("clearSelection");
      $("#outdoorGroupState").multiselect( 'refresh' );
      $('#outdoor_group_cityDiv').hide();
      $('#outdoorGroupCity').val('');
      $('#outdoorRandomCityDiv').hide();
      $("#outdoorRandomCityList").multiselect("clearSelection");
      $("#outdoorRandomCityList").multiselect( 'refresh' );
      $('#outdoor_townDiv').show();
      $('#outdoorTown').val('');
      $('#outdoor_districtDiv').hide();
      $('#outdoorDistrict').val('');
      $('#outdoor_ZoneDiv').hide();
      $('#outdoorZone').val('');
      $('#outdoor_postalCodeDiv').hide();
      $('#outdoorPostalCode').val('');
    }else if(outdoorTArea == "5"){
      $('#outdoor_individual_stateDiv').hide();
      $('#outdoor_city_with_stateDiv').hide();
      $('#outdoorgetCityDiv').hide();
      $('#outdoorIndividualState').val('');
      $('#outdoorCityWithState').prop("checked", false);
      $('#outdoorCityList').val('');
      $('#outdoor_group_stateDiv').hide();
      $("#outdoorGroupState").multiselect("clearSelection");
      $("#outdoorGroupState").multiselect( 'refresh' );
      $('#outdoor_group_cityDiv').hide();
      $('#outdoorGroupCity').val('');
      $('#outdoorRandomCityDiv').hide();
      $("#outdoorRandomCityList").multiselect("clearSelection");
      $("#outdoorRandomCityList").multiselect( 'refresh' );
      $('#outdoor_townDiv').hide();
      $('#outdoorTown').val('');
      $('#outdoor_districtDiv').show();
      $('#outdoorDistrict').val('');
      $('#outdoor_ZoneDiv').hide();
      $('#outdoorZone').val('');
      $('#outdoor_postalCodeDiv').hide();
      $('#outdoorPostalCode').val('');
    }else if(outdoorTArea == "6"){
      $('#outdoor_individual_stateDiv').hide();
      $('#outdoor_city_with_stateDiv').hide();
      $('#outdoorgetCityDiv').hide();
      $('#outdoorIndividualState').val('');
      $('#outdoorCityWithState').prop("checked", false);
      $('#outdoorCityList').val('');
      $('#outdoor_group_stateDiv').hide();
      $("#outdoorGroupState").multiselect("clearSelection");
      $("#outdoorGroupState").multiselect( 'refresh' );
      $('#outdoor_group_cityDiv').hide();
      $('#outdoorGroupCity').val('');
      $('#outdoorRandomCityDiv').hide();
      $("#outdoorRandomCityList").multiselect("clearSelection");
      $("#outdoorRandomCityList").multiselect( 'refresh' );
      $('#outdoor_townDiv').hide();
      $('#outdoorTown').val('');
      $('#outdoor_districtDiv').hide();
      $('#outdoorDistrict').val('');
      $('#outdoor_ZoneDiv').show();
      $('#outdoorZone').val('');
      $('#outdoor_postalCodeDiv').hide();
      $('#outdoorPostalCode').val('');
    }else if(outdoorTArea == "7"){
      $('#outdoor_individual_stateDiv').hide();
      $('#outdoor_city_with_stateDiv').hide();
      $('#outdoorgetCityDiv').hide();
      $('#outdoorIndividualState').val('');
      $('#outdoorCityWithState').prop("checked", false);
      $('#outdoorCityList').val('');
      $('#outdoor_group_stateDiv').hide();
      $("#outdoorGroupState").multiselect("clearSelection");
      $("#outdoorGroupState").multiselect( 'refresh' );
      $('#outdoor_group_cityDiv').hide();
      $('#outdoorGroupCity').val('');
      $('#outdoorRandomCityDiv').hide();
      $("#outdoorRandomCityList").multiselect("clearSelection");
      $("#outdoorRandomCityList").multiselect( 'refresh' );
      $('#outdoor_townDiv').hide();
      $('#outdoorTown').val('');
      $('#outdoor_districtDiv').hide();
      $('#outdoorDistrict').val('');
      $('#outdoor_ZoneDiv').hide();
      $('#outdoorZone').val('');
      $('#outdoor_postalCodeDiv').show();
      $('#outdoorPostalCode').val('');
    }
  });
  //select State with city check box
  $('#outdoorIndividualState').change(function(){
    $('#outdoorCityWithState').prop("checked", false);
  });
  $('#outdoorCityWithState').change(function(){
    if($('#outdoorCityWithState').is(":checked")){
      $('#outdoorgetCityDiv').show();
      var stateCode=$('#outdoorIndividualState').val();
      if (stateCode != '') {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          type: 'GET',
          url: 'getCityStateBased/' + stateCode,
          success: function(response) {
            $.each(response, function(index, value) {
              $('#outdoorCityList').append('<option value="' + value.CityName + '">' + value.CityName + ' </option>');
            });
          },
        });
        $('#outdoorCityList').html('<option value="">Select City</option>');
      }else{
        $('#outdoorCityList').val('');
      }
    }else{ 
      $('#outdoorgetCityDiv').hide();$('#outdoorCityList').val('');
    }
  });
  //select  Group city check box
  var outdoorGroupCity =$('#outdoorGroupCity option:selected').val();
  if ($('#outdoorGroupCity').val()=="5"){
    $('#outdoorRandomCityDiv').show();
  }
  else{
    $('#outdoorRandomCityDiv').hide();
  }
  $('#outdoorGroupCity').change(function(){
    var outdoorGroupCity = $('#outdoorGroupCity option:selected').val();
    if ($('#outdoorGroupCity').val()=="5"){
      $("#outdoorRandomoutdoorCityList").multiselect("clearSelection");
      $("#outdoorRandomoutdoorCityList").multiselect( 'refresh' );
      $('#outdoorRandomCityDiv').show();
    }else{
      $("#outdoorRandomoutdoorCityList").multiselect("clearSelection");
      $("#outdoorRandomoutdoorCityList").multiselect( 'refresh' );
      $('#outdoorRandomCityDiv').hide();
    }
  });
  //on select media Catogry is digital
  $('#outdoorMediaCategory').change(function(){
    var outdoorMediaCategory = $('#outdoorMediaCategory option:selected').val();
    if (outdoorMediaCategory=="2"){
      $('#spotnoDiv').show();
    }else{
      $('#spotnoDiv').hide();
    }
  });

  //Start is creative for outdoor
  var outdoorCreativeAvail =$('#outdoorCreativeAvail option:selected').val();
  if(outdoorCreativeAvail==""){
    $('#outdoorUploadCreativeDiv').hide();
  }
  else if(outdoorCreativeAvail == "0"){
    $('#outdoorUploadCreativeDiv').show();
  }
  else if(outdoorCreativeAvail == "2"|| outdoorCreativeAvail == "3" || outdoorCreativeAvail == "1"){
    $('#outdoorUploadCreativeDiv').hide();
  }
  $('#outdoorCreativeAvail').change(function(){
    var outdoorCreativeAvail =$('#outdoorCreativeAvail option:selected').val();
    if(outdoorCreativeAvail==""){
      $('#outdoorUploadCreativeDiv').hide();
    }
    else if(outdoorCreativeAvail == "0"){
      $('#outdoorUploadCreativeDiv').show();
    }
    else if(outdoorCreativeAvail == "3" || outdoorCreativeAvail == "1"){
      $('#outdoorUploadCreativeDiv').hide();
    }
    else if(outdoorCreativeAvail == "2"){
      $('#outdoorUploadCreativeDiv').hide();

    }
  });
  $('#outdoorRandomCityList').multiselect({
    nonSelectedText: 'Select Random City',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth:'100%',
    textleft:true,
    includeSelectAllOption:true,
  });
  //Group of state
  $('#outdoorGroupState').multiselect({
    nonSelectedText: 'Select Group of State',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth:'100%',
    textleft:true,
    includeSelectAllOption:true,
  });
  //End group of state
  $('input[type="file"]').change(function(e){
    var file = e.target.files[0].name;

    var byte = e.target.files[0].size;
    var sizemb = (byte / (1024*1024));
    var ext = file.split('.').pop();
    if ((file!= "" && sizemb <= 2)) 
    {
      $("#choose_file").text(file);
      $("#upload_doc_error").hide();
    }
    else 
    {
      $("#choose_file" ).text(file);
      $("#upload_doc_error").text('File size should be 2MB');
      $("#upload_doc_error").show();

    }
  });


});