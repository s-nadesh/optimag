<?php

namespace App\Http\Controllers\Admin;

use App\Adsense;
use App\AdsPosition;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Validator;

class AdsenseController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $adsenses = Adsense::all();
        return view('admin.adsense.index', compact('adsenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $pages = AdsPosition::getAdsPositions();
        $positions = array("Top"=>"Top","Middle"=>"Middle","Bottom"=>"Bottom");
        return view('admin.adsense.create', compact('pages','positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, Adsense::rules());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
       
        Adsense::create($data);
        Session::flash('flash_message', 'Adsense created successfully!');
        return redirect('/admin/adsenses');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $adsense = Adsense::find($id);
        $pages = AdsPosition::getAdsPositions();
        $positions = array("Top"=>"Top","Middle"=>"Middle","Bottom"=>"Bottom");
        return view('admin.adsense.edit', compact('adsense','pages','positions'));
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
        $validator = Validator::make($data, Adsense::rules($id));
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $adsense = Adsense::find($id);
        $adsense->update($data);
        Session::flash('flash_message', 'Adsense updated successfully!');
        return redirect('/admin/adsenses');
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
    
        $adsense = Adsense::find($id);
        $adsense->delete();
        Session::flash('flash_message', 'Adsense deleted successfully!');
        
        return redirect('/admin/adsenses');
    }

}
