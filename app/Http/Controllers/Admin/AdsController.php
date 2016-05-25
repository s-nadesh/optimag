<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Ads;
use App\AdsPosition;
use App\ArchiveCategory;
use App\ArchiveImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Input;
use Validator;

class AdsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $ads = Ads::orderBy('ad_id', 'DESC')->get();
        return view('admin.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $pages = AdsPosition::getAdsPositions();
        $archivecategories = ArchiveCategory::getArchiveCategory();
        $langs = array("en" => "EN", "fr" => "FR");
        $positions = array("Top" => "Top", "Middle" => "Middle", "Bottom" => "Bottom");
        return view('admin.ads.create', compact('pages', 'langs', 'positions', 'archivecategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {

        $data = $request->all();
        $id_image = '';

        $messages = [
            'required' => 'The :attribute field is required.',
            'required_if' => 'The :attribute field is required.',
            'not_in' => 'Please select :attribute field',
        ];
        $validator = Validator::make($data, Ads::rules(), $messages);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }


//        if (Input::file()) 
//        {            
//            $image_obj = Input::file('image');
//            $destinationPath = public_path() . '/uploads/ads'; // upload path
//            $extension = $image_obj->getClientOriginalExtension(); // getting image extension
//            $fileName  = rand(11111, 99999) . time() . '.' . $extension; // renameing image
//            $image_obj->move($destinationPath, $fileName); // uploading file to given path
//            $data['ad_file'] = $fileName;  
//            $data['ad_type'] = "image";
//        }
      
       if ($data['ad_type'] == 'image') {
            $data['ad_type'] = "image";
            $data['ad_file'] = '';
            $id_image = $data['image'];
        } else if ($data['ad_type'] == 'video') {
            // video embed
            $id_image = '';
            $data['ad_file'] = $data['video_embed'];
            $data['ad_type'] = "video";
        }

        $adsmodel = new Ads;
        $adsmodel->ad_title = $data['ad_title'];
        $adsmodel->ad_link = $data['ad_link'];
        $adsmodel->ad_file = $data['ad_file'];
        $adsmodel->ad_type = $data['ad_type'];
        $adsmodel->id_image = $id_image;
        $adsmodel->advertiser_url = $data['advertiser_url'];
        $adsmodel->client_name = $data['client_name'];
        $adsmodel->start_date = $data['start_date'];
        $adsmodel->end_date = $data['end_date'];
        $adsmodel->impressions = "0";
        $adsmodel->clicks = "0";
        $adsmodel->page = $data['page'];
        $adsmodel->position = $data['position'];
        $adsmodel->lang = $data['lang'];
        $adsmodel->status = $data['status'];
        $adsmodel->save();

        Session::flash('flash_message', 'Ads created successfully!');
        return redirect('/admin/ads/index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $archiveimages = array();
        $ads = Ads::find($id);
//        $pages = AdsPosition::all();
        $pages = AdsPosition::getAdsPositions();
        $archivecategories = ArchiveCategory::getArchiveCategory();
        $langs = array("en" => "EN", "fr" => "FR");
        $positions = array("Top" => "Top", "Middle" => "Middle", "Bottom" => "Bottom");

        $video_embed = null;
        $id_image = null;
        $category = null;
        $image_name = null;
        if ($ads->ad_type == "video")
            $video_embed = $ads->ad_file;
        else if ($ads->ad_type == "image")
            $id_image = $ads->id_image;

        if ($id_image != null) {
            $category = $ads->archiveimage->id_category;
            $image_name = $ads->archiveimage->image;
            $archiveimages = ArchiveImage::where('id_category', $category)->lists('title_image_en', 'id_image');
            $archiveimages->prepend('--Select Image--', '');
//            $archiveimages1 = ArchiveImage::where('id_category',$category)->get();            
        }
//        echo $id_image;
//        echo '<pre>';
//        print_r($archiveimages);
        if (empty($archiveimages)) {
            $archiveimages = ['' => '--Select Image--'];
        }
//        echo '<pre>';
//        print_r($archiveimages);
//        exit;
        $ad_id = $ads->ad_id;
        return view('admin.ads.edit', compact('ads', 'pages', 'langs', 'video_embed', 'id_image', 'positions', 'archivecategories', 'ad_id', 'category', 'archiveimages', 'image_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request) {
        $id_image = '';
        $data = $request->all();
        $id = $data['ad_id'];
        $messages = [
            'required' => 'The :attribute field is required.',
            'required_if' => 'The :attribute field is required.',
        ];
        $validator = Validator::make($data, Ads::rules($id), $messages);
//        $validator = Validator::make($data, Ads::rules($id));
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $adsmodel = Ads::find($id);

//        $image_obj = Input::file('image');
//        if (!empty($image_obj)) 
//        {  
//            $destinationPath = public_path() . '/uploads/ads'; // upload path
//            $extension = $image_obj->getClientOriginalExtension(); // getting image extension
//            $fileName  = rand(11111, 99999) . time() . '.' . $extension; // renameing image
//            $image_obj->move($destinationPath, $fileName); // uploading file to given path
//            $data['ad_file'] = $fileName;      
//            $data['ad_type'] = "image";
//            $adsmodel->ad_file = $data['ad_file'];
//        }

        if ($data['ad_type'] == 'video') {
            // video embed
            $data['ad_file'] = $data['video_embed'];
            $data['ad_type'] = "video";
            $adsmodel->ad_file = $data['ad_file'];
        } else if ($data['ad_type'] == 'image') {

            $data['ad_type'] = "image";
            $data['ad_file'] = '';
            $id_image = $data['image'];
        }

        $adsmodel->ad_title = $data['ad_title'];
        $adsmodel->ad_link = $data['ad_link'];
        $adsmodel->ad_type = $data['ad_type'];
        $adsmodel->id_image = $id_image;
        $adsmodel->advertiser_url = $data['advertiser_url'];
        $adsmodel->client_name = $data['client_name'];
        $adsmodel->start_date = $data['start_date'];
        $adsmodel->end_date = $data['end_date'];
        $adsmodel->page = $data['page'];
        $adsmodel->position = $data['position'];
        $adsmodel->lang = $data['lang'];
        $adsmodel->status = $data['status'];
        $adsmodel->save();

        Session::flash('flash_message', 'Ads updated successfully!');
        return redirect('/admin/ads/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
        $archiveimages = ArchiveImage::where('id_category', '=', $id)->get();
        $options = '';
        $options = "<option value=''>--Select Image--</option>";
        foreach ($archiveimages as $archiveimage) {
            $options .= "<option value='" . $archiveimage->id_image . "'>" . $archiveimage->title_image_en . "</option>";
        }
        echo $options;
    }

    public function previewimage($id) {
        //
        $images = ArchiveImage::find($id);
        echo url('/uploads/ads/' . $images->id_category . '/' . $images->image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        $ads = Ads::find($id);
        $ads->delete();
        Session::flash('flash_message', 'Ads deleted successfully!');

        return redirect('/admin/ads/index');
    }

}
