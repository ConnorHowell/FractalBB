<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	 public function __construct()
       {
            parent::__construct();
            if (is_dir('install')) {
                  die('It seems you haven\'t run the installation script. Or you haven\'t deleted the install directory, you should do so for safety! Please click <a href="install">here</a> to start the installation process!');
            }
            require 'application/third_party/SampQuery.class.php';
       }

	public function index()
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); //Make a SA:MP query connection
		$myquery = $this->db->query("SELECT * FROM `posts` ORDER BY `id` DESC"); //Get latest posts ordered by ID descending
		$datestring = "%Y"; //Format the date

		$data = array(
            'blog_title' => $this->config->item('site_title'), //Site title
            'blog_heading' => $this->config->item('site_heading'), //Site heading
            'template_dir' => 'templates/'.$this->config->item('template'), //template directory
            'page_name' => 'Home', //This page's name
            'year' => mdate($datestring).' | Powered by FractalBB', //Powered by watermark (Please keep this! <3)
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'blog_entries' => $myquery->result_array(), //Get latest blog entries
            'modules' => $this->modules->loadSideBar(), //Generate sidebar modules
            'userdata' => $this->user_model->getDetails(get_cookie('token')), //Get userdata
            'pagination' => $this->pagination->create_links() //Trying to create pagination links (not implimented)
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data); //Initiate the 'header' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/pages/home',$data); //Initiate the 'home' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data); //Initiate the 'footer' file with all the data above
	}

	public function online()
	{  
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'page_title' => 'Online Users',
            'page_heading' => 'See who\'s online!',
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'template_dir' => base_url().'templates/'.$this->config->item('template'),
            'page_name' => 'Currently Online',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'players' => $query->getDetailedPlayers(),
            'userdata' => $this->user_model->getDetails(get_cookie('token'))
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data); //Initiate the 'header' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/pages/user_list',$data); //Initiate the 'user_list' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data); //Initiate the 'footer' file with all the data above
	}

      public function about()
      { 
            $datestring = "%Y";
            $data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'template_dir' => base_url().'templates/'.$this->config->item('template'),
            'page_name' => 'About '.$this->config->item('site_title'),
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token'))
            );

            $this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data); //Initiate the 'header' file with all the data above
            $this->parser->parse('../../templates/'.$this->config->item('template').'/pages/about',$data); //Initiate the 'about' file with all the data above
            $this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data); //Initiate the 'footer' file with all the data above
      }

      public function contact()
      {
            $datestring = "%Y";
            $data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template'),
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'page_name' => 'Contact Us',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token'))
            );

            $this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data); //Initiate the 'header' file with all the data above
            $this->parser->parse('../../templates/'.$this->config->item('template').'/pages/contact',$data); //Initiate the 'contact' file with all the data above
            $this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data); //Initiate the 'footer' file with all the data above
      }

      public function viewpost($slug)
      { 
            $query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
            $myquery = $this->db->query("SELECT * FROM `posts` WHERE `id` = ".$slug);
            $commentquery = $this->db->query("SELECT * FROM `comments` WHERE `post_id` = ".$slug);
            $datestring = "%Y";
            $data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template'),
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'page_name' => 'Viewing Post',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'blog_entries' => $myquery->result_array(),
            'comments' => $commentquery->result_array(),
            'modules' => $this->modules->loadSideBar(),
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'slug' => $slug
            );

            $this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data); //Initiate the 'header' file with all the data above
            $this->parser->parse('../../templates/'.$this->config->item('template').'/pages/viewpost',$data); //Initiate the 'viewpost' file with all the data above
            $this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data); //Initiate the 'footer' file with all the data above
      }

      public function postcomment()
      {
            $postdata = $this->input->post('comment');
            $this->db->query("INSERT INTO `comments` (`id`, `author`, `content`, `timestamp`, `post_id`) VALUES (NULL, '".$this->user_model->userFromToken(get_cookie('token'))."', '".$postdata."', NOW(), '".$this->input->post('slug')."')");
            redirect(base_url().'viewpost/'.$this->input->post('slug'), 'refresh');
      }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */