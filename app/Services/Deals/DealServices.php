<?php

namespace App\Services\Deals;

use App\Models\Deal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DealServices
{
    public function approved($request)
    {
        $deals = Deal::where('status','approved')->latest()->with('restaurant')->get();
        return view('admin.deals.index',compact('deals'));
    }

    public function pending($request)
    {
        $deals = Deal::where('status','pending')->latest()->with('restaurant')->get();
        return view('admin.deals.pending',compact('deals'));
    }
    public function rejected($request)
    {
        $deals = Deal::where('status','rejected')->latest()->with('restaurant')->get();
//        dd($deals);
        return view('admin.deals.rejected',compact('deals'));
    }


    public function changeStatus($request)
    {

        $user = Deal::find($request->deal_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['status' => 200  ,'message'=>'Status Change Successfully.']);
    }

    public function destroy($request)
    {
        $deal = Deal::find($request->data_id);
        if ($deal){

            if (isset($deal->image) && (!empty($deal->image) || !is_null($deal->image))){    //  check DB record exists or not
                if(file_exists(public_path($deal->image))){    // check image exists in directory
                    $img_del = unlink(public_path($deal->image));
                    $deal->delete();
                }else{
                    $deal->delete();
                }
            }else{
                $deal->delete();
            }

            return response()->json([ 'status' => 1  , 'message' => 'Deal Deleted Successfully']);

        }

    }
}
