@extends('admin.layouts.wallayout')

@section('content')

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Wall Painting</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="{{ asset('theme/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <style>
         .container {
         width: 70%;
         height: 50%;
         }
      </style>
   </head>
   <body>
      <div class="container pt-4">
         <h4 class="text-left"><u>Evaluation of technical bid for wall painting / Digital wall painting</u></h4><br>
         <p>A. Detail of company<a href="{{URL::to('wallPainting')}}" title="Home" class="pull-right"><i class="fa fa-home" style="font-size:30px;"></i></a></p>


         <form Method="post" action="{{url('/wall-painting')}}" enctype="multipart/form-data" id="company_details">
         @csrf
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th class="col-1">S No.</th>
                  <th class="col-3">Description</th>
                  <th colspan ="4">Documents</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>1</td>
                  <td>Name of Agency <font class="text-danger">*</font></td>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm"  name="name_of_agency" placeholder="Please enter agency name" required="required">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2</td>
                  <td>Bid Security declaration</td>
                  <td colspan ="4">Annexure "A" - Yes/No
                     <label class="form-check-label ml-4">
                     <input type="radio"  class="form-check-input" name="bid_security_declaration" value="1">Yes
                     </label>
                     <label class="form-check-label ml-4">
                     <input type="radio" class="form-check-input" name="bid_security_declaration" value="0">No
                     </label>
                  </td>
               </tr>
               <tr>
                  <td>3</td>
                  <td>Head office with tel no.email</td>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="text" name="head_office_telphone_email" class="form-control form-control-sm" placeholder="Please enter Head office with tel no.email">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>4</td>
                  <td>Ownership documents permises / rent agrement and electricty bill of past six month</td>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="file" name="ownership_document_rent_agreement" class="form-control form-control-sm" placeholder="">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>5</td>
                  <td>Branch office with tel no.</td>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="text" name="branch_telephone" maxlength="10" class="form-control form-control-sm" placeholder="Please enter Branch office with tel no.">
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
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="certificate_incorporation" id="sel1">
                           <option value="">Select options</option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">2. GST Registration Certificate:</td>
                  <td>
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="gst_certificate" id="sel1">
                           <option value="">Select options</option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">3. PAN/TAN Card:</td>
                  <td>
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="Pan_tan_card" id="sel1">
                           <option value="">Select options</option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">4. Registration of Startup:</td>
                  <td>
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="registration_startup" id="sel1">
                           <option value="">Select options</option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">5. Any Other document:</td>
                  <td>
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="other_document" id="sel1">
                           <option value="">Select options</option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>7</td>
                  <td>Area of work (name of state/city)</td>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="area_work_name_state_city" placeholder="Please enter Area of work (name of state/city)">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="2">8</td>
                  <td rowspan="2">Details of past work executed (state wise)- 50,0000 sq.ft each state for wall painting</td>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="details_of_past_work_wall_painting" placeholder="Please enter Wall painting">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="details_of_past_work_digital_painting" placeholder="Please enter Digital wall painting">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="2">9</td>
                  <td rowspan="2">Total Year of experience in wall painting / Digital Wall Painting in applied state / s</td>
                  <td colspan="4">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="total_years_exp_wall_painting" placeholder="Please enter Wall painting">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="total_years_exp_digital_painting" placeholder="Please enter Digital wall painting">
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
                     <div class="form-group"><input type="text" name="annual_turn_2019_20_wp" class="form-control form-control-sm" placeholder="Please enter Rs."  onkeypress="return onlyNumberKey(event)"></div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" name="annual_turn_2019_20_dwp" class="form-control form-control-sm" placeholder="Please enter Rs."
                     	 onkeypress="return onlyNumberKey(event)"></div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="3">b. FY 2020-21</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" name="annual_turn_2020_21_wp" class="form-control form-control-sm" placeholder="Please enter Rs."
                     	 onkeypress="return onlyNumberKey(event)"></div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" name="annual_turn_2020_21_dwp" class="form-control form-control-sm" placeholder="Please enter Rs."
                     	 onkeypress="return onlyNumberKey(event)"></div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="3">b. FY 2021-22</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" name="annual_turn_2021_22_wp" class="form-control form-control-sm" placeholder="Please enter Rs."
                     	 onkeypress="return onlyNumberKey(event)"></div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" name="annual_turn_2021_22_dwp" class="form-control form-control-sm" placeholder="Please enter Rs."
                     	 onkeypress="return onlyNumberKey(event)"></div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="3">c. If Statup, DPIIT Certificate no.</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" class="form-control form-control-sm" name="startup_certificate_wp" placeholder="Please enter Rs." onkeypress="return onlyNumberKey(event)"></div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" class="form-control form-control-sm"  name="startup_certificate_dwp" placeholder="Please enter Rs."
                     	 onkeypress="return onlyNumberKey(event)"></div>
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
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2018_19_area_of_painting" placeholder="Please enter Area Of Painting (in sq.ft)">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2018_19_amt_rs" placeholder="Please enter Amount in Rs.">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2018_19_wp_dwp" placeholder="Please enter WP/DWP not specified">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2019-20</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2019_20_area_of_painting" placeholder="Please enter Area Of Painting (in sq.ft)">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2019_20_amt_rs" placeholder="Please enter Amount in Rs.">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2019_20_wp_dwp" placeholder="Please enter WP/DWP not specified">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2020-21</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2020_21_area_of_painting" placeholder="Please enter Area Of Painting (in sq.ft)">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2020_21_amt_rs" placeholder="Please enter Amount in Rs.">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2020_21_wp_dwp" placeholder="Please enter WP/DWP not specified">
                     </div>
                  </td>
               </tr>
               <td>2021-22</td>
               <td>
                  <div class="form-group">
                     <input type="text" class="form-control form-control-sm" name="work_past_three_2021_22_area_of_painting" placeholder="Please enter Area Of Painting (in sq.ft)">
                  </div>
               </td>
               <td>
                  <div class="form-group">
                     <input type="text" class="form-control form-control-sm" name="work_past_three_2021_22_amt_rs" placeholder="Please enter Amount in Rs.">
                  </div>
               </td>
               <td>
                  <div class="form-group">
                     <input type="text" class="form-control form-control-sm" name="work_past_three_2021_22_wp_dwp" placeholder="Please enter WP/DWP not specified">
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
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2018_19_area_claimed" placeholder="Please enter Area Claimed as painted">
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2018_19_area_gst" placeholder="Please enter Area Matcked with GST">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2019-20</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2019_20_area_claimed" placeholder="Please enter Area Claimed as painted">
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2019_20_area_gst" placeholder="Please enter Area Matcked with GST">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2020-21</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2020_21_area_claimed" placeholder="Please enter Area Claimed as painted">
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2020_21_area_gst" placeholder="Please enter Area Matcked with GST">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2021-22</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2021_22_area_claimed" placeholder="Please enter Area Claimed as painted">
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2021_22_area_gst" placeholder="Please enter Area Matcked with GST">
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
                        <input type="text" class="form-control form-control-sm" name="owner_printing_machine" placeholder="Please enter Own Printing machine">
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
                        <input type="text" class="form-control form-control-sm" name="agreement_with_vendor" placeholder="Please enter Agreement with other vendor">
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
         <div class="row">
         	<div class="form-group col-9"></div>
         	 <div class="form-group col-3">
                <input type="submit" class="form-control form-control-sm btn btn-success" name="Print" id="submit_id" placeholder="Please enter Agreement with other vendor">
            </div>
         </div>

         <form>
      </div>
<script type="text/javascript">
	function onlyNumberKey(evt) {
    // Only ASCII character in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}
</script>
   </body>
</html>
@endsection
