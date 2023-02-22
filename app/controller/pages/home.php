<?php
namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;
class Home extends Page{
    public static function getHome(){
        $obOganization = new Organization();
        //view da home
        $content = View::renderView('home', [
            'name' => $obOganization->name
        ]);

        //view da page
        return parent::getPage('Home => fazendo meu frimework', $content);
    }
}

