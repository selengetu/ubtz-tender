<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\RepController;
use App\Http\Controllers\OrderController;
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

Route::get('/', function () {
    return view('auth.login');
});

//AUTH
//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/person', [App\Http\Controllers\HomeController::class, 'person'])->name('person');
Route::get('/perDel/{perid}', [App\Http\Controllers\HomeController::class, 'perDel'])->name('perDel');
Route::get('/dep', [App\Http\Controllers\HomeController::class, 'person'])->name('person');
Route::get('/getPersons/{depid}/{type}', [App\Http\Controllers\HomeController::class, 'getPersons'])->name('getPersons');
Route::get('/getPerson/{hid}', [App\Http\Controllers\HomeController::class, 'getPerson'])->name('getPerson');
Route::post('/savePerson', [App\Http\Controllers\HomeController::class, 'savePerson'])->name('savePerson');

Route::get('/config',  [App\Http\Controllers\HomeController::class,'config'])->name('config');
Route::post('/passw',  [App\Http\Controllers\HomeController::class,'passw'])->name('passw');
Route::get('/passEdit/{hid?}',  [App\Http\Controllers\HomeController::class,'passEdit'])->name('passEdit');

Route::get('/job', [App\Http\Controllers\HomeController::class, 'job'])->name('job');
Route::post('/saveJob', [App\Http\Controllers\HomeController::class, 'saveJob'])->name('saveJob');
Route::get('/getJobs/{hid?}', [App\Http\Controllers\HomeController::class, 'getJobs'])->name('getJobs');
Route::get('/jobDel/{hid?}',[App\Http\Controllers\HomeController::class,'jobDel'])->name('jobDel');

Route::get('/material',  [MaterialController::class, 'index'])->name('material');
Route::post('/addTrainingFile', [MaterialController::class, 'addTrainingFile'])->name('addTrainingFile');
Route::get('/show-training-file/{hid?}', [MaterialController::class, 'showTrainingFile'])->name('show-training-file');
Route::get('/getsgroup/{id?}',function($id = 0){
    return DB::table('EXAMUBTZ.trainingtype')->where('parentid','=',$id)->get();
});
Route::get('/delmat/{hid?}',[MaterialController::class,'delmat'])->name('delmat');
// Route::get('/gettraining/{id?}',function($id = 0){
//     $dt=DB::table('training_file')->where('trid','=',$id)->get();
//     return $dt;
// });

 Route::get('/getmaterial/{id?}',function($id = 0){
     $dt=DB::table('EXAMUBTZ.V_TRAINING')->where('trid','=',$id)->get();
    return $dt;
 });

Route::get('/dep', [App\Http\Controllers\DepController::class, 'dep'])->name('dep');
Route::post('/saveDep', [App\Http\Controllers\DepController::class, 'saveDep'])->name('saveDep');
Route::get('/getDep/{hid?}', [App\Http\Controllers\DepController::class, 'getDep'])->name('getDep');
Route::get('/delDep/{hid?}',[App\Http\Controllers\DepController::class,'delDep'])->name('delDep');

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');

//Order Routes
Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order');
Route::post('/saveOrder', [App\Http\Controllers\OrderController::class, 'saveOrder'])->name('saveOrder');
Route::get('/getorder/{hid?}', [App\Http\Controllers\OrderController::class, 'getorder'])->name('getorder');
Route::get('/delOrder/{hid?}',[App\Http\Controllers\OrderController::class,'delOrder'])->name('delOrder');

//Tender Routes
Route::post('/saveTender', [App\Http\Controllers\TenderController::class, 'saveTender'])->name('saveTender');
Route::get('/getTenders/{hid?}', [App\Http\Controllers\TenderController::class, 'getTenders'])->name('getTenders');
Route::get('/getTender/{hid?}', [App\Http\Controllers\TenderController::class, 'getTender'])->name('getTender');
Route::get('/delTender/{hid?}',[App\Http\Controllers\TenderController::class,'delTender'])->name('delTender');

//Contract Routes
Route::post('/saveContract', [App\Http\Controllers\ContractController::class, 'saveContract'])->name('saveContract');
Route::get('/getContracts/{hid?}', [App\Http\Controllers\ContractController::class, 'getContracts'])->name('getContracts');

Route::post('/saveOrderDetail', [App\Http\Controllers\OrderController::class, 'saveOrderDetail'])->name('saveOrderDetail');
Route::get('/getorderdetail/{hid?}', [App\Http\Controllers\OrderController::class, 'getorderdetail'])->name('getorderdetail');
Route::get('/getorderdetails/{hid?}', [App\Http\Controllers\OrderController::class, 'getorderdetails'])->name('getorderdetails');
Route::get('/delDetail/{hid?}',[App\Http\Controllers\OrderController::class,'delDetail'])->name('delDetail');

Route::post('/saveProgress', [App\Http\Controllers\TenderController::class, 'saveProgress'])->name('saveProgress');
Route::post('/saveComplaint', [App\Http\Controllers\TenderController::class, 'saveComplaint'])->name('saveComplaint');

Route::post('/savePack', [App\Http\Controllers\PackController::class, 'savePack'])->name('savePack');
Route::get('/getpack/{hid?}', [App\Http\Controllers\PackController::class, 'getpack'])->name('getpack');
Route::get('/getpacks/{hid?}', [App\Http\Controllers\PackController::class, 'getpacks'])->name('getpacks');

Route::post('/saveProgress', [App\Http\Controllers\ProgressController::class, 'saveProgress'])->name('saveProgress');
Route::get('/getprogress/{hid?}', [App\Http\Controllers\ProgressController::class, 'getprogress'])->name('getprogress');
Route::get('/getprogresses/{hid?}', [App\Http\Controllers\ProgressController::class, 'getprogresses'])->name('getprogresses');

Route::post('/saveComplaint', [App\Http\Controllers\ComplaintController::class, 'saveComplaint'])->name('saveComplaint');
Route::get('/getcomplaint/{hid?}', [App\Http\Controllers\ComplaintController::class, 'getcomplaint'])->name('getcomplaint');
Route::get('/getcomplaints/{hid?}', [App\Http\Controllers\ComplaintController::class, 'getcomplaints'])->name('getcomplaints');

Route::post('/saveKomiss', [App\Http\Controllers\KomissController::class, 'saveKomiss'])->name('saveKomiss');
Route::get('/getkomiss/{hid?}', [App\Http\Controllers\KomissController::class, 'getkomiss'])->name('getkomiss');
Route::get('/getkomisses/{hid?}', [App\Http\Controllers\KomissController::class, 'getkomisses'])->name('getkomisses');

Route::get('/reportTender', [App\Http\Controllers\ReportController::class, 'reportTender'])->name('reportTender');
Route::get('/reportTenderDetail', [App\Http\Controllers\ReportController::class, 'reportTenderDetail'])->name('reportTenderDetail');
Route::get('/reportContract', [App\Http\Controllers\ReportController::class, 'reportContract'])->name('reportContract');
Route::get('/reportProgress', [App\Http\Controllers\ReportController::class, 'reportProgress'])->name('reportProgress');

Route::get('/filter_dep/{id?}', [App\Http\Controllers\ReportController::class, 'filter_dep']);
Route::get('/filter_tendertype/{id?}', [App\Http\Controllers\ReportController::class, 'filter_tendertype']);
Route::get('/filter_selection/{id?}', [App\Http\Controllers\ReportController::class, 'filter_selection']);

Route::post('/saveTenderState', [App\Http\Controllers\TenderStateController::class, 'saveTenderState'])->name('saveTenderState');
Route::get('/getTenderState/{hid?}', [App\Http\Controllers\TenderStateController::class, 'getTenderState'])->name('getTenderState');
Route::get('/tenderstate', [App\Http\Controllers\TenderStateController::class, 'index'])->name('tenderstate');


Route::post('/saveContract', [App\Http\Controllers\ContractController::class, 'saveContract'])->name('saveContract');
Route::get('/getcontract/{hid?}', [App\Http\Controllers\ContractController::class, 'getcontract'])->name('getcontract');
Route::get('/getcontracts/{hid?}', [App\Http\Controllers\ContractController::class, 'getcontracts'])->name('getcontracts');

Route::post('/saveContractProgress', [App\Http\Controllers\ContractController::class, 'saveContractProgress'])->name('saveContractProgress');
Route::get('/getcontractprogress/{hid?}', [App\Http\Controllers\ContractController::class, 'getcontractprogress'])->name('getcontractprogress');
Route::get('/getcontractprogresses/{hid?}', [App\Http\Controllers\ContractController::class, 'getcontractprogresses'])->name('getcontractprogresses');