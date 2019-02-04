<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsersModel;
use App\CompaniesModel;
use App\TransferedModel;

class PaginationController extends Controller
{
    private $allowed_page = ['companies', 'users', 'abusers'];
    
    public function index(){
        return view('base/index', [
            'companies' => CompaniesModel::all(),
        ]);
    }
    public function page(Request $request){
        if($request->isMethod('post') && $request->ajax()){
            if($request->has('page') && in_array(strtolower($request->page), $this->allowed_page)){
                return response()->json(array(
                    'success' => true,
                    'msg' => $this->showPage(strtolower($request->page))
                    ));
            }else{
                return response()->json(array(
                    'success' => false,
                    'msg'=>'Error.Page not found'
                    ));
            }
        }else{
            echo $this->showPage(strtolower('abusers'));
            return response()->json(array(
                'success' => false,
                'msg'=>'Error. Bad request'
                ));
        }
    }
    
    public function showPage($page){
        switch($page):
            case 'users':
                $data = UsersModel::all();
                break;
            case 'companies':
                $data = CompaniesModel::all();
                break;
            case 'abusers':
                $data = [];
                $companies = CompaniesModel::all();
                foreach ($companies as $company){
                    $users = $company->user()->get();
                    $amount = 0;
                    foreach($users as $user){
                        $amount += $user->transfered()->sum('transfered');
                    }
                    if($amount > $company->quota){
                        array_push($data, [
                            'name' => $company->name,
                            'limit' => $company->quota,
                            'used' => $amount]);
                    }
                }
        endswitch;
        return view('pagination/'.$page, ['data'=>$data])->render();
    }
}
