<?php

namespace App\Http\Controllers\Api;

use Atlassian\JiraRest\Requests\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
//use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Response;
use Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
            $request = app(Project\ProjectRequest::class);

            $response = $request->search([
                'maxResults' => 10,
                'startAt' => 0
            ]);

            $project = \json_decode($response->getBody()->getContents(), true);

            foreach ($project['values'] as $value) {
                foreach ($value['avatarUrls'] as $key => $val) {
                    $avatar[] = array(
                        'avatarURL' => $val
                    );


                }
               
                $projects[] = array(

                    'jiraID' => $value['id'],
                    'jirakey' => $value['key'],
                    'name' => $value['name'],
                    'avatarURL' => '', //$avatar,
                    'created_at' => '',
                    'updated_at' => '',
                    "deleted_at" =>'',

                );
            }

             $csv = fopen('php://temp/maxmemory:'. (5*1024*1024), 'r+');

             $columns = array(
        'jiraID', 
        'jirakey', 
        'name', 
        'avatarURL',
        'created_at', 
        'updated_at',
        'deleted_at'
    );
 fputcsv($csv, $columns);
    foreach($projects as $project) {
    fputcsv($csv, array(
            $project['jiraID'],
            $project['jirakey'],
            $project['name'],
            $project['avatarURL'],
            $project['created_at'],
            $project['updated_at'],
            $project['deleted_at']
        ));
    
    }

rewind($csv);
$output = stream_get_contents($csv);

// Put the content directly in file into the disk
Storage::disk('temp')->put("jira_projects_".date('m-d-Y_').microtime(true).".csv", $output);
        //$projects = Project::all();

        return response()->json([
            'status' => true,
            'project' => $projects
        ]);
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
