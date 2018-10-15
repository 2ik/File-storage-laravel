<?php

namespace App\Console\Commands;

use App\File;
use Illuminate\Console\Command;

class LinkFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'link:file {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a link based on id';

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
        if($url = File::get_link($this->argument('id'))){
            $this->info($url);
        } else {
            $this->error("unknown file: ".$this->argument('id'));
        }
            
    }
}
