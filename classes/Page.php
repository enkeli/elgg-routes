<?php

/**
 * Page Entity
 */
class Page
{
    /**
    * @var array $vars Options for the body
    */ 
    public $vars = array();
    
    /**
    * @var string $title Title of the page
    */ 
    public $title = null;
    
    /**
    * @var string $content Content of the page
    */ 
    public $content = null;
    
    /**
    * @var string $layout Layout to use
    */ 
    public $layout = 'content';
    
    /**
    * Print the page
    */
    function view() {
        $vars = array(
                'content' => $this->content,
                'title' => $this->title,
        );
        
        $vars = array_merge($vars, $this->vars);
        
        $body = elgg_view_layout($this->layout, $vars);
        
        echo elgg_view_page($this->title, $body);
    }
}