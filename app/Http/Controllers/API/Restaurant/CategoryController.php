<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Services\API\Restaurant\CategoryServices;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list(CategoryServices $categoryServices)
    {
        return $categoryServices->list();
    }
}
