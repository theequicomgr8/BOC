<div class="row" style="display: none;">
  <div class="col-md-12">
    <div class="form-group">
      <label class="form-control-label">Size / आकार<font color="red">*</font></label>
      <div class="icheck-primary d-inline">
        <input {{ $disabled }} type="radio" id="radioKnown1" name="knowncampaign" value="1" {{ (@$prch->{'Size Known'}=="1")? "checked" : "checked" }}><label for="radioKnown1">If Known / यदि परिचित हो </label>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Newspaper Type/ समाचार पत्र प्रकार<font color="red">*</font></label>
      <select {{ $disabled }} name="newspaper_type" id="newspaper_type" class="form-control form-control-sm" onchange="getMediaType(this.value)">
        <option value="">Select Newspaper Type</option>
        <option value="0" {{@$prch->{'Newspaper Type'} == 0 && @$prch->{'Newspaper Type'} != ""  ? 'selected' : ''}}>Daily</option>
        <option value="1" {{@$prch->{'Newspaper Type'} == 1 && @$prch->{'Newspaper Type'} != ""  ? 'selected' : ''}}>Employment News</option>
      </select>
    </div>
  </div>
  <!--------Start Media Plan Type--------->
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Media plan type/ मीडिया योजना प्रकार<font color="red">*</font></label>
      <select {{ $disabled }} name="print_media_planType" id="media_plan" class="form-control form-control-sm">
        <option value="">Select Media Plan</option>
        <option value="0" {{@$prch->{'Media Plan Type'} == 0 && @$prch->{'Media Plan Type'} != ""  ? 'selected' : ''}}>Single Plan</option>
        <option value="1" {{@$prch->{'Media Plan Type'} == 1 && @$prch->{'Media Plan Type'} != ""  ? 'selected' : ''}}>Multiple Plan</option>
      </select>
      <span id="first_claimed_circulation" style="color:red;display:none;"></span>
    </div>
  </div>
  <!--------end Langauge--------->
  <div class="col-md-4" id="print_size_select">
    <div class="form-group">
      <label class="form-control-label">Print size selection/प्रिंट आकार चयन<font color="red">*</font></label>
      <select {{ $disabled }} name="pageSize" id="pageSize" class="form-control form-control-sm">
        <option value="">Select Page Size</option>
        <option value="0" {{@$prch->{'Print Size Selection'} ==0 && @$prch->{'Print Size Selection'} != ""  ? 'selected' : ''}}>Custom Size</option>
        <option value="1" class="print_size_option" {{@$prch->{'Print Size Selection'} ==1 && @$prch->{'Print Size Selection'} != ""  ? 'selected' : ''}}>Half Page Horizontal</option>
        <option value="2" class="print_size_option" {{@$prch->{'Print Size Selection'} ==2 && @$prch->{'Print Size Selection'} != ""  ? 'selected' : ''}}>Full Page</option>
        <option value="3" class="print_size_option" {{@$prch->{'Print Size Selection'} ==3 && @$prch->{'Print Size Selection'} != ""  ? 'selected' : ''}}>Half Page Vertical</option>
        <option value="4" class="print_size_option" {{@$prch->{'Print Size Selection'} ==4 && @$prch->{'Print Size Selection'} != ""  ? 'selected' : ''}}>Quarter Page</option>
      </select>
      <span id="first_claimed_circulation" style="color:red;display:none;"></span>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4" id="printLength">
    <div class="form-group">
      <label class="form-control-label">Advertise length(Cm.) / विज्ञापन की लंबाई<font color="red">*</font></label>
      <input {{ $disabled }} type="text" maxlength="20" name="un_advertise_length" placeholder="Enter Advertise Length" class="form-control form-control-sm" id="un_advertise_length" onkeyup="return customSize(this)" onkeypress="return onlyNumberKey(event)" value="{{$Length}}">
      <span id="first_company_name" style="color:red;display:none;"></span>
      <span id="ctm_un_advertise_length" style="color:red;display:none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="printBread">
    <div class="form-group">
      <label class="form-control-label">Advertise breadth(Cm.) / विज्ञापन चौड़ाई<font color="red">*</font></label>
      <input {{ $disabled }} type="text" maxlength="20" name="un_advertise_breadth" id="un_advertise_breadth" placeholder="Enter Advertise Breadth" class="form-control form-control-sm" onkeyup="return customSize(this)" onkeypress="return onlyNumberKey(event)" value="{{$Breadth }}">
      <span id="first_channel_of_name" style="color:red;display:none;"></span>
      <span id="ctm_un_advertise_breadth" style="color:red;display:none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="printArea">
    <div class="form-group">
      <label class="form-control-label">Advertise area(Sq Cm) / विज्ञापन क्षेत्र <font color="red">*</font></label>
      <input {{ $disabled }} type="text" name="un_advertise_area" id="un_advertise_area" placeholder="Enter Advertise Area." class="form-control form-control-sm" id="advertise_area" onkeypress="return onlyNumberKey(event)" value="{{ $SizeofAdvt }}">
      <span id="first_rena_rni_registration_no" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Color / रंग<font color="red">*</font></label>
      <select {{ $disabled }} name="print_color" id="print_color" class="form-control form-control-sm">
        <option value="">Select Color</option>
        <option value="0" {{@$prch->{'Color'} ==0 && @$prch->{'Color'} != ""  ? 'selected' : ''}}>Color</option>
        <option value="1" {{@$prch->{'Color'} ==1 && @$prch->{'Color'} != ""  ? 'selected' : ''}}>B/W</option>
        <!-- <option value="2" {{@$prch->{'Color'} == 2 && @$prch->{'Color'} != ""  ? 'selected' : ''}} >Color-Big NP</option> -->
      </select>
      <span id="first_claimed_circulation" style="color:red;display:none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label"> Budget / बजट<font color="red">*</font></label>
      <input {{ $disabled }} type="text" class="form-control form-control-sm" name="tentative_budget" maxlength="20" id="tentative_budget" placeholder="Enter Tentative Budget." onkeypress="return onlyNumberKey(event)" value="{{ round(@$prch->{'Print Budget'}) && round(@$prch->{'Print Budget'})!=0? round(@$prch->{'Print Budget'}):'' }}">
    </div>
  </div>
  <div class="col-md-4" id="targetArea">
    <div class="form-group">
      <label class="form-control-label">Target area / लक्षित इलाका<font color="red">*</font></label>
      <select {{ $disabled }} name="print_target_area" id="target_area" class="form-control form-control-sm">
        <option value="">Select Target Area </option>
        <option value="0" {{@$prch->{'Target Area'} ==0 && @$prch->{'Target Area'} != ""  ? 'selected' : ''}}>Pan India</option>
        <option value="1" {{@$prch->{'Target Area'} ==1 && @$prch->{'Target Area'} != ""  ? 'selected' : ''}}>Individual State</option>
        <option value="2" {{@$prch->{'Target Area'} ==2 && @$prch->{'Target Area'} != ""  ? 'selected' : ''}}>Group of States</option>
        <option value="3" {{@$prch->{'Target Area'} ==3 && @$prch->{'Target Area'} != ""  ? 'selected' : ''}}>Cities</option>
      </select>
      <span id="first_claimed_circulation" style="color:red;display:none;"></span>
    </div>
  </div>
</div>
<div id="selected_target_area">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group" id="group_state">
        <label class="form-control-label">Group of states/राज्यों का समूह <font color="red">*</font></label>
        <select {{$disabled}} name="group_s[]" id="group_s" class="form-control form-control-sm" multiple>
          @foreach($states as $state)
          <option value="{{$state->Code}}" {{in_array( $state->Code, str_replace(' ', '', $printStateSelectionData1)) ? 'selected' :'' }}>{{$state->Code}} ~ {{$state->Description}}</option>
          @endforeach
        </select>
        <span id="first_claimed_circulation" style="color:red;display:none;"></span>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group" id="individuals_state">
        <label class="form-control-label">Individual state/व्यक्तिगत राज्य <font color="red">*</font></label>
        <select {{ $disabled }} name="individuals_s" id="individuals_s" class="form-control form-control-sm">
          <option value="" {{@$prch->{'State'} == ""  ? 'selected' : ''}}>Select State</option>
          @foreach($states as $state)
          <option value="{{$state->Code}}" {{@$prch->{'State'} === $state->Code  ? 'selected' : ''}}>{{$state->Code}} ~ {{$state->Description}}</option>
          @endforeach
        </select>
        <span id="first_claimed_circulation" style="color:red;display:none;"></span>
      </div>
    </div>
    <div class="col-md-4 city_with_state_div" id="city_with_state_div" style="display: none;">
      <div class="form-group ">
        <!-- <label class="form-control-label">&nbsp;</label> -->
        <label class="form-control-label">City with state</label>
        <input style="width: 21px;height: 23px;" class="form-control form-control-sm" {{ $disabled }} type="checkbox" id="city_with_state" name="city_with_state" {{ (@$prch->{'State With City'}=="1")? "checked" : "" }}>
      </div>
    </div>
    <!--   Start City selected indivisual state -->
    <div class="col-md-4" id="getCity" style="display: none;">
      <div class="form-group">
        <label class="form-control-label">City</label>
        <select {{ $disabled }} name="cityList" id="cityList" class="form-control form-control-sm">
          <option value="{{@$printCitySelectionData1[0]}}" selected="selected"> {{@$printCitySelectionData1[0]}} </option>
        </select>
        <span id="first_claimed_circulation" style="color:red;display:none;"></span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <!-------Group of city--------->
  <div class="col-md-4" id="group_city">
    <div class="form-group">
      <label class="form-control-label">Group of Cities <font color="red">*</font></label>
      <select {{ $disabled }} name="group_of_city" id="group_of_city" class="form-control form-control-sm">
        <option value="">Select </option>
        <option value="0" {{@$prch->{'City Groups'} ==0 && @$prch->{'City Groups'} != ""  ? 'selected' : ''}}>Metro</option>
        <option value="1" {{@$prch->{'City Groups'} ==1 && @$prch->{'City Groups'} != ""  ? 'selected' : ''}}>Capital</option>
        <option value="2" {{@$prch->{'City Groups'} ==2 && @$prch->{'City Groups'} != ""  ? 'selected' : ''}}>Class A</option>
        <option value="3" {{@$prch->{'City Groups'} ==3 && @$prch->{'City Groups'} != ""  ? 'selected' : ''}}>Class B</option>
        <option value="4" {{@$prch->{'City Groups'} ==4 && @$prch->{'City Groups'} != ""  ? 'selected' : ''}}>Class C</option>
        <option value="5" {{@$prch->{'City Groups'} ==5 && @$prch->{'City Groups'} != ""  ? 'selected' : ''}}>Random</option>
      </select>
      <span id="first_claimed_circulation" style="color:red;display:none;"></span>
    </div>
  </div>
  <!--------End Group of city----->
  <div class="col-md-4" id="randomCity">
    <div class="form-group">
      <label class="form-control-label">Random cities</label>
      <select {{ $disabled }} name="randomCityList[]" id="randomCityList" class="form-control form-control-sm" multiple>
        @foreach($allCityData as $allCity)
        <option value="{{$allCity->CityName}}" {{ in_array($allCity->CityName,str_replace(' ', '',$printCitySelectionData1) )? 'selected' :'' }}>{{$allCity->CityName}} </option>
        @endforeach
      </select>
      <span id="first_claimed_circulation" style="color:red;display:none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <!--------Start Langauge--------->
  <div class="col-md-4">
    <div class="form-group" id="languageName">
      <label class="form-control-label">Language(S/M)/भाषा (एस / एम)<font color="red">*</font></label>
      <select {{ $disabled }} name="print_language" id="language_sm" class="form-control form-control-sm">
        <option value="">Select Language</option>
        <option value="0" {{@$prch->{'Language'} == 0 && @$prch->{'Language'} != ""  ? 'selected' : ''}}>Single</option>
        <option value="1" {{@$prch->{'Language'} == 1 && @$prch->{'Language'} != ""  ? 'selected' : ''}}>Multiple</option>
        <option value="2" {{@$prch->{'Language'} == 2 && @$prch->{'Language'} != ""  ? 'selected' : ''}}>Hindi & English</option>
        <option value="3" {{@$prch->{'Language'} == 3 && @$prch->{'Language'} != ""  ? 'selected' : ''}}>State Language Preference</option>
      </select>
      <span id="first_claimed_circulation" style="color:red;display:none;"></span>
    </div>
  </div>
  <!--------end Langauge--------->
  <!-------Start single Language--------->
  <div class="col-md-4" id="single_langauge_select_div">
    <div class="form-group">
      <label class="form-control-label">Single language/एक भाषा<font color="red">*</font></label>
      <select {{ $disabled }} name="multi_langauge_select[]" id="single_langauge_select" class="form-control form-control-sm">
        <option value="">Select Single Language</option>
        @foreach($languages as $language)
        <option value="{{$language->Code}}" {{ 
          in_array( $language->Code, str_replace(' ', '', $langSelectionData1 )) ? 'selected' : '' }}>{{$language->Code}} ~ {{$language->Name}}</option>
        @endforeach
      </select>
      <span id="first_claimed_circulation" style="color:red;display:none;"></span>
    </div>
  </div>
  <!--------End single Language----->
  <!-------Start Multiple Language--------->
  <div class="col-md-4" id="multi_langauge_select_div">
    <div class="form-group">
      <label class="form-control-label">Multiple language/विभिन्न भाषा<font color="red">*</font></label>
      <select {{ $disabled }} name="multi_langauge_select[]" id="multi_langauge_select" class="form-control form-control-sm" required="required" multiple>
        @foreach($languages as $language)
        <option value="{{$language->Code}}" {{ 
          in_array( $language->Code, str_replace(' ', '', $langSelectionData1 )) ? 'selected' : '' }}>{{$language->Code}} ~ {{$language->Name}}</option>
        @endforeach
      </select>
      <span id="first_claimed_circulation" style="color:red;display:none;"></span>
    </div>
  </div>
  <!--------End Multiple Language----->
  <!-------Start Multiple Language--------->
  <div class="col-md-4" id="selecte_hindi_english">
    <div class="form-group">
      <label class="form-control-label">Language Hindi & English/भाषा हिंदी और अंग्रेजी <font color="red">*</font> </label>
      <select {{ $disabled }} name="multi_langauge_select[]" id="langauge_select_hindi_english" class="form-control form-control-sm" multiple>
        <option value="HND">Hindi</option>
        <option value="ENU">English</option>
      </select>
      <span id="first_claimed_circulation" style="color:red;display:none;"></span>
    </div>
  </div>
  <!--------End Multiple Language----->
  <!-------Start Multiple media plan--------->
  <div class="col-md-4" id="demography">
    <div class="form-group">
      <label class="form-control-label">Demography/जनसांख्यिकी</label>
      <input {{ $disabled }} type="text" maxlength="20" name="print_demography" id="print_demography" placeholder="Enter Demography" class="form-control form-control-sm" id="print_demography" value="{{ @$prch->{'Demography'} ?? '' }}">
      <span id="first_claimed_circulation" style="color:red;display:none;"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4" id="multiple_media_plan">
    <div class="form-group">
      <label class="form-control-label">No. Of Plan/योजना की संख्या<font color="red">*</font></label>
      <input {{ $disabled }} type="text" maxlength="20" name="Plan_No" placeholder="Enter No. Of Plan" class="form-control form-control-sm" value="{{@$pcount }}" onkeypress="return onlyNumberKey(event)">
    </div>
  </div>
  <!--------End Multiple media plan---->
  <div class="col-md-4" id="requirement">
    <div class="form-group">
      <label class="form-control-label"> Requirement(s) / आवश्यकताएँ </label>
      <textarea {{$disabled}} id="print_Requirement" name="print_Requirement" placeholder="Enter Requirement" rows="2" cols="50" class="form-control form-control-sm">{{ @$prch->{'Requirement'}?? ''}}</textarea>
      <span id="alert_address" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label"> Remarks for revision / पुनरीक्षण के लिए टिप्पणी</label>
      <textarea {{$disabled}} id="print_Remarks" name="print_Remarks" maxlength="100" placeholder="Enter Remarks" rows="2" cols="50" class="form-control form-control-sm">{{ @$prch->{'Remarks'}?? ''}}</textarea>
      <span id="alert_address" style="color:red;display: none;"></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Is creative available/क्या रचनात्मक उपलब्ध है?<font color="red">*</font></label>
      <select {{ $disabled }} name="print_creative" id="is_create_available" class="form-control form-control-sm" OnKeypress="javascript:return isAlphaNumeric(event,this.value);">
        <option value="">Select any one option</option>
        <option value="0" {{@$prch->{'Creative Availability'} == 0 && @$prch->{'Creative Availability'} != ""  ? 'selected' : ''}}>Available</option>
        <option value="1" class="is_creative_available" {{@$prch->{'Creative Availability'} == 1 && @$prch->{'Creative Availability'} != ""  ? 'selected' : ''}}>Not Available</option>
        <option value="2" class="is_creative_available" {{@$prch->{'Creative Availability'} == 2 && @$prch->{'Creative Availability'} != ""  ? 'selected' : ''}}>Creative to be developed by BOC</option>
        <option value="3" class="is_creative_available" {{@$prch->{'Creative Availability'} == 3 && @$prch->{'Creative Availability'} != ""  ? 'selected' : ''}}>Photographs Available</option>
      </select>
      <span id="first_rena_lang" style="color:red;display:none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="upload_creative">
    <div class="form-group">
      <label class="form-control-label">Upload creative/क्रिएटिव अपलोड करें<font color="red">*</font></label>
      <div class="input-group" @if(@$prch->{'Crative File Name'}=='')" @endif>
        <div class="custom-file">
          <input {{ $disabled }} type="file" accept="image/png, image/jpeg, image/jpg" class="custom-file-doc form-control form-control-sm" name="print_upload_creative_fileName" id="upload_doc_0" data="0" onchange="return uploadFile(0,this)">
          <label class="custom-file-label" for="upload_doc_0" id="choose_file0">Choose file</label>
          <input {{ $disabled }} type="hidden" name="hidefile" id="hidefile" value="{{ @$prch->{'Crative File Name'} }}">
        </div>
        @if(@$prch->{'Crative File Name'}=='')
        <div class="input-group-append">
          <span class="input-group-text" id="upload_file0">Upload</span>
        </div>@endif
        @if(@$prch->{'Crative File Name'}!='' || @$prch->{'Crative File Name'}!=null)
        <div class="input-group-append">
          <span class="input-group-text">
            <a href="{{ url('/uploads') }}/client-request/{{ @$prch->{'Crative File Name'} }}" target="_blanck"><img src="{{asset('img/view22X22.png')}}"></a></span>
        </div>
        @endif
        <span id="upload_doc_error0" class="error invalid-feedback"></span>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Advertisement display type/विज्ञापन प्रदर्शन प्रकार<font color="red">*</font></label>
      <select {{ $disabled }} name="print_advertisement_display_select" id="multiple_media_plan_select" class="form-control form-control-sm">
        <option value="">Select</option>
        <option value="0" {{@$prch->{'Advertisement Type'} == 0 && @$prch->{'Advertisement Type'} != ""  ? 'selected' : ''}}>Classified</option>
        <option value="1" {{@$prch->{'Advertisement Type'} == 1 && @$prch->{'Advertisement Type'} != ""  ? 'selected' : ''}}>Display</option>
        <option value="2" {{@$prch->{'Advertisement Type'} == 2 && @$prch->{'Advertisement Type'} != ""  ? 'selected' : ''}}>UPSC</option>
      </select>
      <span id="first_claimed_circulation" style="color:red;display:none;"></span>
    </div>
  </div>
  <div class="col-md-4" id="heighLightDiv">
    <div class="form-group">
      <label class="form-control-label">Highlight/हाइलाइट</label>
      <input {{$disabled}} type="text" id="heighlight" name="heighlight" placeholder="Enter highlight" maxlength="30" class="form-control form-control-sm" OnKeypress="javascript:return onlyAlphabets(event,this.value);" value="{{@$prch->{'Highlight'} ?? ''}}">
    </div>
  </div>

  <div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Publication From Date / प्रकाशन तारीख से<span style="color:red">*</span></label>
      <input {{ $disabled }} style="{{$style}}" type="text" class="form-control form-control-sm" name="from_date" id="from_date" value="{{ date('d-m-Y',strtotime(@$prch->{'Publication From Date'})) && date('d-m-Y',strtotime(@$prch->{'Publication From Date'}))!='01-01-1970'  ?date('d-m-Y',strtotime(@$prch->{'Publication From Date'})): '' }}" placeholder="DD/MM/YYYY" autocomplete="off">
      <span id="date_error" style="color:red;display: none;"></span>
    </div>
  </div>    
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-control-label">Publication To Date / प्रकाशन तारीख तक<span style="color:red">*</span></label>
      <input {{ $disabled }} style="{{ $style }}" type="text" class="form-control form-control-sm" name="to_date" id="to_date" value="{{ date('d-m-Y',strtotime(@$prch->{'Publication  To Date'})) && date('d-m-Y',strtotime(@$prch->{'Publication  To Date'}))!='01-01-1970' ?date('d-m-Y',strtotime(@$prch->{'Publication  To Date'})): '' }}" placeholder="DD/MM/YYYY" autocomplete="off">
      <span id="date_error" style="color:red;display: none;"></span>
    </div>
  </div>
</div>
</div>

