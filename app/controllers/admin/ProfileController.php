<?php
class ProfileController extends ActionController
{
    public $db;
    function __construct()
    {
        $this->db = DBConfig::config();
        $sec = new CustomSecurity();
        $sec->security($this->db);
        parent::__construct('UserServices','back-end/profile.html', 'profile', 'profile', 'Profile');
    }
}