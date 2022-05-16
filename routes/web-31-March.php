<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoleRightMediaController;
use App\Http\Controllers\ClientSubmissionController;
use App\Http\Controllers\FmStationController;
use App\Http\Controllers\RegionalNationalController;
use App\Http\Controllers\CommunityRadioController;
use App\Http\Controllers\AudioVideoController;
use App\Http\Controllers\ArogiController;
use App\Http\Controllers\PersonalMediaController;
use App\http\Controllers\PrivateMediaController;
use App\http\Controllers\dailycompliance\DailyComplianceController;
use App\http\Controllers\billing\BillingController;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\DigitalCinemaController;
use App\Http\Controllers\InternetWebsiteController;
use App\http\Controllers\ClientRequest\mediaPlanControllers\outdoorMediaPlanController;
use App\http\Controllers\ClientRequest\mediaPlanControllers\tvMediaPlanController;
use App\http\Controllers\RO\ROController;
use App\http\Controllers\dailycompliance\ODMediaCompliance\ODMediaComplianceController;
use App\http\Controllers\billing\ODMediaBilling\ODMediaBillingController;
use App\Http\Controllers\FreshEmpanelmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\wallPrintingController;
use App\Http\Controllers\TechnicalHoardingController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\BulkSmsController;
use App\http\Controllers\clientRequest\mediaPlanControllers\RadioMediaPlanController;

//use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });
//login routes
//Route::group(['middleware'=>'bocuser'],function(){
//Auth::routes();
// Route::get('login/{user_type?}', [App\http\controllers\auth\BocUserController::class, 'showLoginForm'])->name('login');
// Route::post('login/{user_type?}', [App\http\controllers\auth\BocUserController::class, 'login'])->name('login')->where('user_type', '[0-1]+');;


//});
//end login
Route::get('dashboard', function () {
    return view('admin.pages.dashboard');
});


Route::match(['get','post'],'map-details/{od_vendor_id}',[MapController::class,'map_details'])->name('map-details');

//wall-painting route start
Route::match(['get','post'],'wall-painting',[wallPrintingController::class,'companyDetails'])->name('wall-painting');
Route::get('wallPainting',[wallPrintingController::class,'wallPrintinglist'])->name('wallPainting');
Route::get('wallPainting-view/{id}',[wallPrintingController::class,'wallPrinting_view'])->name('wallPainting-view');
Route::get('wallPainting-export-pdf/{id}', [wallPrintingController::class,'downloadPdf'])->name('wallPainting-export-pdf');
//wall-painting route end

// Technical Bid Hoarding route start
Route::match(['get','post'],'TechnicalHoarding',[TechnicalHoardingController::class,'TechnicalHoarding'])->name('TechnicalHoarding');
Route::get('bidHoarding',[TechnicalHoardingController::class,'bidHoardinglist'])->name('bidHoarding');
Route::match(['get','post'],'bidHoarding-edit/{id}',[TechnicalHoardingController::class,'bidHoarding_edit'])->name('bidHoarding-edit');
Route::get('bidHoarding-view/{id}',[TechnicalHoardingController::class,'bidHoarding_view'])->name('bidHoarding-view');
Route::get('bidHoarding-export-pdf/{id}', [TechnicalHoardingController::class,'biddownloadPdf'])->name('bidHoarding-export-pdf');
// Technical Bid Hoarding route end


//Route::group(['middleware' => 'auth'], function () {
Route::get('client-request', [App\Http\Controllers\ClientRequestController::class, 'clientRequest'])->name('client-request');
Route::post('ministry-code', [App\Http\Controllers\ClientRequestController::class, 'ministryCode'])->name('ministry-code');
Route::post('ministry-head', [App\Http\Controllers\ClientRequestController::class, 'ministryHead'])->name('ministry-head');
Route::post('client-request-save', [App\Http\Controllers\ClientRequestController::class, 'clientRequestSave'])->name('client-request-save');
Route::post('state-cities', [App\Http\Controllers\ClientRequestController::class, 'stateCities'])->name('state-cities');
//});
/* Start Personal media by priyanshi */
/*Route::get('rate-settlement-personal-media', [PersonalMediaController::class,'InsertpersonalMedia'])->name('rate-settlement-personal-media');
Route::post('personalcheckuniqueowner',[PersonalMediaController::class, 'checkUniqueOwner'])->name('personalcheckuniqueowner');
Route::post("savePersonalMedia", [PersonalMediaController::class,'savePersonalMedia'])->name('savePersonalMedia');
Route::get("viewPersonal/{mediaid}", [PersonalMediaController::class,'viewPersonal'])->name('viewPersonal');
Route::post("fetchpersonalownerrecord", [PersonalMediaController::class,'fetchOwnerRecord'])->name('fetchpersonalownerrecord');
Route::post('personalcheckuniquevendor',[PersonalMediaController::class, 'checkUniqueVendor'])->name('personalcheckuniquevendor');

Route::get('vendor-renewal-outdoor-personal',[PersonalMediaController::class, 'renewalForm']);*/
// Route::get('rate-settlement-personal-media', [PersonalMediaController::class,'InsertpersonalMedia'])->name('rate-settlement-personal-media');
Route::get('personalcheckuniqueowner',[PersonalMediaController::class, 'checkUniqueOwner'])->name('personalcheckuniqueowner');
Route::post("savePersonalMedia", [PersonalMediaController::class,'savePersonalMedia'])->name('savePersonalMedia');
Route::get("viewPersonal/{mediaid}", [PersonalMediaController::class,'viewPersonal'])->name('viewPersonal');
Route::get("fetchpersonalownerrecord", [PersonalMediaController::class,'fetchOwnerRecord'])->name('fetchpersonalownerrecord');
Route::get('personalcheckuniquevendor',[PersonalMediaController::class, 'checkUniqueVendor'])->name('personalcheckuniquevendor');
Route::get('getMediaSubCategory',[PersonalMediaController::class, 'getMediaSubCategory']);
// Route::get('personal-renewal', [App\Http\Controllers\PersonalMediaController::class, 'personalRenewal']);
// Route::post('personal-renewal', [App\Http\Controllers\PersonalMediaController::class, 'personalRenewalView']);
// Route::post('personal-renewal-save', [App\Http\Controllers\PersonalMediaController::class, 'personalRenewalSave'])->name('personal-renewal-save');
Route::get('remove-workdone-data', [App\Http\Controllers\PersonalMediaController::class, 'removeWorkdoneData']);
Route::get("get-agencyName-fromgst", [PersonalMediaController::class, 'getAgencyNameFromgst']);
Route::post("perfetchmedia", [PersonalMediaController::class, 'fetchmedia'])->name('perfetchmedia'); //add 11 march


Route::get('rate-settlement-personal-media/{id?}', [PersonalMediaController::class,'InsertpersonalMedia'])->name('rate-settlement-personal-media');
Route::get('personal-list', [PersonalMediaController::class,'personallist'])->name('personallist');
Route::get('personal-show-subcategory', [PersonalMediaController::class,'show_subcategory'])->name('personal-show-subcategory');
Route::get('persolan-existing-form',[PersonalMediaController::class,'existinguser'])->name('personal_existinguser'); //for exting user form 22-Feb
Route::post('personal-existing-user-data',[PersonalMediaController::class,'existingUserSaved'])->name('personal_existingUserSaved'); //for exting user form 
Route::get('personal-find-sub-category', [PersonalMediaController::class,'findSubCategory'])->name('personalfindSubCategory');


Route::get('personal-renewal/{id?}', [PersonalMediaController::class,'personal_right_renewal_form'])->name('personal-renewal');
Route::post('personal-renewal-form-submit', [PersonalMediaController::class,'personal_renewal_form_submit'])->name('personal-renewal-submit');

Route::get('remove-media-data', [App\Http\Controllers\PersonalMediaController::class, 'removeMediaData']);

//for personal agreement
Route::get('personal-fileupload/{id?}', [AgreementController::class, 'personalUpload'])->name('personal.upload');
Route::post('personal-fileupload', [AgreementController::class, 'personal_file_upload'])->name('personal.upload.post');
Route::get('personalfile-download', [AgreementController::class, 'personal_download_file'])->name('personalfile.download');

/* End Personal media sk */

/*Start Sole Right Create by Priyanshi*/
Route::get("fetchStates", [SoleRightMediaController::class, 'fetchStates'])->name('fetchStates');
Route::post("fetchDistricts", [SoleRightMediaController::class, 'fetchDistricts'])->name('fetchDistricts');
Route::get('vendor-sole-right-media',[SoleRightMediaController::class, 'vendoesolerightMedia'])->name('vendor-sole-right-media');
Route::post('get-all-vendorlist',[SoleRightMediaController::class, 'getAllVendorList'])->name('get-all-vendorlist');
Route::post("updateSoleRight/{odmedia_id}", [SoleRightMediaController::class,'updateSoleRight'])->name('updateSoleRight');
/*Unique Email and mobile Route*/
Route::post('solerightcheckuniquevendor',[SoleRightMediaController::class, 'checkUniqueVendor'])->name('solerightcheckuniquevendor');
Route::post('checkpsolerightuniqueowner',[SoleRightMediaController::class, 'checkUniqueOwner'])->name('checkpsolerightuniqueowner');
Route::post('fetchownerrecord', [SoleRightMediaController::class, 'fetchOwnerRecord'])->name('fetchownerrecord');

Route::get('sole-right-media/{id?}', [SoleRightMediaController::class,'InsertsoleRightMedia'])->name('sole-right-media');
Route::post("saveSoleMedia", [SoleRightMediaController::class,'saveSoleMedia'])->name('saveSoleMedia');
Route::get("viewSoleRightMedia/{mediaid}", [SoleRightMediaController::class,'viewSoleRightMedia'])->name('viewSoleRightMedia');
Route::post("fetchsolerightownerrecord", [SoleRightMediaController::class,'fetchOwnerRecord'])->name('fetchsolerightownerrecord');

Route::get('existing_user',[SoleRightMediaController::class,'existing_user'])->name('existing_user');

Route::get('vendor-account', [SoleRightMediaController::class,'vendor_account'])->name('vendor-account'); //for account detail 21-feb
Route::get('sole-right-existing-user',[SoleRightMediaController::class,'existinguser'])->name('existinguser'); //for exting user form 22-Feb
Route::post('existing-user-data',[SoleRightMediaController::class,'existingUserSaved'])->name('existingUserSaved'); //for exting user form 23-Feb


Route::post("fetchmedia", [SoleRightMediaController::class, 'fetchmedia'])->name('fetchmedia'); 
Route::post("fileupload", [SoleRightMediaController::class,'fileupload'])->name('fileupload');


Route::match(['get','post'],'sole-right-list', [SoleRightMediaController::class,'solerightlist'])->name('solerightlist');

Route::get('find-sub-category', [SoleRightMediaController::class,'findSubCategory'])->name('findSubCategory');
Route::get('show-subcategory', [SoleRightMediaController::class,'show_subcategory'])->name('show-subcategory');


//Soleright aggrement file
Route::get('soleright-fileupload/{id?}', [AgreementController::class, 'solerightUpload'])->name('soleright.upload');
Route::post('soleright-fileupload', [AgreementController::class, 'soleright_file_upload'])->name('solefile.upload.post');
Route::get('solefile-download', [AgreementController::class, 'soleright_download_file'])->name('solefile.download');

Route::get("checkgstsole", [SoleRightMediaController::class, 'checkgst']);
Route::get('remove-mediaaddress-data', [SoleRightMediaController::class, 'removeMediaaddressData']);
//soleright renewal agreement

Route::get('sole-right-renewal/{id?}', [SoleRightMediaController::class,'sole_right_renewal_form'])->name('sole-right-renewal');
Route::post('sole-right-renewal-form-submit', [SoleRightMediaController::class,'sole_right_renewal_form_submit'])->name('sole-right-renewal-submit');

Route::get('solerenewal-agreement-upload', [AgreementController::class, 'solerenewalAgreement'])->name('solerenewal-agreement-upload');
Route::get('solerenewalAgreement', [AgreementController::class, 'solerenewalAgreement'])->name('solerenewal-agreement-upload');
Route::post('solerenewalAgreementupload', [AgreementController::class, 'solerenewalAgreementupload'])->name('solerenewalAgreementupload');
Route::get('sole-renewalfile-download', [AgreementController::class, 'soleright_renewal_download_file'])->name('solerenewalfile.download');

//private agreement file
Route::get('private-fileupload', [AgreementController::class, 'privateUpload'])->name('private.upload');
Route::post('private-fileupload', [AgreementController::class, 'private_file_upload'])->name('private.upload.post');
Route::get('private-download', [AgreementController::class, 'private_download_file'])->name('private.download');

Route::get('privaterenewalAgreement', [AgreementController::class, 'privaterenewalAgreement'])->name('privaterenewal-agreement-upload');
Route::post('privaterenewalAgreementupload', [AgreementController::class, 'privaterenewalAgreementupload'])->name('privaterenewalAgreementupload');
Route::get('private-renewalfile-download', [AgreementController::class, 'private_renewal_download_file'])->name('privaterenewalfile.download');

//personal agreement file
// Route::get('personal-fileupload', [AgreementController::class, 'personalUpload'])->name('personal.upload');
// Route::post('personal-fileupload', [AgreementController::class, 'personal_file_upload'])->name('personal.upload.post');
Route::get('personal-download', [AgreementController::class, 'personal_download_file'])->name('personal.download');

Route::get('personalrenewalAgreement', [AgreementController::class, 'personalrenewalAgreement'])->name('personalrenewal-agreement-upload');
Route::post('personalrenewalAgreementupload', [AgreementController::class, 'personalrenewalAgreementupload'])->name('personalrenewalAgreementupload');
Route::get('personal-renewalfile-download', [AgreementController::class, 'personal_renewal_download_file'])->name('personalrenewalfile.download');

/* AV Agreement file Upload and download created by priyanshi */
Route::get('av-producer-fileupload', [AgreementController::class, 'avProducerfileUpload'])->name('av-producer-fileupload');
Route::post('av-producer-fileupload', [AgreementController::class, 'avProducer_file_upload'])->name('av-producer-fileupload');
Route::get('av-producer-file-download', [AgreementController::class, 'avProducer_download_file'])->name('av-producer-file.download');


/* Community Radio Station Agreement file Upload and download created by priyanshi */
Route::get('commu-radio-fileupload', [AgreementController::class, 'commuRadiofileUpload'])->name('commu-radio-fileupload');
Route::post('commu-radio-fileupload', [AgreementController::class, 'commuRadio_file_upload'])->name('commu-radio-fileupload');
Route::get('commu-radio-file-download', [AgreementController::class, 'commuRadio_download_file'])->name('commu-radio-file.download');

//AVTV aggrement file
Route::get('avtv-fileupload', [AgreementController::class, 'avtvUpload'])->name('avtv-fileupload');
Route::post('avtv-fileupload', [AgreementController::class, 'avtv_file_upload'])->name('avtv-fileupload');
Route::get('avtv-download', [AgreementController::class, 'avtv_download_file'])->name('avtv-download');
//PVT FM Station aggrement file
Route::get('fm-fileupload', [AgreementController::class, 'FMUpload'])->name('fm-fileupload');
Route::post('fm-fileupload', [AgreementController::class, 'FM_file_upload'])->name('fm-fileupload');
Route::get('fm-download', [AgreementController::class, 'FM_download_file'])->name('fm-download');

// Sole right renewal suman
Route::get('soleright-renewal', [App\Http\Controllers\SoleRightMediaController::class, 'solerightRenewal']);
Route::post('soleright-renewal', [App\Http\Controllers\SoleRightMediaController::class, 'solerightRenewalView']);
Route::post('ownerRenewal',[App\Http\Controllers\SoleRightMediaController::class, 'ownerRenewal']);
Route::post('solerightRenewall',[App\Http\Controllers\SoleRightMediaController::class, 'solerightRenewall']);
Route::get('MediaWorkDone_delete',[App\Http\Controllers\SoleRightMediaController::class, 'MediaWorkDone_delete']);//media work done delete
Route::get('soleaddress_delete',[App\Http\Controllers\SoleRightMediaController::class, 'soleaddress_delete']);//sole address delete

/*Start private outdoor route start */
Route::post('fetchprivateownerrecord', [PrivateMediaController::class, 'fetchOwnerRecord'])->name('fetchprivateownerrecord');
Route::post('checkprivateuniqueowner', [PrivateMediaController::class, 'checkUniqueOwner'])->name('checkprivateuniqueowner');
Route::post('checkuniqueprivatevendor',[PrivateMediaController::class, 'checkUniqueVendor'])->name('checkuniqueprivatevendor');
Route::post('get-all-privatevendorlist', [PrivateMediaController::class, 'getAllPrivateVendorList'])->name('get-all-privatevendorlist');
Route::post("updatePrivateMedia/{odmedia_id}", [PrivateMediaController::class, 'updatePrivateMedia'])->name('updatePrivateMedia');
/*end renewal*/
Route::get('rate-settlement-private-media', [PrivateMediaController::class, 'Privatemedia'])->name('rate-settlement-private-media');
Route::post('private_media', [PrivateMediaController::class, 'private_media'])->name('private_media');
Route::get('ownerData2', [PrivateMediaController::class,'ownerData2'])
->name('ownerData2');

Route::get('private-renewal', [PrivateMediaController::class, 'privateRenewal']);
Route::post('private-renewal', [PrivateMediaController::class, 'privateRenewalView']);
Route::post('privateownerRenewal',[PrivateMediaController::class, 'ownerRenewal']);
Route::post('privateRenewall',[PrivateMediaController::class, 'privateRenewall']);
Route::get("checkgstprivate", [PrivateMediaController::class, 'getAgencyNameFromgst']);
/*End private outdoor route start */

//Strat FM Station
Route::get('fm-radio-station',[FmStationController::class,'StateDropdown'])->name('fm-radio-station');
Route::get('FmfetchDistricts',[FmStationController::class,'FMfetchDistricts'])->name('FmfetchDistricts');
Route::post('fmStation',[FmStationController::class,'fmStation'])->name('fmStation');
Route::get('findfm',[FmStationController::class,'findfm'])->name('findfm');
Route::get('checkgst',[FmStationController::class,'checkgst'])->name('checkgst');
Route::post('SaveVend',[FmStationController::class,'VendDetailsSave'])->name('SaveVend');
Route::post('SaveAccout',[FmStationController::class,'AccountDetailsSave'])->name('SaveAccout');
Route::post('SaveDOC',[FmStationController::class,'DocumentSave'])->name('SaveDOC');
Route::get('getIFSC',[FmStationController::class,'getifsc'])->name('getIFSC');
//End FM Station

/*Regional National Route*/
Route::get('regional-national/{id}',[RegionalNationalController::class,'getregional'])->name('regional-national');
Route::get('getDistrict-national',[RegionalNationalController::class,'fetchDistricts'])->name('getDistrict-national');
Route::post('SaveOwnerData',[RegionalNationalController::class,'Savedata'])->name('SaveOwnerData');
Route::get('FetchRNemail',[RegionalNationalController::class,'FetchRNemail'])->name('FetchRNemail');
Route::post('saveregional',[RegionalNationalController::class,'saveregional'])->name('saveregional');
Route::any('form-type',[RegionalNationalController::class,'reginalradio'])->name('form-type');
/*End Regional National Route*/


/* Start Community Radio Station*/
Route::get('community-radio-station', [CommunityRadioController::class, 'InsertRadioForm'])->name('InsertRadioForm');
Route::get('getDistrictcomm1', [CommunityRadioController::class, 'fetchDistricts'])->name('getDistrictcomm1');
Route::post("saveCommRadio", [CommunityRadioController::class,'saveRadio'])->name('saveCommRadio');
Route::get('getIFSC', [CommunityRadioController::class,'getifsc'])->name('getifsc');
Route::post('findcr',[App\Http\Controllers\CommunityRadioController::class,'findcr'])->name('findcr');
Route::post('get-all-CommRadio',[CommunityRadioControlle::class, 'getAllCommRadio'])->name('get-all-CommRadio');
/* End Community Radio Station*/

//for audio video producers start
Route::get('audio', [AudioVideoController::class, 'index'])->name('audio');
Route::post('first_insert',[AudioVideoController::class,'first_tab_insert'])->name('first_insert');
Route::post('final_submit',[AudioVideoController::class,'final_submit'])->name('final_submit');
//end audio video producers



Route::get('vendor-notifi-empanelment', [App\Http\Controllers\AdvisioryController::class, 'vennotiemp'])->name('vendor-notifi-empanelment');
Route::get('client-submission-for-advertisement', [App\Http\Controllers\ClientSubAdvertisementController::class, 'ClientSubAdvertisement'])->name('client-submission-for-advertisement');


Route::get('vendor-notifi-empanelment', [App\Http\Controllers\AdvisioryController::class, 'vennotiemp'])->name('vendor-notifi-empanelment');
Route::get('client-submission-for-advertisement', [App\Http\Controllers\ClientSubAdvertisementController::class, 'ClientSubAdvertisement'])->name('client-submission-for-advertisement');

// Route::post('/login', [App\Http\Controllers\auth\LoginController::class, 'login'])->name('login');
//Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

   //@rishi

        //Start Client Request Route
            Route::get('client-submission-form/{CLHID?}', [ClientSubmissionController::class, 'getClientForm'])->name('client-submission-form'); 

            Route::get('previousLogs', [ClientSubmissionController::class, 'previousLogs'])->name('previousLogs'); 
            
            Route::post('client-submission-form', [ClientSubmissionController::class, 'clientSave'])->name('client-submission-form'); 
            Route::get('client-submission-list', [ClientSubmissionController::class, 'index'])->name('client-submission-list');
            Route::get('get-district/{state_code?}', [ClientSubmissionController::class, 'getCity'])->name('get-district');
            Route::post('get-email', [ClientSubmissionController::class, 'getEmail'])->name('get-email');

            Route::get('getCityStateBased/{state_code?}', [ClientSubmissionController::class, 'getCityStateBased'])->name('getCityStateBased');
        //End Client Request Route
        //start media plan route
            Route::get('media-plan',[ClientSubmissionController::class, 'mediaPlanList'])->name('media-plan');
        Route::get('media-plan-view/{mpNo}/{planVersion}',[ClientSubmissionController::class, 'mediaPlanView'])->name('media-plan-view');
            // Route::get('media-plan-view/{mpNo}',[ClientSubmissionController::class, 'mediaPlanView'])->name('media-plan-view');

            Route::post('save-comment-mediaplan',[ClientSubmissionController::class, 'saveCommentOfmp'])->name('save-comment-mediaplan');
        //end Media plan route
        //RO Releted Rute
            Route::get('release-order-list',[ClientSubmissionController::class, 'roList'])->name('release-order-list');
            Route::get('RO-View/{npcode}/{lineno}/{planid}/{clientid}',[ClientSubmissionController::class, 'viewRO'])->name('RO-View');
        //end RO Releted Rute
        /*forgot password */
            Route::get('reset-password', [App\Http\Controllers\auth\BocUserController::class, 'showResetForm'])->name('resetForm');
            Route::post('forgot-password',[App\http\controllers\auth\BocUserController::class,'forgotpassword']);
            Route::post('submitotp',[App\http\controllers\auth\BocUserController::class,'submitotp']);
            Route::post('updatepassword',[App\http\controllers\auth\BocUserController::class,'resetPassword']);

        //end forgot password 
         /*start daily compliance route*/
            Route::get('dailycompliance/nplist/{npcode}', [DailyComplianceController::class,'getnpDetail'])->name('dailycompliance.nplist');
            Route::get('dailycompliance/rolist/{rocode}', [DailyComplianceController::class,'getrodetail'])->name('dailycompliance.rolist');    

            //Route::get('dailycompliance/submitted-bill', [DailyComplianceController::class,'submittedBill'])->name('dailycompliance.submittedBill');
            Route::resources([
                'dailycompliance' => DailyComplianceController::class,
            ]);

             Route::get('dailyCompliancePrintPDF/{npcode}', [DailyComplianceController::class,'dailyCompliancePrintPDF']); 
             Route::get('billingPrintPDF/{npcode}', [BillingController::class,'billingPrintPDF']);

            Route::resources([
                'billing' => BillingController::class,
            ]);

             Route::get('ODMediaCompliance/getSelectedAgencyDetail/{agencycode}', [ODMediaComplianceController::class,'getSelectedAgencyDetail'])->name('ODMediaCompliance.getSelectedAgencyDetail');
            Route::get('ODMediaCompliance/rolist/{rocode}', [ODMediaComplianceController::class,'getrodetail'])->name('ODMediaCompliance.rolist'); 
           
            Route::resources([
                'ODMediaPlan' => outdoorMediaPlanController::class,
            ]);

            //for tv
            Route::resources([
                'tvMediaPlan' => tvMediaPlanController::class,
            ]);

            Route::resources([
                'ODMediaRO' => ROController::class,
            ]);
            Route::resources([
                'ODMediaCompliance' =>ODMediaComplianceController::class,
            ]);
            Route::resources([
                'ODMediaBilling' =>ODMediaBillingController::class,
            ]);
        /*END daily compliance route*/
         //start billing route
            Route::resources([
                'billing' => BillingController::class,
            ]);
             Route::get('billing/create/{npcode?}', [BillingController::class,'create'])->name('billing.create');
            // Route::get('dailycompliance/rolist/{rocode}', [BillSubmissionController::class,'getrodetail'])->name('dailycompliance.rolist');
            
        //end bulling route
             //for AV Radio plan
                Route::resources([
                'radioMediaPlan' => RadioMediaPlanController::class,
                ]);

        //All mail send to client

             Route::get('mailSendToClient/{emailparam?}',[ClientSubmissionController::class, 'mailSendToClient'])->name('mailSendToClient');
             
             //En mail


        //@Rishi




//for rob
Route::get('/rob-form-one/{id?}',[ArogiController::class,'index'])->name('rob-form-one'); 
Route::post('/rob-form-one',[ArogiController::class,'feedback'])->name('submit_one');


Route::get('/rob-form-two',[ArogiController::class,'formtwo'])->name('rob-form-two');
Route::post('/rob-form-two',[ArogiController::class,'formtwosubmit'])->name('form-two');

Route::post('/rob-form-twoupdate',[ArogiController::class,'formtwosubmitupdate'])->name('form-twoupdate');

Route::get('/rob-data',[ArogiController::class,'fetch'])->name('fetch-data');
Route::get('/rob-specialdata',[ArogiController::class,'sapecial_area_fetch'])->name('fetch-specialdata'); //special area data fetch

Route::get('roblist',[ArogiController::class,'roblist'])->name('roblist');

Route::get('alllist/{id}',[ArogiController::class,'userlist'])->name('userlist2');
Route::get('/alllistsecond/{id}',[ArogiController::class,'userlistsecond'])->name('userlist');

Route::post('rob_insert',[ArogiController::class,'rob_insert'])->name('rob_insert'); //new rob insert
Route::post('robSubmit',[ArogiController::class,'robSubmit'])->name('robSubmit'); //new rob final submit
Route::get('hq_region',[ArogiController::class,'headquat'])->name('headquat');//new
Route::get('fo_region',[ArogiController::class,'foregion'])->name('foregion');//new
// sk change end

//This url is used to vendor and client login


/* Rimmi Route */
//excel routes
Route::get('import-abc-view', [App\Http\Controllers\ABCController::class, 'importABCView']);
Route::post('import', [App\Http\Controllers\ABCController::class, 'import'])->name('import');
//excel routes

// SMS and Mail Api Routes
Route::get('sms_send', [App\Http\Controllers\SMSController::class, 'sms_send'])->name('sms_send');
Route::get('mail-send', [App\Http\Controllers\SMSController::class, 'mailSend'])->name('mail-send');
// End SMS Mail Api Routes 

// print route
Route::get('fresh-empanelment', [FreshEmpanelmentController::class, 'freshEmpanelment'])->name('fresh-empanelment');
Route::post('fresh-empanelment-save', [FreshEmpanelmentController::class, 'freshEmpanelmentSave'])->name('fresh-empanelment-save');
Route::post('fresh-empanelment-update', [FreshEmpanelmentController::class, 'freshEmpanelmentUpdate'])->name('fresh-empanelment-update');
Route::get('getdistrict', [FreshEmpanelmentController::class, 'getDistrict'])->name('getdistrict');
Route::get('fresh-empanelment-previous', [FreshEmpanelmentController::class, 'previousLogsave'])->name('fresh-empanelment-previous');
// Route::post('checkfile',[FreshEmpanelmentController::class, 'checkFile'])->name('checkfile');
Route::get('existownerdata', [FreshEmpanelmentController::class, 'existingOwnerData'])->name('existownerdata');
Route::get('checkuniqueowner/{emailparam}', [FreshEmpanelmentController::class, 'checkUniqueOwner'])->name('checkuniqueowner');
Route::post('fetchownerrecord', [FreshEmpanelmentController::class, 'fetchOwnerRecord'])->name('fetchownerrecord');
Route::get('checkuniquevendor/{emailparam}', [FreshEmpanelmentController::class, 'checkUniqueVendor'])->name('checkuniquevendor');
Route::get('account-detail', [FreshEmpanelmentController::class, 'accountDetail']);
Route::post('account_detail', [FreshEmpanelmentController::class, 'accountDetailSave'])->name('account_detail');
Route::get('get-press-owner-data', [FreshEmpanelmentController::class, 'getPressOwnerData'])->name('get-press-owner-data');
Route::get('print-renewal', [FreshEmpanelmentController::class, 'printRenewal']);
Route::post('print-renewal', [FreshEmpanelmentController::class, 'printRenewalView']);
Route::post('print-renewal-save', [FreshEmpanelmentController::class, 'printRenewalSave'])->name('print-renewal-save');
Route::get('vendor-rate-offered', [FreshEmpanelmentController::class, 'vendorRateOffered']);
Route::post('vendor-rate-status-update', [FreshEmpanelmentController::class, 'vendorRateStatusupdate'])->name('vendor-rate-status-update');
Route::get('check-regno-cir-base', [FreshEmpanelmentController::class, 'checkRegCirBase'])->name('check-regno-cir-base');
Route::get('check-gstno', [FreshEmpanelmentController::class, 'checkGstno']);
Route::get('check-isprimaryedition', [FreshEmpanelmentController::class, 'checkIsPrimaryEdition']);
Route::get('check-renewal-gstno', [FreshEmpanelmentController::class, 'checkRenewalGSTNo']);
Route::get('check-renewal-regno-cir-base', [FreshEmpanelmentController::class, 'checkRenewalRegCirBase']);
Route::get('check-renewal-unique-email-vendor', [FreshEmpanelmentController::class, 'checkUniqueEmailVendor']);
Route::get('checkgstprint', [FreshEmpanelmentController::class,'checkgstprint']);
Route::get('print-pdf/{np_code}', [FreshEmpanelmentController::class, 'printPDF']);
// end print route


// payment routes
Route::post('vendor-payment-bharatkosh', [PaymentController::class, 'signSignature']);
Route::match(['get','post'],'bharatkosh-payment-response', [PaymentController::class, 'verifySignature'])->name('bharatkosh-payment-response');

// Route::match(['get','post'],'bharatkosh-payment-response', array('before' => 'auth', function()
// {
//     return 'sole-right-list'
// }));

Route::get('vendor-payment/{media_id}', [PaymentController::class, 'index']);
Route::get('get-payment-details', [PaymentController::class,'getPaymentDetails'])->name('get-payment-details');

// end payment routes



Route::get('fresh-empanelment-av-media', function () {
    return view('admin.pages.fresh-empanelment-av-media-form');
});
Route::get('fresh-empanelment-digital-cinema', function () {
    return view('admin.pages.fresh-empanelment-digital-cinema-form');
});


//Internet Website start created priyanshi
// Route::get("fetchStates", [InternetWebsiteController::class, 'fetchStates'])->name('fetchStates');
// Route::get("fetchDistricts", [InternetWebsiteController::class, 'fetchDistricts'])->name('fetchDistricts');
Route::get('internet-website',[InternetWebsiteController::class,'internetWebSave'])->name('internet-website');
Route::post("saveInternetWeb", [InternetWebsiteController::class,'saveinterNetWebsite'])->name('saveInternetWeb');
Route::get("checkgst-internet", [InternetWebsiteController::class, 'checkgst'])->name('checkgst');

 /* Internet Website Agreement file Upload and download created by priyanshi */
 Route::get('intWeb-file-upload', [AgreementController::class, 'intWebfileUpload'])->name('intWeb-file-upload');
 Route::post('intWeb-file-upload', [AgreementController::class, 'intWeb_file_upload'])->name('intWeb-file-upload');
 Route::get('intweb-file-download', [AgreementController::class, 'intWeb_download_file'])->name('intweb-file.download');
/* End Route internetWWebsite */

/* Start Digital Cinema*/
Route::get('digital-cinema',[DigitalCinemaController::class,'Digitalview'])->name('digital-cinema');
Route::post('DGCOwner',[DigitalCinemaController::class,'DGCOwner'])->name('DGCOwner');
Route::post('DigitalSeats',[DigitalCinemaController::class,'DigitalSeats'])->name('DigitalSeats');
Route::post('AccountDetails',[DigitalCinemaController::class,'AccountDetails'])->name('AccountDetails');
Route::post('SaveDocFile',[DigitalCinemaController::class,'SaveDocFile'])->name('SaveDocFile');
Route::post('getifsc',[DigitalCinemaController::class,'getifsc'])->name('getifsc');
Route::get('DigitalgetDistricts',[DigitalCinemaController::class, 'DigitalgetDistricts'])->name('DigitalgetDistricts');

// Digital Cinema Agreement
Route::get('digital-agreement',[AgreementController::class,'digitalcinemaUpload'])->name('digital-agreement');
Route::post('digital_file_upload',[AgreementController::class,'digital_file_upload'])->name('digital_file_upload');
Route::get('Digital_download_file',[AgreementController::class,'Digital_download_file'])->name('Digital_download_file');
/*End Digital cinema */


Route::get('print-renewal', [App\Http\Controllers\FreshEmpanelmentController::class, 'printRenewal']);
Route::post('print-renewal', [App\Http\Controllers\FreshEmpanelmentController::class, 'printRenewalView']);
Route::post('print-renewal-save', [App\Http\Controllers\FreshEmpanelmentController::class, 'printRenewalSave'])->name('print-renewal-save');

// Route::get('vendor-empanelment', [App\Http\Controllers\FreshEmpanelmentController::class, 'vendorEmpanelment']);
// Route::get('vendor-empanelment-view', [App\Http\Controllers\FreshEmpanelmentController::class, 'vendorEmpanelmentView']);
Route::get('vendor-rate-offered', [App\Http\Controllers\FreshEmpanelmentController::class, 'vendorRateOffered']);
Route::post('vendor-rate-status-update', [App\Http\Controllers\FreshEmpanelmentController::class, 'vendorRateStatusupdate'])->name('vendor-rate-status-update');
Route::get('check-regno-cir-base', [App\Http\Controllers\FreshEmpanelmentController::class, 'checkRegCirBase'])->name('check-regno-cir-base');
Route::get('check-gstno', [App\Http\Controllers\FreshEmpanelmentController::class, 'checkGstno']);
Route::get('check-isprimaryedition', [App\Http\Controllers\FreshEmpanelmentController::class, 'checkIsPrimaryEdition']);

Route::get('check-renewal-gstno', [App\Http\Controllers\FreshEmpanelmentController::class, 'checkRenewalGSTNo']);
Route::get('check-renewal-regno-cir-base', [App\Http\Controllers\FreshEmpanelmentController::class, 'checkRenewalRegCirBase']);
Route::get('check-renewal-unique-email-vendor', [App\Http\Controllers\FreshEmpanelmentController::class, 'checkUniqueEmailVendor']);
Route::get('checkgstprint', [App\Http\Controllers\FreshEmpanelmentController::class,'checkgstprint']);

 /* Vendor Agreement file Upload and download created by priyanshi */
    Route::get('file-upload', [AgreementController::class, 'fileUpload'])->name('file.upload');
    Route::post('file-upload', [AgreementController::class, 'agreement_file_upload'])->name('file.upload.post');
    Route::get('file-download', [AgreementController::class, 'agreement_download_file'])->name('file.download');

//vendor renewal agreement
Route::get('renewal-agreement-upload', [AgreementController::class, 'renewalAgreement'])->name('renewal-agreement-upload');
Route::post('renewal-agreement-upload', [AgreementController::class, 'renewalAgreementUpload'])->name('renewal-agreement-upload');
Route::get('renewal-agreement-download', [AgreementController::class, 'renewalAgreementDownload'])->name('renewal-agreement.download');


Route::get('master',[ClientSubmissionController::class,'npmaster']);  //Temparory code for create login details of existing vendors.
Route::get('/emailVerify',[App\http\controllers\auth\BocUserController::class,'emailVerify'])->name('emailVerify');
Route::get('getODMediaSubCat/{mediaGroupId?}/{mediaUIDCode?}', [ClientSubmissionController::class,'getODMediaSubCat'])->name('getODMediaSubCat');





Route::match(['get','post'],'vendor-signup', [App\http\controllers\auth\BocUserController::class,'createSignup'])->name('vendor-signup');
Route::get('signup_confirm', [App\Http\Controllers\auth\BocUserController::class, 'signup_confirm'])->name('signup_confirm');
Route::post('set-password', [App\Http\Controllers\auth\BocUserController::class, 'setpassword'])->name('setpassword');
Route::post('signup_confirm', [App\Http\Controllers\auth\BocUserController::class, 'signupConfirm'])->name('signupConfirm');
Route::get('resendotp', [App\Http\Controllers\auth\BocUserController::class, 'resendotp_form'])->name('resendotp_form');
Route::post('resendotp', [App\Http\Controllers\auth\BocUserController::class, 'resendotp_post'])->name('resendotp_post');
Route::get('logout', [App\Http\Controllers\auth\BocUserController::class, 'signOut'])->name('logout');
Route::get('{slug}',[App\http\controllers\auth\BocUserController::class,'showSigninForm']); 
Route::post('{slug1}',[App\http\controllers\auth\BocUserController::class,'createSignin']);
