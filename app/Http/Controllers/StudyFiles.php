<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class StudyFiles extends Controller
{
    public function index(): Response
    {

        return Inertia::render(
            'StudyFiles/Index',
            [
                'studies' => Project::all(),
                //'preset'   => [],
                'users'   => User::select('id', 'name')->orderby('name', 'asc')->get(),
            ]
        );
    }
}
