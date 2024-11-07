<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    // ====================================
    // READ
    // ====================================
    public function view()
    {
        $projects = Project::all();
        return view('admin.projects.main', compact('projects'));
    }

    // ====================================
    // CREATE
    // ====================================
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'prj_name' => 'required|string',
            'prj_desc' => 'required|string'
        ]);

        Project::create([
            'prj_id' => mt_rand(100000, 900000),
            'prj_name' => $validatedData['prj_name'],
            'prj_desc' => $validatedData['prj_desc'],
            'created_at' => now(),
            'updated_at' => now(),
            'start_date' => now(),
            'end_date' => '',
            'organization' => 'unassigned'
        ]);

        return redirect(route('admin.projects'));
    }

    // ====================================
    // UPDATE
    // ====================================
    public function update(Request $request, $prj_id)
    {
        $project = Project::where('prj_id', $prj_id)->first();
        if (!$project) {
            return redirect()->back()->withErrors(['error' => 'Project not found']);
        }

        try {
            $validatedData = $request->validate([
                'prj_name' => 'nullable|string',
                'prj_desc' => 'nullable|string'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }

        try {
            if (isset($validatedData['prj_name'])) {
                $project->prj_name = $validatedData['prj_name'];
            }
            if (isset($validatedData['prj_desc'])) {
                $project->prj_desc = $validatedData['prj_desc'];
            }
            $project->updated_at = now();
            $project->save();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update project']);
        }

        return redirect(route('admin.projects'));
    }
}
