<?php
class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function logmein($username) //Add token, set cookie, redirect (Login)
    {
    	$logintoken = random_string('alnum', 32); //Generate random alpha numerical 32 char string, check the codeigniter user_guide (included) for different random string types
		$cookie = array(
	    	'name'   => 'token', //Name of the cookie
	    	'value'  => $logintoken, //Add the random string to the cookies value
	    	'expire' =>  time()+60*60*24*365 //Set the expire date
		);
        $data = array(
           'username' => $username, //Username (self explanatory)
           'login_token' => $logintoken //The random token
        );

        $this->db->on_duplicate('login_session', $data); //Custom active record class, check the custom CI user_guide
		set_cookie($cookie); //Set the cookie in the browse
		return redirect("/ucp", "refresh");
    }

    function userFromToken($token) //Get username from login token
    {
        $query = $this->db->get_where('login_session', array('login_token' => $token)); //SELECT * FROM `login_session` WHERE `login_token` = $token
        $username = $query->row_array(); //Run above query
        return $username['username']; //Give the username
    }

    function getDetails($token) //getDetails from a token
    {
    	$query = $this->db->get_where('login_session', array('login_token' => $token)); //SELECT * FROM `login_session` WHERE `login_token` = $token
    	$username = $query->row_array(); //Run above query
        return $this->user_model->getDetailsUsername($username['username']); //Return the details from that username using the selected method
    }

    function getDetailsUsername($username) //Get username details (details from username)
    {
    	$type = $this->config->item('acc_method'); //Store the account method we're using
    	if ($type == "FTP") { //If we use FTP
    		$ini_array = file_get_contents('ftp://'.$this->config->item('ftp_user').':'.$this->config->item('ftp_pass').'@'.$this->config->item('ftp_ip').'/'.$this->config->item('acc_dir').$username.'.ini'); //Run a file_get_contents on a FTP:// URL
			$ini = parse_ini_string($ini_array, true); //Parse the user ini file
			return $ini[$this->config->item('main_tag')]; //Give all details under the main tag
    	}
    	elseif ($type == "MySQL") { //If we use MySQL
            $query = $this->db->get_where('users', array('username' => $username)); //SELECT user details where the username is equal to the give variable
        	return $query->row_array(); //Return the row as an associative array
    	}
    }

}