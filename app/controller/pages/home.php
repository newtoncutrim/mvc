<?php
namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;
class Home extends Page{
    public static function getHome(){
        $obOganization = new Organization();
        //view da home
        $content = View::renderView('home', [
            'id' => $obOganization->id,
            'nome' => $obOganization->name,
            'site' => $obOganization->site,
            'description' => $obOganization->description
        ]);

        //view da page
        return parent::getPage('Projeto fazendo meu frimework', $content);
    }
}

