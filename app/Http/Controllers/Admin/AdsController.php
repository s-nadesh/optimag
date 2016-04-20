<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Ads;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Validator;

class AdsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $ads = Ads::all();
        return view('admin.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('admin.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        
        $data = $request->all();
        $validator = Validator::make($data, Ads::rules());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        Section::create($data);
        Session::flash('flash_message', 'Ads created successfully!');
        return redirect('/admin/ads');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $section = Section::find($id);
        return view('admin.ads.edit', compact('ads'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        
        $data = $request->all();
        
        $validator = Validator::make($data, Ads::rules($id));
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $ads = Ads::find($id);
        $ads->update($data);
        Session::flash('flash_message', 'Ads updated successfully!');
        return redirect('/admin/ads');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
