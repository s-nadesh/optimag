<?php

namespace App\Http\Controllers\Admin;

use App\Edition;
use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Validator;
use DB;

class EditionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $editions = Edition::all();
        return view('admin.edition.index', compact('editions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */  
    public function create() {
        return view('admin.edition.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, Edition::rules());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        
        if(isset($data['is_current_edition']))
        $affected = DB::table('editions')->update(array('is_current_edition' => 0));        
        
        Edition::create($data);
        Session::flash('flash_message', 'Edition created successfully!');
        return redirect('/admin/editions');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $edition = Edition::find($id);
        return view('admin.edition.edit', compact('edition'));
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
        $validator = Validator::make($data, Edition::rules($id));
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        
        if(isset($data['is_current_edition']))
        $affected = DB::table('editions')->update(array('is_current_edition' => 0));
        
        $edition = Edition::find($id);     
        $edition->update($data);
        
        Session::flash('flash_message', 'Edition updated successfully!');
        return redirect('/admin/editions');
        
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        
        $check_current_edition = Edition::where(['edition_id' => $id])->pluck('is_current_edition');
        if($check_current_edition==1)
        {
            Session::flash('flash_message', 'Sorry you can\'t delete the current edition!!!'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect('/admin/editions');
        } 
         
        // Check the article exist for this edition    
        $edition_exist = Article::where(['edition_id' => $id])->get()->count(); 
    
        if($edition_exist>0)
        {
            Session::flash('flash_message', 'Sorry this edition have article(s). So please remove articles and do this action!!!'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect('/admin/editions');
        }    
        
        // Delete edition
        $edition = Edition::find($id);
        $edition->delete();
        Session::flash('flash_message', 'Edition deleted successfully!');        
        return redirect('/admin/editions');
    }

}
