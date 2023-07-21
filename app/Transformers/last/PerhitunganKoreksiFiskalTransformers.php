<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class PerhitunganKoreksiFiskalTransformers extends JsonResource
{
    public function toArray($request)
    {    
        return [
            'koreksi_fiskal_total' => $this->koreksi_fiskal_total,
        ];
    }
}