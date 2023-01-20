<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::with(['type', 'technologys'])->orderByDesc('id')->paginate(5);
    }

    public function show($slug)
    {
        //dd($id);
        $project = Project::where('slug', $slug)->first();
        // dd($project);
        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'project' => 'Project not found',
            ]);
        }
    }
}
