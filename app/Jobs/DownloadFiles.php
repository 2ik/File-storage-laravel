<?php

namespace App\Jobs;

use App\File;
use App\Resource;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class DownloadFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $resource;
    public $tries = 3;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('START id: '.$this->resource->id.' the download of the file: '.$this->resource->url);
        
        $res = Resource::find($this->resource->id);

        $res->change_status(2); // downloading

        if(!$save = File::save_file($this->resource->id, $this->resource->url)){
            $res->change_status(4); // error
        } else {
            $res->change_status(3); // complete
            $res->change_download_link($save->id); 
        }

        Log::info('FINISH id: '.$this->resource->id.' downloading the file: '.$this->resource->url);
    }

    /**
     * Failed the job.
     *
     * @return void
     */
    public function failed(Exception $exception)
    {
        Log::info(__CLASS__ . ": error run task");
    }
}
