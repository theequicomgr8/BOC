<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use App\Http\Controllers\Api\ClientController as api;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use PDF;
use App\Http\Traits\clientRequestTableTrait;

class ClientSubmissionController extends Controller
{
    use CommonTrait, clientRequestTableTrait;
    public function client_details()
    {
        $UserName = Session::get('UserName');

        $dbresponse['ministry_Code'] = DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2 as m')
                            ->select('Ministry Name as ministry_name')
                            ->leftjoin('BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2 as mh','m.Ministry Code','=','mh.New Ministry Code')
                            ->where('mh.Ministries Head',$UserName)
                            ->first();
        // print_r($dbresponse['ministry_Code']);die;
        return view('admin.pages.client-request.client-login-details',$dbresponse);
    }

    public function index(Request $request)
    {
        $userid = Session::get('UserID');
        $UserName = Session::get('UserName');
        if ($userid != '' || $userid != null) {
            
            $wingType=@$_GET['wingType']?? 1;
            $mpstatus=@$_GET['mpstatus'] ?? '';
            $from_date = isset($request->from_date)  ? date('Y-m-d', strtotime($request->from_date)) : '';
            $to_date = isset($request->to_date)  ? date('Y-m-d', strtotime($request->to_date)) : '';

            if($from_date == "" && $to_date == "" && $mpstatus!= "")
            {
                
                $today_date    = date('d');
                $today_month    = date('m');
                // $today_month    = '03';
                $previous_year  = date('Y') - 1;
                $today_year     = date('Y');
                

                if($today_month > 03)
                {
                    $from_date = $today_year.'-04-01';
                    $to_date = $today_year.'-'.$today_month.'-'.$today_date;
                }
                else
                {
                    $from_date = $previous_year.'-04-01';
                    $to_date = $today_year.'-'.$today_month.'-'.$today_date;
                }
                
            }
            else
            {   
                $from_date = "";
                $to_date = "";
            }            

            if($wingType == 1){
                $wingType_text = 'Print';
                $select=['CL.Client Request No AS ClientRequestNo',
                'CL.Request Date AS RequestDate',
                'PRCL.Publication From Date As FromDate',
                'PRCL.Publication  To Date AS ToDate',
                'CL.Email Id AS EmailId',
                'CL.Status',
                'CL.Status AS CLStatus',
                'CL.Client Request No AS CRHID',
                'PRCL.Client Request No_ AS PRCRHID',
                'ODMR.Client Request No AS ODMRId',
                'TVM.Client Request No AS TVMId',
                'CRSM.Client Request No AS CRSMId',
                'CL.Print',
                'PMP.MP No_ as MPNO',
                'PMP.Client Remarks AS MPClientRemarks',
                'PMP.Client Name as MPClientName',
                'PMP.Target Area as MPTargetArea',
                'PMP.Status as MPStatus',
                'PMP.Version as MPVersion',
                'PMP.Client Request Code as MPClientRequestCode',
                'PRCL.Print Budget AS budgetAmount',
                'PRCL.Newspaper Type AS newspaperType',

                DB::raw("(CASE 
                WHEN PRCL.Color = 0 THEN 'Color' 
                WHEN PRCL.Color = 1 THEN 'B/W' 
                ELSE 'NA' END) AS colorType")
            ];
            }else if($wingType == 2){
                $wingType_text = 'Outdoor';
                $select=['CL.Client Request No AS ClientRequestNo',
                'CL.Request Date AS RequestDate',
                'ODMR.From Date As FromDate',
                'ODMR.To Date AS ToDate',
                'CL.Email Id AS EmailId',
                'CL.Status',
                'CL.Status AS CLStatus',
                'CL.Client Request No AS CRHID',
                'PRCL.Client Request No_ AS PRCRHID',
                'ODMR.Client Request No AS ODMRId',
                'TVM.Client Request No AS TVMId',
                'CRSM.Client Request No AS CRSMId',
                'CL.Print',
                'ODMP.MP No_ as MPNO',
                'ODMP.Client Remarks AS MPClientRemarks',
                'ODMP.Client Name as MPClientName',
                'ODMP.Target Area as MPTargetArea',
                'ODMP.Status as MPStatus',
                'ODMP.OD Media Type AS MPODMediaType'];
            }else if($wingType == 3){
                $wingType_text = 'AV-TV';
                $select=['CL.Client Request No AS ClientRequestNo',
                'CL.Request Date AS RequestDate',
                'TVM.From Date As FromDate',
                'TVM.To Date AS ToDate',
                'CL.Email Id AS EmailId',
                'CL.Status',
                'CL.Status AS CLStatus',
                'CL.Client Request No AS CRHID',
                'PRCL.Client Request No_ AS PRCRHID',
                'ODMR.Client Request No AS ODMRId',
                'TVM.Client Request No AS TVMId',
                'CRSM.Client Request No AS CRSMId',
                'CL.Print',
                'AVMP.MP No_ as MPNO',
                'AVMP.Client Remarks AS MPClientRemarks',
                'AVMP.Client Name as MPClientName',
                'AVMP.Target Area as MPTargetArea',
                'AVMP.Approval Status', //Approval Status
                'AVMP.Status as MPStatus'];
            }else if($wingType == 4){
                $wingType_text = 'AV-Radio';
                $select=['CL.Client Request No AS ClientRequestNo',
                'CL.Request Date AS RequestDate',
                'CRSM.From Date As FromDate',
                'CRSM.To Date AS ToDate',
                'CL.Email Id AS EmailId',
                'CL.Status',
                'CL.Status AS CLStatus',
                'CL.Client Request No AS CRHID',
                'PRCL.Client Request No_ AS PRCRHID',
                'ODMR.Client Request No AS ODMRId',
                'TVM.Client Request No AS TVMId',
                'CRSM.Client Request No AS CRSMId',
                'CL.Print',
                'radio.MP No_ as MPNO',
                //'radio.Client Name as MPClientName',
                'radio.Target Area as MPTargetArea',
                //'radio.Approval Status', //Approval Status
                'radio.Client Approval',
                'radio.Client Remarks AS MPClientRemarks',
                'radio.Radio Type AS RadioType',
                DB::raw("(CASE 
                WHEN radio.Status = 0 THEN 'Open' 
                WHEN radio.Status = 1 THEN 'Under Approval' 
                WHEN radio.Status = 2 THEN 'Approved' 
                WHEN radio.Status = 3 THEN 'Rejected' 
                WHEN radio.Status = 4 THEN 'Farworded' 
                WHEN radio.Status = 5 THEN 'Finally Approved'
                WHEN radio.Status = 6 THEN 'Finally Reject'
                ELSE 'NA' END) AS MPStatus")];
            }
            $data = DB::table($this->tblClientRequestHeader. ' as CL')
            ->select($select)
            ->leftjoin($this->tblPrintClientRequest.' as PRCL', 'CL.Client Request No', '=', 'PRCL.Client Request No_')
            ->leftjoin($this->tblODMediaRequestHeader.' as ODMR', 'CL.Client Request No', '=', 'ODMR.Client Request No')
            ->leftjoin($this->tblAVMedia.' as TVM', 'CL.Client Request No', '=', 'TVM.Client Request No')
            ->leftjoin($this->tblAVMedia.' as CRSM', 'CL.Client Request No', '=', 'CRSM.Client Request No')  
            ->orderBy('CL.Client Request No', 'DESC')
            ->where('CL.User Id', $userid);
            if($wingType==1 ){
                $data->leftjoin($this->tblPrintMediaPlan.' as PMP', 'PMP.Client Request Code', '=', 'CL.Client Request No');
                // $data->where('PMP.Ministry Head', $UserName);
                //$data->where('PMP.Send To Client', 1);
                //$data->where('PMP.Version', 2);
                $data->where('CL.Print',1);
                if(($request->has('from_date')  && $request->has('to_date')) && $from_date != '' && $to_date != ''){
                   $data->whereDate('CL.Request Date', '>=', $from_date)->whereDate('CL.Request Date', '<=', $to_date);  
                }
                if($request->has('mpstatus') && $mpstatus!='' ){

                    if($mpstatus=="7" || $mpstatus=="8" || $mpstatus=="9" || $mpstatus=="10" || $mpstatus=="11" ){

                        if($mpstatus=="7"){
                            $clmpstatus=1;
                            $data->where('CL.Status', $clmpstatus);
                        }elseif($mpstatus=="8"){
                             $clmpstatus=2;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="9"){
                             $clmpstatus=3;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="10"){
                             $clmpstatus=4;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="11"){
                            //dd($mpstatus);
                             $clmpstatus=0;
                             $data->where('CL.Status',0);
                        }
                    }else{
                        $data->where('PMP.Status', $mpstatus);
                    }
                   
                }
                   /* if($mpstatus==0 && $mpstatus!=''){
                       
                        $data->where('PMP.Status', $mpstatus);
                       // $data->where('CL.Status', $mpstatus);
                    }else{
                     $data->where('PMP.Status', $mpstatus);   
                    }*/

            }else if($wingType==2 ){
                $data->leftjoin($this->tblODMediaPlanHeader.' as ODMP', 'ODMP.Client Request No_', '=', 'CL.Client Request No');
                // $data->where('ODMP.Ministry Head', $UserName);
                //$data->where('ODMP.Send To Client', 1);
                $data->where('CL.Outdoor',1);
                if( ($request->has('from_date')  && $request->has('to_date')) && $from_date != '' && $to_date != ''){
                   $data->whereDate('ODMR.From Date', '>=', $from_date)->whereDate('ODMR.To Date', '<=', $to_date);  
                }
                if($request->has('mpstatus') && $mpstatus!='' ){

                    if($mpstatus=="7" || $mpstatus=="8" || $mpstatus=="9" || $mpstatus=="10" || $mpstatus=="11" ){

                        if($mpstatus=="7"){
                            $clmpstatus=1;
                            $data->where('CL.Status', $clmpstatus);
                        }elseif($mpstatus=="8"){
                             $clmpstatus=2;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="9"){
                             $clmpstatus=3;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="10"){
                             $clmpstatus=4;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="11"){
                            //dd($mpstatus);
                             $clmpstatus=0;
                             $data->where('CL.Status',0);
                        }
                    }else{
                        $data->where('ODMP.Status', $mpstatus);
                    }
                   
                }
                /*if($request->has('mpstatus') && $mpstatus!='' ){
                    $data->where('ODMP.Status', $mpstatus);
                }*/
            }else if($wingType==3 ){
                $data->leftjoin($this->tblAVMediaPlan.' as AVMP', 'AVMP.Client Request Code', '=', 'CL.Client Request No');
                // $data->where('AVMP.Ministry Head', $UserName);
                $data->where('CL.AV - TV',1);
                if( ($request->has('from_date')  && $request->has('to_date')) && $from_date != '' && $to_date != ''){
                  $data->whereDate('TVM.From Date', '>=', $from_date)->whereDate('TVM.To Date', '<=', $to_date);   
                }
                if($request->has('mpstatus') && $mpstatus!='' ){

                    if($mpstatus=="7" || $mpstatus=="8" || $mpstatus=="9" || $mpstatus=="10" || $mpstatus=="11" ){

                        if($mpstatus=="7"){
                            $clmpstatus=1;
                            $data->where('CL.Status', $clmpstatus);
                        }elseif($mpstatus=="8"){
                             $clmpstatus=2;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="9"){
                             $clmpstatus=3;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="10"){
                             $clmpstatus=4;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="11"){
                            //dd($mpstatus);
                             $clmpstatus=0;
                             $data->where('CL.Status',0);
                        }
                    }else{
                        $data->where('AVMP.Status', $mpstatus);
                    }
                   
                }
                /*if($request->has('mpstatus') && $mpstatus!='' ){
                    $data->where('AVMP.Status', $mpstatus);
                } */  
            }else if($wingType==4 ){
                 $data->leftjoin($this->tblFMRadioMediaPlanHeader.' as radio', 'radio.Client Request Code', '=', 'CL.Client Request No');
                // $data->where('radio.Ministry Head', $UserName);
                // ->where('AVMP.Send To Client', 1) //x
                $data->where('CL.AV - Radio',1);
                if(($request->has('from_date')  && $request->has('to_date')) && $from_date != '' && $to_date != ''){
                  $data->whereDate('CRSM.From Date', '>=', $from_date)->whereDate('CRSM.To Date', '<=', $to_date);  
                }
                if($request->has('mpstatus') && $mpstatus!='' ){

                    if($mpstatus=="7" || $mpstatus=="8" || $mpstatus=="9" || $mpstatus=="10" || $mpstatus=="11" ){

                        if($mpstatus=="7"){
                            $clmpstatus=1;
                            $data->where('CL.Status', $clmpstatus);
                        }elseif($mpstatus=="8"){
                             $clmpstatus=2;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="9"){
                             $clmpstatus=3;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="10"){
                             $clmpstatus=4;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="11"){
                            //dd($mpstatus);
                             $clmpstatus=0;
                             $data->where('CL.Status',0);
                        }
                    }else{
                        $data->where('radio.Status', $mpstatus);
                    }
                   
                }
                /*if($request->has('mpstatus') && $mpstatus!='' ){
                    $data->where('radio.Status', $mpstatus);
                } */ 
            }
           $dategat =$data->get();
           $response=$data->paginate(25);  
           //dd($response);
           $dataPDF =['response'=>$dategat,'wingType' =>$wingType,'wingType_text' =>$wingType_text,'mpstatus'=>$mpstatus,'from_date' =>$from_date,'to_date'=>$to_date];
           Session::put('response',$dategat);
           Session::put('wingType',$wingType);
           Session::put('wingType_text',$wingType_text);
           Session::put('mpstatus',$mpstatus);
           Session::put('from_date',$from_date);
           Session::put('to_date',$to_date);
           if (isset($_REQUEST["submitreset"])) {
            return Redirect('client-submission-list');
            }else{
                 return view('admin.pages.client-request.index', compact('response','wingType','wingType_text','mpstatus','from_date','to_date'));
            }
            //return view('admin.pages.client-request.index', compact('response','wingType','wingType_text','mpstatus','from_date','to_date'));
           
        // }elseif($request->user !=''){
        //     $pdf =PDF::loadView('admin.pages.client-request.client-request-form-pdf', compact('response','wingType','wingType_text','mpstatus','from_date','to_date'));
        //     return $pdf->download($id.'.pdf');
        // }else{
            return Redirect('client-login');
        }
    }
    public function mediaPlanList(Request $request, $mpNo = '')
    {
        $userid = Session::get('UserID');
        $UserName = Session::get('UserName');
        if ($userid != '' || $userid != null) {
            $response = DB::table($this->tblPrintMediaPlan.' as PMP')
                ->select(
                    'PMP.MP No_',
                    'PMP.Client Request Code',
                    'PMP.Client Name',
                    'PMP.Target Area',
                    'PMP.Status',
                    'PMP.Version'
                )
                ->orderBy('PMP.MP No_', 'DESC')
                ->where('PMP.Ministry Head', $UserName)
                ->where('PMP.Send To Client', 1)
                ->paginate(25);
            return view('admin.pages.client-request.media-plan-list', compact('response'));
        }else{
            return Redirect('client-login');
        }
    }
    public function mediaPlanView( Request $request, $mpNo = '', $planVersion='' )
    {
        $userid = Session::get('UserID');
        $UserName = Session::get('UserName');
        $mpdetails = '';
        $npLists = '';
        $npActualAmt1='';
        $npActualAmt='';
        $tblLanguageSelectionData='';
        $LanguageName='';
        if (($userid != '' || $userid != null) && $mpNo != '') {
            //media plan  detail
            $mpdetails = DB::table($this->tblPrintMediaPlan)
                ->select("*")
                ->orderBy('MP No_', 'DESC')
                ->where('Ministry Head', $UserName)
                ->where('MP No_', $mpNo)->first();
                //get language
            if(!empty($mpdetails)){
                $tblLanguageSelectionData = DB::table($this->tblLanguageSelection)
                ->select("Language Name AS LanguageName")
                ->where('Media Name', 'Print')
                ->where('Client Request No_', $mpdetails->{'Client Request Code'})->get()->toArray();
                if(!empty($tblLanguageSelectionData)){
                    $lang_names = array_column($tblLanguageSelectionData, 'LanguageName');
                    $LanguageName=implode(' , ', $lang_names);
                }
            }
            //selected newspaper detail
            $npLists = DB::table($this->tblNewspaperSelect)
                ->select("*")
                //->orderBy('Line No_', 'DESC')
                ->where('Version',$planVersion)
                ->where('Document No_', $mpNo)
                ->orderBy('State Name','ASC')
                ->orderBy('Category','ASC')
                ->orderBy('NP Name','ASC')
                ->paginate(25);
            $npActualAmt1 = DB::table($this->tblNewspaperSelect)
                ->select("Amount")
                ->orderBy('Line No_', 'DESC')
                ->where('Document No_', $mpNo)->sum('Amount');
            //dd(number_format($npActualAmt,2));
            $npActualAmt=number_format($npActualAmt1);
            return view('admin.pages.client-request.media-plan-view', compact('mpdetails', 'npLists', 'npActualAmt', 'LanguageName'));
        }else{
            return Redirect('client-login');
        }
    }

   public function mediaPlanViewPDF( Request $request, $mpNo = '', $planVersion='' )
    {
        $userid = Session::get('UserID');
        $UserName = Session::get('UserName');
        $mpdetails = '';
        $npLists = '';
        $npActualAmt1='';
        $npActualAmt='';
        $tblLanguageSelectionData='';
        $LanguageName='';
        if (($userid != '' || $userid != null) && $mpNo != '') {
            //media plan  detail
            $mpdetails = DB::table($this->tblPrintMediaPlan)
                ->select("*")
                ->orderBy('MP No_', 'DESC')
                ->where('Ministry Head', $UserName)
                ->where('MP No_', $mpNo)->first();
                //get language
            if(!empty($mpdetails)){
                $tblLanguageSelectionData = DB::table($this->tblLanguageSelection)
                ->select("Language Name AS LanguageName")
                ->where('Media Name', 'Print')
                ->where('Client Request No_', $mpdetails->{'Client Request Code'})->get()->toArray();
                if(!empty($tblLanguageSelectionData)){
                    $lang_names = array_column($tblLanguageSelectionData, 'LanguageName');
                    $LanguageName=implode(' , ', $lang_names);
                }
            }
            //selected newspaper detail
            $npLists = DB::table($this->tblNewspaperSelect)
                ->select("*")
                //->orderBy('Line No_', 'DESC')
                ->where('Version',$planVersion)
                ->where('Document No_', $mpNo)
                //->orderBy('NP Code','DESC')
                ->orderBy('State Name','ASC')
                ->orderBy('Category','ASC')
                ->orderBy('NP Name','ASC')
                ->paginate(25);
            $npActualAmt1 = DB::table($this->tblNewspaperSelect)
                ->select("Amount")
                ->orderBy('Line No_', 'DESC')
                ->where('Document No_', $mpNo)->sum('Amount');
            //dd(number_format($npActualAmt,2));
            $npActualAmt=number_format($npActualAmt1);
           $pdfmediaplan =PDF::loadView('admin.pages.client-request.media-plan-view-pdf', compact('mpdetails', 'npLists', 'npActualAmt', 'LanguageName'));
           return $pdfmediaplan->download($mpNo.'.pdf');
        }else{
            return Redirect('client-login');
        }
    }
    
    public function saveCommentOfmp(Request $request)
    {
        $resp = (new api)->saveCommentOfmp($request);
        $response = json_decode(json_encode($resp), true);
        if($response['original']['success'] == false) {
            return response()->json($response['original']);
        }elseif($response['original']['success'] == true) {
            return response()->json($response['original']);
        }
    }

    
    public function clientSave(Request $request)
    {
        if ($request->nextTabName == 'Basic Information') {
            $resp = (new api)->saveClientBasicInfo($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }else if ($request->nextTabName == 'Print') {
            $resp = (new api)->savePrintMedia($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }else if ($request->nextTabName == 'Outdoor') {
            $resp = (new api)->saveOutdoorMedia($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }
        else if ($request->nextTabName == 'AV-TV') {
            $resp = (new api)->saveTvMedia($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }
        else if ($request->nextTabName == 'AV-Radio') {
            $resp = (new api)->savecrsRadioMedia($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }
        if ($response['original']['success'] == true) {
            return response()->json($response['original']);
        }
    }
    public function getClientForm($clid = '')
    { 
        $userid = Session::get('UserID');
        $regionalLang = $this->getRegionalLanguages();
        if (($userid != '' || $userid != null) && ($clid !== '')) {
            $client_req_header = array();
            $print_client_req = array();
            $languages = $this->getLanguages();
            $states = $this->getStates();
            $districts = $this->getDistricts();
            $allCityData = $this->getAllCity();
            $allTrainData = $this->getTrain();

            $mhcode = Session::get('UserName');
            if ($mhcode) {
                $MHeadTable = '[BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2]';
                $ministries_head = DB::table($this->tblMinistriesHead)->select('*')
                    ->where('Ministries Head', $mhcode)->first();
            }
            $table1 = '[BOC$Client Request Header$3f88596c-e20d-438c-a694-309eb14559b2]';
            $client_req_header = DB::table($this->tblClientRequestHeader)->select('*')
                ->where('User ID', $userid)
                ->where('Client Request No ', $clid)->first();
            $print_client_req = DB::table($this->tblPrintClientRequest)->select('*')
                ->where('Client Request No_', $clid)->first();
            $clientOutdoorData = DB::table($this->tblODMediaRequestHeader.' AS ODMRH')->select('ODMRH.*', 'ODR.*')
            ->leftjoin($this->tblODMediaRequest.' AS ODR', 'ODMRH.Client Request No', '=', 'ODR.Client Request No')
            ->where('ODMRH.Client Request No', $clid)->get();
            $clientTVData = DB::table($this->tblAVMedia)->select('*')
                ->where('Client Request No', $clid)->first();
            $clientRadioData = DB::table($this->tblRadioMediaRequest)->select('*')
                ->where('Client Request No', $clid)->first();

             $printCitySelection=array();
            if( ($client_req_header->Print==1 && $client_req_header->Outdoor==1) || ($client_req_header->Print==1 ) || ($client_req_header->Outdoor==1 ) ){
                $printCitySelection = DB::table($this->tblCitySelection)->select('*')
                ->where('Client Request No_', $clid)->where('Media Name', 'PRINT')->get()->toArray();   
            }
            if (is_array($printCitySelection)) {

                $distarr = array();
                foreach ($printCitySelection as  $Dist) {
                    $distarr[] = $Dist->{'City Name'};
                }
                if (is_array($distarr)) {

                    $printCitySelectionData = implode(',', $distarr);
                }
            } else {
                $printCitySelectionData = '';
            }
            $printStateSelection=array();
            if( ($client_req_header->Print==1 && $client_req_header->Outdoor==1) || ($client_req_header->Print==1 ) || ($client_req_header->Outdoor==1 ) ){
                $printStateSelection = DB::table($this->tblStateSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'PRINT')
                ->get()->toArray();
            }

            if (is_array($printStateSelection)) {
                $stcode = array();
                foreach ($printStateSelection as  $st) {
                    $stcode[] = $st->{'State Code'};
                }
                if (is_array($stcode)) {
                    $printStateSelectionData = implode(',', $stcode);
                }
            } else {

                $printStateSelectionData= '';
            }
            $langSelection=array();
            if($client_req_header->Print==1){
                $langSelection = DB::table($this->tblLanguageSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'PRINT')
                ->get()->toArray();
            }

            if (is_array($langSelection)) {

                $langarr = array();
                foreach ($langSelection as  $lang) {
                    $langarr[] = $lang->{'Language Code'};
                }
                if (is_array($langarr)) {
                    $langSelectionData = implode(',', $langarr);
                }
            } else {

                $langSelectionData = '';
            }
            //regional lang for tv
            $tvLangSelection=array();
            if($client_req_header->{'AV - TV'}==1){
                $tvLangSelection = DB::table($this->tblAVLanguageSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('AV Type', '0')
                ->get()->toArray();
            }

            if (is_array($tvLangSelection)) {

                $langarr = array();
                foreach ($tvLangSelection as  $lang) {
                    $langarr[] = $lang->{'Language Code'};
                }
                if (is_array($langarr)) {
                    $tvLangSelectionData = implode(',', $langarr);
                }
            } else {

                $tvLangSelectionData = '';
            }
            //regional lang for radio
            $radioLangSelection=array();
            if($client_req_header->{'AV - Radio'}==1){
                $radioLangSelection = DB::table($this->tblLanguageSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'CRS')
                ->get()->toArray();
            }

            if (is_array($radioLangSelection)) {

                $langarr = array();
                foreach ($radioLangSelection as  $lang) {
                    $langarr[] = $lang->{'Language Code'};
                }
                if (is_array($langarr)) {
                    $radioLangSelectionData = implode(',', $langarr);
                }
            } else {

                $radioLangSelectionData = '';
            }


            $disabled = 'disabled';
            return view(
                'admin.pages.client-request.application-for-client-submission-for-advertisement',
                [
                    'languages' => $languages->original['data'],
                    'regionalLang'=>$regionalLang->original['data'],
                    'states' => $states->original['data'],
                    'districts' => $districts->original['data'],
                    'allCityData'=>$allCityData->original['data'],
                    'client_req_header' => $client_req_header,
                    'print_client_req' => $print_client_req,
                    'clientOutdoorData'=>$clientOutdoorData,
                    'clientTVData'=>$clientTVData,
                    'clientRadioData'=>$clientRadioData,
                    'ministries_head' => $ministries_head,
                    'disabled' => $disabled,
                    'printCitySelectionData' => $printCitySelectionData,
                    'printStateSelectionData' => $printStateSelectionData,
                    'langSelectionData' => $langSelectionData,
                    'tvLangSelectionData' => $tvLangSelectionData,
                    'radioLangSelectionData' => $radioLangSelectionData,
                    'allTrainData'=>isset($allTrainData->original['data'])?$allTrainData->original['data']:''

                ]
            );

            /* $current_url = $request->url();
            $data = ['Activity_id'=> '2', 'module_id' => '2','current_url'=>$current_url];
            $logData=$this->saveLogs($data);*/
        }

        if ($userid != '' || $userid != null) {
            $client_req_header = array();
            $print_client_req = array();
            $languages = $this->getLanguages();
            $states = $this->getStates();
            $districts = $this->getDistricts();
            $allCityData = $this->getAllCity();
            $allTrainData=$this->getTrain();

            $mhcode = Session::get('UserName');
            if ($mhcode) {
                $MHeadTable = '[BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2]';
                $ministries_head = DB::table($this->tblMinistriesHead)->select('*')
                    ->where('Ministries Head', $mhcode)->first();
            }
            $table1 = '[BOC$Client Request Header$3f88596c-e20d-438c-a694-309eb14559b2]';

            $Creq_number = DB::table($this->tblClientRequestHeader)->select('*')
                ->where('User ID', $userid)->orderBy('Client Request No', 'DESC')
                ->first();

            if (!empty($Creq_number)) {
                $table2 = '[BOC$Print Client Request]';
                $print_req = DB::table($this->tblPrintClientRequest)->select('*')
                    ->where('Client Request No_', $Creq_number->{'Client Request No'})->first();
                $odmReq = DB::table($this->tblODMediaRequest)->select('*')
                ->where('Client Request No', $Creq_number->{'Client Request No'})->first();
                 $tvmReq = DB::table($this->tblAVMedia)->select('*')
                ->where('Client Request No', $Creq_number->{'Client Request No'})->first();
                 $radiomReq = DB::table($this->tblRadioMediaRequest)->select('*')
                ->where('Client Request No', $Creq_number->{'Client Request No'})->first();

            }
            
            if (isset($Creq_number->{'Client Request No'})) {
                $client_req_header = DB::table($this->tblClientRequestHeader)
                    ->select('*')
                    ->where('User ID', $userid)
                    ->where('Client Request No', $Creq_number->{'Client Request No'})->first();
            }
            //dd($client_req_header->{'Client Request No'});
            $printCitySelectionData=array();
            $printStateSelectionData=array();
            $langSelectionData=array();
            $clientOutdoorData=array();
            $clientTVData=array();
            $clientRadioData=array();
            if (!empty($client_req_header)) {
                $table2 = '[BOC$Print Client Request$3f88596c-e20d-438c-a694-309eb14559b2]';

                $print_client_req = DB::table($this->tblPrintClientRequest)
                    ->select('*')
                    ->where('Client Request No_ ', $client_req_header->{'Client Request No'})->first();
                $clientOutdoorData = DB::table($this->tblODMediaRequest)->select('*')
                    ->where('Client Request No', $Creq_number->{'Client Request No'})->first();
                 $clientTVData = DB::table($this->tblAVMedia)->select('*')
                    ->where('Client Request No', $Creq_number->{'Client Request No'})->first();
                $clientRadioData = DB::table($this->tblRadioMediaRequest)->select('*')
                    ->where('Client Request No', $Creq_number->{'Client Request No'})->first();
            }
            if(!empty($client_req_header)){
                $printCitySelection=array();
                if($client_req_header->Print==1){
                    $printCitySelection = DB::table($this->tblCitySelection)->select('*')
                    ->where('Client Request No_', $Creq_number->{'Client Request No'})->where('Media Name', 'PRINT')->get()->toArray();
                }
                if (is_array($printCitySelection)) {

                    $distarr = array();
                    foreach ($printCitySelection as  $Dist) {
                        $distarr[] = $Dist->{'City Name'};
                    }
                    if (is_array($distarr)) {

                        $printCitySelectionData = implode(',', $distarr);
                    }
                } else {
                    $printCitySelectionData = '';
                }
                $printStateSelection=array();
                if($client_req_header->Print==1){
                     $printStateSelection = DB::table($this->tblStateSelection)->select('*')
                    ->where('Client Request No_', $Creq_number->{'Client Request No'})
                    ->where('Media Name', 'PRINT')
                    ->get()->toArray();

                }
                if (is_array($printStateSelection)) {
                    $stcode = array();
                    foreach ($printStateSelection as  $st) {
                        $stcode[] = $st->{'State Code'};
                    }
                    if (is_array($stcode)) {
                        $printStateSelectionData = implode(',', $stcode);
                    }
                } else {

                    $printStateSelectionData= '';
                }
                $langSelection=array();
                if($client_req_header->Print==1){
                    $langSelection = DB::table($this->tblLanguageSelection)->select('*')
                    ->where('Client Request No_', $Creq_number->{'Client Request No'})
                    ->where('Media Name', 'PRINT')
                    ->get()->toArray();

                }
                if (is_array($langSelection)) {

                    $langarr = array();
                    foreach ($langSelection as  $lang) {
                        $langarr[] = $lang->{'Language Code'};
                    }
                    if (is_array($langarr)) {
                        $langSelectionData = implode(',', $langarr);
                    }
                } else {

                    $langSelectionData = '';
                }
                 //regional lang for tv
            $tvLangSelection=array();
            if($client_req_header->{'AV - TV'}==1){
                $tvLangSelection = DB::table($this->tblAVLanguageSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('AV Type', '0')
                ->get()->toArray();
            }

            if (is_array($tvLangSelection)) {

                $langarr = array();
                foreach ($tvLangSelection as  $lang) {
                    $langarr[] = $lang->{'Language Code'};
                }
                if (is_array($langarr)) {
                    $tvLangSelectionData = implode(',', $langarr);
                }
            } else {

                $tvLangSelectionData = '';
            }
            //regional lang for radio
            $radioLangSelection=array();
            if($client_req_header->{'AV - Radio'}==1){
                $radioLangSelection = DB::table($this->tblLanguageSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'CRS')
                ->get()->toArray();
            }

            if (is_array($radioLangSelection)) {

                $langarr = array();
                foreach ($radioLangSelection as  $lang) {
                    $langarr[] = $lang->{'Language Code'};
                }
                if (is_array($langarr)) {
                    $radioLangSelectionData = implode(',', $langarr);
                }
            } else {

                $radioLangSelectionData = '';
            }

            }
           /* return view('admin.pages.client-request.application-for-client-submission-for-advertisement', [
                    'languages' => $languages->original['data'],
                    'regionalLang'=>$regionalLang->original['data'],
                    'states' => $states->original['data'],
                    'districts' => $districts->original['data'],
                    'allCityData'=>$allCityData->original['data'],
                    'client_req_header' => $client_req_header,
                    'print_client_req' => $print_client_req,
                    'clientOutdoorData'=>$clientOutdoorData,
                    'clientTVData'=>$clientTVData,
                    'clientRadioData'=>$clientRadioData,
                    'ministries_head' => $ministries_head,
                    'printCitySelectionData' => $printCitySelectionData,
                    'printStateSelectionData' => $printStateSelectionData,
                    'langSelectionData' => $langSelectionData,
                    'tvLangSelectionData' => $tvLangSelectionData,
                    'radioLangSelectionData' => $radioLangSelectionData,
                    'email' => isset($client_req_header->{'Email Id'})? $client_req_header->{'Email Id'}:''
                ]);*/
            if ( (isset($Creq_number->{'Client Request No'})== false  && isset($print_req->{'Client Request No_'})== false && isset($odmReq->{'Client Request No'})== false ) 
                || (isset($Creq_number->{'Client Request No'})  && isset($print_req->{'Client Request No_'}) && isset($odmReq->{'Client Request No'}) == false ) 
                || (isset($Creq_number->{'Client Request No'}) && isset($odmReq->{'Client Request No'})  && isset($print_req->{'Client Request No_'}) == false ) 
                || (isset($Creq_number->{'Client Request No'})== false  && isset($print_req->{'Client Request No_'})== false  )
            || (isset($Creq_number->{'Client Request No'})  && isset($odmReq->{'Client Request No'})  )
            || (isset($Creq_number->{'Client Request No'})  && isset($tvmReq->{'Client Request No'})  ) 
            || (isset($Creq_number->{'Client Request No'})  && isset($radiomReq->{'Client Request No'})  ) 

                 ) {
                
                    return view('admin.pages.client-request.application-for-client-submission-for-advertisement', [
                    'languages' => $languages->original['data'],
                    'regionalLang'=>$regionalLang->original['data'],
                    'states' => $states->original['data'],
                    'districts' => $districts->original['data'],
                    'allCityData'=>$allCityData->original['data'],
                    'ministries_head' => $ministries_head,
                    'printCitySelectionData' => '',
                    'printStateSelectionData' => '',
                    'langSelectionData' => '',
                    'tvLangSelectionData' => '',
                    'radioLangSelectionData' => '',
                    'email' => isset($client_req_header->{'Email Id'})? $client_req_header->{'Email Id'}:'',
                    'allTrainData'=>isset($allTrainData->original['data'])?$allTrainData->original['data']:''
                    ]);
                 
            } else { 
                
                return view('admin.pages.client-request.application-for-client-submission-for-advertisement', [
                    'languages' => $languages->original['data'],
                    'regionalLang'=>$regionalLang->original['data'],
                    'states' => $states->original['data'],
                    'districts' => $districts->original['data'],
                    'allCityData'=>$allCityData->original['data'],
                    'client_req_header' => $client_req_header,
                    'print_client_req' => $print_client_req,
                    'clientOutdoorData'=>$clientOutdoorData,
                    'clientTVData'=>$clientTVData,
                    'clientRadioData'=>$clientRadioData,
                    'ministries_head' => $ministries_head,
                    'printCitySelectionData' => $printCitySelectionData,
                    'printStateSelectionData' => $printStateSelectionData,
                    'langSelectionData' => $langSelectionData,
                    'tvLangSelectionData' => $tvLangSelectionData,
                    'radioLangSelectionData' => $radioLangSelectionData,
                    'email' => isset($client_req_header->{'Email Id'})? $client_req_header->{'Email Id'}:'',
                    'allTrainData'=>isset($allTrainData->original['data'])?$allTrainData->original['data']:''
                ]);
            }

            $current_url = $request->url();
            $data = ['Activity_id' => '1', 'module_id' => '2', 'current_url' => $current_url];
        } else {

            return Redirect('client-login');
        }
    }

    public function previousLogs()
    {
        /*$current_url = url()->previous();

        $data = ['Activity_id'=> '10', 'module_id' => '2','current_url'=>$current_url];
        $logData=$this->saveLogs($data);*/
    }
    public function getCity($stateCode = '')
    {
        $districts = $this->getDistricts($stateCode);
        $response = json_decode(json_encode($districts), true);
        // echo"<pre>";print_r($districts->original['data']);die;
        // return response()->json($response['original']['data']);
        return  $districts->original['data'];
    }
    public function getCityStateBased($stateCode = '')
    {
        $getCityStateBased = $this->getAllCity($stateCode);
        $response = json_decode(json_encode($getCityStateBased), true);
        // echo"<pre>";print_r($districts->original['data']);die;
        // return response()->json($response['original']['data']);
        return  $getCityStateBased->original['data'];
    }
    public function roList(Request $request)
    {
        $userid = Session::get('UserID');
        if ($userid != '' || $userid != null) {
            $response = [];
        if (Session::has('UserName') && Session('UserName') != '') {   
 
            //get Owner ID
            $ownerid_login = '';
            $table = $this->tblVendorEmpPrint;
            $ownerid_login = $this->getOwnerID($table,Session('UserName'));
            $response_login = json_decode(json_encode($ownerid_login), true);
            if ($response_login['original']['success'] == true) {
                $ownerid_login = $response_login['original']['data'][0]['Owner ID'];
            }
            //end get Owner ID

            $response = array();
            if ($request->has('npcode') || ($request->has('from_date') && $request->has('to_date'))) {
                $from_date = isset($request->from_date)  ? date('Y-m-d', strtotime($request->from_date)) : '';
                $to_date = isset($request->to_date)  ? date('Y-m-d', strtotime($request->to_date)) : '';
                $npcode = isset($request->npcode) ? $request->npcode : '';

                //get Owner ID
                $ownerid_ro = '';
                if($npcode != ''){                
                $ownerid_ro = $this->getOwnerID($table,$npcode);
                $response_ro = json_decode(json_encode($ownerid_ro), true);
                  if ($response_ro['original']['success'] == true) {
                    $ownerid_ro = $response_ro['original']['data'][0]['Owner ID'];
                  }
                 }
                 
                //end get Owner ID
                if(($ownerid_login != '' && $ownerid_ro != '') && ($ownerid_login == $ownerid_ro)){
                    DB::enableQueryLog(); 
                    $data = DB::table($this->tblROHeader.' as ROH')
                        ->select(
                            'ROH.RO Code AS RoCode',
                            'ROH.Plan ID AS PlanId',
                            'ROH.Client ID AS ClientId',
                            'ROH.RO Date AS PublishDate',
                            'RL.NP Code AS npcode',
                            'RL.Line No_ As lineno',
                            'RL.Pdf File Name As Pdf File Name',
                            'MPL.Client Request Code AS CLRCode',
                            'PCR.Crative File Name',
                            'MPL.Version AS planVersion'
                        )
                        ->Join($this->tblROLine.' as RL', 'ROH.RO Code', '=', 'RL.RO No_')
                        ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
                        ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
                        ->orderBy('RL.Line No_', 'DESC')  
                        ->where('ROH.Status','<>',4)           
                        ->Where('RL.NP Code', $npcode);                    

                    if (($request->has('from_date')  && $request->has('to_date')) && $from_date != '' && $to_date != '') {
                        $data->whereDate('ROH.RO Date', '>=', $from_date)->whereDate('ROH.RO Date', '<=', $to_date);
                    }
                   
                    $response = $data->paginate(25);
                    $query = DB::getQueryLog();
                    //dd($query);
             }
            }
        }
            return view('admin.pages.release-order.ROList', compact('response'));
        } else {

            return Redirect('vendor-login');
        }
    }
    public function viewRO($npcode = '', $lineno = '', $PlanId = '', $ClientId = '')
    {
        $np_code = decrypt($npcode);
        $line_no = decrypt($lineno);
        $Plan_Id = decrypt($PlanId);
        $Client_Id = decrypt($ClientId);
        $userid = Session::get('UserID');

        if ($userid != '' || $userid != null) {
            $response = array();
            DB::enableQueryLog();
            $response = DB::table($this->tblROHeader.' as ROH')
                ->select(
                    'ROH.*',
                    'MPL.*'
                )
                //->leftJoin('BOC$RO Line as RL', 'RL.NP Code','=','')
                ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
                ->where('ROH.Plan ID', $Plan_Id)
                ->first();
            $query = DB::getQueryLog();
            //dd($query);

            return view('admin.pages.release-order.ROView', compact('response'));
        } else {

            return Redirect('vendor-login');
        }
    }
    public function getEmail(Request $request)
    {
        $resp = (new api)->getEmail($request);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true) {
            return response()->json($response['original']['data']);
        } else {
            return response()->json($response['original']['message']);
        }
    }

    public function mailSendToClient($param = '')
    {
        $resp = (new api)->sendMailToClient($param);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true) {
            return response()->json($response['original']['data']);
        } else {
            return response()->json($response['original']['message']);
        }
    }
    public function getODMediaSubCat($mgroupCatId = '',$mUIDCode='')
    {
        $mdata = $this->getODMediaSubCatList($mgroupCatId, $mUIDCode);
        return  $mdata->original['data'];
    }
    public function getClientcallbackForm()
    {
        $userid = Session::get('UserID');
        if ($userid != '' || $userid != null) {
            return view('admin.pages.client-request.requestcallback');
         }else{
            return Redirect('client-login');
         }
    }
    public function MailForCallBack(Request $request){
        $mhcode = Session::get('UserName');
        if ($mhcode) {
            $MHeadTable = '[BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2]';
            $ministries_head = DB::table($this->tblMinistriesHead)->select('Head Name as headName')
                ->where('Ministries Head', $mhcode)->first();
        }
        $mHeadName=isset($ministries_head->headName)?$ministries_head->headName:'';
       $details = [
                'title'=> 'Reminder',
                'name'=>isset($request->name)?$request->name:'',
                'mobile'=>isset($request->mobile)?$request->mobile:'',
                'mHeadName'=>$mHeadName,
                'body'=> isset($request->issue)?$request->issue:''
            ];
        $email=isset($request->email)?$request->email:'';
        $response=Mail::to($email)->send(new \App\Mail\clientcallbackmail($details));
        if($response) {
            return response()->json(['success'=>'true', 200]);
        } else {
            return response()->json(['success'=>'false', 400]);
        }

    }
    public function fundstatusList(){
        
        $mhcode = Session::get('UserName');
        // $mhcode = 14101;
        $head_code = ltrim($mhcode,0);
        // dd(ltrim($mhcode,0));
        $table = 'BOC$LOA Ledger$3f88596c-e20d-438c-a694-309eb14559b2';
        $get_amount = DB::table($table)->select('Authorized Amount as amount')->where('Head Code',$head_code)->first();
        $dbresponse['amount'] = round($get_amount->amount);
        // dd(round($get_amount->amount));
        if($mhcode == 10101)
        {
            $dbresponse['opening_amount'] = '1187959';
            $dbresponse['closing_amount'] = '146';
        }
        else if($mhcode == 10103)
        {
            $dbresponse['opening_amount']  = '175339';
            $dbresponse['closing_amount'] = '610';
        }

        else if($mhcode == 10104)
        {
            $dbresponse['opening_amount']  = '150000';
            $dbresponse['closing_amount'] = '1975';
        }
        else if($mhcode == 10105)
        {
            $dbresponse['opening_amount']  = '11880';
            $dbresponse['closing_amount'] = '349';
        }
        else if($mhcode == 10109)
        {
            $dbresponse['opening_amount']  = '2100002';
            $dbresponse['closing_amount'] = '3420';
        }
        else if($mhcode == 15401)
        {
            $dbresponse['opening_amount']  = '104781116';
            $dbresponse['closing_amount'] = '244912';
        }
        else if($mhcode == 15402)
        {
            $dbresponse['opening_amount']  = '1826062';
            $dbresponse['closing_amount'] = '5207';
        }
        else
        {
            $dbresponse['opening_amount']  = '0.00';
            $dbresponse['closing_amount'] = '0.00';
        }
        return view('admin.pages.client-request.fundstatuslist',$dbresponse);

    }

    public function clientRequestPDF($userId =""){  
            $response       = Session::get('response');
            $wingType       = Session::get('wingType');
            $wingType_text  = Session::get('wingType_text');
            $mpstatus       =  Session::get('mpstatus');
            $from_date      = Session::get('from_date');
            
            $to_date        = Session::get('to_date');

            if($from_date == "" && $to_date == "")
            {
                // print_r("expression");die;
                $today_date    = date('d');
                $today_month    = date('m');
                // $today_month    = '03';
                $previous_year  = date('Y') - 1;
                $today_year     = date('Y');
                // print_r($today_date);die;

                if($today_month > 03)
                {
                    $from_date = $today_year.'-04-01';
                    $to_date = $today_year.'-'.$today_month.'-'.$today_date;
                }
                else
                {
                    $from_date = $previous_year.'-04-01';
                    $to_date = $today_year.'-'.$today_month.'-'.$today_date;
                }
                
            }
            // print_r($from_date); echo"<br>";
                // print_r("to:".$to_date);die;
            // echo"<pre>";print_r($response);die;
            //dd($response, $wingType, $wingType_text,  $mpstatus, $from_date, $to_date);
            $pdf =PDF::loadView('admin.pages.client-request.client-request-list-pdf',compact('response', 'wingType','wingType_text', 'mpstatus','from_date','to_date'));
            // return $pdf->download($userId. '.pdf');
            return $pdf->download('Media Request List.pdf');
        }

    public function roPrintPDF($npcode)
    {
        $userid = Session::get('UserID');
        if ($userid != '' || $userid != null) 
        {
            $response = [];
            if (Session::has('UserName') && Session('UserName') != '') {
            $response = DB::table($this->tblROHeader.' as ROH')
            ->select(
                'ROH.RO Code AS RoCode',
                'ROH.Plan ID AS PlanId',
                'ROH.Client ID AS ClientId',
                'ROH.RO Date AS PublishDate',
                'RL.NP Code AS npcode',
                'RL.Line No_ As lineno',
                'RL.Pdf File Name As Pdf File Name',
                'MPL.Client Request Code AS CLRCode',
                'PCR.Crative File Name',
                'MPL.Version AS planVersion'
            )
            ->Join($this->tblROLine.' as RL', 'ROH.RO Code', '=', 'RL.RO No_')
            ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
            ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
            ->orderBy('RL.Line No_', 'DESC')
            ->where('ROH.Status','<>',4)
            ->Where('RL.NP Code', $npcode)->get();
            }
            $pdf = \PDF::loadView('admin.pages.release-order.ROList-pdf', compact('response'));
        }
        return $pdf->download($npcode . '.pdf');
    }

    
public function GeneratePDFclientReq($clid =""){
        $userid = Session::get('UserID');
        $regionalLang = $this->getRegionalLanguages();
        if (($userid != '' || $userid != null) && ($clid !== '')) {
            $client_req_header = array();
            $print_client_req = array();
            $languages = $this->getLanguages();
            $states = $this->getStates();
            $districts = $this->getDistricts();
            $allCityData = $this->getAllCity();
            $allTrainData = $this->getTrain();

            $mhcode = Session::get('UserName');
            if ($mhcode) {
                $MHeadTable = '[BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2]';
                $ministries_head = DB::table($this->tblMinistriesHead)->select('*')
                    ->where('Ministries Head', $mhcode)->first();
            }
            $table1 = '[BOC$Client Request Header$3f88596c-e20d-438c-a694-309eb14559b2]';
            $client_req_header = DB::table($this->tblClientRequestHeader)->select('*')
                ->where('User ID', $userid)
                ->where('Client Request No ', $clid)->first();
            $print_client_req = DB::table($this->tblPrintClientRequest)->select('*')
                ->where('Client Request No_', $clid)->first();
            $clientOutdoorData = DB::table($this->tblODMediaRequestHeader.' AS ODMRH')->select('ODMRH.*', 'ODR.*')
            ->leftjoin($this->tblODMediaRequest.' AS ODR', 'ODMRH.Client Request No', '=', 'ODR.Client Request No')
            ->where('ODMRH.Client Request No', $clid)->get();
            $clientTVData = DB::table($this->tblAVMedia)->select('*')
                ->where('Client Request No', $clid)->first();
            $clientRadioData = DB::table($this->tblRadioMediaRequest)->select('*')
                ->where('Client Request No', $clid)->first();

             $printCitySelection=array();
            if( ($client_req_header->Print==1 && $client_req_header->Outdoor==1) || ($client_req_header->Print==1 ) || ($client_req_header->Outdoor==1 ) ){
                $printCitySelection = DB::table($this->tblCitySelection)->select('*')
                ->where('Client Request No_', $clid)->where('Media Name', 'PRINT')->get()->toArray();   
            }
            if (is_array($printCitySelection)) {

                $distarr = array();
                foreach ($printCitySelection as  $Dist) {
                    $distarr[] = $Dist->{'City Name'};
                }
                if (is_array($distarr)) {

                    $printCitySelectionData = implode(',', $distarr);
                }
            } else {
                $printCitySelectionData = '';
            }
            $printStateSelection=array();
            if( ($client_req_header->Print==1 && $client_req_header->Outdoor==1) || ($client_req_header->Print==1 ) || ($client_req_header->Outdoor==1 ) ){
                $printStateSelection = DB::table($this->tblStateSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'PRINT')
                ->get()->toArray();
            }

            if (is_array($printStateSelection)) {
                $stcode = array();
                foreach ($printStateSelection as  $st) {
                    $stcode[] = $st->{'State Code'};
                }
                if (is_array($stcode)) {
                    $printStateSelectionData = implode(',', $stcode);
                }
            } else {

                $printStateSelectionData= '';
            }
            $langSelection=array();
            if($client_req_header->Print==1){
                $langSelection = DB::table($this->tblLanguageSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'PRINT')
                ->get()->toArray();
            }

            if (is_array($langSelection)) {

                $langarr = array();
                foreach ($langSelection as  $lang) {
                    $langarr[] = $lang->{'Language Code'};
                }
                if (is_array($langarr)) {
                    $langSelectionData = implode(',', $langarr);
                }
            } else {

                $langSelectionData = '';
            }
            //regional lang for tv
            $tvLangSelection=array();
            if($client_req_header->{'AV - TV'}==1){
                $tvLangSelection = DB::table($this->tblAVLanguageSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('AV Type', '0')
                ->get()->toArray();
            }

            if (is_array($tvLangSelection)) {

                $langarr = array();
                foreach ($tvLangSelection as  $lang) {
                    $langarr[] = $lang->{'Language Code'};
                }
                if (is_array($langarr)) {
                    $tvLangSelectionData = implode(',', $langarr);
                }
            } else {

                $tvLangSelectionData = '';
            }
            //dd($tvLangSelectionData);
            //regional lang for radio
            $radioLangSelection=array();
            if($client_req_header->{'AV - Radio'}==1){
                $radioLangSelection = DB::table($this->tblLanguageSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'CRS')
                ->get()->toArray();
            }

            if (is_array($radioLangSelection)) {

                $langarr = array();
                foreach ($radioLangSelection as  $lang) {
                    $langarr[] = $lang->{'Language Code'};
                }
                if (is_array($langarr)) {
                    $radioLangSelectionData = implode(',', $langarr);
                }
            } else {

                $radioLangSelectionData = '';
            }
            $outdata =[];
                       //dd($clientOutdoorData);
                      $IndianCi =DB::table('BOC$Indian City$3f88596c-e20d-438c-a694-309eb14559b2')->get();
                      $UserName = Session::get('UserName');
            
                      $dbresponse = DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2 as m')
                                          ->select('Ministry Name as ministry_name')
                                          ->leftjoin('BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2 as mh','m.Ministry Code','=','mh.New Ministry Code')
                                          ->where('mh.Ministries Head',$UserName)
                                          ->first();
            $pdf =PDF::loadView('admin.pages.client-request.client-request-form-pdf',
                                [
                                    'languages' => $languages->original['data'],
                                    'regionalLang'=>$regionalLang->original['data'],
                                    'states' => $states->original['data'],
                                    'districts' => $districts->original['data'],
                                    'allCityData'=>$allCityData->original['data'],
                                    'client_req_header' => $client_req_header,
                                    'print_client_req' => $print_client_req,
                                    'clientOutdoorData'=>$clientOutdoorData,
                                    'clientTVData'=>$clientTVData,
                                    'clientRadioData'=>$clientRadioData,
                                    'ministries_head' => $ministries_head,
                                    'printCitySelectionData' => $printCitySelectionData,
                                    'printStateSelectionData' => $printStateSelectionData,
                                    'langSelectionData' => $langSelectionData,
                                    'tvLangSelectionData' => $tvLangSelectionData,
                                    'radioLangSelectionData' => $radioLangSelectionData,
                                    //'mediasubcategory'=>$outdata,
                                    'IndianCi' => $IndianCi,
                                    'dbresponse' =>$dbresponse,
                                    //'trantNo' =>$trantNo,
                                    'allTrainData'=>isset($allTrainData->original['data'])?$allTrainData->original['data']:''
                    
                                ]
                            );
                           return $pdf->download($clid.'.pdf');
                    
        }
    }

 
}
