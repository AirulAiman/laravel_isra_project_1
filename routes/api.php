<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreatController;
use App\Http\Controllers\VulnerabilityController;
use App\Http\Controllers\ThreatGroupController;

use App\Http\Controllers\RiskAssessmentController;


// Risk Assessment Routes
Route::prefix('user')->group(function () {
    Route::get('user/risk_assessments', [RiskAssessmentController::class, 'index'])->name('risk_assessments.index');
Route::get('user/risk_assessments/create', [RiskAssessmentController::class, 'create'])->name('risk_assessments.create');
Route::post('user/risk_assessments', [RiskAssessmentController::class, 'store'])->name('risk_assessments.store');
Route::get('user/risk_assessments/{id}', [RiskAssessmentController::class, 'show'])->name('risk_assessments.show');
Route::get('user/risk_assessments/{id}/edit', [RiskAssessmentController::class, 'edit'])->name('risk_assessments.edit');
Route::put('user/risk_assessments/{id}', [RiskAssessmentController::class, 'update'])->name('risk_assessments.update');
Route::delete('user/risk_assessments/{id}', [RiskAssessmentController::class, 'destroy'])->name('risk_assessments.destroy');
});

Route::prefix('user/profile/threats')->group(function () {
    Route::get('/', [ThreatController::class, 'index'])->name('threats.index');
    Route::get('/create', [ThreatController::class, 'create'])->name('threats.create');
    Route::post('/', [ThreatController::class, 'store'])->name('threats.store');
    Route::get('/{threat}/edit', [ThreatController::class, 'edit'])->name('threats.edit');
    Route::put('/{threat}', [ThreatController::class, 'update'])->name('threats.update');
    Route::delete('/{threat}', [ThreatController::class, 'destroy'])->name('threats.destroy');
    Route::get('/get-threats/{groupId}', [ThreatController::class, 'getThreats'])->name('get.threats');

    // Threat Group management
    Route::get('/groups/create', [ThreatGroupController::class, 'create'])->name('threat-groups.create');
    Route::post('/groups', [ThreatGroupController::class, 'store'])->name('threat-groups.store');
    Route::get('/groups/{group}/edit', [ThreatGroupController::class, 'edit'])->name('threat-groups.edit');
    Route::put('/groups/{group}', [ThreatGroupController::class, 'update'])->name('threat-groups.update');
    Route::delete('/groups/{group}', [ThreatGroupController::class, 'destroy'])->name('threat-groups.destroy');
    Route::get('/get-threats-by-group/{groupId}', [ThreatController::class, 'getThreatsByGroup']);
});


Route::get('threats/group/{groupId}', [RiskAssessmentController::class, 'getThreatsByGroup']);

// Get vulnerabilities by group
Route::get('vulnerabilities/group/{groupId}', [RiskAssessmentController::class, 'getVulnerabilitiesByGroup']);

use App\Http\Controllers\VulnerabilityGroupController;

Route::prefix('user/profile/Vulnerability')->group(function () {
    Route::get('/', [VulnerabilityController::class, 'index'])->name('vulnerabilities.index');
    Route::get('/create', [VulnerabilityController::class, 'create'])->name('vulnerabilities.create');
    Route::post('/', [VulnerabilityController::class, 'store'])->name('vulnerabilities.store');
    Route::get('/{vulnerability}/edit', [VulnerabilityController::class, 'edit'])->name('vulnerabilities.edit');
    Route::put('/{vulnerability}', [VulnerabilityController::class, 'update'])->name('vulnerabilities.update');
    Route::delete('/{vulnerability}', [VulnerabilityController::class, 'destroy'])->name('vulnerabilities.destroy');
    Route::get('/get-vulnerabilities/{groupId}', [VulnerabilityController::class, 'getVulnerabilities'])->name('get.vulnerabilities');
    

    // Vulnerability Group management
    Route::get('/groups/create', [VulnerabilityGroupController::class, 'create'])->name('vulnerability-groups.create');
    Route::post('/groups', [VulnerabilityGroupController::class, 'store'])->name('vulnerability-groups.store');
    Route::get('/groups/{group}/edit', [VulnerabilityGroupController::class, 'edit'])->name('vulnerability-groups.edit');
    Route::put('/groups/{group}', [VulnerabilityGroupController::class, 'update'])->name('vulnerability-groups.update');
    Route::delete('/groups/{group}', [VulnerabilityGroupController::class, 'destroy'])->name('vulnerability-groups.destroy');
    Route::get('/get-vulnerabilities-by-group/{groupId}', [VulnerabilityController::class, 'getVulnerabilitiesByGroup']);
});