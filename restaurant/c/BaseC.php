<?php

abstract class BaseC extends Controller
{
    protected $title; 
    protected $content; 
    
    public function __construct(){}
    
    public function before()
    {
        $this -> title = 'Ресторан';
        $this -> content = '';
    }
    
    public function render()
    {
        $get_user = new UserM();
        
        if (isset($_SESSION['user_id'])) {
            $user_info = $get_user -> getUser($_SESSION['user_id']);
        } else {
            $user_info['name'] = false;
        }
        
        $loader = new Twig_Loader_Filesystem('v'); 
        $twig = new Twig_Environment($loader); 
        $template = $twig -> loadTemplate('empty.twig');
        $vars = array(
            'title' => $this->title,
            'content' => $this->content, 
            'user' => $user_info['name']
        );
        echo $template -> render($vars);
        //echo $template -> renderBlock('header',$vars);
    }

    public function userTest()
    {
        $get_user = new UserM();

        if (isset($_SESSION['user_id'])) {
            $user_info = $get_user -> getUser($_SESSION['user_id']);
        } else {
            $user_info['name'] = false;
        }
        return $user_info['name'];
    }

}
