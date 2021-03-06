<?php
/**
 * Routing package
 *
 * @package Routes
 */

elgg_register_event_handler('init', 'system', 'routes_init', 100);

/**
 * Init function
 */
function routes_init() {
    
    //Example
    Route::add('test');
}

/**
 * Global page handler
 */
function route_handler($page, $handler) {
    
    return Route::find($page, $handler);
}