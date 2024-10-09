<?php


use Illuminate\Support\Facades\Route;

// ===================================
// ========= PUBLIC ROUTE ============
// ===================================
Route::get('/', 'App\Http\Controllers\ViewController@landing')
    ->name('landing');


// ===================================
// ===== AUTHENTICATION ROUTES =======
// ===================================
// LOGIN PAGE ROUTE
Route::get('/login', 'App\Http\Controllers\ViewController@login')
    ->name('login');
// REGISTER PAGE ROUTE
Route::get('/register', 'App\Http\Controllers\ViewController@register')
    ->name('register');
// LOGIN POST
Route::post('/login', 'App\Http\Controllers\AuthController@loginPost')
    ->name('login.post');
// REGISTER POST
Route::post('/register', 'App\Http\Controllers\AuthController@registerPost')
    ->name('register.post');
// LOGOUT
Route::post('/logout', 'App\Http\Controllers\AuthController@logout')
    ->name('logout');

// ====================================
// ========== USER REQUESTS ===========
// ====================================
// user
Route::get('/user', 'App\Http\Controllers\ViewController@user')->name('user');

// Views
Route::get('/admin', 'App\Http\Controllers\ViewController@adminDashboard')->name('admin-dashboard');
Route::get('/admin/genre', 'App\Http\Controllers\ViewController@adminGenre')->name('admin.genre');
Route::get('/admin/project/rr', 'App\Http\Controllers\ViewController@adminRR')->name('admin-rr');
Route::get('/admin/project/ra', 'App\Http\Controllers\ViewController@adminRA')->name('admin-ra');
Route::get('/admin/project/rtp', 'App\Http\Controllers\ViewController@adminRTP')->name('admin-rtp');
Route::get('/admin/project/all', 'App\Http\Controllers\ViewController@adminAll')->name('admin-all');









Route::middleware('user')->group(function () {
    Route::get('/user', 'App\Http\Controllers\ViewController@user')
        ->name('user');
});

// Route::middleware('')->group(function () {
Route::get('/admin', 'App\Http\Controllers\ViewController@adminDashboard')
    ->name('admin');

Route::get('/admin/user-management', 'App\Http\Controllers\Admin\UserManagementController@view')
    ->name('user-management');

// routes/web.php




// Route::get('/admin', 'App\Http\Controllers\ViewController@adminDashboard')
//     ->name('admin');

// Route::get('/admin/projects', 'App\Http\Controllers\Admin\ProjectController@view')
//     ->name('admin.projects');

// Route::post('/admin/projects/create', 'App\Http\Controllers\Admin\ProjectController@create')
//     ->name('admin.projects.create');

// Route::get('/admin/user-management', 'App\Http\Controllers\Admin\UserManagementController@view')
//     ->name('user-management');


// routes/web.php

/* use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 */



// ====================================

use App\Http\Controllers\Admin\ProjectController;

Route::get('/admin/projects', [ProjectController::class, 'view'])->name('admin.projects');
Route::post('/admin/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
Route::patch('/admin/projects/{id}/update', [ProjectController::class, 'update'])->name('admin.projects.update');


use App\Http\Controllers\ThreatGroupController;
use App\Http\Controllers\ThreatController;




Route::prefix('user/profile/threats')->group(function () {
    Route::get('/', [ThreatController::class, 'index'])->name('threats.index');
    Route::get('/create', [ThreatController::class, 'create'])->name('threats.create');
    Route::post('/', [ThreatController::class, 'store'])->name('threats.store');
    Route::get('/{threat}/edit', [ThreatController::class, 'edit'])->name('threats.edit');
    Route::put('/{threat}', [ThreatController::class, 'update'])->name('threats.update');
    Route::delete('/{threat}', [ThreatController::class, 'destroy'])->name('threats.destroy');
    // Route::get('/get-threats/{groupId}', [ThreatController::class, 'getThreats'])->name('get.threats');
    Route::get('/threats/group/{groupId}', [ThreatController::class, 'getThreatsByGroup']);

    // Threat Group management
    Route::get('/groups/create', [ThreatGroupController::class, 'create'])->name('threat-groups.create');
    Route::post('/groups', [ThreatGroupController::class, 'store'])->name('threat-groups.store');
    Route::get('/groups/{group}/edit', [ThreatGroupController::class, 'edit'])->name('threat-groups.edit');
    Route::put('/groups/{group}', [ThreatGroupController::class, 'update'])->name('threat-groups.update');
    Route::delete('/groups/{group}', [ThreatGroupController::class, 'destroy'])->name('threat-groups.destroy');
    // Route::get('/get-threats-by-group/{groupId}', [ThreatController::class, 'getThreatsByGroup']);
});

use App\Http\Controllers\VulnerabilityController;
use App\Http\Controllers\VulnerabilityGroupController;

Route::prefix('user/profile/Vulnerability')->group(function () {
    Route::get('/', [VulnerabilityController::class, 'index'])->name('vulnerabilities.index');
    Route::get('/create', [VulnerabilityController::class, 'create'])->name('vulnerabilities.create');
    Route::post('/', [VulnerabilityController::class, 'store'])->name('vulnerabilities.store');
    Route::get('/{vulnerability}/edit', [VulnerabilityController::class, 'edit'])->name('vulnerabilities.edit');
    Route::put('/{vulnerability}', [VulnerabilityController::class, 'update'])->name('vulnerabilities.update');
    Route::delete('/{vulnerability}', [VulnerabilityController::class, 'destroy'])->name('vulnerabilities.destroy');
    // Route::get('/get-vulnerabilities/{groupId}', [VulnerabilityController::class, 'getVulnerabilities'])->name('get.vulnerabilities');
    Route::get('/vulnerabilities/group/{groupId}', [VulnerabilityController::class, 'getVulnerabilitiesByGroup']);

    // Vulnerability Group management
    Route::get('/groups/create', [VulnerabilityGroupController::class, 'create'])->name('vulnerability-groups.create');
    Route::post('/groups', [VulnerabilityGroupController::class, 'store'])->name('vulnerability-groups.store');
    Route::get('/groups/{group}/edit', [VulnerabilityGroupController::class, 'edit'])->name('vulnerability-groups.edit');
    Route::put('/groups/{group}', [VulnerabilityGroupController::class, 'update'])->name('vulnerability-groups.update');
    Route::delete('/groups/{group}', [VulnerabilityGroupController::class, 'destroy'])->name('vulnerability-groups.destroy');
    // Route::get('/get-vulnerabilities-by-group/{groupId}', [VulnerabilityController::class, 'getVulnerabilitiesByGroup']);
});

use App\Http\Controllers\Admin\TestOrganizationController;

Route::get('/admin/test/organizations', [TestOrganizationController::class, 'view'])->name('test.organizations');
Route::post('/admin/test/organizations', [TestOrganizationController::class, 'create'])->name('test.organizations.create');
Route::patch('/admin/test/organizations/{id}/update', [TestOrganizationController::class, 'update'])->name('test.organizations.update');

use App\Http\Controllers\Admin\RTPController;

Route::prefix('/admin/rtp')->group(function () {
    Route::get('/', [RTPController::class, 'view'])->name('rtp');
    // Route::post('', [TestOrganizationController::class, 'create'])->name('test.organizations.create');
    // Route::patch('', [TestOrganizationController::class, 'update'])->name('test.organizations.update');
});;

use App\Http\Controllers\AssetRegisterController;

Route::prefix('user/asset_register')->group(function () {
    Route::get('/', [AssetRegisterController::class, 'index'])->name('assets.index');
    Route::get('/create', [AssetRegisterController::class, 'create'])->name('assets.create');
    Route::post('/', [AssetRegisterController::class, 'store'])->name('assets.store');
    Route::get('/{id}/edit', [AssetRegisterController::class, 'edit'])->name('assets.edit');
    Route::put('/{id}', [AssetRegisterController::class, 'update'])->name('assets.update');
    Route::delete('/{id}', [AssetRegisterController::class, 'destroy'])->name('assets.destroy');
});

use App\Http\Controllers\Admin\AdminThreatGroupController;
use App\Http\Controllers\Admin\AdminThreatController;

Route::prefix('admin/profile/threats/')->group(function () {
    Route::get('/view', [AdminThreatController::class, 'newView'])->name('threats.view');
    Route::get('/', [AdminThreatController::class, 'index'])->name('threats.index');
    Route::get('/create', [AdminThreatController::class, 'create'])->name('threats.create');
    Route::post('/', [AdminThreatController::class, 'store'])->name('threats.store');
    Route::get('/{threat}/edit', [AdminThreatController::class, 'edit'])->name('threats.edit');
    Route::put('/{threat}', [AdminThreatController::class, 'update'])->name('threats.update');
    Route::delete('/{threat}', [AdminThreatController::class, 'destroy'])->name('threats.destroy');

    // Threat Group management
    Route::get('/groups/create', [AdminThreatGroupController::class, 'create'])->name('threat-groups.create');
    Route::post('/groups', [AdminThreatGroupController::class, 'store'])->name('threat-groups.store');
    Route::get('/groups/{group}/edit', [AdminThreatGroupController::class, 'edit'])->name('threat-groups.edit');
    Route::put('/groups/{group}', [AdminThreatGroupController::class, 'update'])->name('threat-groups.update');
    Route::delete('/groups/{group}', [AdminThreatGroupController::class, 'destroy'])->name('threat-groups.destroy');
});

use App\Http\Controllers\Admin\VulnController;
use App\Http\Controllers\Admin\VulnGroupController;

Route::prefix('admin/profile/vulnerabilities/')->group(function () {
    Route::get('/', [VulnController::class, 'index'])->name('vulnerabilities.index');
    Route::get('/create', [VulnController::class, 'create'])->name('vulnerabilities.create');
    Route::post('/', [VulnController::class, 'store'])->name('vulnerabilities.store');
    Route::get('/{vulnerability}/edit', [VulnController::class, 'edit'])->name('vulnerabilities.edit');
    Route::put('/{vulnerability}', [VulnController::class, 'update'])->name('vulnerabilities.update');
    Route::delete('/{vulnerability}', [VulnController::class, 'destroy'])->name('vulnerabilities.destroy');

    // Vulnerability Group management
    Route::get('/groups/create', [VulnGroupController::class, 'create'])->name('vulnerability-groups.create');
    Route::post('/groups', [VulnGroupController::class, 'store'])->name('vulnerability-groups.store');
    Route::get('/groups/{group}/edit', [VulnGroupController::class, 'edit'])->name('vulnerability-groups.edit');
    Route::put('/groups/{group}', [VulnGroupController::class, 'update'])->name('vulnerability-groups.update');
    Route::delete('/groups/{group}', [VulnGroupController::class, 'destroy'])->name('vulnerability-groups.destroy');
});

use App\Http\Controllers\RiskAssessmentController;

// Route::resource('risk_assessments', RiskAssessmentController::class);




Route::get('user/risk_assessments', [RiskAssessmentController::class, 'index'])->name('risk_assessments.index');
Route::get('user/risk_assessments/create', [RiskAssessmentController::class, 'create'])->name('risk_assessments.create');
Route::post('user/risk_assessments', [RiskAssessmentController::class, 'store'])->name('risk_assessments.store');
Route::get('user/risk_assessments/{id}/edit', [RiskAssessmentController::class, 'edit'])->name('risk_assessments.edit');
Route::put('user/risk_assessments/{id}', [RiskAssessmentController::class, 'update'])->name('risk_assessments.update');
Route::delete('user/risk_assessments/{id}', [RiskAssessmentController::class, 'destroy'])->name('risk_assessments.destroy');












