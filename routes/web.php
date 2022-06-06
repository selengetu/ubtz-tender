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

// Exam Routes
Route::get('/create_exam', [ExamController::class, 'create'])->name('create_exam');
Route::get('/testProc', [ExamController::class, 'testProc']);

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');

//Order Routes
Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order');
Route::post('/saveOrder', [App\Http\Controllers\OrderController::class, 'saveOrder'])->name('saveOrder');
Route::get('/getorder/{hid?}', [App\Http\Controllers\OrderController::class, 'getorder'])->name('getorder');

//Tender Routes
Route::post('/saveTender', [App\Http\Controllers\OrderController::class, 'saveTender'])->name('saveTender');