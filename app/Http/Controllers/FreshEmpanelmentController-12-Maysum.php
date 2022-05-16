<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
//use Illuminate\Support\Facades\Auth;
use Session;
use Auth;
use App\Models\Api\ApiFreshEmpanelment;
use App\Http\Controllers\Api\ApiFreshEmpanelmentController as api;
use App\Http\Controllers\Api\ApiLogsController as logapi;
use App\Http\Traits\CommonTrait;
use Redirect;
use PDF;
use File;
use Illuminate\Support\Facades\Mail;

class FreshEmpanelmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait;

    public function freshEmpanelment(Request $request)
    {

        if (!Session::has('id')) {
            return Redirect('/vendor-login');
        } else {
            $vendor_table = '[BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2]';
            $request['user_id'] = session('id');
            $vendordata = (new api)->fetchVendorRecord($request);
            $vendordatas = json_decode(json_encode($vendordata), true);
            $ownerdatas = '';
            $ownerotherdata = '';
            if ($vendordatas['original']['success'] == true) {
                $request['key'] = 'Owner ID';
                $request['owner_id'] = $vendordatas['original']['data'][0]['Owner ID'];
                $ownerdatas = (new api)->fetchOwnerRecord($request);
                $ownerdatas = json_decode(json_encode($ownerdatas), true);
                $ownerdatas = $ownerdatas['original']['data'] ? $ownerdatas['original']['data'][0] : '';
                $vendordatas = $vendordatas['original']['data'] ? $vendordatas['original']['data'][0] : '';
                if (count($vendordatas) > 0) {
                    $owner_other_data = (new api)->fetchOwnerOtherRecord($request);
                    $owner_other_data = json_decode(json_encode($owner_other_data), true);
                    if ($owner_other_data['original']['success'] == true) {
                        $ownerotherdata = $owner_other_data['original']['data'];
                    }
                }
            } else {
                $vendordatas = '';
            }
        }
        $language_array = (new api)->getLanguages();
        $languages = json_decode(json_encode($language_array), true);
        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);
        $district_array = (new api)->getAllDistricts();
        $district = json_decode(json_encode($district_array), true);
        return view('admin.pages.vendor-print.fresh-empanelment-form', ['languages' => $languages['original']['data'], 'states' => $states['original']['data'], 'districts' => $district['original']['data'], 'ownerdatas' => $ownerdatas, 'vendordatas' => $vendordatas, 'ownerotherdata' => $ownerotherdata]);
    }

    public function freshEmpanelmentSave(Request $request)
    {
        if ($request->next_tab_1 == 1) {
            $request->validate(
                [
                    'email' => 'required',
                    'mobile' => 'required',
                    'address' => 'required',
                    // 'state' => 'required',
                    'city' => 'required',
                    // 'district' => 'required'
                ]
            );
            $request['client_ip'] = $request->ip();
            $request['user_id'] = session('id');
            $request['activity_id'] = 5;
            $request['page_url'] = url()->current();
            $request['Module_Id'] = 1;
            // $logres = (new logapi)->save_activity_logs($request);
            $resp = (new api)->freshEmpanelmentSaveOwnerData($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }
        // Session::put('email',Session('email') ?? $request->v_email);
        if ($request->next_tab_2 == 1) {
            $request->validate(
                [
                    'newspaper_name' => 'required',
                    'place_of_publication' => 'required',
                    'v_email' => 'required',
                    'v_mobile' => 'required',
                    'v_address' => 'required',
                    'v_state' => 'required',
                    'v_city' => 'required',
                    'v_district' => 'required',
                    'pin_code' => 'required',
                    'language' => 'required',
                    'periodicity' => 'required',
                    'cir_base' => 'required',
                    'claimed_circulation' => 'required',
                    'quality_paper_used' => 'required',
                    'printing_colour' => 'required',
                    'news_agencies_subscribed' => 'required',
                    // 'agencies' => 'required',
                    'price_newspaper' => 'required',
                    'name_of_editor' => 'required',
                    'editor_email' => 'required',
                    'editor_mobile' => 'required',
                    // 'editor_phone' => 'required',
                    'publisher_name' => 'required',
                    'publisher_email' => 'required',
                    'publisher_mobile' => 'required',
                    // 'publisher_phone' => 'required',
                    'printer_name' => 'required',
                    'printer_email' => 'required',
                    'printer_mobile' => 'required',
                    //'printer_phone' => 'required',
                    'name_of_press' => 'required',
                    'press_email' => 'required',
                    'press_mobile' => 'required',
                    // 'press_phone' => 'required',
                    // 'ca_email' => 'required',
                    // 'ca_mobile' => 'required',
                    //'ca_phone' => 'required',
                ]
            );
            $request['client_ip'] = $request->ip();
            $request['user_id'] = session('id');
            $request['activity_id'] = 6;
            $request['page_url'] = url()->current();
            $request['Module_Id'] = 1;
            //$logres = (new logapi)->save_activity_logs($request);
            $resp = (new api)->freshEmpanelmentSaveVendorData($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }
        if ($request->next_tab_3 == 1) {
            $request->validate(
                [
                    'bank_account_no' => 'required',
                    'account_holder_name' => 'required',
                    'bank_name' => 'required',
                    'ifsc_code' => 'required',
                    'branch_name' => 'required',
                    'address_of_account' => 'required',
                    'pan_card' => 'required',
                ]
            );
            $request['client_ip'] = $request->ip();
            $request['user_id'] = session('id');
            $request['activity_id'] = 7;
            $request['page_url'] = url()->current();
            $request['Module_Id'] = 1;
            // $logres = (new logapi)->save_activity_logs($request);
            $resp = (new api)->freshEmpanelmentSaveVendorAccount($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }

        if ($request->submit_btn == 1 && $request->next_tab_1 == 0) {
            if ($request->Modification  == '') {
                $request->validate(
                    [
                        // 'rni_reg_file_name' => 'required',
                        'annexure_file_name' => 'required',
                        //'circulation_cert_file_name' => 'required',
                        // 'annual_return_file_name' => 'required',
                        'specimen_copy_file_name' => 'required',
                        'commercial_rate_file_name' => 'required',
                        // 'no_dues_cert_file_name' => 'required',
                        //'gst_reg_cert_file_name' => 'required',
                        'declaration_field_file_name' => 'required',
                        'pan_copy_file_name' => 'required',
                        // 'dm_declaration_file_name' => 'required',
                        'advertisement_policy' => 'required'
                    ]
                );
            }
            $request['client_ip'] = $request->ip();
            $request['user_id'] = session('id');
            $request['activity_id'] = 8;
            $request['page_url'] = url()->current();
            $request['Module_Id'] = 1;
            // $logres = (new logapi)->save_activity_logs($request);
            $resp = (new api)->freshEmpanelmentSaveVendorDocs($request);
            $response = json_decode(json_encode($resp), true);

            if ($response['original']['success'] == true) {
                if($request->vendorid_tab_4 !=''){

                $res = $this->printPDFCode($request->vendorid_tab_4);
                $details['body'] = 'Thanks for your application at Bureau of Outreach and Communication. Please find attached the application with the file/reference number';
                $details['ref_no'] = $request->vendorid_tab_4;
                $details['content'] = 'The same can be downloaded post login into BOC portal';
                $details['url'] = 'http://104.211.206.19:8585/vendor-login';
                $details['pdf'] = $res->output();

                $details['group_code'] = $request->ownerid ?? '';
                //'ysharma@expediens.com'
                $this->mailSend($details, $request->v_email);
             
                }
                return response()->json(['success' => true, 'message' => $response['original']['message']]);
            } else {
                return response()->json(['success' => false, 'message' => $response['original']['message']]);
            }
        }
        if (@$response['original']['success'] == true) {
            return response()->json($response['original']);
        }
    }


    public function getDistrict(Request $request)
    {
        $districts = (new api)->getDistrictByState($request);
        $response = json_decode(json_encode($districts), true);
        return response()->json(['status' => $response['original']['status'], 'message' => $response['original']['message']]);
    }

    // get exist owner data
    public function existingOwnerData(Request $request)
    {
        $owner_datas = (new api)->existingOwnerData($request);
        $response = json_decode(json_encode($owner_datas), true);
        return response()->json(['status' => $response['original']['status'], 'message' => $response['original']['message']]);
    }

    // check duplicate records into database
    public function checkUniqueOwner($emailparam = '')
    {
        $table1 = '[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2]';
        $count_id = DB::select("select COUNT(*) as count from $table1 where [Email ID] = '" . $emailparam . "' or [Mobile No_] = '" . $emailparam . "'");

        if ($count_id[0]->count > 0) {
            return response()->json(['status' => 0, 'message' => 'already exist']);
        } else {
            return response()->json(['status' => 1, 'message' => 'No data found']);
        }
    }
    public function fetchOwnerRecord(Request $request)
    {
        $request['key'] = 'Email ID';
        $request['owner_id'] = $request->data;
        $ownerdata = (new api)->fetchOwnerRecord($request);
        $ownerdatas = json_decode(json_encode($ownerdata), true);

        //get vendor edition
        $countvendordatas = '';
        $vendorDatas = '';
        $request['Owner_ID'] = $ownerdatas['original']['data'][0]['Owner ID'];
        $vendordatac = (new api)->countVendorRecords($request);
        $vendordata = json_decode(json_encode($vendordatac), true);

        if ($vendordata['original']['success'] == true) {
            $countvendordatas = count($vendordata['original']['data']);
            $vendorDatas = $vendordata['original']['data'];
        }

        if ($ownerdatas['original']['success'] == true) {
            $state_array = (new api)->getStates();
            $states = json_decode(json_encode($state_array), true);
            $state_data = "<option value=''>Select District</option>";
            foreach ($states['original']['data'] as $state) {
                $selected =  $ownerdatas['original']['data'][0]['State'] === $state['Code']  ? 'selected' : '';
                $state_data .= "<option value='" . $state['Code'] . "' $selected>" . $state['Description'] . "</option>";
            }

            $dist_array = (new api)->getAllDistricts();
            $districts = json_decode(json_encode($dist_array), true);
            $dist_data = "<option value=''>Select District</option>";
            foreach ($districts['original']['data'] as $district) {
                $selected =  $ownerdatas['original']['data'][0]['District'] === $district['District']  ? 'selected' : '';
                $dist_data .= "<option value='" . $district['District'] . "' $selected>" . $district['District'] . "</option>";
            }

            return response()->json(['status' => 1, 'message' => $ownerdatas['original']['data'][0], 'state' => $state_data, 'districts' => $dist_data, 'countvendordatas' => $countvendordatas, 'vendordatas' => $vendorDatas]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No data found']);
        }
    }

    public function checkUniqueVendor($emailparam = '')
    {
        $table1 = '[BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2]';
        $count_id = DB::select("select COUNT(*) as count from $table1 where [E-mail ID] = '" . $emailparam . "' or [Mobile No_] = '" . $emailparam . "'");
        if ($count_id[0]->count > 0) {
            return response()->json(['status' => 0, 'message' => 'already exist']);
        } else {
            return response()->json(['status' => 1, 'message' => 'No data found']);
        }
    }

    public function previousLogsave(Request $request)
    {
        // $request->session()->reflash();
        $request['client_ip'] = $request->ip();
        $request['user_id'] = session('id');
        $request['activity_id'] = $request->activity_id;
        $request['page_url'] = url()->current();
        $request['Module_Id'] = 1;
        // $logres = (new logapi)->save_activity_logs($request);
        // $logres = json_decode(json_encode($logres), true);
        //return $logres;
        return true;
    }

    public function checkRegCirBase(Request $request)
    {
        $reg_data = (new api)->checkRegCirBase($request);
        $response = json_decode(json_encode($reg_data), true);
        if ($response['original']['success'] == true) {
            return response()->json(['status' => $response['original']['success'], 'message' => $response['original']['message'], 'data' => $response['original']['data'][0]]);
        } else {
            return response()->json(['status' => $response['original']['success'], 'message' => $response['original']['message'], 'data' => '']);
        }
    }

    public function vendorRateOffered()
    {
        $vendor_datas = (new api)->printRateOffered();
        $response = json_decode(json_encode($vendor_datas), true);
        if ($response['original']['success'] == true) {
            return view('admin.pages.vendor-print.vendor-rate-offered-form', ['data' => $response['original']['data'][0]]);
        } else {
            return view('admin.pages.vendor-print.vendor-rate-offered-form', ['data' => '']);
        }
    }

    public function vendorRateStatusupdate(Request $request)
    {
        $resp = (new api)->printRateStatusupdate($request);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true) {
            return back()->with(['status_msg' => $response['original']['success'], 'message' =>  $response['original']['message']]);
        } else {
            return back()->with(['status_msg' => $response['original']['success'], 'message' => $response['original']['message']]);
        }
    }

    public function getPressOwnerData(Request $request)
    {
        $resp = (new api)->getPressOwnerData($request);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true && count($response['original']['data']) > 0) {
            return response()->json(['status' => true, 'data' => $response['original']['data'][0]]);
        } else {
            return response()->json(['status' => false, 'data' => '']);
        }
    }


    public function printRenewal(Request $request)
    {
        return view('admin.pages.vendor-print.fresh-empanelment-renewal-form');
    }

    public function printRenewalView(Request $request)
    {
        $request->validate(
            [
                'boc_code' => 'required'
            ]
        );
        if (Session::has('UserName') && Session('UserName') != '') {

            $table1 = '[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2]';
            $table2 = '[BOC$Main Newspaper Master$3f88596c-e20d-438c-a694-309eb14559b2]';
            $table3 = '[BOC$NP Rate Renewal$3f88596c-e20d-438c-a694-309eb14559b2]';
            $owner_other_publications = [];
            $owner_datas = '';
            $np_rate_renewal = '';
            $vendor_datas = '';
            //get Owner ID
            $ownerid = '';
            $mnm_table = 'BOC$Main Newspaper Master$3f88596c-e20d-438c-a694-309eb14559b2';
            $owner_id = $this->getOwnerID($mnm_table, Session('UserName'));
            $response_login = json_decode(json_encode($owner_id), true);

            // if ($response_login['original']['success'] == true) {

            $vendor_datas = DB::select("select * from $table2 where [Newspaper Code] = '" . $request->boc_code . "' ");
            // }
            // dd($vendor_datas);
            //end get Owner ID

            if (!empty($vendor_datas[0]->{'Owner ID'})) {
                // $ownerid = $response_login['original']['data'][0]['Owner ID'];
                $owner_datas = DB::select("select * from $table1 where [Owner ID] = '" . $vendor_datas[0]->{'Owner ID'} . "'");
                $owner_other_publications = DB::select("select * from $table2 where [Owner ID] = '" . $vendor_datas[0]->{'Owner ID'} . "' and [Newspaper Code] != '" . $request->boc_code . "' order by [Newspaper Code] desc");
            }
            if (!empty($vendor_datas)) {
                $np_rate_renewal = DB::select("select TOP 1 * from $table3 where [NP Code] = '" . $request->boc_code . "' order by [Line No_] desc");
            }

            $language_array = (new api)->getLanguages();
            $languages = json_decode(json_encode($language_array), true);
            $state_array = (new api)->getStates();
            $states = json_decode(json_encode($state_array), true);
            $district_array = (new api)->getAllDistricts();
            $district = json_decode(json_encode($district_array), true);

            if (!empty($vendor_datas)) {
                return view('admin.pages.vendor-print.fresh-empanelment-renewal-save-form')->with(['owner_datas' => $owner_datas, 'vendor_datas' => $vendor_datas[0], 'owner_other_publications' => $owner_other_publications, 'np_rate_renewal' => $np_rate_renewal, 'languages' => $languages['original']['data'], 'states' => $states['original']['data'], 'districts' => $district['original']['data']]);
            } else {
                return back()->with(['status' => 'Fail', 'message' => 'No data found!']);
            }
        } else {
            return back()->with(['status' => 'Fail', 'message' => 'Not found!']);
        }
    }

    public function printRenewalSave(Request $request)
    {

        $request->validate(
            [
                'v_email' => 'required',
                'v_address' => 'required',
                'claimed_circulation' => 'required',
                'printing_colour' => 'required',
                'page_length' => 'required',
                'page_width' => 'required',
                'publisher_name' => 'required',
                'publisher_email' => 'required',
                'publisher_mobile' => 'required',
                'publisher_address' => 'required',
                'printer_name' => 'required',
                'printer_email' => 'required',
                'printer_phone' => 'required',
                'printer_address' => 'required',
                'dm_declaration_date' => 'required',
                // 'Circulation_File_Name' => 'required',
                // 'DMD_File_Name' => 'required',
            ]
        );
        $resp = (new api)->printRenewalSave($request);

        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true) {
            return response()->json(['success' => true, 'message' => $response['original']['message']]);
        } else {
            return response()->json(['success' => false, 'message' => $response['original']['message']]);
        }
    }
    public function checkUniqueEmailVendor(Request $request)
    {
        $resp = (new api)->checkUniqueEmailVendor($request->email, $request->np_code);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true) {
            return response()->json(['status' => 1, 'message' => 'Email already exist']);
        } else {
            return response()->json(['status' => 0, 'message' => 'No data found']);
        }
    }

    public function checkGstno(Request $request)
    {
        $res = (new api)->checkGSTNo($request);
        $response = json_decode(json_encode($res), true);
        //   dd($response);
        if ($response['original']['success'] == true) {
            return response()->json(['status' => true, 'message' => 'GST No. already exist']);
        } else {
            return response()->json(['status' => false, 'message' => 'No data found']);
        }
    }

    public function checkRenewalGSTNo(Request $request)
    {
        $res = (new api)->checkRenewalGSTNo($request->gst_no, $request->ownerid);
        $response = json_decode(json_encode($res), true);
        //   dd($response);
        if ($response['original']['success'] == true) {
            return response()->json(['status' => true, 'message' => 'GST No. already exist']);
        } else {
            return response()->json(['status' => false, 'message' => 'No data found']);
        }
    }

    public function checkRenewalRegCirBase(Request $request)
    {
        $reg_data = (new api)->checkRenewalRegCirBase($request->cir_no, $request->reg_no, $request->np_code);
        $response = json_decode(json_encode($reg_data), true);
        if ($response['original']['success'] == true) {
            return response()->json(['status' => $response['original']['success'], 'message' => $response['original']['message'], 'data' => $response['original']['data'][0]]);
        } else {
            return response()->json(['status' => $response['original']['success'], 'message' => $response['original']['message'], 'data' => '']);
        }
    }

    public function accountDetail()
    {
        $account_detail = '';
        if (Session::has('UserName') && Session('UserName') != '') {
            $table = 'BOC$Main Newspaper Master$3f88596c-e20d-438c-a694-309eb14559b2';
            $where = array('Newspaper Code' => Session('UserName'));
            $select = array('Bank Account No_', 'Account Holder Name', 'Account Address', 'IFSC Code', 'Bank Name', 'Branch', 'PAN', 'Account Type', 'ESI Account No', 'No_of Employees covered', 'EPF Account No_', 'No_ of EPF Employees covered');
            $res = (new api)->accountDetail($table, $select, $where);
            $account_details = json_decode(json_encode($res), true);
            if ($account_details['original']['success'] == true) {
                $account_detail = $account_details['original']['data'][0];
            } else {
                $account_detail = '';
            }
        } else {
            $table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
            $where = array('User ID' => Session('id'));
            $select = array('Newspaper Code', 'Bank Account No_', 'Account Holder Name', 'Account Address', 'IFSC Code', 'Bank Name', 'Branch', 'PAN', 'Account Type', 'ESI Account No', 'No_of Employees covered', 'EPF Account No_', 'No_ of EPF Employees covered');
            $res = (new api)->accountDetail($table, $select, $where);
            $account_details = json_decode(json_encode($res), true);
            if ($account_details['original']['success'] == true) {
                $account_detail = $account_details['original']['data'][0];
            } else {
                $account_detail = '';
            }
        }
        return view('admin.pages.vendor-print.account-detail-form')->with(['account_detail' => $account_detail]);
    }

    public function accountDetailSave(Request $request)
    {
        $request->validate(
            [
                'account_type' => 'required',
                'bank_account_no' => 'required',
                'account_holder_name' => 'required',
                'bank_name' => 'required',
                'ifsc_code' => 'required',
                'branch_name' => 'required',
                'address_of_account' => 'required',
                'pan_card' => 'required'
            ]
        );

        $resp = (new api)->accountDetailSave($request);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true) {
            Session::flash('account_msg',"Your account information has been updated successfully");
            return redirect()->route('print-account-detail');
            // return back()->with(['status' => $response['original']['success'], 'message' =>  $response['original']['message']]);
        } else {
            return back()->with(['status' => $response['original']['success'], 'message' => $response['original']['message']]);
        }
    }

    public function checkIsPrimaryEdition(Request $request)
    {
        $res = (new api)->isPrimaryEdition($request->owner_id);
        $response = json_decode(json_encode($res), true);
        if ($response['original']['success'] == true) {
            return response()->json(['status' => true, 'message' => $response['original']['data'][0]['Newspaper Name'] . ' edition is already primary']);
        } else {
            return response()->json(['status' => false, 'message' => 'No data found']);
        }
    }

    public function checkgstprint(Request $request)
    {
        $gstNumber = $request->gstNumber;
        $data = $this->AgencyNameFromgst($gstNumber);
        $gst_data = json_decode(json_encode($data), true);
        if ($gst_data['original']['success'] == true) {
            return response()->json($gst_data['original']['data']);
        } else {
            return response()->json($gst_data['original']['data']);
        }
    }

    public function printPDF(Request $request)
    {
        $pdf = $this->printPDFCode($request->np_code);
        return $pdf->download($request->np_code . '.pdf');
    }
    public function printPDFCode($np_code)
    {
        $response = (new api)->printPDFData($np_code);
        $print_data = json_decode(json_encode($response), true);
        $owner = $print_data['original']['data']['owner_details'];
        $vendor = $print_data['original']['data']['vendor_details'];
        $owner_datas = array(
            'owner' => $owner
        );
        $vendor_datas = array(
            'vendor' => $vendor
        );
        $pdf = PDF::loadView('admin.pages.vendor-print.print-pdf', compact('owner_datas', 'vendor_datas'));
        return $pdf;
    }








    //for basic detail
    public function basic_detail(Request $request)
    {

        if (!Session::has('id')) {
            return Redirect('/vendor-login');
        } else {
            $vendor_table = '[BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2]';
            $request['user_id'] = session('id');
            $vendordata = (new api)->fetchVendorRecord($request);
            $vendordatas = json_decode(json_encode($vendordata), true);
            $ownerdatas = '';
            $ownerotherdata = '';
            if ($vendordatas['original']['success'] == true) {
                $request['key'] = 'Owner ID';
                $request['owner_id'] = $vendordatas['original']['data'][0]['Owner ID'];
                $ownerdatas = (new api)->fetchOwnerRecord($request);
                $ownerdatas = json_decode(json_encode($ownerdatas), true);
                $ownerdatas = $ownerdatas['original']['data'] ? $ownerdatas['original']['data'][0] : '';
                $vendordatas = $vendordatas['original']['data'] ? $vendordatas['original']['data'][0] : '';
                if (count($vendordatas) > 0) {
                    $owner_other_data = (new api)->fetchOwnerOtherRecord($request);
                    $owner_other_data = json_decode(json_encode($owner_other_data), true);
                    if ($owner_other_data['original']['success'] == true) {
                        $ownerotherdata = $owner_other_data['original']['data'];
                    }
                }
            } else {
                $vendordatas = '';
            }
        }
        $language_array = (new api)->getLanguages();
        $languages = json_decode(json_encode($language_array), true);
        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);
        $district_array = (new api)->getAllDistricts();
        $district = json_decode(json_encode($district_array), true);
        return view('admin.pages.vendor-print.print-basic-detail', ['languages' => $languages['original']['data'], 'states' => $states['original']['data'], 'districts' => $district['original']['data'], 'ownerdatas' => $ownerdatas, 'vendordatas' => $vendordatas, 'ownerotherdata' => $ownerotherdata]);
    }



    public function basic_detail_save(Request $request)
    {

        $request->validate([
            'owner_name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'owner_type' => 'required',
            'address' => 'required',
            'state' => 'required',
            'district' => 'required',
            'city' => 'required'
          ]);
        

        $user_id=Session::get('id');
        $owner_id=$request->exist_owner_id;
        $newspaper_code=$request->newspaper_code ?? '';


        $ownerdata=[
            "Owner Name"=>$request->owner_name,
            "Email ID"=>$request->email,
            "Mobile No_"=>$request->mobile,
            "Owner Type"=>$request->owner_type,
            "Address 1"=>$request->address,
            "State"=>$request->state,
            "District"=>$request->district,
            "City"=>$request->city,
            "Phone No_"=>$request->phone ?? ''
        ];

        $select = array(
            'PAN Copy',
            'PAN Copy File Name',
            'Newspaper Code'
        );
        
        $vendor_table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
        $where = array('User ID' => $user_id);
        $response = ApiFreshEmpanelment::fetchAllRecords($vendor_table, $select, '', '', $where);
        $destinationPath = public_path() . '/uploads/fresh-empanelment/';
        $mypath = public_path() . '/uploads/fresh-empanelment/' . $newspaper_code . "/";
        if (!File::isDirectory($mypath)) {
            File::makeDirectory($mypath, 0777, true, true);
        }
        
        $pan_copy_file_name = $response[0]->{'PAN Copy File Name'} ?? '';
        $pan_copy = $response[0]->{'PAN Copy'} ?? 0;
        if ($request->hasFile('pan_copy_file_name') || $request->hasFile('pan_copy_file_name_modify')) {
            // $pan_copy = 1;
            $file = $request->file('pan_copy_file_name') ?? $request->file('pan_copy_file_name_modify');
            $pan_copy_file_name = time() . '-' . $newspaper_code . '-PANCopy';
            $file_uploaded = $file->move($destinationPath, $pan_copy_file_name);
            File::copy($destinationPath.$pan_copy_file_name, $mypath.$pan_copy_file_name);
            if ($file_uploaded) {
                $pan_copy = 1;
            } else {
                $pan_copy_file_name = '';
            }
        }
        $update_data=[
            "PAN Copy File Name"=>$pan_copy_file_name
        ];
        $vendordata_save=DB::table('BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2')
                        ->where('User ID',$user_id)
                        ->update($update_data);


        $ownerdata_save=DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->where('Owner ID',$owner_id)->update($ownerdata);
        if($ownerdata_save)
        {
            Session::flash('update_msg',"Data has been update successfully");
            return redirect()->route('basic_detail');
        }
    }
}
