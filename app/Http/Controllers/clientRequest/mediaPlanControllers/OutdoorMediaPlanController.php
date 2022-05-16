<?php

namespace App\Http\Controllers\ClientRequest\mediaPlanControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;
use App\Http\Traits\clientRequestTableTrait;

class OutdoorMediaPlanController extends Controller
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
        $odmediaType=$request->odmediaType;
        if ($userid != '' || $userid != null) {
            $data = DB::table($this->tblODMediaPlanHeader.' as ODMP')
                ->select(
                    'ODMP.MP No_',
                    'ODMP.Client Request No_',
                    'ODMP.Client Name',
                    'ODMP.Target Area',
                    'ODMP.Status',
                    'ODMP.OD Media Type AS ODMediaType',
                )
                ->where('ODMP.Ministry Head', $UserName)
                ->where('ODMP.Send To Client', 1)
                ->orderBy('ODMP.MP No_', 'DESC');
                if($request->has('odmediaType')){
                    $data->where('ODMP.OD Media Type', $odmediaType);
                }
                 $response = $data->paginate(25);
            return view('admin.pages.client-request.mediaPlan.outdoorMediaPlan.index', compact('response','odmediaType'));
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
        $resp = $this->saveODMPlanComment($request);
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
    public function show($mpNo)
    {
        $userid = Session::get('UserID');
        $UserName = Session::get('UserName');
        $mpdetails = '';
        $npLists = '';
        if (($userid != '' || $userid != null) && $mpNo != '') {
            //media plan  detail
            $mpdetails = DB::table($this->tblODMediaPlanHeader)
                ->select("*")
                ->orderBy('MP No_', 'DESC')
                ->where('Ministry Head', $UserName)
                ->where('MP No_', $mpNo)->first();
            //selected newspaper detail
            $npLists = DB::table($this->tblODMediaPlanLine)
                ->select("*")
                ->orderBy('Line No_', 'DESC')
                ->where('Document No_', $mpNo)->paginate(25);
            //dd($npLists);

            $npActualAmt1 = DB::table($this->tblODMediaPlanLine)
                ->select("Amount")
                ->orderBy('Line No_', 'DESC')
                ->where('Document No_', $mpNo)->sum('Amount');
            //dd(number_format($npActualAmt,2));
            $npActualAmt=number_format($npActualAmt1,2);
            return view('admin.pages.client-request.mediaPlan.outdoorMediaPlan.viewPlan', compact('mpdetails', 'npLists','npActualAmt'));
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
   
     public function saveODMPlanComment(Request $request)
    {
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
            $update = array('Client Consent' => $Consent, 'Client Remarks' => $remark, 'Cl Approval Received' => $clApprovalReceived, 'Send TO Client'=>$sentTOClient);
            DB::unprepared('SET ANSI_WARNINGS OFF');
            $pmptable = $this->tblODMediaPlanHeader;
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
