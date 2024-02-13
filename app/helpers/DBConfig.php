<?php
class DBConfig
{
    public static function config()
    {
        $f3=Base::instance();
        $db=new DB\SQL(
            $f3->get('DB_DNS') . $f3->get('DB_NAME'),
            $f3->get('DB_USER'),
            $f3->get('DB_PASS')
        );
       return $db;
    }
}