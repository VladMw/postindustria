<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $fillable = ['id', 'name', 'email', 'company'];
    public $timestamps = false;
    public function transfered(){
        return $this->hasMany('App\TransferedModel', 'user_id', 'id');
    }
    public function company(){
        return $this->belongsTo('\App\CompaniesModel', 'company', 'id');
    }
}
