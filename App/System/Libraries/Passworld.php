<?php
namespace System\Libraries;

use System\FastApp;

class Passworld {

    protected static $cost = 10;

    public static function checkCost(){
        $Hash = FastApp::getInstance()->getConfig("encrypt_key");
        $timeTarget = 0.05;
        $cost = 8;
        do {
            $cost++;
            $start = microtime(true);
            password_hash("teste", PASSWORD_BCRYPT, ["salt" => $Hash,"cost" => $cost]);
            $end = microtime(true);
        } while (($end - $start) < $timeTarget);
        echo "Appropriate Cost Found: " . $cost;
    }

    public static function getPassworld($passworld){
        return password_hash($passworld, PASSWORD_BCRYPT, [
            "salt" => FastApp::getInstance()->getConfig("encrypt_key"),
            "cost" => self::$cost
        ]);
    }

    public static function verifyPassworld($passworld, $hash){
        return password_verify($passworld, $hash);
    }

    public static function generateUuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0C2f ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
        );
    }
}