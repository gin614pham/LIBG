<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDauSachController;
use App\Http\Controllers\AdminDocGiaController;
use App\Http\Controllers\AdminNgonNguController;
use App\Http\Controllers\AdminNhaCungCapController;
use App\Http\Controllers\AdminPhanLoaiController;
use App\Http\Controllers\AdminPhieuMuonController;
use App\Http\Controllers\AdminPhieuNhapController;
use App\Http\Controllers\AdminSachController;
use App\Http\Controllers\AdminThanhLyController;
use App\Http\Controllers\AdminTheLoaiController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminViPhamController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

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
Route::get('/mail', [AdminController::class, 'sendNotification']);
Route::get('/', [AdminController::class, 'login'])->name('admin.auth.login');
Route::post('/admin/login', [AdminController::class, 'getLogin'])->name('admin.auth.login.post');


Route::group(['prefix'=>'admin', 'middleware' => 'auth'], function (){
    Route::get('/logout',[AdminController::class, 'logout'])->name('admin.auth.logout');
    Route::get('/send/{id}',[AdminController::class, 'sendNotification'])->name('admin.auth.notification');
    Route::get('/statistical', [AdminController::class, 'statistical'])->name('admin.statistical.index');

    Route::group(['prefix'=>'vipham'], function (){
        Route::get('/', [AdminViPhamController::class, 'index'])->name('admin.vipham.index');
        Route::get('/create', [AdminViPhamController::class, 'create'])->name('admin.vipham.create');
        Route::post('/store', [AdminViPhamController::class,'store'])->name('admin.vipham.store');
        Route::get('/edit/{id}',[AdminViPhamController::class, 'edit'])->name('admin.vipham.edit');
        Route::post('/update/{id}/{name}', [AdminViPhamController::class, 'update'])->name('admin.vipham.update');
        Route::get('/delete/{id}',[AdminViPhamController::class, 'destroy'])->name('admin.vipham.delete');
    });
    Route::group(['prefix'=>'docgia'], function(){
        Route::get('/', [AdminDocGiaController::class, 'index'])->name('admin.docgia.index');
        Route::get('/create',[AdminDocGiaController::class, 'create'])->name('admin.docgia.create');
        Route::post('/store',[AdminDocGiaController::class, 'store'])->name('admin.docgia.store');
        Route::get('/edit/{id}',[AdminDocGiaController::class, 'edit'])->name('admin.docgia.edit');
        Route::post('/update/{id}', [AdminDocGiaController::class, 'update'])->name('admin.docgia.update');
        Route::get('/delete/{id}',[AdminDocGiaController::class, 'destroy'])->name('admin.docgia.delete');
        Route::get('/view/{id}',[AdminDocGiaController::class, 'show'])->name('admin.docgia.view');
    });
    Route::group(['prefix'=>'ngonngu'], function(){
        Route::get('/', [AdminNgonNguController::class, 'index'])->name('admin.ngonngu.index');
        Route::get('/create',[AdminNgonNguController::class, 'create'])->name('admin.ngonngu.create');
        Route::post('/store',[AdminNgonNguController::class, 'store'])->name('admin.ngonngu.store');
        Route::get('/edit/{id}',[AdminNgonNguController::class, 'edit'])->name('admin.ngonngu.edit');
        Route::post('/update/{id}',[AdminNgonNguController::class, 'update'])->name('admin.ngonngu.update');
        Route::get('/delete/{id}',[AdminNgonNguController::class,'destroy'])->name('admin.ngonngu.delete');
    });
    Route::group(['prefix'=>'nhacungcap'], function (){
        Route::get('/', [AdminNhaCungCapController::class, 'index'])->name('admin.nhacungcap.index');
        Route::get('/create',[AdminNhaCungCapController::class, 'create'])->name('admin.nhacungcap.create');
        Route::post('/store',[AdminNhaCungCapController::class, 'store'])->name('admin.nhacungcap.store');
        Route::get('/edit/{id}',[AdminNhaCungCapController::class, 'edit'])->name('admin.nhacungcap.edit');
        Route::post('/update/{id}',[AdminNhaCungCapController::class, 'update'])->name('admin.nhacungcap.update');
        Route::get('/delete/{id}',[AdminNhaCungCapController::class,'destroy'])->name('admin.nhacungcap.delete');
    });
    Route::group(['prefix'=>'phanloai'], function (){
        Route::get('/', [AdminPhanLoaiController::class, 'index'])->name('admin.phanloai.index');
        Route::get('/create',[AdminPhanLoaiController::class, 'create'])->name('admin.phanloai.create');
        Route::post('/store',[AdminPhanLoaiController::class, 'store'])->name('admin.phanloai.store');
        Route::get('/edit/{id}',[AdminPhanLoaiController::class, 'edit'])->name('admin.phanloai.edit');
        Route::post('/update/{id}',[AdminPhanLoaiController::class, 'update'])->name('admin.phanloai.update');
        Route::get('/delete/{id}',[AdminPhanLoaiController::class,'destroy'])->name('admin.phanloai.delete');
    });
    Route::group(['prefix'=>'phieumuon'], function (){
        Route::get('/', [AdminPhieuMuonController::class, 'index'])->name('admin.phieumuon.index');
        Route::get('/create',[AdminPhieuMuonController::class, 'create'])->name('admin.phieumuon.create');
        Route::post('/store',[AdminPhieuMuonController::class, 'store'])->name('admin.phieumuon.store');
        Route::get('/edit/{id}',[AdminPhieuMuonController::class, 'edit'])->name('admin.phieumuon.edit');
        Route::post('/update/{id}',[AdminPhieuMuonController::class, 'update'])->name('admin.phieumuon.update');
        Route::get('/delete/{id}',[AdminPhieuMuonController::class,'destroy'])->name('admin.phieumuon.delete');
        Route::get('trasach/{id}',[AdminPhieuMuonController::class,'traSach'])->name('admin.phieumuon.check');

    });
    Route::group(['prefix'=>'phieunhap'], function (){
        Route::get('/', [AdminPhieuNhapController::class, 'index'])->name('admin.phieunhap.index');
        Route::get('/create',[AdminPhieuNhapController::class, 'create'])->name('admin.phieunhap.create');
        Route::post('/store',[AdminPhieuNhapController::class, 'store'])->name('admin.phieunhap.store');
        Route::get('/delete/{id}',[AdminPhieuNhapController::class,'destroy'])->name('admin.phieunhap.delete');
    });
    Route::group(['prefix'=>'thanhly'], function (){
        Route::get('/', [AdminThanhLyController::class, 'index'])->name('admin.thanhly.index');
        Route::get('/store/{id}/{lydo}',[AdminThanhLyController::class, 'store'])->name('admin.thanhly.store');
        Route::get('/update/{id}/{lydo}',[AdminThanhLyController::class, 'update'])->name('admin.thanhly.update');
        Route::get('/delete/{id}',[AdminThanhLyController::class,'destroy'])->name('admin.thanhly.delete')
            ->middleware('checkUserAllow::class');
        Route::get('/restore/{id}',[AdminThanhLyController::class,'restore'])->name('admin.thanhly.restore')
            ->middleware('checkUserAllow::class');
    });
    Route::group(['prefix'=>'theloai'], function (){
        Route::get('/', [AdminTheLoaiController::class, 'index'])->name('admin.theloai.index');
        Route::get('/create',[AdminTheLoaiController::class, 'create'])->name('admin.theloai.create');
        Route::post('/store',[AdminTheLoaiController::class, 'store'])->name('admin.theloai.store');
        Route::get('/edit/{id}',[AdminTheLoaiController::class, 'edit'])->name('admin.theloai.edit');
        Route::post('/update/{id}',[AdminTheLoaiController::class, 'update'])->name('admin.theloai.update');
        Route::get('/delete/{id}',[AdminTheLoaiController::class,'destroy'])->name('admin.theloai.delete');
    });
    Route::group(['prefix'=>'dausach'], function (){
        Route::get('/', [AdminDauSachController::class, 'index'])->name('admin.dausach.index');
        Route::get('/create',[AdminDauSachController::class, 'create'])->name('admin.dausach.create');
        Route::post('/store',[AdminDauSachController::class, 'store'])->name('admin.dausach.store');
        Route::get('/edit/{id}',[AdminDauSachController::class, 'edit'])->name('admin.dausach.edit');
        Route::post('/update/{id}',[AdminDauSachController::class, 'update'])->name('admin.dausach.update');
        Route::get('/delete/{id}',[AdminDauSachController::class, 'destroy'])->name('admin.dausach.delete');
    });
    Route::group(['prefix' =>'sach'], function(){
        Route::get('/', [AdminSachController::class, 'index'])->name('admin.sach.index');
        Route::post('/store',[AdminSachController::class, 'store'])->name('admin.sach.store');
        Route::get('/edit/{id}',[AdminSachController::class,'edit'])->name('admin.sach.edit');
        Route::post('/update/{id}',[AdminSachController::class,'update'])->name('admin.sach.update');
        Route::get('/delete/{id}',[AdminSachController::class, 'destroy'])->name('admin.sach.delete')
            ->middleware('checkUserAllow::class');
    });
    Route::group(['prefix'=>'user', 'middleware' => 'checkUserAllow'], function (){
        Route::get('/', [AdminUserController::class, 'index'])->name('admin.user.index');
        Route::get('/create',[AdminUserController::class, 'create'])->name('admin.user.create');
        Route::post('/store',[AdminUserController::class, 'store'])->name('admin.user.store');
        Route::get('/edit/{id}',[AdminUserController::class,'edit'])->name('admin.user.edit');
        Route::post('/update/{id}',[AdminUserController::class,'update'])->name('admin.user.update');
        Route::get('/delete/{id}',[AdminUserController::class, 'destroy'])->name('admin.user.delete');
    });



});






