<?php
namespace App\Http\Traits\clientRequest;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Api\ApiLogsController as apiLog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Traits\clientRequestTableTrait;
trait crsRadioRequest
{
   /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait, clientRequestTableTrait;
    public function sendMailToClientForcrsRadio(Request $request){
        //call sms and mail function
            if (isset($request->govt_email_id)) {
                $emails = array($request->email, $request->govt_email_id);
            } else {
                $emails = array($request->email);
            }
            $details = [
                'title'=> 'Reminder',
                'body' => 'Data has been Successfully Submitted.'
            ];
            $this->smsSend($request->mobile);
            $this->sendMailToClient($emails,$details);
            
           /* if($request->crsRadioCreativeAvail=="1" || $request->crsRadioCreativeAvail=="2"){
                $details3 = [
                    'title'=> 'Creative Reminder',
                    'body' => 'Creative is to be developed by BOC and you have one week buffer to submit.'
                ];
                $this->sendMailToClient($emails,$details3);
            }*/
            
            //end call sms and mail function
    }
    public function getcrsRadioMediaName($reqnum=''){
        return $res = DB::table($this->tblClientRequestHeader)->select('Print','AV - Radio AS crsRadio' )
                ->where('Client Request No',  $reqnum)->first();
    }
    public function deleteAllcrsRadioSelection(Request $request){
        $mName=$this->getcrsRadioMediaName($request->Client_ReqNo);
            if($mName && $mName->crsRadio=="1"){
                $mediaName="CRS";
            }
        $delsql1 = DB::table($this->tblLanguageSelection)->where('Media Name',$mediaName)->where('Client Request No_',$request->Client_ReqNo)->delete();
       // $delsql2 = DB::table('BOC$Genre Selection')->where('Media Name',$mediaName)->where('Client Request No_',$request->Client_ReqNo)->delete();
       
        if($delsql1 ){
            $msg = 'deleteAllSelection Successfully!';
            return $this->sendResponse([], $msg);
        }else{
            return $this->sendError('Some Error Occurred!.');
        }
    }
    public function savecrsRadioRegLangAndGenre(Request $request){
        //start Language Selection save
        $crsRadioRegion=$request->crsRadioRegion;
        if ($request->crsRadioTargetArea == "1" || $request->crsRadioTargetArea == "2") {
            if (count($request->crsRadioRegion) > 0) {
                $mName=$this->getcrsRadioMediaName($request->Client_ReqNo);
                if($mName && $mName->crsRadio=="1"){
                    $mediaName="CRS";
                }
                foreach ($request->crsRadioRegion as $langkey => $langvalue) {
                    $langauge_Code =
                        isset($request->crsRadioRegion[$langkey]) ? $request->crsRadioRegion[$langkey] : '';
                    $crsRadioLangtData='';
                    if($langauge_Code!='' || $langauge_Code!=null){
                        $crsRadioLangtData = DB::table($this->tblLanguage)->select('Name')->where('Code',  $langauge_Code)->first();
                        $crsRadio_langName = $crsRadioLangtData->Name;
                        $selected_langVal = 1;
                        $line_no1 = DB::select('select TOP 1 [Line No_] from dbo.[BOC$Language Selection$3f88596c-e20d-438c-a694-309eb14559b2] order by [Line No_] desc');
                        if (empty($line_no1)) {
                            $line_no1 = 10000;
                        } else {
                            $line_no1 = $line_no1[0]->{"Line No_"};
                            $line_no1 = $line_no1 + 10000;
                        }
                        $lanPostData = array(
                            'Client Request No_'=>$request->Client_ReqNo,
                            'Line No_'=>$line_no1,
                            'Selected' => $selected_langVal,
                            'Media Name' => $mediaName,
                            'Lang(S_M)'=>0,          
                            'Language Code'=>$langauge_Code ,    
                            'Language Name'=>$crsRadio_langName,
                            'Budget Percentage'=>0,
                            'Media Plan No_'=>0,
                            'Plan Type'=>0,
                            'Old Budget Pct_'=>0
                        );
                        $sql = DB::table($this->tblLanguageSelection)->insert($lanPostData);
                    }
                       
                }
                if($sql){
                    $msg = 'Language Save Successfully!';
                    return $this->sendResponse([], $msg);
                }else{
                    return $this->sendError('Some Error Occurred!.');
                }

            }
        }
        //End Language Selection 
    }
   
}


?>