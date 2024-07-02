<?php
namespace App\Http\Resources\V1;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(\Illuminate\Http\Request $request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content
        ];
    }
}
