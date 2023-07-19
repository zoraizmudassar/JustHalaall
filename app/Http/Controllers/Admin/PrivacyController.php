<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Privacy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $privacy = Privacy::all();
        return view('admin/privacy.index', compact('privacy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/privacy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $privacy = new Privacy;
        $privacy->heading = $request->heading;
        $privacy->description = $request->description;
        $privacy->save();
        return response()->json(['status' => 1, 'url' => route('admin.privacy.index'), 'message' => 'Privacy Added Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\privacy  $privacy
     * @return \Illuminate\Http\Response
     */
    public function show(Privacy $privacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\privacy  $privacy
     * @return \Illuminate\Http\Response
     */
    public function edit(Privacy $privacy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\privacy  $privacy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Privacy $privacy)
    {
        $privacy = new Privacy;
        $privacy->heading = $request->heading;
        $privacy->description = $request->description;
        $privacy->update();
        return response()->json(['status' => 1, 'url' => route('admin.privacy.index'), 'message' => 'Privacy update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\privacy  $privacy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $privacy = Privacy::find($request->data_id);
        $privacy->delete();
        return response()->json(['status' => 1, 'message' => ' Privacy Delete Successfully']);
    }
}
