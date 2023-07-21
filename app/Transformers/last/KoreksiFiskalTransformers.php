<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class KoreksiFiskalTransformers extends JsonResource
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
            'periode_koreksi_fiskal' => $this->periode_koreksi_fiskal,
            'periode' => date('Y',strtotime($this->periode_koreksi_fiskal)),
            'data' => $data,
        ];
    }
}