<?php

namespace App\Http\Controllers;

use App\Models\Study;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class StudyController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Study/Index', ['studies' => Study::all()]);
    }

    public function store(): RedirectResponse
    {
        Study::create(
            Request::validate([
                                  'name' => ['required', 'max:100'],
                                  'email' => ['nullable', 'max:50', 'email'],
                              ])
        );

        return Redirect::route('studies')->with('success', 'Study created.');
    }
}
