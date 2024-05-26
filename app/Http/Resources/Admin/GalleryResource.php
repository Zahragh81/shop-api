<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'path' => url(env('IMAGE_UPLOADED_FOR_GALLERY'). $this->path),
            'mime' => $this->mime,

        ];
    }
}
