<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::withCount('files')->paginate(10);


        return view('dashboard.projects.index', compact('projects'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.projects.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:projects,name']
        ]);

        Project::create($request->all());

        return to_route('dashboard.projects.index')
        ->with([
            'message' => 'تم الاضافه بنجاح'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('dashboard.projects.edit', compact('project')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => ['required', 'string', "unique:projects,name,$project->id"]
        ]);

        $project->update($request->all());

        return to_route('dashboard.projects.index')

        ->with([
            'message' => 'تم الحفظ بنجاح'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('dashboard.projects.index')
        ->with([
            'message' => 'تم الحذف بنجاح'
        ]);
    }
}
