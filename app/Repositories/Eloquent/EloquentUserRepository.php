<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepository\Eloquent\EloquentBaseRepository;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EloquentUserRepository extends EloquentBaseRepository implements UserRepository{
    
    public function __construct($models)
    {
        $this->model = $models;
    }
    
    /**
     * getProfile
     *
     * To get data profile user
     * 
     * @param  mixed $user
     * @return void
     */
    public function getProfile($user)
    {
        $profile_data = $this->model->find($user->id);
        return $profile_data;

    }
    
    /**
     * listData
     * 
     * (To get data list user)
     * 
     * @param  mixed $request
     * @return void
     */
    public function listData($request)
    {
        $list_user = $this->model;
        if($request->cari){
            $cari = $request->cari;
            $list_user = $list_user->where(function ($query) use ($cari) {
                                $query->where('users.name', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('users.jabatan', 'LIKE', '%' . $cari . '%')
                                    ->orWhere('users.alamat', 'LIKE', '%' . $cari . '%');
                            });
        }
        $jumlah = $list_user->count();
        $list_user = $list_user->orderByDesc('created_at')->skip($request->page * 10)->take(10)->get();
        $send = array(
            'jumlah'=>$jumlah,
            'data' =>$list_user
        );
        return $send;
    }

    public function create($request,$foto=null)
    {
        $user = $this->model->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'alamat' => $request->alamat,
                'foto' => $foto,
            ]);
        return $user;
    }

    public function update_data($id,$request,$foto)
    {
        $user = $this->model->find($id);
        $role =strtolower($request->jabatan);
        $user = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'foto' => $foto,
            'role' => $role,
        ]);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->model->find($id);
        $user = $user->delete();
        return $user;
    }

}