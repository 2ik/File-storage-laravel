<?php

namespace App\Http\Controllers;

use Exception;
use App\Resource;
use App\Jobs\DownloadFiles;
use App\Http\Resources\ResourceResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResourceController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:api')->except(['index', 'show', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ResourceResource::withoutWrapping();
        return Resource::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        ResourceResource::withoutWrapping();
        
        if (!$request->get('url')) {
            $returnData = array(
                'status' => 'error',
                'message' => 'url required'
            );
            return response()->json($returnData, 400);
        }

        try {
            $resource = Resource::add($request->all());
            
        } catch (Exception $exception) {

            Log::error('error create resource: '.$request['url']. ' - '. $exception);

            $returnData = array(
                'status' => 'error',
                'message' => 'error create resource'
            );
            return response()->json($returnData, 400);
        }
        
        DownloadFiles::dispatch($resource); // add queue
        
        return new ResourceResource($resource);
    }

    /**
     * Display the specified resource.
     *
     * @param  Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {   
        ResourceResource::withoutWrapping();
        return new ResourceResource($resource);
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
     * @param  Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        //
    }
}
