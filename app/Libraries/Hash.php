<?php
namespace App\Libraries;
class Hash
{
    public static function make($input)
    {
    	return password_hash($input, PASSWORD_BCRYPT);
        
    }
  public static function check($input, $db_password)
    {
    	if (password_verify($input, $db_password)) {
    		return true;
    	}else{
    		return false;
    	}
        
    }


}

// Cara menggunakan class 
// echo Hash::make('12345');
// echo Hash::check('12345', '12345');

