<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ListCompanyTransformers extends JsonResource
{
    public function toArray($request)
    {    
        $alamat = explode(" ", $this->alamat);
        $alamat_sort = '';
        foreach ($alamat as $key => $value) {
            if($key < 6){
                $alamat_sort = $alamat_sort." ".$value;
            }
        }
        $alamat_sort = $alamat_sort." ...";
        return [
            'id' => $this->id,
            'name_company' => $this->name_company,
            'alamat' => $alamat_sort,
            'jumlah_pegawai' => $this->pegawai->count(),
            'foto' => $this->foto?$this->foto:'default_company.jpg',
        ];
    }
}