<?php
class UserServices extends BaseSQLMapperService
{
    private $f3;
    public $db;

    function __construct($db)
	{
		$this->f3 = Base::instance();
        $this->db = $db;
		parent::__construct($db,"users");
	}

    function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $name                       = $this->f3->get('POST.name');
            $email                      = $this->f3->get('POST.email');
            $password                   = $this->f3->get('POST.password');
            $confirm_password           = $this->f3->get('POST.confirm_password');            
            $role                       = $this->f3->get('POST.role');

            if ($password == $confirm_password)
            {
                // $site_domain = $this->f3->get('SITE_DOMAIN');
			    // $path = 'uploads/users/';
                // $custom = new CustomFunctions();
                // $file_name = $profile_avatar_exist;
                // if($profile_avatar['error'] == 0)
                // {
                //     $uploadFile = $custom->uploadFile($path);
                //     foreach($uploadFile as $key => $value)
                //     {
                //         if($value)
                //         {
                //             $file_name = $site_domain.$key;
                //             if($custom->image_exists($profile_avatar_exist))
                //             {
                //                 $file_path = str_replace($site_domain,'',$profile_avatar_exist);
                //                 unlink(getcwd().'/'.$file_path);
                //             }
                //         }
                //     }
                // }
                // $this->profile_avatar   = '';
                $this->name             = $name;
                $this->email            = $email;
                $this->password         = PasswordHash::hashing($password);                    
                $this->role             = $role;
                $this->created_at       = date('Y-m-d H:i:s');
                $this->access           = 1;
                $this->save();
                $message = '"'.$name.'" ເພີ່ມສຳເລັດແລ້ວ';

                $data = ['success'=> true, 'message'=> $message];
            } else {
                $data = ['success'=> false, 'message'=> 'ຢືນຢັນລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ'];
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'PUT')
        {
            $data = $this->f3->get('BODY');
            parse_str($data, $post_vars);
            if($post_vars['password'] == $post_vars['confirm_password'])
            {
                $this->load(array('id = ?',$post_vars['id']));
                $this->name             = $post_vars['name'];
                $this->email            = $post_vars['email'];
                $this->password         = PasswordHash::hashing($post_vars['password']);                    
                $this->role             = $post_vars['role'];
                $this->update();
                $message = '"'.$post_vars['name'].'" ແກ້ໄຂສຳເລັດແລ້ວ';
                $data = ['success'=> true, 'message'=> $message];
            } else {
                $data = ['success'=> false, 'message'=> 'ຢືນຢັນລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ'];
            }
        }
        API::success($data);
    }

    function profile(){
        if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
            $data = $this->f3->get('BODY');
            parse_str($data, $post_vars);
            $id                         = $post_vars['id'];
            $name                       = $post_vars['name'];
            $email                      = $post_vars['email'];
            $password                   = $post_vars['password'];
            $confirm_password           = $post_vars['confirm_password'];            
            if ($password == $confirm_password){
                $this->load(array('id = ?',$id));
                $this->name             = $name;
                $this->email            = $email;
                $this->password         = PasswordHash::hashing($password);                
                $this->update();
                $message = 'ໂປຣໄຟແກ້ໄຂສຳເລັດແລ້ວ';

                $data = ['success'=> true, 'message'=> $message];
            } else {
                $data = ['success'=> false, 'message'=> 'ຢືນຢັນລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ'];
            }
            API::success($data);
        }
    }

    function getEmail($email)
    {
        return $this->load(array('email = ? AND access = ?', $email,1));
    }

    function getUser($user)
    {
        return $this->load(array('email = ? AND access = ?', $user,1));
    }

    function getUserID($id)
    {
        return $this->load(array(' id = ? AND access = ?', $id,1));
    }

    function LoginDateTime($id)
    {
        $this->load(array('id = ?', $id));
        $this->login_at = time();
        $this->update();
    }
}