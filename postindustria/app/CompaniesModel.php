<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompaniesModel extends Model
{
    protected $table = 'companies';
    protected $fillable = ['name', 'qouta'];
    public $timestamps = false;
    public function user(){
        return $this->hasMany('\App\UsersModel', 'company', 'id');
    }
}
