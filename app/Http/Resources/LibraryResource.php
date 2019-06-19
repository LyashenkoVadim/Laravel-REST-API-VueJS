<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LibraryResource extends JsonResource
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
            'library_name' => $this->library_name,
            'address' => $this->address,
            'href' => [
                'books' => route('books.index', $this->id),
            ],
        ];
    }
}
