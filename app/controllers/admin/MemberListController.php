<?php
class MemberListController extends BaseController{
    public $db;
    private $sec;
    function __construct(){
        $f3 = Base::instance();
        $this->db = DBConfig::config();
        $this->sec = new CustomSecurity();
        $this->sec->security($this->db);
        $help = new HelpFunctions();

        $f3->set('help',$help);
        $custom = new CustomFunctions();
        $f3->set('arrType',$custom->getIncomeType());
        $f3->set('custom',$custom);
	    parent::__construct('MemberServices','back-end/member-list.html', 'member', 'member-list', 'ສະມາຊິກ','', '', $f3->get('ITEM_PER_PAGE'));
    }
}