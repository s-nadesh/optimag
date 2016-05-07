<?php

namespace App\Http\Controllers\Admin;

use App\ArchiveCategory;
use App\ArchiveImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Validator;
use File;
class ArchiveCategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $archivecategories = ArchiveCategory::all();
        return view('admin.archivecategory.index', compact('archivecategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        
        return view('admin.archivecategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, ArchiveCategory::rules());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
//        echo $data['category_fr'];
//        echo $data['category_en'];
//        exit;
//        ArchiveCategory::create($data);
        $archivecategory = new ArchiveCategory;
        $archivecategory->category_fr        = $data['category_fr'];
        $archivecategory->category_en      = $data['category_en'];
        $archivecategory->save();
        
        $path = public_path() .  '/uploads/ads/'. $archivecategory->id_category;
        File::makeDirectory($path);
        
        Session::flash('flash_message', 'Archive category created successfully!');
        return redirect('/admin/archivecategories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $archivecategory = ArchiveCategory::find($id);
        return view('admin.archivecategory.edit', compact('archivecategory'));
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
        $validator = Validator::make($data, ArchiveCategory::rules($id));
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $archivecategory = ArchiveCategory::find($id);
        $archivecategory->category_fr        = $data['category_fr'];
        $archivecategory->category_en      = $data['category_en'];
        $archivecategory->save();
//        $archivecategory->update($data);
        Session::flash('flash_message', 'Archive category updated successfully!');
        return redirect('/admin/archivecategories');
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
    
        $edition_exist = ArchiveImage::where(['id_category' => $id])->get()->count(); 
    
        if($edition_exist>0)
        {
            Session::flash('flash_message', 'Sorry this category have image(s). So please remove image and do this action!!!'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect('/admin/archivecategories');
        }    
        
        
        $archivecategory = ArchiveCategory::find($id);
        $archivecategory->delete();
        Session::flash('flash_message', 'Archive category deleted successfully!');
        
        return redirect('/admin/archivecategories');
    }

}
