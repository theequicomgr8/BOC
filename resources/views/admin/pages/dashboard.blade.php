@extends('admin.layouts.layout')

@section('content')
<?php $user_id = Session::get('UserID'); ?>
<div class="content-inside p-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-download" aria-hidden="true"></i> Generate Report</a> -->
    </div>


    <div class="row">
        @if(Session::get('UserType')==0)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('client-submission-list') }}">
            <div class="card c1 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c1-txt text-uppercase mb-1 module-name">Client Request List</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('client-submission-list') }}">See List <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('client-submission-form') }}">
            <div class="card c2 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c2-txt text-uppercase mb-1 module-name">Add Client Request</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('client-submission-form') }}">Add Request <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('media-plan') }}">
            <div class="card c3 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c3-txt text-uppercase mb-1 module-name">Media Plan List</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('media-plan') }}">See List <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>

        @endif


        @if(Session::get('UserType')==1)
        @if(Session::get('WingType')==3)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('fresh-empanelment') }}">
            <div class="card c4 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c4-txt text-uppercase mb-1 module-name">Fresh Empanelment</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('fresh-empanelment') }}"><i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-print fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('print-renewal') }}">
            <div class="card c5 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c5-txt text-uppercase mb-1 module-name"> Renewal</div>
                            <div class="text-xs font-weight-bold mb-1">
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-print fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        

 <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="#">
                <div class="card c4 shadow h-100 py-2 hvr-pop">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold c4-txt text-uppercase mb-1 module-name">Total Pendency With BOC</div>
                                <div class="text-xs font-weight-bold mb-1"> {{$price}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-inr fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @elseif(Session::get('WingType')==1)

        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('personal-list') }}">
            <div class="card c6 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c6-txt text-uppercase mb-1 module-name"> Personal Media Fresh Empanelment</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('personal-list') }}"> <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-bullhorn fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('personal-renewal') }}">
            <div class="card c7 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c7-txt text-uppercase mb-1 module-name"> Renewal Personal Media</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('personal-renewal') }}"> <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-bullhorn fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
         @elseif(Session::get('WingType')==2)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('rate-settlement-private-media') }}">
            <div class="card c8 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c8-txt text-uppercase mb-1 module-name"> Private Media Fresh Empanelment</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('rate-settlement-private-media') }}"><i class="fa fa-user-plus" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-tv fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
         @elseif(Session::get('WingType')==0)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('sole-right-list') }}">
            <div class="card c9 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c9-txt text-uppercase mb-1 module-name"> Sole Right Media Fresh Empanelment</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <!-- <a class="text-gray-800" href="{{ url('sole-right-list') }}"><i class="fa fa-user-plus" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        @elseif(Session::get('WingType')==5)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('fm-radio-station') }}">
            <div class="card c10 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name"> Pvt. FM Fresh Empanelment</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <a class="text-gray-800" href="{{ url('fm-radio-station') }}"> Add <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
         @elseif(Session::get('WingType')==4)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('form-type') }}">
            <div class="card c25 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c25-txt text-uppercase mb-1 module-name"> AV-TV Fresh Empanelment</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <a class="text-gray-800" href="{{ url('form-type') }}"> Add <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
         @elseif(Session::get('WingType')==7)
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('audio') }}">
            <div class="card c15 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c15-txt text-uppercase mb-1 module-name"> AV Producers Fresh Empanelment</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <a class="text-gray-800" href="{{ url('audio') }}"> Add <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-gray-800" href="{{ url('community-radio-station') }}">
            <div class="card c17 shadow h-100 py-2 hvr-pop">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold c17-txt text-uppercase mb-1 module-name"> Community Radio Station Fresh Empanelment</div>
                            <div class="text-xs font-weight-bold mb-1">
                                <a class="text-gray-800" href="{{ url('community-radio-station') }}"> Add <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        @endif
        @endif
        @if(Session::get('UserType')==2)
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-gray-800" href="{{ url('roblist') }}">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">ROB Post Activity List</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                            <!-- <a class="text-gray-800" href="{{ url('roblist') }}">See Activity List <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                    <!--  FOR ROB PRE LIST -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-gray-800" href="{{ url('preroblist') }}">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">ROB Pre Activity List</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                            <!-- <a class="text-gray-800" href="{{ url('preroblist') }}">See Activity List <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-gray-800" href="{{ url('rob-fob-list') }}">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">FOB Post Activity List</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                            <!-- <a class="text-gray-800" href="{{ url('rob-fob-list') }}">See List <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>

                     
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-gray-800" href="{{ url('rob-form-type') }}">
                        <div class="card c11 shadow h-100 py-2 hvr-pop"><!-- rob-form-one -->
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c11-txt text-uppercase mb-1 module-name">Add ROB's Activity</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                            <!-- <a class="text-gray-800" href="{{ url('rob-form-type') }}"> Add Activity <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>

                <iframe width="1024" height="612" src="https://app.powerbi.com/view?r=eyJrIjoiNWIwNjAzYTYtZWY1Yi00NjgzLTgwYTctMjVhNTU5ZWNlYzAyIiwidCI6Ijg5OTIxMGU2LTlmNTYtNDkyMS1hNTIxLWJiZjhlNzlmOWM5ZCJ9&pageName=ReportSection" frameborder="0" allowFullScreen="true"></iframe>  
                    @endif


                     @if(Session::get('UserType')==3)
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-gray-800" href="{{ url('fob-list') }}">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">FOB's Post Activity List</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                            <!-- <a class="text-gray-800" href="{{ url('fob-list') }}">See Activity List <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>


                    <!--  FOR FOB PRE LIST -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-gray-800" href="{{ url('preroblist') }}">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">FOB's Pre Activity List</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                            <!-- <a class="text-gray-800" href="{{ url('preroblist') }}">See Activity List <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>

                     
                    <div class="col-xl-3 col-md-6 mb-4"> <!--  rob-form-one -->
                        <a class="text-gray-800" href="{{ url('rob-form-type') }}">
                        <div class="card c11 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c11-txt text-uppercase mb-1 module-name">Add FOB's Activity</div>
                                        <div class="text-xs font-weight-bold mb-1">
                                            <!-- <a class="text-gray-800" href="{{ url('rob-form-type') }}"> Add Activity <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>  
                    @endif

    </div><!-- end row-->

    @endsection