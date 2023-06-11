<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\Type;
use Doctrine\DBAL\Schema\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Technology;


class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->is_admin){
            $projects =  Project::paginate(3);
        }
        else{
            $projects = Project::where('user_id', Auth::id())->paginate(4);
        }
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $userId = auth()->id();
        $data = $request->validated();
        $slug = Str::slug($request->name, '-');
        $project = new Project();
        $project -> slug = $slug;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->user_id = $userId;
        $project->type_id = $request->type_id;
        $selectedTechnologies = $request->input('technologies');
        $project->save();
        foreach ($selectedTechnologies as $technologyId) {
            $technology = Technology::find($technologyId);
            $project->technologies()->attach($technology);
        }
    
        
        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->with('technologies')->firstOrFail();
        $project = Project::where('slug', $slug)->firstOrFail(); 
        if (!Auth::user()->is_admin && $project->user_id !== Auth::id()) {
            abort(403);
        }
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        if (!Auth::user()->is_admin && $project->user_id !== Auth::id()){
            abort(403);
        }
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
       
        $data = $request->validated();
        $slug = Str::slug($request->name, '-');
        $data['slug'] = $slug;
        $project->update($data);
        $selectedTechnologies = $request->input('technologies');
        if (empty($selectedTechnologies)) {
            $project->technologies()->detach();
        } else {
            // Remove unselected technologies
            $unselectedTechnologies = Technology::whereNotIn('id', $selectedTechnologies)->get();
            $project->technologies()->detach($unselectedTechnologies);
            $technologies = Technology::whereIn('id', $selectedTechnologies)->get();
            $project->technologies()->sync($technologies);
        }
        return redirect()->route('admin.projects.index')->with('success', 'Project updated correctly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
