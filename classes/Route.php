<?php

/**
 * Route facade
 *
 * Provides routing functions
 *
 * @package Routes
 * @author Gabriel Vargas <angel.wrt@gmail.com>
 */
class Route
{
    /**
    * Register a page to be handled
    * @param  string $page The name of the page to be handled
    */
    static function add($page) {
        elgg_register_page_handler($page, 'route_handler');
    }
    
    /**
    * Find the controller to handle the request
    *
    * @param  array $page Array with the URL segments
    * @param  string $handler The page requested
    */
    static function find($page, $handler) {
        
        $controller = ucfirst($handler)."Controller";
        $controller = new $controller($page);
        
        return $controller->run();
    }
}