<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class PerhitunganPegawaiTransformers extends JsonResource
{
    public function toArray($request)
    {    
        
        return [
            'gaji_bruto_pegawai_setahun' => $this->gaji_bruto_pegawai,
        ];
    }
}