
$(document).ready(function(){
  $(document).on('keyup', 'input[name^="outdoorAdvBreadth"]', function(element,b) {
  //$("#outdoorAdvLength,#outdoorAdvBreadth").keyup(function () {
    var curEle = jQuery(this);
    var parentEle = curEle.closest('#inputFormRow');
    var outdoorAdvLength = parentEle.find('input[name^="outdoorAdvLength"]').attr('id');
    var outdoorAdvBreadth = parentEle.find('input[name^="outdoorAdvBreadth"]').attr('id');
    var outdoorAdvArea = parentEle.find('input[name^="outdoorAdvArea"]').attr('id');
    $('#'+outdoorAdvArea).val($('#'+outdoorAdvLength).val() * $('#'+outdoorAdvBreadth).val());
  });
  //select State with city check box
  /*  $(document).on('change', 'select[name^="outdoorIndividualState"]', function(element,b) {
    var curEle = jQuery(this);
    var categorieID = curEle.val();
    var parentEle = curEle.closest('#inputFormRow');
    var outdoorCityWithState = parentEle.find('input[name^="outdoorCityWithState"]').attr('id');
    $('#'+outdoorCityWithState).prop("checked", false);
  });
  //$('#outdoorCityWithState').change(function(){
$(document).on('change', 'input[name^="outdoorCityWithState"]', function(element,b) {
    var curEle = jQuery(this);
    var categorieID = curEle.val();
    var parentEle = curEle.closest('#inputFormRow');
    var prodEle = parentEle.find('select[name^="outdoorCityList"]');
    prodEle.empty();
    var outdoor_city_with_stateID = parentEle.find('input[name^="outdoorCityWithState"]').attr('id');
    var outdoorgetCityDiv = parentEle.find('div[id^="outdoorgetCityDiv"]').attr('id');
    var outdoorIndividualState = parentEle.find('select[name^="outdoorIndividualState"]').attr('id');
    if($('#'+outdoor_city_with_stateID).is(":checked")){
      $('#'+outdoorgetCityDiv).show();
      var stateCode=$('#'+outdoorIndividualState).val();
      if (stateCode != '' || stateCode != 'undefined') {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          type: 'GET',
          url: 'getCityStateBased/' + stateCode,
          success: function(response) {
            $.each(response, function(index, value) {
             prodEle.append('<option value="' + value.CityName + '">' + value.CityName + ' </option>');
            });
          },
        });
        prodEle.html('<option value="">Select City</option>');
      }else{
        prodEle.val('');
      }
    }else{ 
      $('#'+outdoorgetCityDiv).hide();prodEle.val('');
    }
  });*/

  //select  Group city check box

   /*if (outdoorMediaCategory=="2"){
      $('#spotnoDiv').show();
    }else{
      $('#spotnoDiv').hide();
    }*/


  $(document).on('change', 'select[name^="outdoorGroupCity"]', function(element,b) {
    var curEleo = jQuery(this);
    var outdoorGroupCityvalu = curEleo.val();
    var parentEle = curEleo.closest('#inputFormRow');
    var outdoorGroupCityID = parentEle.find('select[name^="outdoorGroupCity"]').attr('id');
    var outdoorRandomCityList = parentEle.find('select[name^="outdoorRandomCityList"]').attr('id');
    var outdoorRandomCityDiv = parentEle.find('div[id^="divOutdoor_RandomCity"]').attr('id');
    var optionsValue = $('#'+outdoorGroupCityID+' option:selected').val();

    if (optionsValue=="5"){
      $('#'+outdoorRandomCityList).multiselect({
        nonSelectedText: 'Select Random City',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'100%',
        textleft:true,
        includeSelectAllOption:true,
      });
      $("#"+outdoorRandomCityList).multiselect("clearSelection");
      $('#'+outdoorRandomCityDiv).show();
    }else{
      $("#"+outdoorRandomCityList).multiselect("clearSelection");
      //$("#"+outdoorRandomCityList).multiselect( 'refresh' );
      $('#'+outdoorRandomCityDiv).hide();
    }
  });
$(document).on('change', 'select[name^="outdoorTArea"]', function(element,b) {
    var curEleo = jQuery(this);
    var outdoorTArea = curEleo.val();
    var parentEle = curEleo.closest('#inputFormRow');
    var TASelectID = parentEle.find('select[name^="outdoorTArea"]').attr('id');
    
    
      if(outdoorTArea!="3" ){
        var selectedTgroupCitydivid=parentEle.find('div[id^="divOutdoor_RandomCity"]').attr('id');
        var selectedTgroupCityclassname = $('#'+selectedTgroupCitydivid).attr('class').split(' ');
        var splitselectedTgroupCityclassname =  $('.'+selectedTgroupCityclassname[1]);
        splitselectedTgroupCityclassname.hide(); 
      }
    var options = $('#'+TASelectID+' option:selected').text();
    if(outdoorTArea=="4" || outdoorTArea=="5" || outdoorTArea=="6" ){
      if(options=="City/Town"){
        options='CityTown';
      }
      var selectedTDivID='divOutdoor_'+options;
      var DivID = parentEle.find('div[id^="'+selectedTDivID+'"]').attr('id');
      var DivGroupclass = $('#'+DivID).attr('class').split(' ');
      var selectedTAGroupClass=$('.'+DivGroupclass[1]);
    }else{
        var optionName=options.split(' ');
        var selectedTDivID='divOutdoor_'+optionName[0].concat(optionName[1]);
        var DivID = parentEle.find('div[id^="'+selectedTDivID+'"]').attr('id');
        var DivGroupclass = $('#'+DivID).attr('class').split(' ');
        var selectedTAGroupClass=$('.'+DivGroupclass[1]);
    }
    selectedTAGroupClass.hide();
    $('#'+DivID).show();
    /*var outdoor_city_with_stateDivID='';
    var outdoor_city_with_stateDivID = parentEle.find('div[id^="outdoor_city_with_stateDiv"]').attr('id');
    if(outdoorTArea=="1" ){
      var outdoor_city_with_stateDivClass = $('#'+outdoor_city_with_stateDivID).attr('class').split(' '); 
      $('.'+outdoor_city_with_stateDivClass[1]).hide();
      $('#'+outdoor_city_with_stateDivID).show();
    }else{
      $('#'+outdoor_city_with_stateDivID).hide();
    }*/
    if(outdoorTArea=="2" ){
      var outdoorGroupState = parentEle.find('select[name^="outdoorGroupState"]').attr('id');
      $('#'+outdoorGroupState).multiselect({
      nonSelectedText: 'Select Group of State',
      enableFiltering: true,
      enableCaseInsensitiveFiltering: true,
      buttonWidth:'100%',
      textleft:true,
      includeSelectAllOption:true,
      });
    }
  });
  $(document).on('change', 'select[name^="outdoorMediaCategory"]', function(element,b) {
    var curEle = jQuery(this);
    var categorieID = curEle.val();
    var parentEle = curEle.closest('#inputFormRow');
    var prodEle = parentEle.find('select[name^="outdoorMediaSubCategory"]');
    prodEle.empty();
    
    if (categorieID) {
        jQuery.ajax({
             url: 'getODMediaSubCat/'+categorieID+'/'+'',
            type: "GET",
            dataType: "json",
            success: function(data) {
                 prodEle.prepend('<option value="">Select media Subcategory</option>');
                jQuery.each(data, function(key, value) {
                    prodEle.append('<option value="' +value.ODMediaUID + '">' + value.Name + '</option>');
                });
            }
        });
    }
  });
  $(document).on('change', 'select[name^="outdoorMediaSubCategory"]', function(element,b) {
    var curEle = jQuery(this);
    var subCatID = curEle.val();
    var parentEle = curEle.closest('#inputFormRow');
    var targetEle = parentEle.find('select[name^="outdoorTArea"]').attr('id');
    var outdoorTrainDiv = parentEle.find('div[id^="divOutdoor_train"]').attr('id');
    if (subCatID) {
      if(subCatID=='OD029' || subCatID=='OD030' || subCatID=='OD080' || subCatID=='OD084' || subCatID=='OD104' || subCatID=='OD108' ){
        $('#'+targetEle+' option[value="0"]').attr("selected",true) ;
      }else{
        $('#'+targetEle+' option[value="0"]').attr("selected",false) ;
      }
      if(subCatID=='OD029' || subCatID=='OD030' || subCatID=='OD084' || subCatID=='OD108' ){
         $('#'+outdoorTrainDiv).show();
      }else{
         $('#'+outdoorTrainDiv).hide();
      }
    }
  });

  //end
  //for outdoor view
  $('select[name^="outdoorIndividualState"] option:selected').each(function(index,curEle) {
    var curEle = jQuery(this);
    var categorieID = curEle.val();
    var parentEle = curEle.closest('#inputFormRow');
    var outdoorCityWithState = parentEle.find('input[name^="outdoorCityWithState"]').attr('id');
    $('#'+outdoorCityWithState).prop("checked", false);
  });

  $('select[name^="outdoorGroupCity"] option:selected').each(function(element,b) {
    var curEleo = jQuery(this);
    var outdoorGroupCityvalu = curEleo.val();
    var parentEle = curEleo.closest('#inputFormRow');
    var outdoorGroupCityID = parentEle.find('select[name^="outdoorGroupCity"]').attr('id');
    var outdoorRandomCityList = parentEle.find('select[name^="outdoorRandomCityList"]').attr('id');
    var outdoorRandomCityDiv = parentEle.find('div[id^="divOutdoor_RandomCity"]').attr('id');
    var divOutdoor_GroupCity = parentEle.find('div[id^="divOutdoor_GroupCity"]').attr('id');
    var optionsValue = $('#'+outdoorGroupCityID+' option:selected').val();
    if (optionsValue=="5"){
      $('#'+outdoorRandomCityList).multiselect({
        nonSelectedText: 'Select Random City',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'100%',
        textleft:true,
        includeSelectAllOption:true,
      });
      $('#'+outdoorRandomCityDiv).show();
    }else{
      //$("#"+outdoorRandomCityList).multiselect("clearSelection");
      //$("#"+outdoorRandomCityList).multiselect( 'refresh' );
      $('#'+outdoorRandomCityDiv).hide();
       //$('#'+divOutdoor_GroupCity).show();

    }

  });

   /*if (outdoorMediaCategory=="2"){
      $('#spotnoDiv').show();
    }else{
      $('#spotnoDiv').hide();
    }*/

$('select[name^="outdoorTArea"] option:selected').each(function(element,b) {
    var curEleo = jQuery(this);
    var outdoorTArea = curEleo.val();
    var parentEle = curEleo.closest('#inputFormRow');
    var TASelectID = parentEle.find('select[name^="outdoorTArea"]').attr('id');
    var options = $('#'+TASelectID+' option:selected').text();
    if(outdoorTArea=="4" || outdoorTArea=="5" || outdoorTArea=="6" ){
       if(options=="City/Town"){
        options='CityTown';
      }
      var selectedTDivID='divOutdoor_'+options;
      var DivID = parentEle.find('div[id^="'+selectedTDivID+'"]').attr('id');
      var DivGroupclass = $('#'+DivID).attr('class').split(' ');
      var selectedTAGroupClass=$('.'+DivGroupclass[1]);
     /* var selectedTDivID1='divOutdoor_'+options;
      if(selectedTDivID1=="divOutdoor_City/Town"){
       selectedTDivID1='divOutdoor_City Town';
      }
      
      var DivID1 = parentEle.find('div[id^="'+selectedTDivID1+'"]').attr('id');
      console.log(selectedTDivID1);
      console.log(DivID1);
      var DivGroupclass = $('#'+DivID1).attr('class').split(' ');
      var selectedTAGroupClass=$('.'+DivGroupclass[1]);*/

    }else{
        var optionName=options.split(' ');
        var selectedTDivID='divOutdoor_'+optionName[0].concat(optionName[1]);
        console.log(selectedTDivID);
        var DivID = parentEle.find('div[id^="'+selectedTDivID+'"]').attr('id');
        var DivGroupclass = $('#'+DivID).attr('class').split(' ');
        var selectedTAGroupClass=$('.'+DivGroupclass[1]);
    }
    selectedTAGroupClass.hide();
    $('#'+DivID).show();
    if(outdoorTArea=="2" ){
      var outdoorGroupState = parentEle.find('select[name^="outdoorGroupState"]').attr('id');
      $('#'+outdoorGroupState).multiselect({
      nonSelectedText: 'Select Group of State',
      enableFiltering: true,
      enableCaseInsensitiveFiltering: true,
      buttonWidth:'100%',
      textleft:true,
      includeSelectAllOption:true,
      });
    }
  //Group of state  
  });
$('select[name^="outdoorMediaCategory"] option:selected').each(function(index,curEle) {
    
    var curEle = jQuery(this);
    var categorieID = curEle.val();
    var parentEle = curEle.closest('#inputFormRow');
    var prodEle = parentEle.find('select[name^="outdoorMediaSubCategory"]');
    var outdoorMediaSubCategoryID = parentEle.find('input[name^="hiddensubcatid"]').val();
    prodEle.empty();
    
    if (categorieID && categorieID!='' && outdoorMediaSubCategoryID !='') {
      console.log('categorieID',categorieID);
       var getmediaurl='getODMediaSubCat/'+categorieID+'/'+ outdoorMediaSubCategoryID
        jQuery.ajax({
            url: window.location.origin+'/'+getmediaurl,
            type: "GET",
            dataType: "json",
            success: function(value) {
                    prodEle.append('<option value="' +value[0].ODMediaUID + '">' + value[0].Name + '</option>');
            }
        });
    }else{
      prodEle.prepend('<option value="">Select media Subcategory</option>');
    }
  });
/*$("#addRow").click(function() {

  $('select[name^="outdoorMediaCategory"] option:selected').each(function(index,curEle) {
    
    var curEle = jQuery(this);
    var categorieID = curEle.val();
    var parentEle = curEle.closest('#inputFormRow');
    var prodEle = parentEle.find('select[name^="outdoorMediaSubCategory"]');
    var outdoorMediaSubCategoryID = parentEle.find('input[name^="hiddensubcatid"]').val();
    prodEle.empty();
    
    if (categorieID && categorieID!='') {
      console.log('categorieID',categorieID);
       var getmediaurl='getODMediaSubCat/'+categorieID+'/'+ outdoorMediaSubCategoryID
        jQuery.ajax({
            url: window.location.origin+'/'+getmediaurl,
            type: "GET",
            dataType: "json",
            success: function(value) {
                    prodEle.append('<option value="' +value[0].ODMediaUID + '">' + value[0].Name + '</option>');
            }
        });
    }else{
      prodEle.prepend('<option value="">Select Subcategory</option>');
    }
  });
});*/
  $('select[name^="outdoorMediaSubCategory"] option:selected').each(function() {
    
    var curEle = jQuery(this);
    var subCatID = curEle.val();
    var parentEle = curEle.closest('#inputFormRow');
    var targetEle = parentEle.find('select[name^="outdoorTArea"]').attr('id');
     var outdoorTrainDiv = parentEle.find('div[id^="divOutdoor_train"]').attr('id');
    if (subCatID) {
      if(subCatID=='OD029' || subCatID=='OD030' || subCatID=='OD080' || subCatID=='OD084' || subCatID=='OD104' || subCatID=='OD108' ){
        $('#'+targetEle+' option[value="0"]').attr("selected",true) ;
      }else{
        $('#'+targetEle+' option[value="0"]').attr("selected",false) ;
      }
      if(subCatID=='OD029' || subCatID=='OD030' || subCatID=='OD084' || subCatID=='OD108' ){
         $('#'+outdoorTrainDiv).show();
      }else{
         $('#'+outdoorTrainDiv).hide();
      }
    }
  });
  
  //End for outdoor view

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