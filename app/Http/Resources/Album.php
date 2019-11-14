<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Album extends JsonResource
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
            'id'=> $this->id,
            'title'=> $this->title,
            'coverartURL' =>$this->coverartURL,
            'previewURL' => $this->previewURL,
            'catalogID'=> $this->catalogID,
            'price'=> $this->price,
            'blurb' => $this->blurb,
        ];
    }
}
