<?php

namespace App\Transformers;

use App\Traits\ConvertToCurrency;
use Illuminate\Http\Resources\Json\JsonResource;

class PerhitunganPPh21Transformers extends JsonResource
{
    use ConvertToCurrency;
    public function toArray($request)
    {    
        return [
            'id' => $this->id,
            'pegawai_id' => $this->pegawai_id,
            'periode' => date('M Y',strtotime($this->periode)),
            'periode_format' => date('Y-m',strtotime($this->periode)),
            'gaji_pokok' => str_replace('.',',',$this->rupiah($this->gaji_pokok)),
            'pendapatan_kotor' => str_replace('.',',',$this->rupiah($this->pendapatan_kotor)),
            'tunjangan_lain' => str_replace('.',',',$this->rupiah($this->tunjangan_lain)),
            'bpjs_kesehatan' => str_replace('.',',',$this->rupiah($this->bpjs_kesehatan)),
            'JKK' => str_replace('.',',',$this->rupiah($this->JKK)),
            'JK' => str_replace('.',',',$this->rupiah($this->JK)),
            'thr' => str_replace('.',',',$this->rupiah($this->thr)),
            'gaji_bruto' => str_replace('.',',',$this->rupiah($this->gaji_bruto)),
            'gaji_bruto_setahun' => str_replace('.',',',$this->rupiah($this->gaji_bruto_setahun)),
            'biaya_jabatan' => str_replace('.',',',$this->rupiah($this->biaya_jabatan)),
            'JHT' => str_replace('.',',',$this->rupiah($this->JHT)),
            'pensiunan' => str_replace('.',',',$this->rupiah($this->pensiunan)),
            'gaji_neto' => str_replace('.',',',$this->rupiah($this->gaji_neto)),
            'gaji_neto_setahun' => str_replace('.',',',$this->rupiah($this->gaji_neto_setahun)),
            'PTKP' => str_replace('.',',',$this->rupiah($this->PTKP)),
            'PKP' => str_replace('.',',',$this->rupiah($this->PKP)),
            'pph_npwp' => str_replace('.',',',$this->rupiah($this->pph_npwp)),
            'pph_non_npwp' => str_replace('.',',',$this->rupiah($this->pph_non_npwp)),
            'pph_21_sebulan' => str_replace('.',',',$this->rupiah($this->pph_21_sebulan)),
        ];
    }
}