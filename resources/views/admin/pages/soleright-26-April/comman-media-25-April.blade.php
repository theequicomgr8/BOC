@php
$lineone =[];
$media_cat = array('0' => 'Airport', '1' => 'Railways', '2' => 'Road', '3' => 'Transit Media', '4' => 'Others', '5' => 'Metro', '6' => 'Bus & Station');
$read1='';
$pointer1 = '';
if(!empty($OD_media_address_data) && count($OD_media_address_data) > 1 && @$pointer ==''){
$read1='readonly';
$pointer1 = 'none';
}
$url = request()->segments();
if($url[0] == 'sole-right-media'){
if(empty($vendor_data) || @$vendor_data[0]['Modification'] == '0'){
$modification = 0;
}else{
$modification = 1;
}
}elseif($url[0] == 'sole-right-existing-user'){
if(empty($vendor) || @$vendor->{'Modification'} == '0'){
$modification = 0;
}
}elseif($url[0] == 'sole-right-renewal'){
if(!empty($vendor) && $modification_renew == '0'){
$modification = 0;
}else{
$modification = 1;
}
}
$catText = '';
@endphp

@if($modification == '0')
<div class="row" style="display: {{@$show}};">
    <div class="col-md-6">
        <h6>If you want to import through XLS <a href="{{asset('uploads/Master.xlsx')}}" target="_blank">Download Master File</a></h6>
    </div>
    <div class="col-md-3">
        <input type="radio" name="xls" id="xlxyes" value="1" class="xls"> Yes &nbsp;
        <input type="radio" name="xls" id="xlxno" value="0" class="xls" checked="checked"> No
    </div>
</div><br><br>

<!-- add 20 Apr start -->
<div class="row" id="second" style="display: none;">
    <div class="col-md-6" >
        <h6><a href="{{asset('uploads/outdoor_sample1.xlsx')}}" target="_blank">Download Sample File</a></h6>
    </div>
</div>
<div class="row" id="three" style="display: none;">
    <div class="col-md-6" >
        <h6><a href="{{asset('uploads/outdoor_sample2.xlsx')}}" target="_blank">Download Sample File</a></h6>
    </div>
</div>
<div class="row" id="four" style="display: none;">
    <div class="col-md-6" >
        <h6><a href="{{asset('uploads/outdoor_sample3.xlsx')}}" target="_blank">Download Sample File</a></h6>
    </div>
</div>
<div class="row" id="choose_category" style="display: none;">
    <div class="col-md-4">
        <div class="form-group">
            <label>Media category / मीडिया श्रेणी <font color="red">*</font></label>
            <p>
                <select name="mediacategory" class="form-control form-control-sm empty downloadclass" style="width: 100%;" id="mediacategory" data-val="mediasubcategory">
                    <option value="">Select Category</option>
                    <option value="0">Airport </option>
                    <option value="1">Railways</option>
                    <option value="2">Road </option>
                    <option value="3">Transit Media</option>
                    <option value="4">Others</option>
                    <option value="5">Metro</option>
                    <option value="6">Bus & Station</option>
                </select>
            </p>
        </div>
    </div>

    <div class="col-md-4" id="subcategory2">
        <div class="form-group">
            <label>Media Sub-Category / मीडिया उप-श्रेणी : <font color="red">*</font>
            </label>
            <p>
                <select name="mediasubcategory" class="form-control-sm form-control empty subcategory dynemicsub_cat0 mediasub" id="mediasubcategory"  data-eid="mediasubcategory">
                    <option value="">Select Sub-Category</option>
                    @foreach($getcat as $cat)
                    <option value="{{$cat->media_uid}}">
                        {{$cat->name}}
                    </option>
                    @endforeach
                </select>
            </p>
        </div>
    </div>
</div>
<!-- add 20 Apr end -->

<div class="row" id="xls_show">
    <div class="col-md-4">
        <input type="file" name="media_import" id="media_address_import" class="form-control form-control-sm" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
    </div>
</div>

<div id="media_address">
    @foreach($OD_media_address_data as $key => $OD_media_address)
    <div class="row" id="media_empty">
        <div class="col-md-4">
            <div class="form-group">
                <label for="Name">State / राज्य<font color="red">*</font>
                </label>
                <p>
                    <select {{@$disabled}} id="state_id_{{$key}}" name="MA_State[]" class="form-control form-control-sm empty call_district" data="dist_id_{{$key}}" {{@$read}} tabindex="{{$key}}" style="pointer-events: {{@$pointer}};">
                        <option value="">Select State</option>
                        @if(count($states) > 0)
                        @foreach($states as $statesData)
                        <option value="{{ $statesData['Code'] }}" {{@$OD_media_address['State'] == $statesData['Code'] ? 'selected' : ''}}>
                            {{$statesData['Description']}}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Name">District / ज़िला<font color="red">*</font>
                </label>
                <p>
                    <select {{@$disabled}} id="dist_id_{{$key}}" name="MA_District[]" class="form-control form-control-sm empty" {{@$read}} tabindex="{{$key}}" style="pointer-events: {{@$pointer}};">
                        <option value="">Select District</option>
                        @if(@$OD_media_address['District'])
                        <option selected="selected">
                            {{$OD_media_address['District']}}
                        </option>
                        @endif
                    </select>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Name">City / नगर<font color="red">*</font></label>
                <p>
                    <input type="text" name="MA_City[]" id="MA_City{{$key}}" class="form-control form-control-sm empty" placeholder="Enter City" maxlength="20" value="{{$OD_media_address['City']?? ''}}" onkeypress="return onlyAlphabets(event)" {{@$disabled}} {{@$read}} tabindex="{{@$key}}" style="pointer-events: '{{@$pointer}}';">
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Media category / मीडिया श्रेणी <font color="red">*</font></label>
                <p>
                    <select name="Applying_For_OD_Media_Type[]" class="form-control form-control-sm empty mediaclass" style="width: 100%; pointer-events: {{@$pointer}} {{@$pointer1}};" {{@$disabled}} id="applying_media_{{$key}}" data-val="showcategory_{{$key}}" {{@$read}} {{$read1}} tabindex="{{$key}}">
                        <option value="">Select Category</option>
                        <option value="0" {{@$OD_media_address['OD Media Type']=='0' ? 'selected' : ''}}>Airport </option>
                        <option value="1" {{@$OD_media_address['OD Media Type']=='1' ? 'selected' : ''}}>Railways</option>
                        <option value="2" {{@$OD_media_address['OD Media Type']=='2' ? 'selected' : ''}}>Road</option>
                        <option value="3" {{@$OD_media_address['OD Media Type']=='3' ? 'selected' : ''}}>Transit Media</option>
                        <option value="4" {{@$OD_media_address['OD Media Type']=='4' ? 'selected' : ''}}>Others</option>
                        <option value="5" {{@$OD_media_address['OD Media Type']=='5' ? 'selected' : ''}}>Metro</option>
                        <option value="6" {{@$OD_media_address['OD Media Type']=='6' ? 'selected' : ''}}>Bus & Station</option>
                    </select>
                </p>
            </div>
        </div>
        <div class="col-md-4" id="subcategory">
            <div class="form-group">
                <label>Media Sub-Category / मीडिया उप-श्रेणी <font color="red">*</font>
                </label>
                <p>
                    <select name="od_media_type[]" class="form-control-sm form-control empty subcategory dynemicsub_cat{{$key}} " id="showcategory_{{$key}}" {{@$read}} tabindex="{{$key}}" style="pointer-events: {{@$pointer}};" data-eid="showcategory_{{$key}}">
                        <option value="">Select Sub-Category</option>
                        @if(@$OD_media_address['OD Media Type']!='')
                        @foreach($getcat as $cat)
                        @php
                        $selected = '';
                        if($OD_media_address['OD Media ID'] == $cat->media_uid){
                        $selected = 'selected';
                        $catText= $cat->name;
                        }
                        @endphp
                        <option value="{{$cat->media_uid}}" {{@$selected}}>
                            {{$cat->name}}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </p>
            </div>
        </div>

        <div class="col-md-4 train_no" style="display: {{@$OD_media_address['OD Media Type']=='1' ? 'block' : 'none'}};">
            <div class="form-group">
                <label for="Train_No">Train Number/Name / गाड़ी संख्या/नाम<font color="red"></font></label>
                <p>
                    <input type="text" name="Train_Data[]" placeholder="Search By Train Number/Name" class="form-control form-control-sm traindata" id="Train_Data_{{$key}}" tabindex="{{$key}}" value="{{ @$OD_media_address['Train Number'] != '' && $OD_media_address['Train Number'] != 0 ?$OD_media_address['Train Number'] .' - '. $OD_media_address['Train Name'] : ''}}">
                </p>
            </div>
        </div>

        <?php
        $arrdata = "OD006,OD013,OD072,OD073,OD110,OD122,OD086,OD087,OD123,OD127";
        $findcat = @$OD_media_address['OD Media ID'] ?? '';
        $show_no_of_spots = 'none';
        if ($findcat != '') {
            if (strpos($arrdata, @$OD_media_address['OD Media ID']) !== false) {
                $show_no_of_spots = 'block';
            }
        }
        ?>
        <input type="hidden" name="noOfSpotsArr" id="noOfSpotsArr" value="{{$arrdata}}">
        <div class="col-md-4 no_of_spots_{{$key}}" style="display: {{$show_no_of_spots}};">
            <div class="form-group">
                <label for="year">No. of Spots / स्पॉट की संख्या<font color="red"></font></label>
                <p>
                    <input type="text" name="No_of_Spots[]" placeholder="Enter No of Spots" class="form-control form-control-sm" id="No_of_Spots_{{$key}}" onkeypress="return onlyNumberKey(event)" value="{{ @$OD_media_address['No Of Spot'] ? round(@$OD_media_address['No Of Spot'],2) : ''}}" {{@$read}} tabindex="{{@$key}}" style="pointer-events: '{{@$pointer}}';">
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="year">Quantity/No. Of Location / मात्रा/स्थान की संख्या<font color="red">*</font></label>
                <p>
                    <input type="text" name="quantity[]" placeholder="Location Quantity" class="form-control form-control-sm empty lat_media" id="quantity_{{$key}}" onkeypress="return onlyNumberKey(event)" value="{{ @$OD_media_address['Quantity'] ? round(@$OD_media_address['Quantity'],2) : ''}}" {{@$read}} tabindex="{{@$key}}" style="pointer-events: '{{@$pointer}}';">
                </p>
            </div>
        </div>
        
        <?php
        $litStr = "Bus Panel,Hoarding,Digital Display,Train Inside,Train Outside";
        $litArr = explode(",", $litStr);
        $catstr = $catText ?? '';
        $show_lit = 'none';
        if ($catstr != '') {
            foreach ($litArr as $val) {
                if (strpos($catstr, $val) === false && @$OD_media_address['Illumination Type'] == '1') {
                    $show_lit = 'block';
                    break;
                }
            }
        }

        ?>
        <input type="hidden" name="litArr" id="litArr" value="{{$litStr}}">
        <div class="col-md-4">
            <div class="form-group">
                <label for="illumination">Illumination / रोशनी</label>
                <p>
                    <select name="Illumination_media[]" id="Illumination_media_{{$key}}" class="form-control form-control-sm illuminationType" {{@$read}} tabindex="{{$key}}" style="pointer-events: {{@$pointer}};">
                        <option value="">Select Illumination</option>
                        <option value="1" {{@$OD_media_address['Illumination Type']=='1' ? 'selected' : '' }} style="display: {{$show_lit}};">Lit
                        </option>
                        <option value="2" {{@$OD_media_address['Illumination Type']=='2' ? 'selected' : '' }}>Non
                            Lit</option>
                    </select>
                </p>
            </div>
        </div>

        <div class="col-md-4 lit_type_{{$key}}" style="display: {{$show_lit}};">
            <div class="form-group">
                <label for="year">Lit Type<font color="red"></font></label>
                <p>
                    <select name="lit_type[]" id="lit_type_{{$key}}" class="form-control form-control-sm" {{@$read}} tabindex="{{@$key}}" style="pointer-events: {{@$pointer}};">
                        <option value="">Please Select</option>
                        <option value="1" {{@$OD_media_address['Lit Type']=='1' ? 'selected' : '' }}>Front Lit</option>
                        <option value="2" {{@$OD_media_address['Lit Type']=='2' ? 'selected' : '' }}>Back Lit</option>
                    </select>
                </p>
            </div>
        </div>
        <?php
        $arrdata1 = "OD053,OD010,OD011,OD014,OD017,OD018,OD019,OD020,OD021,OD023,OD024,OD025,OD036,OD037,OD038,OD044,OD047,OD048,OD054,OD055,OD057,OD071,OD082,OD084,OD088,OD089,OD090,OD092,OD095,OD108,OD113,OD117,OD041,OD120,OD035,OD051";
        $findcat1 = @$OD_media_address['OD Media ID'] ?? '';
        $show_size_fields = 'none';
        if ($findcat1 != '') {
            if (strpos($arrdata1, @$OD_media_address['OD Media ID']) !== false) {
                $show_size_fields = 'block';
            }
        }
        ?>
        <input type="hidden" name="LWArr" id="LWArr" value="{{$arrdata1}}">
        <div class="col-md-4 area_size_{{$key}}" style="display: {{$show_size_fields}};">
            <div class="form-group">
                <label>Size Type / आकार प्रकार <font color="red"></font>
                </label>
                <p>
                    <select name="Size_Type[]" class="form-control form-control-sm" style="width: 100%;" id="Size_Type_{{$key}}" tabindex="{{$key}}">
                        <option value="">Select Size Type</option>
                        <option value="1" {{ @$OD_media_address['Size Type']=='1' ? 'selected' : '' }}>CM </option>
                        <option value="2" {{ @$OD_media_address['Size Type']=='2' ? 'selected' : '' }}>FT</option>
                    </select>
                </p>
            </div>
        </div>
        <div class="col-md-4 area_size_{{$key}}" style="display: {{$show_size_fields}};">
            <div class="form-group">
                <label for="license_to">Length / लंबाई <font color="red"></font></label>
                <p>
                    <input type="text" name="length[]" placeholder="Enter Length" class="form-control form-control-sm empty size_area size_len_digit" id="length_{{$key}}" value="{{ @$OD_media_address['Length'] ? round(@$OD_media_address['Length'],2) : ''}}" {{@$disabled}} onkeypress="return onlyNumberKey(event)" {{@$read}} tabindex="{{@$key}}" style="pointer-events: '{{@$pointer}}';">
                    <span id="len_error_{{$key}}" class="error invalid-feedback"></span>
                </p>
            </div>
        </div>
        <div class="col-md-4 area_size_{{$key}}" style="display: {{$show_size_fields}};">
            <div class="form-group">
                <label for="year">Width / चौड़ाई<font color="red"></font></label>
                <p>
                    <input type="text" name="width[]" placeholder="Enter Width" class="form-control form-control-sm empty size_area size_width_digit" id="width_{{$key}}" onkeypress="return onlyNumberKey(event)" value="{{ @$OD_media_address['Width'] ? round(@$OD_media_address['Width'],2) : ''}}" {{@$read}} tabindex="{{@$key}}" style="pointer-events: '{{@$pointer}}';">
                    <span id="width_error_{{$key}}" class="error invalid-feedback"></span>
                </p>
            </div>
        </div>
        <div class="col-md-4 area_size_{{$key}}" style="display: {{$show_size_fields}};">
            <div class="form-group">
                <label for="year">Total Area / कुल क्षेत्रफल<font color="red"></font></label>
                <p>
                    <input type="text" name="Total_Area[]" placeholder="Total Area" class="form-control form-control-sm" id="Total_Area_{{$key}}" onkeypress="return onlyNumberKey(event)" value="{{ @$OD_media_address['Total Area'] ? round(@$OD_media_address['Total Area'],2) : ''}}" {{@$read}} tabindex="{{@$key}}" style="pointer-events: 'none';" readonly>
                </p>
            </div>
        </div>
        <div class="col-md-10"></div>
        <div class="col-md-2" style="padding: 2% 0 0 5%; display: {{$key==0 ? 'none' :'block'}}"><button class="btn btn-danger remove_row" data="{{$key}}" style="display: {{@$show}};"><i class="fa fa-minus"></i> Remove</button>
            <input type="hidden" value="{{$OD_media_address['Line No_'] ?? ''}}" name="line_no_m" id="line_no_m{{$key}}">
            <input type="hidden" value="{{$OD_media_address['Sole Media ID'] ?? ''}}" name="odmedia_id_m" id="odmedia_id_m{{$key}}">
        </div>
    </div>
    @php
    if(!empty($OD_media_address['Line No_'])) {
    $lineone[] =$OD_media_address['Line No_'];
    }
    $extline1 =implode(',', $lineone);
    @endphp
    @endforeach
</div><!-- media_address id close -->
<input type="hidden" name="lineno1" id="lineno1" value="{{$extline1 ?? ''}}">
<div class="row" style="float:right;margin-top: 6px;margin-right: 0px;">
    <input type="hidden" name="count_id" id="count_id" value="{{$key ?? 0}}">
    <a class="btn btn-primary {{@$disabled}}" id="add_row_media_add" {{@$read}} tabindex="{{@$tab}}" style="pointer-events: {{@$pointer}}; display: {{@$show}};"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
</div>
@else
<div class="row">
    <div class="col-md-12 wrapScroll" id="media_address">
        <table class="table" style="border: 1px solid gainsboro;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">State</th>
                    <th scope="col">District</th>
                    <th scope="col">City</th>
                    <th scope="col">Media category</th>
                    <th scope="col">Media Sub-Category</th>
                    <th scope="col">Train No.</th>
                    <th scope="col">Train Name</th>
                    <th scope="col">Spots</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Length </th>
                    <th scope="col">Width </th>
                    <th scope="col">Total Area</th>
                    <th scope="col">Size Type </th>
                    <th scope="col">Illumination</th>
                    <th scope="col">Lit Type</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($OD_media_address_data as $key => $OD_media_address)
                <tr>
                    <td scope="row">{{ $key +1 }}</td>
                    <td>
                        @if(count($states) > 0)
                        @foreach($states as $statesData)
                        {{$OD_media_address['State'] == $statesData['Code'] ? $statesData['Description'] : ''}}
                        @endforeach
                        @endif
                    </td>
                    <td>{{$OD_media_address['District'] ?? ''}}</td>
                    <td>{{$OD_media_address['City'] ?? ''}}</td>
                    <td>
                        @foreach($media_cat as $k => $cat_val)
                        {{$OD_media_address['OD Media Type'] == $k ? $cat_val : ''}}
                        @endforeach
                    </td>
                    <td>
                        @if(@$OD_media_address['OD Media Type']!='')
                        @foreach($getcat as $cat)
                        {{@$OD_media_address['OD Media ID']==$cat->media_uid ? $cat->name : ''}}
                        @endforeach
                        @endif
                    </td>
                    <td>{{ $OD_media_address['OD Media Type']=='1' ? $OD_media_address['Train Number'] : ''}}</td>
                    <td>{{ $OD_media_address['OD Media Type']=='1' ? $OD_media_address['Train Name'] : ''}}</td>
                    <td>{{ !empty($OD_media_address) ? round(@$OD_media_address['No Of Spot'],2) : ''}}</td>
                    <td>{{ !empty($OD_media_address) ? round(@$OD_media_address['Quantity'],2) : ''}}</td>
                    <td>{{ !empty($OD_media_address) ? round(@$OD_media_address['Length'],2) : ''}}</td>
                    <td>{{ !empty($OD_media_address) ? round(@$OD_media_address['Width'],2) : ''}}</td>
                    <td>{{ !empty($OD_media_address) ? round((@$OD_media_address['Length'] * @$OD_media_address['Width']),2) : ''}}</td>
                    <td>{{ $OD_media_address['Size Type'] =='1' ? 'CM' : 'FT'}}</td>
                    <td>{{ $OD_media_address['Illumination Type']=='1' ? 'Lit' : 'Non Lit'}}</td>
                    <td> @if($OD_media_address['Illumination Type']=='1') {{$OD_media_address['Lit Type'] =='1' ? 'Front Lit' : 'Back Lit'}} @else &nbsp; @endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif