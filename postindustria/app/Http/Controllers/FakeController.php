<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsersModel;
use App\TransferedModel;
use App\CompaniesModel;

class FakeController extends Controller
{
    public $action = ['user' => 50, 'company' => 10, 'transfer' => 500];
    public $alphabet = ['qw', 'A', 'S', 'Df', 'GH', 'JK', 'LQWER', 'TY', 'UI', 'O', 'PZX', 'CV', 'BNM', '1234567890', 'poysrtqzx', '1z2x58z'];
    public function fake(Request $request){
        if(in_array($request->type, array_keys($this->action))){
            switch($request->type):
                case 'user':
                    $result = $this->randomUser();
                    break;
                case 'company':
                    $result = $this->randomCompany();
                    break;
                case 'transfer':
                    $result = $this->randomTransfer();
                    break;
            endswitch;
            return response()->json($result);
        }else{
            return response()->json(array([
            'success' => false,
            'msg' => "Bad params"
        ]));
        }  
    }
    
    public function randomUser(){
        for($i=0; $i < $this->action['user']; ){
            $company = CompaniesModel::orderByRaw("RAND()")->first();
            for($k=0; $k < 5; $k++){
                $name =''; 
                $email='';
                foreach(array_rand($this->alphabet, 3) as $key){
                    $name .= $this->alphabet[$key];
                    $email .= $this->alphabet[$key];
                }
                $email .= '@mail.com';
                $user = new UsersModel;
                $user->name = $name;
                $user->email = $email;
                $company->user()->save($user);
            }
            $i += 5;
        }
        return array(
            'sucess' => true,
            'msg' => 'User created successfully'
        );
    }
    public function randomCompany(){
        for($i=0; $i < $this->action['company']; $i++){
            $company = new CompaniesModel();
            $name = '';
            foreach(array_rand($this->alphabet, 3) as $key){
                $name .= $this->alphabet[$key];
            }
            $company->name = $name;
            $company->quota = random_int(1048576, 10485760);
            $company->save();
        }
        return array(
            'success' => true,
            'msg' => 'Company created successfully'
        );
    }
    public function  randomTransfer(){
        for($i=0; $i < $this->action['transfer']; ){
            $user = UsersModel::orderByRaw("RAND()")->first();
            for($k=0; $k <5; $k++){
                $transfer = new TransferedModel;
                $res = 'http://';
                foreach(array_rand($this->alphabet, 3) as $key){
                    $res .= $this->alphabet[$key];
                }
                $transfer->resource = $res;
                $transfer->date = date('Y-m-d');
                $transfer->transfered = random_int(1024, 524288);
                $user->transfered()->save($transfer);
            }
            $i+=5;
        }
        return array(
            'success' => true,
            'msg' => 'Transfered created successfully'
        );
    }
}
