<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\ArticleImage;
use App\Edition;
use App\Helpers\MyFuncs;
use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Intervention\Image\Facades\Image; // Use this if you want facade style code
use Validator;

class ArticleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $articles = Article::orderBy('year', 'DESC')->orderBy('edition_id', 'DESC')->orderBy('article_id', 'DESC')->get();
        return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $editions = Edition::getEditions();
        $sections = Section::getSections();
        $languages = array("en"=>"EN" , "fr"=>"FR");
        $years = MyFuncs::getYears();
        return view('admin.article.create', compact('editions','languages', 'sections', 'years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $data_article = $data['article'];
       // $languages = $data_article['lang'];
        
        $messages = [
            'title.required' => 'Title is required',
            'description.required'  => 'Description is required',
        ];
           
        $validator = Validator::make($data_article, Article::rules(),$messages);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $article_key = MyFuncs::getArticleUniqueKey();
       // foreach ($languages as $lang => $value) {
            $article = new Article;

            $article->edition_id  = $data_article['edition_id'];
            $article->section_id  = $data_article['section_id'];
            $article->year        = $data_article['year'];
            $article->status      = $data_article['status'];

            $article->article_key = $article_key;
            $article->language    = $data_article['language'];
            $article->title       = $data_article['title'];
            $article->description = $data_article['description'];
            $article->embed_video = $data_article['embed_video'];
            $article->writer_name = $data_article['writer_name'];
            $article->writer_company = $data_article['writer_company'];

            $article->save();

            //Images
            if (isset($data_article['article_image'])) {
                $images = $data_article['article_image'];
                foreach ($images as $image) {
                    if (!empty($image['image'])) {
                        $image_obj = $image['image'];

                        $destinationPath = public_path() . '/uploads/'; // upload path
                        $extension = $image_obj->getClientOriginalExtension(); // getting image extension
                        $fileName = rand(11111, 99999) . time() . '.' . $extension; // renameing image
                        $image_obj->move($destinationPath, $fileName); // uploading file to given path
                        // Image resize
                        // $original_img_path = $destinationPath.$fileName;
                        // $this->resize("100","100",$original_img_path,$fileName); 
                        if($extension!="")
                        {    
                            $article_image = new ArticleImage;
                            $article_image->article_id = $article->article_id;
                            $article_image->image = $fileName;
                            $article_image->text = $image['text'];
                            $article_image->link = $image['link'];
                            $article_image->description = $image['description'];
                            $article_image->save();
                        }    
                    }
                }
            }
      //  }
        Session::flash('flash_message', 'Article created successfully!');
        return redirect('/admin/article/index');
    }
    
    private function resize($wdth,$hght,$original_img_path,$fileName)
    {        
    	try 
    	{
    		//$extension    = $image->getClientOriginalExtension();
    		$imageRealPath 	= $original_img_path;	    	
	    	//$imageManager = new ImageManager(); // use this if you don't want facade style code
    		//$img = $imageManager->make($imageRealPath);	    
	    	$img = Image::make($imageRealPath); // use this if you want facade style code
//	    	$img->resize(intval($wdth), null , function($constraint) {
//	    		 $constraint->aspectRatio();
//	    	});
                $img->resize(intval($wdth),intval($hght));
	    	return $img->save(public_path('uploads/thumb'). '/'. $fileName);
    	}
    	catch(Exception $e)
    	{
    		return false;
    	}

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($key) {
        
        $data = array();
        
        $editions = Edition::getEditions();
        $sections = Section::getSections();
        $years = MyFuncs::getYears();
        $languages = array("en"=>"EN" , "fr"=>"FR");

        $articles_obj = Article::where(['article_id' => $key])->first();
        
        $articles = $articles_obj->toArray();
        
        $data['article'] = array(
            'edition_id'  => $articles['edition_id'],
            'section_id'  => $articles['section_id'],
            'year'        => $articles['year'],
            'language'    => $articles['language'],
            'article_id'  => $articles['article_id'],
            'article_key' => $articles['article_key'],
            'title'       => $articles['title'],
            'description' => $articles['description'],
            'embed_video' => $articles['embed_video'],
            'writer_name' => $articles['writer_name'],
            'writer_company' => $articles['writer_company'],
            'status'      => $articles['status'],
        );
        
        $articles_image = $articles_obj->articleImages->toArray();
        
        $data['article']['article_image'] = $articles_image;
       
        return view('admin.article.edit', compact('editions', 'sections', 'years', 'data','languages'));
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
        $data_article = $data['article'];
        
        $article = Article::find($data_article['article_id']);

        $article->edition_id = $data_article['edition_id'];
        $article->section_id = $data_article['section_id'];
        $article->year       = $data_article['year'];
        $article->language   = $data_article['language'];
        $article->status     = $data_article['status'];

        $article->title          = $data_article['title'];
        $article->description    = $data_article['description'];
        $article->embed_video    = $data_article['embed_video'];
        $article->writer_name    = $data_article['writer_name'];
        $article->writer_company = $data_article['writer_company'];

        $article->save();

        //Images
        $item_ids = [];
        if (isset($data_article['article_image'])) 
        {
            $images = $data_article['article_image'];
     
            foreach ($images as $image) {
                
                if (isset($image['article_image_id']) && $image['article_image_id'] != '') {
                    $article_image = ArticleImage::find($image['article_image_id']);
                    
                    if (!empty($image['image'])) {
                        $image_obj = $image['image'];
                        $destinationPath = public_path() . '/uploads/'; // upload path
                        $extension = $image_obj->getClientOriginalExtension(); // getting image extension
                        $fileName = rand(11111, 99999) . time() . '.' . $extension; // renameing image
                        $image_obj->move($destinationPath, $fileName); // uploading file to given path
                        // Image resize
                       // $original_img_path = $destinationPath.$fileName;
                       // $this->resize("100","100",$original_img_path,$fileName); 

                        $article_image->image = $fileName;
                    }

                    $article_image->article_id = $article->article_id;
                    $article_image->text = $image['text'];
                    $article_image->link = $image['link'];
                    $article_image->description = $image['description'];
                    $article_image->save();
                }else{
                    $article_image = new ArticleImage;
                    
                    if (!empty($image['image'])) {
                        $image_obj = $image['image'];
                        $destinationPath = public_path() . '/uploads/'; // upload path
                        $extension = $image_obj->getClientOriginalExtension(); // getting image extension
                        $fileName = rand(11111, 99999) . time() . '.' . $extension; // renameing image
                        if($extension!="")
                        { 
                            $image_obj->move($destinationPath, $fileName); // uploading file to given path
                            // Image resize
                           // $original_img_path = $destinationPath.$fileName;
                           // $this->resize("100","100",$original_img_path,$fileName); 

                            $article_image->image = $fileName;
                            $article_image->article_id = $article->article_id;
                            $article_image->text = $image['text'];
                            $article_image->link = $image['link'];
                            $article_image->description = $image['description'];
                            $article_image->save();
                        }    
                    }                   
                }

               
                $item_ids[$article_image->article_image_id] = $article_image->article_image_id;
            }

            //Remove deleted images in database
            $old_images = $article->articleImages->lists('article_image_id')->toArray();
            if(!empty($item_ids))
            {    
                $delete_ids = array_diff($old_images, $item_ids);
                if (!empty($delete_ids)) {
                    foreach ($delete_ids as $delete_id) {
                        ArticleImage::destroy($delete_id);
                    }
                }
            }    
        }

        Session::flash('flash_message', 'Article updated successfully!');
        return redirect('/admin/article/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    
        $article = Article::find($id);
        $article->delete();
        Session::flash('flash_message', 'Article deleted successfully!');
        
        return redirect('/admin/article/index');
    }

}
