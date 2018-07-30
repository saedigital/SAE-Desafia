<?php
namespace Libraries;

use Models\Model_Users;
use System\Libraries\Session;

class ProfileUser {

    public static function hasLoggon(){
        if (!Session::getInstance()->get("userLogged")){
            return false;
        }

        $DataUser = Model_Users::init_instance()->getUser(Session::getInstance()->get("userId"), false);
        if (!$DataUser)
            return false;

        return $DataUser;
    }

    public static function setLoggon($userId){
        Session::getInstance()->set("userLogged", true);
        Session::getInstance()->set("userId", $userId);
    }
}