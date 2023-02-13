<?php
namespace App\Utils;

class View {
    public static function getContentView($view){
        $file = __DIR__ . '/../../resources/view/pages/'. $view .'.html';
        return file_exists($file) ? file_get_contents($file) : 'erro';
    }

    public static function renderView($view, $vars = []){
        $contenView = self::getContentView($view);

        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{'.$item.'}}';
        }, $keys);
       

        return str_replace($keys, array_values($vars), $contenView);
    }
}


