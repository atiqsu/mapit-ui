<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Study;
use App\Models\User;

class StudyFiles extends Controller
{
    public function index(): Response
    {

        return Inertia::render(
            'StudyFiles/Index',
            [
                'studies' => Study::all(),
                //'preset'   => [],
                'users'   => User::select('id', 'name')->orderby('name', 'asc')->get(),
            ]
        );
    }
}
