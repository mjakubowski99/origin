<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'traces';

    public function stations(){
        return $this->hasMany('App\Station', 'ID_TRACE');
    }
}
