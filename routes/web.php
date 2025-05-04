<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUtamaController;
use App\Http\Controllers\LaporanakhirController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelaporController;
use App\Http\Controllers\PengawasController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\SettingController;
use App\Models\Pengawas;
use App\Models\Teknisi;
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

Route::get('/', function () {
    return view('login');
});
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/register', [RoleController::class, 'register'])->name('register');
Route::get('/register/pelapor', [RoleController::class, 'registerPelapor'])->name('register-pelapor');
Route::get('/register/teknisi', [RoleController::class, 'registerTeknisi'])->name('register-teknisi');
Route::get('/register/pengawas', [RoleController::class, 'registerPengawas'])->name('register-pengawas');
Route::post('/regist-pelapor', [PelaporController::class, 'regist'])->name('regist-pelapor');
Route::post('/regist-teknisi', [TeknisiController::class, 'regist'])->name('regist-teknisi');
Route::post('/regist-pengawas', [PengawasController::class, 'regist'])->name('regist-pengawas');

Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth:admin,pelapor,pengawas,teknisi,admin_utama']], function () {
    // ==============ROUTE UNTUK BAGIAN USER PELAPOR============== //
    Route::get('/profile-pelapor', [PelaporController::class, 'profile']);
    Route::post('/save-ttd-pelapor/{id}', [PelaporController::class, 'ttd'])->name('save-ttd-pelapor');;
    Route::post('/save-foto-pelapor/{id}', [PelaporController::class, 'foto'])->name('save-foto-pelapor');;
    Route::get('/dashboard-user', [LaporanController::class, 'dashU']);
    Route::post('/save-laporan', [LaporanController::class, 'store'])->name('save-laporan');
    Route::get('/comp', [PelaporController::class, 'index']);
    Route::get('/form-comp', [PelaporController::class, 'create']);
    Route::get('/detail-comp/{idlap}', [PelaporController::class, 'detail']);
    Route::get('/edit-comp/{idlap}', [PelaporController::class, 'edit']);
    Route::post('/update-comp/{idlap}', [PelaporController::class, 'updateLap'])->name('update-comp');
    Route::post('/proses-tambah-waktu/{idlap}', [PelaporController::class, 'tambahwaktu'])->name('proses-tambah-waktu');
    Route::post('/acc-laporan/{idlap}', [PelaporController::class, 'acclap'])->name('acc-laporan');
    Route::match(['get', 'post'], '/history-user',[PelaporController::class, 'history'])->name('history-user');
    Route::post('/delete-laporan/{idlap}', [LaporanController::class, 'delete'])->name('delete-laporan');
    Route::get('/getNoInventarisOptions', [LaporanController::class, 'getNoInventarisOptions']);
    Route::get('/password', [PelaporController::class, 'password']);
    Route::post('/ubah-password', [PelaporController::class, 'ubahpassword'])->name('ubah-password');
    Route::post('/laptidaksesuai/{id}', [PelaporController::class, 'laptidaksesuai'])->name('laptidaksesuai');


    // ==============ROUTE UNTUK BAGIAN ADMIN============== //
    Route::get('/laporan-admin', [AdminController::class, 'index']);
    Route::get('/laporan-alihkan', [AdminController::class, 'laporan_alihkan']);
    Route::post('/acc-laporan-alihkan/{idlap}', [AdminController::class, 'acc_laporan_alihkan'])->name('acc-laporan-alihkan');
    Route::get('/kop-surat', [AdminController::class, 'kop_surat']);
    Route::post('/update-kop-surat/{id}', [AdminController::class, 'update_kop_surat'])->name('update-kop-surat');
    Route::post('/preview-kop-surat/{id}', [AdminController::class, 'preview_kop_surat'])->name('preview-kop-surat');
    Route::get('/detail-laporan-admin/{id}', [AdminController::class, 'detail']);
    Route::post('/pilih-teknisi/{id}', [AdminController::class, 'teknisi'])->name('pilih-teknisi');
    Route::post('/manager/{id}', [AdminController::class, 'sendtoManager'])->name('manager');
    Route::get('/dashboard-admin', [AdminController::class, 'dashboard']);
    Route::get('/send-manager', [AdminController::class, 'manager']);
    Route::match(['get', 'post'],'/history-admin', [AdminController::class, 'history'])->name('history-admin');
    Route::get('/getNoInventarisOptionsAdmin', [AdminController::class, 'getNoInventarisOptionsAdmin']);

    Route::get('/kategori', [KategoriController::class, 'read']);
    Route::post('/kategori-form', [KategoriController::class, 'create'])->name('kategori-form');
    Route::get('/kategori-hapus', [KategoriController::class, 'delete'])->name('kategori-hapus');

    Route::get('/role', [RoleController::class, 'read']);
    Route::get('/role-form/{id}', [RoleController::class, 'form'])->name('role-form');
    Route::post('/role-ubah', [RoleController::class, 'update'])->name('role-ubah');    

    Route::get('/list-akun-admin', [AdminController::class, 'akun']);
    Route::get('/persetujuan-akun-admin', [AdminController::class, 'listaccakun']);
    Route::post('/acc-akun/{id}', [AdminController::class, 'accakun'])->name('acc-akun');
    Route::post('/edit-pelapor-save/{id}', [AdminController::class, 'editpelapor'])->name('edit-pelapor-save');
    Route::post('/edit-teknisi-save/{id}', [AdminController::class, 'editteknisi'])->name('edit-teknisi-save');
    Route::post('/edit-pengawas-save/{id}', [AdminController::class, 'editpengawas'])->name('edit-pengawas-save');
    Route::get('/broadcast', [BroadcastController::class, 'index']);
    Route::get('/add-broadcast', [BroadcastController::class, 'create']);
    Route::post('/store-broadcast', [BroadcastController::class, 'store'])->name('store-broadcast');
    Route::get('/edit-broadcast/{id}', [BroadcastController::class, 'edit'])->name('edit-broadcast');
    Route::post('/update-broadcast/{id}', [BroadcastController::class, 'update'])->name('update-broadcast');
    Route::get('/aktivasi-akun', [AdminUtamaController::class, 'showAktivasiAkun'])->name('aktivasi-akun');
    Route::get('/aktivasi-akun/{pengajuanId}', [AdminUtamaController::class, 'aktivasi'])->name('aktivasi');
    Route::get('/setujui-aktivasi/{pengajuanId}', [AdminController::class, 'setujuiAktivasi'])->name('setujuiAktivasi');

    // ==============ROUTE UNTUK BAGIAN TEKNISI IT============== //
    Route::get('/profile-teknisi', [TeknisiController::class, 'profile']);
    Route::post('/save-ttd-teknisi/{id}', [TeknisiController::class, 'ttd'])->name('save-ttd-teknisi');;
    Route::get('/layanan-it', [TeknisiController::class, 'index']); //All data
    Route::get('/it', [TeknisiController::class, 'index2']);
    Route::get('/detail-comp-it/{id}', [TeknisiController::class, 'detail'])->name('detail-comp-it');
    Route::post('/proses-laporan/{id}',[TeknisiController::class, 'proses'])->name('proses-laporan');
    Route::post('/reset-waktu/{id}', [TeknisiController::class, 'resetwaktu'])->name('reset-waktu');
    Route::post('/tambah-waktu/{id}', [TeknisiController::class, 'tambahwaktu'])->name('tambah-waktu');
    Route::post('/laporan-selesai-it/{id}', [TeknisiController::class, 'selesai'])->name('laporan-selesai-it');
    Route::match(['get', 'post'], '/history-it', [TeknisiController::class, 'history'])->name('history-it');
    Route::get('/getNoInventarisOptionsIT', [TeknisiController::class, 'getNoInventarisOptionsIT']);
    Route::post('/detail-pekerjaan-it/{id_det}', [TeknisiController::class, 'pekerjaanIT'])->name('detail-pekerjaan-it');
    Route::post('/tambah-pekerjaan-it/{id}', [TeknisiController::class, 'tambahpekerjaanIT'])->name('tambah-pekerjaan-it');
    Route::get('/hapus-pekerjaan-it/{id}', [TeknisiController::class, 'hapuspekerjaanIT'])->name('hapus-pekerjaan-it');
    Route::get('/pengajuan-aktivasi', [AdminUtamaController::class, 'formPengajuanAktivasi'])->name('pengajuan-aktivasi');
    Route::post('/submit-aktivasi', [AdminUtamaController::class, 'submitAktivasi'])->name('submit-aktivasi');
    Route::post('/submit-kode-aktivasi', [AdminUtamaController::class, 'submitKodeAktivasi'])->name('submit-kode-aktivasi');


    // ==============ROUTE UNTUK BAGIAN PENGAWAS/MANAGER============== //
    Route::get('/dashboard-pengawas', function () {return view('pengawas.dashboard');});
    Route::get('/profile-pengawas', [PengawasController::class, 'profile']);
    Route::post('/save-ttd-pengawas/{id}', [PengawasController::class, 'ttd'])->name('save-ttd-pengawas');;
    Route::get('/list-akun', [PengawasController::class, 'akun']);
    Route::get('/list-laporan', [PengawasController::class, 'laporan']);
    Route::get('/ambil-laporan/{idlap}', [PengawasController::class, 'ambil'])->name('ambil-laporan');
    Route::get('/list-laporan-cetak', [PengawasController::class, 'laporan_cetak'])->name('list-laporan-cetak');
    Route::post('/alih-laporan-cetak/{idlap}', [PengawasController::class, 'alih_laporan'])->name('alih-laporan-cetak');
    Route::get('/cetak-laporan/{idlap}', [PengawasController::class, 'cetak'])->name('cetak-laporan');
    Route::get('/detail-laporan/{id}', [PengawasController::class, 'detail'])->name('detail-laporan');
    Route::post('/laporan-akhir/{idlap}', [LaporanakhirController::class, 'store'])->name('laporan-akhir');
    Route::get('/cetak', function () {return view('pengawas.cetak');});


    Route::get('/setting/no-telp/index', [SettingController::class, 'index'])->name('setting-no-telp-index');
    Route::post('/setting/no-telp/update', [SettingController::class, 'update'])->name('setting-no-telp-update');

});

