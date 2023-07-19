<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Services\API\Restaurant\AccountServices;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function editAccount(Request $request,AccountServices $accountServices)
    {
        return $accountServices->editAccount($request);
    }
}
