<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['id', 'amount', 'date', 'comment', 'type_id', 'del_flg', 'created_at', 'updated_at'];

    public function type(){
        return $this->belongsTo('App\Type', 'type_id', 'id');
    }
}
