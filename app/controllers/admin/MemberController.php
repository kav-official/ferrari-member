<?php
class MemberController extends ActionController{
    private $sec;
    public $db;
    function __construct(){
        $f3 = Base::instance();
        $this->db = DBConfig::config();
        $this->sec = new CustomSecurity();
        $this->sec->security($this->db);
        $custom = new CustomFunctions();
        $help = new HelpFunctions();
        $f3->set('custom',$custom);
        $f3->set('arrIncomeType',$custom->getIncomeType());
        $f3->set('help',$help);
        parent::__construct('MemberServices','back-end/member.html', 'member', 'member', 'ສະມາຊິກ');
    }
}