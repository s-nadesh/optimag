<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Ads;
use App\AdsPosition;
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
        $positions = AdsPosition::getAdsPositions();
        $langs = array("en"=>"EN","fr"=>"FR");
        return view('admin.ads.create', compact('positions','langs'));
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
               
        if (Input::file()) 
        {            
            $image_obj = Input::file('image');
            $destinationPath = public_path() . '/uploads/ads'; // upload path
            $extension = $image_obj->getClientOriginalExtension(); // getting image extension
            $fileName  = rand(11111, 99999) . time() . '.' . $extension; // renameing image
            $image_obj->move($destinationPath, $fileName); // uploading file to given path
            $data['ad_file'] = $fileName;  
            $data['ad_type'] = "image";
        }else if(isset($data['video_embed'])){  
            // video embed
            $data['ad_file'] = $data['video_embed'];
            $data['ad_type'] = "video";
        }       
       
        $adsmodel = new Ads;
        $adsmodel->ad_title    = $data['ad_title'];
        $adsmodel->ad_link     = $data['ad_link'];
        $adsmodel->ad_file     = $data['ad_file'];
        $adsmodel->ad_type     = $data['ad_type'];
        $adsmodel->advertiser_url = $data['advertiser_url'];
        $adsmodel->client_name = $data['client_name'];
        $adsmodel->start_date  = $data['start_date'];
        $adsmodel->end_date    = $data['end_date'];
        $adsmodel->impressions = "0";
        $adsmodel->clicks      = "0";
        $adsmodel->position    = $data['position'];
        $adsmodel->lang        = $data['lang'];
        $adsmodel->status      = $data['status'];
        $adsmodel->save(); 
        
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
        $ads = Ads::find($id);
        $positions = AdsPosition::getAdsPositions();
        $langs = array("en"=>"EN","fr"=>"FR");
        
        $video_embed = null;
        $image_file  = null;
        
        if($ads->ad_type=="video")
        $video_embed = $ads->ad_file;        
        else if($ads->ad_type=="image")
        $image_file = $ads->ad_file;
        
        return view('admin.ads.edit', compact('ads','positions','langs','video_embed','image_file'));
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
      
        $adsmodel = Ads::find($id);
        
        $image_obj = Input::file('image');
        if (!empty($image_obj)) 
        {  
            echo "Asd"; exit;
            $destinationPath = public_path() . '/uploads/ads'; // upload path
            $extension = $image_obj->getClientOriginalExtension(); // getting image extension
            $fileName  = rand(11111, 99999) . time() . '.' . $extension; // renameing image
            $image_obj->move($destinationPath, $fileName); // uploading file to given path
            $data['ad_file'] = $fileName;      
            $data['ad_type'] = "image";
            $adsmodel->ad_file = $data['ad_file'];
        }else if(isset($data['video_embed']) && $data['video_embed']!=""){  
            // video embed
            $data['ad_file'] = $data['video_embed'];
            $data['ad_type'] = "video";
            $adsmodel->ad_file     = $data['ad_file'];
        }  
        
        $adsmodel->ad_title    = $data['ad_title'];
        $adsmodel->ad_link     = $data['ad_link'];        
        $adsmodel->ad_type     = $data['ad_type'];
        $adsmodel->advertiser_url = $data['advertiser_url'];
        $adsmodel->client_name = $data['client_name'];
        $adsmodel->start_date  = $data['start_date'];
        $adsmodel->end_date    = $data['end_date'];
        $adsmodel->position    = $data['position'];
        $adsmodel->lang        = $data['lang'];
        $adsmodel->status      = $data['status'];
        $adsmodel->save();
        
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
        $ads = Ads::find($id);
        $ads->delete();
        Session::flash('flash_message', 'Ads deleted successfully!');
        
        return redirect('/admin/ads');
    }

}
