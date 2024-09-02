<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function view()
    {
        $projects = Project::all();
        return view('admin.projects.main', compact('projects'));
    }

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
}