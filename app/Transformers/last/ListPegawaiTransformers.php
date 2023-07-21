<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ListPegawaiTransformers extends JsonResource
{
    public function toArray($request)
    {    
        $status_pegawai = (new StatusPegawaiTransformers($this->status_pegawai));
        $alamat = explode(" ", $this->alamat);
        $alamat_sort = '';
        foreach ($alamat as $key => $value) {
            if($key < 6){
                $alamat_sort = $alamat_sort." ".$value;
            }
        }
        $pegawai_listpph = $this->perhitungan_pph21()->select(['perhitungan_pph21.id', DB::raw("DATE_FORMAT(periode, '%Y') year")])->get();
        $data_list = [];
        foreach ($pegawai_listpph as $value) {
            if (array_key_exists($value->year,$data_list)) {
                $data_list[$value->year] += 1;
            } else {
                $data_list[$value->year] = 1;
            }     
        }
        
        $alamat_sort = $alamat_sort." ...";
        $jenis_kelamin = $this->jenis_kelamin?'Laki-laki':'Perempuan';
        return [
            'id' => $this->id,
            'nama_pegawai' => $this->nama,
            'NPWP_pegawai' => $this->NPWP,
            'jabatan_pegawai' => $this->jabatan,
            'email_pegawai' => $this->email,
            'kontak_pegawai' => $this->kontak,
            'status_pegawai' => $status_pegawai,
            'periode_bekerja' => date('d/m/Y',strtotime($this->periode_bekerja)),
            'gaji_pokok' => $this->gaji_pokok,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat_pegawai' => $alamat_sort,
            'alamat_lengkap' => $this->alamat,
            'jumlah_perhitungan' => (object)$data_list,
            'foto' => $this->foto?$this->foto:'default.jpg',
        ];
    }
}