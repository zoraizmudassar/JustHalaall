<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Services\Categories\CategoryServices;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function index(Request $request,CategoryServices $categoryServices)
    {
        return $categoryServices->index($request);
    }

    public function create(Request $request,CategoryServices $categoryServices)
    {
        return $categoryServices->create($request);
    }

    public function store(Request $request,CategoryServices $categoryServices)
    {
        return $categoryServices->store($request);
    }

    public function update(Request $request,CategoryServices $categoryServices)
    {
        return $categoryServices->update($request);
    }

    public function destroy(Request $request,CategoryServices $categoryServices)
    {
        return $categoryServices->destroy($request);
    }

    public function changeStatus(Request $request,CategoryServices $categoryServices)
    {
        return $categoryServices->changeStatus($request);
    }
}
