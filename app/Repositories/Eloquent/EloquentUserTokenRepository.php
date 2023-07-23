<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepository\Eloquent\EloquentBaseRepository;
use App\Repositories\Interfaces\UserTokenRepository;
use Illuminate\Support\Facades\DB;

class EloquentUserTokenRepository extends EloquentBaseRepository implements UserTokenRepository{
    public function __construct($models)
    {
        $this->model = $models;
    }



}