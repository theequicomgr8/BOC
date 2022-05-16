<?php

namespace App\Imports;

use App\Models\Api\MediaCirculationDone;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Session;
use DB;

class MediaExcelsImportDone implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $rows)
    {
        $od_mediaID=Session::get('ex_odmediaid');
        // $table='BOC$OD Media Category';
        $table2='BOC$OD Media Work done';
        // DB::table($table2)->where('OD Media ID',$od_mediaID)->delete();
        $lineNO=DB::table($table2)->select('Line No_')->where('OD Media ID',$od_mediaID)->orderBy('Line No_','desc')->first();
        if (empty($lineNO->{'Line No_'})) {
            $lineNO = 10000;
        } else {
            $lineNO = $lineNO->{"Line No_"};
            $lineNO++;
        }

        // if($rows['media_category'] == 'Airport')
        // {
        //         $media_category = 1;
        // }
        // else if($rows['media_category'] == 'Railway Station')
        // {
        //     $media_category = 2;
        // }
        // else if($rows['media_category'] == 'Moving Media')
        // {
        //     $media_category = 3;
        // }
        // else if($rows['media_category'] == 'Public utility')
        // {
        //     $media_category = 4;
        // }
            
        // $category=DB::table($table)->select('OD Media UID')->where('Name',$rows['media_sub_category'])->first();
        // dd($category->{'OD Media UID'});
        // $sub_category = DB::table('OD Media Category')->select('OD Media ID')->where('sub categoryname',$rows['sub_category_name'])->first();
        // dd($odmedia_id);

        // dd($rows);

        
        return new MediaCirculationDone([
            // 'State'                     => trim($rows['state']),
            // 'District'                  => trim($rows['district']), 
            // 'City'                      => trim($rows['city']),
            // 'Zone'                      => trim($rows['zone']),
            // 'Display Size'              => trim($rows['display_size']),
            // 'Illumination Type'         => trim($rows['illumination_type']),
            // 'Availability Start Date'   => trim($rows['availability_start_date']),
            // 'Availability End Date'     => trim($rows['availability_end_date']),
            // 'OD Media Type'             =>$media_category, //for category
            // 'Sole Media ID'             =>$od_mediaID,
            // 'Line No_'                  =>$lineNO,
            // 'Latitude'                  =>0.0,
            // 'Longitde'                  =>0.0,
            // 'Landmark'                  =>'',
            // 'Image File Name'           =>'',
            // 'OD Media ID'               =>$category->{'OD Media UID'}, //for sub-category
            // 'Quantity'                  =>0,
            // 'Length'                    =>0,
            // 'Width'                     =>0,
            // 'Total Area'                =>0,
            // 'Rental'                    =>0,
            // 'Rental Type'               =>0
            'OD Media Type' => 2,
            'OD Media ID' =>$od_mediaID,
            'Line No_' =>$lineNO,
            'Work Name' =>'',
            'Year' =>trim($rows['year']),
            'Qty Of Display_Duration' => trim($rows['duration']),
            'Billing Amount' =>trim($rows['amount']),
            'Allocated Vendor Code' =>'',
            'From Date' =>trim($rows['from_date']),
            'To Date' =>trim($rows['to_date'])
        ]);
    }
}



