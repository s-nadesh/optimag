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

class ArticleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $articles = Article::all();
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
        $years = MyFuncs::getYears();
        return view('admin.article.create', compact('editions', 'sections', 'years'));
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
        $languages = $data_article['lang'];

        $article_key = MyFuncs::getArticleUniqueKey();
        foreach ($languages as $lang => $value) {
            $article = new Article;

            $article->edition_id = $data_article['edition_id'];
            $article->section_id = $data_article['section_id'];
            $article->year = $data_article['year'];

            $article->article_key = $article_key;
            $article->language = $lang;
            $article->title = $value['title'];
            $article->description = $value['description'];
            $article->embed_video = $value['embed_video'];
            $article->writer_name = $value['writer_name'];
            $article->writer_company = $value['writer_company'];

            $article->save();

            //Images
            if (isset($value['article_image'])) {
                $images = $value['article_image'];
                foreach ($images as $image) {
                    if (!empty($image['image'])) {
                        $image_obj = $image['image'];

                        $destinationPath = public_path() . '/uploads/'; // upload path
                        $extension = $image_obj->getClientOriginalExtension(); // getting image extension
                        $fileName = rand(11111, 99999) . time() . '.' . $extension; // renameing image
                        $image_obj->move($destinationPath, $fileName); // uploading file to given path

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
        Session::flash('flash_message', 'Article created successfully!');
        return redirect('/admin/article/index');
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
    public function edit($key) {
        $editions = Edition::getEditions();
        $sections = Section::getSections();
        $years = MyFuncs::getYears();

        $en_articles_obj = Article::where(['article_key' => $key, 'language' => 'en'])->first();
        $en_articles = $en_articles_obj->toArray();
        $en_articles_image = $en_articles_obj->articleImages->toArray();

        $fr_articles_obj = Article::where(['article_key' => $key, 'language' => 'fr'])->first();
        $fr_articles = $fr_articles_obj->toArray();
        $fr_articles_image = $fr_articles_obj->articleImages->toArray();

        $data = array();

        $data['article'] = array(
            'edition_id' => $en_articles['edition_id'],
            'section_id' => $en_articles['section_id'],
            'year' => $en_articles['year'],
        );

        $data['article']['lang']['en'] = array(
            'article_id' => $en_articles['article_id'],
            'article_key' => $en_articles['article_key'],
            'title' => $en_articles['title'],
            'description' => $en_articles['description'],
            'embed_video' => $en_articles['embed_video'],
            'writer_name' => $en_articles['writer_name'],
            'writer_company' => $en_articles['writer_company'],
        );

        $data['article']['lang']['fr'] = array(
            'article_id' => $fr_articles['article_id'],
            'article_key' => $fr_articles['article_key'],
            'title' => $fr_articles['title'],
            'description' => $fr_articles['description'],
            'embed_video' => $fr_articles['embed_video'],
            'writer_name' => $fr_articles['writer_name'],
            'writer_company' => $fr_articles['writer_company'],
        );

        $data['article']['lang']['en']['article_image'] = $en_articles_image;
        $data['article']['lang']['fr']['article_image'] = $fr_articles_image;

        return view('admin.article.edit', compact('editions', 'sections', 'years', 'data'));
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
        $languages = $data_article['lang'];

        foreach ($languages as $lang => $value) {
            $article = Article::find($value['article_id']);

            $article->edition_id = $data_article['edition_id'];
            $article->section_id = $data_article['section_id'];
            $article->year = $data_article['year'];

            $article->title = $value['title'];
            $article->description = $value['description'];
            $article->embed_video = $value['embed_video'];
            $article->writer_name = $value['writer_name'];
            $article->writer_company = $value['writer_company'];

            $article->save();

            //Images
            $item_ids = [];
            if (isset($value['article_image'])) {
                $images = $value['article_image'];
                foreach ($images as $image) {

                    $article_image = new ArticleImage;
                    if (isset($image['article_image_id']) && $image['article_image_id'] != '') {
                        $article_image = ArticleImage::find($image['article_image_id']);
                    }

                    if (!empty($image['image'])) {
                        $image_obj = $image['image'];
                        $destinationPath = public_path() . '/uploads/'; // upload path
                        $extension = $image_obj->getClientOriginalExtension(); // getting image extension
                        $fileName = rand(11111, 99999) . time() . '.' . $extension; // renameing image
                        $image_obj->move($destinationPath, $fileName); // uploading file to given path
                        $article_image->image = $fileName;
                    }

                    $article_image->article_id = $article->article_id;
                    $article_image->text = $image['text'];
                    $article_image->link = $image['link'];
                    $article_image->description = $image['description'];
                    $article_image->save();
                    $item_ids[$article_image->article_image_id] = $article_image->article_image_id;
                }
            }

            //Remove deleted images in database
            $old_images = $article->articleImages->lists('article_image_id')->toArray();
            $delete_ids = array_diff($old_images, $item_ids);
            if (!empty($delete_ids)) {
                foreach ($delete_ids as $delete_id) {
                    ArticleImage::destroy($delete_id);
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
    }

}
