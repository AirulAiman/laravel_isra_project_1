<?php

namespace App\Http\Controllers;

use App\Models\Process;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    public function index()
    {
        $processes = Process::all();
        return view('processes.index', compact('processes'));
    }

    public function create()
    {
        return view('processes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Process::create($validated);

        return redirect()->route('processes.index')
            ->with('success', 'Process created successfully.');
    }

    public function edit(Process $process)
    {
        return view('processes.edit', compact('process'));
    }

    public function update(Request $request, Process $process)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $process->update($validated);

        return redirect()->route('processes.index')
            ->with('success', 'Process updated successfully.');
    }

    public function destroy(Process $process)
    {
        $process->delete();

        return redirect()->route('processes.index')
            ->with('success', 'Process deleted successfully.');
    }
}