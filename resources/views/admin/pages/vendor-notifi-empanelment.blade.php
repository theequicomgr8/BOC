@extends('admin.layouts.layout')
<style>
  <?php
    $start_date = date("d-m-y",strtotime(@$advisiory->start_date));
    $end_date = date("d-m-y",strtotime(@$advisiory->end_date));
    $publish_date = date("d-m-y",strtotime(@$advisiory->publish_date));
    $boc_ftp_path = $dbresponse->boc_ftp_path;
  ?>
body{color: #6c757d !important;}
div#to {margin-right: 16px;}
label:not(.form-check-label):not(.custom-file-label) {font-weight: 500!important;}
@media (min-width: 768px){.col-md-2 {
   max-width: 13.666667%!important;
   }
 }
</style>
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <!--<h1>Application Form for Fresh Empanelment of Newspaper</h1>-->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <div class="row">
          <div class="col-md-12">
            <div class="card card-default">  
            <div class="card-header">
            <h3 class="card-title">Vendor Notification Empanelment</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
              <!-- /.end card-header -->            
              <div class="card-body p-0">
                <div class="bs-stepper">
                  <div style="padding:15px; 35px;" class="bs-stepper-content">
                    <h5>Notification:-</h5>
                      <form action="" method="post">
                      	<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="Name">Title Subject / शीर्षक विषय*</label>
                              <input type="text" class="form-control" name="title_sub" id="title_sub" placeholder="Title Subject" readonly value="{{@$advisiory->Title_Subject}}">
                            </div>
                          </div>
                         <!--  <div class="col-md-6">
                            <div class="form-group">
                              <label for="Name">Start date / आरंभ करने की तिथि*</label>
                              <input type="text" class="form-control" id="start_date" readonly value="{{@$advisiory->start_date}}">
                            </div>
                          </div> -->
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="Name">Start date / आरंभ करने की तिथि*</label>
                              <input type="text" class="form-control" id="start_date" readonly value="{{@$start_date}}">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="Name">End date / समाप्ति तिथि*</label>
                              <input type="text" class="form-control" id="end_date" readonly value="{{@$end_date}}">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="Name">Publish date / प्रकाशित तिथि*</label>
                              <input type="text" class="form-control" id="Publish_date" readonly value="{{@$publish_date}}">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="Name">Attatchment / अनुरक्ति*</label>
							  <a target="_blank" href="http://52.172.8.254:8080/BOC_web/pdf/whats_new/Adv13421682021.pdf">View</a>
                              <!--<input type="text" class="form-control" id="file" readonly value="{{@$boc_ftp_path}}">-->
                            </div>
                          </div>
                			  </div>
                      </form>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->       
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
@endsection
@section('custom_js')
@endsection