<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PresetController extends Controller
{
    public function index(): Response {

        return Inertia::render(
            'Preset/Index',
            [
                'studies' => Project::all(),
                //'preset'   => [],
                'users'   => User::select('id', 'name')->orderby('name', 'asc')->get(),
            ]
        );
    }
}
