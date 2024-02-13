<?php
class UserController extends ActionController
{
    private $sec;
    public $db;
    function __construct()
    {
        $this->db = DBConfig::config();
        $this->sec = new CustomSecurity();
        $this->sec->security($this->db);
        parent::__construct('UserServices','back-end/user.html', 'user', 'user', 'ຜູ້ໃຊ້');
    }
}