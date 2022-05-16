<?php

namespace App\Imports\Outdoor\Media;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Api\MediaCirculation;
use Session;
use DB;

class ThirdSheetImport implements ToModel, WithHeadingRow
{
    public function model(array $rows)
    {
        $od_mediaID = Session::get('ex_odmediaid');
        $table = 'BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2';
        $table2 = 'BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2';
        $lineNO = DB::table($table2)->select('Line No_')->where('Sole Media ID', $od_mediaID)->orderBy('Line No_', 'desc')->first();
        if (empty($lineNO->{'Line No_'})) {
            $lineNO = 10000;
        } else {
            $lineNO = $lineNO->{"Line No_"};
            $lineNO++;
        }

        $media_cat = array('0' => 'Airport', '1' => 'Railways', '2' => 'Road', '3' => 'Transit Media', '4' => 'Others', '5' => 'Metro', '6' => 'Bus & Station');
        foreach ($media_cat as $k => $cat_val) {
            if ($rows['category'] == $cat_val) {
                $media_category = $k;
            }
        }

        //for illumination 

        $illumination_type = $rows['illumination'] == 'Lit' ? 1 : 2;

        //for lit type
        if ($illumination_type == 1) {
            $lit_type = $rows['lit_type'] == 'Front Lit' ? 1 : 2;
        } else {
            $lit_type = 0;
        }


        // get sub cat UID
        $category = DB::table($table)->select('OD Media UID')->where('Name', $rows['sub_category'])->first();

        return new MediaCirculation([
            'State'                     => trim($rows['state']),
            'District'                  => trim($rows['district']),
            'City'                      => trim($rows['city']),
            'Zone'                      => 0,
            'Display Size'              => 0,
            'Illumination Type'         => $illumination_type,
            'Availability Start Date'   => '1753-01-01 00:00:00.000',
            'Availability End Date'     => '1753-01-01 00:00:00.000',
            'OD Media Type'             => $media_category, //for category
            'Sole Media ID'             => $od_mediaID,
            'Line No_'                  => $lineNO,
            'Latitude'                  => 0.0,
            'Longitde'                  => 0.0,
            'Landmark'                  => '',
            'Image File Name'           => '',
            'OD Media ID'               => $category->{'OD Media UID'}, //for sub-category
            'Quantity'                  => trim($rows['quantity']),
            'Length'                    => 0,
            'Width'                     => 0,
            'Total Area'                => 0,
            'Rental'                    => 0,
            'Rental Type'               => 0,
            'Train Number'              => trim($rows['train_number']),
            'Train Name'                => trim($rows['train_name']),
            'Size Type'                 => 0,
            'Duration'                  => 0,
            'No Of Spot'                => 0,
            'Lit Type'                  => $lit_type
        ]);
    }
}
