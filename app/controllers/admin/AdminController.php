<?php
class AdminController{
    public $db;
    function __construct(){
        $this->db = DBConfig::config();
        $sec = new CustomSecurity();
        $sec->security($this->db);
    }
    public function index(){
        $f3 = Base::instance();
        $tmp = new Template;

        $member         = $this->db->exec("SELECT * FROM tblmember ",[]);
        $total_member   = 0;

        foreach($member as $row){
            $total_member += 1;
        }

		$f3->set('total_member', $total_member);
        $f3->set('nav', 'home');
        $f3->set('subnav', 'home');
        $f3->set('strAction', 'Home');
        $f3->set('strPage', 'Home');
        echo($tmp->render('back-end/index.html'));
    }
}