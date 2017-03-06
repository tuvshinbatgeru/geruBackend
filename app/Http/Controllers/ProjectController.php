<?php

namespace App\Http\Controllers;

use App\Project;
use App\Transformers\ProjectTransformer;
use Illuminate\Http\Request;
use Response;

class ProjectController extends Controller
{
    protected $planTransformer;

    function __construct(ProjectTransformer $projectTransformer)
    {
        $this->projectTransformer = $projectTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->projectTransformer->transform($request->all());

        $project = new Project($data);
        $project->status = 'active';
        $project->save();

        $project->skills()->sync($decode->skills);

        return Response::json([
            'code' => 0,
            'result' => $project,
            'message' => 'Амжилттай хадгаллаа',
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
