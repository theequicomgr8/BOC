<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTrait;
use DB;
use Carbon\Carbon;
use App\Models\Api\ApiFreshEmpanelment;
use Session;
use App\Models\Api\RateSettlementPersonalMedia;
// use App\Models\Api\MediaCirculation;
use App\Models\Api\MediaCirculation;
use App\Models\Api\MediaCirculationDone;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MediaExcelsImport;
use App\Imports\MediaExcelsImportDone;


use App\Exports\Outdoor\SoleRightMediaExcelExport;
use App\Imports\Outdoor\Media\SoleRightMediaSheets;

class SoleRightMediaController extends Controller
{
    use CommonTrait;

    public function saveSoleRightMedia(Request $request)
    {
        //dd($request);
        $table1 = '[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2]';
        $msg = '';
        $unique_id = array();
        // $ownerids = explode(",", $request->ownerid[0]); 

        if (($request->owner_email) >= 0) {
            foreach ($request->owner_email as $key => $value) {
                $ownerids = DB::select("select [Owner ID] from $table1 where [Email ID] = '" . $request->owner_email[$key] . "' ");
                $ownerid = !empty($ownerids) ? $ownerids[0]->{'Owner ID'} : '';
                if ($ownerid == '') {
                    // dd("insert");
                    $owner_id = DB::select("select TOP 1 [Owner ID] from $table1 order by [Owner ID] desc");
                    //dd($owner_id);
                    if (empty($owner_id)) {
                        $owner_id = 'EMPOW1';
                    } else {
                        $owner_id = $owner_id[0]->{"Owner ID"};
                        $owner_id++;
                    }

                    $owner_name = isset($request->owner_name[$key]) ? $request->owner_name[$key] : '';
                    $mobile = isset($request->owner_mobile[$key]) ? $request->owner_mobile[$key] : '';
                    $email = isset($request->owner_email[$key]) ? $request->owner_email[$key] : '';
                    $phone = isset($request->phone[$key]) ? $request->phone[$key] : '';
                    $fax_no = isset($request->fax_no[$key]) ? $request->fax_no[$key] : '';
                    $address = isset($request->address[$key]) ? $request->address[$key] : '';
                    $city = isset($request->city[$key]) ? $request->city[$key] : '';
                    $district = isset($request->district[$key]) ? $request->district[$key] : '';
                    $state = isset($request->state[$key]) ? $request->state[$key] : '';
                    $user_id = Session::get('UserID');

                    $sql =  DB::insert(
                        "insert into $table1 (
                    [timestamp],
                    [Owner ID],
                    [Owner Name],
                    [Mobile No_],
                    [Email ID],
                    [Phone No_],
                    [Fax No_],
                    [Address 1],
                    [Address 2],
                    [City],
                    [District],
                    [State],
                    [HO Same Address as DO],
                    [DO Address],
                    [DO Landline No_(with STD)],
                    [DO Fax No_],
                    [DO E-Mail],
                    [DO Mobile No_],
                    [DO PIN Code],
                    [DO City],
                    [DO State],
                    [DO District],
                    [PIN Code],
                    [User ID],
                    [Group Name],
                    [Printed],
                    [BR Code],
                    [Pay Mode],
                    [Account No],
                    [Account Type],
                    [MICR Code],
                    [MICR City Code],
                    [Local],
                    [RBI AG Code],
                    [RBI BR Code],
                    [State Code],
                    [STEPS BR Code],
                    [STEPS Account NO],
                    [GRP Password],
                    [STEPS CoreBank],
                    [AUTH Sign Name],
                    [AUTH Sign Desgn],
                    [IFSC Code],
                    [IFSC Account Name],
                    [IFSC Account NO],
                    [IFSC Address],
                    [IFSC File],
                    [Adwing Pay Mode],
                    [PFMS UniqueCode],
                    [Group New Name],
                    [Sanction Payee],
                    [Owner Type]
                    )
                    values (
                    DEFAULT,
                    '" . $owner_id . "',
                    '" . $owner_name . "',
                    '" . $mobile . "',
                    '" . $email . "',
                    '" . $phone . "',
                    '" . $fax_no . "',
                    '" . $address . "',
                    ' ',
                    '" . $city . "',
                    '" . $district . "',
                    '" . $state . "',
                    0,'','','','','','','','','','','" . $user_id . "',
                    '','','','','','','','','','','','','','','','','',
                    '','','','','','','','','','',0
                    )"
                    );
                    $unique_id[] = $owner_id;
                    // Session::put('owneriid',$owner_id);sk
                    //dd($unique_id);
                    $msg = ' Sole right Data Insert Successfully!';
                } else {
                    // dd("update");
                    // $owner = $request->ownerid[$key];
                    $owner_id = $request->owner_email[$key];
                    
                    $Owner_table = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
                    $request->phone = $request->phone[$key] ?? '';
                    $request->fax_no = $request->fax_no[$key] ?? '';
                    $update = array(
                        'Owner Name' => $request->owner_name[$key],
                        'Mobile No_' => $request->owner_mobile[$key],
                        'Email ID' => $request->owner_email[$key],
                        'Phone No_' => $request->phone,
                        'Fax No_' => $request->fax_no,
                        'Address 1' => $request->address[$key],
                        'City' => $request->city[$key],
                        'District' => $request->district[$key],
                        'State' => $request->state[$key]
                    );
                    // $where = array('Owner ID' => $request->ownerid[$key]);
                    $where = array('Email ID' => $request->owner_email[$key]);
                    $sql = ApiFreshEmpanelment::updateAllRecords($Owner_table, $update, $where);
                    $unique_id[] = $owner_id;
                    // Session::put('owneriid',$owner_id);sk
                    //dd($unique_id);
                    $msg = ' sole right Data Updated Successfully!';
                }
            }
        }
        if ($sql) {
            return $this->sendResponse($unique_id, $msg);
        } else {
            return $this->sendError('Some Error Occurred!.444');
            exit;
        }
    }

    public function getMediaExcel(Request $request)
    {
        // lit type section

        $litdata_array = array();
        $excel_data_array = array();
        $litStr = "Bus Panel,Hoarding,Digital Display,Train Inside,Train Outside";

        $lit_arr_data = explode(",", $litStr);
        $subCatTextArr = explode(",", $request->subcattext);
        $i = 0;
        $nonlit = 0;
        foreach ($subCatTextArr as $subcattext) {

            $nonlit = 0;
            foreach ($lit_arr_data as $val) {
                if (str_contains($subcattext, $val)) {
                    $nonlit = 1;
                }
            }

            $litdata_array[$i]['cat'] = $request->cattext;
            $litdata_array[$i]['sub_cat'] = $subcattext;

            if ($nonlit == 1) {

                $litdata_array[$i]['illumination'] = 'Non Lit';
                $litdata_array[$i]['lit_type'] = '';
            } else {

                $litdata_array[$i]['illumination'] = 'Lit';
                $litdata_array[$i]['lit_type'] = 'Front Lit';
            }
            $i++;
        }

        //end lit type section

        $traindata_array = array();
        $no_ofspots_array = array();
        $size_array = array();
        $key_data = array();
        $train_arr_data = "OD029,OD030,OD084,OD108";
        $no_ofspots_arr_data = "OD006,OD013,OD072,OD073,OD110,OD122,OD086,OD087,OD123,OD127";
        $size_arr_data = "OD053,OD010,OD011,OD014,OD017,OD018,OD019,OD020,OD021,OD023,OD024,OD025,OD036,OD037,OD038,OD044,OD047,OD048,OD054,OD055,OD057,OD071,OD082,OD084,OD088,OD089,OD090,OD092,OD095,OD108,OD113,OD117,OD041,OD120,OD035,OD051";

        foreach ($request->subcatvalue as $key => $subcatval) {

            if (strpos($no_ofspots_arr_data, $subcatval) !== false) {
                // no of spots section
                $excel_data_array[$key]['noOfSpotsArray']['Category'] = $request->cattext;
                $excel_data_array[$key]['noOfSpotsArray']['Sub Category'] = $litdata_array[$key]['sub_cat'];
                $excel_data_array[$key]['noOfSpotsArray']['No Of Spots'] = '2340';
                $excel_data_array[$key]['noOfSpotsArray']['Illumination'] = $litdata_array[$key]['illumination'];
                if ($litdata_array[$key]['lit_type'] != '') {
                    $excel_data_array[$key]['noOfSpotsArray']['Lit Type'] = $litdata_array[$key]['lit_type'];
                }
                array_push($key_data, 'noOfSpotsArray');
            } else if (strpos($size_arr_data, $subcatval) !== false) {

                if (strpos($train_arr_data, $subcatval)  !== false) {
                    // size and train section 
                    $excel_data_array[$key]['sizeTrainArray']['Category'] = $request->cattext;
                    $excel_data_array[$key]['sizeTrainArray']['Sub Category'] = $litdata_array[$key]['sub_cat'];

                    $excel_data_array[$key]['sizeTrainArray']['Train Number'] = '23409';
                    $excel_data_array[$key]['sizeTrainArray']['Train Name'] = 'Taj';

                    // $excel_data_array[$key]['sizeTrainArray']['Size Type'] = 'CM';
                    // $excel_data_array[$key]['sizeTrainArray']['Length'] = '56';
                    // $excel_data_array[$key]['sizeTrainArray']['Width'] = '78';

                    $excel_data_array[$key]['sizeTrainArray']['Illumination'] = $litdata_array[$key]['illumination'];
                    if ($litdata_array[$key]['lit_type'] != '') {
                        $excel_data_array[$key]['sizeTrainArray']['Lit Type'] = $litdata_array[$key]['lit_type'];
                    }

                    array_push($key_data, 'sizeTrainArray');
                } else {
                    // size section
                    $excel_data_array[$key]['sizeArray']['Category'] = $request->cattext;
                    $excel_data_array[$key]['sizeArray']['Sub Category'] = $litdata_array[$key]['sub_cat'];
                    
                    // $excel_data_array[$key]['sizeArray']['Size Type'] = 'CM';
                    // $excel_data_array[$key]['sizeArray']['Length'] = '56';
                    // $excel_data_array[$key]['sizeArray']['Width'] = '78';

                    $excel_data_array[$key]['sizeArray']['Illumination'] = $litdata_array[$key]['illumination'];
                    if ($litdata_array[$key]['lit_type'] != '') {
                        $excel_data_array[$key]['sizeArray']['Lit Type'] = $litdata_array[$key]['lit_type'];
                    }

                    array_push($key_data, 'sizeArray');
                }
            } else if (strpos($train_arr_data, $subcatval)  !== false) {
                // train section
                $excel_data_array[$key]['trainArray']['Category'] = $request->cattext;
                $excel_data_array[$key]['trainArray']['Sub Category'] = $litdata_array[$key]['sub_cat'];
                $excel_data_array[$key]['trainArray']['Train Number'] = '23409';
                $excel_data_array[$key]['trainArray']['Train Name'] = 'Taj';

                $excel_data_array[$key]['trainArray']['Illumination'] = $litdata_array[$key]['illumination'];
                if ($litdata_array[$key]['lit_type'] != '') {
                    $excel_data_array[$key]['trainArray']['Lit Type'] = $litdata_array[$key]['lit_type'];
                }
                array_push($key_data, 'trainArray');
            } else {
                //default section
                $excel_data_array[$key]['default']['Category'] = $request->cattext;
                $excel_data_array[$key]['default']['Sub Category'] = $litdata_array[$key]['sub_cat'];
                $excel_data_array[$key]['default']['Illumination'] = $litdata_array[$key]['illumination'];
                if ($litdata_array[$key]['lit_type'] != '') {
                    $excel_data_array[$key]['default']['Lit Type'] = $litdata_array[$key]['lit_type'];
                }
                array_push($key_data, 'default');
            }
        }
        //return (new MediaExcelExport($excel_data_array))->download('media_sample.xlsx');

        $myFile =  Excel::raw(new SoleRightMediaExcelExport($key_data, $excel_data_array), 'Xlsx');

        $response =  array(
            'name' => "outdoor_sample.xlsx",
            'file' => "data:application/vnd.ms-excel;base64," . base64_encode($myFile)
        );
        return response()->json($response);
    }

    /*End Owner function*/

    /*Data insert tab 2nd*/

    public function soleRightSaveVendorData(Request $request)
    {
        // dd($request);
        return DB::transaction(function () use ($request) {
        $unique_id = array();
        $msg = '';
        $lineno1 = [];
        $lineno2 = [];
        $usersid = Session::get('UserID');
        $table3 = '[BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2]';
        $od_media_category = 0;
        //check data is inserted or not in Vendor Emp- OD Media table.
        $Check_vendor_table = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
        $fwhere=array("User ID"=>$usersid,"OD Category"=>0,"Modification"=>0);
        $find_odmedia=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID')->where($fwhere)->orderBy('OD Media ID','desc')->first(); //15 feb sk
        if ($find_odmedia == '' || $find_odmedia == null) {

            $destinationPath = public_path() . '/uploads/sole-right-media/';
          
            if ($request->vendorid_tab_2 == '' || $request->vendorid_tab_2 == null) {
                // $odmedia_id = DB::select('select TOP 1 [OD Media ID] from dbo.[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2] where [OD Media ID] LIKE %OPF%  order by [OD Media ID] desc');

                $odmedia_id=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID')->where('OD Media ID','LIKE','%'.'OPF'.'%')->first();
                

                if (empty($odmedia_id)) {
                    // $odmedia_id = 'POD00001';
                    $odmedia_id = 'OPF000001';
                } else {
                    dd('else');
                    $odmedia_id = $odmedia_id->{"OD Media ID"};
                    $odmedia_id++;
                }
            } else {
                $odmedia_id = $request->vendorid_tab_2;
            }
            $Owner_ids = explode(',', $request->ownerid[0]);         
            $owner_id = isset($Owner_ids) ? $Owner_ids : [];

            //Check data is available or not in "OD Media Owner Detail" table.
            $Check_owner_detail_table = 'BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2';
            $check_owner_detail = DB::table($Check_owner_detail_table)->select('OD Media ID')->where('OD Media ID', $odmedia_id)->first();

            if ($check_owner_detail == '' || $check_owner_detail == null) {

                if (count($owner_id) > 0) {
                    foreach ($owner_id as $key => $value) {
                        $ow_table = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
                        $usersid = Session::get('UserID');
                        $onr_id = DB::table($ow_table)->where('User ID', $usersid)->orderBy('Owner ID', 'desc')->value('Owner ID');

                        //relation create between Owner and OD Media Owner Detail table
                        $sql3 =  DB::insert("insert into $table3([timestamp],[OD Media Type],[OD Media ID],[Owner ID],[Allocated Vendor Code])values(DEFAULT,$od_media_category,'" . $odmedia_id . "','" . $onr_id . "','')");
                    }
                    if (!$sql3) {
                        return $this->sendError('Some Error Occurred!.5555');
                        exit;
                    }
                }
            }

            //Check data is available or not in "OD Media Work Done".
            $Check_media_work_table = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
            $check_media_work = DB::table($Check_media_work_table)->select('OD Media ID')->where('OD Media ID', $request->vendorid_tab_2)->first();
            if($request->xls2==0)
            {
                if ($check_media_work == '' || $check_media_work == null) {
                    //media work donedata   save
                    $table4 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';

                    if(!empty($request->ODMFO_Billing_Amount[0])){
                        $dataFile = array();
                      
                        foreach ($request->ODMFO_Billing_Amount as $key => $value) {
                            $line_no = DB::select("select TOP 1 [Line No_] from $table4 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
                            if (empty($line_no)) {
                                $line_no = 10000;
                            } else {
                                $line_no = $line_no[0]->{"Line No_"};
                                $line_no = $line_no + 10000;
                            }
                            $workName = isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';
                            $ODMFO_Year = isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
                            $ODMFO_Quantity_Of_Display_Or_Duration = isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 0;
                            $ODMFO_Billing_Amount = isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;
                        
                            $from_date = isset($request->from_date[$key]) ? $request->from_date[$key] : '1753-01-01 00:00:00.000';
                            $to_date = isset($request->to_date[$key]) ? $request->to_date[$key] : '1753-01-01 00:00:00.000';
                            DB::unprepared('SET ANSI_WARNINGS OFF');

                            $sql4 = DB::insert("insert into $table4([timestamp],[OD Media Type],[OD Media ID],[Line No_],[Work Name],[Year],[Qty Of Display_Duration],[Billing Amount],[Allocated Vendor Code],[From Date],[To Date]) values(DEFAULT,$od_media_category,'" . $odmedia_id . "',$line_no,'" . $workName . "','" . $ODMFO_Year . "',$ODMFO_Quantity_Of_Display_Or_Duration,$ODMFO_Billing_Amount,'','".$from_date."','".$to_date."')");
                            $lineno2[] = $line_no;
                            $request->session()->put('line2', $lineno2);
                            DB::unprepared('SET ANSI_WARNINGS ON');
                        }
                        if (!$sql4) {
                            return $this->sendError('Some Error Occurred!.6666');
                            exit;
                        }
                    }
                }
            }


            //9 feb 
            foreach($request->Authorized_Rep_Name as $key => $rep_name)
            {
                $line_no = DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();
                if (empty($line_no)) {
                    $line_no = 10000;
                } else {
                    $line_no = $line_no->{"Line No_"};
                    $line_no = $line_no + 10000;
                }

                $authorized_data=array(
                    "OD Media Type" =>0,
                    "OD Media ID" =>$odmedia_id,
                    "Line No_" =>$line_no,
                    "AR Name" =>$rep_name,
                    "AR Address"=> $request->AR_Address[$key] ?? '',
                    "AR Mobile"=> $request->AR_Mobile_No[$key] ?? '',
                    "AR Phone No_" => $request->AR_Landline_No[$key] ?? '',
                    "AR Email" => $request->AR_Email[$key] ?? '',
                    "Company Legal Status"=>$request->Legal_Status_of_Company[$key] ?? '',
                    "Alternate Mobile No_" =>$request->altername_mobile[$key] ?? '',
                    "User ID"=>Session::get('UserID')
                );
                
                $aut=DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->insert($authorized_data);
            }
            if (!$aut) {
                return $this->sendError('Some Error Occurred! OD Auth Reper table');
                exit;
            }

            //10 feb insert time branch address
            if($request->BO_Address!='')
            {
                foreach($request->BO_Address as $key => $branch_address)
                {
                    $line_no = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();
                    if (empty($line_no)) {
                        $line_no = 10000;
                    } else {
                        $line_no = $line_no->{"Line No_"};
                        $line_no = $line_no + 10000;
                    }

                    $branch_data=array(
                        "OD Media Type" =>0,
                        "OD Media ID" =>$odmedia_id,
                        "Line No_" =>$line_no,
                        "State" => $request->BO_state[$key] ?? '',
                        "BO Address"=> $branch_address ?? '',
                        "BO Landline No_"=> $request->BO_Landline_No[$key] ?? '',
                        "BO E-mail" => $request->BO_Email[$key] ?? '',
                        "BO Mobile No_" => $request->BO_Mobile[$key] ?? '',
                        "User ID"=>Session::get('UserID')
                    );
                    
                    $branch=DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->insert($branch_data);
                }
                if (!$branch) {
                    return $this->sendError('Some Error Occurred! In Branch Detail');
                    exit;
                }
            }

            //Check data is available or not "Sole Medias Address"
            $Check_sole_media_table = 'BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2';
            $check_sole_media = DB::table($Check_sole_media_table)->select('Sole Media ID')->where('Sole Media ID', $request->vendorid_tab_2)->first();
            if($request->xls==0)
            {
                if ($check_sole_media == '' || $check_sole_media == null) {
                    // save Media Address 
                    $table5 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]';

                        if(!empty($request->MA_City[0])){
                        foreach ($request->MA_City as $key => $value) {
                            $line_no = DB::select("select TOP 1 [Line No_] from $table5 where [Sole Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
                            if (empty($line_no)) {
                                $line_no = 10000;
                            } else {
                                $line_no = $line_no[0]->{"Line No_"};
                                $line_no = $line_no + 10000;
                            }

                            if (!empty($request->MA_City[0])) {
                                $MA_City = isset($request->MA_City[$key]) ? $request->MA_City[$key] : '';
                                $MA_State  = isset($request->MA_State[$key]) ? $request->MA_State[$key] : '';
                                $MA_District = isset($request->MA_District[$key]) ? $request->MA_District[$key] : '';
                                $MA_Zone = isset($request->MA_Zone[$key]) ? $request->MA_Zone[$key] : 0;

                                //add extra field sk start
                                $Applying_For_OD_Media_Type = isset($request->Applying_For_OD_Media_Type[$key]) ? $request->Applying_For_OD_Media_Type[$key] : 0;
                                $ODMFO_Display_Size_Of_Media = isset($request->ODMFO_Display_Size_Of_Media[$key]) ? $request->ODMFO_Display_Size_Of_Media[$key] : 0;
                                $Illumination_media = isset($request->Illumination_media[$key]) ? $request->Illumination_media[$key] : 0;
                                $od_media_type = isset($request->od_media_type[$key]) ? $request->od_media_type[$key] : 0;

                                $av_start_date = isset($request->av_start_date[$key]) ? $request->av_start_date[$key] : '1753-01-01';
                                $av_end_date = isset($request->av_end_date[$key]) ? $request->av_end_date[$key] : '1753-01-01';

                                //add extra field sk end

                                $MA_Latitude = isset($request->MA_Latitude[$key]) ? $request->MA_Latitude[$key] : 0;
                                $MA_Longitude = isset($request->MA_Longitude[$key]) ? $request->MA_Longitude[$key] : 0;
                                $MA_Property_Landmark = isset($request->MA_Property_Landmark[$key]) ? $request->MA_Property_Landmark[$key] : 0;
                                $Image_File_Name = isset($request->Image_File_Name[$key]) ? $request->Image_File_Name[$key] : '';

                                $length = isset($request->length[$key]) ? $request->length[$key] : 0;
                                $width = isset($request->width[$key]) ? $request->width[$key] : 0;
                                $quantity = isset($request->quantity[$key]) ? $request->quantity[$key] : 0;
                                $total_area = $length * $width;
                                $trainData = isset($request->Train_Data[$key]) ? explode("-",$request->Train_Data[$key]) : '';
                                $Train_No = isset($request->Train_Data[$key]) ? trim($trainData[0]) : '';
                                $Train_Name = isset($request->Train_Data[$key]) ? trim($trainData[1]) : '';
                                $Size_Type = isset($request->Size_Type[$key]) ? $request->Size_Type[$key] : 0;
                                $No_of_Spot = isset($request->No_of_Spots[$key]) ? $request->No_of_Spots[$key] : 0;
                                $lit_type = isset($request->lit_type[$key]) ? $request->lit_type[$key] : 0;

                                DB::unprepared('SET ANSI_WARNINGS OFF');
                                $table55 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]';
                                $sql5 = DB::insert("insert into $table5([timestamp],[OD Media Type],[Sole Media ID],[Line No_],[City],[State], [District],[Zone],[Latitude],[Longitde],[Landmark],[Image File Name],[OD Media ID],[Display Size],[Illumination Type],[Availability Start Date],[Availability End Date],[Length],[Width],[Total Area],[Rental],[Rental Type],[Quantity],[Train Number],[Train Name],[Size Type],[Duration],[No Of Spot],[Lit Type]) values(DEFAULT,$Applying_For_OD_Media_Type,'" . $odmedia_id . "',$line_no,'" . $MA_City . "','" . $MA_State . "','" . $MA_District . "',$MA_Zone,$MA_Latitude,$MA_Longitude,'" . $MA_Property_Landmark . "','" . $Image_File_Name . "','" . $od_media_type . "','" . $ODMFO_Display_Size_Of_Media . "','" . $Illumination_media . "','" . $av_start_date . "','" . $av_end_date . "','".$length."','".$width."','".$total_area."',0,0,'".$quantity."','".$Train_No."','".$Train_Name."',$Size_Type,0,$No_of_Spot,$lit_type)");
                                $lineno1[] = $line_no;
                                $request->session()->put('line1', $lineno1);
                                DB::unprepared('SET ANSI_WARNINGS ON');
                            }
                        }
                    }
                } //main sole media if condition close
            }
            
            $Notarized_Copy_Of_Agreement = 0;
            $Attach_Copy_Of_Pan_Number = 0;
            $Affidavit_Of_Oath = 0;
            $Photographs = 0;
            $Company_Legal_Documents = 0;
            $GST_Registration = 0;
            $CA_Certified_Balance_Sheet = 0;


            if ($request->hasFile('Notarized_Copy_File_Name')) {
                $file = $request->file('Notarized_Copy_File_Name');
                $Notarized_Copy_File_Name = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $Notarized_Copy_File_Name);
                if ($fileUploaded) {
                    $Notarized_Copy_Of_Agreement = 1;
                }
            } else {
                $Notarized_Copy_File_Name = '';
            }
            if ($request->hasFile('Attach_Copy_Of_Pan_Number_File_Name')) {
                $file = $request->file('Attach_Copy_Of_Pan_Number_File_Name');
                $Attach_Copy_Of_Pan_Number_File_Name = time() . '-' . $file->getClientOriginalName();
                $fileUploaded =  $file->move($destinationPath, $Attach_Copy_Of_Pan_Number_File_Name);
                if ($fileUploaded) {
                    $Attach_Copy_Of_Pan_Number = 1;
                }
            } else {
                $Attach_Copy_Of_Pan_Number_File_Name = '';
            }
            if ($request->hasFile('Affidavit_File_Name')) {
                $file = $request->file('Affidavit_File_Name');
                $Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $Affidavit_File_Name);
                if ($fileUploaded) {
                    $Affidavit_Of_Oath = 1;
                }
            } else {
                $Affidavit_File_Name = '';
            }
            if ($request->hasFile('Photo_File_Name')) {
                $file = $request->file('Photo_File_Name');
                $Photo_File_Name = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $Photo_File_Name);
                if ($fileUploaded) {
                    $Photographs = 1;
                }
            } else {
                $Photo_File_Name = '';
            }
            if ($request->hasFile('Legal_Doc_File_Name')) {
                $file = $request->file('Legal_Doc_File_Name');
                $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
                if ($fileUploaded) {
                    $Company_Legal_Documents = 1;
                }
            } else {
                $Legal_Doc_File_Name = '';
            }
            if ($request->hasFile('GST_File_Name')) {
                $file = $request->file('GST_File_Name');
                $GST_File_Name = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $GST_File_Name);
                if ($fileUploaded) {
                    $GST_Registration = 1;
                }
            } else {
                $GST_File_Name = '';
            }
            if ($request->hasFile('Balance_Sheet_File_Name')) {
                $file = $request->file('Balance_Sheet_File_Name');
                $Balance_Sheet_File_Name = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $Balance_Sheet_File_Name);
                if ($fileUploaded) {
                    $CA_Certified_Balance_Sheet = 1;
                }
            } else {
                $Balance_Sheet_File_Name = '';
            }

            if ($request->self_declaration == "on" || $request->self_declaration == "On" || $request->self_declaration == "ON") {
                $Self_declaration = 1;
            } else {
                $Self_declaration = 0;
            }

            $HO_Address =
                isset($request->HO_Address) ? $request->HO_Address : '';
            $HO_Landline_No =
                isset($request->HO_Landline_No) ? $request->HO_Landline_No : '';
            $HO_Fax_No =
                isset($request->HO_Fax_No) ? $request->HO_Fax_No : '';
            $HO_Email =
                isset($request->HO_Email) ? $request->HO_Email : '';
            $HO_Mobile_No =
                isset($request->HO_Mobile_No) ? $request->HO_Mobile_No : '';
            $BO_Address =
                isset($request->BO_Address) ? $request->BO_Address : '';
            $BO_Landline_No =
                isset($request->BO_Landline_No) ? $request->BO_Landline_No : '';
            $BO_Fax_No =
                isset($request->BO_Fax_No) ? $request->BO_Fax_No : '';
            $BO_Email =
                isset($request->BO_Email) ? $request->BO_Email : '';
            $BO_Mobile =
                isset($request->BO_Mobile) ? $request->BO_Mobile : '';
            $DO_Address =
                isset($request->DO_Address) ? $request->DO_Address : '';
            $DO_Landline_No =
                isset($request->BO_DO_Landline_NoMobile) ? $request->DO_Landline_No : '';
            $DO_Fax_No =
                isset($request->DO_Fax_No) ? $request->DO_Fax_No : '';
            $DO_Email =
                isset($request->DO_Email) ? $request->DO_Email : '';
            $DO_Mobile =
                isset($request->DO_Mobile) ? $request->DO_Mobile : '';
            $Authorized_Rep_Name = '';
                
            $AR_Address = '';
                
            $AR_Landline_No = '';
                
            $AR_FAX_No = '';
                
            $AR_Email = '';
                
            $AR_Mobile_No = '';
                
            $Legal_Status_of_Company =0;
                
            $Authority_Which_granted_Media =
                isset($request->Authority_Which_granted_Media) ? $request->Authority_Which_granted_Media : '';
            $Amount_paid_to_Authority =
                isset($request->Amount_paid_to_Authority) ? $request->Amount_paid_to_Authority : 0;

            $Contract_No =
                isset($request->Contract_No) ? $request->Contract_No : '';
            $License_Fee =
                isset($request->License_Fee) ? $request->License_Fee : 0;
            $Quantity_Of_Display =
                isset($request->Quantity_Of_Display) ? $request->Quantity_Of_Display : 0;
            $License_From =
                isset($request->License_From) ? $request->License_From : '';
            $License_To =
                isset($request->License_To) ? $request->License_To : '';
            $Media_Type =
                isset($request->Media_Type) ? $request->Media_Type : '1753-01-01';
            $Rental_Agreement =
                isset($request->Rental_Agreement) ? $request->Rental_Agreement : 0;
            $Applying_For_OD_Media_Type =
                isset($request->Applying_For_OD_Media_Type) ? $request->Applying_For_OD_Media_Type : 0;
            $ODMFO_Display_Size_Of_Media =
                isset($request->ODMFO_Display_Size_Of_Media) ? $request->ODMFO_Display_Size_Of_Media : '0';
            // $Illumination_media =
            //     isset($request->Illumination_media) ? $request->Illumination_media : 0; sk
            $GST_No =
                isset($request->GST_No) ? $request->GST_No : '';
            $TIN_TAN_VAT_No =
                isset($request->TIN_TAN_VAT_No) ? $request->TIN_TAN_VAT_No : '';
            $Other_Relevant_Information =
                isset($request->Other_Relevant_Information) ? $request->Other_Relevant_Information : '';
            $DD_No =
                isset($request->DD_No) ? $request->DD_No : '';
            $DD_Date =
                isset($request->DD_Date) ? $request->DD_Date : '';
            $DD_Bank_Name =
                isset($request->DD_Bank_Name) ? $request->DD_Bank_Name : '';
            $DD_Bank_Branch_Name =
                isset($request->DD_Bank_Branch_Name) ? $request->DD_Bank_Branch_Name : '';
            $Application_Amount =
                isset($request->Application_Amount) ? $request->Application_Amount : 0;
            $PM_Agency_Name =
                isset($request->PM_Agency_Name) ? $request->PM_Agency_Name : '';
            $PAN =
                isset($request->PAN) ? $request->PAN : '';
            $Bank_Name =
                isset($request->Bank_Name) ? $request->Bank_Name : '';
            $Bank_Branch =
                isset($request->Bank_Branch) ? $request->Bank_Branch : '';
            $IFSC_Code =
                isset($request->IFSC_Code) ? $request->IFSC_Code : '';
            $Account_No =
                isset($request->Account_No) ? $request->Account_No : '';
            //dd($DD_No);

            //Check data is inserted or not in "Vendor Emp - OD Media" table.
            $Check_vendor_table = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
            $check_vendor = DB::table($Check_vendor_table)->select('OD Media ID')->where('OD Media ID', $request->vendorid_tab_2)->first();

            if ($check_vendor == '' || $check_vendor == null) {
                $user_id = Session::get('UserID');  //for get user id 

                //Get value for Receiver ID.
                $receiver_table = '[BOC$Media Plan Setup$3f88596c-e20d-438c-a694-309eb14559b2]';
                $get_receiver_code = DB::select("select TOP 1 [OD Vend Landing UID] from dbo.$receiver_table");
                $recervier_id = $get_receiver_code[0]->{"OD Vend Landing UID"};
                // $recervier_id = "MKTA";

                //second tab file upload
                $file_check = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmedia_id)->first();
                $destinationPath = public_path() . '/uploads/sole-right-media/';
                $file_name = $file_check->{'File Name'} ?? '';
                if ($request->hasFile('file_name') || $request->hasFile('file_name_modify')) {
                    $file = $request->file('file_name') ?? $request->file('file_name_modify');
                    $file_name = time() . '-' . $file->getClientOriginalName();
                    $file_uploaded = $file->move($destinationPath, $file_name);
                    if ($file_uploaded) {
                        $Notarized_Copy_Of_Agreement = 1;
                    } else {
                        $file_name = '';
                    }
                }

                $table2 = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
                DB::unprepared('SET ANSI_WARNINGS OFF');
                $sql2 =
                    DB::insert("insert into $table2
            (
              [timestamp],
              [OD Category],
              [OD Media ID],
              [HO Address],
              [HO Landline No_],
              [HO Fax No_],
              [HO E-Mail],
              [HO Mobile No_],
              [DO Address],
              [DO Landline No_],
              [DO Fax No_],
              [DO E-Mail],
              [DO Mobile No_],
              [Legal Status of Company],
              [Authority Which granted Media],
              [Amount paid to Authority],
              [Contract No_],
              [License Fees],
              [Quantity Of Display],
              [License From],
              [License To],
              [Duration],
              [Rental Agreement],
              [Applying For OD Media Type],
              [Media Display size],
              [Illumination],
              [GST No_],
              [TIN_TAN_VAT No_],
              [Other Relevant Information],
              [DD No_],
              [DD Date],
              [DD Bank Name],
              [DD Bank Branch Name],
              [Application Amount],
              [PM Agency Name],
              [PAN],
              [Bank Name],
              [Bank Branch],
              [IFSC Code],
              [Account No_],
              [Notarized Copy File Name],
              [PAN File Name],
              [Affidavit File Name],
              [Photo File Name],
              [Legal Doc File Name],
              [GST File Name],
              [Balance Sheet File Name],
              [Notarized Copy Of Agreement],
              [PAN Attached],
              [Affidavit Of Oath],
              [Photographs],
              [Company Legal Documents],
              [GST Registration],
              [CA Certified Balance Sheet],
              [Self-declaration],
              [User Id],
              [Status],
              [Global Dimension 1 Code],
              [Global Dimension 2 Code],
              [Sender ID],
              [Receiver ID],
              [Recommended To Committee],
              [Modification],
              [Media Sub Category],
              [Rate],
              [Rate Status],
              [Rate Remark],
              [Rate Status Date],
              [Agr File Path],
              [Agr File Name],
              [Allocated Vendor Code],
              [Document Date],
              [Empanelment Category],
              [From Date],
              [To Date],
              [File Name],
              [File Uploaded],
              [Application Type],
              [Cancelled Cheque File Name]
            )
              values
              (
                DEFAULT,
                $od_media_category,
                '" . $odmedia_id . "',
                '" . $HO_Address . "',
                '" . $HO_Landline_No . "',
                '" . $HO_Fax_No . "',
                '" . $HO_Email . "',
                '" . $HO_Mobile_No . "',
                '" . $DO_Address . "',
                '" . $DO_Landline_No . "',
                '" . $DO_Fax_No . "',
                '" . $DO_Email . "',
                '" . $DO_Mobile . "',
                $Legal_Status_of_Company,
                '" . $Authority_Which_granted_Media . "',
                $Amount_paid_to_Authority,
                '" . $Contract_No . "',
                $License_Fee,
                $Quantity_Of_Display,
                '" . $License_From . "',
                '" . $License_To . "',
                $Media_Type,
                $Rental_Agreement,
                0,
                '',
                '',
                '" . $GST_No . "',
                '" . $TIN_TAN_VAT_No . "',
                '" . $Other_Relevant_Information . "',
                '" . $DD_No . "',
                '" . $DD_Date . "',
                '" . $DD_Bank_Name . "',
                '" . $DD_Bank_Branch_Name . "',
                $Application_Amount,
                '" . $PM_Agency_Name . "',
                '" . $PAN . "',
                '" . $Bank_Name . "',
                '" . $Bank_Branch . "',
                '" . $IFSC_Code . "',
                '" . $Account_No . "',
                '" . $Notarized_Copy_File_Name . "',
                '" . $Attach_Copy_Of_Pan_Number_File_Name . "',
                '" . $Affidavit_File_Name . "',
                '" . $Photo_File_Name . "',
                '" . $Legal_Doc_File_Name . "',
                '" . $GST_File_Name . "',
                '" . $Balance_Sheet_File_Name . "',
                $Notarized_Copy_Of_Agreement,
                $Attach_Copy_Of_Pan_Number,
                $Affidavit_Of_Oath,
                $Photographs,
                $Company_Legal_Documents,
                $GST_Registration,
                $CA_Certified_Balance_Sheet,
                $Self_declaration,
                '" . $user_id . "',
                0,
                'M003',
                '',
                '',
                '" . $recervier_id . "',
                0,
                0,
                '',
                0,
                0,
                '',
                '1753-01-01',
                '',
                '',
                '".$odmedia_id."',
                '1753-01-01',
                1,
                '1753-01-01 00:00:00.000',
                '1753-01-01 00:00:00.000',
                '".$file_name."',
                1,
                0,
                ''
            )");
            }
            $excel_odmedia_id = Session::put('ex_odmediaid', $odmedia_id);
            if($request->xls=='1' || $request->xls2=='1')
            {
                if ($request->hasfile('media_import') && $request->hasfile('media_import2')) {
                    try {
                        Excel::import(new SoleRightMediaSheets, request()->file('media_import')); //for import
                        Excel::import(new MediaExcelsImportDone, request()->file('media_import2')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                }
                elseif ($request->hasfile('media_import')) {
                    try {
                        Excel::import(new SoleRightMediaSheets, request()->file('media_import')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                }
                elseif ($request->hasfile('media_import2')) {
                    try {
                        Excel::import(new MediaExcelsImportDone, request()->file('media_import2')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                }
            }
            //excel file upload in work done field
            // if ($request->hasfile('media_import2')) {
            //     try {
            //         // DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where($whee)->delete();
            //         Excel::import(new MediaExcelsImportDone, request()->file('media_import2')); //for import
            //         return $this->sendResponse('', 'Data Import successfully second');
            //     } catch (ValidationException $ex) {

            //         $failures = $ex->failures();
            //         foreach ($failures as $failure) {
            //             return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
            //         }
            //     }
            // }


            $msg = 'Sole Right Vendor Data Save Successfully!';
            $unique_id[] =  $odmedia_id;
        } 
        else 
        { //update query
            // PM_Agency_Name

            // return DB::transaction(function () use ($request) 
            // {
            // dd('update');
            $lineno1 = explode(",", $request->lineno1);
            $lineno2 = explode(",", $request->lineno2);

            $line2 = $request->line_no; //ram code
            $line2 = $request->session()->get('line2');
            $table4 = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
            // $odmedia_id = $request->vendorid_tab_2; //15 feb
            $f_where=array("User ID"=>$usersid,"OD Category"=>0,"Modification"=>0);
            @$find_odmedia=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID')->where($f_where)->orderBy('OD Media ID','desc')->first(); //15 feb sk
            // dd($find_odmedia->{'OD Media ID'});
            $odmedia_id=@$find_odmedia->{'OD Media ID'}; 
            // dd($odmedia_id);
            // dd($odmedia_id);
            // if (count($request->ODMFO_Year) > 0 ) { comment by sk 12-Feb becouse always count 1 when import excel
                $workcheck = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmedia_id)->first();
                if ($workcheck) {
                    DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmedia_id)->delete();
                }

                if($request->xls2==0)
                {
                    if(!empty($request->ODMFO_Billing_Amount[0]))
                    {
                        $table66 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';
                        $table55 = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
                        $line_no_val = DB::select("select [Line No_] from $table66 where [OD Media ID] = '" . $odmedia_id . "'");

                        $linenn_no = !empty($line_no_val) ? count($line_no_val) : 0;
                        if ($linenn_no > 0) 
                        {
                            DB::table($table55)->where('OD Media ID', $odmedia_id)->where('OD Media Type', 0)->delete();
                        }

                        foreach ($request->ODMFO_Billing_Amount as $key => $value) 
                        { //ram code start

                           
                            $table6 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';
                            $table5 = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
                            $ODMFO_Year  =
                                isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
                            $ODMFO_Quantity_Of_Display_Or_Duration =
                                isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 00;
                            $ODMFO_Billing_Amount =
                                isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;
                            
                            $from_date = isset($request->from_date[$key]) ? $request->from_date[$key] : '1753-01-01 00:00:00.000';
                            $to_date = isset($request->to_date[$key]) ? $request->to_date[$key] : '1753-01-01 00:00:00.000';


                            $unique_id = $odmedia_id;
                            $msg = 'Personal Media Vender Data Updated Successfully!';


                            $workName = isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';
                            //sk change 
                            $next_line_no = DB::select("select TOP 1 [Line No_] from $table6 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
                            if (empty($next_line_no)) {
                                $next_line_no = 10000;
                            } else {
                                $next_line_no = $next_line_no[0]->{"Line No_"};
                                $next_line_no = $next_line_no + 10000;
                            }

                            DB::unprepared('SET ANSI_WARNINGS OFF');
                            $od_media_category=0;
                            $sql4 = DB::insert(
                                "insert into $table6 
                                ([timestamp],
                                [OD Media Type],
                                [OD Media ID],
                                [Line No_],
                                [Work Name],
                                [Year],
                                [Qty Of Display_Duration],
                                [Billing Amount],
                                [Allocated Vendor Code],
                                [From Date],
                                [To Date]
                                ) values(DEFAULT,
                                $od_media_category,
                                '" . $odmedia_id . "',
                                $next_line_no,
                                '" . $workName . "',
                                '" . $ODMFO_Year . "',
                                $ODMFO_Quantity_Of_Display_Or_Duration,$ODMFO_Billing_Amount,
                                '','".$from_date."','".$to_date."')"
                            );

                            DB::unprepared('SET ANSI_WARNINGS ON');
                            // }
                        } //ram code end
                }
            }   

            $line1 = $request->session()->get('line1');
            $table5 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]';
            // dd($request->length);
            $check = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID', $odmedia_id)->first();
            if ($check) {
                DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID', $odmedia_id)->delete();
            }

            if($request->xls==0)
            {
                if (!empty($request->MA_City[0])) {
                    foreach ($request->MA_City as $key => $value) {
                        $MA_City =
                            isset($request->MA_City[$key]) ? $request->MA_City[$key] : '';

                        $MA_State  =
                            isset($request->MA_State[$key]) ? $request->MA_State[$key] : '';
                        $MA_District =
                            isset($request->MA_District[$key]) ? $request->MA_District[$key] : '';

                        $MA_Zone =
                            isset($request->MA_Zone[$key]) ? $request->MA_Zone[$key] : 0;

                        //add extra field sk start
                        $Applying_For_OD_Media_Type = isset($request->Applying_For_OD_Media_Type[$key]) ? $request->Applying_For_OD_Media_Type[$key] : '';
                        $ODMFO_Display_Size_Of_Media = isset($request->ODMFO_Display_Size_Of_Media[$key]) ? $request->ODMFO_Display_Size_Of_Media[$key] : 0;
                        $Illumination_media = isset($request->Illumination_media[$key]) ? $request->Illumination_media[$key] : '';

                        $od_media_type = isset($request->od_media_type[$key]) ? $request->od_media_type[$key] : 0;

                        $av_start_date = isset($request->av_start_date[$key]) ? $request->av_start_date[$key] : '1753-01-01';
                        $av_end_date = isset($request->av_end_date[$key]) ? $request->av_end_date[$key] : '1753-01-01';
                        //add extra field sk end

                        $MA_Latitude =
                            isset($request->MA_Latitude[$key]) ? $request->MA_Latitude[$key] : 0;
                        $MA_Longitude =
                            isset($request->MA_Longitude[$key]) ? $request->MA_Longitude[$key] : 0;
                        $MA_Property_Landmark =
                            isset($request->MA_Property_Landmark[$key]) ? $request->MA_Property_Landmark[$key] : 0;
                        $Image_File_Name =
                            isset($request->Image_File_Name[$key]) ? $request->Image_File_Name[$key] : '';

                        $length = isset($request->length[$key]) ? $request->length[$key] : 0;
                        $width = isset($request->width[$key]) ? $request->width[$key] : 0;
                        $quantity = isset($request->quantity[$key]) ? $request->quantity[$key] : 0;
                        $total_area=$length * $width;
                        $trainData = isset($request->Train_Data[$key]) ? explode("-",$request->Train_Data[$key]) : '';
                        $Train_No = isset($request->Train_Data[$key]) ? trim($trainData[0]) : 0;
                        $Train_Name = isset($request->Train_Data[$key]) ? trim($trainData[1]) : 0;
                        $Size_Type = isset($request->Size_Type[$key]) ? $request->Size_Type[$key] : 0;
                        $No_of_Spot = isset($request->No_of_Spots[$key]) ? $request->No_of_Spots[$key] : 0;
                        $lit_type = isset($request->lit_type[$key]) ? $request->lit_type[$key] : 0;

                        DB::unprepared('SET ANSI_WARNINGS OFF');

                        $mediaaatable = 'BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2';

                        $line_id = DB::table($mediaaatable)->select('Line No_')->where('Sole Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();

                        if (empty($line_id)) {
                            $line_id = '10000';
                        } else {
                            $line_id = $line_id->{"Line No_"};
                            $line_id++;
                        }
                        // dd($line_id);

                        $sql2 =
                            DB::insert("insert into $table5
                            (
                            [timestamp],
                            [City],
                            [State],
                            [District],
                            [Zone],
                            [Latitude],
                            [Longitde],
                            [Landmark],
                            [Image File Name],
                            [OD Media Type],
                            [Sole Media ID],
                            [Line No_],
                            [OD Media ID],
                            [Display Size],
                            [Illumination Type],
                            [Availability Start Date],
                            [Availability End Date],
                            [Length],
                            [Width],
                            [Total Area],
                            [Rental],
                            [Rental Type],
                            [Quantity],
                            [Train Number],
                            [Train Name],
                            [Size Type],
                            [Duration],
                            [No Of Spot],
                            [Lit Type]
                            )
                            values
                            (
                                DEFAULT,
                                '" . $value . "',
                                '" . $MA_State . "',
                                '" . $MA_District . "',
                                     $MA_Zone ,
                                0,
                                0,
                                '',
                                '',
                                '" . $Applying_For_OD_Media_Type . "',
                                '" . $odmedia_id . "',
                                '" . $line_id . "',
                                '" . $od_media_type . "',
                                '" . $ODMFO_Display_Size_Of_Media . "',
                                '" . $Illumination_media . "',
                                '" . $av_start_date . "',
                                '" . $av_end_date . "',
                                '".$length."',
                                '".$width."',
                                '".$total_area."',
                                0,
                                0,
                                '". $quantity ."',
                                '". $Train_No ."',
                                '". $Train_Name ."',
                                $Size_Type,
                                0,
                                $No_of_Spot,
                                $lit_type
                            )");

                        $unique_id = $odmedia_id;
                        $msg = 'Data Updated Successfully!';
                    }
                }
            }


            //9 feb update time
            $where=array('OD Media ID' => $odmedia_id,"OD Media Type" =>0);
            DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->delete();
            foreach($request->Authorized_Rep_Name as $key => $rep_name)
            {
                $line_no = DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();
                if (empty($line_no)) {
                    $line_no = 10000;
                } else {
                    $line_no = $line_no->{"Line No_"};
                    $line_no = $line_no + 10000;
                }

                $authorized_data=array(
                    "OD Media Type" =>0,
                    "OD Media ID" =>$odmedia_id,
                    "Line No_" =>$line_no,
                    "AR Name" =>$rep_name,
                    "AR Address"=> $request->AR_Address[$key] ?? '',
                    "AR Mobile"=> $request->AR_Mobile_No[$key] ?? '',
                    "AR Phone No_" => $request->AR_Landline_No[$key] ?? '',
                    "AR Email" => $request->AR_Email[$key] ?? '',
                    "Company Legal Status"=>$request->Legal_Status_of_Company[$key] ?? '',
                    "Alternate Mobile No_" =>$request->altername_mobile[$key] ?? '',
                    "User ID"=>Session::get('UserID')
                );
                
                $aut=DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->insert($authorized_data);
            }
            if (!$aut) {
                return $this->sendError('Some Error Occurred! OD Auth Reper table');
                exit;
            }



            //10 feb update time branch address
            
            if($request->BO_Address!='')
            {
                $where=array('OD Media ID' => $odmedia_id,"OD Media Type" =>0);
                DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->delete();
                foreach($request->BO_Address as $key => $branch_address)
                {
                    $line_no = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();
                    if (empty($line_no)) {
                        $line_no = 10000;
                    } else {
                        $line_no = $line_no->{"Line No_"};
                        $line_no = $line_no + 10000;
                    }

                    $branch_data=array(
                        "OD Media Type" =>0,
                        "OD Media ID" =>$odmedia_id,
                        "Line No_" =>$line_no,
                        "State" => $request->BO_state[$key] ?? '',
                        "BO Address"=> $branch_address ?? '',
                        "BO Landline No_"=> $request->BO_Landline_No[$key] ?? '',
                        "BO E-mail" => $request->BO_Email[$key] ?? '',
                        "BO Mobile No_" => $request->BO_Mobile[$key] ?? '',
                        "User ID"=>Session::get('UserID')
                    );
                    
                    $branch=DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->insert($branch_data);
                }
                if (!$branch) {
                    return $this->sendError('Some Error Occurred! In Branch Detail');
                    exit;
                }
            }





            $HO_Address =
                isset($request->HO_Address) ? $request->HO_Address : '';
            $HO_Landline_No =
                isset($request->HO_Landline_No) ? $request->HO_Landline_No : '';
            $HO_Fax_No =
                isset($request->HO_Fax_No) ? $request->HO_Fax_No : '';
            $HO_Email =
                isset($request->HO_Email) ? $request->HO_Email : '';
            $HO_Mobile_No =
                isset($request->HO_Mobile_No) ? $request->HO_Mobile_No : '';
            $BO_Address =
                $request->boradio == 1 ? $request->BO_Address : '';
            $BO_Landline_No =
                $request->boradio == 1 ? $request->BO_Landline_No : '';
            $BO_Fax_No =
                $request->boradio == 1 ? $request->BO_Fax_No : '';
            $BO_Email =
                $request->boradio == 1 ? $request->BO_Email : '';
            $BO_Mobile =
                $request->boradio == 1 ? $request->BO_Mobile : '';
            $Authorized_Rep_Name =
                isset($request->Authorized_Rep_Name) ? $request->Authorized_Rep_Name : '';
            $AR_Address =
                isset($request->AR_Address) ? $request->AR_Address : '';
            $AR_Landline_No =
                isset($request->AR_Landline_No) ? $request->AR_Landline_No : '';
            $AR_FAX_No =
                isset($request->AR_FAX_No) ? $request->AR_FAX_No : '';
            $AR_Email =
                isset($request->AR_Email) ? $request->AR_Email : '';
            $AR_Mobile_No =
                isset($request->AR_Mobile_No) ? $request->AR_Mobile_No : '';
            $Legal_Status_of_Company =
                isset($request->Legal_Status_of_Company) ? $request->Legal_Status_of_Company : 0;
            $Authority_Which_granted_Media =
                isset($request->Authority_Which_granted_Media) ? $request->Authority_Which_granted_Media : '';

            $Contract_No =
                isset($request->Contract_No) ? $request->Contract_No : '';
            $Quantity_Of_Display =
                isset($request->Quantity_Of_Display) ? $request->Quantity_Of_Display : 0;
            $License_From =
                isset($request->License_From) ? date("Y-m-d", strtotime($request->License_From)) : '';
            $License_To =
                isset($request->License_To) ? date("Y-m-d", strtotime($request->License_To)) : '';
            $Applying_For_OD_Media_Type =
                isset($request->Applying_For_OD_Media_Type) ? $request->Applying_For_OD_Media_Type : 0;
            $GST_No =
                isset($request->GST_No) ? $request->GST_No : '';
            $TIN_TAN_VAT_No =
                isset($request->TIN_TAN_VAT_No) ? $request->TIN_TAN_VAT_No : '';
            $Other_Relevant_Information =
                isset($request->Other_Relevant_Information) ? $request->Other_Relevant_Information : '';

            //second tab file upload
            $file_check = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmedia_id)->first();
            $destinationPath = public_path() . '/uploads/sole-right-media/';
            $file_name = $file_check->{'File Name'} ?? '';
            if ($request->hasFile('file_name') || $request->hasFile('file_name_modify')) {
                $file = $request->file('file_name') ?? $request->file('file_name_modify');
                $file_name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $file_name);
                if ($file_uploaded) {
                    $Notarized_Copy_Of_Agreement = 1;
                } else {
                    $file_name = '';
                }
            }

            $table2 = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
            $update = array(
                'HO Address' => $HO_Address,
                'HO Landline No_' => $HO_Landline_No,
                'HO Fax No_' => $HO_Fax_No,
                'HO E-Mail' => $HO_Email,
                'HO Mobile No_' => $HO_Mobile_No,
                // 'BO Address' => $BO_Address,
                // 'BO Landline No_' => $BO_Landline_No,
                // 'BO Fax No_' => $BO_Fax_No,
                // 'BO E-Mail' => $BO_Email,
                // 'BO Mobile No_' => $BO_Mobile,
                // 'Authorized Rep Name' => $Authorized_Rep_Name,
                // 'AR Address' => $AR_Address,
                // 'AR Landline No_' => $AR_Landline_No,
                // 'AR FAX No_' => $AR_FAX_No,
                // 'AR E-mail' => $AR_Email,
                // 'AR Mobile No_' => $AR_Mobile_No,
                // 'Legal Status of Company' => $Legal_Status_of_Company,
                'Authority Which granted Media' => $Authority_Which_granted_Media,
                'Contract No_' => $Contract_No,
                'Quantity Of Display' => $Quantity_Of_Display,
                'License From' => $License_From,
                'License To' => $License_To,
                'Applying For OD Media Type' => 0,
                'GST No_' => $GST_No,
                'TIN_TAN_VAT No_' => $TIN_TAN_VAT_No,
                'Other Relevant Information' => $Other_Relevant_Information,
                'PM Agency Name' => $request->PM_Agency_Name,
                // 'Modification' => 0,
                'File Name'=>$file_name,
                "Allocated Vendor Code"=>$odmedia_id,
                "Status"=>0
            );
            
            $where = array('OD Media ID' => $odmedia_id);
            $sql2 = ApiFreshEmpanelment::updateAllRecords($table2, $update, $where);



            $unique_id = $odmedia_id;
            //excel import suman
            $excel_odmedia_id = Session::put('ex_odmediaid', $odmedia_id);


            // if ($request->hasfile('media_import')) {
            //     try {
            //         Excel::import(new MediaExcelsImport, request()->file('media_import')); //for import
            //         return $this->sendResponse('', 'Data retrieved successfully');
            //     } catch (ValidationException $ex) {

            //         $failures = $ex->failures();
            //         foreach ($failures as $failure) {
            //             return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
            //         }
            //     }
            // }


            // //excel file upload in work done field update
            // if ($request->hasfile('media_import2')) {
            //     $whee=array('OD Media ID'=>$excel_odmedia_id,'OD Media Type'=>2);
            //     DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where($whee)->delete();
            //     try {
            //         Excel::import(new MediaExcelsImportDone, request()->file('media_import2')); //for import
            //         return $this->sendResponse('', 'Data retrieved successfully Update');
            //     } catch (ValidationException $ex) {

            //         $failures = $ex->failures();
            //         foreach ($failures as $failure) {
            //             return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
            //         }
            //     }
            // }
            if($request->xls=='1' || $request->xls2=='1')
            {
                // dd('hfdjfhdf');
                if ($request->hasfile('media_import') && $request->hasfile('media_import2')) {
                    try {
                        Excel::import(new SoleRightMediaSheets, request()->file('media_import')); //for import
                        Excel::import(new MediaExcelsImportDone, request()->file('media_import2')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                }
                elseif ($request->hasfile('media_import')) {
                    try {
                        Excel::import(new SoleRightMediaSheets, request()->file('media_import')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                }
                elseif ($request->hasfile('media_import2')) {
                    try {
                        Excel::import(new MediaExcelsImportDone, request()->file('media_import2')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                }
            }



            // if ($request->hasfile('media_import2'))
            // {
            //     $wheer=array('OD Media ID'=>$excel_odmedia_id,'OD Media Type'=>2,'Line No_'=>10000);
            //     DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where($wheer)->delete();
            // }





            $msg = 'Data Updated Successfully!';
        // }); 
        //tansaction close
        }

        DB::unprepared('SET ANSI_WARNINGS ON');
        $arr = array(
                'lineno1' => $lineno1,
                'lineno2' => $lineno2,
                'unique_id' => $unique_id
            );
        return $this->sendResponse($arr, $msg);

    }); //tansaction close
    }


    /*Third tab data*/
    public function soleRightMediaSaveVendorAccount(Request $request)
    {
        $vendor_table = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
        // $odmedia_id = $request->vendorid_tab_2; //comment 12 feb not workin after excel file import
        $user_id = Session::get('UserID');
        $where=array("User ID"=>$user_id,"OD Category"=>0,"Modification"=>0); //add Modification 15 feb
        $data=DB::table($vendor_table)->where($where)->first();
        // dd($data);
        // dd($data->{'OD Media ID'});
        $odmedia_id=@$data->{'OD Media ID'};
        // dd($odmedia_id);
       
        //$odmedia_id = $request->vendorid_tab_3 ?? ''; sk 
        // account information variable
        $DD_No =
            isset($request->DD_No) ? $request->DD_No : '';
        $DD_Date =
            isset($request->DD_Date) ? date("Y-m-d", strtotime($request->DD_Date)) : '';
        $DD_Bank_Name =
            isset($request->DD_Bank_Name) ? $request->DD_Bank_Name : '';
        $DD_Bank_Branch_Name =
            isset($request->DD_Bank_Branch_Name) ? $request->DD_Bank_Branch_Name : '';
        $Application_Amount =
            isset($request->Application_Amount) ? $request->Application_Amount : 0;
        $PM_Agency_Name =
            isset($request->PM_Agency_Name) ? $request->PM_Agency_Name : '';
        $PAN =
            isset($request->PAN) ? $request->PAN : '';
        $Bank_Name =
            isset($request->Bank_Name) ? $request->Bank_Name : '';
        $Bank_Branch =
            isset($request->Bank_Branch) ? $request->Bank_Branch : '';
        $IFSC_Code =
            isset($request->IFSC_Code) ? $request->IFSC_Code : '';
        $Account_No =
            isset($request->Account_No) ? $request->Account_No : '';

        // $update = array(
        //     'DD No_' => $DD_No,
        //     'DD Date' => $DD_Date,
        //     'DD Bank Name' => $DD_Bank_Name,
        //     'DD Bank Branch Name' => $DD_Bank_Branch_Name,
        //     'Application Amount' => $Application_Amount,
        //     'PM Agency Name' => $PM_Agency_Name,
        //     'PAN' => $PAN,
        //     'Bank Name' => $Bank_Name,
        //     'Bank Branch' => $Bank_Branch,
        //     'IFSC Code' => $IFSC_Code,
        //     'Account No_' => $Account_No,
        // );

        if ($request->PM_Agency_Name != '') {
            // 'PM Agency Name' =>$request->PM_Agency_Name,
            $update = array(
                'PAN' => $request->PAN,
                'Bank Name' => $request->Bank_Name,
                'Bank Branch' => $request->Bank_Branch,
                'IFSC Code' => $request->IFSC_Code,
                'Account No_' => $request->Account_No,
            );
        } else {
            $update = array(
                'DD No_' => $request->DD_No,
                'DD Date' => $request->DD_Date,
                'DD Bank Name' => $request->DD_Bank_Name,
                'DD Bank Branch Name' => $request->DD_Bank_Branch_Name,
                'Application Amount' => $request->Application_Amount,
            );
        }

        $where = array('OD Category' => 0, 'OD Media ID' => $odmedia_id);

        $sql1 = ApiFreshEmpanelment::updateAllRecords($vendor_table, $update, $where);
        //dd($sql1);
        if ($sql1) {
            //return $this->sendResponse($unique_id, $msg);
            // $unique_id[]=$odmedia_id;
            return $this->sendResponse($odmedia_id, 'Data Updated Successfully! Please note the ' . $odmedia_id . ' reference number for future use.');
        } else {
            return $this->sendError('Some Error Occurred!.222');
            exit;
        }
    }

    public function soleRightSaveVendorDocs(Request $request)
    {
        // $odmedia_id = $request->vendorid_tab_3;
        $odmedia_id = $request->vendorid_tab_2;
        $destinationPath = public_path() . '/uploads/sole-right-media/';
        $Notarized_Copy_Of_Agreement = 0;
        $Attach_Copy_Of_Pan_Number = 0;
        $Affidavit_Of_Oath = 0;
        $Photographs = 0;
        $Company_Legal_Documents = 0;
        $GST_Registration = 0;
        $CA_Certified_Balance_Sheet = 0;

        if ($request->hasFile('Notarized_Copy_File_Name')) {
            $file = $request->file('Notarized_Copy_File_Name');
            $Notarized_Copy_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $Notarized_Copy_File_Name);
            if ($fileUploaded) {
                $Notarized_Copy_Of_Agreement = 1;
            }
        } else {
            $Notarized_Copy_File_Name = '';
        }
        if ($request->hasFile('Attach_Copy_Of_Pan_Number_File_Name')) {
            $file = $request->file('Attach_Copy_Of_Pan_Number_File_Name');
            $Attach_Copy_Of_Pan_Number_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded =  $file->move($destinationPath, $Attach_Copy_Of_Pan_Number_File_Name);
            if ($fileUploaded) {
                $Attach_Copy_Of_Pan_Number = 1;
            }
        } else {
            $Attach_Copy_Of_Pan_Number_File_Name = '';
        }
        if ($request->hasFile('Affidavit_File_Name')) {
            $file = $request->file('Affidavit_File_Name');
            $Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $Affidavit_File_Name);
            if ($fileUploaded) {
                $Affidavit_Of_Oath = 1;
            }
        } else {
            $Affidavit_File_Name = '';
        }
        if ($request->hasFile('Photo_File_Name')) {
            $file = $request->file('Photo_File_Name');
            $Photo_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $Photo_File_Name);
            if ($fileUploaded) {
                $Photographs = 1;
            }
        } else {
            $Photo_File_Name = '';
        }
        if ($request->hasFile('Legal_Doc_File_Name')) {
            $file = $request->file('Legal_Doc_File_Name');
            $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
            if ($fileUploaded) {
                $Company_Legal_Documents = 1;
            }
        } else {
            $Legal_Doc_File_Name = '';
        }
        if ($request->hasFile('GST_File_Name')) {
            $file = $request->file('GST_File_Name');
            $GST_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $GST_File_Name);
            if ($fileUploaded) {
                $GST_Registration = 1;
            }
        } else {
            $GST_File_Name = '';
        }
        if ($request->hasFile('Balance_Sheet_File_Name')) {
            $file = $request->file('Balance_Sheet_File_Name');
            $Balance_Sheet_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $Balance_Sheet_File_Name);
            if ($fileUploaded) {
                $CA_Certified_Balance_Sheet = 1;
            }
        } else {
            $Balance_Sheet_File_Name = '';
        }

        if ($request->self_declaration == "on" || $request->self_declaration == "On" || $request->self_declaration == "ON") {
            $Self_declaration = 1;
        } else {
            $Self_declaration = 0;
        }
        if ($odmedia_id != null || $odmedia_id != '' || $odmedia_id != 0) {
            $vendor_table = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
            $owner_id = $request->ownerid ?? '';
            $newspaper_code = $request->vendorid_tab_4 ?? '';
            $update = array(
                'Notarized Copy File Name' => $Notarized_Copy_File_Name,
                'PAN File Name' => $Attach_Copy_Of_Pan_Number_File_Name,
                'Affidavit File Name' => $Affidavit_File_Name,
                'Photo File Name' => $Photo_File_Name,
                'Legal Doc File Name' => $Legal_Doc_File_Name,
                'GST File Name' => $GST_File_Name,
                'Balance Sheet File Name' => $Balance_Sheet_File_Name,
                'Notarized Copy Of Agreement' => $Notarized_Copy_Of_Agreement,
                'PAN Attached' => $Attach_Copy_Of_Pan_Number,
                'Affidavit Of Oath' => $Affidavit_Of_Oath,
                'Photographs' => $Photographs,
                'Company Legal Documents' => $Company_Legal_Documents,
                'GST Registration' => $GST_Registration,
                'CA Certified Balance Sheet' => $CA_Certified_Balance_Sheet,
                'Self-declaration' => $Self_declaration
            );
            $where = array('OD Category' => 0, 'OD Media ID' => $odmedia_id);
            //dd($odmedia_id);
            $sql22 = ApiFreshEmpanelment::updateAllRecords($vendor_table, $update, $where);

            Session::flash('od_message', 'Data Saved Your Code!' . $odmedia_id);
            if ($sql22) {
                //return $this->sendResponse($unique_id, $msg);
                Session::flash('od_message', 'Data Saved Your Code!' . $odmedia_id);
                return $this->sendResponse($odmedia_id, 'Data Updated Successfully! Please note the ' . $odmedia_id . ' reference number for future use.');
            } else {
                return $this->sendError('Some Error Occurred!.3333');
                exit;
            }
        } else {
            return $this->sendError('Od mdia id not exist!.');
            exit;
        }
    }

    public function showDetails($od_media_id = '')
    {
        //echo $od_media_id;exit;
        //dd($od_media_id);
        $table2 = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
        // $select = array('*');
        $select = array(
            'OD Category',
            'OD Media ID',
            'PM Agency Name',
            'HO Address',
            'HO Landline No_',
            'HO Fax No_',
            'HO E-Mail',
            'HO Mobile No_',
            // 'BO Address',
            // 'BO Landline No_',
            // 'BO Fax No_',
            // 'BO E-Mail',
            // 'BO Mobile No_',
            'DO Address',
            'DO Landline No_',
            'DO Fax No_',
            'DO E-Mail',
            'DO Mobile No_',
            'Legal Status of Company',
            'Other Relevant Information',
            'Authority Which granted Media',
            'Amount paid to Authority',
            'License From',
            'License To',
            'Duration',
            'Rental Agreement',
            'Applying For OD Media Type',
            'GST No_',
            'TIN_TAN_VAT No_',
            'DD Date',
            'DD No_',
            'DD Bank Name',
            'DD Bank Branch Name',
            'Application Amount',
            'PAN',
            'Bank Name',
            'Bank Branch',
            'IFSC Code',
            'Account No_',
            'Company Legal Documents',
            'Notarized Copy Of Agreement',
            'Photographs',
            'Affidavit Of Oath',
            'GST Registration',
            'CA Certified Balance Sheet',
            'Self-declaration',
            'Legal Doc File Name',
            'Notarized Copy File Name',
            'Photo File Name',
            'Affidavit File Name',
            'GST File Name',
            'Balance Sheet File Name',
            // 'Authorized Rep Name',
            // 'AR Address',
            // 'AR Landline No_',
            // 'AR FAX No_',
            // 'AR Mobile No_',
            // 'AR E-mail',
            'Contract No_',
            'Quantity Of Display',
            'License Fees',
            'Media Display size',
            'Illumination',
            'PAN Attached',
            'PAN File Name',
            'Status',
            'Modification',
            'Rate Status Date',
            'File Name',
            'Modification',
            'Document Date'
        );

        $where = array('OD Category' => 0, 'User ID' => $od_media_id,"Modification"=>0); //add Modification for show un-complete data on form sk
        $OD_vendors = RateSettlementPersonalMedia::fetchAllRecords($table2, $select, '', '',  $where, '', '');

        $array = json_decode(json_encode($OD_vendors), true);
        $od_mediaid = $array[0]['OD Media ID'] ?? '';

        $table = 'BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array('Owner ID', 'OD Media ID');
        $owner_id_detail = Session::get('owner_id_detail');
        // dd($owner_id_detail);
        // $where = array('OD Media Type' => 0, 'OD Media ID' => $od_mediaid);
        
        $where = array('OD Media Type' => 0,"OD Media ID"=>$od_mediaid); //add od media id sk 15 feb
        // $pluck = 'Owner ID';
        // dd($od_mediaid);
        // $result = RateSettlementPersonalMedia::fetchAllRecords($table, $select, '', '', $where, '', $pluck); 
        $result = RateSettlementPersonalMedia::fetchAllRecords($table, $select, 'desc', '', $where,'','',1);
        $media_owner_details = $result;
        // dd($result);
        $array1 = json_decode(json_encode($result), true);
        // dd($array1);
        // $ownerid =$array1[0]['Owner ID'] ?? '';

        $table1 = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array(
            'Owner ID',
            'Owner Name',
            'Mobile No_',
            'Email ID',
            'Phone No_',
            'Fax No_',
            'Address 1',
            'Address 2',
            'City',
            'District',
            'State'
        );
        // dd($array1);
        $whereIn = array('Owner ID' => $array1);
        $OD_owners = RateSettlementPersonalMedia::fetchAllRecords($table1, $select, '', '', '', $whereIn, '');

        $table3 = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
        // $select = array('*');
        $select = array(
            'OD Media Type',
            'OD Media ID',
            'Line No_',
            'Work Name',
            'Year',
            'Qty Of Display_Duration',
            'Billing Amount',
            'From Date',
            'To Date'
        );
        $where = array('OD Media Type' => 0, 'OD Media ID' => $od_mediaid);
        $OD_work_dones = RateSettlementPersonalMedia::fetchAllRecords($table3, $select, '', '',  $where, '', '');

        $table4 = 'BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2';
        // $select = array('*');
        $select = array(
            'OD Media Type',
            'Sole Media ID',
            'Line No_',
            'City',
            'State',
            'District',
            'Zone',
            'Latitude',
            'Longitde',
            'Landmark',
            'Image File Name',
            'OD Media ID',
            'Display Size',
            'Illumination Type',
            'Availability Start Date',
            'Availability End Date',
            'Length',
            'Width',
            'Total Area',
            'Quantity',
            'Train Number',
            'Train Name',
            'Size Type',
            'Duration',
            'No Of Spot',
            'Lit Type'
        );
        // $where = array('OD Media Type' => 0, 'Sole Media ID' => $od_mediaid);sk change becouse 'OD Media Type' not going to '0' 
        $where = array('Sole Media ID' => $od_mediaid);
        $OD_media_address = RateSettlementPersonalMedia::fetchAllRecords($table4, $select, '', '',  $where, '', '');

        // dd($OD_media_address->{'OD Media ID'});  


        if (empty($result)) {
            return $this->sendError('Data not found!.');
            exit;
        }

        $table44 = 'BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2';
        // $sub_category=DB::table($table44)->where('OD Media UID',$od_mediaid)->get();


        $response = [
            'OD_owners' => $OD_owners,
            'OD_vendors' => $OD_vendors,
            'OD_work_dones' => $OD_work_dones,
            'OD_media_address' => $OD_media_address,
            'media_owner_details' => $media_owner_details,

        ];
        //dd($response);
        return $this->sendResponse($response, 'Data retrieved successfully.');

        //return response()->json($OD_owners,200);

    }
    public function showlistdata($od_media_id = '')
    {
        //echo $od_media_id;exit;
        //dd($od_media_id);
        $table2 = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
        // $select = array('*');
        $select = array(
            'OD Category',
            'OD Media ID',
            'PM Agency Name',
            'HO Address',
            'HO Landline No_',
            'HO Fax No_',
            'HO E-Mail',
            'HO Mobile No_',
            // 'BO Address',
            // 'BO Landline No_',
            // 'BO Fax No_',
            // 'BO E-Mail',
            // 'BO Mobile No_',
            'DO Address',
            'DO Landline No_',
            'DO Fax No_',
            'DO E-Mail',
            'DO Mobile No_',
            'Legal Status of Company',
            'Other Relevant Information',
            'Authority Which granted Media',
            'Amount paid to Authority',
            'License From',
            'License To',
            'Duration',
            'Rental Agreement',
            'Applying For OD Media Type',
            'GST No_',
            'TIN_TAN_VAT No_',
            'DD Date',
            'DD No_',
            'DD Bank Name',
            'DD Bank Branch Name',
            'Application Amount',
            'PAN',
            'Bank Name',
            'Bank Branch',
            'IFSC Code',
            'Account No_',
            'Company Legal Documents',
            'Notarized Copy Of Agreement',
            'Photographs',
            'Affidavit Of Oath',
            'GST Registration',
            'CA Certified Balance Sheet',
            'Self-declaration',
            'Legal Doc File Name',
            'Notarized Copy File Name',
            'Photo File Name',
            'Affidavit File Name',
            'GST File Name',
            'Balance Sheet File Name',
            // 'Authorized Rep Name',
            // 'AR Address',
            // 'AR Landline No_',
            // 'AR FAX No_',
            // 'AR Mobile No_',
            // 'AR E-mail',
            'Contract No_',
            'Quantity Of Display',
            'License Fees',
            'Media Display size',
            'Illumination',
            'PAN Attached',
            'PAN File Name',
            'Status',
            'Modification',
            'Rate Status Date',
            'File Name',
            'Modification',
            'Document Date'
        );

        $where = array('OD Category' => 0, 'OD Media ID' => $od_media_id);
        $OD_vendors = RateSettlementPersonalMedia::fetchAllRecords($table2, $select, '', '',  $where, '', '');

        $array = json_decode(json_encode($OD_vendors), true);
        $od_mediaid = $array[0]['OD Media ID'] ?? '';

        $table = 'BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array('Owner ID', 'OD Media ID');
        $owner_id_detail = Session::get('owner_id_detail');
        // dd($owner_id_detail);
        // $where = array('OD Media Type' => 0, 'OD Media ID' => $od_mediaid);
        $where = array('OD Media Type' => 0, 'Owner ID' => $owner_id_detail,"OD Media ID"=>$od_mediaid); //add od media id sk 15 feb
        // $pluck = 'Owner ID';
        
        // $result = RateSettlementPersonalMedia::fetchAllRecords($table, $select, '', '', $where, '', $pluck); 
        $result = RateSettlementPersonalMedia::fetchAllRecords($table, $select, 'desc', '', $where,'','',1);
        $media_owner_details = $result;
        $array1 = json_decode(json_encode($result), true);
        // dd($array1);
        // $ownerid =$array1[0]['Owner ID'] ?? '';

        $table1 = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array(
            'Owner ID',
            'Owner Name',
            'Mobile No_',
            'Email ID',
            'Phone No_',
            'Fax No_',
            'Address 1',
            'Address 2',
            'City',
            'District',
            'State'
        );
        $whereIn = array('Owner ID' => $array1);
        $OD_owners = RateSettlementPersonalMedia::fetchAllRecords($table1, $select, '', '', '', $whereIn, '');

        $table3 = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
        // $select = array('*');
        $select = array(
            'OD Media Type',
            'OD Media ID',
            'Line No_',
            'Work Name',
            'Year',
            'Qty Of Display_Duration',
            'Billing Amount',
            'From Date',
            'To Date'
        );
        $where = array('OD Media Type' => 0, 'OD Media ID' => $od_mediaid);
        $OD_work_dones = RateSettlementPersonalMedia::fetchAllRecords($table3, $select, '', '',  $where, '', '');

        $table4 = 'BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2';
        // $select = array('*');
        $select = array(
            'OD Media Type',
            'Sole Media ID',
            'Line No_',
            'City',
            'State',
            'District',
            'Zone',
            'Latitude',
            'Longitde',
            'Landmark',
            'Image File Name',
            'OD Media ID',
            'Display Size',
            'Illumination Type',
            'Availability Start Date',
            'Availability End Date',
            'Length',
            'Width',
            'Total Area',
            'Quantity',
            'Train Number',
            'Train Name',
            'Size Type',
            'Duration',
            'No Of Spot',
            'Lit Type'
        );
        // $where = array('OD Media Type' => 0, 'Sole Media ID' => $od_mediaid);sk change becouse 'OD Media Type' not going to '0' 
        $where = array('Sole Media ID' => $od_mediaid);
        $OD_media_address = RateSettlementPersonalMedia::fetchAllRecords($table4, $select, '', '',  $where, '', '');

        // dd($OD_media_address->{'OD Media ID'});  


        if (empty($result)) {
            return $this->sendError('Data not found!.');
            exit;
        }

        $table44 = 'BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2';
        // $sub_category=DB::table($table44)->where('OD Media UID',$od_mediaid)->get();


        $response = [
            'OD_owners' => $OD_owners,
            'OD_vendors' => $OD_vendors,
            'OD_work_dones' => $OD_work_dones,
            'OD_media_address' => $OD_media_address,
            'media_owner_details' => $media_owner_details,

        ];
        //dd($response);
        return $this->sendResponse($response, 'Data retrieved successfully.');

        //return response()->json($OD_owners,200);

    }

    public function fetchOwnerRecord(Request $request)
    {
        $table = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array('Owner ID', 'Owner Name', 'Mobile No_', 'Email ID', 'Phone No_', 'Fax No_', 'Address 1', 'City', 'District', 'State');
        $where = array($request->key => $request->owner_id);
        $response = RateSettlementPersonalMedia::fetchAllRecords($table, $select, '', '', $where, '', '');
        $table2 = '[BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2]';
        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }
    public function fetchOwnerVendorMapped(Request $request)
    {
        $table = 'BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array('Owner ID');
        $where = array($request->key => $request->owner_id, 'OD Media Type' => 1);
        $response = RateSettlementPersonalMedia::fetchAllRecords($table, $select, '', '', $where, '', '');
        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }

    public function getAllDistricts()
    {
        $table = 'BOC$District$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array('District');
        $response = RateSettlementPersonalMedia::fetchAllRecords($table, $select, 'District', 'ASC', '', '', '');
        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }
    //////////////////////////////////////////////////////////////////////

    //for soleright renewal data show
    public function showRenewalDetails($od_media_id = '')
    {
        //echo $od_media_id;exit;
        //dd($od_media_id);
        $table2 = 'BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2';
        // $select = array('*');
        $select = array(
            // 'OD Category', //
            'OD Media ID',
            'PM Agency Name', //
            'PM Agency Name as agency', //
            'Line No_',
            'HO Address',
            'HO Landline No_',
            'HO Fax No_',
            'HO E-Mail',
            'HO Mobile No_',
            'BO Address',
            'BO Landline No_',
            'BO Fax No_',
            'BO E-Mail',
            'BO Mobile No_',
            'DO Address',
            'DO Landline No_',
            'DO Fax No_',
            'DO E-Mail',
            'DO Mobile No_',
            'Legal Status of Company',
            'Other Relevant Information',
            'Authority Which granted Media',
            'Amount paid to Authority',
            'License From',
            'License To',
            // 'Duration',
            'Rental Agreement',
            'Applying For OD Media Type',
            'GST No_',
            'TIN_TAN_VAT No_',
            'DD Date',
            'DD No_',
            'DD Bank Name',
            'DD Bank Branch Name',
            'Application Amount',
            'PAN',
            'Bank Name',
            'Bank Branch',
            'IFSC Code',
            'Account No_',
            'Company Legal Documents',
            'Notarized Copy Of Agreement',
            'Photographs',
            'Affidavit Of Oath',
            'GST Registration',
            'CA Certified Balance Sheet',
            'Self-declaration',
            'Legal Doc File Name',
            'Notarized Copy File Name',
            'Photo File Name',
            'Affidavit File Name',
            'GST File Name',
            'Balance Sheet File Name',
            'Authorized Rep Name',
            'AR Address',
            'AR Landline No_',
            'AR FAX No_',
            'AR Mobile No_',
            'AR E-mail',
            'Contract No_',
            'Quantity Of Display',
            'License Fees',
            'Media Display size',
            'Illumination',
            'PAN Attached',
            'PAN File Name',
            'Status',
            'Modification',
            'Rate Status Date',
            'Modification'

        );

        // $where = array('OD Category' => 0, 'User ID'=> $od_media_id); //comment by sk 29-Dec, becouse OD Category field not exists
        $where = array('User ID' => $od_media_id);
        // dd($where);
        // ($table, $select, 'District', 'ASC', '','','');
        $OD_vendors = RateSettlementPersonalMedia::fetchAllRecords($table2, $select, 'Line No_', 'DESC',  $where, '', '');

        $array = json_decode(json_encode($OD_vendors), true);
        $od_mediaid = $array[0]['OD Media ID'] ?? '';

        $table = 'BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array('Owner ID', 'OD Media ID');
        $owner_id_detail = Session::get('owner_id_detail');
        // dd($owner_id_detail);
        // $where = array('OD Media Type' => 0, 'OD Media ID' => $od_mediaid);
        $where = array('OD Media Type' => 0, 'Owner ID' => $owner_id_detail);
        // $pluck = 'Owner ID';
        // $result = RateSettlementPersonalMedia::fetchAllRecords($table, $select, '', '', $where, '', $pluck); 
        $result = RateSettlementPersonalMedia::fetchAllRecords($table, $select, '', '', $where);
        $media_owner_details = $result;
        $array1 = json_decode(json_encode($result), true);
        // dd($array1);
        // $ownerid =$array1[0]['Owner ID'] ?? '';

        $table1 = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array(
            'Owner ID',
            'Owner Name',
            'Mobile No_',
            'Email ID',
            'Phone No_',
            'Fax No_',
            'Address 1',
            'Address 2',
            'City',
            'District',
            'State'
        );
        $whereIn = array('Owner ID' => $array1);
        $OD_owners = RateSettlementPersonalMedia::fetchAllRecords($table1, $select, '', '', '', $whereIn, '');

        $table3 = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
        // $select = array('*');
        $select = array(
            'OD Media Type',
            'OD Media ID',
            'Line No_',
            'Work Name',
            'Year',
            'Qty Of Display_Duration',
            'Billing Amount',
            'Allocated Vendor Code',
            'From Date',
            'To Date'
        );
        $where = array('OD Media Type' => 0, 'OD Media ID' => $od_mediaid);
        $OD_work_dones = RateSettlementPersonalMedia::fetchAllRecords($table3, $select, '', '',  $where, '', '');

        $table4 = 'BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2';
        // $select = array('*');
        $select = array(
            'OD Media Type',
            'Sole Media ID',
            'Line No_',
            'City',
            'State',
            'District',
            'Zone',
            'Latitude',
            'Longitde',
            'Landmark',
            'Image File Name',
            'OD Media ID',
            'Display Size',
            'Illumination Type',
            'Availability Start Date',
            'Availability End Date'
        );
        // $where = array('OD Media Type' => 0, 'Sole Media ID' => $od_mediaid);sk change becouse 'OD Media Type' not going to '0' 
        $where = array('Sole Media ID' => $od_mediaid);
        $OD_media_address = RateSettlementPersonalMedia::fetchAllRecords($table4, $select, '', '',  $where, '', '');

        // dd($OD_media_address->{'OD Media ID'});  


        if (empty($result)) {
            return $this->sendError('Data not found!.');
            exit;
        }

        $table44 = 'BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2';
        // $sub_category=DB::table($table44)->where('OD Media UID',$od_mediaid)->get();


        $response = [
            'OD_owners' => $OD_owners,
            'OD_vendors' => $OD_vendors,
            'OD_work_dones' => $OD_work_dones,
            'OD_media_address' => $OD_media_address,
            'media_owner_details' => $media_owner_details,

        ];
        //dd($response);
        return $this->sendResponse($response, 'Data retrieved successfully.');

        //return response()->json($OD_owners,200);

    }

    public function removeMediaaddress($line_no, $od_media_id)
    {
        $sql = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where(['Line No_' => $line_no, 'Sole Media ID' => $od_media_id])->delete();
        if ($sql) {
            return $this->sendResponse('', 'Data deleted successfully!');
        } else {
            return $this->sendError('Some Error Occurred!.');
        }
    }
}
