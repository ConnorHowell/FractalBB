<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
            if (is_dir('install')) {
                  die('It seems you haven\'t run the installation script. Or you haven\'t deleted the install directory, you should do so for safety! Please click <a href="../install">here</a> to start the installation process!');
            }
            require 'application/third_party/SampQuery.class.php';
       }

	public function index()
	{
		$query = $this->db->query('SELECT * FROM `forum_categories` ORDER BY `id` ASC'); //Get all categories ID ASC
		$datestring = "%Y"; //Year
		$data = array(
            'blog_title' => $this->config->item('site_title'), //Site title
            'blog_heading' => $this->config->item('site_heading'), //Site heading
            'template_dir' => base_url().'templates/'.$this->config->item('template'), //Template directory
            'page_name' => 'Forum Index', //Page title
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'year' => mdate($datestring).' | Powered by FractalBB', //Linkback
            'forum_categories' => $this->load->view('../../templates/'.$this->config->item('template').'/forum/cat_loader.php', '', true), //Get all categories using the 'cat_loader' file
            'user_module' => $this->modules->loadSideBar(), //Load sidebar modules
            'userdata' => $this->user_model->getDetails(get_cookie('token'))//User data
            );

		$this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data); //Initiate the 'header' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/forum/index',$data); //Initiate the 'index' file with all the data above
		$this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data); //Initiate the 'footer' file with all the data above
	}

    public function postnew()
    {
        $title = $this->input->post('post_title');  //Title of the new post      
        $post = $this->input->post('posteditor');  //Content of the new post
        $forumid = $this->input->post('forum_id');//The ID of the forum this post will go in

        $authordata = $this->user_model->getDetails(get_cookie('token')); //Author's data (YOU!)

        $this->db->query("INSERT INTO `forum_posts` (`id`, `name`, `author`, `timestamp`, `pinned`, `forum_id`) VALUES (NULL, '".$title."', '".$this->user_model->userFromToken(get_cookie('token'))."', NOW(), '0', '".$forumid."')");
        $query = $this->db->query("SELECT * FROM `forum_posts` ORDER BY `id` DESC LIMIT 1"); //Only edit these queries if you know PHP/SQL

        $this->db->query("INSERT INTO `forum_content` (`id`, `author`, `content`, `topic_id`, `forum_id`) VALUES (NULL, '".$this->user_model->userFromToken(get_cookie('token'))."', '".$post."', '".$query->result_array()[0]['id']."', '".$forumid."')");
        redirect(base_url().'forum/viewtopic/'.$query->result_array()[0]['id'], 'refresh');
    }

    public function post()
    {        
        $post = $this->input->post('posteditor'); //Get contents of the users post
        $forumid = $this->input->post('forum_id'); //Get the current forum id
        $topicid = $this->input->post('topicid'); //Get the topic id
        $authordata = $this->user_model->getDetails(get_cookie('token')); //Get the details of the author
        if ($post == '') {
            redirect('/', 'refresh'); //If post is empty redirect to home page
        }
        $this->db->query("INSERT INTO `forum_content` (`id`, `author`, `content`, `topic_id`, `forum_id`) VALUES (NULL, '".$this->user_model->userFromToken(get_cookie('token'))."', '".$post."', '".$topicid."', '".$forumid."')"); //Query, edit if you know what you're doing
        redirect(base_url().'forum/viewtopic/'.$topicid, 'refresh'); //Redirect to the newly posted resonse
    }

    public function viewforum($slug)
    {
        $this->load->library('pagination');

        $query = $this->db->query("SELECT * FROM `forum_posts` WHERE `forum_id` ='".$slug."' ORDER BY `id` ASC");

        $config['base_url'] = base_url().'viewforum/'.$slug;
        $config['total_rows'] = $query->num_rows();
        $config['per_page'] = 20; 

        $this->pagination->initialize($config); //Pagination ^

        $datestring = "%Y"; //Date (Year)
        $data = array(
            'blog_title' => $this->config->item('site_title'), //Site title
            'blog_heading' => $this->config->item('site_heading'), //Site heading
            'template_dir' => base_url().'templates/'.$this->config->item('template'), //Template direcotry
            'page_name' => 'Viewing Forum', //Page title
            'year' => mdate($datestring).' | Powered by FractalBB', //Linkback
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'forum_posts' => $this->load->view('../../templates/'.$this->config->item('template').'/forum/forum_loader.php',  array('slug' => $slug), true), //Load all forums using 'forum_loader' file
            'user_module' => $this->modules->loadSideBar(), //Load sidebar modules
            'userdata' => $this->user_model->getDetails(get_cookie('token')), //Get userdata
            'pagination' => $this->pagination->create_links(), //Trying to make pagination work... Doesn't
            'id' => $slug //Forum ID
            );

        $this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data); //Initiate the 'header' file with all the data above
        $this->parser->parse('../../templates/'.$this->config->item('template').'/forum/viewposts',$data); //Initiate the 'viewposts' file with all the data above
        $this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data); //Initiate the 'footer' file with all the data above
    }

    public function viewtopic($slug) //View replies to specific topic if ($slug)
    { 
        $query = $this->db->query("SELECT * FROM `forum_content` WHERE `topic_id` ='".$slug."' ORDER BY `id` ASC"); //Get all responses ordered by ID ASC
        $this->db->query("UPDATE `forum_posts` SET `views` = views+1 WHERE `id` = ".$query->result_array()[0]['topic_id']); //Plus 1 view onto the total viewcount for this thread!
        

        $datestring = "%Y"; //Format date for year
        $email = $this->user_model->getDetails(get_cookie('token'))['email']; //Get the users email (Doesn't work as intended for INI based systems)
        $data = array(
            'blog_title' => $this->config->item('site_title'), //Site title
            'blog_heading' => $this->config->item('site_heading'), //Site heading
            'template_dir' => base_url().'templates/'.$this->config->item('template'), //Template directory
            'username' => $this->user_model->userFromToken(get_cookie('token')), //Get username using v1.2 method
            'page_name' => 'Viewing Topic', //Page title
            'year' => mdate($datestring).' | Powered by FractalBB', //Linkback
            'topic_posts' => $this->load->view('../../templates/'.$this->config->item('template').'/forum/post_loader.php',  array('slug' => $slug), true), //Load all posts using the 'post_loader' file
            'user_module' => $this->modules->loadSideBar(), //Load sidebar modules
            'userdata' => $this->user_model->getDetails(get_cookie('token')), //Get userdata
            'gravatar_hash' => md5(strtolower(trim($email))), //Gravatar Hash to get user profile pic
            'forum' => $slug, //Forum ID
            'topicid' => $slug //^^^
            );
        $this->parser->parse('../../templates/'.$this->config->item('template').'/header',$data); //Initiate the 'header' file with all the data above
        $this->parser->parse('../../templates/'.$this->config->item('template').'/forum/viewtopic',$data); //Initiate the 'viewtopic' file with all the data above
        $this->parser->parse('../../templates/'.$this->config->item('template').'/footer',$data); //Initiate the 'footer' file with all the data above
    }
}