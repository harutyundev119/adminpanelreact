<?php

// url controller
namespace App\Http\Controllers;
use App\Currency;
use Illuminate\Support\Facades\Request;
use App\Language;

class UrlController extends Controller
{
    public static function geturl()
    {
        $uri = Request::path();
        $segmentsURI = explode('/',$uri); 
        if(strlen($segmentsURI[0]) == 2){
            return $segmentsURI[0];
        }else{
            return false;
        }
    }

    public static function languages(){
        $languages = Language::all();
        return $languages;
    }

    public static function get_page(){
        $uri = Request::path();
        $segmentsURI = explode('/',$uri); 
        if(strlen($segmentsURI[0]) == 2){
            if(count($segmentsURI) == 1){
                $uri = 'home';
            }elseif(count($segmentsURI) == 2){
                $uri = $segmentsURI[1];
            }elseif(count($segmentsURI) == 3){
                $uri = $segmentsURI[2];
            }
        }else{
            if(count($segmentsURI) == 1){
                $uri = $segmentsURI[0];
            }elseif(count($segmentsURI) == 2){
                $uri = $segmentsURI[1];
            }
        }
        if($segmentsURI[0] == ''){
            $uri = 'home';
        }
        return $uri;
    }
    public static function admin_page(){
        $uri = Request::path(); 
        $segmentsURI = explode('/',$uri); 
        return $segmentsURI[2];
    }
    public static function get_language(){
        $uri = Request::path(); 
        $segmentsURI = explode('/',$uri); 
        if(strlen($segmentsURI[0]) == 2){
            $language = $segmentsURI[0];
        }else{
            $language = 'en' ;
        }
        return $language;
    }
    public static function set_language(){
        $uri = Request::path(); 
        $segmentsURI = explode('/',$uri);
        if($segmentsURI[0] == ""){
            $href = '/';
        }else if(strlen($segmentsURI[0]) == 2){
            array_shift($segmentsURI);
            if(!empty($segmentsURI)){
               $href = implode('/', $segmentsURI);
            }else{
                $href = '/';
            }
        }else{
            $href =  $uri;
        }
        return $href;
    }
}
