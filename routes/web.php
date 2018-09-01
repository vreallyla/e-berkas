<?php

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
    if (\Illuminate\Support\Facades\Auth::guest())
        return redirect(url('home'));
    else
        $cek = \Illuminate\Support\Facades\Auth::user()->role->name;
    if ($cek == 'Admin') {
        return redirect(url('admin'));
    } else
        return redirect(url('home'));
});
Auth::routes();

Route::get('404',['as'=>'404','uses'=>'ErrorHandlerController@errorCode404']);

Route::get('405',['as'=>'405','uses'=>'ErrorHandlerController@errorCode405']);

Route::match(['get', 'post'], 'register', function () {
    if (\Illuminate\Support\Facades\Auth::guest())
        return redirect(url('home'));
    else
        $cek = \Illuminate\Support\Facades\Auth::user()->role->name;
    if ($cek == 'Admin') {
        return redirect(url('admin'));
    } else
        return redirect(url('home'));
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'api'], function () {
        Route::get('mst/data2', 'eBerkasController@apiData2')->name('api.mst.data2');
        Route::get('mst/data3', 'eBerkasController@apiData3')->name('api.mst.data3');
        Route::get('mst/data', 'eBerkasController@apiData')->name('api.mst.data4');

    });
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'profileController@index')->name('profile');

    });

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'AdminController@index')->name('admin.dashboard');
        Route::get('dataget', 'AdminController@dataget')->name('admin.dataget');
        Route::get('datauniv', 'AdminController@datauniv')->name('admin.datauniv');
        Route::get('accept', 'AdminController@accept')->name('admin.accept');
        Route::get('reject', 'AdminController@reject')->name('admin.reject');
        Route::get('carouselget', 'AdminController@carouselget')->name('admin.carouselget');
        Route::get('suratshow', 'AdminController@suratshow')->name('admin.suratshow');
        Route::get('mstdatashow', 'AdminController@mstdatashow')->name('admin.mstdatashow');
        Route::post('carouseladd', 'AdminController@carouseladd')->name('admin.carouseladd');
        Route::post('carouseledit', 'AdminController@carouseledit')->name('admin.carouseledit');
        Route::get('carouseldelete', 'AdminController@carouseldelete')->name('admin.carouseldelete');

        Route::group(['prefix' => 'request'], function () {
            Route::get('/', 'AdminTableManageController@index')->name('admin.request.index');
            Route::get('/apiData', 'AdminTableManageController@apiData')->name('admin.request.apiData');
            Route::get('/accept', 'AdminTableManageController@accept')->name('admin.request.accept');
            Route::get('/deny', 'AdminTableManageController@deny')->name('admin.request.deny');

        });
        Route::group(['prefix' => 'table'], function () {
            Route::get('{users}', 'AdminTableUserController@index')->name('admin.table.user');
            Route::group(['prefix' => 'user'], function () {
                Route::get('/', 'AdminTableUserController@index')->name('admin.table.user');
                Route::get('/api', 'AdminTableUserController@apiUser')->name('admin.table.user.api');
                Route::get('/getPosisition', 'AdminTableUserController@getPosisition')->name('admin.table.user.getPosisition');
                Route::get('/api-penghuni', 'AdminTableLetterController@apiPenghuni')->name('admin.table.penghuni.api');
                Route::get('/api-histori', 'AdminTableLetterController@apiPenghunihistori')->name('admin.table.penghuni.histori');
                Route::get('/lihat', 'AdminTableUserController@lihat')->name('admin.table.pengguna.lihat');
                Route::get('/cekhapus', 'AdminTableUserController@cekhapus')->name('admin.table.pengguna.cekhapus');
                Route::get('/hapus', 'AdminTableUserController@hapus')->name('admin.table.pengguna.hapus');
                Route::get('/ceknip', 'AdminTableUserController@ceknip')->name('admin.table.pengguna.ceknip');
                Route::post('/edit', 'AdminTableUserController@edit')->name('admin.table.pengguna.edit');
                Route::post('/storesuratplus', 'AdminTableUserController@storesuratplus')->name('admin.table.pengguna.storesuratplus');
                Route::get('/resend', 'AdminTableUserController@resend')->name('admin.table.pengguna.resend');
            });
            Route::group(['prefix' => 'letter'], function () {
                Route::get('/', 'AdminTableLetterController@index')->name('admin.table.letter');
                Route::get('/api', 'AdminTableLetterController@api')->name('admin.table.letter.api');
                Route::get('/lihat', 'AdminTableLetterController@lihat')->name('admin.table.letter.lihat');
                Route::get('/cekhapus', 'AdminTableLetterController@cekhapus')->name('admin.table.letter.cekhapus');
                Route::get('/hapus', 'AdminTableLetterController@hapus')->name('admin.table.letter.hapus');
                Route::post('/storesurat', 'AdminTableLetterController@storesurat')->name('admin.table.letter.storesurat');
                Route::post('/storesuratplus', 'AdminTableLetterController@storesuratplus')->name('admin.table.letter.storesuratplus');
                Route::get('/apisurat', 'AdminTableUserController@apiSurat')->name('admin.table.surat.api');
                Route::post('/edit', 'AdminTableLetterController@edit')->name('admin.table.surat.edit');


            });
        });

    });


    Route::group(['prefix' => 'user'], function () {
        Route::get('update', 'UserController@index')->name('user.update');
        Route::get('getjob', 'UserController@getjob')->name('user.getjob');
        Route::post('store', 'UserController@store')->name('user.store');
        Route::get('waktu', 'UserController@waktu')->name('user.waktu');
        Route::get('cek', 'UserController@cek')->name('user.cek');
        Route::get('kirim', 'UserController@kirim')->name('user.kirim');
        Route::group(['middleware' => ['role']], function () {
            Route::get('pengurus', 'UserController@pengurus')->name('user.pengurus');
            Route::post('suratplus', 'UserController@suratplus')->name('user.suratplus');
            Route::get('ceksurat', 'UserController@ceksurat')->name('user.ceksurat');
            Route::get('data', 'UserController@apiData')->name('user.data');
        });
    });
    Route::group(['prefix' => 'eBerkas'], function () {
//        Route::get('/', 'eBerkasController@index')->name('eberkas.index');
        Route::get('/', 'eBerkasduaController@index')->name('eberkas.index');
//        Route::post('save', 'eBerkasController@store')->name('eberkas.store');
        Route::post('save', 'eBerkasduaController@store')->name('eberkas.store');

        Route::get('apieberkas', 'eBerkasduaController@api')->name('eberkas.api');
        Route::get('jumlah', 'eBerkasController@jumlah')->name('eberkas.jumlah');
        Route::get('show', 'eBerkasduaController@edit')->name('eberkas.show');
        Route::get('delete', 'eBerkasduaController@destroy')->name('eberkas.delete');
        Route::get('deleteperm', 'eBerkasController@deleteperm')->name('eberkas.deleteperm');
        Route::get('restore', 'eBerkasduaController@restore')->name('eberkas.restore');
        Route::get('history', 'eBerkasduaController@history')->name('eberkas.history');
        Route::post('cek', 'eBerkasController@cek')->name('eberkas.cek');
        Route::post('update', 'eBerkasduaController@update')->name('eberkas.update');
        Route::post('multiupdate', 'eBerkasduaController@multiupdate')->name('eberkas.multiupdate');
    });
    Route::group(['prefix' => 'employes'], function () {
        Route::get('/coba', 'EmployesController@coba')->name('coba');
        Route::get('/coba2', 'EmployesController@coba2')->name('coba2');
        Route::get('/caridata', 'EmployesController@caridata');
        Route::get('/', 'EmployesController@index')->name('employes.index');
    });
});

Route::get('/home', 'GeneralController@index')->name('dashboard');
Route::get('/get', 'GeneralController@get')->name('get');
Route::get('/coba', 'GeneralController@index')->name('rumah');
Route::get('/tryemil', 'AdminTableUserController@tryna')->name('tryna');

