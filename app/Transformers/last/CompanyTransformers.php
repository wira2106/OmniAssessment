<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyTransformers extends JsonResource
{
    public function toArray($request)
    {    
        return [
            'id' => $this->id,
            'name_company' => $this->name_company,
            'nama_direktur' => $this->nama_direktur,
            'npwp_direktur' => $this->npwp_direktur,
            'npwp' => $this->NPWP !=="" && $this->NPWP !=="0"? $this->NPWP:'-',
            'email' => $this->email,
            'kontak' => $this->kontak,
            'alamat' => $this->alamat,
            'foto' => $this->foto?$this->foto:'default_company.jpg',
        ];
    }
}