<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepository\Eloquent\EloquentBaseRepository;
use Illuminate\Support\Facades\DB;

class TemplateEloquent extends EloquentBaseRepository implements TemplateInterface{
    public function __construct($models)
    {
        $this->model = $models;
    }



}