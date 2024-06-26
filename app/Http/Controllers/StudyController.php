<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudyCreateRequest;
use App\Models\Study;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class StudyController extends Controller
{

    public function index(): Response
    {
        return Inertia::render('Study/Index', [
            'studies' =>  Study::with('users')->get(),
            'users' => User::select('id', 'name')->orderby('name', 'asc')->get()]
        );
    }


    public function store(StudyCreateRequest $request): RedirectResponse
    {
        //Study::create($request->validated());

        dd($request->validated());

        return Redirect::route('study.index')->with('success', 'Study created.');
    }

    public function edit(Request $request, Study $study): JsonResponse
    {

        $dt['req'] = $request->all();
        $dt['ss'] = $request->pa();
        $dt['st'] = $study;


        return response()->json($dt);
    }

}
