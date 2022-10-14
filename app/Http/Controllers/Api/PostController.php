<?php

namespace App\Http\Controllers\Api;

use Atlassian\JiraRest\Requests\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // output up to 5MB is kept in memory, if it becomes bigger it will
// automatically be written to a temporary file
$csv = fopen('php://temp/maxmemory:'. (5*1024*1024), 'r+');

fputcsv($csv, array('blah','blah'));
rewind($csv);
$output = stream_get_contents($csv);

// Put the content directly in file into the disk
Storage::disk('temp')->put("products-%s.csv", $output);

        /*$productItemNumbers = [0, 15, 158, 584];
        $exportFileName     = sprintf('products-%s.csv', date('d-m-Y'));
        Storage::disk('csv')->put($exportFileName, $productItemNumbers);*/

     /* $issue = \Jira::issue('UAS-20286')->get();
        dd($issue);*/

        /** @var \Atlassian\JiraRest\Requests\Project\ProjectRequest $request */
/*$request = app(Project\ProjectRequest::class);

$response = $request->search([
    'maxResults' => 10,
    'startAt' => 0
]);

$output = \json_decode($response->getBody()->getContents(), true);
dd($output);*/

        $request = new \Atlassian\JiraRest\Requests\Issue\IssueRequest;
$response = $request->get('UAS-20286');
$response = json_decode($response->getBody(), true);
dd($response);


        $posts = Post::all();

        return response()->json([
            'status' => true,
            'posts' => $posts
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
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Post Created successfully!",
            'post' => $post
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $post->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Post Updated successfully!",
            'post' => $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'status' => true,
            'message' => "Post Deleted successfully!",
        ], 200);
    }
}