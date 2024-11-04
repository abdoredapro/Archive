<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

final class ProjectsController extends Controller
{
    /**
     * Get all projects.
     */

    public function __invoke()
    {
        $projects = Project::withCount('files as views')->get();

        return $projects;
    }

}
