<?php

namespace App\Http\Controllers\Project;

use App\Exceptions\ProjectException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\EditRequest;
use App\Http\Resources\ProjectResource;

class EditController extends Controller
{
    public function index(EditRequest $request, $id)
    {
        $project = $request->user()->projects()->find($id);

        if (!$project) {
            throw new ProjectException('Project not found', 404);
        }

        $project->update($request->only('name', 'description'));

        if (!$project) {
            throw new ProjectException('Project not updated', 500);
        }

        return ProjectResource::make($project)->response();
    }
}
