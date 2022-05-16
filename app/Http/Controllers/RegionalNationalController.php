<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Api\ResionalNaController as api;
use Illuminate\Http\Request;
use DB;
use PDF;
use Session;
class RegionalNationalController extends Controller
{

public function reginalradio(Request $request){
  $user_id =Session::get('UserID');
  $Showdetails =(new api)->ShowDetailsAVTV($user_id);
  $Chanal_Details =$Showdetails['Chanal_Details'];
  if ($request->isMethod('post')){
      $formType =$request->davp_code;
      //dd($formType);
    return redirect('regional-national/'.$formType);
  }
    return view('admin.pages.regional-national-form', ['Chanal_Details'=>$Chanal_Details]);
  

 
}

public function getregional($formType){
//dd($formType);
  $data =(new api)->getStates();
  $da =json_decode(json_encode($data),true);
  $state =$da['original']['data'];
  //Languages data
  $datalang =(new api)->getLanguages();
  $datala =json_decode(json_encode($datalang),true);
  $Languages=$datala['original']['data'];
 //Show All Data 
  $user_id =Session::get('UserID');
  $Showdetails =(new api)->ShowDetailsAVTV($user_id);
  $OwnerDetails =$Showdetails['OwnerDetails'];
   // dd($OwnerDetails->{'District'});
  $Chanal_Details =$Showdetails['Chanal_Details'];
  $district1 = "";
  $district2 = "";
  $district3 = "";
  
  if($Chanal_Details !=''){
    
    $district1 = $this->fetchStateDistricts(@$Chanal_Details->{'DO State'});
    $district2 = $this->fetchStateDistricts(@$Chanal_Details->{'HO State'});
    $district3 = $this->fetchStateDistricts(@$OwnerDetails->{'State'});
    //dd($district3);
    // print_r($district2);die;
      return view('admin.pages.empanelment-regional-national-form',['state'=>$state,'Languages' =>$Languages,'Chanal_Details' =>$Chanal_Details,'OwnerDetails'=>$OwnerDetails,'district1'=>$district1,'district2'=>$district2, 'dist' => $district3,'formType'=>$formType]);
  }
  return view('admin.pages.empanelment-regional-national-form',['state'=>$state,'Languages' =>$Languages,'formType'=>$formType,'dist' => $district3,]);
   }

public function fetchStateDistricts($state_code)
  { 
    	$data =(new api)->getDistricts($state_code);
    	 $getdis =json_decode(json_encode($data),true);
    	$district =$getdis['original']['data'];
     return $district;
  }

  public function fetchDistricts(Request $request)
  { 
 
     $state_code = $request->state_id;  
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
  public function Savedata(Request $request){

$Ownerdata=(new api)->reginalOwnerData($request);
 $response =json_decode(json_encode($Ownerdata),true);
 if($response['original']['success'] == true){
  return response()->json($response['original']);
 }
 }

 public function saveregional(Request $request){
    $vender =(new api)->ChanalInformation($request);
    $response =json_decode(json_encode($vender), true);
   if($response['original']['success'] == true){
  return response()->json($response['original']);
 }

 }

     public function FetchRNemail(Request $request){
          //dd($request->Email_data);
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
          //dd($ownerdata);
          $response=['owner' => $ownerdata,
                    'status'=>true];
           // return response()->json($response);
            return $response;

}
//Down load pdf
public function getStatePDF($State_pdf =""){
  $state =DB::table('BOC$State')->select('Description')->where('Code',$State_pdf)->first();
  return $state->{'Description'};
}
public function getLanguage($lang=''){
  $getlan =DB::table('BOC$Language')->select('name')->where('Code',$lang)->first();
  return $getlan->{'name'};
}
public function avtvPDF($id){
  $Chanal_Details =DB::table('BOC$Vendor Emp - Channel')->where('Channel ID',$id)->first();  
  $OD_owners =DB::table('BOC$Owner')->where('Owner ID',@$Chanal_Details->{'Owner ID'})->first();
  $DO_State =$this->getStatePDF(@$Chanal_Details->{'DO State'});
  $HO_State =$this->getStatePDF(@$Chanal_Details->{'HO State'});
  $Owner_State =$this->getStatePDF(@$OD_owners->{'State'});
  $getlang =$this->getLanguage(@$Chanal_Details->{'Regional_Language Type'});
  $pdf= PDF::loadView('admin.pages.AV-pdf.avtv-pdf',[ 'Chanal_Details'=>$Chanal_Details,'OD_owners'=>$OD_owners, 'DO_State'=> $DO_State, 'HO_State' =>$HO_State, 'Owner_State'=>$Owner_State,'getlang'=>$getlang]);
return $pdf->download($id. '.pdf');
}




}
