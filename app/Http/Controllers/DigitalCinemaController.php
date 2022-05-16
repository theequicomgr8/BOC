<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Api\DigitalCinemaController as api;

class DigitalCinemaController extends Controller
{
    public function Digitalview(){
    $state_array = (new api)->getStates();
    $statess = json_decode(json_encode($state_array),true);
    $states =$statess['original']['data'];

    //Get Vendor Details
    $userID =session::get('UserID');
    $Vendorres =(new api)->ShowDetails($userID);
    //dd($Vendorres);
    $vendorData =$Vendorres['vendorData'];
    $DigitalScreen =$Vendorres['DigitalScreen'];
    $district ="";
    if(!empty($vendorData)){
    	$district =$this->fetchStateDistricts($vendorData->{'State'});
    	//dd($district);
    	return view('admin.pages.fresh-empanelment-digital-cinema-form',['states' =>$states,
    		'vendorData' =>$vendorData,'DigitalScreen'=>$DigitalScreen,'district'=>$district]);
    }
    	return view('admin.pages.fresh-empanelment-digital-cinema-form',['states' =>$states,
    		'district'=>$district]);
    }
    public function fetchStateDistricts($state_code)
    {
            $data =(new api)->getDistricts($state_code);
            $getdis =json_decode(json_encode($data),true);
            $district =$getdis['original']['data'];
        return $district;
    }
    //GETDistrict
    public function DigitalgetDistricts(Request $request)
    {
        $state_code = $request->State_code;
        $data =(new api)->getDistricts($state_code);
        $getdis =json_decode(json_encode($data),true);
        $district =$getdis['original']['data'];
        $html="<option value=''>Select District</option>";
        foreach ($district as $key => $value) {
        $html.='<option value="'.$value['District'].'">'.$value['District'].'</option>';
    }
    echo $html;
  }
    //Store first tab data

    public function DGCOwner(Request $request){
    	$resp =(new api)->DCOwnerData($request);
    	$response = json_decode(json_encode($resp), true);
    	if($response['original']['success'] == true){
    		return response()->json($response['original']);
    	}
    }

    //stor second tab data

    public function DigitalSeats(Request $request){
    	//dd($request);
    	$resp =(new api)->addSeatsdetails($request);
    	$response = json_decode(json_encode($resp), true);
    	if($response['original']['success'] == true){
    		return response()->json($response['original']);
    	}
    }

    //Account Details

    public function AccountDetails(Request $request){
    	$resp =(new api)->SaveAccountDetails($request);
    	$response = json_decode(json_encode($resp), true);
    	if($response['original']['success'] == true){
    		return response()->json($response['original']);
    	}
    }

    public function SaveDocFile(Request $request){
    	$resp =(new api)->DOCStore($request);
    	$response =json_decode(json_encode($resp),true);
    	if($response['original']['success'] == true){
    		return response()->json($response['original']);
    	}
    }
    //IFSC api
    public function getifsc(Request $request){
    $IFSC_CODE = rawurlencode($request->IFSC);
    $url = "https://ifsc.razorpay.com/".$IFSC_CODE;
    $curl_handle=curl_init();
    curl_setopt($curl_handle, CURLOPT_URL,"$url");
    curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_handle, CURLOPT_HEADER, false);
    $postoffice_data = curl_exec($curl_handle);
    return $postoffice_data;
    }
}
