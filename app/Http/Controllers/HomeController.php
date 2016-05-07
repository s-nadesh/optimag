<?php
namespace App\Http\Controllers;
// use Symfony\Component\HttpFoundation\Response as Response2;

use App\Article;
use App\Http\Controllers\Controller;
use App\Edition;
use App\Section;
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
    public function index($lang="en")
    {
        DB::enableQueryLog();  
       
        $get_edition_id = Edition::where('is_current_edition', '=', "1")->first()->edition_id;
       // dd(DB::getQueryLog());   
          
        $edition_id = $get_edition_id;
        $year       = date("Y");
       
        try{
            $statusCode = 200;
            $response   = [
              'articles'  => [],
              'sections'  => [],
              'banner_results' => []  
            ];            
            
            if($get_edition_id!="" || $get_edition_id>0)
            {    
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
            } 
           
        }catch (Exception $e){
            $statusCode = 400;
        }finally{          
            return response()->json([$response, $statusCode]);
        }
    }
    
    public function sections($lang="en",$sid)
    {
        
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
            $response['banner_results'][] = $banner_results;
          
        }catch (Exception $e){
            $statusCode = 400;
        }finally{          
            return response()->json([$response, $statusCode]);
        }   
    }
    
    public function search($lang="en",$keyword=NULL,$edition=0,$section=0)
    {
        
       //DB::enableQueryLog();  
       $search_str = "status=1 AND language='$lang'";  
       
       if($keyword!="NULL" )
       $search_str .= " AND (title LIKE '%$keyword%' || description LIKE '%$keyword%' || writer_name LIKE '%$keyword%' || writer_company LIKE '%$keyword%' )";  
               
       if($edition!="0")
       $search_str .= " AND edition_id=$edition ";
       
       if($section!="0")
       $search_str .= " AND section_id=$section ";
                  
       $articles = Article::whereRaw($search_str)->orderBy('year', 'DESC')->orderBy('edition_id', 'DESC')->orderBy("article_id","desc")->get();
      //dd(DB::getQueryLog());   
       try{            
            $statusCode = 200;
            $response = [
              'articles'  => [],    
              'editions'  => [],   
              'sections'  => [],    
            ];
            
            $edition_column = "edition_name_".$lang;
            $section_column = "section_name_".$lang;
           
            foreach($articles as $article)
            { 
              
                $response['articles'][] = [
                    'article_id'    => $article->article_id,
                    'article_title' => $article->title,
                    'article_desc'  => $article->description,                    
                    'year'          => $article->year, 
                    'edition'       => $article->edition->$edition_column, 
                    'section_name'  => $article->section->$section_column, 
                ];
            }
            
            $editions = Edition::orderBy('edition_id', 'DESC')->get();            
            foreach($editions as $edition)
            {
                $response['editions'][] = [
                    'edition_id'    => $edition->edition_id,
                    'edition_name'  => $edition->$edition_column
                ];        
            }
            
            $sections = Section::orderBy('section_id', 'DESC')->get();      
            foreach($sections as $section)
            {
                $response['sections'][] = [
                    'section_id'    => $section->section_id,
                    'section_name'  => $section->$section_column
                ];        
            }
                 
        }catch (Exception $e){
            $statusCode = 400;
        }finally{          
            return response()->json([$response, $statusCode]);
        }  
        
    } 
    
    public function archive_editions($lang="en")
    {
        try{            
            
            $statusCode = 200;
            $response = [    
              'editions'  => [],    
            ];
            
            $edition_column = "edition_name_".$lang;
            $editions = Edition::orderBy('edition_id', 'DESC')->get();            
            foreach($editions as $edition)
            {
                $response['editions'][] = [
                    'edition_id'    => $edition->edition_id,
                    'edition_name'  => $edition->$edition_column
                ];                
            }
            
        }catch (Exception $e){
            $statusCode = 400;
        }finally{          
            return response()->json([$response, $statusCode]);
        }  
    }        
   
    public function archive_sections($lang="en",$editionid)
    {
       
        try{
            $statusCode = 200;
            $response   = [
              'sections'  => [],
            ];            
            
            if($editionid!="" || $editionid>0)
            {    
                $articles = Article::whereRaw("status=1 and edition_id='$editionid' AND language='$lang'")->groupBy('section_id')->orderBy('article_id', 'DESC')->get();

                foreach($articles as $article){                     

                    $section_column = "section_name_".$lang;
                    
                    $response['sections'][] = [ 
                        'section_id'  => $article->section->section_id,      
                        'section_name'  => $article->section->$section_column, 
                    ];
                }
            } 
            
        }catch (Exception $e){
            $statusCode = 400;
        }finally{          
            return response()->json([$response, $statusCode]);
        }
    }
    
    public function archive_articles($lang="en",$sid)
    {
        
        $articles = Article::whereRaw("status=1 and section_id='$sid' and language='$lang'")->orderBy('year', 'DESC')->orderBy('edition_id', 'DESC')->orderBy("article_id","desc")->take(6)->get();
        
        try{
            
            $statusCode = 200;
            $response = [
              'articles'  => [],                
            ];
            
            foreach($articles as $article)
            {          

                $response['articles'][] = [
                    'article_id'    => $article->article_id,
                    'article_title' => $article->title,                    
                    'year'          => $article->year,                   
                ];
            }
          
        }catch (Exception $e){
            $statusCode = 400;
        }finally{          
            return response()->json([$response, $statusCode]);
        }    
    } 
}
