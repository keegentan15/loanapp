<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoanPackageController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LoanRecordController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\InquiryController;



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




Route::resource('admin/staff', StaffController::class);

Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware('isLoggedIn'); 
Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('AlreadyLoggedIn');
Route::post('login-user', [AuthController::class, 'loginUser'])->name('login-user'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

Route::get('admin/activitylog', [ActivityLogController::class, 'index'])->name('activitylog');
Route::get('admin/activitylog/show/{id}', [ActivityLogController::class, 'show'])->name('activitylog-show');

Route::get('admin/inquiry', [InquiryController::class, 'index'])->name('inquiry');
Route::get('admin/inquiry/{id}', [InquiryController::class, 'view'])->name('inquiry-view');
Route::delete('admin/inquiry/{id}', [InquiryController::class, 'destroy'])->name('inquiry-destroy');

Route::get('/', [HomepageController::class, 'index']);
Route::post('/', [HomepageController::class, 'ContactUsForm'])->name('contact.store');

//Route::resource('api',ApiController::class);
Route::get('/admin',[StaffController::class,'index'])->name('index');
Route::get('/admin/test',[StaffController::class,'test']);
Route::get('/admin/checkauth',[AdminController::class,'loginauth']);

Route::middleware('apiauth')->group(function(){
    Route::get('/api/token',[ApiController::class,'token']);
    Route::get('/api/login',[ApiController::class,'login']);
    Route::post('/api/register',[ApiController::class,'register']);
    Route::post('/api/createcontact',[ApiController::class,'createcontact']);
    Route::get('/api/loanlist',[ApiController::class,'loanlist']);
    Route::get('/api/loanpackage',[ApiController::class,'loanpackage']);
    Route::post('/api/applyloan',[ApiController::class,'applyloan']);
    Route::post('/api/editprofile',[ApiController::class,'editprofile']);
});

Route::get('/admin/package',[LoanPackageController::class,'index'])->name('loanpackage')->middleware('isLoggedIn');
Route::get('/admin/package/create',[LoanPackageController::class,'create']);
Route::post('/admin/package/create',[LoanPackageController::class,'create']);
Route::post('/admin/package/updatestatus',[LoanPackageController::class,'updatestatus']);
Route::get('/admin/package/edit/{id}',[LoanPackageController::class,'edit']);
Route::post('/admin/package/edit',[LoanPackageController::class,'edit']);



Route::get('/admin/user',[UserController::class,'index'])->name('user');
Route::post('/admin/user/approval',[UserController::class,'approvalaction']);
Route::get('/admin/user/view/{id}',[UserController::class,'view'])->name('viewuser');
Route::get('/admin/user/exportcontact/{id}',[UserController::class,'exportcontact'])->name('exportcontact');

Route::get('/admin/loan/active',[LoanRecordController::class,'active'])->name('activeloan');
Route::get('/admin/loan/application',[LoanRecordController::class,'application'])->name('loanapplication');
Route::get('/admin/loan/rejected',[LoanRecordController::class,'rejected'])->name('rejectedloan');
Route::get('/admin/loan/completed',[LoanRecordController::class,'completed'])->name('completedloan');
Route::get('/admin/loan/view/{id}',[LoanRecordController::class,'view'])->name('viewloan');
Route::get('/admin/loan/pendingtransfer',[LoanRecordController::class,'pendingtransfer'])->name('pendingtransfer');
Route::get('/admin/loan/latepayment',[LoanRecordController::class,'latepayment'])->name('latepayment');
Route::post('/admin/loan/transfer/{id}',[LoanRecordController::class,'transfer'])->name('transfer');
Route::post('/admin/loan/approveloan/{id}',[LoanRecordController::class,'approve']);
Route::post('/admin/loan/rejectloan/{id}',[LoanRecordController::class,'reject']);
Route::post('/admin/loan/complete/{id}',[LoanRecordController::class,'complete'])->name('complete');





