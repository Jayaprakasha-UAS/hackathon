<?php

namespace App\Http\Controllers\Api;

use Atlassian\JiraRest\Requests\Issue;

use App\Http\Controllers\Controller;
//use App\Models\Issue;
use Illuminate\Http\Request;

use Storage;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var \Atlassian\JiraRest\Requests\Issue\IssueRequest $request */
            $request = app(Issue\IssueRequest::class);

            $response = $request->search([
                'maxResults' => 10,
                'startAt' => 0
            ]);

            $issues = \json_decode($response->getBody()->getContents(), true);

foreach ($issues['issues'] as $value) {
                $jiraissues[] = array(

                    'id' => $value['id'],
                    'key' => $value['key'],
                    'type_name' => '', //$value['name'],
                    'type_icon_url' => '', //$value['iconUrl'],
                    'is_subtask' => '', //$value['subtask'],
                    'parent_key' => '',
                    "status_name" => '',
                    "summary" => '',
                    "due_date" => '',
                    "estimate_remaining" => '',
                    "estimate_date" => '',
                    "estimate_diff" => '',
                    "priority_name" => '',
                    "priority_icon_url" => '',
                    "reporter_key" => '',
                    "reporter_name" => '',
                    "reporter_icon_url" => '',
                    "assignee_key" => '',
                    "assignee_name" => '',
                    "assignee_icon_url" => '',
                    "issue_category" => '',
                    "focus" => '',
                    "epic_key" => '',
                    "epic_url" => '',
                    "epic_name" => '',
                    "epic_color" => '',
                    "labels" => '',
                    "links" => '',
                    "rank" => '',
                    "entry_date" => '',
                    "created_at" => '',
                    "updated_at" => '',
                    "project_id" => '',
                    "project_key" => '',
                    "epic_id" => '',
                    "fix_versions" => '',
                    "changelogs_updated_at" => '',
                    "changelogs_count" => '',
                    "resolution_date" => '',
                    "rank_index" => '',
                    "worklogs_count" => '',
                    "worklogs_updated_at" => '',
                    "release_notes" => '',
                    "requires_release_notes" => '',


                );
            }

             $csv = fopen('php://temp/maxmemory:'. (5*1024*1024), 'r+');

             $columns = array(
        'id',
                    'key',
                    'type_name',
                    'type_icon_url',
                    'is_subtask',
                    'parent_key',
                    "status_name",
                    "summary",
                    "due_date",
                    "estimate_remaining",
                    "estimate_date",
                    "estimate_diff",
                    "priority_name",
                    "priority_icon_url",
                    "reporter_key",
                    "reporter_name",
                    "reporter_icon_url",
                    "assignee_key",
                    "assignee_name",
                    "assignee_icon_url",
                    "issue_category",
                    "focus",
                    "epic_key",
                    "epic_url",
                    "epic_name",
                    "epic_color",
                    "labels",
                    "links",
                    "rank",
                    "entry_date",
                    "created_at",
                    "updated_at",
                    "project_id",
                    "project_key",
                    "epic_id",
                    "fix_versions",
                    "changelogs_updated_at",
                    "changelogs_count",
                    "resolution_date",
                    "rank_index",
                    "worklogs_count",
                    "worklogs_updated_at",
                    "release_notes",
                    "requires_release_notes"
    );

 fputcsv($csv, $columns);
//fputcsv($csv, $projects);
              foreach($jiraissues as $issue) {

    fputcsv($csv, array(
            $issue['id'],
            $issue['key'],
            $issue['type_name'],
            $issue['type_icon_url'],
            $issue['is_subtask'],
            $issue['parent_key'],
            $issue['status_name']
        ));
    
    }

rewind($csv);
$output = stream_get_contents($csv);

// Put the content directly in file into the disk
Storage::disk('temp')->put("jira_isseus_".date('m-d-Y_').microtime(true).".csv", $output);
       // $issues = Issue::all();

        return response()->json([
            'status' => true,
            'issue' => $issues
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
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        //
    }
}
