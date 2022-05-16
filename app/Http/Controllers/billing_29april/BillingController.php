<?php

namespace App\Http\Controllers\billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Traits\CommonTrait;
use Session;
use App\Http\Controllers\Api\billing\BillingController as api;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait;
    public function index()
    {
        $userid = Session::get('UserID');
        $np_code = Session::get('UserName');
        if ($userid != '' || $userid != null) {
            $response = array();
            if (Session::has('UserName')) {
                $response = $this->getBillingData($np_code);
            }
            return view('admin.pages.billing.index', compact('response'));
        } else {
            return Redirect('vendor-login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $npcodeData = DB::table($this->tblROLine)->select('NP Code AS npcode', 'NP Name AS npname')->orderBy('Line No_', 'DESC')->get();
        return view('admin.pages.billing.create', compact('npcodeData'));
        //dd($npcodeData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resp = (new api)->storeBilling($request);
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
    public function show($id)
    {
        //
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
    public function getnpDetail($npcode = '')
    {
        return  $getData = DB::table($this->tblROLine)->select('Language', 'NP Name AS npname', 'State Name AS statename', 'Periodicity Name AS periodicityname', 'Publishing City AS publication_place', 'RO NO_ AS rocode')->where('NP Code', $npcode)->first();
    }
    public function getrodetail($rocode = '')
    {
        $arr = explode(",", $rocode);
        $code = implode("/", $arr);
        return  $getData = DB::table($this->tblROHeader)->select('Advertisement Type AS advtype')->where('RO Code', $code)->first();
    }
    public function getBillingData($np_code)
    {
        DB::enableQueryLog();
        $response = DB::table($this->tblROHeader.' as ROH')
            ->select(
                'MPL.Client Request Code AS CLRCode',
                'ROH.Plan ID',
                //'ROH.Status',
                'PCR.Crative File Name',
                'PCR.Size of Advt_ AS advtSize',
                'RL.RO No_',
                'RL.NP Code',
                'RL.Amount',
                'RL.Periodicity Name',
                'RL.Language',
                'RL.Publishing City',
                'RL.NP Name',
                'RL.State Name',
                'RL.Publishing Date',
                'RL.Page No_',
                'RL.Compliance Status',
                'RL.Remarks',
                'RL.Amount',
                'RL.Billing Status',
                'RL.Control No_ AS ReferenceNo',
                'MPL.Version AS planVersion',
                DB::raw("(CASE
                WHEN ROH.Status = 0 THEN 'Open'
                WHEN ROH.Status = 1 THEN 'Approved'
                WHEN ROH.Status = 2 THEN 'end to Vendor'
                WHEN ROH.Status = 3 THEN 'PDF Created'
                WHEN ROH.Status = 4 THEN 'Rolled Back'
                ELSE 'NA'
                END) AS StatusLable")
            )
            ->leftJoin($this->tblROLine.' as RL', 'RL.RO No_', '=', 'ROH.RO Code')
            ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
            ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
            ->where('RL.Compliance Status', 1)
            ->where('RL.Billing Status', 1)
            ->where('RL.NP Code', $np_code)
            ->where('ROH.Status', '<>', 4)
            ->orderBy('RL.Line No_', 'desc')
            ->get();
        $query = DB::getQueryLog();
        return $response;
        //dd($response);
    }

    public function billingPrintPDF($np_code)
    {
        $response = $this->getBillingData($np_code);
        $pdf = \PDF::loadView('admin.pages.billing.print-pdf', compact('response'));
        return $pdf->download($np_code . '.pdf');
    }

    /* Billing View start Priyanshi */

    public function billingView(Request $request) {
        $response = $this->billingData($request['NPCode'],$request['ROCode'],$request['BillingStatus']);
        //dd($response);
        return view('admin.pages.billing.billing_view', compact('response'));
    }

    public function billingPDF(Request $request)
    {
        $response = $this->billingData($request['NPCode'],$request['ROCode'],$request['BillingStatus']);
        $pdf = \PDF::loadView('admin.pages.billing.billing-pdf', compact('response'));
        return $pdf->download($request['NPCode'] . '.pdf');
    }

    public function billingData($NPCode,$ROCode,$BillingStatus) {
        // dd($NPCode,$ROCode);
        $response = DB::table($this->tblROLine)
                    ->where('Billing Status', $BillingStatus)
                    ->where('NP Code', $NPCode)
                    ->where('RO No_', $ROCode)
                    ->first();
        //dd($response);
        return $response;
    }
}
