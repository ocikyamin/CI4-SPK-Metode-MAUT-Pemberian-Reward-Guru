<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
//  Auth Routes 
$routes->group('auth', static function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->post('check', 'Auth::LoginCheck');
});


$routes->group('admin', static function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
    $routes->get('logout', 'Admin\Dashboard::Logout');
});

// Sekolah 
$routes->group('admin/sekolah', static function ($routes) {
    $routes->get('/', 'Admin\Sekolah::index');
    $routes->get('show', 'Admin\Sekolah::Show');
    $routes->get('new', 'Admin\Sekolah::New');
    $routes->post('save', 'Admin\Sekolah::Save');
    $routes->get('edit', 'Admin\Sekolah::Edit');
    $routes->post('update', 'Admin\Sekolah::Update');
    $routes->post('delete', 'Admin\Sekolah::Delete');
});
// Periode 
$routes->group('admin/periode', static function ($routes) {
    $routes->get('/', 'Admin\Periode::index');
    $routes->get('show', 'Admin\Periode::Show');
    $routes->get('new', 'Admin\Periode::New');
    $routes->post('save', 'Admin\Periode::Save');
    $routes->get('edit', 'Admin\Periode::Edit');
    $routes->post('update', 'Admin\Periode::Update');
    $routes->post('status', 'Admin\Periode::Status');
    $routes->post('delete', 'Admin\Periode::Delete');
});
// Mapel 
$routes->group('admin/mapel', static function ($routes) {
    $routes->get('/', 'Admin\Mapel::index');
    $routes->get('show', 'Admin\Mapel::Show');
    $routes->get('new', 'Admin\Mapel::New');
    $routes->post('save', 'Admin\Mapel::Save');
    $routes->get('edit', 'Admin\Mapel::Edit');
    $routes->post('update', 'Admin\Mapel::Update');
    $routes->post('delete', 'Admin\Mapel::Delete');
});
// Kelas 
$routes->group('admin/kelas', static function ($routes) {
    $routes->get('/', 'Admin\Kelas::index');
    $routes->get('show', 'Admin\Kelas::Show');
    $routes->get('new', 'Admin\Kelas::New');
    $routes->post('save', 'Admin\Kelas::Save');
    $routes->get('edit', 'Admin\Kelas::Edit');
    $routes->post('update', 'Admin\Kelas::Update');
    $routes->post('delete', 'Admin\Kelas::Delete');
});

// Kriteria 
$routes->group('admin/kriteria', static function ($routes) {
    $routes->get('/', 'Admin\Kriteria::index');
    $routes->get('list', 'Admin\Kriteria::ListKriteria');
    $routes->get('new', 'Admin\Kriteria::NewKriteria');
    $routes->post('save', 'Admin\Kriteria::SaveKriteria');
    $routes->get('edit', 'Admin\Kriteria::EditKriteria');
    $routes->post('update', 'Admin\Kriteria::UpdateKriteria');
    $routes->post('delete', 'Admin\Kriteria::DeleteKriteria');
    $routes->get('sub', 'Admin\Kriteria::SubKriteria');
    $routes->get('list/sub', 'Admin\Kriteria::ListSubKriteria');
    $routes->post('sub/save', 'Admin\Kriteria::SaveSubKriteria');
    $routes->get('sub/edit', 'Admin\Kriteria::EditSubKriteria');
    $routes->post('sub/update', 'Admin\Kriteria::UpdateSubKriteria');
    $routes->post('sub/delete', 'Admin\Kriteria::DeleteSubKriteria');
});

// Admin/Guru
$routes->group('admin/guru', static function ($routes) {
    $routes->get('/', 'Admin\Guru::index');
    $routes->get('akun/list', 'Admin\Guru::ListAkunGuru');
    $routes->get('akun/new', 'Admin\Guru::NewAkunGuru');
    $routes->post('akun/save', 'Admin\Guru::SaveAkunGuru');
    $routes->get('akun/edit', 'Admin\Guru::EditAkunGuru');
    $routes->post('akun/update', 'Admin\Guru::UpdateAkunGuru');
    $routes->post('akun/status', 'Admin\Guru::StatusAkunGuru');
    $routes->post('akun/delete', 'Admin\Guru::DeleteAkunGuru');
});
$routes->group('admin/guru/mapel', static function ($routes) {
    $routes->get('list', 'Admin\Guru::ListGuruMapel');
    $routes->get('new', 'Admin\Guru::NewGuruMapel');
    $routes->get('kelas', 'Admin\Guru::GetKelasBySekolah');
    $routes->get('sekolah', 'Admin\Guru::GetGuruBySekolah');
    $routes->post('save', 'Admin\Guru::SaveGuruMapel');
    $routes->get('edit', 'Admin\Guru::EditGuruMapel');
    $routes->post('update', 'Admin\Guru::UpdateGuruMapel');
    $routes->post('delete', 'Admin\Guru::DeleteGuruMapel');
});

// Skors 
$routes->group('admin/skors', static function ($routes) {
    $routes->get('/', 'Admin\Skors::index');
    $routes->get('nilai-alternatif', 'Admin\Skors::NilaiAlternatif');
});
// Users 
$routes->group('admin/user', static function ($routes) {
    $routes->get('/', 'Admin\Users::index');
    $routes->get('show', 'Admin\Users::Show');
    $routes->get('new', 'Admin\Users::New');
    $routes->post('save', 'Admin\Users::Save');
    $routes->get('edit', 'Admin\Users::Edit');
    $routes->post('update', 'Admin\Users::Update');
    $routes->post('status', 'Admin\Users::Status');
    $routes->post('delete', 'Admin\Users::Delete');
});

// Account Admin 
$routes->group('admin/account', static function ($routes) {
    $routes->get('/', 'Admin\Account::index');
    $routes->post('update', 'Admin\Account::Update');
    $routes->get('form-pwd', 'Admin\Account::FormPassword');
    $routes->post('change', 'Admin\Account::ChangePassword');
});


// Supervisor / Penilai 
$routes->group('superv', static function ($routes) {
    $routes->get('/', 'Supervisor\Home::index');
    $routes->get('logout', 'Supervisor\Home::Logout');
});
$routes->group('superv/penilaian', static function ($routes) {
    $routes->get('/', 'Supervisor\Penilaian::index');
    $routes->get('guru', 'Supervisor\Penilaian::GuruMapel');
    $routes->get('guru/(:num)', 'Supervisor\Penilaian::FormNilai/$1');
    $routes->get('status', 'Supervisor\Penilaian::NilaiKompetnsi');
    $routes->post('sub', 'Supervisor\Penilaian::FormSubKriteria');
    $routes->post('save', 'Supervisor\Penilaian::SaveNilai');
    $routes->post('reset', 'Supervisor\Penilaian::ResetNilai');
});

// Skors Superv
$routes->group('superv/skors', static function ($routes) {
    $routes->get('/', 'Supervisor\Skors::index');
    $routes->get('nilai-alternatif', 'Supervisor\Skors::NilaiAlternatif');
});
// Acount Suoerv 
$routes->group('superv/account', static function ($routes) {
    $routes->get('/', 'Supervisor\Account::index');
    $routes->post('update', 'Supervisor\Account::Update');
});

// Report 

$routes->group('report', static function ($routes) {
    $routes->get('nilai/(:num)', 'Report::NilaiGuru/$1');
    $routes->get('pkg/(:num)/(:num)', 'Report::PKG/$1/$2');
});




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}