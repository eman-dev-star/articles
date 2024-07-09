<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->descTag(), // Use the descTag method to get the transformed description
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            // 'tags' => $this->whenLoaded('tags', fn () => TagsResource::collection($this->tags)),
        ];
    }

    private function descTag()
    {
        $description = $this->description;
        $tags=$this->tags;
        foreach ($tags as $tag) {
            // $description = $description."<a href='#'>#{$tag->name}</a>";
            $description = $description." "."#{$tag->name}";


        }
        return $description;

    }

}
