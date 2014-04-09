<?php
class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function logmein($username, $password, $remember)
    {
    	$logintoken = random_string('alnum', 32);
		$cookie = array(
	    	'name'   => 'token',
	    	'value'  => $logintoken,
	    	'expire' =>  time()+60*60*24*365
		);

    	$this->db->query("UPDATE `users` SET `login_token` = '".$logintoken."' WHERE `username` = '".$username."'");
		set_cookie($cookie);
		return redirect("/ucp", "refresh");
    }

    function getDetails($token)
    {
    	$query = $this->db->query("SELECT * FROM `users` WHERE `login_token` = '".$token."'");
    	return $query->result_array();
    }

    function getDetailsUsername($username)
    {
        $query = $this->db->query("SELECT * FROM `users` WHERE `username` = '".$username."'");
        return $query->result_array();
    }

}