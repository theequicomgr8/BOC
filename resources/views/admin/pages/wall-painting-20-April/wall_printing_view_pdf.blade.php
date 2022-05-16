@extends('admin.layouts.wallayout')
@section('content')
   <head>
      <title>Wall Painting</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="{{ asset('theme/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

      <style>
         .container {
         width: 70%;
         height: 50%;
         }
      </style>
   </head>
   <body>
      <div class="container pt-4 canvas_div_pdf">
         <h4 class="text-left"><u>Evaluation of technical bid for wall painting / Digital wall painting</u> <a href="javascript:void(0)" id="download" style="background:#2b414d; color:rgb(255, 254, 254); text-decoration:none; font-size:16px; border-radius: 15px; font-family: sans-serif; padding:8px 20px; text-transform: uppercase;"></a> <a href="{{ route('wallPainting-export-pdf') }}" class="btn btn-success btn-sm">Download</a></h4><br>
         <p>A. Detail of company<a href="{{ URL::to('wallPainting') }}" title="Home" class="pull-right"><i class="fa fa-home" style="font-size:30px;"></i></a></p>
         @if(session('msg'))
            <div class="alert alert-success" role="alert">
                {{session('msg')}}
            </div>
          @endif
         <form Method="post" action="{{ url('/company-details') }}" enctype="multipart/form-data" id="company_details">
         @csrf
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th width="80">S No.</th>
                  <th>Description</th>
                  <th colspan ="4">Documents</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>1</td>
                  <td>Name of Agency <font class="text-danger">*</font></td>
                  <td colspan ="4">
                     <div>
                        <label for="">{{ @$wall_print_data->name_of_agency }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2</td>
                  <td>Bid Security declaration</td>
                  <td colspan ="4">
                     <label for="">
                     {{ @$wall_print_data->bid_security_declaration == 1 ? "YES" : "NO" }}
                     </label>
                  </td>
               </tr>
               <tr>
                  <td>3</td>
                  <td>Head office with tel no.email</td>
                  <td colspan ="4">
                     <div>
                        <label for="">{{ @$wall_print_data->head_office_telphone_email }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>4</td>
                  <td>Ownership documents permises / rent agrement and electricty bill of past six month</td>
                  <td colspan ="4">
                     <div>
                       <label for=""><a href="{{ asset('uploads/CompanyDetails/'.$wall_print_data->ownership_document_rent_agreement) }}" target="_blank">View Document</a></label>

                        <!-- <a href="pdfname">View Document</a> -->
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>5</td>
                  <td>Branch office with tel no.</td>
                  <td colspan ="4">
                     <div>
                        <label for="">{{$wall_print_data->branch_telephone}}</label>
                     </div>
                  </td>
               </tr>

               <tr rowspan="2">
                  <td rowspan="6">6</td>
                  <td rowspan="6">Legal Status of company</td>
                  <th colspan ="3">Document</th>
                  <th>Yes/No</th>
               </tr>
               <tr>
                  <td colspan ="3">1. Certificate Of Incorporation:</td>
                  <td>
                     <div>
                        <label>{{@$wall_print_data->certificate_incorporation==1?"YES":"NO"}}
                        </label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">2. GST Registration Certificate:</td>
                  <td>
                     <div class="form-group">
                     <label>{{@$wall_print_data->gst_certificate == 1 ? "YES" :"NO"}}
                        </label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">3. PAN/TAN Card:</td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->Pan_tan_card==1 ? "YES" : "NO"}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">4. Registration of Startup:</td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->registration_startup == 1 ? "YES" : "NO"}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">5. Any Other document:</td>
                  <td>
                     <div class="form-group">
                        <label for="">{{ $wall_print_data->other_document == 1 ? "YES" : "NO" }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>7</td>
                  <td>Area of work (name of state/city)</td>
                  <td colspan ="4">
                     <div class="form-group">
                        <label for="">{{ $wall_print_data->area_work_name_state_city }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="2">8</td>
                  <td rowspan="2">Details of past work executed (state wise)- 50,0000 sq.ft each state for wall painting</td>
                  <td colspan ="4">
                     <div class="form-group">
                        <label for="">{{ $wall_print_data->details_of_past_work_wall_painting }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="4">
                     <div class="form-group">
                        <label for="">{{ $wall_print_data->details_of_past_work_digital_painting }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="2">9</td>
                  <td rowspan="2">Total Year of experience in wall painting / Digital Wall Painting in applied state / s</td>
                  <td colspan="4">
                     <div class="form-group">
                        <label for="">{{ $wall_print_data->details_of_past_work_wall_painting }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="4">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->total_years_exp_digital_painting}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="12">10</td>
                  <td rowspan="12">Annual trurn over of FY 2019-20 and 2020-21 (notarized copy of annual return / CA certified return)</td>
                  <td rowspan="3">a. FY 2019-20</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group">
                       <label for="">{{ $wall_print_data->annual_turn_2019_20_wp }}</label>
                     </div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{ $wall_print_data->annual_turn_2019_20_dwp }}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="3">b. FY 2020-21</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->annual_turn_2020_21_wp}}</label>
                     </div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->annual_turn_2020_21_dwp}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="3">b. FY 2021-22</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->annual_turn_2021_22_wp}}</label>
                     </div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->annual_turn_2021_22_dwp}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="3">c. If Statup, DPIIT Certificate no.</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->startup_certificate_wp}}</label>
                     </div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                    <div class="form-group">
                        <label for="">{{$wall_print_data->startup_certificate_dwp}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="5">11</td>
                  <td rowspan="5">work order of past three years (wall painting only)</td>
                  <td>F Year</td>
                  <td>Area Of Painting (in sq.ft)</td>
                  <td>Amount in Rs.</td>
                  <td>WP/DWP not specified</td>
               </tr>
               <tr>
                  <td>2018-19</td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2018_19_area_of_painting}}</label>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                       <label for="">{{$wall_print_data->work_past_three_2018_19_amt_rs}}</label>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2018_19_wp_dwp}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2019-20</td>
                  <td>
                     <div class="form-group">
                       <label for="">{{$wall_print_data->work_past_three_2019_20_area_of_painting}}</label>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2019_20_amt_rs}}</label>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                       <label for="">{{$wall_print_data->work_past_three_2019_20_wp_dwp}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2020-21</td>
                  <td>
                     <div class="form-group">
                       <label for="">{{$wall_print_data->work_past_three_2020_21_area_of_painting}}</label>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2020_21_amt_rs}}</label>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2020_21_wp_dwp}}</label>
                     </div>
                  </td>
               </tr>
               <td>2021-22</td>
               <td>
                  <div class="form-group">
                    <label for="">{{$wall_print_data->work_past_three_2021_22_area_of_painting}}</label>
                  </div>
               </td>
               <td>
                  <div class="form-group">
                    <label for="">{{$wall_print_data->work_past_three_2021_22_amt_rs}}</label>
                  </div>
               </td>
               <td>
                  <div class="form-group">
                     <label for="">{{$wall_print_data->work_past_three_2021_22_wp_dwp}}</label>
                  </div>
               </td>
               </tr>
               <tr>
                  <td rowspan="5">12</td>
                  <td rowspan="5">work order of past three years (wall painting only)</td>
                  <td>F Year</td>
                  <td>Area Claimed as painted</td>
                  <td colspan="2">Area Matcked with GST</td>
               </tr>
               <tr>
                  <td>2018-19</td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2018_19_area_claimed}}</label>
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2018_19_area_gst}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2019-20</td>
                  <td>
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2019_20_area_claimed}}</label>
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2019_20_area_gst}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2020-21</td>
                  <td>
                     <div class="form-group">
                       <label for="">{{$wall_print_data->work_past_three_2020_21_area_claimed}}</label>
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2020_21_area_gst}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2021-22</td>
                  <td>
                     <div class="form-group">
                       <label for="">{{$wall_print_data->work_past_three_2021_22_area_claimed}}</label>
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->work_past_three_2021_22_area_gst}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="2">13</td>
                  <td rowspan="2">Painting Printing capacity of the campany - Own Printing machine /Vendor (Proof of own machine /Vendor)</td>
                  <td colspan="2">Own Printing machine:<br />
                     <b>a.</b> Premises Ownership/Rent agrement<br />
                     <b>b.</b> Machine details with purchage invoice
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->owner_printing_machine}}</label>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan="2">Agreement with other vendor: <br />
                     <b> a.</b> Copy of agrement <br />
                     <b> b.</b> copeis of bill
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <label for="">{{$wall_print_data->agreement_with_vendor}}</label>
                     </div>
                  </td>
               </tr>
                <!-- <tr>
                  <td colspan="6">
                     <div class="form-group">
                        <button class="btn btn-info">Print</button>
                     </div>
                  </td>
               </tr> -->
            </tbody>
         </table>
         <form>
      </div>
<script>
    setTimeout(function() {
        $('.alert-success').fadeOut("slow");

    }, 3000);
</script>
@endsection
