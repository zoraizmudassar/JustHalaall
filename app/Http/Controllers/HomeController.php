<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     
    public function index1()
    {
        $foodCategory=Category::get();
        $resturant=Restaurant::where('status', 'approved')->get();
        return view('web.home', compact('foodCategory', 'resturant'));
    }
    
    public function getDashboard()
    {
        $foodCategory = Category::get();
        $resturant = Restaurant::where('status', 'approved')->get();
        return view('website.home', compact('foodCategory', 'resturant'));
    }
    public function index()
    {

        return view('web.home2');
        // $foodCategory=Category::whereIn('id', [1,5,8,9])->get();
        $foodCategory=Category::get();
        $resturant=Restaurant::where('status', 'approved')->get();
        return view('web.home', compact('foodCategory', 'resturant'));
        // return view('home');
    }
    public function search(Request $request)
    {
        // $foodCategory=Category::whereIn('id', [1,5,8,9])->get();
        $foodCategory=Category::where('name','like','%'.$request->search.'%')->get();
        $resturant=Restaurant::where('name','like','%'.$request->search.'%')->where('status', 'approved')->get();
        return view('web.home', compact('foodCategory', 'resturant'));
        // return view('home');
    }

    public function categoryProducts($categoryId) {
        $categoryProducts=Product::where(['category_id'=>$categoryId, 'status'=>'approved'])->get();
        return view('web.categoryproduct', compact('categoryProducts'));
    }
}
