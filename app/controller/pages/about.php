<?php
namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;
class About extends Page{
    public static function getAbout(){
        $obOganization = new Organization();
        //view da home
        $content = View::renderView('about', [
            'nome' => $obOganization->name,
            'site' => $obOganization->site,
            'description' => $obOganization->description
        ]);

        //view da page
        return parent::getPage('Sobre fazendo meu frimework', $content);
    }
}

