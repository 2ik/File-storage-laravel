<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{   
    protected $fillable = ['url'];
    

    public function status()
    {
        return $this->belongsTo('\App\Status');
    }

    public function file()
    {
        return $this->belongsTo('\App\File');
    }

    /**
     * create resource
     */
    public static function add($fields)
    {
        $resource = new static;
    	$resource->fill($fields);
    	$resource->status = 1;
    	$resource->save();

    	return $resource;
    }

    /**
     * edit resource
     */
    public function edit($fields)
    {
    	$this->fill($fields);
    	$this->save();
    }

    /**
     * change field status resource
     */
    public function change_status($status)
    {
        $this->status = $status;
        $this->save();
    }

    /**
     * change field download_link resource
     */
    public function change_download_link($link)
    {
        $this->download_link = $link;
        $this->save();
    }
    


}
