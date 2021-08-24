<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'image' => $this->image,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category' => $this->subCategory->category->name,
            'sub_category' => $this->subCategory->name,
            'created' => $this->created_at
        ];
    }
}
