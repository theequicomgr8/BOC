
$(document).ready(function(){
  var crsRadioTargetArea =$('#crsRadioTargetArea option:selected').val();
  if(crsRadioTargetArea == ''){
    $('#crsRadioSpecificRegionDiv').hide();
    $('#crsRadioGroupRegionDiv').hide(); 
  }else if(crsRadioTargetArea == "0"){
    $('#crsRadioSpecificRegionDiv').hide();
    $('#crsRadioGroupRegionDiv').hide();
  }else if(crsRadioTargetArea == "1"){
    $('#crsRadioSpecificRegionDiv').show();
  }else if(crsRadioTargetArea == "2"){
    $('#crsRadioGroupRegionDiv').show();
  }
  $('#crsRadioTargetArea').change(function(){
    var crsRadioTargetArea =$('#crsRadioTargetArea option:selected').val();
    if(crsRadioTargetArea == ''){
      $('#crsRadioSpecificRegionDiv').hide();
      $('#crsRadioGroupRegionDiv').hide(); 
      $('#crsRadioSpecificRegion').val('');
      $("#crsRadioGroupRegion").multiselect("clearSelection");
    }else if(crsRadioTargetArea == "0"){
      $('#crsRadioSpecificRegionDiv').hide();
      $('#crsRadioGroupRegionDiv').hide();
      $('#crsRadioSpecificRegion').val('');
      $("#crsRadioGroupRegion").multiselect("clearSelection");
    }else if(crsRadioTargetArea == "1"){
      $('#crsRadioSpecificRegionDiv').show();
      $('#crsRadioGroupRegionDiv').hide();
      //$('#crsRadioSpecificRegion').val('');
      //$("#crsRadioGroupRegion").multiselect("clearSelection");
      $("#crsRadioGroupRegion").attr("name", "crsRadioGroupRegion");
      $("#crsRadioSpecificRegion").attr("name", "crsRadioRegion[]");
    }else if(crsRadioTargetArea == "2"){
      $('#crsRadioSpecificRegionDiv').hide();
      $('#crsRadioGroupRegionDiv').show();
      //$('#crsRadioSpecificRegion').val('');
      //$("#crsRadioGroupRegion").multiselect("clearSelection");
      ("#crsRadioGroupRegion").attr("name", "crsRadioRegion[]");
      $("#crsRadioSpecificRegion").attr("name", "crsRadioSpecificRegion[]");
    }
  });
  //Start is creative for crsRadio
  var crsRadioCreativeAvail =$('#crsRadioCreativeAvail option:selected').val();
  if(crsRadioCreativeAvail==""){
    $('#crsRadioUploadCreativeDiv').hide();
  }
  else if(crsRadioCreativeAvail == "0"){
    $('#crsRadioUploadCreativeDiv').show();
  }
  else if(crsRadioCreativeAvail == "2"|| crsRadioCreativeAvail == "3" || crsRadioCreativeAvail == "1"){
    $('#crsRadioUploadCreativeDiv').hide();
  }
  $('#crsRadioCreativeAvail').change(function(){
    var crsRadioCreativeAvail =$('#crsRadioCreativeAvail option:selected').val();
    if(crsRadioCreativeAvail==""){
      $('#crsRadioUploadCreativeDiv').hide();
    }
    else if(crsRadioCreativeAvail == "0"){
      $('#crsRadioUploadCreativeDiv').show();
    }
    else if(crsRadioCreativeAvail == "3" || crsRadioCreativeAvail == "1"){
      $('#crsRadioUploadCreativeDiv').hide();
    }
    else if(crsRadioCreativeAvail == "2"){
      $('#crsRadioUploadCreativeDiv').hide();

    }
  });
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
   //Group of region
  $('#crsRadioGroupRegion').multiselect({
    nonSelectedText: 'Select Group Region',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth:'100%',
    textleft:true,
    includeSelectAllOption:true,
  });

});