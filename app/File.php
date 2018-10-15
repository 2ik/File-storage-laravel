<?php

namespace App;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class File extends Model
{
    protected $fillable = ['resource_id', 'name'];


    public function resource()
    {
        return $this->hasOne('\App\Resource');
    }
    /**
     * get end url
     */
    public static function end_url($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); //set url
        curl_setopt($ch, CURLOPT_HEADER, true); //get header
        curl_setopt($ch, CURLOPT_NOBODY, true); //do not include response body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //do not show in browser the response
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); //follow any redirects
        curl_exec($ch);
        $new_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); //extract the url from the header response
        curl_close($ch);

        return $new_url;
    }

    /**
     * get content url file
     */
    public static function get_url($url)
    {
        return file_get_contents($url);
    }

    /**
     * save file in local starage
     */
    public static function save_file($id, $url)
    {
        $url_with_redirect = self::end_url($url);
        $folder = 'public/files/'.$id.'/';
        $file_name = basename($url);
        
        try {
            Storage::disk('local')->put($folder.$file_name, self::get_url($url_with_redirect));
        } catch (Exception $exception) {
            Log::error('failed to load file: '.$url. ' - '. $exception);
            return False;
        }

        $new_file = self::add([
            'resource_id' => $id,
            'name' => $file_name
        ]);

        return $new_file;

    }

    /**
     * create new write file
     */
    public static function add($fields)
    {
        $file = new static;
    	$file->fill($fields);
        $file->save();
        
    	return $file;
    }

    /**
     * get link on file in local storage
     */
    public static function get_link($id)
    {
        $file = self::find($id);

        try {
            $path = Storage::url('public/files/'.$file->resource_id.'/'.$file->name);
        } catch (Exception $exception) {
            Log::error('unknown file: '.$id.' - '.$exception);
            return False;
        }
        
        return asset($path);
    }

}
