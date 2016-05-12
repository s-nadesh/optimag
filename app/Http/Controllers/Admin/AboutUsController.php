<?php

namespace App\Http\Controllers\Admin;

use App\AboutUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Validator;

class AboutUsController extends Controller {

    
    public function edit() {
        
        $aboutus_date = AboutUs::find(1);
        
        return view('admin.aboutus.edit', compact('aboutus_date'));
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
       
        $validator = Validator::make($data, AboutUs::rules(1));
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $aboutus = AboutUs::find(1);
         $aboutus->content_fr    = $data['content_fr'];
        $aboutus->content_en     = $data['content_en'];        
        $aboutus->save();
                
        Session::flash('flash_message', 'About us updated successfully!');
        return redirect('/admin/aboutus/edit');
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

}
