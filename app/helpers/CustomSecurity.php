<?php
class CustomSecurity
{
    function security($db)
    {
        $f3 = Base::instance();
        $tmp = new Template;
        $secSvr = new UserServices($db);
        if ($f3->get('COOKIE.user_id') != null && $f3->get('COOKIE.user_key') != null)
        {
            $user = $secSvr->getUserID($f3->get('COOKIE.user_id'));
            if($user)
            {
                if (md5($user->id.$f3->get('HASH_SECRET')) == $f3->get('COOKIE.user_key'))
                {
                    $f3->set('LOGON_USER_ID',$user->id);
                    $f3->set('LOGON_USER_NAME',$user->name);
                    $f3->set('LOGON_USER_EMAIL',$user->email);
                    $f3->set('LOGON_USER_ROLE', $user->role);
                } else {
                    $f3->clear('COOKIE.user_id');
                    $f3->clear('COOKIE.user_key');
                    echo($tmp->render('back-end/login.html'));
                    die();
                }
            } else {
                $f3->clear('COOKIE.user_id');
                $f3->clear('COOKIE.user_key');
                echo($tmp->render('back-end/login.html'));
                die();
            }
        } else {
            echo($tmp->render('back-end/login.html'));
            die();
        }
    }
}