<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Traits\CommonTrait;
class DigitalCinemaController extends Controller
{
  use CommonTrait;

    private $vendorTable ='BOC$Vend Emp Digital Cinema$3f88596c-e20d-438c-a694-309eb14559b2';

    public function __Constructor($vendorTable){
        return $this->vendorTable =$vendorTable;
    }


/* ==================================start Owner Insert Update======================================*/
    public function DCOwnerData(Request $request)
    {
        $table1 = '[BOC$Vend Emp Digital Cinema$3f88596c-e20d-438c-a694-309eb14559b2]';
        $msg = '';
        $userid =Session::get('UserID');
        $agencyFind=DB::table($this->vendorTable)->select('Agency Code')->where('User ID',$userid)->first();
            //dd($agencyFind->{'Agency Code'});
        $agency_Name=
        isset($request->Owner_Name) ? $request->Owner_Name:'';
        $mobile=
        isset($request->digital_mobile) ? $request->digital_mobile:'';
        $email=
        isset($request->digital_email) ? $request->digital_email:'';
        $phone=
        isset($request->digital_phone_no) ? $request->digital_phone_no:'';
        $address=
        isset($request->digital_address) ? $request->digital_address:'';
        $city=
        isset($request->digital_city) ? $request->digital_city:'';
        $district=
        isset($request->digital_district) ? $request->digital_district:'';
        $state=
        isset($request->digital_state) ? $request->digital_state:'';
            if(@$agencyFind->{'Agency Code'} == ''){
                $msg ='';
                //$agency_code='';select TOP 1 [Owner ID] from dbo.[BOC$Owner] order by [Owner ID] desc'
                 $agency_code =DB::select("select TOP 1 [Agency Code] from $table1 order by [Agency Code] desc");
                // dd($agency_code[0]->{'Agency Code'});

            if(empty($agency_code)){
                $agency_code ='D0S1N0';
            }else{
               $agency_code =$agency_code[0]->{'Agency Code'};
               $agency_code++;
            }

            //dd($agency_code);
        $sql =  DB::insert(
        "insert into $table1 (
       [timestamp],
       [Agency Code],
       [Agency Name],
       [Address 1],
       [Address 2],
       [City],
       [District],
       [State],
       [Mobile],
       [E-Mail],
       [Phone],
       [Fax],
       [Account No_],
       [A_C Holder Name],
       [Bank Name],
       [Branch Name],
       [IFSC Code],
       [Account Address],
       [PAN],
       [ESI A_c No_],
       [No_ Of Emp in ESI],
       [EPF A_c No_],
       [No_ Of Emp in EPF],
       [Agreement Between Parties],
       [Agreement File Name],
       [Self Declaration],
       [Self Dclr File Name],
       [Empanelment Category],
       [Global Dimension 1 Code],
       [Global Dimension 2 Code],
       [User ID],
       [Status],
       [Recommended To Committee],
       [Agr File Path],
       [Agr File Name],
       [Affidavit For Non Suspension],
       [Affidavit For NS File Naame],
       [Affidavit For Director],
       [Affidavit For Dir File Name],
       [Mobile number Own DB],
       [Mobile number ODB File Name],
       [Incorporation Certificate],
       [Incorporation Cert File Name],
       [Sender ID],
       [Receiver ID],
       [Modification],
       [Alocated DC Code],
       [From Date],
       [To Date]
       )
            values (
                DEFAULT,
               '".$agency_code."',
               '".$agency_Name."',
               '".$address."',
               '',
               '".$city."',
               '".$district."',
               '".$state."',
               '".$mobile."',
               '".$email."',
               '".$phone."',
               '',
               '',
               '',
               '',
               '',
               '',
               '',
               '',
               '',
                0,
               '',
               0,
               '',
               '',
                0,
               '',
               7,
              'M004',
              '',
              '".$userid."',
              0,0,'','',0,'',0,'',0,'',0,'','','',0,'','1900-01-01 00:00:00.000','1900-01-01 00:00:00.000')"
            );

            //$sql =DB::teble('')insert($insert)
                $msg = 'Data Saved Successfully!';
                if ($sql){
                return $this->sendResponse($agency_code, $msg);
                }
            }else {
                $update =[
                "Agency Name" =>$agency_Name,
                "Address 1" =>$address,
                "Address 2" =>'',
                "City" =>$city,
                "District" =>$district,
                "State" =>$state,
                "Mobile" =>$mobile,
                "E-Mail" =>$email,
                "Phone" =>$phone,
                "Fax" =>''
                ];
                 $sql =DB::table($this->vendorTable)->where('Agency Code',@$agencyFind->{'Agency Code'})->update($update);
                // //dd($sql);
                 $msg = 'Data Updated Successfully!';

            if ($sql) {
            return $this->sendResponse(@$agencyFind->{'Agency Code'}, $msg);
            }else{
            return $this->sendError('Some Error Occurred!.');
            exit;
           }
        }
    }

/* ==================================End Owner Insert Update======================================*/
/*==================================Start Second Insert Update=====================================*/
public function addSeatsdetails(Request $request){
    return DB::transaction(function() use ($request) {
    $msg ='';
    $sql1 ='';
    $userid = session::get('UserID');
         $agencyFind=DB::table($this->vendorTable)
            ->select('Agency Code')->where('User ID',$userid)->first();
                if(count($request->screen_unique_code) > 0){
                     $where2=array("Agency Code"=>@$agencyFind->{'Agency Code'});
                    $checkData=DB::table('BOC$Digital Cinema Screen$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->delete();
                foreach ($request->screen_unique_code as $key => $value) {
                    $where=array("Agency Code"=>@$agencyFind->{'Agency Code'});
                    $line=DB::table('BOC$Digital Cinema Screen$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where($where)->orderBy('Line No_','desc')->first();
                    $line_no=@$line->{'Line No_'};
                    // dd($line_no);
                    if(empty($line))
                    {
                        $lineNo='1000';
                    }
                    else
                    {
                        $lineNo=$line_no+1;

                    }
                    $agency_contract_details =$request->agency_contract_details[$key] ?? '';
                    $screen_unique_code =$value ?? '';
                    $number_screens =$request->number_screens [$key] ?? '';
                        //dd($agencyFind->{'Agency Code'} ,$lineNo);
                    $insert =[
                      "Agency Code" =>@$agencyFind->{'Agency Code'},
                      "Line No_" =>$lineNo,
                      "Screen Unique Code"=> $screen_unique_code,
                      "Agency Contract Detail" =>$agency_contract_details,
                      "No_ Of Seats" =>$number_screens
                        ];
                         $sql1 =DB::table('BOC$Digital Cinema Screen$3f88596c-e20d-438c-a694-309eb14559b2')
                        ->insert( $insert);
                    $msg ="Sreens data save Successfully!";
                }
            }
        // Lets add some custom validation that will prohibit the transaction:
        if(!$sql1) {
            throw AnyException('Please rollback this transaction');
             //return $this->sendError('Some Error Occurred!');
        }
        return $this->sendResponse(@$agencyFind->{'Agency Code'},$msg);
    });//transection close
}
/*==================================End Second Insert Update=====================================*/
public function SaveAccountDetails(Request $request){
        $bank_account_no =$request->bank_account_no ?? '';
        $account_holder_name =$request->account_holder_name ?? '';
        $IFSC_Code =$request->IFSC_Code ?? '';
        $bank_name =$request->bank_name ?? '';
        $branch =$request->branch ?? '';
        $address_account =$request->address_account ?? '';
        $PAN =$request->PAN ?? '';
        $ESI_account_no =$request->ESI_account_no ?? '';
        $ESI_employees_covered =$request->ESI_employees_covered ?? '';
        $EPF_account_no =$request->EPF_account_no ?? '';
        $EPF_employees_covered =$request->EPF_employees_covered ?? '';
        $msg ="";
        $userid = session::get('UserID');
        $agencyFind=DB::table($this->vendorTable)
        ->select('Agency Code')->where('User ID',$userid)->first();
        $updateAC=[
                "Account No_" =>$bank_account_no,
                "A_C Holder Name" =>$account_holder_name,
                "Bank Name" =>$bank_name,
                "Branch Name" =>$branch,
                "IFSC Code" =>$IFSC_Code,
                "Account Address" =>$address_account,
                "PAN" =>$PAN,
                "ESI A_c No_"=>$ESI_account_no,
                "No_ Of Emp in ESI" =>$ESI_employees_covered,
                "EPF A_c No_" =>$EPF_account_no,
                "No_ Of Emp in EPF" =>$EPF_employees_covered,

        ];
        //dd($ESI_employees_covered);
        $sqlAC =DB::table($this->vendorTable)->where('Agency Code',@$agencyFind->{'Agency Code'})->update($updateAC);
        $msg ="Account Save Successfully !";
        if($sqlAC){
            return $this->sendResponse(@$agencyFind->{'Agency Code'},$msg);
        }

}
/*==================================End Third Insert Update=====================================*/
/*==================================Start Fourth Insert Update=====================================*/
public function DOCStore(Request $request){
        $msg ="";
        $userid = session::get('UserID');
        $agencyFind=DB::table($this->vendorTable)
        ->select('Agency Code','Agreement File Name')->where('User ID',$userid)->first();
        $agreement_parties ='';
        $Agreement_Between_Parties ='';
        $Uploaded_file =$agencyFind->{'Agreement File Name'} ?? '';
        $destinationPath =public_path().'/uploads/Digital-Cinema/';

        if($request->hasFile('agreement_parties')){
            $file =$request->file('agreement_parties');
             $agreement_parties =time().'-'.$file->getClientOriginalName();
            $fileUploaded=$file->move($destinationPath, $agreement_parties);
            if($fileUploaded){
                $Agreement_Between_Parties = 1;
            }
            }else{
                $agreement_parties =$Uploaded_file;
            }
            $Self_declaration =$request->Self_declaration ?? 0;

    $DOCupdate =[
        "Agreement Between Parties" =>$Agreement_Between_Parties,
        "Agreement File Name" =>$agreement_parties,
        "Self Declaration" =>$Self_declaration,
        "Self Dclr File Name" =>'',
        "Modification" =>1
    ];
    $sqlDOC =DB::table($this->vendorTable)
    ->where('Agency Code',@$agencyFind->{'Agency Code'})
    ->update($DOCupdate);
    $data_id =@$agencyFind->{'Agency Code'};
    $msg ='Data Save Successfully! Please note the ' .$data_id.' reference number for future use.';
        if($sqlDOC){
            return $this->sendResponse($data_id,$msg);
        }else{
            return $this->sendError('Some Error Occurred !');
        }
}
/* ===================================End Fourth Insert Update======================================*/
/*====================================Start Show Details =========================================*/

public function ShowDetails($userID =''){
        $screentable ='BOC$Digital Cinema Screen$3f88596c-e20d-438c-a694-309eb14559b2';
        $vendorData =DB::table($this->vendorTable)->where('User ID',$userID)->first();
        $DigitalScreen =DB::table($screentable)
        ->where('Agency Code',@$vendorData->{'Agency Code'})
        ->get();
        $response =[
                'vendorData' =>$vendorData,
                'DigitalScreen' =>$DigitalScreen
                ];
        return $response;
}

/*====================================End Show Details============================================*/
}
