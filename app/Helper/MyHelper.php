<?php

use App\Mail\ApprovalMail;
use Illuminate\Support\Facades\Mail;

class Myhelper
{
    public static function encrypt($data)
    {
      $hashKey = 'atp_dev';

      $METHOD = 'aes-256-cbc';
      $IV = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
      $key = substr(hash('sha256', $hashKey, true), 0, 32);
      $encrypt= base64_encode(openssl_encrypt($data,$METHOD,$key, OPENSSL_RAW_DATA, $IV));

      return $encrypt;
    }

    public static function decrypt($data)
    {
      $hashKey = 'atp_dev';

      $METHOD = 'aes-256-cbc';
      $IV = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
      $key = substr(hash('sha256', $hashKey, true), 0, 32);
      $decrypted = openssl_decrypt(base64_decode($data),$METHOD, $key, OPENSSL_RAW_DATA, $IV);

      return $decrypted;
    }

    public static function passwordEncryptNew($data)
    {
        //user encryption
        $username = $data['user'];
        $password = $data['pass'];

        $method = 'aes-256-cbc';
        // Must be exact 32 chars (256 bit)
        $hashed = substr(hash('sha256', $password, true), 0, 32);
        // IV must be exact 16 chars (128 bit)
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
    	    chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
    		chr(0x0) .chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
    		chr(0x0);

        $e_password =  base64_encode(openssl_encrypt($username, $method, $hashed, OPENSSL_RAW_DATA, $iv));

        $encrypted = array(
            'username' => $data['user'],
            'password' => $e_password
        );

        return $encrypted;
    }

    public static function createJsonDataTable($data)
    {
        $draw         = $data['draw'];
        $start        = $data['start'];
        $length       = $data['length'];
        $records      = $data['records'];
        $pageSize     = ($length != null ? $length :0);
        $skip         = ($start != null ? $start : 0);
        $recordsTotal = count($records);
        $data = array_slice($records,$skip,$pageSize);
        return '{"draw":"'.$draw.'","recordsFiltered":'.$recordsTotal.',"recordsTotal":'.$recordsTotal.',"data":'.json_encode($data).'}';
    }

    public static function passwordEncrypt($username,$password)
    {
        $method = 'aes-256-cbc';
        // Must be exact 32 chars (256 bit)
        $hashed = substr(hash('sha256', $password, true), 0, 32);
        // IV must be exact 16 chars (128 bit)
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
              chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
              chr(0x0) .chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
              chr(0x0);
        // av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
        $password = base64_encode(openssl_encrypt($username, $method, $hashed, OPENSSL_RAW_DATA, $iv));

        return $password;
    }

    public static function decryptMyHub($encrypted){
    $password = 'atp_dev';

    $method = 'aes-256-cbc';
    // Must be exact 32 chars (256 bit)
    $$password = substr(hash('sha256', $password, true), 0, 32);
    // IV must be exact 16 chars (128 bit)
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
		      chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
		      chr(0x0) .chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
		      chr(0x0);

	  // av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
	  $decrypted = openssl_decrypt(base64_decode($encrypted), $method, $password, OPENSSL_RAW_DATA, $iv);

    return $decrypted;
    }

    //CHECK USER ACCESS (w/ parameters $data='array',$actionIDs='array' or 'not array')
    public static function checkUserAccess($data,$actionIDs)
    {
      if(is_array($actionIDs)):
        foreach($data['userAccess'] as $access):
          if($access['Module_ID'] == $data['moduleID'] && $access['Action_ID'] == 1):
             return true;
          endif;
          if($access['Module_ID'] == $data['moduleID']):
            if(in_array($access['Action_ID'], $actionIDs)):
              return true;
            endif;
          endif;
        endforeach;
      else:
        foreach($data['userAccess'] as $access):
          if($access['Module_ID'] == $data['moduleID'] && $access['Action_ID'] == 1):
            return true;
          endif;
          if($access['Action_ID']  ==  $actionIDs &&
              $access['Module_ID'] == $data['moduleID']):
            return true;
          endif;
        endforeach;
      endif;
      return false;
    }

    public function mobileEncrypt($data)
    {
      $key   = "my32lengthsupersecretnooneknows1";

      $method = 'aes-256-cbc';
      // Must be exact 32 chars (256 bit)
      $newKey = substr(hash('sha256', $key, true), 0, 32);
      // IV must be exact 16 chars (128 bit)
      $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
                chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
                chr(0x0) .chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
                chr(0x0);

      $encrypted=  base64_encode(openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv));

      return $encrypted;
    }

    public function mobileDecrypt($data)
    {
      $key   = "my32lengthsupersecretnooneknows1";

      $method = 'aes-256-cbc';
      // Must be exact 32 chars (256 bit)
      $newKey = substr(hash('sha256', $key, true), 0, 32);
      // IV must be exact 16 chars (128 bit)
      $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
                chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
                chr(0x0) .chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
                chr(0x0);

      $decrypted = openssl_decrypt(base64_decode($data), $method, $key, OPENSSL_RAW_DATA, $iv);

      return $decrypted;
    }


    public function sendEmail($name, $superior, $email, $mode)
    {

        $data = [
            'name'   => $name,
            'email'  => $email,
            'superior' => $superior,
            'mode' => $mode
        ];

        Mail::to($email)->send(new ApprovalMail($data));
    }
}


