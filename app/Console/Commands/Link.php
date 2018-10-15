<?php

namespace App\Console\Commands;

use App\Resource;
use App\File;
use App\Jobs\DownloadFiles;
use Illuminate\Console\Command;

class Link extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'link:filch {link}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download file in local storage';

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
        $resource = Resource::add([
            'url' => $this->argument('link')
        ]);

        DownloadFiles::dispatch($resource); // add queue

        $this->info('OK: Queued for download');
    }
}
