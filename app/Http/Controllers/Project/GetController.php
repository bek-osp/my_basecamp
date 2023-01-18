<?php

namespace App\Http\Controllers\Project;

use App\Exceptions\ProjectException;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function index(Request $request)
    {
        $projects = $request->user()->projects()->get();

        if ($projects->isEmpty()) {
            throw new ProjectException('Projects not found', 404);
        }

        return ProjectResource::collection($projects)->response();
    }

    public function get(Request $request, $id)
    {
        $project = $request->user()->projects()->find($id);

        if (!$project) {
            throw new ProjectException('Project not found', 404);
        }

        return ProjectResource::make($project)->response();
    }
}
