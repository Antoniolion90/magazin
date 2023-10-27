<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->title,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'image_url' => $this->imageUrl,
            'category' => new CategoryResource($this->category),
            'is_show' => $this->is_show,
        ];
    }
}
