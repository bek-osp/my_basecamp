<?php

namespace App\Http\Controllers\Project;

use App\Exceptions\ProjectException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateRequest;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function index(CreateRequest $request)
    {
        $project = $request->user()->projects()->create($request->only('name', 'description'));

        if (!$project) {
            throw new ProjectException('Project not created', 500);
        }

        return ProjectResource::make($project)->response();
    }

}
