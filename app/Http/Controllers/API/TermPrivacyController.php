<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Privacy;
use App\Models\Term;
use Illuminate\Http\Request;

class TermPrivacyController extends Controller
{
    public function term(){
        $term = Term::all();
        return response()->json(['status'=>200,'data'=>$term],200);
    }
    public function privacy(){
        $privacy = Privacy::all();
        return response()->json(['status'=>200,'data'=>$privacy],200);
    }
}
