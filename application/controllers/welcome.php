<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	 public function __construct()
       {
            parent::__construct();
            require 'application/third_party/SampQuery.class.php';
       }

	public function index()
	{
		$query = new SampQuery($this->config->item('server_ip'), $this->config->item('server_port')); 
		$myquery = $this->db->query("SELECT * FROM `posts` ORDER BY `id` DESC");
		$datestring = "%Y";

		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => 'templates/'.$this->config->item('template'),
            'page_name' => 'Home',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'blog_entries' => $myquery->result_array(),
            'modules' => $this->modules->loadSideBar(),
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'pagination' => $this->pagination->create_links()
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/pages/home',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data);
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
            'template_dir' => base_url().'templates/'.$this->config->item('template'),
            'page_name' => 'Currently Online',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'players' => $query->getDetailedPlayers(),
            'userdata' => $this->user_model->getDetails(get_cookie('token'))
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/pages/user_list',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data);
	}

      public function about()
      { 
            $datestring = "%Y";
            $data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template'),
            'page_name' => 'About '.$this->config->item('site_title'),
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token'))
            );

            $this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data);
            $this->parser->parse('../../templates/'.$this->config->item('template').'/pages/about',$data);
            $this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data);
      }

      public function contact()
      {
            $datestring = "%Y";
            $data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template'),
            'page_name' => 'Contact Us',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'userdata' => $this->user_model->getDetails(get_cookie('token'))
            );

            $this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data);
            $this->parser->parse('../../templates/'.$this->config->item('template').'/pages/contact',$data);
            $this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data);
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
            'page_name' => 'Viewing Post',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'blog_entries' => $myquery->result_array(),
            'comments' => $commentquery->result_array(),
            'modules' => $this->modules->loadSideBar(),
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'slug' => $slug
            );

            $this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data);
            $this->parser->parse('../../templates/'.$this->config->item('template').'/pages/viewpost',$data);
            $this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data);
      }

      public function postcomment()
      {
            $postdata = $this->input->post('comment');
            $authordata = $this->user_model->getDetails(get_cookie('token'));
            $this->db->query("INSERT INTO `comments` (`id`, `author`, `content`, `timestamp`, `post_id`) VALUES (NULL, '".$authordata[0]['username']."', '".$postdata."', NOW(), '".$this->input->post('slug')."')");
            redirect(base_url().'viewpost/'.$this->input->post('slug'), 'refresh');
      }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */