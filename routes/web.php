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
    return view('auth.login');
});


Auth::routes();

Route::group( ['middleware' => ['auth','permission_clearance']], function() {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('positions','PositionController');
    Route::get('preview-positions','ReportController@getPositionPreview');

    Route::resource('departments','DepartmentController');
    Route::get('preview-departments','ReportController@getDepartmentPreview');
    Route::get('dept_code/{id}','DepartmentController@getDeptCode');

    Route::resource('employees','EmployeeController');
    Route::get('preview-employees','ReportController@getEmployeePreview');
    Route::get('nomer_karyawan/{dept_id}/{join_date}','EmployeeController@empAutoNumber');
    Route::get('list_emp','EmployeeController@getAllEmployee');

    Route::resource('projects','ProjectController');
    Route::get('preview-projects','ReportController@getProjectPreview');

    //Route::resource('settings','SettingController');

    Route::resource('advanceds','AdvanceController');
    Route::get('preview-form/{id}','ReportController@getFormKasbonPreview');
    Route::get('preview-advanced','ReportController@getAdvancedPreview');

    Route::resource('attends','AttendController');
    Route::patch('overtime/{id}','AttendController@updateLembur');
    Route::get('get_dataovertime/{id}','AttendController@getDetailEmpLembur');
    Route::get('absensi','AttendController@getAllAttend');

    Route::resource('calculates','CalculateController');
    Route::get('tarik_data/{dari_tgl}/sampai/{tanggal}','CalculateController@getDataAbsensi');
    //Route::get('list_payroll','CalculateController@getListPayroll');

    Route::resource('users','UserController');
    Route::get('preview-users','ReportController@getUserPreview');

    //Role Access
    Route::resource('roles', 'RoleController');
    Route::get('datagrid_roles','RoleController@getAllRoles');
    
    //Permission
    Route::resource('permissions','PermissionController');
    Route::get('datagrid_permission','PermissionController@getAllPermissions');

    Route::get('settings','SettingController@index');

});


Route::group(['middleware' => 'web'], function () {
    //Route::auth();
    /*Route::get(
        'login',
        [
            'as' => 'login',
            'middleware' => ['web'],
            'uses' => 'Auth\LoginController@showLoginForm' ]
    );*/

    Route::post(
        'login',
        [
            'as' => 'login',
            'middleware' => ['web'],
            'uses' => 'Auth\LoginController@login' ]
    );

    Route::get(
        'logout',
        [
            'as' => 'logout',
            'uses' => 'Auth\LoginController@logout' ]
    );

});