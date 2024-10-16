<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth; // Make sure Auth facade is imported

class ProjectController extends Controller
{
    // ====================================
    // INDEX (for users to view their own organization's projects)
    // ====================================
    public function index()
    {
        $user = Auth::user();
        $projects = Project::where('org_id', $user->org_id)->get();
        return view('user.projects.index', compact('projects'));
    }

    // ====================================
    // STORE (Create a new project)
    // ====================================
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'prj_name' => 'required|string|max:255',
    //         'prj_desc' => 'required|string',
    //         'org_id' => 'required|exists:organizations,org_id',
    //     ]);

    //     Project::create($request->all());
    //     return redirect()->route('organizations.show', $request->org_id);
    // }

    // ====================================
    // VIEW (for admin to view all projects)
    // ====================================
    public function view()
    {
        $projects = Project::all(); // Admin sees all projects
        return view('admin.projects.index', compact('projects')); // Assuming view is in 'admin.projects.index'
    }

    public function create($org_id)
    {
        // Fetch the organization using the provided org_id
        $organization = Organization::findOrFail($org_id); // Ensure the organization exists

        // Pass the organization to the view
        return view('admin.projects.create', compact('organization'));
    }
    // ====================================
    // CREATE (for admin to create a project)
    // ====================================
    // public function create(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'prj_name' => 'required|string',
    //         'prj_desc' => 'required|string'
    //     ]);

    //     Project::create([
    //         'prj_id' => mt_rand(100000, 900000),
    //         'prj_name' => $validatedData['prj_name'],
    //         'prj_desc' => $validatedData['prj_desc'],
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //         'org_id' => $request->org_id, // Pass the correct org_id
    //     ]);

    //     return redirect()->route('admin.projects');
    // }


    public function store(Request $request, $org_id)
    {
        // Validate request data
        $request->validate([
            'prj_name' => 'required|string|max:255',
            'prj_desc' => 'required|string',

        ]);

        // Ensure organization exists
        $organization = Organization::findOrFail($org_id);

        // Create the project for the specific organization
        Project::create([
            'prj_name' => $request->prj_name,
            'prj_desc' => $request->prj_desc,
            'org_id' => $organization->org_id, // Assign to the correct organization
        ]);

        return redirect()->route('organizations.show', $org_id)->with('success', 'Project created successfully!');
    }
    // ====================================
    // UPDATE (for admin to update project details)
    // ====================================
    public function update(Request $request, $prj_id)
    {
        $project = Project::where('prj_id', $prj_id)->first();
        if (!$project) {
            return redirect()->back()->withErrors(['error' => 'Project not found']);
        }

        $validatedData = $request->validate([
            'prj_name' => 'nullable|string',
            'prj_desc' => 'nullable|string'
        ]);

        if (isset($validatedData['prj_name'])) {
            $project->prj_name = $validatedData['prj_name'];
        }
        if (isset($validatedData['prj_desc'])) {
            $project->prj_desc = $validatedData['prj_desc'];
        }

        $project->updated_at = now();
        $project->save();

        return redirect()->route('admin.projects');
    }
}
