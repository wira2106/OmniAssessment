<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TemplateTransformers extends JsonResource
{
    public function toArray($request)
    {    
        return [
            'nama' => $this->name,
            'jabatan' => $this->jabatan,
            'alamat' => $this->alamat,
            'foto' => $this->foto,
        ];
    }
}