<?php

namespace App\Imports;

use App\Models\Api\AVTVCirculation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Session;
use DB;

class AVTVExcelsImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $rows)
    {
        $today = date('Y-m-d h:i:s', time());
        

        $data = session()->all();
        
        $wingvalue=Session::get('WingType');

        if($wingvalue==5)
        {
            $wingtype='AV-Radio';
        }
        elseif($wingvalue==4)
        {
            $wingtype='Av-TV';
        }
        elseif($wingtype==7)
        {
            $wingtype='AV-Producers';
        }

        $table='[BOC$RO Bill Detail Lines$3f88596c-e20d-438c-a694-309eb14559b2]';
        $line_no = DB::select("select TOP 1 [Line No_] from $table  order by [Line No_] desc");
        if (empty($line_no)) {
            $line_no = 10000;
        } else {
            $line_no = $line_no[0]->{"Line No_"};
            $line_no = $line_no + 10000;
        }

        // $agencycode=Session::get('AgencyCode');
        $agencycode='ADC123';
        $year=date('Y');
        
        $table2='[BOC$RO Bill Detail Lines$3f88596c-e20d-438c-a694-309eb14559b2]';
        // $control_no = DB::select("select TOP 1 [Control No_] from $table2  order by [Control No_] desc");
        $control_no=DB::table('BOC$RO Bill Detail Lines$3f88596c-e20d-438c-a694-309eb14559b2')->orderBy('Control No_','desc')->first();

        if (empty($control_no)) {
            $control_no = $agencycode.'/'.$year.'/0001';
        } 
        else {
            $control_no = $control_no->{"Control No_"};
            $first_code=substr($control_no,0,12);
            $second_code=substr($control_no,12,4) + 1;
            
            // dd($code);

            $input = 1;
            $num = str_pad($second_code, 4, "0", STR_PAD_LEFT);
            // dd($num);
            $control_no=$first_code.$num;
            // dd($control_no);

            

        }

        


        return new AVTVCirculation([
                    'Transaction Type'       =>$wingvalue, 
                    'RO No_'                 =>Session::get('rono'), 
                    'RO Line No_'            =>Session::get('roline'),
                    'Line No_'               =>$line_no,
                    'Control No_'            =>$control_no,
                    'Air Date and Time'      =>trim($rows['aired_date']),
                    'Start Air Time'         =>'1753-01-01 00:00:00.000',
                    'Duration'               =>trim($rows['claimed_spot_duration']),
                    'Remark'                 =>trim($rows['caption'])
                    
                ]);          

            
            
        }

    }

// trim($rows['state']),
