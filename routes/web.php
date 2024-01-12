<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\JadwalmatakulController;

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');



Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('get_all_jadwal_mata_kuliah_mahasiswa', [DashboardController::class, 'getAllJadwalmatakulMahasiswa'])->name('get_all_jadwal_mata_kuliah_mahasiswa');
    Route::get('get_all_jadwal_mata_kuliah_dosen', [DashboardController::class, 'getAllJadwalmatakulDosen'])->name('get_all_jadwal_mata_kuliah_dosen');
    Route::group(['middleware' => ['auth', 'admin']], function () {

        // JURUSAN
        Route::get('jurusan', [JurusanController::class, 'index'])->name('jurusan');
        Route::get('get_all_jurusan', [JurusanController::class, 'getAllJurusan'])->name('get_all_jurusan');
        Route::get('get_jurusan_by_id/{id}', [JurusanController::class, 'getJurusanById'])->name('get_jurusan_by_id');
        Route::any('add_jurusan', [JurusanController::class, 'addJurusan'])->name('add_jurusan');
        Route::any('edit_jurusan', [JurusanController::class, 'editJurusan'])->name('edit_jurusan');
        Route::any('delete_jurusan/{id}', [JurusanController::class, 'deleteJurusan'])->name('delete_jurusan');

        //KELAS
        Route::get('kelas', [KelasController::class, 'index'])->name('kelas');
        Route::get('get_all_kelas', [KelasController::class, 'getAllKelas'])->name('get_all_kelas');
        Route::get('get_kelas_by_id/{id}', [KelasController::class, 'getKelasById'])->name('get_kelas_by_id');
        Route::any('add_kelas', [KelasController::class, 'addKelas'])->name('add_kelas');
        Route::any('edit_kelas', [KelasController::class, 'editKelas'])->name('edit_kelas');
        Route::any('delete_kelas/{id}', [KelasController::class, 'deleteKelas'])->name('delete_kelas');

        //MAHASISWA
        Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
        Route::get('get_all_mahasiswa', [MahasiswaController::class, 'getAllMahasiswa'])->name('get_all_mahasiswa');
        Route::get('get_mahasiswa_by_id/{id}', [MahasiswaController::class, 'getMahasiswaById'])->name('get_mahasiswa_by_id');
        Route::any('add_mahasiswa', [MahasiswaController::class, 'addMahasiswa'])->name('add_mahasiswa');
        Route::any('edit_mahasiswa', [MahasiswaController::class, 'editMahasiswa'])->name('edit_mahasiswa');
        Route::any('delete_mahasiswa/{id}', [MahasiswaController::class, 'deleteMahasiswa'])->name('delete_mahasiswa');

        //DOSEN
        Route::get('dosen', [DosenController::class, 'index'])->name('dosen');
        Route::get('get_all_dosen', [DosenController::class, 'getAllDosen'])->name('get_all_dosen');
        Route::get('get_dosen_by_id/{id}', [DosenController::class, 'getDosenById'])->name('get_dosen_by_id');
        Route::any('add_dosen', [DosenController::class, 'addDosen'])->name('add_dosen');
        Route::any('edit_dosen', [DosenController::class, 'editDosen'])->name('edit_dosen');
        Route::any('delete_dosen/{id}', [DosenController::class, 'deleteDosen'])->name('delete_dosen');

        //MATA KULIAH
        Route::get('mata_kuliah', [MatakuliahController::class, 'index'])->name('mata_kuliah');
        Route::get('get_all_mata_kuliah', [MatakuliahController::class, 'getAllMatakuliah'])->name('get_all_mata_kuliah');
        Route::get('get_mata_kuliah_by_id/{id}', [MatakuliahController::class, 'getMatakuliahById'])->name('get_mata_kuliah_by_id');
        Route::any('add_mata_kuliah', [MatakuliahController::class, 'addMatakuliah'])->name('add_mata_kuliah');
        Route::any('edit_mata_kuliah', [MatakuliahController::class, 'editMatakuliah'])->name('edit_mata_kuliah');
        Route::any('delete_mata_kuliah/{id}', [MatakuliahController::class, 'deleteMatakuliah'])->name('delete_mata_kuliah');

        //MATA KULIAH
        Route::get('jadwal_mata_kuliah', [JadwalmatakulController::class, 'index'])->name('jadwal_mata_kuliah');
        Route::get('get_all_jadwal_mata_kuliah', [JadwalmatakulController::class, 'getAllJadwalmatakul'])->name('get_all_jadwal_mata_kuliah');
        Route::get('get_all_hari', [JadwalmatakulController::class, 'getAllHari'])->name('get_all_hari');
        Route::get('get_jadwal_mata_kuliah_by_id/{id}', [JadwalmatakulController::class, 'getJadwalmatakulById'])->name('get_jadwal_mata_kuliah_by_id');
        Route::get('get_jadwal_mata_kuliah_by_id_kelas/{id}', [JadwalmatakulController::class, 'getJadwalmatakulByIdKelas'])->name('get_jadwal_mata_kuliah_by_id_kelas');
        Route::any('edit_jadwal_mata_kuliah', [JadwalmatakulController::class, 'editJadwalmatakul'])->name('edit_jadwal_mata_kuliah');
        Route::any('delete_jadwal_mata_kuliah/{id}', [JadwalmatakulController::class, 'deleteJadwalmatakul'])->name('delete_jadwal_mata_kuliah');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
