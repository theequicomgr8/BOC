<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\clientRequest\printRequest;
use App\Http\Traits\clientRequest\outdoorRequest;
use App\Http\Traits\clientRequest\tvRequest;
use App\Http\Traits\clientRequest\crsRadioRequest;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Traits\clientRequestTableTrait;
class ClientController extends Controller
{
    use CommonTrait, printRequest, outdoorRequest, tvRequest, crsRadioRequest, clientRequestTableTrait;
    public function saveClientBasicInfo(Request $request)
    {
        $msg = ''; $data = array();
        $postData=$this->PostData($request);
        $sql = DB::table($this->tblClientRequestHeader)->updateOrInsert(['Client Request No'=> $postData['Client Request No']], $this->PostData($request));
        if($sql){
            $msg = 'Data Save Successfully!';$data = array('Client_ReqNo' => $postData['Client Request No']);
            return $this->sendResponse($data, $msg);
        }else{
            return $this->sendError('Some Error Occurred!.');
        }  
    }
    public function savePrintMedia(Request $request)
    {
        $msg = ''; $data = array();
        $sql = DB::table($this->tblPrintClientRequest)->updateOrInsert(['Client Request No_'=> $request->Client_ReqNo], $this->PostData($request));
        if($sql){

            $this->deleteAllPrintSelection($request);
            $this->savePrintStateAndCity($request);
            $this->savePrintLanguage($request);
            $this->sendMailToClientForPrint($request);
            $msg = 'Data Save Successfully!';$data = array('Client_ReqNo' => $request->Client_ReqNo);
            return $this->sendResponse($data, $msg);
        }else{
            return $this->sendError('Some Error Occurred!.');
        }  
    }
    public function saveOutdoorMediaDetail(Request $request){
        foreach ($request->outdoorTArea as $skey => $svalue) {
            $outdoorTArea =isset($request->outdoorTArea[$skey]) ? $request->outdoorTArea[$skey] : '';
            if ($outdoorTArea!='' || $outdoorTArea!=null) {
                $line_no = DB::select('select TOP 1 [Line No_] from dbo.[BOC$OD Media Request$3f88596c-e20d-438c-a694-309eb14559b2] order by [Line No_] desc');
                if(empty($line_no)) {
                    $line_no = 10000;
                }else {
                    $line_no = $line_no[0]->{"Line No_"}; $line_no = $line_no + 10000;
                }
               $outdoorGroupState= isset($request->outdoorGroupState[$skey]) && $request->outdoorGroupState[$skey]!=NULL  ? $request->outdoorGroupState[$skey]:[];
               $outdoorGroupCity= isset($request->outdoorGroupCity[$skey]) && $request->outdoorGroupCity[$skey]!=NULL ? $request->outdoorGroupCity[$skey]:[];
               $outdoorRandomCityList= isset($request->outdoorRandomCityList[$skey]) && $request->outdoorRandomCityList[$skey]!=NULL ? $request->outdoorRandomCityList[$skey]:[];
                $this->saveOutdoorStateAndCitySelection( $request->outdoorTArea[$skey], $outdoorGroupState, $request->Client_ReqNo, $line_no, $outdoorGroupCity, $outdoorRandomCityList );
                
                $outdoorCityWithState =
                isset($request->outdoorCityWithState[$skey]) ? $request->outdoorCityWithState[$skey] : 'off';
                if ( ($outdoorCityWithState == 'on' || $outdoorCityWithState == '1') && ($request->outdoorTArea == "1") ) {
                    $outdoorCityWithState = 1;
                } else {
                    $outdoorCityWithState = 0;
                }
                $oddetailArr=array(
                  'Client Request No'=>$request->Client_ReqNo,
                  'Line No_'=>$line_no,
                  'Target Area'=> isset($request->outdoorTArea[$skey])? $request->outdoorTArea[$skey]:0,
                  'Length'=> isset($request->outdoorAdvLength[$skey])? $request->outdoorAdvLength[$skey]:0,
                  'Breadth'=>isset($request->outdoorAdvBreadth[$skey])? $request->outdoorAdvBreadth[$skey] :0,
                  'Advt_ Area'=>isset($request->outdoorAdvArea[$skey])? $request->outdoorAdvArea[$skey] :0,
                  'Category Group'=>isset($request->outdoorMediaCategory[$skey])? $request->outdoorMediaCategory[$skey]:0,
                  'Category Sub Grp ID'=>isset($request->outdoorMediaSubCategory[$skey])?$request->outdoorMediaSubCategory[$skey]:'',
                  'No_ Of Spots'=>isset($request->outdoorSpotsno[$skey])?$request->outdoorSpotsno[$skey]:0,
                  'Zone'=>isset($request->outdoorZone[$skey])? $request->outdoorZone[$skey] :'',
                  'Postal Code'=>isset($request->outdoorPostalCode[$skey])?$request->outdoorPostalCode[$skey] :'',
                  'City Groups'=>isset($request->outdoorGroupCity[$skey])? $request->outdoorGroupCity[$skey]:0,
                  'City'=>isset($request->outdoorTown[$skey])?$request->outdoorTown[$skey]:'',
                  'State With City'=>$outdoorCityWithState,
                  'District'=> isset($request->outdoorDistrict[$skey])?$request->outdoorDistrict[$skey]:'',
                  'State'=> isset($request->outdoorIndividualState[$skey])?$request->outdoorIndividualState[$skey]:'',
                  'Start Date'=>'',
                  'End Date'=>'',
                  'Multiple StateName'=>isset($request->outdoorGroupState[$skey])? implode(',',$request->outdoorGroupState[$skey]):'',
                  'Multiple CityName'=>isset($request->outdoorRandomCityList[$skey])? implode(',',$request->outdoorRandomCityList[$skey]):'',
                  'Average Budget(_)'=>0,
                  'Budget Allocation'=>0,
                  'Group Budget(_)'=>0,
                  'Group Budget Allocation(_)'=>0,
                  'Group Budget Amt'=>0,
                  'Category Budget Amt'=>0,
                  'Train Number'=>isset($request->outdoortrain[$skey])?$request->outdoortrain[$skey]:'',
                );
               $sql = DB::table($this->tblODMediaRequest)->updateOrInsert(['Line No_'=>$line_no], $oddetailArr);
            }
        }
        if($sql){
            return true;
        }else{
            return false; 
        }         
        
    }
    public function saveOutdoorMedia(Request $request)
    {
        $msg = ''; $data = array();
        $sql = DB::table($this->tblODMediaRequestHeader)->updateOrInsert(['Client Request No'=> $request->Client_ReqNo], $this->PostData($request));  
        $oddetailsql2=$this->saveOutdoorMediaDetail($request);
        if ($sql && $oddetailsql2) {
            $this->sendMailToClientForOutdoor($request);
            $msg = 'Data Save Successfully!';$data = array('Client_ReqNo' => $request->Client_ReqNo);
            return $this->sendResponse($data, $msg);
        }else {
            return $this->sendError('Some Error Occurred!.'); exit;
        }
    }
     public function saveTvMedia(Request $request)
    {
        $msg = ''; $data = array();
        $sql = DB::table($this->tblAVMedia)->updateOrInsert(['Client Request No'=> $request->Client_ReqNo], $this->PostData($request));  
        if ($sql) {
            $this->deleteAlltvSelection($request);
            $this->savetvRegLangAndGenre($request);
           $this->sendMailToClientFortv($request);
            $msg = 'Data Save Successfully!';$data = array('Client_ReqNo' => $request->Client_ReqNo);
            return $this->sendResponse($data, $msg);
        }else {
            return $this->sendError('Some Error Occurred!.'); exit;
        }
    }
    public function savecrsRadioMedia(Request $request)
    {
        $msg = ''; $data = array();
        $sql = DB::table($this->tblRadioMediaRequest)->updateOrInsert(['Client Request No'=> $request->Client_ReqNo], $this->PostData($request));  
        if ($sql) {
            $this->deleteAllcrsRadioSelection($request);
            $this->savecrsRadioRegLangAndGenre($request);
            $this->sendMailToClientForcrsRadio($request);
            $msg = 'Data Save Successfully!';$data = array('Client_ReqNo' => $request->Client_ReqNo);
            return $this->sendResponse($data, $msg);
        }else {
            return $this->sendError('Some Error Occurred!.'); exit;
        }
    }
    public function PostData(Request $request)
    {
        if ($request->nextTabName == 'Basic Information') {
            $printmVal=0;
            $outdoormVal=0;
            $TVMVal=0;
            $crsRadioMVal=0;
            $medialength=count($request->media_name_s);
            //dd($request->media_name_s);
            foreach ($request->media_name_s as $key => $value) {
               if($value==1 && $medialength==1 || $value==1 && $medialength>1){
                $printmVal=1;
               }else if($value==2 && $medialength==1 || $value==2 && $medialength>1){
                $outdoormVal=1;
               }else if($value==3 && $medialength==1 || $value==3 && $medialength>1){
                $TVMVal=1;
               }else if($value==4 && $medialength==1 || $value==4 && $medialength>1){
                $crsRadioMVal=1;
               }
            }
           //media type single case
            if($request->Client_ReqNo == '' && $request->Campaign_Type=="0") {
                if( $printmVal =="1"){
                      $CLRNUM = 'OMRAD'.date('Y').date('m');
                }elseif($outdoormVal =="1"){
                     $CLRNUM = 'OMROP'.date('Y').date('m');
                }
                elseif($TVMVal =="1"){
                     $CLRNUM = 'OMRAV'.date('Y').date('m');
                }
                elseif($crsRadioMVal =="1"){
                     $CLRNUM = 'OMRAV'.date('Y').date('m');
                }
       
                $reqN1 = DB::table('BOC$Client Request Header$3f88596c-e20d-438c-a694-309eb14559b2')->select('Client Request No')->where('Client Request No', 'LIKE', '%'.'OMR'.'%')->orderBy('Client Request No','DESC')->get();
                if (empty($reqN1)) {
                     $num = 1;
                    $serno = str_pad($num, 4, "0", STR_PAD_LEFT);
                    $req_number = $CLRNUM.$serno;
                }else {
                    $old_control_serno=substr($reqN1[0]->{"Client Request No"},11, 5);
                    $db_serno=$old_control_serno+1;
                    $serno = str_pad($db_serno, 4, "0", STR_PAD_LEFT);
                    $req_number = $CLRNUM.$serno;
                } 
            }else{
                $req_number=$request->Client_ReqNo;
            }
            //medai type multiple case
            if($request->Client_ReqNo == '' && $request->Campaign_Type=="1" ) {
                if( $medialength =="1"){
                      $CLRNUM = 'OMRM1'.date('Y').date('m');
                }elseif($medialength =="2"){
                     $CLRNUM = 'OMRM2'.date('Y').date('m');
                }
                elseif($medialength =="3"){
                     $CLRNUM = 'OMRM3'.date('Y').date('m');
                }
                elseif($medialength =="4"){
                     $CLRNUM = 'OMRM4'.date('Y').date('m');
                }
       
                $reqN1 = DB::table('BOC$Client Request Header$3f88596c-e20d-438c-a694-309eb14559b2')->select('Client Request No')->where('Client Request No', 'LIKE', '%'.'OMR'.'%')->orderBy('Client Request No','DESC')->get();
                if (empty($reqN1)) {
                     $num = 1;
                    $serno = str_pad($num, 4, "0", STR_PAD_LEFT);
                    $req_number = $CLRNUM.$serno;
                }else {
                    $old_control_serno=substr($reqN1[0]->{"Client Request No"},11, 5);
                    $db_serno=$old_control_serno+1;
                    $serno = str_pad($db_serno, 4, "0", STR_PAD_LEFT);
                    $req_number = $CLRNUM.$serno;
                } 
            }else{
                $req_number=$request->Client_ReqNo;
            }
            $Ministry_Code=''; $CAMPOFF ='';
            $userId = Session::get('UserID'); $Ministry_Code = Session::get('ministrycode');
            if($Ministry_Code!=''){
                // $sqlres = DB::table($this->tblMinistries)->select('Landing UID AS printLandingUID', 'OD Landing UID AS ODLandingUID', 'AV Landing UID AS AVLandingUID')->where('Ministry Code', $Ministry_Code)->first(); 
                $sqlres = DB::table($this->tblMinistries)->select('Landing UID AS LandingUID', 'Landing UID AS LandingUID', 'Landing UID AS LandingUID')->where('Ministry Code', $Ministry_Code)->first(); 
                 if(isset($sqlres)){
                    $LandingUID=$sqlres->LandingUID;
                }
               /* if(isset($sqlres) && $printmVal=="1" ){
                    $LandingUID=$sqlres->printLandingUID;
                }else if(isset($sqlres) && $outdoormVal=="1" ){
                    $LandingUID=$sqlres->ODLandingUID;
                }else if(isset($sqlres) && $TVMVal=="1"|| $crsRadioMVal=="1" ){
                    $LandingUID=$sqlres->AVLandingUID;
                }*/
            }else{$LandingUID ='';}
            $Ministry_Code =
            isset($request->Ministry_Code) ? $request->Ministry_Code : '';
            $Ministry_Head =
            isset($request->Ministry_Head) ? $request->Ministry_Head : '';
            $Department_Code =
            isset($request->Department_Code) ? $request->Department_Code : '';
            $Name_of_Officer =
            isset($request->Name_of_Officer) ? $request->Name_of_Officer : '';
            $email =
            isset($request->email) ? $request->email : '';
            $mobile =
            isset($request->mobile) ? $request->mobile : '';
            $phone =
            isset($request->phone) ? $request->phone : '';
            $address =
            isset($request->address) ? $request->address : '';
            if ($request->Client_ReqNo == '') {
                $department_Ref_No =
                isset($request->department_Ref_No) ? 'BOC/' . $request->department_Ref_No : '';
            }else {
                $department_Ref_No =
                isset($request->department_Ref_No) ? $request->department_Ref_No : '';
            }
           
            $tentative_budget =
            isset($request->tentative_budget) ? $request->tentative_budget : 0;

            $Campaign_Type =
            isset($request->Campaign_Type) ? $request->Campaign_Type : 0; 
            $No_Series =
            isset($request->No_Series) ? $request->No_Series : '';
            $Region =
            isset($request->Region) ? $request->Region : 0;
            $City =
            isset($request->City) ? $request->City : '';
            $Designation =
            isset($request->Designation) ? $request->Designation : '';
            $Fax_No =
            isset($request->Fax_No) ? $request->Fax_No : '';
            $comment =
            isset($request->comment) ? $request->comment : '';
            $comment_date =
            isset($request->comment_date) ? $request->comment_date : '';
            $State =
            isset($request->State) ? $request->State : '';
            $OMR_ID =
            isset($request->OMR_ID) ? $request->OMR_ID : '';
            $Audio_Visual =
            isset($request->Audio_Visual) ? $request->Audio_Visual : 0;
            $Request_Date = date("Y-m-d");
            $Outreach =
            isset($request->Outreach) ? $request->Outreach : 0;
            $govt_email_id =
            isset($request->govt_email_id) ? $request->govt_email_id : '';
            return $postData=array(
                'Client Request No'=>$req_number,
                'User Id'=>$userId,
                'Ministry Code'=>$Ministry_Code,
                'Ministry Head'=>$Ministry_Head,
                'Department Code'=>$Department_Code,
                'Requesting officer Name'=>$Name_of_Officer,
                'Email Id'=>$email,
                'Mobile No_'=>$mobile,
                'Phone No_'=>$phone,
                'Address'=>$address,
                'Client Refrence No_'=>$department_Ref_No,
                'From Date'=>'',
                'To Date'=>'',
                'Overall Budget'=>$tentative_budget,
                'Campaign Type'=>$Campaign_Type,
                'Print'=>$printmVal,
                'Designation'=>$Designation,
                'Fax No_'=>$Fax_No,
                'Request Date'=>$Request_Date,
                'New Media'=>0,
                //'Audio Visual'=>$Audio_Visual,
                'Outdoor'=>$outdoormVal,
                'Outreach'=>$Outreach,
                'Print Sub-Type'=>'',
                'Global Dimension 1 Code'=>'',
                'Global Dimension 2 Code'=>'',
                'AV Sub-Type'=>'',
                'New Media Sub-Type'=>'',
                'Outdoor Sub-Type'=>'',
                'Outreach Sub-Type'=>'',
                'Status'=>0,
                'Current User'=>$LandingUID,
                'Plan Created'=>0,
                'Correction'=>0,
                'Sender Id'=>'',
                'Govt E-mail ID'=>$govt_email_id,
                'AV - TV'=>$TVMVal,
                'AV - Radio'=>$crsRadioMVal,
                'Child Creation'=>0,
                'Original Doc No_'=>''
            );
        }else if($request->nextTabName == 'Print'){
            $destinationPath = public_path() . '/uploads/client-request/';
            if($request->hasFile('print_upload_creative_fileName')) {
                $file = $request->file('print_upload_creative_fileName');
                $print_upload_creative_fileName = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $print_upload_creative_fileName);
            }else {
                $print_upload_creative_fileName = '';
            }
            $knowncampaign =
            isset($request->knowncampaign) ? $request->knowncampaign : 0;
            $pageSize =
            isset($request->pageSize) ? $request->pageSize : 0;
            $un_advertise_length =
            isset($request->un_advertise_length) ? $request->un_advertise_length : 0;
            $un_advertise_breadth =
            isset($request->un_advertise_breadth) ? $request->un_advertise_breadth : 0;
            $un_advertise_area = isset($request->un_advertise_area) ? $request->un_advertise_area : 0;
            $print_color =
            isset($request->print_color) ? $request->print_color : 0;
            $print_demography =
            isset($request->print_demography) ? $request->print_demography :'';
            $individuals_s =
            isset($request->individuals_s) ?  $request->individuals_s : '';
            $group_of_city =
            isset($request->group_of_city) ? $request->group_of_city : 0;
            $print_media_planType =
            isset($request->print_media_planType) ? $request->print_media_planType : 0;
            $Plan_No =
            isset($request->Plan_No) ? $request->Plan_No : 1;
            $print_advertisement_display_select =
            isset($request->print_advertisement_display_select) ? $request->print_advertisement_display_select : 0;
            $print_Requirement =
            isset($request->print_Requirement) ? $request->print_Requirement : '';
            $print_Remarks =
            isset($request->print_Remarks) ? $request->print_Remarks : '';
            $tentative_budget =
            isset($request->tentative_budget) ? $request->tentative_budget : 0;
            $print_creative =
            isset($request->print_creative) ? $request->print_creative : 0;
            $print_target_area =
            isset($request->print_target_area) ? $request->print_target_area : 0;
            $print_language =
            isset($request->print_language) ? $request->print_language : '';
            $langauge_list = isset($request->langauge_list) ? implode(',', $request->langauge_list) : '';
            $city_with_state =
            isset($request->city_with_state) ? $request->city_with_state : 'off';
            if(($city_with_state == 'on' || $city_with_state == '1') && ($print_target_area == 1) ) {
                $city_with_state1 = 1; $stateWithCityName = '';
            }else{
                $city_with_state1 = 0; $stateWithCityName = '';
            }
            $Highlight =isset($request->heighlight) ? $request->heighlight : '';
             $from_date =
            isset($request->from_date) ? date('Y-m-d', strtotime($request->from_date)) : '';
            $to_date =
            isset($request->to_date) ? date('Y-m-d', strtotime($request->to_date)) : '';
            return $postData=array(
               'Client Request No_'=>$request->Client_ReqNo,
               'Size Known'=>$knowncampaign,
               'Print Size Selection'=>$pageSize,
               'Length'=> $un_advertise_length ,
               'Breadth'=>$un_advertise_breadth ,
               'Size of Advt_'=>$un_advertise_area ,
               'Color'=>$print_color ,
               'Demography'=>$print_demography,
               'Target Area'=>$print_target_area,
               'State'=>$individuals_s,
               'State With City'=>$city_with_state1,
               'City'=>$stateWithCityName,
               'City Groups'=>$group_of_city,
               'Language'=>$print_language,
               'Language List'=>$langauge_list,
               'Media Plan Type'=>$print_media_planType,
               'Plan Count'=>$Plan_No,
               'Advertisement Type'=>$print_advertisement_display_select ,
               'Requirement'=>$print_Requirement,
               'Remarks'=>$print_Remarks,
               'Creative Availability'=>$print_creative ,
               'Crative File Name'=>$print_upload_creative_fileName,
               'State List II'=>'',
               'State List I'=> '',
               'Posting Date'=>'',
               'Plan Posted'=>0,
               'Print Budget'=>$tentative_budget,
               'Plan Frozen'=>0,
               'Highlight'=>$Highlight,
               'Newspaper Type' => isset($request->newspaper_type) ? $request->newspaper_type:0 ,
               'Publication From Date'=>$from_date,
                'Publication  To Date'=>$to_date
            );
        }else if($request->nextTabName == 'Outdoor'){
            $destinationPath = public_path() . '/uploads/client-request/';
            if ($request->hasFile('outdoorCreativeFileName')) {
                $file = $request->file('outdoorCreativeFileName');
                $outdoorCreativeFileName = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $outdoorCreativeFileName);
            } else {
                $outdoorCreativeFileName = '';
            }
             $outdoorfrom_date =
            isset($request->outdoorfrom_date) ? date('Y-m-d', strtotime($request->outdoorfrom_date)) : '';
            $outdoorto_date =
            isset($request->outdoorto_date) ? date('Y-m-d', strtotime($request->outdoorto_date)) : '';
            return $postData=array(
              'Client Request No'=>$request->Client_ReqNo,
              'OD Budget'=>$request->outdoortentative_budget,
              'OD Media Type'=>isset($request->OutdoorMedium)? $request->OutdoorMedium:0,
              'Language'=>isset($request->outdoorLanguage)?$request->outdoorLanguage:0,
              'Creative Availability'=>isset($request->outdoorCreativeAvail)?$request->outdoorCreativeAvail:0,
              'Requirement'=>isset($request->outdoorRequirement)?$request->outdoorRequirement:'',
              'Remarks'=> isset($request->outdoorRemarks)?$request->outdoorRemarks:'',
              'Creative File Name'=>$outdoorCreativeFileName, 
              'From Date'=>$outdoorfrom_date,
              'To Date'=>$outdoorto_date
              
            );
            
        }else if($request->nextTabName == 'AV-TV'){
            $destinationPath = public_path() . '/uploads/client-request/';
            if ($request->hasFile('tvCreativeFileName')) {
                $file = $request->file('tvCreativeFileName');
                $tvCreativeFileName = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $tvCreativeFileName);
            } else {
                $tvCreativeFileName = '';
            }
            $tvfrom_date =
            isset($request->tvfrom_date) ? date('Y-m-d', strtotime($request->tvfrom_date)) : '';
            $tvto_date =
            isset($request->tvto_date) ? date('Y-m-d', strtotime($request->tvto_date)) : '';
            return $postData=array(
              'Client Request No'=>$request->Client_ReqNo,
              'Target Area'=> isset($request->tvTargetArea)? $request->tvTargetArea:0,
              'Duration'=> isset($request->tvDuration)?$request->tvDuration:0,
              'Spot Per Day'=>isset($request->tvSpotsNo)?$request->tvSpotsNo:0,
              'Requirement'=>isset($request->tvRequirment)?$request->tvRequirment:'',
              'Remarks'=> isset($request->tvRemark)?$request->tvRemark:'',
              'Creative Available'=>isset($request->tvCreativeAvail)?$request->tvCreativeAvail:0,
              'Creative File Name'=>$tvCreativeFileName,
              'Allocated Budget'=>isset($request->tvTentative_budget)? $request->tvTentative_budget:0,
              'No Of Days'=>0,
              'Regional List'=>'',
              'Gener List'=>'',
              'Language'=>0,
              'Language List'=>'',
              'National List'=>'',
              'Sub Category'=>0,
              'Genre Category'=>isset($request->tvGener)? $request->tvGener:0,
              'From Date'=>$tvfrom_date,
              'To Date'=>$tvto_date
              
            );


        }else if($request->nextTabName == 'AV-Radio'){
            $destinationPath = public_path() . '/uploads/client-request/';
            if ($request->hasFile('crsRadioCreativeFileName')) {
                $file = $request->file('crsRadioCreativeFileName');
                $crsRadioCreativeFileName = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $crsRadioCreativeFileName);
            } else {
                $crsRadioCreativeFileName = '';
            }
            $crsRadiofrom_date =
            isset($request->crsRadiofrom_date) ? date('Y-m-d', strtotime($request->crsRadiofrom_date)) : '';
            $crsRadioto_date =
            isset($request->crsRadioto_date) ? date('Y-m-d', strtotime($request->crsRadioto_date)) : '';
            return $postData=array(
              'Client Request No'=>$request->Client_ReqNo,
              'Target Area'=> isset($request->crsRadioTargetArea)? $request->crsRadioTargetArea:0,
              'Duration(Sec)'=> isset($request->crsRadioDuration)?$request->crsRadioDuration:0,
              'Spots'=>isset($request->crsRadioSpotsNo)?$request->crsRadioSpotsNo:0,
              'Requirement'=>isset($request->crsRadioRequirment)?$request->crsRadioRequirment:'',
              'Remarks'=> isset($request->crsRadioRemark)?$request->crsRadioRemark:'',
              'Creative Available'=>isset($request->crsRadioCreativeAvail)?$request->crsRadioCreativeAvail:0,
              'Creative File Name'=>$crsRadioCreativeFileName,
            'Radio Type'=>isset($request->crsRadioMedium)?$request->crsRadioMedium:0,
            'From Date'=>'',
            'To Date'=>'',
            'Time Band'=>0,
            'Pan India'=>0,
            'Job Type'=>0,
            'Job Name'=>'',
            'Job Description'=>'',
            'Budget Amount'=>isset($request->crsTentative_budget)? $request->crsTentative_budget:0,
            'Rate'=>0,
            'Secondage'=>0,
            'Regional List'=>'',
            'Zonal List'=>'',
            'Language'=>0,
            'Language List'=>'',
            'Media Plan Type'=>0,
            'Job Period'=>0,
            'Job Format'=>'',
            'Budget Available'=>0,
            'Plan Generated'=>0,
            'Lang(S_M)' =>0,
            'From Date'=>$crsRadiofrom_date,
            'To Date'=>$crsRadioto_date
              
            );


        }
        
    }
    public function clientList(Request $request)
    {
        $userid = Session::get('UserID');
        $res = array();
        $res = DB::table($this->tblClientRequestHeader.' as CL')
        ->select(
            'CL.Request Date AS RequestDate',
            'CL.From Date As FromDate',
            'CL.To Date AS ToDate',
            'CL.Email Id AS EmailId',
            'CL.Status',
            'CL.Client Request No AS CRHID',
            'PRCL.Client Request No_ AS PRCRHID'
        )
        ->join($this->tblPrintClientRequest.' as PRCL', 'CL.Client Request No', '=', 'PRCL.Client Request No_')
        ->orderBy('CL.Client Request No', 'DESC')
        ->where('CL.User Id', $userid)->paginate(2);
        return response()->json([$res]);
    }
    public function saveCommentOfmp(Request $request)
    {
        if ($request->Consent != '') {
            $Consent = $request->Consent;
            $remark = isset($request->Comment) ? $request->Comment : '';
            $mpno = $request->mpno;
            $planversion = $request->planVersion;
            $clApprovalReceived=1;
            
            if ($Consent==1 && $remark!='') {
                $sentTOClient=0;
            } else {
                $sentTOClient=1;
            }
            $update = array('Client Consent' => $Consent, 'Client Remarks' => $remark, 'Cl Approval Received' => $clApprovalReceived, 'Send TO Client'=>$sentTOClient);
            DB::unprepared('SET ANSI_WARNINGS OFF');
            $pmptable = $this->tblPrintMediaPlan;
            $where = array('MP No_' => $mpno,'Version'=>$planversion);
           $sql = $this->updateAllRecords($pmptable, $update, $where);
            $msg = 'Farworded to boc for approval!';
            DB::unprepared('SET ANSI_WARNINGS ON');
            if ($sql) {
                return $this->sendResponse('', $msg);
            } else {
                return $this->sendError('Some Error Occurred!.');
                exit;
            }
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }
    public function getEmail(Request $request)
    {
        $userid = Session::get('UserID');
        $emailid = $request->email;
        $res = array();
        $res = DB::table($this->tblClientRequestHeader)
        ->select('Email ID')
        ->orderBy('Email ID', 'ASC')
        ->where([
            ['User Id', '=', $userid],
            ['Email ID', 'like', "%$emailid%"],
        ])
        ->get();
        if ($res) {
            return $this->sendResponse($res, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }
    public function sendMailToClient($email='',$details='')
    {

        $res=$this->ClientMailSend($details, $email);

        if ($res) {
            return $this->sendResponse($res, 'Mail Sent to Client successfully');
        } else {
            return $this->sendError('Mail Not Sent!.');
            exit;
        }
    }
}
