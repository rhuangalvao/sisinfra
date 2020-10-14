<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 25/05/2019
 * Time: 15:21
 */

namespace App\Domain;

use phpseclib\Crypt\RSA;
use Illuminate\Support\Facades\Storage;

class Crypto
{
    public function encryptRSA($message, $pubfile=null){
        if (isnull($pubfile)){
            $pubfile='sisinfra.pub';
        }

        $key = Storage::get($pubfile);
        $rsa = new RSA();
        $rsa->loadKey($key);
        if (strlen($message)>0){
            return base64_encode($rsa->encrypt($message));
        }
        else {
            return null;
        }
    }

    public function decryptRSA($message, $keyfile=null){
        if (isnull($keyfile)){
            $keyfile='sisinfra.key';
        }

        $key = Storage::get($keyfile);
        $rsa = new RSA();
        $rsa->loadKey($key);
        if (strlen($message)>0) {
            return $rsa->decrypt(base64_decode($message));
        }
        else {
            return null;
        }
    }
}