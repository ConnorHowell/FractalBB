<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ucp extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
            if (is_dir('install')) {
                  die('It seems you haven\'t run the installation script. Or you haven\'t deleted the install directory, you should do so for safety! Please click <a href="../install">here</a> to start the installation process!');
            }
       }

	public function index()
	{
		$blogquery = $this->db->query("SELECT * FROM `posts` WHERE `author` = '".$this->user_model->userFromToken(get_cookie('token'))."' LIMIT 0, 5");
		$forumquery = $this->db->query("SELECT * FROM `forum_posts` WHERE `author` = '".$this->user_model->userFromToken(get_cookie('token'))."' LIMIT 0, 5");

		$user = $this->user_model->getDetails(get_cookie('token'));

		if ($this->config->item('acc_method') == 'FTP') {
			$kills = $user[$this->config->item('kill_tag')];
		}
		elseif ($this->config->item('acc_method') == 'MySQL') {
			$kills = $user['kills'];
		}

		if ($this->config->item('acc_method') == 'FTP') {
			$cash = $user[$this->config->item('cash_tag')];
		}
		elseif ($this->config->item('acc_method') == 'MySQL') {
			$cash = $user['money'];
		}

		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/ucp/',
            'page_name' => 'User Panel',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'kills' => $kills,
            'cash' => number_format($cash),
            'latest_posts' => $blogquery->result_array(),
            'latest_forum_posts' => $forumquery->result_array(),
            'ucp_modules' => $this->modules->generateUCPLinks(),
            'post_count' => $this->db->query("SELECT * FROM `posts` WHERE `author` = '".$this->user_model->userFromToken(get_cookie('token'))."'")->num_rows(),
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/ucp/header',$data); //Initiate the 'header' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/ucp/index',$data); //Initiate the 'index' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/ucp/footer',$data); //Initiate the 'footer' file with all the data above
	}

	public function module($module,$page = 'index')
	{
		$module_config = parse_ini_file("./modules/ucp/".$module."/config.ini");
		$blogquery = $this->db->query("SELECT * FROM `posts` LIMIT 0, 5");
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/ucp/',
            'page_name' => 'User Panel',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'latest_posts' => $blogquery->result_array(),
            'ucp_modules' => $this->modules->generateUCPLinks(),
            'view_path' => './modules/ucp/'.$module_config['url_name'].'/',
            'module_name' => $module_config['name'],
            'module_url' => $module
            );
		if (file_exists("./modules/ucp/".$module."/enabled.fractalbb")) {
			$this->parser->parse('../../templates/'.$this->config->item('template').'/ucp/header',$data); //Initiate the 'header' file with all the data above
			$this->parser->parse('../../modules/ucp/'.$module_config['url_name'].'/'.$page,$data); //Initiate the modules home file with all the data above
			$this->parser->parse('../../templates/'.$this->config->item('template').'/ucp/footer',$data); //Initiate the 'footer' file with all the data above
		}
		else show_404();
	}

	public function editsignature()
	{
		$blogquery = $this->db->query("SELECT * FROM `posts` LIMIT 0, 5");
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/ucp/',
            'page_name' => 'Editing Signature',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'signature' => $this->user_model->getDetails(get_cookie('token'))['signature'],
            'latest_posts' => $blogquery->result_array(),
            'ucp_modules' => $this->modules->generateUCPLinks()
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/ucp/header',$data); //Initiate the 'header' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/ucp/sig',$data); //Initiate the 'sig' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/ucp/footer',$data); //Initiate the 'footer' file with all the data above
	}

	public function login()
	{
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/ucp/',
            'page_name' => 'Login'
            );
		$this->parser->parse('../../templates/'.$this->config->item('template').'/ucp/login',$data); //Initiate the 'login' file with all the data above

		if ($this->input->post('username') !== '' && $this->input->post('password') !== '' && $this->input->post('submit') == 'submit') {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$remember = $this->input->post('remember');
			
			if ($this->config->item('acc_method') == 'FTP') {
				$user = $this->user_model->getDetailsUsername($username);
				if ($user[$this->config->item('pass_tag')] == $this->encryption->encrypt($this->config->item('acc_enc'), $password)) {
					$this->user_model->logmein($username);
				}
				else die('Seems like the details were not correct?');
			}
			elseif($this->config->item('acc_method') == 'MySQL') {
				$this->db->select('*')->from('users')->where('username', $username)->where('password', $this->encryption->encrypt($this->config->item('acc_enc'), $password));
				$query = $this->db->get();

				if ($query->num_rows() == 0) {
					die('Seems like the details were not correct?');
				}
				else $this->user_model->logmein($username);
			}
		}
		elseif($this->input->post('submit') == 'submit') {die('Must fill in all fields.. Not sure how you got passed it??');}
	}

	public function viewuser($username)
	{	
		if (!isset($username)) {
			redirect('/','refresh');
		}
		$blogquery = $this->db->query("SELECT * FROM `comments` WHERE `author` = '".$this->user_model->userFromToken(get_cookie('token'))."' LIMIT 0, 5");
		$forumquery = $this->db->query("SELECT * FROM `forum_posts` WHERE `author` = '".$this->user_model->userFromToken(get_cookie('token'))."' LIMIT 0, 5");
		$user = $this->user_model->getDetails(get_cookie('token'));

		if ($this->config->item('acc_method') == 'FTP') {
			$kills = $user[$this->config->item('kill_tag')];
		}
		elseif ($this->config->item('acc_method') == 'MySQL') {
			$kills = $user['kills'];
		}

		if ($this->config->item('acc_method') == 'FTP') {
			$cash = $user[$this->config->item('cash_tag')];
		}
		elseif ($this->config->item('acc_method') == 'MySQL') {
			$cash = $user['money'];
		}
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/ucp/',
            'page_name' => 'User Panel',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'my_username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'username' => $username,
            'latest_posts' => $blogquery->result_array(),
            'latest_forum' => $forumquery->result_array(),
            'kills' => $kills,
            'cash' => number_format($cash),
            'viewing_user' => $this->user_model->getDetailsUsername($username),
            'gravatar_hash' => md5(strtolower(trim($this->user_model->getDetails(get_cookie('token'))['email']))),
            'ucp_modules' => $this->modules->generateUCPLinks()
            );

		/*if ($this->db->query("SELECT * FROM `users` WHERE `username` = '".$username."'")->num_rows() == 0) {
			show_404();
		}*/

		$this->parser->parse('../../templates/'.$this->config->item('template').'/ucp/header',$data); //Initiate the 'header' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/ucp/user',$data); //Initiate the 'user' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/ucp/footer',$data); //Initiate the 'footer' file with all the data above
	}

	public function logout()
	{
		delete_cookie("token");
		redirect('/', 'refresh');
	}

	public function updateprofile()
	{
		if (get_cookie('token') == FALSE) {
			redirect('/ucp/login', 'refresh');
		}
		elseif (md5($this->input->post('currentPW')) == $this->user_model->getDetails(get_cookie('token'))[0]['password']) {
			$this->db->query("UPDATE `users` SET `password` = '".md5($this->input->post('newPW'))."' WHERE `id` = ".$this->user_model->getDetails(get_cookie('token'))[0]['id']);
			redirect('/ucp', 'refresh');
		} else die('Wrong password!!');
	}

	public function updatesignature()
	{
		if (get_cookie('token') == FALSE) {
			redirect('/ucp/login', 'refresh');
		}
		$this->db->query("UPDATE `users` SET `signature` = '".$this->input->post('posteditor')."' WHERE `id` = ".$this->user_model->getDetails(get_cookie('token'))[0]['id']);
		redirect('/ucp', 'refresh');
	}
}