<?php

namespace App\Repositories\Eloquent;

use App\Models\Company;
use App\Repositories\BaseRepository\Eloquent\EloquentBaseRepository;
use App\Repositories\Interfaces\KoreksiFiskalRepository;
use Illuminate\Support\Facades\DB;

class EloquentKoreksiFiskalRepository extends EloquentBaseRepository implements KoreksiFiskalRepository{
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
    public function listData($request)
    {
        $list_koreksi_fiskal = $this->model
                                ->select([
                                    'companies.name_company',
                                    'companies.npwp',
                                    'companies.alamat',
                                    'koreksi_fiskal.*',
                                ])
                                ->join('companies','companies.id','=','koreksi_fiskal.companies_id');
        if($request->cari){
            $cari = $request->cari;
            $list_koreksi_fiskal = $list_koreksi_fiskal->where(function ($query) use ($cari) {
                                $query->where('companies.nama_company', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('companies.NPWP', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('companies.alamat', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('companies.email', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('companies.kontak', 'LIKE', '%' . $cari . '%');
                            });
        }
        $jumlah = $list_koreksi_fiskal->count();
        $list_koreksi_fiskal = $list_koreksi_fiskal->orderByDesc('created_at')->skip($request->page * 10)->take(10)->get();
        $send = array(
            'jumlah'=>$jumlah,
            'data' =>$list_koreksi_fiskal
        );
        return $send;
    }


    public function find_koreksi_fiskal($id)
    {
        $data_koreksi_fiskal = $this->model
                                ->select([
                                    'companies.name_company',
                                    'companies.email',
                                    'companies.nama_direktur',
                                    'companies.kontak',
                                    'companies.alamat',
                                    'companies.NPWP',
                                    'koreksi_fiskal.*',
                                ])
                                ->join('companies','companies.id','=','koreksi_fiskal.companies_id')
                                ->where('koreksi_fiskal.id',$id)
                                ->first();

        return $data_koreksi_fiskal;
    }

    

    public function delete($id)
    {
        $koreksifiskal = $this->model->find($id);
        $koreksifiskal = $koreksifiskal->delete();
        return $koreksifiskal;
    }

    public function koreksi_fiskal_total(Company $company, $tahun){
        $koreksi_fiskal = $company->koreksi_fiskal()->where('koreksi_fiskal.periode_koreksi_fiskal','LIKE','%'.$tahun.'%')->first();
        $data = json_decode($koreksi_fiskal->data);
        $koreksi_fiskal_total = 0;
        foreach ($data as $key => $value) {
           $koreksi_fiskal_total += $value->total;
        }

        return (object)['koreksi_fiskal_total' => $koreksi_fiskal_total];
    }

}