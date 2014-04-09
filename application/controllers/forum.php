<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
            require 'application/third_party/SampQuery.class.php';
       }

	public function index()
	{
		$query = $this->db->query('SELECT * FROM `forum_categories` ORDER BY `id` ASC');
		$datestring = "%Y";
		$data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template'),
            'page_name' => 'Forum Index',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'forum_categories' => $this->load->view('../../templates/'.$this->config->item('template').'/forum/cat_loader.php', '', true),
            'user_module' => $this->modules->loadSideBar(),
            'userdata' => $this->user_model->getDetails(get_cookie('token'))
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/forum/index',$data);
		$this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data);
	}

    public function postnew()
    {
        $title = $this->input->post('post_title');        
        $post = $this->input->post('posteditor');
        $forumid = $this->input->post('forum_id');

        $authordata = $this->user_model->getDetails(get_cookie('token'));

        $this->db->query("INSERT INTO `forum_posts` (`id`, `name`, `author`, `timestamp`, `pinned`, `forum_id`) VALUES (NULL, '".$title."', '".$authordata[0]['username']."', NOW(), '0', '".$forumid."')");
        $query = $this->db->query("SELECT * FROM `forum_posts` ORDER BY `id` DESC LIMIT 1");

        $this->db->query("INSERT INTO `forum_content` (`id`, `author`, `content`, `topic_id`, `forum_id`) VALUES (NULL, '".$authordata[0]['username']."', '".$post."', '".$query->result_array()[0]['id']."', '".$forumid."')");
        redirect(base_url().'forum/viewtopic/'.$query->result_array()[0]['id'], 'refresh');
    }

    public function post()
    {        
        $post = $this->input->post('posteditor');
        $forumid = $this->input->post('forum_id');
        $topicid = $this->input->post('topicid');
        $authordata = $this->user_model->getDetails(get_cookie('token'));
        if ($post == '') {
            redirect('/', 'refresh');
        }
        $this->db->query("INSERT INTO `forum_content` (`id`, `author`, `content`, `topic_id`, `forum_id`) VALUES (NULL, '".$authordata[0]['username']."', '".$post."', '".$topicid."', '".$forumid."')");
        redirect(base_url().'forum/viewtopic/'.$topicid, 'refresh');
    }

    public function viewforum($slug)
    {
        $this->load->library('pagination');

        $query = $this->db->query("SELECT * FROM `forum_posts` WHERE `forum_id` ='".$slug."' ORDER BY `id` ASC");

        $config['base_url'] = base_url().'viewforum/'.$slug;
        $config['total_rows'] = $query->num_rows();
        $config['per_page'] = 20; 

        $this->pagination->initialize($config); 

        $datestring = "%Y";
        $data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template'),
            'page_name' => 'Viewing Forum',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'forum_posts' => $this->load->view('../../templates/'.$this->config->item('template').'/forum/forum_loader.php',  array('slug' => $slug), true),
            'user_module' => $this->modules->loadSideBar(),
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'pagination' => $this->pagination->create_links(),
            'id' => $slug
            );

        $this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data);
        $this->parser->parse('../../templates/'.$this->config->item('template').'/forum/viewposts',$data);
        $this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data);
    }

    public function viewtopic($slug)
    { 
        $query = $this->db->query("SELECT * FROM `forum_content` WHERE `topic_id` ='".$slug."' ORDER BY `id` ASC");
        $this->db->query("UPDATE `forum_posts` SET `views` = views+1 WHERE `id` = ".$query->result_array()[0]['topic_id']);
        

        $datestring = "%Y";
        $email = $this->user_model->getDetails(get_cookie('token'))[0]['email'];
        $data = array(
            'blog_title' => $this->config->item('site_title'),
            'blog_heading' => $this->config->item('site_heading'),
            'template_dir' => base_url().'templates/'.$this->config->item('template'),
            'page_name' => 'Viewing Topic',
            'year' => mdate($datestring).' | Powered by FractalBB',
            'topic_posts' => $this->load->view('../../templates/'.$this->config->item('template').'/forum/post_loader.php',  array('slug' => $slug), true),
            'user_module' => $this->modules->loadSideBar(),
            'userdata' => $this->user_model->getDetails(get_cookie('token')),
            'gravatar_hash' => md5(strtolower(trim($email))),
            'forum' => $slug,
            'username' => $this->user_model->getDetails(get_cookie('token'))[0]['username'],
            'topicid' => $slug
            );
        $this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data);
        $this->parser->parse('../../templates/'.$this->config->item('template').'/forum/viewtopic',$data);
        $this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data);
    }
}