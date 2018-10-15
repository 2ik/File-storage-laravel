<?php

namespace App\Console\Commands;

use App\Resource;
use Illuminate\Console\Command;

class LinkList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'link:list {--status=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all link with all statuses --status=(pending|downloading|complete|error)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $headers = ['id', 'url', 'status', 'file id'];

        switch ($this->option('status')) {

            case 'pending':
                $resources = Resource::where('status', 1)
                ->get(['id', 'url', 'status', 'download_link'])
                ->toArray();
                break;
            
            case 'downloading':
                $resources = Resource::where('status', 2)
                ->get(['id', 'url', 'status', 'download_link'])
                ->toArray();
                break;
            
            case 'complete':
                $resources = Resource::where('status', 3)
                ->get(['id', 'url', 'status', 'download_link'])
                ->toArray();
                break;
            
            case 'error':
                $resources = Resource::where('status', 4)
                ->get(['id', 'url', 'status', 'download_link'])
                ->toArray();
                break;
            
            default:
                $resources = Resource::all(['id', 'url', 'status', 'download_link'])
                ->toArray();
                break;
        }

        $this->table($headers, $resources);
        
    }
}
