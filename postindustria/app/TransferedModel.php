<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferedModel extends Model
{
    protected $table = 'transfered';
    protected $fillable = ['id', 'user_id', 'date', 'resource', 'transfered'];
    public $timestamps = false;
    public function user(){
        return $this->belongsTo('App\UsersModel', 'user_id', 'id');
    }
}
