<?php
class UserListController extends BaseController
{
    private $f3;
    private $sec;
    public $db;
    function __construct()
    {
        $this->f3 = Base::instance();
        $this->db = DBConfig::config();
        $this->sec = new CustomSecurity();
        $this->sec->security($this->db);
	    parent::__construct('UserServices','back-end/user-list.html', 'user', 'user-list', 'ຜູ້ໃຊ້', '', '', $this->f3->get('ITEM_PER_PAGE'));
    }
}