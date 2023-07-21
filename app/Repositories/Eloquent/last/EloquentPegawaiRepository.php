<?php

namespace App\Repositories\Eloquent;

use App\Models\Company;
use App\Repositories\BaseRepository\Eloquent\EloquentBaseRepository;
use App\Repositories\Interfaces\PegawaiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EloquentPegawaiRepository extends EloquentBaseRepository implements PegawaiRepository{
    
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
    public function listData($request,$company)
    {
        $list_pegawai = $company->pegawai();
        $jumlah = $list_pegawai->count();
        if($request->cari){
            $cari = $request->cari;
            $list_pegawai = $list_pegawai->where(function ($query) use ($cari) {
                                $query->where('pegawai.nama', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('pegawai.email', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('pegawai.kontak', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('pegawai.jabatan', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('pegawai.alamat', 'LIKE', '%' . $cari . '%'
                                );  
                            });
        }
        $list_pegawai = $list_pegawai->orderBy('created_at','asc')->skip($request->page * 10)->take(10)->get();
        $send = array(
            'jumlah'=>$jumlah,
            'data' =>$list_pegawai
        );
        return $send;
    }

    public function find_on_jabatan($jabatan,$company)
    {
        $jabatan = $jabatan;
        $list_pegawai = $company->pegawai();
        $list_pegawai = $list_pegawai->where(function ($query) use ($jabatan) {
                                $query->where('pegawai.jabatan', 'LIKE', '%' . $jabatan . '%');  
                            })->first();

        return $list_pegawai;
    }
    
    
    /**
     * Update Data Pegawai Company
     *
     * @param  mixed $id
     * @param  mixed $request
     * @param  mixed $foto
     * @return void
     */
    public function update_data($id,$request,$foto)
    {
        $pegawai = $this->model->find($id);
        $jk = $request->jenis_kelamin == '1'?1:0;
        $data_pegawai = [
            'companies_id'=>$request->companies_id,
            'status_id'=>$request->status_id,
            'NPWP'=>$request->NPWP?$request->NPWP:0,
            'nama'=>$request->nama,
            'jabatan'=>$request->jabatan,
            'periode_bekerja'=>$request->periode_bekerja,
            'gaji_pokok'=>(int)str_replace(',','',$request->gaji_pokok),
            'email'=>$request->email,
            'kontak'=>$request->kontak,
            'jenis_kelamin'=>$jk,
            'alamat'=>$request->alamat,
            'foto'=>$foto,
        ];
        $pegawai = $pegawai->update($data_pegawai);
        return $pegawai;
    }

    public function get_data_bukti_potong($id,$tahun){
        $pegawai = $this->model->find($id);
        $status_pegawai = $pegawai->status_pegawai;
        $company = $pegawai->company;
        $perhitungan_pph21 = $pegawai->perhitungan_pph21()
                                    ->select([
                                        DB::raw('SUM(gaji_bruto) as bruto_setahun'),
                                        DB::raw('SUM(pph_21_sebulan) as pph_21_setahun'),
                                        DB::raw('SUM(tunjangan_lain) as tunjangan_lain_setahun'),
                                        DB::raw('SUM(biaya_jabatan) as biaya_jabatan_setahun'),
                                        DB::raw('SUM(pensiunan) as pensiunan_setahun'),
                                        DB::raw('SUM(JHT) as JHT_setahun'),
                                        DB::raw('SUM(gaji_neto) as gaji_neto_setahun'),
                                    ])
                                     ->where('perhitungan_pph21.periode', 'LIKE', '%' . $tahun . '%')
                                     ->get();
        $send = array(
            'pegawai'=>$pegawai,
            'status_pegawai'=>$status_pegawai,
            'perhitungan_pph21'=>$perhitungan_pph21,
            'company' =>$company
        );
        return $send;

    }
    
    /**
     * Delete Data Pegawai Company
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $pegawai = $this->model->find($id);
        $pegawai = $pegawai->delete();
        return $pegawai;
    }
    
    public function gaji_pegawai_setahun(Company $company, $tahun){
        $pegawai = $company->pegawai()->orderBy('created_at','desc')->get();
        $bruto_seluruh_pegawai = 0;
        foreach ($pegawai as $key => $value) {
           $perhitungan_pph21 = $value->perhitungan_pph21()->where('perhitungan_pph21.periode', 'LIKE', '%' . $tahun . '%');
           if($perhitungan_pph21->count()){
            $sum_gaji_bruto = $perhitungan_pph21->sum('gaji_bruto');
            $bruto_seluruh_pegawai += $sum_gaji_bruto;
           }
        }
        return (object)['gaji_bruto_pegawai' => $bruto_seluruh_pegawai];
    }

}