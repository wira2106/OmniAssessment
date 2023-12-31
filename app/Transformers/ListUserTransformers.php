<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ListUserTransformers extends JsonResource
{
    public function toArray($request)
    {    
        return [
            'id' => $this->id,
            'nama' => $this->name,
            'email' => $this->email,
            'alamat' => $this->alamat,
            'foto' => $this->foto?$this->foto:'default.jpg',
        ];
    }
}