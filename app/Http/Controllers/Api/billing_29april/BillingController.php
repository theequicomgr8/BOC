<?php

namespace App\Http\Controllers\Api\billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Traits\CommonTrait;
use Illuminate\Support\Facades\Session;
class BillingController extends Controller
{
  	use CommonTrait;
	public function storeBilling(Request $request){
		$vendorno=Session::get('UserName');
		$currentDate=now();
		$destinationPath = public_path() . '/uploads/billing/';
        if ($request->hasFile('advtImage')) {
            $file = $request->file('advtImage');
            $advtImage = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $advtImage);
        } else {
            $advtImage = '';
        }
        if ($request->hasFile('npImage')) {
            $file = $request->file('npImage');
            $npImage = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $npImage);
        } else {
            $npImage = '';
        }
		$arrayName=array(
			'Vendor Bill No_' => $request->billno,
		      'Vendor Bill Date' =>  date('Y-m-d', strtotime($request->bill_date)),
		      'Submission Date' =>  date('Y-m-d', strtotime($request->publication_date)),
		      'Vendor GST No_' => $request->gstno,
		      'Billing Advertisement Type' => $request->bublishedIn,
		      'Page No_' => $request->published_pageno,
		      'Advertisement Length' => $request->advtLen,
		      'Advertisement Width' => $request->advtWidth,
		      'Advertisement Diff_' => $request->diff,
		      'Bill Claim Amount' => $request->claimedAmount,
		      'Bill Approved Amount'=>$request->ap_amount,
		      'Bill Officer Name' => $request->billOfficerName,
		      'Bill Officer Designation' => $request->billOfficerDesign,
		      'Email Id' => $request->email,
		      'Bill Submitted By' => $request->SignatoryName,
		      'Bill Submitted - Designation' => $request->SignatoryDesign,
		      'Advertisement Img FileName'=>$advtImage,
		      'NP Img FileName'=>$npImage,
		    // 'Image Match Percentage'=>$request->ImageMatchPercentage,
		      'Billing Status'=>1,
		      'Billing DateTime(Audit)'=>$currentDate,
		      'Vendor No_'=>$vendorno

  		);
  		//dd($arrayName);
  		 DB::unprepared('SET ANSI_WARNINGS OFF');
		$sql = DB::table('BOC$RO Line')
		->where('NP Code', $request->npcode)
        ->where('RO NO_', $request->rocode)
		->update($arrayName);

		DB::unprepared('SET ANSI_WARNINGS ON');
		if ($sql) {
			return $this->sendResponse('', 'Data Successfully saved');
		} else {
			return $this->sendError('Some Error Occurred!.');
			exit;
		}

	}
}
