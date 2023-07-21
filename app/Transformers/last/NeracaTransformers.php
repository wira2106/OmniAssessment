<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class NeracaTransformers extends JsonResource
{
    public function toArray($request)
    {    
        $data = json_decode($this->data);
        return [
            'id' => $this->id,
            'name_company' => $this->name_company,
            'alamat' => $this->alamat,
            'npwp' => $this->npwp,
            'compenies_alamat' => $this->compenies_id,
            'periode_neraca' => $this->periode_neraca,
            'periode' => date('Y',strtotime($this->periode_neraca)),
            'data' => $data,
        ];
    }
}