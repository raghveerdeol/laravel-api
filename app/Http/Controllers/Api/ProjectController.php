<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //

    public function index(){
        $projects = Project::with("technologies", "type")->paginate(20);
        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    public function show(Project $project){
        $project->loadMissing("technologies", "type");
        return response()->json([
            'success' => true,
            'results' => $project
        ]);
    }

    public function projectSearch(Request $request){
        $data = $request->all();

        $projects = Project::where('title', 'LIKE', $data['title'] . '%')->get();

        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }
}
