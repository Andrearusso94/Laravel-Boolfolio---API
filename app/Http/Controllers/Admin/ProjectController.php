<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::orderByDesc('id')->get();

        return view('admin.projects.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = Type::all();
        $technology = Technology::all();
        //dd($type);
        return view('admin.projects.create', compact('type', 'technology'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        //dd($request->all());

        $cover_image = Storage::disk('public')->put('placeholders', $request['cover_image']);
        //$request['cover_image'] = $cover_image;
        // dd($request['type_id']);
        $project = new Project();
        $project->title = $request['title'];
        $project->slug = $request['slug'];
        $project->body = $request['body'];
        $project->cover_image = $cover_image;
        $project->type_id = $request['type_id'];

        $project->save();

        $project->Technologys()->attach($request->technology);
        return to_route('admin.project.index')->with('message', 'Post ceated Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $type = Type::all();
        $technology = Technology::all();
        return view('admin.projects.edit', compact('project', 'type', 'technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = [
            $project->title = $request['title'],
            $project->slug = $request['slug'],
            $project->body = $request['body'],
            $project->cover_image = ['cover_image'],

        ];
        $project->update($data);
        $cover_image = Storage::put('uploads', $request['cover_image']);
        $project->Technologys()->sync($request->technology);
        return to_route('admin.project.index')->with('message', 'Post update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.project.index')->with('message', 'Post Deleted Successfully');
    }
}
