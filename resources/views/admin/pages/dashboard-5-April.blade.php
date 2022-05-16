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
                        <div class="card c1 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c1-txt text-uppercase mb-1 module-name">Client Request List</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('client-submission-list') }}">See List <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c2 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c2-txt text-uppercase mb-1 module-name">Add Client Request</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('client-submission-form') }}">Add Request <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     
                    <!-- <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c3 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c3-txt text-uppercase mb-1 module-name">Media Plan List</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('media-plan') }}">See List <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    @endif


                     @if(Session::get('UserType')==1)
                     <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c4 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c4-txt text-uppercase mb-1 module-name">Add Print Fresh Empanelment</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('fresh-empanelment') }}" > Add <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-print fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c5 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c5-txt text-uppercase mb-1 module-name"> Vendor Print Empanelment Renewal</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('print-renewal') }}" > Add <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-print fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($user_id != 'EMRUY3')
                     <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c6 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c6-txt text-uppercase mb-1 module-name">  Add Outdoor Personal Media</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('personal-list') }}" > Add <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-bullhorn fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c7 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c7-txt text-uppercase mb-1 module-name">  Renewal Outdoor Personal Media</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('personal-renewal') }}" > Add <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-bullhorn fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c8 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c8-txt text-uppercase mb-1 module-name">  Add Outdoor Private Media</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('rate-settlement-private-media') }}" > Add <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-tv fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c9 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c9-txt text-uppercase mb-1 module-name">  Add Outdoor Sole Right Media</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('sole-right-list') }}" > Add <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name"> Add Pvt. FM</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('fm-radio-station') }}" > Add <i class="fa fa-angle-right" aria-hidden="true"></i></a>    
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c25 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c25-txt text-uppercase mb-1 module-name"> Add AV-TV</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('form-type') }}" > Add <i class="fa fa-angle-right" aria-hidden="true"></i></a>    
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c15 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c15-txt text-uppercase mb-1 module-name"> Add  AV Producers</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('audio') }}" > Add <i class="fa fa-angle-right" aria-hidden="true"></i></a>    
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                      <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c17 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c17-txt text-uppercase mb-1 module-name"> Add Community Radio Station</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('community-radio-station') }}" > Add <i class="fa fa-angle-right" aria-hidden="true"></i></a>    
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                     
                   

                    @endif
                    @if(Session::get('UserType')==2)
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">ROB Activity List</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('roblist') }}">See List <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">FOB Activity List</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('rob-fob-list') }}">See List <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c11 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c11-txt text-uppercase mb-1 module-name">Add ROB</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('rob-form-one') }}"> Add <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    @endif


                     @if(Session::get('UserType')==3)
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c10 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c10-txt text-uppercase mb-1 module-name">FOB Activity List</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('roblist') }}">See List <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card c11 shadow h-100 py-2 hvr-pop">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold c11-txt text-uppercase mb-1 module-name">Add FOB</div>
                                        <div class="text-xs font-weight-bold mb-1"><a class="text-gray-800" href="{{ url('rob-form-one') }}"> Add <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    @endif

            </div><!-- end row-->

@endsection