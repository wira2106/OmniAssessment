<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepository\Eloquent\EloquentBaseRepository;
use App\Repositories\Interfaces\PerhitunganPPh21Repository;
use Illuminate\Support\Facades\DB;

class EloquentPerhitunganPPh21Repository extends EloquentBaseRepository implements PerhitunganPPh21Repository{
    public function __construct($models)
    {
        $this->model = $models;
    }

     /**
     * listData
     * 
     * (To get data list user)
     * 
     * @param  mixed $request
     * @return void
     */
    public function listData($request,$data_relation)
    {
        $list_user = $data_relation;
        if($request->cari){
            $cari = $request->cari;
            $list_user = $list_user->where(function ($query) use ($cari) {
                                $query->where('perhitungan_pph21.periode', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.gaji_pokok', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.pendapatan_kotor', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.tunjangan_lain', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.bpjs_kesehatan', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.JKK', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.JK', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.thr', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.gaji_bruto', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.gaji_bruto_setahun', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.biaya_jabatan', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.JHT', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.pensiunan', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.gaji_neto', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.gaji_neto_setahun', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.PTKP', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.PKP', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.pph_npwp', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.pph_non_npwp', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('perhitungan_pph21.pph_21_sebulan', 'LIKE', '%' . $cari . '%');  
                            });
        }
        $jumlah = $list_user->count();
        $list_user = $list_user->orderBy('periode','asc')->skip($request->page * 10)->take(10)->get();
        
        $send = array(
            'jumlah'=>$jumlah,
            'data' =>$list_user
        );
        return $send;
    }

    public function update_data($id,$request)
    {
        $data_perhitungan =[
            'pegawai_id' => $request->pegawai_id,
            'periode' => date('Y-m',strtotime($request->periode)).'-01',
            'gaji_pokok' => (int)str_replace(',','',$request->gaji_pokok),
            'pendapatan_kotor' => (int)str_replace(',','',$request->pendapatan_kotor),
            'tunjangan_lain' => (int)str_replace(',','',$request->tunjangan_lain),
            'bpjs_kesehatan' => (int)str_replace(',','',$request->bpjs_kesehatan),
            'JKK' => (int)str_replace(',','',$request->JKK),
            'JK' => (int)str_replace(',','',$request->JK),
            'thr' => (int)str_replace(',','',$request->thr),
            'gaji_bruto' => (int)str_replace(',','',$request->gaji_bruto),
            'gaji_bruto_setahun' => (int)str_replace(',','',$request->gaji_bruto_setahun),
            'biaya_jabatan' => (int)str_replace(',','',$request->biaya_jabatan),
            'JHT' => (int)str_replace(',','',$request->JHT),
            'pensiunan' => (int)str_replace(',','',$request->pensiunan),
            'gaji_neto' => (int)str_replace(',','',$request->gaji_neto),
            'gaji_neto_setahun' => (int)str_replace(',','',$request->gaji_neto_setahun),
            'PTKP' => (int)str_replace(',','',$request->PTKP),
            'PKP' => (int)str_replace(',','',$request->PKP),
            'pph_npwp' => (int)str_replace(',','',$request->pph_npwp),
            'pph_non_npwp' => (int)str_replace(',','',$request->pph_non_npwp),
            'pph_21_sebulan' => (int)str_replace(',','',$request->pph_21_sebulan)

        ];
        $perhitunganpph21 = $this->model->find($id);
        $perhitunganpph21 = $perhitunganpph21->update($data_perhitungan);
        return $perhitunganpph21;
    }

    public function delete($id)
    {
        $perhitunganpph21 = $this->model->find($id);
        $perhitunganpph21 = $perhitunganpph21->delete();
        return $perhitunganpph21;
    }


}