<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Media Type/मीडिया प्रकार<font color="red">*</font></label>
      <select {{ $disabled }} name="OutdoorMedium" id="OutdoorMedium" class="form-control form-control-sm">
        <option value="">Select Medium</option>
        <option value="0"{{@$codm[0]->{'OD Media Type'} ==0 && @$codm[0]->{'OD Media Type'} != ""  ? 'selected' : ''}} >Sole Right</option>
        <option value="1" {{@$codm[0]->{'OD Media Type'} ==1 && @$codm[0]->{'OD Media Type'} != ""  ? 'selected' : ''}}>Personal Media(PMC)</option>
     <!--    <option value="2" {{@$codm[0]->{'OD Media Type'} ==2 && @$codm[0]->{'OD Media Type'} != ""  ? 'selected' : ''}}>Private Media</option> -->
      </select>
    </div>
  </div>
  <!--------Start Langauge--------->
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Language/भाषा<font color="red">*</font></label>
      <select {{ $disabled }} name="outdoorLanguage" id="outdoorLanguage" class="form-control form-control-sm">
        <option value="">Select Language</option>
        <option value="0" {{@$codm[0]->{'Language'} == 0 && @$codm[0]->{'Language'} != ""  ? 'selected' : ''}}>Hindi</option>
        <option value="1" {{@$codm[0]->{'Language'} == 1 && @$codm[0]->{'Language'} != ""  ? 'selected' : ''}}>English</option>
        <option value="2" {{@$codm[0]->{'Language'} == 2 && @$codm[0]->{'Language'} != ""  ? 'selected' : ''}}>Regional</option>
      </select>
    </div>
  </div>
  <!--------end Langauge--------->
  <!--------Start Tentative--------->
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Tentative budget/संभावित बजट<font color="red">*</font></label>
      <input {{ $disabled }} type="text" class="form-control form-control-sm" name="tentative_budget" maxlength="20" id="tentative_budget" placeholder="Enter Tentative Budget." onkeypress="return onlyNumberKey(event)" value="{{round(@$codm[0]->{'OD Budget'}) && round(@$codm[0]->{'OD Budget'})!=0 ? round(@$codm[0]->{'OD Budget'}) :''}}">
    </div>
  </div><!--------end Tentative--------->
</div>
@foreach(@$codm as $key=>$codmDetail)
<div class="addmore" id="inputFormRow">
 
    <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> Media Details</h6>

  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Advertise length/विज्ञापन की लंबाई<font color="red">*</font></label>
        <input {{ $disabled }} type="text" maxlength="20" name="outdoorAdvLength[]" placeholder="Advertise Length(CM)" class="form-control form-control-sm" id="outdoorAdvLength0" onkeypress="return isNumber(event)" value="{{round(@$codmDetail->{'Length'}) && round(@$codmDetail->{'Length'})!=0 ? round(@$codmDetail->{'Length'}) :''}}">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Advertise breadth/विज्ञापन चौड़ाई<font color="red">*</font></label>
        <input {{ $disabled }} type="text" maxlength="20" name="outdoorAdvBreadth[]" id="outdoorAdvBreadth0" placeholder="Advertise Breadth(CM)" class="form-control form-control-sm" onkeypress="return isNumber(event)" value="{{round(@$codmDetail->{'Breadth'}) && round(@$codmDetail->{'Breadth'})!=0 ?round(@$codmDetail->{'Breadth'}) : ''}}">
      </div>
    </div>
    <div class="col-md-4" >
      <div class="form-group">
        <label class="form-control-label">Advertise area/विज्ञापन क्षेत्र<font color="red">*</font></label>
        <input {{ $disabled }} type="text"  name="outdoorAdvArea[]" id="outdoorAdvArea0" placeholder="Advertise Area(Sq Cm)" class="form-control form-control-sm" onkeypress="return isNumber(event)" value="{{round(@$codmDetail->{'Advt_ Area'}) && round(@$codmDetail->{'Advt_ Area'})!=0 ?round(@$codmDetail->{'Advt_ Area'}):  ''}}" >
      </div>
    </div>
  </div>
  <div class="row">
    <!--------Start Media Category--------->
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Media Category/ मीडिया श्रेणी<font color="red">*</font><br></label>
        <select {{ $disabled }} name="outdoorMediaCategory[]" id="outdoorMediaCategory0" class="form-control form-control-sm">
          <option value="">Select media category</option>
          <option value="0" {{@$codmDetail->{'Category Group'} ==0 && @$codmDetail->{'Category Group'} != ""  ? 'selected' : ''}}>Airport </option>
          <option value="1" {{@$codmDetail->{'Category Group'} ==1 && @$codmDetail->{'Category Group'} != ""  ? 'selected' : ''}}>Railway Station</option>
          <option value="2"{{@$codmDetail->{'Category Group'} ==2 && @$codmDetail->{'Category Group'} != ""  ? 'selected' : ''}} > Road side </option>
          <option value="3"{{@$codmDetail->{'Category Group'} ==3 && @$codmDetail->{'Category Group'} != ""  ? 'selected' : ''}} >Moving Media </option>
          <option value="4"{{@$codmDetail->{'Category Group'} ==4 && @$codmDetail->{'Category Group'} != ""  ? 'selected' : ''}} >Public Utility</option>
        </select>
      </div>
    </div><!--------end Media Category--------->
    <!--------Start Media Sub Category--------->
    <input type="hidden" value="{{ @$codmDetail->{'Category Sub Grp ID'} }}" name="hiddensubcatid[]" id ="hiddensubcatid0">
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Sub Category/मीडिया उपश्रेणी<font color="red">*</font></label>
        <select {{ $disabled }} name="outdoorMediaSubCategory[]" id="outdoorMediaSubCategory0" class="form-control form-control-sm">
        </select>
      </div>
    </div><!--------end Media Sub Category--------->
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label">Target area / लक्षित इलाका<font color="red">*</font></label>
        <select {{ $disabled }} name="outdoorTArea[]" id="outdoorTArea0" class="form-control form-control-sm">
          <option value="">Select Target Area </option>
          <option value="0" {{@$codmDetail->{"Target Area"} ==0 && @$codmDetail->{"Target Area"} != ""  ? "selected" : ""}}>Pan India</option>
          <option value="1" {{@$codmDetail->{"Target Area"} ==1 && @$codmDetail->{"Target Area"} != ""  ? "selected" : ""}}>Individual State</option>
          <option value="2" {{@$codmDetail->{"Target Area"} ==2 && @$codmDetail->{"Target Area"} != ""  ? "selected" : ""}}>Group States</option>
          <option value="3" {{@$codmDetail->{"Target Area"} ==3 && @$codmDetail->{"Target Area"} != ""  ? "selected" : ""}}>Group City</option>
          <option value="4" {{@$codmDetail->{"Target Area"} ==4 && @$codmDetail->{"Target Area"} != ""  ? "selected" : ""}}>City/Town</option>
          <option value="5" {{@$codmDetail->{"Target Area"} ==5 && @$codmDetail->{"Target Area"} != ""  ? "selected" : ""}}>District</option>
          <option value="6" {{@$codmDetail->{"Target Area"} ==6 && @$codmDetail->{"Target Area"} != ""  ? "selected" : ""}}>Zone</option>
          <option value="7" {{@$codmDetail->{"Target Area"} ==7 && @$codmDetail->{"Target Area"} != ""  ? "selected" : ""}}>Postal Code</option>
        </select>
      </div>  
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 selectedTgroup{{ @$codmDetail->{'Target Area'}=='0' ? $key :0}}" id="divOutdoor_PanIndia{{  @$codmDetail->{'Target Area'}=='0' ? $key :0}}" style="display: none;"></div>
    <div class="col-md-4 selectedTgroup{{ @$codmDetail->{'Target Area'}=='' ? $key :0}}" id="divOutdoor_SelectTargetArea{{ @$codmDetail->{'Target Area'}=='' ? $key :0}}" style="display: none;"></div>
    <div class="col-md-4 selectedTgroup0" id="divOutdoor_CityTown0" style="display: none;">
      <div class="form-group">
        <label class="form-control-label">City/Town/शहर/कस्बा<font color="red">*</font></label>
         <select {{$disabled}} name="outdoorTown[]" id="outdoorTown0" class="form-control form-control-sm" >
          <option value="">Select</option>
           @foreach($allCityData as $allCity)
          <option value="{{$allCity->CityName}}" {{  in_array($allCity->CityName, explode(',', @$codmDetail->{'City'}) ) ? 'selected' :'' }} >{{$allCity->CityName}} </option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-4 selectedTgroup0" id="divOutdoor_Zone0" style="display: none;">
      <div class="form-group">
        <label class="form-control-label">Zone/क्षेत्र<font color="red">*</font></label>
        <input {{ $disabled }} type="text" maxlength="20" name="outdoorZone[]" id="outdoorZone" placeholder="Enter Zone" class="form-control form-control-sm" value="{{@$codmDetail->{'Zone'} ?? ''}}" >
      </div>
    </div>
    <div class="col-md-4 selectedTgroup0" id="divOutdoor_PostalCode0" style="display: none;">
      <div class="form-group">
        <label class="form-control-label">Postal Code/डाक कोड<font color="red">*</font></label>
        <input {{ $disabled }} type="text" maxlength="20" name="outdoorPostalCode[]" id="outdoorPostalCode0" placeholder="Enter postal code" class="form-control form-control-sm" value="{{@$codmDetail->{'Postal Code'} ?? ''}}" >
      </div>
    </div>
    <div class="col-md-4 selectedTgroup0" id="divOutdoor_District0" style="display: none;">
      <div class="form-group" >
       <label class="form-control-label">District/ज़िला <font color="red">*</font></label>
        <select {{$disabled}} name="outdoorDistrict[]" id="outdoorDistrict0" class="form-control form-control-sm" >
          <option value="">Select</option>
          @foreach($districts as $district)
          <option value="{{$district->District}}" >{{$district->District}} ~ {{$district->District}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-4 selectedTgroup{{ @$codmDetail->{'Multiple StateName'} && @$codmDetail->{'Multiple StateName'}!='' ? $key :0}}" id="divOutdoor_GroupStates{{ @$codmDetail->{'Multiple StateName'} && @$codmDetail->{'Multiple StateName'}!='' ? $key :0}}" style="display: none;">
      <div class="form-group" >
       <label class="form-control-label">Group of states/राज्यों का समूह <font color="red">*</font></label>
        <select {{$disabled}} name="outdoorGroupState[0][]" id="outdoorGroupState{{ @$codmDetail->{'Multiple StateName'} && @$codmDetail->{'Multiple StateName'}!='' ? $key :0}}" class="form-control form-control-sm" multiple>

          @foreach($states as $state)
          <option value="{{$state->Code}}" {{in_array( $state->Code, str_replace(' ', '', explode(',', @$codmDetail->{'Multiple StateName'}) )) ? 'selected' :'' }}>{{$state->Code}} ~ {{$state->Description}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <!-------Group of city--------->
    <div class="col-md-4 selectedTgroup{{ @$codmDetail->{'City Groups'} && @$codmDetail->{'City Groups'}!='' ? $key :0}}" id="divOutdoor_GroupCity{{ @$codmDetail->{'City Groups'} && @$codmDetail->{'City Groups'}!='' ? $key :0}}" style="display: none;">
      <div class="form-group">
        <label class="form-control-label">Group of Cities/शहर का समूह <font color="red">*</font></label>
        <select {{ $disabled }} name="outdoorGroupCity[]" id="outdoorGroupCity0" class="form-control form-control-sm">
          <option value="">Select </option>
          <option value="0" {{@$codmDetail->{"City Groups"} ==0 && @$codmDetail->{"City Groups"} != ""  ? "selected" : ""}}>Metro</option>
          <option value="1" {{@$codmDetail->{"City Groups"} ==1 && @$codmDetail->{"City Groups"} != ""  ? "selected" : ""}}>Capital</option>
          <option value="2" {{@$codmDetail->{"City Groups"} ==2 && @$codmDetail->{"City Groups"} != ""  ? "selected" : ""}}>Class A</option>
          <option value="3" {{@$codmDetail->{"City Groups"} ==3 && @$codmDetail->{"City Groups"} != ""  ? "selected" : ""}}>Class B</option>
          <option value="4" {{@$codmDetail->{"City Groups"} ==4 && @$codmDetail->{"City Groups"} != ""  ? "selected" : ""}}>Class C</option>
          <option value="5" {{@$codmDetail->{"City Groups"} ==5 && @$codmDetail->{"City Groups"} != ""  ? "selected" : ""}}>Random</option>
        </select>
      </div>
    </div><!--------End Group of city----->
    <div class="col-md-4 selectedTgroupCity{{ @$codmDetail->{'Multiple CityName'} && @$codmDetail->{'Multiple CityName'}!='' ? $key :0}}" id="divOutdoor_RandomCity{{ @$codmDetail->{'Multiple CityName'} && @$codmDetail->{'Multiple CityName'}!='' ? $key :0}}" style="display: none;">
      <div class="form-group">
        <label class="form-control-label">Random cities/यादृच्छिक शहर</label>
        <select {{ $disabled }} name="outdoorRandomCityList[0][]" id="outdoorRandomCityList{{ @$codmDetail->{'Multiple CityName'} && @$codmDetail->{'Multiple CityName'}!='' ? $key :0}}" class="form-control form-control-sm" multiple>
         @foreach($allCityData as $allCity)
          <option value="{{$allCity->CityName}}" {{  in_array($allCity->CityName, explode(',', @$codmDetail->{'Multiple CityName'}) ) ? 'selected' :'' }} >{{$allCity->CityName}} </option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
  <div class="row" >
    <div class="col-md-4 selectedTgroup{{ @$codmDetail->{'State'} && @$codmDetail->{'State'}!='' ? $key :0}}" id="divOutdoor_IndividualState{{ @$codmDetail->{'State'} && @$codmDetail->{'State'}!='' ? $key :0}}"style="display: none;" >
      <div class="form-group" id="outdoor_individual_state" >
        <label class="form-control-label">Individual state/व्यक्तिगत राज्य <font color="red">*</font></label>
        <select {{ $disabled }} name="outdoorIndividualState[]" id="outdoorIndividualState{{ @$codmDetail->{'State'} && @$codmDetail->{'State'}!='' ? $key :0}}" class="form-control form-control-sm">
          <option value="" {{@$codmDetail->{'State'} == ""  ? 'selected' : ''}}>Select State</option>
          @foreach($states as $state)
          <option value="{{$state->Code}}" {{@$codmDetail->{'State'} == $state->Code  ? 'selected' : ''}}>{{$state->Code}} ~ {{$state->Description}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-4 outdoorCityWithStateHide0" id="outdoor_city_with_stateDiv0" style="display: none;">
      <div class="form-group" >
        <label class="form-control-label">City with state/राज्य के साथ शहर</label>
        <input style="width: 21px;height: 23px;" class="form-control form-control-sm" {{ $disabled }} type="checkbox" id="outdoorCityWithState0" name="outdoorCityWithState[]" {{ (@$codmDetail->{'State With City'}=="1")? "checked" : "" }}>
      </div>
    </div>
    <!--   Start City selected indivisual state -->
    <div class="col-md-4 selectedTgroup0" id="outdoorgetCityDiv0" style="display: none;">
      <div class="form-group">
        <label class="form-control-label">City/शहर</label>
        <select {{ $disabled }} name="outdoorCityList[]" id="outdoorCityList0" class="form-control form-control-sm">
           <option value="{{@$outdoorCitySelectionData1[0]}}" selected="selected"> {{@$outdoorCitySelectionData1[0]}} </option>
        </select>
      </div>
    </div>
    <div class="col-md-4" id="spotnoDiv" style="display: none;">
      <div class="form-group">
        <label class="form-control-label">Spots No. /स्पॉट संख्या<font color="red">*</font></label>
        <input {{ $disabled }} type="text" maxlength="20" name="outdoorSpotsno[]" id="outdoorSpotsno0" placeholder="Enter Spots No." class="form-control form-control-sm" value="{{@$codmDetail->{'No_ Of Spots'} ?? ''}}" onkeypress="return isNumber(event)">
      </div>
    </div>
  </div>
 <!--  <div class="row">
    <div class="col-sm-12 text-right">
      <a class="btn btn-danger remove-button  btn-sm m-0" id="removeRow"><i class="fa fa-caret-left"></i> Remove</a> 
    </div>
  </div> -->
</div><!-- end addmore div -->
@endforeach
<div  id="newRow"></div>
  <div class="row">
    <div class="col-sm-12 text-right" >
      <a class="btn btn-primary addrow-button  btn-sm m-2" id="addRow"><i class="fa fa-caret-left"></i> Add Row</a> 
    </div>
  </div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label"> Requirements/ आवश्यकताएँ </label>
      <textarea {{$disabled}} id="outdoorRequirement" name="outdoorRequirement" placeholder="Enter Requirement" rows="2" cols="50" class="form-control form-control-sm">{{@$codm[0]->{'Requirement'} ?? ''}}</textarea>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label"> Remarks/टिप्पणी</label>
      <textarea {{$disabled}} id="outdoorRemarks" name="outdoorRemarks" maxlength="100" placeholder="Enter Remarks" rows="2" cols="50" class="form-control form-control-sm">{{@$codm[0]->{'Remarks'} ?? ''}}</textarea>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Is creative available/क्या रचनात्मक उपलब्ध है? <font color="red">*</font></label>
      <select {{ $disabled }} name="outdoorCreativeAvail" id="outdoorCreativeAvail" class="form-control form-control-sm" >
        <option value="">Select any one option</option>
        <option value="0" {{@$codm[0]->{'Creative Availability'} == 0 && @$codm[0]->{'Creative Availability'} != ""  ? 'selected' : ''}}>Available</option>
        <option value="1" {{@$codm[0]->{'Creative Availability'} == 1 && @$codm[0]->{'Creative Availability'} != ""  ? 'selected' : ''}}>Not Available</option>
        <option value="2" {{@$codm[0]->{'Creative Availability'} == 2 && @$codm[0]->{'Creative Availability'} != ""  ? 'selected' : ''}}>Creative to be developed by BOC</option>
        <option value="3" {{@$codm[0]->{'Creative Availability'} == 3 && @$codm[0]->{'Creative Availability'} != ""  ? 'selected' : ''}}>Photographs Available</option>
      </select>
      <span id="first_rena_lang" style="color:red;display:none;"></span>
    </div>
  </div>
  @if(@$codm[0]->{'Creative File Name'}=='' || @$codm[0]->{'Creative File Name'}==null)
  <div class="col-md-4" id="outdoorUploadCreativeDiv">
    <div class="form-group">
      <label class="form-control-label">Upload creative/क्रिएटिव अपलोड करें<font color="red">*</font></label>
      <input {{ $disabled }} type="file" accept="image/png, image/jpeg, image/jpg" class="form-control form-control-sm" name="outdoorCreativeFileName" id="outdoorCreativeFileName" ><span id="upload_doc_error" class="error invalid-feedback"></span>
    </div>
  </div>
  @endif
  @if(@$codm[0]->{'Creative File Name'}!='' || @$codm[0]->{'Creative File Name'}!=null)
  <div class="col-md-4" id="outdoorUploadCreativeDiv">
    <div class="form-group">
      <label class="form-control-label">Uploaded creative/क्रिएटिव अपलोड करें<font color="red">*</font></label>
      <a href="{{ url('/uploads') }}/client-request/{{ $codm[0]->{'Creative File Name'} }}" target="_blanck"><img src="{{ url('/uploads') }}/client-request/{{ $codm[0]->{'Creative File Name'} }}" width="80px" height="80px"></a></span>
    </div>
  </div>
  @endif
</div>