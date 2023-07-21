<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepository\Eloquent\EloquentBaseRepository;
use App\Repositories\Interfaces\StatusPegawaiRepository;
use Illuminate\Support\Facades\DB;

class EloquentStatusPegawaiRepository extends EloquentBaseRepository implements StatusPegawaiRepository{
    public function __construct($models)
    {
        $this->model = $models;
    }



}