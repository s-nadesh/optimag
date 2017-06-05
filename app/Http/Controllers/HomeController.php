<?php
namespace App\Http\Controllers;
// use Symfony\Component\HttpFoundation\Response as Response2;

use App\User;
use App\Http\Controllers\Controller;
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
        
    public function login($user,$pwd)
    {
        
        $articles = User::whereRaw("status=1 and section_id='$sid' and language='$lang'")->orderBy('year', 'DESC')->orderBy('edition_id', 'DESC')->orderBy("article_id","desc")->take(6)->get();
        
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
            $match = array();
            $url = '';
            foreach($articles as $article)
            {
                $art_imges = array();
                $art_imges = $article->articleImages->toArray();
                
                $lang = $article->language;
                $edition_column = "edition_name_".$lang;
                $section_column = "section_name_".$lang;
                
                if($article->embed_video != ''){
                    preg_match('/src="([^"]+)"/', $article->embed_video, $match);
                    $url = $match[1];
                }
                
               if($url!="") 
               {    
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
                    'embed_video'   => $url
                ];
               }else{
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
                ];
               } 
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
               
       if($edition!="0"){
        $id_with_year = explode("-", $edition);
        $edition_id = $id_with_year["0"];
        $year = $id_with_year["1"];
        $search_str .= " AND edition_id=$edition_id AND year =$year ";
//       $search_str .= " AND edition_id=$edition ";
       }
       
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
           
            $check_empty= '0';
            
                    
                foreach($articles as $article)
                { 
                    $check_empty++;
                    $response['articles'][] = [
                        'article_id'    => $article->article_id,
                        'article_title' => $article->title,
                        'article_desc'  => $article->description,                    
                        'year'          => $article->year, 
                        'edition'       => $article->edition->$edition_column, 
                        'section_name'  => $article->section->$section_column, 
                    ];
                }
                if($check_empty == 0){
                    $response['articles'][] = ['no_articles'=>'No articles were found'];
                }
            
            $editions = Article::whereRaw("status=1 AND language='$lang'")->groupBy('edition_id')->orderBy('year', 'DESC')->orderBy('edition_id', 'DESC')->get();
            //$editions = Edition::orderBy('edition_id', 'DESC')->get();       
            $i=0;
            foreach($editions as $edition)
            {
                
//                $response['editions'][] = [
//                        'edition_id'    => $edition->edition_id,
//                        'edition_name'  => $edition->$edition_column
//                    ]; 
                if($i == 0){
                        $response['editions'][] = [
                        'edition_id'    => 0,
                        'edition_name'  => 'All Editions'
                    ]; $i =1;
                }
                    $edition_year_with_column = $edition->edition->$edition_column.' '.$edition->year;
                    $edition_year_with_id = $edition->edition->edition_id.'-'.$edition->year;
                    $response['editions'][] = [
                        'edition_id'    => $edition_year_with_id,
                        'edition_name'  => $edition_year_with_column
                    ];    
                
            }
            $i = 0;
            $sections = Section::orderBy('section_id', 'DESC')->get();      
            foreach($sections as $section)
            {
                if($i == 0){
                        $response['sections'][] = [
                        'section_id'    => 0,
                        'section_name'  => 'All Sections'
                    ]; $i =1;
                }
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
    
    public function archives($page="editions",$lang="en",$id=0)
    {
        try{            
            
            $statusCode = 200;
            $response = [    
              'years'  => [],
              'editions'  => [],
              'sections'  => [],
              'articles'  => []
            ];
            
            if($page=="years")
            {   
                $articles = Article::whereRaw("status=1 AND language='$lang'")->groupBy('year')->orderBy('year', 'DESC')->get();

                foreach($articles as $article){                     

                    $response['years'][] = [ 
                        'year'  => $article->year,      
                    ];
                }  
                if(empty($response['years'])){
                    $response['years'][]="No records found";
                }
            }
            
            if($page=="editions" && $id>0)
            {   
                $articles = Article::whereRaw("status=1 AND language='$lang' AND year = '$id'")->groupBy('edition_id')->orderBy('year', 'DESC')->orderBy('edition_id', 'DESC')->get();

                foreach($articles as $article){                     
                    $edition_column = "edition_name_".$lang;
                    $edition_year_with_column = $article->edition->$edition_column;
                    $edition_year_with_id = $article->edition->edition_id.'-'.$article->year;
                    $response['editions'][] = [ 
                        'edition_id'  => $edition_year_with_id,      
                        'edition_name'  => $edition_year_with_column,                        
                    ];
                }   
                if(empty($response['editions'])){
                    $response['editions'][]="No records found";
                }
            }
            
            if($page=="sections" && $id>0)
            { 
                $id_with_year = explode("-", $id);
                $edition_id = $id_with_year["0"];
                $year = $id_with_year["1"];
                $articles = Article::whereRaw("status=1 and edition_id='$edition_id' AND year='$year' AND language='$lang'")->groupBy('section_id')->orderBy('article_id', 'DESC')->get();

                foreach($articles as $article){                     

                    $section_column = "section_name_".$lang;
                    $section_year_with_id = $article->section->section_id.'-'.$edition_id.'-'.$article->year;
                    $response['sections'][] = [ 
                        'section_id'  => $section_year_with_id,      
                        'section_name'  => $article->section->$section_column, 
                    ];
                }
                if(empty($response['sections'])){
                    $response['sections'][]="No records found";
                }
            }
            
            if($page=="articles" && $id>0)
            {
                 $id_with_year = explode("-", $id);
                 
                $section_id = $id_with_year["0"];
                $edition_id = $id_with_year["1"];
                $year = $id_with_year["2"];
                $articles = Article::whereRaw("status=1 and edition_id='$edition_id' and section_id='$section_id' and year='$year' and language='$lang'")->orderBy('edition_id', 'DESC')->orderBy("article_id","DESC")->get();
                foreach($articles as $article)
                {       

                    $response['articles'][] = [
                        'article_id'    => $article->article_id,
                        'article_title' => $article->title,
                        'article_description' => $article->description,
                        'year'          => $article->year,                   
                    ];
                }
                if(empty($response['articles'])){
                    $response['articles'][]="No records found";
                }
            }
           
        }catch (Exception $e){
            $statusCode = 400;
        }finally{          
            return response()->json([$response, $statusCode]);
        }      
         
    }
    public function aboutus($lang="en")
    {
        
        $aboutus = AboutUs::find(1);
        
        try{
            
            $statusCode = 200;
            $content_column = "content_".$lang;
            if($aboutus->$content_column != ''){
                $response[$content_column] = $aboutus->$content_column;
            }else{
                $response[$content_column] = array(); 
            }
            
        }catch (Exception $e){
            $statusCode = 400;
        }finally{          
            return response()->json([$response, $statusCode]);
        }    
    }
}
