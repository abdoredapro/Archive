<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Film;
use App\Models\Project;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index() {

        $films = Film::count();
        $files = File::count();

        $projects = Project::count();

        $projectsArray = Project::all();

        return view('dashboard.report.index', compact('films', 'files', 'projects', 'projectsArray'));
    }
}
