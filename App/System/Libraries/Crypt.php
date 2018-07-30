<?php
namespace System\Libraries;

use System\FastApp;


class Crypt {

    /**
     * @author fonte php.net
     */
    public static function encrpyt($plaintext, $cipher = "AES-256-CBC", $options = OPENSSL_RAW_DATA){
        $key = FastApp::getInstance()->getConfig("encrypt_key");
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key,$options, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
        return $ciphertext;
    }

    /**
     * @author fonte php.net
     */
    public static function decrypt($ciphertext, $cipher = "AES-256-CBC", $options = OPENSSL_RAW_DATA){
        $key = FastApp::getInstance()->getConfig("encrypt_key");
        $c = base64_decode($ciphertext);
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        if (hash_equals($hmac, $calcmac)){
            return $original_plaintext;
        }
        return false;
    }
}