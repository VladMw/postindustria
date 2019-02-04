<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompaniesModel;
use App\UsersModel;

class CompaniesController extends Controller
{
    public function add(Request $request){
        if($request->ajax() && $request->isMethod('post')){
            $company = new CompaniesModel;
            $company->name = $request->name;
            $company->quota =  (int)$request->quota;
            try{
                $company->save();
                return response()->json(array(
                    'seccess' => true,
                    'msg'=>'Company added successfully'
                ));
            }catch(\PDOException $e){
                return response()->json(array(
                    'success' => false,
                    'msg' => 'Error adding company to database'
                ));
            }
        }
    }
    public function del(Request $request){
        $company = CompaniesModel::where('name', '=', $request->company)->first();
        if($company){
            $usersOfCompany = $company->user()->get();
            foreach ($usersOfCompany as $user):
                $user->transfered()->delete();
                $user->delete();
            endforeach;
            CompaniesModel::where('name', '=', $request->company)->delete();
            return response()->json(array(
                'success' => true,
                'msg' => 'Company deleted'
            ));
        }else{
            return response()->json(array(
                'success' => false,
                'msg' => 'Company doesnt exist'
            ));
        }
    }
    public function edit(Request $request, $name=null){
        if($name){
            return response()->json(array(
                'success' => true,
                'msg' => self::returnForm('edit', 'company', CompaniesModel::where('name', '=', $name)->first())
            ));
        }else{
            if($request->has('old') && $request->has('name') && $request->has('quota')){
                $company = CompaniesModel::where('name', '=', $request->old)->first();
                $company->name = $request->name;
                $company->quota = $request->quota;
                try{
                    $company->save();
                    return response()->json(array(
                        'success' => true,
                        'msg' => 'Company changes save'
                    ));
                }catch(\PDOException $e){
                    return response()->json(array(
                        'success' => false,
                        'msg' => 'Companies changes not save'
                    ));
                }
            }
        }
    }
    public function abusers(Request $request){
        $company = CompaniesModel::where('name', '=', $request->company)->first();
        $users = $company->user()->get();
        $abusers = [];
        foreach($users as $user){
            array_push($abusers, [
                'name' => $user->name,
                'email' => $user->email,
                'used' => $user->transfered()->sum('transfered')
            ]);
        }
        return response()->json(array(
            'success' => true,
            'msg' => view('/forms/list/abusers', [
                'data' => $abusers,
            ])->render()
        ));
    }
}
