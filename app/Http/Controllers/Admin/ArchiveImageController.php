<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ArchiveCategory;
use App\ArchiveImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Input;
use Validator;

class ArchiveImageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id) {
//        $archiveimages = ArchiveImage::orderBy('id_image', 'DESC')->get();
//        return view('admin.archiveimage.index', compact('archiveimages'));
        $archiveimages = ArchiveImage::where('id_category', '=', $id)->get();
        return view('admin.archiveimage.index', compact('archiveimages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $archivecategory = ArchiveCategory::getArchiveCategory();
        return view('admin.archiveimage.create', compact('archivecategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {

        $data = $request->all();
        
        $this->validate($request, [
            'title_image_fr' => 'required|min:3',  
            'title_image_en' => 'required|min:3',
            'id_category' => 'required',
            'image' => 'required|Mimes:jpeg,png,gif',
    ]);
       
//        $validator = Validator::make($data, ArchiveImage::rules());
//        if ($validator->fails()) {
//            return redirect()->back()->withInput()->withErrors($validator->errors());
//        }
            
       
        if (Input::file()) 
        {            
            $image_obj = Input::file('image');
            $destinationPath = public_path() . '/uploads/ads/'.$data['id_category'].'/'; // upload path
            $extension = $image_obj->getClientOriginalExtension(); // getting image extension
            $fileName  = rand(11111, 99999) . time() . '.' . $extension; // renameing image
            $image_obj->move($destinationPath, $fileName); // uploading file to given path
            
        }    
       
        $archiveimagemodel = new ArchiveImage;
        $archiveimagemodel->id_category    = $data['id_category'];
        $archiveimagemodel->title_image_fr     = $data['title_image_fr'];
        $archiveimagemodel->title_image_en     = $data['title_image_en'];
        $archiveimagemodel->image     = $fileName;
        $archiveimagemodel->extension = $extension;
//        $archiveimagemodel->status      = $data['status'];
        $archiveimagemodel->save(); 
        
        Session::flash('flash_message', 'Archive image created successfully!');
        return redirect('/admin/archiveimages/index/'.$data['id_category']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $archiveimage = ArchiveImage::find($id);
        $archivecategory = ArchiveCategory::getArchiveCategory();
        $image_file = $archiveimage->image;
        $extension = $archiveimage->extension;
        $id_image = $archiveimage->id_image;
        
        
        return view('admin.archiveimage.edit', compact('archiveimage','archivecategory','image_file','extension','id_image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request) {
        
        $data = $request->all();
        $id = $data['id_image'];
        
        if(Input::file()){
            $this->validate($request, [
                'title_image_fr' => 'required|min:3',  
                'title_image_en' => 'required|min:3',
                'id_category' => 'required',
                'image' => 'required|Mimes:jpeg,png,gif',
            ]);
        }else{
            $this->validate($request, [
                'title_image_fr' => 'required|min:3',  
                'title_image_en' => 'required|min:3',
                'id_category' => 'required',
            ]);
        }
        
//        $validator = Validator::make($data, ArchiveImage::rules($id));
//        if ($validator->fails()) {
//            return redirect()->back()->withInput()->withErrors($validator->errors());
//        }
      
        $archiveimagemodel = ArchiveImage::find($id);
        
        
        
        if (Input::file()) 
        {  
            $image_obj = Input::file('image');
            $destinationPath = public_path() . '/uploads/ads/'.$data['id_category'].'/'; // upload path
            $extension = $image_obj->getClientOriginalExtension(); // getting image extension
            $fileName  = rand(11111, 99999) . time() . '.' . $extension; // renameing image
            $image_obj->move($destinationPath, $fileName); // uploading file to given path
            $archiveimagemodel->image     = $fileName;
            $archiveimagemodel->extension = $extension;
        }else{
            $archiveimagemodel->image     = $data['image'];
            $archiveimagemodel->extension = $data['extension'];
        } 
        
        $archiveimagemodel->id_category    = $data['id_category'];
        $archiveimagemodel->title_image_fr     = $data['title_image_fr'];
        $archiveimagemodel->title_image_en     = $data['title_image_en'];
        
//        $archiveimagemodel->status      = $data['status'];
        $archiveimagemodel->save();
        
        Session::flash('flash_message', 'Archive image updated successfully!');
        return redirect('/admin/archiveimages/index/'.$data['id_category']);
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
        $archiveimages = ArchiveImage::find($id);
        $category = $archiveimages->id_category;
        $archiveimages->delete();
        Session::flash('flash_message', 'Archive image deleted successfully!');
        
        return redirect('/admin/archiveimages/index/'.$category);
    }

}
