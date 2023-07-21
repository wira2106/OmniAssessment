<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepository\Eloquent\EloquentBaseRepository;
use App\Repositories\Interfaces\NeracaRepository;
use Illuminate\Support\Facades\DB;

class EloquentNeracaRepository extends EloquentBaseRepository implements NeracaRepository{
    public function __construct($models)
    {
        $this->model = $models;
    }

     /**
     * listData
     * 
     * (To get data list company)
     * 
     * @param  mixed $request
     * @return void
     */

    public function find_neraca($id)
    {
        $data_koreksi_fiskal = $this->model
                                ->select([
                                    'companies.name_company',
                                    'companies.email',
                                    'companies.nama_direktur',
                                    'companies.kontak',
                                    'companies.alamat',
                                    'neraca.*',
                                ])
                                ->join('companies','companies.id','=','neraca.companies_id')
                                ->where('neraca.id',$id)
                                ->first();

        return $data_koreksi_fiskal;
    }
    public function listData($request)
    {
        $list_neraca = $this->model
                                ->select([
                                    'companies.name_company',
                                    'companies.npwp',
                                    'companies.alamat',
                                    'neraca.*',
                                ])
                                ->join('companies','companies.id','=','neraca.companies_id');
        if($request->cari){
            $cari = $request->cari;
            $list_neraca = $list_neraca->where(function ($query) use ($cari) {
                                $query->where('companies.nama_company', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('companies.NPWP', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('companies.alamat', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('companies.email', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('companies.kontak', 'LIKE', '%' . $cari . '%');
                            });
        }
        $jumlah = $list_neraca->count();
        $list_neraca = $list_neraca->orderByDesc('created_at')->skip($request->page * 10)->take(10)->get();
        $send = array(
            'jumlah'=>$jumlah,
            'data' =>$list_neraca
        );
        return $send;
    }

    public function delete($id)
    {
        $neraca = $this->model->find($id);
        $neraca = $neraca->delete();
        return $neraca;
    }

}