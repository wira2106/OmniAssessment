<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepository\Eloquent\EloquentBaseRepository;
use App\Repositories\Interfaces\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EloquentCompanyRepository extends EloquentBaseRepository implements CompanyRepository{
    
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
        $list_companies = $this->model;
        if($request->cari){
            $cari = $request->cari;
            $list_companies = $list_companies->where(function ($query) use ($cari) {
                                $query->where('companies.nama_company', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('companies.NPWP', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('companies.alamat', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('companies.email', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('companies.kontak', 'LIKE', '%' . $cari . '%');
                            });
        }
        $jumlah = $list_companies->count();
        $list_companies = $list_companies->orderByDesc('created_at')->skip($request->page * 10)->take(10)->get();
        $send = array(
            'jumlah'=>$jumlah,
            'data' =>$list_companies
        );
        return $send;
    }

    public function create($request,$foto=null)
    {
        $role =strtolower($request->jabatan) == 'accounting'?'accounting':'pegawai';
        $role =strtolower($request->jabatan) == 'direktur'?'direktur':'pegawai';
        $company = $this->model->create([
                'name_company' => $request->name_company,
                'nama_direktur' => $request->nama_direktur,
                'NPWP' => $request->NPWP,
                'email' => $request->email,
                'kontak' => $request->kontak,
                'alamat' => $request->alamat,
                'foto' => $foto,
            ]);
        return $company;
    }

    public function update_data($id,$request,$foto)
    {
        $company = $this->model->find($id);
        $role =strtolower($request->jabatan) == 'accounting'?'Accounting':'pegawai';
        $role =strtolower($request->jabatan) == 'direktur'?'direktur':'pegawai';
        $company = $company->update([
            'name_company' => $request->name_company,
            'nama_direktur' => $request->nama_direktur,
            'npwp_direktur' => $request->npwp_direktur,
            'NPWP' => $request->NPWP,
            'email' => $request->email,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
            'foto' => $foto,
        ]);
        return $company;
    }

    public function delete($id)
    {
        $user = $this->model->find($id);
        $user = $user->delete();
        return $user;
    }

}