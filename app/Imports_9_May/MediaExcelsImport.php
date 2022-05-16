<?php

namespace App\Imports;

use App\Models\Api\MediaCirculation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Session;
use DB;

class MediaExcelsImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $rows)
    {
        // dd('fkjdkdg');
        $od_mediaID=Session::get('ex_odmediaid');
        $table='BOC$OD Media Category';
        $table2='BOC$Sole Medias Address';
        $lineNO=DB::table($table2)->select('Line No_')->where('Sole Media ID',$od_mediaID)->orderBy('Line No_','desc')->first();
        if (empty($lineNO->{'Line No_'})) {
            $lineNO = 10000;
        } else {
            $lineNO = $lineNO->{"Line No_"};
            $lineNO++;
        }

        if(@$rows['media_category'] == 'Airport')
        {
                $media_category = 0;
        }
        else if(@$rows['media_category'] == 'Railways')
        {
            $media_category = 1;
        }
        else if(@$rows['media_category'] == 'Road')
        {
            $media_category = 2;
        }
        else if(@$rows['media_category'] == 'Transit Media')
        {
            $media_category = 3;
        }
        else if(@$rows['media_category'] == 'Others')
        {
            $media_category = 4;
        }
        else if(@$rows['media_category'] == 'Metro')
        {
            $media_category = 5;
        }
        else if(@$rows['media_category'] == 'Bus & Station')
        {
            $media_category = 6;
        }
       
        
        //for illumination 
        if(@$rows['illumination_type']=='Lit')
        {
            $illumination_type=1;
        }
        else if(@$rows['illumination_type']=='Non Lit')
        {
            $illumination_type=2;
        }
        

        //for lit type
        if(@$rows['lit_type']=='Front Lit')
        {
            $lit_type=1;
        }
        else if(@$rows['lit_type']=='Back Lit')
        {
            $lit_type=2;
        }
        else
        {
            $lit_type=0;
        }

        //for Size type
        if(@$rows['size_type']=='CM')
        {
            $size_type=1;
        }
        else if(@$rows['size_type']=='FT')
        {
            $size_type=2;
        }
        else
        {
            $size_type=0;
        }

        
        //for train name 
        if(@$rows['train_name']=='')
        {
            $train_name='';
        }
        else
        {
            $train_name=$rows['train_name'];
        }

        //for train number 
        if(@$rows['train_no']=='')
        {
            $train_no='';
        }
        else
        {
            $train_no=$rows['train_no'];
        }
        
            
        $category=DB::table($table)->select('OD Media UID')->where('Name',$rows['media_sub_category'])->first();
        // dd($category->{'OD Media UID'});

            // $subcategory=$category->{'OD Media UID'};
            // if($subcategory=='OD004' || $subcategory=='OD058' || $subcategory=='OD059' || $subcategory=='OD060' || $subcategory=='OD083' || $subcategory=='OD111'|| $subcategory=='OD001'|| $subcategory=='OD011'|| $subcategory=='OD014'|| $subcategory=='OD020'|| $subcategory=='OD021'|| $subcategory=='OD023'|| $subcategory=='OD036'|| $subcategory=='OD091'|| $subcategory=='OD113'|| $subcategory=='OD117'|| $subcategory=='OD121'|| $subcategory=='OD100'|| $subcategory=='OD124'|| $subcategory=='OD029')
            // {
            //     $illumination_type=2;
            // }

            $cat = $rows['media_sub_category'];
            if (strpos($cat, 'Bus Panel') !== false) {
                $illumination_type=2;
            }
            else if(strpos($cat, 'Hoarding') !== false)
            {
                 $illumination_type=2;
            }
            else if(strpos($cat, 'Digital Display') !== false)
            {
                 $illumination_type=2;
            }
            else if(strpos($cat, 'Train Inside') !== false)
            {
                 $illumination_type=2;
            }
            else if(strpos($cat, 'Train Outside') !== false)
            {
                 $illumination_type=2;
            }

            $keys=array_keys($rows);

            // $first=["media_category","media_sub_category","duration","state","district","city","quantity","illumination_type"];
            // if(array_diff($first, $keys)==[] && array_diff($keys, $first)==[])
            // {
            //     dd("First");
            // }
            $second=["media_category","media_sub_category","quantity","state","district","city","illumination_type","lit_type","train_name","train_no"];
            if(array_diff($second, $keys)==[] && array_diff($keys, $second)==[])
            {
                // dd('SECOND');
                return new MediaCirculation([
                    'State'                     => trim($rows['state']),
                    'District'                  => trim($rows['district']), 
                    'City'                      => trim($rows['city']),
                    'Zone'                      => 0,
                    'Display Size'              => 0,
                    'Illumination Type'         => $illumination_type, //trim($rows['illumination_type']),
                    'Availability Start Date'   => '1753-01-01 00:00:00.000',
                    'Availability End Date'     => '1753-01-01 00:00:00.000',
                    'OD Media Type'             =>$media_category, //for category
                    'Sole Media ID'             =>$od_mediaID,
                    'Line No_'                  =>$lineNO,
                    'Latitude'                  =>0.0,
                    'Longitde'                  =>0.0,
                    'Landmark'                  =>'',
                    'Image File Name'           =>'',
                    'OD Media ID'               =>$category->{'OD Media UID'}, //for sub-category
                    'Quantity'                  =>trim($rows['quantity']),
                    'Length'                    =>0,
                    'Width'                     =>0,
                    'Total Area'                =>0,
                    'Rental'                    =>0,
                    'Rental Type'               =>0,
                    'Train Number'              =>$train_no,
                    'Train Name'                =>$train_name,
                    'Size Type'                 =>$size_type,  //trim($rows['size_type']),
                    'Duration'                  =>0,
                    'No Of Spot'                =>0,
                    'Lit Type'                  =>$lit_type 
                ]);
            }

            //$third=["media_category","media_sub_category","quantity","length","width","state","district","city","size_type","illumination_type"];
            // if(array_diff($third, $keys)==[] && array_diff($keys, $third)==[])
            // {
            //     dd("THIRD");
            // }
            $four=["media_category","media_sub_category","quantity","no_of_spot","state","district","city","size_type","illumination_type","lit_type"];
            if(array_diff($four, $keys)==[] && array_diff($keys, $four)==[])
            {
                // dd("FOUR");
                return new MediaCirculation([
                    'State'                     => trim($rows['state']),
                    'District'                  => trim($rows['district']), 
                    'City'                      => trim($rows['city']),
                    'Zone'                      => 0,
                    'Display Size'              => 0,
                    'Illumination Type'         => $illumination_type, //trim($rows['illumination_type']),
                    'Availability Start Date'   => '1753-01-01 00:00:00.000',
                    'Availability End Date'     => '1753-01-01 00:00:00.000',
                    'OD Media Type'             =>$media_category, //for category
                    'Sole Media ID'             =>$od_mediaID,
                    'Line No_'                  =>$lineNO,
                    'Latitude'                  =>0.0,
                    'Longitde'                  =>0.0,
                    'Landmark'                  =>'',
                    'Image File Name'           =>'',
                    'OD Media ID'               =>$category->{'OD Media UID'}, //for sub-category
                    'Quantity'                  =>trim($rows['quantity']),
                    'Length'                    =>0,
                    'Width'                     =>0,
                    'Total Area'                =>0,
                    'Rental'                    =>0,
                    'Rental Type'               =>0,
                    'Train Number'              =>0,
                    'Train Name'                =>'',
                    'Size Type'                 =>$size_type,  //trim($rows['size_type']),
                    'Duration'                  =>0,
                    'No Of Spot'                =>trim($rows['no_of_spot']),
                    'Lit Type'                  =>$lit_type 
                ]);
            }

            // $five=["media_category","media_sub_category","quantity","state","district","city","size_type","illumination_type"];
            // if(array_diff($five, $keys)==[] && array_diff($keys, $five)==[])
            // {
            //     dd("FIVE");
            // }

            $three=["media_category","media_sub_category","length","width","quantity","state","district","city","size_type","illumination_type","lit_type","train_name","train_no"];

            if(array_diff($three, $keys)==[] && array_diff($keys, $three)==[])
            {
                return new MediaCirculation([
                    'State'                     => trim($rows['state']),
                    'District'                  => trim($rows['district']), 
                    'City'                      => trim($rows['city']),
                    'Zone'                      => 0,
                    'Display Size'              => 0,
                    'Illumination Type'         => $illumination_type, //trim($rows['illumination_type']),
                    'Availability Start Date'   => '1753-01-01 00:00:00.000',
                    'Availability End Date'     => '1753-01-01 00:00:00.000',
                    'OD Media Type'             =>$media_category, //for category
                    'Sole Media ID'             =>$od_mediaID,
                    'Line No_'                  =>$lineNO,
                    'Latitude'                  =>0.0,
                    'Longitde'                  =>0.0,
                    'Landmark'                  =>'',
                    'Image File Name'           =>'',
                    'OD Media ID'               =>$category->{'OD Media UID'}, //for sub-category
                    'Quantity'                  =>trim($rows['quantity']),
                    'Length'                    =>trim($rows['length']),
                    'Width'                     =>trim($rows['width']),
                    'Total Area'                =>trim($rows['length']) * trim($rows['width']),
                    'Rental'                    =>0,
                    'Rental Type'               =>0,
                    'Train Number'              =>$train_no,
                    'Train Name'                =>$train_name,
                    'Size Type'                 =>$size_type,  //trim($rows['size_type']),
                    'Duration'                  =>0,
                    'No Of Spot'                =>0,
                    'Lit Type'                  =>$lit_type 
                ]);
            }
            else
            {
                dd("Wrong File");
            }
            
        }

    }


