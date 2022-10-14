<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Issue;
use App\Models\version;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $currentversion = Version::max('name');

        

        //$issues = Issue::all();
$issues = DB::table('issues')
                ->select('issues.id as id', 'issues.key as key','issues.type_name as type_name', 'issues.fix_versions as fix_versions', 'issues.release_notes as release_notes', 'versions.release_date AS release_date')
                ->leftJoin('versions', 'versions.project_id', '=', 'issues.project_id')
                ->get();

           /* $issues = DB::table('issues')
            ->join('versions', 'issues.project_id', '=', 'versions.project_id')
            ->select('issues.*', 'versions.release_date')
            ->get();*/



         return view('home', compact('issues', 'currentversion'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
