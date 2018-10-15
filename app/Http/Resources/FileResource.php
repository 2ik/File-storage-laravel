<?php

namespace App\Http\Resources;

use App\File;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'resource_id' => $this->resource_id,
            'download_link' => File::get_link($this->id),
            'created_at' => (string) $this->created_at,
            // 'updated_at' => (string) $this->updated_at
        ];
    }
}
