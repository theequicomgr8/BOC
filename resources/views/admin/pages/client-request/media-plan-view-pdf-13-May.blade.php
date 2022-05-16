<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Media Request Application Receipt</title>
    <style>
      body{
    color: #6c757d !important;
    font-size:12px;
  }
  tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tree {
            page-break-inside: avoid;
        }
.text-size{
  text-size:10px;
}
table, th, td {
  border:1px solid #dee2e6;
  border-collapse: collapse;
}
    </style>
</head>
@php 

$results=isset($npLists)? $npLists:'';

$mpdetail='';
$mpdetail=isset($mpdetails)? $mpdetails:''; 
if($mpdetail->{'Cl Approval Received'}==1){
$disabled='disabled';
}else{
$disabled='';

}
@endphp 
<body>
    <div class="card-body">
     <div class="table-responsive">
     <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%"> 
     <thead>
      <tr>
            <td align="center" colspan="7"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                <p><strong>GOVERNMENT OF INDIA <br />
                        BUREAU OF OUTREACH & COMMUNICATION<br />
                        Ministry of Information & Broadcasting</strong><br />
                    Phase IV, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                </p>
            </td>
        </tr>
        
    </thead>
    </table>
    <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%"> 
    
     <thead>
         <tr><th colspan="8" style="float: right;"><h4>MEDIA PLAN - {{$mpdetail->{'MP No_'} }}</h4>  </th></tr>
      <tr>
          <td colspan="2"><b>Request No.</b></td>
          <td colspan="2">{{ $mpdetail->{'Client Request Code'} }}</td>
          <td colspan="2"><b>Language List</b></td>
          <td colspan="2">{{ $mpdetail->{'Language List'}? $mpdetail->{'Language List'}:'NA' }}</td> 
        </tr>
        <tr>
          <td colspan="2"><b>MP No.</b></td>
          <td colspan="2">{{ $mpdetail->{'MP No_'} }}</td>
          <td colspan="2"><b>Language</b></td>
          @if(@$mpdetail->{'Language'} ==0)      
                        <td colspan="2">{{ 'Single' }} </td>
                      @elseif(@$mpdetail->{'Language'} ==1)
                        <td colspan="2"> {{ 'Multiple' }} </td>
                      @elseif(@$mpdetail->{'Language'} ==2)
                        <td colspan="2"> {{ 'Hindi & English' }} </td>
                      @elseif(@$mpdetail->{'Language'} ==3) 
                        <td colspan="2"> {{ 'State Language Preference' }} </td>
                        @else
                        <td colspan="2"></td>
                      @endif
        </tr>
        <tr>
          <td colspan="2"><b>Ministry</b></td>
          <td colspan="2">{{ $mpdetail->Ministry }}</td>
          <td colspan="2"><b>Print Size</b></td>
          @php  $printsize = ''; @endphp
          @if(@$mpdetail->{'Print Size Selection'} ==0)      
                       $printsize = 'Custom Size';
                      @elseif(@$mpdetail->{'Language'} ==1)
                      $printsize =  'Half Page';
                      @elseif(@$mpdetail->{'Language'} ==2)
                      $printsize =  'Full Page';
                      @else
                      $printsize = '';
                      @endif
                      <td colspan="2">{{$printsize ?? 'N/A'}}</td>
        </tr>
        <tr>
          <td colspan="2"><b>Ministry Head</b></td>
          <td colspan="2">{{ @$mpdetail->{'Client Name'} ?@$mpdetail->{'Client Name'}:'NA'}}</td>
          <td colspan="2"><b>Color</b></td>
          @if($mpdetail->Color == 0)      
                        <td colspan="2">{{ 'Color' }} </td>
                      @elseif($mpdetail->Color == 1) 
                        <td colspan="2"> {{ 'B/W' }} </td>
                        @else 
                        <td colspan="2"></td>
                      @endif 
        </tr>
        <tr>
          <td colspan="2"><b>Target Area</b></td>
          @if(@$mpdetail->{'Target Area'} ==0)      
                        <td colspan="6">{{ 'Pan India' }} </td>
                      @elseif(@$mpdetail->{'Target Area'} ==1)
                        <td colspan="6"> {{ 'Individual State' }} </td>
                      @elseif(@$mpdetail->{'Target Area'} ==2)
                        <td colspan="6"> {{ 'Group of States' }} </td>
                      @elseif(@$mpdetail->{'Target Area'} ==3) 
                        <td colspan="6"> {{ 'Cities' }} </td>
                        @else
                        <td colspan="6"></td>
                      @endif 
        </tr>
        <tr>
          <td colspan="2"><b>Plan Budget</b></td>
          <td colspan="2">{{ @$mpdetail->{'Plan Budget'} ? @round(@$mpdetail->{'Plan Budget'}):'NA'}}</td>
          <td colspan="2"><b>Actual Amount</b></td>
          @php
                     $amt=array();
                     foreach($results as $res){
                     $amt[]=$res->Amount;}
                    @endphp
          <td colspan="2">{{ array_sum($amt) }}</td> 
        </tr>
        <tr><th colspan="8"><h4>Selected News Papers</h4>  </th></tr>
        <tr>
                  <th scope="col" >S.No</th>
                  <th scope="col" >NP Code</th>
                  <th scope="col" >NP Name</th>
                  <th scope="col" >Language</th>
                  <th scope="col" >State Name</th>
                  <th scope="col" >City</th>
                  <th scope="col" >Category</th>
                   <th scope="col" >Amount</th> 
                </tr>
        </thead>
        <tbody>
        @forelse($results as $key=>$result)
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ @$result->{'NP Code'} }} </td>
                      <td>{{ @$result->{'NP Name'}  }} </td> 
                      <td>{{ @$result->{'Language'}  }} </td> 
                      <td>{{ @$result->{'State Name'}  }} </td>
                      <td>{{ @$result->{'City'}  }} </td>
                      @if(@$result->{'Category'}==0)
                      <td>{{ 'B'  }} </td>
                      @elseif(@$result->{'Category'}==1)
                       <td>{{ 'M'  }} </td>
                       @elseif(@$result->{'Category'}==2)
                       <td>{{ 'S'  }} </td>
                       @endif
                       <td>{{ @round(@$result->{'Amount'})  }} </td> 

                    </tr>
                  @empty
                      <tr style="background:silver"><td colspan="7" ><strong style="padding-left: 279px;">No Data</strong></td></tr>
                  @endforelse
          </tbody>
        </table>
        <br />
        <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%"> 
     <thead>
      <tr>
            <td clospan="4"><b>Agree/Return With Comment:</b></td>
            @if($mpdetail->{'Cl Approval Received'}==1)
            @if(@$mpdetail->{'Client Consent'}==0)
            <td clospan="4">Agree</td>
            @elseif(@$mpdetail->{'Client Consent'}==1)
            <td clospan="4">Return With Comment</td>  
            @else 
            <td clospan="4">N/A</td>
            @endif  
            @else  
            <td clospan="4">N/A</td>
            @endif 
        </tr>
    </thead>
    </table>
      </div>
    </div>

</body>

</html>