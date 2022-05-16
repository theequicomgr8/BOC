@extends('admin.layouts.layout')

@section('content')
<style>
    .main-footer{
        margin-left: 4px !important;
    }
</style>
<div class="content-wrapper">
    <!-- <link href="{{asset('arogi/css/home_standard.css')}}" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="{{asset('arogi/css/bootstrap.css')}}" rel="stylesheet" /> -->
    <!-- <link href="{{asset('arogi/css/bootstrap-responsive.css')}}" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" href="{{asset('arogi/css/jquery-ui.css')}}" type="text/css" /> -->
    <link href="{{asset('arogi/css/override_style.css')}}" rel="stylesheet" />
    <!-- <script src="{{asset('arogi/js/jquery-1.8.2.js')}}" type="text/javascript"></script> -->
    <!-- <script src="{{asset('arogi/js/jquery-ui.js')}}" type="text/javascript"></script> -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">ROB Dashboard</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <!-- <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol> -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="row form-actions float-right">
                <h4><span class="btn btn-success "><a href="/rob-form-one" style="list-style: none; color: white;">Add New</a></span></h4>
            </div>



    <!-- <TABLE id="Table1" style="WIDTH: 100%;" cellSpacing="0" cellPadding="0" align="center" border="0">
        <TR>
            <TD width="100%">
                <div id="header">
                
                    <div><img src="{{asset('arogi/images/banner_BOC.jpg')}}" border="0" alt="DAVP Banner" style="width:100%" /></div>
                </div>
            </TD>
        </TR>
    </TABLE> -->
    

    

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Theme</th>
                            <th>Name of Village</th>
                            <th>Funds Allocated</th>
                            <th>Name Of The Officer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;    
                        @endphp
                        @foreach ($data as $item)
                            
                        
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$item->sop_theme}}</td>
                            <td>{{$item->village_name}}</td>
                            <td>{{$item->allocated_funds}}</td>
                            <td>{{$item->officer_name}}</td>
                            <td>
                                <a href="alllist/{{$item->Pk_id}}" class="btn btn-info" id="view">View</a>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>

</div>
</div>
</div>
</section>

<!-- <script src="{{asset('arogi/js/jquery-1.8.2.js')}}" type="text/javascript"></script>
<script src="{{('arogi/js/jquery-ui.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/custom.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/datafetch.js')}}" type="text/javascript"></script> -->
@endsection



