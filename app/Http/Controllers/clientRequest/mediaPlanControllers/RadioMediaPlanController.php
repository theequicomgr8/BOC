<?php
namespace App\Http\Controllers\ClientRequest\mediaPlanControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;
use App\Http\Traits\clientRequestTableTrait;

class RadioMediaPlanController extends Controller
{
    use CommonTrait, clientRequestTableTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $userid = Session::get('UserID');
        $UserName = Session::get('UserName');
        $response=array();
        $radioType=$request->radioType;
        if ($userid != '' || $userid != null) {
            $data = DB::table($this->tblFMRadioMediaPlanHeader.' as radio')
                ->select(
                    'radio.MP No_',
                    'radio.Client Request Code',
                    'radio.Client Approval',
                    'radio.Target Area AS TargetArea',
                    'radio.Client Remarks AS ClientRemarks',
                    'radio.Radio Type AS RadioType',
                    DB::raw("(CASE 
                        WHEN radio.Status = 0 THEN 'Open' 
                        WHEN radio.Status = 1 THEN 'Under Approval' 
                        WHEN radio.Status = 2 THEN 'Approved' 
                        WHEN radio.Status = 3 THEN 'Rejected' 
                        WHEN radio.Status = 4 THEN 'Farworded' 
                        WHEN radio.Status = 5 THEN 'Finally Approved'
                        WHEN radio.Status = 6 THEN 'Finally Reject'
                        ELSE 'NA' END) AS PlanStatus"),   
                )
                ->where('radio.Ministry Head', $UserName)
                ->orderBy('radio.MP No_', 'DESC');
                if($request->has('radioType')){
                    $data->where('Radio Type', $radioType);
                }
                 $response = $data->paginate(25);
            return view('admin.pages.client-request.mediaPlan.avMediaPlan.radio.index', compact('response','radioType'));
        } else {
            return Redirect('client-login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resp = $this->saveRadioPlanComment($request);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == false) {
            return response()->json($response['original']);
        } elseif ($response['original']['success'] == true) {
            return response()->json($response['original']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mpNo1)
    {
    	$mpNo=str_replace("FM","FM/",$mpNo1);
        $userid = Session::get('UserID');
        $UserName = Session::get('UserName');
        $mpdetails = '';
        $npLists = '';
        if (($userid != '' || $userid != null) && $mpNo != '') {
            //media plan  detail
            $mpdetails = DB::table($this->tblFMRadioMediaPlanHeader.' as radio')
                ->select("*")
                ->orderBy('MP No_', 'DESC')
                ->where('Ministry Head', $UserName)
                ->where('MP No_', $mpNo)->first();
            //selected newspaper detail
            $npLists = DB::table($this->tblFMRadioMedaPlanLine)
                ->select("*")
                ->orderBy('FM No_', 'DESC')
                ->where('Document No_', $mpNo)->paginate(25);
            
            return view('admin.pages.client-request.mediaPlan.avMediaPlan.radio.viewPlan', compact('mpdetails', 'npLists'));
        } else {
            return Redirect('client-login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
   
     public function saveRadioPlanComment(Request $request)
    {
        // dd("demo");
        if ($request->Consent != '') {
            $Consent = $request->Consent;
            $remark = isset($request->Comment) ? $request->Comment : '';
            $mpno = $request->mpno;
            $clApprovalReceived=1;
            
            if ($Consent==1 && $remark!='') {
                $sentTOClient=0;
            } else {
                $sentTOClient=1;
            }
            // $update = array('Client Consent' => $Consent, 'Client Remarks' => $remark, 'Cl Approval Received' => $clApprovalReceived, 'Send TO Client'=>$sentTOClient);
            $update = array('Client Consent' => $Consent, 'Client Remarks' => $remark,'Cl Approval Received' => $clApprovalReceived,'Send To Client'=>$sentTOClient);
            DB::unprepared('SET ANSI_WARNINGS OFF');
            $pmptable = $this->tblFMRadioMediaPlanHeader;
            $where = array('MP No_' => $mpno);
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
}

