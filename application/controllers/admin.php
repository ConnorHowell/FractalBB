<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() //Constructor to load in all functions
       {
            parent::__construct();
            if (is_dir('install')) {
                  die('It seems you haven\'t run the installation script. Or you haven\'t deleted the install directory, you should do so for safety! Please click <a href="../install">here</a> to start the installation process!');
            }
            require 'application/third_party/SampQuery.class.php'; //Includes the class to query SA:MP servers
            require('application/third_party/SampRcon.class.php'); //Includes the class to remote control SA:MP servers using RCON
       }

	public function index() //Main page
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); //Create a query connection to the server
		$rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); //Creates an RCON connection to the server
		$blogquery = $this->db->query("SELECT * FROM `posts` LIMIT 0, 5"); //Get the 5 latest posts
		$datestring = "%Y"; //Format the date

        $checklist = '<li><i class="fa fa-check fa-li text-success"></i>Change your name from the default!</li>
                <li><i class="fa fa-check fa-li text-success"></i>Add a site heading!</li>
                <li><i class="fa fa-check fa-li text-success"></i>Setup the user account hook</li>
                <li><i class="fa fa-check fa-li text-success"></i>Create your first blog post!</li>
                <li><i class="fa fa-check fa-li text-success"></i>Setup a forum!</li>
                <li><i class="fa fa-check fa-li text-success"></i>Install a module.</li>';

        $data = array(
            'blog_title' => $this->config->item('site_title'), //Parse the site title
            'blog_heading' => $this->config->item('site_heading'), //Parse the site heading
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/', //Parse the URL to the template
            'page_name' => 'Dashboard', //Give the page name to the template
            'year' => mdate($datestring).' | Powered by FractalBB', //Parse the date in Year format + FractalBB branding
            'userdata' => $this->user_model->getDetails(get_cookie('token')), //Parse user data in the form of an array
            'latest_posts' => $blogquery->result_array(), //Parse the latest posts in the form of an array
            'players' => $query->getDetailedPlayers(), //Parse all the details of every player in the server
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'checklist' => $checklist //The checklist whether each item has been configured, to avoid in template PHP
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data); //Initiate the admin 'header' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/index',$data); //Initiate the admin 'index' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data); //Initiate the admin 'footer' file with all the data above
	}

	public function account() //Account hook management
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); //Create a query connection to the server
		$rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); //Creates an RCON connection to the server
		$blogquery = $this->db->query("SELECT * FROM `posts` LIMIT 0, 5"); //Get the 5 latest posts
		$datestring = "%Y"; //Format the date
		$data = array(
            'blog_title' => $this->config->item('site_title'), //Parse the site title
            'blog_heading' => $this->config->item('site_heading'), //Parse the site heading
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/', //Parse the URL to the template
            'page_name' => 'Dashboard', //Give the page name to the template
            'year' => mdate($datestring).' | Powered by FractalBB', //Parse the date in Year format + FractalBB branding
            'userdata' => $this->user_model->getDetails(get_cookie('token')), //Parse user data in the form of an array
            'latest_posts' => $blogquery->result_array(), //Parse the latest posts in the form of an array
            'players' => $query->getDetailedPlayers(), //Parse all the details of every player in the server
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'acc_dir' => $this->config->item('acc_dir'),
            'pass_tag' => $this->config->item('pass_tag'),
            'kill_tag' => $this->config->item('kill_tag'),
            'cash_tag' => $this->config->item('cash_tag'),
            'ftp_ip' => $this->config->item('ftp_ip'),
            'ftp_user' => $this->config->item('ftp_user'),
            'ftp_pass' => $this->config->item('ftp_pass'),
            'main_tag' => $this->config->item('main_tag')
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data); //Initiate the admin 'header' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/account_hook',$data); //Initiate the admin 'account_hook' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data); //Initiate the admin 'footer' file with all the data above
	}

	public function blogposts() //All blog posts
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); //Create a query connection to the server
		$rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); //Creates an RCON connection to the server
		$blogquery = $this->db->query("SELECT * FROM `posts`"); //Get all posts
		$datestring = "%Y"; //Format the date
		$data = array(
            'blog_title' => $this->config->item('site_title'), //Parse the site title
            'blog_heading' => $this->config->item('site_heading'), //Parse the site heading
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/', //Parse the URL to the template
            'page_name' => 'Blog Posts', //Give the page name to the template
            'year' => mdate($datestring).' | Powered by FractalBB', //Parse the date in Year format + FractalBB branding
            'userdata' => $this->user_model->getDetails(get_cookie('token')), //Parse user data in the form of an array
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'latest_posts' => $blogquery->result_array(), //Parse the latest posts in the form of an array
            'players' => $query->getDetailedPlayers(), //Parse all the details of every player in the server
            'posts' => $blogquery->result_array() //Parse all the post details
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data); //Initiate the admin 'header' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/blogposts',$data); //Initiate the admin 'blogposts' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data); //Initiate the admin 'footer' file with all the data above
	}

	public function categories()
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
		$rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); 
		$blogquery = $this->db->query("SELECT * FROM `forum_categories`");
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'page_name' => 'Forum Categories',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'latest_posts' => $blogquery->result_array(),
            'players' => $query->getDetailedPlayers(),
            'categories' => $blogquery->result_array() 
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/categories',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function update()
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$blog_title = $this->input->post('blog_title');
		$blog_subtitle = $this->input->post('blog_subtitle');
		$license_key = $this->input->post('license_key');

		$server_ip = $this->input->post('server_ip');
		$server_port = $this->input->post('server_port');
		$rcon_password = $this->input->post('rcon_password');

        $output_path = 'application/config/general.php';
        $database_file = read_file('./templates/'.$this->config->item('template').'/admin/config/config.php');
	
        $new  = str_replace("%SITE_TITLE%",$blog_title,$database_file);
        $new  = str_replace("%SITE_HEADING%",$blog_subtitle,$new);
        $new  = str_replace("%LICENSE_KEY%",$license_key,$new);
        $new  = str_replace("%SERVER_IP%",$server_ip,$new);
        $new  = str_replace("%SERVER_PORT%",$server_port,$new);
        $new  = str_replace("%RCON_PASSWORD%",$rcon_password,$new);
        $new  = str_replace("%THEME%",$this->config->item('template'),$new);

        //new additions, FTP and ACC

        $new  = str_replace("%ACC_METHOD%",$this->config->item('acc_method'),$new);
        $new  = str_replace("%ACC_ENC%",$this->config->item('acc_enc'),$new);
        $new  = str_replace("%ACC_DIR%",$this->config->item('acc_dir'),$new);
        $new  = str_replace("%MAIN_TAG%",$this->config->item('main_tag'),$new);
        $new  = str_replace("%PASS_TAG%",$this->config->item('pass_tag'),$new);
        $new  = str_replace("%KILL_TAG%",$this->config->item('kill_tag'),$new);
        $new  = str_replace("%CASH_TAG%",$this->config->item('cash_tag'),$new);
        $new  = str_replace("%FTP_IP%",$this->config->item('ftp_ip'),$new);
        $new  = str_replace("%FTP_USER%",$this->config->item('ftp_user'),$new);
        $new  = str_replace("%FTP_PASS%",$this->config->item('ftp_pass'),$new);


        $handle = fopen($output_path,'w+');
        @chmod($output_path,0777);
    	fwrite($handle,$new);
    	redirect(base_url().'admin/options', 'refresh');
    	$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function update_acc()
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);

		$acc_method = $this->input->post('acc_method');
		$acc_enc = $this->input->post('acc_enc');
		$acc_dir = $this->input->post('acc_dir');
		$pass_tag = $this->input->post('pass_tag');
		$kill_tag = $this->input->post('kill_tag');
		$cash_tag = $this->input->post('cash_tag');
		$ftp_ip = $this->input->post('ftp_ip');
		$ftp_user = $this->input->post('ftp_user');
		$ftp_pass = $this->input->post('ftp_pass');
		$main_tag = $this->input->post('main_tag');

        $output_path = 'application/config/general.php';
        $database_file = read_file('./templates/'.$this->config->item('template').'/admin/config/config.php');
	
        $new  = str_replace("%SITE_TITLE%",$this->config->item('site_title'),$database_file);
        $new  = str_replace("%SITE_HEADING%",$this->config->item('site_heading'),$new);
        $new  = str_replace("%LICENSE_KEY%",$this->config->item('license_key'),$new);
        $new  = str_replace("%SERVER_IP%",$this->config->item('server_ip'),$new);
        $new  = str_replace("%SERVER_PORT%",$this->config->item('server_port'),$new);
        $new  = str_replace("%RCON_PASSWORD%",$this->config->item('rcon_password'),$new);
        $new  = str_replace("%THEME%",$this->config->item('template'),$new);

        //new additions, FTP and ACC

        $new  = str_replace("%ACC_METHOD%",$acc_method,$new);
        $new  = str_replace("%ACC_ENC%",$acc_enc,$new);
        $new  = str_replace("%ACC_DIR%",$acc_dir,$new);
        $new  = str_replace("%MAIN_TAG%",$main_tag,$new);
        $new  = str_replace("%PASS_TAG%",$pass_tag,$new);
        $new  = str_replace("%KILL_TAG%",$kill_tag,$new);
        $new  = str_replace("%CASH_TAG%",$cash_tag,$new);
        $new  = str_replace("%FTP_IP%",$ftp_ip,$new);
        $new  = str_replace("%FTP_USER%",$ftp_user,$new);
        $new  = str_replace("%FTP_PASS%",$ftp_pass,$new);


        $handle = fopen($output_path,'w+');
        @chmod($output_path,0777);
    	fwrite($handle,$new);
    	redirect(base_url().'admin/account', 'refresh');
    	$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function viewcat($id)
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
		$rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); 
		$blogquery = $this->db->query("SELECT * FROM `forum_forums` WHERE `cat_id` = ".$id);
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'page_name' => 'Viewing Category: '.$id,
            'year' => mdate($datestring).' | Powered by FractalBB',
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'latest_posts' => $blogquery->result_array(),
            'players' => $query->getDetailedPlayers(),
            'forums' => $blogquery->result_array(),
            'forum_id' => $id
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/viewcategories',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function createpost()
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
		$rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); 
		$blogquery = $this->db->query("SELECT * FROM `posts`");
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'page_name' => 'Creating Blog Post',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'latest_posts' => $blogquery->result_array(),
            'players' => $query->getDetailedPlayers(),
            'posts' => $blogquery->result_array() 
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/createpost',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function newforum($id)
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
		$rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); 
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'page_name' => 'Creating Forum',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'players' => $query->getDetailedPlayers(),
            'id' => $id
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/createforum',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function manageposts()
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
		$rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); 
		$forumquery = $this->db->query("SELECT * FROM `forum_content`");
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'page_name' => 'Forum Posts',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'players' => $query->getDetailedPlayers(),
            'posts' => $forumquery->result_array()
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/manageposts',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function managetopics()
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
		$rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); 
		$forumquery = $this->db->query("SELECT * FROM `forum_posts`");
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'page_name' => 'Forum Topics',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'players' => $query->getDetailedPlayers(),
            'posts' => $forumquery->result_array()
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/managetopics',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function editforum($id)
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
		$rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password'));
		$forumquery = $this->db->query("SELECT * FROM `forum_forums` WHERE `id` = ".$id);
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'page_name' => 'Creating Forum',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'players' => $query->getDetailedPlayers(),
            'id' => $id,
            'forum' => $forumquery->result_array() 
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/editforum',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function editentry($id)
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
		$rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); 
		$blogquery = $this->db->query("SELECT * FROM `posts` WHERE `id` = ".$id);
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'page_name' => 'Editing Post',
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'players' => $query->getDetailedPlayers(),
            'post' => $blogquery->result_array() 
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/editpost',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function comments()
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
		$rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); 
		$blogquery = $this->db->query("SELECT * FROM `comments`");
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'page_name' => 'Blog Comments',
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'latest_posts' => $blogquery->result_array(),
            'players' => $query->getDetailedPlayers(),
            'comments' => $blogquery->result_array() 
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/comments',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function settheme($name)
	{
		$output_path = 'application/config/general.php';
        $database_file = read_file('./templates/'.$this->config->item('template').'/admin/config/config.php');
	
        $new  = str_replace("%SITE_TITLE%",$this->config->item('site_title'),$database_file);
        $new  = str_replace("%SITE_HEADING%",$this->config->item('site_heading'),$new);
        $new  = str_replace("%LICENSE_KEY%",$this->config->item('license_key'),$new);
        $new  = str_replace("%SERVER_IP%",$this->config->item('server_ip'),$new);
        $new  = str_replace("%SERVER_PORT%",$this->config->item('server_port'),$new);
        $new  = str_replace("%RCON_PASSWORD%",$this->config->item('rcon_password'),$new);
        $new  = str_replace("%ACC_METHOD%",$this->config->item('acc_method'),$new);
        $new  = str_replace("%ACC_ENC%",$this->config->item('acc_enc'),$new);
        $new  = str_replace("%ACC_DIR%",$this->config->item('acc_dir'),$new);
        $new  = str_replace("%PASS_TAG%",$this->config->item('pass_tag'),$new);
        $new  = str_replace("%KILL_TAG%",$this->config->item('kill_tag'),$new);
        $new  = str_replace("%CASH_TAG%",$this->config->item('cash_tag'),$new);
        $new  = str_replace("%FTP_IP%",$this->config->item('ftp_ip'),$new);
        $new  = str_replace("%FTP_USER%",$this->config->item('ftp_user'),$new);
        $new  = str_replace("%FTP_PASS%",$this->config->item('ftp_pass'),$new);
        $new  = str_replace("%THEME%",$name,$new);

        $handle = fopen($output_path,'w+');
        @chmod($output_path,0777);
    	fwrite($handle,$new);
    	redirect('/	', 'refresh');
	}

	public function forumcreate($id)
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->db->query("INSERT INTO `forum_forums` (`id`, `name`, `description`, `cat_id`) VALUES (NULL, '".$this->input->post('blogtitle')."', '".$this->input->post('posteditor')."', ".$id.")");
		redirect(base_url().'admin/categories', 'refresh');
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function createcat()
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->db->query("INSERT INTO `forum_categories` (`id`, `name`) VALUES (NULL, '".$this->input->post('cattitle')."')");
		redirect(base_url().'admin/categories', 'refresh');
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function deleteforum($id)
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->db->query("DELETE FROM `forum_forums` WHERE `id` = ".$id);
		redirect(base_url().'admin/categories', 'refresh');
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function deletecat($id)
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->db->query("DELETE FROM `forum_categories` WHERE `id` = ".$id);
		redirect(base_url().'admin/categories', 'refresh');
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function deletetopic($id)
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->db->query("DELETE FROM `forum_posts` WHERE `id` = ".$id);
		redirect(base_url().'admin/managetopics', 'refresh');
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

    public function disable_module($module)
    {
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
        unlink('./modules/ucp/'.$module.'/enabled.fractalbb');
        redirect(base_url().'admin/modules_ucp', 'refresh');
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
    }

    public function enable_module($module)
    {
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
        write_file('./modules/ucp/'.$module.'/enabled.fractalbb', '');
        redirect(base_url().'admin/modules_ucp', 'refresh');
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
    }

    public function disable_side_module($module)
    {
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
        unlink('./modules/sidebar/'.$module.'/enabled.fractalbb');
        redirect(base_url().'admin/modules_sidebar', 'refresh');
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
    }

    public function enable_side_module($module)
    {
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
        write_file('./modules/sidebar/'.$module.'/enabled.fractalbb', '');
        redirect(base_url().'admin/modules_sidebar', 'refresh');
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
    }


	public function deleteforumpost($id)
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->db->query("DELETE FROM `forum_content` WHERE `id` = ".$id);
		redirect(base_url().'admin/manageposts', 'refresh');
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function deletecomment($id)
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->db->query("DELETE FROM `comments` WHERE `id` = ".$id);
		redirect(base_url().'admin/comments', 'refresh');
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function postedit($id)
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->db->query("UPDATE `posts` SET `title` = '".$this->input->post('blogtitle')."', `content` = '".$this->input->post('posteditor')."' WHERE `id` = ".$id);
		redirect('/viewpost/'.$id, 'refresh');
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function saveforum($id)
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->db->query("UPDATE `forum_forums` SET `name` = '".$this->input->post('blogtitle')."', `description` = '".$this->input->post('posteditor')."' WHERE `id` = ".$id);
		redirect('/forum', 'refresh');
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function deleteentry($id)
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->db->query("DELETE FROM `posts` WHERE `id` = ".$id);
		redirect(base_url().'admin/blogposts', 'refresh');
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function postcreate()
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$authordata = $this->user_model->getDetails(get_cookie('token'));
		$this->db->query("INSERT INTO `posts` (`id`, `title`, `author`, `timestamp`, `content`) VALUES (NULL, '".$this->input->post('blogtitle')."', '".$authordata[0]['username']."', NOW(), '".$this->input->post('posteditor')."')");
		redirect(base_url().'admin/blogposts', 'refresh');
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function options()
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
		$rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); 
		$blogquery = $this->db->query("SELECT * FROM `posts` LIMIT 0, 5");
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'page_name' => 'Options',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'latest_posts' => $blogquery->result_array(),
            'players' => $query->getDetailedPlayers(),
            'license_key' => $this->config->item('license_key'),
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'server_ip' => $this->config->item('server_ip'), 
            'server_port' => $this->config->item('server_port'),
            'rcon_password' => $this->config->item('rcon_password')
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/options',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

	public function themes()
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
		$rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); 
		$blogquery = $this->db->query("SELECT * FROM `posts` LIMIT 0, 5");
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'page_name' => 'Theme Options',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'latest_posts' => $blogquery->result_array(),
            'players' => $query->getDetailedPlayers(),
            'template_list' => directory_map('./templates/', 1),
            'current_theme' => $this->config->item('template')
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/themes',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
	}

    public function bans()
    {
        $query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
        $rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); 
        $blogquery = $this->db->query("SELECT * FROM `bans`");
        $datestring = "%Y";
        $data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'page_name' => 'Viewing Bans',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'ban_list' => $blogquery->result_array(),
            'players' => $query->getDetailedPlayers()
            );

        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/ban_list',$data);
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
    }

    public function server()
    {
        $query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
        $rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); 
        $datestring = "%Y";
        $data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'page_name' => 'Managing Servers',
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'players' => $query->getDetailedPlayers(),
            'server_info' => $query->getInfo()
            );

        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/server',$data);
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
    }

    public function modules_ucp()
    {
        $query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
        $rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); 
        $blogquery = $this->db->query("SELECT * FROM `posts` LIMIT 0, 5");
        $datestring = "%Y";
        $data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'page_name' => 'UCP Modules',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'latest_posts' => $blogquery->result_array(),
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'players' => $query->getDetailedPlayers(),
            'module_list' => directory_map('./modules/ucp/', 1),
            );

        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/modules',$data);
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
    }

    public function modules_sidebar()
    {
        $query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
        $rcon = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password')); 
        $blogquery = $this->db->query("SELECT * FROM `posts` LIMIT 0, 5");
        $datestring = "%Y";
        $data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template').'/admin/',
            'page_name' => 'UCP Modules',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'latest_posts' => $blogquery->result_array(),
            'players' => $query->getDetailedPlayers(),
            'module_list' => directory_map('./modules/sidebar/', 1),
            );

        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/sidebar',$data);
        $this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
    }

	public function ban($id,$admin,$player)
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$query = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password'));
		if ($query->connect()) { // If a successful connection has been made 
            $query->ban($id); // Ban player ID 1 
            $query->reloadBans(); // Reload the server's bans file 
            $query->close(); // Close the connection 
            $this->db->query("INSERT INTO `bans` (`id`, `player`, `admin`, `timestamp`) VALUES (NULL, '".$player."', '".$admin."', NOW())");
        } else { 
            echo "Server did not respond!"; 
        } 
        $query->close(); // Close the connection 
		redirect(base_url().'admin', 'refresh');
	}

	public function kick($id)
	{
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/header',$data);
		$query = new SampRcon($this->config->item('server_ip'), $this->config->item('server_port'), $this->config->item('rcon_password'));
 
        if ($query->connect()) { // If a successful connection has been made 
            $query->kick($id); // Kick player 
            $query->close(); // Close the connection 
        } else { 
            echo "Server did not respond!"; 
        } 
        $query->close(); // Close the connection 
		$this->parser->parse('../../templates/'.$this->config->item('template').'/admin/footer',$data);
		redirect(base_url().'admin', 'refresh');
	}

	public function logout()
	{
		delete_cookie("token");
		redirect('/', 'refresh');
	}
}