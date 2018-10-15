<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\File;
use App\Resource;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileTest extends TestCase
{

    public $url = "https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png";

    public function testAddFile()
    {
        $resource = Resource::where('url', $this->url)->first();
        
        $file = File::save_file($resource->id, $resource->url);

        $this->assertEquals($file->name, basename($this->url));
    }

}
