<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Section;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Validator;

class SectionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $sections = Section::all();
        return view('admin.section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('admin.section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, Section::rules());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        Section::create($data);
        Session::flash('flash_message', 'Section created successfully!');
        return redirect('/admin/sections');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $section = Section::find($id);
        return view('admin.section.edit', compact('section'));
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
       
        $validator = Validator::make($data, Section::rules($id));
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        
        $section = Section::find($id);
        $section->update($data);
        Session::flash('flash_message', 'Section updated successfully!');
        return redirect('/admin/sections');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        // Check the article exist for this section    
        $section_exist = Article::where(['section_id' => $id])->get()->count(); 
    
        if($section_exist>0)
        {
            Session::flash('flash_message', 'Sorry this section have article(s). So please remove articles and do this action!!!'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect('/admin/sections');
        }    
        
        // Delete section
        $section = Section::find($id);
        $section->delete();
        Session::flash('flash_message', 'Section and that related articles deleted successfully!');
        
        return redirect('/admin/sections');
    }

}
