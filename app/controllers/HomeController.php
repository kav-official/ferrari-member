<?php
class HomeController{
    public $db;
    function __construct(){
        $this->db = DBConfig::config();
    }
    public function index(){
        $f3 = Base::instance();
        $tmp = new Template;
        $custom = new CustomFunctions();
        $f3->set('nav', 'home');
        $f3->set('subnav', 'home');
        $f3->set('strAction', 'Home');
        $f3->set('strPage', 'Home');
        echo($tmp->render('back-end/login.html'));
    }
}