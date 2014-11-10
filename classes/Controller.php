<?php

/**
 * Base controller for routing
 *
 * Root class for route controllers
 *
 * @package Routes
 * @author Gabriel Vargas <angel.wrt@gmail.com>
 */
class Controller
{
    /**
    * @var array $segments Saves the URL segments of the call
    */ 
    private $segments;
    
    /**
    * @var bool $autoLoadEntity Auto load entities on $segment[1]?
    */ 
    protected $autoLoadEntity = true;
    
    /**
    * @var ElggEntity $entity Entity of the request
    */ 
    protected $entity = null;
    
    /**
    * @var Page $page The page to be served
    */ 
    protected $page = null;

    
    /**
    * Route not found
    */
    function __call($func, $args) {
        throw new Exception('404');
        
    }
    
    /**
    * Build the controller
    * 
    * @param  array $pages Array of pages present in the URL
    */
    function __construct($pages) {
        $this->segments = $pages;
        
        if($this->autoLoadEntity && !empty($pages[1])) {
        
            if(is_numeric($pages[1])) {
                $this->entity = get_entity($pages[1]);
            }
            else {
                $this->entity = get_user_by_username($pages[1]);
            }
            
        }
    }
    
    /**
    * Get a specific URL segment
    *
    * @param  int $number Position of the segment
    */
    protected function getSegment($number) {
        return $this->segments[$number];
    }
    
    /**
    * Serve page
    */
    protected function serve() {
        
        if (empty($this->page)) {
            throw new Exception('No page');
        }
        else {
            $this->page->view();
        }
    }
    
    /**
    * Execute the function that will handle the request
    */ 
    public function run() {
        $func = $this->getSegment(0);
        
        if(empty($func)){
            $func = 'index';
        }
        
        try {
            $this->$func();
            $this->serve();
        } catch (Exception $e) {
            return false;  
        }
    }
}
