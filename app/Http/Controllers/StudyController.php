<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudyCreateRequest;
use App\Http\Requests\StudyUpdateRequest;
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
        $data =  $request->all();

        $study = Study::create($request->validated());

        $study->users()->sync($data['users']);

        return Redirect::route('study.index')->with('success', 'Study created.');
    }

    public function update(StudyUpdateRequest $request, $id ): RedirectResponse
    {
        $study = Study::findOrFail($id);

        if(empty($study)) {

            return Redirect::route('study.index')->with('error', 'Failed....');
        }

        $data =  $request->validated();

        $study->update(['name' => $data['name']]);

        $study->users()->sync($data['users']);

        return Redirect::route('study.index')->with('success', 'Study updated successfully.');
    }

    public function edit(Request $request, Study $study): JsonResponse
    {

        $dt['req'] = $request->all();
        $dt['ss'] = $request->pa();
        $dt['st'] = $study;

        return response()->json($dt);
    }

}
