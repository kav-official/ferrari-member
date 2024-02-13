<?php
class AccessServices extends BaseSQLMapperService{
	function __construct($db){
		parent::__construct($db,"accesslog");
	}

	function add($id, $role, $success){
		$this->user_id = $id;
		$this->role = $role;
		$this->ip_address = CustomFunctions::get_real_ip();
		$this->login_success = $success;
		$this->created_at = time();
		return $this->save();
	}
}