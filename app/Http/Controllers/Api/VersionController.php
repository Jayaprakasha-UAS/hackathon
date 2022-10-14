<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Version;
use Illuminate\Http\Request;
use Storage;

class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
           // $request = app(Project\ProjectRequest::class);

           /* $response = $request->search([
                'maxResults' => 10,
                'startAt' => 0
            ]);*/
$version = Version::all();
           // $version = array(); //\json_decode($response->getBody()->getContents(), true);

            foreach ($version as $value) {
               
               
                $versions[] = array(

                    'project_id' => $value['project_id'],
                    'jira_id' => $value['jira_id'],
                    'name' => $value['name'],
                    'released' => $value['released'],
                    'release_date' => $value['release_date'],
                    'created_at' => $value['created_at'],
                    "updated_at" => $value['updated_at'],

                );
            }

             $csv = fopen('php://temp/maxmemory:'. (5*1024*1024), 'r+');

             $columns = array(
        'project_id', 
        'jira_id', 
        'name', 
        'released',
        'release_date', 
        'created_at',
        'updated_at'
    );
 fputcsv($csv, $columns);
    foreach($versions as $version) {
    fputcsv($csv, array(
            $version['project_id'],
            $version['jira_id'],
            $version['name'],
            $version['released'],
            $version['release_date'],
            $version['created_at'],
            $version['updated_at']
        ));
    
    }

rewind($csv);
$output = stream_get_contents($csv);

// Put the content directly in file into the disk
Storage::disk('temp')->put("jira_versions_".date('m-d-Y_').microtime(true).".csv", $output);

        //$versions = Version::all();

        return response()->json([
            'status' => true,
            'version' => $versions
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
     * @param  \App\Models\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function show(Version $version)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function edit(Version $version)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Version $version)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function destroy(Version $version)
    {
        //
    }
}
