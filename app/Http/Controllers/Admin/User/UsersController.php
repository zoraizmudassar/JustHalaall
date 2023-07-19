<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserServices;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function form(UserServices $userServices)
    {
        return $userServices->form();
    }
    public function active(UserServices $userServices)
    {
        return $userServices->active();
    }
    public function inActive(UserServices $userServices)
    {
        return $userServices->inActive();
    }
    public function store(Request $request,UserServices $userServices)
    {
        return $userServices->store($request);
    }

//    public function edit(Request $request,User $id,UserServices $userServices)
//    {
//        return $userServices->edit($request,$id);
//    }
    public function update(Request $request,UserServices $userServices)
    {
        return $userServices->update($request);
    }
    public function destroy(Request $request,UserServices $userServices)
    {
    return $userServices->destroy($request);
    }

    public function changeStatus(Request $request,UserServices $userServices)
    {
        return $userServices->changeStatus($request);
    }
}
