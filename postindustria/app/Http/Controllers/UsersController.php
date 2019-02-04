<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsersModel;
use App\CompaniesModel;

class UsersController extends Controller
{
    public function add(Request $request){
        $user = new UsersModel;
        $user->name = $request->name;
        $user->email = $request->email;
        $company = CompaniesModel::where('name', '=', $request->company)->first();
        try{
            $company->user()->save($user);
            return response()->json(array(
                'msg'=>'User added successfully'
            ));
        }catch(\Exception $e){
            return response()->json(array(
                'success' => false,
                'msg' => 'Error adding user to database'
            ));
        }
    }
    public function del(Request $request){
        $user = UsersModel::where('id', '=', (int)$request->user)->first();
        if($user):
            if($user->transfered()->delete() || !$user->transfered()->delete()):
                $user->delete();
                return response()->json(array(
                    'success'=>true,
                    'msg'=>'User delete successfully'
                ));
            else:
                return response()->json(array(
                    'sucess' => false,
                    'msg' => 'Error with del user'
                ));
            endif;
        else:
            return response()->json(array(
               'success' => false,
                'msg' => 'User doent exist'
            ));
        endif;
    }
    public function edit(Request $request, $id=null){
        if($id):
            return response()->json(array(
                'success' => true,
                'msg' => self::returnForm('edit', 'user', UsersModel::where('id', '=', $id)->first())
            ));
        else:
            if($request->has('old') && $request->has('name') && $request->has('email')):
                $user = UsersModel::where('email', '=', $request->old)->first();
                $user->name = $request->name;
                $user->email = $request->email;
                $company = CompaniesModel::where('name', '=', $request->company)->first();
                try{
                    $company->user()->save($user);
                    return response()->json(array(
                        'success' => true,
                        'msg' => 'User changes save'
                    ));
                }catch(\PDOException $e){
                    return response()->json(array(
                        'success' => false,
                        'msg' => $e
                    ));
                }
            endif;
        endif;
    }
}
