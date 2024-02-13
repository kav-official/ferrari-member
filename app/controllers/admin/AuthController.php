<?php
class AuthController
{
	private $data;
    public $db;

    function __construct()
    {
    	$this->db = DBConfig::config(); 
    }

    public function login()
    {
        $f3 = Base::instance();
        $usersSvr = new UserServices($this->db);
        $accessSvr = new AccessServices($this->db); 
        $txtUserName = $f3->get('POST.email');
        $txtPassword = $f3->get('POST.password');     
        $result = $usersSvr->getUser($txtUserName);
        if($result->id ?? 0 > 0)
        {
            if($result->password == crypt($txtPassword, $result->password))
            {
                
                $f3->set('COOKIE.user_id', $result->id);
                $f3->set('COOKIE.user_key', md5($result->id.$f3->get('HASH_SECRET')), 0, "/");
                $usersSvr->LoginDateTime($result->id);
                
                $accessSvr->add($result->id,$result->role,1);
                $this->data = ['success'=> true,'message'=> 'Login success!',];
            } else {
                $accessSvr->add($result->id,$result->role,0); 
                $this->data = ['success'=> false, 'message'=> 'Password invalid!'];
            }
        } else {
            $this->data = ['success'=> false, 'message'=> 'Email / Password invalid!'];
        }
        API::success($this->data);
    }

    public function logout()
    {
        $f3 = Base::instance();
        $f3->clear('COOKIE.user_id');
        $f3->clear('COOKIE.key');
        $f3->reroute('/?success=You are logged out!');
    }
}