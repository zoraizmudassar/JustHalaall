<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Services\API\Customer\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getDashboard(CustomerService $customerService) {
        return $customerService->getDashboard();
    }

    public function getRestaurant(CustomerService $customerService) {
        return $customerService->getRestaurant();
    }

    public function searchRestaurant(Request $request, CustomerService $customerService) {
        return $customerService->searchRestaurant($request);
    }

    public function restaurantDetail(Request $request, CustomerService $customerService) {
        return $customerService->restaurantDetail($request);
    }

    public function restaurantProducts(Request $request, CustomerService $customerService) {
        return $customerService->restaurantProducts($request);
    }

    public function restaurantFeaturedProducts(Request $request, CustomerService $customerService) {
        return $customerService->restaurantFeaturedProducts($request);
    }

    public function restaurantDeals(Request $request, CustomerService $customerService) {
        return $customerService->restaurantDeals($request);
    }

    public function searchFood(Request $request, CustomerService $customerService) {
        return $customerService->searchFood($request);
    }

    public function restaurantProductDetail(Request $request, CustomerService $customerService) {
        return $customerService->restaurantProductDetail($request);
    }

    public function restaurantDealDetail(Request $request, CustomerService $customerService) {
        return $customerService->restaurantDealDetail($request);
    }

    public function categoryList(Request $request, CustomerService $customerService) {
        return $customerService->categoryList($request);
    }

    public function getProfile(Request $request, CustomerService $customerService) {
        return $customerService->getProfile($request);
    }

    public function updateProfile(Request $request, CustomerService $customerService) {
        return $customerService->updateProfile($request);
    }

    public function categoryProducts(Request $request, CustomerService $customerService) {
        return $customerService->categoryProducts($request);
    }
}
