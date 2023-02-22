<?php
namespace App\Utils;

class View {
    private static array $vars = [];
    public static function init($vars = []){
        self::$vars = $vars;
    }
    public static function getContentView($view){
        $file = __DIR__ . '/../../resources/view/pages/'. $view .'.html';
        return file_exists($file) ? file_get_contents($file) : 'erro';

    }

    public static function renderView($view, $vars = []){
        $contenView = self::getContentView($view);
        
        $vars = array_merge(self::$vars, $vars);
        
        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{'.$item.'}}';
        }, $keys);
        
        return str_replace($keys, array_values($vars), $contenView);
    }
}


