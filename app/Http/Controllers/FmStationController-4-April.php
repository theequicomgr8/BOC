<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Session;
use Redirect;
use response;
use App\Http\Controllers\Api\ApiFreshEmpanelmentController as api;
use App\Http\Controllers\Api\PrivateFMStationController as FMapi;
class FmStationController extends Controller
{
   public function StateDropdown()
  {

    $state_array = (new api)->getStates();
    $statess = json_decode(json_encode($state_array),true);
    $states =$statess['original']['data'];
    $state_code = "";
    $lang = (new api)->getLanguages();
    $languag1 = json_decode(json_encode($lang),true);
    $languag=$languag1['original']['data'];
    $userid = Session::get('UserID');
    $response =(new FMapi)->ShowAllDetails($userid);
    $FMdata=$response['FMdata'];
    $OD_owners =$response['OD_owners'];
    $Time_band =$response['Time_band'];
    $dist="";
    if($FMdata !=''){
      $dist=$this->FMDistricts(@$OD_owners->State);
      // dd($dist);
   return view('admin.pages.fm-station-form' ,['dist'=>$dist])->with(compact('languag','states', 'FMdata','OD_owners','Time_band'));
          }
      return view('admin.pages.fm-station-form',['dist'=>$dist])->with(compact('languag','states'));    
      }
  //Get District function    
   public function FMfetchDistricts(Request $request)
  { 
 
     $state_code = $request->state_code;  
      $data =(new api)->getDistricts($state_code);
       $getdis =json_decode(json_encode($data),true);
      $district =$getdis['original']['data'];
     // return $district;
      $html="<option value=''>Select District</option>";
      foreach ($district as $key => $value) {
      $html.='<option value="'.$value['District'].'">'.$value['District'].'</option>';
    
      }
      echo $html;
    
  }


  public function FMDistricts($state_code)
  { 
 
     $state_code = $state_code;  
      $data =(new api)->getDistricts($state_code);
       $getdis =json_decode(json_encode($data),true);
      $district =$getdis['original']['data'];
     return $district;
      // $html="<option>Select District</option>";
      // foreach ($district as $key => $value) {
      // $html.='<option value="'.$value['District'].'">'.$value['District'].'</option>';
    
      // }
      // echo $html;
    
  }

  public function fmStation(Request $request){
    //dd($request);
  	if($request->next_tab_1 == 1){
   
  		$resp =(new FMapi)->fmStationOwnerData($request);
  			$response = json_decode(json_encode($resp), true);
          if ($response == true) {
                return response()->json($response['original']);
  				}
  
  			}  

        if($request->next_tab_2 == 1){
         // dd($request);
          $resp =(new FMapi)->saveVanderdetails($request);
        $response =json_decode(json_encode($resp), true);
        if($response == true){
          return response()->json($response['original']);
        }
        }
        if($request->next_tab_3 == 1){
           $resp =(new FMapi)->ACdetails($request);
          $response = json_decode(json_encode($resp), true);
          if($response == true){
            return response()->json($response['original']);
          }
        }

        if($request->submit_btn == 1){
          //dd($request);
          $resp =(new FMapi)->storeDOC($request);
          $response =json_decode(json_encode($resp), true);
          //dd($response['original']['message']);
       if($response['original']['success'] == true){
     
       return response()->json($response['original']);
       // return response();
        }
        
        }
    
		}

    public function findfm(Request $request){

           $tableOwner ='BOC$Owner';
          $ownerdata =DB::table($tableOwner)
          ->select('Owner ID as owner_id',
                    'Owner Name as owner_name',
                    'Mobile No_ as mobile_no',
                    'Email ID as email_id',
                    'Phone No_ as phone_no',
                    'Fax No_ as fax_no',
                    'Address 1 as address_a',
                    'Address 2 as address_b',
                    'City as city',
                    'District as d',
                    'State as state')
          ->where('Email ID',$request->Email_data)
          ->first();
          $response=['owner' => $ownerdata,
                    'status'=>true];
           // return response()->json($response);
            return $response;
            

}

 public function checkgst(Request $request)
    {
       $getGST=$request->GST_name;

        //Server url 09AADCS2308B1ZU
        $url = "https://apisetu.gov.in/gstn/v1/taxpayers/$getGST";
        $apiKey = 'LoYt543GxbGJJuV6KXbgvs0EmNv9INJk'; // should match with Server key
        $headers = array(
            // 'Authorization: '.$apiKey
            "accept: application/json", 
            "X-APISETU-CLIENTID: in.nic.davp",
            "X-APISETU-APIKEY: LoYt543GxbGJJuV6KXbgvs0EmNv9INJk",

        );
        // Send request to Server
        $ch = curl_init($url);
        // To save response in a variable from server, set headers;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // Get response
        $response = curl_exec($ch);
        // Decode
        $result = json_decode($response);
        // dd($result);
        return $result;
    }

//IFSC Code Api
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