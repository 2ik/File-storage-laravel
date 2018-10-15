<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Resource;
use App\File;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResourceTest extends TestCase
{

    public $url = "https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png";

    public function testAddResource()
    {
        $resource = Resource::add([
            'url' => $this->url
        ]);

        $this->assertEquals($resource->url, $this->url);
    }

    public function testEditResourceStatus()
    {
        $resource = Resource::where('url', $this->url)->first();

        $resource->change_status(2);
        
        $this->assertEquals($resource->status, 2);
    }

    public function testEditResourceLinkDownload()
    {
        $resource = Resource::where('url', $this->url)->first();

        $resource->change_download_link(2);
        
        $this->assertEquals($resource->download_link, 2);
    }

}
