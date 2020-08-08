<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trains';

    public function places(){
        return $this->belongsToMany('App\Place', 'train_places', 'TRAIN_ID', 'PLACE_ID');
    }
}
