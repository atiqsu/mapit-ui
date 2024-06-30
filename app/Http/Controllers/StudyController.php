<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class StudyController extends Controller
{
    public function index($id): Response {

        $project = Project::find($id);

        return Inertia::render(
            'Study/Index',
            [
                'project' => $project,
                'users'   => [],
            ]
        );
    }
}
