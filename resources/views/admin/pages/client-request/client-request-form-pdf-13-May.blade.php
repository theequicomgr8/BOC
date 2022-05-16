<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Client Request Application Receipt</title>
    <style>
        /* tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tree {
            page-break-inside: avoid;
        }
        #content1::before{
    content: "\a";
    white-space: pre;
} */

body{
            font-size:13px;
        }
        table, th, td {
  border:1px solid #dee2e6;
  border-collapse: collapse;
}
    </style>
</head>

<body>

@php
$disabled= isset($disabled ) ? $disabled :'' ;
$crh=isset($client_req_header)? $client_req_header:'';
$prch=isset($print_client_req)? $print_client_req:'';
$codm=isset($clientOutdoorData)? $clientOutdoorData:[1];
$tvcr=isset($clientTVData)? $clientTVData:'';
$crsRadiocr=isset($clientRadioData)? $clientRadioData:'';
//dd($tvcr);
$mhead=isset($ministries_head) ? $ministries_head:'';
//dd($mhead);
@$Client_ReqNo = $crh->{'Client Request No'};
@$print_reqid1 = @$prch->{'Client Request No_'};
$readonly = ' ';
$checked = ' ';
if(@$Client_Request_No != ''){
$readonly = 'readonly';
$checked = 'checked';
}
$emailreadonly = '';
if(@$email !=''){
$emailreadonly = 'readonly';
}
if(round(@$prch->{'Length'})==0){
$Length='' ;
}else{
$Length=@round(@$prch->{'Length'});
}
if(round(@$prch->{'Breadth'})==0){
$Breadth='' ;
}else{
$Breadth=round(@$prch->{'Breadth'});
}
if( round(@$prch->{'Size of Advt_'})==0){
$SizeofAdvt ='';
}else{
$SizeofAdvt = round(@$prch->{'Size of Advt_'});
}
if( @$prch->{'Plan Count'}==0){
$pcount='';

}else{
$pcount= @$prch->{'Plan Count'};
}
if(@$crh->{'From Date'}=='' ){
$fromDate='';

}else{
$fromDate= date('d-m-Y',strtotime(@$crh->{'From Date'}));
}
if(@$crh->{'To Date'}=='' ){
$toDate='';
}else{
$toDate= date('d-m-Y',strtotime(@$crh->{'To Date'}));
}
if($disabled=='disabled'){
$style="pointer-events:none;";

}else{
$style='';
}
$printCitySelectionData1 = (!empty($printCitySelectionData)) ? explode(',', $printCitySelectionData):[];
$printStateSelectionData1 = (!empty($printStateSelectionData)) ? explode(',', $printStateSelectionData):[];
$langSelectionData1 = (!empty($langSelectionData))?explode(',', $langSelectionData):[];

$tvLangSelectionData =(!empty($tvLangSelectionData))? explode(',', $tvLangSelectionData):[];
$radioLangSelectionData=(!empty($radioLangSelectionData))? explode(',', $radioLangSelectionData):[];

$mediaArray=array(
0=>array('mdNameVal'=>"1",'mdName'=>'Print'),
1=>array('mdNameVal'=>"2",'mdName'=>'Outdoor'),
2=>array('mdNameVal'=>"3",'mdName'=>'AV-TV'),
3=>array('mdNameVal'=>"4",'mdName'=>'AV-Radio')
);
if(@$Client_ReqNo!=''){
$dynamicmname[]=$crh->Print=="1" ? $crh->Print="1":'';
$dynamicmname[]=$crh->Outdoor=="1" ? $crh->Outdoor="2":'';
$dynamicmname[]=$crh->{'AV - TV'}=="1" ? $crh->{'AV-TV'}="3":'';
$dynamicmname[]=$crh->{'AV - Radio'}=="1"? $crh->{'AV-Radio'}="4":'';

$mediaTabArray=array(
0=>array('mdNameVal'=>$crh->Print!="" ? $crh->Print:'','mdName'=>'Print'),
1=>array('mdNameVal'=>$crh->Outdoor!="" ? $crh->Outdoor:'','mdName'=>'Outdoor'),
2=>array('mdNameVal'=>$crh->{'AV - TV'}!="" ? $crh->{'AV - TV'}:'','mdName'=>'AV-TV'),
3=>array('mdNameVal'=>$crh->{'AV - Radio'}!="" ? $crh->{'AV - Radio'}:'','mdName'=>'AV-Radio')
);
}else{
$mediaTabArray=$mediaArray;
$dynamicmname=array();
}
//echo"<pre>";
    //print_r($allTrainData);
   // exit;
@endphp
<div class="card-body">
     <div class="table-responsive">
     <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%"> 
     <thead>
      <tr>
            <td align="center" colspan="6"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                <p><strong>GOVERNMENT OF INDIA <br />
                        BUREAU OF OUTREACH & COMMUNICATION<br />
                        Ministry of Information & Broadcasting</strong><br />
                    Phase IV, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                </p>
            </td>
        </tr>
    </thead>
    </table>
      <table class="table table-striped table-bordered table-hover order-list" id="myTable" width="100%">   
        <tbody>
        <tr>
            <!-- <td colspan="6">
            <h3><strong style="align:left"> Basic Information </strong></h3>
            </td> -->
        </tr>
        <tr>
                        <td><strong>Ministry Head</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$mhead->{'Ministries Head'} ?? ''}}, ({{@$dbresponse->ministry_name ?? ''}}) <br /> {{@$mhead->{'Head Name'} ?? ''}}</td>
                        <td><strong>Officer Name</strong></td>
                        <td width="10px"><strong>:</strong></td>
                        <td width="200px">{{@$crh->{'Requesting officer Name'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Designation</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$crh->{'Designation'} ?? '' }}</td>
                        <td><strong>E-Mail Id </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$crh->{'Email Id'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Govt E-mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$crh->{'Govt E-mail ID'} ?? '' }}</td>
                        <td><strong>Mobile No</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$crh->{'Mobile No_'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone No(with STD code)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$crh->{'Phone No_'} ??''}}</td>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$crh->Address ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Department file. Ref. No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $crh->{'Client Refrence No_'} ?? '' }}</td>
                        <td><strong>Campaign type</strong></td>
                        <td ><strong>:</strong></td>
                        @php
                            $capi='';
                        if(@$crh->{'Campaign Type'} == 0 && @$crh->{'Campaign Type'} != "") {
                            $capi ='Single media';
                        }elseif(@$crh->{'Campaign Type'} == 1 && @$crh->{'Campaign Type'} != ""){
                            $capi ='Multiple media';
                        }else{
                            $capi='';
                        }
                        @endphp
                        <td>{{$capi}}</td>
                    </tr><tr>
                        <td><strong>Media name</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">@foreach($mediaArray as  $key => $md)
                    @if(in_array( $md['mdNameVal'], str_replace(' ', '', $dynamicmname)))
                     {{$md['mdName']}} ,
                     @endif
                    @endforeach </td>
                    </tr>
        
        @if(@$crh->Print == 0)
        
                        @else
        <tr>
            <td colspan="6">
            <hr /> 
            </td>
        </tr>
        <tr>
                <td><strong>Publication start date </strong></td>
                    <td><strong>:</strong></td>
                    
                    <td >{{ date('d-m-Y',strtotime(@$prch->{'Publication From Date'})) && date('d-m-Y',strtotime(@$prch->{'Publication From Date'}))!='01-01-1970'  ?date('d-m-Y',strtotime(@$prch->{'Publication From Date'})): '' }}</td>
                <td><strong>Publication end date </strong></td>
                    <td><strong>:</strong></td>
                    
                    <td >{{ date('d-m-Y',strtotime(@$prch->{'Publication  To Date'})) && date('d-m-Y',strtotime(@$prch->{'Publication  To Date'}))!='01-01-1970' ?date('d-m-Y',strtotime(@$prch->{'Publication  To Date'})): '' }}</td>
                    
            </tr>
            <tr>

                <td><strong>Media plan type</strong></td>
                 <td><strong>:</strong></td>
         @php 
         $data ='';        
        if(@$prch->{'Media Plan Type'} == 0 && @$prch->{'Media Plan Type'} != "" ){
            $data ="Single Plan";
        }elseif(@$prch->{'Media Plan Type'} == 1 && @$prch->{'Media Plan Type'} != "" ){
            $data ="Multiple Plan"; 
        }else{
            $data ='';
        }
        @endphp
       
        <td>{{ $data }} </td> 
        <td><strong>Size</strong></td>
                <td><strong>:</strong></td>
        @php 
        $print_size ='';
        if(@$prch->{'Print Size Selection'} ==0 && @$prch->{'Print Size Selection'} != ""  ){
            $print_size ="Custom size";
        }elseif(@$prch->{'Print Size Selection'} ==1 && @$prch->{'Print Size Selection'} != ""){
            $print_size ="Half Page Horizontal";
        }elseif(@$prch->{'Print Size Selection'} ==2 && @$prch->{'Print Size Selection'} != ""){
            $print_size ="Full Page";
        }elseif(@$prch->{'Print Size Selection'} ==3 && @$prch->{'Print Size Selection'} != "" ){
            $print_size ="Half Page Vertical";
        }elseif(@$prch->{'Print Size Selection'} ==4 && @$prch->{'Print Size Selection'} != ""){
            $print_size ="Quarter Page";
        }else{
            $print_size ='';
        }
        @endphp
        <td >{{ $print_size }} </td>   
    </tr>
        <tr>  
                <td><strong>Advertise length(Cm.)</strong></td>
                    <td><strong>:</strong></td>
                    
                    <td >{{$Length}}</td>
                <td><strong>Advertise breadth(Cm.)</strong></td>
                    <td><strong>:</strong></td>
                    
                    <td >{{$Breadth }}</td>
                    
            </tr>
            <tr>
                <td><strong>Advertise area(Sq Cm)</strong></td>
                    <td><strong>:</strong></td>
                    <td >{{ $SizeofAdvt }}</td>
                <td><strong>Color</strong></td>
                    <td><strong>:</strong></td>
                    @php
                    $Colorp ='';
                   if(@$prch->{'Color'} ==0 && @$prch->{'Color'} != ""){$Colorp ="Color";}
                   elseif(@$prch->{'Color'} ==1 && @$prch->{'Color'} != ""){$Colorp ="B/W";}
                   else{$Colorp ='';}
                   @endphp
                    <td >{{ $Colorp }}</td>

            </tr>
          
            
           <tr>
           <td><strong>Budget</strong></td>
                    <td><strong>:</strong></td>
                    <td >{{ round(@$prch->{'Print Budget'}) && round(@$prch->{'Print Budget'})!=0? round(@$prch->{'Print Budget'}):'' }}</td>
           <td><strong>Target area</strong></td>
                    <td><strong>:</strong></td>
                    @php
                    $target_area ='';
                    if(@$prch->{'Target Area'} ==0 && @$prch->{'Target Area'} != ""){
                        $target_area ="Pan India";
                    }elseif(@$prch->{'Target Area'} ==1 && @$prch->{'Target Area'} != ""){
                        $target_area ="Individual State";
                    }elseif(@$prch->{'Target Area'} ==2 && @$prch->{'Target Area'} != ""){
                        $target_area ="Group of States";
                    }elseif(@$prch->{'Target Area'} ==3 && @$prch->{'Target Area'} != ""){
                        $target_area ="Cities";
                    }else{
                        $target_area ='';
                    }
                    @endphp
                    <td >{{$target_area }}</td>
            </tr>
            <tr>
            @if(@$prch->{'Target Area'} ==2 && @$prch->{'Target Area'} != "")
                <td><strong>Group of states</strong></td>
                    <td><strong>:</strong></td>
                    <td >
                    @foreach($states as $key => $state)
                    @if(in_array( $state->Code, str_replace(' ', '', $printStateSelectionData1)))
                    {{$state->Description}}, 
                    @endif
                    @endforeach
                    </td>
            @elseif(@$prch->{'Target Area'} == 1 && @$prch->{'Target Area'} != "")
                <td><strong>Individual state</strong></td>
                    <td><strong>:</strong></td>
                    <td> @foreach($states as $state)
                    @if(@$prch->{'State'} === $state->Code)
                    {{$state->Code}} ~ {{$state->Description}}
                    @endif
                    @endforeach</td>
            @elseif(@$prch->{'Target Area'} ==3 && @$prch->{'Target Area'} != "")
                <td><strong>Group of Cities</strong></td>
                    <td><strong>:</strong></td>
                    <!-- @php $City_Groups =''; @endphp             
                    @if(@$prch->{'City Groups'} ==0 && @$prch->{'City Groups'} != "") $City_Groups ="Metro";
                    @elseif(@$prch->{'City Groups'} ==1 && @$prch->{'City Groups'} != "") $City_Groups ="Capital" ;
                    @elseif(@$prch->{'City Groups'} ==2 && @$prch->{'City Groups'} != "" ) $City_Groups ="Class A";
                    @elseif(@$prch->{'City Groups'} ==3 && @$prch->{'City Groups'} != "") $City_Groups ="Class B";
                    @elseif(@$prch->{'City Groups'} ==4 && @$prch->{'City Groups'} != "") $City_Groups ="Class C";
                    @elseif(@$prch->{'City Groups'} ==5 && @$prch->{'City Groups'} != "") $City_Groups ="Random";
                    @else $City_Groups ='';
                    
                    @endif -->
                    <td>
                    @foreach($IndianCi as $indcity)
                    @if($indcity->{'City Class'} == @$prch->{'City Groups'})
                    @php $namecity = strtolower($indcity->{'Name'}) @endphp
                    {{ucwords($namecity) ?? ''}}
                    @endif
                    @endforeach
                    </td>
            @else
            <td><strong></strong></td>
                    <td><strong>:</strong></td>
            <td></td>
            @endif
             <td><strong>Language(S/M)</strong></td>
                    <td><strong>:</strong></td>
                    @if(@$prch->{'Language'} == "0")
                    <td>Single</td>
                    @elseif(@$prch->{'Language'} == "1")
                    <td>Multiple</td>
                    @elseif(@$prch->{'Language'} == "2")
                    <td>Hindi & English</td>
                    @elseif(@$prch->{'Language'} == "3")
                    <td >State Language Preference</td>
                    @else
                    <td></td>
                    @endif
            </tr> 
            <tr>
            @if(@$prch->{'Language'} == 0 && @$prch->{'Language'} != "")
                
                <td><strong>Single language</strong></td>
                    <td><strong>:</strong></td>
                    <td> @php $i = 1; @endphp
                    @foreach($languages as  $language)
                    @if(in_array( $language->Code, str_replace(' ', '', $langSelectionData1 )))
                     {{$language->Code}} ~ {{$language->Name}}
                    @endif
                   @php
                   $i++;
                   @endphp
                    @endforeach
                    </td>

            @elseif(@$prch->{'Language'} == "1" && @$prch->{'Language'} != "")
                <td ><strong>Multiple Language</strong></td>
                    <td><strong>:</strong></td>
                    @php $i = 1; @endphp
                    <td>
                    @foreach($languages as $key => $language) 
                    @if(in_array( $language->Code, str_replace(' ', '', $langSelectionData1)))
                     {{$language->Name}}, 
                    @endif
                    @endforeach
                    </td>
            @elseif(@$prch->{'Language'} == 2 && @$prch->{'Language'} != "")
           
                <td><strong>Language Hindi & English</strong></td>
                    <td><strong>:</strong></td>
                   @php $hindi="Hindi"; $english ="English"; @endphp
                    <td width="200px">{{$hindi}} ~ {{$english}}</td>
            @else
            @endif
            <td><strong>Random cities</strong></td>
                    <td><strong>:</strong></td>
                    <td width="200px"> @foreach($allCityData as $allCity)
                    @if(in_array($allCity->CityName,str_replace(' ', '',$printCitySelectionData1) ))
                    @php $allc =strtolower($allCity->CityName) @endphp
                    {{ucwords($allc)}},
                    @endif
                    @endforeach
                    </td> 
            </tr>
            <tr>
            <td><strong>Demography</strong></td>
                    <td><strong>:</strong></td>
                    <td >{{ @$prch->{'Demography'} ?? '' }}</td>
            <td><strong>No. Of Plan</strong></td>
                    <td><strong>:</strong></td>
                    <td >{{@$pcount }}</td>
            </tr>
            <tr>
            <td><strong>Requirement(s)</strong></td>
                    <td><strong>:</strong></td>
                    <td >{{ @$prch->{'Requirement'}?? ''}}</td>
            <td><strong>Remarks for revision</strong></td>
                    <td><strong>:</strong></td>
                    <td >{{ @$prch->{'Remarks'}?? ''}}</td>
             </tr>
        <tr>
        <!-- <td><strong>Is creative available</strong></td>
        @php $creative_Avail =""; @endphp            <td><strong>:</strong></td>
        @if(@$prch->{'Creative Availability'} == 0 && @$prch->{'Creative Availability'} != "" ) $creative_Avail ="Available";
        @elseif(@$prch->{'Creative Availability'} == 1 && @$prch->{'Creative Availability'} != "") $creative_Avail ="Not Available";
        @elseif(@$prch->{'Creative Availability'} == 2 && @$prch->{'Creative Availability'} != "")
        $creative_Avail ="Creative to be developed by BOC";
        @elseif(@$prch->{'Creative Availability'} == 3 && @$prch->{'Creative Availability'} != "" )
        $creative_Avail ="Photographs Available";
        @else $creative_Avail ="";
        @endif
                    <td >{{$creative_Avail}}</td> -->
                    @if(@$prch->{'Creative Availability'} == 0 && @$prch->{'Creative Availability'} != '')
                    <td><strong>Uploaded creative</strong></td>
                    <td><strong>:</strong></td> 
                    <td colspan="4">{{ (@$prch->{'Crative File Name'} !='')? "Yes" : "No" }} </td>  
                 @endif
            
                 
             </tr>
             <tr>
             <td><strong>Advertisement display type</strong></td>
                    <td><strong>:</strong></td> 
            
                @if(@$prch->{'Advertisement Type'} == 0 && @$prch->{'Advertisement Type'} != "")
                 <td >Classified </td> 
                @elseif(@$prch->{'Advertisement Type'} == 1 && @$prch->{'Advertisement Type'} != "" )
                 <td >Display</td> 
                @elseif(@$prch->{'Advertisement Type'} == 2 && @$prch->{'Advertisement Type'} != "")
                <td >UPSC</td> 
                @else <td > </td> 
                @endif
                 
             <td><strong>Highlight</strong></td>
                    <td><strong>:</strong></td> 
                    <td>{{@$prch->{'Highlight'} ?? 'N/A'}}</td> 
             </tr>
        
         
        @endif
        
        @if($crh->Outdoor == 0)
@else
        <tr>
            <td colspan="6">
            <hr />
            </td>
        </tr>
<tr>
    <td><strong>Publication start date </strong></td>
        <td><strong>:</strong></td>
        
        <td >{{ date('d-m-Y',strtotime(@$codm[0]->{'From Date'})) && date('d-m-Y',strtotime(@$codm[0]->{'From Date'}))!='01-01-1970'  ? date('d-m-Y',strtotime(@$codm[0]->{'From Date'})) : 'N/A' }}</td>
    <td><strong>Publication end date </strong></td>
        <td><strong>:</strong></td>
        <td >{{ date('d-m-Y',strtotime(@$codm[0]->{'To Date'})) && date('d-m-Y',strtotime(@$codm[0]->{'To Date'}))!='01-01-1970' ?date('d-m-Y',strtotime(@$codm[0]->{'To Date'})): 'N/A'}}</td>
</tr>
<tr>
    <td><strong>Tentative budget</strong></td>
        <td><strong>:</strong></td>
        <td colspan="4">{{round(@$codm[0]->{'OD Budget'}) && round(@$codm[0]->{'OD Budget'})!=0 ? round(@$codm[0]->{'OD Budget'}) :'N/A'}}</td>
</tr>
@foreach(@$codm as $key=>$codmDetail)
<tr>
    <td><strong>Media category</strong></td>
        <td><strong>:</strong></td>
        @if(@$codmDetail->{'Category Group'} ==0 && @$codmDetail->{'Category Group'} != "")<td  >Airport</td>
        @elseif(@$codmDetail->{'Category Group'} ==1 && @$codmDetail->{'Category Group'} != "")
        <td >Railways</td>
        @elseif(@$codmDetail->{'Category Group'} ==2 && @$codmDetail->{'Category Group'} != "") <td >Road side </td>
        @elseif(@$codmDetail->{'Category Group'} ==3 && @$codmDetail->{'Category Group'} != "") <td >Transit Media </td>
        @elseif(@$codmDetail->{'Category Group'} ==4 && @$codmDetail->{'Category Group'} != "") <td >Others</td>
        @elseif(@$codmDetail->{'Category Group'} ==5 && @$codmDetail->{'Category Group'} != "") <td >Metro</td>
        @elseif(@$codmDetail->{'Category Group'} ==6 && @$codmDetail->{'Category Group'} != "") <td >Bus & Station</td>
        @else <td ></td>
        @endif
    <td><strong>Target area</strong></td>
        <td><strong>:</strong></td>
            @if(@$codmDetail->{"Target Area"} ==0 && @$codmDetail->{"Target Area"} != "" ) 
            <td >Pan India</td>
            @elseif(@$codmDetail->{"Target Area"} ==1 && @$codmDetail->{"Target Area"} != "") 
            <td >Individual State</td>
            @elseif(@$codmDetail->{"Target Area"} ==2 && @$codmDetail->{"Target Area"} != "") 
            <td >Group States</td>
            @elseif(@$codmDetail->{"Target Area"} ==3 && @$codmDetail->{"Target Area"} != "") 
            <td >Group City</td>
            @elseif(@$codmDetail->{"Target Area"} ==4 && @$codmDetail->{"Target Area"} != "") 
            <td >City/Town</td>
            @else <td></td>
            @endif      
    </tr>
    <tr>
@if(@$codmDetail->{"Target Area"} ==2 && @$codmDetail->{"Target Area"} != "")

    <td><strong>Group of states</strong></td>
        <td><strong>:</strong></td>
        <td colspan="4">
        @foreach($states as $key => $state)
        @if(in_array( $state->Code, str_replace(' ', '', explode(',', @$codmDetail->{'Multiple StateName'}) ))) 
        {{$state->Description}}, 
        @endif
        @endforeach
    </td>
@elseif(@$codmDetail->{"Target Area"} ==3 && @$codmDetail->{"Target Area"} != "")
    <td><strong>Group of Cities</strong></td>
        <td><strong>:</strong></td>
        <!-- @if(@$codmDetail->{"City Groups"} ==0 && @$codmDetail->{"City Groups"} != "") <td colspan="4">Metro</td>
        @elseif(@$codmDetail->{"City Groups"} ==1 && @$codmDetail->{"City Groups"} != "") 
        <td colspan="4">Capital</td>
        @elseif(@$codmDetail->{"City Groups"} ==2 && @$codmDetail->{"City Groups"} != "")
        <td colspan="4">lass A</td>
        @elseif(@$codmDetail->{"City Groups"} ==3 && @$codmDetail->{"City Groups"} != "") 
        <td colspan="4">Class B</td>
        @elseif(@$codmDetail->{"City Groups"} ==4 && @$codmDetail->{"City Groups"} != "") 
        <td colspan="4">Class C</td>
        @elseif(@$codmDetail->{"City Groups"} ==5 && @$codmDetail->{"City Groups"} != "") 
        <td colspan="4">Random</td>
        @else <td colspan="4"></td>
        @endif -->
        <td colspan="4">
        @foreach($IndianCi as $indcity)
        @if($indcity->{'City Class'} == @$codmDetail->{"City Groups"})
        @php $namecity = strtolower($indcity->{'Name'}) @endphp
        {{ucwords($namecity) ?? ''}}
        @endif

        @endforeach
        </td>

@elseif(@$codmDetail->{"Target Area"} ==1 && @$codmDetail->{"Target Area"} != "") 

    <td><strong>Individual state</strong></td>
        <td><strong>:</strong></td>
        <td colspan="4">
        @foreach($states as $state)
        @if(@$codmDetail->{'State'} == $state->Code ) 
        {{$state->Code}} ~ {{$state->Description}}
        @endif
        @endforeach     
        </td>
@elseif(@$codmDetail->{"Target Area"} ==4 && @$codmDetail->{"Target Area"} != "")
    <td><strong>City</strong></td>
        <td><strong>:</strong></td>
        <td colspan="4">{{$codmDetail->{'City'} }} </td>
@elseif(@$codmDetail->{"Target Area"} ==0 && @$codmDetail->{"Target Area"} != "" )
<td><strong></strong></td>
        <td><strong>:</strong></td>
        <td colspan="4"> N/A</td>
@else
<td><strong></strong></td>
        <td><strong>:</strong></td>
        <td colspan="4"> N/A</td>
@endif 
</tr>  
@endforeach
<tr>
    <td><strong>Requirements</strong></td>
        <td><strong>:</strong></td>
        <td colspan="4">{{@$codm[0]->{'Requirement'} ?? ''}}</td>
 </tr>
<tr>
<td><strong>Uploaded creative</strong></td>
        <td><strong>:</strong></td>
@if(@$codm[0]->{'Creative Availability'} == 0 && @$codm[0]->{'Creative Availability'} != "")
    
        <td >{{ @$codm[0]->{'Creative File Name'} !='' ? 'Yes':'N/A' }}</td>
@else 
<td >N/A</td>
@endif

    <td><strong>Language</strong></td>
        <td><strong>:</strong></td>
        @if(@$codm[0]->{'Language'} == 0 && @$codm[0]->{'Language'} != "") 
        <td>Hindi</td>
        @elseif(@$codm[0]->{'Language'} == 1 && @$codm[0]->{'Language'} != "")
        <td>English</td> 
        @else<td></td>
        @endif
</tr>
@endif
    @if(@$crh->{'AV - TV'} == 0)  
    @else  
    <tr>
        <td colspan="6">
        <hr />
        </td>
    </tr>  
    <tr>
            <td><strong>Publication start date</strong></td>
                <td><strong>:</strong></td>
                     <td >{{ date('d-m-Y',strtotime(@$tvcr->{'From Date'})) && date('d-m-Y',strtotime(@$tvcr->{'From Date'}))!='01-01-1970' ? date('d-m-Y',strtotime(@$tvcr->{'From Date'})) :'N/A' }}</td> 
            <td><strong>Publication end date</strong></td>
                <td><strong>:</strong></td>
                     <td >{{ date('d-m-Y',strtotime(@$tvcr->{'To Date'})) && date('d-m-Y',strtotime(@$tvcr->{'To Date'}))!='01-01-1970' ? date('d-m-Y',strtotime(@$tvcr->{'To Date'})):'N/A' }}</td>  
        </tr>
        <tr>
            <td><strong>Size</strong></td>
                <td><strong>:</strong></td>
                    @if(@$tvcr->{'Target Area'} == "0" && @$tvcr->{'Target Area'} != "") 
                    <td >PAN India</td>
                    @elseif(@$tvcr->{'Target Area'} == "1" && @$tvcr->{'Target Area'} != "") 
                    <td >Specific Regional</td>
                    @elseif(@$tvcr->{'Target Area'} == "2" && @$tvcr->{'Target Area'} != "") 
                    <td >Group Regional</td>
                    @else <td ></td> 
                    @endif
        
            <td><strong>Tentative budget</strong></td>
                <td><strong>:</strong></td>
                   <td >{{round(@$tvcr->{'Allocated Budget'}) && round(@$tvcr->{'Allocated Budget'})!=0 ? round(@$tvcr->{'Allocated Budget'}) :'N/A'}}</td>    
        </tr>
        <tr>
        @if(@$tvcr->{'Target Area'} == "1" && @$tvcr->{'Target Area'} != "" )
        
            <td><strong>Specific Regional</strong></td>
                <td><strong>:</strong></td>
                <td >
                @foreach($regionalLang as $regionLang)
                @if(in_array( $regionLang->Code, str_replace(' ', '', $tvLangSelectionData ))) {{$regionLang->Code}} ~ {{$regionLang->Name}}
                @endif
                @endforeach
                </td>
        
        @elseif(@$tvcr->{'Target Area'} == "2" && @$tvcr->{'Target Area'} != "")
        
            <td><strong>Group Regional </strong></td>
                <td><strong>:</strong></td>
                <td >
                @foreach($regionalLang as $regionLang)
                @if(in_array( $regionLang->Code, str_replace(' ', '', $tvLangSelectionData ))) {{$regionLang->Code}} ~ {{$regionLang->Name}}
                @endif
                @endforeach
                </td>
        @elseif(@$tvcr->{'Target Area'} == "0" && @$tvcr->{'Target Area'} != "")

        @endif

     
            <td><strong>Duration(in seconds)</strong></td>
                <td><strong>:</strong></td>
               <td >{{@$tvcr->{'Duration'} ?? ''}}</td>
        </tr>
        <tr>
            <td><strong>Spots No.</strong></td>
                <td><strong>:</strong></td>
               <td >{{@$tvcr->{'Spot Per Day'} ?? ''}}</td>
        
            <td><strong>Genre</strong></td>
                <td><strong>:</strong></td>
                @if(@$tvcr->{'Genre Category'} =='0') <td> Both</td>
                @elseif(@$tvcr->{'Genre Category'} =='1') <td>GEC</td>
                @elseif(@$tvcr->{'Genre Category'} =='2') <td>Non-GEC</td>
                @else <td ></td>
                @endif
        </tr>
        <tr>
            <td><strong>Requirement(s) (1000 characters max)</strong></td>
                <td><strong>:</strong></td>
               <td >{{@$tvcr->{'Requirement'} ?? ''}}</td>
            <td><strong>Remarks (100 characters max)</strong></td>
                <td><strong>:</strong></td>
               <td >{{@$tvcr->{'Remarks'} ?? ''}}</td>
        </tr>
        <tr>
            <!-- <td><strong>Is advertisement available</strong></td>
                <td><strong>:</strong></td>
                @if(@$tvcr->{'Creative Available'} == 0 && @$tvcr->{'Creative Available'} != "") 
                <td >Available</td>
                @elseif(@$tvcr->{'Creative Available'} == 1 && @$tvcr->{'Creative Available'} != "") <td >Not Available</td>
                @else <td ></td>
                @endif -->
       
            @if(@$tvcr->{'Creative Available'} == 0 && @$tvcr->{'Creative Available'} != "")        
      
            <td><strong>Uploaded advertisement</strong></td>
                <td><strong>:</strong></td>
                <td colspan="4">{{ $tvcr->{'Creative File Name'} !='' ? 'Yes':'N/A' }}</td>
        
        @endif 
        </tr>        
    @endif
@if(@$crh->{'AV - Radio'} == 0)
    @else
    <tr>
        <td  colspan="6">
           <hr />
        </td>
    </tr>
    <tr>
            <td><strong>Publication start date</strong></td>
                <td><strong>:</strong></td>
                     <td >{{ date('d-m-Y',strtotime(@$crsRadiocr->{'From Date'})) && date('d-m-Y',strtotime(@$crsRadiocr->{'From Date'}))!='01-01-1970' ?date('d-m-Y',strtotime(@$crsRadiocr->{'From Date'})): 'N/A' }}</td> 
        
            <td><strong>Publication end date</strong></td>
                <td><strong>:</strong></td>
                     <td >{{ date('d-m-Y',strtotime(@$crsRadiocr->{'To Date'})) && date('d-m-Y',strtotime(@$crsRadiocr->{'To Date'}))!='01-01-1970' ?date('d-m-Y',strtotime(@$crsRadiocr->{'To Date'})): 'N/A' }}</td>  
        </tr>    
        <tr>
            <td><strong>Advertisement Medium</strong></td>
                <td><strong>:</strong></td>
                    @if(@$crsRadiocr->{'Radio Type'} ==0 && @$crsRadiocr->{'Radio Type'} != "") 
                    <td >CRS</td>
                    @elseif(@$crsRadiocr->{'Radio Type'} ==1 && @$crsRadiocr->{'Radio Type'} != "") 
                    <td >PVT. FM</td>
                    @else <td></td> 
                    @endif
            <td><strong>Target Area</strong></td>
                <td><strong>:</strong></td>
                    @if(@$crsRadiocr->{'Target Area'} == "0" && @$crsRadiocr->{'Target Area'} != "") 
                    <td >PAN India</td>
                    @elseif(@$crsRadiocr->{'Target Area'} == "1" && @$crsRadiocr->{'Target Area'} != "") <td >Specific Regional</td>
                    @elseif(@$crsRadiocr->{'Target Area'} == "2" && @$crsRadiocr->{'Target Area'} != "") 
                    <td >Group Regional</td>
                    @else <td ></td>
                    @endif              
        </tr>
        <tr>
            <td><strong>Tentative budget</strong></td>
                <td><strong>:</strong></td>
               <td>{{round(@$crsRadiocr->{'Budget Amount'}) && round(@$crsRadiocr->{'Budget Amount'})!=0 ? round(@$crsRadiocr->{'Budget Amount'}) :''}}</td>
        @if(@$crsRadiocr->{'Target Area'} == "1" && @$crsRadiocr->{'Target Area'} != "")
            <td><strong>Specific Regional</strong></td>
                <td><strong>:</strong></td>
                @foreach($regionalLang as $regionLang)
                @if( in_array( $regionLang->Code, str_replace(' ', '', $radioLangSelectionData ))) 
                <td>{{$regionLang->Code}} ~ {{$regionLang->Name}}</td>
                @endif
                @endforeach
        @elseif(@$crsRadiocr->{'Target Area'} == "2" && @$crsRadiocr->{'Target Area'} != "") 
            <td><strong>Group Regional </strong></td>
                <td><strong>:</strong></td>
                @foreach($regionalLang as $regionLang)
                @if( in_array( $regionLang->Code, str_replace(' ', '', $radioLangSelectionData ))) 
                <td>{{$regionLang->Code}} ~ {{$regionLang->Name}}</td>
                @endif
                @endforeach
        @elseif(@$crsRadiocr->{'Target Area'} == "0" && @$crsRadiocr->{'Target Area'} != "") 
                <td><strong> </strong></td>
                <td><strong>:</strong></td>
                <td></td>
        @else

        @endif
           
        </tr>
        <tr>
        <td><strong>Duration(in seconds)</strong></td>
                <td><strong>:</strong></td>
               <td >{{@$crsRadiocr->{'Duration(Sec)'} ?? 'N/A'}}</td>
            <td><strong>Spots No.</strong></td>
                <td><strong>:</strong></td>
               <td >{{ @$crsRadiocr->spots ?? 'N/A'}}</td>
        </tr>
        <tr>
        <td><strong>Requirement(s) (1000 characters max)</strong></td>
                <td><strong>:</strong></td>
               <td >{{@$crsRadiocr->{'Requirement'} ?? 'N/A'}}</td>
                <td><strong> Remarks (100 characters max) </strong></td>
                <td><strong>:</strong></td>
               <td >{{@$crsRadiocr->{'Remarks'} ?? 'N/A'}}</td>
        </tr>
    
        <!-- <td><strong>Is advertisement available</strong></td>
                <td><strong>:</strong></td>
                @if(@$crsRadiocr->{'Creative Available'} == 0 && @$crsRadiocr->{'Creative Available'} != "") 
                <td>Available</td>
                @elseif(@$crsRadiocr->{'Creative Available'} == 1 && @$crsRadiocr->{'Creative Available'} != "") <td>Not Available</td>
                @else <td ></td>
                @endif -->
                @if(@$crsRadiocr->{'Creative Available'} == 0 && @$crsRadiocr->{'Creative Available'} != "")  
                <tr> 
            <td><strong>Uploaded advertisement</strong></td>
                <td><strong>:</strong></td>
                <td colspan="4"> {{ $crsRadiocr->{'Creative File Name'} !='' ? 'Yes':'N/A'}}</td>
                </tr>
                @endif
        
        @endif
          </tbody>
        </table>
    
      </div>
    
    </div>
</body>

</html>