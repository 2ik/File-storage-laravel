<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Resources\FileResource;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:api')->except(['show']);
    }

    public function show($id)
    {
        FileResource::withoutWrapping();

        if(!File::get_link($id)){
            $returnData = array(
                'status' => 'error',
                'message' => 'unknown file'
            );
            return response()->json($returnData, 400);
        }

        $file = File::find($id);

        return new FileResource($file);

    }
}
