<?php

namespace model\admin;

use core\model\orm\wOrm;
use model\db_class\DB_Class;

/**
 * Classe Admin
 * @method int getId()                  Returns the admin's id
 * @method string getEmail()            Returns the admin's email
 * @method string getPass()             Returns the admin's pass
 * @method string getUsername()         Returns the admin's username
 * @method boolean getFull_name()       Returns the admin's full_name
 */ 
 
class Admin extends wOrm
{
  /* Definition */
  protected $id;
  protected $email;
  protected $pass;
  protected $username;
  protected $full_name;

	public function __construct()
	{
		parent::__construct();
		$db = new DB_Class();
	}

	/* Custom methods should come here */

	/**
	* @return boolean
	*/
	public function check_login($emailusername, $password) {
        $password = md5($password);
		
        $result = mysql_query("SELECT ID from admin WHERE email = '$emailusername' or username='$emailusername' and pass = '$password'");
        if($result === FALSE) {
			die(mysql_error()); // TODO: better error handling
		}
		else{
		$user_data = mysql_fetch_array($result);
        $no_rows = mysql_num_rows($result);

        if ($no_rows == 1) {

            $_SESSION['login'] = true;
            $_SESSION['ID'] = $user_data['ID'];
            return TRUE;
        } else {
            return FALSE;
        }
		}
    }
	
	/**
	* @return boolean
	*/
	public function get_session() {
        if (isset($_SESSION['login']))
            return $_SESSION['login'];
        else
            return false;
    }

    public function user_logout() {
        $_SESSION['login'] = FALSE;
        session_destroy();
    }
}

