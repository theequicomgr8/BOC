<?php

namespace App\Http\Controllers\billing\AV_RadioMediabilling;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;



use App\Models\Api\AVTVCirculation;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AVTVExcelsImport;
use Session;
class RadioController extends Controller
{

    public function index(){   
        $username=Session::get('UserName');  //->where('Agency Code',$username)        ->distinct()

        $data=DB::table('BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2 as line')
                    ->select('line.RO No_','line.Billing Status')
                    // ->leftJoin('BOC$AV RO Header$3f88596c-e20d-438c-a694-309eb14559b2 as header','header.RO Code','=','line.RO No_')
                    ->where('line.Agency Code',$username)
                    ->distinct()
                    ->get();

        // $data =DB::table('BOC$AV RO Header$3f88596c-e20d-438c-a694-309eb14559b2')->get();
        return view('admin.pages.billing.RedioMediaBilling.index',['data'=>$data]);
    }
    public function create($id =''){
        $code=str_replace("-", "/", $id);
        $data =DB::table('BOC$AV RO Header$3f88596c-e20d-438c-a694-309eb14559b2')->where('RO Code',$code)->first();
        //dd($data);
        $dataline =DB::table('BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2')->where('RO NO_',$code)->get();
        return view('admin.pages.billing.RedioMediaBilling.create',['RO_id'=>$data,'dataline'=>$dataline]);
    }
    public function storebilling(Request $request){

        $validated = $request->validate([
            'Order_id'          => 'required',
            'Account_rep'       => 'required',
            'billOfficerName'   => 'required',
            'billOfficerDesign' => 'required',
            'email'             => 'required',
            'from_date'         => 'required',
            'to_date'           => 'required'
        ]);


        $where =['RO Code'=>$request->RoCode];
        $getheader =DB::table('BOC$AV RO Header$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->first();
        $destinationPath = public_path() . '/uploads/radiobilling/';
        if ($request->hasFile('attachment1')) {
            $file = $request->file('attachment1');
            $advtImage = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $advtImage);
        } else {
            if(!empty($getheader->{'Attachment 1'})){
                $advtImage =  $getheader->{'Attachment 1'};
            }else{
                $advtImage ='';
            }
        }
        if($request->hasFile('attachment2')) {
            $file = $request->file('attachment2');
            $npImage = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $npImage);
        } else {
            if(!empty($getheader->{'Attachment 2'})){
                $npImage = $getheader->{'Attachment 2'};
            }else{
                $npImage = '';
            }
          
        }

        //av ro header 
        // $updatehead =['Attachment 1' => $advtImage,'Attachment 2'=> $npImage];
        $wing=Session::get('WingType');
        if($wing==4) //av-tv
        {
            $type=1;
        }
        elseif($wing==5)  //av-radio
        {
            $type=0;
        }
        elseif($wing==7)  //av-producere
        {
            $type=2;
        }

        $updatehead=array(
            "Attachment 1"=>$advtImage,
            "Attachment 2"=>$npImage,
            "Invoice No_"=>$request->Invoice_id,
            "Invoice Date"=>$request->Invoice_date,
            "Order No_"=>$request->Order_id,
            "Account Rep_"=>$request->Account_rep,
            "Bill Officer Name"=>$request->billOfficerName,
            "Bill Officer Designation"=>$request->billOfficerDesign,
            "Email Id"=>$request->email,
            "Telecast_Broadcast From Date"=>$request->from_date,
            "Telecast_Broadcast To Date"=>$request->to_date,
            "AV Type"=>$type
        );


        $where =['RO Code'=>$request->RoCode];
        $header =DB::table('BOC$AV RO Header$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->update($updatehead);

        //for multiple line table
        if(count($request->RoCode) > 0){
            foreach($request->RoCode as $key => $value){ 
                $update =['Bill Claim Amount' =>$request->claimed_amount[$key] ?? 0,"Billing Status"=>1];

                $where =['RO No_' => $value, 'Agency Code' =>$request->agencyCode[$key]];
                $data =DB::table('BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->update($update);
            }
        }
        // dd($request->RoCode[0]);
        $rono=Session::put('rono',$request->RoCode[0]);
        $roline=Session::put('roline',$request->RoLine[0]);
        if ($request->hasfile('avtv_excel')) {
            try {
                Excel::import(new AVTVExcelsImport, request()->file('avtv_excel')); //for import
            } catch (ValidationException $ex) {

                $failures = $ex->failures();
                foreach ($failures as $failure) {
                    return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                }
            }
        }



        if($header){
            return redirect('radio-billing/')->with('message','billing details updated successfully !');
        }
    }






}
