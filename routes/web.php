<?php

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
    return view('index');
});

//pekerjaan 
Route::resource('/pekerjaan', 'PekerjaanController');
//end pekerjaan
Route::resource('/upload', 'UploadimgController');
Route::resource('/pengurus', 'ponpes\PengurusController');
Route::resource('/kamar', 'ponpes\KamarController');
Route::resource('/santri', 'ponpes\SantriController');
Route::resource('/ustad', 'tpq\UstadController');
// Route::get('/upload','UploadimgController@index')->name('upload');
// Route::get('/addupload','UploadimgController@create')->name('addupload');
// Route::post('/simpan-upload','UploadimgController@store')->name('simpan-upload');
// Route::get('/upload/{id}','UploadimgController@store')->name('upload');
// Route::post('/update-upload','UploadimgController@update')->name('update-upload');

// upload profile_img route
// Route::put('upload/ustad/{id}', 'UploadfotoController@ustad')->name('ustad.upload_foto');
// Route::put('upload/siswa/{id}', 'UploadfotoController@siswa')->name('siswa.upload_foto');

//TPQ
// kelas TPQ
Route::get('kelas', 'tpq\KelasController@index')->name('kelas.index');
Route::get('kelas/add', 'tpq\KelasController@create')->name('kelas.add');
Route::post('kelas/add', 'tpq\KelasController@store')->name('kelas.store');
Route::get('kelas/{id}/edit', 'tpq\KelasController@edit')->name('kelas.edit');
Route::patch('kelas/{id}/update', 'tpq\KelasController@update')->name('kelas.update');
Route::delete('kelas/hapus/{id}', 'tpq\KelasController@destroy')->name('kelas.destroy');
//santri TPQ
Route::resource('/siswa', 'tpq\SantritpqController');
// register Kelas
Route::get('/regis-kelas', 'tpq\RegiskelasController@index')->name('regiskelas.rk');
Route::get('/regis-kelas/regis/{kelas}', 'tpq\RegiskelasController@register')->name('rk.regis');
Route::post('/regis-kelas/regis/{kelas}/store', 'tpq\RegiskelasController@store')->name('regiskelas.rk.store');
Route::get('/regis-kelas/regis/{kelas}/list', 'tpq\RegiskelasController@list_kelas')->name('rk.list');
// Route::get('/regis-kelas/regis/delete/{id}', 'tpq\RegiskelasController@destroy')->name('regis.rk.delete');
Route::get('/regis-kelas/regis/{kelas}/delete/{id}', 'tpq\RegiskelasController@destroy')->name('regiskelas.rk.delete');

//end regis kelas
//tahun Akademik
// Route::resource('/tahun-akademik', 'TahunakademikController');
Route::get('/tahun-akademik', 'TahunakademikController@index')->name('tahun-akademik');
Route::get('/tahun-akademik/create', 'TahunakademikController@create')->name('tahun-akademik.create');
Route::post('/tahun-akademik/store', 'TahunakademikController@store')->name('tahun-akademik.store');
Route::get('/tahun-akademik/{id}/edit', 'TahunakademikController@edit')->name('tahun-akademik.edit');
Route::patch('/tahun-akademik/{id}/update', 'TahunakademikController@update')->name('tahun-akademik.update');
Route::get('/tahun-akademik/apply/{id}', 'TahunakademikController@apply')->name('tahun-akademik.apply');
Route::delete('/tahun-akademik/delete/{id}', 'TahunakademikController@destroy')->name('tahun-akademik.destroy');
//end tahun Akademik 
//regis
Route::get('/reg-kamar', 'ponpes\RegekamarController@index')->name('reg-kamar');
Route::get('/reg-kamar/register/{kamar}', 'ponpes\RegekamarController@register')->name('reg-kamar.register');
Route::post('/reg-kamar/register/{kamar}/store', 'ponpes\RegekamarController@store')->name('reg-kamar.register.store');
Route::get('/reg-kamar/register/{kamar}/list', 'ponpes\RegekamarController@list_kamar')->name('reg-kamar.list');
Route::get('/reg-kamar/register/{kamar}/delete/{id}', 'ponpes\RegekamarController@destroy')->name('reg-kamar.register.delete');

//end regis
//test register
Route::resource('/kamar-regis', 'ponpes\RegisterkamarController');
// spp
Route::resource('/spp-pondok', 'ponpes\SppController');
// // end spp

// Pembayaran
Route::get('/pembayaran', 'ponpes\PembayaranController@index')->name('pembayaran');
//end Pembayaran
