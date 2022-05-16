<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Session;
use App\Http\Controllers\Api\ApiFreshEmpanelmentController as api;
use App\Http\Controllers\Api\SoleRightMediaController as solerightMedapi;
use Mail;
use App\Http\Traits\CommonTrait;
use App\Models\Api\MediaCirculation;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MediaExcelsImport;
use App\Models\Api\MediaCirculationDone;
use App\Imports\MediaExcelsImportDone;
use App\Exports\Outdoor\SoleRightMediaExcelExport;
use App\Imports\Outdoor\Media\SoleRightMediaSheets;
use Hash;

class SoleRightMediaController extends Controller
{
    use CommonTrait;


    public function InsertsoleRightMedia(Request $request)
    {
        $url = last(request()->segments());

        $city_array = $this->getcities();
        $ownerCities = json_decode(json_encode($city_array), true);

        $district_array = $this->getDistricts();
        $ownerDistricts = json_decode(json_encode($district_array), true);

        $state_array = $this->getStates();
        $states = json_decode(json_encode($state_array), true);

        if ($url == 'sole-right-media') {

            $userid = Session::get('UserID');

            $table = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';

            $datas = DB::table($table)->where('User ID', $userid)->first();

            if (!empty($datas)) {
                $owner_id = $datas->{'Owner ID'};
                Session::put('owner_id_detail', $datas->{'Owner ID'});
            } else {
                Session::put('owner_id_detail', "");
                $owner_id = "";
            }

            //9 feb for find od media id through owner id

            $where = array("Owner ID" => $owner_id, "OD Media Type" => 0);
            $odmedia = DB::table('BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->where("Owner ID", "!=", '')->orderBy('OD Media ID', 'desc')->first();
            @$mediaid = $odmedia->{'OD Media ID'};

            $where2 = array("OD Media ID" => $mediaid, "OD Media Type" => 0);
            $authorize = DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->get();
            $branch = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->get();

            // Lat Long code start

            $latlongData = DB::table('BOC$OD Latlong Detail$3f88596c-e20d-438c-a694-309eb14559b2')->select("Latitude", "Longitude", "Image File Name", "Remarks", "Far Image File Name", "City", "Near Picture", "Far Picture", "Tag Name")->where('OD Vendor ID', $mediaid)->get();

            $data = (new solerightMedapi)->showDetails($userid);

            $response = json_decode(json_encode($data), true);

            //for all category display
            $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->get();

            $owner_data = isset($response['original']['data']['OD_owners']) ? $response['original']['data']['OD_owners'] : [];

            $vendor_data = isset($response['original']['data']['OD_vendors']) ? $response['original']['data']['OD_vendors'] : [];

            $media_owner_details = isset($response['original']['data']['media_owner_details']) ? $response['original']['data']['media_owner_details'] : [];

            $OD_work_dones_data = isset($response['original']['data']['OD_work_dones']) ? $response['original']['data']['OD_work_dones'] : [];
            $OD_media_address_data = isset($response['original']['data']['OD_media_address']) ? $response['original']['data']['OD_media_address'] : [];

            $state_code = @$owner_data[0]['State'] ?? "";

            $city_array = $this->getcities($state_code);
            $ownerCities = json_decode(json_encode($city_array), true);

            $district_array = $this->getDistricts($state_code);
            $ownerDistricts = json_decode(json_encode($district_array), true);

            if (@$vendor_data[0]->{'Modification'} == 0) {
                //for all category display
                $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->where('Category Group', @$OD_media_address_data[0]['OD Media Type'])->get();
                return view('admin.pages.soleright.sole-right-media-form', ['latlongData' => $latlongData, 'states' => $states['original']['data'], 'ownerDistricts' => $ownerDistricts['original']['data'], 'ownerCities' => $ownerCities['original']['data']])->with(compact('owner_data', 'vendor_data', 'media_owner_details', 'OD_work_dones_data', 'OD_media_address_data', 'getcat', 'authorize', 'branch'));
            } else {
                $branch = array();
                $authorize = array();
                $latlongData = array();
                return view('admin.pages.soleright.sole-right-media-form', ['states' => $states['original']['data'], 'ownerDistricts' => $ownerDistricts['original']['data'], 'ownerCities' => $ownerCities['original']['data']])->with(compact('getcat', 'authorize', 'branch'));
            }
        } else {

            $odid = $url; //od media id
            $userid = Session::get('UserID');
            //find owner id from OD Media Owner Detail table
            $where_detail = array("OD Media ID" => $odid, "OD Media Type" => 0);
            $find_owner_detail = DB::table('BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2')->select('Owner ID')->where($where_detail)->first();
            $ownID = @$find_owner_detail->{'Owner ID'}; //get Owner ID
            $table = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
            $datas = DB::table($table)->where('Owner ID', $ownID)->first();
            if (!empty($datas)) {
                $owner_id = $datas->{'Owner ID'};
                Session::put('owner_id_detail', $datas->{'Owner ID'});
            } else {
                Session::put('owner_id_detail', "");
                $owner_id = '';
            }

            //9 feb for find od media id through owner id
            $where = array("Owner ID" => $owner_id, "OD Media Type" => 0);
            $odmedia = DB::table('BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->orderBy('OD Media ID', 'desc')->first();

            @$mediaid = $odid;
            $where2 = array("OD Media ID" => $mediaid, "OD Media Type" => 0);
            $authorize = DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->get();
            $branch = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->get();

            // Lat Long code start

            $latlongData = DB::table('BOC$OD Latlong Detail$3f88596c-e20d-438c-a694-309eb14559b2')->select("Latitude", "Longitude", "Image File Name", "Remarks", "Far Image File Name", "City", "Near Picture", "Far Picture", "Tag Name")->where('OD Vendor ID', $mediaid)->get();

            // Lat Long code End

            $data = (new solerightMedapi)->showlistdata($odid);

            $response = json_decode(json_encode($data), true);

            $owner_data = isset($response['original']['data']['OD_owners']) ? $response['original']['data']['OD_owners'] : [];

            $vendor_data = isset($response['original']['data']['OD_vendors']) ? $response['original']['data']['OD_vendors'] : [];

            $media_owner_details = isset($response['original']['data']['media_owner_details']) ? $response['original']['data']['media_owner_details'] : [];

            $OD_work_dones_data = isset($response['original']['data']['OD_work_dones']) ? $response['original']['data']['OD_work_dones'] : [];
            $OD_media_address_data = isset($response['original']['data']['OD_media_address']) ? $response['original']['data']['OD_media_address'] : [];
            //for all category display 
            $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->where('Category Group', $OD_media_address_data[0]['OD Media Type'])->get();

            return view('admin.pages.soleright.sole-right-media-form', ['latlongData' => $latlongData, 'states' => $states['original']['data'], 'ownerDistricts' => $ownerDistricts['original']['data'], 'ownerCities' => $ownerCities['original']['data']])->with(compact('owner_data', 'vendor_data', 'media_owner_details', 'OD_work_dones_data', 'OD_media_address_data', 'getcat', 'authorize', 'branch'));
        }
    }
    public function saveSoleMedia(Request $request)
    {
        if ($request->next_tab_1 == 1) {
            $request->validate(
                [
                    'owner_email' => 'required',
                    'owner_mobile' => 'required',
                    'address' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    'district' => 'required'
                ]
            );
            $resp = (new solerightMedapi)->saveSoleRightMedia($request);
            $response = json_decode(json_encode($resp), true);
            return response()->json($response['original']);
            if ($response['original']['success'] == true) {
                return response()->json($response['original']);
            } else {
                return response()->json($response['original']);
            }
        }
        //Start tab 2 data insert

        if ($request->next_tab_2 == 1) {

            $request->validate(
                [
                    'HO_Address' => 'required',
                    // 'HO_Landline_No' => 'required',
                    'HO_Email' => 'required',
                    'HO_Mobile_No' => 'required',
                    // 'Legal_Status_of_Company' => 'required',
                    'Authority_Which_granted_Media' => 'required',
                    'Contract_No' => 'required',
                    'License_Fee' => 'required',
                    // 'Quantity_Of_Display' => 'required',
                    'License_From' => 'required',
                    'License_To' => 'required',
                    'MA_State' => 'required',
                    'MA_District' => 'required',
                    'MA_City' => 'required',
                    // 'MA_Latitude' => 'required',
                    // 'MA_Longitude' => 'required',
                    // 'MA_Property_Landmark' => 'required',
                    // 'ODMFO_Display_Size_Of_Media' => 'required',
                    'ODMFO_Quantity_Of_Display_Or_Duration' => 'required',
                    'ODMFO_Billing_Amount' => 'required'
                ]
            );
            $resp = (new solerightMedapi)->soleRightSaveVendorData($request);
            $response = json_decode(json_encode($resp), true);
            // dd($response);
            return response()->json($response['original']);
            if ($response['original']['success'] == true) {
                return response()->json($response['original']);
            } else {
                return response()->json($response['original']);
            }
        }

        //End tab 2 data insert
        if ($request->next_tab_3 == 1) {
            // $request->validate(
            //     [
            //         'DD_No' => 'required',
            //         'DD_Date' => 'required',
            //         'DD_Bank_Name' => 'required',
            //         'DD_Bank_Branch_Name' => 'required',
            //         'PM_Agency_Name' => 'required',
            //         'PAN' => 'required',
            //         'Bank_Name' => 'required',
            //         'Bank_Branch' => 'required',
            //         'IFSC_Code' => 'required',
            //         'Account_No' => 'required',
            //     ]
            // );

            $resp = (new solerightMedapi)->soleRightMediaSaveVendorAccount($request);
            $response = json_decode(json_encode($resp), true);
            //dd($response);
            if ($response['original']['success'] == true) {

                return response()->json($response['original']);
            } else {
                return response()->json($response['original']);
            }
        }


        if ($request->submit_btn == 1) {
            $request->validate(
                [
                    'Legal_Doc_File_Name' => 'required',
                    'Notarized_Copy_File_Name' => 'required',
                    'Attach_Copy_Of_Pan_Number_File_Name' => 'required',
                    'Affidavit_File_Name' => 'required',
                    'Photo_File_Name' => 'required',
                    'GST_File_Name' => 'required',
                ]
            );
            $resp = (new solerightMedapi)->soleRightSaveVendorDocs($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == true) {
                Session::forget('line1');
                Session::forget('line2');
                return response()->json($response['original']);
            } else {
                return response()->json($response['original']);
            }
        }
    }

    public function vendoesolerightMedia()
    {
        return view('admin.pages.soleright.vendor-sole-right-media-form');
    }

    public function viewSoleRightMedia($mediaid = '')
    {
        //dd($mediaid);

        if (!empty($mediaid)) {
            $userid = Session::get('UserID');
            $state_array = (new api)->getStates();
            $states1 = json_decode(json_encode($state_array), true);
            $states = $states1['original']['data'];
            $data = (new solerightMedapi)->showDetails($userid);
            //dd($data);
            //Lat Long Code Start

            $latlongData = DB::table('BOC$OD Latlong Detail$3f88596c-e20d-438c-a694-309eb14559b2')->select("Latitude", "Longitude", "Image File Name", "Remarks")->where('OD Vendor ID', $userid)->get();
            //Lat Long Code Start


            $response = json_decode(json_encode($data), true);
            //dd($response);
            $owner_data = isset($response['original']['data']['OD_owners']) ? $response['original']['data']['OD_owners'] : [];
            $vendor_data = isset($response['original']['data']['OD_vendors']) ? $response['original']['data']['OD_vendors'] : [];
            $OD_work_dones_data = isset($response['original']['data']['OD_work_dones']) ? $response['original']['data']['OD_work_dones'] : [];
            $OD_media_address_data = isset($response['original']['data']['OD_media_address']) ? $response['original']['data']['OD_media_address'] : [];

            return view(
                'admin.pages.soleright.view-sole-right-media',
                compact(
                    'owner_data',
                    'vendor_data',
                    'OD_work_dones_data',
                    'OD_media_address_data',
                    'states',
                    'latlongData'
                )
            );
        } else {
            //dd("hello");
        }
    }

    public function fetchStates()
    {
        $states = (new solerightMedapi)->getStates();

        return $states;
    }

    public function fetchDistricts(Request $request)
    {

        $state_code = $request->state_code;
        // cities dropdown
        $city_array = $this->getcities($state_code);
        $cities = json_decode(json_encode($city_array), true);
        $city_data = "<option value=''>Select City</option>";
        if ($cities['original']['success'] == true) {
            foreach ($cities['original']['data'] as $city) {
                $city_data .= "<option value='" . $city['cityName'] . "'>" . $city['cityName'] . "</option>";
            }
        }

        // district dropdown
        $district_array = (new api)->getDistricts($state_code);
        $districts = json_decode(json_encode($district_array), true);
        $dist_data = "<option value=''>Select District</option>";
        if ($districts['original']['success'] == true) {
            foreach ($districts['original']['data'] as $district) {
                $dist_data .= "<option value='" . $district['District'] . "'>" . $district['District'] . "</option>";
            }
            return response()->json(['status' => 1, 'districts' => $dist_data, 'cities' => $city_data]);
        } else {
            return response()->json(['status' => 0]);
        }

        // $data=DB::table('')-
    }


    public function getAllVendorList($odmediaId = '')
    {
        if (!empty($odmediaId)) {
            $data = (new solerightMedapi)->showDetails($odmediaId);
            $response = json_decode(json_encode($data), true);
            if ($response['original']['success'] != '' || $response['original']['success'] != false) {
                $owner_data = $response['original']['data']['OD_owners'];
                $vendor_data = $response['original']['data']['OD_vendors'];
                $OD_work_dones_data = $response['original']['data']['OD_work_dones'];
                $OD_media_address_data = $response['original']['data']['OD_media_address'];
                return redirect()->route('sole-right-media')->with(
                    compact(
                        'owner_data',
                        'vendor_data',
                        'OD_work_dones_data',
                        'OD_media_address_data'
                    )
                );
            } else {
                return back()->with(['status' => 'Fail', 'message' => 'DAVP Code not found!']);
            }
        } else {
            return back()->with(['status' => 'Fail', 'message' => 'DAVP Code not found!']);
        }
    }

    // get exist owner data
    public function existingOwnerData(Request $request)
    {
        $sole_right_array = (new api)->existingOwnerData($request);
        $response = json_decode(json_encode($owner_datas), true);
        return response()->json(['status' => $response['original']['status'], 'message' => $response['original']['message']]);
    }


    // check duplicate records into database
    public function checkUniqueOwner(Request $request)
    {
        $table1 = '[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2]';
        $count_id = DB::select("select COUNT(*) as count from $table1 where [Email ID] = '" . $request->data . "' or [Mobile No_] = '" . $request->data . "'");

        if ($count_id[0]->count > 0) {
            return response()->json(['status' => 0, 'message' => 'already exist']);
        } else {
            return response()->json(['status' => 1, 'message' => 'No data found']);
        }
    }

    public function checkUniqueVendor(Request $request)
    {
        $table1 = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
        $count_id = DB::select("select COUNT(*) as count from $table1 where [Ho E-Mail] = '" . $request->data . "' or [HO Mobile No_] = '" . $request->data . "'");
        if ($count_id[0]->count > 0) {
            return response()->json(['status' => 0, 'message' => 'already exist']);
        } else {
            return response()->json(['status' => 1, 'message' => 'No data found']);
        }
    }
    public function fetchOwnerRecord(Request $request)
    {
        $request->session()->reflash();
        $request['key'] = 'Email ID';
        $request['owner_id'] = $request->data;
        $ownerdatas = (new solerightMedapi)->fetchOwnerRecord($request);
        $ownerdatas = json_decode(json_encode($ownerdatas), true);
        //get vendor edition
        // $countvendordatas = '';
        // $vendorDatas = '';
        $ownerID = '';
        // $request['Owner_ID'] = $ownerdatas['original']['data'][0]['Owner ID'];
        // $vendordata = (new private_madia_api)->countVendorRecords($request);
        // $vendordata = json_decode(json_encode($vendordata), true);

        // if ($vendordata['original']['success'] == true) {
        //     $countvendordatas = count($vendordata['original']['data']);
        //     $vendorDatas = $vendordata['original']['data']; 
        // }

        if ($ownerdatas['original']['success'] == true) {
            $request['key'] = 'Owner ID';
            $request['owner_id'] = $ownerdatas['original']['data'][0]['Owner ID'];
            $ownerID = (new solerightMedapi)->fetchOwnerVendorMapped($request);
            $ownerID = json_decode(json_encode($ownerID), true);
            $ownerID = count($ownerID['original']['data']);

            $state_array = (new api)->getStates();
            $states = json_decode(json_encode($state_array), true);
            $state_data = "<option value=''>Select District</option>";
            foreach ($states['original']['data'] as $state) {
                $selected =  $ownerdatas['original']['data'][0]['State'] === $state['Code']  ? 'selected' : '';
                $state_data .= "<option value='" . $state['Code'] . "' $selected>" . $state['Description'] . "</option>";
            }

            $dist_array = (new solerightMedapi)->getAllDistricts();
            $districts = json_decode(json_encode($dist_array), true);
            $dist_data = "<option value=''>Select District</option>";
            foreach ($districts['original']['data'] as $district) {
                $selected =  $ownerdatas['original']['data'][0]['District'] === $district['District']  ? 'selected' : '';
                $dist_data .= "<option value='" . $district['District'] . "' $selected>" . $district['District'] . "</option>";
            }

            $state_code = $ownerdatas['original']['data'][0]['State'];
            $city_array = $this->getcities($state_code);
            $cities = json_decode(json_encode($city_array), true);
            $city_data = "<option value=''>Select City</option>";
            if ($cities['original']['success'] == true) {
                foreach ($cities['original']['data'] as $city) {
                    $selected =  $ownerdatas['original']['data'][0]['City'] === $city['cityName']  ? 'selected' : '';
                    $city_data .= "<option value='" . $city['cityName'] . "' $selected>" . $city['cityName'] . "</option>";
                }
            }

            return response()->json(['status' => 1, 'message' => $ownerdatas['original']['data'][0], 'state' => $state_data, 'districts' => $dist_data, 'cities' => $city_data, 'ownerID' => $ownerID]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No data found']);
        }
    }



    public function fileupload(Request $request)
    {
        $destinationPath = public_path() . '/uploads/sole-right-media/';
        $Notarized_Copy_Of_Agreement = 0; //1
        $Attach_Copy_Of_Pan_Number = 0;
        $Affidavit_Of_Oath = 0; //1
        $Photographs = 0; //1
        $Company_Legal_Documents = 0; //
        $GST_Registration = 0; //1
        $CA_Certified_Balance_Sheet = 0;

        $odmedia_id = $request->vendorid_tab_3;
        $mtable = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
        $mod = DB::table($mtable)->where('OD Media ID', $odmedia_id)->first();



        // if ($request->hasFile('Notarized_Copy_File_Name')) {
        //     $file = $request->file('Notarized_Copy_File_Name');
        //     $Notarized_Copy_File_Name = time() . '-' . $file->getClientOriginalName();
        //     $fileUploaded = $file->move($destinationPath, $Notarized_Copy_File_Name);
        //     if ($fileUploaded) {
        //         $Notarized_Copy_Of_Agreement = 1;
        //     }
        // } else {
        //     $Notarized_Copy_File_Name = '';
        // }

        //change modify  present
        $Notarized_Copy_File_Name = $mod->{'Notarized Copy File Name'} ?? '';
        if ($request->hasFile('Notarized_Copy_File_Name') || $request->hasFile('Notarized_Copy_File_Name_modify')) {
            $file = $request->file('Notarized_Copy_File_Name') ?? $request->file('Notarized_Copy_File_Name_modify');
            $Notarized_Copy_File_Name = time() . '-' . $file->getClientOriginalName();
            $file_uploaded = $file->move($destinationPath, $Notarized_Copy_File_Name);
            if ($file_uploaded) {
                $Notarized_Copy_Of_Agreement = 1;
            } else {
                $Notarized_Copy_File_Name = '';
            }
        }



        // if ($request->hasFile('Attach_Copy_Of_Pan_Number_File_Name')) {
        //     $file = $request->file('Attach_Copy_Of_Pan_Number_File_Name');
        //     $Attach_Copy_Of_Pan_Number_File_Name = time() . '-' . $file->getClientOriginalName();
        //     $fileUploaded =  $file->move($destinationPath, $Attach_Copy_Of_Pan_Number_File_Name);
        //     if ($fileUploaded) {
        //         $Attach_Copy_Of_Pan_Number = 1;
        //     }
        // } else {
        //     $Attach_Copy_Of_Pan_Number_File_Name = '';
        // }

        //change modify present
        $Attach_Copy_Of_Pan_Number_File_Name = $mod->{'PAN File Name'} ?? '';
        if ($request->hasFile('Attach_Copy_Of_Pan_Number_File_Name') || $request->hasFile('Attach_Copy_Of_Pan_Number_File_Name_modify')) {
            $file = $request->file('Attach_Copy_Of_Pan_Number_File_Name') ?? $request->file('Attach_Copy_Of_Pan_Number_File_Name_modify');
            $Attach_Copy_Of_Pan_Number_File_Name = time() . '-' . $file->getClientOriginalName();
            $file_uploaded = $file->move($destinationPath, $Attach_Copy_Of_Pan_Number_File_Name);
            if ($file_uploaded) {
                $Attach_Copy_Of_Pan_Number = 1;
            } else {
                $Attach_Copy_Of_Pan_Number_File_Name = '';
            }
        }




        // if ($request->hasFile('Affidavit_File_Name')) {
        //     $file = $request->file('Affidavit_File_Name');
        //     $Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
        //     $fileUploaded = $file->move($destinationPath, $Affidavit_File_Name);
        //     if ($fileUploaded) {
        //         $Affidavit_Of_Oath = 1;
        //     }
        // } else {
        //     $Affidavit_File_Name = '';
        // }

        //change modify present
        $Affidavit_File_Name = $mod->{'Affidavit File Name'} ?? '';
        if ($request->hasFile('Affidavit_File_Name') || $request->hasFile('Affidavit_File_Name_modify')) {
            $file = $request->file('Affidavit_File_Name') ?? $request->file('Affidavit_File_Name_modify');
            $Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
            $file_uploaded = $file->move($destinationPath, $Affidavit_File_Name);
            if ($file_uploaded) {
                $Affidavit_Of_Oath = 1;
            } else {
                $Affidavit_File_Name = '';
            }
        }




        // if ($request->hasFile('Photo_File_Name')) {
        //     $file = $request->file('Photo_File_Name');
        //     $Photo_File_Name = time() . '-' . $file->getClientOriginalName();
        //     $fileUploaded = $file->move($destinationPath, $Photo_File_Name);
        //     if ($fileUploaded) {
        //         $Photographs = 1;
        //     }
        // } else {
        //     $Photo_File_Name = '';
        // }

        //change modify present
        // $Photo_File_Name = $mod->{'Photo File Name'} ?? '';
        // if ($request->hasFile('Photo_File_Name') || $request->hasFile('Photo_File_Name_modify')) {
        //     $file = $request->file('Photo_File_Name') ?? $request->file('Photo_File_Name_modify');
        //     $Photo_File_Name = time() . '-' . $file->getClientOriginalName();
        //     $file_uploaded = $file->move($destinationPath, $Photo_File_Name);
        //     if ($file_uploaded) {
        //         $Photographs = 1;
        //     } else {
        //         $Photo_File_Name = '';
        //     }
        // }



        // if ($request->hasFile('Legal_Doc_File_Name')) {
        //     $file = $request->file('Legal_Doc_File_Name');
        //     $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
        //     $fileUploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
        //     if ($fileUploaded) {
        //         $Company_Legal_Documents = 1;
        //     }
        // } else {
        //     $Legal_Doc_File_Name = '';
        // }

        //change modify present
        $Legal_Doc_File_Name = $mod->{'Legal Doc File Name'} ?? '';
        if ($request->hasFile('Legal_Doc_File_Name') || $request->hasFile('Legal_Doc_File_Name_modify')) {
            $file = $request->file('Legal_Doc_File_Name') ?? $request->file('Legal_Doc_File_Name_modify');
            $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
            $file_uploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
            if ($file_uploaded) {
                $Company_Legal_Documents = 1;
            } else {
                $Legal_Doc_File_Name = '';
            }
        }



        // if ($request->hasFile('GST_File_Name')) {
        //     $file = $request->file('GST_File_Name');
        //     $GST_File_Name = time() . '-' . $file->getClientOriginalName();
        //     $fileUploaded = $file->move($destinationPath, $GST_File_Name);
        //     if ($fileUploaded) {
        //         $GST_Registration = 1;
        //     }
        // } else {
        //     $GST_File_Name = '';
        // }

        //change modify present
        $GST_File_Name = $mod->{'GST File Name'} ?? '';
        if ($request->hasFile('GST_File_Name') || $request->hasFile('GST_File_Name_modify')) {
            $file = $request->file('GST_File_Name') ?? $request->file('GST_File_Name_modify');
            $GST_File_Name = time() . '-' . $file->getClientOriginalName();
            $file_uploaded = $file->move($destinationPath, $GST_File_Name);
            if ($file_uploaded) {
                $GST_Registration = 1;
            } else {
                $GST_File_Name = '';
            }
        }


        // if ($request->hasFile('Balance_Sheet_File_Name')) {
        //     $file = $request->file('Balance_Sheet_File_Name');
        //     $Balance_Sheet_File_Name = time() . '-' . $file->getClientOriginalName();
        //     $fileUploaded = $file->move($destinationPath, $Balance_Sheet_File_Name);
        //     if ($fileUploaded) {
        //         $CA_Certified_Balance_Sheet = 1;
        //     }
        // } else {
        //     $Balance_Sheet_File_Name = '';
        // }


        //change modify
        // if ($request->hasFile('Balance_Sheet_File_Name') || $request->hasFile('Balance_Sheet_File_Name_modify')) {
        //     $file = $request->file('Balance_Sheet_File_Name') ?? $request->file('Balance_Sheet_File_Name_modify');
        //     $Balance_Sheet_File_Name = time() . '-' . $file->getClientOriginalName();
        //     $file_uploaded = $file->move($destinationPath, $Balance_Sheet_File_Name);
        //     if ($file_uploaded) {
        //         $CA_Certified_Balance_Sheet = 1;
        //     } else {
        //         $Balance_Sheet_File_Name = '';
        //     }
        // }

        $Self_declaration = 1;
        $odmedia_id = $request->vendorid_tab_3;
        // dd($odmedia_id);
        $vendor_table = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
        $update = array(
            'Notarized Copy File Name' => $Notarized_Copy_File_Name,
            'PAN File Name' => $Attach_Copy_Of_Pan_Number_File_Name,
            'Affidavit File Name' => $Affidavit_File_Name,
            'Photo File Name' => '',
            'Legal Doc File Name' => $Legal_Doc_File_Name,
            'GST File Name' => $GST_File_Name,
            'Balance Sheet File Name' => '',
            'Notarized Copy Of Agreement' => $Notarized_Copy_Of_Agreement,
            'PAN Attached' => $Attach_Copy_Of_Pan_Number,
            'Affidavit Of Oath' => $Affidavit_Of_Oath,
            'Photographs' => $Photographs,
            'Company Legal Documents' => $Company_Legal_Documents,
            'GST Registration' => $GST_Registration,
            'CA Certified Balance Sheet' => $CA_Certified_Balance_Sheet,
            'Self-declaration' => $Self_declaration,
            'Modification' => 0
        );
        $up = DB::table($vendor_table)
            ->where('OD Category', 0)
            ->where('OD Media ID', $odmedia_id)
            ->update($update);

        Session::flash('od_message', 'Your data have been submitted successfully. Your reference number is ' . $odmedia_id);

        if ($up) {
            // Session::flash('od_message','Data Saved Your Code!'.$odmedia_id);

            $movingmedia = implode(",", $request->Applying_For_OD_Media_Type); //convert into string                       
            $ary = explode(",", $movingmedia); //again convert array
            $total_media = count($ary); //array count

            $str = $movingmedia;
            $length = 0;
            for ($i = 0; $i < strlen($str); $i++) {
                if ($str[$i] == '3') {
                    $length = $length + 1;
                }
            }
            //return $length;
            if ($length == $total_media) {
                $da = array(
                    "Modification" => 1,
                    "Document Date" => date('Y-m-d')
                );
                DB::table($vendor_table)->where('OD Media ID', $odmedia_id)->update($da);
                // return "File Upload Success. status change One";
                return "Your data have been submitted successfully. Your reference number is " . $odmedia_id;
            }
            // else
            // {
            //     $da=array(
            //         "Status"=>0
            //     );
            //     DB::table($vendor_table)->where('OD Media ID',$odmedia_id)->update($da);
            //     return "File Upload Success. status change Zero";
            // }

            return "Your data have been submitted successfully. Your reference number is " . $odmedia_id;
        }
    }


    public function fetchmedia(Request $request)
    {
        $media_code = $request->media_code;
        $dyn_sub = $request->dyn_sub;

        $table = 'BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2';
        $data = DB::table($table)->where(['Category Group' => $media_code, 'Active' => 1, "OD Media Type" => 0])->get();
        $html = "<option>Select Sub Media Category</option>";
        // $html  = "";
        foreach ($data as $cat) {
            if (is_array($dyn_sub)) {
                if (!in_array($cat->{'OD Media UID'}, $dyn_sub)) {
                    $html .= "<option value='" . $cat->{'OD Media UID'} . "'>" . $cat->Name . "</option>";
                }
            } else {
                $html .= "<option value='" . $cat->{'OD Media UID'} . "'>" . $cat->Name . "</option>";
            }
        }
        echo $html;
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


    public function checkgst(Request $request)
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

    public function removeMediaaddressData(Request $request)
    {
        $resp = (new solerightMedapi)->removeMediaaddress($request->line_no, $request->od_media_id);
        $response = json_decode(json_encode($resp), true);

        if ($response['original']['success'] == true) {
            return response()->json($response['original']['message']);
        } else {
            return response()->json($response['original']['message']);
        }
    }


    //soleright renewal code start 29-Dec-2021
    public function solerightRenewal()
    {
        return view('admin.pages.soleright.Soleright-renewal-form');
    }

    public function solerightRenewalView(Request $request)
    {

        // POD00004
        $boc_code = $request->boc_code;
        Session::put('vendorCode', $boc_code);

        //For Get UserID Start
        $where = array('Allocated Vendor Code' => $boc_code, "OD Media Type" => 0);
        $owner_detail_data = DB::table('BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID as od_media_id', 'Allocated Vendor Code as vendor_code', 'Owner ID as ownerId')->where($where)->first();
        if (!empty($owner_detail_data) && $owner_detail_data != null) {
            $ownerId = $owner_detail_data->ownerId; //find ownerid from detail table
            $od_media_id = $owner_detail_data->od_media_id; //find OD Media ID from detail table 
            Session::put('ODmediaCode', $od_media_id);
            Session::put('vendorCode', $boc_code); //its Vendor Allocated Code
        } else {
            Session::flash('not_found', 'Record Not Found!' . $boc_code);
            //if record not found then redirect renewal form 3-Dec Suman
            return view('admin.pages.soleright.Soleright-renewal-form');
        }


        $find_owner_data = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('User ID as UserID')->where('OD Media ID', $od_media_id)->first();
        $UserID = $find_owner_data->UserID;
        $userid = $UserID;
        //For get UserID  End  



        

        $table = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
        $datas = DB::table($table)->where('User ID', $userid)->first();


        if (!empty($datas)) {
            $owner_id = $datas->{'Owner ID'};
            Session::put('owner_id_detail', $datas->{'Owner ID'});
        } else {
            Session::put('owner_id_detail', "");
        }

        // Lat Long code start 
        $latlongData = DB::table('BOC$OD Latlong Detail$3f88596c-e20d-438c-a694-309eb14559b2')->select("Latitude", "Longitude", "Image File Name", "Remarks")->where('OD Vendor ID', $userid)->get();
        // Lat Long code End

        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);
        $state_code = "";

        $district_array = (new api)->getDistricts();
        $districts = json_decode(json_encode($district_array), true);
        //dd($districts['original']['data']);

        //check record in renewal table(OD Vendor Renewal) start  29-Dec
        $renewalTableRecord = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $od_media_id)->orderBy('Line No_', 'desc')->first();
        if (!empty($renewalTableRecord)) //data exists in renewal table(OD Vendor Renewal) then run this code
        {
            $data = (new solerightMedapi)->showRenewalDetails($userid);
            // dd($data);
            $response = json_decode(json_encode($data), true);
            //dd($response);
            //return "Not Empty";
        } else {
            $data = (new solerightMedapi)->showDetails($userid);
            // dd($data);
            $response = json_decode(json_encode($data), true);
            //dd($response);
        }
        //check record in renewal table end 




        //for all category display 
        $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->get();

        $owner_data = isset($response['original']['data']['OD_owners']) ? $response['original']['data']['OD_owners'] : [];
        // dd($owner_data[0]{'Owner ID'});
        $vendor_data = isset($response['original']['data']['OD_vendors']) ? $response['original']['data']['OD_vendors'] : [];
        $media_owner_details = isset($response['original']['data']['media_owner_details']) ? $response['original']['data']['media_owner_details'] : [];


        $OD_work_dones_data = isset($response['original']['data']['OD_work_dones']) ? $response['original']['data']['OD_work_dones'] : [];
        $OD_media_address_data = isset($response['original']['data']['OD_media_address']) ? $response['original']['data']['OD_media_address'] : [];



        return view('admin.pages.soleright.Soleright-renewal-save-form', ['latlongData' => $latlongData, 'states' => $states['original']['data'], 'districts' => $districts['original']['data']])->with(compact('owner_data', 'vendor_data', 'media_owner_details', 'OD_work_dones_data', 'OD_media_address_data', 'getcat'));
    }



    //Tab 1
    public function ownerRenewal(Request $request)
    {
        $email = $request->owner_email;
        $ownerData = DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->select('Email ID')->where('Email ID', $email)->first();
        if (!empty($ownerData)) {
            $update = array(
                'Owner Name' => $request->owner_name,
                'Mobile No_' => $request->owner_mobile,
                'Phone No_' => $request->phone ?? '',
                'Fax No_' => $request->fax_no ?? '',
                'Address 1' => $request->address,
                'City' => $request->city,
                'District' => $request->district,
                'State' => $request->state
            );
            DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->where('Email ID', $email)->update($update);
            return "Owner Update Success";
        } else {
            return "Email ID Not Fond";
        }
    }

    // for tab2,tab3,tab4
    public function solerightRenewall(Request $request)
    {
        $userid = Session::get('UserID'); //get login user ID sk 30-Dec sk
        $getID = $request->getID;
        $ODmediaCode = Session::get('ODmediaCode'); //its OD Media ID
        $vendorCode = Session::get('vendorCode'); //get allocated vendor code
        if ($getID == 0) {
            // return "Insert";
            // $line_no = DB::select("select TOP 1 [Line No_] from $table4 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
            $line_no = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $ODmediaCode)->orderBy('Line No_', 'desc')->first();
            if (empty($line_no)) {
                $line_no = 10000;
            } else {
                $line_no = $line_no[0]->{"Line No_"};
                $line_no = $line_no + 10000;
            }

            //for tab 4 file upload code start
            $destinationPath = public_path() . '/uploads/sole-right-media/';
            $Notarized_Copy_Of_Agreement = 0;
            $Attach_Copy_Of_Pan_Number = 0;
            $Affidavit_Of_Oath = 0;
            $Photographs = 0;
            $Company_Legal_Documents = 0;
            $GST_Registration = 0;
            $CA_Certified_Balance_Sheet = 0;

            $odmedia_id = $request->vendorid_tab_3;
            $mtable = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
            $mod = DB::table($mtable)->where('OD Media ID', $odmedia_id)->first();


            $Notarized_Copy_File_Name = $mod->{'Notarized Copy File Name'} ?? '';
            if ($request->hasFile('Notarized_Copy_File_Name') || $request->hasFile('Notarized_Copy_File_Name_modify')) {
                $file = $request->file('Notarized_Copy_File_Name') ?? $request->file('Notarized_Copy_File_Name_modify');
                $Notarized_Copy_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Notarized_Copy_File_Name);
                if ($file_uploaded) {
                    $Notarized_Copy_Of_Agreement = 1;
                } else {
                    $Notarized_Copy_File_Name = '';
                }
            }

            $Attach_Copy_Of_Pan_Number_File_Name = $mod->{'PAN File Name'} ?? '';
            if ($request->hasFile('Attach_Copy_Of_Pan_Number_File_Name') || $request->hasFile('Attach_Copy_Of_Pan_Number_File_Name_modify')) {
                $file = $request->file('Attach_Copy_Of_Pan_Number_File_Name') ?? $request->file('Attach_Copy_Of_Pan_Number_File_Name_modify');
                $Attach_Copy_Of_Pan_Number_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Attach_Copy_Of_Pan_Number_File_Name);
                if ($file_uploaded) {
                    $Attach_Copy_Of_Pan_Number = 1;
                } else {
                    $Attach_Copy_Of_Pan_Number_File_Name = '';
                }
            }

            $Affidavit_File_Name = $mod->{'Affidavit File Name'} ?? '';
            if ($request->hasFile('Affidavit_File_Name') || $request->hasFile('Affidavit_File_Name_modify')) {
                $file = $request->file('Affidavit_File_Name') ?? $request->file('Affidavit_File_Name_modify');
                $Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Affidavit_File_Name);
                if ($file_uploaded) {
                    $Affidavit_Of_Oath = 1;
                } else {
                    $Affidavit_File_Name = '';
                }
            }


            $Legal_Doc_File_Name = $mod->{'Legal Doc File Name'} ?? '';
            if ($request->hasFile('Legal_Doc_File_Name') || $request->hasFile('Legal_Doc_File_Name_modify')) {
                $file = $request->file('Legal_Doc_File_Name') ?? $request->file('Legal_Doc_File_Name_modify');
                $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
                if ($file_uploaded) {
                    $Company_Legal_Documents = 1;
                } else {
                    $Legal_Doc_File_Name = '';
                }
            }


            $GST_File_Name = $mod->{'GST File Name'} ?? '';
            if ($request->hasFile('GST_File_Name') || $request->hasFile('GST_File_Name_modify')) {
                $file = $request->file('GST_File_Name') ?? $request->file('GST_File_Name_modify');
                $GST_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $GST_File_Name);
                if ($file_uploaded) {
                    $GST_Registration = 1;
                } else {
                    $GST_File_Name = '';
                }
            }
            //for tab 4 file upload code end

            $insertArray = array(
                "OD Media ID" => $ODmediaCode,
                "Line No_" => $line_no,
                "PM Agency Name" => $request->PM_Agency_Name ?? '',
                "Agreement Start Date" => '1753-01-01 00:00:00.000',
                "Agreement End Date" => '1753-01-01 00:00:00.000',
                "Empanelment Category" => 0,
                "HO Address" => $request->HO_Address ?? '',
                "HO Landline No_" => $request->HO_Landline_No ?? '',
                "HO Fax No_" => $request->HO_Fax_No ?? '',
                "HO E-Mail" => $request->HO_Email ?? '',
                "HO Mobile No_" => $request->HO_Mobile_No ?? '',
                "BO Address" => $request->BO_Address ?? '',
                "BO Landline No_" => $request->BO_Landline_No ?? '',
                "BO Fax No_" => $request->BO_Fax_No ?? '',
                "BO E-Mail" => $request->BO_Email ?? '',
                "BO Mobile No_" => $request->BO_Mobile ?? '',
                "DO Address" => $request->DO_Address ?? '',
                "DO Landline No_" => $request->DO_Landline_No ?? '',
                "DO Fax No_" => $request->DO_Fax_No  ?? '',
                "DO E-Mail" => $request->DO_Email ?? '',
                "DO Mobile No_" => $request->DO_Mobile ?? '',
                "Legal Status of Company" => $request->Legal_Status_of_Company ?? 0,
                "Other Relevant Information" => $request->Other_Relevant_Information ?? '',
                "Authority Which granted Media" => $request->Authority_Which_granted_Media ?? '',
                "Amount paid to Authority" => $request->Amount_paid_to_Authority ?? 0,
                "License From" => $request->License_From ?? '',
                "License To" => $request->License_To ?? '',
                "Media Type" => 0,
                // "Duration" => $request->Media_Type ?? '1753-01-01 00:00:00.000',
                "Rental Agreement" => $request->Rental_Agreement ?? 0,
                "Applying For OD Media Type" => 0,
                "Media Display size" => '',
                "Illumination" => 0,
                "GST No_" => $request->GST_No ?? '',
                "TIN_TAN_VAT No_" => $request->TIN_TAN_VAT_No ?? '',
                "DD Date" => $request->DD_Date ?? '',
                "DD No_" => $request->DD_No ?? '',
                "DD Bank Name" => $request->DD_Bank_Name ?? '',
                "DD Bank Branch Name" => $request->DD_Bank_Branch_Name ?? '',
                "Application Amount" => $request->Application_Amount ?? 0,
                "PAN" => $request->PAN ?? '',
                "Bank Name" => $request->Bank_Name ?? '',
                "Bank Branch" => $request->Bank_Branch ?? '',
                "IFSC Code" => $request->IFSC_Code ?? '',
                "Account No_" => $request->Account_No ?? '',
                "Company Legal Documents" => 0,
                "Notarized Copy Of Agreement" => 0,
                "Photographs" => 0,
                "Affidavit Of Oath" => 0,
                "GST Registration" => 0,
                "CA Certified Balance Sheet" => 0,
                "Self-declaration" => 0,
                "Legal Doc File Name" => $Legal_Doc_File_Name,
                "Notarized Copy File Name" => $Notarized_Copy_File_Name, //
                "Photo File Name" => '',
                "Affidavit File Name" => $Affidavit_File_Name,
                "GST File Name" => $GST_File_Name,
                "Balance Sheet File Name" => '',
                "Authorized Rep Name" => $request->Authorized_Rep_Name ?? '',
                "AR Address" => $request->AR_Address ?? '',
                "AR Landline No_" => $request->AR_Landline_No ?? '',
                "AR FAX No_" => $request->AR_FAX_No ?? '',
                "AR Mobile No_" => $request->AR_Mobile_No ?? '',
                "AR E-mail" => $request->AR_Email ?? '',
                "Contract No_" => $request->Contract_No ?? '',
                "Quantity Of Display" => $request->Quantity_Of_Display ?? '',
                "License Fees" => $request->License_Fee ?? '',
                "PAN Attached" => 0,
                "PAN File Name" => $Attach_Copy_Of_Pan_Number_File_Name,
                "User ID" => $userid,
                "Status" => 0,
                "Global Dimension 1 Code" => '',
                "Global Dimension 2 Code" => '',
                "Sender ID" => '',
                "Receiver ID" => '',
                "Recommended To Committee" => 0,
                "Modification" => 1,
                "Media Sub Category" => '',
                "Rate" => 0,
                "Rate Status" => 0,
                "Rate Remark" => '',
                "Rate Status Date" => '1753-01-01 00:00:00.000',
                "Agr File Path" => '',
                "Agr File Name" => '',
                "Allocated Vendor Code" => $vendorCode,
                "Document Date" => '1753-01-01 00:00:00.000'
            );
            DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->insert($insertArray); //Insert Query In Vendor renewal table 30-Dec Sk
            //insert data end in Vendor renewal table 30-Dec

            // Array Data Insert In Sole Media Address start 31-Dec suman
            $odmedia_id = $request->vendorid_tab_2;
            $line1 = $request->session()->get('line1');
            $table5 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]';
            $check = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID', $odmedia_id)->first();
            if ($check) {
                DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID', $odmedia_id)->delete();
            }


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
                    $ODMFO_Display_Size_Of_Media = isset($request->ODMFO_Display_Size_Of_Media[$key]) ? $request->ODMFO_Display_Size_Of_Media[$key] : '';
                    $Illumination_media = isset($request->Illumination_media[$key]) ? $request->Illumination_media[$key] : '';

                    $od_media_type = isset($request->od_media_type[$key]) ? $request->od_media_type[$key] : 0;

                    // $av_start_date = isset($request->av_start_date[$key]) ? $request->av_start_date[$key] : 0;
                    // $av_end_date = isset($request->av_end_date[$key]) ? $request->av_end_date[$key] : 0;
                    $av_start_date = '1753-01-01 00:00:00.000';
                    $av_end_date = '1753-01-01 00:00:00.000';
                    //add extra field sk end

                    $MA_Latitude =
                        isset($request->MA_Latitude[$key]) ? $request->MA_Latitude[$key] : 0;
                    $MA_Longitude =
                        isset($request->MA_Longitude[$key]) ? $request->MA_Longitude[$key] : 0;
                    $MA_Property_Landmark =
                        isset($request->MA_Property_Landmark[$key]) ? $request->MA_Property_Landmark[$key] : 0;
                    $Image_File_Name =
                        isset($request->Image_File_Name[$key]) ? $request->Image_File_Name[$key] : '';
                    DB::unprepared('SET ANSI_WARNINGS OFF');

                    $mediaaatable = 'BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2';
                    // $line_id = DB::select('select TOP 1 [Line No_] from dbo.[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2] where [Sole Media ID]="'.$odmedia_id.'" order by [Line No_] desc');
                    $line_id = DB::table($mediaaatable)->select('Line No_')->where('Sole Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();

                    if (empty($line_id)) {
                        $line_id = '10000';
                    } else {
                        $line_id = $line_id->{"Line No_"};
                        $line_id++;
                    }
                    $sole_media = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                        "City" => $value,
                        "State" => $MA_State,
                        "District" => $MA_District,
                        "Zone" => $MA_Zone,
                        "Latitude" => 0,
                        "Longitde" => 0,
                        "Landmark" => '',
                        "Image File Name" => '',
                        "OD Media Type" => $Applying_For_OD_Media_Type,
                        "Sole Media ID" => $odmedia_id,
                        "Line No_" => $line_id,
                        "OD Media ID" => $od_media_type,
                        "Display Size" => $ODMFO_Display_Size_Of_Media,
                        "Illumination Type" => $Illumination_media,
                        "Availability Start Date" => $av_start_date,
                        "Availability End Date" => $av_end_date,
                        "Length" => 0,
                        "Width" => 0,
                        "Total Area" => 0,
                        "Rental" => 0,
                        "Rental Type" => 0,
                        "Quantity" => 0
                    ]);

                    $unique_id = $odmedia_id;
                    $msg = 'Data Updated Successfully!';
                }
            }
            // Array Data Insert In Sole Media Address End 31-Dec 

            //excel file upload start 3-Dec suman
            $excel_odmedia_id = Session::put('ex_odmediaid', $odmedia_id);
            if ($request->xls == '1' || $request->xls2 == '1')
                if ($request->hasfile('media_import')) {
                    try {
                        Excel::import(new SoleRightMediaSheets, request()->file('media_import')); //for import
                        return $this->sendResponse('', 'Data retrieved successfully');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                }
            //excel file upload ebd 3-Dec Suman


            //Data add in OD Media Work Done (2nd Tab Last Add More Option) 31-Dec sk
            $table4 = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
            $odmedia_id = $request->vendorid_tab_2;
            if (count($request->ODMFO_Billing_Amount) > 0) {
                $table66 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';
                $table55 = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
                $line_no_val = DB::select("select [Line No_] from $table66 where [OD Media ID] = '" . $odmedia_id . "'");

                $linenn_no = !empty($line_no_val) ? count($line_no_val) : 0;
                if ($linenn_no > 0) {
                    DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmedia_id)->where('OD Media Type', 0)->delete();
                }

                foreach ($request->ODMFO_Billing_Amount as $key => $value) { //ram code start

                    $Document_FileName = '';
                    $File_Uploaded_Status = 0;
                    if (!empty($request->file('ODMFO_Upload_Document')[$key]) && array_key_exists($key, $request->file('ODMFO_Upload_Document'))) {
                        if ($request->hasFile('ODMFO_Upload_Document')) {
                            $file = $request->file('ODMFO_Upload_Document')[$key];
                            $fileName = time() . '-' . $file->getClientOriginalName();
                            $fileUploaded = $file->move(public_path() . '/uploads/personal-media/', $fileName);
                            if ($fileUploaded) {
                                $File_Uploaded_Status = 1;
                                $Document_FileName = $fileName;
                            }
                        } else {
                            $Document_FileName = '';
                        }
                    } else {
                        $Document_FileName = $request->ODMFO_Upload_Document_[$key];
                    }
                    $table6 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';
                    $table5 = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
                    $ODMFO_Year  =
                        isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
                    $ODMFO_Quantity_Of_Display_Or_Duration =
                        isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 0;
                    $ODMFO_Billing_Amount =
                        isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;
                    $allocated_vendor_code = isset($request->allocated_vendor_code[$key]) ? $request->allocated_vendor_code[$key] : '';

                    $unique_id = $odmedia_id;
                    $msg = 'Personal Media Vender Data Updated Successfully!';


                    $workName = isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';

                    //Find Last Line No_ by "OD Media ID" in "BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2" table 31-Dec 
                    $next_line_no = DB::select("select TOP 1 [Line No_] from $table6 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
                    if (empty($next_line_no)) {
                        $next_line_no = 10000;
                    } else {
                        $next_line_no = $next_line_no[0]->{"Line No_"};
                        $next_line_no = $next_line_no + 10000;
                    }

                    DB::unprepared('SET ANSI_WARNINGS OFF');



                    //insert data in OD Media Work done table 31-Dec sk
                    DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                        "OD Media Type" => 0,
                        "OD Media ID" => $odmedia_id,
                        "Line No_" => $next_line_no,
                        "Work Name" => $workName,
                        "Year" => $ODMFO_Year,
                        "Qty Of Display_Duration" => $ODMFO_Quantity_Of_Display_Or_Duration,
                        "Billing Amount" => $ODMFO_Billing_Amount,
                        "File Name" => $Document_FileName,
                        "File Uploaded" => $File_Uploaded_Status,
                        'Allocated Vendor Code' => $allocated_vendor_code
                    ]);

                    DB::unprepared('SET ANSI_WARNINGS ON');
                    // }
                }
            }
            //End Data OD Media Work Done 31-Dec sk
            return "Data Saved";
        } else //update query
        {
            // $line_no=DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID')->orderBy('Line No_','desc')->first();
            // if (empty($line_no)) {
            //     $line_no = 10000;
            // } else {
            //     $line_no = $line_no[0]->{"Line No_"};
            //     $line_no = $line_no + 10000;
            // }

            //for tab 4 file upload code start
            $destinationPath = public_path() . '/uploads/sole-right-media/';
            $Notarized_Copy_Of_Agreement = 0;
            $Attach_Copy_Of_Pan_Number = 0;
            $Affidavit_Of_Oath = 0;
            $Photographs = 0;
            $Company_Legal_Documents = 0;
            $GST_Registration = 0;
            $CA_Certified_Balance_Sheet = 0;

            $odmedia_id = $request->vendorid_tab_3;
            $mtable = 'BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2';
            $mod = DB::table($mtable)->where('OD Media ID', $odmedia_id)->first();


            $Notarized_Copy_File_Name = $mod->{'Notarized Copy File Name'} ?? '';
            if ($request->hasFile('Notarized_Copy_File_Name') || $request->hasFile('Notarized_Copy_File_Name_modify')) {
                $file = $request->file('Notarized_Copy_File_Name') ?? $request->file('Notarized_Copy_File_Name_modify');
                $Notarized_Copy_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Notarized_Copy_File_Name);
                if ($file_uploaded) {
                    $Notarized_Copy_Of_Agreement = 1;
                } else {
                    $Notarized_Copy_File_Name = '';
                }
            }

            $Attach_Copy_Of_Pan_Number_File_Name = $mod->{'PAN File Name'} ?? '';
            if ($request->hasFile('Attach_Copy_Of_Pan_Number_File_Name') || $request->hasFile('Attach_Copy_Of_Pan_Number_File_Name_modify')) {
                $file = $request->file('Attach_Copy_Of_Pan_Number_File_Name') ?? $request->file('Attach_Copy_Of_Pan_Number_File_Name_modify');
                $Attach_Copy_Of_Pan_Number_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Attach_Copy_Of_Pan_Number_File_Name);
                if ($file_uploaded) {
                    $Attach_Copy_Of_Pan_Number = 1;
                } else {
                    $Attach_Copy_Of_Pan_Number_File_Name = '';
                }
            }

            $Affidavit_File_Name = $mod->{'Affidavit File Name'} ?? '';
            if ($request->hasFile('Affidavit_File_Name') || $request->hasFile('Affidavit_File_Name_modify')) {
                $file = $request->file('Affidavit_File_Name') ?? $request->file('Affidavit_File_Name_modify');
                $Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Affidavit_File_Name);
                if ($file_uploaded) {
                    $Affidavit_Of_Oath = 1;
                } else {
                    $Affidavit_File_Name = '';
                }
            }


            $Legal_Doc_File_Name = $mod->{'Legal Doc File Name'} ?? '';
            if ($request->hasFile('Legal_Doc_File_Name') || $request->hasFile('Legal_Doc_File_Name_modify')) {
                $file = $request->file('Legal_Doc_File_Name') ?? $request->file('Legal_Doc_File_Name_modify');
                $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
                if ($file_uploaded) {
                    $Company_Legal_Documents = 1;
                } else {
                    $Legal_Doc_File_Name = '';
                }
            }


            $GST_File_Name = $mod->{'GST File Name'} ?? '';
            if ($request->hasFile('GST_File_Name') || $request->hasFile('GST_File_Name_modify')) {
                $file = $request->file('GST_File_Name') ?? $request->file('GST_File_Name_modify');
                $GST_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $GST_File_Name);
                if ($file_uploaded) {
                    $GST_Registration = 1;
                } else {
                    $GST_File_Name = '';
                }
            }
            //for tab 4 file upload code end

            $updateArray = array(
                "OD Media ID" => $ODmediaCode,
                // "Line No_" => $line_no,
                "PM Agency Name" => $request->PM_Agency_Name ?? '',
                "Agreement Start Date" => '1753-01-01 00:00:00.000',
                "Agreement End Date" => '1753-01-01 00:00:00.000',
                "Empanelment Category" => 0,
                "HO Address" => $request->HO_Address ?? '',
                "HO Landline No_" => $request->HO_Landline_No ?? '',
                "HO Fax No_" => $request->HO_Fax_No ?? '',
                "HO E-Mail" => $request->HO_Email ?? '',
                "HO Mobile No_" => $request->HO_Mobile_No ?? '',
                "BO Address" => $request->BO_Address ?? '',
                "BO Landline No_" => $request->BO_Landline_No ?? '',
                "BO Fax No_" => $request->BO_Fax_No ?? '',
                "BO E-Mail" => $request->BO_Email ?? '',
                "BO Mobile No_" => $request->BO_Mobile ?? '',
                "DO Address" => $request->DO_Address ?? '',
                "DO Landline No_" => $request->DO_Landline_No ?? '',
                "DO Fax No_" => $request->DO_Fax_No  ?? '',
                "DO E-Mail" => $request->DO_Email ?? '',
                "DO Mobile No_" => $request->DO_Mobile ?? '',
                "Legal Status of Company" => $request->Legal_Status_of_Company ?? 0,
                "Other Relevant Information" => $request->Other_Relevant_Information ?? '',
                "Authority Which granted Media" => $request->Authority_Which_granted_Media ?? '',
                "Amount paid to Authority" => $request->Amount_paid_to_Authority ?? 0,
                "License From" => $request->License_From ?? '',
                "License To" => $request->License_To ?? '',
                "Media Type" => 0,
                // "Duration" => $request->Media_Type ?? '1753-01-01 00:00:00.000',
                "Rental Agreement" => $request->Rental_Agreement ?? 0,
                "Applying For OD Media Type" => 0,
                "Media Display size" => '',
                "Illumination" => 0,
                "GST No_" => $request->GST_No ?? '',
                "TIN_TAN_VAT No_" => $request->TIN_TAN_VAT_No ?? '',
                "DD Date" => $request->DD_Date ?? '',
                "DD No_" => $request->DD_No ?? '',
                "DD Bank Name" => $request->DD_Bank_Name ?? '',
                "DD Bank Branch Name" => $request->DD_Bank_Branch_Name ?? '',
                "Application Amount" => $request->Application_Amount ?? 0,
                "PAN" => $request->PAN ?? '',
                "Bank Name" => $request->Bank_Name ?? '',
                "Bank Branch" => $request->Bank_Branch ?? '',
                "IFSC Code" => $request->IFSC_Code ?? '',
                "Account No_" => $request->Account_No ?? '',
                "Company Legal Documents" => 0,
                "Notarized Copy Of Agreement" => 0,
                "Photographs" => 0,
                "Affidavit Of Oath" => 0,
                "GST Registration" => 0,
                "CA Certified Balance Sheet" => 0,
                "Self-declaration" => $request->self_declaration ?? 0,
                "Legal Doc File Name" => $Legal_Doc_File_Name,
                "Notarized Copy File Name" => $Notarized_Copy_File_Name, //
                "Photo File Name" => '',
                "Affidavit File Name" => $Affidavit_File_Name,
                "GST File Name" => $GST_File_Name,
                "Balance Sheet File Name" => '',
                "Authorized Rep Name" => $request->Authorized_Rep_Name ?? '',
                "AR Address" => $request->AR_Address ?? '',
                "AR Landline No_" => $request->AR_Landline_No ?? '',
                "AR FAX No_" => $request->AR_FAX_No ?? '',
                "AR Mobile No_" => $request->AR_Mobile_No ?? '',
                "AR E-mail" => $request->AR_Email ?? '',
                "Contract No_" => $request->Contract_No ?? '',
                "Quantity Of Display" => $request->Quantity_Of_Display ?? '',
                "License Fees" => $request->License_Fee ?? '',
                "PAN Attached" => 0,
                "PAN File Name" => $Attach_Copy_Of_Pan_Number_File_Name,
                "User ID" => $userid,
                "Status" => 0,
                "Global Dimension 1 Code" => '',
                "Global Dimension 2 Code" => '',
                "Sender ID" => '',
                "Receiver ID" => '',
                "Recommended To Committee" => 0,
                "Modification" => 1,
                "Media Sub Category" => '',
                "Rate" => 0,
                "Rate Status" => 0,
                "Rate Remark" => '',
                "Rate Status Date" => '1753-01-01 00:00:00.000',
                "Agr File Path" => '',
                "Agr File Name" => '',
                "Allocated Vendor Code" => $vendorCode,
                "Document Date" => '1753-01-01 00:00:00.000'
            );
            //if status =6 then data again insert, or if status=0 then do Nothing (This Work Not Start Now) 3-Dec Suman start 
            @$check_status = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->select('Status', 'Line No_ as lineno')->where('OD Media ID', $ODmediaCode)->orderBy('Line No_', 'desc')->first();
            if (@$check_status->Status != "6") {
                $updatewhere = array('OD Media ID' => $ODmediaCode, 'Line No_' => @$check_status->lineno);
                $up = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->where($updatewhere)->orderBy('Line No_', 'desc')->update($updateArray);

                //when you chhose moving media in all Media category then status change, for readable
                if ($up) {
                    $movingmedia = implode(",", $request->Applying_For_OD_Media_Type); //convert into string                       
                    $ary = explode(",", $movingmedia); //again convert array
                    $total_media = count($ary); //array count

                    $str = $movingmedia;
                    $length = 0;
                    for ($i = 0; $i < strlen($str); $i++) {
                        if ($str[$i] == '3') {
                            $length = $length + 1;
                        }
                    }
                    //return $length;
                    if ($length == $total_media) {
                        $da = array(
                            "Modification" => 1,
                            "Document Date" => date('Y-m-d')
                        );
                        DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->where($updatewhere)->update($da);
                    }
                }
            } else {
                $line_no = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $ODmediaCode)->orderBy('Line No_', 'desc')->first();
                if (empty($line_no)) {
                    $line_no = 10000;
                } else {
                    $line_no = $line_no->{"Line No_"};
                    $line_no = $line_no + 10000;
                }

                $againInsert = array(
                    "OD Media ID" => $ODmediaCode,
                    "Line No_" => $line_no,
                    "PM Agency Name" => $request->PM_Agency_Name ?? '',
                    "Agreement Start Date" => '1753-01-01 00:00:00.000',
                    "Agreement End Date" => '1753-01-01 00:00:00.000',
                    "Empanelment Category" => 0,
                    "HO Address" => $request->HO_Address ?? '',
                    "HO Landline No_" => $request->HO_Landline_No ?? '',
                    "HO Fax No_" => $request->HO_Fax_No ?? '',
                    "HO E-Mail" => $request->HO_Email ?? '',
                    "HO Mobile No_" => $request->HO_Mobile_No ?? '',
                    "BO Address" => $request->BO_Address ?? '',
                    "BO Landline No_" => $request->BO_Landline_No ?? '',
                    "BO Fax No_" => $request->BO_Fax_No ?? '',
                    "BO E-Mail" => $request->BO_Email ?? '',
                    "BO Mobile No_" => $request->BO_Mobile ?? '',
                    "DO Address" => $request->DO_Address ?? '',
                    "DO Landline No_" => $request->DO_Landline_No ?? '',
                    "DO Fax No_" => $request->DO_Fax_No  ?? '',
                    "DO E-Mail" => $request->DO_Email ?? '',
                    "DO Mobile No_" => $request->DO_Mobile ?? '',
                    "Legal Status of Company" => $request->Legal_Status_of_Company ?? 0,
                    "Other Relevant Information" => $request->Other_Relevant_Information ?? '',
                    "Authority Which granted Media" => $request->Authority_Which_granted_Media ?? '',
                    "Amount paid to Authority" => $request->Amount_paid_to_Authority ?? 0,
                    "License From" => $request->License_From ?? '',
                    "License To" => $request->License_To ?? '',
                    "Media Type" => 0,
                    // "Duration" => $request->Media_Type ?? '1753-01-01 00:00:00.000',
                    "Rental Agreement" => $request->Rental_Agreement ?? 0,
                    "Applying For OD Media Type" => 0,
                    "Media Display size" => '',
                    "Illumination" => 0,
                    "GST No_" => $request->GST_No ?? '',
                    "TIN_TAN_VAT No_" => $request->TIN_TAN_VAT_No ?? '',
                    "DD Date" => $request->DD_Date ?? '',
                    "DD No_" => $request->DD_No ?? '',
                    "DD Bank Name" => $request->DD_Bank_Name ?? '',
                    "DD Bank Branch Name" => $request->DD_Bank_Branch_Name ?? '',
                    "Application Amount" => $request->Application_Amount ?? 0,
                    "PAN" => $request->PAN ?? '',
                    "Bank Name" => $request->Bank_Name ?? '',
                    "Bank Branch" => $request->Bank_Branch ?? '',
                    "IFSC Code" => $request->IFSC_Code ?? '',
                    "Account No_" => $request->Account_No ?? '',
                    "Company Legal Documents" => 0,
                    "Notarized Copy Of Agreement" => 0,
                    "Photographs" => 0,
                    "Affidavit Of Oath" => 0,
                    "GST Registration" => 0,
                    "CA Certified Balance Sheet" => 0,
                    "Self-declaration" => 0,
                    "Legal Doc File Name" => $Legal_Doc_File_Name,
                    "Notarized Copy File Name" => $Notarized_Copy_File_Name, //
                    "Photo File Name" => '',
                    "Affidavit File Name" => $Affidavit_File_Name,
                    "GST File Name" => $GST_File_Name,
                    "Balance Sheet File Name" => '',
                    "Authorized Rep Name" => $request->Authorized_Rep_Name ?? '',
                    "AR Address" => $request->AR_Address ?? '',
                    "AR Landline No_" => $request->AR_Landline_No ?? '',
                    "AR FAX No_" => $request->AR_FAX_No ?? '',
                    "AR Mobile No_" => $request->AR_Mobile_No ?? '',
                    "AR E-mail" => $request->AR_Email ?? '',
                    "Contract No_" => $request->Contract_No ?? '',
                    "Quantity Of Display" => $request->Quantity_Of_Display ?? '',
                    "License Fees" => $request->License_Fee ?? '',
                    "PAN Attached" => 0,
                    "PAN File Name" => $Attach_Copy_Of_Pan_Number_File_Name,
                    "User ID" => $userid,
                    "Status" => 0,
                    "Global Dimension 1 Code" => '',
                    "Global Dimension 2 Code" => '',
                    "Sender ID" => '',
                    "Receiver ID" => '',
                    "Recommended To Committee" => 0,
                    "Modification" => 1,
                    "Media Sub Category" => '',
                    "Rate" => 0,
                    "Rate Status" => 0,
                    "Rate Remark" => '',
                    "Rate Status Date" => '1753-01-01 00:00:00.000',
                    "Agr File Path" => '',
                    "Agr File Name" => '',
                    "Allocated Vendor Code" => $vendorCode,
                    "Document Date" => '1753-01-01 00:00:00.000'
                );
                DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->insert($againInsert);
            }
            //if status =6 then data again insert, or if status=0 then do Nothing (This Work Not Start Now) 3-Dec end


            // DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID',$ODmediaCode)->update($updateArray);
            //Vendor Renewal update data end 30-Dec

            // Array Data Insert In Sole Media Address start 31-Dec 
            $odmedia_id = $request->vendorid_tab_2;
            $line1 = $request->session()->get('line1');
            $table5 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]';
            $check = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID', $odmedia_id)->first();
            if ($check) {
                DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID', $odmedia_id)->delete();
            }


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
                    $ODMFO_Display_Size_Of_Media = isset($request->ODMFO_Display_Size_Of_Media[$key]) ? $request->ODMFO_Display_Size_Of_Media[$key] : '';
                    $Illumination_media = isset($request->Illumination_media[$key]) ? $request->Illumination_media[$key] : '';

                    $od_media_type = isset($request->od_media_type[$key]) ? $request->od_media_type[$key] : 0;

                    // $av_start_date = isset($request->av_start_date[$key]) ? $request->av_start_date[$key] : 0;
                    // $av_end_date = isset($request->av_end_date[$key]) ? $request->av_end_date[$key] : 0;
                    $av_start_date = '1753-01-01 00:00:00.000';
                    $av_end_date = '1753-01-01 00:00:00.000';
                    //add extra field sk end

                    $MA_Latitude =
                        isset($request->MA_Latitude[$key]) ? $request->MA_Latitude[$key] : 0;
                    $MA_Longitude =
                        isset($request->MA_Longitude[$key]) ? $request->MA_Longitude[$key] : 0;
                    $MA_Property_Landmark =
                        isset($request->MA_Property_Landmark[$key]) ? $request->MA_Property_Landmark[$key] : 0;
                    $Image_File_Name =
                        isset($request->Image_File_Name[$key]) ? $request->Image_File_Name[$key] : '';
                    DB::unprepared('SET ANSI_WARNINGS OFF');

                    $mediaaatable = 'BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2';
                    // $line_id = DB::select('select TOP 1 [Line No_] from dbo.[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2] where [Sole Media ID]="'.$odmedia_id.'" order by [Line No_] desc');
                    $line_id = DB::table($mediaaatable)->select('Line No_')->where('Sole Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();

                    if (empty($line_id)) {
                        $line_id = '10000';
                    } else {
                        $line_id = $line_id->{"Line No_"};
                        $line_id++;
                    }
                    

                    $sole_media = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                        "City" => $value,
                        "State" => $MA_State,
                        "District" => $MA_District,
                        "Zone" => $MA_Zone,
                        "Latitude" => 0,
                        "Longitde" => 0,
                        "Landmark" => '',
                        "Image File Name" => '',
                        "OD Media Type" => $Applying_For_OD_Media_Type,
                        "Sole Media ID" => $odmedia_id,
                        "Line No_" => $line_id,
                        "OD Media ID" => $od_media_type,
                        "Display Size" => $ODMFO_Display_Size_Of_Media,
                        "Illumination Type" => $Illumination_media,
                        "Availability Start Date" => $av_start_date,
                        "Availability End Date" => $av_end_date,
                        "Length" => 0,
                        "Width" => 0,
                        "Total Area" => 0,
                        "Rental" => 0,
                        "Rental Type" => 0,
                        "Quantity" => 0
                    ]);



                    $unique_id = $odmedia_id;
                    $msg = 'Data Updated Successfully!';
                }
            }


            // Array Data Insert In Sole Media Address End 31-Dec 

            //excel file upload 
            $excel_odmedia_id = Session::put('ex_odmediaid', $odmedia_id);
            if ($request->hasfile('media_import')) {
                try {
                    Excel::import(new SoleRightMediaSheets, request()->file('media_import')); //for import
                    return $this->sendResponse('', 'Data retrieved successfully');
                } catch (ValidationException $ex) {

                    $failures = $ex->failures();
                    foreach ($failures as $failure) {
                        return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                    }
                }
            }
            //excel file upload ebd 3-Dec



            $table4 = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
            $odmedia_id = $request->vendorid_tab_2;
            if (count($request->ODMFO_Billing_Amount) > 0) {
                $table66 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';
                $table55 = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
                //Old Code
                $line_no_val = DB::select("select [Line No_] from $table66 where [OD Media ID] = '" . $odmedia_id . "'");


                $linenn_no = !empty($line_no_val) ? count($line_no_val) : 0;
                if ($linenn_no > 0) {
                    DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmedia_id)->where('OD Media Type', 0)->delete();
                }

                foreach ($request->ODMFO_Billing_Amount as $key => $value) { //ram code start

                    $Document_FileName = '';
                    $File_Uploaded_Status = 0;
                    if (!empty($request->file('ODMFO_Upload_Document')[$key]) && array_key_exists($key, $request->file('ODMFO_Upload_Document'))) {
                        if ($request->hasFile('ODMFO_Upload_Document')) {
                            $file = $request->file('ODMFO_Upload_Document')[$key];
                            $fileName = time() . '-' . $file->getClientOriginalName();
                            $fileUploaded = $file->move(public_path() . '/uploads/personal-media/', $fileName);
                            if ($fileUploaded) {
                                $File_Uploaded_Status = 1;
                                $Document_FileName = $fileName;
                            }
                        } else {
                            $Document_FileName = '';
                            // unlink(public_path() . '/uploads/personal-media/'.$request->ODMFO_Upload_Document_[$key]); 
                        }
                    } else {
                        $Document_FileName = $request->ODMFO_Upload_Document_[$key];
                    }
                    $table6 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';
                    $table5 = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
                    $ODMFO_Year  =
                        isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
                    $ODMFO_Quantity_Of_Display_Or_Duration =
                        isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 0;
                    $ODMFO_Billing_Amount =
                        isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;
                    $allocated_vendor_code = isset($request->allocated_vendor_code[$key]) ? $request->allocated_vendor_code[$key] : '';


                    $unique_id = $odmedia_id;
                    $msg = 'Personal Media Vender Data Updated Successfully!';


                    $workName = isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';

                    //Find Last Line No_ by "OD Media ID" in "BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2" table 31-Dec
                    $next_line_no = DB::select("select TOP 1 [Line No_] from $table6 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");

                    if (empty($next_line_no)) {
                        $next_line_no = 10000;
                    } else {
                        $next_line_no = $next_line_no[0]->{"Line No_"};
                        $next_line_no = $next_line_no + 10000;
                    }

                    DB::unprepared('SET ANSI_WARNINGS OFF');

                    
                    DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                        "OD Media Type" => 0,
                        "OD Media ID" => $odmedia_id,
                        "Line No_" => $next_line_no,
                        "Work Name" => $workName,
                        "Year" => $ODMFO_Year,
                        "Qty Of Display_Duration" => $ODMFO_Quantity_Of_Display_Or_Duration,
                        "Billing Amount" => $ODMFO_Billing_Amount,
                        "File Name" => $Document_FileName,
                        "File Uploaded" => $File_Uploaded_Status,
                        'Allocated Vendor Code' => $allocated_vendor_code
                    ]);

                    DB::unprepared('SET ANSI_WARNINGS ON');
                    // }
                }
            }
            //End Data OD Media Work Done 31-Dec sk
            return "Data Saved Success..";
        }
    }




    public function MediaWorkDone_delete(Request $request)
    {
        $line_no = $request->line_no;
        $od_media_id = $request->od_media_id;

        $where = array("OD Media ID" => $od_media_id, 'Line No_' => $line_no);
        $data = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->delete();
        return "Data Delete Successfully";
    }


    public function soleaddress_delete(Request $request)
    {
        $line_no = $request->line_no;
        $od_media_id = $request->od_media_id;

        $where = array("Sole Media ID" => $od_media_id, 'Line No_' => $line_no);
        $data = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->delete();
        return "Data Delete Successfully";
    }


    public function existing_user(Request $request)
    {
        $code = $request->code;
        $res = DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->select('Owner Name as name', 'Mobile No_ as mobile', 'Email ID as email', 'Address 1 as address', 'City', 'State', 'District', 'Phone No_ as phone_no')->where('Owner ID', $code)->first();
        //  dd($res);
        // return $res->name;
        if (!empty($res)) {
            // return $res;
            return array(["msg" => $res, "status" => 1]);
        } else {
            return array(["msg" => "Data Not Found", "status" => 0]);
        }

        // return response()->json(["result"=>$res]);
        // return response()->json(['result' => $res],200);
        // return json_encode($res);
    }

    public function soleright_list_backup()
    {
        $userid = Session::get('UserID');
        /*$where = array('User ID' => $userid, "Modification" => 1, 'OD Category' => 0);
        $vendor = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID as media_id', 'HO E-Mail as ho_email', 'GST No_ as gst', 'HO Mobile No_ as mobile', 'Modification', 'Allocated Vendor Code as vendor_code', 'License From as from_date', 'License To as to_date')->where($where)->orderBy('OD Media ID','desc')->get();*/
        $vendor = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2 as odmedia')
                    ->select('odmedia.OD Media ID as media_id', 'odmedia.HO E-Mail as ho_email', 'odmedia.GST No_ as gst', 'odmedia.HO Mobile No_ as mobile', 'odmedia.Modification', 'odmedia.Allocated Vendor Code as vendor_code', 'odmedia.License From as from_date', 'odmedia.License To as to_date','odmedia.User ID as user_id','odmedia.Modification as Modification','odmedia.OD Category as od_category','renewal.License From as renewal_license_from','renewal.License To as renewal_license_to')
                    ->leftJoin('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2 as renewal', "renewal.OD Media ID", "=", "odmedia.OD Media ID")
                    ->where(["odmedia.User ID"=>$userid,"odmedia.Modification"=>1,"odmedia.OD Category"=>0])
                    ->orderBy('odmedia.OD Media ID','DESC')
                    ->get();


        $pending_count = 0;
        foreach ($vendor as $key => $val) {
            $payment_status = DB::table('BOC$Vendor Fees$3f88596c-e20d-438c-a694-309eb14559b2')->select('Status')->where('Media ID', $val->media_id)->first();

            if (empty($payment_status)) {
                $vendor[$key]->payment_status = 'Pending';
                $pending_count++;
            } else {
                $vendor[$key]->payment_status = $payment_status->Status;
            }
        }
        return view('admin.pages.soleright.sole-right-list', ["vendor" => $vendor, 'pending_count' => $pending_count]);
    }



    public function solerightlist()
    {
        $userid = Session::get('UserID');
        $vendor_data = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2 as odmedia')
            ->select('odmedia.OD Media ID as media_id', 'odmedia.HO E-Mail as ho_email', 'odmedia.GST No_ as gst', 'odmedia.HO Mobile No_ as mobile', 'odmedia.Modification', 'odmedia.Allocated Vendor Code as vendor_code', 'odmedia.License From as from_date', 'odmedia.License To as to_date', 'odmedia.User ID as user_id', 'odmedia.Modification as Modification', 'odmedia.OD Category as od_category', 'renewal.License From as renewal_license_from', 'renewal.License To as renewal_license_to', 'fee.Status as payment_status','sole.OD Media Type as category')
            ->leftJoin('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2 as renewal', "renewal.OD Media ID", "=", "odmedia.OD Media ID")

            ->leftJoin('BOC$Vendor Fees$3f88596c-e20d-438c-a694-309eb14559b2 as fee', "fee.Media ID", "=", "odmedia.OD Media ID")
            ->leftJoin('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2 as sole','sole.Sole Media ID','=','odmedia.OD Media ID')
            ->where(["odmedia.User ID" => $userid, "odmedia.Modification" => 1, "odmedia.OD Category" => 0])
            ->orderBy('odmedia.OD Media ID', 'desc')
            ->get();
        $pending_count = 0;
        $vendor_arr = array();
        $vendor = array();

        foreach ($vendor_data as $key => $val) {
            if ($val->payment_status == 'SUCCESS') {
                array_push($vendor_arr, $val);
            } else {
                array_push($vendor, $val);
                $pending_count++;
            }
        }

        if (count($vendor_arr) > 0) {
            foreach ($vendor_arr as $key => $val) {
                array_push($vendor, $val);
            }
        }
        return view('admin.pages.soleright.sole-right-list', ["vendor" => $vendor, 'pending_count' => $pending_count]);
    }




    


    

    // public function findSubCategory(Request $request)
    // {
    //     $subcat=$request->sub_category_val;
    //     $userid = Session::get('UserID');
    //     $where=array("User ID"=>$userid,"OD Category"=>2,"Status"=>0);
    //     $vendor=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID')->where($where)->first();
    //     if($vendor)
    //     {
    //         $od_media_id=$vendor->{'OD Media ID'};
    //         $wh=array("Sole Media ID"=>$od_media_id,"OD Media ID"=>$subcat);
    //         $sole=DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID')->where($wh)->first(); 
    //         // dd($sole);
    //         if($sole)
    //         {
    //             // return "Yes";
    //             return ["status"=>'1'];
    //         }
    //         else
    //         {
    //             return ["status"=>'0'];
    //             // return "Not";
    //         }
    //     }

    // }


    public function findSubCategory(Request $request)
    {
        //sweet alert
        $subcat = $request->sub_category_val;
        // $subcat="OD108";
        $userid = Session::get('UserID');
        $where = array("User ID" => $userid, "OD Category" => 0);
        $vendor = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->pluck('OD Media ID')->toArray();
        if ($vendor) {
            $od_media_id = implode(",", $vendor);
            // $od_media_id=$vendor->{'OD Media ID'};
            $sole = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID')->where("OD Media ID", $subcat)->whereIn("Sole Media ID", [$vendor])->get();
            // dd($sole[0]->{'OD Media ID'});
            if (@$sole[0]->{'OD Media ID'} != '') {
                return ["status" => '1'];
            } else {
                return ["status" => '0'];
            }
        }
    }



    public function show_subcategory(Request $request)
    {
        $cat_id = $request->cat_id;
        $data = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media Type as cat', 'OD Media ID as subcat')->where('Sole Media ID', $cat_id)->get();
        $cat_temp = [];
        $sub_temp = [];
        $temp1 = [];
        foreach ($data as $list) {
            $cat_data = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where("OD Media UID", $list->subcat)->get();
            foreach ($cat_data as $cat_list) {
                $temp1[] = $cat_list->Name;
            }
        }
        // dd($temp1);
        // return response()->json(["result"=>$temp1]);
        return implode(" <br>", $temp1);
    }


    public function show_category(Request $request)
    {
        // return $request->cat_id;
        $cat_id = $request->cat_id;
        // dd($cat_id);
        $data = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media Type as cat', 'OD Media ID as subcat')->where('Sole Media ID', $cat_id)->get();
        $cat_temp = [];
        $sub_temp = [];
        $temp1 = [];
        foreach ($data as $list) {
            $cat_temp[] = $list->cat;
            // $cat_data=DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where("OD Media Type",$list->cat)->get();          
            // foreach($cat_data as $cat_list)
            // {
            //     $temp1[]=$cat_list->{'OD Media Type'};
            // }

        }
        // dd($cat_temp);
        // return response()->json(["result"=>$cat_temp]);
        return ["result" => $cat_temp];
        // return implode(" <br>",$temp1);
    }



    public function vendor_account()
    {
        return view('admin.pages.soleright.account_details');
    }

    public function existinguser()
    {
        $user_id = Session::get('UserID');
        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);
        // dd($states);
        $state_code = "";
        $district_array = (new api)->getDistricts();
        $districts = json_decode(json_encode($district_array), true);

        $vendor = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where(["User ID" => $user_id, "OD Category" => 0, "Modification" => 0])->orderBy('OD Media ID','desc')->first();
        if ($vendor) {
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
            $odmediaid = $vendor->{'OD Media ID'};
            $OD_media_address_datas = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select($select)->where("Sole Media ID", $odmediaid)->get();
            $works = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->select('Year','Qty Of Display_Duration','Line No_','Billing Amount','From Date','To Date','OD Media ID')->where(["OD Media ID" => $odmediaid, "OD Media Type" => 0])->get();
            $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->where('Category Group', @$OD_media_address_datas[0]->{'OD Media Type'})->get();
            $vendorcheck = 0;
            $OD_work_dones_data = json_decode(json_encode($works), true);
            $OD_media_address_data = json_decode(json_encode($OD_media_address_datas), true);
        } else {
            $odmediaid = '';
            $OD_media_address_data = [1];
            $OD_work_dones_data = [];
            $getcat = [];
            $vendorcheck = 1;
        }

        return view('admin.pages.soleright.sole-right-existing-form', ['states' => $states['original']['data'], 'districts' => $districts['original']['data']], compact('vendor', 'OD_media_address_data', 'OD_work_dones_data', 'getcat', 'vendorcheck'));
    }


    public function existingUserSaved(Request $request)
    {
        $user_id = Session::get('UserID');
        // $user_id='EMRVV76';
        $ownerdata = DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where('User ID', $user_id)->first();
        $ownerid = $ownerdata->{'Owner ID'};

        $vendordata = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where(["User ID" => $user_id, "OD Category" => 0])->orderBy('OD Media ID', 'desc')->first();

        // dd($vendordata);

        $destinationPath = public_path() . '/uploads/sole-right-media/';        

        $mod = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where(["User ID" => $user_id, "OD Category" => 0, "Modification" => 0])->first();
        // dd($mod->{'Legal Doc File Name'});
        $Legal_Doc_File_Name = $mod->{'Legal Doc File Name'} ?? '';
        if ($request->hasFile('Legal_Doc_File_Name') || $request->hasFile('Legal_Doc_File_Name_modify')) {
            $file = $request->file('Legal_Doc_File_Name') ?? $request->file('Legal_Doc_File_Name_modify');
            $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
            $file_uploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
            if ($file_uploaded) {
                $Company_Legal_Documents = 1;
            } else {
                $Legal_Doc_File_Name = '';
            }
        }


        $Affidavit_File_Name = $mod->{'Affidavit File Name'} ?? '';
        if ($request->hasFile('Affidavit_File_Name') || $request->hasFile('Affidavit_File_Name_modify')) {
            $file = $request->file('Affidavit_File_Name') ?? $request->file('Affidavit_File_Name_modify');
            $Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
            $file_uploaded = $file->move($destinationPath, $Affidavit_File_Name);
            if ($file_uploaded) {
                $Affidavit_Of_Oath = 1;
            } else {
                $Affidavit_File_Name = '';
            }
        }


        if ($request->vendorcheck == 1) {
            // dd('insert');
            $old_odmedia_id = $vendordata->{'OD Media ID'};
            // $odmedia_id = DB::select('select TOP 1 [OD Media ID] from dbo.[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2] order by [OD Media ID] desc');
            // $odmedia_id_check = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID')->orderBy('OD Media ID', 'desc')->first();

            $odmedia_id_check=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID')->where('OD Media ID','LIKE','%'.'OPF'.'%')->first();
            if (empty($odmedia_id_check)) {
                $odmedia_id = 'OPF000001';
            } else {
                $odmedia_id = $odmedia_id_check->{'OD Media ID'};
                $odmedia_id++;
            }

            // dd($vendordata->{'Legal Doc File Name'});

            // dd($vendorcheck);
            $vendor_array = array(
                "OD Category" => $vendordata->{'OD Category'},
                "OD Media ID" => $odmedia_id,
                "PM Agency Name" => $vendordata->{'PM Agency Name'},
                "HO Address" => $vendordata->{'HO Address'},
                "HO Landline No_" => $vendordata->{'HO Landline No_'},
                "HO Fax No_" => $vendordata->{'HO Fax No_'},
                "HO E-Mail" => $vendordata->{'HO E-Mail'},       //HO E-Mail
                "HO Mobile No_" => $vendordata->{'HO Mobile No_'},
                "DO Address" => $vendordata->{'DO Address'},
                "DO Landline No_" => $vendordata->{'DO Landline No_'},
                "DO Fax No_" => $vendordata->{'DO Fax No_'},
                "DO E-Mail" => $vendordata->{'DO E-Mail'},
                "DO Mobile No_" => $vendordata->{'DO Mobile No_'},
                "Legal Status of Company" => $vendordata->{'Legal Status of Company'},
                "Other Relevant Information" => $vendordata->{'Other Relevant Information'},
                "Authority Which granted Media" => $request->Authority_Which_granted_Media, //$vendordata->{'Authority Which granted Media'},
                "Amount paid to Authority" => $vendordata->{'Amount paid to Authority'},
                "License From" => $request->License_From,    //$vendordata->{'License From'},
                "License To" => $request->License_To,       //$vendordata->{'License To'},
                "Duration" => $vendordata->{'Duration'},
                "Rental Agreement" => $vendordata->{'Rental Agreement'},
                "Applying For OD Media Type" => $vendordata->{'Applying For OD Media Type'},
                "Media Display size" => $vendordata->{'Media Display size'},
                "Illumination" => $vendordata->{'Illumination'},
                "GST No_" => $vendordata->{'GST No_'},
                "TIN_TAN_VAT No_" => $vendordata->{'TIN_TAN_VAT No_'},
                "DD Date" => $vendordata->{'DD Date'},
                "DD No_" => $vendordata->{'DD No_'},
                "DD Bank Name" => $vendordata->{'DD Bank Name'},
                "DD Bank Branch Name" => $vendordata->{'DD Bank Branch Name'},
                "Application Amount" => $vendordata->{'Application Amount'},
                "PAN" => $vendordata->{'PAN'},
                "Bank Name" => $vendordata->{'Bank Name'},
                "Bank Branch" => $vendordata->{'Bank Branch'},
                "IFSC Code" => $vendordata->{'IFSC Code'},
                "Account No_" => $vendordata->{'Account No_'},
                "Company Legal Documents" => $vendordata->{'Company Legal Documents'},
                "Notarized Copy Of Agreement" => $vendordata->{'Notarized Copy Of Agreement'},
                "Photographs" => $vendordata->{'Photographs'},
                "Affidavit Of Oath" => $vendordata->{'Affidavit Of Oath'},
                "GST Registration" => $vendordata->{'GST Registration'},
                "CA Certified Balance Sheet" => $vendordata->{'CA Certified Balance Sheet'},
                "Self-declaration" => $vendordata->{'Self-declaration'},      //Self-declaration

                "Legal Doc File Name" => $vendordata->{'Legal Doc File Name'}, //$Legal_Doc_File_Name ?? '', //upload file

                "Notarized Copy File Name" => $vendordata->{'Notarized Copy File Name'},
                "Photo File Name" => $vendordata->{'Photo File Name'},
                "Affidavit File Name" => $Affidavit_File_Name ?? '',  //upload file

                "GST File Name" => $vendordata->{'GST File Name'},
                "Balance Sheet File Name" => $vendordata->{'Balance Sheet File Name'},
                "Contract No_" => $request->Contract_No,  //$vendordata->{'Contract No_'},
                "Quantity Of Display" => $request->Quantity_Of_Display ?? '',  //$vendordata->{'Quantity Of Display'},
                "License Fees" => $request->License_Fee, //$vendordata->{'License Fees'},
                "PAN Attached" => $vendordata->{'PAN Attached'},
                "PAN File Name" => $vendordata->{'PAN File Name'},
                "User ID" => $vendordata->{'User ID'},
                "Status" => $vendordata->{'Status'},
                "Global Dimension 1 Code" => $vendordata->{'Global Dimension 1 Code'},
                "Global Dimension 2 Code" => $vendordata->{'Global Dimension 2 Code'},
                "Sender ID" => $vendordata->{'Sender ID'},
                "Receiver ID" => $vendordata->{'Receiver ID'},
                "Recommended To Committee" => $vendordata->{'Recommended To Committee'},
                "Modification" => 0,
                "Media Sub Category" => $vendordata->{'Media Sub Category'},
                "Rate" => $vendordata->{'Rate'},
                "Rate Status" => $vendordata->{'Rate Status'},
                "Rate Remark" => $vendordata->{'Rate Remark'},
                "Rate Status Date" => $vendordata->{'Rate Status Date'},
                "Agr File Path" => '',
                "Agr File Name" => '',
                "Allocated Vendor Code" => $odmedia_id,
                "Document Date" => $vendordata->{'Document Date'},
                "Empanelment Category" => $vendordata->{'Empanelment Category'},
                "From Date" => $vendordata->{'From Date'},
                "To Date" => $vendordata->{'To Date'},
                "File Name" => $vendordata->{'File Name'},
                "File Uploaded" => $vendordata->{'File Uploaded'},
                "Application Type" => 1,
                "Cancelled Cheque File Name"=>''
            );


            $getBranch = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->where(["OD Media ID" => $old_odmedia_id, "OD Media Type" => 0])->get();
            // $branch_ary=[];
            foreach ($getBranch as $key => $getBranchs) {
                $line_no = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();
                if (empty($line_no)) {
                    $line_no = 10000;
                } else {
                    $line_no = $line_no->{"Line No_"};
                    $line_no = $line_no + 10000;
                }
                $branch = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                    "OD Media Type" => 0,
                    "OD Media ID" => $odmedia_id,
                    "Line No_" => $line_no,
                    "State" => $getBranchs->State,
                    "BO Address" => $getBranchs->{'BO Address'},
                    "BO Landline No_" => $getBranchs->{'BO Landline No_'},
                    "BO E-Mail" => $getBranchs->{'BO E-Mail'},
                    "BO Mobile No_" => $getBranchs->{'BO Mobile No_'},
                    "User ID" => Session::get('UserID')
                ]);
            }
            if (!$branch) {
                return $this->sendError('Some Error Occurred! OD Branch Offices table');
                exit;
            }

            //for Auth Representative

            $getAuth = DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->where(["OD Media ID" => $old_odmedia_id, "OD Media Type" => 0])->get();
            foreach ($getAuth as $key => $getAuths) {
                $line_no = DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();
                if (empty($line_no)) {
                    $line_no = 10000;
                } else {
                    $line_no = $line_no->{"Line No_"};
                    $line_no = $line_no + 10000;
                }
                $auth = DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                    "OD Media Type" => 0,
                    "OD Media ID" => $odmedia_id,
                    "Line No_" => $line_no,
                    "AR Name" => $getAuths->{'AR Name'},
                    "AR Address" => $getAuths->{'AR Address'},
                    "AR Mobile" => $getAuths->{'AR Mobile'},
                    "AR Phone No_" => $getAuths->{'AR Phone No_'},
                    "AR Email" => $getAuths->{'AR Email'},
                    "Company Legal Status" => $getAuths->{'Company Legal Status'},
                    "Alternate Mobile No_" => $getAuths->{'Alternate Mobile No_'},
                    "User ID" => Session::get('UserID')
                ]);
            }
            if (!$auth) {
                return $this->sendError('Some Error Occurred! OD Branch Offices table');
                exit;
            }




            // foreach($request->Authorized_Rep_Name as $key => $rep_name)
            // {
            //     $line_no = DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();
            //     if (empty($line_no)) {
            //         $line_no = 10000;
            //     } else {
            //         $line_no = $line_no->{"Line No_"};
            //         $line_no = $line_no + 10000;
            //     }

            //     $authorized_data=array(
            //         "OD Media Type" =>2,
            //         "OD Media ID" =>$odmedia_id,
            //         "Line No_" =>$line_no,
            //         "AR Name" =>$rep_name,
            //         "AR Address"=> $request->AR_Address[$key] ?? '',
            //         "AR Mobile"=> $request->AR_Mobile_No[$key] ?? '',
            //         "AR Phone No_" => $request->AR_Landline_No[$key] ?? '',
            //         "AR Email" => $request->AR_Email[$key] ?? '',
            //         "Company Legal Status"=>$request->Legal_Status_of_Company[$key] ?? '',
            //         "Alternate Mobile No_" =>$request->altername_mobile[$key] ?? ''
            //     );

            //     $aut=DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->insert($authorized_data);
            // }
            // if (!$aut) {
            //     return $this->sendError('Some Error Occurred! OD Auth Reper table');
            //     exit;
            // }


            if ($request->xls == 0) {

                $table5 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]';
                // if (count($request->MA_City) > 0) {
                if (!empty($request->MA_City[0])) {
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

                            // $av_start_date = isset($request->av_start_date[$key]) ? $request->av_start_date[$key] : '1753-01-01';
                            // $av_end_date = isset($request->av_end_date[$key]) ? $request->av_end_date[$key] : '1753-01-01';
                            $av_start_date = '1753-01-01 00:00:00.000';
                            $av_end_date = '1753-01-01 00:00:00.000';

                            //add extra field sk end

                            $MA_Latitude = isset($request->MA_Latitude[$key]) ? $request->MA_Latitude[$key] : 0;
                            $MA_Longitude = isset($request->MA_Longitude[$key]) ? $request->MA_Longitude[$key] : 0;
                            $MA_Property_Landmark = isset($request->MA_Property_Landmark[$key]) ? $request->MA_Property_Landmark[$key] : 0;
                            $Image_File_Name = isset($request->Image_File_Name[$key]) ? $request->Image_File_Name[$key] : '';

                            $length = isset($request->length[$key]) ? $request->length[$key] : 0;
                            $width = isset($request->width[$key]) ? $request->width[$key] : 0;
                            $quantity = isset($request->quantity[$key]) ? $request->quantity[$key] : 0;
                            $total_area = $length * $width;

                            $trainData = isset($request->Train_Data[$key]) ? explode("-", $request->Train_Data[$key]) : '';
                            $Train_No = isset($request->Train_Data[$key]) ? trim($trainData[0]) : 0;
                            $Train_Name = isset($request->Train_Data[$key]) ? trim($trainData[1]) : 0;
                            $No_of_Spot = isset($request->No_of_Spots[$key]) ? $request->No_of_Spots[$key] : 0;
                            $Size_Type = isset($request->Size_Type[$key]) ? $request->Size_Type[$key] : 0;
                            $lit_type = isset($request->lit_type[$key]) ? $request->lit_type[$key] : 0;
                            DB::unprepared('SET ANSI_WARNINGS OFF');


                            $table55 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]';
                            //$check=DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID',$odmedia_id)->first();
                            // if($check)
                            // {
                            //     DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID',$odmedia_id)->delete();
                            // }

                            $sql5 = DB::insert("insert into $table5([timestamp],[OD Media Type],[Sole Media ID],[Line No_],[City],[State], [District],[Zone],[Latitude],[Longitde],[Landmark],[Image File Name],[OD Media ID],[Display Size],[Illumination Type],[Availability Start Date],[Availability End Date],[Length],[Width],[Total Area],[Rental],[Rental Type],[Quantity],[Train Number],[Train Name],[Size Type],[Duration],[No Of Spot],[Lit Type]) values(DEFAULT,$Applying_For_OD_Media_Type,'" . $odmedia_id . "',$line_no,'" . $MA_City . "','" . $MA_State . "','" . $MA_District . "',$MA_Zone,$MA_Latitude,$MA_Longitude,'" . $MA_Property_Landmark . "','" . $Image_File_Name . "','" . $od_media_type . "','" . $ODMFO_Display_Size_Of_Media . "','" . $Illumination_media . "','" . $av_start_date . "','" . $av_end_date . "','" . $length . "','" . $width . "','" . $total_area . "',0,0,'" . $quantity . "','" . $Train_No . "','" . $Train_Name . "',$Size_Type,0,$No_of_Spot,$lit_type)");


                            $lineno1[] = $line_no;
                            $request->session()->put('line1', $lineno1);

                            DB::unprepared('SET ANSI_WARNINGS ON');
                        }
                    }
                    if (!$sql5) {
                        return $this->sendError('Some Error Occurred!.7777');
                        exit;
                    }
                } //if close of sole media address
            }

            $table4 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';
            // if (count($request->ODMFO_Year) > 0) {
            $od_media_category = 0;
            if ($request->xls2 == 0) {
                if (!empty($request->ODMFO_Billing_Amount[0])) {
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
                        // $Document_FileName = isset($dataFile['Upload_Document_FileName'][$key]) ? $dataFile['Upload_Document_FileName'][$key] : '';
                        // $from_date=$request->from_date[$key] ?? '';
                        // $to_date=$request->to_date[$key] ?? '';
                        $from_date = isset($request->from_date[$key]) ? $request->from_date[$key] : '1753-01-01 00:00:00.000';
                        $to_date = isset($request->to_date[$key]) ? $request->to_date[$key] : '1753-01-01 00:00:00.000';
                        DB::unprepared('SET ANSI_WARNINGS OFF');

                        $sql4 = DB::insert("insert into $table4([timestamp],[OD Media Type],[OD Media ID],[Line No_],[Work Name],[Year],[Qty Of Display_Duration],[Billing Amount],[Allocated Vendor Code],[From Date],[To Date]) values(DEFAULT,$od_media_category,'" . $odmedia_id . "',$line_no,'" . $workName . "','" . $ODMFO_Year . "',$ODMFO_Quantity_Of_Display_Or_Duration,$ODMFO_Billing_Amount,'','" . $from_date . "','" . $to_date . "')");
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

            $vendorinsert = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->insert($vendor_array);

            $detail_data = DB::table('BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                "OD Media Type" => 0,
                "OD Media ID" => $odmedia_id,
                "Owner ID" => $ownerid,
                "Allocated Vendor Code" => ''
            ]);

            //When you choose movieing media than modification value set one start
            $movingmedia = implode(",", $request->Applying_For_OD_Media_Type); //convert into string                       
            $ary = explode(",", $movingmedia); //again convert array
            $total_media = count($ary); //array count

            $str = $movingmedia;
            $length = 0;
            for ($i = 0; $i < strlen($str); $i++) {
                if ($str[$i] == '3') {
                    $length = $length + 1;
                }
            }
            //return $length;
            if ($length == $total_media) {
                $da = array(
                    "Modification" => 1,
                    "Document Date" => date('Y-m-d')
                );
                DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmedia_id)->update($da);
                // return ["Msg"=>"Data Update Success","code"=>$odmedia_id];
            }
            //When you choose movieing media than modification value set one end


            if (!$detail_data || !$vendorinsert) {
                return $this->sendError('Some Error Occurred!.6666');
                exit;
            }


            //excel upload start
            $excel_odmedia_id = Session::put('ex_odmediaid', $odmedia_id);
            if ($request->xls == '1' || $request->xls2 == '1') {
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
                } elseif ($request->hasfile('media_import')) {
                    try {
                        Excel::import(new SoleRightMediaSheets, request()->file('media_import')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                } elseif ($request->hasfile('media_import2')) {
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
            //excel upload end



            return ["msg" => "Data saved success.! your ", "code" => $odmedia_id];
        } else {
            $vend = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where(["User ID" => $user_id, "OD Category" => 0, "Modification" => 0])->orderBy('OD Media ID', 'desc')->first();
            $odmediaid = @$vend->{'OD Media ID'};
            $vendor_array = array(
                "Authority Which granted Media" => $request->Authority_Which_granted_Media, //$vendordata->{'Authority Which granted Media'},
                "License From" => $request->License_From,    //$vendordata->{'License From'},
                "License To" => $request->License_To,       //$vendordata->{'License To'},
                "Legal Doc File Name" => $Legal_Doc_File_Name ?? '', //upload file
                "Affidavit File Name" => $Affidavit_File_Name ?? '',  //upload file
                "Contract No_" => $request->Contract_No,  //$vendordata->{'Contract No_'},
                "Quantity Of Display" => $request->Quantity_Of_Display ?? '',  //$vendordata->{'Quantity Of Display'},
                "License Fees" => $request->License_Fee //$vendordata->{'License Fees'},
            );

            $vendorUpdate = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where(["OD Media ID" => $odmediaid, "OD Category" => 0, "Modification" => 0])->update($vendor_array);

            $check = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where('Sole Media ID', $odmediaid)->first();
            if ($check) {
                DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID', $odmediaid)->delete();
            }

            if ($request->xls == 0) {
                $table5 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]';
                // if (count($request->MA_City) > 0) {
                if (!empty($request->MA_City[0])) {
                    foreach ($request->MA_City as $key => $value) {
                        $line_no = DB::select("select TOP 1 [Line No_] from $table5 where [Sole Media ID] = '" . $odmediaid . "' order by [Line No_] desc");
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
                            $trainData = isset($request->Train_Data[$key]) ? explode("-", $request->Train_Data[$key]) : '';
                            $Train_No = isset($request->Train_Data[$key]) ? trim($trainData[0]) : 0;
                            $Train_Name = isset($request->Train_Data[$key]) ? trim($trainData[1]) : 0;
                            $No_of_Spot = isset($request->No_of_Spots[$key]) ? $request->No_of_Spots[$key] : 0;
                            $Size_Type = isset($request->Size_Type[$key]) ? $request->Size_Type[$key] : 0;
                            $lit_type = isset($request->lit_type[$key]) ? $request->lit_type[$key] : 0;

                            DB::unprepared('SET ANSI_WARNINGS OFF');


                            $table55 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]';
                            //$check=DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID',$odmediaid)->first();
                            // if($check)
                            // {
                            //     DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID',$odmediaid)->delete();
                            // }

                            $sql5 = DB::insert("insert into $table5([timestamp],[OD Media Type],[Sole Media ID],[Line No_],[City],[State], [District],[Zone],[Latitude],[Longitde],[Landmark],[Image File Name],[OD Media ID],[Display Size],[Illumination Type],[Availability Start Date],[Availability End Date],[Length],[Width],[Total Area],[Rental],[Rental Type],[Quantity],[Train Number],[Train Name],[Size Type],[Duration],[No Of Spot],[Lit Type]) values(DEFAULT,$Applying_For_OD_Media_Type,'" . $odmediaid . "',$line_no,'" . $MA_City . "','" . $MA_State . "','" . $MA_District . "',$MA_Zone,$MA_Latitude,$MA_Longitude,'" . $MA_Property_Landmark . "','" . $Image_File_Name . "','" . $od_media_type . "','" . $ODMFO_Display_Size_Of_Media . "','" . $Illumination_media . "','" . $av_start_date . "','" . $av_end_date . "','" . $length . "','" . $width . "','" . $total_area . "',0,0,'" . $quantity . "','" . $Train_No . "','" . $Train_Name . "',$Size_Type,0,$No_of_Spot,$lit_type)");


                            $lineno1[] = $line_no;
                            $request->session()->put('line1', $lineno1);

                            DB::unprepared('SET ANSI_WARNINGS ON');
                        }
                    }
                    if (!$sql5) {
                        return $this->sendError('Some Error Occurred!.7777');
                        exit;
                    }
                } //if close of sole media address
            }

            $check = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmediaid)->first();
            if ($check) {
                DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmediaid)->delete();
            }
            $table4 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';
            // if (count($request->ODMFO_Year) > 0) {
            $od_media_category = 0;
            if ($request->xls2 == 0) {
                if (!empty($request->ODMFO_Billing_Amount[0])) {
                    $dataFile = array();
                    foreach ($request->ODMFO_Billing_Amount as $key => $value) {
                        $line_no = DB::select("select TOP 1 [Line No_] from $table4 where [OD Media ID] = '" . $odmediaid . "' order by [Line No_] desc");
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
                        // $Document_FileName = isset($dataFile['Upload_Document_FileName'][$key]) ? $dataFile['Upload_Document_FileName'][$key] : '';
                        // $from_date=$request->from_date[$key] ?? '';
                        // $to_date=$request->to_date[$key] ?? '';
                        $from_date = isset($request->from_date[$key]) ? $request->from_date[$key] : '1753-01-01 00:00:00.000';
                        $to_date = isset($request->to_date[$key]) ? $request->to_date[$key] : '1753-01-01 00:00:00.000';
                        DB::unprepared('SET ANSI_WARNINGS OFF');

                        $sql4 = DB::insert("insert into $table4([timestamp],[OD Media Type],[OD Media ID],[Line No_],[Work Name],[Year],[Qty Of Display_Duration],[Billing Amount],[Allocated Vendor Code],[From Date],[To Date]) values(DEFAULT,$od_media_category,'" . $odmediaid . "',$line_no,'" . $workName . "','" . $ODMFO_Year . "',$ODMFO_Quantity_Of_Display_Or_Duration,$ODMFO_Billing_Amount,'','" . $from_date . "','" . $to_date . "')");
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






            //When you choose movieing media than modification value set one start
            $movingmedia = implode(",", $request->Applying_For_OD_Media_Type); //convert into string                       
            $ary = explode(",", $movingmedia); //again convert array
            $total_media = count($ary); //array count

            $str = $movingmedia;
            $length = 0;
            for ($i = 0; $i < strlen($str); $i++) {
                if ($str[$i] == '3') {
                    $length = $length + 1;
                }
            }
            //return $length;
            if ($length == $total_media) {
                $da = array(
                    "Modification" => 1,
                    "Document Date" => date('Y-m-d')
                );
                DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmediaid)->update($da);
                // return ["Msg"=>"Data Update Success","code"=>$odmediaid];
            }
            //When you choose movieing media than modification value set one end(array)

            //excel upload start
            $excel_odmedia_id = Session::put('ex_odmediaid', $odmediaid);
            if ($request->xls == '1' || $request->xls2 == '1') {
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
                } elseif ($request->hasfile('media_import')) {
                    try {
                        Excel::import(new SoleRightMediaSheets, request()->file('media_import')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                } elseif ($request->hasfile('media_import2')) {
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
            //excel upload end
            // $odmediaid1=Session::get('ex_odmediaid');
            return ["Msg" => "Data Update Success", "code" => $odmediaid];
        } //else close


    }



    //renewal feb -2022
    public function sole_right_renewal_form($id = '')
    {
        if ($id != '') {

            $user_id = Session::get('UserID');
            $state_array = (new api)->getStates();
            $states = json_decode(json_encode($state_array), true);
            // dd($states);
            $state_code = "";
            $district_array = (new api)->getDistricts();
            $districts = json_decode(json_encode($district_array), true);

            $getODmediaID = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where(["User ID" => $user_id, "OD Category" => 0, "Allocated Vendor Code" => $id])->first();
            $odmedia_id = @$getODmediaID->{'OD Media ID'};

            $check_data_in_renewal_table = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->where(["User ID" => $user_id, "OD Category" => 0, "OD Media ID" => $odmedia_id])->first();
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
                'Quantity',
                'Train Number',
                'Train Name',
                'Size Type',
                'Duration',
                'No Of Spot',
                'Lit Type'
            );
            if ($check_data_in_renewal_table == '' || $check_data_in_renewal_table == null || $check_data_in_renewal_table == 'null') {
                $vendor = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where(["User ID" => $user_id, "OD Category" => 0, "Modification" => 1, "OD Media ID" => $odmedia_id])->first();
                if ($vendor) {

                    $odmediaid = $vendor->{'OD Media ID'};
                    $soleaddress = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select($select)->where("Sole Media ID", $odmediaid)->get();
                    $works = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->select('Year','Qty Of Display_Duration','Line No_','Billing Amount','From Date','To Date','OD Media ID')->where(["OD Media ID" => $odmediaid, "OD Media Type" => 0])->get();
                    $vendorcheck = 0;                    
                    $OD_work_dones_data = json_decode(json_encode($works), true);
                    $OD_media_address_data = json_decode(json_encode($soleaddress), true);
                    $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->where('Category Group', $OD_media_address_data[0]['OD Media Type'])->get();
                } else {
                    $odmediaid = '';
                    $OD_media_address_data = [];
                    $OD_work_dones_data = [];
                    $getcat = [];
                    $vendorcheck = 1;
                }
                $disabled = '';
                $pointer = '';
                $modification_renew = 0;
                return view('admin.pages.soleright.sole-right-renewal-form', ['states' => $states['original']['data'], 'districts' => $districts['original']['data']], compact('vendor', 'OD_media_address_data', 'OD_work_dones_data', 'getcat', 'vendorcheck', 'disabled', 'pointer', 'modification_renew'));
            } else {
                $vendor = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where(["User ID" => $user_id, "OD Category" => 0, "OD Media ID" => $odmedia_id])->orderBy('Line No_', 'desc')->first();
                if ($vendor) {
                    $odmediaid = $vendor->{'OD Media ID'};
                    $soleaddress = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select($select)->where("Sole Media ID", $odmediaid)->get();
                    $works = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->select('Year','Qty Of Display_Duration','Line No_','Billing Amount','From Date','To Date','OD Media ID')->where(["OD Media ID" => $odmediaid, "OD Media Type" => 0])->get();
                    $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->get();
                    $vendorcheck = 0;
                    $OD_work_dones_data = json_decode(json_encode($works), true);
                    $OD_media_address_data = json_decode(json_encode($soleaddress), true);
                } else {
                    $odmediaid = '';
                    $OD_media_address_data = [];
                    $OD_work_dones_data = [];
                    $getcat = [];
                    $vendorcheck = 1;
                }
                if ($vendor->Modification == '1') {
                    $disabled = 'disabled';
                    $pointer = 'none';
                } else {
                    $disabled = '';
                    $pointer = '';
                }
                $modification_renew = 1;
                return view('admin.pages.soleright.sole-right-renewal-form', ['states' => $states['original']['data'], 'districts' => $districts['original']['data']], compact('vendor', 'OD_media_address_data', 'OD_work_dones_data', 'getcat', 'vendorcheck', 'disabled', 'pointer', 'modification_renew'));
            }
        } else {
            return redirect()->route('solerightlist');
        }
    }



    //renewal form submit feb-2022
    public function sole_right_renewal_form_submit(Request $request)
    {
        $user_id = Session::get('UserID');
        $vendor_code = $request->od_media_id;
        $getODmediaID = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where(["User ID" => $user_id, "OD Category" => 0, "Allocated Vendor Code" => $vendor_code])->first();
        $odmediaid = @$getODmediaID->{'OD Media ID'};

        $destinationPath = public_path() . '/uploads/sole-right-media/';
        $mod = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where(["User ID" => $user_id, "OD Category" => 0, "OD Media ID" => $odmediaid])->first();
        // dd($mod->{'Legal Doc File Name'});
        $Legal_Doc_File_Name = $mod->{'Legal Doc File Name'} ?? '';
        if ($request->hasFile('Legal_Doc_File_Name') || $request->hasFile('Legal_Doc_File_Name_modify')) {
            $file = $request->file('Legal_Doc_File_Name') ?? $request->file('Legal_Doc_File_Name_modify');
            $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
            $file_uploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
            if ($file_uploaded) {
                $Company_Legal_Documents = 1;
            } else {
                $Legal_Doc_File_Name = '';
            }
        }


        $Affidavit_File_Name = $mod->{'Affidavit File Name'} ?? '';
        if ($request->hasFile('Affidavit_File_Name') || $request->hasFile('Affidavit_File_Name_modify')) {
            $file = $request->file('Affidavit_File_Name') ?? $request->file('Affidavit_File_Name_modify');
            $Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
            $file_uploaded = $file->move($destinationPath, $Affidavit_File_Name);
            if ($file_uploaded) {
                $Affidavit_Of_Oath = 1;
            } else {
                $Affidavit_File_Name = '';
            }
        }
        $table4 = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
        // $line_no = DB::select("select TOP 1 [Line No_] from $table4 where [OD Media ID] = '" . $odmediaid . "' order by [Line No_] desc");
        $line_no = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $odmediaid)->orderBy('Line No_', 'desc')->first();
        if (empty($line_no)) {
            $line_no = 10000;
        } else {
            $line_no = $line_no->{"Line No_"};
            $line_no = $line_no + 10000;
        }

        // dd($line_no);
        $receiver_table = '[BOC$Media Plan Setup$3f88596c-e20d-438c-a694-309eb14559b2]';
        $get_receiver_code = DB::select("select TOP 1 [OD Vend Landing UID] from dbo.$receiver_table");
        $recervier_id = $get_receiver_code[0]->{"OD Vend Landing UID"};

        $vendor_renewal = array(
            "OD Media ID" => $odmediaid,
            "Line No_" => $line_no,
            "PM Agency Name" => $getODmediaID->{'PM Agency Name'},
            "OD Category" => 0,
            "HO Address" => '',
            "HO Landline No_" => '',
            "HO Fax No_" => '',
            "HO E-Mail" => '',
            "HO Mobile No_" => '',
            "BO Address" => '',
            "BO Landline No_" => '',
            "BO Fax No_" => '',
            "BO E-Mail" => '',
            "BO Mobile No_" => '',
            "DO Address" => '',
            "DO Landline No_" => '',
            "DO Fax No_" => '',
            "DO E-Mail" => '',
            "DO Mobile No_" => '',
            "Legal Status of Company" => 0,
            "Other Relevant Information" => '',
            "Authority Which granted Media" => $request->Authority_Which_granted_Media,
            "Amount paid to Authority" => 0,
            "License From" => $request->License_From,
            "License To" => $request->License_To,
            "Media Type" => 0,
            "Rental Agreement" => 0,
            "Applying For OD Media Type" => 0,
            "Media Display size" => '',
            "Illumination" => 0,
            "GST No_" => '',
            "TIN_TAN_VAT No_" => '',
            "DD Date" => '1753-01-01 00:00:00.000',
            "DD No_" => '',
            "DD Bank Name" => '',
            "DD Bank Branch Name" => '',
            "Application Amount" => 0,
            "PAN" => '',
            "Bank Name" => '',
            "Bank Branch" => '',
            "IFSC Code" => '',
            "Account No_" => '',
            "Company Legal Documents" => 1,
            "Notarized Copy Of Agreement" => 0,
            "Photographs" => 0,
            "Affidavit Of Oath" => 1,
            "GST Registration" => 0,
            "CA Certified Balance Sheet" => 0,
            "Self-declaration" => 0,
            "Legal Doc File Name" => $Legal_Doc_File_Name ?? '',
            "Notarized Copy File Name" => '',
            "Photo File Name" => '',
            "Affidavit File Name" => $Affidavit_File_Name ?? '',
            "GST File Name" => '',
            "Balance Sheet File Name" => '',
            "Authorized Rep Name" => '',
            "AR Address" => '',
            "AR Landline No_" => '',
            "AR FAX No_" => '',
            "AR Mobile No_" => '',
            "AR E-mail" => '',
            "Contract No_" => $request->Contract_No,
            "Quantity Of Display" => $request->Quantity_Of_Display ?? '',
            "License Fees" => $request->License_Fee,
            "PAN Attached" => 0,
            "PAN File Name" => '',
            "User ID" => $user_id,
            "Status" => 0,
            "Global Dimension 1 Code" => '',
            "Global Dimension 2 Code" => '',
            "Sender ID" => '',
            "Receiver ID" => $recervier_id,
            "Recommended To Committee" => 0,
            "Modification" => 1,
            "Media Sub Category" => '',
            "Rate" => 0,
            "Rate Status" => 0,
            "Rate Remark" => '',
            "Rate Status Date" => '1753-01-01 00:00:00.000',
            "Agr File Path" => '',
            "Agr File Name" => '',
            "Allocated Vendor Code" => '',
            "Document Date" => '1753-01-01 00:00:00.000',
            "Agreement Start Date" => '1753-01-01 00:00:00.000',
            "Agreement End Date" => '1753-01-01 00:00:00.000',
            "Empanelment Category" => 0,
            "Duration" => '1753-01-01 00:00:00.000'
        );

        $renewalsave = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->insert($vendor_renewal);

        $check = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where('Sole Media ID', $odmediaid)->first();
        if ($check) {
            DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID', $odmediaid)->delete();
        }

        $table5 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]';
        if (count($request->MA_City) > 0) {
            foreach ($request->MA_City as $key => $value) {
                $line_no = DB::select("select TOP 1 [Line No_] from $table5 where [Sole Media ID] = '" . $odmediaid . "' order by [Line No_] desc");
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
                    $trainData = isset($request->Train_Data[$key]) ? explode("-", $request->Train_Data[$key]) : '';
                    $Train_No = isset($request->Train_Data[$key]) ? trim($trainData[0]) : 0;
                    $Train_Name = isset($request->Train_Data[$key]) ? trim($trainData[1]) : 0;
                    $No_of_Spot = isset($request->No_of_Spots[$key]) ? $request->No_of_Spots[$key] : 0;
                    $Size_Type = isset($request->Size_Type[$key]) ? $request->Size_Type[$key] : 0;
                    $lit_type = isset($request->lit_type[$key]) ? $request->lit_type[$key] : 0;

                    DB::unprepared('SET ANSI_WARNINGS OFF');


                    $table55 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]';
                    //$check=DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID',$odmediaid)->first();
                    // if($check)
                    // {
                    //     DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID',$odmediaid)->delete();
                    // }
                    $sql5 = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                        "OD Media Type" => $Applying_For_OD_Media_Type,
                        "Sole Media ID" => $odmediaid,
                        "Line No_" => $line_no,
                        "City" => $MA_City,
                        "State" => $MA_State,
                        "District" => $MA_District,
                        "Zone" => $MA_Zone,
                        "Latitude" => $MA_Latitude,
                        "Longitde" => $MA_Longitude,
                        "Landmark" => $MA_Property_Landmark,
                        "Image File Name" => $Image_File_Name,
                        "OD Media ID" => $od_media_type,
                        "Display Size" => $ODMFO_Display_Size_Of_Media,
                        "Illumination Type" => $Illumination_media,
                        "Availability Start Date" => $av_start_date,
                        "Availability End Date" => $av_end_date,
                        "Length" => $length,
                        "Width" => $width,
                        "Total Area" => $total_area,
                        "Rental" => 0,
                        "Rental Type" => 0,
                        "Quantity" => $quantity,
                        "Train Number" => $Train_No,
                        "Train Name" => $Train_Name,
                        "Size Type" => $Size_Type,
                        "Duration" => 0,
                        "No Of Spot" => $No_of_Spot,
                        "Lit Type" => $lit_type
                    ]);

                    $lineno1[] = $line_no;
                    $request->session()->put('line1', $lineno1);

                    DB::unprepared('SET ANSI_WARNINGS ON');
                }
            }
            if (!$sql5) {
                return $this->sendError('Some Error Occurred!.7777');
                exit;
            }
        } //if close of sole media address


        //work done start
        $table4 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';
        DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmediaid)->delete();
        // if (count($request->ODMFO_Year) > 0) {
        $od_media_category = 0;
        if (!empty($request->ODMFO_Quantity_Of_Display_Or_Duration[0])) {
            $dataFile = array();
            foreach ($request->ODMFO_Billing_Amount as $key => $value) {
                $line_no = DB::select("select TOP 1 [Line No_] from $table4 where [OD Media ID] = '" . $odmediaid . "' order by [Line No_] desc");
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
                // $Document_FileName = isset($dataFile['Upload_Document_FileName'][$key]) ? $dataFile['Upload_Document_FileName'][$key] : '';
                // $from_date=$request->from_date[$key] ?? '';
                // $to_date=$request->to_date[$key] ?? '';
                $from_date = isset($request->from_date[$key]) ? $request->from_date[$key] : '1753-01-01 00:00:00.000';
                $to_date = isset($request->to_date[$key]) ? $request->to_date[$key] : '1753-01-01 00:00:00.000';
                $allocated_vendor_code = isset($request->allocated_vendor_code[$key]) ? $request->allocated_vendor_code[$key] : '';
                DB::unprepared('SET ANSI_WARNINGS OFF');

                $sql4 = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                    "OD Media Type" => $od_media_category,
                    "OD Media ID" => $odmediaid,
                    "Line No_" => $line_no,
                    "Work Name" => $workName,
                    "Year" => $ODMFO_Year,
                    "Qty Of Display_Duration" => $ODMFO_Quantity_Of_Display_Or_Duration,
                    "Billing Amount" => $ODMFO_Billing_Amount,
                    "Allocated Vendor Code" => $allocated_vendor_code,
                    "From Date" => $from_date,
                    "To Date" => $to_date
                ]);


                $lineno2[] = $line_no;
                $request->session()->put('line2', $lineno2);
                DB::unprepared('SET ANSI_WARNINGS ON');
            }
            if (!$sql4) {
                return $this->sendError('Some Error Occurred!.6666');
                exit;
            }
        }

        //excel upload start
        $excel_odmedia_id = Session::put('ex_odmediaid', $odmediaid);
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
        } elseif ($request->hasfile('media_import')) {
            try {
                Excel::import(new SoleRightMediaSheets, request()->file('media_import')); //for import
                // return $this->sendResponse('', 'Data Import successfully first');
            } catch (ValidationException $ex) {

                $failures = $ex->failures();
                foreach ($failures as $failure) {
                    return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                }
            }
        } elseif ($request->hasfile('media_import2')) {
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
        //excel upload end
        return ["msg" => "Data Saved in renewal table", "media_id" => $odmediaid];
    }
    public function accountDetails()
    {
        $userid = Session::get('UserID');

        $vdata=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID',$userid)->orderBy('OD Media ID','asc')->first();
        $agency=DB::table('BOC$OD Agency$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID',$userid)->first();
        
        $odid = @$vdata->{'OD Media ID'}; //od media id
        $username='asd';
        if((empty($agency)) && ($odid=='null' || $odid==null))
        {
            $username='';
            Session::flash('not_exist',"Please Complete Your Enpanelement");
        }


        $table = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
        $data = DB::table($table)->where(['User ID' => $userid])->first();
        return view('admin.pages.soleright.account_details', compact('data','username'));
    }

    public function updateAccountDetail(Request $request)
    {
        $request->validate(
            [
                'PAN' => 'required',
                'IFSC_Code' => 'required',
                'Bank_Name' => 'required',
                'Bank_Branch' => 'required',
                'Account_No' => 'required'
            ]
        );


        $destinationPath = public_path() . '/uploads/sole-right-media/';
        $userid = Session::get('UserID');
        $mtable = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
        $mod = DB::table($mtable)->where('User ID', $userid)->first();


        $cancelled_cheque_file_name = $mod->{'Cancelled Cheque File Name'} ?? '';
        if ($request->hasFile('cancelled_cheque_file_name') || $request->hasFile('cancelled_cheque_file_name_modify')) {
            $file = $request->file('cancelled_cheque_file_name') ?? $request->file('cancelled_cheque_file_name_modify');
            $cancelled_cheque_file_name = time() . '-' . $file->getClientOriginalName();
            $file_uploaded = $file->move($destinationPath, $cancelled_cheque_file_name);
            if ($file_uploaded) {
                $Attach_Copy_Of_Pan_Number = 1;
            } else {
                $cancelled_cheque_file_name = '';
            }
        }




        $table = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
        
        $find_vender=DB::table($table)->where("User ID",$userid)->first();
        if(empty($find_vender))
        {
            $vendordata=[
                "OD Category" =>0,
                "OD Media ID" =>$odmedia_id,
                "HO Address" =>'',
                "HO Landline No_" =>'',
                "HO Fax No_" =>'',
                "HO E-Mail" =>'',
                "HO Mobile No_" =>'',
                "DO Address" =>'',
                "DO Landline No_" =>'',
                "DO Fax No_" =>'',
                "DO E-Mail" =>'',
                "DO Mobile No_" =>'',
                "Legal Status of Company" =>0,
                "Authority Which granted Media" =>'',
                "Amount paid to Authority" =>0,
                "Contract No_" =>0,
                "License Fees" =>0,
                "Quantity Of Display" =>0,
                "License From" =>'1753-01-01 00:00:00.000',
                "License To" =>'1753-01-01 00:00:00.000',
                "Duration" =>0,
                "Rental Agreement" =>0,
                "Applying For OD Media Type" =>0,
                "Media Display size" =>'',
                "Illumination" =>0,
                "GST No_" => '',
                "TIN_TAN_VAT No_" =>'',
                "Other Relevant Information" =>'',
                "DD No_" =>'',
                "DD Date" =>'1753-01-01 00:00:00.000',
                "DD Bank Name" =>'',
                "DD Bank Branch Name" =>'',
                "Application Amount" =>0,
                "PM Agency Name" => '',
                "PAN" =>$request->PAN ?? '',
                "Bank Name" =>$request->Bank_Name ?? '',
                "Bank Branch" =>$request->Bank_Branch ?? '',
                "IFSC Code" =>$request->IFSC_Code ?? '',
                "Account No_" =>$request->Account_No ?? '',
                "Notarized Copy File Name" =>'',
                "PAN File Name" =>'',
                "Affidavit File Name" =>'',
                "Photo File Name" =>'',
                "Legal Doc File Name" =>'',
                "GST File Name" =>'',
                "Balance Sheet File Name" =>'',
                "Notarized Copy Of Agreement" =>0,
                "PAN Attached" =>1,
                "Affidavit Of Oath" =>0,
                "Photographs" =>0,
                "Company Legal Documents" =>0,
                "GST Registration" =>0,
                "CA Certified Balance Sheet" =>0,
                "Self-declaration" =>0,
                "User Id" =>$userid,
                "Status" =>0,
                "Global Dimension 1 Code" =>'M003',
                "Global Dimension 2 Code" =>'',
                "Sender ID" =>'',
                "Receiver ID" =>'APCO',
                "Recommended To Committee" =>0,
                "Modification" =>0,
                "Media Sub Category" =>'',
                "Rate" =>0,
                "Rate Status" =>0,
                "Rate Remark" =>'',
                "Rate Status Date" =>'',
                "Agr File Path" =>'',
                "Agr File Name" =>'',
                "Allocated Vendor Code" =>'',
                "Document Date" =>'1753-01-01 00:00:00.000',
                "Empanelment Category" =>0,
                "From Date" =>'1753-01-01 00:00:00.000',
                "To Date" =>'1753-01-01 00:00:00.000',
                "File Name" =>'',
                "File Uploaded" =>0,
                "Application Type" =>0,
                "Cancelled Cheque File Name"=>$cancelled_cheque_file_name
            ];

            $sql_update=DB::table($table)->insert($vendordata);
        }
        else{
            $update = array(
                'PAN' => $request->PAN,
                'Bank Name' => $request->Bank_Name,
                'Bank Branch' => $request->Bank_Branch,
                'IFSC Code' => $request->IFSC_Code,
                'Account No_' => $request->Account_No,
                'Cancelled Cheque File Name'=>$cancelled_cheque_file_name
            );
            $sql_update = DB::table($table)
                ->where(['User ID' => $userid])
                ->update($update);
        }
        
        $update2 = array(
            'PAN' => $request->PAN,
            'Bank Name' => $request->Bank_Name,
            'Bank Branch' => $request->Bank_Branch,
            'IFSC Code' => $request->IFSC_Code,
            'Account No_' => $request->Account_No,
            'Cancelled Cheque File Name'=>$cancelled_cheque_file_name
        );
        $agency=DB::table('BOC$OD Agency$3f88596c-e20d-438c-a694-309eb14559b2')->where("User ID",$userid)->update($update2);

        if ($sql_update) {
            return back()->with(['status' => true, 'message' => 'Data Updated Successfully!']);
        } else {
            return back()->with(['status' => false, 'message' => 'Some Error Occurred!']);
        }
    }

    public function outdoorsoleRightPdf()
    {
        $userid = Session::get('UserID');
        
        $solepdfdata = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2 as odv')
        ->Join('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2 as sma', 'sma.Sole Media ID', '=', 'odv.OD Media ID')
        ->join('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2 as smc', 'smc.OD Media UID', '=', 'sma.OD Media ID')
        ->select('odv.OD Media ID as mediaID','odv.HO E-Mail as ho_email','odv.HO Mobile No_ as mobile',
            DB::raw("string_agg(smc.Name,',') as subcat_name"))
        ->groupBy('odv.OD Media ID','odv.HO E-Mail','odv.HO Mobile No_')
        ->orderBy('odv.OD Media ID','desc')
        ->where(['odv.User ID' => $userid, "odv.Modification" => 1, 'odv.OD Category' => 0])
        ->get();
         $pdf = \PDF::loadView('admin.pages.soleright.sole-right-pdf', compact('solepdfdata'));
        return $pdf->download($userid . '.pdf');
    }


    public function autocompletetrain(Request $request)
    {
        $res = DB::table('BOC$Trains$3f88596c-e20d-438c-a694-309eb14559b2')->select('Train No_ as train_no', 'Name as name')
            ->where("Train No_", "LIKE", "%{$request->term}%")
            ->orWhere("Name", "LIKE", "%{$request->term}%")
            ->get();
        return response()->json($res);
    }

    //for sole basic
    public function sole_basic_data(Request $request)
    {
        $url = last(request()->segments());
        $city_array = $this->getcities();
        $ownerCities = json_decode(json_encode($city_array), true);

        $district_array = $this->getDistricts();
        $ownerDistricts = json_decode(json_encode($district_array), true);

        $state_array = $this->getStates();
        $states = json_decode(json_encode($state_array), true);

        if ($url == 'sole-basic-detail1') {
            
            $userid = Session::get('UserID');

            $table = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';

            $datas = DB::table($table)->where('User ID', $userid)->first();

            if (!empty($datas)) {
                $owner_id = $datas->{'Owner ID'};
                Session::put('owner_id_detail', $datas->{'Owner ID'});
            } else {
                Session::put('owner_id_detail', "");
                $owner_id = "";
            }

            //9 feb for find od media id through owner id

            $where = array("Owner ID" => $owner_id, "OD Media Type" => 0);
            $odmedia = DB::table('BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->where("Owner ID", "!=", '')->orderBy('OD Media ID', 'desc')->first();
            @$mediaid = $odmedia->{'OD Media ID'};

            $where2 = array("OD Media ID" => $mediaid, "OD Media Type" => 0);
            $authorize = DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->get();
            $branch = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->get();

            // Lat Long code start

            $latlongData = DB::table('BOC$OD Latlong Detail$3f88596c-e20d-438c-a694-309eb14559b2')->select("Latitude", "Longitude", "Image File Name", "Remarks", "Far Image File Name", "City", "Near Picture", "Far Picture", "Tag Name")->where('OD Vendor ID', $mediaid)->get();

            $data = (new solerightMedapi)->showDetails($userid);

            $response = json_decode(json_encode($data), true);

            //for all category display sk
            $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->get();

            $owner_data = isset($response['original']['data']['OD_owners']) ? $response['original']['data']['OD_owners'] : [];

            $vendor_data = isset($response['original']['data']['OD_vendors']) ? $response['original']['data']['OD_vendors'] : [];

            $media_owner_details = isset($response['original']['data']['media_owner_details']) ? $response['original']['data']['media_owner_details'] : [];

            $OD_work_dones_data = isset($response['original']['data']['OD_work_dones']) ? $response['original']['data']['OD_work_dones'] : [];
            $OD_media_address_data = isset($response['original']['data']['OD_media_address']) ? $response['original']['data']['OD_media_address'] : [];

            $state_code = @$owner_data[0]['State'] ?? "";

            $city_array = $this->getcities($state_code);
            $ownerCities = json_decode(json_encode($city_array), true);

            $district_array = $this->getDistricts($state_code);
            $ownerDistricts = json_decode(json_encode($district_array), true);
            
            if (@$vendor_data[0]->{'Modification'} == 0) {
                //for all category display sk
                $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->where('Category Group', @$OD_media_address_data[0]['OD Media Type'])->get();
                return view('admin.pages.soleright.sole-basic-detail', ['latlongData' => $latlongData, 'states' => $states['original']['data'], 'ownerDistricts' => $ownerDistricts['original']['data'], 'ownerCities' => $ownerCities['original']['data']])->with(compact('owner_data', 'vendor_data', 'media_owner_details', 'OD_work_dones_data', 'OD_media_address_data', 'getcat', 'authorize', 'branch'));
            } else {
                $branch = array();
                $authorize = array();
                $latlongData = array();
                return view('admin.pages.soleright.sole-basic-detail', ['states' => $states['original']['data'], 'ownerDistricts' => $ownerDistricts['original']['data'], 'ownerCities' => $ownerCities['original']['data']])->with(compact('getcat', 'authorize', 'branch'));
            }
        } else {
            $userid = Session::get('UserID');
            $vdata=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID',$userid)->orderBy('OD Media ID','asc')->first();
            $agency=DB::table('BOC$OD Agency$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID',$userid)->first();
            
            $odid = @$vdata->{'OD Media ID'}; //od media id
            $username='asd';
            if((empty($agency)) && ($odid=='null' || $odid==null))
            {
                $username='';
                Session::flash('not_exist',"Please Complete Your Enpanelement");
            }
            //find owner id from OD Media Owner Detail table
            $where_detail = array("OD Media ID" => $odid, "OD Media Type" => 0);
            $find_owner_detail = DB::table('BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2')->select('Owner ID')->where($where_detail)->first();
            $ownID = @$find_owner_detail->{'Owner ID'}; //get Owner ID
            $table = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
            $datas = DB::table($table)->where('Owner ID', $ownID)->first();
            if (!empty($datas)) {
                $owner_id = $datas->{'Owner ID'};
                Session::put('owner_id_detail', $datas->{'Owner ID'});
            } else {
                Session::put('owner_id_detail', "");
                $owner_id = '';
            }

            //9 feb for find od media id through owner id
            $where = array("Owner ID" => $owner_id, "OD Media Type" => 0);
            $odmedia = DB::table('BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->orderBy('OD Media ID', 'desc')->first();

            @$mediaid = $odid;
            $where2 = array("OD Media ID" => $mediaid, "OD Media Type" => 0);
            $authorize = DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->get();
            $branch = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->get();

            // Lat Long code start
            $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->get();
            $latlongData = DB::table('BOC$OD Latlong Detail$3f88596c-e20d-438c-a694-309eb14559b2')->select("Latitude", "Longitude", "Image File Name", "Remarks", "Far Image File Name", "City", "Near Picture", "Far Picture", "Tag Name")->where('OD Vendor ID', $mediaid)->get();

            // Lat Long code End

            $data = (new solerightMedapi)->showlistdata($odid);

            $response = json_decode(json_encode($data), true);

            $owner_data = isset($response['original']['data']['OD_owners']) ? $response['original']['data']['OD_owners'] : [];

            $vendor_data = isset($response['original']['data']['OD_vendors']) ? $response['original']['data']['OD_vendors'] : [];

            $media_owner_details = isset($response['original']['data']['media_owner_details']) ? $response['original']['data']['media_owner_details'] : [];

            $OD_work_dones_data = isset($response['original']['data']['OD_work_dones']) ? $response['original']['data']['OD_work_dones'] : [];
            $OD_media_address_data = isset($response['original']['data']['OD_media_address']) ? $response['original']['data']['OD_media_address'] : [];
            //for all category display sk
            
            $state_code = @$owner_data[0]['State'] ?? "";

            $city_array = $this->getcities($state_code);
            $ownerCities = json_decode(json_encode($city_array), true);
            
            $district_array = $this->getDistricts($state_code);
            $ownerDistricts = json_decode(json_encode($district_array), true);

            return view('admin.pages.soleright.sole-basic-detail', ['latlongData' => $latlongData, 'states' => $states['original']['data'], 'ownerDistricts' => $ownerDistricts['original']['data'], 'ownerCities' => $ownerCities['original']['data']])->with(compact('owner_data', 'vendor_data', 'media_owner_details', 'OD_work_dones_data', 'OD_media_address_data', 'getcat', 'authorize', 'branch','username'));
        }
        
        
        
    }


    //basic detail update
    public function sole_basic_detail_update(Request $request)
    {
        return DB::transaction(function () use ($request) {
            // $validator=Validator::make($request->all(),[
            //     "owner_name"=>'required',
            //     "owner_email"=>'required',
            //     "address"=>'required',
            //     "state"=>'required',
            //     "district"=>'required',
            //     "city"=>'required',
            //     "GST_No"=>'required',
            //     "PM_Agency_Name"=>'required',
            //     "HO_Address"=>'required',
            //     "HO_Landline_No"=>'required',
            //     "HO_Email"=>'required',
            //     "HO_Mobile_No"=>'required'
            // ]);
            // if($validator->fails())
            // {
            //     return $this->sendError($validator->errors(),'Validation Error');
            // }
        
            $userid = Session::get('UserID');
            $checowner=DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->where("User ID",$userid)->first();
            $checvendor=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where("User ID",$userid)->first();
            if(empty($checowner) && empty($checvendor))
            {
                //insert
                $table1 = '[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2]';
                $owner_id = DB::select("select TOP 1 [Owner ID] from $table1 order by [Owner ID] desc");
                if (empty($owner_id)) {
                    $owner_id = 'EMPOW1';
                } else {
                    $owner_id = $owner_id[0]->{"Owner ID"};
                    $owner_id++;
                }
                $owner_name=$request->owner_name ?? '';
                $mobile=$request->owner_mobile ?? '';
                $email=$request->owner_email ?? '';
                $phone=$request->phone ?? '';
                $address=$request->address ?? '';
                $city=$request->city ?? '';
                $district=$request->district ?? '';
                $state=$request->state ?? '';


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
                    '',
                    '" . $address . "',
                    ' ',
                    '" . $city . "',
                    '" . $district . "',
                    '" . $state . "',
                    0,'','','','','','','','','','','" . $userid . "',
                    '','','','','','','','','','','','','','','','','',
                    '','','','','','','','','','',0
                    )"
                );


                //vendor insert
                $odmedia_id=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID')->where('OD Media ID','LIKE','%'.'OPF'.'%')->orderBy('OD Media ID','desc')->first();
                

                if (empty($odmedia_id)) {
                    // $odmedia_id = 'POD00001';
                    $odmedia_id = 'OPF000001';
                } else {
                    $odmedia_id = $odmedia_id->{"OD Media ID"};
                    $odmedia_id++;
                }


                $destinationPath = public_path() . '/uploads/sole-right-media/';
                // $owner=DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->where('Email ID',$request->owner_email)->update($ownerdata);

                $mtable = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
                $mod = DB::table($mtable)->where('User ID', $userid)->first();

                $Legal_Doc_File_Name = $mod->{'Legal Doc File Name'} ?? '';
                if ($request->hasFile('Legal_Doc_File_Name') || $request->hasFile('Legal_Doc_File_Name_modify')) {
                    $file = $request->file('Legal_Doc_File_Name') ?? $request->file('Legal_Doc_File_Name_modify');
                    $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
                    $file_uploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
                    if ($file_uploaded) {
                        $Company_Legal_Documents = 1;
                    } else {
                        $Legal_Doc_File_Name = '';
                    }
                }


                $Attach_Copy_Of_Pan_Number_File_Name = $mod->{'PAN File Name'} ?? '';
                if ($request->hasFile('Attach_Copy_Of_Pan_Number_File_Name') || $request->hasFile('Attach_Copy_Of_Pan_Number_File_Name_modify')) {
                    $file = $request->file('Attach_Copy_Of_Pan_Number_File_Name') ?? $request->file('Attach_Copy_Of_Pan_Number_File_Name_modify');
                    $Attach_Copy_Of_Pan_Number_File_Name = time() . '-' . $file->getClientOriginalName();
                    $file_uploaded = $file->move($destinationPath, $Attach_Copy_Of_Pan_Number_File_Name);
                    if ($file_uploaded) {
                        $Attach_Copy_Of_Pan_Number = 1;
                    } else {
                        $Attach_Copy_Of_Pan_Number_File_Name = '';
                    }
                }




                $GST_File_Name = $mod->{'GST File Name'} ?? '';
                if ($request->hasFile('GST_File_Name') || $request->hasFile('GST_File_Name_modify')) {
                    $file = $request->file('GST_File_Name') ?? $request->file('GST_File_Name_modify');
                    $GST_File_Name = time() . '-' . $file->getClientOriginalName();
                    $file_uploaded = $file->move($destinationPath, $GST_File_Name);
                    if ($file_uploaded) {
                        $GST_Registration = 1;
                    } else {
                        $GST_File_Name = '';
                    }
                }


                $vendordata=[
                    "OD Category" =>0,
                    "OD Media ID" =>$odmedia_id,
                    "HO Address" =>$request->HO_Address ?? '',
                    "HO Landline No_" =>$request->HO_Landline_No ?? '',
                    "HO Fax No_" =>'',
                    "HO E-Mail" =>$request->HO_Email ?? '',
                    "HO Mobile No_" =>$request->HO_Mobile_No ?? '',
                    "DO Address" =>'',
                    "DO Landline No_" =>'',
                    "DO Fax No_" =>'',
                    "DO E-Mail" =>'',
                    "DO Mobile No_" =>'',
                    "Legal Status of Company" =>0,
                    "Authority Which granted Media" =>'',
                    "Amount paid to Authority" =>0,
                    "Contract No_" =>0,
                    "License Fees" =>0,
                    "Quantity Of Display" =>0,
                    "License From" =>'1753-01-01 00:00:00.000',
                    "License To" =>'1753-01-01 00:00:00.000',
                    "Duration" =>0,
                    "Rental Agreement" =>0,
                    "Applying For OD Media Type" =>0,
                    "Media Display size" =>'',
                    "Illumination" =>0,
                    "GST No_" => $request->GST_No ?? '',
                    "TIN_TAN_VAT No_" =>$request->TIN_TAN_VAT_No ?? '',
                    "Other Relevant Information" =>$request->Other_Relevant_Information ?? '',
                    "DD No_" =>'',
                    "DD Date" =>'1753-01-01 00:00:00.000',
                    "DD Bank Name" =>'',
                    "DD Bank Branch Name" =>'',
                    "Application Amount" =>0,
                    "PM Agency Name" =>$request->PM_Agency_Name ?? '',
                    "PAN" =>'',
                    "Bank Name" =>'',
                    "Bank Branch" =>'',
                    "IFSC Code" =>'',
                    "Account No_" =>'',
                    "Notarized Copy File Name" =>'',
                    "PAN File Name" =>$Attach_Copy_Of_Pan_Number_File_Name,
                    "Affidavit File Name" =>'',
                    "Photo File Name" =>'',
                    "Legal Doc File Name" =>$Legal_Doc_File_Name,
                    "GST File Name" =>$GST_File_Name,
                    "Balance Sheet File Name" =>'',
                    "Notarized Copy Of Agreement" =>0,
                    "PAN Attached" =>1,
                    "Affidavit Of Oath" =>0,
                    "Photographs" =>0,
                    "Company Legal Documents" =>0,
                    "GST Registration" =>0,
                    "CA Certified Balance Sheet" =>0,
                    "Self-declaration" =>0,
                    "User Id" =>$userid,
                    "Status" =>0,
                    "Global Dimension 1 Code" =>'M003',
                    "Global Dimension 2 Code" =>'',
                    "Sender ID" =>'',
                    "Receiver ID" =>'APCO',
                    "Recommended To Committee" =>0,
                    "Modification" =>0,
                    "Media Sub Category" =>'',
                    "Rate" =>0,
                    "Rate Status" =>0,
                    "Rate Remark" =>'',
                    "Rate Status Date" =>'',
                    "Agr File Path" =>'',
                    "Agr File Name" =>'',
                    "Allocated Vendor Code" =>'',
                    "Document Date" =>'1753-01-01 00:00:00.000',
                    "Empanelment Category" =>0,
                    "From Date" =>'1753-01-01 00:00:00.000',
                    "To Date" =>'1753-01-01 00:00:00.000',
                    "File Name" =>'',
                    "File Uploaded" =>0,
                    "Application Type" =>0,
                    "Cancelled Cheque File Name"=>''
                ];

                $vendorsave=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->insert($vendordata);

                $selecteagency=DB::table('BOC$OD Agency$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID',$userid)->first();
                
                if((!empty($selecteagency)) || $selecteagency!='null' || $selecteagency!=null)
                {
                    $vendordata2=array(
                        "GST No_"=>$request->GST_No ?? '',
                        // "PM Agency Name"=>$request->PM_Agency_Name ?? '',
                        "TIN_TAN_VAT No_"=>$request->TIN_TAN_VAT_No ?? '',
                        "Other Relevant Information"=>$request->Other_Relevant_Information ?? '',
                        "HO Address"=>$request->HO_Address ?? '',
                        "HO Landline No_"=>$request->HO_Landline_No ?? '',
                        "HO E-Mail"=>$request->HO_Email ?? '',
                        "HO Mobile No_"=>$request->HO_Mobile_No ?? ''
                        // "Legal Doc File Name"=>$Legal_Doc_File_Name,
                        // "PAN File Name"=>$Attach_Copy_Of_Pan_Number_File_Name,
                        // "GST File Name"=>$GST_File_Name
                    );
                    $updateagency=DB::table('BOC$OD Agency$3f88596c-e20d-438c-a694-309eb14559b2')->where("User ID",$userid)->update($vendordata2);
                }

                //branch office start
                if($request->BO_Address!='')
                {
                    $where=array('User ID' => $userid,"OD Media Type" =>0);
                    DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->delete();
                    foreach($request->BO_Address as $key => $branch_address)
                    {
                        $line_no = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('User ID', $userid)->orderBy('Line No_', 'desc')->first();
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
                //branch office end

                ///////////////////////for auth//////////
                $where=array('User ID' => $userid,"OD Media Type" =>0);
                DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->delete();
                foreach($request->Authorized_Rep_Name as $key => $rep_name)
                {
                    $line_no = DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('User ID', $userid)->orderBy('Line No_', 'desc')->first();
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

                $detail=DB::table('BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                    "OD Media Type"=>0,
                    "OD Media ID" =>$odmedia_id,
                    "Owner ID"=>$owner_id,
                    "Allocated Vendor Code"=>''
                ]);

                


                if($vendorsave)
                {
                    Session::flash('success',"Details have been saved successfully. Please note reference number for future use ".$odmedia_id);
                    return redirect()->route('sole-basic-detail');
                }

            }
            else{  //update part

                $odmediaid=$request->odmediaid;
                $ownerdata=array(
                    "Owner Name"=>$request->owner_name,
                    "Email ID"=>$request->owner_email,
                    "Mobile No_"=>$request->owner_mobile,
                    "Address 1"=>$request->address,
                    "State"=>$request->state,
                    "District"=>$request->district,
                    "City"=>$request->city,
                    "Phone No_"=>$request->phone ?? ''
                );
                $destinationPath = public_path() . '/uploads/sole-right-media/';
                $owner=DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->where('Email ID',$request->owner_email)->update($ownerdata);

                $mtable = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
                $mod = DB::table($mtable)->where('User ID', $userid)->first();

                $Legal_Doc_File_Name = $mod->{'Legal Doc File Name'} ?? '';
                if ($request->hasFile('Legal_Doc_File_Name') || $request->hasFile('Legal_Doc_File_Name_modify')) {
                    $file = $request->file('Legal_Doc_File_Name') ?? $request->file('Legal_Doc_File_Name_modify');
                    $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
                    $file_uploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
                    if ($file_uploaded) {
                        $Company_Legal_Documents = 1;
                    } else {
                        $Legal_Doc_File_Name = '';
                    }
                }


                $Attach_Copy_Of_Pan_Number_File_Name = $mod->{'PAN File Name'} ?? '';
                if ($request->hasFile('Attach_Copy_Of_Pan_Number_File_Name') || $request->hasFile('Attach_Copy_Of_Pan_Number_File_Name_modify')) {
                    $file = $request->file('Attach_Copy_Of_Pan_Number_File_Name') ?? $request->file('Attach_Copy_Of_Pan_Number_File_Name_modify');
                    $Attach_Copy_Of_Pan_Number_File_Name = time() . '-' . $file->getClientOriginalName();
                    $file_uploaded = $file->move($destinationPath, $Attach_Copy_Of_Pan_Number_File_Name);
                    if ($file_uploaded) {
                        $Attach_Copy_Of_Pan_Number = 1;
                    } else {
                        $Attach_Copy_Of_Pan_Number_File_Name = '';
                    }
                }




                $GST_File_Name = $mod->{'GST File Name'} ?? '';
                if ($request->hasFile('GST_File_Name') || $request->hasFile('GST_File_Name_modify')) {
                    $file = $request->file('GST_File_Name') ?? $request->file('GST_File_Name_modify');
                    $GST_File_Name = time() . '-' . $file->getClientOriginalName();
                    $file_uploaded = $file->move($destinationPath, $GST_File_Name);
                    if ($file_uploaded) {
                        $GST_Registration = 1;
                    } else {
                        $GST_File_Name = '';
                    }
                }



                $vendordata=array(
                    "GST No_"=>$request->GST_No ?? '',
                    "PM Agency Name"=>$request->PM_Agency_Name ?? '',
                    "TIN_TAN_VAT No_"=>$request->TIN_TAN_VAT_No ?? '',
                    "Other Relevant Information"=>$request->Other_Relevant_Information ?? '',
                    "HO Address"=>$request->HO_Address ?? '',
                    "HO Landline No_"=>$request->HO_Landline_No ?? '',
                    "HO E-Mail"=>$request->HO_Email ?? '',
                    "HO Mobile No_"=>$request->HO_Mobile_No ?? '',
                    "Legal Doc File Name"=>$Legal_Doc_File_Name,
                    "PAN File Name"=>$Attach_Copy_Of_Pan_Number_File_Name,
                    "GST File Name"=>$GST_File_Name,
                );
                $vendor=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID',$userid)->update($vendordata);


                if($request->BO_Address!='')
                {
                    $where=array('User ID' => $userid,"OD Media Type" =>0);
                    DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->delete();
                    foreach($request->BO_Address as $key => $branch_address)
                    {
                        $line_no = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('User ID', $userid)->orderBy('Line No_', 'desc')->first();
                        if (empty($line_no)) {
                            $line_no = 10000;
                        } else {
                            $line_no = $line_no->{"Line No_"};
                            $line_no = $line_no + 10000;
                        }
                        $branch_data=array(
                            "OD Media Type" =>0,
                            "OD Media ID" =>$odmediaid,
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
                ///////////////////////for auth//////////
                $where=array('User ID' => $userid,"OD Media Type" =>0);
                DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->delete();
                foreach($request->Authorized_Rep_Name as $key => $rep_name)
                {
                    $line_no = DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('User ID', $userid)->orderBy('Line No_', 'desc')->first();
                    if (empty($line_no)) {
                        $line_no = 10000;
                    } else {
                        $line_no = $line_no->{"Line No_"};
                        $line_no = $line_no + 10000;
                    }

                    $authorized_data=array(
                        "OD Media Type" =>0,
                        "OD Media ID" =>$odmediaid,
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

                $selecteagency=DB::table('BOC$OD Agency$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID',$userid)->first();
                if((!empty($selecteagency)) || $selecteagency!='null' || $selecteagency!=null)
                {
                    $vendordata2=array(
                        "GST No_"=>$request->GST_No ?? '',
                        // "PM Agency Name"=>$request->PM_Agency_Name ?? '',
                        "TIN_TAN_VAT No_"=>$request->TIN_TAN_VAT_No ?? '',
                        "Other Relevant Information"=>$request->Other_Relevant_Information ?? '',
                        "HO Address"=>$request->HO_Address ?? '',
                        "HO Landline No_"=>$request->HO_Landline_No ?? '',
                        "HO E-Mail"=>$request->HO_Email ?? '',
                        "HO Mobile No_"=>$request->HO_Mobile_No ?? ''
                        // "Legal Doc File Name"=>$Legal_Doc_File_Name,
                        // "PAN File Name"=>$Attach_Copy_Of_Pan_Number_File_Name,
                        // "GST File Name"=>$GST_File_Name
                    );
                    $updateagency=DB::table('BOC$OD Agency$3f88596c-e20d-438c-a694-309eb14559b2')->where("User ID",$userid)->update($vendordata2);
                }

                if($vendor)
                {
                    Session::flash('success',"Details have been updated successfully");
                    return redirect()->route('sole-basic-detail');
                }


            }

        

        }); //tansaction close


        
    }





    public function datainsert()
    {
        $table2 = '[BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2]';
        $user_id = DB::select("select TOP 1 [User ID] from $table2 order by [User ID] desc");

        if (empty($user_id)) {
            $user_id = 'EMPOW1';
        } else {
            $user_id = $user_id[0]->{"User ID"};
            $user_id++;
        }

        DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
            "User Type"=>5,
            "User ID"=>$user_id,
            "User Name"=>'ADG-JAIPUR',
            "Gender"=>0,
            "password"=>Hash::make('Dav@123$'),
            "email"=>'',
            "Mobile No_"=>'',
            "Employee Code"=>'',
            "Active"=>1,
            "Last Updated By"=>'',
            "Last Update Date Time"=>'2021-09-22 00:00:00.000',
            "OTP"=>'',
            "Email Verification"=>1,
            "GST"=>'',
            "Global Dimension 1 Code"=>'',
            "Email OTP"=>'',
            "wing type"=>0 
        ]);
    }
}
