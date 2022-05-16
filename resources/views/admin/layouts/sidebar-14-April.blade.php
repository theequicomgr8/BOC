<nav id="sidebar">
  <div class="sidebar-header">
    <!--<h3>Bootstrap Sidebar </h3>-->
    <h3 class="inside-logo"><img class="logo" style=' {{ strlen(Session::get('HeadName')) >27 ? "vertical-align: bottom ": "vertical-align: middle"}}' src="{{asset('theme/images/logo-s.png')}}" /> <span class="mt-3">@if(Session::has('HeadName'))
        {{ Session::get('HeadName')}}
        @endif</span></h3>
  </div>

  <div class="p-3">
    <i class="fa fa-fw fa-align-left"></i> My Menu</p>
    @if(Session::get('UserType')==0)
      <a href="{{url('client-submission-list')}}"><i class="fa fa-fw fa-home"></i>Dashboard</a>
    @else
      <a href="{{url('dashboard')}}"><i class="fa fa-fw fa-home"></i>Dashboard</a>
    @endif


    

    <ul class="list-unstyled components mb-5">
      @if(Session::get('UserType')==0)
      <li>
        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user" aria-hidden="true"></i> Media Request</a>
        <ul class="collapse list-unstyled" id="homeSubmenu">
          <li>
            <a href="{{ url('client-submission-list') }}"><i class="fa fa-undo" aria-hidden="true"></i> View Previous Requests</a>
          </li>
          <li>
            <a href="{{ url('client-submission-form') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Add New Request</a>
          </li>
        </ul>
      </li>
      <li><a href="{{ url('fundstatus') }}"><i class="fa fa-inr" aria-hidden="true"></i> Fund Status</a></li>
      <!-- <li>
        <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-print" aria-hidden="true"></i> Plan Estimate</a>
        <ul class="collapse list-unstyled" id="homeSubmenu2">
          <li>
            <a href="{{ url('media-plan') }}"> <i class="fa fa-angellist" aria-hidden="true"> </i> Print Media Plan List</a>
          </li>
          <li>
            <a href="{{ url('ODMediaPlan') }}"> <i class="fa fa-angellist" aria-hidden="true"> </i> Outdoor Media Plan List</a>
          </li>

          <li>
            <a href="#homeSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-print" aria-hidden="true"></i> TV Plan Estimate</a>
            <ul class="collapse list-unstyled" id="homeSubmenu3">
              <li>
                <a href="{{ url('tvMediaPlan') }}"><i class="fa fa-angellist" aria-hidden="true"></i> List</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#homeSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-print" aria-hidden="true"></i> CRS & Radio Plan Estimate</a>
            <ul class="collapse list-unstyled" id="homeSubmenu4">
              <li>
                <a href="{{ url('radioMediaPlan') }}"><i class="fa fa-angellist" aria-hidden="true"></i> List</a>
              </li>
            </ul>
          </li>
        </ul>
      </li> -->
      @endif

      @if(Session::get('UserType')==2)
      <li>
        <a href="{{ url('roblist') }}" class="nav-link">
          <i class="fa fa-angellist" aria-hidden="true"></i>
          Activity list
          </p>
        </a>
      </li>
      @endif
      
      @if(Session::get('UserType')==1)
      <li>
        <a href="#Empanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>Vendor Empanelment</a>

        <ul class="collapse list-unstyled" id="Empanelment">
          <li>
            <a href="#new-empanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
              <i class="fa fa-leaf" aria-hidden="true"></i>New
            </a>
            <ul class="collapse list-unstyled" id="new-empanelment">
              <!-- Fresh Empanelment -->
              @if(Session::get('WingType')=='M001')
              <li>
                <a href="#print-empanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                  <i class="fa fa-television" aria-hidden="true"></i> Print</a>
                <ul class="collapse list-unstyled" id="print-empanelment">
                  <li>
                    <a href="{{ url('fresh-empanelment') }}"><i class="fa fa-print"></i>Add Print Fresh Empanelment</a>
                  </li>
                </ul>
              </li>
              @endif
              @if(Session::get('WingType')=='M003')
              <li>
                <a href="#outdoor-empanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                  <i class="fa fa-map-signs" aria-hidden="true"></i> Outdoor Empanelment</a>
                <ul class="collapse list-unstyled" id="outdoor-empanelment">
                  <li>
                    <a href="{{ url('personal-list') }}"><i class="fa fa-user-plus"></i> Add Personal Media</a>
                  </li>
                  <li>
                    <a href="{{ url('rate-settlement-private-media') }}"><i class="fa fa-user-plus"></i> Add Private Media</a>
                  </li>
                  <li>
                    <a href="{{ url('sole-right-list') }}"><i class="fa fa-user-plus"></i> Add Soleright Media</a>
                  </li>

                </ul>
              </li>

              @endif
              @if(Session::get('WingType')=='M002')
              <li>
                <a href="#av-empanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                  <i class="fa fa-television" aria-hidden="true"></i> AV Empanelment</a>
                <ul class="collapse list-unstyled" id="av-empanelment">
                  <li>
                    <a href="{{ url('fm-radio-station') }}"><i class="fa fa-user-plus"></i> Add Pvt. FM</a>
                  </li>
                  <li>
                    <a href="{{ url('form-type') }}"><i class="fa fa-user-plus"></i> Add AV-TV</a>
                  </li>
                  <li>
                    <a href="{{ url('audio') }}"><i class="fa fa-user-plus"></i> Add AV Producers</a>
                  </li>
                  <li>
                    <a href="{{ url('community-radio-station') }}"><i class="fa fa-user-plus"></i> Add Community Radio Station</a>
                  </li>
                </ul>
              </li>
              @endif
              @if(Session::get('WingType')=='M004')
              <li>
                <a href="#newmedia-empanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                  <i class="fa fa-wifi" aria-hidden="true"></i> New Media Empanelment</a>
                <ul class="collapse list-unstyled" id="newmedia-empanelment">
                  <li>
                    <a href="{{ url('internet-website') }}"><i class="fa fa-user-plus"></i> Add Internet Website</a>
                  </li>
                  <li>
                    <a href="{{ url('digital-cinema') }}"><i class="fa fa-user-plus"></i> Add Digital Cinema</a>
                  </li>
                  <li>
                    <a href="{{ url('bulk-sms') }}"><i class="fa fa-user-plus"></i> Add Bulk SMS & OBD</a>
                  </li>
                </ul>
              </li>
              @endif
            </ul>
          </li>
          @if(Session::get('WingType')=='M003')
      <li>
        <a href="#account_section" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i> Account Section</a>
        <ul class="collapse list-unstyled" id="account_section">
          <li>
            <a href="{{ route('account_details') }}"><i class="fa fa-user" aria-hidden="true"></i> Soleright Account</a>
          </li>
        </ul>
      </li>
      @endif

          <!-- Renewal -->
          <li>
            <a href="#renewal-empanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
              <i class="fa fa-leaf" aria-hidden="true"></i> Renewal</a>
            <ul class="collapse list-unstyled" id="renewal-empanelment">
              @if(Session::get('WingType')=='M001')
              <li>
                <a href="{{ url('print-renewal') }}"><i class="fa fa-edit"></i> Print</a>
              </li>
              <li>
                <a href="{{ url('vendor-rate-offered') }}" class="nav-link"><i class="fa fa-edit"></i> Rate Offered </a>
              </li>
              @endif
              @if(Session::get('WingType')=='M003')
              <li>
                <a href="{{ url('sole-right-list') }}"><i class="fa fa-edit"></i> Soleright</a>
              </li>
              <li>
                <a href="{{ url('private-renewal') }}"><i class="fa fa-edit"></i> Private</a>
              </li>
              <li>
                <a href="{{ url('personal-list') }}"><i class="fa fa-edit"></i> Personal </a>
              </li>
              @endif
            </ul>
          </li>

          <!-- Vendor Agreement -->
          <li>
            <a href="#vendor-agreement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-leaf" aria-hidden="true"></i> Vendor Agreement</a>
            <ul class="collapse list-unstyled" id="vendor-agreement">
              @if(Session::get('WingType')=='M001')
              <li>
                <a href="#aggrement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>Print Agreement</a>
                <ul class="collapse list-unstyled" id="aggrement">
                  <li>
                    <a href="{{ url('file-upload') }}"><i class="fa fa-upload"></i> Agreement Of Fresh Empanelment</a>
                  </li>
                  <li>
                    <a href="{{ url('renewal-agreement-upload') }}"><i class="fa fa-upload"></i> Agreement Of Renewal</a>
                  </li>
                </ul>
              </li>
              @endif
              @if(Session::get('WingType')=='M003')
              <li>
                <a href="#od-aggrement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>Outdoor Agreement</a>
                <ul class="collapse list-unstyled" id="od-aggrement">

                  <!-- for soleright agreement start-->
                  <li>
                    <a href="#aggrement1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>Soleright Agreement</a>
                    <ul class="collapse list-unstyled" id="aggrement1">
                      <li>
                        <a href="{{ url('sole-right-list') }}"><i class="fa fa-upload"></i> Agreement Of Fresh Empanelment</a>
                      </li>
                      <!-- <li>
                    <a href="{{ url('solerenewalAgreement') }}"><i class="fa fa-upload"></i> Agreement Of Renewal</a>
                  </li> -->
                    </ul>
                  </li>
                  <!-- for private agreement start-->
                  <li>
                    <a href="#aggrement2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>Private Agreement</a>
                    <ul class="collapse list-unstyled" id="aggrement2">
                      <li>
                        <a href="{{ url('private-fileupload') }}"><i class="fa fa-upload"></i> Agreement Of Fresh Empanelment</a>
                      </li>
                      <li>
                        <a href="{{ url('privaterenewalAgreement') }}"><i class="fa fa-upload"></i> Agreement Of Renewal</a>
                      </li>
                    </ul>
                  </li>
                  <!-- for personal agreement start-->
                  <li>
                    <a href="#aggrement3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>Personal Agreement</a>
                    <ul class="collapse list-unstyled" id="aggrement3">
                      <li>
                        <a href="{{ url('personal-list') }}"><i class="fa fa-upload"></i> Agreement Of Fresh Empanelment</a>
                      </li>
                      <!-- <li>
                  <a href="{{ url('personalrenewalAgreement') }}"><i class="fa fa-upload"></i> Agreement Of Renewal</a>
                </li> -->
                    </ul>
                  </li>
                </ul>
              </li>
              @endif
              @if(Session::get('WingType')=='M002')
              <li>
                <a href="#av-aggrement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>AV Agreement</a>
                <ul class="collapse list-unstyled" id="av-aggrement">

                  <!-- for AV Producer start-->
                  <li>
                    <a href="#avagree" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>AV Producer Agreement</a>
                    <ul class="collapse list-unstyled" id="avagree">
                      <li>
                        <a href="{{ url('av-producer-fileupload') }}"><i class="fa fa-upload"></i> Agreement Of AV Producer</a>
                      </li>
                    </ul>
                  </li>
                  <!-- for Community Radio Station agreement start-->
                  <li>
                    <a href="#commu-radio" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>Community Radio Station Agreement</a>
                    <ul class="collapse list-unstyled" id="commu-radio">
                      <li>
                        <a href="{{ url('commu-radio-fileupload') }}"><i class="fa fa-upload"></i> Agreement Of Community Radio Station</a>
                      </li>
                    </ul>
                  </li>
                  <!-- for AVTV Upload agreement start-->
                  <li>
                    <a href="#avtvagree" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>AVTV Agreement</a>
                    <ul class="collapse list-unstyled" id="avtvagree">
                      <li>
                        <a href="{{ url('avtv-fileupload') }}"><i class="fa fa-upload"></i> Agreement Of AVTV</a>
                      </li>
                    </ul>
                  </li>

                  <li>
                    <a href="#fmagree" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>Pvt. FM Station Agreement</a>
                    <ul class="collapse list-unstyled" id="fmagree">
                      <li>
                        <a href="{{ url('fm-fileupload') }}"><i class="fa fa-upload"></i> Agreement Of Pvt. FM Station</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              @endif
              @if(Session::get('WingType')=='M004')
              <li>
                <a href="#nm-aggrement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>New Media Agreement</a>
                <ul class="collapse list-unstyled" id="nm-aggrement">
                  <li>
                    <a href="{{ url('intWeb-file-upload') }}"><i class="fa fa-upload"></i>Agreement Of Internet Website</a>
                  </li>
                </ul>
              </li>
              @endif
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a href="#RO-billing" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i> RO & Billing</a>
        <ul class="collapse list-unstyled" id="RO-billing">
          <li>
            <a href="#RO" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-files-o" aria-hidden="true"></i> Release Order</a>
            <ul class="collapse list-unstyled" id="RO">
              @if(Session::get('WingType')=='M001')
              <li>
                <a href="{{ url('release-order-list') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Print RO List</a>
              </li>
              @endif
              @if(Session::get('WingType')=='M003')
              <li>
                <a href="{{ url('ODMediaRO') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Outdoor RO List</a>
              </li>
              @endif
            </ul>
          </li>

          <li>
            <a href="#compliance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-files-o" aria-hidden="true"></i> Daily Compliance</a>
            <ul class="collapse list-unstyled" id="compliance">
              @if(Session::get('WingType')=='M001')
              <li>
                <a href="#print-compliance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>Print Compliance</a>
                <ul class="collapse list-unstyled" id="print-compliance">
                  <li>
                    <a href="{{ route('dailycompliance.create') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Add Compliance</a>
                  </li>
                  <li>
                    <a href="{{ route('dailycompliance.index') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Compliance List </a>
                  </li>
                  <li>
                    <a href="{{ route('billing.index') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Submitted Bill List</a>
                  </li>
                </ul>
              </li>
              @endif
              @if(Session::get('WingType')=='M003')
              <li>
                <a href="#od-compliance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>Outdoor Compliance</a>
                <ul class="collapse list-unstyled" id="od-compliance">
                  <li>
                    <a href="{{ route('ODMediaCompliance.create') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Add Compliance</a>
                  </li>
                  <li>
                    <a href="{{ route('ODMediaCompliance.index') }}"><i class="fa fa-angellist" aria-hidden="true"></i>Compliance List</a>
                  </li>
                  <li>
                    <a href="{{ route('ODMediaBilling.index') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Submitted Bill List</a>
                  </li>
                </ul>
              </li>
              @endif
              
            </ul>
          </li>



        </ul>
      </li>




      @endif
      <li>
        <a href="{{URL::to('uploads/footer_document/ministry wise client code.csv')}}" >Ministry Wise Client Code</a>
      </li>
      <li>
        <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-print" aria-hidden="true"></i> Policies & Guidelines</a>
        <ul class="collapse list-unstyled" id="homeSubmenu2">
          <li>
            <a target="_blank" href="{{URL::to('uploads/footer_document/PrintMedia/Print Media Advertisement Policy2O2O.pdf')}}"> 
               Print</a>
          </li>
          <li>
            <a href="#homeSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Outdoor</a>
            <ul class="collapse list-unstyled" id="homeSubmenu3">
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/Outdoor/Policy Guidelines for Outdoor & Personal Media2021.pdf')}}"> Outdoor & Personal Media</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#av_media" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> AV Media</a>
            <ul class="collapse list-unstyled" id="av_media">              
                <a href="#av_media2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Community Radio Station</a> 
                  <ul class="collapse list-unstyled" id="av_media2">
                  <li>
                      <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Empanelment of Community Radio Station (CRS)2020.pdf')}}"> Guidelines of CRS</a>              
                  </li> 
                  <li>
                      <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Revision in the guidelines of Empanelment of Community Radio Station2022.pdf')}}"> Revision guidelines of CRS </a>              
                  </li>             
                  </ul>
                  <li>
                    <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Empanelment of Pvt. FM Stations2020.pdf')}}"> Guidelines of  PVt. FM</a>
                  </li>
                  <li>
                    <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Guidelines for Empanelment of AV Producers2011.pdf')}}"> Guidelines of AV Producers</a>
                  </li>
                  <li>
                    <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Pvt. C&S TV Policy Guidelines January 2019.pdf')}}"> Guidelines of AV TV</a>
                  </li>
            </ul>
          </li>

          <li>
            <a href="#new_media" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> New Media</a>
            <ul class="collapse list-unstyled" id="new_media">
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Bulk SMS & Other Value Added Services2020.pdf')}}"> Guidelines of Bulk SMS</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment & Engagement of Social Media Platforms2020.pdf')}}"> Guidelines of Social Media</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment and Rate Fixation for Central Govt. Advertisements on Internet Websites2016.pdf')}}"> Guidelines of Internet websites</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment of Digital Cinema2019.pdf')}}"> Guidelines of Digital Cinema</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#print_publisher" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Print Publisher</a>
            <ul class="collapse list-unstyled" id="print_publisher">
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/PrintPublicity_MassMailing/Empanelment of Offset PrintersDiary Makers & Digital Printers2018.pdf')}}"> Guidelines of  Digital Printers</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/PrintPublicity_MassMailing/Guidelines for empanelment of Offset Printers and Diary Makers with DAVP 2018.pdf')}}"> Guidelines of Offset Printer & Diary Makers</a>
              </li>

            </ul>
          </li>

          
        </ul>
      </li>

      <li>
        <a href="#advisorieshomeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-print" aria-hidden="true"></i> Advisories</a>
        <ul class="collapse list-unstyled" id="advisorieshomeSubmenu2">
          <li>
            <a target="_blank" href="{{URL::to('uploads/footer_document/PrintMedia/Print Media Advertisement Policy2O2O.pdf')}}"> 
               Print</a>
          </li>
          <li>
            <a href="#advisorieshomeSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Outdoor</a>
            <ul class="collapse list-unstyled" id="advisorieshomeSubmenu3">
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/Outdoor/Policy Guidelines for Outdoor & Personal Media2021.pdf')}}"> Outdoor & Personal Media</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#advisoriesav_media" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> AV Media</a>
            <ul class="collapse list-unstyled" id="advisoriesav_media">              
                <a href="#advisoriesav_media2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Community Radio Station</a> 
                  <ul class="collapse list-unstyled" id="advisoriesav_media2">
                  <li>
                      <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Empanelment of Community Radio Station (CRS)2020.pdf')}}"> Guidelines of CRS</a>              
                  </li> 
                  <li>
                      <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Revision in the guidelines of Empanelment of Community Radio Station2022.pdf')}}"> Revision guidelines of CRS </a>              
                  </li>             
                  </ul>
                  <li>
                    <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Empanelment of Pvt. FM Stations2020.pdf')}}"> Guidelines of  PVt. FM</a>
                  </li>
                  <li>
                    <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Guidelines for Empanelment of AV Producers2011.pdf')}}"> Guidelines of AV Producers</a>
                  </li>
                  <li>
                    <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Pvt. C&S TV Policy Guidelines January 2019.pdf')}}"> Guidelines of AV TV</a>
                  </li>
            </ul>
          </li>

          <li>
            <a href="#advisoriesnew_media" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> New Media</a>
            <ul class="collapse list-unstyled" id="advisoriesnew_media">
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Bulk SMS & Other Value Added Services2020.pdf')}}"> Guidelines of Bulk SMS</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment & Engagement of Social Media Platforms2020.pdf')}}"> Guidelines of Social Media</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment and Rate Fixation for Central Govt. Advertisements on Internet Websites2016.pdf')}}"> Guidelines of Internet websites</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment of Digital Cinema2019.pdf')}}"> Guidelines of Digital Cinema</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#advisoriesprint_publisher" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Print Publisher</a>
            <ul class="collapse list-unstyled" id="advisoriesprint_publisher">
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/PrintPublicity_MassMailing/Empanelment of Offset PrintersDiary Makers & Digital Printers2018.pdf')}}"> Guidelines of  Digital Printers</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/PrintPublicity_MassMailing/Guidelines for empanelment of Offset Printers and Diary Makers with DAVP 2018.pdf')}}"> Guidelines of Offset Printer & Diary Makers</a>
              </li>

            </ul>
          </li>

          
        </ul>
      </li>

      @if(Session::get('UserType')==1)
      <li>
            <a href="#advisories_empaneled" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Empaneled Vendors</a>
            <ul class="collapse list-unstyled" id="advisories_empaneled">
              @if(Session::get('WingType')=='M004')
              <li>
                <a href="{{URL::to('uploads/footer_document/VendorsEmpaneled/Digital Cinema Vendors.xlsx')}}"> Digital Cinema Vendors</a>
              </li>
              @endif
              @if(Session::get('WingType')=='M001')
              <li>
                <a href="{{URL::to('uploads/footer_document/VendorsEmpaneled/Print Vendors.xlsx')}}"> Print Vendors</a>
              </li>
              @endif
              @if(Session::get('WingType')=='M002')
              <li>
                <a href="{{URL::to('uploads/footer_document/VendorsEmpaneled/TV Channels.xlsx')}}"> TV Channels</a>
              </li>
              @endif
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/VendorsEmpaneled/Websites.pdf')}}"> Websites</a>
              </li>

            </ul>
          </li>
      @endif

      <li>
        <a href="{{URL::to('uploads/footer_document/ClientFAQs.pdf')}}" >FAQs</a>
      </li>

      
    </ul>
    @if(Session::get('UserType')==0)
    
    <div class="footer">
      <a  class='btn btn-primary btn-sm m-0'  href="{{url('callbackrequest')}}">Request a Callback</a>
      </p>
    </div>
    @endif
  </div>
</nav>