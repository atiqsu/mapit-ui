<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudyCreateRequest;
use App\Http\Requests\StudyStatusChangeRequest;
use App\Http\Requests\StudyUpdateRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{

    public function index(): Response
    {
        return Inertia::render('Project/Index', [
            'studies' =>  Project::with('users')->get(),
            'users' => User::select('id', 'name')->orderby('name', 'asc')->get()]
        );
    }


    public function store(StudyCreateRequest $request): RedirectResponse
    {
        $data =  $request->all();

        $study = Project::create($request->validated());

        $study->users()->sync($data['users']);

        return Redirect::route('project.index')->with('success', 'Project successfully created.');
    }

    public function update(StudyUpdateRequest $request, $id ): RedirectResponse
    {
        $study = Project::findOrFail($id);

        if(empty($study)) {

            return Redirect::route('project.index')->with('error', 'Failed....');
        }

        $data =  $request->validated();

        $study->update(['name' => $data['name']]);

        $study->users()->sync($data['users']);

        return Redirect::route('project.index')->with('success', 'Project updated successfully.');
    }

    public function changeStatus(StudyStatusChangeRequest $request, $id ): RedirectResponse
    {

        $study = Project::findOrFail($id);

        if(empty($study)) {

            return Redirect::route('project.index')->with('error', 'Failed....');
        }

        $data =  $request->validated();

        $study->update(['is_active' => $data['is_active']]);

        return redirect()->back()->with('success', 'Project status updated successfully! - '. $id);
    }

}
