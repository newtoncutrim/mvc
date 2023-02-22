<?php
namespace App\Controller\Pages;

use App\Utils\View;

class Page{
    
    public static function getFooter(){
        return View::renderView('footer');
    }
    public static function getHeader(){
        return View::renderView('header');
    }
    public static function getPage($title, $content){
        return View::renderView('page',[
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);

    }
}