<?php
namespace App\Http\Controllers;
// use Symfony\Component\HttpFoundation\Response as Response2;

use App\Article;
use App\Http\Controllers\Controller;
use App\Edition;
use App\AdsSetting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SebastianBergmann\RecursionContext\Exception;
use Illuminate\Routing\ResponseFactory;
use App\Helpers\MyFuncs;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($lang)
    {
        DB::enableQueryLog();  
       
        $cmonth = date("M");
        $get_edition_id = Edition::where('edition_slug_en', 'like', "%$cmonth%")->pluck('edition_id');
       // dd(DB::getQueryLog());   
        
        $lang       = ($lang!="")?$lang:"en";    
        $edition_id = $get_edition_id;
        $year       = date("Y");
       
        try{
            $statusCode = 200;
            $response = [
              'articles'  => [],
              'sections'  => [],
              'banner_results' => []  
            ];            
            
            $articles = Article::whereRaw("status=1 and edition_id='$edition_id' AND year = '$year' AND language='$lang'")->groupBy('section_id')->orderBy('article_id', 'DESC')->get();
        
            foreach($articles as $article){
                
                $artimage  = "no-image.png";
                $art_imges = $article->articleImages()->take(1)->lists('image','article_image_id');
                foreach($art_imges as $aimg)
                {
                   $artimage = $aimg; 
                }    
                
                $section_column = "section_name_".$lang;
                
                $response['articles'][] = [
                    'article_id'    => $article->article_id,
                    'article_title' => $article->title,
                    'article_desc'  => $article->description,  
                    'section_name'  => $article->section->$section_column,  
                   'article_image'  => $artimage,
                    'embed_video'   => $article->embed_video
                ];
                
                $response['sections'][] = [ 
                    'section_id'  => $article->section->section_id,      
                    'section_name'  => $article->section->$section_column, 
                ];
            }
            
            // Home - position 1
            $banner_results = MyFuncs::banner_display(1,$lang);
            $response['banner_results'][] = $banner_results;
         
        }catch (Exception $e){
            $statusCode = 400;
        }finally{          
            return response()->json([$response, $statusCode]);
        }
    }
    
    public function sections($lang,$sid)
    {
        $lang = ($lang!="")?$lang:"en"; 
        
        $articles = Article::whereRaw("status=1 and section_id='$sid' and language='$lang'")->orderBy('year', 'DESC')->orderBy('edition_id', 'DESC')->orderBy("article_id","desc")->take(6)->get();
        
        try{
            
            $statusCode = 200;
            $response = [
              'articles'  => [],    
              'banner_results' => []  
            ]; 
            $response1= [
               'sections_content' => [] 
            ]; 
            
            foreach($articles as $article)
            {
                $artimage  = "no-image.png";
                $art_imges = $article->articleImages()->take(1)->lists('image','article_image_id');
                foreach($art_imges as $aimg)
                {
                   $artimage = $aimg; 
                }  
              
                $edition_column = "edition_name_".$lang;

                $response['articles'][] = [
                    'article_id'    => $article->article_id,
                    'article_title' => $article->title,
                    'article_desc'  => $article->description,                     
                    'year'          => $article->year, 
                    'edition'       => $article->edition->$edition_column, 
                    'article_image' => $artimage,
                    'embed_video'   => $article->embed_video,
                    'type_val'      => 'article'    
                ];
            }
   
            $articlecounts = count($response['articles']);            
               
            // Ads positions
            //$get_sectionpositions = AdsSetting::where('s_id', '=', 1)->pluck('section_position');
           // $response['positions'][] = [ 'section_positions'    => $get_sectionpositions];
                
            // Section Ads 
            $banner_results = MyFuncs::section_banner_display(2,$lang,$articlecounts);
            $response['banner_results'] = $banner_results;
           
            $i=1;
            $bannercounts = count($response['banner_results']);            
            foreach($response['articles'] as $akey => $ainfo)
            {   
                // First banner
                if($i==1 && isset($banner_results[0]))
                 $response1['sections_content'][] = $banner_results[0];               
                
                 $response1['sections_content'][] = $ainfo;
                 
                // Mid banner 
                if($i==3 && isset($banner_results[1]))
                 $response1['sections_content'][] = $banner_results[1];
               
                // Last banner
                if($i==$articlecounts && $articlecounts>3 && isset($banner_results[2]))
                 $response1['sections_content'][] = $banner_results[2];
                elseif($i==$articlecounts && $articlecounts<3 && isset($banner_results[1]))
                 $response1['sections_content'][] = $banner_results[1];    
                
               $i++;
            } 
          
        }catch (Exception $e){
            $statusCode = 400;
        }finally{          
            return response()->json([$response1, $statusCode]);
        }    
    } 
    
    public function article($aid)
    {
       $articles = Article::whereRaw("status=1 and article_id='$aid'")->get();
        
        try{
            
            $statusCode = 200;
            $response = [
              'articles'  => [],              
            ];   
        
            foreach($articles as $article)
            {
                $art_imges = array();
                $art_imges = $article->articleImages->toArray();
                
                $lang = $article->language;
                $edition_column = "edition_name_".$lang;
                $section_column = "section_name_".$lang;
                $response['articles'][] = [
                    'article_id'    => $article->article_id,
                    'article_title' => $article->title,
                    'article_desc'  => $article->description,  
                    'writer_name'   => $article->writer_name,
                    'writer_company'=> $article->writer_company,
                    'year'          => $article->year, 
                    'edition'       => $article->edition->$edition_column, 
                    'section_name'  => $article->section->$section_column,  
                    'article_image' => $art_imges,
                    'embed_video'   => $article->embed_video
                ];
            } 
            
             // Article Ads 
            $banner_results = MyFuncs::banner_display(3,$lang);
            $response['banner_results'] = $banner_results;
          
        }catch (Exception $e){
            $statusCode = 400;
        }finally{          
            return response()->json([$response, $statusCode]);
        }   
    }
    
    public function search($keyword,$edition)
    {
        echo $keyword;
        echo $edition;
        
    }        
   
}
