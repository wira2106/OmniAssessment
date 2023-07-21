<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTransformers extends JsonResource
{
    public function toArray($request)
    {    
        return [
            'id' => $this->id,
            'nama' => $this->name,
            'jabatan' => $this->jabatan?$this->jabatan:'Pegawai',
            'email' => $this->email,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'foto' => $this->foto?$this->foto:'default.jpg',
        ];
    }
}