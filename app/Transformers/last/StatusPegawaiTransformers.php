<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusPegawaiTransformers extends JsonResource
{
    public function toArray($request)
    {    
        return [
            'id' => $this->id,
            'status_code' => $this->status_code,
            'ptkp' => $this->ptkp,
            'keterangan' => $this->keterangan,
        ];
    }
}